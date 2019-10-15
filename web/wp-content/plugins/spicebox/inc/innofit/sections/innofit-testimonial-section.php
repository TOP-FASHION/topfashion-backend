<?php 
/* Call the action for team section */
add_action('innofit_testimonial_action','innofit_testimonial_section');
/* Function for team section*/
function innofit_testimonial_section()
{
$testimonial_options = get_theme_mod('innofit_testimonial_content'); 

$testimonial_section_enable = get_theme_mod('testimonial_section_enable','on');
if($testimonial_section_enable !='off')
{
$home_testimonial_section_title = get_theme_mod('home_testimonial_section_title',__('What our clients say','spicebox'));
$home_testimonial_section_discription = get_theme_mod('home_testimonial_section_discription',__('We provide best WordPress solutions for your business.','spicebox'));
if( $home_testimonial_section_title != '' || $home_testimonial_section_discription != '') { 
?>
<!-- Testimonial Section-->
<?php $testimonial_callout_background = get_theme_mod('testimonial_callout_background',''); 	
 if($testimonial_callout_background != '') { ?>
<section class="testimonial-wrapper" id="testimonial" style="background-image:url('<?php echo esc_url($testimonial_callout_background);?>'); background-repeat: no-repeat; background-position: top left;">
	<?php } else { ?>
<section class="testimonial-wrapper" id="testimonial">
<?php } 
$testimonial_overlay_section_color = get_theme_mod('testimonial_overlay_section_color','rgba(0, 11, 24, 0.80)');
$testimonial_image_overlay = get_theme_mod('testimonial_image_overlay',true);
?>
    <?php if($testimonial_image_overlay != false) { ?>
	<div class="overlay" style="background-color:<?php echo $testimonial_overlay_section_color; ?>"></div>
	<?php } ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-header text-left">
						<h1 class="section-title text-white"><?php echo esc_attr($home_testimonial_section_title); ?></h1>
						<p class="section-subtitle text-white"><?php echo esc_attr($home_testimonial_section_discription); ?></p>
					</div>
				</div>						
			</div>
		</div>
	
</section>
<?php } ?>
<section class="testimonial">
	<div class="container">
		<div class="row">
			<div class="owl-theme">	
				<?php
					$testimonial_options = json_decode($testimonial_options);
					if( $testimonial_options!='' )
						{
						$allowed_html = array(
								'br'     => array(),
								'em'     => array(),
								'strong' => array(),
								'b'      => array(),
								'i'      => array(),
								);	
							
					foreach($testimonial_options as $testimonial_iteam){ 
					
							$title = ! empty( $testimonial_iteam->title ) ? apply_filters( 'innofit_translate_single_string', $testimonial_iteam->title, 'Testimonial section' ) : '';
							$test_desc = ! empty( $testimonial_iteam->text ) ? apply_filters( 'innofit_translate_single_string', $testimonial_iteam->text, 'Testimonial section' ) : '';
							$test_link = $testimonial_iteam->link;
							$open_new_tab = $testimonial_iteam->open_new_tab;
							
							$designation = ! empty( $testimonial_iteam->designation ) ? apply_filters( 'innofit_translate_single_string', $testimonial_iteam->designation, 'Testimonial section' ) : '';
					?>
					<div class="item col-md-4 col-sm-6 col-xs-12">
					<blockquote class="testmonial-block text-center">
						
						<?php $default_arg =array('class' => "img-circle"); ?>
						<?php if($testimonial_iteam->image_url != ''): ?>
						<figure class="avatar">
						<a href="<?php echo $test_link; ?>" <?php if($open_new_tab == 'yes'){ echo 'target="_blank"';}?>>
						<img alt="img" class="img-circle" src="<?php echo $testimonial_iteam->image_url; ?>" draggable="false">
						</a>
						</figure>
						<?php endif; ?>
							
						<div class="description">
							<p><?php echo wp_kses( html_entity_decode( $test_desc ), $allowed_html ); ?></p>
						</div>
						
						<figcaption>
							<cite class="name"> <a href="<?php echo $test_link; ?>" <?php if($open_new_tab == 'yes'){ echo 'target="_blank"';}?>><?php echo $title; ?> </a> <span class="designation"><?php echo $designation; ?></span>
							</cite>
						</figcaption>
							
						
						</blockquote>
					</div>
					<?php } } else 
					{ 
					$image = array('user1','user2','user3');
					$name = array('Martin Wills','Amanda Smith','Travis Cullan');
					$desc =array(__('Developer','spicebox'), __('Team Leader','spicebox'), __('Volunteer','spicebox'));
					for($i=0; $i<=2; $i++) {
					?>	
					<div class="item col-md-4 col-sm-6 col-xs-12">
						<blockquote class="testmonial-block text-center">
							<figure class="avatar">
								<img src="<?php echo SPICEB_PLUGIN_URL ?>/inc/innofit/images/testimonial/<?php echo $image[$i]; ?>.jpg" class="img-circle" alt="img">
							</figure>
							<div class="description">
								<p><?php echo "We are so glad that we made the switch to use Innofit this year and our results were fantastic."; ?></p>
							</div>	
							<figcaption>
								<cite class="name"><a href="#"><?php echo $name[$i]; ?></a><span class="designation"><?php echo $desc[$i]; ?></span></cite>
							</figcaption>
						</blockquote>
					</div>
					<?php } } ?>	
			</div>
		</div>
	</div>
</section>	
<!-- /End of Testimonial Section-->
<?php } }?>