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



class Master_Woo_Next_Prev_Button extends Widget_Base
{

    private static $product_id = null;


    public function __construct($data = [], $args = null)
    {


        parent::__construct($data, $args);
        wp_register_style( 'icon-style',  \MasterElements::widgets_url() . '/woo-next-prev-button/css.css', false, \MasterElements::version );


    }
    public function get_style_depends() {

        return [ 'icon-style' ];

    }

    public function get_name()
    {

        return 'woo-next-prev-button';

    }

    public function get_title()
    {

        return __('MW: Single Product Pagination', 'masterelements');

    }

    public function get_categories()
    {

        return array('master-addons');

    }

    public function get_icon()
    {

        return 'eicon-table';

    }

    protected function _register_controls(){

        $this->start_controls_section(
            'me_pagination_button',
            [
                'label' => __( 'Pagination Button', 'masterelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'me_pagination_button_before',
            [
                'label' => __('Show Button Before Product', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => '',
            ]
        );

        $this->add_control(
            'me_pagination_button_after',
            [
                'label' => __('Show Button After Product', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => '',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'me_pagination_button_text',
            [
                'label' => __( 'Previous/Next Style', 'masterelements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('me_pagination_button_style_tabs');

        // Start Normal Submit button tab
        $this->start_controls_tab(
            'me_pagination_button_normal_tab',
            [
                'label' => __( 'Normal', 'masterelements' ),
            ]
        );
        $this->add_control(
            'me_pagination_button_text_color',
            [
                'label'     => __( 'Text Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prev_next_buttons a[rel="next"]'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'me_pagination_button_bg_color',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prev_next_buttons a[rel="next"]' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_pagination_button_border',
                'label' => __( 'Border', 'masterelements' ),
                'selector' => '{{WRAPPER}} .prev_next_buttons a[rel="next"]',
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'me_pagination_button_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .prev_next_buttons a[rel="next"]' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_responsive_control(
            'me_pagination_button_margin',
            [
                'label' => esc_html__( 'Margin', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .prev_next_buttons a[rel="next"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'me_pagination_button_hover_tab',
            [
                'label' => __( 'Hover', 'masterelements' ),
            ]
        );
        $this->add_control(
            'me_pagination_button_text_color_hover',
            [
                'label'     => __( 'Text Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prev_next_buttons a[rel="next"]:hover'   => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'me_pagination_button_bg_color_hover',
            [
                'label' => __('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .prev_next_buttons a[rel="next"]:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'me_pagination_button_border_hover',
                'label' => __( 'Border', 'masterelements' ),
                'selector' => '{{WRAPPER}} .prev_next_buttons a[rel="next"]:hover',
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'me_pagination_button_border_radius_hover',
            [
                'label' => esc_html__( 'Border Radius', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .prev_next_buttons a[rel="next"]:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    function master_prev_next_product(){

        echo '<div class="prev_next_buttons">';

        $previous = next_post_link('%link', '&larr; PREVIOUS', TRUE, ' ', 'product_cat');
        $next = previous_post_link('%link', 'NEXT &rarr;', TRUE, ' ', 'product_cat');

        echo $previous;
        echo $next;

        echo '</div>';

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $master_button = new Master_Woocommerce_Functions();
        if ( $master_button :: mw_is_is_edit_mode() ) {

            echo "Previous and Next Button will be shown on the page this addon is applied on.";
        }
        else{

            if( $settings['me_pagination_button_before'] == 'true')
            {
                add_action('woocommerce_before_single_product', array($this, 'master_prev_next_product'));
                do_action( 'woocommerce_before_single_product', array($this, 'master_prev_next_product') );
            }
           elseif($settings['me_pagination_button_after'] == 'true'){
               add_action('woocommerce_after_single_product', array($this, 'master_prev_next_product'));
               do_action( 'woocommerce_after_single_product', array($this, 'master_prev_next_product') );
           }

        }

    }
}
