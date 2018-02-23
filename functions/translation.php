<?php

add_filter('translatable_custom_fields', function(array $fields, int $post_id) {

	$post_type = get_post_type($post_id);

	// for each case, determine what translatable fields to use

	// if ( $post_type === 'post-type' ) {
	//
	// 	array_push($fields, [
	// 		'field-1',
	// 		'field-2'
	// 	]);
	//
	// }

	// return an empty array as a fallback
	return $fields;

}, 10, 2);
