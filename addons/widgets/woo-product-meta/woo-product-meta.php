<?php
namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;

if ( ! defined( 'ABSPATH' ) ) exit; 

class Master_Woo_Product_Meta extends Widget_Base {
    private static $product_id = null;

    public function __construct( $data = [], $args = null ) {

        parent::__construct( $data, $args );
    }

    public function get_name() {
        return 'woo-product-meta';
    }

    public function get_title() {
        return __( 'Woo Product Meta', 'masterelements' );
    }

    public function get_categories() {
        return array( 'master-addons' );
    }
    public function get_icon() {
        return 'eicon-product-meta';
    }

    
    protected function _register_controls() {

            
            $this->start_controls_section(
                'me_product_meta_section_style',
                array(
                    'label' => __( 'Style Product Meta', 'masterelements' ),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                )
            );

            $this->add_control(
                'me_product_meta_breadcrumbs_color',
                [
                    'label'     => __( 'Text Color', 'masterelements' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product_meta' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'me_product_meta_breadcrumbs_link_color',
                [
                    'label'     => __( 'Link Color', 'masterelements' ),
                    'type'      => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product_meta a' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'product_breadcrumbs_typography',
                    'label'     => __( 'Typography', 'masterelements' ),
                    'selector'  => '{{WRAPPER}} .product_meta, {{WRAPPER}} .product_meta a',
                )
            );

            $this->add_responsive_control(
                'me_product_meta_breadcrumbs_align',
                [
                    'label'        => __( 'Alignment', 'masterelements' ),
                    'type'         => \Elementor\Controls_Manager::CHOOSE,
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
                    'prefix_class' => 'elementor%s-align-',
                    'default'      => 'left',
                ]
            );

            $this->end_controls_section();

        }


    /**
     * Some Functions, Classes used in Render function is Taken From WooCommerce
     */
    protected function render()
    {

        $post_type = get_post_type();
        $master_product_meta = new Master_Woocommerce_Functions();
        if ('product' == $post_type) {
            $master_product_meta::mw_template_single_meta();
        }
        else if ($master_product_meta::mw_is_is_edit_mode())
        {
            echo '<div class="woocommerce"><div class="product">';
            echo '<div class="product_meta">
                <span class="sku_wrapper">SKU: <span class="sku">1234</span></span>
                <span class="posted_in">Category: <a href="#" rel="tag">Example Category</a></span>
                <span class="tagged_as">Tag: <a href="#" rel="tag">Example Tag</a></span>
                </div>';
            echo '</div></div>';
        }
    }
}