<?php

namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;

if (!defined('ABSPATH')) exit;

class Master_Woo_Product_Price extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);

    }


    public function get_name()
    {
        return 'woo-product-price';
    }

    public function get_title()
    {
        return __('Woo Product Price', 'masterelements');
    }

    public function get_categories()
    {
        return array('master-addons');
    }

    public function get_icon()
    {
        return 'eicon-product-price';
    }


    protected function _register_controls()
    {

        $this->start_controls_section(
            'me_price_options_section',
            array(
                'label' => __('Price Option', 'masterlements'),
            )
        );

        $this->add_responsive_control(
            'me_price_options',
            [
                'label' => esc_html__('Choose Price Option', 'masterelements-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => '0',
                'options' => [
                    '1' => esc_html__('Show Price', 'masterelements'),
                    '2' => esc_html__('Call for Price', 'masterelements'),
                ],
                'label_block' => true,
            ]

        );
        $this->end_controls_section();

        $this->start_controls_section(
            'me_product_price_section_content',
            array(
                'label' => __('Product Price', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'me_price_options' => '1',
                ],
            )
        );

        $this->add_control(
            'me_product_price_color',
            [
                'label' => __('Price Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_product_price_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .price, {{WRAPPER}} .price .amount',
            )
        );

        $this->add_responsive_control(
            'me_product_price_align',
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
                ],
                'prefix_class' => 'elementor%s-align-',
                'default' => 'left',
            ]
        );

        $this->add_control(
            'me_price_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'me_call_for_price_section_content',
            array(
                'label' => __('Call for Price', 'masterelements'),
                'condition' => [
                    'me_price_options' => '2',
                ],
            )
        );

        $this->add_control(
            'me_call_for_price_button_text',
            [
                'label' => __('Button Text', 'masterelements'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Call For Price', 'masterelements'),
                'placeholder' => __('Call For Price', 'masterelements'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'me_call_for_price_button_phone_number',
            [
                'label' => __('Button Phone Number', 'masterelements'),
                'type' => Controls_Manager::TEXT,
                'default' => __('123-456-7890', 'masterelements'),
                'placeholder' => __('123-456-7890', 'masterelements'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'me_product_price_button_style',
            [
                'label' => __('Button', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'me_price_options' => '2',
                ],
            ]
        );

        $this->start_controls_tabs('me_product_price_button_normal_style_tabs');

        // Button Normal tab
        $this->start_controls_tab(
            'me_product_price_button_normal_style_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_product_price_button_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-call-for-price a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_product_price_button_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-call-for-price a',
            )
        );

        $this->add_control(
            'button_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-call-for-price a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-call-for-price a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-call-for-price a',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .me-call-for-price a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-call-for-price a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        // Button Hover tab
        $this->start_controls_tab(
            'button_hover_style_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-call-for-price a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-call-for-price a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __('Border Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-call-for-price a:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();

    }


    /**
     * This Functions is Taken From WooCommerce
     */
    protected function render()
    {

        $settings = $this->get_settings_for_display();

        global $product;
        $master_product_price = new Master_Woocommerce_Functions();
        $product = $master_product_price::mw_wc_get_product();
        $me_price_options = $this->get_settings_for_display('me_price_options');

        if ($master_product_price::mw_is_is_edit_mode()) {
            if ($me_price_options == '1') {
                echo '<div class="woocommerce"><div class="product"><div class="entry-summary">';
                echo '<p class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>30.00</span></p>';
                echo '</div></div></div>';
            } else {
                $this->add_render_attribute('link_attr', 'href', 'tel:' . $settings['me_call_for_price_button_phone_number']);
                ?>
                <div class="me-call-for-price">
                    <a <?php echo $this->get_render_attribute_string('link_attr'); ?> ><?php echo esc_html__($settings['me_call_for_price_button_text'], 'masterelements'); ?></a>
                </div>
                <?php
            }
        } else {
            if (empty($product)) {
                return;
            }

            if ($me_price_options == '1') {
                echo '<div class="entry-summary">';

                $master_product_price::mw_template_single_price();

                echo '</div>';
            } else {
                $this->add_render_attribute('link_attr', 'href', 'tel:' . $settings['me_call_for_price_button_phone_number']);
                ?>
                <div class="me-call-for-price">
                    <a <?php echo $this->get_render_attribute_string('link_attr'); ?> ><?php echo esc_html__($settings['me_call_for_price_button_text'], 'masterelements'); ?></a>
                </div>
                <?php
            }
        }
    }
}

