<?php
/**
 * Class Admin
 *
 * @package  WPAPIPlugin
 * @author   Shazahan Kabir <sksaaju@gmail.com>
 * @license  GPLv2 or later
 * @link     https://github.com/sksaju/wp-api-plugin
 * @since    1.0.0
 */

namespace WPAPIPlugin\Admin;

use WPAPIPlugin\Plugin;

 /**
 * Class Admin
 *
 * @package WPAPIPlugin\Admin
 *
 * @since   1.0.0
 */
class Admin {

	/**
	 * Admin constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
	}

	/**
	 * Enqueue script for admin panel.
	 *
	 * @since 1.0.0
	 *
	 * @param string $hook_suffix The current admin page.
	 */
	public function enqueue_scripts( string $hook_suffix ): void {
		if ( false === strpos( $hook_suffix, Plugin::SLUG ) ) {
			return;
		}

		$nonce_key = Plugin::NONCE_KEY;

		wp_enqueue_script(
			'wp-api-plugin-admin-script',
			WPAPI_PLUGIN_URL . 'assets/dist/admin/main.min.js',
			[ 'wp-i18n' ],
			Plugin::VERSION,
			true
		);

		// Localize the script with data.
		wp_localize_script(
			'wp-api-plugin-admin-script',
			'wpapiplugin',
			[
				'ajax_url'  => admin_url( 'admin-ajax.php' ),
				'nonce_key' => $nonce_key,
				$nonce_key  => wp_create_nonce( Plugin::NONCE_ACTION ),
			]
		);
	}

	/**
	 * Add plugin page in WordPress menu.
	 *
	 * @since 1.0.0
	 */
	public function add_admin_menu(): void {
		add_menu_page(
			esc_html__( 'API Data', 'wp-api-plugin' ),
			esc_html__( 'WP API Plugin', 'wp-api-plugin' ),
			'manage_options',
			Plugin::SLUG,
			[
				$this,
				'page_options',
			]
		);
	}

	/**
	 * Plugin page callback.
	 *
	 * @since 1.0.0
	 */
	public function page_options(): void {
		require_once WPAPI_PLUGIN_PATH . 'templates/admin/api-data-list.php';
	}
}
