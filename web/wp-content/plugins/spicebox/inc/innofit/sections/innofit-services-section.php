<?php 
add_action('innofit_services_action','innofit_services_section');

function innofit_services_section()
{ 	
	$service_data = get_theme_mod('innofit_service_content');
	if(empty($service_data))
		{
			$service_data = json_encode( array(
			array(
				'icon_value' => 'fa-headphones',
				'title'      => esc_html__( 'Unlimited Support', 'spicebox' ),
				'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
				'choice'    => 'customizer_repeater_icon',
				'link'       => '#',
				'open_new_tab' => 'yes',
				'id'         => 'customizer_repeater_56d7ea7f40b56',
				),
				array(
				'icon_value' => 'fa-mobile',
				'title'      => esc_html__( 'Pixel Perfect Design', 'spicebox' ),
				'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
				'choice'    => 'customizer_repeater_icon',
				'link'       => '#',
				'open_new_tab' => 'yes',
				'id'         => 'customizer_repeater_56d7ea7f40b66',
				),
				array(
				'icon_value' => 'fa fa-cogs',
				'title'      => esc_html__( 'Powerful Options', 'spicebox' ),
				'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
				'choice'    => 'customizer_repeater_icon',
				'link'       => '#',
				'open_new_tab' => 'yes',
				'id'         => 'customizer_repeater_56d7ea7f40b86',
				),
				array(
				'icon_value' => 'fa-android',
				'title'      => esc_html__( 'App Development', 'spicebox' ),
				'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
				'choice'    => 'customizer_repeater_icon',
				'link'       => '#',
				'open_new_tab' => 'yes',
				'id'         => 'customizer_repeater_56d7ea7f40b88',
				),
				array(
				'icon_value' => 'fa-code',
				'title'      => esc_html__( 'Unique and Clean', 'spicebox' ),
				'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
				'choice'    => 'customizer_repeater_icon',
				'link'       => '#',
				'open_new_tab' => 'yes',
				'id'         => 'customizer_repeater_56d7ea7f40b89',
				),
				array(
				'icon_value' => 'fa-users',
				'title'      => esc_html__( 'Satisfied Clients', 'spicebox' ),
				'text'       => 'Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore.',
				'choice'    => 'customizer_repeater_icon',
				'link'       => '#',
				'open_new_tab' => 'yes',
				'id'         => 'customizer_repeater_56d7ea7f40b91',
				),
			) );
		}
		
	$innofit_home_service_enabled = get_theme_mod('home_service_section_enabled','on');
	if($innofit_home_service_enabled !='off')
	{ 
	$innofit_service_section_title = get_theme_mod('home_service_section_title',__('What we do','spicebox'));
	$innofit_service_section_discription = get_theme_mod('home_service_section_discription',__('Services we provide','spicebox'));
	?>

<!-- Service Section -->
<section class="section-module services" id="services">
	<div class="container">
		<?php if($innofit_service_section_discription!='' || innofit_service_section_title!=''){ ?>
		<div class="row">
			<div class="col-md-12">
				<div class="section-header">
					<?php if($innofit_service_section_discription!=''){ ?>
					<p class="section-subtitle"><?php echo $innofit_service_section_discription; ?></p>
					<?php } if($innofit_service_section_title){?>
					<h1 class="section-title"><?php echo $innofit_service_section_title; ?></h1>
					<?php }?>
				</div>
			</div>
		</div>
		<?php }?>
		
		
		<div id="service_content">
		<div class="row">
		<?php $service_data = json_decode($service_data);
		if (!empty($service_data))
		{ 
			foreach($service_data as $service_team)
			{ ?>
			
				<div class="col-md-4 col-sm-6 col-xs-12">				
					<article class="post">
						<?php 
						if($service_team->choice == 'customizer_repeater_icon'){
						if($service_team->icon_value!=''){?>
						<figure class="post-thumbnail">
						<?php if($service_team->link!=''){?>
							<a <?php if($service_team->open_new_tab== 'yes'){echo "target='_blank'";} ?> href="<?php echo $service_team->link; ?>">
							<i class="fa <?php echo $service_team->icon_value; ?>"></i>
							</a>
						<?php }else{ ?>
							<a><i class="fa <?php echo $service_team->icon_value; ?>"></i></a>
					    <?php } ?>
						</figure>
						 <?php }} else if($service_team->choice =='customizer_repeater_image'){
							if($service_team->image_url!=''){ ?>
							<figure class="post-thumbnail">	
							<?php if($service_team->link!=''){?>
							<a <?php if($service_team->open_new_tab== 'yes'){echo "target='_blank'";} ?> href="<?php echo $service_team->link; ?>">
							<?php }?>
							<img src="<?php echo $service_team->image_url; ?>">
							<?php if($service_team->link!=''){ ?>
							
							</a>
							<?php }?>
						    </figure>
							
						 <?php } }

						if ($service_team->title !=""){?>
						<div class="entry-header">
							<h5 class="entry-title text-center"> 
							<?php if($service_team->link!=''){ ?>
							<a href="<?php echo $service_team->link; ?>" <?php if($service_team->open_new_tab== 'yes'){echo "target='_blank'";} ?>> 
							<?php } 
							
							echo $service_team->title;
							
							if($service_team->link!=''){?>
							</a>
							<?php }?>
							</h5>
						</div>
						<?php } if($service_team->text !="")?>
						<div class="entry-content">
							<p><?php echo $service_team->text ; ?></p>
						</div>
					</article>
				</div>
		
			<?php 
			}
		} 
		?>
		</div></div>
		
	</div>
</section>
<!-- /End of Service Section -->
<?php } //End of service section enable condition

} ?>