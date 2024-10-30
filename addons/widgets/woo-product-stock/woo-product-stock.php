<?php

namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;

if (!defined('ABSPATH')) exit;

class Master_Woo_Product_Stock extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);

    }


    public function get_name()
    {
        return 'woo-product-stock';
    }

    public function get_title()
    {
        return __('MW: Product Stock', 'masterelements');
    }

    public function get_categories()
    {
        return array('master-addons');
    }

    public function get_icon()
    {
        return 'eicon-product-stock';
    }

    protected function _register_controls()
    {

// Product Price Style
        $this->start_controls_section(
            'me_product_stock_style_section',
            array(
                'label' => __('Style', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'me_product_stock_text_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .stock' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'me_product_stock_text_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '.woocommerce {{WRAPPER}} .stock',
            ]
        );

        $this->add_responsive_control(
            'me_product_stock_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .stock' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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

        $master_product_stock = new Master_Woocommerce_Functions();
        global $product;
        $product = $master_product_stock::mw_wc_get_product();

        if ($master_product_stock::mw_is_is_edit_mode()) {

        } else {
            if (empty($product)) return;

            $get_id = $product->get_id();
            $stock = $master_product_stock::mw_get_stock($get_id);
            echo '<pre>' . print_r($stock['stock_status']) . '</pre>';
            exit();
        }


    }
}