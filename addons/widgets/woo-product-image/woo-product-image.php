<?php

namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Master_Woo_Product_Image extends Widget_Base
{

    public function __construct($data = [], $args = null)
    {

        parent::__construct($data, $args);

        wp_register_style('woo-widgets-css', \MasterElements::widgets_url() . '/woo-product-image/assets/css/woo-widgets.css', false, \MasterElements::version);

    }


    public function get_name()
    {
        return 'woo-product-image';
    }

    public function get_title()
    {
        return __('Woo Product Image', 'masterelements');
    }

    public function get_icon()
    {
        return 'eicon-product-images';
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

    protected function _register_controls()
    {

        // Product Image Style
        $this->start_controls_section(
            'product_image_style_section',
            array(
                'label' => __('Image', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_image_border',
                'selector' => '.woocommerce {{WRAPPER}} .woocommerce-product-gallery__trigger + .woocommerce-product-gallery__wrapper,
                    .woocommerce {{WRAPPER}} .flex-viewport',
            ]
        );

        $this->add_responsive_control(
            'product_image_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .woocommerce-product-gallery__trigger + .woocommerce-product-gallery__wrapper,
                        .woocommerce {{WRAPPER}} .flex-viewport' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .flex-viewport:not(:last-child)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        /*$this->add_responsive_control(
            'me_zoom_icon_align',
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
                ],
                'prefix_class' => 'elementor-align-%s',
                'default'      => 'left',
            ]
        );*/

        $this->end_controls_section();

        // Product Thumbnails Style
        $this->start_controls_section(
            'product_thumbnails_image_style_section',
            array(
                'label' => __('Thumbnails', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'product_thumbnails_border',
                'label' => __('Thumbnails Border', 'masterelements'),
                'selector' => '.woocommerce {{WRAPPER}} .flex-control-thumbs img',
            ]
        );

        $this->add_responsive_control(
            'product_thumbnails_border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .flex-control-thumbs img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'product_thumbnails_spacing',
            [
                'label' => __('Spacing', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '.woocommerce {{WRAPPER}} .flex-control-thumbs li' => 'padding-right: calc({{SIZE}}{{UNIT}} / 2); padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-bottom: {{SIZE}}{{UNIT}}',
                    '.woocommerce {{WRAPPER}} .flex-control-thumbs' => 'margin-right: calc(-{{SIZE}}{{UNIT}} / 2); margin-left: calc(-{{SIZE}}{{UNIT}} / 2)',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'me_sale_sticker_style_section',
            array(
                'label' => __('Sale Sticker', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'me_sale_sticker_color',
            [
                'label' => __('Sale Text Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce span.onsale, span.onsale' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'product_onsale_background_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.woocommerce span.onsale, span.onsale ' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}}.woocommerce span.onsale, span.onsale' => 'background-color: {{VALUE}} !important',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name' => 'me_sale_sticker_title_typography',
                'label' => __('Typography', 'masterelements'),
                'selector' => '{{WRAPPER}} .onsale',
            )
        );

        $this->add_responsive_control(
            'me_sale__margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .onsale' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );


        $this->end_controls_section();
    }

    /**
     * Some Functions, Classes used in Render function is Taken From WooCommerce
     */
    protected function render()
    {
        global $product;
        $settings = $this->get_settings_for_display();
        $master_product_image = new Master_Woocommerce_Functions();
        $product = $master_product_image::mw_wc_get_product();

        if ($master_product_image::mw_is_is_edit_mode()) {

            echo '<div class="woocommerce"><div class="product">';

            $product_columns = apply_filters('woocommerce_product_thumbnails_columns', 4);

            $single_product_classes = apply_filters('woocommerce_single_product_image_gallery_classes', array(

                'woocommerce-product-gallery',

                'woocommerce-product-gallery--columns-' . absint($product_columns),

                'images',

            ));

            ?>

            <div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $single_product_classes))); ?>"
                 data-columns="<?php echo esc_attr($product_columns); ?>"
                 style="opacity: 1; transition: opacity .25s ease-in-out; width:auto; float:none;">

                <figure class="woocommerce-product-gallery__wrapper">

                    <?php

                    $html = '<div class="woocommerce-product-gallery__image--placeholder">';

                    $html .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url($master_product_image::mw_wc_placeholder_img_src()), esc_html__('Loading product image', 'woocommerce'));

                    $html .= '</div>';

                    echo apply_filters('woocommerce_single_product_image_thumbnail_html', $html, null);

                    ?>
                </figure>
            </div>
            <?php
            echo '</div></div>';
        } else {
            if (empty($product)) {
                return;
            }
            echo '<div class="product-img-case" style="width:auto;">';
            global $me_product_image_gallery, $me_extra_images;
            if (isset($me_extra_images['product_gallery']) && $me_extra_images['product_gallery'] == 1) {
                $master_product_image::mw_product_sale_flash();
            } else {
                $master_product_image::mw_product_sale_flash();
                $master_product_image::mw_product_images();
            }
            echo '</div>';
        }
    }

}
