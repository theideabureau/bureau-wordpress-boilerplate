<?php // functions/plugins.php

// modify Yoast SEO meta box priority
add_filter('wpseo_metabox_prio', function() {
	return 'low';
});

// remove YARPP CSS files

add_action('wp_head', function() {
	wp_dequeue_style('yarppWidgetCss');
}, 1);

add_action('wp_footer', function() {
	wp_dequeue_style('yarppRelatedCss');
}, 1);
