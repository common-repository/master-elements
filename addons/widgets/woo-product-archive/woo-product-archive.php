<?php

namespace Elementor;


use Elementor\Cotnrols_Stack;
use MasterElements\Master_Woocommerce_Functions;
use WooCommerce\WC_Product_Factory;
use MasterElements\Archive_Products_Render;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Master_Woo_Product_Archive extends Widget_Base
{

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);

        wp_register_style('woo-widgets-css', \MasterElements::widgets_url() . '/woo-product-archive/assets/css/woo-widgets.css', false, \MasterElements::version);

    }


    public function get_name()
    {
        return 'woo-product-archive';
    }

    public function get_title()
    {
        return __('MW: Product Archive', 'masterelements');
    }


    public function get_categories()
    {
        return array('master-addons');
    }

    public function get_style_depends()
    {
        return [
            'woo-widgets-css',
        ];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'me-product-archive-conent',
            [
                'label' => __('Archive Products', 'masterelements'),
            ]
        );

        $this->add_responsive_control(
            'me_columns',
            [
                'label' => __('Columns', 'masterelements'),
                'type' => Controls_Manager::NUMBER,
                'prefix_class' => 'masterelements-columns%s-',
                'min' => 1,
                'max' => 12,
                'default' => 4,
                'required' => true,
                'device_args' => [
                    Controls_Stack::RESPONSIVE_TABLET => [
                        'required' => false,
                    ],
                    Controls_Stack::RESPONSIVE_MOBILE => [
                        'required' => false,
                    ],
                ],
                'min_affected_device' => [
                    Controls_Stack::RESPONSIVE_DESKTOP => Controls_Stack::RESPONSIVE_TABLET,
                    Controls_Stack::RESPONSIVE_TABLET => Controls_Stack::RESPONSIVE_TABLET,
                ],
            ]
        );

        $this->add_control(
            'me_rows',
            [
                'label' => __('Rows', 'masterelements'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
                'render_type' => 'template',
                'range' => [
                    'px' => [
                        'max' => 20,
                    ],
                ],
            ]
        );

        $this->add_control(
            'me_paginate',
            [
                'label' => __('Pagination', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        $this->add_control(
            'me_sort_product_order',
            [
                'label' => __('Sort Products in Order', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'condition' => [
                    'me_paginate' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'me_show_result_count',
            [
                'label' => __('Show Product Count', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'condition' => [
                    'me_paginate' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'me_orderby',
            [
                'label' => __('Order by', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => __('Date', 'masterelements'),
                    'title' => __('Title', 'masterelements'),
                    'price' => __('Price', 'masterelements'),
                    'popularity' => __('Popularity', 'masterelements'),
                    'rating' => __('Rating', 'masterelements'),
                    'rand' => __('Random', 'masterelements'),
                    'menu_order' => __('Menu Order', 'masterelements'),
                ],
                'condition' => [
                    'me_paginate!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'me_order',
            [
                'label' => __('Order', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => __('ASC', 'masterelements'),
                    'desc' => __('DESC', 'masterelements'),
                ],
                'condition' => [
                    'me_paginate!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'me_query_post_type',
            [
                'type' => 'hidden',
                'default' => 'current_query',
            ]
        );

        $this->end_controls_section();
        //////////////////////////////////////////////////////////////////


        // View Cart Button Style Section
//        $this->start_controls_section(
//            'me_product-viewcartbutton-section',
//            [
//                'label' => esc_html__('View Cart Button', 'masterelements'),
//                'tab' => Controls_Manager::TAB_STYLE,
//            ]
//        );
//        $this->start_controls_tabs('me_product_viewcartbutton_style_tabs');
//
//        // Add to cart normal style
//        $this->start_controls_tab(
//            'me_product_viewcartbutton_style_normal_tab',
//            [
//                'label' => __('Normal', 'masterelements'),
//            ]
//        );
//
//
//        $this->add_control(
//            'me_view_cart_button_background_color',
//            [
//                'label' => __('Background Color', 'masterelements'),
//                'type' => Controls_Manager::COLOR,
//                'selectors' => [
//                    '{{WRAPPER}} a.added_to_cart.wc-forward' => 'background-color: {{VALUE}};',
//                ],
//            ]
//        );
//
//        $this->add_group_control(
//            Group_Control_Border::get_type(),
//            [
//                'name' => 'me_view_cart_button_border',
//                'label' => __('Border', 'masterelements'),
//                'selector' => '{{WRAPPER}} a.added_to_cart.wc-forward',
//            ]
//        );
//
//
//        $this->end_controls_tab();
//
//        // Add to cart hover style
//        $this->start_controls_tab(
//            'me_product_viewcartbutton_style_hover_tab',
//            [
//                'label' => __('Hover', 'masterelements'),
//            ]
//        );
//
//        $this->add_group_control(
//            Group_Control_Border::get_type(),
//            [
//                'name' => 'me_view_cart_button_hover_border',
//                'label' => __('Border', 'masterelements'),
//                'selector' => '{{WRAPPER}} a.added_to_cart.wc-forward:hover',
//            ]
//        );
//
//        $this->end_controls_tab();
//
//        $this->end_controls_tabs();
//
//        $this->end_controls_section();

        //////////////////////////////////////////////////////////////////////////
        // Item Style Section
        $this->start_controls_section(
            'me-product-item-section',
            [
                'label' => esc_html__('Products', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        ////////////////////////////////////////////////////////////////////////////////////// Start
        $this->start_controls_tabs('me_product_card_style_tabs');

        //  card normal style
        $this->start_controls_tab(
            'me_card_style_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );


        $this->add_control(
            'me_card_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_card_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product',
            ]
        );


        $this->end_controls_tab();

        // card hover style
        $this->start_controls_tab(
            'me_product_card_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),

            ]
        );
        $this->add_control(
            'me_card_hover_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_card_hover_border',
                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product:hover',
            ]
        );
//        $this->add_control(
//            'width',
//            [
//                'label' => __( 'Width', 'masterelements' ),
//                'type' => Controls_Manager::SLIDER,
//                'size_units' => [ 'px', '%' ],
//                'range' => [
//                    'px' => [
//                        'min' => 0,
//                        'max' => 1000,
//                        'step' => 1,
//                    ],
//                    '%' => [
//                        'min' => 0,
//                        'max' => 100,
//                    ],
//                ],
//                'default' => [
//                    'unit' => '%',
//                    'size' => 50,
//                ],
//                'selectors' => [
//                    '{{WRAPPER}} .woocommerce ul.products li.product a img:hover' => 'transition: transform 0.6s ease-in-out;',
//                    '{{WRAPPER}} .woocommerce ul.products li.product:hover' => 'width: {{SIZE}}{{UNIT}};',
//                ],
//            ]
//        );


        $this->end_controls_tab();

        $this->end_controls_tabs();


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//    Remove This border & add Above
//        $this->add_group_control(
//            Group_Control_Border::get_type(),
//            [
//                'name' => 'me_product_item_border',
//                'label' => __('Border', 'masterelements'),
//                'selector' => '{{WRAPPER}} .woocommerce ul.products li',
//            ]
//        );


        $this->add_responsive_control(
            'me_product_item_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_product_item_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_product_item_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_product_item_box_shadow',
                'label' => __('Box Shadow', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce ul.products li',
            ]
        );

        $this->add_responsive_control(
            'me_product_item_alignment',
            [
                'label' => __('Alignment', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'masterelements'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'masterelements'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'masterelements'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'masterelements'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'prefix_class' => 'masterelements-product-loop-item-align-',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // image Style Section
        $this->start_controls_section(
            'me-product-image-section',
            [
                'label' => esc_html__('Image', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        ////////////////////////////////////////////////////////////////////
        $this->start_controls_tabs('me_Product_img_style_tabs');

        //  card normal style
        $this->start_controls_tab(
            'me_Product_img_style_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_product_image_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product a img',
            ]
        );
        $this->end_controls_tab();

        // card hover style
        $this->start_controls_tab(
            'me_Product_img_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_hover_product_image_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product a img',
            ]
        );


        $this->add_control(
            'me_img_animation',
            [
                'label' => __('Transition', 'plugin-domain'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => 'px',
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1.09,
                        'step' => 0.5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1.1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product:hover a img' => 'transform: scale({{SIZE}}) !important;',
                    '{{WRAPPER}} .woocommerce ul.products li a img' => 'transition: transform .3s !important;',
                    '{{WRAPPER}} .woocommerce ul.products li .woocommerce-loop-product__link' => 'display:block !important;',
                    '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-product__link' => 'overflow:hidden;',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();
        /////////////////////////////////////////////////////////////////////////

        $this->add_responsive_control(
            'me_product_image_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_product_image_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product a img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Title Style Section
        $this->start_controls_section(
            'me-product-title-section',
            [
                'label' => esc_html__('Title', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('product_title_style_tabs');

        // Title Normal Style
        $this->start_controls_tab(
            'me_product_title_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );
        $this->add_control(
            'me_product_title_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_product_title_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title ',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title',
            ]
        );

        $this->add_responsive_control(
            'me_product_title_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_product_title_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );

        $this->end_controls_tab();

        // Title Hover Style
        $this->start_controls_tab(
            'me_product_title_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_product_title_hover_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Price Style Section
        $this->start_controls_section(
            'me_product-price-section',
            [
                'label' => esc_html__('Price', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'me_sell_price_heading',
            [
                'label' => __('Sale Price', 'masterelements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'me_product_price_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .price' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce .price' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .woocommerce ul.products li.product .price ins' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce .price ins' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .woocommerce ul.products li.product .price ins .amount' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce .price ins .amount' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_product_price_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .price,{{WRAPPER}} .woocommerce .price',
            ]
        );

        // Regular Price
        $this->add_control(
            'me_regular_price_heading',
            [
                'label' => __('Regular Price', 'masterelements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'me_product_regular_price_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .price del' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce .price del' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce ul.products li.product .price del .amount' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .woocommerce .price del .amount' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_product_regular_price_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .price del .amount, {{WRAPPER}} .woocommerce ul.products li.product .price del, {{WRAPPER}} .woocommerce .price del',
            ]
        );

        $this->end_controls_section();

        // Rating Style Section
        $this->start_controls_section(
            'me_product-rating-section',
            [
                'label' => esc_html__('Rating', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'me_product_rating_color',
            [
                'label' => __('Rating Start Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .star-rating' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce.star-rating' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'me_product_empty_rating_color',
            [
                'label' => __('Empty Rating Start Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .star-rating::before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce .star-rating::before' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'me_product_rating_star_size',
            [
                'label' => __('Star Size', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .star-rating' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .woocommerce .star-rating' => 'font-size: {{SIZE}}{{UNIT}} !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_product_rating_start_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .star-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .woocommerce .star-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );

        $this->end_controls_section();

// Add to Cart Button Style Section
        $this->start_controls_section(
            'me_product-addtocartbutton-section',
            [
                'label' => esc_html__('Add To Cart Button', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('me_product_addtocartbutton_style_tabs');

        // Add to cart normal style
        $this->start_controls_tab(
            'me_product_addtocartbutton_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_cart_button_text_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .button' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'me_cart_button_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_cart_button_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} .woocommerce .button',
            ]
        );

        $this->add_responsive_control(
            'me_cart_button_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .woocommerce .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_cart_button_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} .woocommerce .button',
            ]
        );

        $this->add_responsive_control(
            'me_cart_button_text_alignment',
            [
                'label' => __('Text Alignment', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'masterelements'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'masterelements'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'masterelements'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'masterelements'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'prefix_class' => 'masterelements-product-loop-item-align-',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button,{{WRAPPER}} .woocommerce .button' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_cart_button_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .woocommerce .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_cart_button_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .woocommerce .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );

        $this->end_controls_tab();

        // Add to cart hover style
        $this->start_controls_tab(
            'me_product_addtocartbutton_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );
        $this->add_control(
            'me_cart_button_hover_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .button:hover' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'me_cart_button_hover_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product .button:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce .button:hover' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_cart_button_hover_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product .button:hover,{{WRAPPER}}.elementor-widget-masterelements .button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // View Cart Button Style Section
        $this->start_controls_section(
            'me_product-viewcartbutton-section',
            [
                'label' => esc_html__('View Cart Button', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('me_product_viewcartbutton_style_tabs');

        // Add to cart normal style
        $this->start_controls_tab(
            'me_product_viewcartbutton_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_view_cart_button_text_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} a.added_to_cart.wc-forward' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'me_view_cart_button_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.added_to_cart.wc-forward' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_view_cart_button_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} a.added_to_cart.wc-forward',
            ]
        );

        $this->add_responsive_control(
            'me_views_cart_button_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}a.added_to_cart.wc-forward' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_view_cart_button_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} a.added_to_cart.wc-forward',
            ]
        );

        $this->add_responsive_control(
            'me_vertical_align_view_cart_btn',
            [
                'label' => __('Vertical Position', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'contents' => [
                        'title' => __('Top', 'masterelements'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'table' => [
                        'title' => __('Bottom', 'masterelements'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .added_to_cart' => 'display: {{VALUE}} !important',

                ],

            ]
        );

        $this->add_responsive_control(
            'me_view_cart_button_text_alignment',
            [
                'label' => __('Text Alignment', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'masterelements'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'masterelements'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'masterelements'),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'masterelements'),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'prefix_class' => 'masterelements-product-loop-item-align-',
                'selectors' => [
                    '{{WRAPPER}} a.added_to_cart.wc-forward' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .added_to_cart' => 'width: 100% !important',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_view_cart_button_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} a.added_to_cart.wc-forward' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_view_cart_button_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} a.added_to_cart.wc-forward' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_tab();

        // Add to cart hover style
        $this->start_controls_tab(
            'me_product_viewcartbutton_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );
        $this->add_control(
            'me_view_cart_button_hover_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.added_to_cart.wc-forward:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'me_view_cart_button_hover_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.added_to_cart.wc-forward:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_view_cart_button_hover_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} a.added_to_cart.wc-forward:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        // Pagination Style Section
        $this->start_controls_section(
            'me-product-pagination-section',
            [
                'label' => esc_html__('Pagination', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'me_paginate' => 'yes',
                ],
            ]
        );
        $this->start_controls_tabs('product_pagination_style_tabs');

        // Pagination normal style
        $this->start_controls_tab(
            'me_product_pagination_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_product_pagination_border_color',
            [
                'label' => __('Border Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul li' => 'border-right-color: {{VALUE}}; border-left-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_product_pagination_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul li a, {{WRAPPER}}.elementor-widget-masterelements nav.woocommerce-pagination ul li span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'me_product_pagination_link_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_product_pagination_link_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul li a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        // Pagination Active style
        $this->start_controls_tab(
            'me_product_pagination_style_active_tab',
            [
                'label' => __('Active', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_product_pagination_link_color_hover',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul li a:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul li span.current' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_product_pagination_link_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul li a:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce nav.woocommerce-pagination ul li span.current' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        //Product Count
        $this->start_controls_section(
            'me-product-count-section',
            [
                'label' => esc_html__('Product Count', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'me_show_result_count' => 'yes',
                ],
            ]
        );
        $this->start_controls_tabs('me_product_count_style_tabs');

        // Product Count normal style
        $this->start_controls_tab(
            'me_product_count_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_product_count_text_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.woocommerce-result-count' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'me_product_count_text_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.woocommerce-result-count' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_product_count_text_typography',
                'selector' => '{{WRAPPER}} p.woocommerce-result-count',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_product_count_text_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} p.woocommerce-result-count',
            ]
        );

        $this->add_responsive_control(
            'me_product_count_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} p.woocommerce-result-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_product_count_box_shadow',
                'label' => __('Box Shadow', 'masterelements'),
                'selector' => '{{WRAPPER}} p.woocommerce-result-count',
            ]
        );

        $this->add_responsive_control(
            'me_product_count_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} p.woocommerce-result-count' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'me_product_count_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} p.woocommerce-result-count' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );


        $this->end_controls_tab();

        //Product Count Hover
        $this->start_controls_tab(
            'me_product_count_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_product_count_text_color_hover',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.woocommerce-result-count:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'me_product_count_text_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.woocommerce-result-count:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_product_count_text_typography_hover',
                'selector' => '{{WRAPPER}} p.woocommerce-result-count:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_product_count_text_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} p.woocommerce-result-count:hover',
            ]
        );

        $this->add_responsive_control(
            'me_product_count_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} p.woocommerce-result-count:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_tabs();

        $this->end_controls_section();

        //Product Sort
        $this->start_controls_section(
            'me-product-sort-order-section',
            [
                'label' => esc_html__('Product Sort', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'me_sort_product_order' => 'yes',
                ],
            ]
        );
        $this->start_controls_tabs('me_product_sort_order_style_tabs');

        // Product Sort normal style
        $this->start_controls_tab(
            'me_product_sort_order_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_product_sort_order_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} select.orderby' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'me_product_sort_order_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} select.orderby' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_product_sort_order_typography',
                'selector' => '{{WRAPPER}} select.orderby',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_product_sort_order_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} select.orderby',
            ]
        );

        $this->add_responsive_control(
            'me_product_sort_order_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} select.orderby' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_product_sort_order_box_shadow',
                'label' => __('Box Shadow', 'masterelements'),
                'selector' => '{{WRAPPER}} select.orderby',
            ]
        );

        $this->add_responsive_control(
            'me_product_sort_order_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} select.orderby' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'me_product_sort_order_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} select.orderby' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );


        $this->end_controls_tab();

        //Product Count Hover
        $this->start_controls_tab(
            'me_product_sort_order_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_product_sort_order_text_color_hover',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}select.orderby:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'me_product_sort_order_text_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} select.orderby:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_product_sort_order_text_typography_hover',
                'selector' => '{{WRAPPER}} select.orderby:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_product_sort_order_text_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} select.orderby:hover',
            ]
        );

        $this->add_responsive_control(
            'me_product_sort_order_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} select.orderby:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_tabs();

        $this->end_controls_section();


        // Sale Flash Style Section
        $this->start_controls_section(
            'me_product-saleflash-style-section',
            [
                'label' => esc_html__('Sale Tag', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'me_product_show_onsale_flash',
            [
                'label' => __('Sale Flash', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('Hide', 'masterelements'),
                'label_on' => __('Show', 'masterelements'),
                'separator' => 'before',
                'default' => 'yes',
                'return_value' => 'yes',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product span.onsale' => 'display: block',
                    '{{WRAPPER}} .woocommerce span.onsale' => 'display: block !important',
                ],
            ]
        );

        $this->add_control(
            'me_product_onsale_text_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product span.onsale' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce span.onsale' => 'color: {{VALUE}} !important',
                ],
                'condition' => [
                    'me_product_show_onsale_flash' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'me_product_onsale_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product span.onsale' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce span.onsale' => 'background-color: {{VALUE}} !important',
                ],
                'condition' => [
                    'me_product_show_onsale_flash' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_product_onsale_typography',
                'selector' => '{{WRAPPER}} .woocommerce ul.products li.product span.onsale,{{WRAPPER}} .woocommerce span.onsale',
                'condition' => [
                    'me_product_show_onsale_flash' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_product_onsale_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product span.onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .woocommerce span.onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
                'condition' => [
                    'me_product_show_onsale_flash' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_product_onsale_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product span.onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .woocommerce span.onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
                'condition' => [
                    'me_product_show_onsale_flash' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'me_horizontal_onsale_position',
            [
                'label' => __('Horizontal Position', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'masterelements'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'masterelements'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product span.onsale' => '{{VALUE}}',
                    '{{WRAPPER}} .woocommerce span.onsale' => '{{VALUE}} !important',
                ],
                'selectors_dictionary' => [
                    'left' => 'right: auto; left: 0',
                    'right' => 'left: auto; right: 0',
                ],
                'condition' => [
                    'me_product_show_onsale_flash' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_horizontal_offset_left',
            [
                'label' => __('Offset', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'options' => [
                    'left',
                    'right'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product span.onsale' => 'left: {{SIZE}}{{UNIT}} !important',
                    //'{{WRAPPER}} .woocommerce span.onsale' => 'right: auto',
                ],
                'condition' => [
                    'me_horizontal_onsale_position' => 'left',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_horizontal_offset_right',
            [
                'label' => __('Offset', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'options' => [
                    'left',
                    'right'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product span.onsale' => 'right: {{SIZE}}{{UNIT}} !important',
                    //'{{WRAPPER}} .woocommerce span.onsale' => 'right: auto',
                ],
                'condition' => [
                    'me_horizontal_onsale_position' => 'right',
                ],
            ]
        );

        $this->add_control(
            'me_verical_product_onsale_position',
            [
                'label' => __('Vertical Position', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'top' => [
                        'title' => __('Top', 'masterelements'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'masterelements'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product span.onsale' => '{{VALUE}}',
                    '{{WRAPPER}} .woocommerce span.onsale' => '{{VALUE}} !important',
                ],
                'selectors_dictionary' => [
                    'top' => 'bottom: auto; top: 0',
                    'bottom' => 'top: auto; bottom: 0',
                ],
                'condition' => [
                    'me_product_show_onsale_flash' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_vertical_offset_top',
            [
                'label' => __('Offset', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'options' => [
                    'top',
                    'bottom'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product span.onsale' => 'top: {{SIZE}}{{UNIT}} !important',
                    //'{{WRAPPER}} .woocommerce span.onsale' => 'bottom: auto',
                ],
                'condition' => [
                    'me_verical_product_onsale_position' => 'top',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_vertical_offset_bottom',
            [
                'label' => __('Offset', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'options' => [
                    'top',
                    'bottom'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce ul.products li.product span.onsale' => 'bottom: {{SIZE}}{{UNIT}} !important',
                    //'{{WRAPPER}} .woocommerce span.onsale' => 'bottom: auto',
                ],
                'condition' => [
                    'me_verical_product_onsale_position' => 'bottom',
                ],
            ]
        );


        $this->add_responsive_control(
            'me_item_margin_sale',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} woocommerce ul.products li.product span.onsale' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    public function custom_product_limit($limit = 3)
    {
        $limit = ($this->get_settings_for_display('me_columns') * $this->get_settings_for_display('row'));
        return $limit;
    }

    /**
     * WooCommerce Classes, Actions and Filters Used in this Function
     */
    protected function render()
    {
        $master_session = new Master_Woocommerce_Functions();
        if ($master_session::mw_session()) {
            $master_session::mw_wc_notices();
        }

        if (!isset($GLOBALS['post'])) {
            $GLOBALS['post'] = null;
        }

        $settings = $this->get_settings();
        $settings['editor_mode'] = $master_session::mw_is_is_edit_mode();
        $settings['is_page'] = is_page();
        //echo '<pre>'.print_r($settings).'</pre>';
        add_filter('product_custom_limit', array($this, 'custom_product_limit'));

        $mobile_width = 100 / $this->get_settings_for_display('me_columns_mobile');
        $tablet_width = 100 / $this->get_settings_for_display('me_columns_tablet');
        require_once(ME_Path . 'addons/widgets/woo-product-archive/master_archive_products.php');

        ?>
        <style>
            @media screen and (max-width: 767px) {
                .woocommerce ul.products[class*=columns-] li.product, .woocommerce-page ul.products[class*=columns-] li.product {
                    width: <?= $mobile_width ?>%;
                }
            }

            @media screen and (min-width: 768px) and (max-width: 1024px) {
                .woocommerce ul.products[class*=columns-] li.product, .woocommerce-page ul.products[class*=columns-] li.product {
                    width: <?= $tablet_width ?>%;
                    clear:none;
                }
            }
        </style>
        <?php
        $mw_shortcode = new \Master_Archive_Products($settings);
        $shop_content = $mw_shortcode->get_content();

        echo $shop_content;


    }
}