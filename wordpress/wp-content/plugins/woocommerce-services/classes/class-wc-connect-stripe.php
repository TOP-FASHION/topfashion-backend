<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_Connect_Stripe' ) ) {

	class WC_Connect_Stripe {

		/**
		 * @var WC_Connect_API_Client
		 */
		private $api;

		/**
		 * @var WC_Connect_Options
		 */
		private $options;

		/**
		 * @var WC_Connect_Logger
		 */
		private $logger;

		/**
		 * @var WC_Connect_Nux
		 */
		private $nux;

		const STATE_VAR_NAME = 'stripe_state';
		const SETTINGS_OPTION = 'woocommerce_stripe_settings';
		const CONNECTED_KEYS_OPTION = 'stripe_keys';

		public function __construct( WC_Connect_API_Client $client, WC_Connect_Options $options, WC_Connect_Logger $logger, WC_Connect_Nux $nux ) {
			$this->api = $client;
			$this->options = $options;
			$this->logger = $logger;
			$this->nux = $nux;
		}

		public function is_stripe_plugin_enabled() {
			return class_exists( 'WC_Stripe' );
		}

		public function get_oauth_url( $return_url = '' ) {
			if ( empty( $return_url ) ) {
				$return_url = admin_url( 'admin.php?page=wc-settings&tab=checkout&section=stripe' );
			}

			if ( substr( $return_url, 0, 8 ) !== 'https://' ) {
				return new WP_Error( 'invalid_url_protocol', __( 'Your site must be served over HTTPS in order to connect your Stripe account via WooCommerce Services', 'woocommerce-services' ) );
			}

			$result = $this->api->get_stripe_oauth_init( $return_url );

			if ( is_wp_error( $result ) ) {
				return $result;
			}

			$this->options->update_option( self::STATE_VAR_NAME, $result->state );

			return $result->oauthUrl;
		}

		public function create_account( $email, $country ) {
			$response = $this->api->create_stripe_account( $email, $country );
			if ( is_wp_error( $response ) ) {
				return $response;
			}
			return $this->save_stripe_keys( $response );
		}

		public function get_account_details() {
			if ( ! $this->is_connected() ) {
				return new WP_Error(
					'not_using_wcs_for_stripe_connection',
					__( 'Not using WooCommerce Services for Stripe keys. Maybe using user supplied keys.', 'woocommerce-services' ),
					array(
						'status' => 400
					)
				);
			}

			$response = $this->api->get_stripe_account_details();
			if ( is_wp_error( $response ) ) {
				return $response;
			}

			return array(
				'account_id'      => $response->accountId,
				'display_name'    => $response->displayName,
				'email'           => $response->email,
				'business_logo'   => $response->businessLogo,
				'legal_entity'    => array(
					'first_name'      => $response->legalEntity->firstName,
					'last_name'       => $response->legalEntity->lastName
				),
				'payouts_enabled' => $response->payoutsEnabled,
			);
		}

		public function deauthorize_account() {
			$response = $this->api->deauthorize_stripe_account();
			if ( is_wp_error( $response ) ) {
				return $response;
			}

			$this->clear_stripe_keys();
			return $response;
		}

		public function connect_oauth( $state, $code ) {
			if ( $state !== $this->options->get_option( self::STATE_VAR_NAME, false ) ) {
				return new WP_Error( 'Invalid stripe state' );
			}

			$response = $this->api->get_stripe_oauth_keys( $code );

			if ( is_wp_error( $response ) ) {
				return $response;
			}

			return $this->save_stripe_keys( $response );
		}

		/**
		 * Checks if the Stripe keys currently being used are the same as the keys from the connected stripe account
		 *
		 * @return bool true if the keys match
		 */
		public function is_connected() {
			$options = get_option( self::SETTINGS_OPTION, array() );
			if ( empty( $options ) ) {
				return false;
			}
			$is_test = isset( $options['testmode'] ) && 'yes' === $options['testmode'];
			$prefix = $is_test ? 'test_' : '';
			$publishable_key_name = $prefix . 'publishable_key';
			$secret_key_name = $prefix . 'secret_key';

			$connected_keys = WC_Connect_Options::get_option( self::CONNECTED_KEYS_OPTION, array() );
			if ( empty( $connected_keys ) || ! isset( $connected_keys[ $publishable_key_name ] ) || ! isset( $connected_keys[ $secret_key_name ] ) ) {
				return false;
			}

			return wp_hash( $options[ $publishable_key_name ] ) === $connected_keys[ $publishable_key_name ]
				&& wp_hash( $options[ $secret_key_name ] ) === $connected_keys[ $secret_key_name ];
		}

		/**
		 * Stores the connected account's API keys in order to determine the account connection status in the future
		 *
		 * @param string $publishable_key Publishable key
		 * @param string $secret_key Secret key
		 * @param bool $is_test True if the keys are for test environment, false otherwise
		 */
		private function set_connected_keys( $publishable_key, $secret_key, $is_test ) {
			if ( empty( $publishable_key ) || empty( $secret_key ) ) {
				return;
			}

			$prefix = $is_test ? 'test_' : '';
			$publishable_key_name = $prefix . 'publishable_key';
			$secret_key_name = $prefix . 'secret_key';

			$connected_keys = WC_Connect_Options::get_option( self::CONNECTED_KEYS_OPTION, array() );
			$connected_keys[ $publishable_key_name ] = wp_hash( $publishable_key );
			$connected_keys[ $secret_key_name ]      = wp_hash( $secret_key );
			WC_Connect_Options::update_option( self::CONNECTED_KEYS_OPTION, $connected_keys );
		}

		/**
		 * Migrates the connection status if the site is already connected
		 */
		private function maybe_migrate_connection_status() {
			if ( $this->is_connected() ) {
				return;
			}
			$migrated = WC_Connect_Options::get_option( 'stripe_status_migrated', false );
			if ( $migrated ) {
				return;
			}

			$account_info = $this->api->get_stripe_account_details();
			if ( is_wp_error( $account_info ) ) {
				//no account connected, mark the status as migrated and return
				WC_Connect_Options::update_option( 'stripe_status_migrated', true );
				return;
			}

			$options = get_option( self::SETTINGS_OPTION, array() );
			if ( empty( $options ) ) {
				//no stripe settings found, mark the status as migrated and return
				WC_Connect_Options::update_option( 'stripe_status_migrated', true );
				return;
			}

			//assume the currently set keys are the keys from the connected account
			$this->set_connected_keys( $options['test_publishable_key'], $options['test_secret_key'], true );
			$this->set_connected_keys( $options['publishable_key'], $options['secret_key'], false );
			WC_Connect_Options::update_option( 'stripe_status_migrated', true );
		}

		private function save_stripe_keys( $result ) {
			if ( ! isset( $result->publishableKey, $result->secretKey ) ) {
				return new WP_Error( 'Invalid credentials received from server' );
			}

			$is_test = false !== strpos( $result->publishableKey, '_test_' );
			$prefix = $is_test ? 'test_' : '';

			$default_options = $this->get_default_stripe_config();

			$options = array_merge( $default_options, get_option( self::SETTINGS_OPTION, array() ) );
			$options['enabled']                     = 'yes';
			$options['testmode']                    = $is_test ? 'yes' : 'no';
			$options[ $prefix . 'publishable_key' ] = $result->publishableKey;
			$options[ $prefix . 'secret_key' ]      = $result->secretKey;

			$this->set_connected_keys( $result->publishableKey, $result->secretKey, $is_test );

			// While we are at it, let's also clear the account_id and
			// test_account_id if present

			// Those used to be stored by save_stripe_keys but should not have
			// been since they were not used by anyone

			unset( $options[ 'account_id' ] );
			unset( $options[ 'test_account_id' ] );

			update_option( self::SETTINGS_OPTION, $options );
			return $result;
		}

		/**
		 * Clears keys for test or production (whichever is presently enabled).
		 * Especially useful after Stripe Connect account deauthorization.
		 */
		private function clear_stripe_keys() {
			$default_options = $this->get_default_stripe_config();
			$options = array_merge( $default_options, get_option( self::SETTINGS_OPTION, array() ) );

			if ( 'yes' === $options['testmode'] ) {
				$options[ 'test_publishable_key' ] = '';
				$options[ 'test_secret_key' ] = '';
			} else {
				$options[ 'publishable_key' ] = '';
				$options[ 'secret_key' ] = '';
			}

			// While we are at it, let's also clear the account_id and
			// test_account_id if present

			// Those used to be stored by save_stripe_keys but should not have
			// been since they were not used by anyone

			unset( $options[ 'account_id' ] );
			unset( $options[ 'test_account_id' ] );

			update_option( self::SETTINGS_OPTION, $options );

			WC_Connect_Options::delete_option( self::CONNECTED_KEYS_OPTION );
		}

		private function get_default_stripe_config() {
			if ( ! class_exists( 'WC_Gateway_Stripe' ) ) {
				return array();
			}

			$result = array();
			$gateway = new WC_Gateway_Stripe();
			foreach ( $gateway->form_fields as $key => $value ) {
				if ( isset( $value['default'] ) ) {
					$result[ $key ] = $value['default'];
				}
			}

			return $result;
		}

		/**
		 * Handle connection and just-in-time messaging around OAuth flow.
		 */
		public function maybe_show_notice() {
			// Handle redirect back from OAuth flow.
			if ( isset( $_GET[ 'wcs_stripe_code' ] ) && isset( $_GET[ 'wcs_stripe_state' ] ) ) {
				$response = $this->connect_oauth( $_GET[ 'wcs_stripe_state' ], $_GET[ 'wcs_stripe_code' ] );
				if ( ! is_wp_error( $response ) ) {
					WC_Connect_Options::update_option( 'banner_stripe', 'success' );
				}

				wp_safe_redirect( remove_query_arg( array( 'wcs_stripe_state', 'wcs_stripe_code' ) ) );
				exit;
			}

			// Trigger connection-related admin notice if triggered and if on relevant screen.
			$setting = WC_Connect_Options::get_option( 'banner_stripe', null );
			if ( is_null( $setting ) ) {
				return;
			}

			if ( 'success' === $setting ) {
				add_action( 'admin_notices', array( $this, 'connection_success_notice' ) );
				WC_Connect_Options::delete_option( 'banner_stripe' );
				return;
			}

			$screen = get_current_screen();

			if ( // Display if on any of these admin pages.
				'dashboard' === $screen->id // Dashboard.
				|| 'plugins' === $screen->id // Plugins.
				|| ( // WooCommerce » Settings » Payments.
					'woocommerce_page_wc-settings' === $screen->base
					&& isset( $_GET['tab'] ) && 'checkout' === $_GET['tab']
					)
				|| ( // WooCommerce » Extensions » Payments.
					'woocommerce_page_wc-addons' === $screen->base
					&& isset( $_GET['section'] ) && 'payment-gateways' === $_GET['section']
					)
			) {
				wp_enqueue_style( 'wc_connect_banner' );
				add_action( 'admin_notices', array( $this, 'connection_banner' ) );
			}
		}

		/**
		 * Render dismissible connection banner with OAuth link as primary action.
		 */
		public function connection_banner() {
			$result = $this->get_oauth_url();

			if ( is_wp_error( $result ) ) {
				//do not log the invalid url protocol error when attempting to render the banner
				if ( 'invalid_url_protocol' !== $result->get_error_code() ) {
					$this->logger->log( $result, __CLASS__ );
				}
				return;
			}

			$options = get_option( self::SETTINGS_OPTION, array() );
			if ( ! isset( $options['email'] ) ) {
				return;
			}

			$this->nux->show_nux_banner( array(
				'title'          => __( 'Connect your account', 'woocommerce-services' ),
				'description'    => wp_kses(
					sprintf( __( 'It looks like there is an existing Stripe account at <strong>%s</strong>. To start accepting payments with Stripe, you\'ll need to connect it to your store.', 'woocommerce-services' ), $options['email'] ),
					array( 'strong' => array() )
				),
				'button_text'    => __( 'Connect', 'woocommerce-services' ),
				'button_link'    => $result,
				'image_url'      => plugins_url( 'images/stripe.png', dirname( __FILE__ ) ),
				'should_show_jp' => false,
				'dismissible_id' => 'stripe_connect',
				'compact_logo'   => true,
			) );
		}

		/**
		 * Render admin notice acknowledging successful OAuth connection.
		 */
		public function connection_success_notice() {
			?>
				<div class="notice notice-success">
					<p>
						<?php echo wp_kses(
							__( '<strong>Ready to accept Stripe payments!</strong> Your Stripe account has been successfully connected. Additional settings can be configured on this screen.', 'woocommerce-services' ),
							array( 'strong' => array() )
						); ?>
					</p>
				</div>
			<?php
		}

		/**
		 * Add to settings page container for dynamically rendered connected account view.
		 */
		public function show_connected_account( $settings ) {
			ob_start();
			do_action( 'enqueue_wc_connect_script', 'wc-connect-stripe-connect-account' );

			$this->maybe_migrate_connection_status();

			// Display a different title based on the connection status.
			if ( $this->is_connected() ) {
				$title = __( 'Stripe Account (connected to WooCommerce Services)', 'woocommerce-services' );
			} else {
				$title = __( 'Connect via WooCommerce Services', 'woocommerce-services' );
			}

			$new_settings = array(
				'connection_status' => array(
					'type'        => 'title',
					'title'       => $title,
					'description' => ob_get_clean(),
				),
			);
			return array_merge( $new_settings, $settings );
		}
	}
}
