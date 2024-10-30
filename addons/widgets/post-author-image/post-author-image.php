<?php
namespace Elementor;
use \Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;
class Master_Post_Author_Image extends Widget_Base {
	public $base;
    public function get_name() {
		//get widget name from postauthorimage-handler.php file
		return 'postauthorimage';
	}
	//get widget title from postauthorimage-handler.php file
    public function get_title() {
        return esc_html__( 'Master Post Author Image', 'masterelements' );
	}
	//get widget icon from postauthorimage-handler.php file
    public function get_icon() {
		return 'post-author-image';
	}
	//get widget category from postauthorimage-handler.php file
    public function get_categories() {
        return [ 'master-addons' ];
	}
	//register controls
    protected function _register_controls() {
       
		//single post author  section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Single Post Author', 'masterelements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		//image align control inside single post author section
		$this->add_control(
			'img_align',
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
					'{{WRAPPER}} .img' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		//image padding control inside single post author section
		$this->add_responsive_control(
			'img_padding',
			[
				'label' => __( 'Paddiing', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .auth-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		); 
		//image marign control inside single post author section
		$this->add_responsive_control(
			'img_margin',
			[
				'label' => __( 'Margin', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .auth-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		//border-radius control inside single post author section
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .auth-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		//border control
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'masterelements' ),
				'selector' => '{{WRAPPER}} .auth-image',
			]
		);
		//image dimensions control
		$this->add_control(
			'img_dimension',
			[
				'label' => __( 'Image Dimension', 'masterelements' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'masterelements' ),
				'default' => [
					'width' => '', //default width null
					'height' => '', //default height null
				],
			]
		);
        $this->end_controls_section(); //end single post author section
	}
	//front end rendering
    protected function render() {
		$settings = $this->get_settings_for_display();
		$current_page = sanitize_post( $GLOBALS['wp_the_query']->get_queried_object() );
		//global $current_user;
		if(isset($current_page) && !empty($current_page))
		{
		// Get the page slug
 			$slug = $current_page->post_name;
		}
		else{
			$slug = '';
		}
		$args = array(
			'name'        => $slug,
			'post_type'   => 'post',
			'post_status' => 'publish',
			'numberposts' => 1
		  );
		  $my_posts = get_posts($args);
		  if(isset($my_posts) && !empty($my_posts))
		{
		  $post = $my_posts[0];
		}
		else{
			$post = '';
		}
		//display image
		  foreach($my_posts as $post){
			$author_id=$post->post_author;?>
			<div class="img">
          <source srcset="<?php print get_avatar_url($author_id, ['size' => '51']); ?>" media="(min-width: 992px)"/>
          <img class="auth-image" style="width:<?= $settings['img_dimension']['width']?>px;height:<?=$settings['img_dimension']['height']?>px" src="<?php print get_avatar_url($author_id, ['size' => '200']); ?>"/>
          </div>
			<?php
		 }
}
 
}