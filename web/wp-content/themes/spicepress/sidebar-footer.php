<?php if ( is_active_sidebar( 'footer_widget_area_left' ) || is_active_sidebar( 'footer_widget_area_center' ) ||  is_active_sidebar( 'footer_widget_area_right' )) : ?>
		
		<div class="row footer-sidebar">
			<?php if ( is_active_sidebar( 'footer_widget_area_left' ) ) : ?>
			<div class="col-md-4">		
				<?php dynamic_sidebar( 'footer_widget_area_left' ); ?>			
			</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'footer_widget_area_center' ) ) : ?>
			<div class="col-md-4">		
				<?php dynamic_sidebar( 'footer_widget_area_center' ); ?>			
			</div>
			<?php endif; ?>
			
			<?php if ( is_active_sidebar( 'footer_widget_area_right' ) ) : ?>
			<div class="col-md-4">		
				<?php dynamic_sidebar( 'footer_widget_area_right' ); ?>			
			</div>
			<?php endif; ?>
		</div>
		
<?php endif; ?>