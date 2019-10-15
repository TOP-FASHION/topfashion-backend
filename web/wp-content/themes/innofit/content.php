<?php
/**
 * The default template for displaying content
*/
?>

	<article class="post" <?php post_class( 'post-content-area' ); ?>>			
		<?php 
			if(has_post_thumbnail()){
			if ( !is_single() ) {
			echo '<figure class="post-thumbnail"><a class="post-thumbnail" href="'.esc_url(get_the_permalink()).'">';
			the_post_thumbnail( '', array( 'class'=>'img-responsive' ) );
			echo '</a></figure>';
			} } ?>

		
		<div class="post-content">	
				<?php $blog_meta_section_enable = get_theme_mod('blog_meta_section_enable',true);
					if($blog_meta_section_enable ==true) { ?>
				<div class="entry-meta">
					<span class="entry-date">
					<a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>"><time>
					<?php echo esc_html(get_the_date('M j, Y')); ?></time></a>
					</span>
				
					<?php $cat_list = get_the_category_list();
					if(!empty($cat_list)) { ?>
					<span class="cat-links"><a href="<?php the_permalink(); ?>"><?php the_category(', '); ?></a></span>
					<?php } $tag_list = get_the_tag_list();
					if(!empty($tag_list)) { ?>
					<span class="tag-links"><?php the_tags('', '', ''); ?></span>
					<?php } ?>
				</div>
					<?php } ?>
															
			<header class="entry-header">
				<?php if ( is_single() ) :
				the_title( '<h3 class="entry-title">', '</h3>' );
				else :
				the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h3>' );
				endif;
				?>
			</header>
			
			<div class="entry-content">
				<?php the_content( __('Read More','innofit') ); ?>
				<?php wp_link_pages( ); ?>
			</div>
			<?php if($blog_meta_section_enable ==true) { ?>
			<hr>
			<div class="item-meta">
				
				<div class="pull-left v-center">
					
					<a class="avatar" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' )) );?>"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '40'); ?></a>
					
					<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' )) );?>"><?php echo esc_html__('By ','innofit');?><?php echo esc_html(get_the_author());?></a>
					
				</div>
				
			</div>
			<?php } ?>
		</div>				
	</article>					