<?php // functions/loader.php


 //************************
// THEME PLUGINS DIRECTORY

if ( ! defined('THEME_PLUGINS_DIRECTORY') ) {
	define('THEME_PLUGINS_DIRECTORY', get_theme_root() . '/' . get_template() . '/plugins');
}


 //*******************
// LOAD SIBLING FILES

// get the current path info
$function_path = pathinfo(__FILE__);

// loop through all php files within this functions directory...
foreach ( glob($function_path['dirname'] . '/*.php') as $file) {

	// and if it's not loader.php, include it
	if ( basename($file) !== 'loader.php' ) {
		include $file;
	}

}