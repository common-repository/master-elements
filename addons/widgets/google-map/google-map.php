<?php

namespace Elementor;

if (!defined('ABSPATH')) exit;

class Master_Google_Map extends Widget_Base
{

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
    }

    /**
     * Get widget name.
     *
     * Retrieve google maps widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'google-maps';
    }

    /**
     * Get widget title.
     *
     * Retrieve google maps widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Master Google Maps', 'elementor');
    }

    /**
     * Get widget icon.
     *
     * Retrieve google maps widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-google-maps';
    }

    /**
     * Register google maps widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_map',
            [
                'label' => __('Map', 'masterelements'),
            ]
        );

        $this->add_control(
            'map_lat',
            [
                'label' => __('Latitude', 'masterelements'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => '1.2833754',
                'default' => '1.2833754',
                'dynamic' => ['active' => true]
            ]
        );

        $this->add_control(
            'map_lng',
            [
                'label' => __('Longitude', 'masterelements'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => '103.86072639999998',
                'default' => '103.86072639999998',
                'separator' => true,
                'dynamic' => ['active' => true]
            ]
        );

        $this->add_control(
            'zoom',
            [
                'label' => __('Zoom Level', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 25,
                    ],
                ],
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => __('Width', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'size' => 300,
                ],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 40,
                        'max' => 1440,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-map' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => __('Height', 'masterelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default' => [
                    'size' => 300,
                ],
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 40,
                        'max' => 1440,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .me-map' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render google maps widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings();

        ?>

        <div class="map-responsive me-map">
            <iframe
                    src="https://maps.google.com/maps?q=<?php echo $settings['map_lat']; ?>,<?php echo $settings['map_lng']; ?>&hl=es;z=14&amp;output=embed"
                    style="border:0;width: <?php echo $settings['width']['size'] . $settings['width']['unit']; ?>;height: <?php echo $settings['height']['size'] . $settings['height']['unit']; ?>;"
                    allowfullscreen></iframe>
        </div>

        <?php
    }
}


