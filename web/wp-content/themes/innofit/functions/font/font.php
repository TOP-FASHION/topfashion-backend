<?php
/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
function innofit_fonts_url() {
	
    $fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Open Sans:300,400,600,700,800','Work Sans:300,400,500,600,700,800,900');
	
	
	
	
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $fonts_url;
}
function innofit_scripts_styles() {
    wp_enqueue_style( 'innofit-fonts', innofit_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'innofit_scripts_styles');
?>