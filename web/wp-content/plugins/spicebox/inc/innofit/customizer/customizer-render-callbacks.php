<?php
/**
 * slider section render callbacks.
 */

function spiceb_innofit_slider_section_title_render_callback() {
	return get_theme_mod( 'home_slider_title' );
}

function spiceb_innofit_slider_section_discription_render_callback() {
	return get_theme_mod( 'home_slider_discription' );
}

function spiceb_innofit_slider_btn_render_callback() {
	return get_theme_mod( 'home_slider_btn_txt' );
}



/**
 * about section render callbacks.
 */


function innofit_home_about_content_render_callback(){
	return get_theme_mod( 'about_section_content' );
}


/**
 * service section render callbacks.
 */


function innofit_home_service_section_title_render_callback() {
	return get_theme_mod( 'home_service_section_title' );
}

function innofit_home_service_section_discription_render_callback() {
	return get_theme_mod( 'home_service_section_discription' );
}


/**
 * shop section render callbacks.
 */


function home_shop_section_title_render_callback() {
	return get_theme_mod( 'home_shop_section_title' );
}

function home_shop_section_discription_render_callback() {
	return get_theme_mod( 'home_shop_section_discription' );
}


/**
 * testimonial section render callbacks.
 */


function home_testimonial_section_title_render_callback() {
	return get_theme_mod( 'home_testimonial_section_title' );
}

function home_testimonial_section_discription_render_callback() {
	return get_theme_mod( 'home_testimonial_section_discription' );
}


/**
* team section render callbacks.
*/


function home_team_section_title_render_callback() {
	return get_theme_mod( 'home_team_section_title' );
}

function home_team_section_discription_render_callback() {
	return get_theme_mod( 'home_team_section_discription' );
}


/**
* news section render callbacks.
*/

function home_news_section_title_render_callback() {
	return get_theme_mod( 'home_news_section_title' );
}

function home_news_section_discription_render_callback() {
	return get_theme_mod( 'home_news_section_discription' );
}

/**
 * callout section render callbacks.
 */


function home_call_out_title_render_callback() {
	return get_theme_mod( 'home_call_out_title' );
}

function home_call_out_desc_render_callback() {
	return get_theme_mod( 'home_call_out_desc' );
}

function home_call_out_btn_text_render_callback() {
	return get_theme_mod( 'home_call_out_btn_text' );
}


/**
* contact form section render callbacks.
*/
 

function contact_form_title_one_render_callback() {
	return get_theme_mod( 'contact_form_title_one' );
}

function contact_form_title_two_render_callback() {
	return get_theme_mod( 'contact_form_title_two' );
}

function contact_info_content_render_callback() {
	return get_theme_mod( 'contact_info_content' );
}


/**
* subscribe section render callbacks.
*/


function subscribe_title_content_render_callback() {
	return get_theme_mod( 'innofit_subscribe_title' );
}

function subscribe_subtitle_content_render_callback() {
	return get_theme_mod( 'innofit_subscribe_subtitle' );
}

?>