<?php

namespace Elementor;
use \Elementor\Controls_Manager;


if (!defined('ABSPATH')) exit;
class Master_Info_Box extends Widget_Base
{
    public $base;


    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);


        wp_register_style('infobox-css', \MasterElements::widgets_url() . '/info-box/assets/infobox.css', false, \MasterElements::version);


    }


    public function get_style_depends()
    {

        return ['custom-css'];
    }

    public function get_name()
    {
        /////////////////////////////////////
        //get name of file
        /////////////////////////////////////
        return 'info-box';
    }

    public function get_title()
    {
        /////////////////////////////////////
        //get title from file
        /////////////////////////////////////
        return esc_html__('Master Info Box', 'masterelements');
    }

    public function get_icon()
    {
        /////////////////////////////////////
        //get icon
        /////////////////////////////////////
        return 'info-box';
    }

    public function get_categories()
    {
        //////////////////////////////////////////////////////////////////////////
        //get category where widget will be added in elementor front end
        //////////////////////////////////////////////////////////////////////////
        return ['master-addons'];
    }
//////////////////////////////////////////////////////////////////////////
// elementor default function to register your controls
//////////////////////////////////////////////////////////////////////////
    protected function _register_controls()
    {
        /////////////////////////////////////
//  Content Section Start
/////////////////////////////////////
        $this->start_controls_section(
        ////////////////////////////////////////////////////////////////////////////////////////////
        //section which is shown after you drage your widget in the fornt-end area
        ////////////////////////////////////////////////////////////////////////////////////////////

            'section_content',
            [
                'label' => __('Master Info Box', 'additional-addons'),//......
            ]
        );
//////////////////////////////////////////////////////////
// add Image//////////////////////////////////////////////
/////////////////////////////////////////////////////////
        $this->add_control(
            'image',
            [
                'label' => __('Choose Image', 'masterelements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],

            ]
        );


        $this->add_control(
            'custom_dimension',
            [
                'label' => __('Image Dimension', 'masterelements'),
                'type' => Controls_Manager::IMAGE_DIMENSIONS,
                'description' => __('Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'masterelements'),
                'default' => [
                    'width' => '',
                    'height' => '',
                ],
                'selector' => '.custom-class3',
            ]
        );

        $this->add_control(
            'text_align2',
            [
                'label' => __('Image Alignment', 'masterelements'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                'default' => 'center',
                'toggle' => true,
                'selector' => '.custom-class3',
            ]

        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __('Background', 'masterelements'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .custom-class3',
            ]
        );


        $this->add_control(
            'image_opacity',
            [
                'label' => __('Opacity', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '.custom-class3:hover' => 'opacity: {{SIZE}};',
                ],
            ]
        );
////////////////////////////////////////////////////////////////////////////////////////////
// ////////////    Adding text editor //////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

        $this->add_control(
            'item_description',
            [
                'label' => __('Description', 'masterelements'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __('Default description', 'masterelements'),
                'placeholder' => __('Type your description here', 'masterelements'),
                'selector' => '{{WRAPPER}} .para-typo',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'para_content_typography',
                'label' => __('Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .para-typo',
            ]
        );
////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////
// Adding Heading Controls.
//////////////////////////////////////////////
        $this->add_control(
            'heading',
            [
                'label' => __('Custom Heading', 'masterelements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h1',
                'options' => [
                    'h1' => __('H1', 'masterelements'),
                    'h2' => __('H2', 'masterelements'),
                    'h3' => __('H3', 'masterelements'),
                    'h4' => __('H4', 'masterelements'),
                    'h5' => __('H5', 'masterelements'),
                    'h6' => __('H6', 'masterelements'),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_content_typography',
                'label' => __('Heading Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .custom-class',
            ]
        );
        $this->add_control(
            'text_align',
            [
                'label' => __('Heading Alignment', 'masterelements'),
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
                'default' => 'center',
                'toggle' => true,
                'selector' => '.custom-class',
            ]

        );
        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => __('Heading Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .custom-class' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'heading_margin',
            [
                'label' => __('Heading Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .custom-class' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

//////////////////////////////////////////////
// adding text area and button controls
//////////////////////////////////////////////

        $this->add_control(
            'Text_Area',
            [
                'label' => __('Content ', 'additional-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('hello world!', 'additional-addons'),

            ]
        );

        $this->add_control(
            'colors',
            [
                'label' => __('Color', 'masterelements'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '.custom-class' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __('Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '.custom-class',
            ]
        );


        $this->add_control(
            'show_button',
            [
                'label' => __('Show button', 'masterelements'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'masterelements'),
                'label_off' => __('Hide', 'masterelements'),
                'return_value' => 'yes',
                'default' => 'no',

            ]
        );


        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Button Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .overlay-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_button' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __('Border', 'masterelements'),
                'selector' => '.overlay-btn',
                'condition' => [
                    'show_button' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'border_radius',
            [
                'label' => esc_html__('Border Radius', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .overlay-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_button' => 'yes'
                ],

            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Button Color', 'masterelements'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .overlay-btn' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_button' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_content_typography',
                'label' => __('Typography', 'masterelements'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '.btn-class .overlay-btn',
                'condition' => [
                    'show_button' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button-background-color',
                'label' => __('Background', 'masterelements'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .overlay-btn',
                'condition' => [
                    'show_button' => 'yes'
                ],
            ]
        );


        $this->end_controls_section();
    }
//function to show how front end will look like after you change settings in price widget
//front end live preview.
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>


        <div class="custom-class3" style="text-align:<?= $settings["text_align2"] ?>"><img
                style="width:<?= $settings['custom_dimension']['width'] ?>px;height:<?= $settings['custom_dimension']['height'] ?>px;"
                src="<?php echo $settings['image']['url'] ?>">

            <div class='btn-class'>
                <div class="inner-div">
                    <?php
                    if ("yes" === $settings['show_button']) {
                        ?>
                        <div class="para-typo"> <?php echo $settings['item_description']; ?></div>
                        <?php echo "<input type='button' class='overlay-btn' value='Donate'>"; ?>

                    <?php }


                    ?>
                </div>
            </div>
        </div>
        <<?php echo $settings['heading'] ?> class="custom-class" style="color:<?= $settings['colors'] ?>;text-align:<?= $settings['text_align'] ?>">  <?php echo $settings['Text_Area'] . '<br>' ?>  </<?php echo $settings['heading'] ?>>
        <?php
    }
}
?>
