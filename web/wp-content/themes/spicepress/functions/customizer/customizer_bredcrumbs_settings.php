<?php function spicepress_breadcrumbs_customizer( $wp_customize ) {
$wp_customize->add_section(
        'breadcrumbs_setting',
        array(
            'title' => esc_html__('Archive page title','spicepress'),
            'description' =>'',
			'priority' => 130,
			)
    );

	$wp_customize->add_setting(
    'archive_prefix',
    array(
        'default' => esc_html__('Archive','spicepress'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'spicepress_template_page_sanitize_text',
		)
	);	
	$wp_customize->add_control( 'archive_prefix',array(
    'label'   => esc_html__('Archive','spicepress'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));	
	
	$wp_customize->add_setting(
    'category_prefix',
    array(
        'default' => esc_html__('Category','spicepress'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'spicepress_template_page_sanitize_text',
		)
	);	
	$wp_customize->add_control( 'category_prefix',array(
    'label'   => esc_html__('Category','spicepress'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));

	$wp_customize->add_setting(
    'author_prefix',
    array(
        'default' => esc_html__('All posts by','spicepress'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'spicepress_template_page_sanitize_text',
		)
	);	
	$wp_customize->add_control( 'author_prefix',array(
    'label'   => esc_html__('Author','spicepress'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));
	
	$wp_customize->add_setting(
    'tag_prefix',
    array(
        'default' => esc_html__('Tag','spicepress'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'spicepress_template_page_sanitize_text',
		)
	);	
	$wp_customize->add_control( 'tag_prefix',array(
    'label'   => esc_html__('Tag','spicepress'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));
	
	
	$wp_customize->add_setting(
    'search_prefix',
    array(
        'default' => esc_html__('Search results for','spicepress'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'spicepress_template_page_sanitize_text',
		)
	);	
	$wp_customize->add_control( 'search_prefix',array(
    'label'   => esc_html__('Search','spicepress'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));
	
	$wp_customize->add_setting(
    '404_prefix',
    array(
        'default' => esc_html__('404','spicepress'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'spicepress_template_page_sanitize_text',
		)
	);	
	$wp_customize->add_control( '404_prefix',array(
    'label'   => esc_html__('404','spicepress'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));
	
	
	$wp_customize->add_setting(
    'shop_prefix',
    array(
        'default' => esc_html__('Shop','spicepress'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'spicepress_template_page_sanitize_text',
		)
	);	
	$wp_customize->add_control( 'shop_prefix',array(
    'label'   => esc_html__('Shop','spicepress'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));
}

add_action( 'customize_register', 'spicepress_breadcrumbs_customizer' ); 


function spicepress_template_page_sanitize_text( $input ) {

			return wp_kses_post( force_balance_tags( $input ) );

			}
?>