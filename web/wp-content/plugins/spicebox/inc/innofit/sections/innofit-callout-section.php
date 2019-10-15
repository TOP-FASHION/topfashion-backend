<?php 
add_action('innofit_callout_action','innofit_callout_section');
function innofit_callout_section()
{
	$cta_section_enable  = get_theme_mod('cta_section_enable','on');
	if($cta_section_enable !='off')
	{
	$home_call_out_title = get_theme_mod('home_call_out_title', __('We create beautiful WordPress themes for you!','spicebox'));
	$home_call_out_desc = get_theme_mod('home_call_out_desc',__('Choose a package that suits all your needs to build a website.','spicebox'));
	$home_call_out_btn_text = get_theme_mod('home_call_out_btn_text',__('Buy Innofit','spicebox'));
	$home_call_out_btn_link = get_theme_mod('home_call_out_btn_link',esc_url('#'));
	$home_call_out_btn_link_target = get_theme_mod('home_call_out_btn_link_target',true);
	?>	
	<!--Call to Action-->
	<section class="section-module call-to-action-one bg-grey" id="call-to-action">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-9 col-xs-12">
					<div class="text-left">
						<h4 class="title"><?php echo $home_call_out_title; ?></h4>
						<p><?php echo $home_call_out_desc;?></p>
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<div class="ptop-15 pbottom-5 text-right">
						<?php if($home_call_out_btn_text!='') {?>
						<a <?php if($home_call_out_btn_link !='' ) { ?> href="<?php echo $home_call_out_btn_link; ?>" class="btn-small btn-border-dark
						" <?php if($home_call_out_btn_link_target== true) { echo "target='_blank'"; } } ?>><?php echo $home_call_out_btn_text; ?>
						</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
		<!--/Call to Action-->	
	<?php }
		
} ?>