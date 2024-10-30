<?php

namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;

if (!defined('ABSPATH')) exit;


class Master_Woo_Cart_Table extends Widget_Base
{

    private static $product_id = null;


    public function __construct($data = [], $args = null)
    {


        parent::__construct($data, $args);


    }


    public function get_name()
    {

        return 'woo-cart-table';

    }


    public function get_title()
    {

        return __('MW: Cart Table', 'masterelements');

    }


    public function get_categories()
    {

        return array('master-addons');

    }

    public function get_icon()
    {

        return 'eicon-product-breadcrumbs';

    }


    protected function _register_controls()
    {


        $this->start_controls_section(

            'me_cart_table_titles_style_section',

            [

                'label' => __('Cart Table Titles', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            ]

        );


        $this->start_controls_tabs('me_cart_table_titles_style_tabs');



        // Cart Total Heading Normal Style

        $this->start_controls_tab(

            'me_cart_table_titles_normal',

            [

                'label' => __('Normal', 'masterelements'),

            ]

        );

        $this->add_control(

            'me_cart_table_titles_color',

            [

                'label' => __('Title Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart th' => 'color: {{VALUE}}',

                ],

            ]

        );

        $this->add_control(
            'me_cart_table_titles_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-product-color-background-head' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(

            Group_Control_Typography::get_type(),

            array(

                'name' => 'me_cart_table_titles_typography',

                'label' => __('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart th',

            )

        );


        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_cart_table_titles_border',

                'label' => __('Title Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart th',

            ]

        );


        $this->add_responsive_control(

            'me_cart_table_titles_padding',

            [

                'label' => __('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->add_responsive_control(

            'me_cart_table_titles_align',

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

                'default' => 'left',

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart thead th' => 'text-align: {{VALUE}}',

                ],

            ]

        );

        $this->end_controls_tab();

        $this->start_controls_tab(

            'me_cart_table_titles_hover',

            [

                'label' => __('Hover', 'masterelements'),

            ]

        );

        $this->add_control(
            'me_cart_table_titles_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-product-color-background-head:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();



        $this->end_controls_tabs();


        $this->end_controls_section();


        // Cart Table Content



        $this->start_controls_section(

            'me_product_table_cell_style_section',

            [

                'label' => __('Product Table Cell', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            ]

        );

        $this->start_controls_tabs('me_product_table_cell_style_tabs');



        // Cart Total Heading Normal Style

        $this->start_controls_tab(

            'me_product_table_cell_normal',

            [

                'label' => __('Normal', 'masterelements'),

            ]

        );

        $this->add_control(

            'me_product_table_cell_background_color',

            [

                'label' => __('Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .me-product-color-background-body' => 'background-color: {{VALUE}}',

                ],

            ]

        );

        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_product_table_cell_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart tr.cart_item td',

            ]

        );


        $this->add_responsive_control(

            'me_product_table_cell_padding',

            [

                'label' => __('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->add_responsive_control(

            'me_product_table_cell_align',

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

                'default' => 'left',

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td' => 'text-align: {{VALUE}}',

                ],

            ]

        );

        $this->end_controls_tab();

        $this->start_controls_tab(

            'me_product_table_cell_hover',

            [

                'label' => __('Hover', 'masterelements'),

            ]

        );

        $this->add_control(

            'me_product_table_cell_background_color_hover',

            [

                'label' => __('Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .me-product-color-background-body:hover' => 'background-color: {{VALUE}}',

                ],

            ]

        );

        $this->end_controls_tab();



        $this->end_controls_tabs();


        $this->end_controls_section();


        // Product Image

        $this->start_controls_section(

            'me_cart_product_image_style',

            array(

                'label' => __('Product Image', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            )

        );

        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_product_image_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-thumbnail img',

            ]

        );


        $this->add_responsive_control(

            'me_product_image_border_radius',

            [

                'label' => __('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->add_responsive_control(

            'me_product_image_padding',

            [

                'label' => __('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-thumbnail img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->add_control(

            'me_product_image_width',

            [

                'label' => __('Image Width', 'masterelements'),

                'type' => Controls_Manager::SLIDER,

                'size_units' => ['px', '%'],

                'range' => [

                    'px' => [

                        'min' => 10,

                        'max' => 200,

                        'step' => 1,

                    ],

                    '%' => [

                        'min' => 0,

                        'max' => 200,

                    ],

                ],

                'default' => [

                    'unit' => 'px',

                    'size' => 32,

                ],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-thumbnail img' => 'width: {{SIZE}}{{UNIT}};',

                ],

            ]

        );


        $this->end_controls_section();


        // Product Title

        $this->start_controls_section(

            'me_cart_product_title_style',

            array(

                'label' => __('Product Title', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            )

        );


        $this->start_controls_tabs('me_cart_item_style_tabs');


        // Product Title Normal Style

        $this->start_controls_tab(

            'me_product_title_normal',

            [

                'label' => __('Normal', 'masterelements'),

            ]

        );


        $this->add_control(

            'me_cart_product_title_color',

            [

                'label' => __('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-name' => 'color: {{VALUE}}',

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-name a' => 'color: {{VALUE}}',

                ],

            ]

        );


        $this->add_group_control(

            Group_Control_Typography::get_type(),

            array(

                'name' => 'me_cart_product_title_typography',

                'label' => __('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-name',

            )

        );

        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_product_title_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-name a',

            ]

        );


        $this->add_responsive_control(

            'me_product_title_border_radius',

            [

                'label' => __('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-name a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->end_controls_tab();


        // Product Title Hover Style

        $this->start_controls_tab(

            'me_product_title_hover',

            [

                'label' => __('Hover', 'masterelements'),

            ]

        );


        $this->add_control(

            'me_cart_product_title_hover_color',

            [

                'label' => __('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-name:hover' => 'color: {{VALUE}}',

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-name a:hover' => 'color: {{VALUE}}',

                ],

            ]

        );

        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_product_title_hover_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-name a:hover',

            ]

        );


        $this->add_responsive_control(

            'me_product_title_hover_border_radius',

            [

                'label' => __('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-name a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->end_controls_tab();


        $this->end_controls_tabs();


        $this->add_responsive_control(

            'me_product_title_padding',

            [

                'label' => __('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-name a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->end_controls_section();


        // Product Price

        $this->start_controls_section(

            'me_cart_product_price_style',

            array(

                'label' => __('Product Price', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            )

        );

        $this->add_control(

            'me_cart_product_price_color',

            [

                'label' => __('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-price' => 'color: {{VALUE}}',

                ],

            ]

        );


        $this->add_group_control(

            Group_Control_Typography::get_type(),

            array(

                'name' => 'me_cart_product_price_typography',

                'label' => __('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-price',

            )

        );


        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_product_price_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .me-product-price span.woocommerce-Price-amount.amount',

            ]

        );


        $this->add_responsive_control(

            'me_product_price_border_radius',

            [

                'label' => __('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .me-product-price span.woocommerce-Price-amount.amount' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_responsive_control(

            'me_product_price_padding',

            [

                'label' => __('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .me-product-price span.woocommerce-Price-amount.amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->end_controls_section();


        // Quantity

        $this->start_controls_section(

            'me_cart_product_quantity_style',

            array(

                'label' => __('Quantity', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            )

        );

        $this->add_control(

            'me_cart_product_qty_color',

            [

                'label' => __('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} table.cart input, .woocommerce-cart table.cart input, .woocommerce-checkout table.cart input' => 'color: {{VALUE}}',

                ],

            ]

        );

        $this->add_control(
            'me_cart_product_qty_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} table.cart input, .woocommerce-cart table.cart input, .woocommerce-checkout table.cart input' => 'background-color: {{VALUE}}',
                ],
            ]
        );



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            array(

                'name' => 'me_cart_product_qty_typography',

                'label' => __('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} table.cart input, .woocommerce-cart table.cart input, .woocommerce-checkout table.cart input',

            )

        );


        $this->add_responsive_control(

            'me_cart_product_qty_taxt_align',

            [

                'label' => __('Quantity Text Alignment', 'masterelements'),

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

                'default' => 'left',

                'selectors' => [

                    '{{WRAPPER}} table.cart input, .woocommerce-cart table.cart input, .woocommerce-checkout table.cart input' => 'text-align: {{VALUE}}',

                ],

            ]

        );


        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_product_qty_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} table.cart input, .woocommerce-cart table.cart input, .woocommerce-checkout table.cart input',

            ]

        );


        $this->add_responsive_control(

            'me_product_qty_border_radius',

            [

                'label' => __('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} table.cart input, .woocommerce-cart table.cart input, .woocommerce-checkout table.cart input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_responsive_control(

            'me_product_qty_padding',

            [

                'label' => __('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} table.cart input, .woocommerce-cart table.cart input, .woocommerce-checkout table.cart input .quantity' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_control(

            'me_cart_product_qty_width',

            [

                'label' => __('Quantity Box Width', 'masterelements'),

                'type' => Controls_Manager::SLIDER,

                'size_units' => ['px', '%'],

                'range' => [

                    'px' => [

                        'min' => 10,

                        'max' => 200,

                        'step' => 1,

                    ],

                    '%' => [

                        'min' => 0,

                        'max' => 200,

                    ],

                ],

                //'default' => [

//                        'unit' => 'px',
//
                //                      'size' => 80,
//
                //                  ],

                'selectors' => [

                    '{{WRAPPER}} table.cart input, .woocommerce-cart table.cart input, .woocommerce-checkout table.cart input .quantity' => 'width: {{SIZE}}{{UNIT}};',

                ],

            ]

        );


        $this->end_controls_section();


        // Product Price Total

        $this->start_controls_section(

            'cart_product_subtotal_price_style',

            array(

                'label' => __('Total Price', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            )

        );

        $this->add_control(

            'cart_product_subtotal_price_color',

            [

                'label' => __('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-subtotal' => 'color: {{VALUE}}',

                ],

            ]

        );


        $this->add_group_control(

            Group_Control_Typography::get_type(),

            array(

                'name' => 'cart_product_subtotal_price_typography',

                'label' => __('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart tr.cart_item td.me-product-subtotal',

            )

        );


        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_product_total_price_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .me-product-subtotal span.woocommerce-Price-amount.amount',

            ]

        );


        $this->add_responsive_control(

            'me_product_total_price_border_radius',

            [

                'label' => __('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .me-product-subtotal span.woocommerce-Price-amount.amount' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_responsive_control(

            'me_product_total_price_padding',

            [

                'label' => __('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}}  .me-product-subtotal span.woocommerce-Price-amount.amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->end_controls_section();

        //Button and Input Section
        $this->start_controls_section(

            'me_cart_button_section_style',

            array(

                'label' => __('Coupon Input and Button Section', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            )

        );
        $this->add_responsive_control(
            'me_cart_button_section_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} td.actions' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_cart_button_section_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} td.actions',
            ]
        );


        $this->end_controls_section();
        // Update cart

        $this->start_controls_section(

            'me_cart_update_button_style',

            array(

                'label' => __('Update Cart Button', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            )

        );


        $this->start_controls_tabs('me_cart_update_style_tabs');


        // Product Title Normal Style

        $this->start_controls_tab(

            'me_cart_update_button_normal',

            [

                'label' => __('Normal', 'masterelements'),

            ]

        );


        $this->add_control(

            'me_cart_update_button_color',

            [

                'label' => __('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions > input.button' => 'color: {{VALUE}}',

                ],

            ]

        );


        $this->add_control(

            'me_cart_update_button_bg_color',

            [

                'label' => __('Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions > input.button' => 'background-color: {{VALUE}}',

                ],

            ]

        );


        $this->add_group_control(

            Group_Control_Typography::get_type(),

            array(

                'name' => 'me_cart_update_button_typography',

                'label' => __('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart td.actions > input.button',

            )

        );

        $this->add_control(

            'me_cart_update_button_width',

            [

                'label' => __('Update Cart Button Width', 'masterelements'),

                'type' => Controls_Manager::SLIDER,

                'size_units' => ['px', '%'],

                'range' => [

                    'px' => [

                        'min' => 10,

                        'max' => 200,

                        'step' => 1,

                    ],

                    '%' => [

                        'min' => 0,

                        'max' => 200,

                    ],

                ],

                //'default' => [

                //   'unit' => 'px',

                //  'size' => 80,

                // ],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions > input.button' => 'width: {{SIZE}}{{UNIT}};',

                ],

            ]

        );

        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_cart_update_button_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart td.actions > input.button',

            ]

        );


        $this->add_responsive_control(

            'me_cart_update_button_border_radius',

            [

                'label' => __('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions > input.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->add_responsive_control(

            'me_cart_update_button_padding',

            [

                'label' => __('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions > input.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_cart_update_button_box_shadow',
                'selector' => '{{WRAPPER}} .shop_table.cart td.actions > input.button',
            ]

        );


        $this->end_controls_tab();


        // Product Title Hover Style

        $this->start_controls_tab(

            'me_cart_update_button_hover',

            [

                'label' => __('Hover', 'masterelements'),

            ]

        );


        $this->add_control(

            'me_cart_update_button_hover_color',

            [

                'label' => __('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions > input.button:hover' => 'color: {{VALUE}}',

                ],

            ]

        );


        $this->add_control(

            'me_cart_update_button_hover_bg_color',

            [

                'label' => __('Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions > input.button:hover' => 'background-color: {{VALUE}}; transition:0.4s',

                ],

            ]

        );


        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_cart_update_button_hover_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart td.actions > input.button:hover',

            ]

        );


        $this->add_responsive_control(

            'me_cart_update_button_hover_border_radius',

            [

                'label' => __('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions > input.button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->end_controls_tab();


        $this->end_controls_tabs();


        $this->end_controls_section();


        // Apply coupon

        $this->start_controls_section(

            'me_cart_coupon_style',

            array(

                'label' => __('Apply coupon', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            )

        );


        $this->add_control(

            'me_cart_coupon_button_heading',

            [

                'label' => __('Button', 'masterelements'),

                'type' => Controls_Manager::HEADING,

                'separator' => 'after',

            ]

        );


        $this->add_group_control(

            Group_Control_Typography::get_type(),

            array(

                'name' => 'me_cart_coupon_button_typography',

                'label' => __('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart td.actions .coupon .button',

            )

        );


        $this->add_control(

            'me_cart_coupon_button_color',

            [

                'label' => __('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions .coupon .button' => 'color: {{VALUE}}',

                ],

            ]

        );


        $this->add_control(

            'me_cart_coupon_button_bg_color',

            [

                'label' => __('Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions .coupon .button' => 'background-color: {{VALUE}}; transition:0.4s',

                ],

            ]

        );

        $this->add_control(

            'me_cart_coupon_button_width',

            [

                'label' => __('Coupon Button Width', 'masterelements'),

                'type' => Controls_Manager::SLIDER,

                'size_units' => ['px', '%'],

                'range' => [

                    'px' => [

                        'min' => 10,

                        'max' => 200,

                        'step' => 1,

                    ],

                    '%' => [

                        'min' => 0,

                        'max' => 200,

                    ],

                ],

                //'default' => [

                //   'unit' => 'px',

                //  'size' => 80,

                // ],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions .coupon .button' => 'width: {{SIZE}}{{UNIT}};',

                ],

            ]

        );

        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_cart_coupon_button_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart td.actions .coupon .button',

            ]

        );


        $this->add_responsive_control(

            'me_cart_coupon_button_border_radius',

            [

                'label' => __('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions .coupon .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->add_responsive_control(

            'me_cart_coupon_button_padding',

            [

                'label' => __('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions .coupon .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_cart_coupon_button_box_shadow',
                'selector' => '{{WRAPPER}} .shop_table.cart td.actions .coupon .button',
            ]

        );


        $this->add_control(

            'me_cart_coupon_button_hover_color',

            [

                'label' => __('Hover Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions .coupon .button:hover' => 'color: {{VALUE}}',

                ],

            ]

        );


        $this->add_control(

            'me_cart_coupon_button_hover_bg_color',

            [

                'label' => __('Hover Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions .coupon .button:hover' => 'background-color: {{VALUE}}; transition:0.4s',

                ],

            ]

        );


        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_cart_coupon_hover_button_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart td.actions .coupon .button:hover',

            ]

        );


        $this->add_control(

            'me_cart_coupon_inputbox_heading',

            [

                'label' => __('Input Box', 'masterelements'),

                'type' => Controls_Manager::HEADING,

                'separator' => 'after',

            ]

        );


        $this->add_control(

            'me_cart_coupon_inputbox_color',

            [

                'label' => __('Input Box Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} input#coupon_code' => 'background-color: {{VALUE}};',

                ],

            ]

        );


        $this->add_responsive_control(

            'me_cart_coupon_inputbox_margin',

            [

                'label' => __('Margin', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} input#coupon_code ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->add_group_control(

            Group_Control_Typography::get_type(),

            array(

                'name' => 'me_cart_coupon_inputbox_heading_typography',

                'label' => __('Coupon Heading Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table .coupon label',

            )

        );

        $this->add_control(

            'me_cart_coupon_inputbox_heading_color',

            [

                'label' => __('Heading Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .shop_table .coupon label' => 'color: {{VALUE}}',

                ],

            ]

        );

        $this->add_group_control(

            Group_Control_Typography::get_type(),

            array(

                'name' => 'me_cart_coupon_inputbox_typography',

                'label' => __('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart td.actions .coupon input.input-text',

            )

        );


        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'me_cart_coupon_inputbox_border',

                'label' => __('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .shop_table.cart td.actions .coupon input.input-text',

            ]

        );


        $this->add_responsive_control(

            'me_cart_coupon_inputbox_border_radius',

            [

                'label' => __('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions .coupon input.input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->add_responsive_control(

            'me_cart_coupon_inputbox_padding',

            [

                'label' => __('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions .coupon input.input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );


        $this->add_control(

            'me_cart_coupon_inputbox_width',

            [

                'label' => __('Input Box Width', 'masterelements'),

                'type' => Controls_Manager::SLIDER,

                'size_units' => ['px', '%'],

                'range' => [

                    'px' => [

                        'min' => 10,

                        'max' => 200,

                        'step' => 1,

                    ],

                    '%' => [

                        'min' => 0,

                        'max' => 200,

                    ],

                ],

                //'default' => [

                //   'unit' => 'px',

                //  'size' => 80,

                // ],

                'selectors' => [

                    '{{WRAPPER}} .shop_table.cart td.actions .coupon input.input-text' => 'width: {{SIZE}}{{UNIT}};',

                ],

            ]

        );


        $this->end_controls_section();


    }


    /**
     * WooCommerce Actions and Filters Used in this Function
     */

    protected function render()
    {
        $me = new Master_Woocommerce_Functions();

        wc_maybe_define_constant('WOOCOMMERCE_CART', true);


        $attributes = shortcode_atts(array(), 'woocommerce_cart');

        $mw_nonce_value = wc_get_var($_REQUEST['woocommerce-shipping-calculator-nonce'], wc_get_var($_REQUEST['_wpnonce'], ''));


        //echo '<pre> Check'. var_dump(is_cart()) .'</pre>';


        if (!empty($_POST['calc_shipping']) && (wp_verify_nonce($mw_nonce_value, 'woocommerce-shipping-calculator') || wp_verify_nonce($mw_nonce_value, 'woocommerce-cart'))) { // WPCS: input var ok.

            $me::mw_calculate_shipping();

            $me::mw_calculate_total();

        }

        $me::mw_add_action('woocommerce_check_cart_items');


        $me::mw_calculate_total();


        if ($me::mw_cart_empty()) {

            wc_get_template('cart/cart-empty.php');

        } else {

            wc_get_template('cart-table.php', array('addons' => 1), ME_Path . 'addons/widgets/woo-cart-table/', ME_Path . 'addons/widgets/woo-cart-table/');

        }

    }


}



