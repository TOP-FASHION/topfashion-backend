<?php
if ( ! function_exists( 'spiceb_spicepress_service_customize_register' ) ) :
function spiceb_spicepress_service_customize_register($wp_customize){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
	
/* Services section */
	$wp_customize->add_section( 'services_section' , array(
		'title'      => __('Service settings', 'spicepress'),
		'panel'  => 'section_settings',
		'priority'   => 1,
	) );
		
		
		// Enable service more btn
		$wp_customize->add_setting( 'home_service_section_enabled' , array( 'default' => 'on') );
		$wp_customize->add_control(	'home_service_section_enabled' , array(
				'label'    => __( 'Enable Services on homepage', 'spicepress' ),
				'section'  => 'services_section',
				'type'     => 'radio',
				'choices' => array(
					'on'=>__('ON', 'spicepress'),
					'off'=>__('OFF', 'spicepress')
				)
		));
		
		
		// Service section title
		$wp_customize->add_setting( 'home_service_section_title',array(
		'capability'     => 'edit_theme_options',
		'default' => __('What we Offer?','spicepress'),
		'sanitize_callback' => 'spiceb_spicepress_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_service_section_title',array(
		'label'   => __('Title','spicepress'),
		'section' => 'services_section',
		'type' => 'text',
		));	
		
		//room section discription
		$wp_customize->add_setting( 'home_service_section_discription',array(
		'capability'     => 'edit_theme_options',
		'default' => 'Sea summo mazim ex, ea errem eleifend definitionem vim. Ut nec hinc dolor possim mei ludus efficiendi ei sea summo mazim ex.',
		'sanitize_callback' => 'spiceb_spicepress_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_service_section_discription',array(
		'label'   => __('Description','spicepress'),
		'section' => 'services_section',
		'type' => 'textarea',
		));	
		
		if ( class_exists( 'Spicepress_Repeater' ) ) {
			$wp_customize->add_setting( 'spicepress_service_content', array(
			) );

			$wp_customize->add_control( new Spicepress_Repeater( $wp_customize, 'spicepress_service_content', array(
				'label'                             => esc_html__( 'Service content', 'spicepress' ),
				'section'                           => 'services_section',
				'priority'                          => 10,
				'add_field_label'                   => esc_html__( 'Add new Service', 'spicepress' ),
				'item_name'                         => esc_html__( 'Service', 'spicepress' ),
				'customizer_repeater_icon_control'  => true,
				'customizer_repeater_title_control' => true,
				'customizer_repeater_text_control'  => true,
				'customizer_repeater_link_control'  => true,
				'customizer_repeater_checkbox_control' => true,
				'customizer_repeater_image_control' => true,
				) ) );
		}	
	
}

add_action( 'customize_register', 'spiceb_spicepress_service_customize_register' );
endif;


/**
 * Add selective refresh for Front page section section controls.
 */
function spiceb_spicepress_register_home_service_section_partials( $wp_customize ){

	//Slider section
	$wp_customize->selective_refresh->add_partial( 'spicepress_service_content', array(
		'selector'            => '.service-section #service_content_section',
		'settings'            => 'spicepress_service_content',
	
	) );
	
	
	//Slider section
	$wp_customize->selective_refresh->add_partial( 'home_service_section_title', array(
		'selector'            => '.service-section .section-header .widget-title',
		'settings'            => 'home_service_section_title',
		'render_callback'  => 'spiceb_spicepress_service_section_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_service_section_discription', array(
		'selector'            => '.service-section .section-header p',
		'settings'            => 'home_service_section_discription',
		'render_callback'  => 'spiceb_spicepress_service_section_discription_render_callback',
	
	) );
	
}

add_action( 'customize_register', 'spiceb_spicepress_register_home_service_section_partials' );


function spiceb_spicepress_service_section_title_render_callback() {
	return get_theme_mod( 'home_service_section_title' );
}

function spiceb_spicepress_service_section_discription_render_callback() {
	return get_theme_mod( 'home_service_section_discription' );
}
?>