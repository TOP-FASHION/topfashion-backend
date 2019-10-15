<?php
// Global variables define
define('ST_TEMPLATE_DIR_URI',get_template_directory_uri());	
define('ST_TEMPLATE_DIR',get_template_directory());
define('ST_THEME_FUNCTIONS_PATH',ST_TEMPLATE_DIR.'/functions');


// Theme functions file including
require( ST_THEME_FUNCTIONS_PATH . '/scripts/script.php');
require( ST_THEME_FUNCTIONS_PATH . '/menu/default_menu_walker.php');
require( ST_THEME_FUNCTIONS_PATH . '/menu/st_nav_walker.php');
require( ST_THEME_FUNCTIONS_PATH .'/font/font.php');
require( ST_THEME_FUNCTIONS_PATH . '/breadcrumbs/breadcrumbs.php');
require( ST_THEME_FUNCTIONS_PATH . '/template-tags.php');
require( ST_THEME_FUNCTIONS_PATH . '/widgets/sidebars.php');

// Adding customizer files
require( ST_THEME_FUNCTIONS_PATH . '/customizer/customizer_sections_settings.php' );
require( ST_THEME_FUNCTIONS_PATH . '/customizer/customizer_header_image.php');
require( ST_THEME_FUNCTIONS_PATH . '/customizer/customizer_general_settings.php');
require( ST_THEME_FUNCTIONS_PATH . '/customizer/customizer_recommended_plugin.php');
require( ST_THEME_FUNCTIONS_PATH . '/customizer/customizer_import_data.php');
require( ST_THEME_FUNCTIONS_PATH . '/customizer/customizer_bredcrumbs_settings.php');
require( ST_THEME_FUNCTIONS_PATH . '/customizer/customizer-pro.php');

//Alpha Color Control
require( ST_THEME_FUNCTIONS_PATH . '/customizer/customizer-alpha-color-picker/class-spicepress-customize-alpha-color-control.php');


//About Theme
    $theme = wp_get_theme(); // gets the current theme
	if ( 'SpicePress' == $theme->name) {
	  if ( is_admin() ) {
		  
        require ST_TEMPLATE_DIR . '/admin/admin-init.php';
		
			}
	}



// set default content width
if ( ! isset( $content_width ) ) {
	$content_width = 696;
}
// Theme title
if( !function_exists( 'spicepress_head_title' ) ) 
{
	function spicepress_head_title( $title , $sep ) {
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
				$title = "$title $sep " . sprintf( esc_html__('Page', 'spicepress' ), max( $paged, $page ) );
			
		return $title;
	}
}
add_filter( 'wp_title', 'spicepress_head_title', 10, 2);


if ( ! function_exists( 'spicepress_theme_setup' ) ) :

function spicepress_theme_setup() {
	
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 */
	
	load_theme_textdomain( 'spicepress', ST_TEMPLATE_DIR . '/languages' );

	
	
	
	// Add default posts and comments RSS feed links to head.
	
	add_theme_support( 'automatic-feed-links' );
	
	
	//Add selective refresh for sidebar widget
	add_theme_support( 'customize-selective-refresh-widgets' );

	
	
	/*
	 * Let WordPress manage the document title.
	 */
	 
	add_theme_support( 'title-tag' );
	

	// supports featured image
	
	add_theme_support( 'post-thumbnails' );

	
	
	// This theme uses wp_nav_menu() in two locations.
	
	register_nav_menus( array(
	
		'primary' => __( 'Primary Menu', 'spicepress' ),
		
	) );
	
	
	// woocommerce support
	
	add_theme_support( 'woocommerce' );
	
	// Woocommerce Gallery Support
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	
	//Custom Header support
	
	add_theme_support( 'custom-header' );
	
	
	
	//Custom logo
	
	add_theme_support( 'custom-logo', array(
		'height'      => 49,
		'width'       => 210,
		'flex-height' => true,
		'header-text' => array( 'site-title', 'site-description' ),
		
	) );
	
	// Custom-header
    add_theme_support( 'custom-header', apply_filters( 'spicepress_custom_header_args', array(
                'default-text-color'     => '333',
                'width'                  => 1600,
                'height'                 => 200,
                'flex-height'            => true,
                'wp-head-callback'       => 'spicepress_header_style',
            ) ) );
					
	}
endif; 
add_action( 'after_setup_theme', 'spicepress_theme_setup' );


function spicepress_logo_class($html)
{
	$header_logo_placing = get_theme_mod('header_logo_placing', 'left');
	
	if($header_logo_placing == 'left'){$logo_class = '';}
	if($header_logo_placing == 'right'){$logo_class = 'align-right';}
	if($header_logo_placing == 'center'){$logo_class = 'align-center';}
	
	$html = str_replace('custom-logo-link', 'navbar-brand '.$logo_class.'', $html);
	return $html;
}
add_filter('get_custom_logo','spicepress_logo_class');

add_action( 'admin_init', 'spicepress_detect_button' );
	function spicepress_detect_button() {
	wp_enqueue_style( 'spicepress-info-button', ST_TEMPLATE_DIR_URI . '/css/import-button.css' );
}

function spicepress_customizer_live_preview() {
	wp_enqueue_script(
		'spicepress-customizer-preview', ST_TEMPLATE_DIR_URI . '/js/customizer.js', array(
			'jquery',
			'customize-preview',
		), 999, true
	);
}

add_action( 'customize_preview_init', 'spicepress_customizer_live_preview' );



require_once ST_TEMPLATE_DIR . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'spicepress_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function spicepress_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		
		 // This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
            'name'      => 'Easy Instagram Feed',
            'slug'      => 'easy-instagram-feed',
            'required'  => false,
        ),
		
		

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'spicepress' ),
			'menu_title'                      => __( 'Install Plugins', 'spicepress' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'spicepress' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'spicepress' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'spicepress' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'spicepress'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'spicepress'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'spicepress'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'spicepress'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'spicepress'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'spicepress'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'spicepress'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'spicepress'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'spicepress'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'spicepress' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'spicepress' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'spicepress' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'spicepress' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'spicepress' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'spicepress' ),
			'dismiss'                         => __( 'Dismiss this notice', 'spicepress' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'spicepress' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'spicepress' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}

