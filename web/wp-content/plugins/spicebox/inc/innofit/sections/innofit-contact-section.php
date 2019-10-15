<?php 
add_action('innofit_contact_action','innofit_contact_section'); 
function innofit_contact_section() {
$contact_form_enable = get_theme_mod('contact_form_enable','on');
if($contact_form_enable !='off')
{ 
$contact_form_background = get_theme_mod('contact_form_background', SPICEB_PLUGIN_URL .'inc/innofit/images/testimonial/testimonial-bg.jpg');
$contact_overlay_section_color = get_theme_mod('contact_overlay_section_color','rgba(250, 250, 250, 0.95)');
$contact_form_image_overlay = get_theme_mod('contact_form_image_overlay',true);

 if($contact_form_background != '') { ?>
<section class="section-module contact" id="contact" style="background-image:url('<?php echo esc_url($contact_form_background);?>'); background-repeat: no-repeat; background-position: top left;">
	<?php } else { ?>
			<section class="section-module contact" id="contact">
	<?php } ?>
	<?php if($contact_form_image_overlay != false) { ?>
	<div class="overlay" style="background-color:<?php echo $contact_overlay_section_color; ?>"></div>
	<?php } ?>
 				<div class="container">
					<div class="row v-center">
<?php
		$contact_form_title_one = get_theme_mod('contact_form_title_one',__('Send us a message','innofit'));
		$contact_form_title_two = get_theme_mod('contact_form_title_two',__('Contact Us','innofit'));
	
	?>
						<div class="col-md-<?php if( get_theme_mod('contact_info_enable',true) == false ): echo '12'; else: echo '6'; endif; ?> col-sm-6 col-xs-12">
							<div class="contact-form">
							<?php if($contact_form_title_one != null): ?>
								<h6 class="subtitle"><?php echo $contact_form_title_one; ?></h6>
                            <?php endif; ?>
							<?php if($contact_form_title_two != null): ?>
								<h2 class="title"><?php echo $contact_form_title_two; ?></h2>
							<?php endif; ?>
							
							<?php
				
							if( get_theme_mod('contact_form_shortcode') !='' ) {
							echo  do_shortcode(get_theme_mod('contact_form_shortcode')); 
							}
							
							?>	
							</div>
						</div>
						
				<?php if( get_theme_mod('contact_info_enable',true) == true ): 
				
                        $default = '<h2 class="title">' . esc_html__('Get in touch','spicebox').'</h2><aside class="contact-widget"><div class="media"><div class="contact-icon"><i class="fa fa-map-marker"></i></div><div class="media-body"><h3 class="title">' . esc_html__('Find Us','spicebox').'</h3><address>' . esc_html__('Porterfield 508 Virginia Street Chicago,<br> IL 60653 (USA)','spicebox').'</address></div></div></aside><aside class="contact-widget"><div class="media"><div class="contact-icon"><i class="fa fa-mobile"></i></div><div class="media-body"><h3 class="title">' . esc_html__('Phone','spicebox').'</h3><address>' . esc_html__('Mobile: (+91) 90 1900 - 6886 <br>Hotline: 1800 6886)','spicebox').'</address></div></div></aside><aside class="contact-widget"><div class="media"><div class="contact-icon"><i class="fa fa-envelope-o"></i></div><div class="media-body"><h3 class="title">' . esc_html__('Email','spicebox').'</h3><address><a href="mailto:suppor@tinnofit.com">' . esc_html__('support@innofit.com','spicebox').'</a><a href="mailto:contact@innofit.com">' . esc_html__('contact@innofit.com','spicebox').'</a></address></div></div></aside>';

                    $contact_info_content = get_theme_mod('contact_info_content',$default);
                ?>
					
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="contact-info">
										<?php echo $contact_info_content; ?>
									</div>
								</div>
						
				<?php endif; ?>		
						
					</div>
				</div>
			</section>	
<!--/End of Contact Section-->
<?php } } ?>