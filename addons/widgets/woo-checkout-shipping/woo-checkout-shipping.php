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



class Master_Woo_Checkout_Shipping extends Widget_Base {

    private static $product_id = null;



    public function __construct( $data = [], $args = null ) {



        parent::__construct( $data, $args );



    }

    public function get_name() {

        return 'woo-checkout-shipping';

    }

    public function get_title() {

        return __( 'MW: Checkout Shipping Form', 'masterelements' );

    }

    public function get_categories() {

        return array( 'master-addons' );

    }

    public function get_icon() {

        return 'eicon-table';

    }

protected function _register_controls() {

    // Heading
    $this->start_controls_section(
        'me_checkout_shipping_heading_style',
        array(
            'label' => __( 'Ship to a Different Address Heading', 'masterelements' ),
            'tab' => Controls_Manager::TAB_STYLE,
        )
    );

    $this->start_controls_tabs('me_checkout_shipping_heading_style_tabs');

    // Billing/Shipping Address Content Normal Style

    $this->start_controls_tab(
        'me_checkout_shipping_heading_normal',
        [
            'label' => __('Normal', 'masterelements'),
        ]
    );

    $this->add_control(
        'me_checkout_shipping_heading_color',
        [
            'label' => __( 'Color', 'masterelements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'me_checkout_shipping_heading_bg_color',
        [
            'label' => __('Background Color', 'masterelements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        array(
            'name'      => 'me_checkout_shipping_heading_typography',
            'label'     => __( 'Typography', 'masterelements' ),
            'selector'  => '{{WRAPPER}} .woocommerce-shipping-fields #ship-to-different-address',
        )
    );



    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'me_checkout_shipping_heading_border',
            'label' => __('Border', 'masterelements'),
            'selector' => '{{WRAPPER}}  label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox',
        ]
    );

    $this->add_responsive_control(
        'me_checkout_shipping_heading_border_radius',
        [
            'label' => __('Border Radius', 'masterelements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'me_checkout_shipping_heading_padding',
        [
            'label' => __('Padding', 'masterelements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'me_checkout_shipping_heading_margin',
        [
            'label' => __( 'Margin', 'masterelements' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors' => [
                '{{WRAPPER}} .woocommerce-shipping-fields #ship-to-different-address' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_responsive_control(
        'me_checkout_shipping_heading_align',
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
                '{{WRAPPER}} .woocommerce-shipping-fields #ship-to-different-address' => 'text-align: {{VALUE}}',
            ],
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab(
        'me_checkout_shipping_heading_hover',
        [
            'label' => __('Hover', 'masterelements'),
        ]
    );

    $this->add_control(
        'me_checkout_shipping_heading_color_hover',
        [
            'label' => __( 'Color', 'masterelements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox:hover' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'me_checkout_shipping_heading_bg_color_hover',
        [
            'label' => __('Background Color', 'masterelements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox:hover' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        array(
            'name'      => 'me_checkout_shipping_heading_typography_hover',
            'label'     => __( 'Typography', 'masterelements' ),
            'selector'  => '{{WRAPPER}} .woocommerce-shipping-fields #ship-to-different-address:hover',
        )
    );



    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'me_checkout_shipping_heading_border_hover',
            'label' => __('Border', 'masterelements'),
            'selector' => '{{WRAPPER}}  label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox:hover',
        ]
    );

    $this->add_responsive_control(
        'me_checkout_shipping_heading_border_radius_hover',
        [
            'label' => __('Border Radius', 'masterelements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} label.woocommerce-form__label.woocommerce-form__label-for-checkbox.checkbox:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->end_controls_section();

    // Form label
    $this->start_controls_section(
        'me_checkout_form_label_style',
        array(
            'label' => __( 'Checkout Form Label', 'masterelements' ),
            'tab' => Controls_Manager::TAB_STYLE,
        )
    );
    $this->start_controls_tabs('me_checkout_form_label_style_tabs');

    // Shipping form labels Normal Style

    $this->start_controls_tab(
        'me_checkout_form_label_normal',
        [
            'label' => __('Normal', 'masterelements'),
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        array(
            'name'      => 'me_checkout_form_label_typography',
            'label'     => __( 'Typography', 'masterelements' ),
            'selector'  => '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label',
        )
    );

    $this->add_control(
        'me_checkout_form_label_color',
        [
            'label' => __( 'Label Color', 'masterelements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'me_checkout_form_label_bg_color',
        [
            'label' => __('Label Background Color', 'masterelements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'me_checkout_form_label_required_color',
        [
            'label' => __( 'Required Color', 'masterelements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label abbr' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'me_checkout_form_label_border',
            'label' => __('Border', 'masterelements'),
            'selector' => '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label',
        ]
    );

    $this->add_responsive_control(
        'me_checkout_form_label_border_radius',
        [
            'label' => __('Border Radius', 'masterelements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'me_checkout_form_label_padding',
        [
            'label' => __('Padding', 'masterelements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'me_checkout_form_label_margin',
        [
            'label' => esc_html__( 'Margin', 'masterelements' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%' ],
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'me_checkout_form_label_align',
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
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label' => 'text-align: {{VALUE}}',
            ],
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab(
        'me_checkout_form_label_hover',
        [
            'label' => __('Hover', 'masterelements'),
        ]
    );

    $this->add_control(
        'me_checkout_form_label_color_hover',
        [
            'label' => __( 'Label Color', 'masterelements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label:hover' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'me_checkout_form_label_bg_color_hover',
        [
            'label' => __('Label Background Color', 'masterelements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label:hover' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'me_checkout_form_label_required_color_hover',
        [
            'label' => __( 'Required Color', 'masterelements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label abbr:hover' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'me_checkout_form_label_border_hover',
            'label' => __('Border', 'masterelements'),
            'selector' => '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label:hover',
        ]
    );

    $this->add_responsive_control(
        'me_checkout_form_label_border_radius_hover',
        [
            'label' => __('Border Radius', 'masterelements'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .form-row label:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_tab();

    $this->end_controls_tabs();


    $this->end_controls_section();

    // Input box
    $this->start_controls_section(
        'me_checkout_form_input_box_style',
        array(
            'label' => esc_html__( 'Checkout Form Input Box', 'masterelements' ),
            'tab' => Controls_Manager::TAB_STYLE,
        )
    );
    $this->start_controls_tabs('me_checkout_form_input_box_style_tabs');

    // Checkout Form Input Box Normal Style

    $this->start_controls_tab(
        'me_checkout_form_input_box_normal',
        [
            'label' => __('Normal', 'masterelements'),
        ]
    );

    $this->add_control(
        'me_checkout_form_input_box_text_color',
        [
            'label' => __( 'Text Color', 'masterelements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input.input-text' => 'color: {{VALUE}}',
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper textarea' => 'color: {{VALUE}}',
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper select' => 'color: {{VALUE}}',
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .select2-container .select2-selection' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'me_checkout_form_input_box_bg_color',
        [
            'label' => __('Input Box Color', 'masterelements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input.input-text' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        array(
            'name'      => 'me_checkout_form_input_box_typography',
            'label'     => esc_html__( 'Typography', 'masterelements' ),
            'selector'  => '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input.input-text , {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper textarea, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper select, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .select2-container .select2-selection',
        )
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'me_checkout_form_input_box_border',
            'label' => __( 'Border', 'masterelements' ),
            'selector' => '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input.input-text , {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper textarea, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper select, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .select2-container .select2-selection',
        ]
    );

    $this->add_responsive_control(
        'me_checkout_form_input_box_border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'masterelements' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input.input-text, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper select, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .select2-container .select2-selection' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'me_checkout_form_input_box_padding',
        [
            'label' => esc_html__( 'Padding', 'masterelements' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper select, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .select2-container .select2-selection' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'separator' => 'before',
        ]
    );

    $this->add_responsive_control(
        'me_checkout_form_input_box_margin',
        [
            'label' => esc_html__( 'Margin', 'masterelements' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper select, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .select2-container .select2-selection' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_tab();

    $this->start_controls_tab(
        'me_checkout_form_input_box_hover',
        [
            'label' => __('Hover', 'masterelements'),
        ]
    );

    $this->add_control(
        'me_checkout_form_input_box_text_color_hover',
        [
            'label' => __( 'Text Color', 'masterelements' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input.input-text:hover' => 'color: {{VALUE}}',
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper textarea:hover' => 'color: {{VALUE}}',
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper select:hover' => 'color: {{VALUE}}',
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .select2-container .select2-selection:hover' => 'color: {{VALUE}}',
            ],
        ]
    );

    $this->add_control(
        'me_checkout_form_input_box_bg_color_hover',
        [
            'label' => __('Input Box Color', 'masterelements'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input.input-text:hover' => 'background-color: {{VALUE}}',
            ],
        ]
    );

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        array(
            'name'      => 'me_checkout_form_input_box_typography_hover',
            'label'     => esc_html__( 'Typography', 'masterelements' ),
            'selector'  => '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input.input-text:hover , {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper textarea:hover, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper select:hover, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .select2-container .select2-selection:hover',
        )
    );

    $this->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'me_checkout_form_input_box_border_hover',
            'label' => __( 'Border', 'masterelements' ),
            'selector' => '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input.input-text:hover , {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper textarea:hover, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper select:hover, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .select2-container .select2-selection:hover',
        ]
    );

    $this->add_responsive_control(
        'me_checkout_form_input_box_border_radius_hover',
        [
            'label' => esc_html__( 'Border Radius', 'masterelements' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper input.input-text:hover, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper textarea:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper select:hover, {{WRAPPER}} .shipping_address .woocommerce-shipping-fields__field-wrapper .select2-container .select2-selection:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

}
    /**
     * WooCommerce Classes,Actions and Filters Used in this Function
     */
    protected function render()
    {
        $master_shipping = new Master_Woocommerce_Functions();

        if ( $master_shipping :: mw_is_is_edit_mode() ) {
            //echo '<div class="me-shipping-form">'.__('Shipping Form','masterelements').'</div>';

            if( sizeof(  $master_shipping :: mw_wc_checkout()->checkout_fields ) > 0 ){ ?>
                <div class="woocommerce-shipping-fields">
                    <?php if ( true === $master_shipping :: mw_wc_cart()->needs_shipping_address() ) : ?>

                        <h3 id="ship-to-different-address">
                            <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                <input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> <span><?php _e( 'Ship to a different address?', 'masterelements' ); ?></span>
                            </label>
                        </h3>

                        <div class="shipping_address">
                            <?php $master_shipping :: mw_add_action( 'woocommerce_before_checkout_shipping_form', $master_shipping :: mw_wc_checkout() ); ?>
                            <div class="woocommerce-shipping-fields__field-wrapper">
                                <?php
                                $fields = $master_shipping :: mw_wc_checkout()->get_checkout_fields( 'shipping' );
                                foreach ( $fields as $key => $field ) {
                                    if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
                                        $field['country'] = $master_shipping :: mw_wc_checkout()->get_value( $field['country_field'] );
                                    }
                                    woocommerce_form_field( $key, $field, $master_shipping :: mw_wc_checkout()->get_value( $key ) );
                                }
                                ?>
                            </div>
                            <?php $master_shipping :: mw_add_action( 'woocommerce_after_checkout_shipping_form', $master_shipping :: mw_wc_checkout() ); ?>
                        </div>

                    <?php endif; ?>
                </div>
                <?php
            }
        }else{
            if( $master_shipping :: mw_checkout() ){
                if( sizeof(  $master_shipping :: mw_wc_checkout()->checkout_fields ) > 0 ){ ?>
                    <div class="woocommerce-shipping-fields">
                        <?php if ( true === $master_shipping :: mw_wc_cart()->needs_shipping_address() ) : ?>

                            <h3 id="ship-to-different-address">
                                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
                                    <input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> <span><?php _e( 'Ship to a different address?', 'masterelements' ); ?></span>
                                </label>
                            </h3>

                            <div class="shipping_address">
                                <?php $master_shipping :: mw_add_action( 'woocommerce_before_checkout_shipping_form', $master_shipping :: mw_wc_checkout() ); ?>
                                <div class="woocommerce-shipping-fields__field-wrapper">
                                    <?php
                                    $fields = $master_shipping :: mw_wc_checkout()->get_checkout_fields( 'shipping' );
                                    foreach ( $fields as $key => $field ) {
                                        if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
                                            $field['country'] = $master_shipping :: mw_wc_checkout()->get_value( $field['country_field'] );
                                        }
                                        woocommerce_form_field( $key, $field, $master_shipping :: mw_wc_checkout()->get_value( $key ) );
                                    }
                                    ?>
                                </div>
                                <?php $master_shipping :: mw_add_action( 'woocommerce_after_checkout_shipping_form', $master_shipping :: mw_wc_checkout() ); ?>
                            </div>

                        <?php endif; ?>
                    </div>
                    <?php
                }
            }
        }
    }
}
