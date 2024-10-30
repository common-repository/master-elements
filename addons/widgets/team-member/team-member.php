<?php
namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}

class Master_Team_Member extends Widget_Base {

	public $base;

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_style('team-members-css', \MasterElements::widgets_url() . '/team-member/assets/css/team-members.css', false, \MasterElements::version);
        wp_register_style('team-min-css', \MasterElements::widgets_url() . '/team-member/assets/css/team-members.min.css', false, \MasterElements::version);
    }

    public function get_style_depends()
    {

        return ['team-members-css', 'team-min-css'];
    }


	public function get_name() {
		return 'team-member';
	}

	public function get_title() {
		return esc_html__( 'Master Team Member', 'masterelements');
	}


   	public function get_categories() {
		return [ 'masterelements' ];
	}
    
	
	protected function _register_controls() {

		
  		$this->start_controls_section(
  			'master_section_image',
  			[
  				'label' => esc_html__( 'Team Member Image', 'masterelements')
  			]
  		);
		

		$this->add_control(
			'master_image_team_member',
			[
				'label' => __( 'Team Member Avatar', 'masterelements'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);


		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail',
				'default' => 'full',
				'condition' => [
					'master_image_team_member[url]!' => '',
				],
			]
		);


		$this->end_controls_section();

  		$this->start_controls_section(
  			'master_content_section',
  			[
  				'label' => esc_html__( 'Team Member Content', 'masterelements')
  			]
  		);


		$this->add_control(
			'master_member_name',
			[
				'label' => esc_html__( 'Name', 'masterelements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'John Doe', 'masterelements'),
			]
		);
		
		$this->add_control(
			'master_member_job_title',
			[
				'label' => esc_html__( 'Job Position', 'masterelements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Software Engineer', 'masterelements'),
			]
		);
		$this->add_control(
			'master_team_member_description',
			[
				'label' => esc_html__( 'Description', 'masterelements'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Add team member description here. Remove the text if not necessary.', 'essential-addons-for-elementor-lite'),
			]
		);

		$this->end_controls_section();


  		$this->start_controls_section(
  			'master_section_member_social_profiles',
  			[
  				'label' => esc_html__( 'Social Profiles', 'masterelements')
  			]
  		);

		$this->add_control(
			'master_display_member_social_profiles',
			[
				'label' => esc_html__( 'Display Social Profiles?', 'masterelements'),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
		
		$this->add_control(
			'master_member_social_profile_links',
			[
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'master_display_member_social_profiles!' => '',
				],
				'default' => [
					[
						'social_new' => [
							'value' => 'fab fa-facebook',
							'library' => 'fa-brands'
						]
					],
					[
						'social_new' => [
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands'
						]
					],
					[
						'social_new' => [
							'value' => 'fab fa-google-plus',
							'library' => 'fa-brands'
						]
					],
					[
						'social_new' => [
							'value' => 'fab fa-linkedin',
							'library' => 'fa-brands'
						]
					],
				],
				'fields' => [
					[
						'name' => 'social_new',
						'label' => esc_html__( 'Icon', 'masterelements'),
						'type' => Controls_Manager::ICONS,
						'fa4compatibility' => 'social',
						'default' => [
							'value' => 'fab fa-wordpress',
							'library' => 'fa-brands',
						],
					],
					[
						'name' => 'link',
						'label' => esc_html__( 'Link', 'masterelements'),
						'type' => Controls_Manager::URL,
						'label_block' => true,
						'default' => [
							'url' => '',
							'is_external' => 'true',
						],
						'placeholder' => esc_html__( 'Place URL here', 'masterelements'),
					],
				],
				'title_field' => '<i class="{{ social_new.value }}"></i>',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'master_section_member_image_styles',
			[
				'label' => esc_html__( 'Team Member Image Style', 'masterelements'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);		

		$this->add_responsive_control(
			'master_member_image_width',
			[
				'label' => esc_html__( 'Image Width', 'masterelements'),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}} .me-team-item figure img' => 'width:{{SIZE}}{{UNIT}};',
				]
			]
		);



		$this->add_responsive_control(
			'master_memeber_image_margin',
			[
				'label' => esc_html__( 'Margin', 'masterelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .me-team-item figure img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'master_member_image_padding',
			[
				'label' => esc_html__( 'Padding', 'masterelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .me-team-item figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'master_team_members_image_border',
				'label' => esc_html__( 'Border', 'masterelements'),
				'selector' => '{{WRAPPER}} .me-team-item figure img',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'master_section_member_content_styles',
			[
				'label' => esc_html__( 'Team Member Content Styles', 'masterelements'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$team_member_style_presets_options = apply_filters('master_member_style_preset', [
			
			'me-team-members-overlay'       => esc_html__( 'Overlay Style', 	'masterelements' ),
		]);

		$this->add_control(
			'master_member_preset',
			[
				'label'   => esc_html__( 'Style Preset', 'masterelements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'me-team-members-overlay',
				'options' => $team_member_style_presets_options
			]
		);

		$this->add_control(
			'master_content_card_style',
			[
				'label' => __( 'Content Card', 'masterelements'),
				'type' => Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);


		

		$this->add_control(
			'master_image_overlay_background',
			[
				'label' => esc_html__( 'Overlay Color', 'masterelements'),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(255,255,255,0.8)',
				'selectors' => [
					'{{WRAPPER}} .me-team-members-overlay .me-team-content' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'master_member_preset' => 'me-team-members-overlay',
				],
			]
		);


		$this->add_control(
			'master_content_horizontal_alignment',
			[
				'label' => esc_html__( 'Horizontal Alignment', 'masterelements'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'default' => [
						'title' => __( 'Default', 'masterelements'),
						'icon' => 'fa fa-ban',
					],
					'left' => [
						'title' => esc_html__( 'Left', 'masterelements'),
						'icon' => 'fa fa-align-left',
					],
					'centered' => [
						'title' => esc_html__( 'Center', 'masterelements'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'masterelements'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'me-team-align-default',
				'prefix_class' => 'me-team-align-',
			]
		);

		$this->add_control(
			'master_content_vertical_alignment',
			[
				'label' => __( 'Vertical Alignment', 'masterelements' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top' => __( 'Top', 'masterelements' ),
					'middle' => __( 'Middle', 'masterelements' ),
					'bottom' => __( 'Bottom', 'masterelements' ),
				],
				'default' => 'top',
				'prefix_class' => 'me-team-vertical-align-',
			]
		);


		$this->add_responsive_control(
			'master_description_padding',
			[
				'label' => esc_html__( 'Description Overlay Padding', 'masterelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .me-team-item .me-team-content .me-team-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'master_border_padding',
			[
				'label' => esc_html__( 'Border Padding', 'masterelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .me-team-content .me-team-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'master_content_name_box_padding',
			[
				'label' => esc_html__( 'Name Text Padding', 'masterelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .me-team-item .me-team-member-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'master_content_job_box_padding',
            [
                'label' => esc_html__( 'Job Text Padding', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [

                    '{{WRAPPER}} .me-team-item .me-team-member-position' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'master_content_name_box_margin',
			[
				'label' => esc_html__( 'Name Text Margin', 'masterelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .me-team-item .me-team-member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);
		$this->add_responsive_control(
            'master_content_text_box_margin',
            [
                'label' => esc_html__( 'Job Text Margin', 'masterelements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .me-team-item .me-team-member-position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'master_member_description_border',
				'label' => esc_html__( 'Description Text Border', 'masterelements'),
				'selector' => '{{WRAPPER}} .me-team-item .me-team-text',
			]
		);

		$this->add_control(
			'master_member_description_border-radius',
			[
				'label' => esc_html__( 'Border Radius', 'masterelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .me-team-item .me-team-text' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'master_section_member_content_color_typography',
			[
				'label' => esc_html__( 'Color &amp; Typography', 'masterelements'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'master_member_name_heading',
			[
				'label' => __( 'Member Name', 'masterelements'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'master_member_name_color',
			[
				'label' => esc_html__( 'Member Name Color', 'masterelements'),
				'type' => Controls_Manager::COLOR,
				'default' => '#272727',
				'selectors' => [
					'{{WRAPPER}} .me-team-item .me-team-member-name' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'master_memebr_name_typography',
				'selector' => '{{WRAPPER}} .me-team-item .me-team-member-name',
			]
		);

		$this->add_control(
			'master_member_name_heading_position',
			[
				'label' => __( 'Member Job Position', 'masterelements'),
				'type' => Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

		$this->add_control(
			'master_member_position_color',
			[
				'label' => esc_html__( 'Job Position Color', 'masterelements'),
				'type' => Controls_Manager::COLOR,
				'default' => '#272727',
				'selectors' => [
					'{{WRAPPER}} .me-team-item .me-team-member-position' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'master_member_position_typography',
				'selector' => '{{WRAPPER}} .me-team-item .me-team-member-position',
			]
		);

		$this->add_control(
			'master_member_description_heading',
			[
				'label' => __( 'Member Description', 'masterelements'),
				'type' => Controls_Manager::HEADING,
				'separator'	=> 'before'
			]
		);

		$this->add_control(
			'master_member_description_color',
			[
				'label' => esc_html__( 'Description Color', 'masterelements'),
				'type' => Controls_Manager::COLOR,
				'default' => '#272727',
				'selectors' => [
					'{{WRAPPER}} .me-team-item .me-team-content .me-team-text' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'master_member_description_typography',
				'selector' => '{{WRAPPER}} .me-team-item .me-team-content .me-team-text',
			]
		);

		$this->end_controls_section();

		
		$this->start_controls_section(
			'master_member_section_social_profile_styles',
			[
				'label' => esc_html__( 'Social Profiles Style', 'masterelements'),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);		


		$this->add_control(
			'master_member_section_social_icon_styles',
			[
				'label' => esc_html__( 'Icon Size', 'masterelements'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default'	=> [
					'size'	=> 35,
					'unit'	=> 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .me-team-member-social-link > a i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .me-team-member-social-link > a img' => 'width: {{SIZE}}px; height: {{SIZE}}px; line-height: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'master_member_section_social_profiles_padding',
			[
				'label' => esc_html__( 'Social Profiles Padding', 'masterelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .me-team-content > .me-team-member-social-profiles' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'master_team_member_icon_spacing',
			[
				'label'      => esc_html__( 'Social Icon Spacing', 'masterelements'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .me-team-content > .me-team-member-social-profiles li.me-team-member-social-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'master_social_icon_style_tabs' );

		$this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'masterelements') ] );

		$this->add_control(
			'master_social_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'masterelements'),
				'type' => Controls_Manager::COLOR,
				'default' => '#f1ba63',
				'selectors' => [
					'{{WRAPPER}} .me-team-member-social-link > a' => 'color: {{VALUE}};',
				],
			]
		);
		
		
		$this->add_control(
			'master_member_social_icon_background',
			[
				'label' => esc_html__( 'Background Color', 'masterelements'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .me-team-member-social-link > a' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'master_member_social_icon_border',
				'selector' => '{{WRAPPER}} .me-team-member-social-link > a',
			]
		);
		
		$this->add_control(
			'master_member_social_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'masterelements'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .me-team-member-social-link > a' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
             'name' => 'master_member_social_icon_typography',
				'selector' => '{{WRAPPER}} .me-team-member-social-link > a',
			]
		);

		
		$this->end_controls_tab();

		$this->start_controls_tab( 'master_social_icon_hover', [ 'label' => esc_html__( 'Hover', 'masterelements') ] );

		$this->add_control(
			'master_social_icon_hover_color',
			[
				'label' => esc_html__( 'Icon Hover Color', 'masterelements'),
				'type' => Controls_Manager::COLOR,
				'default' => '#ad8647',
				'selectors' => [
					'{{WRAPPER}} .me-team-member-social-link > a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'master_social_icon_hover_background',
			[
				'label' => esc_html__( 'Hover Background Color', 'masterelements'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .me-team-member-social-link > a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'master_social_icon_hover_border-color',
			[
				'label' => esc_html__( 'Hover Border Color', 'masterelements'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .me-team-member-social-link > a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();


		$this->end_controls_section();


	}


	protected function render( ) {
		
      $ms_settings = $this->get_settings();
	  $ms_team_member_image = $this->get_settings( 'master_image_team_member' );
	  
	  $ms_team_member_image_url = Group_Control_Image_Size::get_attachment_image_src( $ms_team_member_image['id'], 'thumbnail', $ms_settings );	
	  
	  if( empty( $ms_team_member_image_url ) ) 
	  {
		   $ms_team_member_image_url = $ms_team_member_image['url']; 
	  }
		else{
			$ms_team_member_image_url = $ms_team_member_image_url;
		}  
	  $member_classes = $this->get_settings('master_member_preset');
	
	?>


	<div id="me-team-member-<?php echo esc_attr($this->get_id()); ?>" class="me-team-item <?php echo $member_classes; ?>">
		<div class="me-team-item-inner">
			<div class="me-team-image">
				<figure>
					<img src="<?php echo esc_url($ms_team_member_image_url);?>" alt="<?php echo esc_attr( get_post_meta($ms_team_member_image['id'], '_wp_attachment_image_alt', true) ); ?>">
				</figure>
			</div>

			<div class="me-team-content">
			
			<p class="me-team-text"><?php echo $ms_settings['master_team_member_description']; ?></p>
			
			<?php if( 'me-team-members-social-bottom' === $ms_settings['master_member_preset'] )
			 { 
					do_action('ms/team_member_social_botton_markup', $ms_settings);
			 }
			 else{ ?>
					<?php 
					if ( ! empty( $ms_settings['master_display_member_social_profiles'] ) ):
					?>
					<ul class="me-team-member-social-profiles">
						<?php foreach ( $ms_settings['master_member_social_profile_links'] as $item ) : ?>
							
							<?php $icon = isset($item['__fa4_migrated']['social_new']);
							$new_icon = empty($item['social']); ?>
							
							<?php if ( ! empty( $item['social'] ) || !empty($item['social_new'])) : ?>
								
								<?php $target = $item['link']['is_external'] ? ' target="_blank"' : ''; ?>
								
								<li class="me-team-member-social-link">
									<a href="<?php echo esc_attr( $item['link']['url'] ); ?>" <?php echo $target; ?>>
										
									<?php if ($new_icon || $icon) { ?>
											
										<?php if( isset( $item['social_new']['value']['url'] ) ) : ?>
												<img src="<?php echo esc_attr($item['social_new']['value']['url'] ); ?>" alt="<?php echo esc_attr(get_post_meta($item['social_new']['value']['id'], '_wp_attachment_image_alt', true)); ?>" />
											
											<?php else : ?>
												<i class="<?php echo esc_attr($item['social_new']['value'] ); ?>"></i>
											
											<?php endif; ?>
										<?php } else { ?>
											<i class="<?php echo esc_attr($item['social'] ); ?>"></i>
										
										<?php } ?>
									</a>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				<?php } ?>	
			</div>
		</div>
		
	</div>
	
		<div class="me-team-item me-team-content">
					<h3 class="me-team-member-name"><?php echo $ms_settings['master_member_name']; ?></h3>
					<h4 class="me-team-member-position"><?php echo $ms_settings['master_member_job_title']; ?></h4>
				</div>
	
	<?php
	}
}