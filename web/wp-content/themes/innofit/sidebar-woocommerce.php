<?php
/**
 * side bar template
 *
 * @package WordPress
 * @subpackage Innofit
 */
?>

<div class="col-md-4 col-sm-4 col-xs-12">

	<div class="sidebar padding-left-30">
	
		<?php if ( is_active_sidebar( 'woocommerce' )  ) : ?>
<!--Sidebar-->
<?php dynamic_sidebar( 'woocommerce' ); ?>
<!--/End of Sidebar-->
<?php endif; ?>	
		
	</div>
	
</div>