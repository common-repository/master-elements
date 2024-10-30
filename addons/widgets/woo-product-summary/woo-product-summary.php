<?php
namespace Elementor;

use MasterElements\Master_Woocommerce_Functions;

if ( ! defined( 'ABSPATH' ) ) exit;

class Master_Woo_Product_Summary extends Widget_Base {
    private static $product_id = null;

    public function __construct( $data = [], $args = null ) {

        parent::__construct( $data, $args );

	

    }


    public function get_name() {
        return 'woo-product-summary';
    }

    public function get_title() {
        return __( 'MW: Product Summary', 'masterelements' );
    }

    public function get_categories() {
        return array( 'master-addons' );
    }
    public function get_icon() {
        return 'eicon-product-description';
    }
    
    protected function _register_controls() 
    {

        $this->start_controls_section(
            'me_product_summary_section_style',
            array(
                'label' => __( 'Product Summary', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'me_product_summary_color',
            [
                'label'     => __( 'Text Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-product-details__short-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'me_product_summary_typography',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .woocommerce-product-details__short-description',
            )
        );

        $this->add_responsive_control(
            'me_product_summary_align',
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
                'prefix_class' => 'elementor%s-align-',
                'default'      => 'left',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * WooCommerce Classes, Actions and Filters Used in this Function
     */
    protected function render()
    {

        $post_type = get_post_type();
        $master_product_summary = new Master_Woocommerce_Functions();
        if ('product' == $post_type) {
            $master_product_summary::mw_product_summary();
        } else if ($master_product_summary::mw_is_is_edit_mode()) {
            echo '<div class="woocommerce"><div class="product">';
            echo '<div class="woocommerce-product-details__short-description">
                    <p>This is the products summary</p>
                    <p>Summary Text will appear here</p>
                </div>';
            echo '</div></div>';
        }
    }
}