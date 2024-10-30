<?php
namespace Elementor;

defined( 'ABSPATH' ) || die();

class Master_me_Effects extends Widget_Base {
    public $base;
    
    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_enqueue_script('effects-js', \MasterElements::widgets_url() . '/master-effects/assets/js/effects.js', false, \masterelements::version);
        wp_enqueue_script('anime-js', \MasterElements::widgets_url() . '/master-effects/assets/js/anime/lib/anime.min.js', false, \masterelements::version);
        add_action( 'elementor/element/common/_section_style/after_section_end', [ __CLASS__, 'add_controls_section' ], 1 );
   
    }

    public function get_name() {
		return 'master-effects';
	}

    public static function add_controls_section( Element_Base $section ) {
        $section->start_controls_section(
            'me_master_effects',
            [
                'label' => __( 'Float Effects', 'masterelements' ),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );
    
        $section->add_control(
            'me_floating_effects',
            [
                'label' => __( 'Floating Effects', 'masterelements' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'frontend_available' => true,
            ]
        );

        $section->add_control(
            'me_floating_effects_translate_toggle',
            [
                'label' => __( 'Translate', 'masterelements' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'frontend_available' => true,
                'condition' => [
                    'me_floating_effects' => 'yes',
                ]
            ]
        );

        $section->start_popover();

        $section->add_control(
            'me_floating_effects_translate_x',
            [
                'label' => __( 'Translate X', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 0,
                        'to' => 5,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ]
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'scales' => 1,
                'handles' => 'range',
                'condition' => [
                    'me_floating_effects_translate_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
                'labels' => [
                    __( 'From', 'masterelements' ),
                    __( 'To', 'masterelements' ),
                ],
            ]
        );

        $section->add_control(
            'me_floating_effects_translate_y',
            [
                'label' => __( 'Translate Y', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 0,
                        'to' => 5,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ]
                ],                
                'render_type' => 'none',
                'frontend_available' => true,
                'scales' => 1,
                'handles' => 'range',
                'condition' => [
                    'me_floating_effects_translate_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
                'labels' => [
                    __( 'From', 'masterelements' ),
                    __( 'To', 'masterelements' ),
                ],
            ]
        );

        $section->add_control(
            'me_floating_effects_translate_duration',
            [
                'label' => __( 'Duration', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 50
                    ]
                ],
                'default' => [
                    'size' => 800,
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    'me_floating_effects_translate_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
            ]
        );

        $section->add_control(
            'me_floating_effects_translate_delay',
            [
                'label' => __( 'Delay', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 50
                    ]
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    'me_floating_effects_translate_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
            ]
        );

        $section->end_popover();

        $section->add_control(
            'me_floating_effects_rotate_toggle',
            [
                'label' => __( 'Rotate', 'masterelements' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'frontend_available' => true,
                'condition' => [
                    'me_floating_effects' => 'yes',
                ]
            ]
        );

        $section->start_popover();

        $section->add_control(
            'me_floating_effects_rotate_x',
            [
                'label' => __( 'Rotate X', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 0,
                        'to' => 80,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'scales' => 1,
                'handles' => 'range',
                'condition' => [
                    'me_floating_effects_rotate_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
                'labels' => [
                    __( 'From', 'masterelements' ),
                    __( 'To', 'masterelements' ),
                ],
                
            ]
        );

        $section->add_control(
            'me_floating_effects_rotate_y',
            [
                'label' => __( 'Rotate Y', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 0,
                        'to' => 80,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'scales' => 1,
                'handles' => 'range',
                'condition' => [
                    'me_floating_effects_rotate_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
                'labels' => [
                    __( 'From', 'masterelements' ),
                    __( 'To', 'masterelements' ),
                ],
                
            ]
        );

        $section->add_control(
            'me_floating_effects_rotate_z',
            [
                'label' => __( 'Rotate Z', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 0,
                        'to' => 80,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => -180,
                        'max' => 180,
                    ]
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'scales' => 1,
                'handles' => 'range',
                'labels' => [
                    __( 'From', 'masterelements' ),
                    __( 'To', 'masterelements' ),
                ],
                'condition' => [
                    'me_floating_effects_rotate_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
                
            ]
        );

        $section->add_control(
            'me_floating_effects_rotate_duration',
            [
                'label' => __( 'Duration', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 50
                    ]
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'default' => [
                    'size' => 800,
                ],
                'condition' => [
                    'me_floating_effects_rotate_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
                
            ]
        );

        $section->add_control(
            'me_floating_effects_rotate_delay',
            [
                'label' => __( 'Delay', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 100
                    ]
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    'me_floating_effects_rotate_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ], 
            ]
        );

        $section->end_popover();

        $section->add_control(
            'me_floating_effects_scale_toggle',
            [
                'label' => __( 'Scale', 'masterelements' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'frontend_available' => true,
                'condition' => [
                    'me_floating_effects' => 'yes',
                ]
            ]
        );

        $section->start_popover();

        $section->add_control(
            'me_floating_effects_scale_x',
            [
                'label' => __( 'Scale X', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 1,
                        'to' => 1.2,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => .1
                    ]
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'scales' => 1,
                'handles' => 'range',
                'labels' => [
                    __( 'From', 'masterelements' ),
                    __( 'To', 'masterelements' ),
                ],
                'condition' => [
                    'me_floating_effects_scale_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
            ]
        );

        $section->add_control(
            'me_floating_effects_scale_y',
            [
                'label' => __( 'Scale Y', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'sizes' => [
                        'from' => 1,
                        'to' => 1.2,
                    ],
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => .1
                    ]
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'scales' => 1,
                'handles' => 'range',
                'labels' => [
                    __( 'From', 'masterelements' ),
                    __( 'To', 'masterelements' ),
                ],
                'condition' => [
                    'me_floating_effects_scale_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
            ]
        );

        $section->add_control(
            'me_floating_effects_scale_duration',
            [
                'label' => __( 'Duration', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 10000,
                        'step' => 100
                    ]
                ],
                'default' => [
                    'size' => 1000,
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    'me_floating_effects_scale_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
                
            ]
        );

        $section->add_control(
            'me_floating_effects_scale_delay',
            [
                'label' => __( 'Delay', 'masterelements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5000,
                        'step' => 100
                    ]
                ],
                'render_type' => 'none',
                'frontend_available' => true,
                'condition' => [
                    'me_floating_effects_scale_toggle' => 'yes',
                    'me_floating_effects' => 'yes',
                ],
                
            ]
        );

        $section->end_popover();

        $section->add_control(
            'section_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $section->end_controls_section();
    }
}
