<?php
/**
 * Plugin Name: WP API Plugin
 * Plugin URI: https://github.com/sksaju/wp-api-plugin
 * Description: A Simple API Plugin for WordPress
 * Version: 1.0.0
 * Author: Shazahan Kabir
 * Author URI: https://github.com/sksaju/
 * Text Domain: wp-api-plugin
 * Domain Path: /languages/
 * Requires at least: 5.4
 * Requires PHP: 7.1
 *
 * @package WPAPIPlugin
 */

use WPAPIPlugin\Plugin;

defined( 'ABSPATH' ) || exit;

if ( version_compare( phpversion(), '7.1', '<' ) ) {

	/**
	 * Let's log the php version failure and display a nice admin notice.
	 *
	 * @since 1.0.0
	 */
	add_action(
		'admin_notices',
		function () {
			?>
			<div class="notice notice-error">
				<p>
					<?php
						sprintf(
							/* translators: %1$s: start <strong> tag, %2$s: end </strong> tag */
							esc_html__( 'The %1$sWP API Plugin%2$s requires at least %1$sPHP 7.1 %2$s to run properly. Please update the PHP on your server and try again.', 'wp-api-plugin' ),
							'<strong>',
							'</strong>'
						);
					?>
				</p>
			</div>
			<?php
		}
	);

	return;
}

/**
 * Define the required plugin constants
 */
define( 'WPAPI_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WPAPI_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Run plugin
 *
 * @since 1.0.0
 */
function run_wp_api_plugin() {
	require_once WPAPI_PLUGIN_PATH . 'vendor/autoload.php';
	$wp_api_plugin = new Plugin();
	$wp_api_plugin->run();

	do_action( 'wp_api_plugin_init', $wp_api_plugin );
}

// Take of the plugin after all the other plugins have loaded.
add_action( 'plugins_loaded', 'run_wp_api_plugin' );
