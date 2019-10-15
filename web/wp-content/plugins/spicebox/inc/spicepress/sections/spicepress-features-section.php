<?php
/**
 * Services section for the homepage.
 */
if ( ! function_exists( 'spiceb_spicepress_service' ) ) :

	function spiceb_spicepress_service() {

		$home_service_section_enabled = get_theme_mod('home_service_section_enabled','on');
		$home_service_section_title = get_theme_mod('home_service_section_title',__('What we Offer?','spicepress'));
		$home_service_section_discription = get_theme_mod('home_service_section_discription','Sea summo mazim ex, ea errem eleifend definitionem vim. Ut nec hinc dolor possim mei ludus efficiendi ei sea summo mazim ex.');
		$spicepress_service_content  = get_theme_mod( 'spicepress_service_content', spiceb_spicepress_get_service_default() );
		$section_is_empty = empty( $spicepress_service_content ) && empty( $home_service_section_discription ) && empty( $home_service_section_title );
		if($home_service_section_enabled !='off')
		{	
		?>
	    <!-- Section Title -->
<section class="service-section">
	<div class="container">		
		<?php if( ($home_service_section_title) || ($home_service_section_discription)!='' ) { ?>
		<div class="row">
			<div class="col-md-12">
				<div class="section-header">
					<?php if ( ! empty( $home_service_section_title ) || is_customize_preview() ) : ?>
					<h1 class="widget-title">
					<?php echo $home_service_section_title; ?>
					</h1>
					<?php endif; ?>
					<div class="widget-separator"><span></span></div>
					<?php if($home_service_section_discription) {?>
					<div class="separator"><span></span></div>
					<p class="wow fadeInDown animated">
					<?php echo $home_service_section_discription; ?>
					</p>
					<?php } ?>
				</div>
			</div>
		</div>
		<!-- /Section Title -->
		<?php } 				
				spiceb_spicepress_service_content( $spicepress_service_content );
		?>
	</div>
</section>
<?php		} }

endif;


function spiceb_spicepress_service_content( $spicepress_service_content, $is_callback = false ) {
	if ( ! $is_callback ) {
	?>
	
		<?php
	}
	if ( ! empty( $spicepress_service_content ) ) :

		$allowed_html = array(
		'br'     => array(),
		'em'     => array(),
		'strong' => array(),
		'b'      => array(),
		'i'      => array(),
		);
		
		$spicepress_service_content = json_decode( $spicepress_service_content );
		if ( ! empty( $spicepress_service_content ) ) {
			$i = 1;
			echo '<div class="row" id="service_content_section">';
			foreach ( $spicepress_service_content as $service_item ) :
				$icon = ! empty( $service_item->icon_value ) ?  $service_item->icon_value : '';
				$image = ! empty( $service_item->image_url ) ?  $service_item->image_url: '';
				$title = ! empty( $service_item->title ) ? $service_item->title : '';
				$text = ! empty( $service_item->text ) ?  $service_item->text : '';
				$link = ! empty( $service_item->link ) ? $service_item->link : '';
				$color = ! empty( $service_item->color ) ? $service_item->color : '';
				$choice = ! empty( $service_item->choice ) ? $service_item->choice : 'customizer_repeater_icon';
				$open_new_tab = ! empty( $service_item->open_new_tab ) ? $service_item->open_new_tab : 'no';
				
				?>
				<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="post text-center wow flipInX animated" data-wow-delay=".5s">
			
							<?php if($choice == 'customizer_repeater_image'){ ?>	
								<?php if ( ! empty( $image ) ) : ?>
								<figure class="post-thumbnail">	
								
									<?php if ( ! empty( $link ) ) : ?>
										<a href="<?php echo esc_url( $link ); ?>" <?php if($open_new_tab == 'yes'){ echo 'target="_blank"';}?>>
									<?php endif; ?>
									<img class="services_cols_mn_icon"
										 src="<?php echo esc_url( $image ); ?>" <?php if ( ! empty( $title ) ) : ?> alt="<?php echo esc_attr( $title ); ?>" title="<?php echo esc_attr( $title ); ?>" <?php endif; ?> />
									<?php if ( ! empty( $link ) ) : ?>
										</a>
									<?php endif; ?>
								<?php endif; ?>
								</figure>
							<?php } ?>
			
				<?php if($choice == 'customizer_repeater_icon'){ ?>
				
				<?php if ( ! empty( $icon ) ) :?>
				<figure class="post-thumbnail">	
								<?php if ( ! empty( $link ) ) : ?>
						<a href="<?php echo esc_url( $link ); ?>" <?php if($open_new_tab == 'yes'){ echo 'target="_blank"';}?> >
							<?php endif; ?>
							
									<i class="fa <?php echo esc_html( $icon ); ?> txt-pink"></i>
									
						<?php if ( ! empty( $link ) ) : ?>
						</a>
					<?php endif; ?>
							</figure>	
							<?php endif; ?>
				<?php } ?>
				
				<?php if ( ! empty( $title ) ) : ?>
				
				<?php if ( ! empty( $link ) ) : ?>
						<a href="<?php echo esc_url( $link ); ?>" <?php if($open_new_tab == 'yes'){ echo 'target="_blank"';}?> >
							<?php endif; ?>
							
								<div class="entry-header">
								<h4 class="entry-title"><?php echo esc_html( $title ); ?></h4>
								</div>
							<?php if ( ! empty( $link ) ) : ?>
						</a>
					<?php endif; ?>
					
							<?php endif; ?>
				<?php if ( ! empty( $link ) ) : ?>
						</a>
					<?php endif; ?>
			<?php if ( ! empty( $text ) ) : ?>
			
							<div class="entry-content">
							<p><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></p>
							</div>
			
							
						<?php endif; ?>
			</div>
			</div>
				<?php
				if ( $i % apply_filters( 'spicepress_service_per_row_no', 3 ) == 0 ) {
					echo '</div><!-- /.row -->';
					echo '<div class="row">';
				}
				$i++;

			endforeach;
			echo '</div>';
		}// End if().
		endif;
	if ( ! $is_callback ) {
	?>
		
		<?php
	}
}

/**
 * Get default values for service section.
 *
 * @since 1.1.31
 * @access public
 */
function spiceb_spicepress_get_service_default() {

	return apply_filters(
		'spicepress_service_content', json_encode(
			array(
				array(
				'icon_value' => 'fa-laptop',
				'title'      => esc_html__( 'Easy to Use', 'spicepress' ),
				'text'       => 'Phasellus facilisis, nunc in lacinia auctor, eros lacus aliquet velit, quis lobortis risus nunc nec nisi maecans et turpis vitae velit.volutpat porttitor a sit amet est. In eu rutrum ante. Nullam id lorem fermentum, accumsan enim non auctor neque.', 'spicepress',
				'choice'	=> 'customizer_repeater_icon',
				'link'       => '#',
				'open_new_tab' => 'no',
				),
				array(
				'icon_value' => 'fa fa-cogs',
				'title'      => esc_html__( 'Multi-Purpose', 'spicepress' ),
				'text'       => 'Phasellus facilisis, nunc in lacinia auctor, eros lacus aliquet velit, quis lobortis risus nunc nec nisi maecans et turpis vitae velit.volutpat porttitor a sit amet est. In eu rutrum ante. Nullam id lorem fermentum, accumsan enim non auctor neque.', 'spicepress',
				'choice'	=> 'customizer_repeater_icon',
				'link'       => '#',
				'open_new_tab' => 'no',
				),
				array(
				'icon_value' => 'fa fa-mobile',
				'title'      => esc_html__( 'Responsive Design', 'spicepress' ),
				'text'       => 'Phasellus facilisis, nunc in lacinia auctor, eros lacus aliquet velit, quis lobortis risus nunc nec nisi maecans et turpis vitae velit.volutpat porttitor a sit amet est. In eu rutrum ante. Nullam id lorem fermentum, accumsan enim non auctor neque.',
				'choice'	=> 'customizer_repeater_icon',
				'link'       => '#',
				'open_new_tab' => 'no',
				),
			)
		)
	);
}

if ( function_exists( 'spiceb_spicepress_service' ) ) {
	$section_priority = apply_filters( 'spicepress_section_priority', 11, 'spiceb_spicepress_service' );
	add_action( 'spiceb_spicepress_sections', 'spiceb_spicepress_service', absint( $section_priority ) );
}