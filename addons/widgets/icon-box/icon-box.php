<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Schemes;
class Master_Icon_Box extends Widget_Base {

    public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_style( 'icon-style',  \MasterElements::widgets_url() . '/icon-box/assets/icon-style.css', false, \MasterElements::version );

 
    }


    public function get_style_depends() {
		 
        return [ 'icon-style' ];
     }
	/**
	 * Get widget name.
	 *
	 * Retrieve icon box widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'icon-box';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve icon box widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Master Icon Box', 'masterelements' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve icon box widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'icon-box';
	}
	public function get_categories() {
        //////////////////////////////////////////////////////////////////////////
        //////get category where widget will be added in elementor front end//////
        //////////////////////////////////////////////////////////////////////////
		return [ 'master-addons' ];
    }
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'Master icon box', 'icon' ];
	}

	/**
	 * Register icon box widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon Box', 'masterelements' ),
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'masterelements' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'masterelements' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => __( 'Default', 'masterelements' ),
					'stacked' => __( 'Stacked', 'masterelements' ),
					'framed' => __( 'Framed', 'masterelements' ),
				],
				'default' => 'default',
				'prefix_class' => 'master-view-',
			]
		);

		$this->add_control(
			'shape',
			[
				'label' => __( 'Shape', 'masterelements' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => __( 'Circle', 'masterelements' ),
					'square' => __( 'Square', 'masterelements' ),
				],
				'default' => 'circle',
				'condition' => [
					'view!' => 'default',
					'selected_icon[value]!' => '',
				],
				'prefix_class' => 'master-shape-',
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title & Description', 'masterelements' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'This is the heading', 'masterelements' ),
				'placeholder' => __( 'Enter your title', 'masterelements' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'title_size',
			[
				'label' => __( 'Title HTML Tag', 'masterelements' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'masterelements' ),
				'placeholder' => __( 'Enter your description', 'masterelements' ),
				'rows' => 10,
				'separator' => 'none',
				'show_label' => false,
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'masterelements' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'masterelements' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'position',
			[
				'label' => __( 'Icon Position', 'masterelements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'masterelements' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __( 'Top', 'masterelements' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __( 'Right', 'masterelements' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'position-',
				'toggle' => false,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'selected_icon[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);


		$this->end_controls_section();
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////// Icon Style Starts Here ////////////////////////////////////////////////
		////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'masterelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'selected_icon[value]',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => __( 'Normal', 'masterelements' ),
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Primary Color', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}.master-view-stacked .master-icon, {{WRAPPER}}.master-view-stacked .master-icon a, {{WRAPPER}} .icon, {{WRAPPER}} .icon a' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.master-view-framed, {{WRAPPER}}.master-view-framed a, {{WRAPPER}}.master-view-default,  {{WRAPPER}}.master-view-default a' => 'fill: {{VALUE}}; color: {{VALUE}}; border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'secondary_color',
			[
				'label' => __( 'Secondary Color', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.master-view-framed .master-icon, {{WRAPPER}}.master-view-framed .master-icon a,' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.master-view-stacked .master-icon, {{WRAPPER}}.master-view-stacked .master-icon a' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => __( 'Hover', 'masterelements' ),
			]
		);

		$this->add_control(
			'hover_primary_color',
			[
				'label' => __( 'Primary Color', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					' {{WRAPPER}} .master-icon:hover, {{WRAPPER}} .icon:hover,  {{WRAPPER}} .master-icon:hover, {{WRAPPER}} .icon:hover a' => 'background-color: {{VALUE}};',
					' {{WRAPPER}} .master-icon:hover, {{WRAPPER}} .icon:hover,  {{WRAPPER}} .master-icon:hover, {{WRAPPER}} .icon:hover a' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_secondary_color',
			[
				'label' => __( 'Secondary Color', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'condition' => [
					'view!' => 'default',
				],
				'selectors' => [
					' {{WRAPPER}} .master-icon:hover, {{WRAPPER}} .icon:hover, {{WRAPPER}} .master-icon:hover, {{WRAPPER}} .icon:hover a' => 'background-color: {{VALUE}};',
					' {{WRAPPER}} .master-icon:hover, {{WRAPPER}} .icon:hover, {{WRAPPER}} .master-icon:hover, {{WRAPPER}} .icon:hover a' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'masterelements' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);
		

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'masterelements' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .master-icon, {{WRAPPER}} .icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => __( 'Padding', 'masterelements' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .master-icon, {{WRAPPER}} .icon' => 'padding: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);

		$this->add_control(
			'rotate',
			[
				'label' => __( 'Rotate', 'masterelements' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-icon i, {{WRAPPER}} .master-icon, {{WRAPPER}} .icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'border_width',
			[
				'label' => __( 'Border Width', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .master-icon, {{WRAPPER}} .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view' => 'framed',
				],
			]
		);
		

		$this->add_control(
			'border_radius',
			[
				'label' => __( 'Border Radius', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .master-icon, {{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'view!' => 'default',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => __( 'Background', 'masterelements' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .icon-box-icon, {{WRAPPER}} .icon',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'me_icon_border',
				'label' => __( 'Icon Border', 'masterelements' ),
				'selector' => '{{WRAPPER}} .icon-box-icon, {{WRAPPER}} .icon',
			]
		);

		$this->add_control(
			'me_icon_box_border_radius',
			[
				'label' => __( 'Border Radius', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box-icon, {{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
                    '{{WRAPPER}} .icon-box-icon' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .icon-box-icon, {{WRAPPER}} .icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->end_controls_section();
///////////////////////////////////////////////////////////////////////////////////////////////////////////////		
///////////////////////////////////// Icon Style ends Here ////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////// Content Style Starts Here ////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'masterelements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label' => __( 'Alignment', 'masterelements' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'masterelements' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'masterelements' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'masterelements' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'masterelements' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_vertical_alignment',
			[
				'label' => __( 'Vertical Alignment', 'masterelements' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Top', 'masterelements' ),
					'middle' => __( 'Middle', 'masterelements' ),
					'bottom' => __( 'Bottom', 'masterelements' ),
				],
				'default' => 'top',
				'prefix_class' => 'master-vertical-align-',
			]
		);
		$this->add_responsive_control(
			'me_content_box_margin',
			[
				'label' => __( 'Margin', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box-content' => 'Margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'masterelements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		


		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'masterelements' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box-content .icon-box-title,  {{WRAPPER}} .icon-box-content .icon-box-title a' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
			]
		);
		$this->add_control(
			'title_hover_color',
			[
				'label' => __( 'Title Hover Color', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box-content .icon-box-title:hover,  {{WRAPPER}} .icon-box-content .icon-box-title:hover a' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_1,
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .icon-box-content .icon-box-title',
				'scheme' => Schemes\Typography::TYPOGRAPHY_1,
			]
		);
		$this->add_control(
			'me_title_margin',
			[
				'label' => __( 'Title Margin', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box-content .icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'masterelements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
	

		$this->add_control(
			'text_description_color',
			[
				'label' => __( 'Color', 'masterelements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box-content .icon-box-description,{{WRAPPER}} .icon-box-content .icon-box-desc' => 'color: {{VALUE}};',
				],
				'scheme' => [
					'type' => Schemes\Color::get_type(),
					'value' => Schemes\Color::COLOR_3,
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .icon-box-content .icon-box-description,{{WRAPPER}} .icon-box-content .icon-box-desc',
				'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);
		$this->add_control(
			'me_desc_margin',
			[
				'label' => __( 'Description Margin', 'masterelements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box-content .icon-box-description,{{WRAPPER}} .icon-box-content .icon-box-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->end_controls_section();
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////// Content Style Ends Here ////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'icon', 'class', [ 'master-icon', 'master-animation-' . $settings['hover_animation'] ] );

		$icon_tag = 'span';

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['icon'] = 'fa fa-star';
		}

		$has_icon = ! empty( $settings['icon'] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
			$icon_tag = 'a';

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		$icon_attributes = $this->get_render_attribute_string( 'icon' );
		$link_attributes = $this->get_render_attribute_string( 'link' );

		$this->add_render_attribute( 'description_text', 'class', 'master-icon-box-description' );

		$this->add_inline_editing_attributes( 'title_text', 'none' );
		$this->add_inline_editing_attributes( 'description_text' );
		if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
			$has_icon = true;
		}
		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = ! isset( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		?>
		<div class="icon-box-wrapper">
			<?php if ( $has_icon ) : ?>
			<div class="icon-box-icon">
				<<?php echo implode( ' ', [ $icon_tag, $icon_attributes, $link_attributes ] ); ?>>
				<?php
				if ( $is_new || $migrated ) {
					Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
				} elseif ( ! empty( $settings['icon'] ) ) {
					?><i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i><?php
				}
				?>
				</<?php echo $icon_tag; ?>>
			</div>
			<?php endif; ?>
			<div class="icon-box-content">
				<<?php echo $settings['title_size']; ?> class="icon-box-title">
					<<?php echo implode( ' ', [ $icon_tag, $link_attributes ] ); ?><?php echo $this->get_render_attribute_string( 'title_text' ); ?>><?php echo $settings['title_text']; ?></<?php echo $icon_tag; ?>>
				</<?php echo $settings['title_size']; ?>>
				<?php if ( ! Utils::is_empty( $settings['description_text'] ) ) : ?>
				<p class="icon-box-desc"><?php echo $settings['description_text']; ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
   /**
	 * Render icon box widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
			iconTag = link ? 'a' : 'span',
			iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ),
			migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' );

		view.addRenderAttribute( 'description_text', 'class', 'icon-box-description' );

		view.addInlineEditingAttributes( 'title_text', 'none' );
		view.addInlineEditingAttributes( 'description_text' );
		#>
		<div class="icon-box-wrapper">
			<# if ( settings.icon || settings.selected_icon ) { #>
			<div class="icon-box-icon">
				<{{{ iconTag + ' ' + link }}} class="icon animation-{{ settings.hover_animation }}">
					<# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
						{{{ iconHTML.value }}}
						<# } else { #>
							<i class="{{ settings.icon }}" aria-hidden="true"></i>
						<# } #>
				</{{{ iconTag }}}>
			</div>
			<# } #>
			<div class="icon-box-content">
				<{{{ settings.title_size }}} class="icon-box-title">
					<{{{ iconTag + ' ' + link }}} {{{ view.getRenderAttributeString( 'title_text' ) }}}>{{{ settings.title_text }}}</{{{ iconTag }}}>
				</{{{ settings.title_size }}}>
				<# if ( settings.description_text ) { #>
				<p {{{ view.getRenderAttributeString( 'description_text' ) }}}>{{{ settings.description_text }}}</p>
				<# } #>
			</div>
		</div>
		<?php
	}

	public function on_import( $element ) {
		return Icons_Manager::on_import_migration( $element, 'icon', 'selected_icon', true );
	}
}
