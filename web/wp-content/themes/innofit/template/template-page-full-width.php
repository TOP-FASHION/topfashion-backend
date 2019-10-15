<?php 
/**
 * Template name:Full-width page
 */
get_header();

innofit_breadcrumbs();
?>
<!-- Blog & Sidebar Section -->
<section class="site-content">
	<div class="container">
		
		<div class="row">	
		
			<!--Blog Posts-->
			<div class="col-md-12 col-xs-12">
				<div class="blog">
				<?php 
				// Start the Loop.
				the_post();
				// Include the page
				?>
				<article class="post" id="post-<?php the_ID(); ?>" <?php post_class( 'post-content-area' ); ?>>
					<div class="post-content">
						<div class="entry-content">
							<?php the_content( __('Read More','innofit') ); ?>
						</div>							
					</div>
				</article>
					 <?php
						comments_template( '', true ); // show comments 
					?>
				</div>
			</div>	
			<!--/Blog Section-->
		</div>
	</div>
</section>
<!-- /Blog & Sidebar Section -->
<?php get_footer(); ?>