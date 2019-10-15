<?php
function spiceb_spicepress_project_customizer( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
	/* Portfolio Section */
	$wp_customize->add_section( 'portfolio_section' , array(
			'title'      => __('Portfolio settings', 'spicepress'),
			'panel'  => 'section_settings',
			'priority'   => 4,
		) );
		
		// Enable portfolio more btn
		$wp_customize->add_setting( 'portfolio_section_enable' , array( 'default' => 'on') );
		$wp_customize->add_control(	'portfolio_section_enable' , array(
				'label'    => __( 'Enable Home Portfolio section', 'spicepress' ),
				'section'  => 'portfolio_section',
				'type'     => 'radio',
				'choices' => array(
					'on'=>__('ON', 'spicepress'),
					'off'=>__('OFF', 'spicepress')
				)
		));	
		
		// portfolio section title
		$wp_customize->add_setting( 'home_portfolio_section_title',array(
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'spiceb_spicepress_home_page_sanitize_text',
		'default' => __('Our Portfolio','spicepress'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_portfolio_section_title',array(
		'label'   => __('Title','spicepress'),
		'section' => 'portfolio_section',
		'type' => 'text',
		));	
		
		//portfolio section discription
		$wp_customize->add_setting( 'home_portfolio_section_discription',array(
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'spiceb_spicepress_home_page_sanitize_text',
		'default' => 'Sea summo mazim ex, ea errem eleifend definitionem vim. Ut nec hinc dolor possim mei ludus efficiendi ei sea summo mazim ex.',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_portfolio_section_discription',array(
		'label'   => __('Description','spicepress'),
		'section' => 'portfolio_section',
		'type' => 'textarea',
		));	
	 
	 
		//Portfolio one image
		$wp_customize->add_setting( 'portfolio_one_thumb',array('default' => SPICEB_PLUGIN_URL .'inc/spicepress/images/portfolio/item1.jpg',
		'sanitize_callback' => 'esc_url_raw', 'transport'         => $selective_refresh, ));
	 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'portfolio_one_thumb',
				array(
					'label' => __('Image','spicebox'),
					'section' => 'example_section_one',
					'settings' =>'portfolio_one_thumb',
					'section' => 'portfolio_section',
					'type' => 'upload',
				)
			)
		);
		
		
		//Portfolio one Title
		$wp_customize->add_setting(
		'portfolio_one_title', array(
			'default'        => __('Art Office Design','spicebox'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('portfolio_one_title', array(
			'label'   => __('Title', 'spicebox'),
			'section' => 'portfolio_section',
			'type' => 'text',
		));
		
		//Portfolio one description
		$wp_customize->add_setting(
		'portfolio_one_desc', array(
			'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit..',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('portfolio_one_desc', array(
			'label'   => __('Description', 'spicebox'),
			'section' => 'portfolio_section',
			'type' => 'text',
		));
		
		
		
		//Portfolio two image
		$wp_customize->add_setting( 'portfolio_two_thumb',array('default' => SPICEB_PLUGIN_URL .'inc/spicepress/images/portfolio/item2.jpg',
		'sanitize_callback' => 'esc_url_raw','transport'         => $selective_refresh,));
	 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'portfolio_two_thumb',
				array(
					'label' => __('Image','spicebox'),
					'section' => 'example_section_one',
					'settings' =>'portfolio_two_thumb',
					'section' => 'portfolio_section',
					'type' => 'upload',
				)
			)
		);
		
		
		//Portfolio two Title
		$wp_customize->add_setting(
		'portfolio_two_title', array(
			'default'        => __('Graphics Design','spicebox'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('portfolio_two_title', array(
			'label'   => __('Title', 'spicebox'),
			'section' => 'portfolio_section',
			'type' => 'text',
		));
		
		//Portfolio two description
		$wp_customize->add_setting(
		'portfolio_two_desc', array(
			'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit..',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('portfolio_two_desc', array(
			'label'   => __('Description', 'spicebox'),
			'section' => 'portfolio_section',
			'type' => 'text',
		));
		
		//Portfolio three image
		$wp_customize->add_setting( 'portfolio_three_thumb',array('default' => SPICEB_PLUGIN_URL .'inc/spicepress/images/portfolio/item3.jpg',
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => $selective_refresh,
		));
	 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'portfolio_three_thumb',
				array(
					'label' => __('Image','spicebox'),
					'section' => 'example_section_one',
					'settings' =>'portfolio_three_thumb',
					'section' => 'portfolio_section',
					'type' => 'upload',
				)
			)
		);
		
		//Portfolio three Title
		$wp_customize->add_setting(
		'portfolio_three_title', array(
			'default'        => __('WordPress Themes','spicebox'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('portfolio_three_title', array(
			'label'   => __('Title', 'spicebox'),
			'section' => 'portfolio_section',
			'type' => 'text',
		));
		
		//Portfolio three description
		$wp_customize->add_setting(
		'portfolio_three_desc', array(
			'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit..',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('portfolio_three_desc', array(
			'label'   => __('Description', 'spicebox'),
			'section' => 'portfolio_section',
			'type' => 'text',
		));
		
		
		//Pro portfolio	
		class WP_portfolio_pro_Customize_Control extends WP_Customize_Control {
		public $type = 'new_menu';
		/**
		* Render the control's content.
		*/
		public function render_content() {
		?>
		 <div class="pro-vesrion">
		 <P><?php esc_html_e('More options available for portfolio section in SpicePress Pro','spicepress');?></P>
		 </div>
		  <div class="pro-box">
		 <a href="<?php echo esc_url('https://helpdoc.spicethemes.com/spicepress/how-to-manage-homepage-portfolio-in-spicepress-theme/');?>" class="read-more-button" id="review_pro" target="_blank"><?php esc_html_e( 'Read More','spicepress' ); ?></a>
		 <div>
		<?php
		}
	    }

		$wp_customize->add_setting(
			'add_pro_portfolio',
			array(
				'capability'     => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field',
			)	
		);
		$wp_customize->add_control( new WP_portfolio_pro_Customize_Control( $wp_customize, 'add_pro_portfolio', array(	
				'section' => 'portfolio_section',
				'setting' => 'add_pro_portfolio',
		
		)));
		
		

}		
add_action( 'customize_register', 'spiceb_spicepress_project_customizer' );


/**
 * Add selective refresh for Front page section section controls.
 */
function spiceb_spicepress_register_home_project_section_partials( $wp_customize ){

	
	//Portfolio section
	$wp_customize->selective_refresh->add_partial( 'home_portfolio_section_title', array(
		'selector'            => '.portfolio-section .section-header .widget-title',
		'settings'            => 'home_portfolio_section_title',
		'render_callback'  => 'spiceb_spicepress_portfolio_section_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_portfolio_section_discription', array(
		'selector'            => '.portfolio-section .section-header p',
		'settings'            => 'home_portfolio_section_discription',
		'render_callback'  => 'spiceb_spicepress_portfolio_section_discription_render_callback',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'portfolio_one_title', array(
		'selector'            => '.port1 .entry-header .entry-title > a',
		'settings'            => 'portfolio_one_title',
		'render_callback'  => 'spiceb_spicepress_portfolio_one_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'portfolio_one_desc', array(
		'selector'            => '.port1 .entry-content p',
		'settings'            => 'portfolio_one_desc',
		'render_callback'  => 'spiceb_spicepress_portfolio_one_desc_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'portfolio_one_thumb', array(
		'selector'            => '.port1 .post-thumbnail',
		'settings'            => 'portfolio_one_thumb',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'portfolio_two_title', array(
		'selector'            => '.port2 .entry-header .entry-title > a',
		'settings'            => 'portfolio_two_title',
		'render_callback'  => 'spiceb_spicepress_portfolio_two_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'portfolio_two_desc', array(
		'selector'            => '.port2 .entry-content p',
		'settings'            => 'portfolio_two_desc',
		'render_callback'  => 'spiceb_spicepress_portfolio_two_desc_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'portfolio_two_thumb', array(
		'selector'            => '.port2 .post-thumbnail',
		'settings'            => 'portfolio_two_thumb',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'portfolio_three_title', array(
		'selector'            => '.port3 .entry-header .entry-title > a',
		'settings'            => 'portfolio_three_title',
		'render_callback'  => 'spiceb_spicepress_portfolio_three_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'portfolio_three_desc', array(
		'selector'            => '.port3 .entry-content p',
		'settings'            => 'portfolio_three_desc',
		'render_callback'  => 'spiceb_spicepress_portfolio_three_desc_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'portfolio_three_thumb', array(
		'selector'            => '.port3 .post-thumbnail',
		'settings'            => 'portfolio_three_thumb',
	
	) );
	
}

add_action( 'customize_register', 'spiceb_spicepress_register_home_project_section_partials' );


function spiceb_spicepress_portfolio_section_title_render_callback() {
	return get_theme_mod( 'home_portfolio_section_title' );
}

function spiceb_spicepress_portfolio_section_discription_render_callback() {
	return get_theme_mod( 'home_portfolio_section_discription' );
}


function spiceb_spicepress_portfolio_one_title_render_callback() {
	return get_theme_mod( 'portfolio_one_title' );
}


function spiceb_spicepress_portfolio_one_desc_render_callback() {
	return get_theme_mod( 'portfolio_one_desc' );
}


function spiceb_spicepress_portfolio_one_thumb_render_callback() {
	return get_theme_mod( 'portfolio_one_thumb' );
}



function spiceb_spicepress_portfolio_two_title_render_callback() {
	return get_theme_mod( 'portfolio_two_title' );
}


function spiceb_spicepress_portfolio_two_desc_render_callback() {
	return get_theme_mod( 'portfolio_two_desc' );
}


function spiceb_spicepress_portfolio_two_thumb_render_callback() {
	return get_theme_mod( 'portfolio_two_thumb' );
}


function spiceb_spicepress_portfolio_three_title_render_callback() {
	return get_theme_mod( 'portfolio_three_title' );
}


function spiceb_spicepress_portfolio_three_desc_render_callback() {
	return get_theme_mod( 'portfolio_three_desc' );
}


function spiceb_spicepress_portfolio_three_thumb_render_callback() {
	return get_theme_mod( 'portfolio_three_thumb' );
}
	?>