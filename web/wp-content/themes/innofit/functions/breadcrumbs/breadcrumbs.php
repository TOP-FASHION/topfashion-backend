<?php
// theme sub header breadcrumb functions
function innofit_curPageURL() {
	$pageURL = 'http';
	if ( key_exists("HTTPS", $_SERVER) && ( $_SERVER["HTTPS"] == "on" ) ){
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

if( !function_exists('innofit_breadcrumbs') ):
	function innofit_breadcrumbs() { 
			
		global $post;
		$homeLink = home_url();
	?>
		<!-- Page Title Section -->
		<section class="page-title-section" style="background: #17212c url(<?php 
		if(has_post_thumbnail() && !is_archive()) {  // check if the post has a Post Thumbnail assigned to it.
		the_post_thumbnail_url();
		} 
		else
		{
		$header_image_setting = get_theme_mod('header_image_setting');
		if($header_image_setting)
		{ echo esc_url($header_image_setting);}	
		}?> );background-attachment: scroll;
	background-position: top center;
    background-repeat: no-repeat;
    background-size: cover;">
		<div class="overlay"></div>		
			<div class="container">
					<div class="row">
					 <div class="col-md-12 col-sm-12 col-xs-12">
						<div class="page-title text-center">
                           <?php 
						   	$allowed_html = array(
									'br'     => array(),
									'em'     => array(),
									'strong' => array(),
									'i'      => array(
										'class' => array(),
									),
									'span'   => array(),
								);	
                           if(is_home() || is_front_page()) {
                                    echo '<h1 class="text-white">'; echo wp_kses( force_balance_tags(single_post_title()), $allowed_html ); echo '</h1>';
                           } else{
                                    innofit_archive_page_title();
                           } 
                           ?>
                        </div>
						<ul class="page-breadcrumb text-center">
							<?php
														
								if (is_home() || is_front_page()) :
								    echo '<li><a href="'.esc_url($homeLink).'">'.esc_html__('Home','innofit').'</a></li>';
									echo '<li class="active">'; echo wp_kses( force_balance_tags(single_post_title()), $allowed_html ); echo '</li>';
									//echo '<li class="active"><a href="'.$homeLink.'">'.get_bloginfo( 'name' ).'</a></li>';
								 else:
									echo '<li><a href="'.esc_url($homeLink).'">'.esc_html__('Home','innofit').'</a></li>';
									// Blog Category
									if ( is_category() ) {
										echo '<li class="active"><a href="'. innofit_curPageURL() .'">' . esc_html__('Archive by category','innofit').' "' . single_cat_title('', false) . '"</a></li>';

									// Blog Day
									} elseif ( is_day() ) {
										echo '<li class="active"><a href="'. esc_url(get_year_link(esc_attr(get_the_time('Y')))) . '">'. esc_html(get_the_time('Y')) .'</a>';
										echo '<li class="active"><a href="'. esc_url(get_month_link(esc_attr(get_the_time('Y')),esc_attr(get_the_time('m')))) .'">'. esc_html(get_the_time('F')) .'</a>';
										echo '<li class="active"><a href="'. innofit_curPageURL() .'">'. esc_html(get_the_time('d')) .'</a></li>';

									// Blog Month
									} elseif ( is_month() ) {
										echo '<li class="active"><a href="' . get_year_link(esc_attr(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a>';
										echo '<li class="active"><a href="'. innofit_curPageURL() .'">'. esc_html(get_the_time('F')) .'</a></li>';

									// Blog Year
									} elseif ( is_year() ) {
										echo '<li class="active"><a href="'. innofit_curPageURL() .'">'. esc_html(get_the_time('Y')) .'</a></li>';

									// Single Post
									} elseif ( is_single() && !is_attachment() && is_page('single-product') ) {
										
										// Custom post type
										if ( get_post_type() != 'post' ) {
											$cat = get_the_category(); 
											$cat = $cat[0];
											echo '<li>';
												echo get_category_parents($cat, TRUE, '');
											echo '</li>';
											echo '<li class="active"><a href="' . innofit_curPageURL() . '">'. wp_title( '',false ) .'</a></li>';
										} }  
										elseif ( is_page() && $post->post_parent ) {
										$parent_id  = $post->post_parent;
										$breadcrumbs = array();
										while ($parent_id) {
											$page = get_page($parent_id);
											$breadcrumbs[] = '<li class="active"><a href="' . esc_url(get_permalink($page->ID)) . '">' . wp_kses( force_balance_tags(get_the_title($page->ID)), $allowed_html ) . '</a>';
											$parent_id  = $page->post_parent;
										}
										$breadcrumbs = array_reverse($breadcrumbs);
										foreach ($breadcrumbs as $crumb) echo $crumb;
										
										echo '<li class="active"><a href="' . innofit_curPageURL() . '">'. wp_kses( force_balance_tags(get_the_title()), $allowed_html ) .'</a></li>';

									
									}
									elseif( is_search() )
									{
										echo '<li class="active"><a href="' . innofit_curPageURL() . '">'. get_search_query() .'</a></li>';
									}
									elseif( is_404() )
									{
										echo '<li class="active"><a href="' . innofit_curPageURL() . '">'.esc_html__('Error 404','innofit').'</a></li>';
									}
									else { 
										// Default
										echo '<li class="active"><a href="' . innofit_curPageURL() . '">'. wp_kses( force_balance_tags(get_the_title()), $allowed_html ) .'</a></li>';
									}
								endif;
							?>
						</ul>	
						</div>
					</div>
				</div>	
		</section>
		<!-- /Page Title Section -->

		<div class="clearfix"></div>
	<?php }
endif;
?>