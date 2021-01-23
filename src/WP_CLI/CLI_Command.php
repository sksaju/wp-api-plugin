<?php
/**
 * Class CLI Commands
 *
 * @package  WPAPIPlugin
 * @author   Shazahan Kabir <sksaaju@gmail.com>
 * @license  GPLv2 or later
 * @link     https://github.com/sksaju/wp-api-plugin
 * @since    v1.0.0
 */

namespace WPAPIPlugin\WP_CLI;

use WP_CLI;
use WP_CLI_Command;
use WPAPIPlugin\Helpers;

/**
 * Class Ajax
 *
 * @package WPAPIPlugin\WP_CLI
 *
 * @since   1.0.0
 */
class CLI_Command extends WP_CLI_Command {

	/**
	 * Init commands plugin
	 *
	 * @since 1.0.0
	 */
	public static function init(): void {
		WP_CLI::add_command( 'refresh-api-data', [ __CLASS__, 'refresh_api_data' ] );
    }
    
    /**
	 * Run the refresh command callback
	 * 
	 * @since 1.0.0
	 */
	public static function refresh_api_data() {

		try {
			// Reset API data.
			Helpers::set_api_data();

			WP_CLI::success(
				__( 'API data refreshed!', 'wp-api-plugin' )
			);
		} catch ( Exception $e ) {
			WP_CLI::error(
				sprintf(
					/* translators: %s refers to the exception error message */
					__( 'There was an error running the api refresh command: %s', 'wp-api-plugin' ),
					$e->getMessage()
				)
			);
		}
    }
}
