<?php // functions.php

 
 //*****************
// FUNCTIONS LOADER

// bury groups of functionality within the functions/ directory
// loader.php will include all .php files from within

require_once('functions/loader.php');


 //**************
// THEME SUPPORT

add_theme_support('post-thumbnails');
add_theme_support('menus');


 //****************
// REGISTER IMAGES

// standard images
add_image_size('standard_image', 100, 100, TRUE);

// aspect ratio
add_aspect_ratio('4x3', 100, 4, 3);