<?php
/*
Plugin Name: SpiceBox
Plugin URI:
Description: Enhances SpiceThemes with extra functionality.
Version: 0.3.9.1
Author: Spicethemes
Author URI: https://github.com
Text Domain: spicebox
*/
define( 'SPICEB_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'SPICEB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

function spiceb_activate() {
	$theme = wp_get_theme(); // gets the current theme
	if ( 'SpicePress' == $theme->name || 'Rockers' == $theme->name || 'Content' == $theme->name  || 'Certify' == $theme->name || 'Stacy' == $theme->name || 'SpicePress Child Theme' == $theme->name){
		require_once('inc/spicepress/features/feature-slider-section.php');
		require_once('inc/spicepress/features/feature-service-section.php');
		require_once('inc/spicepress/features/feature-portfolio-section.php');
		require_once('inc/spicepress/features/feature-testimonial-section.php');
		require_once('inc/spicepress/sections/spicepress-slider-section.php');
		require_once('inc/spicepress/sections/spicepress-features-section.php');
		require_once('inc/spicepress/sections/spicepress-portfolio-section.php');
		require_once('inc/spicepress/sections/spicepress-testimonail-section.php');
		require_once('inc/spicepress/customizer.php');
		
	}
	
	if ( 'Chilly' == $theme->name || 'SpiceBlue' == $theme->name){
		require_once('inc/spicepress/features/feature-service-section.php');
		require_once('inc/spicepress/features/feature-portfolio-section.php');
		require_once('inc/spicepress/features/feature-testimonial-section.php');
		require_once('inc/spicepress/sections/spicepress-features-section.php');
		require_once('inc/spicepress/sections/spicepress-portfolio-section.php');
		require_once('inc/spicepress/sections/spicepress-testimonail-section.php');
		require_once('inc/spicepress/customizer.php');
	}
	
    if ( 'Innofit' == $theme->name){
		
		
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		
		
		if ( ! is_plugin_active( 'innofit-plus/innofit-plus.php' ) ):

		
			if ( ! function_exists( 'spiceb_innofit_customize_register' ) ) :
				function spiceb_innofit_customize_register($wp_customize){
					
				$sections_customizer_data = array('slider','services','about','testimonial','team','news','callout','contact','subscriber','wooproduct');
					
				$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
				
				if (!empty($sections_customizer_data))
				{ 
					foreach($sections_customizer_data as $section_customizer_data)
					{ 
						require_once('inc/innofit/customizer/'.$section_customizer_data.'-section.php');
					}	
				}
				
			}
			add_action( 'customize_register', 'spiceb_innofit_customize_register' );
			endif;

			
			    $sections_data = array('slider','services','about','testimonial','team','news','callout','contact','subscriber','wooproduct');
				
				if (!empty($sections_data))
				{ 
					foreach($sections_data as $section_data)
					{ 
						require_once('inc/innofit/sections/innofit-'.$section_data.'-section.php');
					}	
				}
			
			require_once('inc/innofit/customizer/customizer-render-callbacks.php');
			require_once('inc/innofit/customizer.php');
		
		
		endif;
		
	}
	

}
add_action( 'init', 'spiceb_activate' );


$theme = wp_get_theme();
if ( 'SpicePress' == $theme->name || 'Rockers' == $theme->name || 'Content' == $theme->name || 'Certify' == $theme->name || 'Stacy' == $theme->name || 'SpicePress Child Theme' == $theme->name || 'Chilly' == $theme->name || 'SpiceBlue' == $theme->name){
		
	
register_activation_hook( __FILE__, 'spiceb_install_function');
function spiceb_install_function()
{	
$item_details_page = get_option('item_details_page'); 
    if(!$item_details_page){
	require_once('inc/spicepress/default-pages/upload-media.php');
	require_once('inc/spicepress/default-pages/about-page.php');
	require_once('inc/spicepress/default-pages/home-page.php');
	require_once('inc/spicepress/default-pages/blog-page.php');
	require_once('inc/spicepress/default-pages/contact-page.php');
	require_once('inc/spicepress/default-pages/portfolio-page.php');
	require_once('inc/spicepress/default-widgets/default-widget.php');
	update_option( 'item_details_page', 'Done' );
    }
}

}


//Innofit
if ( 'Innofit' == $theme->name ){
		
register_activation_hook( __FILE__, 'spiceb_install_function');
function spiceb_install_function()
{	
$item_details_page = get_option('item_details_page'); 
    if(!$item_details_page){
	require_once('inc/innofit/default-pages/upload-media.php');
	require_once('inc/innofit/default-pages/home-page.php');
	require_once('inc/innofit/default-widgets/default-widget.php');
	require_once('inc/innofit/default-pages/home-custom-menu.php');
	update_option( 'item_details_page', 'Done' );
    }
}

}


//Sanatize text
function spiceb_spicepress_home_page_sanitize_text( $input ) {

		return wp_kses_post( force_balance_tags( $input ) );

}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		
		
if ( ! is_plugin_active( 'innofit-plus/innofit-plus.php' ) ):

	function spiceb_innofit_home_page_sanitize_text( $input ) {

		return wp_kses_post( force_balance_tags( $input ) );

	}
			
endif;
?>