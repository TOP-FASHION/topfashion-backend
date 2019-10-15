<?php 
function certify_general_footer_settings_customizer( $wp_customize ){


$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	

	$wp_customize->add_setting(
		'footer_copyright_text',
		array(
			'default'           =>  '<p>'.__( '<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://spicethemes.com" rel="designer">Certify</a> by SpiceThemes', 'certify' ).'</p>',
			'capability'        =>  'edit_theme_options',
			'sanitize_callback' =>  'certify_copyright_sanitize_text',
			'transport'         => $selective_refresh,
		)	
	);
	$wp_customize->add_control('footer_copyright_text', array(
			'label' => esc_html__('Copyright text','certify'),
			'section' => 'spicepress_footer_copyright',
			'type'    =>  'textarea'
	));	 // footer copyright
	
	function certify_copyright_sanitize_text( $input ) 
	{
		return wp_kses_post( force_balance_tags( $input ) );
	}
}
add_action( 'customize_register', 'certify_general_footer_settings_customizer' );


function certify_register_copyright_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'footer_copyright_text', array(
		'selector'            => '.site-footer .site-info p',
		'settings'            => 'footer_copyright_text',
		'render_callback'  => 'certify_footer_copyright_text_render_callback',
	
	) );

}
add_action( 'customize_register', 'certify_register_copyright_section_partials' );


function certify_footer_copyright_text_render_callback() {
	return get_theme_mod( 'footer_copyright_text' );
}