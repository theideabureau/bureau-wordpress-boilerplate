<?php // functions/template.php


 //***********
// PAGINATION

/**
 * checks to see if there is a 'next' page available
 * @return boolean
 */
function has_next_page() {

	global $wp_query;

	$max_pages	= $wp_query->max_num_pages;
	$page		= ( get_query_var('paged') == 0 ? 1 : get_query_var('paged') );

	return ( $page != $max_pages );

}

/**
 * gets the current page number
 * @return int
 */
function get_page_number() {
	return get_query_var('paged') ? get_query_var('paged') : 1;
}


 //**********
// POST SLUG

/**
 * returns the slug from the current post
 * @return string
 */
function get_the_slug() {
	return basename(get_permalink());
}

/**
 * echos the slig from the current post
 */
function the_slug() {
	echo get_the_slug();
}


 //****************
// QUERY FUNCTIONS

/**
 * returns an array of child pages
 * @param  int $id
 * @return array
 */
function get_child_pages($id = NULL) {

	if ( empty($id) ) {
		$id = get_the_ID();
	}

	return new WP_Query(
		array(
			'post_type'			=> 'page',
			'post_parent'		=> $id,
			'posts_per_page'	=> -1
		)
	);

}

/**
 * returns a post object for an id
 * @param  int $id
 * @return array
 */
function get_post_by_id($id) {

	return new WP_Query(
		array(
			'post_type'	=> 'any',
			'p'			=> $id
		)
	);

}

/**
 * returns all posts for a given post type
 * @param  string $post_type
 * @return array
 */
function get_all($post_type) {

	return new WP_Query(
		array(
			'post_type'			=> $post_type,
			'posts_per_page'	=> -1
		)
	);

}


 //********************
// ARRAY MULTI IMPLODE

/**
 * impodes an array with both standard and last items glue
 * @param  string $standard_glue
 * @param  string $last_nodes_glue
 * @param  array $array
 * @return array
 */
function array_multi_implode($standard_glue, $last_nodes_glue, $array) {

	$length = count($array);

	if ( $length > 1 ) {

		$array[$length - 2] = $array[$length - 2] . $last_nodes_glue . $array[$length - 1];

		unset($array[$length - 1]);

	}

	return implode($standard_glue, $array);

}

/**
 * sorts WP posts array by date
 * @return (array) sorted array of WP psots
 */
function sort_posts_by_date($posts) {

	usort($posts, function($a, $b) {

		// if the values are the same don't re-order
		if ( $a == $b ) {
			return 0;
		}

		// re-order the preferred larger value
		return ( strtotime($a->post_date) > strtotime($b->post_date) ) ? -1 : 1;

	});

	return $posts;

}

/**
 * Includes a template partial and passes an optional posts array
 * @param  string $slug
 * @param  string $name
 * @param  array $posts
 */
function get_posts_template($slug, $name = '', $posts = NULL) {

	$templates = array();

	if ( ! empty($name) ) {
		$templates[] = "{$slug}-{$name}.php";
	}

	$templates[] = "{$slug}.php";

	if ( $posts === NULL ) {
		global $wp_query;
		$posts = $wp_query->posts;
	}

	include(locate_template($templates));

}

/**
 * Checks if a post exists within an array, loads it and returns success
 * @param  array $posts
 * @param  integer $index
 * @return boolean
 */
function load_post($posts, $index) {

	global $post;

	if ( ! isset($posts[$index]) ) {
		return FALSE;
	}

	setup_postdata($post = $posts[$index]);

	return TRUE;

}

/**
 * Split an array up into columns
 * @param  array $array
 * @param  integer $columns
 * @return array
 */
function array_columns($array, $columns = 2) {

	$output_array = array();
	$counter = 0;

	foreach ( $array as $key => $value ) {

		$output_array[$counter][$key] = $value;

		if ( $counter++ >= ($columns - 1) ) {
			$counter = 0;
		}

	}

	return $output_array;

}

/**
 * Includes partial templates, similar to get_template_part() * 
 * @param  string $collection
 * @param  string $object
 * @param  array  $options
 */
function get_partial($collection, $object = NULL, $options = array()) {

	$paths = array();

	// if $object has been specified, create add the full path to the array
	if ( $object !== NULL ) {
		$paths[] = implode('/', ['partials', $collection, $object]) . '.php';
	}

	// add the "default" fallback path to tge array
	$paths[] = implode('/', ['partials', $collection, 'default']) . '.php';

	include(locate_template($paths));

}

/**
 * Returns an array of merge partial options
 * @param  array $options 
 * @param  array $defaults
 * @return array
 */
function get_partial_options($options = array(), $defaults = array()) {
	return (object) array_merge($defaults, $options);
}

/**
 * Performs a sub-string, appends a string and returns it
 * @param  string $string
 * @param  integer $length
 * @return string
 */
function get_substr($string, $length) {

	if ( strlen($string) > $length ) {
		return $string = trim(substr($string, 0, $length)) . '&hellip;';
	}

	return $string;

}

/**
 * echos the output from get_substr
 * @param  string $string
 * @param  integer $length
 */
function the_substr($string, $length) {
	echo get_substr($string, $length);
}