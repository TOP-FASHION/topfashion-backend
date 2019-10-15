<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package WordPress
 * @subpackage Spicepress
 */
 
get_header();
?>
 <!-- Page Title Section -->
		<section class="page-title-section">		
			<div class="overlay">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6">
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

						   $our_title = get_the_title( get_option('page_for_posts', true) );
									echo '<div class="page-title wow bounceInLeft animated" ata-wow-delay="0.4s"><h1>'.wp_kses( force_balance_tags( $our_title), $allowed_html ).'</h1></div>';
						   ?>
						</div>
						<div class="col-md-6 col-sm-6">
							<?php
								echo '<ul class="page-breadcrumb wow bounceInRight animated" ata-wow-delay="0.4s">';
									$homeLink = home_url();
									$our_title = get_the_title( get_option('page_for_posts', true) );
								    echo '<li><a href="'.esc_url($homeLink).'">'.wp_kses( force_balance_tags($our_title), $allowed_html ).'</a></li>';
									echo '<li class="active"><a href="'.wp_kses( force_balance_tags($our_title), $allowed_html ) .'">'.get_bloginfo( 'name' ).'</a></li>';
								 echo '</ul>'
							?>
						</div>
					</div>
				</div>	
			</div>
		</section>
		<div class="page-seperate"></div>
		<!-- /Page Title Section -->
 
 
<!-- Blog & Sidebar Section -->
<section class="blog-section">
	<div class="container">
		<div class="row">	
			<!--Blog Section-->
			<div class="col-md-<?php echo ( !is_active_sidebar( 'sidebar_primary' ) ? '12' :'8' ); ?> col-sm-7 col-xs-12">
				<?php 
					if ( have_posts() ) :
					// Start the Loop.
					while ( have_posts() ) : the_post();
						// Include the post format-specific template for the content. get_post_format
						get_template_part( 'content','');
					endwhile;
					
					// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
						'next_text'          => '<i class="fa fa-angle-double-right"></i>'
					) );
				
				endif;
				?>
			</div>	
			<!--/Blog Section-->
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<!-- /Blog & Sidebar Section -->
<?php get_footer(); ?>