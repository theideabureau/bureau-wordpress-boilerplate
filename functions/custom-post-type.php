<?php // functions/custom-post-types.php


 //*******
// LABELS

function create_post_type_labels($singular, $plural = NULL) {

	$plural = $plural === NULL ? $singular . 's' : $plural;
	
	return array(
		'name'					=> $plural,
		'singular_name'			=> $singular,
		'add_new'				=> 'Add ' . $singular,
		'add_new_item'			=> 'Add New ' . $singular,
		'edit_item'				=> 'Edit ' . $singular,
		'new_item'				=> 'New ' . $singular,
		'view_item'				=> 'View ' . $singular,
		'search_items'			=> 'Search ' . $plural,
		'not_found'				=> 'No ' . strtolower($plural) . ' found',
		'not_found_in_trash'	=> 'No ' . strtolower($plural) . ' found in Trash', 
		'parent_item_colon'		=> ''
	);

}


 //*****************
// CUSTOM POST TYPE

// register_post_type('recipe', array(
// 	'labels'				=> create_post_type_labels('Recipe', 'Recipies'),
// 	'public'				=> TRUE,
// 	'query_var'				=> TRUE,
// 	'rewrite'				=> array('slug' => 'recipe', 'with_front' => FALSE),
// 	'capability_type'		=> 'page',
// 	'taxonomies'			=> array(),
// 	'supports'				=> array('title', 'editor', 'thumbnail', 'page-attributes', 'page-formats', 'comments'),
// 	'has_archive'			=> FALSE
// ));