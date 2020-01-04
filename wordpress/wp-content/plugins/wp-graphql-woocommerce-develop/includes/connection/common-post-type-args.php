<?php
/**
 * Define common arguments for post-type connections.
 *
 * @package WPGraphQL\WooCommerce\Connection
 * @since 0.2.2
 */

namespace WPGraphQL\WooCommerce\Connection;

/**
 * Returns argument definitions for argument common on all post-type connections.
 *
 * @return array
 */
function get_common_post_type_args() {
	return array(
		'search'      => array(
			'type'        => 'String',
			'description' => __( 'Limit results to those matching a string.', 'wp-graphql-woocommerce' ),
		),
		'exclude'     => array(
			'type'        => array( 'list_of' => 'Int' ),
			'description' => __( 'Ensure result set excludes specific IDs.', 'wp-graphql-woocommerce' ),
		),
		'include'     => array(
			'type'        => array( 'list_of' => 'Int' ),
			'description' => __( 'Limit result set to specific ids.', 'wp-graphql-woocommerce' ),
		),
		'orderby'     => array(
			'type'        => array( 'list_of' => 'PostTypeOrderbyInput' ),
			'description' => __( 'What paramater to use to order the objects by.', 'wp-graphql-woocommerce' ),
		),
		'dateQuery'   => array(
			'type'        => 'DateQueryInput',
			'description' => __( 'Filter the connection based on dates', 'wp-graphql-woocommerce' ),
		),
		'parent'      => array(
			'type'        => 'Int',
			'description' => __( 'Use ID to return only children. Use 0 to return only top-level items', 'wp-graphql-woocommerce' ),
		),
		'parentIn'    => array(
			'type'        => array( 'list_of' => 'Int' ),
			'description' => __( 'Specify objects whose parent is in an array', 'wp-graphql-woocommerce' ),
		),
		'parentNotIn' => array(
			'type'        => array( 'list_of' => 'Int' ),
			'description' => __( 'Specify objects whose parent is not in an array', 'wp-graphql-woocommerce' ),
		),
	);
}

