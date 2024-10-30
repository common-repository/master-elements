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

class Master_Woo_My_Account_Login extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)


    {

        parent::__construct($data, $args);

    }

    public function get_name()
    {
        return 'woo-my-account-login';
    }

    public function get_title()
    {
        return __('MW: My Account Login Form', 'masterelements');
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
            'me_login_heading_style',
            array(
                'label' => __('Login Heading', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('me_login_heading_style_tabs');
        // Login Heading Normal Style

        $this->start_controls_tab(

            'me_login_heading_normal',
            [
                'label' => __('Normal', 'masterelements'),

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_login_heading_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form h2',
            )
        );

        $this->add_control(
            'me_login_heading_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_login_heading_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form h2' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_login_heading_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form h2',
            ]
        );

        $this->add_responsive_control(
            'me_login_heading_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form h2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_login_heading_align',
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
                    '{{WRAPPER}} .me-myaccount-login-form h2' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_login_heading_padding',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_login_heading_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(

            'me_login_heading_hover',
            [
                'label' => __('Hover', 'masterelements'),

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_login_heading_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form h2:hover',
            )
        );

        $this->add_control(
            'me_login_heading_color_hover',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form h2:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_login_heading_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form h2:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_login_heading_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form h2:hover',
            ]
        );

        $this->add_responsive_control(
            'me_login_heading_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form h2:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Form label
        $this->start_controls_section(
            'me_form_label_style',
            array(
                'label' => __('Form Labels', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->start_controls_tabs('me_form_label_style_tabs');
        // Form Labels Normal Style

        $this->start_controls_tab(

            'me_form_label_normal',
            [
                'label' => __('Normal', 'masterelements'),

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_form_label_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label',
            )
        );

        $this->add_control(
            'me_form_label_color',
            [
                'label' => __('Label Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_form_label_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_form_label_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label',
            ]
        );

        $this->add_responsive_control(
            'me_form_label_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'me_form_label_required_color',
            [
                'label' => __('Required Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label span.required' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_form_label_margin',
            [
                'label' => esc_html__('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_form_label_padding',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(

            'me_form_label_hover',
            [
                'label' => __('Hover', 'masterelements'),

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_form_label_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label:hover',
            )
        );

        $this->add_control(
            'me_form_label_color_hover',
            [
                'label' => __('Label Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_form_label_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_form_label_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label:hover',
            ]
        );

        $this->add_responsive_control(
            'me_form_label_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login .form-row label:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


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
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login input.input-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_form_input_box_typography',
                'label' => esc_html__('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login input.input-text',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_form_input_box_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login input.input-text',
            ]
        );

        $this->add_responsive_control(
            'me_form_input_box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login input.input-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login input.input-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login input.input-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Button
        $this->start_controls_section(
            'me_form_button_style',
            array(
                'label' => esc_html__('Button', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('form_button_style_tabs');

        $this->start_controls_tab(
            'me_form_button_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_form_button_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form button',
            )
        );

        $this->add_control(
            'me_form_button_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_form_button_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_form_button_padding',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_form_button_margin',
            [
                'label' => esc_html__('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_form_button_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form button',
            ]
        );

        $this->add_responsive_control(
            'me_form_button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_form_button_box_shadow',

                'selector' => '{{WRAPPER}} .me-myaccount-login-form button',

            ]
        );

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'me_form_button_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_form_button_hover_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form button:hover' => 'color: {{VALUE}}; transition:0.4s;',
                ],
            ]
        );

        $this->add_control(
            'me_form_button_hover_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_form_button_hover_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form button:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Lost Password
        $this->start_controls_section(
            'me_form_lostpassword_style',
            array(
                'label' => esc_html__('Lost Password', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('me_form_lostpassword_style_tabs');

        $this->start_controls_tab(
            'me_form_lostpassword_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_form_lostpassword_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form .lost_password a',
            )
        );

        $this->add_control(
            'me_form_lostpassword_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form .lost_password a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_form_lostpassword_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form .lost_password a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_form_lostpassword_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form .lost_password a',
            ]
        );

        $this->add_responsive_control(
            'me_form_lostpassword_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form .lost_password a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_form_lostpassword_padding',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form .lost_password a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_form_lostpassword_margin',
            [
                'label' => esc_html__('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form .lost_password a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Lost Password Hover
        $this->start_controls_tab(
            'me_form_lostpassword_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_form_lostpassword_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form .lost_password a:hover',
            )
        );

        $this->add_control(
            'me_form_lostpassword_hover_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form .lost_password a:hover' => 'color: {{VALUE}}; transition:0.4s;',
                ],
            ]
        );
        $this->add_control(
            'me_form_lostpassword_hover_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form .lost_password a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_form_lostpassword_hover_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form .lost_password a:hover',
            ]
        );

        $this->add_responsive_control(
            'me_form_lostpassword_hover_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form .lost_password a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Form area
        $this->start_controls_section(
            'me_form_area_style',
            array(
                'label' => esc_html__('Form Area', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'me_form_area_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_form_area_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login',
            ]
        );

        $this->add_responsive_control(
            'me_form_area_border_radius',
            [
                'label' => esc_html__('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_form_area_margin',
            [
                'label' => esc_html__('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_form_area_padding',
            [
                'label' => esc_html__('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-myaccount-login-form form.woocommerce-form-login' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],]
        );

        $this->end_controls_section();


    }

    /**
     * WooCommerce Classes, Actions and Filters Used in this Function
     */
    protected function render()
    {
        $mw_account = new Master_Woocommerce_Functions();
        if ($mw_account::mw_is_is_edit_mode()) {
            ?>
            <div class="me-myaccount-login-form">

                <h2><?php esc_html_e('Login', 'masterelements'); ?></h2>

                <form class="woocommerce-form woocommerce-form-login login" method="post">

                    <?php $mw_account::mw_add_action('woocommerce_login_form_start'); ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="username"><?php esc_html_e('Username or email address', 'masterelements'); ?>
                            &nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                               id="username" autocomplete="username"
                               value="<?php echo (!empty($_POST['username'])) ? esc_attr($mw_account::mw_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password"><?php esc_html_e('Password', 'masterelements'); ?>&nbsp;<span
                                    class="required">*</span></label>
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password"
                               name="password" id="password" autocomplete="current-password"/>
                    </p>

                    <?php $mw_account::mw_add_action('woocommerce_login_form'); ?>

                    <p class="form-row">
                        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                        <button type="submit" class="woocommerce-Button button" name="login"
                                value="<?php esc_attr_e('Log in', 'masterelements'); ?>"><?php esc_html_e('Log in', 'masterelements'); ?></button>
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme"
                                   type="checkbox" id="rememberme" value="forever"/>
                            <span><?php esc_html_e('Remember me', 'masterelements'); ?></span>
                        </label>
                    </p>

                    <p class="woocommerce-LostPassword lost_password">
                        <a href="<?php echo esc_url($mw_account::mw_lost_password_url()); ?>"><?php esc_html_e('Lost your password?', 'masterelements'); ?></a>
                    </p>

                    <?php $mw_account::mw_add_action('woocommerce_login_form_end'); ?>

                </form>
            </div>
            <?php
        } else {

            if (!$mw_account::mw_account()) {
                $mw_account::mw_add_action('woocommerce_before_customer_login_form');
            }

            ?>
            <div class="me-myaccount-login-form">

                <h2><?php esc_html_e('Login', 'masterelements'); ?></h2>

                <form class="woocommerce-form woocommerce-form-login login" method="post">

                    <?php $mw_account::mw_add_action('woocommerce_login_form_start'); ?>

                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="username"><?php esc_html_e('Username or email address', 'masterelements'); ?>
                            &nbsp;<span class="required">*</span></label>
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
                               id="username" autocomplete="username"
                               value="<?php echo (!empty($_POST['username'])) ? esc_attr($mw_account::mw_unslash($_POST['username'])) : ''; ?>"/><?php // @codingStandardsIgnoreLine
                        ?>
                    </p>
                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                        <label for="password"><?php esc_html_e('Password', 'masterelements'); ?>&nbsp;<span
                                    class="required">*</span></label>
                        <input class="woocommerce-Input woocommerce-Input--text input-text" type="password"
                               name="password" id="password" autocomplete="current-password"/>
                    </p>

                    <?php $mw_account::mw_add_action('woocommerce_login_form'); ?>

                    <p class="form-row">
                        <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                        <button type="submit" class="woocommerce-Button button" name="login"
                                value="<?php esc_attr_e('Log in', 'masterelements'); ?>"><?php esc_html_e('Log in', 'masterelements'); ?></button>
                        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
                            <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme"
                                   type="checkbox" id="rememberme" value="forever"/>
                            <span><?php esc_html_e('Remember me', 'masterelements'); ?></span>
                        </label>
                    </p>

                    <p class="woocommerce-LostPassword lost_password">
                        <a href="<?php echo esc_url($mw_account::mw_lost_password_url()); ?>"><?php esc_html_e('Lost your password?', 'masterelements'); ?></a>
                    </p>

                    <?php $mw_account::mw_add_action('woocommerce_login_form_end'); ?>

                </form>
            </div>
            <?php
        }
    }
}