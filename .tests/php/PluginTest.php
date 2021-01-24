<?php
/**
 * Plugin Tests Class
 *
 * @package  WPAPIPlugin
 * @author   Shazahan Kabir <sksaaju@gmail.com>
 * @license  GPLv2 or later
 * @link     https://github.com/sksaju/wp-api-plugin
 * @since    1.0.0
 */

namespace WPAPIPluginTests;

use PHPUnit\Framework\TestCase;
use WPAPIPlugin\Helpers;

/**
 * Class PluginTest
 *
 * @package WPAPIPluginTests
 *
 * @since   1.0.0
 */
class PluginTest extends TestCase {

	/**
	 * Test api data
	 *
	 * @since 1.0.0
	 */
	public function test_api_data() {
		$api_data = Helpers::get_api_data();
		$this->assertIsArray( $api_data );
		$this->assertNotCount( 0, $api_data );
		$this->assertArrayHasKey( 'title', $api_data );
		$this->assertArrayHasKey( 'data', $api_data );
	}
}
