<?php
$repeater_path = trailingslashit( INNOFIT_TEMPLATE_DIR ) . '/functions/customizer-repeater/functions.php';
if ( file_exists( $repeater_path ) ) {
require_once( $repeater_path );
}

$page_editor_path = trailingslashit( INNOFIT_TEMPLATE_DIR ) . 'functions/customizer/customizer-page-editor/customizer-page-editor.php';
if ( file_exists( $page_editor_path ) ) {
	require_once( $page_editor_path );
}
/**
 * Customize for taxonomy with dropdown, extend the WP customizer
 */

if ( ! class_exists( 'WP_Customize_Control' ) )
return NULL;

function innofit_sections_settings( $wp_customize ){
	
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	

/* Sections Settings */
	$wp_customize->add_panel( 'section_settings', array(
		'priority'       => 126,
		'capability'     => 'edit_theme_options',
		'title'      => esc_html__('Homepage section settings', 'innofit'),
	) );
}
add_action( 'customize_register', 'innofit_sections_settings' );

function innofit_home_page_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

function innofit_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function innofit_sanitize_radio( $input, $setting ){
         
            //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
            $input = sanitize_key($input);
 
            //get the list of possible radio box options 
            $choices = $setting->manager->get_control( $setting->id )->choices;
                             
            //return input if valid or return default option
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
             
}