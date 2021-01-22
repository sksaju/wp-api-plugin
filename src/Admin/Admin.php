<?php
/**
 * Class Admin
 *
 * @package  WPAPIPlugin
 * @author   Shazahan Kabir <sksaaju@gmail.com>
 * @license  GPLv2 or later
 * @link     https://github.com/sksaju/wp-api-plugin
 * @since    v1.0.0
 */

namespace WPAPIPlugin\Admin;

use WPAPIPlugin\Plugin;

class Admin {

	/**
	 * Admin constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
	}

	/**
	 * Register styles for the admin panel.
	 *
	 * @since 1.0.0
	 *
	 * @param string $hook_suffix The current admin page.
	 */
	public function enqueue_styles( string $hook_suffix ): void {
		if ( false === strpos( $hook_suffix, Plugin::SLUG ) ) {
			return;
		}

		wp_enqueue_style(
			'wp-api-plugin-main-styles',
			WPAPI_PLUGIN_URL . 'assets/build/css/styles.min.css',
			[],
			Plugin::VERSION,
			'all'
		);
	}

	/**
	 * Register JavaScript's for the admin panel.
	 *
	 * @since 1.0.0
	 *
	 * @param string $hook_suffix The current admin page.
	 */
	public function enqueue_scripts( string $hook_suffix ): void {
		if ( false === strpos( $hook_suffix, Plugin::SLUG ) ) {
			return;
		}

		wp_enqueue_script(
			'plugin-name-settings',
			WPAPI_PLUGIN_URL . 'assets/build/js/script.min.js',
			[],
			Plugin::VERSION,
			true
		);
	}

	/**
	 * Add plugin page in WordPress menu.
	 *
	 * @since 1.0.0
	 */
	public function add_admin_menu(): void {
		add_menu_page(
			esc_html__( 'WP API Plugin Data', 'wp-api-plugin' ),
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
		require_once WPAPI_PLUGIN_PATH . 'templates/admin/page.php';
	}
}
