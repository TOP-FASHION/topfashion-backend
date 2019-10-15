<?php 
/**
 * Archive page template
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
				if ( have_posts() ) :
					// Start the Loop.
					while ( have_posts() ) : the_post();
						// Include the post format-specific template for the content.
						get_template_part( 'content','');
					endwhile;
					
					// Previous/next page navigation.
					the_posts_pagination( array(
						'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
						'next_text'          => '<i class="fa fa-angle-double-right"></i>'
					) );
					
				else : ?>
				<h2><?php esc_html_e('Nothing found', 'spicepress'); ?></h2>
				<p><?php esc_html_e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.','spicepress'); ?></p>
				<?php endif; ?>
			</div>	
			<!--/Blog Section-->
			<?php get_sidebar(); ?>
		</div>
	</div>
</section>
<!-- /Blog & Sidebar Section -->

<?php get_footer(); ?>