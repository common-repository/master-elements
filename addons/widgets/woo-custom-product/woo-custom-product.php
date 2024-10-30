<?php



namespace Elementor;



use MasterElements\Master_Woocommerce_Functions;



if (!defined('ABSPATH')) exit; // Exit if accessed directly



class Master_Woo_Custom_Product extends Widget_Base

{



    public function __construct( $data = [], $args = null ) {



        parent::__construct( $data, $args );

        wp_register_style('me-woo-custom-product-css', \MasterElements::widgets_url() . '/woo-custom-product/css/woo-custom-product.css', false, \MasterElements::version);

    }

    public function get_style_depends()

    {

        return ['me-woo-custom-product-css'];



    }


    public function get_name()

    {

        return 'woo-custom-product';

    }


    public function get_title()

    {

        return __('Woo Custom Product', 'masterelements');

    }


    public function get_categories()

    {

        return array('master-addons');

    }


    public function get_icon()

    {

        return 'eicon-product-rating';

    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'masterelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number_of_products',
            [
                'label' => __('Number of Products to Show', 'masterelements'),
                'tab' => Controls_Manager::NUMBER,
            ]
        );

        $this->add_control(

            'content_divider',

            [

                'type' => Controls_Manager::DIVIDER,

            ]

        );


        $this->add_control(
            'number_of_description_words',
            [
                'label' => __('Number of Words to Show in Description', 'masterelements'),
                'tab' => Controls_Manager::NUMBER,
            ]
        );

        $this->add_responsive_control(
            'custom_padding',
            [
                'label' => __( 'Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );


        $this->add_responsive_control(

            'custom_margin',

            [

                'label' => __('Margin', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .nextflex' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

//        $this->add_responsive_control(
//
//            'number_of_columns',
//
//            [
//
//                'label' => __('Columns', 'masterelements'),
//
//                'type' => Controls_Manager::NUMBER,
//
//                'prefix_class' => 'masterelements-columns%s-',
//
//                'min' => 1,
//
//                'max' => 12,
//
//                'default' => 4,
//
//                'required' => true,
//
//
//
//            ]
//
//        );
//
//        $this->add_control(
//
//            'number_of_rows',
//
//            [
//
//                'label' => __('Rows', 'masterelements'),
//
//                'type' => Controls_Manager::NUMBER,
//
//                'default' => 4,
//
//                'render_type' => 'template',
//
//                'range' => [
//
//                    'px' => [
//
//                        'max' => 20,
//
//                    ],
//
//                ],
//
//            ]
//
//        );


        $this->end_controls_section();




        $this->start_controls_section(
            'style_section',
            [
                'label'=> __('Title Style','masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]

        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color','masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [

                    '{{WRAPPER}} .masterelement-title' => 'color: {{VALUE}}!important',

                ],
            ]

        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'custom_title_typography',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .masterelement-title',
            )
        );

        $this->add_responsive_control(
            'custom_title_padding',
            [
                'label' => __( 'Title Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .masterelement-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );



//        $this->add_control(
//            'title_align',
//            [
//                'label' => __('Title Align','masterelements'),
//                'type' => \Elementor\Controls_Manager::CHOOSE,
//
//                'options'=> [
//                    'left'=> [
//                        'label' => 'Left',
//                        'icon'  => 'fa fa-align-left',
//                    ],
//                    'center'=> [
//                        'label' => 'Center',
//                        'icon'  => 'fa fa-align-center',
//                    ],
//                    'Right'=> [
//                        'label' => 'Right',
//                        'icon'  => 'fa fa-align-right',
//                    ],
//                ],
//                'default' => 'left',
//
//            ]
//        );

        $this->end_controls_section();


        $this->start_controls_section(
            'price_style_section',
            [
                'label'=> __('Price Style','masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __('price Color','masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [

                    '{{WRAPPER}} .masterelement-price' => 'color: {{VALUE}}!important',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'custom_price_typography',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .masterelement-price',
            )
        );


//        $this->add_control(
//            'price_align',
//            [
//                'label' => __('Price Align','masterelements'),
//                'type' => \Elementor\Controls_Manager::CHOOSE,
//
//                'options'=> [
//                    'left'=> [
//                        'label' => 'Left',
//                        'icon'  => 'fa fa-align-left',
//                    ],
//                    'center'=> [
//                        'label' => 'Center',
//                        'icon'  => 'fa fa-align-center',
//                    ],
//                    'Right'=> [
//                        'label' => 'Right',
//                        'icon'  => 'fa fa-align-right',
//                    ],
//                ],
//                'default' => 'left',
//
//            ]
//        );

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style_section',
            [
                'label'=> __('Content Style','masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __('Content Color','masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [

                    '{{WRAPPER}} .masterelement-content' => 'color: {{VALUE}}!important',

                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'custom_content_typography',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .masterelement-content',
            )
        );


        $this->add_responsive_control(
            'custom_content_padding',
            [
                'label' => __( 'Content Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .masterelement-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );


        $this->add_control(
            'content_align',
            [
                'label' => __('Content Align','masterelements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,

                'options'=> [
                    'left'=> [
                        'label' => 'Left',
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'=> [
                        'label' => 'Center',
                        'icon'  => 'fa fa-align-center',
                    ],
                    'Right'=> [
                        'label' => 'Right',
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',

            ]
        );
        $this->end_controls_section();



        $this->start_controls_section(
            'rating_style_section',
            [
                'label'=> __('Rating Style','masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(

            'custom_rating_color',

            [

                'label' => __('Rating Start Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .custom-star-rating' => 'color: {{VALUE}} !important;',

                    '{{WRAPPER}} .custom-woo-product-me' => 'color: {{VALUE}} !important;',


                ],

            ]

        );



        $this->add_responsive_control(

            'me_custom_rating_margin',

            [

                'label' => __('Margin', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .custom-woo-product-me' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );




//        $this->add_control(
//
//            'custom_empty_rating_color',
//
//            [
//
//                'label' => __('Empty Rating Start Color', 'masterelements'),
//
//                'type' => Controls_Manager::COLOR,
//
//                'selectors' => [
//
//                    '{{WRAPPER}} .woocommerce ul.products li.product .star-rating::before' => 'color: {{VALUE}}',
//
//                    '{{WRAPPER}} .woocommerce .star-rating::before' => 'color: {{VALUE}} !important',
//
//                ],
//
//            ]
//
//        );
//
//
//
//        $this->add_control(
//
//            'custom_star_size',
//
//            [
//
//                'label' => __('Star Size', 'masterelements'),
//
//                'type' => Controls_Manager::SLIDER,
//
//                'size_units' => ['px', 'em', '%'],
//
//                'selectors' => [
//
//                    '{{WRAPPER}} .woocommerce ul.products li.product .star-rating' => 'font-size: {{SIZE}}{{UNIT}}',
//
//                    '{{WRAPPER}} .woocommerce .star-rating' => 'font-size: {{SIZE}}{{UNIT}} !important',
//
//                ],
//
//            ]
//
//        );



//        $this->add_group_control(
//            Group_Control_Typography::get_type(),
//            array(
//                'name'      => 'custom_rating_typography',
//                'label'     => __( 'Typography', 'masterelements' ),
//                'selector'  => '{{WRAPPER}} .masterelement-rating',
//            )
//        );

//        $this->add_control(
//            'rating_icon',
//            [
//                'label' => __('Rating Icon','masterelements'),
//                'type' => \Elementor\Controls_Manager::ICON,
//            ]
//        );


//        $this->add_control(
//            'rating_align',
//            [
//                'label' => __('Rating Align','masterelements'),
//                'type' => \Elementor\Controls_Manager::CHOOSE,
//
//                'options'=> [
//                    'left'=> [
//                        'label' => 'Left',
//                        'icon'  => 'fa fa-align-left',
//                    ],
//                    'center'=> [
//                        'label' => 'Center',
//                        'icon'  => 'fa fa-align-center',
//                    ],
//                    'Right'=> [
//                        'label' => 'Right',
//                        'icon'  => 'fa fa-align-right',
//                    ],
//                ],
//                'default' => 'left',
//
//            ]
//        );

        $this->end_controls_section();


        $this->start_controls_section(
            'button_style_section',
            [
                'label'=> __('Button Style','masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __('Button Color','masterelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [

                    '{{WRAPPER}} .masterelement-button' => 'color: {{VALUE}}!important',

                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __( 'Button Background Color', 'masterelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .masterelement-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'      => 'custom_button_typography',
                'label'     => __( 'Typography', 'masterelements' ),
                'selector'  => '{{WRAPPER}} .masterelement-button',
            )
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'custom_button_border',

                'label' => __( 'Border', 'masterelements' ),

                'selector' => '{{WRAPPER}} .masterelement-button',
            ]
        );

        $this->add_responsive_control(
            'custom_button_padding',
            [
                'label' => __( 'Button Padding', 'masterelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .masterelement-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );


        $this->end_controls_section();



        $this->start_controls_section(
            'image_resize_section',
            [
                'label'=> __('Image Resize','masterelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'img_dimension',
            [
                'label' => __( 'Image Dimension', 'masterelements' ),
                'type' => Controls_Manager::IMAGE_DIMENSIONS,
                'description' => __( '<b>Crop the original image size to any custom size. Set custom width or height.</b>', 'masterelements' ),
                'default' => [
                    'width' => '',
                    'height' => '',
                ],
            ]
        );

        $this->end_controls_section();


    }

//    public function custom_product_limit($limit = 3)
//
//    {
//
//        $limit = ($this->get_settings_for_display('number_of_columns') * $this->get_settings_for_display('number_of_rows'));
//
//        return $limit;
//
//    }

    protected function render()
    {


        $settings = $this->get_settings_for_display();
        global $post;

        $args = array('posts_per_page' => $settings['number_of_products'], 'post_type' => 'product');
        $post_id = $post->ID;
        $product = wc_get_product( $post_id );
        $custom_query = new \WP_Query( $args );


//        add_filter('product_custom_limit', array($this, 'custom_product_limit'));

        if ( $custom_query->have_posts() ) {
            echo '<div id="recent-posts" class="me-products flex space-between">';

            while ( $custom_query->have_posts() ) {

                    $custom_query->the_post();
                global $product;
                echo '<a class="nextflex" href="'. get_the_permalink() .'" >';

                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->post->ID ), $settings['img_dimension'] );
                $array = $settings['img_dimension'];
                $width = $array['width'];
                $height = $array['height'];


                ?>


                <style>
                    .card {
                        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                        transition: 0.3s;
                        width: 100%;
                    }

                    .card:hover {
                        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
                    }

                    .container {
                        padding: 0px 0px;
                    }
                </style>

                <div class="card" style="text-align:center">

                    <img src="<?php  echo $image[0]; ?>" style="width:<?= $width ?>px; height:<?= $height ?>px" data-id="<?php echo $product->post->ID; ?>">

                    <div class="container">

                        <div class="woo-product-alignment">
                        <h3 class="masterelement-title"> <?= $product->name ?></h3>

                        <p class="masterelement-price"> <?= $product->price ?> <br></p>
                    </div>

                        <p class="masterelement-content" style="text-align: <?= $settings['content_align']?>"> <?=

                             substr_replace($product->description, "...", $settings['number_of_description_words']);

                            ?> <br></p>

                        <div class="woo-product-alignment">
                        <?php
                        $master_product_rating = new Master_Woocommerce_Functions();

                        global $product;

                        $product = $master_product_rating::mw_wc_get_product();


                        $post_type = get_post_type();

                        if ('product' == $post_type) {

                            $count_rating = $master_product_rating::mw_wc_get_product()->get_rating_count();

                            $review = $master_product_rating::mw_wc_get_product()->get_review_count();

                            $avg = $master_product_rating::mw_wc_get_product()->get_average_rating();

                            ?>



                            <div class="product custom-product">

                                <div class="me_woocommerce-product-rating custom-woo-product-me">

                                    <?php echo $master_product_rating::mw_get_rating($avg, $count_rating); ?>

                                </div>

                            </div>


                            <?php

                        } else {

                            echo '<div class="woocommerce-custom single-product"><div class="product custom-product">';


                            echo '<div class="me_woocommerce-product-rating custom-woo-product-me">


            <div class="star-rating custom-star-rating"><span style="width:80%">Rated <strong class="rating">4.00</strong> out of 5 based on <span class="rating">1</span> customer rating</span></div>		<a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<span class="count">1</span> customer review)</a>	<br></div>';


                            echo '</div></div>';

                        }
                        ?>

                        <button class="masterelement-button"> <i class="fa fa-plus"></i> <br></button>
                        </div>
                    </div>
                </div>

<?php

                echo "</a>";

                }
            echo '</div>';

            }
        wp_reset_postdata();

    }

}
