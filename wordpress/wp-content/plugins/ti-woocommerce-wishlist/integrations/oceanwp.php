<?php
/**
 * TI WooCommerce Wishlist integration with:
 *
 * @name OceanWP
 *
 * @version
 *
 * @slug
 *
 * @url https://oceanwp.org/
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

// OceanWP theme compatibility;
if ( ! function_exists( 'oceanwp_fix_archive_markup' ) ) {
	add_action( 'init', 'oceanwp_fix_archive_markup' );

	/**
	 * OceanWP theme fix for catalog add to wishlist button position
	 */
	function oceanwp_fix_archive_markup() {
		if ( class_exists( 'OceanWP_WooCommerce_Config' ) && 'above_thumb' === tinv_get_option( 'add_to_wishlist_catalog', 'position' ) ) {
			remove_action( 'woocommerce_before_shop_loop_item', 'tinvwl_view_addto_htmlloop', 9 );
			add_action( 'woocommerce_before_shop_loop_item', 'tinvwl_view_addto_htmlloop', 10 );
		}
	}
}
