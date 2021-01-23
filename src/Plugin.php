<?php
/**
 * Plugin main class
 *
 * @package  WPAPIPlugin
 * @author   Shazahan Kabir <sksaaju@gmail.com>
 * @license  GPLv2 or later
 * @link     https://github.com/sksaju/wp-api-plugin
 * @since    1.0.0
 */

namespace WPAPIPlugin;

use WPAPIPlugin\Admin\Admin;
use WPAPIPlugin\Front\Front;
use WPAPIPlugin\WP_CLI\CLI_Command;

/**
 * Class Plugin
 *
 * @package WPAPIPlugin
 *
 * @since   1.0.0
 */
class Plugin {

	/**
	 * Plugin slug
	 *
	 * @since 1.0.0
	 */
	const SLUG = 'wp-api-plugin';

	/**
	 * Plugin version
	 *
	 * @since 1.0.0
	 */
	const VERSION = '1.0.0';

	/**
	 * Plugin nonce key
	 *
	 * @since 1.0.0
	 */
	const NONCE_KEY = '_wpnonce';

	/**
	 * Plugin nonce action
	 *
	 * @since 1.0.0
	 */
	const NONCE_ACTION = 'wpapi_nonce_action';

	/**
	 * Plugin constructor.
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
	}

	/**
	 * Load textdomain
	 *
	 * @since 1.0.0
	 */
	public function i18n(): void {
		load_plugin_textdomain( self::SLUG );
	}

	/**
	 * Run plugin
	 *
	 * @since 1.0.0
	 */
	public function run(): void {

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			CLI_Command::init();
		}

		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			new Ajax();
		}

		if ( is_admin() ) {
			new Admin();
		} else {
			new Front();
		}
	}
}
