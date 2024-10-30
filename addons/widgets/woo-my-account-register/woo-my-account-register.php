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
use MasterElements\Master_Woocommerce_Functions;
use WooCommerce\Functions;

if (!defined('ABSPATH')) exit;

class Master_Woo_My_Account_Register extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)


    {

        parent::__construct($data, $args);

    }

    public function get_name()
    {
        return 'woo-my-account-register';
    }

    public function get_title()
    {
        return __('MW: My Account Registration Form', 'masterelements');
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
            'me_register_form_heading_style',
            array(
                'label' => __('Register Heading', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('me_register_form_heading_style_tabs');
        // Register Heading Normal Style

        $this->start_controls_tab(

            'me_register_form_heading_normal',
            [
                'label' => __('Normal', 'masterelements'),

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_register_form_heading_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register h2',
            )
        );

        $this->add_control(
            'me_register_form_heading_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_register_form_heading_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register h2' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_register_form_heading_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register h2',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_heading_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register h2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_register_form_heading_padding',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_heading_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_register_form_heading_align',
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
                    '{{WRAPPER}} .me-my-account-form-register h2' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(

            'me_register_form_heading_hover',
            [
                'label' => __('Hover', 'masterelements'),

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_register_form_heading_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register h2:hover',
            )
        );

        $this->add_control(
            'me_register_form_heading_color_hover',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register h2:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_register_form_heading_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register h2:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_register_form_heading_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register h2:hover',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_heading_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register h2:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // Form label
        $this->start_controls_section(
            'me_register_form_label_style',
            array(
                'label' => __('Label', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('me_register_form_label_style_tabs');
        // Form Labels Normal Style

        $this->start_controls_tab(

            'me_register_form_label_normal',
            [
                'label' => __('Normal', 'masterelements'),

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_register_form_label_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label',
            )
        );

        $this->add_control(
            'me_register_form_label_color',
            [
                'label' => __('Label Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_register_form_label_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_register_form_label_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_label_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'me_register_form_label_required_color',
            [
                'label' => __('Required Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label span.required' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_register_form_label_padding',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_label_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'me_register_form_label_align',
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
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        // Form Labels Hover Style

        $this->start_controls_tab(

            'me_register_form_label_hover',
            [
                'label' => __('Hover', 'masterelements'),

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_register_form_label_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label:hover',
            )
        );

        $this->add_control(
            'me_register_form_label_color_hover',
            [
                'label' => __('Label Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_register_form_label_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_register_form_label_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label:hover',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_label_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register .form-row label:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // Input box
        $this->start_controls_section(
            'me_register_form_input_box_style',
            array(
                'label' => __('Input Box', 'masterelementss'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'me_register_form_input_box_text_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register input.input-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_register_form_input_box_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register input.input-text',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_register_form_input_box_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register input.input-text',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_input_box_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register input.input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_register_form_input_box_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register input.input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_input_box_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register input.input-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Button
        $this->start_controls_section(
            'me_register_form_button_style',
            array(
                'label' => __('Button', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('form_button_style_tabs');

        $this->start_controls_tab(
            'me_register_form_button_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_register_form_button_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register button',
            )
        );

        $this->add_control(
            'me_register_form_button_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_register_form_button_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_register_form_button_box_shadow',

                'selector' => '{{WRAPPER}} .me-my-account-form-register button',

            ]
        );

        $this->add_responsive_control(
            'me_register_form_button_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_button_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_register_form_button_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register button',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_button_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'me_register_form_button_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_register_form_button_hover_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register button:hover' => 'color: {{VALUE}}; transition:0.4s;',
                ],
            ]
        );

        $this->add_control(
            'me_register_form_button_hover_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_register_form_button_hover_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Form area
        $this->start_controls_section(
            'me_register_form_area_style',
            array(
                'label' => __('Form Area', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'me_register_form_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_register_form_area_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_area_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_register_form_area_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_register_form_area_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register form.woocommerce-form-register' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Privacy policy
        $this->start_controls_section(
            'me_register_form_privacy_style',
            array(
                'label' => __('Privacy policy text', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('me_register_form_privacy_policy_style_tabs');

        $this->start_controls_tab(
            'me_register_form_privacy_policy_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_register_form_privacy_policy_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register .woocommerce-privacy-policy-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .me-my-account-form-register .woocommerce-privacy-policy-text .woocommerce-privacy-policy-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_register_form_privacy_policy_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register .woocommerce-privacy-policy-text',
            )
        );

        $this->add_responsive_control(
            'me_register_form_privacy_policy_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register .woocommerce-privacy-policy-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_register_form_privacy_policy_style_hover_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_register_form_privacy_policy_color_hover',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-my-account-form-register .woocommerce-privacy-policy-text:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .me-my-account-form-register .woocommerce-privacy-policy-text .woocommerce-privacy-policy-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_register_form_privacy_policy_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-my-account-form-register .woocommerce-privacy-policy-text:hover',
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
        $mw_account_register = new Master_Woocommerce_Functions();
        if ($mw_account_register::mw_is_is_edit_mode()) {
            ?>
            <div class="me-my-account-form-register">

                <h2><?php esc_html_e('Register', 'masterelements'); ?></h2>

                <form method="post"
                      class="woocommerce-form woocommerce-form-register register" <?php $mw_account_register::mw_add_action('woocommerce_register_form_tag'); ?> >

                    <?php $mw_account_register::mw_add_action('woocommerce_register_form_start'); ?>

                    <?php if ('no' === $mw_account_register::mw_get_option('woocommerce_registration_generate_username')) : ?>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_username"><?php esc_html_e('Username', 'masterelements'); ?>&nbsp;<span
                                        class="required">*</span></label>
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                                   name="username" id="reg_username" autocomplete="username"
                                   value="<?php echo (!empty($_POST['username'])) ? esc_attr($mw_account_register::mw_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                        </p>

                    <?php endif; ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_email"><?php esc_html_e('Email address', 'masterelements'); ?>&nbsp;<span
                                    class="required">*</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text"
                               name="email" id="reg_email" autocomplete="email"
                               value="<?php echo (!empty($_POST['email'])) ? esc_attr($mw_account_register::mw_unslash($_POST['email'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                    </p>

                    <?php if ('no' === $mw_account_register::mw_get_option('woocommerce_registration_generate_password')) : ?>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_password"><?php esc_html_e('Password', 'masterelements'); ?>&nbsp;<span
                                        class="required">*</span></label>
                            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
                                   name="password" id="reg_password" autocomplete="new-password"/>
                        </p>

                    <?php endif; ?>

                    <?php $mw_account_register::mw_add_action('woocommerce_register_form'); ?>

                    <p class="woocommerce-FormRow form-row">
                        <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                        <button type="submit" class="woocommerce-Button button" name="register"
                                value="<?php esc_attr_e('Register', 'masterelements'); ?>"><?php esc_html_e('Register', 'masterelements'); ?></button>
                    </p>

                    <?php $mw_account_register::mw_add_action('woocommerce_register_form_end'); ?>

                </form>
            </div>
            <?php
        } else {
            if (!$mw_account_register::mw_account()) {
                $mw_account_register::mw_add_action('woocommerce_before_customer_login_form');
            }
            ?>
            <div class="me-my-account-form-register">

                <h2><?php esc_html_e('Register', 'masterelements'); ?></h2>

                <form method="post"
                      class="woocommerce-form woocommerce-form-register register" <?php $mw_account_register::mw_add_action('woocommerce_register_form_tag'); ?> >

                    <?php $mw_account_register::mw_add_action('woocommerce_register_form_start'); ?>

                    <?php if ('no' === $mw_account_register::mw_get_option('woocommerce_registration_generate_username')) : ?>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_username"><?php esc_html_e('Username', 'masterelements'); ?>&nbsp;<span
                                        class="required">*</span></label>
                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
                                   name="username" id="reg_username" autocomplete="username"
                                   value="<?php echo (!empty($_POST['username'])) ? esc_attr($mw_account_register::mw_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                        </p>

                    <?php endif; ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="reg_email"><?php esc_html_e('Email address', 'masterelements'); ?>&nbsp;<span
                                    class="required">*</span></label>
                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text"
                               name="email" id="reg_email" autocomplete="email"
                               value="<?php echo (!empty($_POST['email'])) ? esc_attr($mw_account_register::mw_unslash($_POST['email'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine
                        ?>
                    </p>

                    <?php if ('no' === $mw_account_register::mw_get_option('woocommerce_registration_generate_password')) : ?>

                        <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                            <label for="reg_password"><?php esc_html_e('Password', 'masterelements'); ?>&nbsp;<span
                                        class="required">*</span></label>
                            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
                                   name="password" id="reg_password" autocomplete="new-password"/>
                        </p>

                    <?php endif; ?>

                    <?php $mw_account_register::mw_add_action('woocommerce_register_form'); ?>

                    <p class="woocommerce-FormRow form-row">
                        <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                        <button type="submit" class="woocommerce-Button button" name="register"
                                value="<?php esc_attr_e('Register', 'masterelements'); ?>"><?php esc_html_e('Register', 'masterelements'); ?></button>
                    </p>

                    <?php $mw_account_register::mw_add_action('woocommerce_register_form_end'); ?>

                </form>
            </div>
            <?php

        }
    }
}
