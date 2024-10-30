<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

class Master_me_Forms extends Widget_Base
{

    public $base;

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_style('forms-css', \MasterElements::widgets_url() . '/me-forms/assets/css/forms.css', false, \MasterElements::version);
        wp_enqueue_script('validator-js', \MasterElements::widgets_url() . '/me-forms/assets/js/validator.js', false, \MasterElements::version);
    }

    public function get_name()
    {
        return 'Master Forms';
    }

    public function get_title()
    {
        return __('Master Forms', 'masterelements');
    }

    public function get_icon()
    {
        return 'eicon-site-search';
    }

    public function get_keywords()
    {
        return ['form', 'forms', 'field', 'button'];
    }

    public function get_categories()
    {
        //get category from input-handler.php file
        return ['additional-addons'];
    }

    protected function _register_controls()
    {

        //content section named input
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Form field', 'masterelements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        //repeater
        $repeater = new \Elementor\Repeater();
        $this->register_repeater_controls($repeater);

        //To Email Address control
        $this->add_control(
            'reciver_email',
            [

                'label' => __('To Email', 'masterelements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __(get_option('admin_email'), 'masterelements'),
                'placeholder' => __('abc@abc.com', 'masterelements'),
            ]
        );
        //Sender Email Address control
        $this->add_control(
            'sender_email',
            [

                'label' => __('From Email', 'masterelements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __(get_option('admin_email'), 'masterelements'),
                'placeholder' => __('abc@abc.com', 'masterelements'),
            ]
        );
        //Email Subject control
        $this->add_control(
            'email_subject',
            [

                'label' => __('Email Subject', 'masterelements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Contact Form Query', 'masterelements'),
                'placeholder' => __('Enter Email Subject', 'masterelements'),
            ]
        );

        $this->add_control(
            'input_list',
            [
                'label' => __('fields', 'masterelements'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'add_input' => __('Select field', 'masterelements'),
                        'input_text_color' => __('Select field Color', 'masterelements'),
                        'input_css_class' => __('Custom Class', 'masterelements'),
                    ],

                ],
                'title_field' => '{{{ add_input }}}',
            ]
        );

        $this->add_control(
            'input_align',
            [
                'label' => __('Alignment', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'masterelements'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'masterelements'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'masterelements'),
                        'icon' => 'fa fa-align-right',

                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .outer' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );


        $this->end_controls_section();
        //start style section
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Button Style', 'additional-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        //button title control
        $this->add_control(
            'input_name',
            [

                'label' => __('Button Title ', 'masterelements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Submit!', 'masterelements'),
                'placeholder' => __('Send', 'masterelements'),
            ]
        );
        $this->start_controls_tabs(
            'button_tabs'
        );
        //Button Normal Style
        $this->start_controls_tab(
            'button_normal',
            [
                'label' => esc_html__('Normal', 'masterelements'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __('Button Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .me-button-outer .me-submit-btn',
            ]

        );
        //width slider control
        $this->add_responsive_control(
            'width',
            [
                'label' => __('Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'], 'devices' => ['desktop'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //width Tablet slider control
        $this->add_responsive_control(
            'width_tablet',
            [
                'label' => __('Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'devices' => ['tablet', 'mobile'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //Height slider control for button on Desktop
        $this->add_responsive_control(
            'height',
            [
                'label' => __('Height', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'devices' => ['desktop'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //Height slider control for button on Tablet/Mobile
        $this->add_responsive_control(
            'height',
            [
                'label' => __('Height', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'devices' => ['tablet', 'mobile'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //margin control for input
        $this->add_responsive_control(
            'margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'devices' => ['desktop'],
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //margin control for input
        $this->add_responsive_control(
            'margin_tablet',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'devices' => ['tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //padding control for input
        $this->add_responsive_control(
            'padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'devices' => ['desktop'],
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //padding control for button on tablet Mobile
        $this->add_responsive_control(
            'padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'devices' => ['tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __('Border', 'masterelements'),
                'selector' => '.me-button-outer .me-submit-btn',
            ]
        );
        //border radius control
        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //text shadow control
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'label' => __('Text Shadow', 'masterelements'),
                'selector' => '.me-button-outer .me-submit-btn',
            ]
        );
        //box shadow control
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __('Box Shadow', 'masterelements'),
                'selector' => '.me-button-outer .me-submit-btn',
            ]
        );
        //box align control for button on desktop
        $this->add_responsive_control(
            'button_text_align',
            [
                'label' => __('Button Text Alignment', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'masterelements'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'masterelements'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'masterelements'),
                        'icon' => 'fa fa-align-right',

                    ],
                ],
                'default' => 'left',
                'devices' => ['desktop'],
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'button_align',
            [
                'label' => __('Button Float', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'masterelements'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'masterelements'),
                        'icon' => 'fa fa-align-right',

                    ],
                ],
                'default' => 'left',
                'devices' => ['desktop'],
                'selectors' => [
                    '{{WRAPPER}} .outer' => 'float: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        //box align control for button on  tablet/Mobile
        $this->add_responsive_control(
            'button_align',
            [
                'label' => __('Alignment', 'masterelements'),
                'type' => Controls_Manager::CHOOSE,
                'devices' => ['tablet', 'mobile'],
                'options' => [
                    'left' => [
                        'title' => __('Left', 'masterelements'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'masterelements'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'masterelements'),
                        'icon' => 'fa fa-align-right',

                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        //color picker control for input text color
        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        //color picker control for background color
        $this->add_control(
            'button_backgroundcolor',
            [
                'label' => esc_html__('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'position_for_btn',
            [
                'label' => __('Button Position', 'masterelements'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'multiple' => true,
                'default' => __('None', 'masterelements'),
                'options' => [
                    'none' => __('None', 'masterelements'),
                    'relative' => __('Relative', 'masterelements'),
                    'absolute' => __('Absolute', 'masterelements'),
                    'fixed' => __('Fixed', 'masterelements'),

                ],
                'selectors' => [
                    '{{WRAPPER}}  .me-submit-btn' => 'position: {{options}};',
                ],
                //'separator' => 'before',
            ]
        );

        //top slider control
        $this->add_control(
            'position_for_btn_top',
            [
                'label' => __('TOP', 'masterelements'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}  .me-submit-btn' => 'top: {{VALUE}}px;',
                ],
            ]
        );


        $this->add_control(
            'position_for_btn_right',
            [
                'label' => __('RIGHT', 'masterelements'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}  .me-submit-btn' => 'right: {{VALUE}}px;',
                ],
            ]
        );


        $this->add_control(
            'position_for_btn_left',
            [
                'label' => __('LEFT', 'masterelements'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}  .me-submit-btn' => 'left: {{VALUE}}px;',
                ],
            ]
        );


        $this->add_control(
            'position_for_btn_bottom',
            [
                'label' => __('BOTTOM', 'masterelements'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}  .me-submit-btn' => 'bottom: {{VALUE}}px;',
                ],
            ]
        );


        $this->end_controls_tab();

        //Button Hover Style
        $this->start_controls_tab(
            'button_hover',
            [
                'label' => esc_html__('Hover', 'masterelements'),
            ]
        );
        $this->add_control(
            'button_color_hover',
            [
                'label' => esc_html__('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        //color picker control for background color
        $this->add_control(
            'button_backgroundcolor_hover',
            [
                'label' => esc_html__('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        //border
        $this->add_control(
            'border_hover',
            [
                'label' => __('Border Color', 'elementor-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn:hover' => 'border-color: {{VALUE}};',
                ]
            ]
        );
        //border radius control
        $this->add_control(
            'border_radius_hover',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .me-button-outer .me-submit-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        //Button Hover Style End

        $this->end_controls_tab();
        //Button Style tab Close
        $this->end_controls_section();

    }


    //front end rendering
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        /* echo '<pre>settings: '.print_r($settings,true).'</pre><br>';
         exit();*/
        ?>
        <form method="post" action="" class="me-contact-form">
            <input type="hidden" name="form_id" value="<?php echo $this->get_id(); ?>"/>


            <?php
            foreach ($settings['input_list'] as $item) {

                $required = ($item['required'] ? ' required ' : '');
                $listinput = $item['add_input'];
                if ($listinput == 'text') {
                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-text">
                        <?= $this->checkLabel($item); ?>
                        <input name="<?= $item['input_name']; ?>" <?= $required; ?> style="width: 100%;"
                               class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>" type="text"
                               placeholder="<?= $item['input_placeholder'] ?>">
                    </div>

                <?php }
                if ($listinput == 'select') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-text">
                        <?= $this->checkLabel($item); ?>
                        <select name="<?= $item['input_name']; ?>" style="width: 100%;"
                                <?= $required; ?>class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>" <?= ($item['allow_multiple'] ? ' multiple' : ''); ?>>
                            <?php
                            $field_options = $item['field_options'];
                            $options = explode(PHP_EOL, $field_options);
                            foreach ($options as $option) {
                                $opt = explode('|', $option);
                                $arr_size = sizeof($opt);

                                for ($index = 0; $index < $arr_size; $index++) {
                                    echo '<option>' . $opt[$index] . '</option>';

                                }
                            }

                            ?>

                        </select>

                    </div>

                <?php }
                if ($listinput == 'email') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-<?= $listinput; ?>">
                        <?= $this->checkLabel($item); ?>
                        <input name="<?= $item['input_name']; ?>" style="width: 100%;"
                               <?= $required; ?>class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                               type="email"
                               placeholder="<?= $item['input_placeholder'] ?>">
                    </div>

                <?php }
                if ($listinput == 'tel') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-<?= $listinput; ?>">
                        <?= $this->checkLabel($item); ?>
                        <input name="<?= $item['input_name']; ?>" style="width: 100%;"
                               <?= $required; ?>class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                               type="tel"
                               placeholder="<?= $item['input_placeholder'] ?>">
                    </div>

                <?php }
                if ($listinput == 'textarea') { ?>

                    <div class="<?= $item['input_css_class'] ?> outer outer-textarea elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                        <?= $this->checkLabel($item); ?>
                        <textarea <?= $required; ?> style="width: 100%;"
                                                    class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                                                    placeholder="<?= $item['input_placeholder']; ?>"></textarea>
                    </div>
                    <?php
                }
                if ($listinput == 'checkbox') {
                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-checkbox">
                        <?= $this->checkLabel($item); ?>
                        <span>
                        <input name="<?= $item['input_name']; ?>" style="width: 100%;"
                               <?= $required; ?>class="elementor-repeater-files-<?php echo esc_attr($item['_id']); ?>"
                               value="click me"
                               type="checkbox" placeholder="<?= $item['input_placeholder'] ?>">
                            <?= $item['checkbox_text']; ?>
                        </span>
                    </div>

                    <?php
                }
                if ($listinput == 'color') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-color">
                        <?= $this->checkLabel($item); ?>
                        <input <?= $required; ?> name="<?= $item['input_name']; ?>" style="width: 100%;"
                                                 class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                                                 type="color">
                    </div>
                    <?php
                }
                if ($listinput == 'date') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-<?= $listinput; ?>">
                        <?= $this->checkLabel($item); ?>
                        <input <?= $required; ?> name="<?= $item['input_name']; ?>" style="width: 100%;"
                                                 class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                                                 type="date">
                    </div>
                    <?php
                }
                if ($listinput == 'file') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-<?= $listinput; ?>">
                        <?= $this->checkLabel($item); ?>
                        <input <?= $required; ?> name="<?= $item['input_name']; ?>" style="width: 100%;"
                                                 class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                                                 type="file">
                    </div>

                <?php }
                if ($listinput == 'hidden') {

                    ?>
                    <div class="<?= $item['input_css_class'] ?> outer outer-<?= $listinput; ?>">
                        <?= $this->checkLabel($item); ?>
                        <input <?= $required; ?> name="<?= $item['input_name']; ?>" style="width: 100%;"
                                                 class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>"
                                                 type="hidden">
                    </div>

                <?php }
                if ($listinput == 'number') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-<?= $listinput; ?>">
                        <?= $this->checkLabel($item); ?>
                        <input name="<?= $item['input_name']; ?>" style="width: 100%;"
                               class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                               type="number" <?= $required; ?>
                               placeholder="<?= $item['input_placeholder'] ?>">
                    </div>

                <?php }
                if ($listinput == 'password') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-<?= $listinput; ?>">
                        <?= $this->checkLabel($item); ?>
                        <input name="<?= $item['input_name']; ?>" style="width: 100%;"
                               class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                               type="password" <?= $required; ?>
                               placeholder="<?= $item['input_placeholder'] ?>">
                    </div>

                <?php }
                if ($listinput == 'radio') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-<?= $listinput; ?>">
                        <?= $this->checkLabel($item); ?>
                        <input name="<?= $item['input_name']; ?>" style="width: 100%;"
                               class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                               type="radio" <?= $required; ?>>
                    </div>

                <?php }
                if ($listinput == 'reset') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-<?= $listinput; ?>">
                        <?= $this->checkLabel($item); ?>
                        <input <?= $required; ?> name="<?= $item['input_name']; ?>" style="width: 100%;"
                                                 class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                                                 type="reset">
                    </div>

                <?php }
                if ($listinput == 'search') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-<?= $listinput; ?>">
                        <?= $this->checkLabel($item); ?>
                        <input <?= $required; ?> name="<?= $item['input_name']; ?>" style="width: 100%;"
                                                 class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                                                 type="search"
                                                 placeholder="<?= $item['input_placeholder'] ?>">
                    </div>

                <?php }
                if ($listinput == 'url') {

                    ?>
                    <div class="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?> <?= $item['input_css_class'] ?> outer outer-<?= $listinput; ?>">
                        <?= $this->checkLabel($item); ?>
                        <input <?= $required; ?> name="<?= $item['input_name']; ?>" style="width: 100%;"
                                                 class="elementor-repeater-field-<?php echo esc_attr($item['_id']); ?>"
                                                 type="url"
                                                 placeholder="<?= $item['input_placeholder'] ?>">
                    </div>

                <?php }
            }
            ?>
            <div class="me-button-outer"><input class="me-submit-btn me-<?= $settings['position_for_btn']; ?>"
                                                type="submit" value="<?= $settings['input_name'] ?>"></div>
        </form>
        <?php

    }

    public static function get_current_post_id()
    {
        if (isset(Plugin::elementor()->documents)) {
            return Plugin::elementor()->documents->get_current()->get_main_id();
        }

        return get_the_ID();
    }

    protected function _content_template()
    {
    }

    public function checkLabel($item)
    {
        if ($item['input_box_label'] == 'true') {
            echo '<label class="me-label">' . $item['input_box_text'] . '</label>';
        }
    }

    public function register_repeater_controls($repeater)
    {
        //which input you want to include select box control
        $repeater->add_control(
            'add_input',
            [
                'label' => __('Add field', 'masterelements'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'multiple' => false,
                'default' => __('Select field Type', 'masterelements'),
                'options' => [
                    'text' => __('Text', 'masterelements'),
                    'tel' => __('Telephone', 'masterelements'),
                    'email' => __('Email', 'masterelements'),
                    'textarea' => __('Textarea', 'masterelements'),
                    'select' => __('Select', 'masterelements'),
                    'checkbox' => __('Checkbox', 'masterelements'),
                    'file' => __('File', 'masterelements'),
                    'date' => __('Date', 'masterelements'),
                    'number' => __('Number', 'masterelements'),
                    'password' => __('Password', 'masterelements'),
                    'radio' => __('Radio', 'masterelements'),
                    'url' => __('URL', 'masterelements'),
                    'hidden' => __('Hidden', 'masterelements'),
                    'reset' => __('Reset Button', 'masterelements'),
                ],
                'separator' => 'before',
            ]
        );
        //input Name control
        $repeater->add_control(
            'checkbox_text',
            [

                'label' => __('Checkbox Text', 'masterelements'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('', 'masterelements'),
                'condition' => [
                    'add_input' => 'checkbox',
                ],
            ]
        );
        //input Name control
        $repeater->add_control(
            'input_name',
            [

                'label' => __('field Name (Without space)', 'masterelements'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('', 'masterelements'),
                'placeholder' => __('Enter Your field name', 'masterelements'),
            ]
        );
        //input placeholder control
        $repeater->add_control(
            'input_placeholder',
            [

                'label' => __('Placeholder ', 'masterelements'),
                'label_block' => true,
                'type' => \Elementor\Controls_Manager::TEXT,
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'add_input',
                            'operator' => '!==',
                            'value' => 'select',
                        ],
                    ],
                ],
                'default' => __('Placeholder', 'masterelements'),
                'placeholder' => __('Placeholder', 'masterelements'),
            ]
        );
        $repeater->add_control(
            'required',
            [
                'label' => __('Required', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => '',
            ]
        );

        $repeater->add_control(
            'field_options',
            [
                'label' => __('Options', 'masterelements'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'description' => __('Seperate each option with a pipe char ("|"). For example: First Name|Last Name|Phone', 'elementor-pro'),
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'add_input',
                            'value' => 'select',
                        ],
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'allow_multiple',
            [
                'label' => __('Multiple Selection', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'add_input',
                            'value' => 'select',
                        ],
                    ],
                ],
            ]
        );
        //input select box control for inline styling
        $repeater->add_control(
            'display',
            [
                'label' => __('Display', 'masterelements'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'multiple' => true,
                'default' => 'inline-block',
                'options' => [
                    'inline-flex' => __('Inline flex', 'masterelements'),
                    'inline-block' => __('Inline Block', 'masterelements'),
                    'inline' => __('Inline', 'masterelements'),

                ],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}},{{WRAPPER}} {{CURRENT_ITEM}}' => 'display: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'input_box_label',
            [
                'label' => __('Input Box Label', 'masterelements'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => '',
            ]
        );

        $repeater->add_control(
            'input_box_text',
            [
                'label' => __('Text', 'masterelements'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'condition' => [
                    'input_box_label' => 'true',
                ],
            ]
        );

        $repeater->add_control(
            'input_box_algin',
            [
                'label' => __('Align', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'center' => __('Center', 'masterelements'),
                    'flex' => __('Left', 'masterelements'),

                ],
                'separator' => 'before',
                'condition' => [
                    'input_box_label' => 'true',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}},{{WRAPPER}} {{CURRENT_ITEM}}' => 'display: {{VALUE}};align-items: center;',
                ],
            ]
        );

        //Label slider control
        $repeater->add_responsive_control(
            'label_width',
            [
                'label' => __('Label Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'devices' => ['desktop'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'condition' => [
                    'input_box_algin' => 'flex',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} label' => 'flex-basis: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //input slider control
        $repeater->add_responsive_control(
            'input_width',
            [
                'label' => __('Input Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'devices' => ['desktop'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'condition' => [
                    'input_box_algin' => 'flex',
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} input' => 'flex-basis: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //width slider control
        $repeater->add_responsive_control(
            'width',
            [
                'label' => __('Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'devices' => ['desktop'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //width Mobile slider control
        $repeater->add_responsive_control(
            'width_table',
            [
                'label' => __('Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'devices' => ['tablet', 'mobile'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
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
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //height slider control
        $repeater->add_responsive_control(
            'height',
            [
                'label' => __('Height', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'devices' => ['desktop'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} input,{{WRAPPER}} {{CURRENT_ITEM}} textarea,{{WRAPPER}} {{CURRENT_ITEM}} select' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        //height Mobile slider control
        $repeater->add_responsive_control(
            'height_table',
            [
                'label' => __('Height', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'devices' => ['tablet', 'mobile'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
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
                    '{{WRAPPER}} {{CURRENT_ITEM}} input,{{WRAPPER}} {{CURRENT_ITEM}} textarea,{{WRAPPER}} {{CURRENT_ITEM}} select' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //margin control for input
        $repeater->add_responsive_control(
            'margin',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'], 'devices' => ['desktop'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //margin control for input
        $repeater->add_responsive_control(
            'margin_tablet',
            [
                'label' => __('Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'], 'devices' => ['tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //padding control for input
        $repeater->add_control(
            'padding',
            [
                'label' => __('Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} input,{{WRAPPER}} {{CURRENT_ITEM}} textarea,{{WRAPPER}} {{CURRENT_ITEM}} select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //border
        $repeater->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __('Border', 'masterelements'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} input,{{WRAPPER}} {{CURRENT_ITEM}} textarea,{{WRAPPER}} {{CURRENT_ITEM}} select',
            ]
        );
        //border radius control
        $repeater->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} input,{{WRAPPER}} {{CURRENT_ITEM}} textarea,{{WRAPPER}} {{CURRENT_ITEM}} select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $repeater->start_controls_tabs(
            'intput_tabs'
        );
        $repeater->start_controls_tab(
            'input_normal',
            [
                'label' => esc_html__('Normal', 'masterelements'),
            ]
        );
        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'label' => __('Label Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'devices' => ['desktop'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} label',
            ]
        );

        //padding control for input
        $repeater->add_control(
            'label_margin',
            [
                'label' => __('Label Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        //color picker control for input text color
        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'label' => __('Input Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'devices' => ['desktop'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} input,{{WRAPPER}} {{CURRENT_ITEM}} textarea,{{WRAPPER}} {{CURRENT_ITEM}} select',
            ]
        );
        //color picker control for input text color
        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography_tablet',
                'label' => __('Input Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'devices' => ['tablet', 'mobile'],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} input,{{WRAPPER}} {{CURRENT_ITEM}} textarea,{{WRAPPER}} {{CURRENT_ITEM}} select',
            ]
        );
        //placeholder typography control for input
        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'placeholder_typography',
                'label' => __('Placeholder Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'add_input',
                            'operator' => '!==',
                            'value' => 'select',
                        ],
                    ],
                ],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} input::-webkit-input-placeholder,{{WRAPPER}} {{CURRENT_ITEM}} textarea::-webkit-input-placeholder',
            ]
        );
        //text shadow control
        $repeater->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'label' => __('Text Shadow', 'masterelements'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} input,{{WRAPPER}} {{CURRENT_ITEM}} textarea,{{WRAPPER}} {{CURRENT_ITEM}} select',
            ]
        );
        //box shadow control
        $repeater->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => __('Box Shadow', 'masterelements'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} input,{{WRAPPER}} {{CURRENT_ITEM}} textarea,{{WRAPPER}} {{CURRENT_ITEM}} select',
            ]
        );
        //color picker control for input text color
        $repeater->add_responsive_control(
            'input_text_color',
            [
                'label' => esc_html__('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} input,{{WRAPPER}} {{CURRENT_ITEM}} textarea,{{WRAPPER}} {{CURRENT_ITEM}} select' => 'color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'label_text_color',
            [
                'label' => esc_html__('Label Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} label' => 'color: {{VALUE}};',
                ],
            ]
        );
        //color picker control for background color
        $repeater->add_responsive_control(
            'input_text_backgroundcolor',
            [
                'label' => esc_html__('Background Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} input,{{WRAPPER}} {{CURRENT_ITEM}} textarea,{{WRAPPER}} {{CURRENT_ITEM}} select' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        //color picker control for placeholder color
        $repeater->add_responsive_control(
            'input_text_placeholder',
            [
                'label' => esc_html__('Placeholder Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#6115d0',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'add_input',
                            'operator' => '!==',
                            'value' => 'select',
                        ],
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} input::-webkit-input-placeholder,{{WRAPPER}} {{CURRENT_ITEM}} textarea::-webkit-input-placeholder ' => 'color: {{VALUE}};',
                ],
            ]
        );
        //your css class control
        $repeater->add_control(
            'input_css_class',
            [
                'label' => esc_html__('Custom Class', 'masterelements'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Your css class', 'masterelements'),

            ]
        );
        $repeater->end_controls_tab();
    }

}

