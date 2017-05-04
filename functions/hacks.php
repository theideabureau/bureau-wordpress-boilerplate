<?php // functions/hacks.php


 //***********
// JQUERY FIX

add_action('template_redirect', function() {

	// only use this method is we're not in wp-admin
	if ( ! is_admin() ) {

		// deregister the original version of jQuery
		wp_deregister_script('jquery');

		// register it again, this time with no file path
		wp_register_script('jquery', '', FALSE, '1.11.0');

		// add it back into the queue
		wp_enqueue_script('jquery');

	}

});


/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param    array  $plugins  
 * @return   array             Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins) {
	
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
	
}
