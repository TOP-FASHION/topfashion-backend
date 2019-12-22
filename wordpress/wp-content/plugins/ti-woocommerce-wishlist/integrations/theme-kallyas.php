<?php
/**
 * TI WooCommerce Wishlist integration with:
 *
 * @name Kallyas
 *
 * @version 4.17.1
 *
 * @slug kallyas
 *
 * @url http://kallyas.net/
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! function_exists( 'kallyas_init' ) ) {

	/**
	 * Run hooks after theme init.
	 */
	function kallyas_init() {
		if ( function_exists( 'zget_option' ) ) {

			$show_cart_to_visitors = zget_option( 'show_cart_to_visitors', 'zn_woocommerce_options', false, 'yes' );
			if ( $show_cart_to_visitors == 'no' && ! is_user_logged_in() ) {
				add_filter( 'tinvwl_allow_addtowishlist_single_product_summary', '__return_true' );
			}


		}
	}

	add_action( 'init', 'kallyas_init' );
}
