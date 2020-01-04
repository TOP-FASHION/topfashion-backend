<?php
/**
 * Adds filters that modify core schema.
 *
 * @package \WPGraphQL\WooCommerce
 * @since   0.0.1
 */

namespace WPGraphQL\WooCommerce;

use WPGraphQL\WooCommerce\Data\Loader\WC_Customer_Loader;
use WPGraphQL\WooCommerce\Data\Loader\WC_Post_Crud_Loader;
use WPGraphQL\WooCommerce\Data\Factory;

/**
 * Class Core_Schema_Filters
 */
class Core_Schema_Filters {
	/**
	 * Stores instance WC_Customer_Loader
	 *
	 * @var WC_Customer_Loader
	 */
	private static $customer_loader;

	/**
	 * Stores instance WC_Post_Crud_Loader
	 *
	 * @var WC_Post_Crud_Loader
	 */
	private static $post_crud_loader;

	/**
	 * Register filters
	 */
	public static function add_filters() {
		// Registers WooCommerce CPTs.
		add_filter( 'register_post_type_args', array( __CLASS__, 'register_post_types' ), 10, 2 );
		add_filter( 'graphql_post_entities_allowed_post_types', array( __CLASS__, 'skip_type_registry' ), 10 );

		// Registers WooCommerce taxonomies.
		add_filter( 'register_taxonomy_args', array( __CLASS__, 'register_taxonomy_args' ), 10, 2 );

		// Add data-loaders to AppContext.
		add_filter( 'graphql_data_loaders', array( __CLASS__, 'graphql_data_loaders' ), 10, 2 );

		// Adds connection resolutions for WooGraphQL type to WPGraphQL type connections.
		add_filter(
			'graphql_post_object_connection_query_args',
			array(
				'\WPGraphQL\WooCommerce\Data\Connection\Post_Connection_Resolver',
				'get_query_args',
			),
			10,
			5
		);
		add_filter(
			'graphql_term_object_connection_query_args',
			array(
				'\WPGraphQL\WooCommerce\Data\Connection\WC_Terms_Connection_Resolver',
				'get_query_args',
			),
			10,
			5
		);

		// Add node resolvers.
		add_filter(
			'graphql_resolve_node',
			array( '\WPGraphQL\WooCommerce\Data\Factory', 'resolve_node' ),
			10,
			4
		);
		add_filter(
			'graphql_resolve_node_type',
			array( '\WPGraphQL\WooCommerce\Data\Factory', 'resolve_node_type' ),
			10,
			2
		);

		// Filter Unions.
		add_filter(
			'graphql_wp_union_type_config',
			array( __CLASS__, 'inject_union_types' ),
			10,
			2
		);

		add_filter(
			'graphql_union_resolve_type',
			array( __CLASS__, 'inject_union_type_resolver' ),
			10,
			3
		);
	}

	/**
	 * Initializes WC_Loader instance
	 *
	 * @param AppContext $context - AppContext.
	 *
	 * @return WC_Post_Crud_Loader
	 */
	public static function post_crud_loader( $context ) {
		if ( is_null( self::$post_crud_loader ) ) {
			self::$post_crud_loader = new WC_Post_Crud_Loader( $context );
		}
		return self::$post_crud_loader;
	}

	/**
	 * Initializes Customer_Loader instance
	 *
	 * @param AppContext $context - AppContext.
	 *
	 * @return WC_Customer_Loader
	 */
	public static function customer_loader( $context ) {
		if ( is_null( self::$customer_loader ) ) {
			self::$customer_loader = new WC_Customer_Loader( $context );
		}
		return self::$customer_loader;
	}

	/**
	 * Registers WooCommerce post-types to be used in GraphQL schema
	 *
	 * @param array  $args      - allowed post-types.
	 * @param string $post_type - name of taxonomy being checked.
	 *
	 * @return array
	 */
	public static function register_post_types( $args, $post_type ) {
		if ( 'product' === $post_type ) {
			$args['show_in_graphql']            = true;
			$args['graphql_single_name']        = 'Product';
			$args['graphql_plural_name']        = 'Products';
			$args['skip_graphql_type_registry'] = true;
		}
		if ( 'product_variation' === $post_type ) {
			$args['show_in_graphql']            = true;
			$args['graphql_single_name']        = 'ProductVariation';
			$args['graphql_plural_name']        = 'ProductVariations';
			$args['skip_graphql_type_registry'] = true;
		}
		if ( 'shop_coupon' === $post_type ) {
			$args['show_in_graphql']            = true;
			$args['graphql_single_name']        = 'Coupon';
			$args['graphql_plural_name']        = 'Coupons';
			$args['skip_graphql_type_registry'] = true;
		}
		if ( 'shop_order' === $post_type ) {
			$args['show_in_graphql']            = true;
			$args['graphql_single_name']        = 'Order';
			$args['graphql_plural_name']        = 'Orders';
			$args['skip_graphql_type_registry'] = true;
		}
		if ( 'shop_order_refund' === $post_type ) {
			$args['show_in_graphql']            = true;
			$args['graphql_single_name']        = 'Refund';
			$args['graphql_plural_name']        = 'Refunds';
			$args['skip_graphql_type_registry'] = true;
		}

		return $args;
	}

	/**
	 * Filters "allowed_post_types" and removed Woocommerce CPTs.
	 *
	 * @param array $post_types  Post types registered in GraphQL schema.
	 *
	 * @return array
	 */
	public static function skip_type_registry( $post_types ) {
		return array_diff(
			$post_types,
			get_post_types(
				array(
					'show_in_graphql'            => true,
					'skip_graphql_type_registry' => true,
				)
			)
		);
	}

	/**
	 * Registers WooCommerce taxonomies to be used in GraphQL schema
	 *
	 * @param array  $args     - allowed taxonomies.
	 * @param string $taxonomy - name of taxonomy being checked.
	 *
	 * @return array
	 */
	public static function register_taxonomy_args( $args, $taxonomy ) {
		if ( 'product_type' === $taxonomy ) {
			$args['show_in_graphql']     = true;
			$args['graphql_single_name'] = 'productType';
			$args['graphql_plural_name'] = 'productTypes';
		}

		if ( 'product_visibility' === $taxonomy ) {
			$args['show_in_graphql']     = true;
			$args['graphql_single_name'] = 'visibleProduct';
			$args['graphql_plural_name'] = 'visibleProducts';
		}

		if ( 'product_cat' === $taxonomy ) {
			$args['show_in_graphql']     = true;
			$args['graphql_single_name'] = 'productCategory';
			$args['graphql_plural_name'] = 'productCategories';
		}

		if ( 'product_tag' === $taxonomy ) {
			$args['show_in_graphql']     = true;
			$args['graphql_single_name'] = 'productTag';
			$args['graphql_plural_name'] = 'productTags';
		}

		if ( 'product_shipping_class' === $taxonomy ) {
			$args['show_in_graphql']     = true;
			$args['graphql_single_name'] = 'shippingClass';
			$args['graphql_plural_name'] = 'shippingClasses';
		}

		// Filter product attributes taxonomies.
		$attributes = \WP_GraphQL_WooCommerce::get_product_attribute_taxonomies();
		if ( in_array( $taxonomy, $attributes, true ) ) {
			$singular_name               = graphql_format_field_name( $taxonomy );
			$args['show_in_graphql']     = true;
			$args['graphql_single_name'] = $singular_name;
			$args['graphql_plural_name'] = \Inflect::pluralize( $singular_name );
		}

		return $args;
	}

	/**
	 * Registers data-loaders to be used when resolving WooCommerce-related GraphQL types
	 *
	 * @param array      $loaders - assigned loaders.
	 * @param AppContext $context - AppContext instance.
	 *
	 * @return array
	 */
	public static function graphql_data_loaders( $loaders, $context ) {
		// WooCommerce customer loader.
		$customer_loader        = self::customer_loader( $context );
		$loaders['wc_customer'] = &$customer_loader;

		// WooCommerce crud object loader.
		$post_crud_loader        = self::post_crud_loader( $context );
		$loaders['wc_post_crud'] = &$post_crud_loader;

		return $loaders;
	}

	/**
	 * Inject Union types that resolve to Product with Product types
	 *
	 * @param array                       $config    WPUnion config.
	 * @param \WPGraphQL\Type\WPUnionType $wp_union  WPUnion object.
	 */
	public static function inject_union_types( $config, $wp_union ) {
		$refresh_callback = false;
		if ( in_array( 'Product', $config['typeNames'], true ) ) {
			// Strip 'Product' from config and child product types.
			$config['typeNames'] = array_merge(
				array_filter(
					$config['typeNames'],
					function( $type ) {
						return 'Product' !== $type;
					}
				),
				array_values( \WP_GraphQL_WooCommerce::get_enabled_product_types() )
			);
			$refresh_callback    = true;
		}

		// Update 'types' callback.
		if ( $refresh_callback ) {
			$config['types'] = function () use ( $config, $wp_union ) {
				$prepared_types = array();
				if ( ! empty( $config['typeNames'] ) && is_array( $config['typeNames'] ) ) {
					$prepared_types = array();
					foreach ( $config['typeNames'] as $type_name ) {
						$prepared_types[] = $wp_union->type_registry->get_type( $type_name );
					}
				}
				return $prepared_types;
			};
		}

		return $config;
	}

	/**
	 * Inject Union type resolver that resolve to Product with Product types
	 *
	 * @param \WPGraphQL\Type\WPObjectType $type      Type be resolve to.
	 * @param mixed                        $value     Object for which the type is being resolve config.
	 * @param \WPGraphQL\Type\WPUnionType  $wp_union  WPUnion object.
	 */
	public static function inject_union_type_resolver( $type, $value, $wp_union ) {
		switch ( get_class( $value ) ) {
			case 'WPGraphQL\WooCommerce\Model\Product':
			case 'WPGraphQL\WooCommerce\Model\Coupon':
			case 'WPGraphQL\WooCommerce\Model\Order':
				$new_type = Factory::resolve_node_type( $type, $value );
				if ( $new_type ) {
					$type = $wp_union->type_registry->get_type( $new_type );
				}
				break;
		}

		return $type;
	}
}
