<?php
namespace Elementor;


use MasterElements\Master_Woocommerce_Functions;

if ( ! defined( 'ABSPATH' ) ) exit;

class Master_Woo_Product_Title extends Widget_Base {
    private static $product_id = null;

    public function __construct( $data = [], $args = null ) {

        parent::__construct( $data, $args );

    }

    public function get_name() {
        return 'woo-product-title';
    }

    public function get_title() {
        return __( 'MW: Product Title', 'masterelements' );
    }

    public function get_categories() {
        return array( 'master-addons' );
    }
    public function get_icon() {
        return 'eicon-product-title';
    }
    protected function _register_controls() {

        $this->start_controls_section(
            'me_product_title_content',
            [
                'label' => __( 'Product Title', 'masterelements' ),
            ]
        );
            $this->add_control(
                'me_product_title_html_tag',
                [
                    'label'   => __( 'Title HTML Tag', 'masterelements' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        'h1'   => __( 'H1', 'masterelements' ),
                        'h2'   => __( 'H2', 'masterelements' ),
                        'h3'   => __( 'H3', 'masterelements' ),
                        'h4'   => __( 'H4', 'masterelements' ),
                        'h5'   => __( 'H5', 'masterelements' ),
                        'h6'   => __( 'H6', 'masterelements' ),
                        'p'    => __( 'p', 'masterelements' ),
                        'div'  => __( 'div', 'masterelements' ),
                        'span' => __( 'span', 'masterelements' ),
                    ],
                    'default' => 'h1',
                ]
            );

        $this->end_controls_section();

        // Product Style
        $this->start_controls_section(
            'me_product_title_style_section',
            array(
                'label' => __( 'Product Title', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_control(
                'me_product_title_color',
                [
                    'label'     => __( 'Title Color', 'masterelements' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .product_title' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'me_product_title_typography',
                    'label'     => __( 'Typography', 'masterelements' ),
                    'selector'  => '{{WRAPPER}} .product_title',
                )
            );

            $this->add_responsive_control(
                'me_product_title_margin',
                [
                    'label' => __( 'Inner Margin', 'masterelements' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .product_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'me_product_title_align',
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
            );

        $this->end_controls_section();

    }

    /**
     * WooCommerce Classes, Actions and Filters Used in this Function
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $master_product_title = new Master_Woocommerce_Functions();
        $post_type = get_post_type();

        if ('product' == $post_type) {
            $title = $master_product_title::mw_product_title();
            echo sprintf('<%1$s class="product_title entry-title">' . __($title, 'masterelements') . '</%1$s>', $settings['me_product_title_html_tag']);
        } else {
            echo sprintf(the_title('<%1$s class="product_title entry-title">', '</%1s>', false), $settings['me_product_title_html_tag']);
        }
    }

}
