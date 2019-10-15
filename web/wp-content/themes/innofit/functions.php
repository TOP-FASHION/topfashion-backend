<?php
// Global variables define
define('INNOFIT_TEMPLATE_DIR_URI',get_template_directory_uri());	
define('INNOFIT_TEMPLATE_DIR',get_template_directory());
define('INNOFIT_THEME_FUNCTIONS_PATH',INNOFIT_TEMPLATE_DIR.'/functions');

// Theme functions file including
require( INNOFIT_THEME_FUNCTIONS_PATH . '/scripts/script.php');
require( INNOFIT_THEME_FUNCTIONS_PATH . '/menu/default_menu_walker.php');
require( INNOFIT_THEME_FUNCTIONS_PATH . '/menu/st_nav_walker.php');
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( ! is_plugin_active( 'innofit-plus/innofit-plus.php' ) ):
require( INNOFIT_THEME_FUNCTIONS_PATH .'/font/font.php');
endif;
require( INNOFIT_THEME_FUNCTIONS_PATH . '/breadcrumbs/breadcrumbs.php');
require( INNOFIT_THEME_FUNCTIONS_PATH . '/template-tags.php');
require( INNOFIT_THEME_FUNCTIONS_PATH . '/excerpt/excerpt.php');
require( INNOFIT_THEME_FUNCTIONS_PATH . '/widgets/sidebars.php');
require( INNOFIT_THEME_FUNCTIONS_PATH . '/widgets/wdl_social_icon.php');
require( INNOFIT_THEME_FUNCTIONS_PATH . '/widgets/wdl_featured_latest_news.php');

require INNOFIT_TEMPLATE_DIR . '/admin/admin-init.php';

// Adding customizer files
require( INNOFIT_THEME_FUNCTIONS_PATH . '/customizer/customizer_sections_settings.php' );
require( INNOFIT_THEME_FUNCTIONS_PATH . '/customizer/customizer_layout_settings.php');
require( INNOFIT_THEME_FUNCTIONS_PATH . '/customizer/customizer_color_back_settings.php');
require( INNOFIT_THEME_FUNCTIONS_PATH . '/customizer/customizer_recommended_plugin.php');
require( INNOFIT_THEME_FUNCTIONS_PATH . '/customizer/customizer-pro.php');

//Alpha Color Control
require( INNOFIT_THEME_FUNCTIONS_PATH . '/customizer/customizer-alpha-color-picker/class-innofit-customize-alpha-color-control.php');

//Customizer Page Editor
require( INNOFIT_THEME_FUNCTIONS_PATH . '/customizer/customizer-page-editor/class/class-innofit-page-editor.php');

//Customizer Subscriber tabs
require( INNOFIT_THEME_FUNCTIONS_PATH . '/customizer/customizer-tabs/class/class-innofit-customize-control-tabs.php');

//Subscriber Info
require( INNOFIT_THEME_FUNCTIONS_PATH . '/customizer/customizer-subscribe-info/class-innofit-subscribe-info.php');

//Plugin Install
require( INNOFIT_THEME_FUNCTIONS_PATH . '/plugin-install/class-innofit-plugin-install-helper.php');

// set default content width
if ( ! isset( $content_width ) ) {
	$content_width = 696;
}
// Theme title
if( !function_exists( 'innofit_head_title' ) ) 
{
	function innofit_head_title( $title , $sep ) {
		global $paged, $page;
		
		if ( is_feed() )
				return $title;
			
		// Add the site name
		$title .= get_bloginfo( 'name' );
		
		// Add the site description for the home / front page
		$site_description = get_bloginfo( 'description' );
		if ( $site_description && ( is_home() || is_front_page() ) )
				$title = "$title $sep $site_description";
			
		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
				$title = "$title $sep " . sprintf( esc_html__('Page', 'innofit' ), max( $paged, $page ) );
			
		return $title;
	}
}
add_filter( 'wp_title', 'innofit_head_title', 10, 2);


if ( ! function_exists( 'innofit_theme_setup' ) ) :

function innofit_theme_setup() {
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	
	load_theme_textdomain( 'innofit', INNOFIT_TEMPLATE_DIR . '/languages' );

	
	
	
	// Add default posts and comments RSS feed links to head.
	
	add_theme_support( 'automatic-feed-links' );
	
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );

	
	/*
	 * Let WordPress manage the document title.
	 */
	 
	add_theme_support( 'title-tag' );
	
	
	add_theme_support( 'custom-header' );
	
	
	// supports featured image
	
	add_theme_support( 'post-thumbnails' );

	
	
	// This theme uses wp_nav_menu() in two locations.
	
	register_nav_menus( array(
	
		'primary' => esc_html__( 'Primary Menu', 'innofit' ),
		
	) );
	
	
	// woocommerce support
	add_theme_support( 'woocommerce' );
	
	
	//Custom background support
	add_theme_support( 'custom-background' );
	
	//Custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 40,
		'width'       => 175,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),
		
	) );
}
endif; 
add_action( 'after_setup_theme', 'innofit_theme_setup' );


function innofit_logo_class($html)
{
	$html = str_replace('custom-logo-link', 'navbar-brand', $html);
	return $html;
}
add_filter('get_custom_logo','innofit_logo_class');

add_action( 'admin_init', 'innofit_detect_button' );
	function innofit_detect_button() {
	wp_enqueue_style( 'innofit-info-button', INNOFIT_TEMPLATE_DIR_URI . '/css/import-button.css' );
}

function innofit_new_content_more($more)
	{  global $post;
		return '<p><a href="' . esc_url(get_permalink()) . "#more-{$post->ID}\" class=\"more-link btn-ex-small btn-border\">" .esc_html__('Read More','innofit')."</a></p>";
	}
	add_filter( 'the_content_more_link', 'innofit_new_content_more' );

function innofit_customizer_live_preview() {
	wp_enqueue_script(
		'innofit-customizer-preview', INNOFIT_TEMPLATE_DIR_URI . '/js/customizer.js', array(
			'jquery',
			'customize-preview',
		), 999, true
	);
}
add_action( 'customize_preview_init', 'innofit_customizer_live_preview' );

add_action( "customize_register", "innofit_remove_defult_setting_customize_register" );
function innofit_remove_defult_setting_customize_register( $wp_customize ) {
 $wp_customize->remove_control("header_image");
}

function innofit_remove_admin_login_header() {
   remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'innofit_remove_admin_login_header');

//Add my style admin bar
function innofit_admin_css() {
    if ( is_user_logged_in() && is_admin_bar_showing() ) {?>
   <style type="text/css">
    @media (min-width: 600px){
       .navbar-fixed-top{top:32px;}
    }
   </style>
<?php }
}
add_action('wp_head', 'innofit_admin_css');

add_action( 'after_setup_theme', 'innofit_theme_woocommerce_setup' );

function innofit_theme_woocommerce_setup() {
   add_theme_support( 'wc-product-gallery-zoom' );
   add_theme_support( 'wc-product-gallery-lightbox' );
   add_theme_support( 'wc-product-gallery-slider' );
}