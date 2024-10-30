<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
class Master_Post_Title extends Widget_Base {
	public $base;
    public function get_name() {
		return 'Epress-PostTitle';
    }
    public function get_title() {
		return esc_html__( 'Master Post Title', 'masterelements' );
    }
    public function get_icon() {
		return 'post-title';
    }
    public function get_categories() {
        return [ 'master-addons' ];
    }
    protected function _register_controls() {
		//single post section after draging single post widget in front-end
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Single Post Title', 'masterelements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		//controls inside single post title section
		//select different headings control
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
		//choose control to align text
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
					'{{WRAPPER}} .post_title' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section(); //end first section
		//style section under single post title section
        $this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'masterelements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		//typography control inside style section
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Typography', 'masterelements' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .post_title a',
			]
        );
         //color picker control inside style section
         $this->add_control(
        	'title_color',
        	[
        		'label' => __( 'Title Color Text', 'masterelements' ),
        		'type' => Controls_Manager::COLOR,
 			 'default' => '#000',
        		'selectors' => [
        			'{{WRAPPER}} .post_title a' => 'color: {{VALUE}}',
        		],
        	]
        );
        $this->end_controls_section();
	}
	//how display will look on front end
    protected function render() {
		//getting all the settings (control title)of every controls and section.
        $settings = $this->get_settings_for_display();
		$queried_object = get_queried_object();

		if ( $queried_object ) {
			$post_id = $queried_object->ID;
		//	echo $post_id;
		}
		?>
		<div class="post_title">
		<<?php echo $settings['html_tags']; ?>>
		<a href="<?php the_permalink($post_id); ?>">
			<?php echo get_the_title($post_id);?></a>
		</<?php echo $settings['html_tags']; ?>>
		</div>
		<?php
		
}
}