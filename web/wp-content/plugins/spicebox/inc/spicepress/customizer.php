<?php
if ( ! function_exists( 'spiceb_customize_register' ) ) :
	/**
	 * Spicepress Customize Register
	 */
	 
	function spiceb_customize_register( $wp_customize ) {
		$spicepress_features_content_control = $wp_customize->get_setting( 'spicepress_service_content' );
		if ( ! empty( $spicepress_features_content_control ) ) {
			$spicepress_features_content_control->default = spiceb_spicepress_get_service_default();
	}
	}

	add_action( 'customize_register', 'spiceb_customize_register' );
endif;
?>