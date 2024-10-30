<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;

class Master_Search extends Widget_Base {
    public $base;
    
    public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
        wp_register_style( 'search-css',  \MasterElements::widgets_url() . '/search/assets/search.css', false, \MasterElements::version );
  
     }
  
	  public function get_style_depends() {
		 
		 return [ 'search-css' ];
	  }

    public function get_name() {
        //get name from search-handler.php file
        return 'search';
    }
    public function get_title() {
        //get title from search-handler.php file
        return esc_html__( 'Master Search', 'masterelements' );
    }
    public function get_icon() {
        //get icon from search-handler.php file
        return 'search';
    }
    public function get_categories() {
        //get categories from search-handler.php file
        return [ 'master-addons' ];
    }
    //register controls
    protected function _register_controls() {
        //search section inside search widget
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Search', 'masterelements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'masterelements' ),
				'selector' => '.master-search-filed',
			]
		);

        $this->add_responsive_control(
			'input_field_padding',
			[
				'label' => __( 'Input-Field-Padding', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'.master-search-filed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
				],
			]
        );
        
        $this->add_control(
			'margin',
			[
				'label' => __( 'Input-Field-Margin', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.master-search-filed' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );

        $this->add_control(
			'input-border_radius',
			[
				'label' => __( 'Input-Border-Radius', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.master-search-filed' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important',
				],
			]
		);
        
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'masterelements' ),
				'selector' => '.master-search-filed',
			]
		);

        $this->add_control(
			'switch-control',
			[
				'label' => __( 'Show Icon', 'masterelements' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'masterelements' ),
				'label_off' => __( 'Hide', 'masterelements' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
            
		);

        $this->add_control(
			'icon',
			[
				'label' => __( 'Button Icon', 'masterelements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
                ],
                'condition' => [
                    'switch-control' => 'yes'
                ],
			]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Button_Typography', 'masterelements' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .master-search-btn',
                'condition' => [
                    'switch-control' => 'no'
                ],
            ]
        );

        $this->add_control(
            'border_radius_search_btn',
            [
                'label'     => __( 'Button Border Radius', 'masterelements' ),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 0,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '.master-search-btn' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
			'Button_Padding',
			[
				'label' => __( 'Button-Padding', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'.master-search-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
        );
        $this->add_control(
			'Button_margin',
			[
				'label' => __( 'Button-Margin', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'.master-search-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
      
        $this->add_control(
            'search_btn_background_color',
            [
                'label'     => __( 'Button Background Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                
                'selectors' => [
                    '.master-search-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'search_btn_icon_color',
            [
                'label'     => __( 'Icon Color', 'masterelements' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => [
                    'type'  => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_2,
                ],
                
                'selectors' => [
                    '.master-search-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'position_for_btn',
			[
				'label' => __( 'Button Position', 'masterelements' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'multiple' => true,
				'default' =>__( 'Select position' , 'masterelements' ),
				'options' => [					
                    'relative' => __( 'Relative', 'masterelements' ),
                    'absolute' => __( 'Absolute', 'masterelements' ),
					'fixed' => __( 'Fixed', 'masterelements' ),

				],
				//'separator' => 'before',
			]
		);

		//top slider control
		$this->add_control(
			'position_for_btn_top',
			[
				'label' => __( 'TOP', 'masterelements' ),
				'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'default' =>0,
				'selectors' => [
					'{{WRAPPER}}  .master-search-btn ' => 'top: {{VALUE}}px;',
				],
			]
		);
		
	
		$this->add_control(
			'position_for_btn_right',
			[
				'label' => __( 'RIGHT', 'masterelements' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 0,
				'default' =>0,
				'selectors' => [
					'{{WRAPPER}}  .master-search-btn ' => 'right: {{VALUE}}px;',
				],
			]
		);
		
		
		$this->add_control(
			'position_for_btn_left',
			[
				'label' => __( 'LEFT', 'masterelements' ),
				'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'default' =>'',
				'selectors' => [
					'{{WRAPPER}}  .master-search-btn ' => 'left: {{VALUE}}px;',
				],
			]
		);
		
		
		$this->add_control(
			'position_for_btn_bottom',
			[
				'label' => __( 'BOTTOM', 'masterelements' ),
				'type' => Controls_Manager::NUMBER,
                'min' => 0,
                'default' =>'',
				'selectors' => [
					'{{WRAPPER}}  .master-search-btn' => 'bottom: {{VALUE}}px;',
				],
			]
		);
        
        
        $this->end_controls_section();
        
    }
    //front end rendering
    protected function render() {

        
        $settings = $this->get_settings_for_display();
        $unique_id = esc_attr( self::wp_get_unique_id( 'master-search-form-' ) );
        ?>
       <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
       <label for="<?php echo $unique_id; ?>" class="master-searchbox-label"></label>
    <div class="master-searchbox">
                                <input type="text" class="master-search-filed" placeholder="What are you looking for?" value="<?php echo get_search_query(); ?>" name="s">
                                <button class ="master-search-btn epres-<?=$settings['position_for_btn'];?>" type="submit"> <?php if($settings['switch-control']==="yes"){\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );}else{echo 'Search';} ?></button>
                    </div>
                </form>
            
        <?php
        
}
function wp_get_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}
    protected function _content_template() { }
}