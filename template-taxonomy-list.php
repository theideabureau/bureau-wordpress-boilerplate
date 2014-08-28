<?php 

/**
 * template-taxonomy-list.php 
 * 
 * The template for displaying all terms within a taxonomy
 * Add a page with the same slug as the taxonomy slug, set
 * the page template as this file.
 *
 * Template Name: Taxonomy List
 */

?>

<?php get_header(); ?>

	<?php

		the_post();

		$taxonomy = basename(get_the_permalink());
		$terms = get_terms($taxonomy);

	?>

	<h1><?php the_title(); ?></h1>

	<?php foreach ( $terms as $term ) : ?>

		<h5>
			<a href="<?php echo get_term_link(intval($term->term_id), $taxonomy); ?>"><?php echo $term->name; ?></a>
		</h5>

	<?php endforeach; ?>

<?php get_footer(); ?>