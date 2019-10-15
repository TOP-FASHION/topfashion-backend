<?php
function innofit_repeater_register( $wp_customize ) {

	$repeater_path = INNOFIT_TEMPLATE_DIR . '/functions/customizer-repeater/class/customizer-repeater-control.php';
	if( file_exists( $repeater_path ) ){
		require_once( $repeater_path );
	}

}
add_action( 'customize_register', 'innofit_repeater_register' );

function innofit_repeater_sanitize($input){
	$input_decoded = json_decode($input,true);

	if(!empty($input_decoded)) {
		foreach ($input_decoded as $boxk => $box ){
			foreach ($box as $key => $value){

					$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );

			}
		}
		return json_encode($input_decoded);
	}
	return $input;
}