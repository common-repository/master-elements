<?php

namespace Elementor;

use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use MasterElements\Master_Woocommerce_Functions;

if (!defined('ABSPATH')) exit;

class Master_Woo_Cart_Total extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);

    }

    public function get_name()
    {
        return 'woo-cart-total';
    }

    public function get_title()
    {
        return __('MW Cart Total', 'masterelements');
    }

    public function get_categories()
    {
        return array('master-addons');
    }

    public function get_icon()
    {
        return 'eicon-woocommerce';
    }

    protected function _register_controls()
    {

        // Heading
        $this->start_controls_section(
            'me_cart_total_heading_style',
            array(
                'label' => __('Heading', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('me_cart_heading_style_tabs');

        // Cart Total Heading Normal Style
        $this->start_controls_tab(
            'me_cart_total_heading_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_cart_total_heading_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals > h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_cart_total_heading_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals > h2' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_cart_total_heading_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .cart_totals > h2',
            )
        );

        $this->end_controls_tab();


        // Product Title Hover Style
        $this->start_controls_tab(
            'me_cart_total_heading_hover',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_cart_total_heading_color_hover',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals > h2:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_cart_total_heading_background_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals > h2:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_cart_total_heading_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .cart_totals > h2:hover',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_cart_total_heading_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .cart_totals > h2:hover',
                'condition' => [
                    'border' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_cart_total_heading_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cart_totals > h2:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'border' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'me_cart_total_heading_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cart_totals > h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_cart_total_heading_align',
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
                'prefix_class' => 'elementor%s-align-',
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .cart_totals > h2' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'border',
            [
                'label' => __('Border', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_cart_total_heading_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .cart_totals > h2',
                'condition' => [
                    'border' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_cart_total_heading_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cart_totals > h2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'border' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_cart_total_heading_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cart_totals > h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'border' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_cart_total_heading_box_shadow',
                'selector' => '{{WRAPPER}} .cart_totals >h2',
                'condition' => [
                    'border' => 'yes',
                ],
            ]

        );

        $this->add_control(
            'me_cart_total_heading_width',
            [
                'label' => __('Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 160,
                        'max' => 1100,
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
                    '{{WRAPPER}} .cart_totals > h2' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'border' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Cart Total Table
        $this->start_controls_section(
            'me_cart_total_table_style',
            array(
                'label' => __('Table Cell', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'me_cart_total_table_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_cart_total_table_border',
                'selector' => '{{WRAPPER}} .cart_totals .shop_table tr th, {{WRAPPER}} .cart_totals .shop_table tr td',
            ]
        );

        $this->add_responsive_control(
            'me_cart_total_table_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr td ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_cart_total_table_align',
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
                'prefix_class' => 'elementor%s-align-',
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr th, {{WRAPPER}} .cart_totals .shop_table tr td' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Cart Total Table heading
        $this->start_controls_section(
            'me_cart_total_table_heading_style',
            array(
                'label' => __('Table Heading', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('me_cart_item_total_heading_style_tabs');

        // Product Title Normal Style
        $this->start_controls_tab(
            'me_cart_total_table_heading_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_cart_total_table_heading_text_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr th' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_cart_total_table_heading_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr th' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_cart_total_table_heading_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .cart_totals .shop_table tr th',
            )
        );

        $this->add_responsive_control(
            'me_cart_total_table_heading_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_cart_total_table_heading_hover', [
                'label' => __('Hover', 'masterelements'),
            ]
        );
        $this->add_control(
            'me_cart_total_table_heading_text_color_hover',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr th:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_cart_total_table_heading_background_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr th:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_cart_total_table_heading_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .cart_totals .shop_table tr th:hover',
            )
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // Cart Total Price
        $this->start_controls_section(
            'me_cart_total_table_price_style',
            array(
                'label' => __('Price', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('me_cart_total_table_price_style_tabs');

        // Table Price Normal Style
        $this->start_controls_tab(
            'me_cart_total_table_price_style_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );
        $this->add_control(
            'me_cart_total_table_heading',
            [
                'label' => __('Price', 'masterelements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_cart_total_table_subtotal_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .cart_totals .shop_table tr.cart-subtotal td',
            )
        );

        $this->add_control(
            'me_cart_total_table_subtotal_color',
            [
                'label' => __('Subtotal Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr.cart-subtotal td' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_me_cart_total_table_subtotal_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr.cart-subtotal td' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_total_table_totalprice_heading',
            [
                'label' => __('Total Price', 'masterelements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'cart_total_table_total_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .cart_totals .shop_table tr.order-total th, {{WRAPPER}} .cart_totals .shop_table tr.order-total td .amount',
            )
        );

        $this->add_control(
            'cart_total_table_total_color',
            [
                'label' => __('Total Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr.order-total td .amount' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'me_cart_total_table_total_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr.order-total td' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_cart_total_table_price_style_hover',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );
        $this->add_control(
            'me_cart_total_table_price_hover',
            [
                'label' => __('Price', 'masterelements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_cart_total_table_subtotal_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .cart_totals .shop_table tr.cart-subtotal td:hover',
            )
        );

        $this->add_control(
            'me_cart_total_table_subtotal_color_hover',
            [
                'label' => __('Subtotal Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr.cart-subtotal td:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_me_cart_total_table_subtotal_background_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr.cart-subtotal td:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_total_table_totalprice_heading_hover',
            [
                'label' => __('Total Price', 'masterelements'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'cart_total_table_total_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .cart_totals .shop_table tr.order-total th:hover, {{WRAPPER}} .cart_totals .shop_table tr.order-total td .amount:hover',
            )
        );

        $this->add_control(
            'cart_total_table_total_color_hover',
            [
                'label' => __('Total Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr.order-total td .amount:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'me_cart_total_table_total_background_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart_totals .shop_table tr.order-total td:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tabs();


        $this->end_controls_section();

        // Checkout button
        $this->start_controls_section(
            'me_cart_total_checkout_button_style',
            array(
                'label' => __('Checkout Button', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('me_cart_total_checkout_button_style_tabs');

        $this->start_controls_tab(
            'me_cart_total_checkout_button_style_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_cart_total_checkout_button_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_cart_total_checkout_button_border',
                'label' => __('Button Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button',
            ]
        );
        $this->add_control(
            'e_cart_total_checkout_button_width',
            [
                'label' => __('Checkout Button Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 277,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 200
                    ],
                ],
                //'default' => [
                //   'unit' => 'px',
                //  'size' => 80,
                // ],
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'float: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'me_cart_table_titles_align',
            [
                'label' => __('Checkout Text Alignment', 'masterelements'),
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
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_cart_total_checkout_button_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_cart_total_checkout_button_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'me_cart_total_checkout_button_text_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_cart_total_checkout_button_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_cart_total_checkout_button_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_cart_total_checkout_button_box_shadow',
                'selector' => '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_cart_total_checkout_button_style_hover',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_cart_total_checkout_button_hover_text_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_cart_total_checkout_button_hover_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_cart_total_checkout_button_hover_border_color',
            [
                'label' => __('Border Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_cart_total_checkout_button_hover_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_cart_total_checkout_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .wc-proceed-to-checkout .button.checkout-button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render()
    {
        $me_total = new Master_Woocommerce_Functions();
        $me_total:: mw_cart_totals();
    }
}