<?php	
add_action( 'widgets_init', 'innofit_widgets_init');
function innofit_widgets_init() {
	
   /*sidebar*/
	
	register_sidebar( array(
		'name' => esc_html__('Sidebar widget area','innofit'),
		'id' => 'sidebar_primary',
		'description' => esc_html__('Sidebar widget area','innofit'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
		
	register_sidebar( array(
		'name' => esc_html__( 'Footer widget left area', 'innofit' ),
		'id' => 'footer_widget_area_left',
		'description' => esc_html__( 'Footer widget left area', 'innofit' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Footer widget central area', 'innofit' ),
		'id' => 'footer_widget_area_center',
		'description' => esc_html__( 'Footer widget central area', 'innofit' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => esc_html__( 'Footer widget right area', 'innofit' ),
		'id' => 'footer_widget_area_right',
		'description' => esc_html__( 'Footer widget right area', 'innofit' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	// Header Social Icon Sidebar
	register_sidebar( array(
		'name' => esc_html__( 'Social media menu lateral area', 'innofit' ),
		'id' => 'menu_social_media_sidebar',
		'description' => esc_html__('Social media menu lateral area', 'innofit' ),
		'before_widget' => '<div id="%1$s" class="header-social-icon %2$s">',
		'after_widget' => '</div>',
	));
	
	// Subscribe Sidebar
	register_sidebar( array(
		'name' => esc_html__( 'Subscriber section widget area', 'innofit' ),
		'id' => 'subscribe-widgets',
		'description' => esc_html__('Subscriber section widget area', 'innofit' ),
	));
	
	
	register_sidebar( array(
	'name' => esc_html__('WooCommerce sidebar widget area', 'innofit' ),
	'id' => 'woocommerce',
	'description' => esc_html__( 'WooCommerce sidebar widget area', 'innofit' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => '</aside>',
	'before_title' => '<h5 class="widget-title">',
	'after_title' => '</h5>',
	) );
	
	
}	                     
?>