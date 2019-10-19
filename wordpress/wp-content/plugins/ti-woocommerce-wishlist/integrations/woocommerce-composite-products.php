<?php
/**
 * TI WooCommerce Wishlist integration with:
 *
 * @name WooCommerce Composite Products
 *
 * @version 4.2.0
 *
 * @slug woocommerce-composite-products
 *
 * @url https://woocommerce.com/products/composite-products/
 *
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! function_exists( 'tinv_wishlist_metasupport_woocommerce_composite_products' ) ) {

	/**
	 * Set description for meta WooCommerce Composite Products
	 *
	 * @param array $meta Meta array.
	 * @param integer $product_id Product ID.
	 *
	 * @return array
	 */
	function tinv_wishlist_metasupport_woocommerce_composite_products( $meta, $product_id ) {
		if ( array_key_exists( 'wccp_component_selection', $meta ) && is_array( $meta['wccp_component_selection'] ) ) {
			$meta = array();
		} // End if().

		return $meta;
	}

	add_filter( 'tinvwl_wishlist_item_meta_post', 'tinv_wishlist_metasupport_woocommerce_composite_products', 10, 2 );
} // End if().

if ( ! function_exists( 'tinvwl_row_woocommerce_composite_products' ) ) {

	/**
	 * Add rows for sub product for WooCommerce Composite Products
	 *
	 * @param array $wl_product Wishlist Product.
	 * @param \WC_Product_Composite $product Woocommerce Product.
	 */
	function tinvwl_row_woocommerce_composite_products( $wl_product, $product ) {
		if ( is_object( $product ) && $product->is_type( 'composite' ) && array_key_exists( 'wccp_component_selection', $wl_product['meta'] ) ) {
			$product_quantity = $product->is_sold_individually() ? 1 : $wl_product['quantity'];

			$components = $product->get_components();
			foreach ( $components as $component_id => $component ) {
				$composited_product_id       = ! empty( $wl_product['meta']['wccp_component_selection'][ $component_id ] ) ? absint( $wl_product['meta']['wccp_component_selection'][ $component_id ] ) : '';
				$composited_product_quantity = isset( $wl_product['meta']['wccp_component_quantity'][ $component_id ] ) ? absint( $wl_product['meta']['wccp_component_quantity'][ $component_id ] ) : $component->get_quantity( 'min' );

				$composited_variation_id = isset( $wl_product['meta']['wccp_variation_id'][ $component_id ] ) ? wc_clean( $wl_product['meta']['wccp_variation_id'][ $component_id ] ) : '';

				if ( $composited_product_id ) {

					$composited_product_wrapper = $component->get_option( $composited_variation_id ? $composited_variation_id : $composited_product_id );

					if ( ! $composited_product_wrapper ) {
						continue;
					}

					$composited_product = $composited_product_wrapper->get_product();

					if ( $composited_product->is_sold_individually() && $composited_product_quantity > 1 ) {
						$composited_product_quantity = 1;
					}

					$product_url   = $composited_product->get_permalink();
					$product_image = $composited_product->get_image();
					$product_title = is_callable( array(
						$composited_product,
						'get_name'
					) ) ? $composited_product->get_name() : $composited_product->get_title();
					$product_price = $composited_product->get_price_html();

					$component_option = $product->get_component_option( $component_id, $composited_product_id );

					if ( $component_option ) {
						if ( false === $component_option->is_priced_individually() && $composited_product->get_price() == 0 ) {
							$product_price = '';
						} elseif ( false === $component_option->get_component()->is_subtotal_visible( 'cart' ) ) {
							$product_price = '';
						} elseif ( apply_filters( 'woocommerce_add_composited_cart_item_prices', true ) ) {
							if ( $product_price ) {
								$product_price = '<span class="component_table_item_price">' . $product_price . '</span>';
							}
						}
					}

					if ( $composited_product->is_visible() ) {
						$product_image = sprintf( '<a href="%s">%s</a>', esc_url( $product_url ), $product_image );
						$product_title = sprintf( '<a href="%s">%s</a>', esc_url( $product_url ), $product_title );
					}
					$product_title .= tinv_wishlist_get_item_data( $composited_product, $wl_product );

					$availability = (array) $composited_product->get_availability();
					if ( ! array_key_exists( 'availability', $availability ) ) {
						$availability['availability'] = '';
					}
					if ( ! array_key_exists( 'class', $availability ) ) {
						$availability['class'] = '';
					}
					$availability_html = empty( $availability['availability'] ) ? '<p class="stock ' . esc_attr( $availability['class'] ) . '"><span><i class="ftinvwl ftinvwl-check"></i></span><span class="tinvwl-txt">' . esc_html__( 'In stock', 'ti-woocommerce-wishlist' ) . '</span></p>' : '<p class="stock ' . esc_attr( $availability['class'] ) . '"><span><i class="ftinvwl ftinvwl-times"></i></span><span>' . esc_html( $availability['availability'] ) . '</span></p>';
					$row_string        = '<tr>';
					$row_string        .= ( ( ! is_user_logged_in() || get_current_user_id() !== $wl_product['author'] ) ? ( ( ! tinv_get_option( 'table', 'colm_checkbox' ) ) ? '' : '<td colspan="1"></td>' ) : '<td colspan="' . ( ( ! tinv_get_option( 'table', 'colm_checkbox' ) ) ? '1' : '2' ) . '"></td>' ) . '&nbsp;<td class="product-thumbnail">%2$s</td><td class="product-name">%1$s:<br/>%3$s</td>';
					if ( tinv_get_option( 'product_table', 'colm_price' ) ) {
						$row_string .= ( $product_price && ! $composited_product->is_type( 'bundle' ) ) ? '<td class="product-price">%4$s &times; %6$s</td>' : '<td class="product-price">%4$s</td>';
					}
					if ( tinv_get_option( 'product_table', 'colm_date' ) ) {
						$row_string .= '<td class="product-date">&nbsp;</td>';
					}
					if ( tinv_get_option( 'product_table', 'colm_stock' ) ) {
						$row_string .= '<td class="product-stock">%5$s</td>';
					}
					if ( tinv_get_option( 'product_table', 'colm_quantity' ) ) {
						$row_string .= '<td class="product-quantity">&nbsp;</td>';
					}
					if ( tinv_get_option( 'product_table', 'add_to_cart' ) ) {
						$row_string .= '<td class="product-action">&nbsp;</td>';
					}
					$row_string .= '</tr>';

					if ( $composited_product->is_type( 'bundle' ) ) {
						$product_price = $availability_html = $product_title = '';
					}

					echo sprintf( $row_string, is_callable( array(
						$component,
						'get_name'
					) ) ? $component->get_name() : $component->get_title(), $product_image, $product_title, $product_price, $availability_html, $composited_product_quantity * $product_quantity ); // WPCS: xss ok.

					if ( $composited_product->is_type( 'bundle' ) ) {

						$wl_product_bundle               = $wl_product;
						$wl_product_bundle['product_id'] = $composited_product->get_id();

						$component_meta = array();

						foreach ( $wl_product['meta'] as $key => $value ) {
							if ( substr( $key, 0, strlen( 'component_' . $component_id ) ) === 'component_' . $component_id ) {

								$component_meta[ substr( $key, strlen( 'component_' . $component_id . '_' ), strlen( $key ) ) ] = $value;
							}
						}

						$wl_product_bundle['meta'] = $component_meta;

						tinvwl_row_woocommerce_product_bundles( $wl_product_bundle, $composited_product, $composited_product_wrapper->get_discount() );
					}
				} // End if().
			} // End foreach().
		} // End if().
	}

	add_action( 'tinvwl_wishlist_row_after', 'tinvwl_row_woocommerce_composite_products', 10, 2 );
} // End if().

if ( ! function_exists( 'tinvwl_item_price_woocommerce_composite_products' ) ) {

	/**
	 * Modify price for WooCommerce Composite Products
	 *
	 * @param string $price Returned price.
	 * @param array $wl_product Wishlist Product.
	 * @param \WC_Product $product Woocommerce Product.
	 *
	 * @return string
	 */
	function tinvwl_item_price_woocommerce_composite_products( $price, $wl_product, $product ) {
		if ( is_object( $product ) && $product->is_type( 'composite' ) && array_key_exists( 'wccp_component_selection', $wl_product['meta'] ) ) {
			$components    = $product->get_components();
			$_price        = $product->get_price();
			$regular_price = $product->get_regular_price();
			foreach ( $components as $component_id => $component ) {
				$composited_product_id       = ! empty( $wl_product['meta']['wccp_component_selection'][ $component_id ] ) ? absint( $wl_product['meta']['wccp_component_selection'][ $component_id ] ) : '';
				$composited_product_quantity = isset( $wl_product['meta']['wccp_component_quantity'][ $component_id ] ) ? absint( $wl_product['meta']['wccp_component_quantity'][ $component_id ] ) : $component->get_quantity( 'min' );

				$composited_variation_id = isset( $wl_product['meta']['wccp_variation_id'][ $component_id ] ) ? wc_clean( $wl_product['meta']['wccp_variation_id'][ $component_id ] ) : '';

				if ( $composited_product_id ) {
					$composited_product_wrapper = $component->get_option( $composited_variation_id ? $composited_variation_id : $composited_product_id );
					if ( $component->is_priced_individually() ) {

						$composited_product = $composited_product_wrapper->get_product();
						if ( $composited_product->is_type( 'bundle' ) ) {

							$wl_product_bundle               = $wl_product;
							$wl_product_bundle['product_id'] = $composited_product->get_id();

							$component_meta = array();

							foreach ( $wl_product['meta'] as $key => $value ) {
								if ( substr( $key, 0, strlen( 'component_' . $component_id ) ) === 'component_' . $component_id ) {

									$component_meta[ substr( $key, strlen( 'component_' . $component_id . '_' ), strlen( $key ) ) ] = $value;
								}
							}

							$wl_product_bundle['meta'] = $component_meta;

							$bundle_price  = tinvwl_item_price_woocommerce_product_bundles( 0, $wl_product_bundle, $composited_product, true );
							$regular_price += $bundle_price;

							if ( $discount = $composited_product_wrapper->get_discount() ) {
								$bundle_price = empty( $bundle_price ) ? $bundle_price : round( (double) $bundle_price * ( 100 - $discount ) / 100, wc_cp_price_num_decimals() );
							}
							$_price += $bundle_price;

							continue;
						}

						$_price        += $composited_product_wrapper->get_price() * $composited_product_quantity;
						$regular_price += $composited_product_wrapper->get_regular_price() * $composited_product_quantity;
					}
				}
			}
			if ( $_price == $regular_price ) {
				$price = wc_price( $_price ) . $product->get_price_suffix();
			} else {
				$price = wc_format_sale_price( $regular_price, $_price ) . $product->get_price_suffix();
			}
		}

		return $price;
	}

	add_filter( 'tinvwl_wishlist_item_price', 'tinvwl_item_price_woocommerce_composite_products', 10, 3 );
} // End if().
