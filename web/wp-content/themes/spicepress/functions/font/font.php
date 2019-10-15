<?php

/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/
function spicepress_fonts_url() {
	
    $fonts_url = '';
		
    $font_families = array();
 
	$font_families = array('Open Sans:300,400,600,700,800','Dosis:200,300,400,500,600,700,800','italic','Courgette');
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

    return $fonts_url;
}
function spicepress_scripts_styles() {
    wp_enqueue_style( 'spicepress-fonts', spicepress_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'spicepress_scripts_styles');
?>