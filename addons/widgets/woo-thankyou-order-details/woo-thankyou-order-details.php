<?php
namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;

if ( ! defined( 'ABSPATH' ) ) exit;

class Master_Woo_Thankyou_Order_Details extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);

    }

    public function get_name()
    {
        return 'woo-thankyou-order-details';
    }

    public function get_title()
    {
        return __('MW: Thankyou Order Details', 'masterelements');
    }

    public function get_categories()
    {
        return array('master-addons');
    }

    public function get_icon()
    {
        return 'eicon-woocommerce';
    }

    protected function _register_controls() {

        // Heading
        $this->start_controls_section(
            'me_order_details_heading_style',
            array(
                'label' => __( 'Order Details Heading', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs( 'me_order_details_style_tabs' );

        // Heading Normal Style

        $this->start_controls_tab(
            'me_order_details_normal',
            [
                'label' => __( 'Normal', 'masterelements' ),
            ]
        );

        $this->add_control(
            'me_order_details_heading_color',
            [
                'label' => __( 'Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_order_details_bg_color',
            [
                'label' => __( 'Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_order_details_heading_typography',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_order_details_border',

                'label' => __( 'Border', 'masterelements' ),

                'selector' => '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title',
            ]
        );



        $this->add_responsive_control(
            'me_order_details_border_radius',
            [

                'label' => __( 'Border Radius', 'masterelements' ),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => [ 'px', 'em', '%' ],

                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_order_details_heading_margin',
            [
                'label' => __( 'Margin', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_order_details_heading_padding',
            [
                'label' => __( 'Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_order_details_heading_align',
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
                'default'      => 'left',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_order_details_hover',
            [
                'label' => __( 'Hover', 'masterelements' ),
            ]
        );
        $this->add_control(
            'me_order_details_heading_color_hover',
            [
                'label' => __( 'Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_order_details_bg_color_hover',
            [
                'label' => __( 'Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_order_details_heading_typography_hover',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title:hover',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_order_details_border_hover',

                'label' => __( 'Border', 'masterelements' ),

                'selector' => '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title:hover',
            ]
        );



        $this->add_responsive_control(
            'me_order_details_border_radius_hover',
            [

                'label' => __( 'Border Radius', 'masterelements' ),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => [ 'px', 'em', '%' ],

                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .woocommerce-order-details__title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tabs();
        $this->end_controls_section();

        // Table Content
        $this->start_controls_section(
            'me_order_details_table_content_style',
            array(
                'label' => __( 'Order Details Table Content', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'me_order_details_all_table_heading',
            [
                'label' => __( 'All Table Headings', 'masterelements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );
        $this->start_controls_tabs( 'me_order_details_all_table_heading_style_tabs' );

        // Heading Normal Style

        $this->start_controls_tab(
            'me_order_details_all_table_heading_normal',
            [
                'label' => __( 'Normal', 'masterelements' ),
            ]
        );
        $this->add_control(
            'me_order_details_all_table_heading_color',
            [
                'label' => __( 'Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .order_details th' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce-order-details .order_details tfoot td' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_order_details_all_table_heading_bg_color',
            [
                'label' => __( 'Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .order_details th' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce-order-details .order_details tfoot td' => 'background-color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_order_details_all_table_heading_typography',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .woocommerce-order-details .order_details th, {{WRAPPER}} .woocommerce-order-details .order_details tfoot td',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_order_details_all_table_heading_border',

                'label' => __( 'Border', 'masterelements' ),

                'selector'  => '{{WRAPPER}} .woocommerce-order-details .order_details th, {{WRAPPER}} .woocommerce-order-details .order_details tfoot td',
            ]
        );

        $this->add_responsive_control(
            'order_details_table_heading_padding',
            [
                'label' => __( 'Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .order_details th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} {{WRAPPER}} .woocommerce-order-details .order_details tfoot td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_order_details_all_table_heading_hover',
            [
                'label' => __( 'Hover', 'masterelements' ),
            ]
        );

        $this->add_control(
            'me_order_details_all_table_heading_color_hover',
            [
                'label' => __( 'Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .order_details th:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce-order-details .order_details tfoot td:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_order_details_all_table_heading_bg_color_hover',
            [
                'label' => __( 'Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .order_details th:hover' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce-order-details .order_details tfoot td:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_order_details_all_table_heading_typography_hover',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .woocommerce-order-details .order_details th:hover, {{WRAPPER}} .woocommerce-order-details .order_details tfoot td:hover',
            )
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_order_details_all_table_heading_border_hover',

                'label' => __( 'Border', 'masterelements' ),

                'selector'  => '{{WRAPPER}} .woocommerce-order-details .order_details th:hover, {{WRAPPER}} .woocommerce-order-details .order_details tfoot td:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'me_order_details_table_content_heading',
            [
                'label' => __( 'Table Content', 'masterelements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $this->start_controls_tabs( 'me_order_details_table_content_price_style_tabs' );

        // Billing/Shipping Address Heading Normal Style

        $this->start_controls_tab(
            'me_order_details_table_content_normal',
            [
                'label' => __( 'Price Normal', 'masterelements' ),
            ]
        );

        $this->add_responsive_control(
            'me_order_details_table_content_align',
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
                'default'      => 'center',
                'selectors' => [
                    '{{WRAPPER}} table.woocommerce-table.woocommerce-table--order-details.shop_table.order_details' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_order_details_table_content_color',
            [
                'label' => __( 'Price Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} td.woocommerce-table__product-total.product-total' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_order_details_table_content_bg_color',
            [
                'label' => __( 'Price Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} td.woocommerce-table__product-total.product-total' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_order_details_table_content_typography',
                'label'     => __( 'Price Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} td.woocommerce-table__product-total.product-total',
            )
        );
        $this->add_responsive_control(
            'me_order_details_table_content_padding',
            [
                'label' => __( 'Price Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} td.woocommerce-table__product-total.product-total' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_order_details_table_content_hover',
            [
                'label' => __( 'Price Hover', 'masterelements' ),
            ]
        );
        $this->add_control(
            'me_order_details_table_content_color_hover',
            [
                'label' => __( 'Price Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} td.woocommerce-table__product-total.product-total:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_order_details_table_content_bg_color_hover',
            [
                'label' => __( 'Price Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} td.woocommerce-table__product-total.product-total:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'order_details_table_content_typography_hover',
                'label'     => __( 'Price Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} td.woocommerce-table__product-total.product-total:hover',
                'separator' => 'after',
            )
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->start_controls_tabs( 'me_order_details_table_content_products_style_tabs' );

        // Billing/Shipping Address Content Normal Style

        $this->start_controls_tab(
            'me_order_details_table_content_products_normal',
            [
                'label' => __( 'Products Normal', 'masterelements' ),
            ]
        );

        $this->add_control(
            'me_order_details_table_content_products_color',
            [
                'label' => __( 'Products Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .order_details td a' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .woocommerce-order-details .order_details td strong' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_order_details_all_table_product_heading_border',

                'label' => __( 'Product Name Border', 'masterelements' ),

                'selector'  => '{{WRAPPER}} .shop_table tr.woocommerce-table__line-item.order_item',
            ]
        );

        $this->add_control(
            'me_order_details_table_content_products_bg_color',
            [
                'label' => __( 'Products Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} td.woocommerce-table__product-name.product-name' => 'background-color: {{VALUE}}',
                    //'{{WRAPPER}} .woocommerce-order-details .order_details td strong' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_order_details_table_content_products_typography',
                'label'     => __( 'Products Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .woocommerce-order-details .order_details td, {{WRAPPER}} .woocommerce-order-details .order_details td strong',
                'separator' => 'after',
            )
        );
        $this->add_responsive_control(
            'me_order_details_table_content_products_padding',
            [
                'label' => __( 'Products Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .order_details td a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .woocommerce-order-details .order_details td strong' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_order_details_table_content_products_hover',
            [
                'label' => __( 'Products Hover', 'masterelements' ),
            ]
        );
        $this->add_control(
            'me_order_details_table_content_products_color_hover',
            [
                'label' => __( 'Products Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-order-details .order_details td a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_order_details_all_table_product_heading_border_hover',

                'label' => __( 'Product Name Border', 'masterelements' ),

                'selector'  => '{{WRAPPER}} .shop_table tr.woocommerce-table__line-item.order_item:hover',
            ]
        );

        $this->add_control(
            'me_order_details_table_content_products_bg_color_hover',
            [
                'label' => __( 'Products Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} td.woocommerce-table__product-name.product-name:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_order_details_table_content_products_typography_hover',
                'label'     => __( 'Products Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .woocommerce-order-details .order_details td:hover, {{WRAPPER}} .woocommerce-order-details .order_details td strong:hover',
                'separator' => 'after',
            )
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
        $master_thankyou_order_details = new Master_Woocommerce_Functions();
        $order_received = $wp->query_vars['order-received'];
        if (isset($order_received)) {
            $received_order_id = $order_received;
        } else {
            global $wpdb;
            $order_status = array_keys($master_thankyou_order_details::mw_wc_get_order_statuses());
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

        $order = $master_thankyou_order_details::mw_wc_get_order($received_order_id);
        $order_id = $order->get_id();


        if (!$order = wc_get_order($order_id)) {
            return;
        }

        $order_items = $master_thankyou_order_details::mw_wc_get_order($received_order_id)->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
        $show_purchase_note = $master_thankyou_order_details::mw_wc_get_order($received_order_id)->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
        $show_customer_details = $master_thankyou_order_details::mw_is_user_logged_in() && $master_thankyou_order_details::mw_wc_get_order($received_order_id)->get_user_id() === get_current_user_id();
        $downloads = $master_thankyou_order_details::mw_wc_get_order($received_order_id)->get_downloadable_items();
        $show_downloads = $master_thankyou_order_details::mw_wc_get_order($received_order_id)->has_downloadable_item() && master_thankyou_order_details::mw_wc_get_order($received_order_id)->is_download_permitted();

        if ($show_downloads) {
            wc_get_template('order/order-downloads.php', array('downloads' => $downloads, 'show_title' => true));
        }

        ?>
        <section class="woocommerce-order-details">
            <?php do_action('woocommerce_order_details_before_order_table', $order); ?>

            <h2 class="woocommerce-order-details__title"><?php esc_html_e('Order details', 'masterelements'); ?></h2>

            <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

                <thead>
                <tr>
                    <th class="woocommerce-table__product-name product-name"><?php esc_html_e('Product', 'masterelements'); ?></th>
                    <th class="woocommerce-table__product-table product-total"><?php esc_html_e('Total', 'masterelements'); ?></th>
                </tr>
                </thead>

                <tbody>
                <?php
                do_action('woocommerce_order_details_before_order_table_items', $order);

                foreach ($order_items as $item_id => $item) {
                    $product = $item->get_product();
                    $master_thankyou_order_details::mw_get_templates('order/order-details-item.php', array(
                        'order' => $order,
                        'item_id' => $item_id,
                        'item' => $item,
                        'show_purchase_note' => $show_purchase_note,
                        'purchase_note' => $product ? $product->get_purchase_note() : '',
                        'product' => $product,
                    ));
                }

                do_action('woocommerce_order_details_after_order_table_items', $master_thankyou_order_details::mw_wc_get_order($received_order_id));
                ?>
                </tbody>

                <tfoot>
                <?php
                foreach ($master_thankyou_order_details::mw_wc_get_order($received_order_id)->get_order_item_totals() as $key => $total) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $total['label']; ?></th>
                        <td><?php echo ('payment_method' === $key) ? esc_html($total['value']) : $total['value']; ?></td>
                    </tr>
                    <?php
                }
                ?>
                <?php if ($master_thankyou_order_details::mw_wc_get_order($received_order_id)->get_customer_note()) : ?>
                    <tr>
                        <th><?php esc_html_e('Note:', 'masterelements'); ?></th>
                        <td><?php echo wptexturize($master_thankyou_order_details::mw_wc_get_order($received_order_id)->get_customer_note()); ?></td>
                    </tr>
                <?php endif; ?>
                </tfoot>
            </table>

            <?php do_action('woocommerce_order_details_after_order_table', $master_thankyou_order_details::mw_wc_get_order($received_order_id)); ?>
        </section>

        <?php
    }
}