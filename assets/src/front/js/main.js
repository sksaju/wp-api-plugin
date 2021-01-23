import {
	__
} from '@wordpress/i18n';

const nodeTitle = document.querySelector( '.wpapi-table-container h3' );
const nodeTable = document.querySelector( '.wpapi-table-container table' );

const months = [ 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ];

/**
 * Append api data to table
 *
 * @since 1.0.0
 */
const appendApiData = () => {

	// Set loading state
	nodeTitle.innerHTML = __( 'loading...', 'wp-api-plugin' );

	const data = new FormData();
	data.append( 'action', 'wpapi_plugin_get_data' );
	const  { ajax_url } = wpapiplugin;

	fetch( ajax_url, {
			method: 'POST',
			body: data
		})
		.then( response => response.json() )
		.then( result => {
			const {
				title,
				data: {
					headers,
					rows
				}
			} = result.data;

			nodeTitle.innerHTML = title; // Set container title

			const thead = nodeTable.createTHead(); // insert table head
			const tBody = nodeTable.createTBody(); // insert table body

			const headRow = thead.insertRow();
			for ( let i = 0; i < headers.length; i++ ) {
				headRow.insertCell().innerHTML = headers[ i ];
			}

			for ( const row in rows ) {
				const tableRow = tBody.insertRow();
				Object.keys( rows[row]).forEach( col => {
					let colData = rows[row][col];
					if ( 'date' === col ) {
						let dateObj = new Date( colData * 1000 );
						colData = months[ dateObj.getMonth() ] + ' ' + dateObj.getDate() + ', ' + dateObj.getFullYear();
					}
					tableRow.insertCell().innerHTML = colData;
				});
			}
		})
		.catch( error => {
			console.error( 'Error:', error );
		});
};

// If the table is exist then apped data into it
if ( nodeTable ) {
	appendApiData();
}
