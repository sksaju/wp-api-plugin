<?php

namespace WPAPIPlugin\Admin;

use WP_List_Table;
use WPAPIPlugin\Helpers;

/**
 * Class Admin
 *
 * @package  WPAPIPlugin
 * @author   Shazahan Kabir <sksaaju@gmail.com>
 * @license  GPLv2 or later
 * @link     https://github.com/sksaju/wp-api-plugin
 * @since    v1.0.0
 */
class API_Data_List extends WP_List_Table {

	/**
	 * Class constructor.
	 */
	public function __construct() {
		// Set parent defaults.
		parent::__construct(
			[
				'singular' => 'API Data', 	// singular name of the listed records.
				'plural'   => 'API Data', 	// plural name of the listed records.
				'ajax'     => false, 		// does this table support ajax?
			]
		);
	}

	/**
	 * Render a column when no column specific method exists.
	 *
	 * @param  array $item row values.
	 * @param  string $column_name col name.
	 *
	 * @return mixed
	 *
	 * @since  1.0.0
	 */
	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'id':
			case 'fname':
			case 'lname':
			case 'email':
			case 'date':
				return $item[ $column_name ];
		}
	}

	/**
	 * Associative array of columns
	 *
	 * @return array
	 *
	 * @since  1.0.0
	 */
	public function get_columns() {
		$columns = [
			'id'    => __( 'ID', 'wp-api-plugin' ),
			'fname' => __( 'First Name', 'wp-api-plugin' ),
			'lname' => __( 'Last Name', 'wp-api-plugin' ),
			'email' => __( 'Email', 'wp-api-plugin' ),
			'date'  => __( 'Date', 'wp-api-plugin' ),
		];

		return $columns;
	}

	/**
	 * API Table data
	 *
	 * @return array
	 *
	 * @since  1.0.0
	 */
	public function get_items() {

		$api_data = Helpers::get_api_data();
		$data     = $api_data['data']['rows'];

		$data = array_map(
			function( $item ) {
				$item['date'] = gmdate( get_option( 'date_format' ), $item['date'] );
				return $item;
			},
			$data
		);

		return $data;
	}

	/**
	 * Prepares the list of items for displaying.
	 *
	 * @since 1.0.0
	 */
	public function prepare_items() {
		$columns               = $this->get_columns();
		$items                 = $this->get_items();
		$this->_column_headers = [ $columns ];
		$this->items           = $items;
	}
}
