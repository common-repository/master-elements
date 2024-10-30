<?php

namespace Elementor;
use \Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) exit;
class Master_Plan_Price extends Widget_Base {
	public $base;

	
    public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);


        wp_register_style( 'price-css',  \MasterElements::widgets_url() . '/plan-price/assets/price.css', false, \MasterElements::version );

     }


	  public function get_style_depends() {
		 
		 return [ 'price-css' ];
	  }

    public function get_name() {
		//get name from price-handler file
        return 'price';
    }
    public function get_title() {
		//get title from price-handler file
		return esc_html__( 'Master Price', 'masterelements' );
    }
    public function get_icon() {
		//get icon from price-handler file
        return 'price';
    }
    public function get_categories() {
		//get category where widget will be added in elementor front end
		return [ 'master-addons' ];
	}
	// elementor default function to register your controls
	protected function _register_controls() {
//  Content Section Dual Heading Start
$this->start_controls_section(
	//section which is shown after you drage your widget in the fornt-end area
	'section_content',
	[
		'label' => __('Master Price', 'additional-addons'),//......
	]
);
// adding switcher to hide or show From.
$this->add_control(
	'show_from',
	[
		'label' => __( 'Show From', 'additional-addons' ),
		'type' => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'Show', 'additional-addons' ),
		'label_off' => __( 'Hide', 'additional-addons' ),
		'return_value' => 'yes',
		'default' => 'yes',
	]
);
// adding input text field named From.
$this->add_control(
	'from',
	[
		'label' => __( 'From ', 'additional-addons' ),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => __( 'From', 'additional-addons' ),
		'placeholder' => __( 'Type yourFrom here', 'additional-addons' ),
		'condition' => ['show_from' => 'yes'],
	]
);
// adding switcher to hide or show price.
$this->add_control(
	'show_price',
	[
		'label' => __( 'Show Price', 'additional-addons' ),
		'type' => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'Show', 'additional-addons' ),
		'label_off' => __( 'Hide', 'additional-addons' ),
		'return_value' => 'yes',
		'default' => 'yes',
	]
);
// adding input text named Price.
$this->add_control(
	'price',
	[
		'label' => __( 'Price ', 'additional-addons' ),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => __( '$', 'additional-addons' ),
		'placeholder' => __( 'Type your Price here', 'additional-addons' ),
		'condition' => ['show_price' => 'yes'],
	]
);

//  switcher to hide or show Duration.
$this->add_control(
	'show_duration',
	[
		'label' => __( 'Show Duration', 'additional-addons' ),
		'type' => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'Show', 'additional-addons' ),
		'label_off' => __( 'Hide', 'additional-addons' ),
		'return_value' => 'yes',
		'default' => 'yes',
	]
);
//adding input text feild named duration.
$this->add_control(
	'duration',
	[
		'label' => __( 'Duration ', 'additional-addons' ),
		'type' => \Elementor\Controls_Manager::TEXT,
		'default' => __( 'month', 'additional-addons' ),
		'placeholder' => __( 'Type your Duration here', 'additional-addons' ),
		'condition' => ['show_duration' => 'yes']
	]
);

// select Box with / option

$this->add_control(
	'me_show_seperator',
	[
		'label' => __( 'Price Seperation Tag', 'masterelements' ),
		'type' => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'Show', 'masterelements' ),
		'label_off' => __( 'Hide', 'masterelements' ),
		'return_value' => 'yes',
		'default' => 'empty',
	]
);

$this->add_control(
	'content_seperation',
	[
		'label' => __( 'Content HTML Tag', 'additional-addons' ),
		'type' => Controls_Manager::SELECT,
		'options' => [
			'/'=>'/',
		],
		'condition' => ['me_show_seperator' => 'yes'],
		'default' => '/',
	]
);

// Content Alignment...
$this->add_control(
	'cont_align',
	[
	'label' => __( 'Content Alignment', 'additional-addons' ),
	'type' => \Elementor\Controls_Manager::CHOOSE,
	'options' => [
		'left' => [
		'title' => __( 'Left', 'additional-addons' ),
		'icon' => 'fa fa-align-left',
		],
		'center' => [
			'title' => __( 'Center', 'additional-addons' ),
			'icon' => 'fa fa-align-center',
		],
		'right' => [
			'title' => __( 'Right', 'additional-addons' ),
			'icon' => 'fa fa-align-right',
		],
	],
	'default' => 'center',
	'toggle' => true,
	]
);
$this->add_control(
	'show_inline',
	[
		'label' => __( 'Show Inline', 'masterelements' ),
		'type' => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'Show', 'masterelements' ),
		'label_off' => __( 'Hide', 'masterelements' ),
		'return_value' => 'yes',
		'default' => 'yes',
	]
);
//////////////////////////////////////////////////////////////////////////////////////
// //////////////////////////Absolute Position For "FROM"/////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////

$this->add_control(
	'me_absolute_position_from',
	[
		'label' => __( '&quot;From&quot; Position Absolute', 'masterelements' ),
		'type' => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'Show', 'masterelements' ),
		'label_off' => __( 'Hide', 'masterelements' ),
		'return_value' => 'yes',
		'default' => 'empty',
		'condition' => ['show_from' => 'yes']
	]
);

$this->add_control(
	'position_for_btn',
	[
		'label' => __( 'Button Position', 'masterelements' ),
		'label_block' => true,
		'type' => Controls_Manager::SELECT,
		'multiple' => true,
		'default' =>__( 'absolute' , 'masterelements' ),
		'options' => [					
			'relative' => __( 'Relative', 'masterelements' ),
			'absolute' => __( 'Absolute', 'masterelements' ),
			'fixed' => __( 'Fixed', 'masterelements' ),

		],
		'condition' => ['me_absolute_position_from' => 'yes'],
		//'separator' => 'before',
	]
);

//top slider control
$this->add_control(
	'position_for_btn_top',
	[
		'label' => __( 'TOP', 'masterelements' ),
		'type' => Controls_Manager::NUMBER,
		'default' =>'',
		'selectors' => [
			'{{WRAPPER}}  .from' => 'top: {{VALUE}}px;',
		],
		
		'condition' => ['me_absolute_position_from' => 'yes'],
	]
);


$this->add_control(
	'position_for_btn_right',
	[
		'label' => __( 'RIGHT', 'masterelements' ),
		'type' => Controls_Manager::NUMBER,
		'default' =>'',
		'selectors' => [
			'{{WRAPPER}}  .from' => 'right: {{VALUE}}px;',
		],
		
		'condition' => ['me_absolute_position_from' => 'yes'],
	]
);


$this->add_control(
	'position_for_btn_left',
	[
		'label' => __( 'LEFT', 'masterelements' ),
		'type' => Controls_Manager::NUMBER,
		'default' =>'',
		'selectors' => [
			'{{WRAPPER}}  .from' => 'left: {{VALUE}}px;',
		],
		
		'condition' => ['me_absolute_position_from' => 'yes'],
	]
);


$this->add_control(
	'position_for_btn_bottom',
	[
		'label' => __( 'BOTTOM', 'masterelements' ),
		'type' => Controls_Manager::NUMBER,
		'default' =>'',
		'selectors' => [
			'{{WRAPPER}}  .from' => 'bottom: {{VALUE}}px;',
		],
		
		'condition' => ['me_absolute_position_from' => 'yes'],
	]
);
//////////////////////////////////////////////////////////////////////////////////////
// //////////////////////////Absolute Position For "FROM" End//////////////////////////
//////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////
// //////////////////////////Absolute Position For "Price"/////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////


$this->add_control(
	'me_absolute_position_price',
	[
		'label' => __( '&quot;Duration&quot; Position Absolute', 'masterelements' ),
		'type' => \Elementor\Controls_Manager::SWITCHER,
		'label_on' => __( 'Show', 'masterelements' ),
		'label_off' => __( 'Hide', 'masterelements' ),
		'return_value' => 'yes',
		'default' => 'empty',
		'condition' => ['show_price' => 'yes']
	
	]
);

$this->add_control(
	'position_for_btn_price',
	[
		'label' => __( 'Button Position', 'masterelements' ),
		'label_block' => true,
		'type' => Controls_Manager::SELECT,
		'multiple' => true,
		'default' =>__( 'absolute' , 'masterelements' ),
		'options' => [					
			'relative' => __( 'Relative', 'masterelements' ),
			'absolute' => __( 'Absolute', 'masterelements' ),
			'fixed' => __( 'Fixed', 'masterelements' ),

		],
		'condition' => ['me_absolute_position_price' => 'yes'],
		//'separator' => 'before',
	]
);

//top slider control
$this->add_control(
	'position_for_btn_top_price',
	[
		'label' => __( 'TOP', 'masterelements' ),
		'type' => Controls_Manager::NUMBER,
		'default' =>'',
		'selectors' => [
			'{{WRAPPER}}  .price' => 'top: {{VALUE}}px;',
		],
		
		'condition' => ['me_absolute_position_price' => 'yes'],
	]
);


$this->add_control(
	'position_for_btn_right_price',
	[
		'label' => __( 'RIGHT', 'masterelements' ),
		'type' => Controls_Manager::NUMBER,
		'default' =>'',
		'selectors' => [
			'{{WRAPPER}}  .price' => 'right: {{VALUE}}px;',
		],
		
		'condition' => ['me_absolute_position_price' => 'yes'],
	]
);


$this->add_control(
	'position_for_btn_left_price',
	[
		'label' => __( 'LEFT', 'masterelements' ),
		'type' => Controls_Manager::NUMBER,
		'default' =>'',
		'selectors' => [
			'{{WRAPPER}}  .price' => 'left: {{VALUE}}px;',
		],
		
		'condition' => ['me_absolute_position_price' => 'yes'],
	]
);


$this->add_control(
	'position_for_btn_bottom_price',
	[
		'label' => __( 'BOTTOM', 'masterelements' ),
		'type' => Controls_Manager::NUMBER,
		'default' =>'',
		'selectors' => [
			'{{WRAPPER}}  .price' => 'bottom: {{VALUE}}px;',
		],
		
		'condition' => ['me_absolute_position_price' => 'yes'],
	]
);



//////////////////////////////////////////////////////////////////////////////////////
// //////////////////////////Absolute Position For "Price" End////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
$this->end_controls_section();
//antoher control section for style
$this->start_controls_section(
	'section_style',
	[
		'label' => __( 'Style', 'additional-addons' ),
		'tab' => Controls_Manager::TAB_STYLE,
	]
);

$this->add_control(
	'content_bg_color',
	[
		'label' => __( 'Content Background Color', 'masterelements' ),
		'type' => Controls_Manager::COLOR,
		//'default' => '#000',
		'selectors' => [
			'{{WRAPPER}} .price-content' => 'background-color: {{VALUE}}',
		],
	]
);

$this->add_group_control(
	Group_Control_Border::get_type(),
	[
		'name' => 'border',
		'label' => __( 'Border', 'masterelements' ),
		'selector' => '{{WRAPPER}} .price-content',
	]
);
$this->add_control(
	'content_border_radius',
	[
		'label' => __( 'Content Border Radius', 'masterelements' ),
		'type' => Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px', '%', 'em' ],
		'selectors' => [
			'{{WRAPPER}} .price-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		],
	]
);

$this->add_group_control(
	Group_Control_Box_Shadow::get_type(),
	[
		'name' => 'box_shadow',
		'label' => __( 'Box Shadow', 'masterelements' ),
		'selector' => '{{WRAPPER}} .price-content',
	]
);

$this->add_responsive_control(
	'me_icon_width',
	[
		'label' => __('Icon Width', 'masterelements'),
		'type' => Controls_Manager::SLIDER,
		'size_units' => ['px', '%'],
		'devices' => ['desktop','tablet','mobile'],
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
		'selectors' => [
			'{{WRAPPER}} .price-content' => 'width: {{SIZE}}{{UNIT}};',
		],
	]
);
$this->add_responsive_control(
	'me_icon_height',
	[
		'label' => __('Icon Height', 'masterelements'),
		'type' => Controls_Manager::SLIDER,
		'size_units' => ['px', '%'],
		'devices' => ['desktop','tablet','mobile'],
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
		'selectors' => [
			'{{WRAPPER}} .price-content' => 'height: {{SIZE}}{{UNIT}};',
		],
	]
);

$this->add_control(
	'me_content_padding',
	[
		'label' => __( 'Content Padding', 'masterelements' ),
		'type' => Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px', '%', 'em' ],
		'selectors' => [
			'{{WRAPPER}} .price-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		],
	]
);


//From Color Change
$this->add_control(
	'from_color',
	[
		'label' => __( 'From Color Text', 'additional-addons' ),
		'type' => Controls_Manager::COLOR,
		'default' => '#000',
		'selectors' => [
			'{{WRAPPER}} .from' => 'color: {{VALUE}}',
		],
	]
);
//Price Color Change
$this->add_control(
	'price_color',
	[
		'label' => __( 'Price Color Text', 'additional-addons' ),
		'type' => Controls_Manager::COLOR,
		'default' => '#000',
		'selectors' => [
			'{{WRAPPER}} .price' => 'color: {{VALUE}}',
		],
	]
);
//Duration Color Change
$this->add_control(
	'duration_color',
	[
		'label' => __( 'Duration Color Text', 'additional-addons' ),
		'type' => Controls_Manager::COLOR,
		'default' => '#000',
		'selectors' => [
			'{{WRAPPER}} .duration' => 'color: {{VALUE}}',
		],
	]
);
//Layout From
$this->add_group_control(
	\Elementor\Group_Control_Typography::get_type(),
	[
		'name' => 'from_typography',
		'label' => __( 'From Typography', 'additional-addons' ),
		'selector' => '{{WRAPPER}} .from',
	]
);
//Layout Price
$this->add_group_control(
	\Elementor\Group_Control_Typography::get_type(),
	[
		'name' => 'price_typography',
		'label' => __( 'Price Typography', 'additional-addons' ),
		'selector' => '{{WRAPPER}} .price',
	]
);
//Layout Duration
$this->add_group_control(
	\Elementor\Group_Control_Typography::get_type(),
	[
		'name' => 'duration_typography',
		'label' => __( 'Duration Typography', 'additional-addons' ),
		'selector' => '{{WRAPPER}} .duration',
	]
);

$this->end_controls_section();
	

	$this->start_controls_section(
		'section_style1',
		[
			'label' => __( 'From Style', 'additional-addons' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	
$this->add_control(
	'me_from_margin',
	[
		'label' => __( 'Margin', 'masterelements' ),
		'type' => Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px', '%', 'em' ],
		'selectors' => [
			'{{WRAPPER}} .from p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		],
	]
);

	$this->end_controls_section();

	$this->start_controls_section(
		'section_style2',
		[
			'label' => __( 'Price Style', 'additional-addons' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);

	
$this->add_control(
	'me_price_margin',
	[
		'label' => __( 'Margin', 'masterelements' ),
		'type' => Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px', '%', 'em' ],
		'selectors' => [
			'{{WRAPPER}} .price p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		],
	]
);
	$this->end_controls_section();

	$this->start_controls_section(
		'section_style3',
		[
			'label' => __( 'Month Style', 'additional-addons' ),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);

	
$this->add_control(
	'me_duration_margin',
	[
		'label' => __( 'Margin', 'masterelements' ),
		'type' => Controls_Manager::DIMENSIONS,
		'size_units' => [ 'px', '%', 'em' ],
		'selectors' => [
			'{{WRAPPER}} .duration p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		],
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
	//function to show how front end will look like after you change settings in price widget
	//front end live preview.
	protected function render() {
		$settings = $this->get_settings_for_display();
?>
		<?php  
		if ($settings['show_inline']=='yes')  {
			$varis="inline";
		}
		?>
		<div class="price-content align-<?=$settings['cont_align']?>" style="text-align: <?=$settings['cont_align']?>">
		<?php if($settings['show_from']=='yes') : ?>
		<span  class="from" style="position:<?=$settings['position_for_btn']?>"><p style="display:<?=$varis?>"><?=$settings['from']?></p></span>
	    <?php endif;?> 
		<?php if($settings['show_price']=='yes') :?>
		<span class="price" style="position:<?=$settings['position_for_btn_price']?>"><p style="display:<?=$varis?>"><?=$settings['price'];?></p></span>
		<?php endif; ?> 
		<?php if($settings['show_duration']=='yes') : ?>
		<span class="duration" style="position: relative; top:<?=$settings['postion2']?>px"><p style="display:<?=$varis;?>"><?=$settings['content_seperation'];?><?=$settings['duration'];?></p></span>
		<?php endif; ?>
		</div>
		<?php	
    }
    /**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() {
	}
}
?>
