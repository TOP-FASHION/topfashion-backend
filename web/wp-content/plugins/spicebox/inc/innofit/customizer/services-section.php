<?php
/* Services section */
	$wp_customize->add_section( 'services_section' , array(
		'title'      => __('Services settings', 'spicebox'),
		'panel'  => 'section_settings',
		'priority'   => 2,
	) );
		
		
		// Enable service more btn
		$wp_customize->add_setting( 'home_service_section_enabled' , array( 'default' => 'on') );
		$wp_customize->add_control(	'home_service_section_enabled' , array(
				'label'    => __( 'Enable Services on homepage', 'spicebox' ),
				'section'  => 'services_section',
				'type'     => 'radio',
				'choices' => array(
					'on'=>__('ON', 'spicebox'),
					'off'=>__('OFF', 'spicebox')
				)
		));
		
		
		// Service section title
		$wp_customize->add_setting( 'home_service_section_title',array(
		'capability'     => 'edit_theme_options',
		'default' => __('What we do','spicebox'),
		'sanitize_callback' => 'innofit_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_service_section_title',array(
		'label'   => __('Title','spicebox'),
		'section' => 'services_section',
		'type' => 'text',
		));	
		
		//Service section discription
		$wp_customize->add_setting( 'home_service_section_discription',array(
		'capability'     => 'edit_theme_options',
		'default' => __('Services we provide','spicebox'),
		'sanitize_callback' => 'innofit_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		
		
		$wp_customize->add_control( 'home_service_section_discription',array(
		'label'   => __('Description','spicebox'),
		'section' => 'services_section',
		'type' => 'textarea',
		));	
		
		if ( class_exists( 'Innofit_Repeater' ) ) {
			$wp_customize->add_setting( 'innofit_service_content', array(
			) );

			$wp_customize->add_control( new Innofit_Repeater( $wp_customize, 'innofit_service_content', array(
				'label'                             => esc_html__( 'Services content', 'spicebox' ),
				'section'                           => 'services_section',
				'priority'                          => 10,
				'add_field_label'                   => esc_html__( 'Add new Service', 'spicebox' ),
				'item_name'                         => esc_html__( 'Service', 'spicebox' ),
				'customizer_repeater_icon_control'  => true,
				'customizer_repeater_title_control' => true,
				'customizer_repeater_text_control'  => true,
				'customizer_repeater_link_control'  => true,
				'customizer_repeater_checkbox_control' => true,
				'customizer_repeater_image_control' => true,
				) ) );
		}
		
		
    /**
	* Add selective refresh for Front page service section controls.
	*/
		
		
	$wp_customize->selective_refresh->add_partial( 'home_service_section_title', array(
		'selector'            => '.services .section-header .section-title',
		'settings'            => 'home_service_section_title',
		'render_callback'  => 'innofit_home_service_section_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_service_section_discription', array(
		'selector'            => '.services .section-header .section-subtitle',
		'settings'            => 'home_service_section_discription',
		'render_callback'  => 'innofit_home_service_section_discription_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'innofit_service_content', array(
		'selector'            => '.services #service_content',
		'settings'            => 'innofit_service_content',
	) );
	
	

?>