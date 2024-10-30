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



if (!defined('ABSPATH')) exit;





class Master_Woo_Shop_Order_Review extends Widget_Base

{



    private static $product_id = null;





    public function __construct($data = [], $args = null)

    {





        parent::__construct($data, $args);





    }





    public function get_name()

    {



        return 'woo-shop-order-review';



    }





    public function get_title()

    {



        return __('MW: Shop Order Review', 'masterelements');



    }





    public function get_categories()

    {



        return array('master-addons');



    }





    public function get_icon()

    {



        return 'eicon-table';



    }





    protected function _register_controls()

    {





        // Heading



        $this->start_controls_section(



            'me_order_review_heading_style',



            array(



                'label' => __('Heading', 'masterelements'),



                'tab' => Controls_Manager::TAB_STYLE,



            )



        );





        $this->start_controls_tabs('me_order_review_heading_style_tabs');





        // Order Review Heading Normal Style



        $this->start_controls_tab(



            'me_order_review_heading_normal',



            [



                'label' => __('Normal', 'masterelements'),



            ]



        );



        $this->add_group_control(



            Group_Control_Typography::get_type(),



            array(



                'name' => 'me_order_review_heading_typography',



                'label' => __('Typography', 'masterelements'),



                'selector' => '{{WRAPPER}} #order_review_heading',



            )



        );





        $this->add_control(



            'me_order_review_heading_color',



            [



                'label' => __('Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} #order_review_heading' => 'color: {{VALUE}}',



                ],



            ]



        );





        $this->add_control(



            'me_order_review_heading_background_color',



            [



                'label' => __('Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} #order_review_heading' => 'background-color: {{VALUE}}',



                ],



            ]



        );





        $this->add_group_control(



            Group_Control_Border::get_type(),



            [



                'name' => 'me_order_review_heading_border',



                'label' => __('Border', 'masterelements'),



                'selector' => '{{WRAPPER}} #order_review_heading',



                'condition' => [



                    'border' => 'yes',



                ],



            ]



        );





        $this->add_responsive_control(



            'me_order_review_heading_border_radius',



            [



                'label' => __('Border Radius', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', 'em', '%'],



                'selectors' => [



                    '{{WRAPPER}} #order_review_heading' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



                'condition' => [



                    'border' => 'yes',



                ],



            ]



        );



        $this->end_controls_tab();





        // Order Review Heading hover Style



        $this->start_controls_tab(



            'me_order_review_heading_hover',



            [



                'label' => __('Hover', 'masterelements'),



            ]



        );



        $this->add_group_control(



            Group_Control_Typography::get_type(),



            array(



                'name' => 'me_order_review_heading_typography_hover',



                'label' => __('Typography', 'masterelements'),



                'selector' => '{{WRAPPER}} #order_review_heading:hover',



            )



        );





        $this->add_control(



            'me_order_review_heading_color_hover',



            [



                'label' => __('Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} #order_review_heading:hover' => 'color: {{VALUE}}',



                ],



            ]



        );





        $this->add_control(



            'me_order_review_heading_background_color_hover',



            [



                'label' => __('Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} #order_review_heading:hover' => 'background-color: {{VALUE}}',



                ],



            ]



        );





        $this->add_group_control(



            Group_Control_Border::get_type(),



            [



                'name' => 'me_order_review_heading_border_hover',



                'label' => __('Border', 'masterelements'),



                'selector' => '{{WRAPPER}} #order_review_heading:hover',



                'condition' => [



                    'border' => 'yes',



                ],



            ]



        );





        $this->add_responsive_control(



            'me_order_review_heading_border_radius_hover',



            [



                'label' => __('Border Radius', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', 'em', '%'],



                'selectors' => [



                    '{{WRAPPER}} #order_review_heading:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



                'condition' => [



                    'border' => 'yes',



                ],



            ]



        );





        $this->add_group_control(



            Group_Control_Box_Shadow::get_type(),



            [



                'name' => 'me_order_review_heading_box_shadow',



                'selector' => '{{WRAPPER}} #order_review_heading',



                'condition' => [



                    'border' => 'yes',



                ],



            ]





        );



        $this->end_controls_tab();





        $this->end_controls_tabs();





        $this->add_control(



            'border',



            [



                'label' => __('Border', 'masterelements'),



                'type' => Controls_Manager::SWITCHER,



                'default' => '',



            ]



        );





        $this->add_responsive_control(



            'me_padding',



            [



                'label' => __('Padding', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', 'em', '%'],



                'selectors' => [



                    '{{WRAPPER}} #order_review_heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



                'condition' => [



                    'border' => 'yes',



                ],



            ]



        );



        $this->add_control(



            'me_order_review_heading_width',



            [



                'label' => __('Heading Width', 'masterelements'),



                'type' => Controls_Manager::SLIDER,



                'size_units' => ['px', '%'],



                'range' => [



                    'px' => [



                        'min' => 160,



                        'max' => 1100,



                        'step' => 1,



                    ],



                    '%' => [



                        'min' => 0,



                        'max' => 200,



                    ],



                ],



                'default' => [



                    'unit' => 'px',



                    'size' => 160,



                ],



                'selectors' => [



                    '{{WRAPPER}} #order_review_heading' => 'width: {{SIZE}}{{UNIT}} !important;',



                ],



                'condition' => [



                    'border' => 'yes',



                ],



            ]



        );





        $this->add_responsive_control(



            'form_heading_margin',



            [



                'label' => __('Margin', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', 'em', '%'],



                'selectors' => [



                    '{{WRAPPER}} #order_review_heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



            ]



        );





        $this->add_responsive_control(



            'form_heading_align',



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



                    '{{WRAPPER}} #order_review_heading' => 'text-align: {{VALUE}}',



                ],



            ]



        );





        $this->end_controls_section();





        // Table Heading



        $this->start_controls_section(



            'me_checkout_order_table_heading_style',



            array(



                'label' => __('Table Heading', 'masterelements'),



                'tab' => Controls_Manager::TAB_STYLE,



            )



        );





        $this->start_controls_tabs('me_checkout_order_table_heading_style_tabs');





        // Order Review Heading Normal Style



        $this->start_controls_tab(



            'me_checkout_order_table_heading_normal',



            [



                'label' => __('Normal', 'masterelements'),



            ]



        );





        $this->add_control(



            'me_checkout_order_table_heading_color',



            [



                'label' => __('Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table th' => 'color: {{VALUE}}',





                ],



            ]



        );





        $this->add_control(



            'me_checkout_order_table_heading_background_color',



            [



                'label' => __('Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table th' => 'background-color: {{VALUE}}',



                ],



            ]



        );





        $this->add_group_control(



            \Elementor\Group_Control_Typography::get_type(),



            [



                'name' => 'me_checkout_order_table_heading_typography',



                'label' => __('Typography', 'masterelements'),

                'scheme' => Scheme_Typography::TYPOGRAPHY_1,

                'selector' =>'{{WRAPPER}}.woocommerce-checkout-review-order-table th',



            ]



        );





        $this->add_responsive_control(



            'me_checkout_order_table_heading_border_radius',



            [



                'label' => __('Border Radius', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', 'em', '%'],



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table th' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',





                ],



                'condition' => [



                    'me_checkout_order_table_heading_border' => 'yes',



                ],



            ]



        );



        $this->end_controls_tab();





        // Order Review Heading hover Style



        $this->start_controls_tab(



            'me_checkout_order_table_heading_hover',



            [



                'label' => __('Hover', 'masterelements'),



            ]



        );



        $this->add_control(



            'me_checkout_order_table_heading_color_hover',



            [



                'label' => __('Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table th:hover' => 'color: {{VALUE}}',





                ],



            ]



        );





        $this->add_control(



            'me_checkout_order_table_heading_background_color_hover',



            [



                'label' => __('Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table th:hover' => 'background-color: {{VALUE}}',





                ],



            ]



        );





        $this->add_group_control(



            Group_Control_Typography::get_type(),



            array(



                'name' => 'me_checkout_order_table_heading_typography_hover',



                'label' => __('Typography', 'masterelements'),



                'selector' =>'{{WRAPPER}} .woocommerce-checkout-review-order-table th:hover',



            )



        );





        $this->add_responsive_control(



            'me_checkout_order_table_heading_border_radius_hover',



            [



                'label' => __('Border Radius', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', 'em', '%'],



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table th:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',





                ],



                'condition' => [



                    'me_checkout_order_table_heading_border' => 'yes',



                ],



            ]



        );



        $this->end_controls_tab();





        $this->end_controls_tabs();





        $this->add_control(



            'me_checkout_order_table_heading_border',



            [



                'label' => __('Border', 'masterelements'),



                'type' => Controls_Manager::SWITCHER,



                'default' => '',



            ]



        );





        $this->add_responsive_control(



            'me_checkout_order_table_heading_padding',



            [



                'label' => __('Padding', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', 'em', '%'],



                'selectors' => [



                    '{{WRAPPER}}  table.shop_table.woocommerce-checkout-review-order-table th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',





                ],



            ]



        );





        $this->add_responsive_control(



            'me_checkout_order_table_heading_align',



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



                    '{{WRAPPER}} table.shop_table.woocommerce-checkout-review-order-table th' => 'text-align: {{VALUE}}',





                ],



            ]



        );



        $this->end_controls_section();





        // Table Content



        $this->start_controls_section(



            'me_checkout_order_table_content_style',



            array(



                'label' => __('Table Content', 'masterelements'),



                'tab' => Controls_Manager::TAB_STYLE,



            )



        );





        $this->start_controls_tabs('me_checkout_order_table_content_style_tabs');





        // Order Review Heading Normal Style



        $this->start_controls_tab(



            'me_checkout_order_table_content_normal',



            [



                'label' => __('Normal', 'masterelements'),



            ]



        );





        $this->add_group_control(



            Group_Control_Typography::get_type(),



            array(



                'name' => 'me_checkout_order_table_content_typography',



                'label' => __('Typography', 'masterelements'),



                'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name, {{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name strong',



            )



        );





        $this->add_control(



            'me_checkout_order_table_content_color',



            [



                'label' => __('Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name' => 'color: {{VALUE}}',



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name strong' => 'color: {{VALUE}}',



                ],



            ]



        );





        $this->add_control(



            'me_checkout_order_table_content_bg_color',



            [



                'label' => __('Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name' => 'background-color: {{VALUE}}',





                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name strong' => 'background-color: {{VALUE}}',



                ],



            ]



        );





        $this->add_group_control(



            Group_Control_Border::get_type(),



            [



                'name' => 'me_checkout_order_table_content_border',



                'label' => __('Border', 'masterelements'),



                'selector' => '{{WRAPPER}}  .woocommerce-checkout-review-order-table td.product-name',



                'condition' => [



                    'me_checkout_order_table_content_border' => 'yes',



                ],



            ]



        );





        $this->end_controls_tab();





        // Order Review Heading hover Style



        $this->start_controls_tab(



            'me_checkout_order_table_content_hover',



            [



                'label' => __('Hover', 'masterelements'),



            ]



        );



        $this->add_group_control(



            Group_Control_Typography::get_type(),



            array(



                'name' => 'me_checkout_order_table_content_typography_hover',



                'label' => __('Typography', 'masterelements'),



                'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name:hover, {{WRAPPER}} .woocommerce-checkout-review-order-table td strong',



            )



        );





        $this->add_control(



            'me_checkout_order_table_content_color_hover',



            [



                'label' => __('Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name:hover' => 'color: {{VALUE}}',



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name  strong:hover ' => 'color: {{VALUE}}!important',



                ],



            ]



        );





        $this->add_control(



            'me_checkout_order_table_content_bg_color_hover',



            [



                'label' => __('Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name:hover' => 'background-color: {{VALUE}}',



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name  strong:hover ' => 'background-color: {{VALUE}}!important',



                ],



            ]



        );





        $this->add_group_control(



            Group_Control_Border::get_type(),



            [



                'name' => 'me_checkout_order_table_content_border_hover',



                'label' => __('Border', 'masterelements'),



                'selector' => '{{WRAPPER}}  .woocommerce-checkout-review-order-table td.product-name:hover',



                'condition' => [



                    'me_checkout_order_table_content_border' => 'yes',



                ],



            ]



        );





        $this->end_controls_tab();





        $this->end_controls_tabs();





        $this->add_control(



            'me_checkout_order_table_content_border',



            [



                'label' => __('Border', 'masterelements'),



                'type' => Controls_Manager::SWITCHER,



                'default' => '',



            ]



        );





        $this->add_responsive_control(



            'me_checkout_order_table_content_align',



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



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name' => 'text-align: {{VALUE}}',



                ],



            ]



        );





        $this->add_responsive_control(



            'me_checkout_order_table_content_padding',



            [



                'label' => __('Padding', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', 'em', '%'],



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



            ]



        );





        $this->end_controls_section();





        // Price



        $this->start_controls_section(



            'me_checkout_order_table_price_style',



            array(



                'label' => __('Price', 'masterelements'),



                'tab' => Controls_Manager::TAB_STYLE,



            )



        );





        $this->add_control(



            'me_checkout_order_table_price_heading',



            [



                'label' => __('Price', 'masterelements'),



                'type' => Controls_Manager::HEADING,



                'separator' => 'after',



            ]



        );





        $this->start_controls_tabs('me_checkout_order_table_price_style_tabs');





        // Order Review Heading Normal Style



        $this->start_controls_tab(



            'me_checkout_order_table_price_normal',



            [



                'label' => __('Normal', 'masterelements'),



            ]



        );





        $this->add_group_control(



            Group_Control_Typography::get_type(),



            array(



                'name' => 'me_checkout_order_table_price_typography',



                'label' => __('Typography', 'masterelements'),



                'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-total',



            )



        );





        $this->add_control(



            'me_checkout_order_table_price_color',



            [



                'label' => __('Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-total' => 'color: {{VALUE}}',



                ],



            ]



        );





        $this->add_control(



            'me_checkout_order_table_price_bg_color',



            [



                'label' => __('Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-total' => 'background-color: {{VALUE}}',



                ],



            ]



        );





        $this->add_group_control(



            Group_Control_Border::get_type(),



            [



                'name' => 'me_checkout_order_table_price_border',



                'label' => __('Border', 'masterelements'),



                'selector' => '{{WRAPPER}}  .woocommerce-checkout-review-order-table td.product-total',



                'condition' => [



                    'me_checkout_order_table_price_border' => 'yes',



                ],



            ]



        );





        $this->end_controls_tab();





        $this->start_controls_tab(



            'me_checkout_order_table_price_hover',



            [



                'label' => __('Hover', 'masterelements'),



            ]



        );



        $this->add_group_control(



            Group_Control_Typography::get_type(),



            array(



                'name' => 'me_checkout_order_table_price_typography_hover',



                'label' => __('Typography', 'masterelements'),



                'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-total:hover',



            )



        );





        $this->add_control(



            'me_checkout_order_table_price_color_hover',



            [



                'label' => __('Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-total:hover' => 'color: {{VALUE}}',



                ],



            ]



        );





        $this->add_control(



            'me_checkout_order_table_price_bg_color_hover',



            [



                'label' => __('Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-total:hover' => 'background-color: {{VALUE}}',



                ],



            ]



        );





        $this->add_group_control(



            Group_Control_Border::get_type(),



            [



                'name' => 'me_checkout_order_table_price_border_hover',



                'label' => __('Border', 'masterelements'),



                'selector' => '{{WRAPPER}}  .woocommerce-checkout-review-order-table td.product-total:hover',



                'condition' => [



                    'me_checkout_order_table_content_border' => 'yes',



                ],



            ]



        );





        $this->end_controls_tab();





        $this->end_controls_tabs();





        $this->add_control(



            'me_checkout_order_table_price_border',



            [



                'label' => __('Border', 'masterelements'),



                'type' => Controls_Manager::SWITCHER,



                'default' => '',



            ]



        );





        $this->add_responsive_control(



            'me_checkout_order_table_price_align',



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



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-total' => 'text-align: {{VALUE}}',



                ],



            ]



        );





        $this->add_responsive_control(



            'me_checkout_order_table_price_padding',



            [



                'label' => __('Padding', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', 'em', '%'],



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table td.product-total' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                ],



            ]



        );





        $this->add_control(



            'checkout_order_table_totalprice_heading',



            [



                'label' => __('Total Price', 'masterelements'),



                'type' => Controls_Manager::HEADING,



                'separator' => 'after',



            ]



        );



        $this->start_controls_tabs('me_checkout_order_table_totalprice_style_tabs');





        //Checkout Order Table Total Price Normal Style



        $this->start_controls_tab(



            'me_checkout_order_table_totalprice_normal',



            [



                'label' => __('Normal', 'masterelements'),



            ]



        );





        $this->add_group_control(



            Group_Control_Typography::get_type(),



            array(



                'name' => 'me_checkout_order_table_totalprice_typography',



                'label' => __('Typography', 'masterelements'),



                'selector' => '{{WRAPPER}} .woocommerce-checkout-review-order-table tr.cart-subtotal td .amount, {{WRAPPER}}.woocommerce-checkout-review-order-table tr.order-total td .amount',



            )



        );





        $this->add_control(



            'me_checkout_order_table_totalprice_color',



            [



                'label' => __('Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table tr.cart-subtotal td .amount' => 'color: {{VALUE}}',



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table tr.order-total td .amount' => 'color: {{VALUE}}',



                ],



            ]



        );





        $this->add_control(



            'me_checkout_order_table_totalprice_bg_color',



            [



                'label' => __('Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table tr.cart-subtotal td' => 'background-color: {{VALUE}}',



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table tr.order-total td' => 'background-color: {{VALUE}}',



                ],



            ]



        );





        $this->add_group_control(



            Group_Control_Border::get_type(),



            [



                'name' => 'me_checkout_order_table_totalprice_border',



                'label' => __('Border', 'masterelements'),



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table tr.cart-subtotal td',



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table tr.order-total td',



                ],



                'condition' => [



                    'me_checkout_order_table_totalprice_border' => 'yes',



                ],



            ]



        );





        $this->end_controls_tab();





        $this->start_controls_tab(



            'me_checkout_order_table_totalprice_hover',



            [



                'label' => __('Hover', 'masterelements'),



            ]



        );



        $this->add_group_control(



            Group_Control_Typography::get_type(),



            array(



                'name' => 'me_checkout_order_table_totalprice_typography_hover',



                'label' => __('Typography', 'masterelements'),



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table tr.cart-subtotal td .amount:hover',



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table tr.order-total td .amount:hover',





                ],



            )



        );





        $this->add_control(



            'me_checkout_order_table_totalprice_color_hover',



            [



                'label' => __('Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}}  .woocommerce-checkout-review-order-table tr.cart-subtotal td .amount:hover' => 'color: {{VALUE}}',



                    '{{WRAPPER}}  .woocommerce-checkout-review-order-table tr.order-total td .amount:hover' => 'color: {{VALUE}}',



                ],



            ]



        );





        $this->add_control(



            'me_checkout_order_table_totalprice_bg_color_hover',



            [



                'label' => __('Background Color', 'masterelements'),



                'type' => Controls_Manager::COLOR,



                'selectors' => [



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table tr.cart-subtotal td:hover' => 'background-color: {{VALUE}}',



                    '{{WRAPPER}} .woocommerce-checkout-review-order-table tr.order-total td:hover' => 'background-color: {{VALUE}}',



                ],



            ]



        );





        $this->add_group_control(



            Group_Control_Border::get_type(),



            [



                'name' => 'me_checkout_order_table_totalprice_border_hover',



                'label' => __('Border', 'masterelements'),



                'selectors' => [



                    '{{WRAPPER}}  .woocommerce-checkout-review-order-table tr.cart-subtotal td:hover',



                    '{{WRAPPER}}  .woocommerce-checkout-review-order-table tr.order-total td:hover',





                ],



                'condition' => [



                    'me_checkout_order_table_totalprice_border' => 'yes',



                ],



            ]



        );





        $this->end_controls_tab();





        $this->end_controls_tabs();





        $this->add_control(



            'me_checkout_order_table_totalprice_border',



            [



                'label' => __('Border', 'masterelements'),



                'type' => Controls_Manager::SWITCHER,



                'default' => '',



            ]



        );





        $this->add_responsive_control(



            'me_checkout_order_table_totalprice_align',



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



                    '{{WRAPPER}}  .woocommerce-checkout-review-order-table tr.cart-subtotal td' => 'text-align: {{VALUE}}',



                    '{{WRAPPER}}  .woocommerce-checkout-review-order-table tr.order-total td' => 'text-align: {{VALUE}}',





                ],



            ]



        );





        $this->add_responsive_control(



            'me_checkout_order_table_totalprice_padding',



            [



                'label' => __('Padding', 'masterelements'),



                'type' => Controls_Manager::DIMENSIONS,



                'size_units' => ['px', 'em', '%'],



                'selectors' => [



                    '{{WRAPPER}}  .woocommerce-checkout-review-order-table tr.cart-subtotal td .amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



                    '{{WRAPPER}}  .woocommerce-checkout-review-order-table tr.order-total td .amount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',



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



        $master_checkout_order_review = new Master_Woocommerce_Functions();



        if ($master_checkout_order_review::mw_is_is_edit_mode()) {



            ?>



            <h3 id="order_review_heading"><?php esc_html_e('Your order', 'masterelements'); ?></h3>



            <?php



            $master_checkout_order_review::mw_checkout_order_review();



        } else {



            //echo '<pre>'. var_dump(is_checkout_page()).'</pre>';

            if ($master_checkout_order_review::mw_checkout()) {

                ?>



                <h3 id="order_review_heading"><?php esc_html_e('Your order', 'masterelements'); ?></h3>



                <?php



                $master_checkout_order_review::mw_checkout_order_review();

            }



        }



    }



}