<?php
/**
 * The default template for displaying content
 */
?>
				<article class="post" <?php post_class( 'post-content-area wow fadeInDown animated' ); ?> data-wow-delay="0.4s">				
					<?php 
					$blog_meta_section_enable = get_theme_mod('blog_meta_section_enable',true);
					if($blog_meta_section_enable == true) {
					spicepress_blog_meta_content(); } ?>
					<header class="entry-header">
						<?php if ( is_single() ) :
						the_title( '<h3 class="entry-title">', '</h3>' );
						else :
						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' );
						endif; 
						if($blog_meta_section_enable ==true) {
						spicepress_blog_category_content();
						}
						?>
					</header>				
					<?php 
					if(has_post_thumbnail()){
					if ( is_single() ) {
					echo '<figure class="post-thumbnail">';
					the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
					echo '</figure>';
					}else{
					echo '<figure class="post-thumbnail"><a class="post-thumbnail" href="'.esc_url(get_the_permalink()).'">';
					the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
					echo '</a></figure>';
					} } ?>
					<div class="entry-content">
						<?php the_content( __('Read More','spicepress') ); ?>
						<?php wp_link_pages( ); ?>
					</div>						
				</article>