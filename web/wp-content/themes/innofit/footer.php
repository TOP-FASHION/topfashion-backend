<?php
if ( ! is_plugin_active( 'innofit-plus/innofit-plus.php' ) ):
?>
<!--Footer Section-->
<footer class="site-footer">	
	<div class="container-fluid">
		<div class="row footer-sidebar">
	   
			<!--Site Info-->	
			<div class="col-md-3 col-sm-4 col-xs-12">		
				<div class="site-info">
					<div class="site-branding pbottom-50">
					<?php the_custom_logo(); ?>
		            
					<?php  if ( display_header_text() ) : ?>
					
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
							<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( $description || is_customize_preview() ) : ?>
								<p class="site-description"><?php echo esc_html($description); ?></p>
							<?php endif; ?>
					
					<?php endif; ?>
					
					</div>
					<?php $footer_copyright = get_theme_mod('footer_copyright_text','<p>'.__( '<a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://spicethemes.com" rel="designer">Innofit</a> by SpiceThemes', 'innofit' ).'</p>');?>
					<?php echo wp_kses_post($footer_copyright);?>
				</div>
			</div>
			<!--/Site Info-->		
			
			<!--Footer Widgets-->		
			<div class="col-md-9 col-sm-8 col-xs-12">		
				<div class="row">
					<?php get_template_part('sidebar','footer');?>
				</div>
			</div>
			<!--/Footer Widgets-->
		</div>
		
	</div>			
</footer>
<!--End of Footer Section-->
</div>	
<!--Page Scroll Up-->
<div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
<!--/Page Scroll Up-->
<?php wp_footer(); ?>
</body>
</html>
<?php endif; ?>

<?php
if (is_plugin_active( 'innofit-plus/innofit-plus.php' ) ):
     do_action( 'innofit_footer_action', false); 
endif; ?>