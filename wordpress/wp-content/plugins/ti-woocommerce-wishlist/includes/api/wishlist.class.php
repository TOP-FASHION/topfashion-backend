<?php
/**
 * REST API plugin class
 *
 * @since             1.13.0
 * @package           TInvWishlist
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}


/**
 * REST API plugin class
 */
class TInvWL_Includes_API_Wishlist {

	/**
	 * Endpoint namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'wc/v3';

	/**
	 * Route base.
	 *
	 * @var string
	 */
	protected $rest_base = 'wishlist';

	/**
	 * Register the routes for wishlist.
	 */
	public function register_routes() {

		// Get wishlist data by share key.
		register_rest_route( $this->namespace, '/' . $this->rest_base . '/get_by_share_key/(?P<share_key>[A-Fa-f0-9]{6})', array(
			array(
				'methods'  => WP_REST_Server::READABLE,
				'callback' => array( $this, 'wishlist_get_by_share_key' ),
			),
		) );

		// Get wishlist(s) data by user ID.
		register_rest_route( $this->namespace, '/' . $this->rest_base . '/get_by_user/(?P<user_id>[\d]+)', array(
			array(
				'methods'  => WP_REST_Server::READABLE,
				'callback' => array( $this, 'wishlist_get_by_user' ),
			),
		) );

		// Update wishlist data by share key.
		register_rest_route( $this->namespace, '/' . $this->rest_base . '/update/(?P<share_key>[A-Fa-f0-9]{6})', array(
			array(
				'methods'  => WP_REST_Server::CREATABLE,
				'callback' => array( $this, 'wishlist_update' ),
			),
		) );

		// Get wishlist products by share key.
		register_rest_route( $this->namespace, '/' . $this->rest_base . '/(?P<share_key>[A-Fa-f0-9]{6})/get_products', array(
			array(
				'methods'  => WP_REST_Server::READABLE,
				'callback' => array( $this, 'wishlist_get_products' ),
			),
		) );

		// Add product to wishlist by share key.
		register_rest_route( $this->namespace, '/' . $this->rest_base . '/(?P<share_key>[A-Fa-f0-9]{6})/add_product', array(
			array(
				'methods'  => WP_REST_Server::CREATABLE,
				'callback' => array( $this, 'wishlist_add_product' ),
			),
		) );

		// Remove product by item ID.
		register_rest_route( $this->namespace, '/' . $this->rest_base . '/remove_product/(?P<item_id>[\d]+)', array(
			array(
				'methods'  => WP_REST_Server::READABLE,
				'callback' => array( $this, 'wishlist_remove_product' ),
			),
		) );
	}

	/**
	 *  Get wishlist data by share key.
	 *
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return mixed|WP_Error|WP_REST_Response
	 */
	public function wishlist_get_by_share_key( $request ) {
		try {
			$share_key = $request['share_key'];

			if ( ! empty( $share_key ) && preg_match( '/^[A-Fa-f0-9]{6}$/', $share_key ) ) {
				$wishlist = tinv_wishlist_get( $share_key );
				if ( ! $wishlist ) {
					throw new WC_REST_Exception( 'ti_woocommerce_wishlist_api_invalid_share_key', __( 'Invalid wishlist share key.', 'ti-woocommerce-wishlist' ), 400 );
				}

				$response = $this->prepare_wishlist_data( $wishlist );

				return rest_ensure_response( $response );


			}
		} catch ( WC_REST_Exception $e ) {
			return new WP_Error( $e->getErrorCode(), $e->getMessage(), array( 'status' => $e->getCode() ) );
		}
	}

	/**
	 * Get wishlist(s) data by user ID.
	 *
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return mixed|WP_Error|WP_REST_Response
	 */
	public function wishlist_get_by_user( $request ) {
		try {
			$user_id = $request['user_id'];

			if ( ! empty( $user_id ) ) {
				$wl        = new TInvWL_Wishlist();
				$wishlists = $wl->get_by_user( $user_id );

				if ( ! $wishlists ) {
					throw new WC_REST_Exception( 'ti_woocommerce_wishlist_api_wishlist_not_found', __( 'No wishlists found for this user.', 'ti-woocommerce-wishlist' ), 400 );
				}

				$response = array();
				foreach ( $wishlists as $wishlist ) {
					$response[] = $this->prepare_wishlist_data( $wishlist );
				}

				return rest_ensure_response( $response );
			}
		} catch ( WC_REST_Exception $e ) {
			return new WP_Error( $e->getErrorCode(), $e->getMessage(), array( 'status' => $e->getCode() ) );
		}
	}

	/**
	 * Update wishlist data by share key.
	 *
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return mixed|WP_Error|WP_REST_Response
	 */
	public function wishlist_update( $request ) {
		try {
			$share_key = $request['share_key'];

			if ( ! empty( $share_key ) && preg_match( '/^[A-Fa-f0-9]{6}$/', $share_key ) ) {

				$wl = new TInvWL_Wishlist();

				$wishlist = $wl->get_by_share_key( $share_key );

				if ( ! $wishlist ) {
					throw new WC_REST_Exception( 'ti_woocommerce_wishlist_api_invalid_share_key', __( 'Invalid wishlist share key.', 'ti-woocommerce-wishlist' ), 400 );
				}

				$data = array();
				if ( ! empty( $request['title'] ) ) {
					$data['title'] = $request['title'];
				}

				if ( ! empty( $request['user_id'] ) ) {
					$data['author'] = $request['user_id'];
				}

				if ( $data ) {
					$update = $wl->update( $wishlist['ID'], $data );

					if ( $update ) {
						$response = $wl->get_by_share_key( $share_key );

						return rest_ensure_response( $this->prepare_wishlist_data( $response ) );
					}

					throw new WC_REST_Exception( 'ti_woocommerce_wishlist_api_wishlist_update_error', __( 'Update wishlist data failed.', 'ti-woocommerce-wishlist' ), 400 );

				}
			}
		} catch ( WC_REST_Exception $e ) {
			return new WP_Error( $e->getErrorCode(), $e->getMessage(), array( 'status' => $e->getCode() ) );
		}
	}

	/**
	 * Get wishlist products by share key.
	 *
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return mixed|WP_Error|WP_REST_Response
	 */
	public function wishlist_get_products( $request ) {
		try {
			$share_key = $request['share_key'];

			if ( ! empty( $share_key ) && preg_match( '/^[A-Fa-f0-9]{6}$/', $share_key ) ) {

				$wl = new TInvWL_Wishlist();

				$wishlist = $wl->get_by_share_key( $share_key );

				if ( ! $wishlist ) {
					throw new WC_REST_Exception( 'ti_woocommerce_wishlist_api_invalid_share_key', __( 'Invalid wishlist share key.', 'ti-woocommerce-wishlist' ), 400 );
				}

				$wlp = new TInvWL_Product();

				$args                = array();
				$args['wishlist_id'] = $wishlist['ID'];
				$args['external']    = false;

				if ( $request['count'] ) {
					$args['count'] = $request['count'];
				}
				if ( $request['offset'] ) {
					$args['offset'] = $request['offset'];
				}
				if ( $request['order'] ) {
					$args['order'] = $request['order'];
				}

				$products = $wlp->get( $args );

				if ( ! $products ) {
					throw new WC_REST_Exception( 'ti_woocommerce_wishlist_api_wishlist_products_not_found', __( 'No products found for this wishlist.', 'ti-woocommerce-wishlist' ), 400 );
				}

				$response = array();

				foreach ( $products as $product ) {
					$response[] = $this->prepare_product_data( $product );
				}

				return rest_ensure_response( $response );
			}
		} catch ( WC_REST_Exception $e ) {
			return new WP_Error( $e->getErrorCode(), $e->getMessage(), array( 'status' => $e->getCode() ) );
		}
	}

	/**
	 * Add product to wishlist by share key.
	 *
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return mixed|WP_Error|WP_REST_Response
	 */
	public function wishlist_add_product( $request ) {
		try {
			$share_key = $request['share_key'];

			if ( ! empty( $share_key ) && preg_match( '/^[A-Fa-f0-9]{6}$/', $share_key ) ) {

				$wl = new TInvWL_Wishlist();

				$wishlist = $wl->get_by_share_key( $share_key );

				if ( ! $wishlist ) {
					throw new WC_REST_Exception( 'ti_woocommerce_wishlist_api_invalid_share_key', __( 'Invalid wishlist share key.', 'ti-woocommerce-wishlist' ), 400 );
				}

				$wlp = new TInvWL_Product();

				$args                = array();
				$args['wishlist_id'] = $wishlist['ID'];
				$args['author']      = $wishlist['author'];

				if ( $request['product_id'] ) {
					$args['product_id'] = $request['product_id'];
				}
				if ( $request['variation_id'] ) {
					$args['variation_id'] = $request['variation_id'];
				}
				if ( $request['meta'] ) {
					$meta = $request['meta'];
				}

				$product = $wlp->add_product( $args, $meta );

				if ( ! $product ) {
					throw new WC_REST_Exception( 'ti_woocommerce_wishlist_api_wishlist_products_not_found', __( 'Add product to wishlist failed.', 'ti-woocommerce-wishlist' ), 400 );
				}

				$response = array();
				$products = $wlp->get( array( 'ID' => $product ) );
				foreach ( $products as $product ) {
					$response[] = $this->prepare_product_data( $product );
				}

				return rest_ensure_response( $response );
			}
		} catch ( WC_REST_Exception $e ) {
			return new WP_Error( $e->getErrorCode(), $e->getMessage(), array( 'status' => $e->getCode() ) );
		}
	}

	/**
	 * Remove product by item ID.
	 *
	 * @param WP_REST_Request $request Request object.
	 *
	 * @return mixed|WP_Error|WP_REST_Response
	 */
	public function wishlist_remove_product( $request ) {
		try {
			$item_id = $request['item_id'];

			if ( ! empty( $item_id ) ) {
				$wlp = new TInvWL_Product();

				$args       = array();
				$args['ID'] = $item_id;

				$result = $wlp->remove( $args );

				if ( ! $result ) {
					throw new WC_REST_Exception( 'ti_woocommerce_wishlist_api_wishlist_product_not_found', __( 'Product not found.', 'ti-woocommerce-wishlist' ), 400 );
				}

				return rest_ensure_response( __( 'Product removed from a wishlist.', 'ti-woocommerce-wishlist' ) );
			}
		} catch ( WC_REST_Exception $e ) {
			return new WP_Error( $e->getErrorCode(), $e->getMessage(), array( 'status' => $e->getCode() ) );
		}
	}

	/**
	 * Prepare wishlist data.
	 *
	 * @param array $wishlist Default wishlist data.
	 *
	 * @return array
	 */
	public function prepare_wishlist_data( $wishlist ) {
		$response               = array();
		$response['id']         = $wishlist['ID'];
		$response['user_id']    = $wishlist['author'];
		$response['date_added'] = $wishlist['date'];
		$response['title']      = $wishlist['title'];
		$response['share_key']  = $wishlist['share_key'];

		return $response;
	}

	/**
	 * Prepare wishlist item data.
	 *
	 * @param array $product Default wishlist item data.
	 *
	 * @return array
	 */
	public function prepare_product_data( $product ) {
		$response                 = array();
		$response['item_id']      = $product['ID'];
		$response['product_id']   = $product['product_id'];
		$response['variation_id'] = $product['variation_id'];
		$response['meta']         = $product['meta'];
		$response['date_added']   = $product['date'];
		$response['price']        = $product['price'];
		$response['in_stock']     = $product['in_stock'];

		return $response;
	}
}
