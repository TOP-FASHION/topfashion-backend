<?php
$wp_customize->add_section( 'testimonial_section' , array(
			'title'      => __('Testimonials settings', 'spicebox'),
			'panel'  => 'section_settings',
			'priority'   => 7,
		) );
		
		// Enable testimonial section
		$wp_customize->add_setting( 'testimonial_section_enable' , array( 'default' => 'on') );
		$wp_customize->add_control(	'testimonial_section_enable' , array(
				'label'    => __( 'Enable Home Testimonial section', 'spicebox' ),
				'section'  => 'testimonial_section',
				'type'     => 'radio',
				'choices' => array(
					'on'=>__('ON', 'spicebox'),
					'off'=>__('OFF', 'spicebox')
				)
		));
		
		
		
		
		//Testimonial Background Image
			$wp_customize->add_setting( 'testimonial_callout_background', array(
			  'sanitize_callback' => 'esc_url_raw',
			) );
			
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'testimonial_callout_background', array(
			  'label'    => __( 'Background Image', 'spicebox' ),
			  'section'  => 'testimonial_section',
			  'settings' => 'testimonial_callout_background',
			) ) );
			
		// Image overlay
		$wp_customize->add_setting( 'testimonial_image_overlay', array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control('testimonial_image_overlay', array(
			'label'    => __('Enable testimonial image overlay', 'spicebox' ),
			'section'  => 'testimonial_section',
			'type' => 'checkbox',
		) );
		
		
		//Testimonial Background Overlay Color
		$wp_customize->add_setting( 'testimonial_overlay_section_color', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'rgba(0, 11, 24, 0.80)',
            ) );	
            
            $wp_customize->add_control(new Innofit_Customize_Alpha_Color_Control( $wp_customize,'testimonial_overlay_section_color', array(
               'label'      => __('Testimonial image overlay color','spicebox' ),
                'palette' => true,
                'section' => 'testimonial_section')
            ) );
			
		
		// testimonial section title
		$wp_customize->add_setting( 'home_testimonial_section_title',array(
		'capability'     => 'edit_theme_options',
		'default' => __('What our clients say','spicebox'),
		'sanitize_callback' => 'innofit_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_testimonial_section_title',array(
		'label'   => __('Title','spicebox'),
		'section' => 'testimonial_section',
		'type' => 'text',
		));	
		
		//testimonial section discription
		$wp_customize->add_setting( 'home_testimonial_section_discription',array(
		'capability'     => 'edit_theme_options',
		'default'=> __('We provide best WordPress solutions for your business.','spicebox'),
		'sanitize_callback' => 'innofit_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_testimonial_section_discription',array(
		'label'   => __('Description','spicebox'),
		'section' => 'testimonial_section',
		'type' => 'textarea',
		));
		
		if ( class_exists( 'Innofit_Repeater' ) ) {
			$wp_customize->add_setting( 'innofit_testimonial_content', array(
			) );

			$wp_customize->add_control( new Innofit_Repeater( $wp_customize, 'innofit_testimonial_content', array(
				'label'                             => esc_html__( 'Testimonial content', 'spicebox' ),
				'section'                           => 'testimonial_section',
				'add_field_label'                   => esc_html__( 'Add new Testimonial', 'spicebox' ),
				'item_name'                         => esc_html__( 'Testimonial', 'spicebox' ),
				'customizer_repeater_title_control' => true,
				'customizer_repeater_text_control'  => true,
				'customizer_repeater_link_control'  => true,
				'customizer_repeater_checkbox_control' => true,
				'customizer_repeater_image_control' => true,
				'customizer_repeater_designation_control' => true,
				) ) );
		}

		
	/**
	* Add selective refresh for Front page testimonial section controls.
	*/
	
	$wp_customize->selective_refresh->add_partial( 'home_testimonial_section_title', array(
		'selector'            => '.testimonial-wrapper .section-title',
		'settings'            => 'home_testimonial_section_title',
		'render_callback'  => 'home_testimonial_section_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_testimonial_section_discription', array(
		'selector'            => '.testimonial-wrapper .section-subtitle',
		'settings'            => 'home_testimonial_section_discription',
		'render_callback'  => 'home_testimonial_section_discription_render_callback',
	
	) );

?>