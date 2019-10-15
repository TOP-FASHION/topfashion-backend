<?php
//Callout Section
		$wp_customize->add_section('home_cta_page_section',array(
		'title' => __('Callout section settings','spicebox'),
		'panel' => 'section_settings',
		'priority'       => 15,
		));
		
			// Enable call to action section
			$wp_customize->add_setting( 'cta_section_enable' , array( 'default' => 'on') );
			$wp_customize->add_control(	'cta_section_enable' , array(
					'label'    => __( 'Enable Home Callout section', 'spicebox' ),
					'section'  => 'home_cta_page_section',
					'type'     => 'radio',
					'choices' => array(
						'on'=>__('ON', 'spicebox'),
						'off'=>__('OFF', 'spicebox')
					)
			));
			
			$wp_customize->add_setting(
			'home_call_out_title',
			array(
				'default' => __('We create beautiful WordPress themes for you!','spicebox'),
				'transport'         => $selective_refresh,
				)
			);	
			$wp_customize->add_control( 'home_call_out_title',array(
			'label'   => __('Title','spicebox'),
			'section' => 'home_cta_page_section',
			 'type' => 'text',)  );
			 
			 $wp_customize->add_setting(
			'home_call_out_desc',
			array(
				'default' => __('Choose a package that suits all your needs to build a website.','spicebox'),
				'transport'         => $selective_refresh,
				)
			);	
			$wp_customize->add_control( 'home_call_out_desc',array(
			'label'   => __('Description','spicebox'),
			'section' => 'home_cta_page_section',
			 'type' => 'textarea',)  );
			 
			 
			 $wp_customize ->add_setting (
			'home_call_out_btn_text',
			array( 
			'default' => __('Buy Innofit','spicebox'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
			
			) 
			);

			$wp_customize->add_control (
			'home_call_out_btn_text',
			array (  
			'label' => __('Button Text','spicebox'),
			'section' => 'home_cta_page_section',
			'type' => 'text',
			) );
			
			
			
			$wp_customize->add_setting( 'home_call_out_btn_link',array(
			'default' => __('#','spicebox'),
			'sanitize_callback' => 'spiceb_innofit_home_page_sanitize_text',
			'transport'         => $selective_refresh,
			));	
			
			$wp_customize->add_control( 'home_call_out_btn_link',array(
			'label'   => __('Button Link','spicebox'),
			'section' => 'home_cta_page_section',
			'type' => 'text',
			));
			
			

			$wp_customize->add_setting(
				'home_call_out_btn_link_target',
				array('sanitize_callback' => 'sanitize_text_field',
				));

			$wp_customize->add_control(
				'home_call_out_btn_link_target',
				array(
					'type' => 'checkbox',
					'label' => __('Open link in new tab','spicebox'),
					'section' => 'home_cta_page_section',
				)
			);
		
		
    /**
	* Add selective refresh for Front page callout section controls.
	*/
	
	
	$wp_customize->selective_refresh->add_partial( 'home_call_out_title', array(
		'selector'            => '.call-to-action-one h4',
		'settings'            => 'home_call_out_title',
		'render_callback'  => 'home_call_out_title_render_callback',
	
	) );
	
	
	
	$wp_customize->selective_refresh->add_partial( 'home_call_out_desc', array(
		'selector'            => '.call-to-action-one p',
		'settings'            => 'home_call_out_desc',
		'render_callback'  => 'home_call_out_desc_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_call_out_btn_text', array(
		'selector'            => '.call-to-action-one .btn-small',
		'settings'            => 'home_call_out_btn_text',
		'render_callback'  => 'home_call_out_btn_text_render_callback',
	
	) );		
					
?>