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


 //**********************
// DISABLE EMOJI SUPPORT

function disable_emojis() {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
}
add_action('init', 'disable_emojis');

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
