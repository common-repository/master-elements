<?php

namespace Elementor;

use \Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class Master_blogpost extends Widget_Base
{
    public $base;

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);

        wp_register_style('blogpost-css', \MasterElements::widgets_url() . '/blogpost/blogpost.css', false, \MasterElements::version);


    }

    public function get_style_depends()
    {

        return ['blogpost-css'];
    }

    public function get_name()
    {
        //get name of widget from blogpost-handler.php file
        return 'elementpress-blogpost';
    }

    public function get_title()
    {
        //get title of widget from blogpost-handler.php file
        return esc_html__('Blog Post', 'elementpress');
    }

    public function get_icon()
    {
        //get icon of widget from blogpost-handler.php file
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        //get category of widget from blogpost-handler.php file
        return ['elementpress_singlepost'];
    }

    //register all controls
    protected function _register_controls()
    {
        $this->content_layout_options();
        $this->style_layout_options();
        $this->style_box_options();
        $this->style_image_options();
        $this->style_title_options();
        $this->style_not_found_options();
        $this->style_meta_options();
        $this->style_content_options();
        $this->style_readmore_options();
    }

    private function content_layout_options()
    {
        //Layout section
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'elementpress'),
            ]
        );
        //select box control for layout
        $this->add_control(
            'elementpressdgridstyle',
            [
                'label' => __('Grid Style', 'elementpress'),
                'type' => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Layout 1', 'elementpress'),
                    '2' => esc_html__('Layout 2', 'elementpress'),
                    '3' => esc_html__('Layout 3', 'elementpress'),
                    '4' => esc_html__('Layout 4', 'elementpress'),
                    '5' => esc_html__('Layout 5', 'elementpress'),
                ],
            ]
        );
        //select box control for coloumns
        $this->add_responsive_control(
            'elementpressdcolumns',
            [
                'label' => __('Columns', 'elementpress'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'prefix_class' => 'elementor-grid%s-',
                'frontend_available' => true,
                'selectors' => [
                    ' {{WRAPPER}} elementor-portfolio-item' => 'width: calc( 100% / {{SIZE}} )',
                ],
            ]
        );
        //Number field control for posts per page
        $this->add_control(
            'posts_perpage',
            [
                'label' => __('Posts Per Page', 'akd-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );
        //switcher control to show and hide image
        $this->add_control(
            'elementpressdshowimage',
            [
                'label' => __('Image', 'elementpress'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementpress'),
                'label_off' => __('Hide', 'elementpress'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'post_thumbnail',
                'exclude' => ['custom'],
                'default' => 'full',
                'prefix_class' => 'post-thumbnail-size-',
                'condition' => [
                    'elementpressdshowimage' => 'yes',
                ],
            ]
        );
        //switcher control for hide and show title
        $this->add_control(
            'elementpressdshowtitle',
            [
                'label' => __('Title', 'elementpress'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementpress'),
                'label_off' => __('Hide', 'elementpress'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        //select box for heading
        $this->add_control(
            'elementpressdtitletag',
            [
                'label' => __('Title HTML Tag', 'elementpress'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
                'condition' => [
                    'elementpressdshowtitle' => 'yes',
                ],
            ]
        );
        //meta data control for blog
        $this->add_control(
            'elementpressdmetadata',
            [
                'label' => __('Meta Data', 'elementpress'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'default' => ['date', 'comments'],
                'multiple' => true,
                'options' => [
                    'author' => __('Author', 'elementpress'),
                    'date' => __('Date', 'elementpress'),
                    'categories' => __('Categories', 'elementpress'),
                    'comments' => __('Comments', 'elementpress'),
                    'tags' => __('Tags', 'elementpress'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'metaseparator',
            [
                'label' => __('Separator Between', 'elementpress'),
                'type' => Controls_Manager::TEXT,
                'default' => '/',
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post .elementpress-post-grid-meta span + span:before' => 'content: "{{VALUE}}"',
                ],
                'condition' => [
                    'meta_data!' => [],
                ],
            ]

        );
        //switcher control for hide and show excerpt
        $this->add_control(
            'elementpressdshowexcerpt',
            [
                'label' => __('Excerpt', 'elementpress'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementpress'),
                'label_off' => __('Hide', 'elementpress'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        //number field control for excerpt length
        $this->add_control(
            'elementpressdexcerptlength',
            [
                'label' => __('Excerpt Length', 'elementpress'),
                'type' => Controls_Manager::NUMBER,
                /** This filter is documented in wp-includes/formatting.php */
                'default' => apply_filters('excerpt_length', 25),
                'condition' => [
                    'elementpressdshowexcerpt' => 'yes',
                ],
            ]
        );
        //switcher control for hide and show readmore
        $this->add_control(
            'elementpressdshowreadmore',
            [
                'label' => __('Read More', 'elementpress'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'elementpress'),
                'label_off' => __('Hide', 'elementpress'),
                'default' => 'yes',
                'separator' => 'before',
            ]
        );
        //text field for readmore text
        $this->add_control(
            'elementpressdreadmoretext',
            [
                'label' => __('Read More Text', 'elementpress'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Read More »', 'elementpress'),
                'condition' => [
                    'elementpressdshowreadmore' => 'yes',
                ],
            ]
        );
        //alignment control
        $this->add_control(
            'elementpressdcontentalign',
            [
                'label' => __('Alignment', 'elementpress'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'elementpress'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'elementpress'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'elementpress'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .elementpress-post-grid-inner' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section(); //end Layout section
    }

    private function style_layout_options()
    {

        // Layout.
        $this->start_controls_section(
            'section_layout_style',
            [
                'label' => __('Layout', 'elementpress'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Columns margin.
        $this->add_control(
            'elementpressdgridstylecolumnsmargin',
            [
                'label' => __('Columns margin', 'elementpress'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container' => 'grid-column-gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        // Row margin.
        $this->add_control(
            'elementpressdgridstylerowsmargin',
            [
                'label' => __('Rows margin', 'elementpress'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 30,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container' => 'grid-row-gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();
    }

    private function style_box_options()
    {
        // Box section under style tab
        $this->start_controls_section(
            'section_box',
            [
                'label' => __('Box', 'elementpress'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Box internal margin.
        $this->add_responsive_control(
            'elementpressdgriditemsstylemargin',
            [
                'label' => __('Margin', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        // Box internal padding.
        $this->add_responsive_control(
            'elementpressdgriditemsstylepadding',
            [
                'label' => __('Padding', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->start_controls_tabs('gridbuttonstyle');
        // Normal tab.
        $this->start_controls_tab(
            'elementpressdgridbuttonstylenormal',
            [
                'label' => __('Normal', 'elementpress'),
            ]
        );
        // Image border radius.
        $this->add_control(
            'elementpressdgridboxborderswidths',
            [
                'label' => __('Border width', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .elementpress-grid-container .elementpress-post' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        // Border Radius.
        $this->add_control(
            'elementpressdgridstyleborderradius',
            [
                'label' => __('Border Radius', 'elementpress'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        // Normal background color.
        $this->add_control(
            'elementpressdgridbuttonstylenormal_bg_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Background Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'separator' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // Normal border color.
        $this->add_control(
            'elementpressdgridbuttonstylenormal_border_btn_color',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Border Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'separator' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        // Normal box shadow.
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'elementpressdgridbuttonstylenormal_box_shadow',
                'selector' => '{{WRAPPER}} .elementpress-grid-container .elementpress-post',
            ]
        );
        $this->end_controls_tab();
        // Hover tab.
        $this->start_controls_tab(
            'elementpressd_gridbuttonstyle_hover',
            [
                'label' => __('Hover', 'elementpress'),
            ]
        );
        // Image border radius.
        $this->add_control(
            'elementpressdgridboxborderswidthshover',
            [
                'label' => __('Border width', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .elementpress-grid-container .elementpress-post:hover' => 'border-style: solid; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        // Border Radius.
        $this->add_control(
            'elementpressdgridstyleborderradiushover',
            [
                'label' => __('Border Radius', 'elementpress'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 0,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post:hover' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        // Hover background color.
        $this->add_control(
            'elementpressdgridbuttonstylehoverbgcolor',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Background Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'separator' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        // Hover border color.
        $this->add_control(
            'elementpressd_gridbuttonstylehoverborderscolors',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Border Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'separator' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        // Hover box shadow.
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'elementpressdgridbuttonstylehoverboxshadow',
                'selector' => '{{WRAPPER}} .elementpress-grid-container .elementpress-post',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    private function style_image_options()
    {
        // Image section after box section
        $this->start_controls_section(
            'section_image',
            [
                'label' => __('Image', 'elementpress'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Image border radius.
        $this->add_control(
            'elementpressdgridimageborderradius',
            [
                'label' => __('Border Radius', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-post-grid-inner .elementpress-post-grid-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //image margin
        $this->add_responsive_control(
            'elementpressdelementpressdgridstyleimagemargin',
            [
                'label' => __('Margin', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-post-grid-inner .elementpress-post-grid-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //image padding
        $this->add_responsive_control(
            'elementpressdelementpressdgridstyleimagepadding',
            [
                'label' => __('Padding', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-post-grid-inner .elementpress-post-grid-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section(); //end Image section
    }

    private function style_title_options()
    {
        // Title section after Image section
        $this->start_controls_section(
            'sectiongridtitlestyle',
            [
                'label' => __('Title', 'elementpress'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Title typography.
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'elementpressdgridtitlestyletypography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementpress-grid-container .elementpress-post .title,{{WRAPPER}} .elementpress-grid-container .elementpress-post .title > a'
            ]
        );
        // Title color.
        $this->add_control(
            'elementpressdgridtitlestylecolor',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post .title, {{WRAPPER}} .elementpress-grid-container .elementpress-post .title > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Title color hover.
        $this->add_control(
            'elementpressdgridtitlestylecolorhover',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Hover Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post .title:hover, {{WRAPPER}} .elementpress-grid-container .elementpress-post .title > a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Title margin.
        $this->add_responsive_control(
            'elementpressdgridtitlestylemargin',
            [
                'label' => __('Margin', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post .title,{{WRAPPER}} .elementpress-grid-container .elementpress-post .title>a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    private function style_meta_options()
    {
        // Tab.
        $this->start_controls_section(
            'sectiongridmetastyle',
            [
                'label' => __('Meta', 'elementpress'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Meta typography.
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'elementpressdgridmetastyletypography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementpress-grid-container .elementpress-post .elementpress-post-grid-meta span',
            ]
        );
        // Meta color.
        $this->add_control(
            'elementpressdgridmetastylecolor',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post .elementpress-post-grid-meta span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post .elementpress-post-grid-meta span a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'elementpressdgridmetastylecolorhover',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Hover Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post .elementpress-post-grid-meta span:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post .elementpress-post-grid-meta span a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Meta margin.
        $this->add_responsive_control(
            'elementpressdgridmetastylemargin',
            [
                'label' => __('Margin', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post .elementpress-post-grid-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    private function style_content_options()
    {
        // Tab.
        $this->start_controls_section(
            'sectiongridcontentstyle',
            [
                'label' => __('Content', 'elementpress'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Content typography.
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'elementpressdgridcontentstyletypography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementpress-grid-container .elementpress-post .elementpress-post-grid-excerpt ',
            ]
        );
        // Content color.
        $this->add_control(
            'elementpressdgridcontentstylecolor',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post .elementpress-post-grid-excerpt ' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Content margin
        $this->add_responsive_control(
            'elementpressdgridcontentstylemargin',
            [
                'label' => __('Margin', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-grid-container .elementpress-post .elementpress-post-grid-excerpt ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'elementpressdgridcontentstylepadding',
            [
                'label' => __('Padding', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementpress-post-grid-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->end_controls_section();
    }

    private function style_not_found_options()
    {
        // Tab.
        $this->start_controls_section(
            'sectiongridnotfoundstyle',
            [
                'label' => __('Not Found', 'elementpress'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Title typography.
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'elementpressdgridnotfoundstyletypography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} p.not_found'
            ]
        );
        // Title color.
        $this->add_control(
            'elementpressdgridnotfoundstylecolor',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} p.not_found' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Title margin.
        $this->add_responsive_control(
            'elementpressdgridnotfoundstylemargin',
            [
                'label' => __('Margin', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} p.not_found ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    private function style_readmore_options()
    {
        // Tab.
        $this->start_controls_section(
            'sectiongridreadmorestyle',
            [
                'label' => __('Read More', 'elementpress'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Readmore typography.
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'elementpressdgridreadmorestyletypography',
                'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementpress-grid-container .elementpress-post a#elementpress-read-more-btn',
            ]
        );
        // Readmore color.
        $this->add_control(
            'elementpressdgridreadmorestylecolor',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .read_more' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'elementpressdgridreadmorestylebackgroundcolor',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Background Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .read_more' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'borderopt',
                'label' => __('Border', 'elementpress'),
                'selector' => '{{WRAPPER}} .read_more',
            ]
        );
        //Hover Properties Read More Button....
        $this->add_control(
            'elementpressdgridreadmorestylecolorhover',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Hover Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .read_more:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'elementpressdgridreadmorestylebackgroundcolorhover',
            [
                'type' => Controls_Manager::COLOR,
                'label' => __('Hover Background Color', 'elementpress'),
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .read_more:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'borderhost',
                'label' => __('Hover Border', 'elementpress'),
                'selector' => '{{WRAPPER}} .read_more:hover',
            ]
        );
        $this->add_control(
            'readmoreborderradius',
            [
                'label' => __('Button Border Radius', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .read_more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Readmore margin
        $this->add_responsive_control(
            'elementpressdgridreadmorestylemargin',
            [
                'label' => __('Margin', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .read_more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'elementpressdgridreadmorestylepadding',
            [
                'label' => __('Padding', 'elementpress'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .read_more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render($instance = [])
    {
        // Get settings.
        $settings = $this->get_settings();
        ?>
        <div class="elementpress-grid">
            <?php
            $elementpress_columns_desktop = (!empty($settings['elementpressdcolumns']) ? 'elementpressgriddesktop-' . $settings['elementpressdcolumns'] : 'elementpressgriddesktop-3');
            $elementpress_columns_tablet = (!empty($settings['elementpressdcolumns_tablet']) ? ' elementpressgridtablet-' . $settings['elementpressdcolumns_tablet'] : 'elementpressgridtablet-2');
            $elementpress_columns_mobile = (!empty($settings['elementpressdcolumns_mobile']) ? ' elementpressgridmobile-' . $settings['elementpressdcolumns_mobile'] : ' elementpressgridmobile-1');
            $elementpress_grid_style = $settings['elementpressdgridstyle'];
            $elementpress_grid_class = '';
            if (5 == $elementpress_grid_style) {
                $elementpress_grid_class = 'elementpressmetabottom';
            }
            ?>
            <div class="elementpress-grid-container elementor-grid <?php echo $elementpress_columns_desktop . $elementpress_columns_tablet . $elementpress_columns_mobile . $elementpress_grid_class; ?>">
                <?php
                $posts_perpage = (!empty($settings['posts_perpage']) ? $settings['posts_perpage'] : 3);
                $query = array(
                    'posts_per_page' => $posts_perpage,
                    'no_found_rows' => true,
                    'ignore_sticky_posts' => true,
                );
                $all_posts = new \WP_Query($query);
                if ($all_posts->have_posts()) :
                    if (5 == $elementpress_grid_style) {
                        include(__DIR__ . '/layouts/layout-5.php');
                    } elseif (4 == $elementpress_grid_style) {
                        include(__DIR__ . '/layouts/layout-4.php');
                    } elseif (3 == $elementpress_grid_style) {
                        include(__DIR__ . '/layouts/layout-3.php');
                    } elseif (2 == $elementpress_grid_style) {
                        include(__DIR__ . '/layouts/layout-2.php');
                    } else {
                        include(__DIR__ . '/layouts/layout-1.php');
                    }
                else : ?>
                    <p class="not_found"><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }

    /*protected function render() {
		//$settings = $this->get_settings_for_display();
		//  $wp_querystring=setsearch();
		// 	echo  $wp_querystring;
		// 	exit();
		//echo '_GET<pre>'.print_r($_GET,true).'</pre><br>';
		global $query_string;
		//echo 'query_string <pre>'.print_r($query_string,true).'</pre><br>';
		//echo '<pre>'.print_r($GLOBALS,true).'</pre><br>';
		//exit();
		$query_args = explode("&", $query_string);
		$search_query = array();
		foreach($query_args as $key => $string) {
		  $query_split = explode("=", $string);
		  $search_query[$query_split[0]] = urldecode($query_split[1]);
		} // foreach
		//echo 'search_query <pre>'.print_r($search_query,true).'</pre><br>';
/*
		$query_args = explode("&",'s=hello');
		//$search_query = array();
		foreach($query_args as $key => $string) {
		  $query_split = explode("=", $string);
		  $search_query[$query_split[0]] = urldecode($query_split[1]);
		} // foreach
		$the_query = new \WP_Query($search_query);
		if ( $the_query->have_posts() ) : 
		?>
		<!-- the loop -->
		<ul>    
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class='title'>
			<?php echo the_post(); ?>
		</div>   
		<?php endwhile; ?>
		</ul>
		<!-- end of the loop -->
		<?php //wp_reset_postdata(); ?>
		<?php else : ?>
			<p><?php _e('Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; 
  }*/
    protected function render_thumbnail()
    {
        $settings = $this->get_settings();
        $elementpressdshowimage = $settings['elementpressdshowimage'];
        if ('yes' !== $elementpressdshowimage) {
            return;
        }
        $elementpressd_post_thumbnail_size = $settings['post_thumbnail_size'];
        if (has_post_thumbnail()) : ?>
            <div class="elementpress-post-grid-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail($elementpressd_post_thumbnail_size); ?>
                </a>
            </div>
        <?php endif;
    }

    protected function render_title()
    {
        $settings = $this->get_settings();
        $elementpressdshowtitle = $settings['elementpressdshowtitle'];
        if ('yes' !== $elementpressdshowtitle) {
            return;
        }
        $elementpressdtitletag = $settings['elementpressdtitletag'];
        ?>
        <<?php echo $elementpressdtitletag; ?> class="title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </<?php echo $elementpressdtitletag; ?>>
        <?php
    }

    protected function render_meta()
    {
        $settings = $this->get_settings();
        $elementpressdmetadata = $settings['elementpressdmetadata'];
        if (empty($elementpressdmetadata)) {
            return;
        }
        ?>
        <div class="elementpress-post-grid-meta">
            <?php
            if (in_array('author', $elementpressdmetadata)) { ?>
                <span class="post-author"><?php the_author(); ?></span>
                <?php
            }
            if (in_array('date', $elementpressdmetadata)) {
                $archive_year = get_the_time('Y');
                $archive_month = get_the_time('m');
                $archive_day = get_the_time('d'); ?>
                <span class="post-author"><a
                            href="<?php echo get_day_link($archive_year, $archive_month, $archive_day); ?>"><?php echo apply_filters('the_date', get_the_date(), get_option('date_format'), '', ''); ?></a></span>
                <?php
            }
            if (in_array('categories', $elementpressdmetadata)) {
                $categories_list = get_the_category_list(esc_html__(', ', 'elementpressd-addons'));
                if ($categories_list) {
                    printf('<span class="post-categories">%s</span>', $categories_list); // WPCS: XSS OK.
                }
            }
            if (in_array('comments', $elementpressdmetadata)) { ?>
                <span class="post-comments"><?php comments_number(); ?></span>
                <?php
            }
            ?>
        </div>
        <?php
    }

    protected function render_excerpt()
    {
        $settings = $this->get_settings();
        $elementpressdshowexcerpt = $settings['elementpressdshowexcerpt'];
        if ('yes' !== $elementpressdshowexcerpt) {
            return;
        }
        $excerpt_length = $settings['elementpressdexcerptlength'];
        ?>
        <div class="elementpress-post-grid-excerpt">
            <?php
            $excerpt = get_the_content();
            echo wp_trim_words($excerpt, $excerpt_length);
            ?>
        </div>
        <?php
    }

    protected function render_readmore()
    {
        $settings = $this->get_settings();
        $elementpressdshowreadmore = $settings['elementpressdshowreadmore'];
        if ('yes' !== $elementpressdshowreadmore) {
            return;
        }
        ?>
        <a style="display:inline-block" class="read_more" id="elementpress-read-more-btn"
           href="<?php the_permalink(); ?>"><?= $settings['elementpressdreadmoretext']; ?></a>
        <?php
    }

    protected function _content_template()
    {
    }
}