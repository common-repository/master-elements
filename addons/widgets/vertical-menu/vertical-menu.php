<?php

namespace Elementor;


use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {

    exit; // Exit if accessed directly.

}


class Master_Vertical_Menu extends Widget_Base
{


    public $base;

    public function __construct($data = [], $args = null)

    {
        parent::__construct($data, $args);
    }


    public function get_name()

    {

        /////////////////////////////////////

        //get name of file

        /////////////////////////////////////

        return 'vertical-menu';

    }


    public function get_title()

    {

        /////////////////////////////////////

        //get title from file

        /////////////////////////////////////

        return esc_html__('Master Vertical Menu', 'masterelements');

    }


    public function get_icon()

    {

        /////////////////////////////////////

        //get icon

        /////////////////////////////////////

        return 'fa fa-bars';

    }


    public function get_categories()

    {

        //////////////////////////////////////////////////////////////////////////

        //get category where widget will be added in elementor front end

        //////////////////////////////////////////////////////////////////////////

        return ['master-addons'];

    }

    public function get_menus()
    {
        $list = [];
        $menus = wp_get_nav_menus();
        foreach ($menus as $menu) {
            $list[$menu->slug] = $menu->name;
        }
        return $list;
    }

    /**
     * Register accordion widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function _register_controls()
    {
        //Menu Content Tab
        $this->start_controls_section(
            'master_content_tab',
            [
                'label' => esc_html__('Menu settings', 'masterelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'master_nav_menu',
            [
                'label' => esc_html__('Select menu', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_menus(),
            ]
        );

        $this-> add_control(
            'master_list_style',
            [
                'label' => esc_html__('List Style', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'masterelements' ),
                    'inherit' => __( 'Inherit', 'masterelements' ),
                    'circle'   => __( 'Circle', 'masterelements' ),
                    'disc'   => __( 'Disc', 'masterelements' ),
                    'square'   => __( 'Square', 'masterelements' ),
                    'armenian'   => __( 'Armenian', 'masterelements' ),
                    'cjk-ideographic'   => __( 'CJK-Ideographic', 'masterelements' ),
                    'decimal'   => __( 'Decimal', 'masterelements' ),
                    'decimal-leading-zero'   => __( 'Decimal Leading Zero', 'masterelements' ),
                    'georgian'    => __( 'Georgian', 'masterelements' ),
                    'hebrew'  => __( 'Hebrew', 'masterelements' ),
                    'hiragana' => __( 'Hiragana', 'masterelements' ),
                    'hiragana-iroha' => __( 'Hiragan Iroha', 'masterelements' ),
                    'katakana' => __( 'Katakana', 'masterelements' ),
                    'katakana-iroha' => __( 'Katakana Iroha', 'masterelements' ),
                    'lower-alpha' => __( 'Lower Alpha', 'masterelements' ),
                    'lower-greek' => __( 'Lower Greek', 'masterelements' ),
                    'lower-latin' => __( 'Lower Latin', 'masterelements' ),
                    'lower-roman' => __( 'Lower Roman', 'masterelements' ),
                    'upper-alpha' => __( 'Upper Alpha', 'masterelements' ),
                    'upper-greek' => __( 'Upper Greek', 'masterelements' ),
                    'upper-latin' => __( 'Upper Latin', 'masterelements' ),
                    'upper-roman' => __( 'Upper Roman', 'masterelements' ),
                    'upload-image' => __('Upload Icons', 'masterelements'),
                 ],
                 'default' => 'none',
            ]
        );

        $this->add_control(

            'icon-image',

            [

                'label' => __('Choose Image', 'masterelements'),

                'type' => Controls_Manager::MEDIA,

                'dynamic' => [

                    'active' => true,

                ],


                'default' => [

                    'url' => Utils::get_placeholder_image_src(),

                ],
                'condition' => [
                    'master_list_style' => 'upload-image',
                ],

            ]

        );
        $this-> add_control(
            'master_menu_style',
            [
                'label' => esc_html__('Menu Style', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'block' => __( 'Vertical', 'masterelements' ),
                    'flex' => __( 'Horizontal', 'masterelements' ),
                 ],

            ]
                );
       
        $this->add_responsive_control(
            'master_mobile_menu_panel_spacing',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'tablet_default' => [
                    'top' => '10',
                    'right' => '0',
                    'bottom' => '10',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'devices' => ['tablet'],
                'selectors' => [
                    '{{WRAPPER}} .master-nav-identity-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'master_mobile_menu_panel_width',
            [
                'label' => esc_html__('Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'devices' => ['tablet'],
                'range' => [
                    'px' => [
                        'min' => 350,
                        'max' => 700,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'tablet_default' => [
                    'size' => 350,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-menu-container' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        //Menu List Text Style
        $this->start_controls_section(
            'master_style_tab_menuitem',
            [
                'label' => esc_html__('Menu item style', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'master_ul_padding',
            [
                'label' => esc_html__('Outer Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .master-navbar-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'master_menu_text_color',
            [
                'label' => esc_html__('Item text color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'desktop_default' => esc_html__('#000000', 'masterelements'),
                'tablet_default' => esc_html__('#000000', 'masterelements'),
                'devices' => ['desktop', 'tablet'],
                'selectors' => [
                    '{{WRAPPER}} .master-navbar-nav > li > a' => 'color: {{VALUE}}',
                ],
            ]
        );
         $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'label' => __( 'Border', 'masterelements' ),
                'selector' => '{{WRAPPER}} .master-navbar-nav > li > a',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => __( 'Border Radius', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .master-navbar-nav > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'master_item_background',
                'label' => esc_html__('Item background', 'masterelements'),
                'types' => ['classic'],
                'selector' => '{{WRAPPER}} .master-navbar-nav > li > a',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'master_content_typography',
                'label' => esc_html__('Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .master-navbar-nav > li > a',
            ]
        );
        $this->add_responsive_control(
            'master_menu_item_spacing',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => ['desktop', 'tablet'],
                'desktop_default' => [
                    'top' => 0,
                    'right' => 15,
                    'bottom' => 0,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 10,
                    'right' => 15,
                    'bottom' => 10,
                    'left' => 15,
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-navbar-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .master-navbar-nav > li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'master_menu_items_margin',
            [
                'label' => esc_html__('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .master-navbar-nav > li > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .master-navbar-nav > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'master_title_one',
            [
                'label' => esc_html__('Hover', 'masterelements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'master_item_background_hover',
                'label' => esc_html__('Item background', 'masterelements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .master-navbar-nav > li > a:hover, {{WRAPPER}} .master-navbar-nav > li > a:focus, {{WRAPPER}} .master-navbar-nav > li > a:active, {{WRAPPER}} .master-navbar-nav > li:hover > a',
            ]
        );
        $this->add_control(
            'master_item_color_hover',
            [
                'label' => esc_html__('Item text color (hover)', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => esc_html__('#707070', 'masterelements'),
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-navbar-nav > li > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .master-navbar-nav > li > a:focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .master-navbar-nav > li > a:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .master-navbar-nav > li:hover > a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'master_style_tab_submenu_item',
            [
                'label' => esc_html__('Submenu item style', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'vertical_menu' => 'no',
                ],
            ]
        );
        $this->add_control(
            'master_style_tab_submenu_item_arrow',
            [
                'label' => esc_html__('Submenu Indicator', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'master_line_arrow',
                'options' => [
                    'master_line_arrow' => esc_html__('Line Arrow', 'masterelements'),
                    'master_plus_icon' => esc_html__('Plus', 'masterelements'),
                    'master_fill_arrow' => esc_html__('Fill Arrow', 'masterelements'),
                    'master_none' => esc_html__('None', 'masterelements'),
                ],
            ]
        );
        $this->add_responsive_control(
            'master_submenu_item_spacing',
            [
                'label' => esc_html__('Spacing', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => ['desktop', 'tablet'],
                'desktop_default' => [
                    'top' => 15,
                    'right' => 10,
                    'bottom' => 15,
                    'left' => 10,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 15,
                    'right' => 10,
                    'bottom' => 15,
                    'left' => 10,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .master-navbar-nav .master-submenu-panel > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'master_menu_item_typography',
                'label' => esc_html__('Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .master-navbar-nav .master-submenu-panel > li > a',
            ]
        );
        $this->add_control(
            'master_submenu_item_color',
            [
                'label' => esc_html__('Item text color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => esc_html__('#000000', 'masterelements'),
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-navbar-nav .master-submenu-panel > li > a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'master_menu_item_background',
                'label' => esc_html__('Item background', 'masterelements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .master-navbar-nav .master-submenu-panel > li > a',
            ]
        );
        $this->add_control(
            'master_title_two',
            [
                'label' => esc_html__('Hover', 'masterelements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'master_item_text_color_hover',
            [
                'label' => esc_html__('Item text color (hover)', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => esc_html__('#707070', 'masterelements'),
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-navbar-nav .master-submenu-panel > li > a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .master-navbar-nav .master-submenu-panel > li > a:focus' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .master-navbar-nav .master-submenu-panel > li > a:active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .master-navbar-nav .master-submenu-panel > li:hover > a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'master_menu_item_background_hover',
                'label' => esc_html__('Item background (hover)', 'masterelements'),
                'types' => ['classic', 'gradient'],
                'selector' => '
                {{WRAPPER}} .master-navbar-nav .master-submenu-panel > li > a:hover,
                {{WRAPPER}} .master-navbar-nav .master-submenu-panel > li > a:focus,
                {{WRAPPER}} .master-navbar-nav .master-submenu-panel > li > a:active,
                {{WRAPPER}} .master-navbar-nav .master-submenu-panel > li:hover > a',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'master_style_tab_submenu_panel',
            [
                'label' => esc_html__('Submenu panel style', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'vertical_menu' => 'no',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'master_panel_submenu_border',
                'label' => esc_html__('Panel Menu Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .master-navbar-nav .master-submenu-panel',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'master_submenu_container_background',
                'label' => esc_html__('Container background', 'masterelements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .master-navbar-nav .master-submenu-panel',
            ]
        );
        $this->add_responsive_control(
            'master_submenu_panel_border_radius',
            [
                'label' => esc_html__('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'devices' => ['desktop', 'tablet'],
                'desktop_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .master-navbar-nav .master-submenu-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'master_submenu_container_width',
            [
                'label' => esc_html__('Conatiner width', 'masterelements'),
                'type' => Controls_Manager::TEXT,
                'devices' => ['desktop', 'tablet'],
                'desktop_default' => esc_html__('220px', 'masterelements'),
                'tablet_default' => esc_html__('200px', 'masterelements'),
                'selectors' => [
                    '{{WRAPPER}} .master-navbar-nav .master-submenu-panel' => 'min-width: {{VALUE}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'master_panel_box_shadow',
                'label' => esc_html__('Box Shadow', 'masterelements'),
                'selector' => '{{WRAPPER}} .master-navbar-nav .master-submenu-panel',
            ]
        );
        $this->end_controls_section();
        //Menu List Style
        $this->start_controls_section(
            'master_menu_list_style_section',
            [
                'label' => esc_html__('Menu List Style', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
                
            ]
            );
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'master_item_list_background',
                    'label' => esc_html__('Menu Background', 'masterelements'),
                    'types' => ['classic'],
                    'selector' => '{{WRAPPER}} .master-navbar-nav > li',
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'item_list_border',
                    'label' => __( 'Menu Border', 'masterelements' ),
                    'selector' => '{{WRAPPER}} .master-navbar-nav > li',
                ]
            );
    
            $this->add_responsive_control(
                'item_border_radius',
                [
                    'label' => __( 'Menu Border Radius', 'masterelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .master-navbar-nav > li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );
    

        $this->end_controls_section();

        $this->start_controls_section(
            'master_menu_toggle_style_tab',
            [
                'label' => esc_html__('Humburder Style', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'vertical_menu' => 'no',
                ],
            ]
        );
        $this->add_control(
            'master_menu_toggle_style_title',
            [
                'label' => esc_html__('Humburger Toggle', 'masterelements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'master_menu_toggle_icon_position',
            [
                'label' => esc_html__('Position', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Top', 'masterelements'),
                        'icon' => 'fa fa-angle-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Middle', 'masterelements'),
                        'icon' => 'fa fa-angle-right',
                    ],
                ],
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .master-menu-hamburger' => 'float: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'master_menu_toggle_spacing',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px',],
                'devices' => ['tablet'],
                'tablet_default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-menu-hamburger' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'master_menu_toggle_width',
            [
                'label' => esc_html__('Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 45,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'devices' => ['tablet'],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-menu-hamburger' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'master_menu_toggle_border_radius',
            [
                'label' => esc_html__('Border Radius', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['tablet'],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-menu-hamburger' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'master_menu_toggle_normal_and_hover_tabs'
        );
        $this->start_controls_tab(
            'master_menu_toggle_normal',
            [
                'label' => esc_html__('Normal', 'masterelements'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'master_menu_toggle_background',
                'label' => esc_html__('Background', 'masterelements'),
                'types' => ['classic'],
                'selector' => '{{WRAPPER}} .master-menu-hamburger',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'master_menu_toggle_border',
                'label' => esc_html__('Border', 'masterelements'),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .master-menu-hamburger',
            ]
        );
        $this->add_control(
            'master_menu_toggle_icon_color',
            [
                'label' => esc_html__('Humber Icon Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => esc_html__('rgba(0, 0, 0, 0.5)', 'masterelements'),
                'selectors' => [
                    '{{WRAPPER}} .master-menu-hamburger .master-menu-hamburger-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'master_menu_toggle_hover',
            [
                'label' => esc_html__('Hover', 'masterelements'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'master_menu_toggle_background_hover',
                'label' => esc_html__('Background', 'masterelements'),
                'types' => ['classic'],
                'selector' => '{{WRAPPER}} .master-menu-hamburger:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'master_menu_toggle_border_hover',
                'label' => esc_html__('Border', 'masterelements'),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .master-menu-hamburger:hover',
            ]
        );
        $this->add_control(
            'master_menu_toggle_icon_color_hover',
            [
                'label' => esc_html__('Humber Icon Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => esc_html__('rgba(0, 0, 0, 0.5)', 'masterelements'),
                'selectors' => [
                    '{{WRAPPER}} .master-menu-hamburger:hover .master-menu-hamburger-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'master_menu_close_style_title',
            [
                'label' => esc_html__('Close Toggle', 'masterelements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'master_menu_close_typography',
                'label' => __('Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .master-menu-close',
            ]
        );
        $this->add_responsive_control(
            'master_menu_close_spacing',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px',],
                'devices' => ['tablet'],
                'tablet_default' => [
                    'top' => '8',
                    'right' => '8',
                    'bottom' => '8',
                    'left' => '8',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-menu-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'master_menu_close_margin',
            [
                'label' => esc_html__('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px',],
                'devices' => ['tablet'],
                'tablet_default' => [
                    'top' => '12',
                    'right' => '12',
                    'bottom' => '12',
                    'left' => '12',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-menu-close' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'master_menu_close_width',
            [
                'label' => esc_html__('Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 45,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'devices' => ['tablet'],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-menu-close' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'master_menu_close_border_radius',
            [
                'label' => esc_html__('Border Radius', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['tablet'],
                'tablet_default' => [
                    'unit' => 'px',
                    'size' => 3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .master-menu-close' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'master_menu_close_normal_and_hover_tabs'
        );
        $this->start_controls_tab(
            'master_menu_close_normal',
            [
                'label' => esc_html__('Normal', 'masterelements'),
            ]
        );
       
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'master_menu_close_border',
                'label' => esc_html__('Border', 'masterelements'),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .master-menu-close',
            ]
        );
        $this->add_control(
            'master_menu_close_icon_color',
            [
                'label' => esc_html__('Humber Icon Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => esc_html__('rgba(51, 51, 51, 1)', 'masterelements'),
                'selectors' => [
                    '{{WRAPPER}} .master-menu-close' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'master_menu_close_hover',
            [
                'label' => esc_html__('Hover', 'masterelements'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'master_menu_close_background_hover',
                'label' => esc_html__('Background', 'masterelements'),
                'types' => ['classic'],
                'selector' => '{{WRAPPER}} .master-menu-close:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'master_menu_close_border_hover',
                'label' => esc_html__('Border', 'masterelements'),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .master-menu-close:hover',
            ]
        );
        $this->add_control(
            'master_menu_close_icon_color_hover',
            [
                'label' => esc_html__('Humber Icon Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'default' => esc_html__('rgba(0, 0, 0, 0.5)', 'masterelements'),
                'selectors' => [
                    '{{WRAPPER}} .master-menu-close:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }


    protected function render()
    {
        echo '<div class="me-wid-con" >';
        $this->render_raw();
        echo '</div>';
    }

    protected function render_raw()
    {
        $settings = $this->get_settings_for_display();
        if ($settings['master_nav_menu'] != '') {

            $item_style = "list-style:". $settings['master_list_style'];
            $menu_style = "display:". $settings['master_menu_style'];
            $args = [
                'items_wrap' => '<ul id="%1$s" style ="' . $item_style . ';'. $menu_style. '" class="%2$s">%3$s</ul>',
                'container' => 'div',
                'container_id' => 'me-vertical-' . $settings['master_nav_menu'],
                'container_class' => 'master-vertical-menu-container master-navbar-nav-default ' . $settings['master_style_tab_submenu_item_arrow'],
                'menu_id' => 'footer-menu',
                'menu' => $settings['master_nav_menu'],
                'menu_class' => 'master-navbar-nav ',
                'depth' => 4,
                'echo' => true,
                'fallback_cb' => 'wp_page_menu',
            ];
            wp_nav_menu($args);
        }
    }

}

