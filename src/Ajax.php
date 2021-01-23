<?php
/**
 * Class Ajax
 *
 * @package  WPAPIPlugin
 * @author   Shazahan Kabir <sksaaju@gmail.com>
 * @license  GPLv2 or later
 * @link     https://github.com/sksaju/wp-api-plugin
 * @since    v1.0.0
 */

namespace WPAPIPlugin;

class Ajax {

	/**
	 * Plugin constructor.
	 */
	public function __construct() {
		add_action( 'wp_ajax_wpapi_plugin_get_data', [ $this, 'get_api_data' ] );
		add_action( 'wp_ajax_nopriv_wpapi_plugin_get_data', [ $this, 'get_api_data' ] );

		add_action( 'wp_ajax_wpapi_plugin_refresh_data', [ $this, 'refresh_api_data' ] );
		add_action( 'wp_ajax_nopriv_wpapi_plugin_refresh_data', [ $this, 'refresh_api_data' ] );
	}

	/**
	 * Get the api data
	 *
	 * @since 1.0.0
	 */
	public function get_api_data(): void {
		$api_data = Helpers::get_api_data();

		if ( $api_data ) {
			wp_send_json_success( $api_data );
		} else {
			wp_send_json_error();
		}
	}

	/**
	 * Refresh the api data
	 *
	 * @since 1.0.0
	 */
	public function refresh_api_data(): void {
		$api_data = Helpers::set_api_data();

		if ( $api_data ) {
			wp_send_json_success( $api_data );
		} else {
			wp_send_json_error();
		}
	}
}
