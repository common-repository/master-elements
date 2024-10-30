<?php

namespace Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) {
    exit;
}

class Master_Breadcrumbs extends Widget_Base
{
    public $base;

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_style('me-breadcrumbs-css', \MasterElements::widgets_url() . '/breadcrumbs/assets/css/me-breadcrumbs-addon.css', false, \MasterElements::version);
    }

    public function get_style_depends()
    {

        return ['me-breadcrumbs-css'];
    }

    public function get_name()
    {
        return 'master-breadcrumbs';
    }

    public function get_title()
    {
        return 'Master Breadcrumbs';
    }

    public function get_categories()
    {
        return ['elementor-addons'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section('me_breadcrumbs_settings',
            [
                'label' => esc_html__('Master Breadcrumbs Settings', 'masterelements'),
            ]
        );

        $this->add_control('me_breadcrumbs_homepage_settings',
            [
                'label' => esc_html__('Show Homepage', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__('Show homepage in breadcrumb', 'masterelements'),
                'options' => [
                    'yes' => esc_html__('Yes', 'Show Homepage', 'masterelements'),
                    'no' => esc_html__('No', 'Show Homepage', 'masterelements'),
                ],
                'default' => esc_html__('yes', 'masterelements'),
            ]
        );

        $this->add_control('me_breadcrumbs_parent_page',
            [
                'label' => esc_html__('Show Parent Page', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__('Show parent page in breadcrumb', 'masterelements'),
                'options' => [
                    'yes' => esc_html__('Yes', 'Show Parent Page', 'masterelements'),
                    'no' => esc_html__('No', 'Show Parent Page', 'masterelements'),
                ],
                'default' => esc_html__('yes', 'masterelements'),
            ]
        );

        $this->add_control('me_breadcrumbs_child_pages',
            [
                'label' => esc_html__('Show Child Pages', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__('Show child pages in breadcrumb', 'masterelements'),
                'options' => [
                    'yes' => esc_html__('Yes', 'Show Child Pages', 'masterelements'),
                    'no' => esc_html__('No', 'Show Child Pages', 'masterelements'),
                ],
                'default' => esc_html__('no', 'masterelements'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('me_breadcrumbs_style_tab',
            [
                'label' => esc_html__('Master Breadcrumb Style', 'masterelements'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control('me_breadcrumbs_style',
            [
                'label' => esc_html__('Choose Style', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__('Select Breadcrumb Style', 'masterelements'),
                'options' => [
                    '0' => esc_html__('Default', 'Select Style', 'masterelements'),
                    '1' => esc_html__('Separator', 'Select Style', 'masterelements'),
                    '2' => esc_html__('Triangle', 'Select Style', 'masterelements'),
                    '3' => esc_html__('Multi-Steps', 'Select Style', 'masterelements'),
                    '4' => esc_html__('Dots', 'Select Style', 'masterelements'),
                    '5' => esc_html__('Dots with step counter', 'Select Style', 'masterelements'),
                ],
                'default' => '0'
            ]
        );

        $this->add_control('me_breadcrumbs_font_size',
            [
                'label' => esc_html__('Font Size', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
                'size_unit' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} li' => 'font-size: {{size}}{{unit}};',
                ],
            ]
        );

        $this->add_control(
            'me_breadcrumbs_horizontal_alignment',
            [
                'label' => esc_html__('Horizontal Alignment', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'default' => [
                        'title' => __('Default', 'masterelements'),
                        'icon' => 'fa fa-ban',
                    ],
                    'left' => [
                        'title' => esc_html__('Left', 'masterelements'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'centered' => [
                        'title' => esc_html__('Center', 'masterelements'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'masterelements'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'me-breadcrumbs-align-default',
                'prefix_class' => 'me-breadcrumbs-align-',
            ]
        );

        $this->add_control('me_breadrcrumb_seperator_style',
            [
                'label' => __('Separator Style', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'description' => __('Breadcrumb Style', 'masterelements'),
                'options' => [
                    '0' => _x('Text', 'Breadcrumb separator style', 'masterelements'),
                    '1' => _x('Font awesome icon', 'Breadcrumb separator style', 'masterelements'),
                    '2' => _x('Image Upload', 'Breadcrumb separator style', 'masterelements'),
                ],
                'default' => '0',
                'condition' => [
                    'me_breadcrumbs_style' => '1'
                ]
            ]
        );

        $this->add_control('me_breadcrumb_text_separator',
            [
                'label' => __('Text Separator', 'masterelements'),
                'description' => __('Add text separator', 'masterelements'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => false],
                'default' => ">",
                'label_block' => true,
                'condition' => [
                    'me_breadrcrumb_seperator_style' => '0',
                    'me_breadcrumbs_style' => '1'
                ],
                'selectors' => [
                    '{{WRAPPER}} li::after' => 'content: "{{VALUE}}"',
                ],
            ]
        );

        $this->add_control('me_breadcrumb_font_awesome_icon_separator',
            [
                'label' => __('Font Awesome Icon Separator', 'masterelements'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => false],
                'description' => __('<span style="font-size: 14px;">Choose icon and then Add icon code from here <a href="https://fontawesome.com/cheatsheet" target="_blank">Font Aweosme cheatsheet</a> and add it like: "\f0a4"</span>', 'masterelements'),
                'label_block' => true,
                'default' => '\f0a4',
                'condition' => [
                    'me_breadrcrumb_seperator_style' => '1',
                    'me_breadcrumbs_style' => '1'
                ],
                'selectors' => [
                    '{{WRAPPER}} li::after' => 'font-family: "FontAwesome"; content: "{{VALUE}}";',
                ]
            ]
        );

        $this->add_control('me_breadecrumb_image_separator',
            [
                'label' => __('Image Separator', 'masterelements'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => ['active' => false],
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ],
                'show_label' => true,
                'condition' => [
                    'me_breadrcrumb_seperator_style' => '2',
                    'me_breadcrumbs_style' => '1'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image',
                'default' => 'thumbnail',
                'condition' => [
                    'me_breadecrumb_image_separator[url]!' => '',
                    'me_breadrcrumb_seperator_style' => '2',
                    'me_breadcrumbs_style' => '1'
                ],
            ]
        );

        $this->add_control('me_triangle_breadcrumb_style_switch',
            [
                'label' => __('Enable custom styling?', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'masterelements'),
                'condition' => [
                    'me_breadcrumbs_style' => '2'
                ]
            ]
        );

        $this->add_control('me_triangle_style_default_color',
            [
                'label' => __('Default Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#6E0D67', 'masterelements'),
                'condition' => [
                    'me_triangle_breadcrumb_style_switch' => 'yes',
                    'me_breadcrumbs_style' => '2'
                ],
                'selectors' => [
                    '{{WRAPPER}} .triangle li a' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .triangle li a::after' => 'border-left: 30px solid {{VALUE}};',
                ]
            ]
        );

        $this->add_control('me_triangle_style_active_color',
            [
                'label' => __('Active Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#9A0C3E', 'masterelements'),
                'condition' => [
                    'me_triangle_breadcrumb_style_switch' => 'yes',
                    'me_breadcrumbs_style' => '2'
                ],
                'selectors' => [
                    '{{WRAPPER}} .triangle li:last-child' => 'background: {{VALUE}};',
                ]
            ]
        );

        $this->add_control('me_breadcrumb_multi_step_style_switch',
            [
                'label' => __('Enable custom styling?', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'masterelements'),
                'condition' => [
                    'me_breadcrumbs_style' => '3'
                ]
            ]
        );

        $this->add_control('me_multi_step_default_color',
            [
                'label' => __('Default Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#6E0D67', 'masterelements'),
                'condition' => [
                    'me_breadcrumb_multi_step_style_switch' => 'yes',
                    'me_breadcrumbs_style' => '3'
                ]
            ]
        );

        $this->add_control('me_multi_step_active_color',
            [
                'label' => __('Active Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#9A0C3E', 'masterelements'),
                'condition' => [
                    'me_breadcrumb_multi_step_style_switch' => 'yes',
                    'me_breadcrumbs_style' => '3'
                ],
                'selectors' => [
                    '{{WRAPPER}} .multi-steps li.current' => 'background: {{VALUE}};',
                ]
            ]
        );

        $this->add_control('me_breadcrumbs_dots_position',
            [
                'label' => __('Position', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top' => _x('Top', 'Dots position', 'masterelements'),
                    'bottom' => _x('Bottom', 'Dots position', 'masterelements'),
                ],
                'default' => __('bottom', 'masterelements'),
                'condition' => [
                    'me_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('me_breadcrumbs_dots_style_switch',
            [
                'label' => __('Enable custom styling?', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'masterelements'),
                'condition' => [
                    'me_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('me_dots_style_default_color',
            [
                'label' => __('Default Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#6E0D67', 'masterelements'),
                'condition' => [
                    'me_breadcrumbs_dots_style_switch' => 'yes',
                    'me_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('me_dots_style_active_color',
            [
                'label' => __('Active Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#9A0C3E', 'masterelements'),
                'condition' => [
                    'me_breadcrumbs_dots_style_switch' => 'yes',
                    'me_breadcrumbs_style' => '4'
                ]
            ]
        );

        $this->add_control('me_dots_step_counter_style_position',
            [
                'label' => __('Position', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'top' => _x('Top', 'Dots with Step Counter position', 'masterelements'),
                    'bottom' => _x('Bottom', 'Dots with Step Counter position', 'masterelements'),
                ],
                'default' => __('bottom', 'masterelements'),
                'condition' => [
                    'me_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->add_control('me_breadcrumbs_dots_step_counter_style_switch',
            [
                'label' => __('Enable custom styling?', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'default' => __('no', 'masterelements'),
                'condition' => [
                    'me_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->add_control('me_dots_step_counter_style_default_color',
            [
                'label' => __('Default Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#6E0D67', 'masterelements'),
                'condition' => [
                    'me_breadcrumbs_dots_step_counter_style_switch' => 'yes',
                    'me_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->add_control('me_dots_step_counter_style_active_color',
            [
                'label' => __('Active Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => __('#9A0C3E', 'masterelements'),
                'condition' => [
                    'me_breadcrumbs_dots_step_counter_style_switch' => 'yes',
                    'me_breadcrumbs_style' => '5'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        global $post;
        global $wp;

        $default_color = __('#6E0D67', 'masterelements');
        $active_color = __('#9A0C3E', 'masterelements');

        $breadcrumb_settings = $this->get_settings_for_display();

        $output = $add_style_class = '';

        $id = "breadcrumb-" . uniqid();

        if (intval($breadcrumb_settings['me_breadcrumbs_style']) === 0) {
            $output .= '<style>#' . $id . ' li::after { content: "»" }</style>';
        }

        if (intval($breadcrumb_settings['me_breadcrumbs_style']) === 1) {
            if (intval($breadcrumb_settings['me_breadrcrumb_seperator_style']) === 2) {
                $image_icon_path = Group_Control_Image_Size::get_attachment_image_src($breadcrumb_settings['me_breadecrumb_image_separator']['id'], 'image', $breadcrumb_settings);

                if ($breadcrumb_settings['image_size'] == 'custom') {
                    $image_icon_width = $breadcrumb_settings['image_custom_dimension']['width'];
                    $image_icon_height = $breadcrumb_settings['image_custom_dimension']['height'];

                    if ($image_icon_width !== '' && $image_icon_height == '') {
                        $image_icon_height = $image_icon_width;
                    }

                    if ($image_icon_width == '' && $image_icon_height != '') {
                        $image_icon_width = $image_icon_height;
                    }
                } else {
                    list($image_icon_width, $image_icon_height) = getimagesize($image_icon_path);
                }

                $output .= '
                        <style> 
                        #' . $id . ' li::after 
                        { 
                            content: ""; background: url("' . $image_icon_path . '"); width: ' . $image_icon_width . 'px; height: ' . $image_icon_height . 'px;) 
                        }
                        </style>
                        ';
            }
        }

        if (intval($breadcrumb_settings['me_breadcrumbs_style']) === 2) {
            if ($breadcrumb_settings['me_triangle_breadcrumb_style_switch'] === '') {
                $output .= '
                    <style>
                        #' . $id . '.triangle li a {
                            background: ' . $default_color . ';
                        }
                        #' . $id . '.triangle li a:after {
                            border-left: 30px solid ' . $default_color . ';
                        }
                        #' . $id . '.triangle li:last-child {
                            background: ' . $active_color . ';
                        }
                    </style>
                ';
            }

            $add_style_class = 'triangle';
        }

        if (intval($breadcrumb_settings['me_breadcrumbs_style']) === 3) {
            if ($breadcrumb_settings['me_breadcrumb_multi_step_style_switch'] == 'yes') {
                $default_color = $breadcrumb_settings['me_multi_step_default_color'];
                $active_color = $breadcrumb_settings['me_multi_step_active_color'];
            }

            $output .= '
                <style>
                    #' . $id . '.text-top a, #' . $id . '.text-bottom a {
                        text-decoration: none;
                    }
                    #' . $id . '.multi-steps li.visited::after {
                        background-color: ' . $default_color . ';
                    }
                    #' . $id . '.multi-steps li::after {
                        background: ' . $active_color . ';
                    }
                    #' . $id . '.multi-steps.text-center li > * {
                        background: ' . $active_color . ';
                    }
                    #' . $id . '.multi-steps.text-center li.visited > *, #' . $id . '.multi-steps.text-center li.current > * {
                        background-color: ' . $default_color . ';
                    }
                </style>
            ';

            $add_style_class = 'multi-steps text-center';
        }

        if (intval($breadcrumb_settings['me_breadcrumbs_style']) === 4) {
            if ($breadcrumb_settings['me_breadcrumbs_dots_style_switch'] == 'yes') {
                $default_color = $breadcrumb_settings['me_dots_style_default_color'];
                $active_color = $breadcrumb_settings['me_dots_style_active_color'];
            }

            $output .= '
                <style>
                    #' . $id . '.text-top a, #' . $id . '.text-bottom a {
                        text-decoration: none;
                    }
                    #' . $id . '.text-top li.visited > *::before, #' . $id . '.text-top li.current > *::before, #' . $id . '.text-bottom li.visited > *::before, #' . $id . '.text-bottom li.current > *::before {
                        background-color: ' . $default_color . ';
                    }
                    #' . $id . '.text-top a:hover, .me-breadcrumbs.text-bottom a:hover {
                        color: ' . $default_color . ';
                    }
                    #' . $id . '.text-top li > *::before, #' . $id . '.text-bottom li > *::before {
                        background-color: ' . $active_color . ';
                    }
                    #' . $id . '.text-top li.visited > a:hover::before, #' . $id . '.text-bottom li.visited > a:hover::before {
                        box-shadow: 0 0 0 3px ' . $default_color . '0.3' . ';
                    }
                    #' . $id . '.text-top li > a:hover::before, #' . $id . '.text-bottom li > a:hover::before {
                        box-shadow: 0 0 0 3px ' . $active_color . '0.3' . ';
                    }
                    #' . $id . '.multi-steps li.visited::after {
                        background-color: ' . $default_color . ';
                    }
                    #' . $id . '.multi-steps li::after {
                        background: ' . $active_color . ';
                    }
                </style>
            ';

            $add_style_class = 'multi-steps text-' . $breadcrumb_settings["me_breadcrumbs_dots_position"] . '';
        }

        if (intval($breadcrumb_settings['me_breadcrumbs_style']) === 5) {
            if ($breadcrumb_settings['me_breadcrumbs_dots_step_counter_style_switch'] == 'yes') {
                $default_color = $breadcrumb_settings['me_dots_step_counter_style_default_color'];
                $active_color = $breadcrumb_settings['me_dots_step_counter_style_active_color'];
            }

            $output .= '
                <style>
                    #' . $id . '.text-top a, #' . $id . '.text-bottom a {
                        text-decoration: none;
                    }
                    #' . $id . '.text-top li.visited > *::before, #' . $id . '.text-top li.current > *::before, #' . $id . '.text-bottom li.visited > *::before, #' . $id . '.text-bottom li.current > *::before {
                        background-color: ' . $default_color . ';
                    }
                    #' . $id . '.text-top a:hover, .me-breadcrumbs.text-bottom a:hover {
                        color: ' . $default_color . ';
                    }
                    #' . $id . '.text-top li > *::before, #' . $id . '.text-bottom li > *::before {
                        background-color: ' . $active_color . ';
                    }
                    #' . $id . '.text-top li.visited > a:hover::before, #' . $id . '.text-bottom li.visited > a:hover::before {
                        box-shadow: 0 0 0 3px ' . $default_color . '0.3' . ';
                    }
                    #' . $id . '.text-top li > a:hover::before, #' . $id . '.text-bottom li > a:hover::before {
                        box-shadow: 0 0 0 3px ' . $active_color . '0.3' . ';
                    }
                    #' . $id . '.multi-steps li.visited::after {
                        background-color: ' . $default_color . ';
                    }
                    #' . $id . '.multi-steps li::after {
                        background: ' . $active_color . ';
                    }
                </style>
            ';

            $add_style_class = 'multi-steps text-' . $breadcrumb_settings['me_dots_step_counter_style_position'] . ' count';
        }

        $data = [];
        $data['@type'] = 'BreadcrumbList';
        $data['itemListElement'] = [];

        $output .= '<ol class="me-breadcrumbs ' . $add_style_class . '" id="' . $id . '">';

        if ($breadcrumb_settings['me_breadcrumbs_homepage_settings'] === "yes") {
            $output .= '<li class="visited"><a href="/">Home</a></li>';
        }

        if ($breadcrumb_settings['me_breadcrumbs_parent_page'] === "yes") {
            $parents = get_post_ancestors($post->ID);

            krsort($parents);

            $parents_count = 1;

            foreach ($parents as $a_parent_ID) {
                $parent = get_post($a_parent_ID);

                $temp_data = [];
                $temp_data['@type'] = 'ListItem';
                $temp_data['position'] = $parents_count;
                $temp_data['name'] = $parent->post_title;
                $temp_data['item'] = get_the_permalink($parent->ID);

                $output .= '<li class="visited"><a href="' . get_permalink($parent->ID) . '">' . $parent->post_title . '</a></li>';

                $data['itemListElement'][] = $temp_data;

                $parents_count++;
            }
        }

        $current_page_data['@type'] = 'ListItem';
        $current_page_data['position'] = intval($parents_count);
        $current_page_data['name'] = esc_attr(get_the_title());
        $current_page_data['item'] = home_url(add_query_arg(array(), $wp->request));
        $data['itemListElement'][] = $current_page_data;

        $output .= '<li class="current"><span>' . esc_attr(get_the_title()) . '</span></li>';

        if ($breadcrumb_settings['me_breadcrumbs_child_pages'] === "yes") {
            wp_reset_postdata();

            $page_child_args = array(
                "post_type" => "page",
                "post_parent" => $post->ID,
                "orderby" => "menu_order",
                "order" => "ASC"
            );
            $get_page_child = get_posts($page_child_args);

            foreach ($get_page_child as $child_post) {
                setup_postdata($child_post);

                $output .= '<li><span>' . esc_attr(get_the_title($child_post->ID)) . '</span></li>';
            }

            wp_reset_postdata();
        }

        $output .= '</ol>';


        echo balanceTags($output, true);
    }
}