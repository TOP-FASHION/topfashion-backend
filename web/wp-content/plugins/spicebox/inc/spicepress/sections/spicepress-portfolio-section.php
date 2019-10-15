<?php
/**
 * Portfolio section for the homepage.
 */
if ( ! function_exists( 'spiceb_spicepress_portfolio' ) ) :

	function spiceb_spicepress_portfolio() {
		
		$home_portfolio_section_title = get_theme_mod('home_portfolio_section_title',__('Our Portfolio','spicepress'));
		$home_portfolio_section_discription = get_theme_mod('home_portfolio_section_discription','Sea summo mazim ex, ea errem eleifend definitionem vim. Ut nec hinc dolor possim mei ludus efficiendi ei sea summo mazim ex.');
		$portfolio_one_title = get_theme_mod('portfolio_one_title',__('Art Office Design','spicebox'));
		$portfolio_one_desc = get_theme_mod('portfolio_one_desc','Lorem ipsum dolor sit amet, consectetur adipisicing elit..');
		$portfolio_one_thumb = get_theme_mod('portfolio_one_thumb',SPICEB_PLUGIN_URL .'inc/spicepress/images/portfolio/item1.jpg');
		
		$portfolio_two_title = get_theme_mod('portfolio_two_title',__('Art Office Design','spicebox'));
		$portfolio_two_desc = get_theme_mod('portfolio_two_desc','Lorem ipsum dolor sit amet, consectetur adipisicing elit..');
		$portfolio_two_thumb = get_theme_mod('portfolio_two_thumb',SPICEB_PLUGIN_URL .'inc/spicepress/images/portfolio/item2.jpg');
		
		$portfolio_three_title = get_theme_mod('portfolio_three_title',__('Art Office Design','spicebox'));
		$portfolio_three_desc = get_theme_mod('portfolio_three_desc','Lorem ipsum dolor sit amet, consectetur adipisicing elit..');
		$portfolio_three_thumb = get_theme_mod('portfolio_three_thumb',SPICEB_PLUGIN_URL .'inc/spicepress/images/portfolio/item3.jpg');
		$portfolio_section_enable = get_theme_mod('portfolio_section_enable','on');
		if($portfolio_section_enable !='off'){
		?>		
<!-- Portfolio Section -->
<section class="portfolio-section">
	<div class="container">
	
		<?php if( ($home_portfolio_section_title) || ($home_portfolio_section_discription)!='' ) { ?>
		<!-- Section Title -->
		<div class="row">
			<div class="col-md-12">
				<div class="section-header">
					<h1 class="widget-title wow fadeInUp animated animated" data-wow-duration="500ms" data-wow-delay="0ms"><?php echo $home_portfolio_section_title; ?></h1>
					<div class="widget-separator"><span></span></div>
					<p class="wow fadeInDown animated"><?php echo $home_portfolio_section_discription; ?></p>
				</div>
			</div>
		</div>
		<!-- /Section Title -->
		<?php } ?>
				
		<!-- Item Scroll -->	
			<div class="row">
				<div id="portfolio-carousel">
					<div class="col-md-4 col-sm-6 col-xs-12 port1">						
						<article class="post">
							<figure class="post-thumbnail">
								<img class="img-responsive" alt="img" src="<?php echo $portfolio_one_thumb; ?>">
							</figure>
							<header class="entry-header">
								<h4 class="entry-title"><a href="#"><?php echo $portfolio_one_title; ?></a></h4>
							</header>	
							<div class="entry-content">
								<p><?php echo $portfolio_one_desc; ?></p>
							</div>	
						</article>
					</div>
					
					<div class="col-md-4 col-sm-6 col-xs-12 port2">						
						<article class="post">
							<figure class="post-thumbnail">
								<img class="img-responsive" alt="img" src="<?php echo $portfolio_two_thumb?>">
							</figure>
							<header class="entry-header">
								<h4 class="entry-title"><a href="#"><?php echo $portfolio_two_title; ?></a></h4>
							</header>	
							<div class="entry-content">
								<p><?php echo $portfolio_two_desc; ?></p>
							</div>	
						</article>
					</div>
					
					<div class="col-md-4 col-sm-6 col-xs-12 port3">						
						<article class="post">
							<figure class="post-thumbnail">
								<img class="img-responsive" alt="img" src="<?php echo $portfolio_three_thumb?>">
							</figure>
							<header class="entry-header">
								<h4 class="entry-title"><a href="#"><?php echo $portfolio_three_title; ?></a></h4>
							</header>
							<div class="entry-content">
								<p><?php echo $portfolio_three_desc; ?></p>
							</div>	
						</article>
					</div>
					
					
				</div>			
			</div>
		<!-- /Item Scroll -->
		
	</div>
</section>
<!-- /Portfolio Section -->

<div class="clearfix"></div>	
<?php } }

endif;

		if ( function_exists( 'spiceb_spicepress_portfolio' ) ) {
		$section_priority = apply_filters( 'spicepress_section_priority', 12, 'spiceb_spicepress_portfolio' );
		add_action( 'spiceb_spicepress_sections', 'spiceb_spicepress_portfolio', absint( $section_priority ) );

		}