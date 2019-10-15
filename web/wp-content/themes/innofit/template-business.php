<?php 
/**
 * Template Name: Business Template
 */
get_header();

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( ! is_plugin_active( 'innofit-plus/innofit-plus.php' ) ):

	if ( is_plugin_active( 'spicebox/spicebox.php' ) ):

		do_action( 'innofit_slider_action' , false);
		do_action( 'innofit_services_action', false);
		do_action( 'innofit_about_action' ,false);
		do_action( 'innofit_wooproduct_action', false);
		if(!empty(get_theme_mod('innofit_testimonial_content')))
		{
		do_action( 'innofit_testimonial_action' ,false);	
		}
		do_action( 'innofit_team_action' ,false);
        do_action( 'innofit_news_action' ,false);
		do_action( 'innofit_contact_action' , false);
		if(!empty(get_theme_mod('innofit_subscribe_title')))
		{
		do_action( 'innofit_subscriber_action' , false);
		}
		if(!empty(get_theme_mod('home_call_out_title')))
		{
		do_action( 'innofit_callout_action' ,false);	
		}

	endif;

endif;


if ( is_plugin_active( 'innofit-plus/innofit-plus.php' ) ):

	    $front_page = get_theme_mod('front_page_data','services,about,portfolio,funfact,wooproduct,testimonial,team,pricing,news,map,contact,subscriber,client,instagram');
		
        do_action( 'innofit_slider_action' , false);
		
		do_action( 'innofit_after_slider_section_hook', false);
		
		$data =is_array($front_page) ? $front_page : explode(",",$front_page);
			
		if($data) 
		{
			foreach($data as $key=>$value)
			{	
                do_action( 'innofit_before_'.$value.'_section_hook', false);
				
				do_action( 'innofit_'.$value.'_action', false);
				
				do_action( 'innofit_after_'.$value.'_section_hook', false);

			}
		}

endif;


get_footer(); ?>