<?php
/**
 * Created by PhpStorm.
 * User: abdul
 * Date: 7/8/2020
 * Time: 3:33 PM
 */

namespace Elementor;

if (!defined('ABSPATH')) exit;

class Master_Custom_Posts extends Widget_Base
{
    public $base;

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_style('carousel-css', __DIR__ . '/assets/css/owl.carousel.css', false, \MasterElements::version, false);
        wp_register_style('style-css', __DIR__ . '/assets/css/style.css', false, \MasterElements::version, false);
        add_action('elementor/editor/after_enqueue_scripts', function () {
            wp_enqueue_script('carousel-js', __DIR__ . '/assets/js/owl.carousel.min.js', array('jquery'), \MasterElements::version, false);
        });
        add_action('elementor/editor/after_enqueue_scripts', function () {
            wp_enqueue_script('main-js', __DIR__ . '/assets/js/main.js', array('jquery'), \MasterElements::version, false);
        });

    }

    public function get_name()
    {
        return 'custom-posts';
    }

    public function get_title()
    {
        return 'Master Custom Posts';
    }

    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        // Start Posts Query
        $this->start_controls_section(
            'start_section_posts_query',
            [
                'label' => esc_html__('Query', 'master-addon'),
            ]
        );

        $this->add_control(
            'me_posts_type',
            [
                'label' => esc_html__('Posts Source', 'master-addon'),
                'type' => Controls_Manager::SELECT,
                'options' => \MasterElements::me_get_all_post_types(),
                'default' => 'post',
            ]
        );

        $this->add_control(
            'me_posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'master-addon'),
                'type' => Controls_Manager::NUMBER,
                'default' => '2',
            ]
        );

        $this->add_control(
            'me_order_by',
            [
                'label' => esc_html__('Order By', 'master-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => 'Date',
                    'ID' => 'Post ID',
                    'title' => 'Title',
                ],
            ]
        );

        $this->add_control(
            'me_order',
            [
                'label' => esc_html__('Order', 'master-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'desc' => 'Descending',
                    'asc' => 'Ascending',
                ],
            ]
        );

        $this->add_control(
            'me_posts_categories',
            [
                'label' => esc_html__('Categories', 'master-addon'),
                'type' => Controls_Manager::SELECT2,
                'options' => \MasterElements::me_get_all_taxonomies(),
                'label_block' => true,
                'multiple' => true,
                'condition' => [
                    'posts_type' => 'post',
                ]
            ]
        );

        $this->add_control(
            'me_exclude',
            [
                'label' => esc_html__('Exclude', 'master-addon'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__('Post Ids Will Be Inorged. Ex: 1,2,3', 'master-addon'),
                'default' => '',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
        // End Posts Query

        // Start Layout
        $this->start_controls_section(
            'section_posts_layout',
            [
                'label' => esc_html__('Layout', 'master-addon'),
            ]
        );

        $this->add_control(
            'me_posts_layout_type',
            [
                'label' => esc_html__('Type', 'master-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'list' => [
                        'title' => esc_html__('List', 'master-addon'),
                        'icon' => 'eicon-post-list',
                    ],
                    'grid' => [
                        'title' => esc_html__('Grid', 'master-addon'),
                        'icon' => 'eicon-posts-grid',
                    ],
                    'masonry' => [
                        'title' => esc_html__('Masonry', 'master-addon'),
                        'icon' => 'eicon-posts-masonry',
                    ],
                ],
                'default' => 'grid',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'posts_layout',
            [
                'label' => esc_html__('Columns', 'master-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'column-2',
                'options' => [
                    'column-1' => esc_html__('1', 'master-addon'),
                    'column-2' => esc_html__('2', 'master-addon'),
                    'column-3' => esc_html__('3', 'master-addon'),
                    'column-4' => esc_html__('4', 'master-addon'),
                    'column-5' => esc_html__('5', 'master-addon'),
                    'column-6' => esc_html__('6', 'master-addon'),
                ],
                'condition' => [
                    'me_posts_layout_type!' => 'list',
                ],
            ]
        );

        $this->add_control(
            'heading_image',
            [
                'label' => esc_html__('Image', 'master-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_image',
            [
                'label' => esc_html__('Show Image', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'image_position',
            [
                'label' => esc_html__('Image Position', 'master-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top' => esc_html__('Top', 'master-addon'),
                    'middle' => esc_html__('Middle', 'master-addon'),
                    'bottom' => esc_html__('Bottom', 'master-addon'),
                ],
                'condition' => [
                    'show_image' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'condition' => [
                    'show_image' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'featured_width',
            [
                'label' => esc_html__('Width', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 40,
                ],
                'selectors' => [
                    '.me-posts-wrap .me-posts.list .blog-post .featured-post' => 'width: {{SIZE}}{{UNIT}};',
                    '.me-posts-wrap .me-posts.list .blog-post .content' => 'width: calc(100% - {{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'heading_content',
            [
                'label' => esc_html__('Content', 'master-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label' => esc_html__('Show Excerpt', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'excerpt_lenght',
            [
                'label' => esc_html__('Excerpt Length', 'master-addon'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 500,
                'step' => 1,
                'default' => 30,
                'condition' => [
                    'show_excerpt' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'heading_button',
            [
                'label' => esc_html__('Button', 'master-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_button',
            [
                'label' => esc_html__('Show Button', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'master-addon'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read More', 'master-addon'),
                'condition' => [
                    'show_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_meta',
            [
                'label' => esc_html__('Meta', 'master-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_meta',
            [
                'label' => esc_html__('Show Meta', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'meta_position',
            [
                'label' => esc_html__('Meta Position', 'master-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top' => esc_html__('Before Title', 'master-addon'),
                    'bottom' => esc_html__('After Title', 'master-addon'),
                ],
                'condition' => [
                    'show_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_author',
            [
                'label' => esc_html__('Show Author', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label' => esc_html__('Show Category', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label' => esc_html__('Show Date', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_meta' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_comment',
            [
                'label' => esc_html__('Show Comment', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'show_meta' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
        // End Layout

        // Start Carousel
        $this->start_controls_section(
            'section_posts_carousel',
            [
                'label' => esc_html__('Carousel', 'master-addon'),
            ]
        );

        $this->add_control(
            'carousel',
            [
                'label' => esc_html__('Carousel', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'master-addon'),
                'label_off' => esc_html__('Off', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'me_posts_layout_type!' => 'masonry',
                ],
            ]
        );

        $this->add_control(
            'carousel_loop',
            [
                'label' => esc_html__('Loop', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'master-addon'),
                'label_off' => esc_html__('Off', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'carousel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'carousel_auto',
            [
                'label' => esc_html__('Auto Play', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'master-addon'),
                'label_off' => esc_html__('Off', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'carousel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'carousel_spacer',
            [
                'label' => esc_html__('Spacer', 'master-addon'),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 100,
                'step' => 1,
                'default' => 30,
                'condition' => [
                    'carousel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'carousel_column_desk',
            [
                'label' => esc_html__('Columns Desktop', 'master-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => '2',
                'options' => [
                    '1' => esc_html__('1', 'master-addon'),
                    '2' => esc_html__('2', 'master-addon'),
                    '3' => esc_html__('3', 'master-addon'),
                    '4' => esc_html__('4', 'master-addon'),
                    '5' => esc_html__('5', 'master-addon'),
                    '6' => esc_html__('6', 'master-addon'),
                ],
                'condition' => [
                    'carousel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'carousel_column_tablet',
            [
                'label' => esc_html__('Columns Tablet', 'master-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('1', 'master-addon'),
                    '2' => esc_html__('2', 'master-addon'),
                    '3' => esc_html__('3', 'master-addon'),
                    '4' => esc_html__('4', 'master-addon'),
                    '5' => esc_html__('5', 'master-addon'),
                    '6' => esc_html__('6', 'master-addon'),
                ],
                'condition' => [
                    'carousel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'carousel_column_mobile',
            [
                'label' => esc_html__('Columns Mobile', 'master-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('1', 'master-addon'),
                    '2' => esc_html__('2', 'master-addon'),
                    '3' => esc_html__('3', 'master-addon'),
                    '4' => esc_html__('4', 'master-addon'),
                    '5' => esc_html__('5', 'master-addon'),
                    '6' => esc_html__('6', 'master-addon'),
                ],
                'condition' => [
                    'carousel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow',
            [
                'label' => esc_html__('Arrow', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'carousel' => 'yes',
                ],
                'description' => 'Just show when you have two slide',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'carousel_prev_icon', [
                'label' => esc_html__('Prev Icon', 'master-addon'),
                'type' => Controls_Manager::ICON,
                'default' => 'fas fa-chevron-left',
                'include' => [
                    'fas fa-angle-double-left',
                    'fas fa-angle-left',
                    'fas fa-chevron-left',
                    'fas fa-arrow-left',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_arrow' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'carousel_next_icon', [
                'label' => esc_html__('Next Icon', 'master-addon'),
                'type' => Controls_Manager::ICON,
                'default' => 'fas fa-chevron-right',
                'include' => [
                    'fas fa-angle-double-right',
                    'fas fa-angle-right',
                    'fas fa-chevron-right',
                    'fas fa-arrow-right',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_arrow' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'carousel_arrow_fontsize',
            [
                'label' => esc_html__('Font Size', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_arrow' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'w_size_carousel_arrow',
            [
                'label' => esc_html__('Width', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_arrow' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'h_size_carousel_arrow',
            [
                'label' => esc_html__('Height', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_arrow' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'carousel_arrow_horizontal_position_prev',
            [
                'label' => esc_html__('Horizontal Position Previous', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_arrow' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'carousel_arrow_horizontal_position_next',
            [
                'label' => esc_html__('Horizontal Position Next', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_arrow' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'carousel_arrow_vertical_position',
            [
                'label' => esc_html__('Vertical Position', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_arrow' => 'yes',
                ]
            ]
        );

        $this->start_controls_tabs(
            'carousel_arrow_tabs',
            [
                'condition' => [
                    'carousel_arrow' => 'yes',
                    'carousel' => 'yes',
                ]
            ]);
        $this->start_controls_tab(
            'carousel_arrow_normal_tab',
            [
                'label' => esc_html__('Normal', 'master-addon'),
            ]
        );
        $this->add_control(
            'carousel_arrow_color',
            [
                'label' => esc_html__('Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrow' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'carousel_arrow_bg_color',
            [
                'label' => esc_html__('Background Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#0080f0',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'carousel_arrow' => 'yes',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'carousel_arrow_border',
                'label' => esc_html__('Border', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next',
                'condition' => [
                    'carousel_arrow' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'carousel_arrow_border_radius',
            [
                'label' => esc_html__('Border Radius Previous', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_arrow' => 'yes',
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'carousel_arrow_hover_tab',
            [
                'label' => esc_html__('Hover', 'master-addon'),
            ]
        );
        $this->add_control(
            'carousel_arrow_color_hover',
            [
                'label' => esc_html__('Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev:hover, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next:hover' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_arrow' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'carousel_arrow_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev:hover, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'carousel_arrow' => 'yes',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'carousel_arrow_border_hover',
                'label' => esc_html__('Border', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev:hover, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next:hover',
                'condition' => [
                    'carousel_arrow' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'carousel_arrow_border_radius_hover',
            [
                'label' => esc_html__('Border Radius Previous', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-nav .owl-prev:hover, {{WRAPPER}} .me-posts-wrap .owl-nav .owl-next:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_arrow' => 'yes',
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'carousel_bullets',
            [
                'label' => esc_html__('Bullets', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'carousel' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'w_size_carousel_bullets',
            [
                'label' => esc_html__('Width', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-dots .owl-dot' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_bullets' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'h_size_carousel_bullets',
            [
                'label' => esc_html__('Height', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-dots .owl-dot' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_bullets' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'carousel_bullets_horizontal_position',
            [
                'label' => esc_html__('Horizonta Offset', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-dots' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_bullets' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'carousel_bullets_vertical_position',
            [
                'label' => esc_html__('Vertical Offset', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_bullets' => 'yes',
                ]
            ]
        );

        $this->start_controls_tabs(
            'carousel_bullets_tabs',
            [
                'condition' => [
                    'carousel' => 'yes',
                    'carousel_bullets' => 'yes',
                ]
            ]);
        $this->start_controls_tab(
            'carousel_bullets_normal_tab',
            [
                'label' => esc_html__('Normal', 'master-addon'),
            ]
        );
        $this->add_control(
            'carousel_bullets_bg_color',
            [
                'label' => esc_html__('Background Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#0080f0',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-dots .owl-dot' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_bullets' => 'yes',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'carousel_bullets_border',
                'label' => esc_html__('Border', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .owl-dots .owl-dot',
                'condition' => [
                    'carousel_bullets' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'carousel_bullets_border_radius',
            [
                'label' => esc_html__('Border Radius', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-dots .owl-dot' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_bullets' => 'yes',
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'carousel_bullets_hover_tab',
            [
                'label' => esc_html__('Hover', 'master-addon'),
            ]
        );
        $this->add_control(
            'carousel_bullets_hover_bg_color',
            [
                'label' => esc_html__('Background Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-dots .owl-dot:hover, {{WRAPPER}} .me-posts-wrap .owl-dots .owl-dot.active' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'carousel_bullets' => 'yes',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'carousel_bullets_border_hover',
                'label' => esc_html__('Border', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .owl-dots .owl-dot:hover, {{WRAPPER}} .me-posts-wrap .owl-dots .owl-dot.active',
                'condition' => [
                    'carousel_bullets' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'carousel_bullets_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .owl-dots .owl-dot:hover, {{WRAPPER}} .me-posts-wrap .owl-dots .owl-dot.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'carousel_bullets' => 'yes',
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        // End Carousel

        // Start Pagination
        $this->start_controls_section(
            'section_posts_pagination',
            [
                'label' => esc_html__('Pagination', 'master-addon'),
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => esc_html__('Pagination', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();
        // End Pagination

        // General Style
        $this->start_controls_section(
            'section_style_general',
            [
                'label' => esc_html__('General', 'master-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => esc_html__('Padding', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .column .blog-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '10',
                    'right' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                    'isLinked' => 'true',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label' => esc_html__('Margin', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__('Box Shadow', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__('Border', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => esc_html__('Background Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_item_post',
            [
                'label' => esc_html__('Content Item Post', 'master-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'bgcolor_content_item_post',
            [
                'label' => esc_html__('Background Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_content_item_post',
            [
                'label' => esc_html__('Padding', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => '20',
                    'right' => '0',
                    'bottom' => '20',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'margin_content_item_post',
            [
                'label' => esc_html__('Margin', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_content_item_post',
                'label' => esc_html__('Box Shadow', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .me-posts .content',
            ]
        );

        $this->add_responsive_control(
            'border_radius_content_item_post',
            [
                'label' => esc_html__('Border Radius', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // /.End General Style

        // Start Image Style
        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__('Image', 'master-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding_image',
            [
                'label' => esc_html__('Padding', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .featured-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'margin_image',
            [
                'label' => esc_html__('Margin', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .featured-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow_image',
                'label' => esc_html__('Box Shadow', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .me-posts .featured-post',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border_image',
                'label' => esc_html__('Border', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .me-posts .featured-post',
            ]
        );

        $this->add_responsive_control(
            'border_radius_image',
            [
                'label' => esc_html__('Border Radius', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .featured-post, {{WRAPPER}} .me-posts-wrap .me-posts .featured-post img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_overlay',
            [
                'label' => esc_html__('Overlay', 'master-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_overlay',
            [
                'label' => esc_html__('Overlay', 'master-addon'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'master-addon'),
                'label_off' => esc_html__('Hide', 'master-addon'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'overlay_bgcolor',
            [
                'label' => esc_html__('Overlay Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .featured-post .overlay' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'show_overlay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'overlay_icon',
            [
                'label' => esc_html__('Icon Button', 'master-addon'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_ol',
                'default' => [
                    'value' => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_overlay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'overlay_color_icon',
            [
                'label' => esc_html__('Icon Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .featured-post .overlay i, {{WRAPPER}} .me-posts-wrap .me-posts .blog-post .featured-post .overlay svg' => 'color: {{VALUE}}; fill: {{VALUE}}',
                ],
                'condition' => [
                    'show_overlay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'overlay_icon_size',
            [
                'label' => esc_html__('Icon Size', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .featured-post .overlay i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .featured-post .overlay svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // /.End Image Style

        // Start Title Style
        $this->start_controls_section(
            'section_style_title',
            [
                'label' => esc_html__('Title', 'master-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Typography', 'master-addon'),
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .title a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Color Hover', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__('Margin', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // /.End Title Style

        // Start Text Style
        $this->start_controls_section(
            'section_style_text',
            [
                'label' => esc_html__('Text', 'master-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Typography', 'master-addon'),
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .content-post',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .content-post' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_margin',
            [
                'label' => esc_html__('Margin', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .content-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // /.End Text Style

        // Start Button Style
        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__('Button', 'master-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_align',
            [
                'label' => esc_html__('Alignment', 'master-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'master-addon'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'master-addon'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'master-addon'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'master-addon'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Typography', 'master-addon'),
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Margin', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'button_style_tabs'
        );

        $this->start_controls_tab('button_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'master-addon'),
            ]);
        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__('Border', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_button_icon',
            [
                'label' => esc_html__('Icon', 'master-addon'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_button',
            [
                'label' => esc_html__('Icon Button', 'master-addon'),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_bt',
                'default' => [
                    'value' => 'fas fa-angle-double-right',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'button_icon_size',
            [
                'label' => esc_html__('Icon Size', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_position',
            [
                'label' => esc_html__('Icon Position', 'master-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'bt_icon_after',
                'options' => [
                    'bt_icon_before' => esc_html__('Before', 'master-addon'),
                    'bt_icon_after' => esc_html__('After', 'master-addon'),
                ],
            ]
        );

        $this->add_control(
            'button_icon_spacer',
            [
                'label' => esc_html__('Icon Spacer', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button.bt_icon_before i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button.bt_icon_before svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button.bt_icon_after i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button.bt_icon_after svg' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('button_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'master-addon'),
            ]);

        $this->add_control(
            'button_color_hover',
            [
                'label' => esc_html__('Color Hover', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button:hover i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button:hover svg' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label' => esc_html__('Background Color Hover', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border_hover',
                'label' => esc_html__('Border', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button:hover',
            ]
        );

        $this->add_control(
            'button_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .me-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        // /.End Button Style

        // Start Meta Style
        $this->start_controls_section(
            'section_style_meta',
            [
                'label' => esc_html__('Meta', 'master-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => esc_html__('Typography', 'master-addon'),
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .post-meta',
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__('Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .post-meta a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'meta_color_hover',
            [
                'label' => esc_html__('Color Hover', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .post-meta a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'meta_spacer',
            [
                'label' => esc_html__('Spacer', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .post-meta > li ' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'author_icon',
            [
                'label' => esc_html__('Author Icons', 'master-addon'),
                'type' => Controls_Manager::ICON,
                'include' => [
                    'far fa-user',
                    'far fa-user-circle',
                    'fas fa-user',
                    'fas fa-user-alt',
                    'fas fa-user-circle',
                ],
                'default' => '',
            ]
        );

        $this->add_control(
            'category_icon',
            [
                'label' => esc_html__('Category Icons', 'master-addon'),
                'type' => Controls_Manager::ICON,
                'include' => [
                    'far fa-folder',
                    'far fa-folder-open',
                    'fas fa-folder',
                    'fas fa-folder-open',
                ],
                'default' => '',
            ]
        );

        $this->add_control(
            'date_icon',
            [
                'label' => esc_html__('Date Icons', 'master-addon'),
                'type' => Controls_Manager::ICON,
                'include' => [
                    'far fa-calendar',
                    'far fa-calendar-alt',
                    'fas fa-calendar',
                    'fas fa-calendar-alt',
                    'far fa-clock',
                    'fas fa-clock',
                ],
                'default' => '',
            ]
        );

        $this->add_control(
            'comments_icon',
            [
                'label' => esc_html__('Comments Icons', 'master-addon'),
                'type' => Controls_Manager::ICON,
                'include' => [
                    'far fa-comment',
                    'fas fa-comment',
                    'far fa-comments',
                    'fas fa-comments',
                    'far fa-comment-alt',
                    'fas fa-comment-alt',
                    'far fa-comment-dots',
                    'fas fa-comment-dots',
                ],
                'default' => '',
            ]
        );

        $this->add_control(
            'meta_icon_color',
            [
                'label' => esc_html__('Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .post-meta i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'meta_spacer_icon',
            [
                'label' => esc_html__('Spacer Icon', 'master-addon'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 5,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .me-posts .blog-post .post-meta > li > i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // /.End Meta Style

        // Start Pagination Style
        $this->start_controls_section(
            'section_style_pagination',
            [
                'label' => esc_html__('Pagination', 'master-addon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pagination_style',
            [
                'label' => esc_html__('Style', 'master-addon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'numeric-link',
                'options' => [
                    'numeric-link' => esc_html__('Numeric & Page', 'master-addon'),
                    'link' => esc_html__('Page', 'master-addon'),
                    'numeric' => esc_html__('Numeric', 'master-addon'),
                    'loadmore' => esc_html__('Load More', 'master-addon'),
                ],
            ]
        );

        $this->add_control(
            'pagination_align',
            [
                'label' => esc_html__('Alignment', 'master-addon'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'master-addon'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'master-addon'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'master-addon'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'condition' => [
                    'pagination_style' => 'numeric-link',
                    'pagination_style' => 'numeric',
                    'pagination_style' => 'loadmore',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'pagination_typography',
                'label' => esc_html__('Typography', 'master-addon'),
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .me-posts-wrap .pagination a, {{WRAPPER}} .me-posts-wrap .pagination span',
            ]
        );

        $this->add_control(
            'pagination_padding',
            [
                'label' => esc_html__('Padding', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .pagination a, {{WRAPPER}} .me-posts-wrap .pagination span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_margin',
            [
                'label' => esc_html__('Margin', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .pagination a, {{WRAPPER}} .me-posts-wrap .pagination span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('pagination_style_tabs');
        $this->start_controls_tab('pagination_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'master-addon'),
            ]);

        $this->add_control(
            'pagination_color',
            [
                'label' => esc_html__('Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .pagination a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_bgcolor',
            [
                'label' => esc_html__('Backgound Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .pagination a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pagination_border',
                'label' => esc_html__('Border', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .pagination a, {{WRAPPER}} .me-posts-wrap .pagination span',
            ]
        );

        $this->add_control(
            'pagination_border_radius',
            [
                'label' => esc_html__('Border Radius', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .pagination a, {{WRAPPER}} .me-posts-wrap .pagination span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab('pagination_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'master-addon'),
            ]);

        $this->add_control(
            'pagination_color_hover',
            [
                'label' => esc_html__('Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0.5)',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .pagination a:hover, {{WRAPPER}} .me-posts-wrap .pagination span.current' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_bgcolor_hover',
            [
                'label' => esc_html__('Background Color', 'master-addon'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .pagination a:hover, {{WRAPPER}} .me-posts-wrap .pagination span.current' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'pagination_border_hover',
                'label' => esc_html__('Border', 'master-addon'),
                'selector' => '{{WRAPPER}} .me-posts-wrap .pagination a:hover, {{WRAPPER}} .me-posts-wrap .pagination span.current',
            ]
        );

        $this->add_control(
            'pagination_border_radius_hover',
            [
                'label' => esc_html__('Border Radius', 'master-addon'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .me-posts-wrap .pagination a:hover, {{WRAPPER}} .me-posts-wrap .pagination span.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        // /.End Pagination Style
    }


    protected function render($instance = [])
    {
        $settings = $this->get_settings_for_display();

        $has_carousel = $class_carousel = '';
        if ($settings['carousel'] == 'yes') {
            $has_carousel = 'has-carousel';
            $class_carousel = 'owl-carousel owl-theme';
        }
        $carousel_arrow = 'no-arrow';
        if ($settings['carousel_arrow'] == 'yes') {
            $carousel_arrow = 'has-arrow';
        }

        $carousel_bullets = 'no-bullets';
        if ($settings['carousel_bullets'] == 'yes') {
            $carousel_bullets = 'has-bullets';
        }

        $this->add_render_attribute('tf_posts_wrap', ['id' => "me-posts-{$this->get_id()}", 'class' => ['me-posts-wrap', $settings['posts_layout'], $has_carousel, $carousel_arrow, $carousel_bullets], 'data-tabid' => $this->get_id()]);

        if (get_query_var('paged')) {
            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {
            $paged = get_query_var('page');
        } else {
            $paged = 1;
        }
        $query_args = array(
            'post_type' => $settings['me_posts_type'],
            'posts_per_page' => $settings['me_posts_per_page'],
            'paged' => $paged
        );

        if (!empty($settings['me_posts_categories'])) {
            $query_args['category_name'] = implode(',', $settings['me_posts_categories']);
        }
        if (!empty($settings['me_exclude'])) {
            if (!is_array($settings['me_exclude']))
                $exclude = explode(',', $settings['me_exclude']);

            $query_args['post__not_in'] = $exclude;
        }
        $query_args['orderby'] = $settings['me_order_by'];
        $query_args['order'] = $settings['me_order'];

        $migrated = isset($settings['__fa4_migrated']['icon_button']);
        $is_new = empty($settings['icon_bt']);

        $migrated_ol = isset($settings['__fa4_migrated']['overlay_icon']);
        $is_new_ol = empty($settings['icon_ol']);

        $author_icon = (!empty($settings['author_icon'])) ? '<i class="' . $settings['author_icon'] . '" aria-hidden="true"></i>' : '';

        $category_icon = (!empty($settings['category_icon'])) ? '<i class="' . $settings['category_icon'] . '" aria-hidden="true"></i>' : '';

        $date_icon = (!empty($settings['date_icon'])) ? '<i class="' . $settings['date_icon'] . '" aria-hidden="true"></i>' : '';

        $comments_icon = (!empty($settings['comments_icon'])) ? '<i class="' . $settings['comments_icon'] . '" aria-hidden="true"></i>' : '';

        $query = new \WP_Query($query_args);

//        echo '<pre>';print_r($query);die;
        if ($query->have_posts()) : ?>
            <div <?php echo $this->get_render_attribute_string('tf_posts_wrap'); ?>
                    data-loop="<?php echo esc_attr($settings['carousel_loop']); ?>"
                    data-auto="<?php echo esc_attr($settings['carousel_auto']); ?>"
                    data-column="<?php echo esc_attr($settings['carousel_column_desk']); ?>"
                    data-column2="<?php echo esc_attr($settings['carousel_column_tablet']); ?>"
                    data-column3="<?php echo esc_attr($settings['carousel_column_mobile']); ?>"
                    data-spacer="<?php echo esc_attr($settings['carousel_spacer']); ?>"
                    data-prev_icon="<?php echo esc_attr($settings['carousel_prev_icon']) ?>"
                    data-next_icon="<?php echo esc_attr($settings['carousel_next_icon']) ?>">
                <div class="me-posts <?php echo esc_attr($class_carousel); ?> <?php echo esc_attr($settings['me_posts_layout_type']) ?>">
                    <?php if ($settings['me_posts_layout_type'] == 'masonry'): ?>
                        <div class="grid-sizer"></div>
                    <?php endif ?>
                    <?php while ($query->have_posts()) : $query->the_post();
                        $get_post_thumbnail = get_post_thumbnail_id();
                        ?>
                        <div class="column">
                            <div class="entry blog-post">
                                <?php if ($settings['show_image'] == 'yes' && $settings['image_position'] == 'top'): ?>
                                    <div class="featured-post">
                                        <img src="<?php echo Group_Control_Image_Size::get_attachment_image_src($get_post_thumbnail, 'thumbnail', $settings); ?>"
                                             alt="image">
                                        <?php if ($settings['show_overlay'] == 'yes'): ?>
                                            <a href="<?php echo esc_url(get_permalink()) ?>" class="overlay">
                                                <?php
                                                if ($is_new_ol || $migrated_ol) {
                                                    if (isset($settings['overlay_icon']['value']['url'])) {
                                                        Icons_Manager::render_icon($settings['overlay_icon'], ['aria-hidden' => 'true']);
                                                    } else {
                                                        echo '<i class="' . esc_attr($settings['overlay_icon']['value']) . '" aria-hidden="true"></i>';
                                                    }
                                                } else {
                                                    echo '<i class="' . esc_attr($settings['icon_ol']) . ' aria-hidden="true""></i>';
                                                }
                                                ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="content">
                                    <?php if ($settings['show_meta'] == 'yes'): ?>
                                        <?php if ($settings['meta_position'] == 'top'): ?>
                                            <ul class="post-meta">
                                                <?php if ($settings['show_author'] == 'yes'): ?>
                                                    <li class="post-author">
                                                        <?php print($author_icon); ?>
                                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ($settings['show_category'] == 'yes'): ?>
                                                    <li class="post-category"><?php print($category_icon); ?><?php echo get_the_category_list(', '); ?></li>
                                                <?php endif; ?>

                                                <?php if ($settings['show_date'] == 'yes'): ?>
                                                    <li class="post-date">
                                                        <?php
                                                        $archive_year = get_the_time('Y');
                                                        $archive_month = get_the_time('m');
                                                        $archive_day = get_the_time('d');
                                                        ?>
                                                        <?php print($date_icon); ?>
                                                        <a href="<?php echo get_day_link($archive_year, $archive_month, $archive_day); ?>"><?php echo get_the_date(); ?></a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ($settings['show_comment'] == 'yes'): ?>
                                                    <li class="post-comments">
                                                        <?php print($comments_icon); ?>
                                                        <?php echo comments_popup_link(esc_html__('Comment (0)', 'master-addon'), esc_html__('Comment (1)', 'master-addon'), esc_html__('Comments (%)', 'master-addon')); ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($settings['show_title'] == 'yes'): ?>
                                        <h2 class="title"><a href="<?php echo esc_url(get_the_permalink()); ?>"
                                                             title="<?php echo esc_attr(get_the_title()); ?>"><?php echo get_the_title(); ?></a>
                                        </h2>
                                    <?php endif; ?>

                                    <?php if ($settings['show_meta'] == 'yes'): ?>
                                        <?php if ($settings['meta_position'] == 'bottom'): ?>
                                            <ul class="post-meta">
                                                <?php if ($settings['show_author'] == 'yes'): ?>
                                                    <li class="post-author">
                                                        <?php print($author_icon); ?>
                                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php echo get_the_author(); ?></a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ($settings['show_category'] == 'yes'): ?>
                                                    <li class="post-category"><?php print($category_icon); ?><?php echo get_the_category_list(', '); ?></li>
                                                <?php endif; ?>

                                                <?php if ($settings['show_date'] == 'yes'): ?>
                                                    <li class="post-date">
                                                        <?php
                                                        $archive_year = get_the_time('Y');
                                                        $archive_month = get_the_time('m');
                                                        $archive_day = get_the_time('d');
                                                        ?>
                                                        <?php print($date_icon); ?>
                                                        <a href="<?php echo get_day_link($archive_year, $archive_month, $archive_day); ?>"><?php echo get_the_date(); ?></a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php if ($settings['show_comment'] == 'yes'): ?>
                                                    <li class="post-comments">
                                                        <?php print($comments_icon); ?>
                                                        <?php echo comments_popup_link(esc_html__('Comment (0)', 'master-addon'), esc_html__('Comment (1)', 'master-addon'), esc_html__('Comments (%)', 'master-addon')); ?>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($settings['show_image'] == 'yes' && $settings['image_position'] == 'middle'): ?>
                                        <div class="featured-post">
                                            <img src="<?php echo Group_Control_Image_Size::get_attachment_image_src($get_post_thumbnail, 'thumbnail', $settings); ?>"
                                                 alt="image">
                                            <?php if ($settings['show_overlay'] == 'yes'): ?>
                                                <a href="<?php echo esc_url(get_permalink()) ?>" class="overlay">
                                                    <?php
                                                    if ($is_new_ol || $migrated_ol) {
                                                        if (isset($settings['overlay_icon']['value']['url'])) {
                                                            Icons_Manager::render_icon($settings['overlay_icon'], ['aria-hidden' => 'true']);
                                                        } else {
                                                            echo '<i class="' . esc_attr($settings['overlay_icon']['value']) . '" aria-hidden="true"></i>';
                                                        }
                                                    } else {
                                                        echo '<i class="' . esc_attr($settings['icon_ol']) . ' aria-hidden="true""></i>';
                                                    }
                                                    ?>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($settings['show_excerpt'] == 'yes'): ?>
                                        <div class="content-post"><?php echo wp_trim_words(get_the_content(), $settings['excerpt_lenght'], '&hellip;'); ?></div>
                                    <?php endif; ?>

                                    <?php if ($settings['show_button'] == 'yes'): ?>
                                        <div class="me-button-container <?php echo esc_attr($settings['button_align']); ?>">
                                            <a href="<?php echo esc_url(get_permalink()) ?>"
                                               class="me-button <?php echo esc_attr($settings['button_icon_position']); ?>">
                                                <?php
                                                if ($settings['button_icon_position'] == 'bt_icon_before') {
                                                    if ($is_new || $migrated) {
                                                        if (isset($settings['icon_button']['value']['url'])) {
                                                            Icons_Manager::render_icon($settings['icon_button'], ['aria-hidden' => 'true']);
                                                        } else {
                                                            echo '<i class="' . esc_attr($settings['icon_button']['value']) . '" aria-hidden="true"></i>';
                                                        }
                                                    } else {
                                                        echo '<i class="' . esc_attr($settings['icon_bt']) . ' aria-hidden="true""></i>';
                                                    }
                                                }

                                                if ($settings['button_text'] != '') {
                                                    echo esc_attr($settings['button_text']);
                                                }

                                                if ($settings['button_icon_position'] == 'bt_icon_after') {
                                                    if ($is_new || $migrated) {
                                                        if (isset($settings['icon_button']['value']['url'])) {
                                                            Icons_Manager::render_icon($settings['icon_button'], ['aria-hidden' => 'true']);
                                                        } else {
                                                            echo '<i class="' . esc_attr($settings['icon_button']['value']) . '" aria-hidden="true"></i>';
                                                        }
                                                    } else {
                                                        echo '<i class="' . esc_attr($settings['icon_bt']) . ' aria-hidden="true""></i>';
                                                    }
                                                }

                                                ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if ($settings['show_image'] == 'yes' && $settings['image_position'] == 'bottom'): ?>
                                    <div class="featured-post">
                                        <img src="<?php echo Group_Control_Image_Size::get_attachment_image_src($get_post_thumbnail, 'thumbnail', $settings); ?>"
                                             alt="image">
                                        <?php if ($settings['show_overlay'] == 'yes'): ?>
                                            <a href="<?php echo esc_url(get_permalink()) ?>" class="overlay">
                                                <?php
                                                if ($is_new_ol || $migrated_ol) {
                                                    if (isset($settings['overlay_icon']['value']['url'])) {
                                                        Icons_Manager::render_icon($settings['overlay_icon'], ['aria-hidden' => 'true']);
                                                    } else {
                                                        echo '<i class="' . esc_attr($settings['overlay_icon']['value']) . '" aria-hidden="true"></i>';
                                                    }
                                                } else {
                                                    echo '<i class="' . esc_attr($settings['icon_ol']) . ' aria-hidden="true""></i>';
                                                }
                                                ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>

                <?php
                if ($settings['pagination'] == 'yes') {
                    require_once(__DIR__ . '/includes/pagination.php');
                    Master_Custom_pagination($query, $paged, $settings['pagination_style'], $settings['pagination_align']);
                }
                ?>
            </div>

            <?php
        else:
            esc_html_e('No posts found', 'master-addon');
        endif;

    }
}
