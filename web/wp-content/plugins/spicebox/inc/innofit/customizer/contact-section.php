<?php
	// contact form section settings
	$wp_customize->add_section('home_contactform_section',array(
	'title'=>'Contact form section settings',
	'description'=>'',
	'panel'  => 'section_settings',
	'priority' => 13,
	));
	
	
		$wp_customize->add_setting( 'contact_form_enable' , array( 'default' => 'on') );
		$wp_customize->add_control(	'contact_form_enable' , array(
					'label'    => __( 'Enable Contact form section', 'spicebox' ),
					'section'  => 'home_contactform_section',
					'type'     => 'radio',
					'choices' => array(
						'on'=>__('ON', 'spicebox'),
						'off'=>__('OFF', 'spicebox')
					)
			));
			
		//Contact form section Background Image
		$wp_customize->add_setting( 'contact_form_background', array('default' =>    get_template_directory_uri().'/images/testimonial-bg.jpg',
			  'sanitize_callback' => 'esc_url_raw',
			) );
			
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'contact_form_background', array(
			  'label'    => __( 'Background Image', 'spicebox' ),
			  'section'  => 'home_contactform_section',
			  'settings' => 'contact_form_background',
			) ) );
			
		// Image overlay
		$wp_customize->add_setting( 'contact_form_image_overlay', array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control('contact_form_image_overlay', array(
			'label'    => __('Enable Contact image overlay', 'spicebox' ),
			'section'  => 'home_contactform_section',
			'type' => 'checkbox',
		) );
		
		
		//Testimonial Background Overlay Color
		$wp_customize->add_setting( 'contact_overlay_section_color', array(
			'default' => 'rgba(250, 250, 250, 0.95)',
            ) );	
            
            $wp_customize->add_control(new Innofit_Customize_Alpha_Color_Control( $wp_customize,'contact_overlay_section_color', array(
               'label'      => __('Contact image overlay color','spicebox' ),
                'palette' => true,
                'section' => 'home_contactform_section')
            ) );
			
			
		
		
		// contact form title
		$wp_customize->add_setting('contact_form_title_one',array(
		'capability'  => 'edit_theme_options',
		'default' => __('Send us a message','spicebox'),
		'sanitize_callback' => 'innofit_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('contact_form_title_one',array(
		'label' => __('Contact form title one','spicebox'),
		'section' => 'home_contactform_section',
		'type' => 'text',
		));

		// Contact title
		$wp_customize->add_setting('contact_form_title_two',array(
		'capability'  => 'edit_theme_options',
		'default' => __('Contact Us','spicebox'),
		'sanitize_callback' => 'innofit_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('contact_form_title_two',array(
		'label' => __('Contact form title two','spicebox'),
		'section' => 'home_contactform_section',
		'type' => 'text',
		));
		
		// Contact form 7 shortcode
		$wp_customize->add_setting('contact_form_shortcode',array(
		'capability'  => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		));
		$wp_customize->add_control('contact_form_shortcode',array(
		'label' => __('Contact Form shortcode','spicebox'),
		'section' => 'home_contactform_section',
		'type' => 'textarea',
		));
		
		
		// contact info enable / disable
		$wp_customize->add_setting('contact_info_enable',array(
		'default'=>true,
		'capability'  => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		));
		$wp_customize->add_control('contact_info_enable',array(
		'label' => __('Enable contact info','spicebox'),
		'section' => 'home_contactform_section',
		'type' => 'checkbox',
		));	
		
		//Contact section content
		if ( class_exists( 'Innofit_Page_Editor' ) ) {
		$default = '<h2 class="title">'. esc_html__( 'Get in touch','spicebox').'</h2><aside class="contact-widget"><div class="media"><div class="contact-icon"><i class="fa fa-map-marker"></i></div><div class="media-body"><h3 class="title"> ' . esc_html__( 'Find Us','spicebox').' </h3><address> ' . esc_html__( 'Porterfield 508 Virginia Street Chicago,<br> IL 60653 (USA)','spicebox').'</address></div></div></aside><aside class="contact-widget"><div class="media"><div class="contact-icon"><i class="fa fa-mobile"></i></div><div class="media-body"><h3 class="title">' . esc_html__( 'Phone','spicebox').'</h3><address>' . esc_html__( 'Mobile: (+91) 90 1900 - 6886 <br>Hotline: 1800 6886)','spicebox').'</address></div></div></aside><aside class="contact-widget"><div class="media"><div class="contact-icon"><i class="fa fa-envelope-o"></i></div><div class="media-body"><h3 class="title">'.esc_html__( 'Email','spicebox').'</h3><address><a href="mailto:suppor@tinnofit.com">' .esc_html__( 'support@innofit.com','spicebox').'</a><a href="mailto:contact@innofit.com"> '. esc_html__( 'contact@innofit.com','spicebox').'</a></address></div></div></aside>';
		$wp_customize->add_setting(
			'contact_info_content', array(
				'default'           => $default,
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			new Innofit_Page_Editor(
				$wp_customize, 'contact_info_content', array(
					'label'    => esc_html__( 'Contact Info content', 'spicebox' ),
					'section'  => 'home_contactform_section',
					'priority' => 10,
					'needsync' => true,
				)
			)
		);
	}
	
	
	/**
	* Add selective refresh for Front page contact section controls.
	*/
	 
	 
	$wp_customize->selective_refresh->add_partial( 'contact_form_title_one', array(
		'selector'            => '.contact .contact-form .subtitle',
		'settings'            => 'contact_form_title_one',
		'render_callback'  => 'contact_form_title_one_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'contact_form_title_two', array(
		'selector'            => '.contact .contact-form .title',
		'settings'            => 'contact_form_title_two',
		'render_callback'  => 'contact_form_title_two_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'contact_info_content', array(
		'selector'            => '.contact .contact-info h2',
		'settings'            => 'contact_info_content',
		'render_callback'  => 'contact_info_content_render_callback',
	
	) ); 
	 
	 

?>