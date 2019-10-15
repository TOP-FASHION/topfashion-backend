<?php 
add_action('innofit_news_action','innofit_news_section'); 
function innofit_news_section() {
$latest_news_section_enable = get_theme_mod('latest_news_section_enable','on');
if($latest_news_section_enable !='off')
{
?>
<!-- Latest News section -->
<section class="section-module home-blog" id="blog">
	<div class="clearfix"></div>
		<div class="container-fluid">
			<div class="container">
				<?php
				$home_news_section_title = get_theme_mod('home_news_section_title',__('Latest News','innofit'));
				$home_news_section_discription = get_theme_mod('home_news_section_discription',__('From our blog','innofit'));
				$home_meta_section_settings = get_theme_mod('home_meta_section_settings', true);
				
				if(($home_news_section_title) || ($home_news_section_discription)!='' ) { 
				?>
				<!-- Section Title -->
							<div class="row">
								<div class="col-md-12">
									<div class="section-header">
									<?php if($home_news_section_title) {?>
										<p class="section-subtitle"><?php echo $home_news_section_title; ?></p>
									<?php } ?>
									<?php if($home_news_section_discription) {?>
										<h1 class="section-title"><?php echo $home_news_section_discription; ?></h1>
									<?php } ?>
									</div>
								</div>						
							</div>
				
				
				<!-- /Section Title -->
				<?php } ?>

			</div>

			<div class="row">
				
			<?php
			
			$args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'post__not_in'=>get_option("sticky_posts")) ; 	
							query_posts( $args );
							if(query_posts( $args ))
						{	
							while(have_posts()):the_post();
						{

							$meta_facebook_url =sanitize_text_field( get_post_meta( get_the_ID(), 'meta_facebook_url', true ));
							$meta_twitter_url =sanitize_text_field( get_post_meta( get_the_ID(), 'meta_twitter_url', true ));
							$meta_google_url =sanitize_text_field( get_post_meta( get_the_ID(), 'meta_google_url', true ));
							$meta_linkedin_url =sanitize_text_field( get_post_meta( get_the_ID(), 'meta_linkedin_url', true ));
							$meta_youtube_url =sanitize_text_field( get_post_meta( get_the_ID(), 'meta_youtube_url', true ));
							$meta_instagram_url =sanitize_text_field( get_post_meta( get_the_ID(), 'meta_instagram_url', true ));
							$meta_pinterest_url =sanitize_text_field( get_post_meta( get_the_ID(), 'meta_pinterest_url', true ));
							$social_media_target =sanitize_text_field( get_post_meta( get_the_ID(), 'social_media_target', true ));

						?>
						
					<div class="col-md-4 col-sm-6 col-xs-12">
				
									<article class="post">	
									<?php if(has_post_thumbnail()){ ?>
										<figure class="post-thumbnail">
										<?php $defalt_arg =array('class' => "img-responsive");?>
									  
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('',$defalt_arg);?></a>
																	
										</figure>	
									<?php } ?>
										<div class="post-content">	
										 
										<?php if($home_meta_section_settings == true){?>
											<div class="entry-meta">
												<span class="entry-date">
												<a href="<?php echo get_month_link(get_post_time('Y'),get_post_time('m')); ?>"><time>
												<?php echo get_the_date('M j, Y'); ?></time></a>
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
												<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
											</header>	
											<div class="entry-content">
												<?php the_content(__('Read More','innofit')); ?>
											</div>
											
									<?php if($home_meta_section_settings == true){?>
											
											<hr>
											<div class="item-meta">
											
											
												<div class="pull-left v-center">
													
													<a class="avatar" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php echo get_avatar( get_the_author_meta('user_email'), $size = '40'); ?></a>
													
													<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>"><?php echo 'By ';?><?php echo get_the_author();?></a>
												</div>
										
												
												<div class="pull-right">
													<ul class="small-social-icon">
		
												<?php 	if(get_post_meta( get_the_ID(),'meta_facebook_url', true )){ ?>
													   <li><a class="facebook-f" <?php if(!empty($social_media_target)){ echo 'target="_blank"'; } ?> href="<?php  echo esc_url($meta_facebook_url); ?>"><i class="fa fa-facebook-f"></i></a></li>
												<?php } ?>
												
												<?php 	if(get_post_meta( get_the_ID(),'meta_twitter_url', true )){ ?>
													   <li><a class="twitter" <?php if(!empty($social_media_target)){ echo 'target="_blank"'; } ?> href="<?php  echo esc_url($meta_twitter_url); ?>"><i class="fa fa-twitter"></i></a></li>
												<?php } ?>
												
												<?php 	if(get_post_meta( get_the_ID(),'meta_google_url', true )){ ?>
													   <li><a class="google" <?php if(!empty($social_media_target)){ echo 'target="_blank"'; } ?> href="<?php  echo esc_url($meta_google_url); ?>"><i class="fa fa-google-plus"></i></a></li>
												<?php } ?>		   
													   
												<?php 	if(get_post_meta( get_the_ID(),'meta_linkedin_url', true )){ ?>	   
													   <li><a class="linkedin" <?php if(!empty($social_media_target)){ echo 'target="_blank"'; } ?> href="<?php  echo esc_url($meta_linkedin_url); ?>"><i class="fa fa-linkedin"></i></a></li>
												<?php } ?>	

												<?php 	if(get_post_meta( get_the_ID(),'meta_youtube_url', true )){ ?>	   
												<li><a class="youtube" <?php if(!empty($social_media_target)){ echo 'target="_blank"'; } ?> href="<?php  echo esc_url($meta_youtube_url); ?>"><i class="fa fa-youtube"></i></a></li>
												<?php } ?>	
													   
												<?php 	if(get_post_meta( get_the_ID(),'meta_instagram_url', true )){ ?>	   
												<li><a class="instagram" <?php if(!empty($social_media_target)){ echo 'target="_blank"'; } ?> href="<?php  echo esc_url($meta_instagram_url); ?>"><i class="fa fa-instagram"></i></a></li>
												<?php } ?>	

												<?php 	if(get_post_meta( get_the_ID(),'meta_pinterest_url', true )){ ?>	   
												<li><a class="pinterest-p" <?php if(!empty($social_media_target)){ echo 'target="_blank"'; } ?> href="<?php  echo esc_url($meta_pinterest_url); ?>"><i class="fa fa-pinterest-p"></i></a></li>
												<?php } ?>

												
												   </ul>
											   </div>
											   
											</div>	
											
											<?php } ?>
										</div>				
									</article>
						
					</div>

				<?php }  endwhile; } ?>
				
			</div>
		</div>	
</section>
<!-- /Latest News Section -->
<div class="clearfix"></div>
<?php } }?>