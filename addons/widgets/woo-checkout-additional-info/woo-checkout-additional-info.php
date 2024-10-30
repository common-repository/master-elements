<?php
namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;
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
if ( ! defined( 'ABSPATH' ) ) exit;



class Master_Woo_Checkout_Additional_Info extends Widget_Base
{

    private static $product_id = null;


    public function __construct($data = [], $args = null)
    {


        parent::__construct($data, $args);


    }

    public function get_name()
    {

        return 'woo-checkout-additional-info';

    }

    public function get_title()
    {

        return __('MW: Checkout Additional Info', 'masterelements');

    }

    public function get_categories()
    {

        return array('master-addons');

    }

    public function get_icon()
    {

        return 'eicon-table';

    }
    protected function _register_controls() {

        // Heading
        $this->start_controls_section(
            'me_additional_form_heading_style',
            array(
                'label' => __( 'Additional Information Heading', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('me_additional_form_heading_style_tabs');

        // Additional Information Heading Normal Style

        $this->start_controls_tab(
            'me_additional_form_heading_label_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_additional_form_typography',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .woocommerce-additional-fields > h3',
            )
        );

        $this->add_control(
            'me_additional_form_heading_color',
            [
                'label' => __( 'Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields > h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_additional_form_heading_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields > h3' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_additional_form_heading_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}}  .woocommerce-additional-fields > h3',
            ]
        );

        $this->add_responsive_control(
            'me_additional_form_heading_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields > h3' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_additional_form_heading_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields > h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_additional_form_heading_margin',
            [
                'label' => __( 'Margin', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields > h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_additional_form_heading_align',
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
                'default'   => 'left',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields > h3' => 'text-align: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_additional_form_heading_hover',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_additional_form_typography_hover',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .woocommerce-additional-fields > h3:hover',
            )
        );

        $this->add_control(
            'me_additional_form_heading_color_hover',
            [
                'label' => __( 'Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields > h3:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_additional_form_heading_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields > h3:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_additional_form_heading_border_hover',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}}  .woocommerce-additional-fields > h3:hover',
            ]
        );

        $this->add_responsive_control(
            'me_additional_form_heading_border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields > h3:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();

        // Form label
        $this->start_controls_section(
            'me_additional_form_label_style',
            array(
                'label' => __( 'Order Notes Label', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_additional_form_label_typography',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .woocommerce-additional-fields .form-row label',
            )
        );

        $this->add_control(
            'me_additional_form_label_color',
            [
                'label' => __( 'Label Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields .form-row label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_additional_form_label_bg_color',
            [
                'label' => __('Label Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields .form-row label' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_additional_form_label_border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} .woocommerce-additional-fields .form-row label',
            ]
        );

        $this->add_responsive_control(
            'me_additional_form_label_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields .form-row label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_additional_form_label_padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields .form-row label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'me_additional_form_label_margin',
            [
                'label' => esc_html__( 'Margin', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields .form-row label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );


        $this->add_responsive_control(
            'me_additional_form_label_align',
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
                    '{{WRAPPER}} .woocommerce-additional-fields .form-row label' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();


        // Input box
        $this->start_controls_section(
            'me_form_input_box_style',
            array(
                'label' => esc_html__( 'Additional Info. Form Input Box', 'masterelementss' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
        $this->start_controls_tabs('me_form_input_box_style_tabs');

        // Additional Information Heading Normal Style

        $this->start_controls_tab(
            'me_form_input_box_label_normal',
            [
                'label' => __('Normal', 'masterelements'),
            ]
        );
        $this->add_control(
            'me_form_input_box_text_color',
            [
                'label' => __( 'Text Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields input , {{WRAPPER}} .woocommerce-additional-fields textarea' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'me_form_input_box_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields input , {{WRAPPER}} .woocommerce-additional-fields textarea' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_form_input_box_typography',
                'label'     => esc_html__( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .woocommerce-additional-fields input , {{WRAPPER}} .woocommerce-additional-fields textarea',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_form_input_box_border',
                'label' => __( 'Border', 'masterelements' ),
                'selector' => '{{WRAPPER}} .woocommerce-additional-fields input , {{WRAPPER}} .woocommerce-additional-fields textarea',
            ]
        );

        $this->add_responsive_control(
            'me_form_input_box_radius',
            [
                'label' => esc_html__( 'Border Radius', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields input , {{WRAPPER}} .woocommerce-additional-fields textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'me_form_input_box_shadow',
                'selector' => '{{WRAPPER}} .woocommerce-additional-fields input , {{WRAPPER}} .woocommerce-additional-fields textarea',
            ]

        );

        $this->add_responsive_control(
            'me_form_input_box_padding',
            [
                'label' => esc_html__( 'Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields input , {{WRAPPER}} .woocommerce-additional-fields textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'me_form_input_box_margin',
            [
                'label' => esc_html__( 'Margin', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields input , {{WRAPPER}} .woocommerce-additional-fields textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_form_input_box_hover',
            [
                'label' => __('Hover', 'masterelements'),
            ]
        );

        $this->add_control(
            'me_form_input_box_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields input , {{WRAPPER}} .woocommerce-additional-fields textarea:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_form_input_box_border_hover',
                'label' => __( 'Border', 'masterelements' ),
                'selector' => '{{WRAPPER}} .woocommerce-additional-fields input , {{WRAPPER}} .woocommerce-additional-fields textarea:hover',
            ]
        );

        $this->add_responsive_control(
            'me_form_input_box_radius_hover',
            [
                'label' => esc_html__( 'Border Radius', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-additional-fields input , {{WRAPPER}} .woocommerce-additional-fields textarea:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {

        $master_additional = new Master_Woocommerce_Functions();
        if ( sizeof( $master_additional :: mw_wc_checkout()->checkout_fields ) > 0 ) { ?>
            <div class="woocommerce-additional-fields">
                <?php $master_additional :: mw_add_action( 'woocommerce_before_order_notes', $master_additional :: mw_wc_checkout() ); ?>

                <?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>


                        <h3><?php _e( 'Additional information', 'masterelements' ); ?></h3>


                    <div class="woocommerce-additional-fields__field-wrapper">
                        <?php foreach ( $master_additional :: mw_wc_checkout()->get_checkout_fields( 'order' ) as $key => $field ) : ?>
                            <?php woocommerce_form_field( $key, $field, $master_additional :: mw_wc_checkout()->get_value( $key ) ); ?>
                        <?php endforeach; ?>
                    </div>

                <?php endif; ?>

                <?php $master_additional :: mw_add_action( 'woocommerce_after_order_notes', $master_additional :: mw_wc_checkout() ); ?>
            </div>
            <?php
        }
    }
}