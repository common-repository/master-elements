<?php

namespace Elementor;

use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use MasterElements\Master_Woocommerce_Functions;
use WooCommerce\Functions;

if (!defined('ABSPATH')) exit;

class Master_Woo_Product_Description extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);

    }

    public function get_name()
    {
        return 'woo-product-description';
    }

    public function get_title()
    {
        return __('Woo Product Description', 'masterelements');
    }

    public function get_categories()
    {
        return array('master-addons');
    }

    public function get_icon()
    {
        return 'eicon-product-description';
    }

    protected function _register_controls()
    {

        // Product Style
        $this->start_controls_section(
            'me_product_decription_style_section',
            array(
                'label' => __('Style', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_responsive_control(
            'me_product_decription_text_align',
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
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_product_decription_text_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce_product_description' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '.woocommerce {{WRAPPER}} .woocommerce_product_description',
            ]
        );

        $this->end_controls_section();

    }


    /**
     * This Functions & Classes is Taken From WooCommerce
     */
    protected function render()
    {

        global $product, $post;
        $master_des = new Master_Woocommerce_Functions();
        $product = $master_des::mw_wc_get_product();

        if ($master_des::mw_is_is_edit_mode()) {

            echo '<div class="woocommerce"><div class="product">';

            echo '<div class="woocommerce_product_description">
                       <h2><b>Product Description</b><h2>
                        <p>Product Description will be shown here. You can style this text to see what it would look like.</p>
                    </div>';

            echo '</div></div>';
        } else {
            if (empty($product)) {
                return;
            }

            echo '<div class="woocommerce_product_description">' . $post->post_content . '</div>';

        }
    }

}
