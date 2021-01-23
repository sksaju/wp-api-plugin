<?php
/**
 * Api data list template
 *
 * @package  WPAPIPlugin
 * @author   Shazahan Kabir <sksaaju@gmail.com>
 * @license  GPLv2 or later
 * @link     https://github.com/sksaju/wp-api-plugin
 * @since    v1.0.0
 */

use WPAPIPlugin\Admin\API_Data_List;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="wrap">
	<h1 class="wp-heading-inline">
		<?php echo esc_html( get_admin_page_title() ); ?>
		<button type="button" id="wpapi-plugin-btn-refresh" class="button"><?php _e( 'Refresh', 'wp-api-plugin' ); ?></button>
	</h1>
	<?php
		$api_data = new API_Data_List();
		$api_data->prepare_items();
		$api_data->display();
	?>
</div>
