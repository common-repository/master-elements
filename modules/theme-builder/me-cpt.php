<?php



namespace MasterElements\Modules\Theme_Builder;



use Elementor\Widgets_Manager;

use MasterElements;

use MasterElements\Modules\Manager\Api;



defined('ABSPATH') || exit;





$p_count = '1';



class Master_Custom_Post

{
    





    public function __construct()

    {



        $this->create_table();



        $this->post_type();





        if (is_admin()) {

            $par = [

                "me_header_settings",

                "me_footer_settings",

                "me_archive_settings",

                "me_single_settings",

                "me_404_settings",

                "me_blog_settings",

                "me_maintenance_settings",

                "me_section_settings",

                "me_search_settings",

                "me_comingsoon_settings",

                "me_megamenu_settings",

                "me_wooproduct_settings"

            ];



            if (in_array(isset($_GET['page']), $par)) {

                wp_enqueue_style('modal-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css', false, \MasterElements::version);

                wp_enqueue_script('modal-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js', array('jquery'), \MasterElements::version, true);

            }



        }





        // wp_enqueue_script('modal-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js', array( 'jquery' ), \MasterElements::version, true );





        add_action('wp_ajax_save_me_settings', [$this, 'save_me_settings']);



        add_action('wp_ajax_nopriv_save_me_settings', [$this, 'save_me_settings']);



        add_action('wp_ajax_remove_post_meta_condition', [$this, 'remove_post_meta_condition']);



        add_action('wp_ajax_nopriv_remove_post_meta_condition', [$this, 'remove_post_meta_condition']);



        add_action('wp_ajax_open_edit_modal', [$this, 'open_edit_modal']);



        add_action('wp_ajax_nopriv_open_edit_modal', [$this, 'open_edit_modal']);



        add_action('wp_ajax_update_post_type_condition', [$this, 'update_post_type_condition']);



        add_action('wp_ajax_nopriv_update_post_type_condition', [$this, 'update_post_type_condition']);



        add_action('wp_ajax_activation_updated', [$this, 'activation_updated']);



        add_action('wp_ajax_nopriv_activation_updated', [$this, 'activation_updated']);



        add_action('admin_menu', [$this, 'cpt_menu']);



        add_filter('single_template', [$this, 'load_canvas_template']);



        add_filter('manage_me_footer_posts_columns', [$this, 'add_new_columns']);



        add_action('manage_me_footer_posts_custom_column', [$this, 'custom_column_data']);



        add_filter('manage_me_header_posts_columns', [$this, 'add_new_columns']);



        add_action('manage_me_header_posts_custom_column', [$this, 'custom_column_data']);



        add_filter('manage_me_archive_posts_columns', [$this, 'add_new_columns']);



        add_action('manage_me_archive_posts_custom_column', [$this, 'custom_column_data']);



        add_filter('manage_me_single_posts_columns', [$this, 'add_new_columns']);



        add_action('manage_me_single_posts_custom_column', [$this, 'custom_column_data']);



        add_filter('manage_me_wooproduct_posts_columns', [$this, 'add_new_columns']);



        add_action('manage_me_wooproduct_posts_custom_column', [$this, 'custom_column_data']);



        add_filter('manage_me_404_posts_columns', [$this, 'add_new_columns']);



        add_action('manage_me_404_posts_custom_column', [$this, 'custom_column_data']);



        add_filter('manage_me_blog_posts_columns', [$this, 'add_new_columns']);



        add_action('manage_me_blog_posts_custom_column', [$this, 'custom_column_data']);



        add_filter('manage_me_maintenance_posts_columns', [$this, 'add_new_columns']);



        add_action('manage_me_maintenance_posts_custom_column', [$this, 'custom_column_data']);



        add_filter('manage_me_section_posts_columns', [$this, 'add_new_columns']);



        add_action('manage_me_section_posts_custom_column', [$this, 'custom_column_data']);



        add_filter('manage_me_search_posts_columns', [$this, 'add_new_columns']);



        add_action('manage_me_search_posts_custom_column', [$this, 'custom_column_data']);



        add_action('wp_ajax_check_module_active', [$this, 'check_module_active']);



        add_action('wp_ajax_get_menu_template', [$this, 'get_menu_template']);



        add_action('wp_ajax_save_menu_postmeta', [$this, 'save_menu_postmeta']);



        add_action('wp_ajax_get_megamenu_control', [$this, 'get_megamenu_control']);



        add_action('wp_ajax_demo_data_import', [$this, 'demo_data_import']);



        add_action('wp_ajax_send_feedback', [$this, 'send_feedback']);



        add_action('wp_ajax_get_cat_data', [$this, 'get_cat_data']);





        wp_enqueue_script('forms-js', \MasterElements::widgets_url() . '/me-forms/assets/js/forms.js', false, \MasterElements::version);



        wp_localize_script('forms-js', 'MS_Ajax', array(

            'ajaxurl' => admin_url('admin-ajax.php'),

        ));

        add_action('wp_ajax_custom_submit_form', [$this, 'custom_submit_form']);

        add_action('wp_ajax_nopriv_custom_submit_form', [$this, 'custom_submit_form']);



    }



    function post_type()

    {





        $template_types = $this->register_sections();



        $settings = $this->get_main_settings_data();



        foreach ($template_types as $type) {



            if (isset($settings[$type['id']]['name']) && $settings[$type['id']]['name'] = $type['id'] && $settings[$type['id']]['value'] != 'no') {





                $labels = array(



                    'name' => __($type['name'], 'masterelements'),



                    'singular_name' => __($type['single'], 'masterelements'),



                    'menu_name' => __($type['name'], 'masterelements'),



                    'name_admin_bar' => __($type['name'], 'masterelements'),



                    'add_new' => __('Add New', 'masterelements'),



                    'add_new_item' => __('Add New ' . $type['item'], 'masterelements'),



                    'new_item' => __('New ' . $type['item'], 'masterelements'),



                    'edit_item' => __('Edit ' . $type['item'], 'masterelements'),



                    'view_item' => __('View ' . $type['item'], 'masterelements'),



                    'all_items' => __('All ' . $type['item'], 'masterelements'),



                    'search_items' => __('Search ' . $type['item'], 'masterelements'),



                    'parent_item_colon' => __('Parent ' . $type['item'], 'masterelements'),



                    'not_found' => __('No ' . $type['item'] . ' found.', 'masterelements'),



                    'not_found_in_trash' => __('No ' . $type['item'] . ' found in Trash.', 'masterelements'),



                );



                $args = array(



                    'labels' => $labels,



                    'public' => true,



                    'menu_icon' => __((isset($type['icon']) ? $type['icon'] : 'dashicons-cart'), 'masterelements'),



                    'rewrite' => false,



                    'show_ui' => true,



                    'show_in_menu' => true,



                    'show_in_nav_menus' => true,



                    'exclude_from_search' => true,



                    'capability_type' => 'page',



                    'hierarchical' => false,



                    'supports' => array('title', 'elementor'),



                );





                register_post_type($type['id'], $args);



            }



        }



    }





    function open_edit_modal()



    {



        if (!empty($_GET['meta_ids']) && !empty($_GET['meta_types'])) {



            $meta_ids = explode(',', $_GET['meta_ids']);



            $condition_a = self::get_complete_meta($meta_ids[0]);



            $condition_sindular = self::get_complete_meta($meta_ids[1]);



            $condition_singular_id = self::get_complete_meta($meta_ids[2]);



            $selected_a = '';



            $selected_b = '';



            $data['condition_a'] = '';



            $data['condition_sing'] = '';



            $data['condition_singular_id'] = '';



            $condition_a_meta_val = $condition_a[0]->meta_value;



            $consition_sing_meta_val = $condition_sindular[0]->meta_value;



            $condition_sing_id_meta_val = $condition_singular_id[0]->meta_value;



            // $postids = unserialize($condition_sing_id_meta_val);



            // print_r($postids);



            // exit();



            $data['condition_a_meta_value'] = $condition_a_meta_val;



            $data['consition_sing_meta_val'] = $consition_sing_meta_val;



            $data['condition_sing_id_meta_val'] = $condition_sing_id_meta_val;





            $data['condition_a'] = '<option value="entire_site" ' . $selected_a = ($condition_a_meta_val === "entire_site" ? "selected='selected'" : "") . '>' . __("Entire Site", "masterelements") . '</option> <option value="singular" ' . $selected_a = ($condition_a_meta_val === "singular" ? "selected='selected'" : "") . '>' . __("Singular", "masterelements") . '</option>



                <option value="archive" ' . $selected_a = ($condition_a_meta_val === "archive" ? "selected='selected'" : "") . '>' . __("Archive", "masterelements") . '</option>





            <option value="archive" ' . $selected_a = ($condition_a_meta_val === "archive" ? "selected='selected'" : "") . '>' . __("Archive", "masterelements") . '</option>



                <option value="woo_single_product" ' . $selected_a = ($condition_a_meta_val === "woo_single_product" ? "selected='selected'" : "") . '>' . __("MW: Single Product", "masterelements") . '</option>



                <option value="woo_archive_product" ' . $selected_a = ($condition_a_meta_val === "woo_archive_product" ? "selected='selected'" : "") . '>' . __("MW: Archive Product", "masterelements") . '</option>



                <option value="woo_product_cart" ' . $selected_a = ($condition_a_meta_val === "woo_product_cart" ? "selected='selected'" : "") . '>' . __("MW: Product Cart", "masterelements") . '</option>



                <option value="woo_product_checkout" ' . $selected_a = ($condition_a_meta_val === "woo_product_checkout" ? "selected='selected'" : "") . '>' . __("MW: Product Checkout", "masterelements") . '</option>

                

                <option value="woo_my_account" ' . $selected_a = ($condition_a_meta_val === "woo_my_account" ? "selected='selected'" : "") . '>' . __("MW: My Account Page", "masterelements") . '</option>

            

                <option value="woo_thankyou_page" ' . $selected_a = ($condition_a_meta_val === "woo_thankyou_page" ? "selected='selected'" : "") . '>' . __("MW: Thankyou Page", "masterelements") . '</option>';



            $data['condition_sing'] = ' <option value="">' . __('Select Any', 'masterelements') . '</option>



                <option value="all" ' . $selected_b = ($consition_sing_meta_val === "all" ? "selected='selected'" : "") . '>' . __('All Singulars', 'masterelements') . '</option>



                <option value="front_page" ' . $selected_b = ($consition_sing_meta_val === "front_page" ? "selected='selected'" : "") . '>' . __('Front Page', 'masterelements') . '</option>



                <option value="all_posts"  ' . $selected_b = ($consition_sing_meta_val === "all_posts" ? "selected='selected'" : "") . '>' . __('All Posts', 'masterelements') . '</option>



                <option value="all_pages"  ' . $selected_b = ($consition_sing_meta_val === "all_pages" ? "selected='selected'" : "") . '>' . __('All Pages', 'masterelements') . '</option>



                <option value="404page"  ' . $selected_b = ($consition_sing_meta_val === "404page" ? "selected='selected'" : "") . '>' . __('404 Page', 'masterelements') . '</option>



                <option value="selective"  ' . $selected_b = ($consition_sing_meta_val === "selective" ? "selected='selected'" : "") . '>' . __('Selective Singular', 'masterelements') . '</option>';





            $data['condition_singular_id'] = '';



            $postids = array();



            if (!empty($condition_sing_id_meta_val)) {



                $postids = unserialize($condition_sing_id_meta_val);



            }



            $args = array(



                'public' => true,



            );





            $output = 'names'; // 'names' or 'objects' (default: 'names')



            $operator = 'and'; // 'and' or 'or' (default: 'and')





            $post_types = get_post_types($args, $output, $operator);





            if ($post_types) { // If there are any custom public post types.



                foreach ($post_types as $post_type) {



                    $args = array(



                        'numberposts' => -1,



                        'post_type' => $post_type



                    );



                    $ecpt = array('metemplate', 'elementor_library', 'attachment');



                    if (!in_array($post_type, $ecpt)) {



                        $posts = get_posts($args);



                        if ($posts) {



                            foreach ($posts as $post) :



                                setup_postdata($post);



                                $selected = '';



                                if (in_array($post->ID, $postids)) {



                                    $selected = "selected";



                                }



                                $data['condition_singular_id'] .= '<option value="' . $post->ID . '" ' . $selected . ' >' . $post->post_title . '</option>';



                            endforeach;



                            wp_reset_postdata();



                        }



                    }



                }



            }



            print_r(json_encode($data, true));



            wp_die();



        }





    }



    function update_post_type_condition()



    {



        print_r($_GET['condition_singular_id']);



        // exit();



        if (!empty($_GET['meta_ids'])) {





            $meta_ids = explode(',', $_GET['meta_ids']);



            $condition_a = self::get_complete_meta($meta_ids[0]);



            $condition_sindular = self::get_complete_meta($meta_ids[1]);



            $condition_singular_id = self::get_complete_meta($meta_ids[2]);



            if (isset($_GET['condition_a']) && !empty($_GET['condition_a'])) {



                update_post_meta($condition_a[0]->post_id, $condition_a[0]->meta_key, $_GET['condition_a']);



            }



            if (isset($_GET['condition_singular'])) {



                update_post_meta($condition_sindular[0]->post_id, $condition_sindular[0]->meta_key, $_GET['condition_singular']);



            }



            if (isset($_GET['condition_singular_id'])) {



                update_post_meta($condition_singular_id[0]->post_id, $condition_singular_id[0]->meta_key, $_GET['condition_singular_id']);



            }



            echo json_encode(array('status' => 'success', 'msg' => 'Settings Updated'));



            // echo "here";



            wp_die();



        }



    }



    function cpt_menu()

    { 



        $template_types = $this->register_sections();



        $settings = $this->get_main_settings_data();



        add_submenu_page('masterelements', esc_html__('Dashboard', 'masterelements'), esc_html__('Dashboard', 'masterelements'), 'manage_options', 'masterelements', [$this, 'dashboard']);



        add_submenu_page('masterelements', esc_html__('Options', 'masterelements'), esc_html__('Options', 'masterelements'), 'manage_options', 'settings', [$this, 'me_settings']);





        foreach ($template_types as $type) {



            if (isset($settings[$type['id']]['name']) && $settings[$type['id']]['name'] = $type['id'] && $settings[$type['id']]['value'] != 'no') {



                add_submenu_page(



                    'edit.php?post_type=' . $type['id'],



                    __('Settings', 'masterelements'),



                    __('Settings', 'masterelements'),



                    'manage_options',



                    $type['id'] . '_settings',



                    [$this, 'posttypes_settings']);





            }



        }



    }
    function dashboard() //Dashboard Screen after clicked on MasterElements option


	{


		require_once \MasterElements:: plugin_dir() . 'admin/pages/dashboard.php';


	}




    function me_settings()

    {



        require_once \MasterElements:: plugin_dir() . 'admin/pages/settings.php';



    }





    function posttypes_settings()

    {



        $activation = 'no';



        $condition_a = '';



        $condition_singular = '';



        ?>





        <form action="" method="POST">



            <div class="em-outer-box">



                <div class="em-option-boxes activation-box">





                    <div class="activation-container-box">



                        <label class="attr-input-label"><?php esc_html_e('Activition:', 'masterelements'); ?></label>



                        <div class="master-admin-input-switch">



                            <input type="checkbox" value="<?= $activation; ?>"

                                   class="master-admin-control-input master-template-activition master-active-<?= $activation; ?>"

                                   name="activation_val" id="master_activation_input">



                            <label class="master-admin-control-label" for="master_activation_modal_input">



                                                    <span class="master-admin-control-label-switch" data-active="ON"



                                                          data-inactive="OFF"></span>



                            </label>



                            <input type="hidden" class="activation_filed" id="activation_filed" name="activation"

                                   value="">



                        </div>



                    </div>





                    <div class="activation-container-box">



                        <div class="activation-flex-box">



                            <label class="attr-input-label"><?php esc_html_e('Choose Template:', 'masterelements'); ?></label>



                        </div>



                        <div class="activation-flex-box">



                            <div class="selection-box">



                                <h4>

                                    <label class="attr-input-label"><?php esc_html_e('Select One:', 'masterelements'); ?></label>

                                </h4>



                                <select id="header-selection" name="type"

                                        class="master-template-type attr-form-control select2 header-selection-dropdown">



                                    <?php



                                    $args = array(



                                        'numberposts' => -1,



                                        'post_type' => $_GET['post_type']



                                    );



                                    $posts = get_posts($args);



                                    if ($posts) {



                                        foreach ($posts as $post) :



                                            setup_postdata($post);



                                            $selected = '';



                                            //                    if (in_array($post->ID, $postids)) {



                                            //                        $selected = "selected";



                                            //                    }



                                            $cd = get_post_meta($post->ID, 'condition_a1');



//                                            echo '<pre>'.$post->ID.print_r($cd,true).'</pre>';



                                            if (is_array($cd) && count($cd) > 0) {



                                                // echo get_post_meta( $post->ID, 'condition_a1');



                                                echo '<option value="' . $post->ID . '" ' . $selected . ' disabled >' . $post->post_title . '</option>';



                                            } else {



                                                //  echo get_post_meta( $post->ID, 'condition_a1');



                                                echo '<option value="' . $post->ID . '" ' . $selected . ' >' . $post->post_title . '</option>';



                                            }



                                        endforeach;



                                        wp_reset_postdata();



                                    }





                                    ?>



                                </select>



                            </div>



                        </div>



                    </div>



                    <div class="activation-container-box">



                        <div class="activation-flex-box">



                            <div class="master-template-option-container ">



                                <div class="master-input-group">



                                    <label class="attr-input-label"><?php esc_html_e('Conditions:', 'masterelements'); ?></label>



                                    <div class="full-widthbox">



                                        <div class="selection-box field-box margin-bottom20">



                                            <select class="master-template-condition_a attr-form-control">



                                                <?php if ($_GET['post_type'] == 'me_archive'): ?>



                                                    <option value="archive"

                                                            class="disabled" <?php selected($condition_a, 'archive', true); ?>><?php esc_html_e('Archive ', 'masterelements'); ?></option>



                                                <?php elseif ($_GET['post_type'] == 'me_maintenance' || $_GET['post_type'] == 'me_404'): ?>



                                                    <option value="entire_site" <?php selected($condition_a, 'entire_site', true); ?>><?php esc_html_e('Entire Site', 'masterelements'); ?></option>



                                                <?php elseif ($_GET['post_type'] == 'me_wooproduct'): ?>



                                                    <option value=" "><?php esc_html_e('Choose Condition', 'masterelements'); ?></option>



                                                    <option value="woo_single_product" <?php selected($condition_a, 'woo_single_product', true); ?>><?php esc_html_e('MW: Single Product Page', 'masterelements'); ?></option>



                                                    <option value="woo_archive_product" <?php selected($condition_a, 'woo_archive_product', true); ?>><?php esc_html_e('MW: Archive Product Page', 'masterelements'); ?></option>



                                                    <option value="woo_product_cart" <?php selected($condition_a, 'woo_product_cart', true); ?>><?php esc_html_e('MW: Cart Product Page', 'masterelements'); ?></option>



                                                    <option value="woo_product_checkout" <?php selected($condition_a, 'woo_product_checkout', true); ?>><?php esc_html_e('MW: Product Checkout Page', 'masterelements'); ?></option>



                                                    <option value="woo_my_account" <?php selected($condition_a, 'woo_my_account', true); ?>><?php esc_html_e('MW: My Account Page', 'masterelements'); ?></option>



                                                    <option value="woo_thankyou_page" <?php selected($condition_a, 'woo_thankyou_page', true); ?>><?php esc_html_e('MW: Thankyou Page', 'masterelements'); ?></option>;



                                                <?php else: ?>



                                                    <option value="entire_site" <?php selected($condition_a, 'entire_site', true); ?>><?php esc_html_e('Entire Site', 'masterelements'); ?></option>



                                                    <option value="singular" <?php selected($condition_a, 'singular', true); ?>><?php esc_html_e('Singular ', 'masterelements'); ?></option>



                                                    <option value="archive" <?php selected($condition_a, 'archive', true); ?>><?php esc_html_e('Archive ', 'masterelements'); ?></option>



                                                <?php endif; ?>



                                            </select>



                                            <input type="hidden" value="1" name="counterCondition"

                                                   id="counterCondition"

                                                   class="counterCondition">



                                            <?php if ($_GET['post_type'] == 'me_archive'): ?>



                                                <input type="hidden" value="archive" name="condition_a1"

                                                       id="condition_a1"

                                                       class="condition_a1">



                                            <?php elseif ($_GET['post_type'] == 'me_wooproduct'): ?>



                                                <input type="hidden" value="woo_single_product" name="condition_a1"

                                                       id="condition_a1"

                                                       class="condition_a1">



                                                <input type="hidden" value="woo_archive_product" name="condition_a1"

                                                       id="condition_a1"

                                                       class="condition_a1">



                                                <input type="hidden" value="woo_product_cart" name="condition_a1"

                                                       id="condition_a1"

                                                       class="condition_a1">



                                                <input type="hidden" value="woo_product_checkout"

                                                       name="condition_a1"

                                                       id="condition_a1"

                                                       class="condition_a1">



                                                <input type="hidden" value="woo_my_account" name="condition_a1"

                                                       id="condition_a1"

                                                       class="condition_a1">



                                                <input type="hidden" value="woo_thankyou_page" name="condition_a1"

                                                       id="condition_a1"

                                                       class="condition_a1">



                                            <?php else: ?>

                                                <input type="hidden" value="entire_site" name="condition_a1"

                                                       id="condition_a1"

                                                       class="condition_a1">

                                            <?php endif; ?>



                                        </div>



                                    </div>



                                </div>





                                <?php



                                $display = 'block';



                                if ($condition_a != 'singular') {



                                    $display = 'none';



                                } ?>



                                <div class="activation-flex-box">



                                    <div class="master-input-group condition_singular"

                                         style="display: <?= $display; ?>">



                                        <label class="attr-input-label"><?php echo __('Select Any:', 'masterelements'); ?></</label>



                                        <select class="master-template-condition_singular attr-form-control">



                                            <option value=""><?php echo __('Select Any', 'masterelements'); ?></

                                            </option>



                                            <option value="all" <?php selected($condition_singular, 'all', true); ?>><?php esc_html_e('All Singulars', 'masterelements'); ?></option>



                                            <option value="front_page" <?php selected($condition_singular, 'front_page', true); ?>><?php esc_html_e('Front Page', 'masterelements'); ?></option>



                                            <option value="all_posts" <?php selected($condition_singular, 'all_posts', true); ?>><?php esc_html_e('All Posts', 'masterelements'); ?></option>



                                            <option value="all_pages" <?php selected($condition_singular, 'all_pages', true); ?>><?php esc_html_e('All Pages', 'masterelements'); ?></option>



                                            <option value="404page" <?php selected($condition_singular, '404page', true); ?>><?php esc_html_e('404 Page', 'masterelements'); ?></option>



                                            <option value="selective" <?php selected($condition_singular, 'selective', true); ?>><?php esc_html_e('Selective Singular', 'masterelements'); ?></option>



                                        </select>



                                        <input type="hidden" name="condition_singular1" id="condition_singular1"

                                               class="condition_singular1">





                                    </div>



                                    <br>



                                    <?php



                                    $display = 'block';



                                    if ($condition_singular != 'selective') {



                                        $display = 'none';



                                    } ?>



                                    <div class="master-template-condition_singular_id-container condition_singular_id"

                                         style="display: <?= $display; ?>">



                                        <div class="master-input-group">



                                            <label class="attr-input-label"><?php echo __('Select Any:', 'masterelements'); ?></</label>



                                            <select style="width:150px;" multiple

                                                    class="master-template-modalinput-condition_singular_id select2">



                                                <?php



                                                $postids = array();



                                                if (!empty($condition_singular_id)) {



                                                    $postids = explode(',', $condition_singular_id);



                                                }



                                                $args = array(



                                                    'public' => true,



                                                );





                                                $output = 'names'; // 'names' or 'objects' (default: 'names')



                                                $operator = 'and'; // 'and' or 'or' (default: 'and')





                                                $post_types = get_post_types($args, $output, $operator);





                                                if ($post_types) { // If there are any custom public post types.



                                                    foreach ($post_types as $post_type) {



                                                        $args = array(



                                                            'numberposts' => -1,



                                                            'post_type' => $post_type



                                                        );



                                                        $ecpt = array('metemplate', 'elementor_library', 'attachment');



                                                        if (!in_array($post_type, $ecpt)) {



                                                            $posts = get_posts($args);



                                                            if ($posts) {



                                                                foreach ($posts as $post) :



                                                                    setup_postdata($post);



                                                                    $selected = '';



                                                                    if (in_array($post->ID, $postids)) {



                                                                        $selected = "selected";



                                                                    }



                                                                    echo '<option value="' . $post->ID . '" ' . $selected . ' >' . $post->post_title . '</option>';



                                                                endforeach;



                                                                wp_reset_postdata();



                                                            }



                                                        }



                                                    }



                                                }





                                                ?>



                                            </select>



                                            <input type="hidden" name="condition_singular_id1[]"

                                                   id="condition_singular_id1" class="condition_singular_id1">





                                        </div>



                                        <br/>



                                    </div>



                                    <br>



                                </div>



                            </div>



                        </div>



                    </div>



                    <div id="newConditionTemplate">





                    </div>



                </div>



            </div>





            <button type="submit" class="option-btn"><?php echo __('Save Data', 'masterelements'); ?></button>



            <?php if ($_GET['post_type'] != 'me_archive'): ?>

                <button type="button" id="addButton"

                        class="blue-btn"><?php echo __('Add more Condition', 'masterelements'); ?></button>

            <?php endif; ?>



            <br>



            <br>





        </form>



        <div style="display: none" id="newRowDiv">



            <div class="master-input-group">



                <label class="attr-input-label"><?php esc_html_e('Conditions:', 'masterelements'); ?></label>



                <select class="master-template-condition_a attr-form-control">



                    <?php if ($_GET['post_type'] == 'me_archive'): ?>



                        <option value="archive"

                                class="disabled" <?php selected($condition_a, 'archive', true); ?>><?php esc_html_e('Archive ', 'masterelements'); ?></option>



                    <?php elseif ($_GET['post_type'] == 'me_wooproduct'): ?>



                        <option value="woo_single_product"

                                class="disabled" <?php selected($condition_a, 'woo_single_product', true); ?>><?php esc_html_e('MW: Single Product Page', 'masterelements'); ?></option>



                        <option value="woo_archive_product"

                                class="disabled" <?php selected($condition_a, 'woo_archive_product', true); ?>><?php esc_html_e('MW: Archive Product Page ', 'masterelements'); ?></option>



                        <option value="woo_product_cart"

                                class="disabled" <?php selected($condition_a, 'woo_product_cart', true); ?>><?php esc_html_e('MW: Product Cart Page ', 'masterelements'); ?></option>



                        <option value="woo_product_checkout"

                                class="disabled" <?php selected($condition_a, 'woo_product_checkout', true); ?>><?php esc_html_e('MW: Product Checkout Page ', 'masterelements'); ?></option>



                        <option value="woo_my_account"

                                class="disabled" <?php selected($condition_a, 'woo_my_account', true); ?>><?php esc_html_e('MW: My Account Page ', 'masterelements'); ?></option>



                        <option value="woo_thankyou_page"

                                class="disabled" <?php selected($condition_a, 'woo_thankyou_page', true); ?>><?php esc_html_e('MW: Thankyou Page ', 'masterelements'); ?></option>;



                    <?php else: ?>



                        <option value="entire_site" <?php selected($condition_a, 'entire_site', true); ?>><?php esc_html_e('Entire Site', 'masterelements'); ?></option>



                        <option value="singular" <?php selected($condition_a, 'singular', true); ?>><?php esc_html_e('Singular ', 'masterelements'); ?></option>



                        <option value="archive" <?php selected($condition_a, 'archive', true); ?>><?php esc_html_e('Archive ', 'masterelements'); ?></option>



                    <?php endif; ?>



                </select>



                <!-- <button type="button" id="addButton" class="btn btn-primary">Add more Condition</button>



                <button style="display: none" type="button" id="removeButton" class="btn btn-primary">Remove Condition</button> -->



            </div>





            <?php



            $display = 'block';



            if ($condition_a != 'singular') {



                $display = 'none';



            } ?>



            <div class="master-input-group condition_singular" style="display: <?= $display; ?>">



                <label class="attr-input-label"><?php echo __('Select Any:', 'masterelements'); ?></label>



                <select class="master-template-condition_singular attr-form-control">



                    <option value=""><?php echo __('Select Any', 'masterelements'); ?></option>



                    <option value="all" <?php selected($condition_singular, 'all', true); ?>><?php esc_html_e('All Singulars', 'masterelements'); ?></option>



                    <option value="front_page" <?php selected($condition_singular, 'front_page', true); ?>><?php esc_html_e('Front Page', 'masterelements'); ?></option>



                    <option value="all_posts" <?php selected($condition_singular, 'all_posts', true); ?>><?php esc_html_e('All Posts', 'masterelements'); ?></option>



                    <option value="all_pages" <?php selected($condition_singular, 'all_pages', true); ?>><?php esc_html_e('All Pages', 'masterelements'); ?></option>



                    <option value="404page" <?php selected($condition_singular, '404page', true); ?>><?php esc_html_e('404 Page', 'masterelements'); ?></option>



                    <option value="selective" <?php selected($condition_singular, 'selective', true); ?>><?php esc_html_e('Selective Singular', 'masterelements'); ?></option>



                </select>



            </div>



            <br>



            <?php



            $display = 'block';



            if ($condition_singular != 'selective') {



                $display = 'none';



            } ?>



            <div class="master-template-condition_singular_id-container condition_singular_id"

                 style="display: <?= $display; ?>">



                <div class="master-input-group">



                    <label class="attr-input-label"><?php echo __('Select Any:', 'masterelements'); ?></label>



                    <select style="width:150px;" multiple

                            class="master-template-modalinput-condition_singular_id select2">



                        <?php



                        $postids = array();



                        if (!empty($condition_singular_id)) {



                            $postids = explode(',', $condition_singular_id);



                        }



                        $args = array(



                            'public' => true,



                        );





                        $output = 'names'; // 'names' or 'objects' (default: 'names')



                        $operator = 'and'; // 'and' or 'or' (default: 'and')





                        $post_types = get_post_types($args, $output, $operator);





                        if ($post_types) { // If there are any custom public post types.



                            foreach ($post_types as $post_type) {



                                $args = array(



                                    'numberposts' => -1,



                                    'post_type' => $post_type



                                );



                                $ecpt = array('metemplate', 'elementor_library', 'attachment');



                                if (!in_array($post_type, $ecpt)) {



                                    $posts = get_posts($args);



                                    if ($posts) {



                                        foreach ($posts as $post) :



                                            setup_postdata($post);



                                            $selected = '';



                                            if (in_array($post->ID, $postids)) {



                                                $selected = "selected";



                                            }



                                            echo '<option value="' . $post->ID . '" ' . $selected . ' >' . $post->post_title . '</option>';



                                        endforeach;



                                        wp_reset_postdata();



                                    }



                                }



                            }



                        }





                        ?>



                    </select>





                </div>





                <br/>



            </div>





            <br>





        </div>





        <?php



        if (isset($_POST) && !empty($_POST) && !empty($_POST['type'] && isset($_POST['counterCondition']))) {



            for ($index = 1; $index <= $_POST['counterCondition']; $index++) {



                if (isset($_POST['condition_a' . $index])) {



                    if (metadata_exists('post', $_POST['type'], $_POST['condition_a' . $index])) {

                        update_post_meta($_POST['type'], 'condition_a' . $index, $_POST['condition_a' . $index]);



                    } else {

                        add_post_meta($_POST['type'], 'condition_a' . $index, $_POST['condition_a' . $index]);



                    }





                }



                if ($_POST['condition_a' . $index] == 'singular') {



                    if (isset($_POST['condition_singular' . $index])) {



                        if (metadata_exists('post', $_POST['type'], $_POST['condition_singular' . $index])) {



                            update_post_meta($_POST['type'], 'condition_singular' . $index, $_POST['condition_singular' . $index]);



                        } else {



                            add_post_meta($_POST['type'], 'condition_singular' . $index, $_POST['condition_singular' . $index]);



                        }





                    }



                    if (isset($_POST['condition_singular_id' . $index])) {



                        if (metadata_exists('post', $_POST['type'], $_POST['condition_singular_id' . $index])) {



                            update_post_meta($_POST['type'], 'condition_singular_id', $index, $_POST['condition_singular_id' . $index]);



                        } else {



                            add_post_meta($_POST['type'], 'condition_singular_id' . $index, $_POST['condition_singular_id' . $index]);



                        }





                    }



                } else {



                    update_post_meta($_POST['type'], 'condition_singular' . $index, '');



                    update_post_meta($_POST['type'], 'condition_singular_id' . $index, '');



                }





            }



            if (metadata_exists('activation', $_POST['type'], $_POST['activation'])) {



                update_post_meta($_POST['type'], 'activation', $_POST['activation']);



            } else {



                add_post_meta($_POST['type'], 'activation', $_POST['activation']);





            }



            if (metadata_exists('counterCondition', $_POST['type'], $_POST['counterCondition'])) {



                update_post_meta($_POST['type'], 'counterCondition', $_POST['counterCondition']);



            } else {



                add_post_meta($_POST['type'], 'counterCondition', $_POST['counterCondition']);





            }



            //  print_r(get_post_meta($_POST['type']));



        }



// } else {



//     echo "Please Select Template";



// }



        if (isset($_POST) && isset($_POST['update']) && !empty($_POST['postmetaids']) && !empty($_POST['postmetatypes'])) {



            echo $_POST;



            exit();



        }



        ?>





        <br>



        <div class="meta-template-option-listing">



            <table class="table">



                <?php

                $args = array(

                    'post_type' => $_GET['post_type'],

                    'post_status' => array('publish'),

                    'order' => 'ASC'

                );



                $posts = query_posts($args);

                ?>



                <tr>



                    <th><?php echo __('Template', 'masterelements'); ?></th>



                    <th><?php echo __('Conditions', 'masterelements'); ?></th>



                    <th><?php echo __('Activation', 'masterelements'); ?></th>



                </tr>



                <?php



                if ($posts) {



                    foreach ($posts as $post) :



                        setup_postdata($post);

                        ?>





                        <tr>

                            <td> <?= $post->post_title ?></td>

                            <td>



                                <?php $conditionCounter = get_post_meta($post->ID, 'counterCondition', true);



                                for ($index = 1; $index <= $conditionCounter; $index++) {



                                    $ca = 'condition_a' . $index;



                                    $cs = 'condition_singular' . $index;



                                    $csid = 'condition_singular_id' . $index;



                                    echo $cad = get_post_meta($post->ID, $ca, true);



                                    $cr = get_post_meta($post->ID, $cs, true);



                                    // echo '<pre>'.print_r($cr,true).'</pre>';



                                    if ($cad === 'singular' && !empty($cr)) {



                                        echo ' > ' . $cr;



                                    }



                                    if ($cr == 'selective') {



                                        print_r(' > ' . implode(',', get_post_meta($post->ID, $csid, true)));



                                    }



                                    if (!empty($cad) || !empty($cr) || !empty(get_post_meta($post->ID, $csid, true))) {



                                        echo '<div class="mastter-post-metaids">



                     <input type="hidden" class="templatePostMetaIds" value="' . self::get_mid_by_key($post->ID, 'condition_a' . $index) . ',' . self::get_mid_by_key($post->ID, 'condition_singular' . $index) . ',' . self::get_mid_by_key($post->ID, 'condition_singular_id' . $index) . '">



        



                    <input type="hidden" class="templatePostMetatypes" value="condition_a' . $index . ',condition_singular' . $index . ',condition_singular_id' . $index . '">



                    <button class="editPostcondition btn btn-primary btn xs" id="editPostcondition" type="button">Edit</button>



                    <button id="removePostcondition" class="removePostcondition btn btn-danger btn-xs" type="button">Remove</button></div>';





                                        //$var =  self::get_complete_meta(152);



                                        // echo $var[0]->meta_value;



                                    }



                                    echo '<br>';



                                }



                                //$activation = (isset($settings[$type['id']]['name']) &&$settings[$type['id']]['name'] = $type['id'])?$settings[$type['id']]['value']:'no';



                                // echo '<pre>'. $activation.'<pre>';



                                $activation = get_post_meta($post->ID, 'activation', true);





                                ?>



                            </td>

                            <td>



                                <div class="master-switch-group">



                                    <label class="attr-input-label"><?php esc_html_e('Activation:', 'masterelements'); ?></label>



                                    <div class="master-admin-input-switch2">



                                        <input type="checkbox" value="<?= $activation; ?>"

                                               data-id="<?= $post->ID; ?>"

                                               class="master-admin-control-input  master-filed-activation master-template-activition master-active-<?= $activation; ?>"

                                               name="activation_val">



                                        <label class="master-admin-control-label"

                                               for="master_activation_modal_input">



									<span class="master-admin-control-label-switch" data-active="ON"



                                          data-inactive="OFF"></span>



                                        </label>



                                        <input type="hidden" name="type" class="post_id_<?= $post->ID; ?>"

                                               value="<?= $post->ID; ?>">



                                        <input type="hidden" class="activation_filed_<?= $post->ID; ?>"

                                               name="activation"



                                               value="<?= (!empty($activation) ? $activation : 'yes?no'); ?>">



                                    </div>

                                </div>

                            </td>

                        </tr>



                    <?php endforeach;



                    wp_reset_postdata();





                }



                ?>



            </table>





            <!-- Link to open the modal -->



            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">



                <div class="modal-dialog" role="document">



                    <div class="modal-content">



                        <div class="modal-header">



                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span

                                        aria-hidden="true">&times;</span></button>



                            <h4 class="modal-title"

                                id="myModalLabel"><?php echo __('Update Condition', 'masterelements'); ?></h4>



                        </div>



                        <div class="modal-body">





                            <?php



                            ?>



                            <div class="master-template-option-container modal-parent-container">



                                <input type="hidden" class="postmetaidsvalues" id="postmetaids" name="postmetaids"

                                       value="">



                                <input type="hidden" class="postmetaidsvalues" id="postmetatypes"

                                       name="postmetatypes"

                                       value="">



                                <div class="master-input-group">



                                    <label class="attr-input-label"><?php esc_html_e('Conditions:', 'masterelements'); ?></label>



                                    <select name="condition_a" id="master-template-condition_a_popup"

                                            class="master-template-condition_a attr-form-control">



                                    </select>



                                </div>





                                <?php



                                // $display = 'block';



                                // if($condition_a!='singular'){



                                //     $display = 'none';



                                // }

                                ?>



                                <div class="master-input-group condition_singular"

                                     id="master-template-condition_singular-container">



                                    <label class="attr-input-label"><?php echo __('Select Any', 'masterelements'); ?></</label>



                                    <select name="condition_singular"

                                            class="master-template-condition_singular attr-form-control"

                                            id="master-template-condition_singular_popup">



                                    </select>



                                </div>



                                <br>



                                <?php



                                // $display = 'block';



                                // if($condition_singular!='selective'){



                                //     $display = 'none';



                                // }

                                ?>



                                <div class="master-template-condition_singular_id-container condition_singular_id"

                                     id="master-template-condition_singular_id-container">



                                    <div class="master-input-group">



                                        <label class="attr-input-label"><?php echo __('Select Any', 'masterelements'); ?></</label>



                                        <select name="condition_singular_id" style="width:150px;" multiple

                                                class="master-template-modalinput-condition_singular_id select2"

                                                id="master-template-condition_singular_id_popup">





                                        </select>



                                    </div>



                                    <br/>



                                </div>



                                <br>



                                <button type="button" class="btn btn-primary update_post_condition_modal"

                                        name="update"

                                        value="Update">Update

                                </button>





                            </div>

                        </div>



                        <div class="modal-footer">



                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>





                        </div>



                    </div>



                </div>



            </div>



        </div>



        <?php

    }





    function get_mid_by_key($post_id, $meta_key)

    {



        global $wpdb;



        $mid = $wpdb->get_var($wpdb->prepare("SELECT meta_id FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $post_id, $meta_key));



        if ($mid != '')



            return (int)$mid;





        return 0;



    }



    function get_complete_meta($meta_id)

    {



        global $wpdb;



        $data = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE meta_id = $meta_id"));



// echo "<pre>".print_r($data[0],true)."</pre>";





        if ($data != '') {



            return $data;



        } else {



            return false;



        }





    }





    function load_canvas_template($single_template)

    {





        global $post;



        $posttypes = $template_types = $this->register_sections();



        foreach ($posttypes as $posttype)



            if ($posttype['id'] == $post->post_type) {





                $elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';





                if (file_exists($elementor_2_0_canvas)) {



                    return $elementor_2_0_canvas;



                } else {



                    return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';



                }



            }





        return $single_template;



    }



    function register_sections()

    {



        return $posttypes = [



            'header' => [



                'name' => 'Header',



                'id' => 'me_header',



                'd_addons' => array('site_navigation'),



                'single' => 'Header Template',



                'icon' => \MasterElements::assets_url() . 'images/icons/header.png',



                'item' => 'Header',



            ],



            'footer' => [



                'name' => 'Footer',



                'id' => 'me_footer',



                'd_addons' => array(''),



                'single' => 'Footer Template',



                'icon' => \MasterElements::assets_url() . 'images/icons/footer.png',



                'item' => 'Footer',



            ],



            'archive' => [



                'name' => 'Archive',



                'id' => 'me_archive',



                'd_addons' => array(''),



                'single' => 'Archive Template',



                'icon' => \MasterElements::assets_url() . 'images/icons/archive.png',



                'item' => 'Archive',



            ],



            'single' => [



                'name' => 'Single',



                'id' => 'me_single',



                'd_addons' => array(''),



                'single' => 'Single Template',



                'icon' => \MasterElements::assets_url() . 'images/icons/single.png',



                'item' => 'Single',



            ],



            '404' => [



                'name' => '404',



                'id' => 'me_404',



                'd_addons' => array(''),



                'single' => '404 Template',



                'icon' => \MasterElements::assets_url() . 'images/icons/404.png',



                'item' => '404',



            ],



            'blog' => [



                'name' => 'Blog Page',



                'id' => 'me_blog',



                'd_addons' => array(''),



                'single' => 'Blog Template',



                'icon' => \MasterElements::assets_url() . 'images/icons/blog.png',



                'item' => 'Blog',



            ],



            'Maintenance' => [



                'name' => 'Under Maintenance',



                'id' => 'me_maintenance',



                'd_addons' => array(''),



                'single' => 'Maintenance Template',



                'icon' => \MasterElements::assets_url() . 'images/icons/maintenance.png',



                'item' => 'Maintenance',



            ],



            'Section' => [



                'name' => 'Section',



                'id' => 'me_section',



                'd_addons' => array(''),



                'single' => 'Section Template',



                'icon' => \MasterElements::assets_url() . 'images/icons/section.png',



                'item' => 'Section',



            ],



            'Search' => [



                'name' => 'Search',



                'id' => 'me_search',



                'd_addons' => array(''),



                'single' => 'Search Template',



                'icon' => \MasterElements::assets_url() . 'images/icons/search.png',



                'item' => 'Search',



            ],



            'Coming Soon' => [



                'name' => 'Coming Soon',



                'id' => 'me_comingsoon',



                'd_addons' => array(''),



                'single' => 'Coming Soon Template',



                'icon' => \MasterElements::assets_url() . 'images/icons/coming_soon.png',



                'item' => 'Coming Soon',



            ],



            'Mega Menu' => [



                'name' => 'Mega Menu',



                'id' => 'me_megamenu',



                'd_addons' => array(''),



                'single' => 'Mega Menu Template',



                'icon' => \MasterElements::assets_url() . 'images/icons/coming_soon.png',



                'item' => 'Mega Menu',



            ],



            'Nested Sections' => [



                'name' => 'Nested Sections',



                'id' => 'me_nested_sections',



                'd_addons' => array(''),



                'single' => 'Nested Sections',



                //'icon' => \MasterElements::assets_url() . 'images/icons/woo.png',



                'item' => 'Nested Sections',

            ],



            'Woocommerce Page' => [



                'name' => 'WooCommerce Page',



                'id' => 'me_wooproduct',



                'd_addons' => array('me_woo_products'),



                'single' => 'Wooproduct Template',



                //'icon' => \MasterElements::assets_url() . 'images/icons/woo.png',



                'item' => 'WooCommerce Page',

            ],





        ];



    }



    // Create table For Theme Builder Settings



    function create_table()

    {



        global $wpdb;



        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');





        /************* Creating Fileds table ************/



        $table_name1 = $wpdb->prefix . "me_settings";



        if ($wpdb->get_var("show tables like '" . $table_name1 . "'") != $table_name1) {



            $sql = "CREATE TABLE " . $table_name1 . "(



                     id int(11) NOT NULL AUTO_INCREMENT,



                     name VARCHAR(255) NOT NULL,



                     value VARCHAR(20) NOT NULL,



                     PRIMARY KEY (id)



                  ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0; ";





            dbDelta($sql);



        }



    }



    // Retrieve data Theme Builder Settings table



    function get_main_settings_data()



    {

        global $wpdb;



        $fields_table_name = $wpdb->prefix . "me_settings";



        $query = "SELECT * FROM " . $fields_table_name;



        $ds = $wpdb->get_results($query, ARRAY_A);

        $data = [];



        foreach ($ds as $d) {



            $data[$d['name']] = $d;



        }



        return $data;

    }



    // Save data for Theme Builder Settings table



    function save_me_settings()

    {

        global $wpdb;

        $table_name = $wpdb->prefix . "me_settings";



        if ($_GET['addon'] != '') {

            $status_arr = explode(',', $_GET['addon']);

            $status_arr[count($status_arr)] = $_GET['type'];

        } else {

            $status_arr[0] = $_GET['type'];

        }



        for ($i = 0; $i < count($status_arr); $i++) {

            $total = $wpdb->get_var("SELECT count(*) FROM " . $table_name . " where name='" . $status_arr[$i] . "'");



            if ($total < 1) {



                $wpdb->query($wpdb->prepare("INSERT INTO " . $table_name . " (name,value) VALUES (%s,%s)", $status_arr[$i], $_GET['status']));



            } else {



                $wpdb->update(



                    $table_name,



                    array(



                        'value' => stripslashes($_GET['status']),



                    ),



                    array('name' => $status_arr[$i]),



                    array(



                        '%s',



                    )



                );



            }

        }



        echo json_encode(array('status' => 'success', 'msg' => 'Settings Updated'));



        wp_die();





    }





    function remove_post_meta_condition()



    {



        // echo $_GET['meta_ids'];



        global $wpdb;



        $table_name = $wpdb->prefix . "postmeta";



        $wpdb->get_var("DELETE FROM " . $table_name . " where meta_id IN (" . $_GET['meta_ids'] . ")");



        echo "Post Meta Setting Deleted Successfully";



        wp_die();





    }



    function activation_updated()



    {



        $post_id = $_REQUEST['meta_ids'];



        global $wpdb;



        $tablename = $wpdb->prefix . "postmeta";



        $status = $_REQUEST['status'];



        echo $sql = "UPDATE `$tablename` SET `meta_value`='" . $status . "' WHERE meta_key = 'activation' AND post_id =" . $post_id;



        $wpdb->query($wpdb->prepare($sql));



        echo 'data updated';



        wp_die();





    }



    function add_new_columns($columns)

    {

        return array_merge($columns,



            array('type' => __('Status'),



                'condition' => __('Condition')));



    }



    function custom_column_data($column)

    {



        global $post;

        global $p_count;

        $p_count++;

        //$c = count1(0);

        //echo '<pre>$Count'. $p_count++ .'</pre>';

        if ($column == 'type' && $p_count % 2 == 0) {

            $activation = get_post_meta($post->ID, 'activation', true);

            echo '<span class="master-status master-status-' . ($activation == 'yes' ? 'active' : 'inactive') . '">' . ($activation == 'yes' ? 'Active' : 'Inactive') . '</span>';

            $p_count++;



        } elseif ($column == 'condition' && $p_count % 2 != 0) {

            $conditionCounter = get_post_meta($post->ID, 'counterCondition', true);



            for ($index = 1; $index <= $conditionCounter; $index++) {



                echo $condition_a = get_post_meta($post->ID, 'condition_a' . $index, true);



                $condition_singular = get_post_meta($post->ID, 'condition_singular' . $index, true);



                if ($condition_a == 'singular') {



                    echo ' > ' . $condition_singular;



                }



                if ($condition_singular == 'selective') {



                    print_r(' > ' . implode(',', get_post_meta($post->ID, 'condition_singular_id' . $index, true)));



                }



                echo '<br>';



            }

            $p_count++;





        }

        /* switch ($column) {



             case 'type':



                 //echo get_post_meta($post->ID, 'type', true);

                 $activation = get_post_meta($post->ID, 'activation', true);

                 echo '<span id = " '. $c . ' " class="master-status master-status-' . ($activation == 'yes' ? 'active' : 'inactive') . '">' . ($activation == 'yes' ? 'Active' : 'Inactive') . '</span>';



                 break;



             case 'condition':



                 //echo get_post_meta( $post->ID , 'c' , true );



                 $conditionCounter = get_post_meta($post->ID, 'counterCondition', true);



                 for ($index = 1; $index <= $conditionCounter; $index++) {



                     echo $condition_a = get_post_meta($post->ID, 'condition_a' . $index, true);



                     $condition_singular = get_post_meta($post->ID, 'condition_singular' . $index, true);



                     if ($condition_a == 'singular') {



                         echo ' > ' . $condition_singular;



                     }



                     if ($condition_singular == 'selective') {



                         print_r(' > ' . implode(',', get_post_meta($post->ID, 'condition_singular_id' . $index, true)));



                     }



                     echo '<br>';



                 }





                 break;



         }*/



    }



    function check_module_active()

    {

        global $wpdb;

        $table_name = $wpdb->prefix . "me_settings";

        $result = $wpdb->get_row("SELECT * FROM " . $table_name . " where name='" . $_GET['module'] . "'");

        $status = ($result->value == 'yes') ? 'yes' : 'no';

        echo $status;

        die;

    }



    function get_menu_template()

    {

        global $wpdb;

        $table_name = $wpdb->prefix . "posts";

             $postslist = $wpdb->get_results (

                        " SELECT * FROM  " . $table_name ."  WHERE post_type =  'me_megamenu' AND post_status = 'publish' ORDER by post_title " );

        $data = array();

        foreach ($postslist as $key => $post) {

                $menu = explode('menu-item-', $_GET['menu']);

                $data[$key]['ID'] = $post->ID;

                $data[$key]['post_title'] = $post->post_title;
                
        }

        echo json_encode($data, true);

        die;

    }



    function save_menu_postmeta()

    {

        $menu = explode('menu-item-', $_POST['menu_id']);

        if (get_post_meta($menu[1])) {

            update_post_meta($menu[1], 'me_megamenu_item', $_POST['megamenu_id']);

        } else {

            add_post_meta($menu[1], 'me_megamenu_item', $_POST['megamenu_id']);

        }

        die;

    }



    function get_megamenu_control()

    {

        global $wpdb;

        $table_name = $wpdb->prefix . "me_settings";
        
        $menu = $wpdb->get_row("SELECT * FROM " . $table_name . " where name='" . $_GET['menu'] . "'");

        echo json_encode($menu, true);

        die;

    }



    function demo_data_import()

    {

        if ($_POST['url'] && $_POST['post_type']) {

            $api = new Api();

            $api->render_widget($_POST['url'], $_POST['post_type']);

        }

        die;

    }



    function get_cat_data()

    {

        $categoryTemplates = [];

        if (isset($_POST['category'])) {

            $demo_data_listing_url = 'http://demo.designingmedia.com/master-demo/template-categories.json';

            $data = file_get_contents($demo_data_listing_url);

            $data = json_decode($data);



            foreach ($data as $k => $d) {

                if ($k == $_POST['category']) {

                    $categoryTemplates = $d;

                }

            }

        }



        echo json_encode($categoryTemplates, true);

        die;

    }



    function send_feedback()

    {

        //user posted variables

        $name = $_POST['name'];

        $email = $_POST['email'];

        $website = $_POST['website'];

        $comment = $_POST['comment'];



        //php mailer variables

        $to = get_option('admin_email');

        $subject = "Masterelement Feedback";

        $headers = 'From: ' . $email . "\r\n" .

            'Reply-To: ' . $email . "\r\n";



        $body = 'Name: ' . $name . "\r\n" .

            'Email: ' . $email . "\r\n" .

            'Website: ' . $website . "\r\n" .

            'Message: ' . $comment . "\r\n";



        //Here put your Validation and send mail

        $sent = wp_mail($to, $subject, strip_tags($body), $headers);

        if ($sent) {

            echo 'Sent';

        }//message sent!

        else {

            echo 'Not Sent';

        }//message wasn't sent



        die;

    }



    function custom_submit_form()

    {

        $body = '';

        if ($_POST['fileds']) {

            $fields = explode('&', $_POST['fileds']);

            foreach ($fields as $k => $v) {

                if ($v !== 'form_id=2fad637') {

                    $body = ' ' . $v . "\r\n";

                }

            }

        }



        wp_mail(get_option('admin_email'), 'Contact Query', $body);

        wp_send_json_success(__('Thanks for reporting !', 'masterelements'));

        wp_die();

    }



}





new Master_Custom_Post();