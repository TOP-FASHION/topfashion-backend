<?php
/**
 * side bar template
 *
 * @package WordPress
 * @subpackage Spicepress
 */
?>

<div class="col-md-4 col-xs-12">
	<div class="sidebar">
<?php if ( is_active_sidebar( 'woocommerce' )  ) : ?>
<!--Sidebar-->
<?php dynamic_sidebar( 'woocommerce' ); ?>
<!--/End of Sidebar-->
<?php endif; ?>
	</div>
</div>	