<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Embed;
use Elementor\Plugin;
use WooCommerce\Functions;
use MasterElements\Master_Woocommerce_Functions;


if (!defined('ABSPATH')) exit;

class Master_Woo_Checkout_Billing extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);

    }

    public function get_name()
    {
        return 'woo-checkout-billing';
    }

    public function get_title()
    {
        return __('MW: Checkout Billing', 'masterelements');
    }

    public function get_categories()
    {
        return array('master-addons');
    }

    public function get_icon()
    {
        return 'eicon-form-horizontal';
    }

    protected function _register_controls()
    {

        // Heading
        $this->start_controls_section(
            'me_form_heading_style',
            array(
                'label' => __('Heading', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_form_heading_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-billing-fields > h3',
            )
        );

        $this->add_control(
            'me_form_heading_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-billing-fields > h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_form_heading_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-billing-fields > h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_form_heading_align',
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
                    '{{WRAPPER}} .woocommerce-billing-fields > h3' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Form label
        $this->start_controls_section(
            'me_form_label_style',
            array(
                'label' => __('Label', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_form_label_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-billing-fields .form-row label',
            )
        );

        $this->add_control(
            'me_form_label_color',
            [
                'label' => __('Label Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-billing-fields .form-row label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_form_label_required_color',
            [
                'label' => __('Required Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-billing-fields .form-row label abbr' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_form_label_padding',
            [
                'label' => esc_html__('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-billing-fields .form-row label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_form_label_align',
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
                    '{{WRAPPER}} .woocommerce-billing-fields .form-row label' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        // Input box
        $this->start_controls_section(
            'me_form_input_box_style',
            array(
                'label' => esc_html__('Input Box', 'masterelementss'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'me_form_input_box_text_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-billing-fields input.input-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_form_input_box_typography',
                'label' => esc_html__('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-billing-fields input.input-text, {{WRAPPER}} .form-row select, {{WRAPPER}} .form-row .select2-container .select2-selection,  {{WRAPPER}} .form-row .select2-container .select2-selection .select2-selection__rendered',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_form_input_box_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-billing-fields input.input-text, {{WRAPPER}} .form-row select, {{WRAPPER}} .form-row .select2-container .select2-selection',
            ]
        );

        $this->add_responsive_control(
            'me_form_input_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-billing-fields input.input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .form-row select, {{WRAPPER}} .form-row .select2-container .select2-selection' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_form_input_box_padding',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-billing-fields input.input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .form-row select, {{WRAPPER}} .form-row .select2-container .select2-selection' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; box-sizing: content-box;',
                    '{{WRAPPER}} .form-row .select2-container .select2-selection .select2-selection__arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} 0; box-sizing: content-box;',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_form_input_box_margin',
            [
                'label' => esc_html__('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-billing-fields input.input-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $master_checkout = new Master_Woocommerce_Functions();
        if ($master_checkout::mw_checkout()) {
            $me_checkout = $master_checkout::mw_wc_checkout();
            if (sizeof($me_checkout->checkout_fields) > 0) :
                echo '<div id="me-checkout-billing">';
                $master_checkout::mw_add_action('woocommerce_checkout_billing');
                echo '</div>';
            endif;
        } else {
            $me_checkout = $master_checkout::mw_wc_checkout();
            if (sizeof($me_checkout->checkout_fields) > 0) :
                $master_checkout::mw_add_action('woocommerce_checkout_billing');
            endif;
        }
    }
}
