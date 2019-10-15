<?php
if ( ! function_exists( 'spiceb_spicepress_testimonial_customize_register' ) ) :
function spiceb_spicepress_testimonial_customize_register($wp_customize){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	

/* Testimonial Section */
	$wp_customize->add_section( 'testimonial_section' , array(
			'title'      => __('Testimonial settings', 'spicepress'),
			'panel'  => 'section_settings',
			'priority'   => 7,
		) );
		
		// Enable testimonial section
		$wp_customize->add_setting( 'testimonial_section_enable' , array( 'default' => 'on') );
		$wp_customize->add_control(	'testimonial_section_enable' , array(
				'label'    => __( 'Enable Home Testimonial section', 'spicepress' ),
				'section'  => 'testimonial_section',
				'type'     => 'radio',
				'choices' => array(
					'on'=>__('ON', 'spicepress'),
					'off'=>__('OFF', 'spicepress')
				)
		));
		
		//Testimonial Background Image
			$wp_customize->add_setting( 'testimonial_callout_background',array('default' => SPICEB_PLUGIN_URL .'inc/spicepress/images/testimonial/testimonial-bg.jpg',
			'sanitize_callback' => 'esc_url_raw', 'transport'         => $selective_refresh,));
			
			
			$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'testimonial_callout_background', array(
			  'label'    => __( 'Background Image', 'spicepress' ),
			  'section'  => 'testimonial_section',
			  'settings' => 'testimonial_callout_background',
			) ) );
			
			// Image overlay
		$wp_customize->add_setting( 'testimonial_image_overlay', array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control('testimonial_image_overlay', array(
			'label'    => __('Enable testimonial image overlay', 'spicepress' ),
			'section'  => 'testimonial_section',
			'type' => 'checkbox',
		) );
		
		
		//Testimonial Background Overlay Color
		$wp_customize->add_setting( 'testimonial_overlay_section_color', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'rgba(0,0,0,0.6)',
            ) );	
            
            $wp_customize->add_control(new SpicePress_Customize_Alpha_Color_Control( $wp_customize,'testimonial_overlay_section_color', array(
               'label'      => __('Testimonial image overlay color','spicepress' ),
                'palette' => true,
                'section' => 'testimonial_section')
            ) );
			
		
		// testimonial section title
		$wp_customize->add_setting( 'home_testimonial_section_title',array(
		'capability'     => 'edit_theme_options',
		'default' => __('What People Say','spicepress'),
		'sanitize_callback' => 'spiceb_spicepress_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_testimonial_section_title',array(
		'label'   => __('Title','spicepress'),
		'section' => 'testimonial_section',
		'type' => 'text',
		));	
		
		//testimonial section discription
		$wp_customize->add_setting( 'home_testimonial_section_discription',array(
		'capability'     => 'edit_theme_options',
		'default'=> 'Sea summo mazim ex, ea errem eleifend definitionem vim. Ut nec hinc dolor possim mei ludus efficiendi ei sea summo mazim ex.',
		'sanitize_callback' => 'spiceb_spicepress_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_testimonial_section_discription',array(
		'label'   => __('Description','spicepress'),
		'section' => 'testimonial_section',
		'type' => 'textarea',
		));
		
		//testimonial one image
		$wp_customize->add_setting( 'home_testimonial_thumb',array('default' => SPICEB_PLUGIN_URL .'inc/spicepress/images/testimonial/testi1.jpg',
		'sanitize_callback' => 'esc_url_raw', 'transport'         => $selective_refresh,));
	 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'home_testimonial_thumb',
				array(
					'label' => __('Image','spicebox'),
					'section' => 'example_section_one',
					'settings' =>'home_testimonial_thumb',
					'section' => 'testimonial_section',
					'type' => 'upload',
				)
			)
		);
		
		//testimonial description
		$wp_customize->add_setting( 'home_testimonial_desc',array(
		'capability'     => 'edit_theme_options',
		'default' => 'Sed ut Perspiciatis Unde Omnis Iste Sed ut perspiciatis unde omnis iste natu error sit voluptatem accu tium neque fermentum veposu miten a tempor nise. Duis autem vel eum iriure dolor in hendrerit in vulputate velit consequat reprehender in voluptate velit esse cillum duis dolor fugiat nulla pariatur.',
		'sanitize_callback' => 'spiceb_spicepress_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_testimonial_desc',array(
		'label'   => __('Description','spicepress'),
		'section' => 'testimonial_section',
		'type' => 'text',
		));
		
		
		// testimonial section title
		$wp_customize->add_setting( 'home_testimonial_title',array(
		'capability'     => 'edit_theme_options',
		'default' => __('Alice Culan','spicepress'),
		'sanitize_callback' => 'spiceb_spicepress_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_testimonial_title',array(
		'label'   => __('Title','spicepress'),
		'section' => 'testimonial_section',
		'type' => 'text',
		));
		
		
		$wp_customize->add_setting( 'home_testimonial_designation',array(
		'capability'     => 'edit_theme_options',
		'default' => __('UI Developer','spicepress'),
		'sanitize_callback' => 'spiceb_spicepress_home_page_sanitize_text',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_testimonial_designation',array(
		'label'   => __('Designation','spicepress'),
		'section' => 'testimonial_section',
		'type' => 'text',
		));
		
		
	    //Pro testimonial	
		class WP_testimonial_pro_Customize_Control extends WP_Customize_Control {
		public $type = 'new_menu';
		/**
		* Render the control's content.
		*/
		public function render_content() {
		?>
		 <div class="pro-vesrion">
		 <P><?php esc_html_e('More options available for testimonial section in SpicePress Pro','spicepress');?></P>
		 </div>
		  <div class="pro-box">
		 <a href="<?php echo esc_url('https://helpdoc.spicethemes.com/spicepress/how-to-add-testimonial-in-spicepress-theme/');?>" class="read-more-button" id="review_pro" target="_blank"><?php esc_html_e( 'Read More','spicepress' ); ?></a>
		 <div>
		<?php
		}
	    }

		$wp_customize->add_setting(
			'add_pro_testimonial',
			array(
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)	
		);
		$wp_customize->add_control( new WP_testimonial_pro_Customize_Control( $wp_customize, 'add_pro_testimonial', array(	
				'section' => 'testimonial_section',
				'setting' => 'add_pro_testimonial',
		
		)));
		
		
}

add_action( 'customize_register', 'spiceb_spicepress_testimonial_customize_register' );
endif;


/**
 * Add selective refresh for Front page section section controls.
 */
function spiceb_spicepress_register_home_testimonial_section_partials( $wp_customize ){


	
		//Testimonial
	$wp_customize->selective_refresh->add_partial( 'home_testimonial_section_title', array(
		'selector'            => '.testimonial-section .section-header h1',
		'settings'            => 'home_testimonial_section_title',
		'render_callback'  => 'spiceb_spicepress_testimonial_section_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_testimonial_section_discription', array(
		'selector'            => '.testimonial-section .section-header p',
		'settings'            => 'home_testimonial_section_discription',
		'render_callback'  => 'spiceb_spicepress_testimonial_section_discription_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_testimonial_desc', array(
		'selector'            => '.author-description p',
		'settings'            => 'home_testimonial_desc',
		'render_callback'  => 'spiceb_spicepress_testimonial_desc_render_callback',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'home_testimonial_title', array(
		'selector'            => '.testmonial-area h4',
		'settings'            => 'home_testimonial_title',
		'render_callback'  => 'spiceb_spicepress_testimonial_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_testimonial_designation', array(
		'selector'            => '.testmonial-area span.designation',
		'settings'            => 'home_testimonial_designation',
		'render_callback'  => 'spiceb_spicepress_testimonial_designation_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'testimonial_callout_background', array(
		'selector'            => 'section.testimonial-section',
		'settings'            => 'testimonial_callout_background',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_testimonial_thumb', array(
		'selector'            => '.testmonial-area .author-box',
		'settings'            => 'home_testimonial_thumb',
	
	) );
	
	
}

add_action( 'customize_register', 'spiceb_spicepress_register_home_testimonial_section_partials' );


function spiceb_spicepress_testimonial_section_title_render_callback() {
	return get_theme_mod( 'home_testimonial_section_title' );
}

function spiceb_spicepress_testimonial_section_discription_render_callback() {
	return get_theme_mod( 'home_testimonial_section_discription' );
}

function spiceb_spicepress_testimonial_desc_render_callback() {
	return get_theme_mod( 'home_testimonial_desc' );
}

function spiceb_spicepress_testimonial_title_render_callback() {
	return get_theme_mod( 'home_testimonial_title' );
}

function spiceb_spicepress_testimonial_designation_render_callback() {
	return get_theme_mod( 'home_testimonial_designation' );
}
?>