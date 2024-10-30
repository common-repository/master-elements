<?php

namespace Elementor;


use MasterElements\Master_Woocommerce_Functions;

if (!defined('ABSPATH')) exit;

class Master_Woo_Products_Data_Tabs extends Widget_Base
{
    private static $product_id = null;

    public function __construct($data = [], $arguments = null)
    {

        parent::__construct($data, $arguments);

        wp_register_style('woo-widgets-css', \MasterElements::widgets_url() . '/woo-product-data-tabs/assets/woo-widgets.css', false, \MasterElements::version);


    }


    public function get_name()
    {
        return 'woo-products-data-tabs';
    }

    public function get_title()
    {
        return __('MW: Products Data Tabs', 'masterelements');
    }

    public function get_categories()
    {
        return array('master-addons');
    }

    public function get_style_depends()
    {
        return [
            'woo-widgets-css',
        ];
    }

    public function get_icon()
    {
        return 'eicon-product-tabs';
    }

    protected function _register_controls()
    {

        // Product Style
        $this->start_controls_section(
            'product_tabs_style_section',
            array(
                'label' => __('Tab Menu', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('data_tabs_style');

        $this->start_controls_tab('normal_data_tab_style',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );

        $this->add_control(
            'tab_text_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tab_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'tab_border_color',
            [
                'label' => __('Border Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs .woocommerce-Tabs-panel' => 'border-color: {{VALUE}}',
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li a',
            ]
        );

        $this->add_control(
            'tab_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li' => 'border-radius: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_text_align',
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
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        // Active Tab style
        $this->start_controls_tab('active_data_tab_style',
            [
                'label' => __('Active', 'masterelements'),
            ]
        );

        $this->add_control(
            'active_tab_text_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li.active a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'active_tab_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs .woocommerce-Tabs-panel, .woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li.active' => 'background-color: {{VALUE}}',
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li.active' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'active_tab_border_color',
            [
                'label' => __('Border Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs .woocommerce-Tabs-panel' => 'border-color: {{VALUE}}',
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li.active' => 'border-color: {{VALUE}} {{VALUE}} {{active_tab_bg_color.VALUE}} {{VALUE}}',
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li:not(.active)' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'active_tab_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li.active a',
            ]
        );

        $this->add_control(
            'active_tab_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-tabs ul.wc-tabs li.active' => 'border-radius: {{SIZE}}{{UNIT}} {{SIZE}}{{UNIT}} 0 0',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Content Style
        $this->start_controls_section(
            'product_data_tab_content_style',
            [
                'label' => __('Content', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_description_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '.woocommerce {{WRAPPER}} .woocommerce-tabs .woocommerce-Tabs-panel',
            ]
        );

        $this->add_control(
            'tab_content_description_color',
            [
                'label' => __('Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-Tabs-panel' => 'color: {{VALUE}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_heading_typography',
                'label' => __('Heading Typography', 'masterelements'),
                'selector' => '.woocommerce {{WRAPPER}} .woocommerce-tabs .woocommerce-Tabs-panel h2',
            ]
        );

        $this->add_control(
            'content_heading_color',
            [
                'label' => __('Heading Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-Tabs-panel h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_heading_margin',
            [
                'label' => __('Heading Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-Tabs-panel h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * WooCommerce Classes, Actions and Filters Used in this Function
     */
    protected function render($instance = [])
    {
        $master_product_data_tabs = new Master_Woocommerce_Functions();
        $settings = $this->get_settings_for_display();

        if ($master_product_data_tabs::mw_is_is_edit_mode()) {
            echo '<div class="woocommerce"><div class="product"><div class="woocommerce-tabs wc-tabs-wrapper">
            <ul class="tabs wc-tabs" role="tablist">
                <li class="description_tab active" id="tab-title-description" role="tab" aria-controls="tab-description">
                    <a href="#tab-description">Description</a>
                </li>
                <li class="additional_information_tab" id="tab-title-additional_information" role="tab" aria-controls="tab-additional_information">
                    <a href="#tab-additional_information">Additional information</a>
                </li>
            </ul>
            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--description panel entry-content wc-tab" id="tab-description" role="tabpanel" aria-labelledby="tab-title-description" style="display: block;">
                <h4>This outputs your products main content area</h4>
                <p>This can even be a elementor content from your product! While previewing in the template builder this demo content shows.</p>
                <p>Mauris eu est placerat, fringilla tellus ut, rhoncus ante. Nulla maximus ultrices ullamcorper. Aliquam dictum risus et odio pellentesque vestibulum. Vestibulum bibendum, erat eget luctus mollis, ante enim tincidunt sapien, at rutrum odio lorem eget ipsum. Vestibulum tincidunt fermentum ornare. Suspendisse consequat malesuada faucibus. Praesent fringilla, turpis nec convallis euismod, velit purus gravida nibh, in sodales orci leo non leo.</p>
                <p>Quisque tempor volutpat libero, aliquet venenatis turpis pulvinar sed. Maecenas eget ullamcorper purus. Vivamus magna libero, gravida at elit quis, eleifend faucibus dolor. Phasellus mattis risus at facilisis consequat. Donec mollis ipsum nec ex laoreet, at euismod metus finibus. Suspendisse interdum quam nec dignissim pulvinar.</p>
            </div>
            <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--additional_information panel entry-content wc-tab" id="tab-additional_information" role="tabpanel" aria-labelledby="tab-title-additional_information" style="display: none;">
                <table class="shop_attributes">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td><p>Value</p></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div></div></div>';
        } else {
            global $product;
            if (empty($product)) return;

            echo '<div class= "product"> ';
            setup_postdata($product->get_id());
            $master_product_data_tabs::mw_product_data_tabs();
            echo '</div>';
        }

    }
}