<?php // search.php ?>

<?php get_header(); ?>

	<h2>Search Results for '<?php echo get_search_query(); ?>'</h2>

	<?php if ( have_posts() ) : ?>

		<article>

			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

			<?php the_content(); ?>

		</article>

	<?php else : ?>
		<p>There are no search results</p>
	<?php endif; ?>

<?php get_footer(); ?>