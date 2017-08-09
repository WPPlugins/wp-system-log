jQuery(document).ready(function(){
	//Submit the enquiry
	jQuery(document).on('click', '#wpsl-send-enquiry', function(){
		var email = jQuery( '#user-email' ).val();
		var message = jQuery( '#user-message' ).val();
		if( email == '' || message == '' ) {
			alert( "details empty" );
		} else {
			jQuery( '.wpsl-send-enquiry-spinner' ).show();
			jQuery.post(
				ajaxurl,
				{
					'action' : 'wpsl_send_enquiry',
					'email' : email,
					'message' : message
				},
				function( response ) {
					if( response == 'enquiry-sent-success' ) {
						jQuery( '#wpsl_enquiry_success' ).show();
						jQuery( '.wpsl-send-enquiry-spinner' ).hide();
					}
				}
			);
		}
	});

	//Turn On The Debug Mode
	jQuery(document).on('click', '#turn-on-debug', function(){
		jQuery.post(
			ajaxurl,
			{
				'action' : 'wpsl_turn_on_debug'
			},
			function( response ){
				var html = '';
				html += '<td><h4>Wordpress Debug Mode:</h4></td>';
				html += '<td><img class="tick-icon" src="'+response+'admin/assets/images/symbol_check.png"></td>';
				html += '<td>';
				html += '<input type="button" class="button button-primary" id="turn-off-debug" value="Turn Off">';
				html += '</td>';

				jQuery( '#wp-debug-row' ).html( html );
			}
		);
	});

	//Turn Off The Debug Mode
	jQuery(document).on('click', '#turn-off-debug', function(){
		jQuery.post(
			ajaxurl,
			{
				'action' : 'wpsl_turn_off_debug'
			},
			function( response ) {
				var html = '';
				html += '<td><h4>Wordpress Debug Mode:</h4></td>';
				html += '<td><img class="tick-icon" src="'+response+'admin/assets/images/erase-icon.png"></td>';
				html += '<td>';
				html += '<input type="button" class="button button-primary" id="turn-on-debug" value="Turn On">';
				html += '</td>';

				jQuery( '#wp-debug-row' ).html( html );
			}
		);
	});
});