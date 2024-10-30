<?php

namespace Elementor;

use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use WooCommerce\Functions;
use MasterElements\Master_Woocommerce_Functions;

if (!defined('ABSPATH')) exit;

class Master_Woo_Checkout_Payment extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);


    }

    public function get_name()
    {
        return 'woo-checkout-payment';
    }

    public function get_title()
    {
        return __('MW: Checkout Payment', 'masterelements');
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

        // Payment
        $this->start_controls_section(
            'me_checkout_personal_data_style',
            array(
                'label' => __('Personal Data Text', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_checkout_personal_data_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} #payment',
            )
        );

        $this->add_control(
            'me_checkout_personal_data_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #payment' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(

            'me_checkout_personal_data_bg_color',

            [

                'label' => __('Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} #payment' => 'background-color: {{VALUE}}',

                ],

            ]

        );

        $this->end_controls_section();

        // Payment Method Heading
        $this->start_controls_section(
            'me_checkout_heading_style',
            array(
                'label' => __('Payment Heading', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_checkout_payment_heading_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} #payment .wc_payment_method label',
            )
        );

        $this->add_control(
            'me_checkout_payment_heading_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #payment .wc_payment_method label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_checkout_payment_heading_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} #payment ul.payment_methods.methods li',
            ]
        );

        $this->add_responsive_control(
            'me_checkout_payment_heading_border_radius',
            [
                'label' => esc_html__('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #payment ul.payment_methods.methods li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_checkout_payment_heading_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #payment ul.payment_methods.methods li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_checkout_payment_heading_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #payment ul.payment_methods.methods li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} #payment .wc_payment_method label' => 'margin: 0;',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_checkout_payment_heading_align',
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
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} #payment ul.payment_methods.methods li' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_checkout_payment_heading_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #payment ul.payment_methods.methods li' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        //Radio Button
        $this->start_controls_section(
            'me_checkout_payment_radio_button_style',
            array(
                'label' => __('Radio Button', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_responsive_control(
            'me_checkout_payment_radio_button_alignment',
            [
                'label' => __('Text Alignment', 'masterelements'),
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
                    '{{WRAPPER}} input[type="radio"], input[type="checkbox"] ' => 'float: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'me_checkout_payment_radio_button_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  input[type="radio"], input[type="checkbox"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important',
                ],
            ]
        );

        $this->end_controls_section();
        // Payment Content
        $this->start_controls_section(
            'me_checkout_payment_content_style',
            array(
                'label' => __('Content', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_checkout_payment_content_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} #payment .payment_box',
            )
        );

        $this->add_control(
            'me_checkout_payment_content_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #payment .payment_box' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_checkout_payment_content_padding',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} #payment .payment_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'me_checkout_payment_content_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #payment .payment_box' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} #payment div.payment_box::before, {{WRAPPER}} #payment div.payment_box::before' => 'border-color:transparent transparent {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_checkout_payment_content_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} #payment .payment_box',
            ]
        );

        $this->add_responsive_control(
            'me_checkout_payment_content_border_radius',
            [
                'label' => esc_html__('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #payment .payment_box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Terms & Conditions Text
        $this->start_controls_section(
            'me_checkout_payment_terms_style',
            array(
                'label' => __('Terms & Conditions Text', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('me_checkout_payment_terms_style_tabs');

        $this->start_controls_tab(
            'me_checkout_payment_terms_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_checkout_payment_terms_text_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} span.woocommerce-terms-and-conditions-checkbox-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'me_checkout_payment_terms_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}span.woocommerce-terms-and-conditions-checkbox-text' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_checkout_payment_terms_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} span.woocommerce-terms-and-conditions-checkbox-text',
            ]
        );

        $this->add_responsive_control(
            'me_checkout_payment_terms_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} span.woocommerce-terms-and-conditions-checkbox-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_checkout_payment_terms_typography',
                'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} aspan.woocommerce-terms-and-conditions-checkbox-text',
            ]
        );

        $this->add_responsive_control(
            'me_checkout_payment_terms_text_alignment',
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
                    '{{WRAPPER}} span.woocommerce-terms-and-conditions-checkbox-text' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_checkout_payment_terms_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} span.woocommerce-terms-and-conditions-checkbox-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_checkout_payment_terms_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} span.woocommerce-terms-and-conditions-checkbox-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_tab();
        // Terms hover style
        $this->start_controls_tab(
            'me_checkout_payment_terms_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );
        $this->add_control(
            'me_checkout_payment_terms_hover_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}span.woocommerce-terms-and-conditions-checkbox-text:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'me_checkout_payment_terms_hover_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}span.woocommerce-terms-and-conditions-checkbox-text:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_checkout_payment_terms_hover_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} span.woocommerce-terms-and-conditions-checkbox-text:hover',
            ]
        );

        $this->end_controls_tabs();
        $this->end_controls_section();
        // Payment Place Order Button
        $this->start_controls_section(
            'me_checkout_payment_place_order_style',
            array(
                'label' => __('Place Order Button', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('checkout_payment_place_order_style_tabs');

        // Plece order button normal
        $this->start_controls_tab(
            'me_checkout_payment_place_order_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_checkout_payment_place_order_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} #payment #place_order',
            )
        );

        $this->add_control(
            'me_checkout_payment_place_order_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #payment #place_order' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_checkout_payment_place_order_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #payment #place_order' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'me_checkout_payment_place_order_alignment',
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
                    '{{WRAPPER}} #payment #place_order' => 'float: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'me_checkout_payment_place_order_button_width',
            [
                'label' => __('Place Order Button Width', 'masterelements'),
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
                    '{{WRAPPER}} #payment #place_order' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'me_checkout_payment_place_order_button_align',
            [
                'label' => __('Button Text Alignment', 'masterelements'),
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
                    '{{WRAPPER}} #payment #place_order' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'me_checkout_payment_place_order_padding',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} #payment #place_order' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_checkout_payment_place_order_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} #payment #place_order',
            ]
        );

        $this->add_responsive_control(
            'me_checkout_payment_place_order_border_radius',
            [
                'label' => esc_html__('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} #payment #place_order' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_checkout_payment_place_order_box_shadow',
                'selector' => '{{WRAPPER}} #payment #place_order',
            ]

        );

        $this->end_controls_tab();

        // Plece order button hover
        $this->start_controls_tab(
            'me_checkout_payment_place_order_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_checkout_payment_place_order_hover_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #payment #place_order:hover' => 'color: {{VALUE}}; transition:0.4s;',
                ],
            ]
        );

        $this->add_control(
            'me_checkout_payment_place_order_hover_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #payment #place_order:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_checkout_payment_place_order_hover_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} #payment #place_order:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    /**
     * WooCommerce Actions and Filters Used in this Function
     */
    protected function render()
    {
        $master_woo_payments = new Master_Woocommerce_Functions();
        $settings = $this->get_settings_for_display();

        if ($master_woo_payments::mw_is_is_edit_mode()) {

            if (!$master_woo_payments::mw_is_ajax()) {
                $master_woo_payments::mw_add_action('woocommerce_review_order_before_payment');
            }

            $master_woo_payments::mw_checkout_payments();

            if (!$master_woo_payments::mw_is_ajax()) {
                $master_woo_payments::mw_add_action('woocommerce_review_order_after_payment');
            }

        } else {
            if ($master_woo_payments::mw_checkout()) {
                $master_woo_payments::mw_add_action('woocommerce_review_order_before_payment');
                $master_woo_payments::mw_checkout_payments();
                $master_woo_payments::mw_add_action('woocommerce_review_order_after_payment');
            }
        }
    }
}