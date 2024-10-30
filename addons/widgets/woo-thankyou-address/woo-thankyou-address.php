<?php

namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;

if (!defined('ABSPATH')) exit;

class Master_Woo_Thankyou_Address extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);


    }

    public function get_name()
    {
        return 'woo-thankyou-address';
    }

    public function get_title()
    {
        return __('MW: Thankyou Customer Address', 'masterelements');
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
            'me_thankyou_address_heading_style',
            array(
                'label' => __('Billing/Shipping Address Heading', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('me_thankyou_address_heading_style_tabs');

        // Billing/Shipping Address Heading Normal Style

        $this->start_controls_tab(
            'me_thankyou_address_heading_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_thankyou_address_heading_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details .woocommerce-column__title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_thankyou_address_heading_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details .woocommerce-column__title' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_thankyou_address_heading_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-customer-details .woocommerce-column__title',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_thankyou_address_heading_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}}  .woocommerce-customer-details .woocommerce-column__title',
            ]
        );

        $this->add_responsive_control(
            'me_thankyou_address_heading_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details .woocommerce-column__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'me_thankyou_address_heading_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details .woocommerce-column__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_thankyou_address_heading_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details .woocommerce-column__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_thankyou_address_heading_align',
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
                    '{{WRAPPER}} .woocommerce-customer-details .woocommerce-column__title' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_thankyou_address_heading_hover',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_thankyou_address_heading_color_hover',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details .woocommerce-column__title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_thankyou_address_heading_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details .woocommerce-column__title:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_thankyou_address_heading_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-customer-details .woocommerce-column__title:hover',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_thankyou_address_heading_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}}  .woocommerce-customer-details .woocommerce-column__title:hover',
            ]
        );

        $this->add_responsive_control(
            '   me_thankyou_address_heading_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details .woocommerce-column__title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'me_thankyou_address_content_style',
            array(
                'label' => __('Billing/Shipping Address Content', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('me_thankyou_address_content_style_tabs');

        // Billing/Shipping Address Content Normal Style

        $this->start_controls_tab(
            'me_thankyou_address_content_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_thankyou_address_content_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details address' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_thankyou_address_content_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details address' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_thankyou_address_content_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-customer-details address',
            )
        );

        $this->add_responsive_control(
            'me_thankyou_address_content_area_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details address' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_thankyou_address_content_area_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-customer-details address',
            ]
        );

        $this->add_responsive_control(
            'me_thankyou_address_content_area_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details address' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_thankyou_address_content_area_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details address' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_thankyou_address_content_align',
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
                    '{{WRAPPER}} .woocommerce-customer-details address' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_thankyou_address_content_hover',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_thankyou_address_content_color_hover',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details address:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_thankyou_address_content_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details address:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_thankyou_address_content_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-customer-details address:hover',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_thankyou_address_content_area_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-customer-details address:hover',
            ]
        );

        $this->add_responsive_control(
            'me_thankyou_address_content_area_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-customer-details address:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

    }

    /**
     * WooCommerce Classes, Actions and Filters Used in this Function
     */
    protected function render()
    {

        global $wp;
        $master_thankyou_address = new Master_Woocommerce_Functions();
        $order_received = $wp->query_vars['order-received'];

        if (isset($order_received)) {
            $received_order_id = $order_received;
        } else {
            global $wpdb;
            $order_status = array_keys($master_thankyou_address::mw_wc_get_order_statuses());
            $order_status = implode("','", $order_status);


            $order_result = $wpdb->get_col("
            SELECT MAX(ID) FROM {$wpdb->prefix}posts
            WHERE post_type LIKE 'shop_order'
            AND post_status IN ('$order_status')"
            );

            $received_order_id = reset($order_result);
        }
        if (!$received_order_id) {
            return;
        }


        $customer_info = $master_thankyou_address::mw_is_user_logged_in() && $master_thankyou_address::mw_wc_get_order($received_order_id)->get_user_id() === $master_thankyou_address::mw_get_current_user_id();
        if ($customer_info) {
            $master_thankyou_address::mw_get_templates('order/order-details-customer.php', array('order' => $master_thankyou_address::mw_wc_get_order($received_order_id)));
        }

    }
}