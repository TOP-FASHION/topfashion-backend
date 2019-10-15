<?php
add_action('innofit_about_action','innofit_about_section');

function innofit_about_section()
{
	$about_section_enabled = get_theme_mod('home_about_section_enabled','on');
	$about_section_background = get_theme_mod('innofit_about_section_background');
	if($about_section_enabled !='off')
	{
$about_image = SPICEB_PLUGIN_URL .'inc/innofit/images/about/about.jpg';
$default = '<div class="row v-center">
						<div class="col-md-5 col-sm-5 col-xs-12">	
							<figure class="about-thumbnail mbottom-50">	
								<img src="'.esc_url($about_image).'" alt="About">
							</figure>
						</div>
						
						<div class="col-md-7 col-sm-7 col-xs-12">
							<div class="about-content mbottom-50">
								<h6 class="entry-subtitle">' . esc_html__('Welcome to','spicebox').' <span class="text-default">' . esc_html__('Innofit','spicebox').'</span></h6>
								<h1 class="entry-title">' . esc_html__('We have the right solutions','spicebox').'</h1>
								<p>' . esc_html__('Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totame rems aperiam, eaque ipsa quae ab illo inventore veritatis quasi architecto beatae vitaes dicta sunt explicabo. Nemo enim ipsam voluptatem.','spicebox').'</p>
								<p> ' . esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.','spicebox').'</p>
								<div class="ptop-15"><a href="#" class="btn-ex-small btn-border">' . esc_html__('Our Story','spicebox').'</a></div>
							</div>
						</div>
					</div>';
			$about_section_content = get_theme_mod('about_section_content',$default);
			?> 
			<section class="section-module about bg-grey <?php if($about_section_background=='') {?> left-right-half<?php }?>"  <?php if($about_section_background!='') {?> style="background-image: url(<?php echo $about_section_background; ?>);"<?php } ?> id="about">
				<div class="container">
				<?php
			echo $about_section_content;
			?> </div>
			</section> <?php
	}
 }
?>