<?php 
function spicepress_general_settings_customizer( $wp_customize ){
	
class Spicepress_Header_Logo_Customize_Control_Radio_Image extends WP_Customize_Control {
	/**
	 * The type of customize control being rendered.
	 *
	 * @since 1.1.24
	 * @var   string
	 */
	public $type = 'radio-image';
	/**
	 * Displays the control content.
	 *
	 * @since  1.1.24
	 * @access public
	 * @return void
	 */
	public function render_content() {
		/* If no choices are provided, bail. */
		if ( empty( $this->choices ) ) {
			return;
		} ?>

		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>

		<div id="<?php echo esc_attr( "input_{$this->id}" ); ?>">

			<?php foreach ( $this->choices as $value => $args ) : ?>

				<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( "_customize-radio-{$this->id}" ); ?>" id="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>" <?php $this->link(); ?> <?php checked( $this->value(), $value ); ?> />

				<label for="<?php echo esc_attr( "{$this->id}-{$value}" ); ?>">
					<?php if ( ! empty( $args['label'] ) ) { ?>
						<span class="screen-reader-text"><?php echo esc_html( $args['label'] ); ?></span>
						<?php
}
?>
					<img class="wp-ui-highlight" src="<?php echo esc_url( sprintf( $args['url'], get_template_directory_uri(), get_stylesheet_directory_uri() ) ); ?>" 
											<?php
											if ( ! empty( $args['label'] ) ) {
												echo 'alt="' . esc_attr( $args['label'] ) . '"'; } ?>
	/>
				</label>

			<?php endforeach; ?>

		</div><!-- .image -->

		<script type="text/javascript">
			jQuery( document ).ready( function() {
				jQuery( '#<?php echo esc_attr( "input_{$this->id}" ); ?>' ).buttonset();
			} );
		</script>
	<?php
	}
	/**
	 * Loads the jQuery UI Button script and hooks our custom styles in.
	 *
	 * @since  1.1.24
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'jquery-ui-button' );
		add_action( 'customize_controls_print_styles', array( $this, 'print_styles' ) );
	}
	/**
	 * Outputs custom styles to give the selected image a visible border.
	 *
	 * @since  1.1.24
	 * @access public
	 * @return void
	 */
	public function print_styles() {
	?>

		<style type="text/css" id="hybrid-customize-radio-image-css">
			.customize-control-radio-image .ui-buttonset {
				text-align: center;
			}

			.customize-control-radio-image label {
				display: inline-block;
				max-width: 33.3%;
				padding: 3px;
				font-size: inherit;
				line-height: inherit;
				height: auto;
				cursor: pointer;
				border-width: 0;
				-webkit-appearance: none;
				-webkit-border-radius: 0;
				border-radius: 0;
				white-space: nowrap;
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
				color: inherit;
				background: none;
				-webkit-box-shadow: none;
				box-shadow: none;
				vertical-align: inherit;
			}

			.customize-control-radio-image label:first-of-type {
				float: left;
			}
			.customize-control-radio-image label:nth-of-type(n + 3){
				float: right;
			}

			.customize-control-radio-image label:hover {
				background: none;
				border-color: inherit;
				color: inherit;
			}

			.customize-control-radio-image label:active {
				background: none;
				border-color: inherit;
				-webkit-box-shadow: none;
				box-shadow: none;
				-webkit-transform: none;
				-ms-transform: none;
				transform: none;
			}

			.customize-control-radio-image img { border: 1px solid transparent; }
			.customize-control-radio-image .ui-state-active img {
				border-color: #5b9dd9;
				-webkit-box-shadow: 0 0 3px rgba(0,115,170,.8);
				box-shadow: 0 0 3px rgba(0,115,170,.8);
			}
		</style>
	<?php
	}
}


$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	

/* Home Page Panel */
	$wp_customize->add_panel( 'general_settings', array(
		'priority'       => 125,
		'capability'     => 'edit_theme_options',
		'title'      => esc_html__('General settings','spicepress'),
	) );
	
	
    /* Header layout logo placing setting */
	$wp_customize->add_section( 'header_layout_logo_placing_setting' , array(
		'title'      => esc_html__('Header layout','spicepress'),
		'panel'  => 'general_settings',
   	) );

	
		if ( class_exists( 'Spicepress_Header_Logo_Customize_Control_Radio_Image' ) ) {
			$wp_customize->add_setting(
				'header_logo_placing', array(
					'default'           => 'left',
					'sanitize_callback' => 'spicepress_sanitize_radio',
				)
			);

			$wp_customize->add_control(
				new Spicepress_Header_Logo_Customize_Control_Radio_Image(
					$wp_customize, 'header_logo_placing', array(
						'label'    => esc_html__('Header layout with logo placing', 'spicepress' ),
						'priority' => 6,
						'section' => 'header_layout_logo_placing_setting',
						'choices' => array(
							'left' => array(
								'url' => trailingslashit( ST_TEMPLATE_DIR_URI ) . 'images/header-left.png',
							),
							'right' => array(
								'url' => trailingslashit( ST_TEMPLATE_DIR_URI ) . 'images/header-right.png',
							),
							'center' => array(
								'url' => trailingslashit( ST_TEMPLATE_DIR_URI ) . 'images/header-center.png',
							),
						),
					)
				)
			);
		}
		
		/* footer copyright section */
	$wp_customize->add_section( 'spicepress_menu_breakpoint' , array(
		'title'      => esc_html__('Menu breakpoint settings','spicepress'),
		'panel'  => 'general_settings',
   	) );
	
	
	
		$wp_customize->add_setting( 'menu_breakpoint', array(
		  'capability' => 'edit_theme_options',
		  'sanitize_callback' => 'spicepress_sanitize_number_absint',
		  'default' => 1100,
		) );

		$wp_customize->add_control( 'menu_breakpoint', array(
		  'type' => 'number',
		  'section' => 'spicepress_menu_breakpoint', // Add a default or your own section
		  'label' => __( 'Menu breakpoint' ),
		  'description' => __( 'Enter the Min. Size 200px and Max Size 6000px' ),
		) );

		function spicepress_sanitize_number_absint( $number, $setting ) {
		  // Ensure $number is an absolute integer (whole number, zero or greater).
		  $number = absint( $number );
		  
		  if($number < 200 || $number > 6000){
			  
		  }else{
			  
			   // If the input is an absolute integer, return it; otherwise, return the default
		       return ( $number ? $number : $setting->default );
		  }

		 
		}
		
		
	
	/* Remove animation */
	$wp_customize->add_section( 'remove_wow_animation_setting' , array(
		'title'      => esc_html__('Animation Settings','spicepress'),
		'panel'  => 'general_settings',
   	) );
	
	
			// Reservation Title
			$wp_customize->add_setting( 'remove_wow_desktop_animation',array(
			'capability'     => 'edit_theme_options',
			'default' => false,
			'sanitize_callback' => 'spicepress_home_page_sanitize_text',
			));	
			$wp_customize->add_control( 'remove_wow_desktop_animation',array(
			'label'   => esc_html__('Disable animation effect in desktop','spicepress'),
			'section' => 'remove_wow_animation_setting',
			'type' => 'checkbox',
			));

			// Reservation Title
			$wp_customize->add_setting( 'remove_wow_mobile_animation',array(
			'capability'     => 'edit_theme_options',
			'default' => false,
			'sanitize_callback' => 'spicepress_home_page_sanitize_text',
			));	
			$wp_customize->add_control( 'remove_wow_mobile_animation',array(
			'label'   => esc_html__('Disable animation effect on mobile devices','spicepress'),
			'section' => 'remove_wow_animation_setting',
			'type' => 'checkbox',
			));
			

	/* footer copyright section */
	$wp_customize->add_section( 'spicepress_footer_copyright' , array(
		'title'      => esc_html__('Footer copyright settings','spicepress'),
		'panel'  => 'general_settings',
   	) );
	
	
	$wp_customize->add_setting(
		'footer_copyright_text',
		array(
			'default'           =>  '<p>'.__( '<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://spicethemes.com" rel="designer">SpicePress</a> by SpiceThemes', 'spicepress' ).'</p>',
			'capability'        =>  'edit_theme_options',
			'sanitize_callback' =>  'spicepress_copyright_sanitize_text',
			'transport'         => $selective_refresh,
		)	
	);
	$wp_customize->add_control('footer_copyright_text', array(
			'label' => esc_html__('Copyright text','spicepress'),
			'section' => 'spicepress_footer_copyright',
			'type'    =>  'textarea'
	));	 // footer copyright
	
	
	/* footer copyright section */
	$wp_customize->add_section( 'spicepress_pro_general' , array(
		'title'      => esc_html__('More Options','spicepress'),
		'panel'  => 'general_settings',
   	) );
	
	    //Pro general settings	
		class WP_general_pro_Customize_Control extends WP_Customize_Control {
		public $type = 'new_menu';
		/**
		* Render the control's content.
		*/
		public function render_content() {
		?>
		 <div class="pro-vesrion">
		 <P><?php esc_html_e('More options available for Header in SpicePress Pro','spicepress');?></P>
		 </div>
		  <div class="pro-box">
		 <a href="<?php echo esc_url('https://helpdoc.spicethemes.com/spicepress/how-to-configure-header-variation/');?>" class="read-more-button" id="review_pro" target="_blank"><?php esc_html_e( 'Read More','spicepress' ); ?></a>
		 <div>
		<?php
		}
	    }

		$wp_customize->add_setting(
			'add_pro_general',
			array(
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)	
		);
		$wp_customize->add_control( new WP_general_pro_Customize_Control( $wp_customize, 'add_pro_general', array(	
				'section' => 'spicepress_pro_general',
				'setting' => 'add_pro_general',
		
		)));
	
	function spicepress_copyright_sanitize_text( $input ) 
	{
		return wp_kses_post( force_balance_tags( $input ) );
	}
}
add_action( 'customize_register', 'spicepress_general_settings_customizer' );


function spicepress_register_copyright_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'footer_copyright_text', array(
		'selector'            => '.site-footer .site-info p',
		'settings'            => 'footer_copyright_text',
		'render_callback'  => 'spicepress_footer_copyright_text_render_callback',
	
	) );

}
add_action( 'customize_register', 'spicepress_register_copyright_section_partials' );


function spicepress_footer_copyright_text_render_callback() {
	return get_theme_mod( 'footer_copyright_text' );
}

function spicepress_home_page_sanitize_text( $input ) {

		return wp_kses_post( force_balance_tags( $input ) );

}