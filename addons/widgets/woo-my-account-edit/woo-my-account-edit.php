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

class Master_Woo_My_Account_Edit extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);

    }

    public function get_name()
    {
        return 'woo-my-account-edit';
    }

    public function get_title()
    {
        return __('MW: My Account Edit', 'masterelements');
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

        // Label
        $this->start_controls_section(
            'me_myaccount_labels_style',
            array(
                'label' => __('Label', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('me_myaccount_labels_style_tabs');
        // Label Normal Style

        $this->start_controls_tab(

            'me_myaccount_labels_normal',

            [

                'label' => __('Normal', 'masterelements'),

            ]

        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_myaccount_labels_typography',
                'label' => __('Form Label Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-EditAccountForm label',
            )
        );
        $this->add_control(
            'me_myaccount_labels_color',
            [
                'label' => __('Form Label Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm label' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'me_myaccount_labels_required_color',
            [
                'label' => __('Required Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm label .required' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'me_myaccount_labels_align',
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
                    '{{WRAPPER}} .woocommerce-EditAccountForm label' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(

            'me_myaccount_labels_hover',

            [

                'label' => __('Hover', 'masterelements'),

            ]

        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_myaccount_labels_typography_hover',
                'label' => __('Form Label Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-EditAccountForm label:hover',
            )
        );
        $this->add_control(
            'me_myaccount_labels_color_hover',
            [
                'label' => __('Form Label Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm label:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();

        // Input box
        $this->start_controls_section(
            'me_myaccount_input_box_style',
            array(
                'label' => __('Input Box', 'masterelementss'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->add_control(
            'me_myaccount_input_box_text_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm input' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_myaccount_input_box_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-EditAccountForm input',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_myaccount_input_box_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-EditAccountForm input',
            ]
        );

        $this->add_responsive_control(
            'me_myaccount_box_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_myaccount_input_box_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_myaccount_input_box_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Password Change Heading
        $this->start_controls_section(
            'me_myaccount_password_heading_style',
            array(
                'label' => __('Password Change Style', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('me_myaccount_password_heading_style_tabs');

        $this->start_controls_tab(
            'me_myaccount_password_heading_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_myaccount_password_heading_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} legend',
            )
        );

        $this->add_control(
            'me_myaccount_password_heading_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} legend' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_myaccount_password_heading_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} legend' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_myaccount_password_heading_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} legend',
            ]
        );

        $this->add_responsive_control(
            'me_myaccount_password_heading_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} legend' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_myaccount_password_heading_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} legend' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_myaccount_password_heading_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_myaccount_password_heading_typography_hover',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} legend:hover',
            )
        );

        $this->add_control(
            'me_myaccount_password_heading_color_hover',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} legend:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_myaccount_password_heading_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} legend:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_myaccount_password_heading_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} legend:hover',
            ]
        );

        $this->add_responsive_control(
            'me_myaccount_password_heading_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} legend:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_section();

        $this->end_controls_tabs();

        // Button
        $this->start_controls_section(
            'me_myaccount_button_style',
            array(
                'label' => __('Button', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('form_button_style_tabs');

        $this->start_controls_tab(
            'me_myaccount_button_style_normal_tab',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_myaccount_button_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-EditAccountForm .woocommerce-Button',
            )
        );

        $this->add_control(
            'me_myaccount_button_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm .woocommerce-Button' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_myaccount_button_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm .woocommerce-Button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_myaccount_button_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm .woocommerce-Button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_myaccount_button_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-EditAccountForm .woocommerce-Button',
            ]
        );

        $this->add_responsive_control(
            'me_myaccount_button_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm .woocommerce-Button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_myaccount_button_box_shadow',

                'selector' => '{{WRAPPER}} .woocommerce-EditAccountForm .woocommerce-Button',

            ]
        );

        $this->end_controls_tab();

        // Hover
        $this->start_controls_tab(
            'me_myaccount_button_style_hover_tab',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_myaccount_button_hover_color',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm .woocommerce-Button:hover' => 'color: {{VALUE}}; transition:0.4s;',
                ],
            ]
        );

        $this->add_control(
            'me_myaccount_button_hover_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-EditAccountForm .woocommerce-Button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_myaccount_button_hover_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-EditAccountForm .woocommerce-Button:hover',
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    /**
     * WooCommerce Actions and Filters Used in this Function
     */
    protected function render()
    {
        $mwf = new Master_Woocommerce_Functions();
        if ($mwf::mw_is_is_edit_mode()) {
            $mwf::mw_add_action('woocommerce_account_edit-account_endpoint');

        } else {
            if (!$mwf::mw_is_user_logged_in()) {
                return __('You need first to be logged in', 'masterelements');
            }
            $mwf::mw_add_action('woocommerce_account_edit-account_endpoint');
        }
    }
}