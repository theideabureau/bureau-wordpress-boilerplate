<?php // functions/acf-fields.php

/**
 * Adds various sub-options pages
 */

if ( FALSE ) {

	add_filter('acf/options_page/settings', function($settings) {

		$settings['title'] = 'Options';
		$settings['pages'] = array('General', 'Social', 'Contact', 'Subscription', 'Menu', 'Adverts');

		return $settings;

	});

}