<?php
//Team Section
	$wp_customize->add_section('innofit_team_section',array(
			'title' => __('Team settings','spicebox'),
			'panel' => 'section_settings',
			'priority'       => 8,
			));
		
			$wp_customize->add_setting( 'team_section_enable' , array( 'default' => 'on') );
			$wp_customize->add_control(	'team_section_enable' , array(
					'label'    => __( 'Enable Home Team section', 'spicebox' ),
					'section'  => 'innofit_team_section',
					'type'     => 'radio',
					'choices' => array(
						'on'=>__('ON', 'spicebox'),
						'off'=>__('OFF', 'spicebox')
					)
			));
			
			// Team section title
			$wp_customize->add_setting( 'home_team_section_title',array(
			'default' => __('Meet our superheroes','spicebox'),
			'sanitize_callback' => 'innofit_home_page_sanitize_text',
			'transport'         => $selective_refresh,
			));	
			$wp_customize->add_control( 'home_team_section_title',array(
			'label'   => __('Title','spicebox'),
			'section' => 'innofit_team_section',
			'type' => 'text',
			));	
			
			//Team section discription
			$wp_customize->add_setting( 'home_team_section_discription',array(
			'default'=> __('The best team available','spicebox'),
			'transport'         => $selective_refresh,
			));	
			$wp_customize->add_control( 'home_team_section_discription',array(
			'label'   => __('Description','spicebox'),
			'section' => 'innofit_team_section',
			'type' => 'textarea',
			));
			
			
			if ( class_exists( 'Innofit_Repeater' ) ) {
			$wp_customize->add_setting(
				'innofit_team_content', array(
				)
			);

			$wp_customize->add_control(
				new Innofit_Repeater(
					$wp_customize, 'innofit_team_content', array(
						'label'                            => esc_html__( 'Team content', 'spicebox' ),
						'section'                          => 'innofit_team_section',
						'priority'                         => 15,
						'add_field_label'                  => esc_html__( 'Add new Team Member', 'spicebox' ),
						'item_name'                        => esc_html__( 'Team Member', 'spicebox' ),
						'customizer_repeater_image_control' => true,
						'customizer_repeater_title_control' => true,
						'customizer_repeater_subtitle_control' => true,
						'customizer_repeater_link_control' => true,
						'customizer_repeater_checkbox_control' => true,
						'customizer_repeater_repeater_control' => true,
						
					)
				)
			);
		} 
	

    /**
	* Add selective refresh for Front page team section controls.
	*/
	
	
	$wp_customize->selective_refresh->add_partial( 'home_team_section_title', array(
		'selector'            => '.team-members .section-subtitle',
		'settings'            => 'home_team_section_title',
		'render_callback'  => 'home_team_section_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_team_section_discription', array(
		'selector'            => '.team-members .section-title',
		'settings'            => 'home_team_section_discription',
		'render_callback'  => 'home_team_section_discription_render_callback',
	
	) );

?>