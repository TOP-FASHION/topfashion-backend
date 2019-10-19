<?php
/**
 * Wishlist counter
 *
 * @since             1.4.0
 * @package           TInvWishlist\Public
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Drop down widget
 */
class TInvWL_Public_WishlistCounter {

	/**
	 * Plugin name
	 *
	 * @var string
	 */
	static $_name;
	/**
	 * This class
	 *
	 * @var \TInvWL_Public_WishlistCounter
	 */
	protected static $_instance = null;

	/**
	 * Get this class object
	 *
	 * @param string $plugin_name Plugin name.
	 *
	 * @return \TInvWL_Public_WishlistCounter
	 */
	public static function instance( $plugin_name = TINVWL_PREFIX ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $plugin_name );
		}

		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * @param string $plugin_name Plugin name.
	 */
	function __construct( $plugin_name ) {
		self::$_name = $plugin_name;
		$this->define_hooks();
	}

	/**
	 * Define hooks
	 */
	function define_hooks() {
		add_filter( 'tinvwl_addtowishlist_return_ajax', array( __CLASS__, 'update_widget' ) );
		add_filter( 'woocommerce_add_to_cart_fragments', array( __CLASS__, 'update_fragments' ) );
		if ( tinv_get_option( 'topline', 'menu' ) ) {
			add_filter( 'wp_get_nav_menu_items', array( __CLASS__, 'add_to_menu' ), 9, 3 );
		}
	}

	/**
	 * Add to menu wishlist link
	 *
	 * @param array $items An array of menu item post objects.
	 * @param object $menu The menu object.
	 * @param array $args An array of arguments used to retrieve menu item objects.
	 *
	 * @return array
	 */
	public static function add_to_menu( $items, $menu, $args ) {
		$menu_cnt = count( $items ) + 1;
		$menu_id  = tinv_get_option( 'topline', 'menu' );

		if ( $menu_id == $menu->term_id ) {

			$menu_order = tinv_get_option( 'topline', 'menu_order' ) ? tinv_get_option( 'topline', 'menu_order' ) : 100;

			// Item title.

			$show_icon   = (bool) tinv_get_option( 'topline', 'icon' );
			$icon_type   = tinv_get_option( 'topline', 'icon' );
			$icon_class  = ( $show_icon && tinv_get_option( 'topline', 'icon' ) ) ? 'top_wishlist-' . tinv_get_option( 'topline', 'icon' ) : '';
			$icon_style  = ( $show_icon && tinv_get_option( 'topline', 'icon' ) ) ? esc_attr( 'top_wishlist-' . tinv_get_option( 'topline', 'icon_style' ) ) : '';
			$icon_upload = tinv_get_option( 'topline', 'icon_upload' );

			$counter = tinv_get_option( 'topline', 'show_counter' ) ? '<span class="wishlist_products_counter_number"></span>' : '';

			$text = tinv_get_option( 'topline', 'show_text' ) ? apply_filters( 'tinvwl_wishlist_products_counter_text', tinv_get_option( 'topline', 'text' ) ) : '';

			$icon = '<span class="wishlist_products_counter ' . $icon_class . ' ' . $icon_style . ( empty( $text ) ? ' no-txt' : '' ) . ( 0 < $counter ? ' wishlist-counter-with-products' : '' ) . '" >';

			if ( $icon_class && 'custom' === $icon_type && ! empty( $icon_upload ) ) {
				$icon .= sprintf( '<img src="%s" />', esc_url( $icon_upload ) );
			}

			$icon .= '</span>';

			$menu_title = apply_filters( 'tinvwl_wishlist_products_counter_menu_html', $icon . ' ' . $text . ' ' . $counter, $icon, $text, $counter );

			if ( $menu_title ) {

				$wishlist_item = (object) array(
					'ID'                    => $menu_cnt + 2147480000,
					'object_id'             => $menu_cnt + 2147480000,
					'db_id'                 => $menu_cnt + 2147480000,
					'title'                 => $menu_title,
					'post_title'            => $menu_title,
					'url'                   => esc_url( tinv_url_wishlist_default() ),
					'guid'                  => esc_url( tinv_url_wishlist_default() ),
					'post_date'             => gmdate( 'Y-m-d H:i:s' ),
					'post_date_gmt'         => gmdate( 'Y-m-d H:i:s' ),
					'post_modified'         => gmdate( 'Y-m-d H:i:s' ),
					'post_modified_gmt'     => gmdate( 'Y-m-d H:i:s' ),
					'menu_order'            => $menu_order,
					'menu_item_parent'      => 0,
					'type'                  => 'custom',
					'post_status'           => 'publish',
					'post_author'           => 1,
					'comment_status'        => 'closed',
					'ping_status'           => 'closed',
					'post_name'             => 'd',
					'post_parent'           => 0,
					'post_type'             => 'nav_menu_item',
					'comment_count'         => 0,
					'filter'                => 'raw',
					'object'                => 'custom',
					'type_label'            => '',
					'target'                => '',
					'attr_title'            => '',
					'object'                => '',
					'classes'               => '',
					'post_content'          => '',
					'post_excerpt'          => '',
					'category_post'         => '',
					'nolink'                => '',
					'description'           => '',
					'xfn'                   => '',
					'template'              => '',
					'mega_template'         => '',
					'megamenu'              => '',
					'megamenu_auto_width'   => '',
					'megamenu_col'          => '',
					'megamenu_heading'      => '',
					'megamenu_widgetarea'   => '',
					'icon'                  => '',
					'post_password'         => '',
					'to_ping'               => '',
					'pinged'                => '',
					'post_content_filtered' => '',
					'post_mime_type'        => '',
				);

				foreach ( array_keys( $items ) as $key ) {

					if ( $items[ $key ]->menu_order > ( $menu_order - 1 ) ) {
						$items[ $key ]->menu_order = $items[ $key ]->menu_order + 1;
					}
				}

				if ( $menu_order < $menu_cnt ) {
					array_splice( $items, $menu_order - 1, 0, array( $wishlist_item ) );
				} else {
					$items[] = $wishlist_item;
				}
			}
		}

		return $items;
	}

	/**
	 * Output shortcode
	 *
	 * @param array $atts Shortcode attributes.
	 */
	function htmloutput( $atts ) {
		$data = array(
			'icon'         => tinv_get_option( 'topline', 'icon' ),
			'icon_class'   => ( $atts['show_icon'] && tinv_get_option( 'topline', 'icon' ) ) ? 'top_wishlist-' . tinv_get_option( 'topline', 'icon' ) : '',
			'icon_style'   => ( $atts['show_icon'] && tinv_get_option( 'topline', 'icon' ) ) ? esc_attr( 'top_wishlist-' . tinv_get_option( 'topline', 'icon_style' ) ) : '',
			'icon_upload'  => tinv_get_option( 'topline', 'icon_upload' ),
			'text'         => $atts['show_text'] ? $atts['text'] : '',
			'counter'      => $atts['show_counter'],
			'show_counter' => $atts['show_counter'],
		);
		tinv_wishlist_template( 'ti-wishlist-product-counter.php', $data );
	}

	/**
	 * AJAX update elements.
	 *
	 * @param array $data AJAX data.
	 *
	 * @return array
	 */
	public static function update_widget( $data ) {
		if ( apply_filters( 'tinvwl_wc_cart_fragments_enabled', true ) ) {
			$data['fragments'] = self::update_fragments( array() );
		}

		return $data;
	}

	/**
	 * Load fragments for wishlist product counter
	 *
	 * @param array $data Woocommerce Fragments for updateing data.
	 */
	public static function update_fragments( $data = array() ) {
		$data['span.wishlist_products_counter_number']            = sprintf( '<span class="wishlist_products_counter_number">%s</span>', apply_filters( 'tinvwl_wishlist_products_counter', self::counter() ) );
		$data['span.sidr-class-wishlist_products_counter_number'] = sprintf( '<span class="sidr-class-wishlist_products_counter_number">%s</span>', apply_filters( 'tinvwl_wishlist_products_counter', self::counter() ) );

		return $data;
	}

	/**
	 * Get count product in all wishlist
	 *
	 * @return integer
	 */
	public static function counter() {
		global $wpdb;
		$count = 0;
		$wl    = new TInvWL_Wishlist();
		if ( is_user_logged_in() ) {
			$wishlist = $wl->add_user_default();
			$wlp      = new TInvWL_Product();
			$counts   = $wlp->get( array(
				'external'    => false,
				'wishlist_id' => $wishlist['ID'],
				'sql'         => 'SELECT COUNT(`quantity`) AS `quantity` FROM {table} t1 INNER JOIN ' . $wpdb->prefix . 'posts t2 on t1.product_id = t2.ID AND t2.post_status = "publish" WHERE {where} ',
			) );
			$counts   = array_shift( $counts );
			$count    = absint( $counts['quantity'] );
		} else {
			$wishlist = $wl->get_by_sharekey_default();
			if ( ! empty( $wishlist ) ) {
				$wishlist = array_shift( $wishlist );
				$wlp      = new TInvWL_Product( $wishlist );
				$counts   = $wlp->get_wishlist( array(
					'external' => false,
					'sql'      => sprintf( 'SELECT %s(`quantity`) AS `quantity` FROM {table}  t1 INNER JOIN ' . $wpdb->prefix . 'posts t2 on t1.product_id = t2.ID AND t2.post_status = "publish" WHERE {where}', 'COUNT' ),
				) );
				$counts   = array_shift( $counts );
				$count    = absint( $counts['quantity'] );
			}
		}

		return $count ? $count : ( tinv_get_option( 'topline', 'hide_zero_counter' ) ? false : 0 );
	}

	/**
	 * Shortcode basic function
	 *
	 * @param array $atts Array parameter from shortcode.
	 *
	 * @return string
	 */
	function shortcode( $atts = array() ) {
		$default = array(
			'show_icon'    => (bool) tinv_get_option( 'topline', 'icon' ),
			'show_text'    => tinv_get_option( 'topline', 'show_text' ),
			'text'         => apply_filters( 'tinvwl_wishlist_products_counter_text', tinv_get_option( 'topline', 'text' ) ),
			'show_counter' => tinv_get_option( 'topline', 'show_counter' ),
		);
		$atts    = filter_var_array( shortcode_atts( $default, $atts ), array(
			'show_icon'    => FILTER_VALIDATE_BOOLEAN,
			'show_text'    => FILTER_VALIDATE_BOOLEAN,
			'show_counter' => FILTER_VALIDATE_BOOLEAN,
			'text'         => FILTER_DEFAULT,
		) );
		ob_start();
		$this->htmloutput( $atts );

		return ob_get_clean();
	}
}
