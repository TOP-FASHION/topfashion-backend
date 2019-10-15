<div class="blog">
	<article class="post" <?php post_class( 'post-content-area' ); ?>>
		<div class="post-content">
			<?php
			if ( class_exists( 'WooCommerce' ) ) {
					
					if( is_account_page() || is_cart() || is_checkout() ) {
			}}else{ }			
			?>
			<div class="entry-content">
			<?php the_content( __('Read More','innofit') ); ?>
			</div>						
		</div>
	</article>
</div>