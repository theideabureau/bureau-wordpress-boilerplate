<?php // functions/media.php


 //********************
// ADD THUMBNAIL SIZES

/**
 * Creates a WordPress image size based on a width and an aspect ratio
 *
 * Example usage and image size names
 *
 * add_aspect_ratio('hero', 900, 16, 9) // hero_900
 * add_aspect_ratio('hero', 600, 16, 9) // hero_600
 * add_aspect_ratio('hero', 300, 16, 9) // hero_300
 * 
 * @param string $label
 * @param integer $width
 * @param integer $aspect_width
 * @param integer $aspect_height
 */
function add_aspect_ratio($label, $width, $aspect_width, $aspect_height) {
	add_image_size($label . '_' . $width, $width, ceil(($aspect_height / $aspect_width) * $width), TRUE);
}