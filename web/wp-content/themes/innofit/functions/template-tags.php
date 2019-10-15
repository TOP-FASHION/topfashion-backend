<?php
if ( ! function_exists( 'innofit_blog_meta_content' ) ) :
function innofit_blog_meta_content()
{ 
	$blog_meta_section_enable = get_theme_mod('blog_meta_section_enable',true);
	
	if( $blog_meta_section_enable == true ) { ?>
	<div class="entry-meta">
		<span class="entry-date">
			<a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"><time datetime=""><?php echo esc_html(get_the_date('M j, Y')); ?></time></a>
		</span>
	</div>
<?php } 
}
endif;

if ( ! function_exists( 'innofit_blog_category_content' ) ) :
function innofit_blog_category_content()
{
	$blog_meta_section_enable = get_theme_mod('blog_meta_section_enable',true);
	
	if( $blog_meta_section_enable == true ) {

?>
<div class="entry-meta">
	<span class="author"><?php esc_html_e('By','innofit');?> <a rel="tag" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ));?>"><?php echo esc_html(get_the_author());?></a>
	
	</span>
	<?php 	
	$cat_list = get_the_category_list();
		if(!empty($cat_list)) { ?>
	<span class="cat-links"><?php esc_html_e('in','innofit');?><a href="<?php the_permalink(); ?>"><?php the_category(', '); ?></a></span>
	<?php } 

	 $tag_list = get_the_tag_list();
		if(!empty($tag_list)) { ?>
				<span class="tag-links"><?php esc_html_e('Tag','innofit');?> <?php the_tags('', ', ', ''); ?></span>
				<?php }

		?>

</div>	 
<?php } } endif;
// avator class
function innofit_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='img-responsive img-circle", $class);
    return $class;
}
add_filter('get_avatar','innofit_gravatar_class');

// blogs,pages and archive page title
function innofit_archive_page_title(){
	if( is_archive() )
	{
		$archive_text = get_theme_mod('archive_prefix',__('Archives','innofit'));
		
		echo '<div class="page-title text-center"><h1 class="text-white">';
		
		if ( is_day() ) :
		
		  printf( esc_html__( '%1$s %2$s', 'innofit' ), esc_html($archive_text), esc_html(get_the_date()) );
		  
        elseif ( is_month() ) :
		
		  printf( esc_html__( '%1$s %2$s', 'innofit' ), esc_html($archive_text), esc_html(get_the_date( 'F Y' )) );
		  
        elseif ( is_year() ) :
		
		  printf( esc_html__( '%1$s %2$s', 'innofit' ), esc_html($archive_text), esc_html(get_the_date( 'Y' )) );
		  
        elseif( is_category() ):
		
			$category_text = get_theme_mod('category_prefix',__('Category','innofit'));
			
			printf( esc_html__( '%1$s %2$s', 'innofit' ), esc_html($category_text), esc_html(single_cat_title( '', false )) );
			
		elseif( is_author() ):
			
			$author_text = get_theme_mod('author_prefix',__('All posts by','innofit'));
		
			printf( esc_html__( '%1$s %2$s', 'innofit' ), esc_html($author_text), esc_html(get_the_author()) );
			
		elseif( is_tag() ):
			
			$tag_text = get_theme_mod('tag_prefix',__('Tag','innofit'));
			
			printf( esc_html__( '%1$s %2$s', 'innofit' ), esc_html($tag_text), single_tag_title( '', false ) );
			
		elseif( class_exists( 'WooCommerce' ) && is_shop() ):
			
			$shop_text = get_theme_mod('shop_prefix',__('Shop','innofit'));
			
			printf( esc_html__( '%1$s %2$s', 'innofit' ), esc_html($shop_text), single_tag_title( '', false ));
			
        elseif( is_archive() ): 
		the_archive_title( '<h1>', '</h1>' ); 
		
		endif;
		

		echo '</h1></div>';
	}
	elseif( is_search() )
	{
		$search_text = get_theme_mod('search_prefix',__('Search results for','innofit'));
		
		echo '<div class="page-title text-center"><h1 class="text-white">';
		
		printf( esc_html__( '%1$s %2$s', 'innofit' ), esc_html($search_text), get_search_query() );
		
		echo '</h1></div>';
	}
	elseif( is_404() )
	{
		$breadcrumbs_text = get_theme_mod('404_prefix',__('404','innofit'));
		
		echo '<div class="page-title text-center"><h1 class="text-white">';
		
		printf( esc_html__( '%1$s ', 'innofit' ) , esc_html($breadcrumbs_text) );
		
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
		
		echo '<div class="page-title text-center"><h1 class="text-white">'.wp_kses( force_balance_tags( get_the_title()), $allowed_html ).'</h1></div>';
	}
}

// Innofit post navigation
function innofit_post_nav()
{
	global $post;
	echo '<div style="text-align:center;">';
	posts_nav_link( ' &#183; ', esc_html__('previous page','innofit'), esc_html__('next page','innofit') );
	echo '</div>';
}


//Hide Title of woocommerce shop page
add_filter( 'woocommerce_show_page_title' , 'innofit_woo_hide_page_title' );

function innofit_woo_hide_page_title() {
	
	return false;
	
}

if(!function_exists( 'innofit_image_thumbnail')) : 					
		function innofit_image_thumbnail($preset,$class){
		if(has_post_thumbnail()){  $defalt_arg =array('class' => $class);
	the_post_thumbnail($preset, $defalt_arg); } } 
endif;

// Custom header function
if ( ! function_exists( 'innofit_header_style' ) ) :

function innofit_header_style() {
    $text_color = get_header_textcolor();

    // If no custom color for text is set, let's bail.
    if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
        return;
    ?>
    <style type="text/css" id="innofit-header-css">
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

    add_action( 'wp_footer', 'innofit_demo_store' );
	function innofit_demo_store() {
	if ( class_exists( 'WooCommerce' ) ) {
	$woocommerce_demo_store = get_option('woocommerce_demo_store', 'no');
	if($woocommerce_demo_store !='no')
	{
	?>
	<style>
	.woocommerce-store-notice .demo_store, #wrapper {
		margin-top: 50px !important;
	}
	</style>
<?php } } } 

/*----Custom Header & Footer Background color----*/ 
function innofit_header_footer_bgcolor() {
    innofit_custom_header_footer_bgcolor();
}
add_action('wp_footer','innofit_header_footer_bgcolor');

/*----Custom Header & Footer Background color----*/ 
function innofit_custom_header_footer_bgcolor() {
	
$header_background_color = get_theme_mod('header_background_color','#21202e');
$footer_background_color = get_theme_mod('footer_background_color','#21202e');

?>
<style type="text/css">
.header-widget-info, .navbar-classic, .stiky-header{
	background: <?php echo esc_attr( $header_background_color);?>;
}
.site-footer{
	background: <?php echo esc_attr( $footer_background_color);?>;
}
</style>
<?php } ?>