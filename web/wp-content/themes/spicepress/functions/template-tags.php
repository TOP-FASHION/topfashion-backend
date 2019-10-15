<?php
if ( ! function_exists( 'spicepress_blog_meta_content' ) ) :
function spicepress_blog_meta_content()
{ 
	$blog_meta_section_enable = get_theme_mod('blog_meta_section_enable',true);
	
	if( $blog_meta_section_enable == true ) { ?>
	<div class="entry-meta">
		<span class="entry-date">
			<a href="<?php echo esc_url(get_month_link(esc_html(get_post_time('Y')),esc_html(get_post_time('m')))); ?>"><time datetime=""><?php echo esc_html(get_the_date('M j, Y')); ?></time></a>
		</span>
	</div>
<?php } 
}
endif;

if ( ! function_exists( 'spicepress_blog_category_content' ) ) :
function spicepress_blog_category_content()
{
	$blog_meta_section_enable = get_theme_mod('blog_meta_section_enable',true);
	
	if( $blog_meta_section_enable == true ) {

?>
<div class="entry-meta">
	<span class="author"><?php esc_html_e('By','spicepress');?> <a rel="tag" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php echo esc_html(get_the_author());?></a>
	
	</span>
	<?php 	
	$cat_list = get_the_category_list();
		if(!empty($cat_list)) { ?>
	<span class="cat-links"><?php esc_html_e('in','spicepress');?><a href="<?php the_permalink(); ?>"><?php the_category(', '); ?></a></span>
	<?php } 
	    $tag_list = get_the_tag_list();
		if(!empty($tag_list)) { ?>
				<span class="tag-links"><?php esc_html_e('Tag','spicepress');?> <?php the_tags('', ', ', ''); ?></span>
				<?php } ?>

</div>	 
<?php } } endif;
// avator class
function spicepress_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='img-responsive img-circle", $class);
    return $class;
}
add_filter('get_avatar','spicepress_gravatar_class');


// spicepress author meta
function spicepress_author_meta()
{ ?>
<article class="blog-author wow fadeInDown animated" data-wow-delay="0.4s">
	<div class="media">
		<div class="pull-left">
			<?php echo get_avatar( get_the_author_meta('ID'), 200); ?>
		</div>
		<div class="media-body">
			<h6><?php the_author_link(); ?></h6>
			<p><?php the_author_meta( 'description' ); ?></p>
			<ul class="blog-author-social">
			    <?php $facebook_profile = get_the_author_meta( 'facebook_profile' ); if ( $facebook_profile && $facebook_profile != '' ): ?>
				<li class="facebook"><a href="<?php echo esc_url($facebook_profile); ?>"><i class="fa fa-facebook"></i></a></li>
				<?php endif; ?>
				<?php $linkedin_profile = get_the_author_meta( 'linkedin_profile' ); if ( $linkedin_profile && $linkedin_profile != '' ): ?>
				<li class="linkedin"><a href="<?php echo esc_url($linkedin_profile); ?>"><i class="fa fa-linkedin"></i></a></li>
				<?php endif; ?>
				<?php $twitter_profile = get_the_author_meta( 'twitter_profile' ); if ( $twitter_profile && $twitter_profile != '' ): ?>
				<li class="twitter"><a href="<?php echo esc_url($twitter_profile); ?>"><i class="fa fa-twitter"></i></a></li>
				<?php endif; ?>
				<?php $google_profile = get_the_author_meta( 'google_profile' ); if ( $google_profile && $google_profile != '' ): ?>
				<li class="googleplus"><a href="<?php echo esc_url($google_profile); ?>"><i class="fa fa-google-plus"></i></a></li>
				<?php endif; ?>
		   </ul>
		</div>
	</div>	
</article>
<?php }

// author profile data
function spicepress_author_social_icons( $contactmethods ) {
		$contactmethods['facebook_profile'] = 'Facebook Profile URL';
		$contactmethods['twitter_profile'] = 'Twitter Profile URL';
		$contactmethods['linkedin_profile'] = 'Linkedin Profile URL';
		$contactmethods['google_profile'] = 'Google Profile URL';
		return $contactmethods;
	}
add_filter( 'user_contactmethods', 'spicepress_author_social_icons', 10, 1);

// blogs,pages and archive page title
function spicepress_archive_page_title(){
	if( is_archive() )
	{
		$archive_text = get_theme_mod('archive_prefix', __('Archive','spicepress'));
		
		echo '<div class="page-title wow bounceInLeft animated" ata-wow-delay="0.4s"><h1>';
		
		if ( is_day() ) :
		
		  printf( esc_html__( '%1$s %2$s', 'spicepress' ), esc_html($archive_text), esc_html(get_the_date()) );
		  
        elseif ( is_month() ) :
		
		  printf( esc_html__( '%1$s %2$s', 'spicepress' ), esc_html($archive_text), esc_html(get_the_date( 'F Y' )) );
		  
        elseif ( is_year() ) :
		
		  printf( esc_html__( '%1$s %2$s', 'spicepress' ), esc_html($archive_text), esc_html(get_the_date( 'Y' )) );
		  
        elseif( is_category() ):
		
			$category_text = get_theme_mod('category_prefix',__('Category','spicepress'));
			
			printf( esc_html__( '%1$s %2$s', 'spicepress' ), esc_html($category_text), single_cat_title( '', false ) );
			
		elseif( is_author() ):
			
			$author_text = get_theme_mod('author_prefix',__('All posts by','spicepress'));
		
			printf( esc_html__( '%1$s %2$s', 'spicepress' ), esc_html($author_text), esc_html(get_the_author() ));
			
		elseif( is_tag() ):
			
			$tag_text = get_theme_mod('tag_prefix',__('Tag','spicepress'));
			
			printf( esc_html__( '%1$s %2$s', 'spicepress' ), esc_html($tag_text), single_tag_title( '', false ) );
			
		elseif( class_exists( 'WooCommerce' ) && is_shop() ):
			
		$shop_text = get_theme_mod('shop_prefix',__('Shop','spicepress'));
			
		printf( esc_html__( '%1$s %2$s', 'spicepress' ), esc_html($shop_text), single_tag_title( '', false ));
			
        elseif( is_archive() ): 
		the_archive_title( '<h1>', '</h1>' ); 
		
		endif;
		

		echo '</h1></div>';
	}
	elseif( is_search() )
	{
		$search_text = get_theme_mod('search_prefix',__('Search results for','spicepress'));
		
		echo '<div class="page-title wow bounceInLeft animated" ata-wow-delay="0.4s"><h1>';
		
		printf( esc_html__( '%1$s %2$s', 'spicepress' ), esc_html($search_text), get_search_query() );
		
		echo '</h1></div>';
	}
	elseif( is_404() )
	{
		$breadcrumbs_text = get_theme_mod('404_prefix',__('404','spicepress'));
		
		echo '<div class="page-title wow bounceInLeft animated" ata-wow-delay="0.4s"><h1>';
		
		printf( esc_html__( '%1$s ', 'spicepress' ) , esc_html($breadcrumbs_text) );
		
		echo '</h1></div>';
	}
	else
	{
		  	$allowed_html = array(
									'br'     => array(),
									'em'     => array(),
									'strong' => array(),
									'i'      => array(
										'class' => array(),
									),
									'span'   => array(),
								);	
		
		echo '<div class="page-title wow bounceInLeft animated" ata-wow-delay="0.4s"><h1>'.wp_kses( force_balance_tags( get_the_title()), $allowed_html ).'</h1></div>';
	}
}

function spicepress_excerpt_more( $more ) {
	return '</div><div class="blog-btn"><a href="' . esc_url(get_permalink()) . '" class="home-blog-btn">'.esc_html__('Read More','spicepress').'</a>';
}
add_filter( 'excerpt_more', 'spicepress_excerpt_more' );

// spicepress post navigation
function spicepress_post_nav()
{
	global $post;
	echo '<div style="text-align:center;">';
	posts_nav_link( ' &#183; ', esc_html__('previous page','spicepress'), esc_html__('next page','spicepress') );
	echo '</div>';
}

add_filter( 'widget_text', 'do_shortcode' );



//Hide Title of woocommerce shop page
add_filter( 'woocommerce_show_page_title' , 'spicepress_woo_hide_page_title' );
function spicepress_woo_hide_page_title() {
	
	return false;
	
}

if(!function_exists( 'spicepress_image_thumbnail')) : 					
		function spicepress_image_thumbnail($preset,$class){
		if(has_post_thumbnail()){  $defalt_arg =array('class' => $class);
	the_post_thumbnail($preset, $defalt_arg); } } 
endif;

// Custom header function
if ( ! function_exists( 'spicepress_header_style' ) ) :

function spicepress_header_style() {
    $text_color = get_header_textcolor();

    // If no custom color for text is set, let's bail.
    if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
        return;
    ?>
    <style type="text/css" id="spicepress-header-css">
        <?php
        // Has the text been hidden?
        if ( ! display_header_text() ) :
    ?>
        .site-title,
        .site-description {
            clip: rect(1px 1px 1px 1px); /* IE7 */
            clip: rect(1px, 1px, 1px, 1px);
            position: absolute;
        }
    <?php
        // If the user has set a custom color for the text, use that.
        elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) :
    ?>
        .site-title a {
            color: #<?php echo esc_attr( $text_color ); ?>;
        }
    <?php endif; ?>
    </style>
    <?php
}
endif;


/*----Function for the menu breakpoint----*/ 

add_action('wp_head','spicepress_custom_menu_breakpoint');
function spicepress_custom_menu_breakpoint() {
	
$menu_breakpoint = get_theme_mod('menu_breakpoint', 1100);
?>
<style type="text/css">


@media (max-width: <?php echo $menu_breakpoint; ?>px) { 
	.navbar-custom .dropdown-menu {
		border-top: none;
		border-bottom: none;	
		box-shadow: none !important;
		border: none;
	}		
}

@media (min-width: 100px) and (max-width: <?php echo $menu_breakpoint; ?>px) { 
	.navbar .navbar-nav > .active > a, 
	.navbar .navbar-nav > .active > a:hover, 
	.navbar .navbar-nav > .active > a:focus {
		color: #ce1b28;
		background-color: transparent;
	}
	.navbar .navbar-nav > .open > a,
	.navbar .navbar-nav > .open > a:hover,
	.navbar .navbar-nav > .open > a:focus { 
		background-color: transparent; 
		color: #ce1b28; 
		border-bottom: 1px dotted #4c4a5f; 
	}
}




/*===================================================================================*/
/*	NAVBAR
/*===================================================================================*/

.navbar-custom {
	background-color: #fff;
	border: 0;
	border-radius: 0;
	z-index: 1000;
	font-size: 1.000rem;
	transition: background, padding 0.4s ease-in-out 0s;
	margin: 0; 
	min-height: 90px;
}
.navbar a { transition: color 0.125s ease-in-out 0s; }
.navbar-custom .navbar-brand {
	letter-spacing: 1px;
	font-weight: 600;
	font-size: 2.000rem;
    line-height: 1.5;
	color: #1b1b1b;
	margin-left: 0px !important;
	height: auto;
	padding: 26px 30px 26px 15px;
}
.site-branding-text { float: left; margin: 0; padding: 13px 50px 13px 0; }
.site-title { height: auto; font-size: 1.875rem; line-height: 1.3; font-weight: 600; margin: 0; padding: 0px; }
.site-description { padding: 0; margin: 0; }
.navbar-custom .navbar-nav li { margin: 0px; padding: 0; }
.navbar-custom .navbar-nav li > a {
	position: relative;
	color: #1b1b1b;
	font-weight: 600;
	font-size: 0.875rem;
	padding: 35px 17px;
    transition: all 0.3s ease-in-out 0s;
}
.navbar-custom .navbar-nav li > a > i {
    padding-left: 5px;
}

/*Dropdown Menu*/
.navbar-custom .dropdown-menu {
	border-radius: 0;
	padding: 0;
	min-width: 200px;
    background-color: #21202e;
    box-shadow: 0 0 3px 0 rgba(0, 0, 0, 0.5);
	position: static;
	float: none;
	width: auto;
	margin-top: 0;
}
.navbar-custom .dropdown-menu > li { padding: 0 10px; margin: 0; }
.navbar-custom .dropdown-menu > li > a {
	color: #d5d5d5;
    border-bottom: 1px dotted #363544;
    font-weight: 600;
    font-size: 0.875rem;
    padding: 12px 15px;
    transition: all 0.2s ease-in-out 0s;
    letter-spacing: 0.7px;	
	white-space: normal;
}
.navbar-custom .dropdown-menu > li > a:hover, 
.navbar-custom .dropdown-menu > li > a:focus {
    padding: 12px 15px 12px 20px;
}
.navbar-custom .dropdown-menu > li > a:hover, 
.navbar-custom .dropdown-menu > li > a:focus {
    color: #ffffff;
    background-color: #282737;
}
.navbar-custom .dropdown-menu .dropdown-menu {
	left: 100%;
	right: auto;
	top: 0;
	margin-top: 0;
}
.navbar-custom .dropdown-menu.left-side .dropdown-menu {
	border: 0;
	right: 100%;
	left: auto;
}
.navbar-custom .dropdown-menu .open > a,
.navbar-custom .dropdown-menu .open > a:focus,
.navbar-custom .dropdown-menu .open > a:hover {
	background: #282737;
	color: #fff;
}
.nav .open > a, 
.nav .open > a:hover, 
.nav .open > a:focus { 
	border-color: #363544;
} 
.navbar-custom .dropdown-menu > .active > a, 
.navbar-custom .dropdown-menu > .active > a:hover, 
.navbar-custom .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: transparent;
}
.navbar-custom .navbar-toggle .icon-bar { background: #121213; width: 40px; height: 2px; }
.navbar-toggle .icon-bar + .icon-bar { margin-top: 8px; }


/*--------------------------------------------------------------
	Menubar - Media Queries
--------------------------------------------------------------*/

@media (min-width: <?php echo $menu_breakpoint; ?>px){

	.navbar-collapse.collapse {
		display: block !important;
	}
	.navbar-nav {
		margin: 0;
	}
	.navbar-custom .navbar-nav > li {
		float: left;
	}
	.navbar-header {
		float: left;
	}
	.navbar-toggle {
		display: none;
	}
}



@media (min-width: 768px){
	.navbar-custom .navbar-brand {
		padding: 20px 50px 20px 0;
	}
}
@media (min-width: <?php echo $menu_breakpoint; ?>px) {
	.navbar-transparent { background: transparent; padding-bottom: 0px; padding-top: 0px; margin: 0; }
	.navbar-custom .open > .dropdown-menu { visibility: visible; opacity: 1; }
	.navbar-right .dropdown-menu { right: auto; left: 0; }
}
 
<?php if($menu_breakpoint < 991){ ?>
@media (min-width: 200px) and (max-width: 991px) {
	.navbar-custom .container-fluid {
		width: auto !important;
	}
}

<?php } ?>

@media (min-width: <?php echo $menu_breakpoint+1; ?>px) {
	.navbar-custom .container-fluid {
		width: 970px;
		padding-right: 15px;
		padding-left: 15px;
		margin-right: auto;
		margin-left: auto;
	}
	
	.navbar-custom .dropdown-menu { 
		border-top: 2px solid #ce1b28 !important;
		border-bottom: 2px solid #ce1b28 !important;
		position: absolute !important; 
		display: block; 
		visibility: hidden; 
		opacity: 0; 
	}
	.navbar-custom .dropdown-menu > li > a { padding: 12px 15px !important; }
	.navbar-custom .dropdown-menu > li > a:hover, 
	.navbar-custom .dropdown-menu > li > a:focus {
		padding: 12px 15px 12px 20px !important;
	}	
	.navbar-custom .open .dropdown-menu { background-color: #21202e !important; }
	
	.navbar-custom .dropdown-menu > li > a i {
        float: right;
    }

}
@media (min-width: 1200px) {
	.navbar-custom .container-fluid {
		width: 1170px;
		padding-right: 15px;
		padding-left: 15px;
		margin-right: auto;
		margin-left: auto;
	}
}


/** BELOW MAX-WIDTH MEDIA QUERIES **/

@media (max-width: <?php echo $menu_breakpoint; ?>px) {
	/* Navbar */
	.navbar-custom .navbar-nav { letter-spacing: 0px; margin-top: 1px; margin-bottom: 0; }
	.navbar-custom .navbar-nav li { margin: 0 15px; padding: 0; }
	.navbar-custom .navbar-nav li > a { color: #bbb; padding: 12px 0px 12px 0px; }
	.navbar-custom .navbar-nav > li > a:focus,
	.navbar-custom .navbar-nav > li > a:hover {
		background: transparent;
		color: #fff;
	}
	.navbar-custom .dropdown-menu > li > a {
		display: block;
		clear: both;
		font-weight: normal;
	}
	.navbar-custom .dropdown-menu > li > a:hover, 
	.navbar-custom .dropdown-menu > li > a:focus {
		background-color: #21202F;
		color: #fff;
		padding: 12px 0px 12px 0px;
	}
	.navbar-custom .open .dropdown-menu {
		position: static;
		float: none;
		width: auto;
		margin-top: 0;
		background-color: transparent;
		border: 0;
		-webkit-box-shadow: none;
		box-shadow: none;
	}
	.navbar-custom .open .dropdown-menu > li > a {
		line-height: 20px;
	}
	.navbar-custom .open .dropdown-menu .dropdown-header,
	.navbar-custom .open .dropdown-menu > li > a {
		padding: 12px 0px;
	}
	.navbar-custom .open .dropdown-menu .dropdown-menu .dropdown-header,
	.navbar-custom .open .dropdown-menu .dropdown-menu > li > a {
		padding: 12px 0px;
	}
	.navbar-custom li a,
	.navbar-custom .dropdown-search {
		border-bottom: 1px dotted #4c4a5f !important;
	}
	.navbar-header { padding: 0px 15px; float: none; }
	.navbar-custom .navbar-brand { padding: 20px 50px 20px 0px; }
	.navbar-toggle { display: block; margin: 24px 15px 24px 0; padding: 9px 0px; }
	.site-branding-text { padding: 17px 50px 17px 15px; }
	.navbar-collapse { border-top: 1px solid transparent; box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1); }
	.navbar-collapse.collapse { display: none!important; }
	.navbar-custom .navbar-nav { background-color: #21202e; float: none!important; margin: 0px }
	.navbar-custom .navbar-nav > li { float: none; }
	.navbar-collapse.collapse.in { display: block!important; }
	.collapsing { overflow: hidden!important; }
	
}
@media (max-width: <?php echo $menu_breakpoint; ?>px) { 
	.navbar-custom .dropdown a > i.fa {
		font-size: 0.938rem;
		position: absolute;
		right: 0;
		margin-top: -6px;
		top: 50%;
		padding-left: 7px;
	}	
}
@media (max-width: 768px) {
	.navbar-header { padding: 0 15px; }
	.navbar-custom .navbar-brand { padding: 20px 50px 20px 15px; }
}
@media (max-width: 500px) { 
	.navbar-custom .navbar-brand { float: none; display: block; text-align: center; padding: 25px 15px 12px 15px; }
	.navbar-custom .navbar-brand img { margin: 0 auto; }
	.site-branding-text { padding: 17px 15px 17px 15px; float: none; text-align: center; }
	.navbar-toggle { float: none; margin: 10px auto 25px; }	
}



/*===================================================================================*/
/*	CART ICON 
/*===================================================================================*/
.cart-header {
	width: 40px;
	height: 40px;
	line-height: 1.6;
	text-align: center;
	background: transparent;
	position: relative;
	float: right;
	margin: 25px 7px 25px 20px;
}
.cart-header > a.cart-icon {
    -wekbit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
    display: inline-block;
    font-size: 1.125rem;
    color: #202020;
    width: 100%;
    height: 100%;
	border: 1px solid #eaeaea;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	border-radius: 50%;
	padding: 4px;
}
.cart-header > a .cart-total {
    font-family: 'Open Sans', Sans-serif;
    font-size: 0.688rem;
	line-height: 1.7;
    color: #ffffff;
	font-weight: 600;
    position: absolute;
    right: -7px;
    top: -7px;
	padding: 1px;
    width: 1.225rem;
    height: 1.225rem;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
	-wekbit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}
@media (min-width: 100px) and (max-width: <?php echo $menu_breakpoint; ?>px) { 
.cart-header { float: left; margin: 20px 7px 20px 15px !important; }
.cart-header > a.cart-icon { color: #fff; }
}


/*--------------------------------------------------------------
	Navbar Overlapped & Stiky Header Css
--------------------------------------------------------------*/

body.page .header-overlapped ~ #slider-carousel,
body.woocommerce-page .header-overlapped ~ #slider-carousel { margin: -70px 0 70px; }
body.page-template.page-template-template-business .header-overlapped ~ #slider-carousel, 
body.blog .header-overlapped, 
body.page-template.page-template-template-overlapped .header-overlapped ~ #slider-carousel { 
	margin: 0px; 
}
body.page-template-template-business .header-overlapped, 
body.page-template-template-overlaped .header-overlapped { 
    background-color: transparent; 
    margin: 0; 
    position: relative; 
    z-index: 99; 
}
.header-overlapped .page-title-section { background-color: transparent !important; }
.navbar-overlapped {
	position: absolute;
	right: 0;
	left: 0;
	top: 0;
	z-index: 20;
	background-color: rgba(0,0,0,0.2);
}
@media (min-width:500px) {
    body.page-template-template-business .navbar-overlapped { 
        position: absolute; 
        right: 0; 
        left: 0; 
        top: 0; 
        z-index: 20;
    }
}
.navbar-overlapped { min-height: 90px; position: relative; }
.header-overlapped .page-seperate {display: none;}
.navbar-overlapped .navbar-brand { padding: 20px 0px; color: #ffffff; }
.navbar-overlapped .navbar-brand:hover, 
.navbar-overlapped .navbar-brand:focus { 
	color: #ffffff; 
}
.navbar-overlapped .site-title a, 
.navbar-overlapped .site-title a:hover, 
.navbar-overlapped .site-title a:focus, 
.navbar-overlapped .site-description {
    color: #fff;
}
.navbar-overlapped .navbar-nav > li > a {
	color: #fff;
	border-bottom: 2px solid transparent;
	margin-left: 5px;
	margin-right: 5px;
}
.navbar-overlapped .navbar-nav > li > a:hover, 
.navbar-overlapped .navbar-nav > li > a:focus {
    background-color: transparent;
    color: #fff;
    border-bottom: 2px solid rgba(255,255,255,1);
}
.navbar-overlapped .navbar-nav > .open > a,
.navbar-overlapped .navbar-nav > .open > a:hover,
.navbar-overlapped .navbar-nav > .open > a:focus { 
	background-color: transparent; 
	color: #fff; 
	border-bottom: 2px solid transparent; 
} 
.navbar-overlapped .navbar-nav > .active > a, 
.navbar-overlapped .navbar-nav > .active > a:hover, 
.navbar-overlapped .navbar-nav > .active > a:focus { 
	background-color: transparent !important;
    color: #fff;
    border-bottom: 2px solid rgba(255,255,255,1);
}
.navbar-overlapped .cart-header { width: 25px; height: 25px; margin: 33px 7px 32px 20px; }
.navbar-overlapped .cart-header > a.cart-icon { color: #fff; border: 1px solid #ffffff; }
.navbar-overlapped .cart-header > a.cart-icon { width: auto; height: auto; border: 0 none; padding: 0; }
.navbar-overlapped .cart-header > a .cart-total { right: -11px; top: -4px; }

/*Header Stiky Menu*/
.stiky-header{
    position: fixed !important;
    top: 0;
    left: 0;
    right: 0;
    z-index: 999;
	background: #21202e;
	transition: all 0.3s ease;
	min-height: 70px;
	box-shadow: 0 2px 3px rgba(0,0,0,.1)
}
.navbar-overlapped.stiky-header .navbar-brand { padding: 10px 0px; }
.navbar-overlapped.stiky-header .site-branding-text { padding: 3px 50px 3px 15px; }
.navbar-overlapped.stiky-header .navbar-nav > li > a { padding: 24px 10px; }
.navbar-overlapped.stiky-header .cart-header { margin: 23px 7px 22px 20px; }

/*--------------------------------------------------------------
	Menubar - Media Queries
--------------------------------------------------------------*/

@media (min-width: 768px){
	.navbar-custom .navbar-brand {
		padding: 20px 50px 20px 0;
	}
}
/** BELOW MAX-WIDTH MEDIA QUERIES **/

@media (max-width: 768px) {
	.navbar-custom .navbar-brand { padding: 20px 50px 20px 15px; }
}
@media (max-width: 500px) { 
	.navbar-custom .navbar-brand { float: none; display: block; text-align: center; padding: 20px 15px 25px 15px; }
	.navbar-custom .navbar-brand img { margin: 0 auto; }
	.site-branding-text { padding: 17px 15px 17px 15px; float: none; text-align: center; }
	.navbar-toggle { float: none; margin: 10px auto 25px; }
	/*Navbar Overlapped*/
	.navbar-overlapped { position: relative; background-color: #21202e; border-bottom: 1px solid #4c4a5f; }
	.navbar-overlapped .navbar-collapse.in { bottom: 0px; }
	.navbar-overlapped .navbar-collapse { bottom: 0px; }	
	.navbar-overlapped.stiky-header .navbar-toggle { float: none; margin: 10px auto 25px; }
	.navbar-overlapped.stiky-header .site-branding-text { 
		padding: 17px 15px 17px 15px; 
		float: none; 
		text-align: center; 
	}
	body.blog .navbar-overlapped { position: relative; }
	
}

/*--------------------------------------------------------------
	Navbar Classic Header Css
--------------------------------------------------------------*/


.navbar-classic { z-index: 20; background-color: #21202e; }
.navbar-classic { min-height: 60px; }
.navbar-classic .navbar-nav { float: none !important; }
.desktop-header .navbar-classic .navbar-nav > li > a { color: #fff; padding: 20px 25px; }
.navbar-classic .navbar-collapse { border-top: 1px solid #434158; }
.navbar-classic .cart-header { width: 25px; height: 25px; margin: 18px 10px 17px 20px; }
.navbar-classic .cart-header > a.cart-icon { color: #fff; border: 1px solid #ffffff; }
.navbar-classic .cart-header > a.cart-icon { width: auto; height: auto; border: 0 none; padding: 0; }
.navbar-classic .cart-header > a .cart-total { right: -11px; top: -4px; }
.header-widget-info .navbar-brand { height: auto; padding: 15px 0px; }

/*--------------------------------------------------------------
	Menubar - Media Queries
--------------------------------------------------------------*/

@media (min-width: 768px){
	.navbar-custom .navbar-brand {
		padding: 20px 50px 20px 0;
	}
	/* Navbar Classic */
	.navbar-classic .navbar-nav { float: none !important; }
}


/*-------------------------------------------------------------------------
/* Navbar - Logo Right Align with Menu
-------------------------------------------------------------------------*/

@media (min-width: <?php echo $menu_breakpoint+1; ?>px) {
	.navbar-header.align-right {
		float: right;
	}
	.navbar-header.align-right ~ .navbar-collapse { padding-left: 0; }
}
@media (max-width: <?php echo $menu_breakpoint; ?>px) {  
	.navbar-header.align-right .navbar-toggle { 
		float: left;
		margin-left: 15px;
	}
}
.navbar-brand.align-right, .site-branding-text.align-right {
	float: right;
	margin-right: 0px;
	margin-left: 50px;
	padding-right: 0px;
}
@media (max-width: 768px) {
	.navbar-brand.align-right, .site-branding-text.align-right {
		padding-right: 15px;
	}
}
@media (max-width: 500px) {
	.navbar-brand.align-right{ 
		float: none;
		padding: 10px 15px 30px 15px;
	}
    .site-branding-text.align-right { 
		float: none;
		padding: 10px 15px 30px 15px;
		margin-left: 0;
	}		
	.navbar-header.align-right .navbar-toggle { 
		float: none;
		margin: 30px auto 10px; 
	}
}
.p-lef-right-0 { padding-left: 0; padding-right: 0; }


/*-------------------------------------------------------------------------
/* Navbar - Logo Center Align with Menu
-------------------------------------------------------------------------*/

.mobile-header-center { display: none; }
@media (max-width: <?php echo $menu_breakpoint; ?>px){
	.desktop-header-center {
		display: none !important;
	}
	.mobile-header-center {
		display: block !important;
	}
}
.navbar-center-fullwidth .container-fluid {
	padding-left: 0px;
	padding-right: 0px;
	width: auto;
}
@media (min-width: <?php echo $menu_breakpoint+1; ?>px) {
	.navbar-center-fullwidth .logo-area { 
		margin: 0 auto;
		padding: 40px 0;
		text-align: center;
	}
	.navbar-brand.align-center, .site-branding-text.align-center{
		float: none;
		padding: 0px;
		display: inline-block;
	}	
	.navbar-center-fullwidth .navbar-nav {
		float: none;
		margin: 0 auto;
		display: table;
	}
}
.navbar-center-fullwidth .navbar-collapse {
    border-top: 1px solid #e9e9e9;
	border-bottom: 1px solid #e9e9e9;
}
.navbar-center-fullwidth .navbar-nav > .active > a, 
.navbar-center-fullwidth .navbar-nav > .active > a:hover, 
.navbar-center-fullwidth .navbar-nav > .active > a:focus {
    color: #ce1b28 !important;
    background-color: transparent !important;
}
.navbar-center-fullwidth .navbar-nav li > a {
    padding: 20px;
}
.navbar-center-fullwidth .dropdown-menu > li > a {
    padding: 12px 15px;
}
.navbar-center-fullwidth .sp-search-area {
    margin-top: 10px;
    margin-bottom: 8px;
}

</style>
<?php } ?>