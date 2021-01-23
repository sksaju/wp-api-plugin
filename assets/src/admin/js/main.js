import {
	__
} from '@wordpress/i18n';

const nodeRefreshButton = document.getElementById( 'wpapi-plugin-btn-refresh' );

/**
 * Refresh api data
 *
 * @since 1.0.0
 */
const refreshApiData = () => {

	// Set loading state
	nodeRefreshButton.innerHTML = __( 'Reloading..', 'wp-api-plugin' );
	nodeRefreshButton.setAttribute( 'disabled', true );

	const  { ajax_url, nonce_key } = wpapiplugin;
	const data = new FormData();
	data.append( 'action', 'wpapi_plugin_refresh_data' );
	data.append( nonce_key, wpapiplugin[ nonce_key ] );

	fetch( ajax_url, {
			method: 'POST',
			body: data
		})
		.then( response => response.json() )
		.then( result => {
			if ( result.success ) {
				location.reload();
			}
		})
		.catch( error => {
			console.error( 'Error:', error );
		});
};

nodeRefreshButton.addEventListener( 'click', refreshApiData );

