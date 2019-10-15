<?php 
$header_one_name = get_theme_mod('header_one_name','');
$header_one_text = get_theme_mod('header_one_text','');
if ( get_header_image() != '') {?>
<header class="custom-header">	
	
	<div class="wp-custom-header">
		<img src="<?php header_image(); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" alt="" />
	</div>
	
	<div class="container header-content">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="">
					<?php if($header_one_name != '') { ?>
					<h1><?php echo esc_html($header_one_name);?></h1>
					<?php }  if($header_one_text != '') { ?>
					<h3><?php echo esc_html($header_one_text); ;?></h3>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	
</header>
<?php } ?>

<header class="header-overlapped">


<nav class="navbar-overlapped navbar navbar-custom navigation" role="navigation">
	<div class="container-fluid p-l-r-0">
	<?php  
	$header_logo_placing_overlap = get_theme_mod('header_logo_placing', 'left');
	if($header_logo_placing_overlap == 'left' || $header_logo_placing_overlap == 'center'){$menu_class = 'navbar-right';}
	if($header_logo_placing_overlap == 'right'){$menu_class = 'navbar-left';}
	
	if($header_logo_placing_overlap == 'left' || $header_logo_placing_overlap == 'center'){
	?>
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<?php the_custom_logo(); ?>

			<?php  if ( display_header_text() ) : ?>
			<div class="site-branding-text">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo esc_html($description); ?></p>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse">
				<span class="sr-only"><?php esc_html_e('Toggle navigation','certify'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		
	<?php } ?>
	
	<?php if($header_logo_placing_overlap == 'right'){ ?> 
	    
	    <div class="navbar-header align-right">
		
		    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse">
				<span class="sr-only"><?php esc_html_e('Toggle navigation','certify'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php the_custom_logo(); ?>
			<?php  if ( display_header_text() ) : ?>
			<div class="site-branding-text align-right">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo esc_html($description); ?></p>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	
	
	<?php } ?>

		<!-- Collect the nav links, forms, and other content for toggling -->
		
		<div class="collapse navbar-collapse" id="custom-collapse">
						<?php wp_nav_menu( array(
								'theme_location' => 'primary',
								'container'  => 'nav-collapse collapse navbar-inverse-collapse',
								'menu_class' => 'nav navbar-nav '.$menu_class.'',
								'fallback_cb' => 'spicepress_fallback_page_menu',
								'walker' => new spicepress_nav_walker() 
							) ); 
						?>
				
		</div><!-- /.navbar-collapse -->
		<!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>

</header>