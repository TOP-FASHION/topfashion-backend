<?php

// Global variables define
define('CERTIFY_PARENT_TEMPLATE_DIR_URI',get_template_directory_uri());	
define('CERTIFY_ST_TEMPLATE_DIR_URI',get_stylesheet_directory_uri());
define('CERTIFY_ST_TEMPLATE_DIR',get_stylesheet_directory());

add_action( 'wp_enqueue_scripts', 'certify_theme_css',999);
function certify_theme_css() {
    wp_enqueue_style( 'certify-parent-style', CERTIFY_PARENT_TEMPLATE_DIR_URI . '/style.css' );
	wp_enqueue_style('bootstrap', ST_TEMPLATE_DIR . '/css/bootstrap.css');
	wp_enqueue_style('certify-child-style',CERTIFY_ST_TEMPLATE_DIR_URI . '/style.css',array('parent-style'));
	wp_enqueue_style('certify-theme-menu-style', CERTIFY_ST_TEMPLATE_DIR_URI .'/css/theme-menu.css');
	wp_enqueue_style('certify-default-style-css', CERTIFY_ST_TEMPLATE_DIR_URI ."/css/default.css" );
	wp_enqueue_style('certify-media-responsive-css', CERTIFY_ST_TEMPLATE_DIR_URI ."/css/media-responsive.css" );

}



if ( ! function_exists( 'certify_theme_setup' ) ) :

function certify_theme_setup() {

//Load text domain for translation-ready
load_theme_textdomain( 'certify', CERTIFY_ST_TEMPLATE_DIR . '/languages' );

require( CERTIFY_ST_TEMPLATE_DIR . '/functions/customizer/customizer_general_settings.php' );

if ( is_admin() ) {
				require CERTIFY_ST_TEMPLATE_DIR . '/admin/admin-init.php';
			}

}
endif; 
add_action( 'after_setup_theme', 'certify_theme_setup' );

/**
 * Import options from SpicePress
 *
 */
function certify_get_lite_options() {
	$spicepress_mods = get_option( 'theme_mods_spicepress' );
	if ( ! empty( $spicepress_mods ) ) {
		foreach ( $spicepress_mods as $spicepress_mod_k => $spicepress_mod_v ) {
			set_theme_mod( $spicepress_mod_k, $spicepress_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'certify_get_lite_options' );


add_action( 'admin_init', 'certify_detect_button' );
	function certify_detect_button() {
	wp_enqueue_style('certify-info-button', CERTIFY_ST_TEMPLATE_DIR_URI .'/css/import-button.css');
}