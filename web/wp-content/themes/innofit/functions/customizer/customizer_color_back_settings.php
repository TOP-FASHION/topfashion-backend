<?php 
function innofit_color_back_settings_customizer( $wp_customize ){


$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

/* Home Page Panel */
	$wp_customize->add_panel( 'colors_back_settings', array(
		'priority'       => 125,
		'capability'     => 'edit_theme_options',
		'title'      => esc_html__('Colors / Background','innofit'),
	) );
	
	/* Footer backgrund color settings */
	$wp_customize->add_section( 'footer_background_color_settings', array(
		'title' => esc_html__('Footer', 'innofit'),
		'panel' => 'colors_back_settings',
   	) );		
	
	
			//Footer background color
			$wp_customize->add_setting('footer_background_color', array(
			'default' => '#21202e',
			'sanitize_callback' => 'sanitize_hex_color',
			) );
			
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_background_color', array(
				'label'      => esc_html__('Footer background color', 'innofit' ),
				'section'    => 'footer_background_color_settings',
				'settings'   => 'footer_background_color',) 
			) );
			
		
		//Plus Color and Background
		class WP_colorbackground_plus_Customize_Control extends WP_Customize_Control {
		public $type = 'new_menu';
		/**
		* Render the control's content.
		*/
		public function render_content() {
		?>
		 <div class="pro-vesrion">
		 <P><?php esc_html_e('More options available for Color and Background section in Innofit Plus','innofit');?></P>
		 </div>
		  <div class="pro-box">
		 <a href="<?php echo esc_url('https://spicethemes.com/innofit-plus/');?>" class="read-more-button" id="review_plus" target="_blank"><?php esc_html_e( 'Upgrade to Plus','innofit' ); ?></a>
		 <div>
		<?php
		}
	    }

		$wp_customize->add_setting(
			'add_plus_color_background',
			array(
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)	
		);
		$wp_customize->add_control( new WP_colorbackground_plus_Customize_Control( $wp_customize, 'add_plus_color_background', array(	
				'section' => 'footer_background_color_settings',
				'setting' => 'add_plus_color_background',
		
		)));
	


}
add_action( 'customize_register', 'innofit_color_back_settings_customizer' );