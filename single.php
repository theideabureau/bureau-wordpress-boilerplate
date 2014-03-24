<?php // single.php ?>

<?php get_header(); ?>

	<?php

		// fetch the content specific template
		// NOTE: if one can't be found (e.g. for normal articles) content.php is used

		get_template_part('partials/content', get_post_format());

	?>

<?php get_footer(); ?>