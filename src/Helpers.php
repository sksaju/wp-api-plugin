<?php
/**
 * Class with static helper functions.
 *
 * @package  WPAPIPlugin
 * @author   Shazahan Kabir <sksaaju@gmail.com>
 * @license  GPLv2 or later
 * @link     https://github.com/sksaju/wp-api-plugin
 * @since    v1.0.0
 */

namespace WPAPIPlugin;

use Exception;

class Helpers {

	/**
	 * Validity time in seconds for remote api data
	 *
	 * @var   number
	 *
	 * @since 1.0.0
	 */
	const API_VALIDITY_TIME = 3600;

	/**
	 * Data transient key
	 *
	 * @var   string
	 *
	 * @since 1.0.0
	 */
	const DATA_TRANSIENT_KEY = 'miusage_api_data';

	/**
	 * Get API Data
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public static function get_api_data(): array {
		$api_data = get_transient( self::DATA_TRANSIENT_KEY );

		if ( ! $api_data ) {
			$api_data = self::set_api_data();
		}

		return $api_data;
	}

	/**
	 * Set API Data
	 *
	 * @return array
	 *
	 * @since 1.0.0
	 */
	public static function set_api_data(): array {
		$response = wp_remote_get( 'https://miusage.com/v1/challenge/1/' );

		try {
			$data = json_decode( $response['body'], true );
			set_transient( self::DATA_TRANSIENT_KEY, $data, self::API_VALIDITY_TIME );
		} catch ( Exception $e ) {
			echo $e->getMessage();
			exit;
		}

		return $data;
	}
}
