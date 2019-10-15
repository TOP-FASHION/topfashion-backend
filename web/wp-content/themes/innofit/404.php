<?php 
/**
 * The main template file
 */
get_header();
innofit_breadcrumbs();
?>
<!--404 Error Page Section-->
<section class="section-module">		
	<div class="container">
		<div class="row v-center">
			<div class="col-md-12 col-sm-12 col-xs-12">							
				<div class="error-404 text-center">
				  <h1><?php esc_html_e('4','innofit'); ?>
				  <i class="fa fa-frown-o"></i><?php esc_html_e('4','innofit'); ?> 
				  </h1>
				  <h4><?php esc_html_e('Oops! Page not found','innofit'); ?></h4>
					<p><?php esc_html_e("We are sorry, but the page you are looking for does not exist.","innofit"); ?></p>
					<div class="ptop-20 text-center">
						<a class="btn-small btn-animate border btn-bg-default" href="<?php echo esc_url(site_url());?>"><?php esc_html_e('Home Page','innofit'); ?></a>
					</div>								
				</div>
			</div>
		</div>
	</div>
</section>
<!--/End of 404 Error Page Section-->
<!-- /404 Error Section -->
<div class="clearfix"></div>
<?php get_footer(); ?>