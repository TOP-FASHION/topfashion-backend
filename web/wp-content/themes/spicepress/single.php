<?php 
/**
 * The main template file
 */
get_header(); 
spicepress_breadcrumbs(); ?>
<!-- Blog & Sidebar Section -->
<section class="blog-section">
	<div class="container">
		<div class="row">	
			<!--Blog Section-->
			<div class="col-md-<?php echo ( !is_active_sidebar( 'sidebar_primary' ) ? '12' :'8' ); ?> col-xs-12">
				<?php 
				// Start the Loop.
				while ( have_posts() ) : the_post();
					// Include the page
					get_template_part( 'content','');
					
					// author meta
					spicepress_author_meta();
					
					comments_template( '', true ); // show comments 
					
				endwhile;
				?>
			</div>	
			<!--/Blog Section-->
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<!-- /Blog & Sidebar Section -->
<?php get_footer(); ?>