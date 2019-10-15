<?php
$activate = array(
        'sidebar_primary' => array(
            'search-1',
            'recent-posts-1',
            'archives-1',
        ),
        'footer_widget_area_left' => array(
           'innofit_featured_latest_news-2',
        ),
        'footer_widget_area_right' => array(
            'categories-2',
        ),
        'footer_widget_area_center' => array(
            'pages-2'
        ),
		
		'menu_social_media_sidebar' => array(
            'innofit_social_icon_widget-2'
        ),
		
    );

    /* the default titles will appear */
   
    update_option('widget_innofit_featured_latest_news', array(
        1 => array('title' => 'Latest News'), 
        2 => array('title' => 'Latest News')));

    update_option('widget_categories', array(
        1 => array('title' => 'Categories'), 
        2 => array('title' => 'Categories')));

    update_option('widget_archives', array(
        1 => array('title' => 'Archives'), 
        2 => array('title' => 'Archives')));
        
    update_option('widget_search', array(
        1 => array('title' => 'Search'), 
        2 => array('title' => 'Search')));
		
	update_option('widget_innofit_social_icon_widget', array(
       2 => array('facebook_link' => '#', 'twitter_link' => '#', 'google_plus_link' => '#')));	

		
	update_option('widget_pages', array(
        1 => array('title' => 'Useful Links'), 
        2 => array('title' => 'Useful Links')));

    update_option('sidebars_widgets',  $activate);
	$MediaId = get_option('innofit_media_id');
	set_theme_mod( 'custom_logo', $MediaId[0] );
	set_theme_mod( 'header_textcolor', "blank" );
?>