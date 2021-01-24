<?php
/**
 * Class Front
 *
 * @package  WPAPIPlugin
 * @author   Shazahan Kabir <sksaaju@gmail.com>
 * @license  GPLv2 or later
 * @link     https://github.com/sksaju/wp-api-plugin
 * @since    1.0.0
 */

namespace WPAPIPlugin\Front;

use WPAPIPlugin\Plugin;

/**
 * Class Front
 *
 * @package WPAPIPlugin\Front
 *
 * @since   1.0.0
 */
class Front {

	/**
	 * Front constructor.
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register_styles' ] );
		add_action( 'init', [ $this, 'register_scripts' ] );
		add_shortcode( 'wpapi_data_table', [ $this, 'api_data_table' ] );
	}

	/**
	 * Register styles for shortcode.
	 *
	 * @since 1.0.0
	 */
	public function register_styles(): void {
		wp_register_style(
			'wp-api-plugin-shortcode-styles',
			WPAPI_PLUGIN_URL . 'assets/dist/front/main.min.css',
			[],
			Plugin::VERSION
		);
	}

	/**
	 * Register script for shortcode.
	 *
	 * @since 1.0.0
	 */
	public function register_scripts(): void {
		wp_register_script(
			'wp-api-plugin-shortcode-script',
			WPAPI_PLUGIN_URL . 'assets/dist/front/main.min.js',
			[ 'wp-i18n' ],
			Plugin::VERSION,
			true
		);

		// Localize the script with data.
		wp_localize_script(
			'wp-api-plugin-shortcode-script',
			'wpapiplugin',
			[
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			]
		);
	}

	/**
	 * Api data table shortcode callback.
	 *
	 * @since 1.0.0
	 */
	public function api_data_table(): void {
		ob_start();
		include_once WPAPI_PLUGIN_PATH . 'templates/front/data-table-shortcode.php';
		echo ob_get_clean();

		// Enqueue style and script.
		wp_enqueue_style( 'wp-api-plugin-shortcode-styles' );
		wp_enqueue_script( 'wp-api-plugin-shortcode-script' );
	}
}
