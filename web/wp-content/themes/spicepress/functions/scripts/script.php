<?php
// Spicepress scripts
if( !function_exists('spicepress_scripts_function'))
{
	function spicepress_scripts_function(){
		// css
		wp_enqueue_style('bootstrap', ST_TEMPLATE_DIR_URI . '/css/bootstrap.css');
		wp_enqueue_style('spicepress-style', get_stylesheet_uri() );
		wp_enqueue_style('spicepress-default', ST_TEMPLATE_DIR_URI . '/css/default.css');
		
	    if( wp_is_mobile() ){
		    
				$remove_wow_mobile_animation = get_theme_mod('remove_wow_mobile_animation',false);
				
				if($remove_wow_mobile_animation !=true)
				{
				wp_enqueue_style('animate.min-css', ST_TEMPLATE_DIR_URI . '/css/animate.min.css');
				}
		}
		else{
		
				$remove_wow_desktop_animation = get_theme_mod('remove_wow_desktop_animation',false);
				
				if($remove_wow_desktop_animation !=true)
				{
				wp_enqueue_style('animate.min-css', ST_TEMPLATE_DIR_URI . '/css/animate.min.css');
				}
		
	    }
		
		wp_enqueue_style('font-awesome', ST_TEMPLATE_DIR_URI . '/css/font-awesome/css/font-awesome.min.css');
		wp_enqueue_style('spicepress-media-responsive-css', ST_TEMPLATE_DIR_URI . '/css/media-responsive.css');
		wp_enqueue_style('owl-carousel-css', ST_TEMPLATE_DIR_URI . '/css/owl.carousel.css');
		
		
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script('bootstrap-min', ST_TEMPLATE_DIR_URI . '/js/bootstrap.min.js');
		
		// Menu & page scroll js
		wp_enqueue_script('spicepress-menu-js', ST_TEMPLATE_DIR_URI . '/js/menu/menu.js');
		$menu_breakpoint = get_theme_mod('menu_breakpoint', 1100);		
        $breakpoint_settings=array('menu_breakpoint'=>$menu_breakpoint);
		wp_localize_script('spicepress-menu-js','breakpoint_settings',$breakpoint_settings);
        wp_enqueue_script('spicepress-menu-js');
		
		
		
		wp_enqueue_script('spicepress-page-scroll-js', ST_TEMPLATE_DIR_URI . '/js/page-scroll.js');
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action('wp_enqueue_scripts','spicepress_scripts_function');

// footer custom script
function spicepress_custom_script()
{
    
	    if( wp_is_mobile() ){
		    
			$remove_wow_mobile_animation = get_theme_mod('remove_wow_mobile_animation',false);
			
				if($remove_wow_mobile_animation !=true)
				{
				wp_enqueue_script('animate-js', ST_TEMPLATE_DIR_URI . '/js/animation/animate.js');
				wp_enqueue_script('wow-js', ST_TEMPLATE_DIR_URI . '/js/animation/wow.min.js');
				}
		}
		else{
		
			$remove_wow_desktop_animation = get_theme_mod('remove_wow_desktop_animation',false);
			
				if($remove_wow_desktop_animation !=true)
				{
				wp_enqueue_script('animate-js', ST_TEMPLATE_DIR_URI . '/js/animation/animate.js');
				wp_enqueue_script('wow-js', ST_TEMPLATE_DIR_URI . '/js/animation/wow.min.js');
				}
		
	    }
}
add_action('wp_footer','spicepress_custom_script');
?>