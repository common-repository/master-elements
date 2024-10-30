<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
class Master_Post_Meta extends Widget_Base {
	public $base;
    public function get_name() {
		//get widget name from metapost-handler.php file
		return 'postmeta';
	}
	//get widget title from metapost-handler.php file
    public function get_title() {
		return esc_html__( 'Master Post Meta', 'masterelements' );
	}
	//get widget icon from metapost-handler.php file
    public function get_icon() {
		return 'post-meta';
	}
	//get widget category from metapost-handler.php file
    public function get_categories() {
		return [ 'master-addons' ];
	}
	//regsiter control
    protected function _register_controls() {
		//single post meta section
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Master Single Post Meta', 'masterelements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		//Respeater control
		$repeater = new \Elementor\Repeater();

		//Meta data select box control
		$repeater->add_control(
			'meta_data',
			[
				'label' => __( 'Meta Data', 'masterelements' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'multiple' => true,
				'default' =>__( 'Select Meta' , 'masterelements' ),
				'options' => [
					'author' => __( 'Author', 'masterelements' ),
					'date' => __( 'Date', 'masterelements' ),
					'categories' => __( 'Categories', 'masterelements' ),
					'comments' => __( 'Comments', 'masterelements' ),
					'tags' => __( 'Tags', 'masterelements' ),
				],
				'separator' => 'before',
			]
		);
		//icon control choose icon control
		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'masterelements' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
		//icon margin slider control
		$repeater->add_control(
			'meta_icon_indent',
			[
				'label' => __( 'Icon Margin', 'masterelements' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} > #ic_space.right-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		//show icon switcher control
		$repeater->add_control(
			'show_icon',
			[
				'label' => __( 'Show Icon', 'masterelements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'masterelements' ),
				'label_off' => __( 'Hide', 'masterelements' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		//Meta margin right slider control
		$repeater->add_control(
			'meta_indent_right',
			[
				'label' => __( 'Mata Right Margin', 'masterelements' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		//Meta margin left slider control
		$repeater->add_control(
			'meta_indent_left',
			[
				'label' => __( 'Mata Left Margin', 'masterelements' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		//icon color picker
		$repeater->add_responsive_control(
			'mata_icon_color',
			[
				'label' =>esc_html__( 'Mata Icon Color', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} > i' => 'color: {{VALUE}};',
				],
			]
		);
		//text color picker
		$repeater->add_responsive_control(
			'mata_text_color',
			[
				'label' =>esc_html__( 'Mata Text Color', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} >a ' => 'color: {{VALUE}};',
				],
			]
		);
		//meta text background color picker
		$repeater->add_responsive_control(
			'mata_text_backgroundcolor',
			[
				'label' =>esc_html__( 'Mata Text Background Color', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} >a ' => 'background-color: {{VALUE}};',
				],
			]
		);
		//meta text hover  color  picker
		$repeater->add_responsive_control(
			'mata_text_color_hover',
			[
				'label' =>esc_html__( 'Mata Text Color hover', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} >a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		//meta text background color hover  (color  picker)
		$repeater->add_responsive_control(
			'mata_text_backgroundcolor_hover',
			[
				'label' =>esc_html__( 'Mata Text Background Color Hover', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} >a:hover ' => 'background-color: {{VALUE}};',
				],
			]
		);
		//Repeater List control
		$this->add_control(
			'meta_list',
			[
				'label' => __( 'Repeater List', 'masterelements' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'meta_data' => __( 'Meta', 'masterelements' ),
						'icon'=>'fas fa-star',
						'meta_icon_indent'=>__( 'Icon Spacing', 'masterelements' ),
						'meta_indent_right'=>__('Meta Spacing Right','masterelements'),
						'meta_indent_left'=>__('Meta Spacing Left','masterelements'),
						'mata_icon_color'=>__('Meta Icon Color','masterelements'),
						'mata_text_color'=>__('Meta Text Color','masterelements'),
					],
				],
				'title_field' => '{{{ meta_data }}}',
			]
		);
		//alignment control for meta
		$this->add_control(
			'Mata_align',
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
					'{{WRAPPER}} .outer' => 'text-align: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section(); //end single post meta section
		//style section under single post meta section
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
				'name' => 'meta_typography',
				'label' => __( 'Meta Typography', 'masterelements' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} a.postmeta',
			]
		);
		//marign control inside style section
		$this->add_control(
			'margin',
			[
				'label' => __( 'Margin Meta ', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} a.postmeta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		//padding control inside style section
		$this->add_control(
			'padding',
			[
				'label' => __( 'Padding Meta ', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} a.postmeta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;',
				],
			]
		);
		//border control
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => __( 'Border', 'masterelements' ),
				'selector' => '{{WRAPPER}} a.postmeta',
			]
		);
		//meta background color hover control (color picker)
		$this->add_responsive_control(
			'mata_bordercolor_hover',
			[
				'label' =>esc_html__( 'Mata Border Color Hover', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} a.postmeta:hover ' => 'border-color: {{VALUE}};',
				],
			]
		);
		//border radius control
		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius Meta ', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} a.postmeta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;',
				],
			]
		);
		$this->end_controls_section(); //end style section
	}
	//fron end rendering
    protected function render() {
		$settings = $this->get_settings_for_display();
		// if ( $settings['meta_list'] ) {
		// 	echo '<dl>';
		// 	foreach (  $settings['meta_list'] as $item ) {
		// 		echo '<dt class="elementor-repeater-item-' . $item['_id'] . '">' . $item['meta_data'] . '</dt>';
		// 	}
		// 	echo '</dl>';
		// }
		$current_page = sanitize_post( $GLOBALS['wp_the_query']->get_queried_object() );
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
		// Get the page slug
		$post = $my_posts[0];
		}
		else{
			$post = '';
		}
?>
	<div class="outer">
		<?php
			foreach (  $settings['meta_list'] as $item ) {
				$meta=$item['meta_data'];
				if ($meta=='author' ) { ?>
					<div  style="display:inline-block" class="elementor-repeater-item-<?php echo esc_attr( $item[ '_id' ] ); ?>"><?php if($item['show_icon']=='yes'){ echo '<i id="ic_space" class="right-icon '.$item['icon']['value'].'"></i>';}?><a class="postmeta" href="<?php echo get_author_posts_url($post->post_author);?>" style="display:inline-block"><?php the_author_meta( 'user_nicename' , $post->post_author); ?></a></div>
				<?php
				}
				if (  'date'== $meta  ) {  
					$archive_year  = get_the_time('Y'); 
					$archive_month = get_the_time('m'); 
					$archive_day   = get_the_time('d'); 
					?>
								<div style="display:inline-block" class="elementor-repeater-item-<?php echo esc_attr( $item[ '_id' ] ); ?>"><?php if($item['show_icon']=='yes'){ echo '<i id="ic_space" class="right-icon '.$item['icon']['value'].'"></i>';}?><a class="postmeta" href="<?php echo get_day_link($archive_year,$archive_month, $archive_day);?>" style="display:inline-block"><?php echo get_post_time( get_option( 'date_format' ), false, $post, true );?></a></div>
					<?php
				}
				if ( 'categories'== $meta ) {
						$category_detail=get_the_category(isset($post->ID));
						?>
						<div style="display:inline-block" class="elementor-repeater-item-<?php echo esc_attr( $item[ '_id' ] ); ?>">
						<?php if($item['show_icon']=='yes'){ echo '<i id="ic_space" class="right-icon '.$item['icon']['value'].'"></i>';}
						foreach($category_detail as $cd){
						$category_id = get_cat_ID( $cd->cat_name );?>
							<a class="postmeta" href="<?php echo get_category_link( isset($category_id) );?>" style="display:inline-block"><?=$cd->cat_name?></a>
						<?php }?>
						</div>
						<?php
				}
				if (  'comments'== $meta  ) { 
						
						$approvedComments = get_comments_number($post->ID);
					?>
						<div style="display:inline-block" class="elementor-repeater-item-<?php echo esc_attr( $item[ '_id' ] ); ?>"><?php if($item['show_icon']=='yes'){ echo '<i id="ic_space" class="right-icon '.$item['icon']['value'].'"></i>';}?><a class="postmeta" href="<?php echo get_comments_link(); ?>"  style="display:inline-block" ><?php echo 'Comments '. $approvedComments ; ?></a></div>
					<?php 
				}
				if (  'tags'==  $meta ) {
						$tags_detail=get_the_tags($post->ID);
						if(empty($tags_detail))
						{
							break;
						}
						else
						{
						foreach($tags_detail as $tg){
							if($tg->name=='')
							{
								echo '';
							}
							else
							{
								?>
								<div style="display:inline-block" class="elementor-repeater-item-<?php echo esc_attr( $item[ '_id' ] ); ?>"><?php if($item['show_icon']=='yes'){ echo '<i id="ic_space" class="right-icon '.$item['icon']['value'].'"></i>'; }?><a class="postmeta" href="<?php echo get_tag_link($tg->term_id); ?>"  style="display:inline-block"><?php echo $tg->name; ?></a></div>
						<?php	}
						}
						}
				}
		}
		?>
	</div>
	<?php
	}
}
