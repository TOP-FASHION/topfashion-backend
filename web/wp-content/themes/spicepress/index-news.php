<?php 
$latest_news_section_enable = get_theme_mod('latest_news_section_enable','on');
if($latest_news_section_enable !='off')
{
?>
<!-- Latest News section -->
<section class="home-news" id="blog">
	<div class="container">
		<?php
		$home_news_section_title = get_theme_mod('home_news_section_title',__('Latest News','spicepress'));
		$home_news_section_discription = get_theme_mod('home_news_section_discription','Sea summo mazim ex, ea errem eleifend definitionem vim. Ut nec hinc dolor possim mei ludus efficiendi ei sea summo mazim ex.');
		
		if(($home_news_section_title) || ($home_news_section_discription)!='' ) { 
		?>
	    <!-- Section Title -->
		<div class="row">
			<div class="col-md-12">
				<div class="section-header">
					<?php if($home_news_section_title) {?>
					<h1 class="widget-title wow fadeInUp animated animated" data-wow-duration="500ms" data-wow-delay="0ms">
					<?php echo esc_html($home_news_section_title); ?>
					</h1>
					<?php } ?>
					<div class="widget-separator"><span></span></div>
					<?php if($home_news_section_discription) {?>
					<p class="wow fadeInDown animated">
					<?php echo esc_html($home_news_section_discription); ?>
					</p>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- /Section Title -->
		<?php } ?>
	
		<div class="row">
		<?php 
		$args = array( 'post_type' => 'post','posts_per_page' => 3,'post__not_in'=>get_option("sticky_posts")) ; 	
						query_posts( $args );
						if(query_posts( $args ))
					{	
						while(have_posts()):the_post();
					{ ?>
			
			<div class="col-md-4 col-sm-6 col-xs-12">
				<article class="post wow fadeInDown animated" data-wow-delay="0.4s">
				    <?php spicepress_blog_meta_content(); ?>
					<header class="entry-header">
						<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
				    <?php spicepress_blog_category_content(); ?>
					</header>		
					<?php if(has_post_thumbnail()){ ?>
					<figure class="post-thumbnail"><?php $defalt_arg =array('class' => "img-responsive");?>
						<?php if(has_post_thumbnail()){?>
						<a  class="post-thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('',$defalt_arg);?></a>
						<?php } ?>
					</figure>
					<?php } ?>
					<div class="entry-content">
						<?php the_content(__('Read More','spicepress')); ?>
					</div>						
				</article>
			</div>
			<?php }  endwhile; } ?>
		</div>
	</div>	
</section>
<!-- /Latest News Section -->
<div class="clearfix"></div>
<?php } ?>