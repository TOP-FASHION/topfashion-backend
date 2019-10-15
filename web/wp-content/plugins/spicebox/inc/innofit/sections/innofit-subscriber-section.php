<?php 
/* Call the action for team section */
add_action('innofit_subscriber_action','innofit_subscriber_section');
/* Function for team section*/
function innofit_subscriber_section()
{
$innofit_subscribe_hide = get_theme_mod('innofit_subscribe_hide','on');
if($innofit_subscribe_hide !='off')
{
$innofit_subscribe_background = get_theme_mod('innofit_subscribe_background', SPICEB_PLUGIN_URL . 'inc/innofit/images/subscribe/subscribe-bg.jpg');

$innofit_overlay_section_color = get_theme_mod('subscribe_overlay_section_color','rgba(0, 11, 24, 0.8)');
$innofit_subscribe_image_overlay = get_theme_mod('subscribe_image_overlay',true);

$innofit_subscribe_title = get_theme_mod('innofit_subscribe_title',esc_html__( 'Subscribe to our newsletter', 'spicebox' ));
$innofit_subscribe_subtitle = get_theme_mod('innofit_subscribe_subtitle',esc_html__( 'Sign up now for more information about our company.', 'spicebox' ));
?>
<!--Subscribe Newsletter Section-->
<section class="subscribe-newsletter" id="subscribe" style="background-image:url('<?php echo esc_url($innofit_subscribe_background);?>');">
<?php if($innofit_subscribe_image_overlay != false) { ?>
<div class="overlay" style="background-color:<?php echo $innofit_overlay_section_color; ?>"></div>
<?php }?>
	<div class="container">			
		<div class="row">
			<div class="col-md-12">
				<div class="section-header text-center">
					<h1 class="section-title text-white"><?php echo $innofit_subscribe_title; ?></h1>
					<p class="section-subtitle text-white"><?php echo $innofit_subscribe_subtitle; ?></p>
				</div>
			</div>
			<div class="col-md-12">
				<?php if ( is_active_sidebar( 'subscribe-widgets' ) ) : dynamic_sidebar( 'subscribe-widgets' ); endif; 
				?>
			</div>					
		</div>
	</div>
</section>
<!--/End of Subscribe Newsletter Section-->
<!--/End of Team Section-->
<?php } }?>