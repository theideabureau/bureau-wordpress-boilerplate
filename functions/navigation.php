<?php // navigation.php

/**
 * Get a menu as an array
 * @param  string $name
 * @return array
 */
function get_menu($name) {

	// get the menu
	$menu = wp_get_nav_menu_items($name);

	// apply any classes to the menu items
	_wp_menu_item_classes_by_context($menu);
	
	// remove the 'current_page_parent' from posts menu-item when on a custom post type
	foreach ($menu as &$menu_item) {

	    if ( (is_post_type_archive('case-study') || is_singular('case-study')) && $menu_item->title == 'News' ) {
	        $menu_item->classes = array_diff($menu_item->classes, ['current_page_parent']);
	    }
	}

	return $menu;

}
