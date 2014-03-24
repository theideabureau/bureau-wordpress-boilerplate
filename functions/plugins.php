<?php // functions/plugins.php

// modify Yoast SEO meta box priority
add_filter('wpseo_metabox_prio', function() {
	return 'low';
});