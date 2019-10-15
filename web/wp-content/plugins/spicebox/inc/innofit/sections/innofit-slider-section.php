<?php
/**
 * Slider section for the homepage.
 */
add_action('innofit_slider_action','innofit_slider_section');

function innofit_slider_section()
{
		$home_slider_image = get_theme_mod('home_slider_image',SPICEB_PLUGIN_URL .'inc/innofit/images/slider/slider.jpg');
		$home_slider_title = get_theme_mod('home_slider_title',__('We provide solutions to<br /> grow your business','spicebox'));	
		$home_slider_discription = get_theme_mod('home_slider_discription',__('Welcome to Innofit','spicebox'));
		$home_slider_btn_txt = get_theme_mod('home_slider_btn_txt','Read More');
		$home_slider_btn_link = get_theme_mod('home_slider_btn_link',esc_url('#'));
		$home_slider_btn_target = get_theme_mod('home_slider_btn_target',false);
		
		$home_page_slider_enabled = get_theme_mod('home_page_slider_enabled','on');
		if($home_page_slider_enabled !='off') {
		?>
		<!-- Slider Section -->	
		<section class="main-slider" id="totop">
			<div class="item home-section home-full-height" style="background-image:url(<?php echo $home_slider_image; ?>);" >
						<div class="container slider-caption">
							<div class="caption-content">
								<?php if ( ! empty( $home_slider_discription ) || is_customize_preview() ) { ?>
								<h5 class="subtitle"><?php echo $home_slider_discription; ?></h5>
								<?php if ( ! empty( $home_slider_title ) || is_customize_preview() ) { ?>
								<h1 class="title"><?php echo $home_slider_title;  ?></h1>
								<?php } ?>
								<?php } if($home_slider_btn_txt) { ?>
								<div class="ptop-15">
								<a <?php if($home_slider_btn_link) { ?> href="<?php echo $home_slider_btn_link; } ?>" 
								<?php if($home_slider_btn_target) { ?> target="_blank" <?php } ?> class="btn-small btn-default">
								<?php if($home_slider_btn_txt) { echo $home_slider_btn_txt; } ?></a>
								</div>
								<?php } ?>								
							</div>
						</div>
			<?php $slider_image_overlay = get_theme_mod('slider_image_overlay',true);
			$slider_overlay_section_color = get_theme_mod('slider_overlay_section_color','rgba(0,0,0,0.30)');
			if($slider_image_overlay != false) { ?>
			<div class="overlay" style="background-color:<?php echo $slider_overlay_section_color;?>"></div>
			<?php } ?>
            </div>
			
				<!-- Slider Pointer -->
			<a href="#services" class="pointer-scroll section-scroll">
				<i class="fa fa-angle-double-down scroll"></i>
			</a>
			<!-- /Slider Pointer -->
					<?php 
					} ?>
					
		</section>
			<!-- /Slider Section -->
		<?php
		}
?>