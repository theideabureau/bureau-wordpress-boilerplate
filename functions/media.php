<?php // functions/media.php


 //********************
// ADD THUMBNAIL SIZES

/**
 * add_aspect_ratio, creates a WordPress image size based on a width and an aspect ratio
 * @param string $label
 * @param integer $width
 * @param integer $aspect_width
 * @param integer $aspect_height
 */
function add_aspect_ratio($label, $width, $aspect_width, $aspect_height) {
	add_image_size($label . '_' . $width, $width, ceil(($aspect_height / $aspect_width) * $width), TRUE);
}