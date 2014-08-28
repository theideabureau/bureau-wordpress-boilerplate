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