<?php

namespace Elementor;
use \Elementor\Controls_Manager;


if (!defined('ABSPATH')) exit;
class Master_Heading extends Widget_Base {
public $base;
public function get_name()
{
    ///////////////////////////////////
    //Returns the name
    ///////////////////////////////////
    return 'mater-heading';
}
public function get_title()
{
    ///////////////////////////////////
    ///Returns Title to be Rendered on Frontend
    ///////////////////////////////////
    return esc_html__('Master Heading', 'masterelements');
}
public function get_icon()
{
    ///////////////////////////////////
    //Returns Icon
    ///////////////////////////////////
    return 'heading';
}
public function get_categories()
{
    ////////////////////////////////////////////////////////////////
    //get category where widget will be added in elementor front end
    ////////////////////////////////////////////////////////////////
    return ['master-addons'];
}
///////////////////////////////////////////////////////
// elementor default function to register your controls
///////////////////////////////////////////////////////
protected function _register_controls()
{
//////////////////////////////////////////////////////////////////////
    //  Content Section Start
//////////////////////////////////////////////////////////////////////
    $this->start_controls_section(
    //////////////////////////////////////////////////////////////////////
    //section which is shown after you drage your widget in the fornt-end area
    //////////////////////////////////////////////////////////////////////
        'section_content',
        [
            'label' => __('Master Heading', 'additional-addons'),//......
        ]
    );
///////////////////////////////////
// Heading Control Added 
///////////////////////////////////
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
///////////////////////////////////
// Adding TextArea and Image Controls
///////////////////////////////////
    $this->add_control(
        'Text_Area',
        [
            'label' => __('Content ', 'additional-addons'),
            'type' => Controls_Manager::TEXT,
            'rows' => 10,
            'default' => __('hello world!', 'additional-addons'),

        ]
    );

    $this->add_control(
        'color',
        [
            'label' => __('Color', 'masterelements'),
            'type' => Controls_Manager::COLOR,
            'scheme' => [
                'type' => Scheme_Color::get_type(),
                'value' => Scheme_Color::COLOR_1,
            ],
            'selectors' => [
                '.custom-class' => 'color: {{VALUE}}',
                '.custom-class1' => 'color: {{VALUE}}',
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
        'item_description',
        [
            'label' => __('Description', 'masterelements'),
            'type' => Controls_Manager::WYSIWYG,
            'rows' => 15,
            'default' => __('Default description', 'masterelements'),
            'placeholder' => __('Type your description here', 'masterelements'),
            'selector' => '.custom-class1',
        ]
    );
    $this->add_control(
        'text_align1',
        [
            'label' => __('Description Alignment', 'masterelements'),
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
            'selector' => '.custom-class1',
        ]

    );
    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'content1_typography',
            'label' => __('Description Typography', 'masterelements'),
            'scheme' => Scheme_Typography::TYPOGRAPHY_1,
            'selector' => '.custom-class1',
        ]
    );
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
            'selector' => '.custom-class2',
        ]
    );

    $this->add_control(
        'text_align2',
        [
            'label' => __('Description Alignment', 'masterelements'),
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
            'selector' => '.custom-class2',
        ]

    );

    $this->end_controls_section();
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////
//function to show how front end will look like after you change settings in price widget
//front end live preview.
/////////////////////////////////////////////////////////////////////////////////////////////////////////
protected function render() {
$settings = $this->get_settings_for_display();
?>

<<?php echo $settings['heading'] ?> class="custom-class" style="color:<?= $settings['color'] ?>;text-align:<?= $settings['text_align'] ?>">  <?php echo $settings['Text_Area'] . '<br>' ?>  </<?php echo $settings['heading'] ?>>
<div class="custom-class1"
     style="color:<?= $settings['color'] ?>;text-align:<?= $settings['text_align1'] ?>"> <?php echo $settings['item_description'] ?> </div>
<div class="custom-class2" style="text-align:<?= $settings["text_align2"] ?>"><img
        style="width:<?= $settings['custom_dimension']['width'] ?>px;height:<?= $settings['custom_dimension']['height'] ?>px;"
        src=" <?php echo $settings['image']['url'] . '">'; ?></div>
    
        <?php
        }
        }
        ?>
