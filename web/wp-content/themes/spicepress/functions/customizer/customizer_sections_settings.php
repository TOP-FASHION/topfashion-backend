<?php
$repeater_path = trailingslashit( ST_TEMPLATE_DIR ) . '/functions/customizer-repeater/functions.php';
if ( file_exists( $repeater_path ) ) {
require_once( $repeater_path );
}
/**
 * Customize for taxonomy with dropdown, extend the WP customizer
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
	return NULL;

function spicepress_sections_settings( $wp_customize ){
	
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	

/* Sections Settings */
	$wp_customize->add_panel( 'section_settings', array(
		'priority'       => 126,
		'capability'     => 'edit_theme_options',
		'title'      => esc_html__('Homepage section settings','spicepress'),
	) );
	
	//Latest News Section
	$wp_customize->add_section('spicepress_latest_news_section',array(
			'title' => esc_html__('Latest News settings','spicepress'),
			'panel' => 'section_settings',
			'priority'       => 8,
			));
		
			
			// Enable news section
			$wp_customize->add_setting( 'latest_news_section_enable' , array( 'default' => 'on',  'sanitize_callback' => 'spicepress_sanitize_radio',) );
			$wp_customize->add_control(	'latest_news_section_enable' , array(
					'label'    => esc_html__( 'Enable Home News section', 'spicepress' ),
					'section'  => 'spicepress_latest_news_section',
					'type'     => 'radio',
					'choices' => array(
						'on'=>esc_html__('ON', 'spicepress'),
						'off'=>esc_html__('OFF', 'spicepress')
					)
			));

		// News section title
		$wp_customize->add_setting( 'home_news_section_title',array(
		'capability'     => 'edit_theme_options',
		'default' => esc_html__('Latest News','spicepress'),
		'sanitize_callback' => 'spicepress_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_news_section_title',array(
		'label'   => esc_html__('Title','spicepress'),
		'section' => 'spicepress_latest_news_section',
		'type' => 'text',
		));	
		
		//News section discription
		$wp_customize->add_setting( 'home_news_section_discription',array(
		'default'=> 'Sea summo mazim ex, ea errem eleifend definitionem vim. Ut nec hinc dolor possim mei ludus efficiendi ei sea summo mazim ex.',
		'transport'         => $selective_refresh,
		'sanitize_callback' => 'wp_filter_nohtml_kses',
		));	
		$wp_customize->add_control( 'home_news_section_discription',array(
		'label'   => esc_html__('Description','spicepress'),
		'section' => 'spicepress_latest_news_section',
		'type' => 'textarea',
		));	
		
		
		// enable / disable meta section 
		$wp_customize->add_setting(
			'blog_meta_section_enable',
			array('capability'  => 'edit_theme_options',
			'default' => true,
			'sanitize_callback' => 'spicepress_sanitize_checkbox',
			
			));
		$wp_customize->add_control(
			'blog_meta_section_enable',
			array(
				'type' => 'checkbox',
				'label' => esc_html__('Enable post meta values, like author name, date, comments, etc.','spicepress'),
				'section' => 'spicepress_latest_news_section',
			)
		);
		
			
}
add_action( 'customize_register', 'spicepress_sections_settings' );

/**
 * Add selective refresh for Front page section section controls.
 */
function spicepress_register_home_section_partials( $wp_customize ){

	
	//News
	$wp_customize->selective_refresh->add_partial( 'home_news_section_title', array(
		'selector'            => '.home-news .section-header .widget-title',
		'settings'            => 'home_news_section_title',
		'render_callback'  => 'spicepress_home_news_section_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_news_section_discription', array(
		'selector'            => '.home-news .section-header p',
		'settings'            => 'home_news_section_discription',
		'render_callback'  => 'spicepress_home_news_section_discription_render_callback',
	
	) );
	

}

add_action( 'customize_register', 'spicepress_register_home_section_partials' );


function spicepress_home_news_section_title_render_callback() {
	return get_theme_mod( 'home_news_section_title' );
}

function spicepress_home_news_section_discription_render_callback() {
	return get_theme_mod( 'home_news_section_discription' );
}

function spicepress_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function spicepress_sanitize_radio( $input, $setting ){
         
            //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
            $input = sanitize_key($input);
 
            //get the list of possible radio box options 
            $choices = $setting->manager->get_control( $setting->id )->choices;
                             
            //return input if valid or return default option
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
             
        }
