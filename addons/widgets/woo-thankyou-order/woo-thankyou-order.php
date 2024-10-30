<?php

namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;

if (!defined('ABSPATH')) exit;

class Master_Woo_Thankyou_Order extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);

    }

    public function get_name()
    {
        return 'woo-thankyou-order';
    }

    public function get_title()
    {
        return __('MW: Thankyou Order', 'masterelements');
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

        $this->start_controls_section(
            'mw_order_thankyou_content',
            [
                'label' => __('Thank you order', 'masterelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'mw_order_thankyou_message',
            [
                'label' => __('Thank you message', 'masterelements'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Thank you. Your order has been received.', 'masterelements'),
            ]
        );

        $this->end_controls_section();

        // Order Thankyou Message
        $this->start_controls_section(
            'mw_order_thankyou_message_style',
            array(
                'label' => __('Thank You Message', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'mw_order_thankyou_message_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-thankyou-order-received' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'mw_order_thankyou_message_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-thankyou-order-received',
            )
        );

        $this->add_responsive_control(
            'mw_order_thankyou_message_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-thankyou-order-received' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mw_order_thankyou_message_align',
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
                    '{{WRAPPER}} .woocommerce-thankyou-order-received' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Order Thankyou Label
        $this->start_controls_section(
            'mw_order_thankyou_label_style',
            array(
                'label' => __('Order Label', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'mw_order_thankyou_label_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ul.order_details li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'mw_order_thankyou_label_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} ul.order_details li',
            )
        );

        $this->add_responsive_control(
            'mw_order_thankyou_label_align',
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
                    '{{WRAPPER}} ul.order_details li' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Order Thankyou Details
        $this->start_controls_section(
            'mw_order_thankyou_details_style',
            array(
                'label' => __('Order Details', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'mw_order_thankyou_details_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ul.order_details li strong' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'mw_order_thankyou_details_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} ul.order_details li strong',
            )
        );

        $this->add_responsive_control(
            'mw_order_thankyou_details_align',
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
                    '{{WRAPPER}} ul.order_details li strong' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * WooCommerce Classes, Actions and Filters Used in this Function
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        global $wp;
        $master_thankyou_order = new Master_Woocommerce_Functions();
        $thankyou_message = $settings['order_thankyou_message'];

        if (isset($wp->query_vars['order-received'])) {
            $received_order_id = $wp->query_vars['order-received'];
        } else {
            global $wpdb;
            $order_status = array_keys($master_thankyou_order::mw_wc_get_order_statuses());
            $order_status = implode("','", $order_status);


            $order_result = $wpdb->get_col("
            SELECT MAX(ID) FROM {$wpdb->prefix}posts
            WHERE post_type LIKE 'shop_order'
            AND post_status IN ('$order_status')"
            );
            $received_order_id = reset($order_result);
        }


        ?>

        <?php if ($master_thankyou_order::mw_wc_get_order($received_order_id)) : ?>

        <?php if ($master_thankyou_order::mw_wc_get_order($received_order_id)->has_status('failed')) : ?>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'masterelements'); ?></p>

            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url($master_thankyou_order::mw_wc_get_order($received_order_id)->get_checkout_payment_url()); ?>"
                   class="button pay"><?php esc_html_e('Pay', 'masterelements') ?></a>
                <?php if (is_user_logged_in()) : ?>
                    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                       class="button pay"><?php esc_html_e('My account', 'masterelements'); ?></a>
                <?php endif; ?>
            </p>

        <?php else : ?>

            <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', $thankyou_message, $master_thankyou_order::mw_wc_get_order($received_order_id)); ?></p>

            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                <li class="woocommerce-order-overview__order order">
                    <?php esc_html_e('Order number:', 'masterelements'); ?>
                    <strong><?php echo $master_thankyou_order::mw_wc_get_order($received_order_id)->get_order_number(); ?></strong>
                </li>

                <li class="woocommerce-order-overview__date date">
                    <?php esc_html_e('Date:', 'masterelements'); ?>
                    <strong><?php echo wc_format_datetime($master_thankyou_order::mw_wc_get_order($received_order_id)->get_date_created()); ?></strong>
                </li>

                <?php if (is_user_logged_in() && $master_thankyou_order::mw_wc_get_order($received_order_id)->get_user_id() === get_current_user_id() && $master_thankyou_order::mw_wc_get_order($received_order_id)->get_billing_email()) : ?>
                    <li class="woocommerce-order-overview__email email">
                        <?php esc_html_e('Email:', 'masterelements'); ?>
                        <strong><?php echo $master_thankyou_order::mw_wc_get_order($received_order_id)->get_billing_email(); ?></strong>
                    </li>
                <?php endif; ?>

                <li class="woocommerce-order-overview__total total">
                    <?php esc_html_e('Total:', 'masterelements'); ?>
                    <strong><?php echo $master_thankyou_order::mw_wc_get_order($received_order_id)->get_formatted_order_total(); ?></strong>
                </li>

                <?php if ($master_thankyou_order::mw_wc_get_order($received_order_id)->get_payment_method_title()) : ?>
                    <li class="woocommerce-order-overview__payment-method method">
                        <?php esc_html_e('Payment method:', 'masterelements'); ?>
                        <strong><?php echo wp_kses_post($master_thankyou_order::mw_wc_get_order($received_order_id)->get_payment_method_title()); ?></strong>
                    </li>
                <?php endif; ?>

            </ul>

        <?php endif; ?>

        <?php do_action('woocommerce_thankyou_' . $master_thankyou_order::mw_wc_get_order($received_order_id)->get_payment_method(), $master_thankyou_order::mw_wc_get_order($received_order_id)->get_id()); ?>

    <?php else : ?>

        <p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters('woocommerce_thankyou_order_received_text', $thankyou_message, null); ?></p>

    <?php endif; ?>

        <?php
    }

}