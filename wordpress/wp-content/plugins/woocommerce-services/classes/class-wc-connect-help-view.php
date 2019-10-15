<?php

if ( ! class_exists( 'WC_Connect_Help_View' ) ) {

	class WC_Connect_Help_View {

		/**
		 * @var WC_Connect_Service_Schemas_Store
		 */
		protected $service_schemas_store;

		/**
		 * @var WC_Connect_Service_Settings_Store
		 */
		protected $service_settings_store;

		/**
		 * @var WC_Connect_Logger
		 */
		protected $logger;

		/**
		 * @array
		 */
		protected $fieldsets;

		public function __construct( WC_Connect_Service_Schemas_Store $service_schemas_store,
			WC_Connect_Service_Settings_Store $service_settings_store,
			WC_Connect_Logger $logger ) {

			$this->service_schemas_store = $service_schemas_store;
			$this->service_settings_store = $service_settings_store;
			$this->logger = $logger;

			add_filter( 'woocommerce_admin_status_tabs', array( $this, 'status_tabs' ) );
			add_action( 'woocommerce_admin_status_content_connect', array( $this, 'page' ) );
		}

		protected function get_health_items() {
			$health_items = array();

			// WooCommerce
			// Only one of the following should present
			// Check that WooCommerce is at least 2.6 or higher (feature-plugin only)
			// Check that WooCommerce base_country is set
			$base_country = WC()->countries->get_base_country();
			if ( version_compare( WC()->version, WOOCOMMERCE_CONNECT_MINIMUM_WOOCOMMERCE_VERSION, "<" ) ) {
				$health_item = array(
					'state' => 'error',
					'message' => sprintf(
						__( 'WooCommerce %s or higher is required (You are running %s)', 'woocommerce-services' ),
						WOOCOMMERCE_CONNECT_MINIMUM_WOOCOMMERCE_VERSION,
						WC()->version
					),
				);
			} else if ( empty( $base_country ) ) {
				$health_item = array(
					'state' => 'error',
					'message' => __( 'Please set Base Location in WooCommerce Settings > General', 'woocommerce-services' ),
				);
			} else {
				$health_item = array(
					'state' => 'success',
					'message' => sprintf(
						__( 'WooCommerce %s is configured correctly', 'woocommerce-services' ),
						WC()->version
					),
				);
			}
			$health_items['woocommerce'] = $health_item;

			// Jetpack
			// Only one of the following should present
			// Check that Jetpack is active
			// Check that Jetpack is connected
			include_once ( ABSPATH . 'wp-admin/includes/plugin.php' ); // required for is_plugin_active
			$is_connected = WC_Connect_Jetpack::is_active() || WC_Connect_Jetpack::is_development_mode();
			if ( ! is_plugin_active( 'jetpack/jetpack.php' ) ) {
				$health_item = array(
					'state' => 'error',
					'message' => sprintf(
						__( 'Please install and activate the Jetpack plugin, version %s or higher', 'woocommerce-services' ),
						WOOCOMMERCE_CONNECT_MINIMUM_JETPACK_VERSION
					),
				);
			} else if ( version_compare( JETPACK__VERSION, WOOCOMMERCE_CONNECT_MINIMUM_JETPACK_VERSION, "<" ) ) {
				$health_item = array(
					'state' => 'error',
					'message' => sprintf(
						__( 'Jetpack %s or higher is required (You are running %s)', 'woocommerce-services' ),
						WOOCOMMERCE_CONNECT_MINIMUM_JETPACK_VERSION,
						JETPACK__VERSION
					),
				);
			} else if ( ! $is_connected ) {
				$health_item = array(
					'state' => 'error',
					'message' => __( 'Jetpack is not connected to WordPress.com. Make sure the Jetpack plugin is installed, activated, and connected.', 'woocommerce-services' ),
				);
			} else if ( WC_Connect_Jetpack::is_staging_site() ) {
				$health_item = array(
					'state' => 'warning',
					'message' => __( 'This is a Jetpack staging site', 'woocommerce-services' ),
				);
			} else {
				$health_item = array(
					'state' => 'success',
					'message' => sprintf(
						__( 'Jetpack %s is connected and working correctly', 'woocommerce-services' ),
						JETPACK__VERSION
					),
				);
			}
			$health_items['jetpack'] = $health_item;

			// Lastly, do the WooCommerce Services health check
			// Check that we have schema
			// Check that we are able to talk to the WooCommerce Services server
			$schemas = $this->service_schemas_store->get_service_schemas();
			$last_fetch_timestamp = $this->service_schemas_store->get_last_fetch_timestamp();
			if ( isset( $_GET['refresh'] ) && 'failed' === $_GET['refresh'] ) {
				$health_item = array(
					'state' => 'error',
					'message' => __( 'An error occurred while refreshing service data.', 'woocommerce-services' ),
					'timestamp' => $last_fetch_timestamp,
				);
			} else if ( is_null( $schemas ) ) {
				$health_item = array(
					'state' => 'error',
					'message' => __( 'No service data available', 'woocommerce-services' ),
				);
			} else if ( is_null( $last_fetch_timestamp ) ) {
				$health_item = array(
					'state' => 'warning',
					'message' => __( 'Service data was found, but may be out of date', 'woocommerce-services' ),
					'timestamp' => $last_fetch_timestamp
				);
			} else if ( $last_fetch_timestamp < time() - WOOCOMMERCE_CONNECT_SCHEMA_AGE_ERROR_THRESHOLD ) {
				$health_item = array(
					'state' => 'error',
					'message' => __( 'Service data was found, but is more than three days old', 'woocommerce-services' ),
					'timestamp' => $last_fetch_timestamp
				);
			} else if ( $last_fetch_timestamp < time() - WOOCOMMERCE_CONNECT_SCHEMA_AGE_WARNING_THRESHOLD ) {
				$health_item = array(
					'state' => 'warning',
					'message' => __( 'Service data was found, but is more than one day old', 'woocommerce-services' ),
					'timestamp' => $last_fetch_timestamp
				);
			} else {
				$health_item = array(
					'state' => 'success',
					'message' => __( 'Service data is up-to-date', 'woocommerce-services' ),
					'timestamp' => $last_fetch_timestamp
				);
			}

			$health_items['woocommerce_services'] = $health_item;

			return $health_items;
		}

		protected function get_services_items() {
			$available_service_method_ids = $this->service_schemas_store->get_all_shipping_method_ids();
			if ( empty( $available_service_method_ids ) ) {
				return false;
			}

			$service_items = array();

			$enabled_services = $this->service_settings_store->get_enabled_services();

			foreach ( (array) $enabled_services as $enabled_service ) {
				$last_failed_request_timestamp = intval( WC_Connect_Options::get_shipping_method_option( 'failure_timestamp', -1, $enabled_service->method_id, $enabled_service->instance_id ) );

				$service_settings_url = esc_url( add_query_arg(
					array(
						'page' => 'wc-settings',
						'tab' => 'shipping',
						'instance_id' => $enabled_service->instance_id
					),
					admin_url( 'admin.php' )
				) );

				// Figure out if the service has any settings saved at all
				$service_settings = $this->service_settings_store->get_service_settings( $enabled_service->method_id, $enabled_service->instance_id );
				if ( empty( $service_settings ) ) {
					$state = 'error';
					$message = __( 'Setup for this service has not yet been completed', 'woocommerce-services' );
				} else if ( -1 === $last_failed_request_timestamp ) {
					$state = 'warning';
					$message = __( 'No rate requests have yet been made for this service', 'woocommerce-services' );
				} else if ( 0 === $last_failed_request_timestamp ) {
					$state = 'success';
					$message = __( 'The most recent rate request was successful', 'woocommerce-services' );
				} else {
					$state = 'error';
					$message = __( 'The most recent rate request failed', 'woocommerce-services' );
				}

				$subtitle = sprintf(
					__( '%s Shipping Zone', 'woocommerce-services' ),
					$enabled_service->zone_name
				);

				$service_items[] = (object) array(
					'title' => $enabled_service->title,
					'subtitle' => $subtitle,
					'state' => $state,
					'message' => $message,
					'timestamp' => $last_failed_request_timestamp,
					'url' => $service_settings_url,
				);
			}

			return $service_items;
		}

		/**
		 * Gets the last 10 lines from the WooCommerce Services log by feature, if it exists
		 */
		protected function get_debug_log_data( $feature = '' ) {
			$data       = new stdClass;
			$data->key  = '';
			$data->file = null;
			$data->tail = array();

			if ( ! method_exists( 'WC_Admin_Status', 'scan_log_files' ) ) {
				return $data;
			}

			$log_prefix = 'wc\-services';

			if ( ! empty( $feature ) ) {
				$log_prefix .= '\-' . $feature;
			}

			$logs             = WC_Admin_Status::scan_log_files();
			$latest_file_date = 0;

			foreach ( $logs as $log_key => $log_file ) {
				if ( ! preg_match( '/' . $log_prefix . '\-(?:\d{4}\-\d{2}\-\d{2}\-)?[0-9a-f]{32}\-log/', $log_key ) ) {
					continue;
				}

				$log_file_path = WC_LOG_DIR . $log_file;
				$file_date     = filemtime( $log_file_path );

				if ( $latest_file_date < $file_date ) {
					$latest_file_date = $file_date;
					$data->file       = $log_file_path;
					$data->key        = $log_key;
				}
			}

			if ( null !== $data->file ) {
				$complete_log = file( $data->file );
				$data->tail   = array_slice( $complete_log, -10 );
			}

			$line_count = count( $data->tail );
			if ( $line_count < 1 ) {
				$log_tail = array( __( 'Log is empty', 'woocommerce-services' ) );
			} else {
				$log_tail = $data->tail;
			}

			return array(
				'tail' => implode( $log_tail ),
				'url'  => $url = add_query_arg(
					array(
						'page'     => 'wc-status',
						'tab'      => 'logs',
						'log_file' => $data->key
					),
					admin_url( 'admin.php' )
				),
				'count' => $line_count,
			);
		}

		/**
		 * Filters the WooCommerce System Status Tabs to add connect
		 *
		 * @param array $tabs
		 * @return array
		 */
		public function status_tabs( $tabs ) {
			if ( ! is_array( $tabs ) ) {
				$tabs = array();
			}
			$tabs[ 'connect' ] = _x( 'WooCommerce Services', 'The WooCommerce Services brandname', 'woocommerce-services' );
			return $tabs;
		}

		/**
		 * Returns the data bootstrap for the help page
		 *
		 * @return array
		 */
		protected function get_form_data() {
			$form_data = array(
				'health_items'    => $this->get_health_items(),
				'services'        => $this->get_services_items(),
				'logging_enabled' => $this->logger->is_logging_enabled(),
				'debug_enabled'   => $this->logger->is_debug_enabled(),
				'logs'            => array(
					'shipping'    => $this->get_debug_log_data( 'shipping' ),
					'taxes'       => $this->get_debug_log_data( 'taxes' ),
					'other'       => $this->get_debug_log_data(),
				)
			);

			return $form_data;
		}

		/**
		 * Localizes the bootstrap, enqueues the script and styles for the help page
		 */
		public function page() {
			if ( isset( $_GET['refresh'] ) && 'true' === $_GET['refresh'] ) {
				$fetched = $this->service_schemas_store->fetch_service_schemas_from_connect_server();
				$url = add_query_arg( 'refresh', $fetched ? false : 'failed' );
				wp_safe_redirect( $url );
			}

			?>
				<h2>
					<?php _e( 'WooCommerce Services Status', 'woocommerce-services' ); ?>
				</h2>
			<?php

			do_action( 'enqueue_wc_connect_script', 'wc-connect-admin-status', array(
				'formData'           => $this->get_form_data(),
			) );

			do_action( 'enqueue_wc_connect_script', 'wc-connect-admin-test-print', array(
				'storeOptions'       => $this->service_settings_store->get_store_options(),
				'paperSize'          => $this->service_settings_store->get_preferred_paper_size(),
			) );
		}

	}

}
