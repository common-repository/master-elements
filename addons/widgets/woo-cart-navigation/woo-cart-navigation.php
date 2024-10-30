<?php



namespace Elementor;



use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use MasterElements\Master_Woocommerce_Functions;



if (!defined('ABSPATH')) exit; // Exit if accessed directly



class Master_Woo_Cart_Navigation extends Widget_Base

{

    public function __construct( $data = [], $args = null ) {



        parent::__construct( $data, $args );

        wp_register_style('me-woo-product-cart-css', \MasterElements::widgets_url() . '/woo-cart-navigation/css/cart-navigation.css', false, \MasterElements::version);
        wp_register_script('me-woo-custom-product-js', \MasterElements::widgets_url() . '/woo-cart-navigation/js/cart-navigation.js', array('jquery'), \MasterElements::version);
        
    }

    public function get_script_depends() {


        return [


            'me-woo-custom-product-js',


        ];


    }


    public function get_style_depends()

    {

        return ['me-woo-product-cart-css'];

    }


    public function get_name()

    {

        return 'cart-navigation';

    }


    public function get_title()

    {

        return __('MW: Cart Navigation', 'masterelements');

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

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'masterelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'cart_icon_select',
            [
                'label' => __('Icon', 'akd-essentials'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa fa-shopping-cart',
                    'library' => 'solid',
                ],
                'selector' => '{{WRAPPER}} .cart-button-icon',
            ]
        );



        $this->add_control(
            'alignment',
            [
                'label' => __( 'Alignment', 'masterelements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'masterelements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'masterelements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'masterelements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cart-button-with-logox' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => __( 'Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-all-background' => 'background-color: {{VALUE}}!important',
                ],
            ]
        );

        $this->add_responsive_control(
            'cart_div_padding',
            [
                'label' => __( 'Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .cart-all-background' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'cart_product_margin',
            [
                'label' => __( 'Margin', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .custom-menu-cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_cart_style',
            [
                'label' => __( 'Menu Icon', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'cart_button_colors' );

        $this->start_controls_tab( 'cart_button_normal_colors',
            [ 'label' => __( 'Normal', 'masterelements' ) ]
        );

        $this->add_control(
            'cart_button_text_color',
            [
                'label' => __( 'Text Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-total-itemsx' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_button_icon_color',
            [
                'label' => __( 'Icon Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-button-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_button_background_color',
            [
                'label' => __( 'Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-button-with-logox' => 'background-color: {{VALUE}}!important',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab( 'cart_button_hover_colors',
            [ 'label' => __( 'Hover', 'masterelements' ) ]
        );

        $this->add_control(
            'cart_button_hover_text_color',
            [
                'label' => __( 'Text Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-total-itemsx:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_button_hover_icon_color',
            [
                'label' => __( 'Icon Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-button-icon:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'cart_button_hover_background_color',
            [
                'label' => __( 'Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-button-with-logox:hover' => 'background-color: {{VALUE}}!important',
                ],
            ]
        );



        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'cart_button_border_width',
            [
                'label' => __( 'Border Width', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .cart-button-with-logox' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'cart_button_border_radius',
            [
                'label' => __( 'Border Radius', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .cart-button-with-logox' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],

            ]
        );

        $this->add_control(
            'cart_icon_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Icon', 'masterelements' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'cart_icon_size',
            [
                'label' => __( 'Size', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .cart-button-icon' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );


        $this->add_responsive_control(
            'cart_button_padding',
            [
                'label' => __( 'Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .cart-button-with-logox' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'cart_counter_number',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Number of Products', 'masterelements' ),
                'separator' => 'before',
                'condition' => [
                    'items_indicator!' => 'none',
                ],
            ]
        );
        $this->add_control(
            'cart_counter_number_color',
            [
                'label' => __( 'Text Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-total-itemsx' => 'color: {{VALUE}}',
                ],

            ]
        );

        $this->add_control(
            'cart_counter_number_background_color',
            [
                'label' => __( 'Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cart-total-itemsx' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_product_tabs_style',
            [
                'label' => __( 'Products', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_product_title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Product Title', 'masterelements' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'product_title_color',
            [
                'label' => __( 'Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-cart-product-title b' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_title_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .custom-cart-product-title b',
            ]
        );

        $this->add_control(
            'heading_product_price_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Product Price', 'masterelements' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'product_price_color',
            [
                'label' => __( 'Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-cart-product-price' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_price_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .custom-cart-product-price',
            ]
        );

        $this->add_control(
            'heading_product_quantity_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Product Quantity', 'masterelements' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'product_quantity_color',
            [
                'label' => __( 'Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-cart-product-quantity' => 'color: {{VALUE}}',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'product_quantity_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .custom-cart-product-quantity',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_style_buttons',
            [
                'label' => __( 'Buttons', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );



        $this->add_control(
            'heading_view_cart_button_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'View Cart', 'masterelements' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'view_cart_button_text_color',
            [
                'label' => __( 'Text Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-cart-view-cart-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'view_cart_button_background_color',
            [
                'label' => __( 'Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-cart-view-cart-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'view_cart_border',
                'selector' => '{{WRAPPER}} .custom-cart-view-cart-button',
            ]
        );

        $this->add_control(
            'heading_checkout_button_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Checkout', 'masterelements' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'checkout_button_text_color',
            [
                'label' => __( 'Text Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-cart-checkout-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'checkout_button_background_color',
            [
                'label' => __( 'Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .custom-cart-checkout-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'checkout_border',
                'selector' => '{{WRAPPER}} .custom-cart-checkout-button',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();

        global $woocommerce;

        $items = $woocommerce->cart->get_cart();

        $total_price = WC()->cart->get_cart_total();

        echo '<div class="cart-all-background">';
        ?>
        <button class="cart-button-with-logox" onclick="myFunction()"><div class="cart-button-icon"><?php Icons_Manager::render_icon( $settings['cart_icon_select'] ); ?></div><span class="cart-total-itemsx"><?php echo  count(WC()->cart->get_cart())  ?></span></button>
        <a href="<?php echo wc_get_cart_url() ?>" style="display: none" class="my-cart-total">Cart (<?php echo  count(WC()->cart->get_cart())  ?>)</a>
        <?php

        echo '<div id="custom-cart-widget-div-id" class="custom-cart-widget-div-class" style="display: none">';


        foreach($items as $item => $values) {

            $_product =  wc_get_product( $values['data']->get_id());

            $cart_item_remove_url = wc_get_cart_remove_url( $item );

            ?>
            <div class="custom-menu-cart">
            <a class="remove" href="--><?php echo $cart_item_remove_url ?>" >x</a>
            <?php

            $getProductDetail = wc_get_product( $values['product_id'] );

            echo '<a href="'. wc_get_cart_url() .'" >';
            echo '<div class="custom-cart-image">';
            echo $getProductDetail->get_image();
            echo '</div>';
            echo "</a>";
            echo '<div class="custom-cart-product-title">';
            echo "<b>".$_product->get_title().'</b><br>';
            echo '</div>';
            echo '<div class="custom-cart-product-quantity">';
            echo 'Quantity: '.$values['quantity'].'<br>';
            echo '</div>';
            echo '<div class="custom-cart-product-price">';
            $price = get_post_meta($values['product_id'] , '_price', true);
            echo "  $ ".$price."<br>";
            echo '</div>';
            echo '</div>';
            
        }

        echo '<div class="custom-cart-price">';
        echo "<b>Total price:".$total_price."<br>";
        echo '</div>';
        echo '<div class="custom-cart-button">';
        echo '<a href="'. wc_get_checkout_url() .'" >';
        echo '<button class="custom-cart-checkout-button"> CHECKOUT </button><br>';
        echo "</a>";
        echo '<a href="'. wc_get_cart_url() .'" >';
        echo '<button class="custom-cart-view-cart-button"> VIEW CART </button><br>';
        echo "</a>";
        echo '</div>';
        echo '</div>';


        ?>


        </div>
        <?php

    }

}
