<?php
namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Embed;
use Elementor\Plugin;
use WooCommerce\Functions;
if ( ! defined( 'ABSPATH' ) ) exit;



class Master_Woo_Product_Search extends Widget_Base
{

    private static $product_id = null;


    public function __construct($data = [], $args = null)
    {


        parent::__construct($data, $args);


    }

    public function get_name()
    {

        return 'woo-product-search';

    }

    public function get_title()
    {

        return __('MW: Product Search', 'masterelements');

    }

    public function get_categories()
    {

        return array('master-addons');

    }

    public function get_icon()
    {

        return 'eicon-table';

    }

    protected function _register_controls() {


        // Style tab section
        $this->start_controls_section(
            'me_search_form_input',
            [
                'label' => __( 'Search From Input Box', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'me_search_form_input_text_color',
            [
                'label'     => __( 'Text Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input.search-field'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'me_search_form_input_placeholder_color',
            [
                'label'     => __( 'Placeholder Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#999999',
                'selectors' => [
                    '{{WRAPPER}} input.search-field::placeholder' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_search_form_input_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} input.search-field',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'me_search_form_input_background',
                'label' => __( 'Background', 'masterelements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} input.search-field',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_input_margin',
            [
                'label' => __( 'Margin', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} input.search-field' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_input_padding',
            [
                'label' => __( 'Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} input.search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'me_search_form_input_height',
            [
                'label' => __( 'Height', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 43,
                ],
                'selectors' => [
                    '{{WRAPPER}} input.search-field' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_control(
            'me_search_form_input_width',
            [
                'label' => __( 'Width', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 3000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} input.search-field' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_search_form_input_border',
                'label' => __( 'Border', 'masterelements' ),
                'selector' => '{{WRAPPER}} input.search-field',
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_input_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} input.search-field' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section();

        // Submit Button
        $this->start_controls_section(
            'me_search_form_style_submit_button',
            [
                'label' => __( 'Search Button', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Button Tabs Start
        $this->start_controls_tabs('me_search_form_style_submit_button_tabs');

        // Start Normal Submit button tab
        $this->start_controls_tab(
            'me_search_form_style_submit_button_normal_tab',
            [
                'label' => __( 'Normal', 'masterelements' ),
            ]
        );

        $this->add_control(
            'me_search_form_style_submit_button_text_color',
            [
                'label'     => __( 'Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   =>'#938989',
                'selectors' => [
                    '{{WRAPPER}} input[type="submit"]'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_search_form_style_submit_button_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} input[type="submit"]',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'me_search_form_style_submit_button_background',
                'label' => __( 'Background', 'masterelements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} input[type="submit"]',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_style_submit_button_padding',
            [
                'label' => __( 'Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_search_form_style_submit_button_margin',
            [
                'label' => __( 'Margin', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} input[type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'me_search_form_style_submit_button_height',
            [
                'label' => __( 'Height', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} input[type="submit"]' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_control(
            'me_search_form_style_submit_button_width',
            [
                'label' => __( 'Width', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 129,
                        'max' => 3000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 129,
                ],
                'selectors' => [
                    '{{WRAPPER}} input[type="submit"]' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'me_cart_table_button_alignment',
            [
                'label' => __('Button Alignment', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'masterelements'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'masterelements'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'prefix_class' => 'masterelements-product-loop-item-align-',
                'selectors' => [
                    '{{WRAPPER}} input[type="submit"]' => 'float: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_search_form_style_submit_button_border',
                'label' => __( 'Border', 'masterelements' ),
                'selector' => '{{WRAPPER}} input[type="submit"]',
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_style_submit_button_radius',
            [
                'label' => esc_html__( 'Border Radius', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} input[type="submit"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_search_form_style_submit_button_box_shadow',
                'selector' => '{{WRAPPER}} input[type="submit"]',
            ]

        );

        $this->end_controls_tab(); // Normal submit Button tab end

        // Start Hover Submit button tab
        $this->start_controls_tab(
            'me_search_form_style_submit_button_hover_tab',
            [
                'label' => __( 'Hover', 'masterelements' ),
            ]
        );

        $this->add_control(
            'me_search_form_style_submit_button_hover_text_color',
            [
                'label'     => __( 'Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input[type="submit"]:hover'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'me_search_form_style_submit_button_hover_background',
                'label' => __( 'Background', 'masterelements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} input[type="submit"]:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_search_form_style_submit_button_hover_border',
                'label' => __( 'Border', 'masterelements' ),
                'selector' => '{{WRAPPER}} input[type="submit"]:hover',
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_style_submit_button_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} input[type="submit"]:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_tab(); // Hover Submit Button tab End

        $this->end_controls_tabs(); // Button Tabs End

        $this->end_controls_section();

        $this->start_controls_section(
            'me_search_form_style_search_breadcrumbs',
            [
                'label' => __( 'Search Breadcrumbs', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('me_search_form_search_breadcrumbs_style_tabs');

        // Additional Information Heading Normal Style

        $this->start_controls_tab(
            'me_search_form_search_breadcrumbs_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_search_form_search_breadcrumbs_active_color',
            [
                'label'     => __( 'Active Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} nav.woocommerce-breadcrumb'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'me_search_form_search_breadcrumbs_non_active_color',
            [
                'label'     => __( 'Non Active Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'me_search_form_search_breadcrumbs_bg_color',
            [
                'label' => __('Breadcrumbs Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} nav.woocommerce-breadcrumb' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_search_form_search_breadcrumbs_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} nav.woocommerce-breadcrumb',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_search_breadcrumbs_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} nav.woocommerce-breadcrumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_search_form_search_breadcrumbs_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} nav.woocommerce-breadcrumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_search_form_search_breadcrumbs_margin',
            [
                'label' => esc_html__( 'Margin', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} nav.woocommerce-breadcrumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_search_breadcrumbs_align',
            [
                'label'        => __( 'Alignment', 'masterelements' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __( 'Left', 'masterelements' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'masterelements' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'masterelements' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'masterelements' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} nav.woocommerce-breadcrumb' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_search_form_search_breadcrumbs_hover',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );
        $this->add_control(
            'me_search_form_search_breadcrumbs_active_color_hover',
            [
                'label'     => __( 'Active Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} nav.woocommerce-breadcrumb:hover'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'me_search_form_search_breadcrumbs_non_active_color_hover',
            [
                'label'     => __( 'Non Active Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a:hover'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'me_search_form_search_breadcrumbs_bg_color_hover',
            [
                'label' => __('Breadcrumbs Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} nav.woocommerce-breadcrumb:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_search_form_search_breadcrumbs_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} nav.woocommerce-breadcrumb:hover',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_search_breadcrumbs_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} nav.woocommerce-breadcrumb:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'me_search_form_style_search_results',
            [
                'label' => __( 'Search Results', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('me_search_form_search_results_style_tabs');

        // Additional Information Heading Normal Style

        $this->start_controls_tab(
            'me_search_form_search_results_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_search_form_search_results_text_color',
            [
                'label'     => __( 'Text Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h1.woocommerce-products-header__title.page-title'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'me_search_form_search_results_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h1.woocommerce-products-header__title.page-title' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_search_form_search_results_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} h1.woocommerce-products-header__title.page-title',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_search_results_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} h1.woocommerce-products-header__title.page-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_search_form_search_results_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} h1.woocommerce-products-header__title.page-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_search_form_search_results_margin',
            [
                'label' => esc_html__( 'Margin', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} h1.woocommerce-products-header__title.page-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_search_results_align',
            [
                'label'        => __( 'Alignment', 'masterelements' ),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __( 'Left', 'masterelements' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'masterelements' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'masterelements' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'masterelements' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} h1.woocommerce-products-header__title.page-title' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_search_form_search_results_hover',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );
        $this->add_control(
            'me_search_form_search_results_text_color_hover',
            [
                'label'     => __( 'Text Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h1.woocommerce-products-header__title.page-title:hover'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'me_search_form_search_results_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h1.woocommerce-products-header__title.page-title:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_search_form_search_results_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} h1.woocommerce-products-header__title.page-title:hover',
            ]
        );

        $this->add_responsive_control(
            'me_search_form_search_results_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} h1.woocommerce-products-header__title.page-title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

    }

    protected function render() {
?>

        <?php
        $master_search = new Master_Woocommerce_Functions();
                if ( $master_search :: mw_is_is_edit_mode() ) {
                    ?>
                    <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>"><label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'woocommerce' ); ?></label>
                        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
                        <input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" />
                        <input type="hidden" name="post_type" value="product" />
                    </form>
                    <br>
                    <?php woocommerce_breadcrumb(); ?>
                    <br>
                    <header class="woocommerce-products-header">
                        <h1 class="woocommerce-products-header__title page-title">SEARCH RESULTS: <?php echo get_search_query(); ?></h1>

                    </header> <?php
                }
        else{ ?>
    <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>"><label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'woocommerce' ); ?></label>
    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
    <input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" />
    <input type="hidden" name="post_type" value="product" />
        </form><?php

        if(!empty(get_search_query()))
        {?>
            <nav class="woocommerce-breadcrumb"><?php woocommerce_breadcrumb(); ?></nav>
            <header class="woocommerce-products-header">
            <h1 class="woocommerce-products-header__title page-title">SEARCH RESULTS: <?php echo get_search_query(); ?></h1>

            </header><?php
        }
        ?>
<?php
    }

}
}
