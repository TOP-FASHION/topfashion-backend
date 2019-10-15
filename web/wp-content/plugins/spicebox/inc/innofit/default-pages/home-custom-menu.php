<?php $run_once = get_option('menu_check');
if (!$run_once){
    //give your menu a name
    $name = 'primary';
    //create the menu
    $menu_id = wp_create_nav_menu($name);
    //then get the menu object by its name
    $menu = get_term_by( 'name', $name, 'nav_menu' );

    //then add the actuall link/ menu item and you do this for each item you want to add
    wp_update_nav_menu_item($menu->term_id, 0, array(
        'menu-item-title' =>  __('Home'),
        'menu-item-url' => '#totop', 
        'menu-item-status' => 'publish',
		'menu-item-position' => 1,
		));
		
	  wp_update_nav_menu_item($menu->term_id, 0, array(
        'menu-item-title' =>  __('Service'),
        'menu-item-url' => '#services', 
        'menu-item-status' => 'publish',
		'menu-item-position' => 2,
		));
		
	wp_update_nav_menu_item($menu->term_id, 0, array(
        'menu-item-title' =>  __('About'),
        'menu-item-url' => '#about', 
        'menu-item-status' => 'publish',
		'menu-item-position' => 3,
		));
		
	wp_update_nav_menu_item($menu->term_id, 0, array(
        'menu-item-title' =>  __('Team'),
        'menu-item-url' => '#team', 
        'menu-item-status' => 'publish',
		'menu-item-position' => 4,
		));
	
	wp_update_nav_menu_item($menu->term_id, 0, array(
        'menu-item-title' =>  __('Blog'),
        'menu-item-url' => '#blog', 
        'menu-item-status' => 'publish',
		'menu-item-position' => 5,
		));
		
	wp_update_nav_menu_item($menu->term_id, 0, array(
        'menu-item-title' =>  __('Contact'),
        'menu-item-url' => '#contact', 
        'menu-item-status' => 'publish',
		'menu-item-position' => 6,
		));
	
	wp_update_nav_menu_item($menu->term_id, 0, array(
        'menu-item-title' =>  __('Callout'),
        'menu-item-url' => '#call-to-action', 
        'menu-item-status' => 'publish',
		'menu-item-position' => 7,
		));	
		
		
	//then you set the wanted theme  location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary'] = $menu->term_id;
    set_theme_mod( 'nav_menu_locations', $locations );

    // then update the menu_check option to make sure this code only runs once
    update_option('menu_check', true);
} ?>