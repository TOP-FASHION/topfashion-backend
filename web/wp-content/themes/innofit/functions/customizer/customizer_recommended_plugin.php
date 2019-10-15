<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
/* Notifications in customizer */
if ( ! is_plugin_active( 'innofit-plus/innofit-plus.php' ) ):

require INNOFIT_TEMPLATE_DIR . '/functions/customizer-notify/innofit-customizer-notify.php';


$config_customizer = array(
	'recommended_plugins'       => array(
		'spicebox' => array(
			'recommended' => true,
			'description' => sprintf( esc_html__( 'Install and activate %s plugin for taking full advantage of all the features this theme has to offer.', 'innofit' ), sprintf( '<strong>%s</strong>', 'Spicebox' ) ),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'innofit' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'innofit' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'innofit' ),
	'activate_button_label'     => esc_html__( 'Activate', 'innofit' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'innofit' ),
);
Innofit_Customizer_Notify::init( apply_filters( 'innofit_customizer_notify_array', $config_customizer ) );
endif;
?>