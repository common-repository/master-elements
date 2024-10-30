<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;

class Master_Post_Image extends Widget_Base {
	public $base;
    public function get_name() {
        return 'postimage';
    }
    public function get_title() {
        return esc_html__( 'Master Post Images', 'masterelements' );
    }
    public function get_icon() {
		return 'post-image';
    }
    public function get_categories() {
        return [ 'master-addons' ];
	}
	//register controls
    protected function _register_controls() {
		//single post images section
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Single Post Images', 'masterelements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		//Image size control inside single post images section. (select box control)
		$this->add_control(
			'image_size',
			[
				'label' => __( 'Image Size', 'masterelements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'thumbnail',
				'options' => [
					'thumbnail'  => __( 'Thumbnail (  150x150 )', 'masterelements' ),
					'medium' => __( 'Medium (  300x300 )', 'masterelements' ),
					'large' => __( 'Large (  1024x1024 )', 'masterelements' ),
					'Full' => __( 'Full ( Original Image Size )', 'masterelements' ),
				],
			]
		);
			//Image align control inside single post images section. (Choose control)
        $this->add_control(
			'image_align',
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
					'{{WRAPPER}} .post-image' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section(); //end single post images section
		//Style section after single post images section
        $this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'masterelements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		//style section Image dimensions control
		$this->add_control(
			'img_size_custom',
			[
				'label' => __( 'Image Dimension', 'masterelements' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'masterelements' ),
				'default' => [
					'width' => '',
					'height' => '',
				],
			]
		);
		//border type control inside style section.
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'masterelements' ),
				'selector' => '{{WRAPPER}} .feature_image',
			]
		);
		//border radius control inside style section.
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .feature_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section(); //end style section.
	}
	//front end display function.
    protected function render() {
        $settings = $this->get_settings_for_display();
      $imagesize=$settings['image_size'];
  $current_page = sanitize_post( $GLOBALS['wp_the_query']->get_queried_object() );
// Get the page slug
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
  foreach($my_posts as $post){
    ?>
    <div class="post-image"><!--Show post image based on above controls -->
   <?php  $featured_img_url = get_the_post_thumbnail_url($post->ID,$imagesize); 
  /* link thumbnail to full size image for use with lightbox*/?>
 <a href="<?esc_url($featured_img_url)?>" rel="lightbox"><img class="feature_image" style="width:<?= $settings['img_size_custom']['width']?>px;height:<?=$settings['img_size_custom']['height']?>px;" src="<?=esc_url($featured_img_url)?>"></a>
    </div>
    <?php
  }
}
  
}