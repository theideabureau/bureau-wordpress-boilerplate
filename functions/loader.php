<?php // functions/loader.php


 //************************
// THEME PLUGINS DIRECTORY

if ( ! defined('THEME_PLUGINS_DIRECTORY') ) {
	define('THEME_PLUGINS_DIRECTORY', get_theme_root() . '/' . get_template() . '/plugins');
}


 //*******************
// LOAD SIBLING FILES

$priority_files = array(
	'log.php',
	'acf-fields.php',
	'query_loop.php',
	'hacks.php'
);

// get the current path info
$function_path = pathinfo(__FILE__);

foreach ( $priority_files as $priority_file ) {
	include $priority_file;
}

// after we've loaded the priority files add loader.php
// to the array, this will make sure it isn't auto added

$priority_files[] = 'loader.php';

// loop through all php files within this functions directory...
foreach ( glob($function_path['dirname'] . '/*.php') as $file) {

	// if we've already loaded the file, skip this iteration
	if ( in_array(basename($file), $priority_files) ) {
		continue;
	}

	include $file;

}
