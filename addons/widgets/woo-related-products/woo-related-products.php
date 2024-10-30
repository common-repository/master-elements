<?php

namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;

if (!defined('ABSPATH')) exit;

class Master_Woo_Related_Products extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $arguments = null)
    {

        parent::__construct($data, $arguments);

    }


    public function get_name()
    {
        return 'woo-related-products';
    }

    public function get_title()
    {
        return __('MW: Related Products', 'masterelements');
    }

    public function get_categories()
    {
        return array('master-addons');
    }

    public function get_icon()
    {
        return 'eicon-product-related';
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'me_product_related_section_content',
            array(
                'label' => __('Product Related', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'me_related_products_posts_per_page',
            [
                'label' => __('Products Per Page', 'masterelements'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
                'range' => [
                    'px' => [
                        'max' => 20,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'me_related_products_columns',
            [
                'label' => __('Columns', 'masterelements'),
                'type' => Controls_Manager::NUMBER,
                'prefix_class' => 'masterelementproducts-columns%s-',
                'default' => 4,
                'min' => 1,
                'max' => 12,
            ]
        );

        $this->add_control(
            'me_related_product_title_color',
            [
                'label' => __('Title Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .products > h2, {{WRAPPER}} .products >h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'product_title_typography',
                'label' => __('Title Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .products > h2, {{WRAPPER}} .products >h3',
            )
        );

        $this->end_controls_section();

    }

    /**
     * WooCommerce Classes, Actions and Filters Used in this Function
     */
    protected function render()
    {

        global $product;
        $post_type = get_post_type();
        $get_settings = $this->get_settings_for_display();
        $master_related_products = new Master_Woocommerce_Functions();
        $product = $master_related_products::mw_wc_get_product();

        if ('product' == $post_type) {

            $arguments = [
                'me_related_products_posts_per_page' => 4,
                'me_related_products_columns' => 4,
                //'orderby' => $get_settings['orderby'],
                //'order' => $get_settings['order'],
            ];

            if (!empty($get_settings['me_related_products_posts_per_page'])) {
                $arguments['me_related_products_posts_per_page'] = $get_settings['me_related_products_posts_per_page'];
            }

            if (!empty($get_settings['me_related_products_columns'])) {
                $arguments['me_related_products_columns'] = $get_settings['me_related_products_columns'];
            }


            $arguments['related_products'] = array_filter(array_map('wc_get_product', wc_get_related_products($master_related_products::mw_wc_get_product()->get_id(),

                $arguments['me_related_products_posts_per_page'], $master_related_products::mw_wc_get_product()->get_upsell_ids())), 'wc_products_array_filter_visible');

            //$arguments['related_products'] = wc_products_array_orderby($arguments['related_products'], $arguments['orderby'], $arguments['order']);

            $master_related_products::mw_get_templates('single-product/related.php', $arguments);

        } else if ($master_related_products::mw_is_is_edit_mode()) {
            echo '<div class="woocommerce"><div class="product-related-placeholder me-widget-related">';
            echo '<h2 class="me-related-products-title">' . __('Related Products', 'masterelements') . '</h2>';
            echo '<h5 class="me-related-products-sub">' . __('Related Products Will Be Shown Here.', 'masterelements') . '</h5>';
            echo '</div></div>';
        }
    }
}