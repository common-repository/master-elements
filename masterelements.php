<?php



use MasterElements\Master_Woocommerce_Functions;



defined('ABSPATH') || exit;



/**

 * Plugin Name: Master Elements

 * Description: Master Elements enables the users of Elementor\'s free version to Create Header, Footer, Blog, Archive, 404, Search, Search result, Coming soon, Woo Product, Woo Single, Mega Menu for your WordPress website using Elementor Page Builder for free.

 * Plugin URI: https://akdesigner.com/

 * Author: TeamDevBunch

 * Version: 8.0

 * Tested up to: 5.8

 * Author URI: https://devbunch.com/

 *

 * Text Domain: masterelements

 *

 * @package MasterElements

 * @category Free

 *

 */



include_once(ABSPATH . 'wp-admin/includes/plugin.php');



register_activation_hook(__FILE__, 'master_activate');



if (!defined('MASTER_PLUGIN_VERSION'))

    define('MASTER_PLUGIN_VERSION', '0.4.4');



function master_activate()

{



    if (file_exists(WP_PLUGIN_DIR . '/elementor/elementor.php') && is_plugin_active(WP_PLUGIN_DIR . '/elementor/elementor.php')) {



        add_option('me_do_activation_redirect', true); //add option for redirection



    }



}



function master_redirect_to_dashboard()

{ //dashboard redirection function



    if (get_option('me_do_activation_redirect', false)) {



        delete_option('me_do_activation_redirect');



    }





}



/*include_once( ABSPATH . 'wp-admin/includes/plugin.php' );



register_activation_hook(__FILE__, 'master_activate');











function master_activate() {



    //if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) && is_plugin_active( WP_PLUGIN_DIR . '/elementor/elementor.php')) {



        add_option('me_do_activation_redirect', true); //add option for redirection



   //}



}



  function master_redirect_to_dashboard() { //dashboard redirection function



        if (get_option('me_do_activation_redirect', false)) {



            delete_option('me_do_activation_redirect');



            if(!isset($_GET['activate-multi']))



            {



            	//echo "is_plugin_active<pre>".(is_plugin_active( 'masterelement/masterelements.php' ))."</pre>";



                    (wp_redirect(admin_url('admin.php?page=masterelements'))); //redirection



             }



    }



}



add_action('admin_init', 'master_redirect_to_dashboard');*/



define('ME_Path', plugin_dir_path(__FILE__));



if (!class_exists('MasterElements')):



    final class MasterElements

    {





        const MINIMUM_ELEMENTOR_VERSION = '2.4.0';



        const PACKAGE_TYPE = 'free';



        const version = '0.1';



        const MINIMUM_PHP_VERSION = '5.6';



        //public static $elementor_instance;



        static function plugin_dir()

        {



            return trailingslashit(plugin_dir_path(__FILE__));



        }



        private static $_instance = null;



        public static function instance()

        { //create one instance of class (singleton)



            if (is_null(self::$_instance)) {



                self::$_instance = new self();



            }



            return self::$_instance;



        }



        static function plugin_url()

        {



            return trailingslashit(plugin_dir_url(__FILE__));



        }





        static function admin_dir()

        {



            return self::plugin_dir() . 'admin/';



        }



        static function admin_url()

        {



            return self::plugin_url() . 'admin/';



        }



        static function assets_url()

        {



            return self::plugin_url() . 'assets/';



        }



        static function addons_dir()

        {



            return self::plugin_dir() . 'addons/';



        }



        static function addons_url()

        {



            return self::plugin_url() . 'addons/';



        }



        static function widgets_url()

        {



            return self::addons_url() . 'widgets/';



        }



        static function widgets_dir()

        {



            return self::addons_dir() . 'widgets/';



        }



        static function upload_dir()

        {



            $path = wp_upload_dir();



            return $path['basedir'];



        }



        static function upload_url()

        {



            $path = wp_upload_dir();



            return $path['baseurl'];



        }





        public function __construct()

        {


            add_action('wp_enqueue_scripts', array($this, 'load_slider_script'));

            add_action('wp_enqueue_scripts', array($this, 'load_slider_style'));

            add_action('admin_enqueue_scripts', array($this, 'load_admin_style')); //load admin styles



            add_action('elementor/editor/before_enqueue_scripts', array($this, 'load_admin_style'));



            add_action('admin_enqueue_scripts', array($this, 'load_admin_style'));



            add_action('elementor/preview/enqueue_styles', array($this, 'load_frontend_style'));



            add_action('plugins_loaded', array($this, 'load_text_domain'));



            add_action('plugins_loaded', function () {



                require_once self::plugin_dir() . '/classes/notice.php'; //Elementor Missing Notice Code



            });



            require_once self::plugin_dir() . 'addons/widgets.php'; // widgets register File



            add_action('elementor/elements/categories_registered', 'master_addon_categories'); //Register Cutom Addon Categories



            add_action('elementor/widgets/widgets_registered', 'master_init_widgets'); //register widgets



            add_action('elementor/init', [$this, 'master_init_modules']); //register widgets



            if (!did_action('elementor/loaded')) { // Check if Elementor installed and activated



                add_action('admin_notices', [$this, 'missing_elementor_notice']); //show message



                return;



            }



            global $wpdb;



            $fields_table_name = $wpdb->prefix . "me_settings";



            $query = "SELECT * FROM " . $fields_table_name;



            $settings = $wpdb->get_results($query, ARRAY_A);



//            foreach ($settings as $set) {
//
//                if ($set['name'] == 'me_custom_css' && $set['value'] == 'yes') {

            add_action('elementor/init', [$this, 'me_css_control_init']);
            add_action('elementor/init', [$this, 'me_nav_control_init']);

//                }
//
//            }
//            add_action('wp_enqueue_scripts', array($this, 'load_custom_product_script'));

        }



        public function me_css_control_init()

        {

            add_action('elementor/element/after_section_end', function ($section, $section_id) {





                if ('section_advanced' === $section_id || '_section_style' === $section_id) {





                    //Start Custom Settings Section



                    $section->start_controls_section(





                        'opt_css',



                        [



                            'label' => __('MasterElements CSS', 'masterelements'),



                            'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,





                        ]



                    );





                    $section->add_control(



                        'front_note',



                        [



                            'type' => \Elementor\Controls_Manager::RAW_HTML,



                            'raw' => __('This Feature Only Works on the frontend.', 'masterelements'),



                            'content_classes' => 'elementor-descriptor',





                        ]



                    );





                    $repeater = new \Elementor\Repeater();



                    $repeater->add_control(



                        'break_title',



                        [



                            'label' => __('Title', 'masterelements'),



                            'type' => \Elementor\Controls_Manager::TEXT,



                            'default' => __('Default title', 'masterelements'),



                            'placeholder' => __('Type your title here', 'masterelements'),



                        ]



                    );





                    $repeater->add_control(



                        'break_enable',



                        [



                            'label' => __('Enable Media Query', 'masterelements'),



                            'type' => \Elementor\Controls_Manager::SWITCHER,



                            'label_on' => __('Show', 'masterelements'),



                            'label_off' => __('Hide', 'masterelements'),



                            'return_value' => 'yes',



                            'default' => 'yes',



                        ]



                    );





                    $repeater->add_control(



                        'show_min',



                        [



                            'label' => __('Show Min', 'masterelements'),



                            'type' => \Elementor\Controls_Manager::SWITCHER,



                            'label_on' => __('Show', 'masterelements'),



                            'label_off' => __('Hide', 'masterelements'),



                            'return_value' => 'yes',



                            'default' => 'yes',



                            'condition' => [



                                'break_enable' => 'yes',



                            ]



                        ]



                    );





                    $repeater->add_control(



                        'show_max',



                        [



                            'label' => __('Show Max', 'masterelements'),



                            'type' => \Elementor\Controls_Manager::SWITCHER,



                            'label_on' => __('Show', 'masterelements'),



                            'label_off' => __('Hide', 'masterelements'),



                            'return_value' => 'yes',



                            'default' => 'yes',



                            'condition' => [



                                'break_enable' => 'yes',



                            ]



                        ]



                    );



                    $repeater->add_control(



                        'break_min',



                        [



                            'label' => __('Min Width (px)', 'masterelements'),



                            'type' => \Elementor\Controls_Manager::NUMBER,



                            'min' => 5,



                            'max' => 1000,



                            'step' => 5,



                            'default' => 0,



                            'condition' => [



                                'show_min' => 'yes',



                                'break_enable' => 'yes',



                            ]



                        ]



                    );



                    $repeater->add_control(



                        'break_max',



                        [



                            'label' => __('Max Width (px)', 'masterelements'),



                            'type' => \Elementor\Controls_Manager::NUMBER,



                            'min' => 5,



                            'max' => 3000,



                            'step' => 5,



                            'default' => 100,



                            'condition' => [



                                'show_max' => 'yes',



                                'break_enable' => 'yes',



                            ]



                        ]



                    );



                    $repeater->add_control(



                        'custom_css',



                        [



                            'type' => \Elementor\Controls_Manager::CODE,



                            'label' => __('Add Your Own Custom Css Here', 'masterelements'),



                            'language' => 'css',



                            'render_type' => 'ui',



                            'show_label' => false,



                            'separator' => 'none',



                        ]



                    );



                    $repeater->add_control(



                        'css_description',



                        [



                            'raw' => __('Use "selector" to target wrapper element. Examples:<br>selector {color: red;} // For main element<br>selector .child-element {margin: 10px;} // For child element<br>.my-class {text-align: center;} // Or use any custom selector', 'masterelements'),



                            'type' => \Elementor\Controls_Manager::RAW_HTML,



                            'content_classes' => 'elementor-descriptor',



                        ]



                    );



                    $section->add_control(



                        'breakpoints_list',



                        [



                            'label' => __('Add Your Own Custom Css Here', 'masterelements'),



                            'type' => \Elementor\Controls_Manager::REPEATER,



                            'fields' => $repeater->get_controls(),



                            'default' => [



                                [



                                    'break_title' => __('Title #1', 'masterelements'),



                                    'break_enable' => __('yes', 'masterelements'),



                                    'show_min' => __('yes', 'masterelements'),



                                    'show_max' => __('yes', 'masterelements'),



                                    'break_min' => __('Min', 'masterelements'),



                                    'break_max' => __('Max', 'masterelements'),



                                    'custom_css' => __('', 'masterelements'),



                                ],



                            ],



                            'title_field' => '{{{ break_title }}}',



                        ]



                    );



                    #End Custom Settings Section



                    $section->end_controls_section();



                }



            }, 10, 2);

            add_action('elementor/frontend/after_render', function ($section_render) {



                $master_dir = new \MasterElements();

                $dir = $master_dir::upload_dir() . "/masterelements";



                if (is_dir($dir) === false) {



                    mkdir($dir);



                }



                foreach ($section_render->get_settings_for_display('breakpoints_list') as $item) {



                    if ($item['break_enable']) {



                        if ($item['show_min'] == 'yes') {



                            $text = '@media screen and (min-width:' . $item['break_min'] . 'px){' . $item['custom_css'] . '}';



                        } elseif ($item['show_max'] == 'yes') {



                            $text = '@media screen and (max-width:' . $item['break_max'] . 'px){' . $item['custom_css'] . '}';



                        }



                        if ($item['show_min'] == 'yes' && $item['show_max'] == 'yes') {



                            $text = '@media  (min-width:' . $item['break_min'] . 'px) and (max-width:' . $item['break_max'] . 'px){' . $item['custom_css'] . '}';



                        }



                    } else {



                        $text = $item['custom_css'];



                    }



                    if ($item['break_min'] === 'Min' || $item['break_max'] === 'Max' || $item['custom_css'] === '') {



                    } else {



                        $filename = $dir . "/post-" . $item['_id'] . ".css";



                        $fh = fopen($filename, "w");



                        fwrite($fh, $text);



                        if (is_multisite() == 1) {

                            wp_enqueue_style('custom-breakpoint' . $item['_id'], WP_CONTENT_DIR . '/uploads/sites/' . get_current_blog_id() . '/masterelements/post-' . $item['_id'] . '.css', true, true);

                        } else {

                            wp_enqueue_style('custom-breakpoint' . $item['_id'], content_url() . '/uploads/masterelements/post-' . $item['_id'] . '.css', true, true);

                        }

                        fclose($fh);



                    }



                }



            }, 11);

        }


        public function me_nav_control_init()

        {

            add_action('elementor/element/after_section_end', function ($section, $section_id) {





                if ('section_advanced' === $section_id || '_section_style' === $section_id) {





                    //Start Custom Settings Section



                    $section->start_controls_section(


                        'opt_nav',


                        [

                            'label' => __('Master Elements Navigation', 'masterelements'),

                            'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,


                        ]

                    );

                    $section->add_control(



                        'front_nav',



                        [



                            'type' => \Elementor\Controls_Manager::RAW_HTML,



                            'raw' => __('This Feature Only Works on the frontend.', 'masterelements'),



                            'content_classes' => 'elementor-descriptor',





                        ]



                    );

                    $section->add_control(
                        'navigation',
                        [
                            'label' => __('Navigate Style', 'masterelements'),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'both',
                            'options' => [
                                'both' => __('Arrows and Dots', 'masterelements'),
                                'arrows' => __('Arrows', 'masterelements'),
                                'dots' => __('Dots', 'masterelements'),
                                'none' => __('None', 'masterelements'),
                            ],
                            'frontend_available' => true,
                        ]
                    );

                    $section->add_control(
                        'heading_style_arrows',
                        [
                            'label' => __('Arrows', 'masterelements'),
                            'type' => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                            'condition' => [
                                'navigation' => ['arrows', 'both'],
                            ],
                        ]
                    );

                    $section->add_control(
                        'arrows_size',
                        [
                            'label' => __('Arrows Size', 'masterelements'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 20,
                                    'max' => 60,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .master-navigation-arrow' => 'font-size: {{SIZE}}{{UNIT}}',
                            ],
                            'condition' => [
                                'navigation' => ['arrows', 'both'],
                            ],
                        ]
                    );

                    $section->add_control(
                        'arrows_color',
                        [
                            'label' => __('Arrows Color', 'masterelements'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-navigation-arrow' => 'color: {{VALUE}}',
                            ],
                            'condition' => [
                                'navigation' => ['arrows', 'both'],
                            ],
                        ]
                    );

                    $section->add_control(
                        'heading_style_dots',
                        [
                            'label' => __('Dots', 'masterelements'),
                            'type' => \Elementor\Controls_Manager::HEADING,
                            'separator' => 'before',
                            'condition' => [
                                'navigation' => ['dots', 'both'],
                            ],
                        ]
                    );

                    $section->add_control(
                        'dots_size',
                        [
                            'label' => __('Dots Size', 'masterelements'),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'min' => 5,
                                    'max' => 15,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .master-navigation-dots' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',

                            ],
                            'condition' => [
                                'navigation' => ['dots', 'both'],
                            ],
                        ]
                    );

                    $section->add_control(
                        'dots_color',
                        [
                            'label' => __('Dots Color', 'masterelements'),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-navigation-dots' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [
                                'navigation' => ['dots', 'both'],
                            ],
                        ]
                    );

                    $section->end_controls_section();



                }



            }, 10, 2);

            add_action('elementor/frontend/after_render', function ($section_render) {



                $master_dir = new \MasterElements();

                $dir = $master_dir::upload_dir() . "/masterelements";



                if (is_dir($dir) === false) {



                    mkdir($dir);



                }



                foreach ($section_render->get_settings_for_display('breakpoints_list') as $item) {



                    if ($item['break_enable']) {



                        if ($item['show_min'] == 'yes') {



                            $text = '@media screen and (min-width:' . $item['break_min'] . 'px){' . $item['custom_css'] . '}';



                        } elseif ($item['show_max'] == 'yes') {



                            $text = '@media screen and (max-width:' . $item['break_max'] . 'px){' . $item['custom_css'] . '}';



                        }



                        if ($item['show_min'] == 'yes' && $item['show_max'] == 'yes') {



                            $text = '@media  (min-width:' . $item['break_min'] . 'px) and (max-width:' . $item['break_max'] . 'px){' . $item['custom_css'] . '}';



                        }



                    } else {



                        $text = $item['custom_css'];



                    }



                    if ($item['break_min'] === 'Min' || $item['break_max'] === 'Max' || $item['custom_css'] === '') {



                    } else {



                        $filename = $dir . "/post-" . $item['_id'] . ".css";



                        $fh = fopen($filename, "w");



                        fwrite($fh, $text);



                        if (is_multisite() == 1) {

                            wp_enqueue_style('custom-breakpoint' . $item['_id'], WP_CONTENT_DIR . '/uploads/sites/' . get_current_blog_id() . '/masterelements/post-' . $item['_id'] . '.css', true, true);

                        } else {

                            wp_enqueue_style('custom-breakpoint' . $item['_id'], content_url() . '/uploads/masterelements/post-' . $item['_id'] . '.css', true, true);

                        }

                        fclose($fh);



                    }



                }



            }, 11);

        }



        public function me_woo_init()

        {



            add_action('admin_action_elementor', array($this, 'wc_frontend_registration'), 5);

        }



        public function wc_frontend_registration()

        {

            $master_frontend = new Master_Woocommerce_Functions();

            $master_frontend::mw_wc_frontend();



            if (is_null($master_frontend::mw_wc_cart())) {

                global $woocommerce;

                $session_class = apply_filters('woocommerce_session_handler', 'WC_Session_Handler');

                $woocommerce->session = new $session_class();

                $woocommerce->session->init();



                $woocommerce->cart = new WC_Cart(); // Woocommerce Class

                $woocommerce->customer = new WC_Customer(get_current_user_id(), true);  //Woocommerce Class and Function

            }

        }



        function load_text_domain()

        {





            if (file_exists(WP_PLUGIN_DIR . '/woocommerce/woocommerce.php') && is_plugin_active('woocommerce/woocommerce.php')) {

                add_action('init', array($this, 'me_woo_init'));

            }



            load_plugin_textdomain('masterelements', FALSE, basename(dirname(__FILE__)) . '/languages/');



        }


//        function load_custom_product_script()
//        {
//            wp_register_script('me-woo-custom-product-js', \MasterElements::widgets_url() . '/woo-cart-navigation/js/cart-navigation.js', array('jquery'), \MasterElements::version);
//
//            wp_enqueue_script( 'me-woo-custom-product-js');
//
//        }

        function load_slider_script() {
            wp_enqueue_script( 'slider_script', self::assets_url() . 'js/myscript.js', array('jquery'), false, false );
        }
        function load_slider_style()
        {
            wp_enqueue_style( 'slider_style', self::assets_url() . 'css/mystyle.css' );
            wp_enqueue_style( 'my_custom_style_2', "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" );
        }

        function load_admin_style()



        { //function to load admin style



            wp_enqueue_style('notics_style', self::assets_url() . '/css/notics-style.css', null, self::version, 'all');



            wp_register_style('fontawesome', \MasterElements::assets_url() . 'css/fontawesome.min.css', [], '1.0.1');



            if (is_admin()) { //check if its a admin interface and style is enqueued already





                // wp_enqueue_style('bootstrap_min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', null, self::version, 'all');
// 


                // wp_enqueue_style('bootstrap_theme_min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css', null, self::version, 'all');



                // wp_enqueue_script('bootstrap_theme_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', null, self::version, 'all');



                wp_enqueue_style('select2', self::assets_url() . 'css/select2.min.css', null, self::version, 'all');



                wp_enqueue_style('admin_style', self::assets_url() . 'css/admin_style.css', null, self::version, 'all');



                wp_enqueue_script('select2', self::assets_url() . 'js/select2.min.js', null, self::version, 'all');



                wp_enqueue_script('admin_script', self::assets_url() . 'js/admin_script.js', null, self::version, 'all');



                wp_localize_script('admin_script', 'frontend_ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));



                wp_enqueue_script('mega_menu', self::assets_url() . 'js/mega_menu.js', null, self::version, 'all');



                add_action('plugin_action_links_' . plugin_basename(__FILE__), [$this, 'my_plugin_action_links']);



                global $wpdb;

                $nested_table_name = $wpdb->prefix . "me_settings";



                $nested_value = $wpdb->get_var("SELECT value FROM " . $nested_table_name . " where name='" . 'me_nested_sections' . "'");

                if ($nested_value == 'yes') {

                    wp_enqueue_script('master_nested_script', self::assets_url() . 'js/master-nested.js', null, self::version, 'all');

                }



            }

        }



        function get_settings_for_nested()

        {

            global $wpdb;

            $nested_table_name = $wpdb->prefix . "me_settings";



            $nested_value = $wpdb->get_var("SELECT value FROM " . $nested_table_name . " where name='" . 'me_nested_sections' . "'");

            return $nested_value;

        }



        function my_plugin_action_links($links)

        {



            $links = array_merge($links, array(

                '<a href="' . esc_url(admin_url('/admin.php?page=settings')) . '">' . __('Settings', 'masterelements') . '</a>'

            ));

            return $links;



        }



        function load_frontend_style()



        { //function to load admin style



            wp_enqueue_style('frontend_masterelements', self::assets_url() . 'css/frontend.css', null, self::version, 'all');



        }



        static function default_modules($package = null)

        {



            $package = ($package != null) ? $package : self::PACKAGE_TYPE;



            $default_list = [



                'theme-builder',



            ];



            return $default_list;



        }



        function master_init_modules()

        {



            require_once self::plugin_dir() . '/handler.php';



            $coremodules = Self::default_modules();



            foreach ($coremodules as $module) {



                $class_name = '\MasterElements\Modules\\' . \MasterElements\Classes\Utils::make_classname($module) . '\Init';



                new $class_name();



            }



        }



        function missing_elementor_notice()

        { //function to show elementor missing message





            if (file_exists(WP_PLUGIN_DIR . '/elementor/elementor.php')) {



                $btn['label'] = esc_html__('Activate Elementor', 'masterelements');



                $btn['url'] = wp_nonce_url('plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php');



            } else {



                $btn['label'] = esc_html__('Install Elementor', 'masterelements');



                $btn['url'] = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');



            }



            \MasterElements\Notice::sendParams(



                [





                    'type' => 'error',



                    'dismissible' => true,



                    'btn' => $btn,



                    'message' => '',



                ]



            );



        }



        static function me_get_all_post_types()

        {

            $post_type_args = [

                'show_in_nav_menus' => true,

            ];

            $post_types = get_post_types($post_type_args, 'objects');



            foreach ($post_types as $post_type) {

                $post_type_name[$post_type->name] = $post_type->label;

            }

            return $post_type_name;

        }



        static function me_get_all_taxonomies($category = 'category')

        {

            $category_posts = get_terms(

                array(

                    'taxonomy' => $category,

                )

            );



            foreach ($category_posts as $category_post) {

                $category_posts_name[$category_post->slug] = $category_post->name;

            }



            return $category_posts_name;

        }



    }



    new MasterElements(); //load one instance of MasterElements class



endif;



