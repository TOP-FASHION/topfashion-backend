<?php
class spicepress_customize_import_dummy_data {

	private static $instance;

	public static function init( ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof spicepress_customize_import_dummy_data ) ) {
			self::$instance = new spicepress_customize_import_dummy_data;
			self::$instance->spicepress_setup_actions();
		}

	}

	/**
	 * Setup the class props based on the config array.
	 */
	

	/**
	 * Setup the actions used for this class.
	 */
	public function spicepress_setup_actions() {

		// Enqueue scripts
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'spicepress_import_customize_scripts' ), 0 );

	}
	
	

	public function spicepress_import_customize_scripts() {

	wp_enqueue_script( 'spicepress-import-customizer-js', ST_TEMPLATE_DIR_URI . '/js/spicepress-import-customizer.js', array( 'customize-controls' ) );
	}
}

$import_customizer = array(

		'import_data' => array(
			'recommended' => true,
			
		),
);
spicepress_customize_import_dummy_data::init( apply_filters( 'spicepress_import_customizer', $import_customizer ) );