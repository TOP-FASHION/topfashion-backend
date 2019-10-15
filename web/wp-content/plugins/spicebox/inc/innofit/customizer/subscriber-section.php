<?php
// Subscriber section settings
	$wp_customize->add_section('home_subscriber_section',array(
	'title'=>'Subscriber section settings',
	'description'=>'',
	'panel'  => 'section_settings',
	'priority' => 14,
	));
	
	
		// Subscribe Section Tabs
		$wp_customize->add_setting(
			'innofit_subscribe_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Innofit_Customize_Control_Tabs(
				$wp_customize, 'innofit_subscribe_tabs', array(
					'section' => 'home_subscriber_section',
					'tabs'    => array(
						'general'    => array(
							'nicename' => esc_html__( 'General Settings', 'spicebox' ),
							'controls' => array(
								'innofit_subscribe_hide',
								'innofit_subscribe_background',
								'subscribe_image_overlay',
								'subscribe_overlay_section_color',
								'innofit_subscribe_title',
								'innofit_subscribe_subtitle',
								'widgets',
							),
						),
						'sendinblue' => array(
							'nicename' => esc_html__( 'SendinBlue plugin', 'spicebox' ),
							'controls' => array(
								'innofit_subscribe_info',
							),
						),
					),
				)
			)
		);
		
		
		// Subscriber section enable / disable
		$wp_customize->add_setting( 'innofit_subscribe_hide' , array( 'default' => 'on') );
		$wp_customize->add_control(	'innofit_subscribe_hide' , array(
				'label'    => __( 'Enable Suscribe section', 'spicebox' ),
				'section'  => 'home_subscriber_section',
				'type'     => 'radio',
				'priority' => 1,
				'choices' => array(
					'on'=>__('ON', 'spicebox'),
					'off'=>__('OFF', 'spicebox')
				)
		));


	$wp_customize->add_setting(
		'innofit_subscribe_background', array(
			'default'           => SPICEB_PLUGIN_URL . 'inc/innofit/images/subscribe/subscribe-bg.jpg',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'innofit_subscribe_background', array(
				'label'    => esc_html__( 'Background Image', 'spicebox' ),
				'section'  => 'home_subscriber_section',
				'priority' => 5,
			)
		)
	);
	
		// Image overlay
		$wp_customize->add_setting( 'subscribe_image_overlay', array(
			'default' => true,
			'sanitize_callback' => '',
		) );
		
		$wp_customize->add_control('subscribe_image_overlay', array(
			'label'    => __('Enable susbcribe image overlay', 'spicebox' ),
			'section'  => 'home_subscriber_section',
			'type' => 'checkbox',
			'priority' => 6,
		) );
		
		
		//Susbcribe Background Overlay Color
		$wp_customize->add_setting( 'subscribe_overlay_section_color', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'rgba(0, 11, 24, 0.80)',
            ) );	
            
            $wp_customize->add_control(new Innofit_Customize_Alpha_Color_Control( $wp_customize,'subscribe_overlay_section_color', array(
               'label'      => __('Subscribe image overlay color','spicebox' ),
                'palette' => true,
				'priority' => 7,
                'section' => 'home_subscriber_section')
		) );
		
		$wp_customize->add_setting(
		'innofit_subscribe_title', array(
			'default'           => esc_html__( 'Subscribe to our newsletter', 'spicebox' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'innofit_subscribe_title', array(
			'label'    => esc_html__( 'Title', 'spicebox' ),
			'section'  => 'home_subscriber_section',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'innofit_subscribe_subtitle', array(
			'default'           => esc_html__( 'Sign up now for more information about our company.', 'spicebox' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'innofit_subscribe_subtitle', array(
			'label'    => esc_html__( 'Description', 'spicebox' ),
			'section'  => 'home_subscriber_section',
			'priority' => 15,
		)
	);
	if ( class_exists( 'Innofit_Subscribe_Info' ) ) {
		$wp_customize->add_setting(
			'innofit_subscribe_info', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Innofit_Subscribe_Info(
				$wp_customize, 'innofit_subscribe_info', array(
					'label'      => esc_html__( 'Instructions', 'spicebox' ),
					'section'    => 'home_subscriber_section',
					'capability' => 'install_plugins',
					'priority'   => 20,
				)
			)
		);
	}
	
	
	/**
	* Add selective refresh for Front page subscribe section controls.
	*/
	
	
	$wp_customize->selective_refresh->add_partial( 'innofit_subscribe_title', array(
		'selector'            => '.subscribe-newsletter .section-title',
		'settings'            => 'innofit_subscribe_title',
		'render_callback'  => 'subscribe_title_content_render_callback',
	
	) );


	$wp_customize->selective_refresh->add_partial( 'innofit_subscribe_subtitle', array(
		'selector'            => '.subscribe-newsletter .section-subtitle',
		'settings'            => 'innofit_subscribe_subtitle',
		'render_callback'  => 'subscribe_subtitle_content_render_callback',
	
	) );
			

?>