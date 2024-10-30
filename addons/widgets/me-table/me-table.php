<?php





namespace Elementor;



if (!defined('ABSPATH')) exit;



class Master_me_table extends Widget_Base

{

    public $base;



    public function __construct($data = [], $args = null)

    {

        parent::__construct($data, $args);

        wp_enqueue_style('masterelements-table-css', \MasterElements::widgets_url() . '/me-table/assets/css/style.css', false, \MasterElements::version, 'screen');

    }



    public function get_name()

    {



        return 'masterelements-table';



    }



    public function get_title()

    {



        return esc_html__('ME Table', 'masterelements');



    }



    public function get_icon()

    {



        return 'eicon-t-letter';



    }



    public function get_categories()

    {



        return ['additional-addons'];



    }



    protected function _register_controls()

    {

        $this->start_controls_section(

            'section_content_table',

            [

                'label' => esc_html__('Table', 'masterelements'),

            ]

        );



        $this->add_control(

            'ep_table_data_type',

            [

                'label' => esc_html__('Data Type', 'masterelements'),

                'type' => Controls_Manager::SELECT,

                'options' => [

                    'custom' => esc_html__('Custom', 'masterelements'),

                ],

                'default' => 'custom'

            ]);

        $repeater_header = new Repeater();



        $repeater_header->add_control(

            'table_header_content',

            [

                'label' => esc_html__('Text', 'masterelements'),

                'type' => Controls_Manager::TEXT,

                'placeholder' => esc_html__('Table Header', 'masterelements'),

                'default' => esc_html__('Table Header', 'masterelements'),

            ]

        );



        $repeater_header->add_control(

            'table_header_image',

            [

                'label' => esc_html__('Image', 'masterelements'),

                'type' => Controls_Manager::MEDIA,

            ]

        );





        $this->add_control(

            'ep_table_build_header',

            [

                'label' => 'Header table area',

                'type' => Controls_Manager::REPEATER,

                'default' => [

                    [

                        'table_header_content' => esc_html__('Header col 1 ', 'masterelements'),

                    ],

                    [

                        'table_header_content' => esc_html__('Header col 2', 'masterelements'),

                    ],

                    [

                        'table_header_content' => esc_html__('Header col 3', 'masterelements'),

                    ],

                ],

                'fields' => $repeater_header->get_controls(),

                'title_field' => '{{{ table_header_content }}}',

                'condition' => [

                    'ep_table_data_type' => 'custom',

                ],

            ]

        );

        $this->add_control(

            'ep_table_csv_type',

            [

                'label' => esc_html__('File Type', 'masterelements'),

                'type' => Controls_Manager::SELECT,

                'options' => [

                    'file' => esc_html__('Upload File', 'masterelements'),

                    'url' => esc_html__('Remote File URL', 'masterelements')

                ],

                'default' => 'file',

                'condition' => [

                    'ep_table_data_type' => 'csv',

                ],

            ]);



        $this->add_control(

            'ep_table_upload_csv',

            [

                'label' => esc_html__('Upload CSV File', 'masterelements'),

                'type' => Controls_Manager::MEDIA,

                'media_type' => array(),

                'condition' => [

                    'ep_table_csv_type' => 'file',

                    'ep_table_data_type' => 'csv',

                ]

            ]);



        $this->add_control(

            'ep_table_csv_url',

            [

                'label' => esc_html__('Enter a CSV File URL', 'masterelements'),

                'type' => Controls_Manager::URL,

                'show_external' => false,

                'label_block' => true,

                'default' => [

                    'url' => 'assets/table.csv',

                ],

                'condition' => [

                    'ep_table_data_type' => 'csv',

                    'ep_table_csv_type' => 'url'

                ]

            ]

        );



        $this->add_control(

            'header_align',

            [

                'label' => esc_html__('Header Alignment', 'masterelements'),

                'type' => Controls_Manager::CHOOSE,

                'options' => [

                    'left' => [

                        'title' => esc_html__('Left', 'masterelements'),

                        'icon' => 'fa fa-align-left',

                    ],

                    'center' => [

                        'title' => esc_html__('Center', 'masterelements'),

                        'icon' => 'fa fa-align-center',

                    ],

                    'right' => [

                        'title' => esc_html__('Right', 'masterelements'),

                        'icon' => 'fa fa-align-right',

                    ],

                ],

                'default' => 'center',

                'selectors' => [

                    '{{WRAPPER}} thead th' => 'text-align: {{VALUE}};',

                ],

            ]

        );





        $this->end_controls_section();



        $this->start_controls_section(

            'section_body',

            [

                'label' => esc_html__('Body Content', 'masterelements'),

                'condition' => [

                    'ep_table_data_type' => 'custom',

                ],

            ]

        );



        $repeater_body = new Repeater();



        $repeater_body->add_control(

            'ep_table_row', [

                'label' => esc_html__('New Row', 'masterelements'),

                'type' => Controls_Manager::SWITCHER,

                'label_off' => esc_html__('No', 'masterelements'),

                'label_on' => esc_html__('Yes', 'masterelements'),

                'return_value' => esc_html__('Row', 'masterelements'),

            ]

        );



        $repeater_body->add_control(

            'cell_select',

            [

                'label' => esc_html__('Text', 'masterelements'),

                'type' => Controls_Manager::SELECT,

                'default' => 'label',

                'options' => [

                    'label' => __('Label', 'masterelements'),

                    'img' => __('Image', 'masterelements'),

                    'btn' => __('Button', 'masterelements'),



                ],



            ]

        );



        $repeater_body->add_control(

            'cell_text',

            [

                'label' => esc_html__('Text', 'masterelements'),

                'type' => Controls_Manager::TEXT,

                'placeholder' => '',

                'default' => '',

                'condition' => [

                    //'cell_select' => ['label', 'btn'],

                ],



            ]

        );



        $repeater_body->start_controls_tabs('ep_table_col_btn_tabs_style');



        $repeater_body->start_controls_tab(

            'ep_table_col_btn_tabnormal',

            [

                'label' => esc_html__('Normal', 'masterelements'),

            ]

        );

        $repeater_body->add_control(

            'ep_table_search_input_background_color',

            [

                'label' => esc_html__('Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} a.button' => 'background-color: {{VALUE}};',

                ],

            ]

        );



        $repeater_body->add_control(

            'epress_button_text_color',

            [

                'label' => esc_html__('Text Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'default' => '#fff',

                'selectors' => [

                    '{{WRAPPER}} a.button' => 'color: {{VALUE}};',

                ],

                'condition' => [

                    'cell_select' => 'btn'

                ]

            ]

        );



        $repeater_body->add_group_control(

            Group_Control_Box_Shadow::get_type(),

            [

                'name' => 'ep_tbl_button_box_shadow',

                'label' => esc_html__('Box Shadow', 'masterelements'),

                'selector' => '{{WRAPPER}} a.button',

                'condition' => [

                    'cell_select' => 'btn'

                ]

            ]

        );



        $repeater_body->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'ep_button_border',

                'label' => esc_html__('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} a.button',

                'condition' => [

                    'cell_select' => 'btn'

                ]

            ]

        );



        $repeater_body->add_responsive_control(

            'ep_tbl_button_border_radius',

            [

                'label' => esc_html__('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', '%'],

                'selectors' => [

                    '{{WRAPPER}} a.button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

                'condition' => [

                    'cell_select' => 'btn'

                ]

            ]

        );



        $repeater_body->add_responsive_control(

            'ep_l_button_padding',

            [

                'label' => esc_html__('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'default' => [

                    'top' => 0,

                    'bottom' => 0,

                    'left' => 0,

                    'right' => 0,

                    'unit' => 'px'

                ],

                'selectors' => [

                    '{{WRAPPER}} a.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

                'condition' => [

                    'cell_select' => 'btn'

                ]

            ]

        );

        $repeater_body->end_controls_tab();



        $repeater_body->start_controls_tab(

            'ep_table_col_btn_tabhover',

            [

                'label' => esc_html__('Hover', 'masterelements'),

            ]

        );

        $repeater_body->add_control(

            'ep_table_search_input_background_color_hover',

            [

                'label' => esc_html__('Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} a.button:hover' => 'background-color: {{VALUE}};',

                ],

            ]

        );



        $repeater_body->add_control(

            'epress_button_text_color_hover',

            [

                'label' => esc_html__('Text Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'default' => '#fff',

                'selectors' => [

                    '{{WRAPPER}} a.button:hover' => 'color: {{VALUE}};',

                ],

                'condition' => [

                    'cell_select' => 'btn'

                ]

            ]

        );



        $repeater_body->add_group_control(

            Group_Control_Box_Shadow::get_type(),

            [

                'name' => 'ep_tbl_button_box_shadow_hover',

                'label' => esc_html__('Box Shadow', 'masterelements'),

                'selector' => '{{WRAPPER}} a.button:hover',

                'condition' => [

                    'cell_select' => 'btn'

                ]

            ]

        );



        $repeater_body->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'ep_button_border_hover',

                'label' => esc_html__('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} a.button:hover',

                'condition' => [

                    'cell_select' => 'btn'

                ]

            ]

        );



        $repeater_body->add_responsive_control(

            'ep_tbl_button_border_radius_hover',

            [

                'label' => esc_html__('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', '%'],

                'selectors' => [

                    '{{WRAPPER}} a.button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

                'condition' => [

                    'cell_select' => 'btn'

                ]

            ]

        );



        $repeater_body->end_controls_tab();

        $repeater_body->end_controls_tabs();

        

        $this->add_control(

            'cell_image',

            [

                'label' => esc_html__('Cell Image', 'masterelements'),

                'type' => \Elementor\Controls_Manager::MEDIA,

                

                'condition' => [

                    'cell_select' => 'img',

                ],



            ]

        );



        $repeater_body->add_control(

            'body_cell_setting_url',

            [

                'label' => esc_html__('Add a url? ', 'masterelements'),

                'type' => Controls_Manager::SWITCHER,

                'default' => 'no',

                'label_on' => esc_html__('Yes', 'masterelements'),

                'label_off' => esc_html__('No', 'masterelements'),

            ]

        );



        $repeater_body->add_control(

            'body_cell_url',

            [

                'label' => esc_html__('URL', 'masterelements'),

                'type' => Controls_Manager::URL,

                'placeholder' => esc_url('http://your-link.com'),

                'condition' => [

                    'body_cell_setting_url' => 'yes'

                ]

            ]

        );

        $this->add_control(

            'table_body_content',

            [

                'label' => 'Body table area',

                'type' => Controls_Manager::REPEATER,

                'default' => [

                    [

                        'table_body_element' => 'cell',

                        'cell_text' => esc_html__('Column 1', 'masterelements'),

                        'ep_table_row' => 'Row',

                    ],

                    [

                        'table_body_element' => 'cell',

                        'cell_text' => esc_html__('Column 2', 'masterelements'),

                    ],

                    [

                        'table_body_element' => 'cell',

                        'cell_text' => esc_html__('Column 3', 'masterelements'),

                    ],

                    [

                        'table_body_element' => 'cell',

                        'cell_text' => esc_html__('Column 1', 'masterelements'),

                        'ep_table_row' => 'Row',

                    ],

                    [

                        'table_body_element' => 'cell',

                        'cell_text' => esc_html__('Column 2', 'masterelements'),

                    ],

                    [

                        'table_body_element' => 'cell',

                        'cell_text' => esc_html__('Column 3', 'masterelements'),

                    ],

                ],

                'fields' => $repeater_body->get_controls(),

                'title_field' => ' {{{ ep_table_row }}}: {{{ cell_text }}}',

            ]

        );



        $this->add_control(

            'body_align',

            [

                'label' => esc_html__('Body Alignment', 'masterelements'),

                'type' => Controls_Manager::CHOOSE,

                'options' => [

                    'left' => [

                        'title' => esc_html__('Left', 'masterelements'),

                        'icon' => 'fa fa-align-left',

                    ],

                    'center' => [

                        'title' => esc_html__('Center', 'masterelements'),

                        'icon' => 'fa fa-align-center',

                    ],

                    'right' => [

                        'title' => esc_html__('Right', 'masterelements'),

                        'icon' => 'fa fa-align-right',

                    ],

                ],

                'default' => 'center',

                'selectors' => [

                    '{{WRAPPER}} tr td' => 'text-align: {{VALUE}};',

                ],

            ]

        );

        $this->end_controls_section();





        // Header

        $this->start_controls_section(

            'section_style_header',

            [

                'label' => esc_html__('Header', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            ]

        );



        $this->add_group_control(

            Group_Control_Background::get_type(),

            array(

                'name' => 'header_background',

                'default' => '#6E5BDE',

                'selector' => '{{WRAPPER}} thead th',

            )

        );



        $this->add_control(

            'header_color',

            [

                'label' => esc_html__('Text Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'default' => '#fff',

                'selectors' => [

                    '{{WRAPPER}} thead th' => 'color: {{VALUE}};',

                    // '{{WRAPPER}} thead th' => 'stroke: {{VALUE}}; fill: {{VALUE}};',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name' => 'ep_table_header_typography',

                'label' => esc_html__('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} thead th',

            ]

        );



        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'ep_header_border_style',

                'label' => esc_html__('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} thead th',

            ]

        );



        $this->add_responsive_control(

            'header_padding',

            [

                'label' => esc_html__('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'default' => [

                    'top' => 17,

                    'bottom' => 17,

                    'left' => 17,

                    'right' => 17,

                    'unit' => 'px'

                ],

                'selectors' => [

                    '{{WRAPPER}} thead th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );





        $this->end_controls_section();



        $this->start_controls_section(

            'section_style_header_image',

            [

                'label' => esc_html__('Header Image', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            ]

        );



        $this->add_control(

            'ep_header_image_height_width',

            [

                'label' => esc_html__('Use Height Width', 'masterelements'),

                'type' => Controls_Manager::SWITCHER,

                'label_on' => esc_html__('Show', 'masterelements'),

                'label_off' => esc_html__('Hide', 'masterelements'),

                'return_value' => 'yes',

                'default' => 'no',

            ]

        );



        $this->add_responsive_control(

            'ep_table_header_image_height',

            [

                'label' => esc_html__('Height', 'masterelements'),

                'type' => Controls_Manager::SLIDER,

                'size_units' => ['px', '%'],

                'range' => [

                    'px' => [

                        'min' => 0,

                        'max' => 1000,

                        'step' => 1,

                    ],

                    '%' => [

                        'min' => 0,

                        'max' => 100,

                        'step' => 1,

                    ],

                ],

                'selectors' => [

                    '{{WRAPPER}} img.alignnone.size-full.wp-image-750' => 'height: {{SIZE}}{{UNIT}};',

                ],

                'condition' => [

                    'ep_header_image_height_width' => 'yes'

                ]

            ]

        );



        $this->add_responsive_control(

            'ep_table_header_image_width',

            [

                'label' => esc_html__('Width', 'masterelements'),

                'type' => Controls_Manager::SLIDER,

                'size_units' => ['px', '%'],

                'range' => [

                    'px' => [

                        'min' => 0,

                        'max' => 1000,

                        'step' => 1,

                    ],

                    '%' => [

                        'min' => 0,

                        'max' => 100,

                        'step' => 1,

                    ],

                ],

                'selectors' => [

                    '{{WRAPPER}} img.alignnone.size-full.wp-image-750' => 'width: {{SIZE}}{{UNIT}};',

                ],

                'condition' => [

                    'ep_header_image_height_width' => 'yes'

                ]

            ]

        );



        $this->add_responsive_control(

            'ep_table_header_image_radius',

            [

                'label' => esc_html__('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', '%'],

                'selectors' => [

                    '{{WRAPPER}} img.alignnone.size-full.wp-image-750' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'ep_table_header_image_border',

                'label' => esc_html__('Border', 'masterelements'),

                'placeholder' => '1px',

                'default' => '1px',

                'selector' => '{{WRAPPER}} img.alignnone.size-full.wp-image-750',

            ]

        );





        $this->end_controls_section();



        $this->start_controls_section(

            'section_style_body',

            [

                'label' => esc_html__('Body', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            ]

        );

        $this->start_controls_tabs('ep_tbl_body_tabs');



        $this->start_controls_tab(

            'ep_tbl_body_tab',

            [

                'label' => esc_html('Normal', 'masterelements')

            ]

        );

        $this->add_control(

            'normal_background',

            [

                'label' => esc_html__('Background', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'default' => '#fff',

                'selectors' => [

                    '{{WRAPPER}} tr' => 'background-color: {{VALUE}};',

                ],

            ]

        );



        $this->add_control(

            'normal_color',

            [

                'label' => esc_html__('Text Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} tr' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name' => 'ep_table_body_typography',

                'label' => esc_html__('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} tr',

            ]

        );



        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'ep_cell_border_style',

                'label' => esc_html__('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} tr',

            ]

        );



        $this->add_responsive_control(

            'cell_padding',

            [

                'label' => esc_html__('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'default' => [

                    'top' => 17,

                    'bottom' => 17,

                    'left' => 17,

                    'right' => 17,

                    'unit' => 'px'

                ],

                'selectors' => [

                    '{{WRAPPER}} tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

                'separator' => 'after',

            ]

        );

        $this->end_controls_tab();



        $this->start_controls_tab(

            'ep_tbl_body_tab_hover',

            [

                'label' => esc_html('Hover', 'masterelements')

            ]

        );

        $this->add_group_control(

            Group_Control_Box_Shadow::get_type(),

            [

                'name' => 'ep_tbl_body_row_box_shadow_hover',

                'label' => esc_html__('Box Shadow', 'masterelements'),

                'selector' => '{{WRAPPER}} tr:hover',

            ]

        );



        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'ep_cell_border_style_hover',

                'label' => esc_html__('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} tr:hover',

            ]

        );



        $this->add_control(

            'ep_tbl_row_border_radius_hover',

            [

                'label' => esc_html__('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', '%', 'em'],

                'default' => [

                    'top' => 50,

                    'right' => 50,

                    'bottom' => 50,

                    'left' => 50,

                    'unit' => 'px'

                ],

                'selectors' => [

                    '{{WRAPPER}} tr:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();



        $this->start_controls_section(

            'section_style_body_image',

            [

                'label' => esc_html__('Body Image', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

            ]

        );



        $this->add_control(

            'ep_body_image_height_width',

            [

                'label' => esc_html__('Use Height Width', 'masterelements'),

                'type' => Controls_Manager::SWITCHER,

                'label_on' => esc_html__('Show', 'masterelements'),

                'label_off' => esc_html__('Hide', 'masterelements'),

                'return_value' => 'yes',

                'default' => 'no',

            ]

        );



        $this->add_responsive_control(

            'ep_table_body_image_height',

            [

                'label' => esc_html__('Height', 'masterelements'),

                'type' => Controls_Manager::SLIDER,

                'size_units' => ['px', '%'],

                'range' => [

                    'px' => [

                        'min' => 0,

                        'max' => 1000,

                        'step' => 1,

                    ],

                    '%' => [

                        'min' => 0,

                        'max' => 100,

                        'step' => 1,

                    ],

                ],

                'selectors' => [

                    '{{WRAPPER}} img.alignnone.size-full.wp-image-747' => 'height: {{SIZE}}{{UNIT}};',

                ],

                'condition' => [

                    'ep_body_image_height_width' => 'yes'

                ]

            ]

        );



        $this->add_responsive_control(

            'ep_table_body_image_width',

            [

                'label' => esc_html__('Width', 'masterelements'),

                'type' => Controls_Manager::SLIDER,

                'size_units' => ['px', '%'],

                'range' => [

                    'px' => [

                        'min' => 0,

                        'max' => 1000,

                        'step' => 1,

                    ],

                    '%' => [

                        'min' => 0,

                        'max' => 100,

                        'step' => 1,

                    ],

                ],

                'selectors' => [

                    '{{WRAPPER}} img.alignnone.size-full.wp-image-747' => 'width: {{SIZE}}{{UNIT}};',

                ],

                'condition' => [

                    'ep_body_image_height_width' => 'yes'

                ]

            ]

        );



        $this->add_responsive_control(

            'ep_table_body_image_radius',

            [

                'label' => esc_html__('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', '%'],

                'selectors' => [

                    '{{WRAPPER}} img.alignnone.size-full.wp-image-747' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'ep_table_body_image_border',

                'label' => esc_html__('Border', 'masterelements'),

                'placeholder' => '1px',

                'default' => '1px',

                'selector' => '{{WRAPPER}} img.alignnone.size-full.wp-image-747',

            ]

        );



        $this->end_controls_section();





        // button

        $this->start_controls_section(

            'ep_table_button_style',

            [

                'label' => esc_html__('Button', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

                'condition' => [

                    'show_entries!' => 'yes',

                    'show_button' => 'yes'

                ]

            ]

        );





        // btn general settings

        $this->add_control(

            'ep_table_btn_general_settings',

            [

                'label' => esc_html__('General Settings', 'masterelements'),

                'type' => Controls_Manager::HEADING,

                'separator' => 'before',

            ]

        );



        $this->add_responsive_control(

            'ep_table_btn_text_padding',

            [

                'label' => esc_html__('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} button.dt-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );



        $this->add_responsive_control(

            'ep_table_btn_text_margin',

            [

                'label' => esc_html__('Margin', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} button.dt-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name' => 'ep_table_btn_typography',

                'label' => esc_html__('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} button.dt-button',

            ]

        );



        $this->add_group_control(

            Group_Control_Text_Shadow::get_type(),

            [

                'name' => 'ep_table_btn_shadow',

                'selector' => '{{WRAPPER}} button.dt-button',

            ]

        );



        $this->start_controls_tabs('ep_table_btn_tabs_style');



        $this->start_controls_tab(

            'ep_table_btn_tabnormal',

            [

                'label' => esc_html__('Normal', 'masterelements'),

            ]

        );



        $this->add_control(

            'ep_table_btn_text_color',

            [

                'label' => esc_html__('Text Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'default' => '',

                'selectors' => [

                    '{{WRAPPER}} button.dt-button, {{WRAPPER}} .ep_table button.dt-button:active, {{WRAPPER}} .ep_table button.dt-button:focus' => 'color: {{VALUE}} !important;',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Background::get_type(),

            array(

                'name' => 'ep_table_btn_bg_color',

                'default' => '',

                'selector' => '{{WRAPPER}} button.dt-button, {{WRAPPER}} .ep_table button.dt-button:active, {{WRAPPER}} .ep_table button.dt-button:focus',

            )

        );



        $this->end_controls_tab();



        $this->start_controls_tab(

            'ep_table_btn_tab_button_hover',

            [

                'label' => esc_html__('Hover', 'masterelements'),

            ]

        );



        $this->add_control(

            'ep_table_btn_hover_color',

            [

                'label' => esc_html__('Text Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'default' => '#CCCCCC',

                'selectors' => [

                    '{{WRAPPER}} button.dt-button:hover' => 'color: {{VALUE}} !important;',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Background::get_type(),

            array(

                'name' => 'ep_table_btn_bg_hover_color',

                'default' => '',

                'selector' => '{{WRAPPER}} button.dt-button:hover',

            )

        );



        $this->end_controls_tab();

        $this->end_controls_tabs();

        // btn general settings



        // btn border settings

        $this->add_control(

            'ep_table_btn_border_settings',

            [

                'label' => esc_html__('Border Settings', 'masterelements'),

                'type' => Controls_Manager::HEADING,

                'separator' => 'before',

            ]

        );



        $this->add_responsive_control(

            'ep_table_btn_border_style',

            [

                'label' => esc_html_x('Border Type', 'Border Control', 'masterelements'),

                'type' => Controls_Manager::SELECT,

                'default' => 'solid',

                'options' => [

                    'none' => esc_html__('None', 'masterelements'),

                    'solid' => esc_html_x('Solid', 'Border Control', 'masterelements'),

                    'double' => esc_html_x('Double', 'Border Control', 'masterelements'),

                    'dotted' => esc_html_x('Dotted', 'Border Control', 'masterelements'),

                    'dashed' => esc_html_x('Dashed', 'Border Control', 'masterelements'),

                    'groove' => esc_html_x('Groove', 'Border Control', 'masterelements'),

                ],

                'selectors' => [

                    '{{WRAPPER}} .ep_table  button.dt-button' => 'border-style: {{VALUE}};',

                ],

            ]

        );

        $this->add_responsive_control(

            'ep_table_btn_border_dimensions',

            [

                'label' => esc_html_x('Width', 'Border Control', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'selectors' => [

                    '{{WRAPPER}} .ep_table  button.dt-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

                'condition' => [

                    'ep_table_btn_border_style!' => 'none'

                ]

            ]

        );

        $this->start_controls_tabs(

            'xs_tabs_button_border_style',

            [

                'condition' => [

                    'ep_table_btn_border_style!' => 'none'

                ]

            ]

        );

        $this->start_controls_tab(

            'ep_table_btn_tab_border_normal',

            [

                'label' => esc_html__('Normal', 'masterelements'),

            ]

        );



        $this->add_control(

            'ep_table_btn_border_color',

            [

                'label' => esc_html_x('Color', 'Border Control', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'default' => '',

                'selectors' => [

                    '{{WRAPPER}} .ep_table button.dt-button, {{WRAPPER}} .ep_table button.dt-button:active' => 'border-color: {{VALUE}};',

                ],

            ]

        );

        $this->end_controls_tab();



        $this->start_controls_tab(

            'ep_table_btn_tab_button_border_hover',

            [

                'label' => esc_html__('Hover', 'masterelements'),

            ]

        );

        $this->add_control(

            'ep_table_btn_hover_border_color',

            [

                'label' => esc_html_x('Color', 'Border Control', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'default' => '',

                'selectors' => [

                    '{{WRAPPER}} .ep_table  button.dt-button:hover' => 'border-color: {{VALUE}};',

                ],

            ]

        );

        $this->end_controls_tab();



        $this->end_controls_tabs();

        $this->add_responsive_control(

            'ep_table_btn_border_radius',

            [

                'label' => esc_html__('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', '%'],

                'default' => [

                    'top' => '',

                    'right' => '',

                    'bottom' => '',

                    'left' => '',

                ],

                'selectors' => [

                    '{{WRAPPER}} button.dt-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );





        // btn shadow settings

        $this->add_control(

            'ep_table_btn_shadow_settings',

            [

                'label' => esc_html__('Shadow Settings', 'masterelements'),

                'type' => Controls_Manager::HEADING,

                'separator' => 'before',

            ]

        );



        $this->add_group_control(

            Group_Control_Box_Shadow::get_type(),

            [

                'name' => 'ep_table_btn_box_shadow_group',

                'selector' => '{{WRAPPER}} button.dt-button',

            ]

        );

        // end btn shadow settings





        $this->end_controls_section();

        // end button



        // Search section

        $this->start_controls_section(

            'ep_section_search_style',

            [

                'label' => esc_html__('Search', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

                'condition' => [

                    'show_search' => 'yes'

                ]

            ]

        );



        $this->add_control(

            'ep_table_search_icon_heading',

            [

                'label' => esc_html__('Icon:', 'masterelements'),

                'type' => Controls_Manager::HEADING,

                'separator' => 'before'

            ]

        );



        $this->add_control(

            'ep_table_search_icon_color',

            [

                'label' => esc_html__('Icon Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'default' => '#cacaca',

                'selectors' => [

                    '{{WRAPPER}} .ep-table-search-label i' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->add_responsive_control(

            'ep_table_search_icon_font_size',

            array(

                'label' => esc_html__('Font Size', 'masterelements'),

                'type' => Controls_Manager::SLIDER,

                'size_units' => array(

                    'px', 'em', 'rem',

                ),

                'range' => array(

                    'px' => array(

                        'min' => 1,

                        'max' => 100,

                    ),

                ),

                'selectors' => array(

                    '{{WRAPPER}} .ep-table-search-label i' => 'font-size: {{SIZE}}{{UNIT}}',

                ),

            )

        );



        $this->add_responsive_control(

            'ep_table_search_icon_padding',

            [

                'label' => esc_html__('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', '%', 'em'],

                'selectors' => [

                    '{{WRAPPER}} .ep-table-search-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );



        $this->add_responsive_control(

            'ep_table_search_icon_margin',

            [

                'label' => esc_html__('Margin', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', '%', 'em'],

                'selectors' => [

                    '{{WRAPPER}} .ep-table-search-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );





        $this->add_control(

            'ep_table_search_input_heading',

            [

                'label' => esc_html__('Input:', 'masterelements'),

                'type' => Controls_Manager::HEADING,

                'separator' => 'before'

            ]

        );



        $this->add_responsive_control(

            'ep_table_search_input_width',

            [

                'label' => esc_html__('Width', 'masterelements'),

                'type' => Controls_Manager::SLIDER,

                'size_units' => ['px', '%'],

                'default' => [

                    'size' => 425,

                    'unit' => 'px'

                ],

                'range' => [

                    'px' => [

                        'min' => 0,

                        'max' => 1000,

                        'step' => 1,

                    ],

                    '%' => [

                        'min' => 0,

                        'max' => 100,

                        'step' => 1,

                    ],

                ],

                'selectors' => [

                    '{{WRAPPER}} .dataTables_filter input' => 'width: {{SIZE}}{{UNIT}};',

                ],

            ]

        );



        $this->add_responsive_control(

            'ep_table_search_input_padding',

            [

                'label' => esc_html__('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'default' => [

                    'top' => 9,

                    'bottom' => 9,

                    'left' => 20,

                    'right' => 50,

                    'unit' => 'px'

                ],

                'selectors' => [

                    '{{WRAPPER}} .dataTables_filter input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'ep_table_search_input_border',

                'label' => esc_html__('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .dataTables_filter input',

            ]

        );



        $this->add_responsive_control(

            'ep_table_search_input_border_radius',

            [

                'label' => esc_html__('Border Radius', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', '%'],

                'selectors' => [

                    '{{WRAPPER}} .dataTables_filter input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Box_Shadow::get_type(),

            [

                'name' => 'ep_table_search_input_border_shadow',

                'selector' => '{{WRAPPER}} .dataTables_filter input',

            ]

        );



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name' => 'ep_table_search_input_text_typography',

                'label' => esc_html__('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .dataTables_filter input',

            ]

        );



        $this->start_controls_tabs(

            'ep_table_search_input_tabs'

        );



        $this->start_controls_tab(

            'ep_table_search_input_normal_tab',

            [

                'label' => esc_html__('Normal', 'masterelements'),

            ]

        );



        $this->add_control(

            'ep_table_search_input_color',

            [

                'label' => esc_html__('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .dataTables_filter input' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->add_control(

            'ep_table_search_input_background_color',

            [

                'label' => esc_html__('Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .dataTables_filter input' => 'background-color: {{VALUE}};',

                ],

            ]

        );





        $this->end_controls_tab();





        $this->start_controls_tab(

            'ep_table_search_input_hover_tab',

            [

                'label' => esc_html__('Hover', 'masterelements'),

            ]

        );



        $this->add_control(

            'ep_table_search_input_hover_color',

            [

                'label' => esc_html__('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .dataTables_filter input:hover' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->add_control(

            'ep_table_search_input_hover_background_color',

            [

                'label' => esc_html__('Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .dataTables_filter input:hover' => 'background-color: {{VALUE}};',

                ],

            ]

        );





        $this->end_controls_tab();



        $this->start_controls_tab(

            'ep_table_search_input_focus_tab',

            [

                'label' => esc_html__('Focus', 'masterelements'),

            ]

        );



        $this->add_control(

            'ep_table_search_input_focus_color',

            [

                'label' => esc_html__('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .dataTables_filter input:focus' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->add_control(

            'ep_table_search_input_focus_background_color',

            [

                'label' => esc_html__('Background Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .dataTables_filter input:focus' => 'background-color: {{VALUE}};',

                ],

            ]

        );



        $this->end_controls_tab();



        $this->end_controls_tabs();



        $this->add_control(

            'ep_table_search_input_placeholder_heading',

            [

                'label' => esc_html__('Input Placeholder:', 'masterelements'),

                'type' => Controls_Manager::HEADING,

                'separator' => 'before'

            ]

        );



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name' => 'ep_table_search_input_placeholder_typo',

                'label' => esc_html__('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .ep_table .dataTables_wrapper .dataTables_filter input::placeholder',

            ]

        );



        $this->add_control(

            'ep_table_search_input_placeholder_color',

            [

                'label' => esc_html__('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .ep_table .dataTables_wrapper .dataTables_filter input::placeholder' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->end_controls_section();





        // Info section

        $this->start_controls_section(

            'ep_section_info_style',

            [

                'label' => esc_html__('Info', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

                'condition' => [

                    'show_info' => 'yes'

                ]

            ]

        );



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name' => 'ep_section_info_style_normal_color_typography',

                'label' => esc_html__('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .dataTables_info',

            ]

        );



        $this->start_controls_tabs(

            'ep_section_info_style_tabs'

        );



        $this->start_controls_tab(

            'ep_section_info_style_normal_tab',

            [

                'label' => esc_html__('Normal', 'masterelements')

            ]

        );



        $this->add_control(

            'ep_section_info_style_normal_color',

            [

                'label' => esc_html__('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .dataTables_info' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->end_controls_tab();



        $this->start_controls_tab(

            'ep_section_info_style_hover_tab',

            [

                'label' => esc_html__('Hover', 'masterelements')

            ]

        );



        $this->add_control(

            'ep_section_info_style_hover_color',

            [

                'label' => esc_html__('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .dataTables_info:hover' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->end_controls_tab();



        $this->end_controls_tabs();





        $this->end_controls_section();



        //  Entries

        $this->start_controls_section(

            'ep_section_entries_style',

            [

                'label' => esc_html__('Entries', 'masterelements'),

                'tab' => Controls_Manager::TAB_STYLE,

                'condition' => [

                    'show_entries' => 'yes'

                ]

            ]

        );





        $this->add_group_control(

            Group_Control_Background::get_type(),

            array(

                'name' => 'ep_entries_background',

                'default' => '#6E5BDE',

                'selector' => '{{WRAPPER}} .dataTables_length label, {{WRAPPER}} .dataTables_length select',

            )

        );



        $this->add_responsive_control(

            'ep_entries_padding',

            [

                'label' => esc_html__('Padding', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .dataTables_length select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );



        $this->add_responsive_control(

            'ep_entries_margin',

            [

                'label' => esc_html__('Margin', 'masterelements'),

                'type' => Controls_Manager::DIMENSIONS,

                'size_units' => ['px', 'em', '%'],

                'selectors' => [

                    '{{WRAPPER}} .dataTables_length' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'ep_entries_border',

                'label' => esc_html__('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .dataTables_length label',

            ]

        );



        $this->add_group_control(

            Group_Control_Box_Shadow::get_type(),

            [

                'name' => 'ep_entries_box_shadow',

                'selector' => '{{WRAPPER}} .dataTables_length label',

            ]

        );



        $this->add_control(

            'ep_section_entries_label_heading',

            [

                'label' => esc_html__('Label:', 'masterelements'),

                'type' => Controls_Manager::HEADING,

                'separator' => 'before',

            ]

        );



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name' => 'ep_section_entries_label_typo',

                'label' => esc_html__('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .dataTables_length label',

            ]

        );



        $this->add_control(

            'ep_section_entries_label_color',

            [

                'label' => esc_html__('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .dataTables_length label' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->add_control(

            'ep_section_entries_select_heading',

            [

                'label' => esc_html__('Select:', 'masterelements'),

                'type' => Controls_Manager::HEADING,

                'separator' => 'before',

            ]

        );



        $this->add_group_control(

            Group_Control_Typography::get_type(),

            [

                'name' => 'ep_section_entries_select_typography',

                'label' => esc_html__('Typography', 'masterelements'),

                'selector' => '{{WRAPPER}} .dataTables_length select',

            ]

        );



        $this->add_control(

            'ep_section_entries_select_color',

            [

                'label' => esc_html__('Color', 'masterelements'),

                'type' => Controls_Manager::COLOR,

                'selectors' => [

                    '{{WRAPPER}} .dataTables_length select' => 'color: {{VALUE}};',

                ],

            ]

        );



        $this->add_group_control(

            Group_Control_Border::get_type(),

            [

                'name' => 'ep_section_entries_select_border',

                'label' => esc_html__('Border', 'masterelements'),

                'selector' => '{{WRAPPER}} .dataTables_length select',

            ]

        );





        $this->end_controls_section();





    }



    /**

     * Render the Dual Heading And Dual Button widget output on the frontend.

     *

     * Written in PHP and used to generate the final HTML.

     *

     * @since 1.0.0

     *

     * @access protected

     */



    protected function render()

    {
 
        $settings = $this->get_settings_for_display();

        extract($settings);



        ?>

        <table class="dedicated_table stacktable large-only">

            <thead>

            <tr>

                

                <?php foreach ($settings['ep_table_build_header'] as $head): ?>

                    <th> <?php if(!empty($head['table_header_image']['url'])){?><img loading="lazy" class="alignnone size-full wp-image-750"

                             src="<?= $head['table_header_image']['url'] ?>"

                             alt="" width="30" height="30"><?php } ?><?= $head['table_header_content'] ?>

                    </th>

                <?php endforeach; ?>

                

            </tr>

            </thead>

            <tbody>



            <?php

            foreach ($settings['table_body_content'] as $cell):

                if ($cell['ep_table_row'] == 'Row') {

                    echo '</tr><tr>';

                }



                if ($cell['cell_select'] == 'label') {

                    echo '<td>' . $cell['cell_text'] . '</td>';

                } elseif ($cell['cell_select'] == 'img') {

                    echo '<td><img loading="lazy" class="alignnone size-full wp-image-747"

                         src="' . $cell['cell_image']['url'] . '"

                         alt="" width="50" height="47"></td>';

                } elseif ($cell['cell_select'] == 'btn') {

                    echo '<td class="table_btn"><a class="button" href="index.php/whmcs-bridge/?ccce=cart">' . $cell['cell_text'] . '</a></td>';

                }



            endforeach;

            ?>

        </table>



        <?php

    }



}