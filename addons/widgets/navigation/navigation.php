<?php







namespace Elementor;







use \Elementor\Controls_Manager;



use MasterElements\Modules\Theme_Builder\Master_Custom_Post;







include('classes/walker-nav-menu.php');







if (!defined('ABSPATH')) exit;







class Master_Navigation extends Widget_Base



{



    public $base;







    public function __construct($data = [], $args = null)



    {



        parent::__construct($data, $args);



        wp_enqueue_style('all-css', \MasterElements::widgets_url() . 'navigation/assets/css/all.min.css', false, \MasterElements::version, false);



        wp_enqueue_style('demo-css', \MasterElements::widgets_url() . 'navigation/assets/css/demo.css', false, \MasterElements::version, false);



        wp_enqueue_style('item-css', \MasterElements::widgets_url() . 'navigation/assets/css/item.css', false, \MasterElements::version, false);



        wp_enqueue_style('normal-css', \MasterElements::widgets_url() . 'navigation/assets/css/normalize.min.css', false, \MasterElements::version, false);



        add_action('elementor/editor/after_enqueue_scripts', function () {



            wp_enqueue_script('navigation-admin-js', \MasterElements::widgets_url() . '/navigation/assets/js/navigation_script.js', array('jquery'), \MasterElements::version, false);



        });



        add_action('elementor/frontend/after_enqueue_scripts', function () {



            wp_enqueue_script('navigation-admin-js', \MasterElements::widgets_url() . '/navigation/assets/js/navigation_script.js', array('jquery'), \MasterElements::version, false);



        });



    }







    public function get_style_depends()



    {







        return ['all-css', 'demo-css', 'item-css', 'normal-css'];



    }











    public function get_name()



    {



        /////////////////////////



        //get name from file////



        ////////////////////////



        return 'master-navigation';



    }







    public function get_title()



    {



        /////////////////////////



        //get title from file////



        /////////////////////////



        return esc_html__('Master Navigation', 'masterelements');



    }







    public function get_icon()



    {



        //////////////////////////



        //get icon from file/////



        /////////////////////////



        return 'fa fa-bars';



    }







    public function get_categories()



    {



        //////////////////////////



        // category of widget



        //////////////////////////



        return ['master-addons'];



    }



    /////////////////////////////////



    /// Getting list of nav menu ///



    ////////////////////////////////



    public function get_menus()



    {



        $list = [];



        $menus = wp_get_nav_menus();



        foreach ($menus as $menu) {



            $list[$menu->slug] = $menu->name;



        }



        return $list;



    }



    ///////////////////////////



    //register controls////////



    //////////////////////////



    protected function _register_controls()



    {



        //////////////////////////////////



        //control section inside  widget//



        //////////////////////////////////



        $this->start_controls_section(



            'content_section',



            [



                'label' => __('Master Navigation', 'masterelements'),



                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,



            ]



        );







        $this->add_control(



            'master_navigation_header_alignment',



            [



                'label' => __('Layouts', 'masterelements'),



                'label_block' => true,



                'type' => Controls_Manager::SELECT,



                'multiple' => true,



                'default' => __('left', 'masterelements'),



                'options' => [



                    'left' => __('01 Align Left', 'masterelements'),



                    'right' => __('02 Align Right', 'masterelements'),



                    'center' => __('03 Align Center', 'masterelements'),



                    'center-1' => __('04 Center 1', 'masterelements'),



                    'center-2' => __('05 Center 2', 'masterelements'),



                    'center-3' => __('06 Center 3', 'masterelements'),



                ],



            ]



        );



        $this->add_control(



            'master_navigation_menu',



            [



                'label' => esc_html__('Select Menu', 'masterelements'),



                'type' => Controls_Manager::SELECT,



                'options' => $this->get_menus(),



                'condition' => [



                    'master_navigation_header_alignment!' => ['center-1', 'center-2']



                ],



            ]



        );



        $this->add_control(



            'master_navigation_mobile_menu',



            [



                'label' => esc_html__('Select Mobile Menu', 'masterelements'),



                'type' => Controls_Manager::SELECT,



                'options' => $this->get_menus(),



                'condition' => [



                    'master_navigation_header_alignment!' => ['center-1', 'center-2']



                ],



            ]



        );



        $this->add_control(



            'master_navigation_menu_left',



            [



                'label' => esc_html__('Left Menu', 'masterelements'),



                'type' => Controls_Manager::SELECT,



                'options' => $this->get_menus(),



                'condition' => [



                    'master_navigation_header_alignment' => ['center-1', 'center-2']



                ],



            ]



        );



        $this->add_control(



            'master_navigation_menu_right',



            [



                'label' => esc_html__('Right Menu', 'masterelements'),



                'type' => Controls_Manager::SELECT,



                'options' => $this->get_menus(),



                'condition' => [



                    'master_navigation_header_alignment' => ['center-1', 'center-2']



                ],



            ]



        );



        $this->add_control(



            'different_logo_img_for_mobile',



            [



                'label' => __('Different Logo For Mobile', 'masterelements'),



                'type' => Controls_Manager::SWITCHER,



                'return_value' => 'true',



                'default' => '',



            ]



        );



        $this->add_control(



            'master_navigation_image_mobile',



            [



                'label' => __('Choose Logo Image For Drawer Menu', 'plugin-domain'),



                'type' => Controls_Manager::MEDIA,



                'default' => [



                    'url' => Utils::get_placeholder_image_src(),



                ],



                'condition' => [



                    'different_logo_img_for_mobile' => 'true',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_width_mobile',



            [



                'label' => __('Mobile Logo Width', 'masterelements'),



                'type' => Controls_Manager::SLIDER,



                'size_units' => ['px', '%'],



                'range' => [



                    'px' => [



                        'min' => 0,



                        'max' => 1000,



                    ],



                    '%' => [



                        'min' => 0,



                        'max' => 100,



                    ],



                ],



                'default' => [



                    'unit' => 'px',



                    'size' => 50,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-logo-light-mobile, {{WRAPPER}} .master-nav-logo-dark-mobile' => 'width: {{SIZE}}{{UNIT}};',



                ],



                'condition' => [



                    'different_logo_img_for_mobile' => 'true',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_height_mobile',



            [



                'label' => __('Mobile Logo Height', 'masterelements'),



                'type' => Controls_Manager::SLIDER,



                'size_units' => ['px', '%'],



                'range' => [



                    'px' => [



                        'min' => 0,



                        'max' => 1000,



                    ],



                    '%' => [



                        'min' => 0,



                        'max' => 100,



                    ],



                ],



                'default' => [



                    'unit' => 'px',



                    'size' => 50,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-logo-light-mobile, {{WRAPPER}} .master-nav-logo-dark-mobile' => 'height: {{SIZE}}{{UNIT}};',



                ],



                'condition' => [



                    'different_logo_img_for_mobile' => 'true',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_close_icon_mobile',



            [



                'label' => __('Upload Close Icon For Drawer Menu', 'plugin-domain'),



                'type' => Controls_Manager::MEDIA,



                'default' => [



                    'url' => \MasterElements::widgets_url() . '/navigation/assets/images/close.png',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_close_icon_mobile_width',



            [



                'label' => __('Close Icon Width', 'masterelements'),



                'type' => Controls_Manager::SLIDER,



                'size_units' => ['px', '%'],



                'range' => [



                    'px' => [



                        'min' => 0,



                        'max' => 1000,



                    ],



                    '%' => [



                        'min' => 0,



                        'max' => 100,



                    ],



                ],



                'default' => [



                    'unit' => 'px',



                    'size' => 22,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-close-icon-light, {{WRAPPER}} .master-nav-close-icon-dark' => 'width: {{SIZE}}{{UNIT}};',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_close_icon_mobile_height',



            [



                'label' => __('Close Icon Height', 'masterelements'),



                'type' => Controls_Manager::SLIDER,



                'size_units' => ['px', '%'],



                'range' => [



                    'px' => [



                        'min' => 0,



                        'max' => 1000,



                    ],



                    '%' => [



                        'min' => 0,



                        'max' => 100,



                    ],



                ],



                'default' => [



                    'unit' => 'px',



                    'size' => 24,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-close-icon-light, {{WRAPPER}} .master-nav-close-icon-dark' => 'height: {{SIZE}}{{UNIT}};',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_image',



            [



                'label' => __('Choose Logo Image for Desktop', 'plugin-domain'),



                'type' => Controls_Manager::MEDIA,



                'default' => [



                    'url' => Utils::get_placeholder_image_src(),



                ],



            ]



        );



        $this->add_control(



            'master_navigation_width',



            [



                'label' => __('Image Width', 'masterelements'),



                'type' => Controls_Manager::SLIDER,



                'size_units' => ['px', '%'],



                'range' => [



                    'px' => [



                        'min' => 0,



                        'max' => 1000,



                    ],



                    '%' => [



                        'min' => 0,



                        'max' => 100,



                    ],



                ],



                'default' => [



                    'unit' => 'px',



                    'size' => 50,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-logo-light, {{WRAPPER}} .master-nav-logo-dark' => 'width: {{SIZE}}{{UNIT}};',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_height',



            [



                'label' => __('Image Height', 'masterelements'),



                'type' => Controls_Manager::SLIDER,



                'size_units' => ['px', '%'],



                'range' => [



                    'px' => [



                        'min' => 0,



                        'max' => 1000,



                    ],



                    '%' => [



                        'min' => 0,



                        'max' => 100,



                    ],



                ],



                'default' => [



                    'unit' => 'px',



                    'size' => 50,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-logo-light, {{WRAPPER}} .master-nav-logo-dark' => 'height: {{SIZE}}{{UNIT}};',



                ],



            ]



        );







        $this->add_control(



            'show_search_icon',



            [



                'label' => __( 'Show Search Icon', 'additional-addons' ),



                'type' => \Elementor\Controls_Manager::SWITCHER,



                'label_on' => __( 'Show', 'additional-addons' ),



                'label_off' => __( 'Hide', 'additional-addons' ),



                'return_value' => 'yes',



                'default' => 'yes',



            ]



        );







        $this->add_control(



            'master_navigation_search_icon',



            [



                'label' => __('Upload Search Icon', 'plugin-domain'),



                'type' => Controls_Manager::MEDIA,



                'default' => [



                    'url' => \MasterElements::widgets_url() . '/navigation/assets/images/search.png',



                ],



                'condition' => [



                    'show_search_icon' => 'yes',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_width_search',



            [



                'label' => __('Search Icon Width', 'masterelements'),



                'type' => Controls_Manager::SLIDER,



                'size_units' => ['px', '%'],



                'range' => [



                    'px' => [



                        'min' => 0,



                        'max' => 1000,



                    ],



                    '%' => [



                        'min' => 0,



                        'max' => 100,



                    ],



                ],



                'default' => [



                    'unit' => 'px',



                    'size' => 18,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-search-icon' => 'width: {{SIZE}}{{UNIT}};',



                ],



                'condition' => [



                    'show_search_icon' => 'yes',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_height_search',



            [



                'label' => __('Search Icon Height', 'masterelements'),



                'type' => Controls_Manager::SLIDER,



                'size_units' => ['px', '%'],



                'range' => [



                    'px' => [



                        'min' => 0,



                        'max' => 1000,



                    ],



                    '%' => [



                        'min' => 0,



                        'max' => 100,



                    ],



                ],



                'default' => [



                    'unit' => 'px',



                    'size' => 19,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-search-icon' => 'height: {{SIZE}}{{UNIT}};',



                ],



                'condition' => [



                    'show_search_icon' => 'yes',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_theme_mode',



            [



                'label' => __('Theme Mode', 'masterelements'),



                'label_block' => true,



                'type' => Controls_Manager::SELECT,



                'multiple' => true,



                'default' => __('light', 'masterelements'),



                'options' => [



                    'light' => __('Light', 'masterelements'),



                    'dark' => __('Dark Mode', 'masterelements'),



                ],



            ]



        );



        $this->add_control(



            'master_navigation_header',



            [



                'label' => __('Header', 'masterelements'),



                'label_block' => true,



                'type' => Controls_Manager::SELECT,



                'multiple' => true,



                'default' => __('default', 'masterelements'),



                'options' => [



                    'default' => __('Default', 'masterelements'),



                    'overlay-light-bg' => __('Overlay Light BG', 'masterelements'),



                    'overlay-dark-bg' => __('Overlay Dark BG', 'masterelements'),



                    'transparent-light' => __('Transparent Light Text', 'masterelements'),



                    'transparent-dark' => __('Transparent Dark Text', 'masterelements'),



                ],



            ]



        );



        $this->add_control(



            'master_navigation_main_menu',



            [



                'label' => __('Main Menu', 'masterelements'),



                'label_block' => true,



                'type' => Controls_Manager::SELECT,



                'multiple' => true,



                'default' => __('default', 'masterelements'),



                'options' => [



                    'default' => __('Default', 'masterelements'),



                    'line-separator' => __('Line Separator', 'masterelements'),



                    'hover-primary' => __('Hover', 'masterelements'),



                    'underline' => __('Underline', 'masterelements'),



                ],



            ]



        );



        $this->add_control(



            'master_navigation_main_bg_menu_underline_color',



            [



                'label' => __('Underline Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'scheme' => [



                    'type' => Scheme_Color::get_type(),



                    'value' => Scheme_Color::COLOR_1,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-menu-underline ul > li > a:hover:after,{{WRAPPER}} .master-nav-menu-hover-gray ul > li > a:hover:before, {{WRAPPER}} .master-nav-menu-hover-primary ul > li > a:hover:before, {{WRAPPER}} .master-nav-menu-line-separator ul > li > a::before' => 'background-color: {{VALUE}}',



                ],



                'condition' => [



                    'master_navigation_main_menu' => 'underline'



                ],



            ]



        );



        $this->add_control(



            'master_navigation_main_bg_menu_line_seperator_color',



            [



                'label' => __('Line Seperator Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'scheme' => [



                    'type' => Scheme_Color::get_type(),



                    'value' => Scheme_Color::COLOR_1,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-menu-line-separator ul > li > a::before' => 'background-color: {{VALUE}}',



                ],



                'condition' => [



                    'master_navigation_main_menu' => 'line-separator'



                ],



            ]



        );



        $this->add_control(



            'master_navigation_main_menu_hover_text_color',



            [



                'label' => __('Hover Text Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'scheme' => [



                    'type' => Scheme_Color::get_type(),



                    'value' => Scheme_Color::COLOR_1,



                ],



                'selectors' => [



                    '{{WRAPPER}} a.me-menu-nav-link:hover' => 'color: {{VALUE}}',



                ],



                'condition' => [



                    'master_navigation_main_menu' => 'hover-primary'



                ],



            ]



        );



        $this->add_control(



            'master_navigation_main_bg_menu_hover_color',



            [



                'label' => __('Hover Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'scheme' => [



                    'type' => Scheme_Color::get_type(),



                    'value' => Scheme_Color::COLOR_1,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-menu-hover-primary ul > li > a:hover' => 'background-color: {{VALUE}}',



                ],



                'condition' => [



                    'master_navigation_main_menu' => 'hover-primary'



                ],



            ]



        );







        $this->end_controls_section();







        $this->start_controls_section(



            'section_style1',



            [



                'label' => __('Menu', 'masterelements'),



                'tab' => Controls_Manager::TAB_STYLE,



            ]



        );



        $this->add_responsive_control(



            'master_navigation_menu_margin',



            [



                'label' => __('Margin', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', '%', 'em'],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-menu-body > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



            ]



        );







        $this->add_responsive_control(



            'master_navigation_menu_padding',



            [



                'label' => __('Padding', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', '%', 'em'],



                'selectors' => [



                    '{{WRAPPER}} ul.master-nav-menu-body > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_bar_background_color',



            [



                'label' => __('Navigation Bar Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .master-nav-container.master-nav-flex.master-nav-align-middle.master-nav-align-justify' => 'background-color: {{VALUE}}',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_mobile_menu_background_color',



            [



                'label' => __('Drawer Menu Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .master-nav-menu.master-nav-mobile-only' => 'background-color: {{VALUE}}',



                ],



            ]



        );



        $this->add_group_control(



            Group_Control_Typography::get_type(),



            [



                'name' => 'master_navigation_menu_typography',



                'label' => __('Typography', 'masterelements'),



                'scheme' => Scheme_Typography::TYPOGRAPHY_1,



                'selector' => '{{WRAPPER}} a.me-menu-nav-link',



            ]



        );



        $this->add_control(



            'master_navigation_menu_color',



            [



                'label' => __('Color', 'masterelements'),



                'type' => \Elementor\Controls_Manager::COLOR,



                'scheme' => [



                    'type' => \Elementor\Core\Schemes\Color::get_type(),



                    'value' => \Elementor\Core\Schemes\Color::COLOR_3,



                ],



                'selectors' => [



                    '{{WRAPPER}} a.me-menu-nav-link' => 'color: {{VALUE}}',



                ],



            ]



        ); $this->add_control(



        'master_navigation_menu_hamburger_color',



        [



            'label' => __('Hamburger Color', 'masterelements'),



            'type' => \Elementor\Controls_Manager::COLOR,



            'scheme' => [



                'type' => \Elementor\Core\Schemes\Color::get_type(),



                'value' => \Elementor\Core\Schemes\Color::COLOR_3,



            ],



            'selectors' => [



                '{{WRAPPER}} path' => 'color: {{VALUE}}',



            ],



        ]



    );



        $this->add_control(



            'master_navigation_menu_hover_color',



            [



                'label' => __('Hover Color', 'masterelements'),



                'type' => \Elementor\Controls_Manager::COLOR,



                'scheme' => [



                    'type' => \Elementor\Core\Schemes\Color::get_type(),



                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,



                ],



                'selectors' => [



                    '{{WRAPPER}} a.me-menu-nav-link:hover' => 'color: {{VALUE}}',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_position_for_search',



            [



                'label' => __('Search Icon Position', 'masterelements'),



                'label_block' => true,



                'type' => Controls_Manager::SELECT,



                'multiple' => true,



                'default' => __('Select position', 'masterelements'),



                'options' => [



                    'relative' => __('Relative', 'masterelements'),



                    'absolute' => __('Absolute', 'masterelements'),



                    'fixed' => __('Fixed', 'masterelements'),



                ],



                'condition' => [



                    'master_navigation_header_alignment' => 'center-3'



                ],



            ]



        );







        $this->add_control(



            'master_navigation_position_for_search_top',



            [



                'label' => __('TOP', 'masterelements'),



                'type' => Controls_Manager::NUMBER,



                'min' => 0,



                'default' => 0,



                'selectors' => [



                    '{{WRAPPER}}  .master-nav-searc' => 'top: {{VALUE}}px;',



                ],



                'condition' => [



                    'master_navigation_header_alignment' => 'center-3'



                ],



            ]



        );











        $this->add_control(



            'master_navigation_position_for_search_right',



            [



                'label' => __('RIGHT', 'masterelements'),



                'type' => Controls_Manager::NUMBER,



                'min' => 0,



                'default' => 0,



                'selectors' => [



                    '{{WRAPPER}}  .master-nav-searc' => 'right: {{VALUE}}px;',



                ],



                'condition' => [



                    'master_navigation_header_alignment' => 'center-3'



                ],



            ]



        );











        $this->add_control(



            'master_navigation_position_for_search_left',



            [



                'label' => __('LEFT', 'masterelements'),



                'type' => Controls_Manager::NUMBER,



                'min' => 0,



                'default' => '',



                'selectors' => [



                    '{{WRAPPER}}  .master-nav-searc' => 'left: {{VALUE}}px;',



                ],



                'condition' => [



                    'master_navigation_header_alignment' => 'center-3'



                ],



            ]



        );











        $this->add_control(



            'master_navigation_position_for_search_bottom',



            [



                'label' => __('BOTTOM', 'masterelements'),



                'type' => Controls_Manager::NUMBER,



                'min' => 0,



                'default' => '',



                'selectors' => [



                    '{{WRAPPER}}  .master-nav-searc' => 'bottom: {{VALUE}}px;',



                ],



                'condition' => [



                    'master_navigation_header_alignment' => 'center-3'



                ],



            ]



        );



        $this->add_responsive_control(



            'master_navigation_outer_padding',



            [



                'label' => __('Outer Box Padding', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', '%', 'em'],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',



                ],



            ]



        );











        $this->end_controls_section();



        $this->start_controls_section(



            'section_style2',



            [



                'label' => __('Dropdown Menu', 'masterelements'),



                'tab' => Controls_Manager::TAB_STYLE,



            ]



        );







        $this->add_responsive_control(



            'master_navigation_dropdown_menu_margin',



            [



                'label' => __('Margin', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', '%', 'em'],



                'selectors' => [



                    '{{WRAPPER}} .master-submenu-panel > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                    '{{WRAPPER}} .sub-menu > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



            ]



        );







        $this->add_responsive_control(



            'master_navigation_dropdown_menu_padding',



            [



                'label' => __('Padding', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', '%', 'em'],



                'selectors' => [



                    '{{WRAPPER}} .master-submenu-panel > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                    '{{WRAPPER}} .sub-menu > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



            ]



        );



        $this->add_control(

            'master_navigation_sub_menu_text_color',

            [

                'label' => __('Dropdown Menu Text Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .master-submenu-panel > li > a' => 'color: {{VALUE}} !important',

                ],

            ]

        );



        $this->add_control(

            'master_navigation_sub_menu_text_hover_color',

            [

                'label' => __('Dropdown Menu Text Hover Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .master-submenu-panel > li > a:hover' => 'color: {{VALUE}} !important',

                ],

            ]

        );



        $this->add_group_control(



            Group_Control_Typography::get_type(),



            [



                'name' => 'master_navigation_sub_menu_typography',



                'label' => __('Dropdown Menu Typography', 'masterelements'),



                'scheme' => Scheme_Typography::TYPOGRAPHY_1,



                'selector' => '{{WRAPPER}} .master-submenu-panel > li > a'



            ]



        );









        $this->add_control(



            'master_navigation_drop_down_toggle_icon_color',



            [



                'label' => __('Dropdown Toggle Icon Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'scheme' => [



                    'type' => Scheme_Color::get_type(),



                    'value' => Scheme_Color::COLOR_1,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-nav-menu ul.master-nav-menu-body li.menu-item-has-children:after' => 'color: {{VALUE}}',



                ],



            ]



        );

        $this->add_responsive_control(

            'master_navigation_drop_down_toggle_icon_margin',

            [

                'label' => __('Dropdown Icon Margin', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', '%'],

                'selectors' => [

                    '{{WRAPPER}} .master-nav-menu ul.master-nav-menu-body li.menu-item-has-children:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',

                ],

            ]

        );



        $this->add_control(



            'master_navigation_drop_down_menu_color',



            [



                'label' => __('Dropdown Menu Bg Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'scheme' => [



                    'type' => Scheme_Color::get_type(),



                    'value' => Scheme_Color::COLOR_2,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-submenu-panel > li > a' => 'background-color: {{VALUE}}',



                    '{{WRAPPER}} .sub-menu > li > a' => 'background-color: {{VALUE}}',



                ],



            ]



        );







        $this->add_control(



            'master_navigation_drop_down_menu_hover_color',



            [



                'label' => __('Dropdown Menu Bg Hover Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'scheme' => [



                    'type' => Scheme_Color::get_type(),



                    'value' => Scheme_Color::COLOR_2,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-submenu-panel > li > a:hover' => 'background-color: {{VALUE}}',



                    '{{WRAPPER}} .sub-menu > li > a:hover' => 'background-color: {{VALUE}}',



                ],



            ]



        );







        $this->end_controls_section();



        $this->start_controls_section(



            'section_style3',



            [



                'label' => __('Sticky', 'masterelements'),



                'tab' => Controls_Manager::TAB_STYLE,



            ]



        );



        $this->add_control(



            'master_navigation_sticky_switcher',



            [



                'label' => __('Enable Sticky Effect', 'masterelements'),



                'type' => \Elementor\Controls_Manager::SWITCHER,



                'label_on' => __('On', 'masterelements'),



                'label_off' => __('Off', 'masterelements'),



                'frontend_available' => true,



                'return_value' => 'yes',



                'default' => 'empty',



            ]



        );



        $this->add_control(



            'master_navigation_sticky_offset_num',



            [



                'label' => __('Offset', 'masterelements'),



                'type' => Controls_Manager::NUMBER,



                'default' => 0,



                'min' => 0,



                'max' => 500,



                'frontend_available' => true,



                'condition' => [



                    'master_navigation_sticky_switcher' => 'yes'



                ],



            ]



        );



        $this->add_control(



            'master_navigation_sticky_header_bg_color',



            [



                'label' => __('Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'scheme' => [



                    'type' => Scheme_Color::get_type(),



                    'value' => Scheme_Color::COLOR_1,



                ],



                'selectors' => [



                    '{{WRAPPER}} .master-sticky-header:before' => 'background-color: {{VALUE}}',



                ],



                'condition' => [



                    'master_navigation_sticky_switcher' => 'yes'



                ],



            ]



        );



        $this->add_responsive_control(



            'master_navigation_sticky_header_margin',



            [



                'label' => __('Margin', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', 'em', '%'],



                'selectors' => [



                    '{{WRAPPER}} .master-sticky-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



            ]



        );



        $this->add_control(



            'master_navigation_entrance_animation',



            [



                'label' => __('Entrance Animation', 'masterelements'),



                'label_block' => true,



                'type' => Controls_Manager::SELECT,



                'multiple' => true,



                'default' => __('none', 'masterelements'),



                'options' => [



                    'none' => __('None', 'masterelements'),



                    'animated fadeIn' => __('Fade In', 'masterelements'),



                    'animated fadeInDown' => __('Fade In Down', 'masterelements'),



                    'animated fadeInLeft' => __('Fade In Left', 'masterelements'),



                    'animated fadeInRight' => __('Fade In Right', 'masterelements'),



                    'animated zoomIn' => __('Zoom In', 'masterelements'),



                    'animated zoomInDown' => __('Zoom In Down', 'masterelements'),



                    'animated zoomInLeft' => __('Zoom In Left', 'masterelements'),



                    'animated zoomInRight' => __('Zoom In Right', 'masterelements'),



                    'animated zoomInUp' => __('Zoom In Up', 'masterelements'),



                    'animated bounceIn' => __('Bounce In', 'masterelements'),



                    'animated bounceInDown' => __('Bounce In Down', 'masterelements'),



                    'animated bounceInLeft' => __('Bounce In Left', 'masterelements'),



                    'animated bounceInRight' => __('Bounce In Right', 'masterelements'),



                    'animated bounceInUp' => __('Bounce In Up', 'masterelements'),



                    'animated slideInDown' => __('Slide In Down', 'masterelements'),



                    'animated slideInLeft' => __('Slide In Left', 'masterelements'),



                    'animated slideInRight' => __('Slide In Right', 'masterelements'),



                    'animated slideInUp' => __('Slide In Up', 'masterelements'),



                    'animated rotateIn' => __('Rotate In', 'masterelements'),



                    'animated rotateInDownLeft' => __('Rotate In Down Left', 'masterelements'),



                    'animated rotateInDownRight' => __('Rotate In Down Right', 'masterelements'),



                    'animated rotateInUpLeft' => __('Rotate In Up Left', 'masterelements'),



                    'animated rotateInUpRight' => __('Rotate In Up Right', 'masterelements'),



                    'animated bounce' => __('Bounce', 'masterelements'),



                    'animated flash' => __('Flash', 'masterelements'),



                    'animated pulse' => __('Pulse', 'masterelements'),



                    'animated rubberBand' => __('Rubber Band', 'masterelements'),



                    'animated shake' => __('Shake', 'masterelements'),



                    'animated headShake' => __('Head Shake', 'masterelements'),



                    'animated swing' => __('Swing', 'masterelements'),



                    'animated tada' => __('Tada', 'masterelements'),



                    'animated wobble' => __('Wobble', 'masterelements'),



                    'animated jello' => __('Jello', 'masterelements'),



                    'animated lightSpeedIn' => __('Light Speed In', 'masterelements'),



                    'animated rollIn' => __('Roll In', 'masterelements'),



                ],



                'condition' => [



                    'master_navigation_sticky_switcher' => 'yes'



                ],



            ]



        );



        $this->add_control(



            'master_navigation_entrance_animation_duration',



            [



                'label' => __('Animation Duration', 'masterelements'),



                'label_block' => true,



                'type' => Controls_Manager::SELECT,



                'multiple' => true,



                'default' => __('normal', 'masterelements'),



                'options' => [



                    'animated-slow' => __('Slow', 'masterelements'),



                    'normal' => __('Normal', 'masterelements'),



                    'animated-fast' => __('Fast', 'masterelements'),



                ],



                'condition' => [



                    'master_navigation_sticky_switcher' => 'yes'



                ],



            ]



        );



        $this->add_control(



            'master_navigation_entrance_animation_delay',



            [



                'label' => __('Animation Delay (s)', 'masterelements'),



                'type' => Controls_Manager::NUMBER,



                'multiple' => true,



                'default' => '',



                'frontend_available' => true,



                'selectors' => [



                    '.master-sticky-header' => 'animation-delay:{{value}}s',



                ],



                'condition' => [



                    'master_navigation_sticky_switcher' => 'yes'



                ],



            ]



        );



        $this->end_controls_section();







    }



    ////////////////////////



    //front end rendering///



    ////////////////////////



    protected function render()



    {







        $settings = $this->get_settings_for_display();







        ////////////////////////////////



        // Header Alignment Option Value



        ////////////////////////////////







        switch ($settings['master_navigation_header_alignment']) {



            case 'left':



                $headerAlign = ' master-nav-header-aligned-left';



                break;







            case 'right':



                $headerAlign = ' master-nav-header-aligned-right';



                break;







            case 'center':



                $headerAlign = ' master-nav-header-aligned-center';



                break;







            case 'center-1':



                $headerAlign = ' master-nav-header-aligned-center-1';



                break;







            case 'center-2':



                $headerAlign = ' master-nav-header-aligned-center-2';



                break;







            case 'center-3':



                $headerAlign = ' master-nav-header-aligned-center-3';



                break;



        }







        ////////////////////////////////



        // Header Theme Mode Option Value



        ////////////////////////////////



        if ($settings['master_navigation_theme_mode'] == 'light') {



            $class = '';



        } else {



            $class = ' master-nav-header-' . $settings['master_navigation_theme_mode'];



        }







        ////////////////////////////////



        // Header mode Option Value



        ////////////////////////////////







        switch ($settings['master_navigation_header']) {



            case 'transparent-dark':



                $header = ' master-nav-header-transparent-dark';



                break;







            case 'overlay-light-bg':



                $header = ' master-nav-header-overlay-light-bg';



                break;







            case 'overlay-dark-bg':



                $header = ' master-nav-header-overlay-dark-bg';



                break;







            case 'transparent-light':



                $header = ' master-nav-header-transparent-light';



                break;







            default:



                $header = '';



                break;



        }







        ////////////////////////////////



        // Header Main Menu Option Value



        ////////////////////////////////







        switch ($settings['master_navigation_main_menu']) {



            case 'line-separator':



                $mainMenu = ' master-nav-menu-line-separator';



                break;







            case 'hover-gray':



                $mainMenu = ' master-nav-menu-hover-gray';



                break;







            case 'hover-primary':



                $mainMenu = ' master-nav-menu-hover-primary';



                break;







            case 'underline':



                $mainMenu = ' master-nav-menu-underline';



                break;







            default:



                $mainMenu = '';



                break;



        }







        $backround_class = ($settings['_background_color'] != '') ? 'background-color: ' . $settings['_background_color'] . ' !important' : '';







        ?>



        <?php



        if ($settings['master_navigation_header_alignment'] == 'left') {

            wp_register_style('prefix_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
            wp_enqueue_style('prefix_bootstrap');
            // wp_enqueue_style('bootstrap_min', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
            // 
            
            
                            // wp_enqueue_style('bootstrap_theme_min', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css', null, self::version, 'all');
            
            
            
                            // wp_enqueue_script('bootstrap_theme_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', null, self::version, 'all');
            
            ?>



            <!-- /////////////////////////////////////////////// -->



            <!-- ////Master navigation Header Left Align////////-->



            <!-- /////////////////////////////////////////////// -->







            <header class="stickys master-nav-header<?= $headerAlign ?><?= $class ?><?= $header ?>"



                    data-animate="<?= $settings['master_navigation_entrance_animation'] ?>"



                    data-duration="<?= $settings['master_navigation_entrance_animation_duration'] ?>"



                    data-scroll-offset="<?= $settings['master_navigation_sticky_offset_num'] ?>" role="banner">



                <div class="master-nav-container master-nav-flex master-nav-align-middle master-nav-align-justify"



                     style="<?= $backround_class ?>">



                    <!-- ///////////////////// -->



                    <!-- MOBILE MENU TOGGLE -->



                    <!-- ///////////////////// -->



                    <div class="master-nav-menu-toggler master-nav-mobile-only">



                        <label for="master-nav-NAV">



                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">



                                <path d="M3 18h12v-2H3v2zM3 6v2h18V6H3zm0 7h18v-2H3v2z"></path>



                                <path fill="none" d="M0 0h24v24H0V0z"></path>



                            </svg>



                        </label>



                    </div>



                    <!-- ////////////////////// -->



                    <!-- MOBILE MENU TOGGLE END -->



                    <!-- ////////////////////// -->











                    <!-- ////////////////////// -->



                    <!-- MOBILE/DESKTOP LOGO -->



                    <!-- ////////////////////// -->







                    <div class="master-nav-logo">



                        <h1>



                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                <img src="<?php echo $settings['master_navigation_image']['url'] ?>"



                                     alt="Master Logo Light" class="master-nav-logo-light d-none  d-lg-block">



                                <!-- <img src="<?php echo $settings['master_navigation_image']['url'] ?>"



                                     alt="Master Logo Dark" class="master-nav-logo-dark "> -->



                                <span>Master</span>



                            </a>







                        </h1>



                    </div>



                    <!-- ////////////////////// -->



                    <!-- MOBILE/DESKTOP LOGO END -->



                    <!-- ////////////////////// -->



                    <div class="master-nav-flex master-nav-align-middle lg:master-nav-flex-auto">



                        <input type="checkbox" id="master-nav-NAV" class="master-nav-menu-monitor master-nav-hidden">



                        <label for="master-nav-NAV" class="master-nav-menu-overlay"></label>



                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU2 -->



                        <!-- ////////////////////// -->







                        <div class="master-nav-menu<?= $mainMenu ?> master-nav-mobile-only">



                            <nav  style="<?= $backround_class ?>" role="navigation">



                                <ul class="master-nav-menu-title">



                                    <li>



                                        <!-- MOBILE MENU TOGGLE -->



                                        <div class="master-nav-menu-toggler">



                                            <label for="master-nav-NAV">



                                                <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                     alt="Master Logo Light" class="master-nav-close-icon-light">



                                                <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                     alt="Master Logo Dark" class="master-nav-close-icon-dark">



                                            </label>



                                        </div>



                                        <!-- MOBILE MENU TOGGLE END -->







                                        <!-- MOBILE LOGO -->



                                        <div class="master-nav-logo">



                                            <h1>



                                                <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                                    <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                                        <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                             alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                                        <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                             alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                                    <?php }



                                                    else{ ?>



                                                        <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                             alt="Master Logo Light" class="master-nav-logo-light">



                                                        <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                             alt="Master Logo Dark" class="master-nav-logo-dark">



                                                    <?php } ?>



                                                    <span>Master</span>



                                                </a>







                                            </h1>



                                        </div>



                                        <!-- MOBILE LOGO END -->







                                    </li>



                                </ul>



                                <?php







                                $item_style = "";



                                $args = [



                                    'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                    'container' => 'div',



                                    'menu_id' => 'main-menu',



                                    'menu' => $settings['master_navigation_menu'],



                                    'menu_class' => 'master-nav-menu-body master-nav-desktop-menu',



                                    'depth' => 4,



                                    'echo' => true,



                                    'fallback_cb' => 'wp_page_menu',



                                    'walker' => new \Master_Menu_Walker()



                                ];







                                wp_nav_menu($args);







                                $item_style = "";



                                $args = [



                                    'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                    'container' => 'div',



                                    'menu_id' => 'main-menu',



                                    'menu' => $settings['master_navigation_mobile_menu'],



                                    'menu_class' => 'master-nav-menu-body master-nav-mobile-menu',



                                    'depth' => 4,



                                    'echo' => true,



                                    'fallback_cb' => 'wp_page_menu',



                                    'walker' => new \Master_Menu_Walker()



                                ];







                                wp_nav_menu($args);



                                ?>







                            </nav>



                        </div>



                        <div class="master-nav-menu<?= $mainMenu ?> master-nav-desktop-only ">



                            <nav  style="<?= $backround_class ?>" role="navigation">



                                <ul class="master-nav-menu-title">



                                    <li>



                                        <!-- MOBILE MENU TOGGLE -->



                                        <div class="master-nav-menu-toggler">



                                            <label for="master-nav-NAV">



                                                <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                     alt="Master Logo Light" class="master-nav-close-icon-light">



                                                <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                     alt="Master Logo Dark" class="master-nav-close-icon-dark">



                                            </label>



                                        </div>



                                        <!-- MOBILE MENU TOGGLE END -->







                                        <!-- MOBILE LOGO -->



                                        <div class="master-nav-logo">



                                            <h1>



                                                <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                                    <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                                        <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                             alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                                        <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                             alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                                    <?php }



                                                    else{ ?>



                                                        <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                             alt="Master Logo Light" class="master-nav-logo-light">



                                                        <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                             alt="Master Logo Dark" class="master-nav-logo-dark">



                                                    <?php } ?>



                                                    <span>Master</span>



                                                </a>







                                            </h1>



                                        </div>



                                        <!-- MOBILE LOGO END -->







                                    </li>



                                </ul>



                                <?php







                                $item_style = "";



                                $args = [



                                    'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                    'container' => 'div',



                                    'menu_id' => 'main-menu',



                                    'menu' => $settings['master_navigation_menu'],



                                    'menu_class' => 'master-nav-menu-body master-nav-desktop-menu',



                                    'depth' => 4,



                                    'echo' => true,



                                    'fallback_cb' => 'wp_page_menu',



                                    'walker' => new \Master_Menu_Walker()



                                ];







                                wp_nav_menu($args);







                                $item_style = "";



                                $args = [



                                    'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                    'container' => 'div',



                                    'menu_id' => 'main-menu',



                                    'menu' => $settings['master_navigation_mobile_menu'],



                                    'menu_class' => 'master-nav-menu-body master-nav-mobile-menu',



                                    'depth' => 4,



                                    'echo' => true,



                                    'fallback_cb' => 'wp_page_menu',



                                    'walker' => new \Master_Menu_Walker()



                                ];







                                wp_nav_menu($args);



                                ?>







                            </nav>



                        </div>



                        <?php if($settings['show_search_icon']=='yes') :?>



                            <div class="master-nav-menu-right-section">



                            <!-- ////////////////////// -->



                            <!-- Master navigation MENU SEARCH -->



                            <!-- ////////////////////// -->



                            <form class="master-nav-menu-search">



                                <input class="master-nav-hidden" id="master-nav-SEARCH" type="checkbox">



                                <label class="master-nav-transparent-overlay" for="master-nav-SEARCH"></label>



                                <label class="master-nav-pointer master-nav-flex js-master-nav-menu-search-icon"



                                       for="master-nav-SEARCH">



                                    <img src="<?php echo $settings['master_navigation_search_icon']['url']; ?>"



                                         alt="Master Logo Light" class="master-nav-search-icon">



                                </label>



                                <div class="master-nav-menu-search-field">



                                    <div class="master-nav-container">



                                        <div class="master-nav-menu-search-field-inner">



                                            <label class="master-nav-flex master-nav-pointer" for="master-nav-SEARCH">



                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"



                                                     viewBox="0 0 24 24">



                                                    <path d="M0 0h24v24H0z" fill="none"></path>



                                                    <path d="M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z"></path>



                                                </svg>



                                            </label>



                                            <input class="js-master-nav-menu-search-field" type="search"



                                                   placeholder="Search" name="q" autocapitalize="off"



                                                   autocomplete="off">



                                        </div>



                                    </div>



                                </div>



                            </form>



                            <!-- ////////////////////// -->



                            <!-- Master navigation MENU SEARCH END -->



                            <!-- ////////////////////// -->



                            </div><?php endif; ?>



                    </div>



                </div>







                <div class="master-nav-header-shadow"></div>



            </header>







            <?php



        }



        ?>



        <!--//////////////////////////////////////////////////////  -->



        <!-- ///////////   Master navigation Right Align ///////-->



        <!-- /////////////////////////////////////////////////////// -->







        <?php if ($settings['master_navigation_header_alignment'] == 'right') { ?>



        <header class="stickys master-nav-header<?= $headerAlign ?><?= $class ?><?= $header ?>"



                data-animate="<?= $settings['master_navigation_entrance_animation'] ?>"



                data-scroll-offset="<?= $settings['master_navigation_sticky_offset_num'] ?>" role="banner">



            <div class="master-nav-container master-nav-flex master-nav-align-middle master-nav-align-justify"



                 style="<?= $backround_class ?>">



                <!-- ////////////////////// -->



                <!-- MOBILE MENU TOGGLE -->



                <!-- ////////////////////// -->



                <div class="master-nav-menu-toggler master-nav-mobile-only">



                    <label for="master-nav-NAV">



                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">



                            <path d="M3 18h12v-2H3v2zM3 6v2h18V6H3zm0 7h18v-2H3v2z"></path>



                            <path fill="none" d="M0 0h24v24H0V0z"></path>



                        </svg>



                    </label>



                </div>



                <!-- ////////////////////// -->



                <!-- MOBILE MENU TOGGLE END -->



                <!-- ////////////////////// -->







                <!-- ////////////////////// -->



                <!-- MOBILE/DESKTOP LOGO -->



                <!-- ////////////////////// -->



                <div class="master-nav-logo">



                    <h1>



                        <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                            <img src="<?php echo $settings['master_navigation_image']['url'] ?>" alt="Master Logo Light"



                                 class="master-nav-logo-light">



                            <!-- <img src="<?php echo $settings['master_navigation_image']['url'] ?>" alt="Master Logo Dark"



                                 class="master-nav-logo-dark"> -->



                            <span>Master</span>



                        </a>







                    </h1>



                </div>



                <!-- ////////////////////// -->



                <!-- MOBILE/DESKTOP LOGO END -->



                <!-- ////////////////////// -->







                <div class="master-nav-flex master-nav-align-middle">



                    <input type="checkbox" id="master-nav-NAV" class="master-nav-menu-monitor master-nav-hidden">



                    <label for="master-nav-NAV" class="master-nav-menu-overlay"></label>



                    <!-- ////////////////////// -->



                    <!-- Master navigation MENU3 -->



                    <!-- ////////////////////// -->



                    <div class="master-nav-menu<?= $mainMenu ?> master-nav-mobile-only">

                        <nav style="<?= $backround_class ?>" role="navigation">



                            <ul class="master-nav-menu-title">



                                <li>



                                    <!-- MOBILE MENU TOGGLE -->



                                    <div class="master-nav-menu-toggler">



                                        <label for="master-nav-NAV">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Light" class="master-nav-close-icon-light">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Dark" class="master-nav-close-icon-dark">



                                        </label>



                                    </div>



                                    <!-- MOBILE MENU TOGGLE END -->







                                    <!-- MOBILE LOGO -->



                                    <div class="master-nav-logo">



                                        <h1>



                                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                                <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                                <?php }



                                                else{ ?>



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light">



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark">



                                                <?php } ?>



                                                <span>Master</span>



                                            </a>







                                        </h1>



                                    </div>



                                    <!-- MOBILE LOGO END -->







                                </li>



                            </ul>



                            <?php







                            $item_style = "";



                            $args = [



                                'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                'container' => 'div',



                                'menu_id' => 'main-menu',



                                'menu' => $settings['master_navigation_menu'],



                                'menu_class' => 'master-nav-menu-body master-nav-desktop-menu',



                                'depth' => 4,



                                'echo' => true,



                                'fallback_cb' => 'wp_page_menu',



                                'walker' => new \Master_Menu_Walker()



                            ];







                            wp_nav_menu($args);







                            $item_style = "";



                            $args = [



                                'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                'container' => 'div',



                                'menu_id' => 'main-menu',



                                'menu' => $settings['master_navigation_mobile_menu'],



                                'menu_class' => 'master-nav-menu-body master-nav-mobile-menu',



                                'depth' => 4,



                                'echo' => true,



                                'fallback_cb' => 'wp_page_menu',



                                'walker' => new \Master_Menu_Walker()



                            ];







                            wp_nav_menu($args);



                            ?>







                        </nav>

                    </div>



                    <div class="master-nav-menu<?= $mainMenu ?> master-nav-desktop-only">

                        <nav style="<?= $backround_class ?>" role="navigation">



                            <ul class="master-nav-menu-title">



                                <li>



                                    <!-- MOBILE MENU TOGGLE -->



                                    <div class="master-nav-menu-toggler">



                                        <label for="master-nav-NAV">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Light" class="master-nav-close-icon-light">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Dark" class="master-nav-close-icon-dark">



                                        </label>



                                    </div>



                                    <!-- MOBILE MENU TOGGLE END -->







                                    <!-- MOBILE LOGO -->



                                    <div class="master-nav-logo">



                                        <h1>



                                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                                <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                                <?php }



                                                else{ ?>



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light">



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark">



                                                <?php } ?>



                                                <span>Master</span>



                                            </a>







                                        </h1>



                                    </div>



                                    <!-- MOBILE LOGO END -->







                                </li>



                            </ul>



                            <?php







                            $item_style = "";



                            $args = [



                                'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                'container' => 'div',



                                'menu_id' => 'main-menu',



                                'menu' => $settings['master_navigation_menu'],



                                'menu_class' => 'master-nav-menu-body master-nav-desktop-menu',



                                'depth' => 4,



                                'echo' => true,



                                'fallback_cb' => 'wp_page_menu',



                                'walker' => new \Master_Menu_Walker()



                            ];







                            wp_nav_menu($args);







                            $item_style = "";



                            $args = [



                                'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                'container' => 'div',



                                'menu_id' => 'main-menu',



                                'menu' => $settings['master_navigation_mobile_menu'],



                                'menu_class' => 'master-nav-menu-body master-nav-mobile-menu',



                                'depth' => 4,



                                'echo' => true,



                                'fallback_cb' => 'wp_page_menu',



                                'walker' => new \Master_Menu_Walker()



                            ];







                            wp_nav_menu($args);



                            ?>







                        </nav>

                    </div>



                    <?php if($settings['show_search_icon']=='yes') :?>



                        <div class="master-nav-menu-right-section">



                            <!-- ////////////////////// -->



                            <!-- Master navigation MENU SEARCH -->



                            <!-- ////////////////////// -->



                            <form class="master-nav-menu-search">



                                <input class="master-nav-hidden" id="master-nav-SEARCH" type="checkbox">



                                <label class="master-nav-transparent-overlay" for="master-nav-SEARCH"></label>



                                <label class="master-nav-pointer master-nav-flex js-master-nav-menu-search-icon"



                                       for="master-nav-SEARCH">



                                    <svg class="master-nav-search-icon" xmlns="http://www.w3.org/2000/svg" width="24"



                                         height="24" viewBox="0 0 24 24">



                                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>



                                        <path d="M0 0h24v24H0z" fill="none"></path>



                                    </svg>



                                </label>



                                <div class="master-nav-menu-search-field">



                                    <div class="master-nav-container">



                                        <div class="master-nav-menu-search-field-inner">



                                            <label class="master-nav-flex master-nav-pointer" for="master-nav-SEARCH">



                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"



                                                     viewBox="0 0 24 24">



                                                    <path d="M0 0h24v24H0z" fill="none"></path>



                                                    <path d="M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z"></path>



                                                </svg>



                                            </label>



                                            <input class="js-master-nav-menu-search-field" type="search"



                                                   placeholder="Search" name="q" autocapitalize="off" autocomplete="off">



                                        </div>



                                    </div>



                                </div>



                            </form>



                            <!-- ////////////////////// -->



                            <!-- Master navigation MENU SEARCH END -->



                            <!-- ////////////////////// -->



                        </div>



                    <?php endif; ?>



                </div>



            </div>







            <div class="master-nav-header-shadow"></div>



        </header>



        <div class="master-nav-header-spacer"></div>







    <?php } ?>







        <!-- //////////////////////////////////////////////////-->



        <!-- /////////// Master navigation center ///////////// -->



        <!-- ///////////////////////////////////////////////// -->







        <?php if ($settings['master_navigation_header_alignment'] == 'center') { ?>



        <header class="stickys master-nav-header<?= $headerAlign ?><?= $class ?><?= $header ?>"



                data-animate="<?= $settings['master_navigation_entrance_animation'] ?>"



                data-scroll-offset="<?= $settings['master_navigation_sticky_offset_num'] ?>" role="banner">



            <div class="master-nav-container master-nav-flex master-nav-align-middle master-nav-align-justify"



                 style="<?= $backround_class ?>">



                <!-- ////////////////////// -->



                <!-- MOBILE MENU TOGGLE -->



                <!-- ////////////////////// -->



                <div class="master-nav-menu-toggler master-nav-mobile-only">



                    <label for="master-nav-NAV">



                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">



                            <path d="M3 18h12v-2H3v2zM3 6v2h18V6H3zm0 7h18v-2H3v2z"></path>



                            <path fill="none" d="M0 0h24v24H0V0z"></path>



                        </svg>



                    </label>



                </div>



                <!-- ////////////////////// -->



                <!-- MOBILE MENU TOGGLE END -->



                <!-- ////////////////////// -->







                <!-- ////////////////////// -->



                <!-- MOBILE/DESKTOP LOGO -->



                <!-- ////////////////////// -->



                <div class="master-nav-logo">



                    <h1>



                        <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                            <img src="<?php echo $settings['master_navigation_image']['url'] ?>" alt="Master Logo Light"



                                 class="master-nav-logo-light">



                            <img src="<?php echo $settings['master_navigation_image']['url'] ?>" alt="Master Logo Dark"



                                 class="master-nav-logo-dark">



                            <span>Master</span>



                        </a>







                    </h1>



                </div>



                <!-- ////////////////////// -->



                <!-- MOBILE/DESKTOP LOGO END -->



                <!-- ////////////////////// -->







                <div class="master-nav-flex master-nav-align-middle master-nav-absolute lg:master-nav-static">



                    <input type="checkbox" id="master-nav-NAV" class="master-nav-menu-monitor master-nav-hidden">



                    <label for="master-nav-NAV" class="master-nav-menu-overlay"></label>



                    <!-- ////////////////////// -->



                    <!-- Master navigation MENU4 -->



                    <!-- ////////////////////// -->



                    <div class="master-nav-menu<?= $mainMenu ?> master-nav-mobile-only">

                        <nav style="<?= $backround_class ?>" role="navigation">



                            <ul class="master-nav-menu-title">



                                <li>



                                    <!-- MOBILE MENU TOGGLE -->



                                    <div class="master-nav-menu-toggler">



                                        <label for="master-nav-NAV">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Light" class="master-nav-close-icon-light">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Dark" class="master-nav-close-icon-dark">



                                        </label>



                                    </div>



                                    <!-- MOBILE MENU TOGGLE END -->







                                    <!-- MOBILE LOGO -->



                                    <div class="master-nav-logo">



                                        <h1>



                                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                                <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                                <?php }



                                                else{ ?>



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light">



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark">



                                                <?php } ?>



                                                <span>Master</span>



                                            </a>







                                        </h1>



                                    </div>



                                    <!-- MOBILE LOGO END -->







                                </li>



                            </ul>



                            <?php







                            $item_style = "";



                            $args = [



                                'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                'container' => 'div',



                                'menu_id' => 'main-menu',



                                'menu' => $settings['master_navigation_menu'],



                                'menu_class' => 'master-nav-menu-body master-nav-desktop-menu',



                                'depth' => 4,



                                'echo' => true,



                                'fallback_cb' => 'wp_page_menu',



                                'walker' => new \Master_Menu_Walker()



                            ];







                            wp_nav_menu($args);







                            $item_style = "";



                            $args = [



                                'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                'container' => 'div',



                                'menu_id' => 'main-menu',



                                'menu' => $settings['master_navigation_mobile_menu'],



                                'menu_class' => 'master-nav-menu-body master-nav-mobile-menu',



                                'depth' => 4,



                                'echo' => true,



                                'fallback_cb' => 'wp_page_menu',



                                'walker' => new \Master_Menu_Walker()



                            ];







                            wp_nav_menu($args);







                            ?>







                        </nav>

                    </div>

                    <div class="master-nav-menu<?= $mainMenu ?> master-nav-desktop-only">

                        <nav style="<?= $backround_class ?>" role="navigation">



                            <ul class="master-nav-menu-title">



                                <li>



                                    <!-- MOBILE MENU TOGGLE -->



                                    <div class="master-nav-menu-toggler">



                                        <label for="master-nav-NAV">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Light" class="master-nav-close-icon-light">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Dark" class="master-nav-close-icon-dark">



                                        </label>



                                    </div>



                                    <!-- MOBILE MENU TOGGLE END -->







                                    <!-- MOBILE LOGO -->



                                    <div class="master-nav-logo">



                                        <h1>



                                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                                <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                                <?php }



                                                else{ ?>



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light">



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark">



                                                <?php } ?>



                                                <span>Master</span>



                                            </a>







                                        </h1>



                                    </div>



                                    <!-- MOBILE LOGO END -->







                                </li>



                            </ul>



                            <?php







                            $item_style = "";



                            $args = [



                                'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                'container' => 'div',



                                'menu_id' => 'main-menu',



                                'menu' => $settings['master_navigation_menu'],



                                'menu_class' => 'master-nav-menu-body master-nav-desktop-menu',



                                'depth' => 4,



                                'echo' => true,



                                'fallback_cb' => 'wp_page_menu',



                                'walker' => new \Master_Menu_Walker()



                            ];







                            wp_nav_menu($args);







                            $item_style = "";



                            $args = [



                                'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                'container' => 'div',



                                'menu_id' => 'main-menu',



                                'menu' => $settings['master_navigation_mobile_menu'],



                                'menu_class' => 'master-nav-menu-body master-nav-mobile-menu',



                                'depth' => 4,



                                'echo' => true,



                                'fallback_cb' => 'wp_page_menu',



                                'walker' => new \Master_Menu_Walker()



                            ];







                            wp_nav_menu($args);







                            ?>







                        </nav>

                    </div>





                </div>



                <?php if($settings['show_search_icon']=='yes') :?>



                    <div class="master-nav-menu-right-section">



                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU SEARCH -->



                        <!-- ////////////////////// -->



                        <form class="master-nav-menu-search">



                            <input class="master-nav-hidden" id="master-nav-SEARCH" type="checkbox">



                            <label class="master-nav-transparent-overlay" for="master-nav-SEARCH"></label>



                            <label class="master-nav-pointer master-nav-flex js-master-nav-menu-search-icon"



                                   for="master-nav-SEARCH">



                                <svg class="master-nav-search-icon" xmlns="http://www.w3.org/2000/svg" width="24"



                                     height="24" viewBox="0 0 24 24">



                                    <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>



                                    <path d="M0 0h24v24H0z" fill="none"></path>



                                </svg>



                            </label>



                            <div class="master-nav-menu-search-field">



                                <div class="master-nav-container">



                                    <div class="master-nav-menu-search-field-inner">



                                        <label class="master-nav-flex master-nav-pointer" for="master-nav-SEARCH">



                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"



                                                 viewBox="0 0 24 24">



                                                <path d="M0 0h24v24H0z" fill="none"></path>



                                                <path d="M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z"></path>



                                            </svg>



                                        </label>



                                        <input class="js-master-nav-menu-search-field" type="search" placeholder="Search"



                                               name="q" autocapitalize="off" autocomplete="off">



                                    </div>



                                </div>



                            </div>



                        </form>



                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU SEARCH END -->



                        <!-- ////////////////////// -->



                    </div>



                <?php endif; ?>



            </div>







            <div class="master-nav-header-shadow"></div>



        </header>



    <?php } ?>



        <!-- ////////////////////////////////// -->



        <!-- ////////// Center Style 1 ////////-->



        <!-- ///////////////////////////////// -->



        <?php



        if ($settings['master_navigation_header_alignment'] == 'center-1') {



            ?>



            <header class="stickys master-nav-header<?= $headerAlign ?><?= $class ?><?= $header ?>"



                    data-animate="<?= $settings['master_navigation_entrance_animation'] ?>"



                    data-scroll-offset="<?= $settings['master_navigation_sticky_offset_num'] ?>" role="banner">



                <div class="master-nav-container master-nav-flex master-nav-align-middle master-nav-align-justify lg:master-nav-align-center"



                     style="<?= $backround_class ?>">



                    <!-- ////////////////////// -->



                    <!-- MOBILE MENU TOGGLE -->



                    <!-- ////////////////////// -->



                    <div class="master-nav-menu-toggler master-nav-mobile-only">



                        <label for="master-nav-NAV">



                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">



                                <path d="M3 18h12v-2H3v2zM3 6v2h18V6H3zm0 7h18v-2H3v2z"></path>



                                <path fill="none" d="M0 0h24v24H0V0z"></path>



                            </svg>



                        </label>



                    </div>



                    <!-- ////////////////////// -->



                    <!-- MOBILE MENU TOGGLE END -->



                    <!-- ////////////////////// -->







                    <!-- ////////////////////// -->



                    <!-- MOBILE LOGO -->



                    <!-- ////////////////////// -->



                    <div class="master-nav-logo master-nav-mobile-only">



                        <h1>



                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                         alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                         alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                <?php }



                                else{ ?>



                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                         alt="Master Logo Light" class="master-nav-logo-light">



                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                         alt="Master Logo Dark" class="master-nav-logo-dark">



                                <?php } ?>



                                <span>Master</span>



                            </a>







                        </h1>



                    </div>



                    <!-- ////////////////////// -->



                    <!-- MOBILE LOGO END -->



                    <!-- ////////////////////// -->







                    <div class="master-nav-flex master-nav-align-middle">



                        <input type="checkbox" id="master-nav-NAV" class="master-nav-menu-monitor master-nav-hidden">



                        <label for="master-nav-NAV" class="master-nav-menu-overlay"></label>



                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU -->



                        <!-- ////////////////////// -->



                        <ul class="master-nav-menu-title">



                            <li>



                                <!-- ////////////////////// -->



                                <!-- MOBILE MENU TOGGLE -->



                                <!-- ////////////////////// -->



                                <div class="master-nav-menu-toggler style-nav">



                                    <label for="master-nav-NAV">



                                        <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                             alt="Master Logo Light" class="master-nav-close-icon-light">



                                        <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                             alt="Master Logo Dark" class="master-nav-close-icon-dark">



                                    </label>



                                </div>



                                <!-- ////////////////////// -->



                                <!-- MOBILE MENU TOGGLE END -->



                                <!-- ////////////////////// -->







                            </li>



                        </ul>



                        <nav class="master-nav-menu<?= $mainMenu ?>" style="<?= $backround_class ?>" role="navigation">



                            <ul class="master-nav-menu-title">



                                <li>



                                    <!-- MOBILE MENU TOGGLE -->



                                    <div class="master-nav-menu-toggler">



                                        <label for="master-nav-NAV">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Light" class="master-nav-close-icon-light">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Dark" class="master-nav-close-icon-dark">



                                        </label>



                                    </div>



                                    <!-- MOBILE MENU TOGGLE END -->







                                    <!-- MOBILE LOGO -->



                                    <div class="master-nav-logo">



                                        <h1>



                                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                                <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                                <?php }



                                                else{ ?>



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light">



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark">



                                                <?php } ?>



                                                <span>Master</span>



                                            </a>







                                        </h1>



                                    </div>



                                    <!-- MOBILE LOGO END -->







                                </li>



                            </ul>



                            <ul class="master-nav-menu-body master-nav-menu-body-center">



                                <?php



                                $item_style = "";



                                $args = [



                                    'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                    'container' => 'div',



                                    'menu_id' => 'main-menu',



                                    'menu' => $settings['master_navigation_menu_left'],



                                    'menu_class' => 'master-nav-menu-body',



                                    'depth' => 4,



                                    'echo' => true,



                                    'fallback_cb' => 'wp_page_menu',



                                    'walker' => new \Master_Menu_Walker()



                                ];







                                wp_nav_menu($args);



                                ?>







                                <!-- ////////////////////// -->



                                <!-- DESKTOP LOGO -->



                                <!-- ////////////////////// -->



                                <li class="master-nav-desktop-only">



                                    <ul>



                                        <li class="master-nav-menu-item">



                                            <div class="master-nav-logo">



                                                <h1>



                                                    <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                                        <img src="<?php echo $settings['master_navigation_image']['url'] ?>"



                                                             alt="Master Logo Light" class="master-nav-logo-light">



                                                        <img src="<?php echo $settings['master_navigation_image']['url'] ?>"



                                                             alt="Master Logo Dark" class="master-nav-logo-dark">



                                                        <span>Master</span>



                                                    </a>







                                                </h1>



                                            </div>



                                        </li>



                                    </ul>



                                </li>



                                <!-- ////////////////////// -->



                                <!-- DESKTOP LOGO END -->



                                <!-- ////////////////////// -->







                                <?php



                                $item_style = "";



                                $args = [



                                    'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                    'container' => 'div',



                                    'menu_id' => 'main-menu',



                                    'menu' => $settings['master_navigation_menu_right'],



                                    'menu_class' => 'master-nav-menu-body',



                                    'depth' => 4,



                                    'echo' => true,



                                    'fallback_cb' => 'wp_page_menu',



                                    'walker' => new \Master_Menu_Walker()



                                ];







                                wp_nav_menu($args);



                                ?>







                                <li class="master-nav-menu-item master-nav-align-middle master-nav-desktop-only">



                                    <label class="master-nav-pointer master-nav-flex js-master-nav-menu-search-icon"



                                           for="master-nav-SEARCH">



                                        <svg class="master-nav-search-icon" xmlns="http://www.w3.org/2000/svg"



                                             width="24" height="24" viewBox="0 0 24 24">



                                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>



                                            <path d="M0 0h24v24H0z" fill="none"></path>



                                        </svg>



                                    </label>



                                </li>



                            </ul>



                            </li>



                            </ul>







                        </nav>







                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU SEARCH -->



                        <!-- ////////////////////// -->



                        <?php if($settings['show_search_icon']=='yes') :?>



                            <form class="master-nav-menu-search master-nav-flex master-nav-align-middle">



                                <input class="master-nav-hidden" id="master-nav-SEARCH" type="checkbox">



                                <label class="master-nav-transparent-overlay" for="master-nav-SEARCH"></label>



                                <label class="master-nav-pointer master-nav-flex js-master-nav-menu-search-icon master-nav-mobile-only"



                                       for="master-nav-SEARCH">



                                    <svg class="master-nav-search-icon" xmlns="http://www.w3.org/2000/svg" width="24"



                                         height="24" viewBox="0 0 24 24">



                                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>



                                        <path d="M0 0h24v24H0z" fill="none"></path>



                                    </svg>



                                </label>



                                <div class="master-nav-menu-search-field">



                                    <div class="master-nav-container">



                                        <div class="master-nav-menu-search-field-inner">



                                            <label class="master-nav-flex master-nav-pointer" for="master-nav-SEARCH">



                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"



                                                     viewBox="0 0 24 24">



                                                    <path d="M0 0h24v24H0z" fill="none"></path>



                                                    <path d="M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z"></path>



                                                </svg>



                                            </label>



                                            <input class="js-master-nav-menu-search-field" type="search"



                                                   placeholder="Search" name="q" autocapitalize="off" autocomplete="off">



                                        </div>



                                    </div>



                                </div>



                            </form>



                        <?php endif; ?>



                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU SEARCH END -->



                        <!-- ////////////////////// -->



                    </div>



                </div>







                <div class="master-nav-header-shadow"></div>



            </header>



            <div class="master-nav-header-spacer"></div>



            <!-- ////////////////////// -->



            <!-- Master navigation HEADER END -->



            <!-- ////////////////////// -->



            <?php



        }



        ?>



        <!-- //////////////////////////////////////////////// -->



        <!-- ///// Master navigation Center Style 2 //////// -->



        <!-- /////////////////////////////////////////////// -->







        <?php



        if ($settings['master_navigation_header_alignment'] == 'center-2') {



            ?>



            <header class="stickys master-nav-header<?= $headerAlign ?><?= $class ?><?= $header ?>"



                    data-animate="<?= $settings['master_navigation_entrance_animation'] ?>"



                    data-scroll-offset="<?= $settings['master_navigation_sticky_offset_num'] ?>" role="banner">



                <div class="master-nav-container master-nav-flex master-nav-align-middle master-nav-align-justify lg:master-nav-align-center"



                     style="<?= $backround_class ?>">



                    <!-- ////////////////////// -->



                    <!-- MOBILE MENU TOGGLE -->



                    <!-- ////////////////////// -->



                    <div class="master-nav-menu-toggler master-nav-mobile-only">



                        <label for="master-nav-NAV">



                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">



                                <path d="M3 18h12v-2H3v2zM3 6v2h18V6H3zm0 7h18v-2H3v2z"></path>



                                <path fill="none" d="M0 0h24v24H0V0z"></path>



                            </svg>



                        </label>



                    </div>



                    <!-- ////////////////////// -->



                    <!-- MOBILE MENU TOGGLE END -->



                    <!-- ////////////////////// -->







                    <!-- ////////////////////// -->



                    <!-- MOBILE LOGO -->



                    <!-- ////////////////////// -->



                    <div class="master-nav-logo master-nav-mobile-only">



                        <h1>



                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                         alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                         alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                <?php }



                                else{ ?>



                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                         alt="Master Logo Light" class="master-nav-logo-light">



                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                         alt="Master Logo Dark" class="master-nav-logo-dark">



                                <?php } ?>



                                <span>Master</span>



                            </a>







                        </h1>



                    </div>



                    <!-- ////////////////////// -->



                    <!-- MOBILE LOGO END -->



                    <!-- ////////////////////// -->







                    <div class="master-nav-flex master-nav-align-middle lg:master-nav-flex-auto">



                        <input type="checkbox" id="master-nav-NAV" class="master-nav-menu-monitor master-nav-hidden">



                        <label for="master-nav-NAV" class="master-nav-menu-overlay"></label>



                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU -->



                        <!-- ////////////////////// -->



                        <ul class="master-nav-menu-title">



                            <li>



                                <!-- ////////////////////// -->



                                <!-- MOBILE MENU TOGGLE -->



                                <!-- ////////////////////// -->



                                <div class="master-nav-menu-toggler style-nav">



                                    <label for="master-nav-NAV">



                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"



                                             viewBox="0 0 24 24">



                                            <path d="M3 18h12v-2H3v2zM3 6v2h18V6H3zm0 7h18v-2H3v2z"></path>



                                            <path fill="none" d="M0 0h24v24H0V0z"></path>



                                        </svg>



                                    </label>



                                </div>



                                <!-- ////////////////////// -->



                                <!-- MOBILE MENU TOGGLE END -->



                                <!-- ////////////////////// -->











                            </li>



                        </ul>



                        <nav class="master-nav-menu<?= $mainMenu ?>" style="<?= $backround_class ?>" role="navigation">



                            <ul class="master-nav-menu-title">



                                <li>



                                    <!-- MOBILE MENU TOGGLE -->



                                    <div class="master-nav-menu-toggler">



                                        <label for="master-nav-NAV">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Light" class="master-nav-close-icon-light">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Dark" class="master-nav-close-icon-dark">



                                        </label>



                                    </div>



                                    <!-- MOBILE MENU TOGGLE END -->







                                    <!-- MOBILE LOGO -->



                                    <div class="master-nav-logo">



                                        <h1>



                                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                                <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                                <?php }



                                                else{ ?>



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light">



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark">



                                                <?php } ?>



                                                <span>Master</span>



                                            </a>







                                        </h1>



                                    </div>



                                    <!-- MOBILE LOGO END -->







                                </li>



                            </ul>



                            <ul class="master-nav-menu-body master-nav-menu-body-center lg:master-nav-align-justify">



                                <?php



                                $item_style = "";



                                $args = [



                                    'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                    'container' => 'div',



                                    'menu_id' => 'main-menu',



                                    'menu' => $settings['master_navigation_menu_left'],



                                    'menu_class' => 'master-nav-menu-body',



                                    'depth' => 4,



                                    'echo' => true,



                                    'fallback_cb' => 'wp_page_menu',



                                    'walker' => new \Master_Menu_Walker()



                                ];







                                wp_nav_menu($args);



                                ?>







                                <!-- ////////////////////// -->



                                <!-- DESKTOP LOGO -->



                                <!-- ////////////////////// -->



                                <li class="master-nav-desktop-only">



                                    <ul>



                                        <li class="master-nav-menu-item">



                                            <div class="master-nav-logo">



                                                <h1>



                                                    <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                                        <img src="<?php echo $settings['master_navigation_image']['url'] ?>"



                                                             alt="Master Logo Light" class="master-nav-logo-light">



                                                        <img src="<?php echo $settings['master_navigation_image']['url'] ?>"



                                                             alt="Master Logo Dark" class="master-nav-logo-dark">



                                                        <span>Master</span>



                                                    </a>







                                                </h1>



                                            </div>



                                        </li>



                                    </ul>



                                </li>



                                <!-- ////////////////////// -->



                                <!-- DESKTOP LOGO END -->



                                <!-- ////////////////////// -->



                                <?php



                                $item_style = "";



                                $args = [



                                    'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                    'container' => 'div',



                                    'menu_id' => 'main-menu',



                                    'menu' => $settings['master_navigation_menu_right'],



                                    'menu_class' => 'master-nav-menu-body',



                                    'depth' => 4,



                                    'echo' => true,



                                    'fallback_cb' => 'wp_page_menu',



                                    'walker' => new \Master_Menu_Walker()



                                ];







                                wp_nav_menu($args);



                                ?>







                                <li class="master-nav-menu-item master-nav-align-middle master-nav-desktop-only">



                                    <label class="master-nav-pointer master-nav-flex js-master-nav-menu-search-icon"



                                           for="master-nav-SEARCH">



                                        <svg class="master-nav-search-icon" xmlns="http://www.w3.org/2000/svg"



                                             width="24" height="24" viewBox="0 0 24 24">



                                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>



                                            <path d="M0 0h24v24H0z" fill="none"></path>



                                        </svg>



                                    </label>



                                </li>



                            </ul>



                            </li>



                            </ul>



                        </nav>







                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU SEARCH -->



                        <!-- ////////////////////// -->



                        <?php if($settings['show_search_icon']=='yes') :?>



                            <form class="master-nav-menu-search master-nav-flex master-nav-align-middle">



                                <input class="master-nav-hidden" id="master-nav-SEARCH" type="checkbox">



                                <label class="master-nav-transparent-overlay" for="master-nav-SEARCH"></label>



                                <label class="master-nav-pointer master-nav-flex js-master-nav-menu-search-icon master-nav-mobile-only"



                                       for="master-nav-SEARCH">



                                    <svg class="master-nav-search-icon" xmlns="http://www.w3.org/2000/svg" width="24"



                                         height="24" viewBox="0 0 24 24">



                                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>



                                        <path d="M0 0h24v24H0z" fill="none"></path>



                                    </svg>



                                </label>



                                <div class="master-nav-menu-search-field">



                                    <div class="master-nav-container">



                                        <div class="master-nav-menu-search-field-inner">



                                            <label class="master-nav-flex master-nav-pointer" for="master-nav-SEARCH">



                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"



                                                     viewBox="0 0 24 24">



                                                    <path d="M0 0h24v24H0z" fill="none"></path>



                                                    <path d="M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z"></path>



                                                </svg>



                                            </label>



                                            <input class="js-master-nav-menu-search-field" type="search"



                                                   placeholder="Search" name="q" autocapitalize="off" autocomplete="off">



                                        </div>



                                    </div>



                                </div>



                            </form>



                        <?php endif; ?>



                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU SEARCH END -->



                        <!-- ////////////////////// -->



                    </div>



                </div>







                <div class="master-nav-header-shadow"></div>



            </header>



            <div class="master-nav-header-spacer"></div>



            <!-- ////////////////////// -->



            <!-- Master navigation HEADER END -->



            <!-- ////////////////////// -->



        <?php } ?>







        <!-- ////////////////////////////////////////////////// -->



        <!-- ////////// Master navigation Style 3 ///////////// -->



        <!-- ////////////////////////////////////////////////// -->







        <?php



        if ($settings['master_navigation_header_alignment'] == 'center-3') {



            ?>



            <header class="stickys master-nav-header<?= $headerAlign ?><?= $class ?><?= $header ?>"



                    data-animate="<?= $settings['master_navigation_entrance_animation'] ?>"



                    data-scroll-offset="<?= $settings['master_navigation_sticky_offset_num'] ?>" role="banner">



                <div class="master-nav-container master-nav-flex master-nav-align-middle">



                    <!-- ////////////////////// -->



                    <!-- DESKTOP LOGO -->



                    <!-- ////////////////////// -->



                    <div class="master-nav-logo master-nav-logo-top master-nav-desktop-only">



                        <h1>



                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                <img src="<?php echo $settings['master_navigation_image']['url'] ?>"



                                     alt="Master Logo Light" class="master-nav-logo-light">



                                <img src="<?php echo $settings['master_navigation_image']['url'] ?>"



                                     alt="Master Logo Dark" class="master-nav-logo-dark">



                                <span>Master</span>



                            </a>







                        </h1>



                    </div>



                    <!-- ////////////////////// -->



                    <!-- DESKTOP LOGO END -->



                    <!-- ////////////////////// -->







                </div>



                <div class="master-nav-container master-nav-flex master-nav-align-middle master-nav-align-justify lg:master-nav-align-center"



                     style="<?= $backround_class ?>">



                    <!-- ////////////////////// -->



                    <!-- MOBILE MENU TOGGLE -->



                    <!-- ////////////////////// -->



                    <div class="master-nav-menu-toggler master-nav-mobile-only">



                        <label for="master-nav-NAV">



                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">



                                <path d="M3 18h12v-2H3v2zM3 6v2h18V6H3zm0 7h18v-2H3v2z"></path>



                                <path fill="none" d="M0 0h24v24H0V0z"></path>



                            </svg>



                        </label>



                    </div>



                    <!-- ////////////////////// -->



                    <!-- MOBILE MENU TOGGLE END -->



                    <!-- ////////////////////// -->







                    <!-- ////////////////////// -->



                    <!-- MOBILE LOGO -->



                    <!-- ////////////////////// -->



                    <div class="master-nav-logo master-nav-mobile-only">



                        <h1>



                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                         alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                         alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                <?php }



                                else{ ?>



                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                         alt="Master Logo Light" class="master-nav-logo-light">



                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                         alt="Master Logo Dark" class="master-nav-logo-dark">



                                <?php } ?>



                                <span>Master</span>



                            </a>







                        </h1>



                        <!-- ////////////////////// -->



                    </div>



                    <!-- MOBILE LOGO END -->



                    <!-- ////////////////////// -->







                    <div class="master-nav-flex master-nav-align-middle">



                        <input type="checkbox" id="master-nav-NAV" class="master-nav-menu-monitor master-nav-hidden">



                        <label for="master-nav-NAV" class="master-nav-menu-overlay"></label>



                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU1 -->



                        <!-- ////////////////////// -->



                        <nav class="master-nav-menu<?= $mainMenu ?>" style="<?= $backround_class ?>" role="navigation">



                            <ul class="master-nav-menu-title">



                                <li>



                                    <!-- MOBILE MENU TOGGLE -->



                                    <div class="master-nav-menu-toggler">



                                        <label for="master-nav-NAV">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Light" class="master-nav-close-icon-light">



                                            <img src="<?php echo $settings['master_navigation_close_icon_mobile']['url'] ?>"



                                                 alt="Master Logo Dark" class="master-nav-close-icon-dark">



                                        </label>



                                    </div>



                                    <!-- MOBILE MENU TOGGLE END -->







                                    <!-- MOBILE LOGO -->



                                    <div class="master-nav-logo">



                                        <h1>



                                            <a href="<?php echo home_url('/'); ?>" title="<?php echo get_bloginfo(); ?>">



                                                <?php if ($settings['different_logo_img_for_mobile'] == 'true') { ?>



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light-mobile">



                                                    <img src="<?php echo $settings['master_navigation_image_mobile']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark-mobile">



                                                <?php }



                                                else{ ?>



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Light" class="master-nav-logo-light">



                                                    <img src="<?php echo $settings['master_navigation_image']['url']; ?>"



                                                         alt="Master Logo Dark" class="master-nav-logo-dark">



                                                <?php } ?>



                                                <span>Master</span>



                                            </a>







                                        </h1>



                                    </div>



                                    <!-- MOBILE LOGO END -->







                                </li>



                            </ul>



                            <?php







                            $item_style = "";



                            $args = [



                                'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                'container' => 'div',



                                'menu_id' => 'main-menu',



                                'menu' => $settings['master_navigation_menu'],



                                'menu_class' => 'master-nav-menu-body master-nav-desktop-menu',



                                'depth' => 4,



                                'echo' => true,



                                'fallback_cb' => 'wp_page_menu',



                                'walker' => new \Master_Menu_Walker()



                            ];







                            wp_nav_menu($args);







                            $item_style = "";



                            $args = [



                                'items_wrap' => '<ul id="%1$s" style ="' . $item_style . '" class="%2$s">%3$s</ul>',



                                'container' => 'div',



                                'menu_id' => 'main-menu',



                                'menu' => $settings['master_navigation_mobile_menu'],



                                'menu_class' => 'master-nav-menu-body master-nav-mobile-menu',



                                'depth' => 4,



                                'echo' => true,



                                'fallback_cb' => 'wp_page_menu',



                                'walker' => new \Master_Menu_Walker()



                            ];







                            wp_nav_menu($args);







                            ?>







                            <!-- //////////////////////////////// -->



                            <!-- Master navigation MENU SEARCH -->



                            <!-- ///////////////////////////// -->



                            <?php if($settings['show_search_icon']=='yes') :?>



                                <form class="master-nav-searc master-nav-pos-<?= $settings['master_navigation_position_for_search'] ?>">



                                    <label class="master-nav-transparent-overlay" for="master-nav-SEARCH"></label>



                                    <label for="master-nav-SEARCH">



                                        <svg class="master-nav-search-icon" xmlns="http://www.w3.org/2000/svg" width="24"



                                             height="24" viewBox="0 0 24 24">



                                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>



                                            <path d="M0 0h24v24H0z" fill="none"></path>



                                        </svg>



                                    </label>



                                    <div class="master-nav-menu-search-field">



                                        <div class="master-nav-container">



                                            <div class="master-nav-menu-search-field-inner">



                                                <label class="master-nav-flex master-nav-pointer" for="master-nav-SEARCH">



                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"



                                                         viewBox="0 0 24 24">



                                                        <path d="M0 0h24v24H0z" fill="none"></path>



                                                        <path d="M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z"></path>



                                                    </svg>



                                                </label>



                                                <input class="js-master-nav-menu-search-field" type="search"



                                                       placeholder="Search" name="q" autocapitalize="off"



                                                       autocomplete="off">



                                            </div>



                                        </div>



                                    </div>



                                </form>



                            <?php endif; ?>



                            <!-- ///////////////////////////////// -->



                            <!-- Master navigation MENU SEARCH END -->



                            <!-- ///////////////////////////////// -->



                        </nav>







                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU SEARCH -->



                        <!-- ////////////////////// -->



                        <?php if($settings['show_search_icon']=='yes') :?>



                            <form class="master-nav-menu-search master-nav-flex master-nav-align-middle">



                                <input class="master-nav-hidden" id="master-nav-SEARCH" type="checkbox">



                                <label class="master-nav-transparent-overlay" for="master-nav-SEARCH"></label>



                                <label class="master-nav-pointer master-nav-flex js-master-nav-menu-search-icon master-nav-mobile-only"



                                       for="master-nav-SEARCH">



                                    <svg class="master-nav-search-icon" xmlns="http://www.w3.org/2000/svg" width="24"



                                         height="24" viewBox="0 0 24 24">



                                        <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>



                                        <path d="M0 0h24v24H0z" fill="none"></path>



                                    </svg>



                                </label>



                                <div class="master-nav-menu-search-field">



                                    <div class="master-nav-container">



                                        <div class="master-nav-menu-search-field-inner">



                                            <label class="master-nav-flex master-nav-pointer" for="master-nav-SEARCH">



                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"



                                                     viewBox="0 0 24 24">



                                                    <path d="M0 0h24v24H0z" fill="none"></path>



                                                    <path d="M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z"></path>



                                                </svg>



                                            </label>



                                            <input class="js-master-nav-menu-search-field" type="search"



                                                   placeholder="Search" name="q" autocapitalize="off" autocomplete="off">



                                        </div>



                                    </div>



                                </div>



                            </form>



                        <?php endif; ?>



                        <!-- ////////////////////// -->



                        <!-- Master navigation MENU SEARCH END -->



                        <!-- ////////////////////// -->



                    </div>



                </div>







                <div class="master-nav-header-shadow"></div>



            </header>



            <div class="master-nav-header-spacer"></div>



            <!-- ////////////////////// -->



            <!-- Master navigation HEADER END -->



            <!-- ////////////////////// -->



        <?php }







    }







}