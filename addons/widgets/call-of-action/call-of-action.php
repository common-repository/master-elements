<?php

namespace Elementor;
use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Master_call_Of_Action extends Widget_Base {

	public $base;

    public function get_name() {

		return 'callofaction';

    }

    public function get_title() {

		return esc_html__( 'Master Call Of Action', 'masterelements' );

    }

    public function get_icon() {

        return 'call-of-action';

    }

    public function get_categories() {

		return [ 'addons' ];

    }

    protected function _register_controls() {


        $this->start_controls_section(

			'content_section',

			[

				'label' => __( 'Single Post Call Of Action', 'masterelements' ),

				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,

			]

        );

		$this->add_control(

			'title_Master',

			[

				'label' => __( 'Title', 'masterelements' ),

				'type' => \Elementor\Controls_Manager::TEXT,

				'default' => __( 'Default title', 'masterelements' ),

				'placeholder' => __( 'Type your title here', 'masterelements' ),

			]

		);

		$this->add_control(

			'btn_txt',

			[

				'label' => __( 'Button Text', 'masterelements' ),

				'type' => \Elementor\Controls_Manager::TEXT,

				'default' => __( 'Click Me!', 'masterelements' ),

				'placeholder' => __( 'Type your Text here', 'masterelements' ),

			]

		);

		$this->add_control(

			'html_tags',

			[

				'label' => __( 'Html Tags', 'masterelements' ),

				'type' => \Elementor\Controls_Manager::SELECT,

				'default' => 'h1',

				'options' => [

					'h1'  => __( 'H1', 'masterelements' ),

					'h2' => __( 'H2', 'masterelements' ),

					'h3' => __( 'H3', 'masterelements' ),

					'h4' => __( 'H4', 'masterelements' ),

                    'h5' => __( 'H5', 'masterelements' ),

                    'h6' => __( 'H6', 'masterelements' ),

				],

			]

		);

		$this->add_control(

			'content_Master',

			[

				'label' => __( 'Content', 'masterelements' ),

				'type' => Controls_Manager::WYSIWYG,

				'default' => __( 'Content', 'masterelements' ),

			]

		);

        $this->add_control(

			'title_align',

			[

				'label' => __( 'Alignment', 'masterelements' ),

				'type' => Controls_Manager::CHOOSE,

				'options' => [

					'left' => [

						'title' => __( 'Left', 'masterelements' ),

						'icon' => 'fa fa-align-left',

					],

					'center' => [

						'title' => __( 'Center', 'masterelements' ),

						'icon' => 'fa fa-align-center',

					],

					'right' => [

						'title' => __( 'Right', 'masterelements' ),

						'icon' => 'fa fa-align-right',

					],

				],

				'default' => 'left',

				'selectors' => [

					'{{WRAPPER}} .outer-Master' => 'text-align: {{VALUE}};',

				],

				'separator' => 'before',

			]

		);

        $this->end_controls_section();

        $this->start_controls_section(

			'style_section',

			[

				'label' => __( 'Style', 'masterelements' ),

				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,

			]

        );

        $this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'title_typography',

				'label' => __( 'Title Typography', 'masterelements' ),

				'scheme' => Scheme_Typography::TYPOGRAPHY_1,

				'selector' => '{{WRAPPER}} .title a',

			]

        );

         //Heading 1 Text Color Change

         $this->add_control(

        	'title_color',

        	[

        		'label' => __( 'Title Color Text', 'masterelements' ),

        		'type' => Controls_Manager::COLOR,

        		'scheme' => [

        			'type' => \Elementor\Scheme_Color::get_type(),

        			'value' => \Elementor\Scheme_Color::COLOR_3,

        		],

        		'default' =>  \Elementor\Scheme_Color::COLOR_3,

        		'selectors' => [

        			'{{WRAPPER}} .title a' => 'color: {{VALUE}}',

        		],

        	]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'content_typography',

				'label' => __( 'Content Typography', 'masterelements' ),

				'scheme' => Scheme_Typography::TYPOGRAPHY_1,

				'selector' => '{{WRAPPER}} .content-Master ',

			]

        );

         //Heading 1 Text Color Change

         $this->add_control(

        	'content_color',

        	[

        		'label' => __( 'Content Color Text', 'masterelements' ),

        		'type' => Controls_Manager::COLOR,

        		'scheme' => [

        			'type' => \Elementor\Scheme_Color::get_type(),

        			'value' => \Elementor\Scheme_Color::COLOR_3,

        		],

        		'default' =>  \Elementor\Scheme_Color::COLOR_3,

        		'selectors' => [

        			'{{WRAPPER}} .content-Master' => 'color: {{VALUE}}',

        		],

        	]

		);

		//Heading 1 Text Color Change

		$this->add_control(

        	'text_field_color',

        	[

        		'label' => __( 'Text Field Color Text', 'masterelements' ),

        		'type' => Controls_Manager::COLOR,

        		'scheme' => [

        			'type' => \Elementor\Scheme_Color::get_type(),

        			'value' => \Elementor\Scheme_Color::COLOR_3,

        		],

        		'default' =>  \Elementor\Scheme_Color::COLOR_3,

        		'selectors' => [

        			'{{WRAPPER}} .email-Master' => 'color: {{VALUE}}',

        		],

        	]

		);

		$this->add_control(

        	'text_field_placeholder_color',

        	[

        		'label' => __( 'Text Field PlaceHolder Color Text', 'masterelements' ),

        		'type' => Controls_Manager::COLOR,

        		'scheme' => [

        			'type' => \Elementor\Scheme_Color::get_type(),

        			'value' => \Elementor\Scheme_Color::COLOR_3,

        		],

        		'default' =>  \Elementor\Scheme_Color::COLOR_3,

        		'selectors' => [

        			'{{WRAPPER}} .email-Master::-webkit-input-placeholder' => 'color: {{VALUE}}',

        		],

        	]

		);

		$this->add_control(

        	'text_background_color',

        	[

        		'label' => __( 'Text Box Background Color', 'masterelements' ),

        		'type' => Controls_Manager::COLOR,

        		'scheme' => [

        			'type' => \Elementor\Scheme_Color::get_type(),

        			'value' => \Elementor\Scheme_Color::COLOR_3,

        		],

        		'default' =>  \Elementor\Scheme_Color::COLOR_3,

        		'selectors' => [

        			'{{WRAPPER}} .email-Master' => 'background-color: {{VALUE}}',

        		],

        	]

		);

		$this->add_control(

        	'button_color',

        	[

        		'label' => __( 'Button Color', 'masterelements' ),

        		'type' => Controls_Manager::COLOR,

        		'scheme' => [

        			'type' => \Elementor\Scheme_Color::get_type(),

        			'value' => \Elementor\Scheme_Color::COLOR_3,

        		],

        		'default' =>  \Elementor\Scheme_Color::COLOR_3,

        		'selectors' => [

        			'{{WRAPPER}} .button-Master' => 'background-color: {{VALUE}}',

        		],

        	]

		);

		$this->add_control(

        	'button_hover_color',

        	[

        		'label' => __( 'Button Hover Color', 'masterelements' ),

        		'type' => Controls_Manager::COLOR,

        		'scheme' => [

        			'type' => \Elementor\Scheme_Color::get_type(),

        			'value' => \Elementor\Scheme_Color::COLOR_3,

        		],

        		'default' =>  \Elementor\Scheme_Color::COLOR_3,

        		'selectors' => [

        			'{{WRAPPER}} .button-Master:hover' => 'background-color: {{VALUE}}',

        		],

        	]

		);

		$this->add_control(

        	'button_text_color',

        	[

        		'label' => __( 'Button Text Color', 'masterelements' ),

        		'type' => Controls_Manager::COLOR,

        		'scheme' => [

        			'type' => \Elementor\Scheme_Color::get_type(),

        			'value' => \Elementor\Scheme_Color::COLOR_3,

        		],

        		'default' =>  \Elementor\Scheme_Color::COLOR_3,

        		'selectors' => [

        			'{{WRAPPER}} .button-Master' => 'color: {{VALUE}}',

        		],

        	]

		);

		$this->add_control(

        	'button_text_hover_color',

        	[

        		'label' => __( 'Button Text Hover Color', 'masterelements' ),

        		'type' => Controls_Manager::COLOR,

        		'scheme' => [

        			'type' => \Elementor\Scheme_Color::get_type(),

        			'value' => \Elementor\Scheme_Color::COLOR_3,

        		],

        		'default' =>  \Elementor\Scheme_Color::COLOR_3,

        		'selectors' => [

        			'{{WRAPPER}} .button-Master:hover' => 'color: {{VALUE}}',

        		],

        	]

		);

		$this->add_group_control(

			Group_Control_Typography::get_type(),

			[

				'name' => 'button_typography',

				'label' => __( 'Button Typography', 'masterelements' ),

				'scheme' => Scheme_Typography::TYPOGRAPHY_1,

				'selector' => '{{WRAPPER}} .button-Master',

			]

		);

		$this->add_group_control(

        Group_Control_Border::get_type(),

        	[

        		'name' => 'border',

        		'label' => __( 'Button Border', 'masterelements' ),

        		'selector' => '{{WRAPPER}} .button-Master',

        	]

        );

		$this->add_responsive_control(

			'button_padding',

			[

				'label' => __( 'Button Paddiing', 'plugin-name' ),

				'type' => \Elementor\Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', 'em', '%' ],

				'selectors' => [

					'{{WRAPPER}} .button-Master' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		); 

		$this->add_responsive_control(

			'button_margin',

			[

				'label' => __( 'Button Margin', 'plugin-name' ),

				'type' => \Elementor\Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', 'em', '%' ],

				'selectors' => [

					'{{WRAPPER}} .button-Master' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

		$this->add_responsive_control(

			'border_radius',

			[

				'label' => __( 'Button Border Radius', 'plugin-name' ),

				'type' => \Elementor\Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', 'em', '%' ],

				'selectors' => [

					'{{WRAPPER}} .button-Master' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

		$this->add_responsive_control(

			'text_border_radius',

			[

				'label' => __( 'Text Box Border Radius', 'plugin-name' ),

				'type' => \Elementor\Controls_Manager::DIMENSIONS,

				'size_units' => [ 'px', 'em', '%' ],

				'selectors' => [

					'{{WRAPPER}} .email-Master' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],

			]

		);

        $this->end_controls_section();

    }

    protected function render() {

		$settings = $this->get_settings_for_display();

	   ?>

	   <div class="outer-Master">

		<div class="title">

		<<?=$settings['html_tags']?>><a><?=$settings['title_Master']?></a></<?=$settings['html_tags']?>>

		</div>

		<div class="content-Master">

		<?=$settings['content_Master']?>

		</div>

		<input class="email-Master" type="text" name="email" placeholder="Email">

		<input class="button-Master" type="button" value="<?=$settings['btn_txt']?>" style="width:100%">

		</div>

<?php 

}

}