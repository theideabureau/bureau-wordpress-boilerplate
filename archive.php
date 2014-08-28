<?php // archive.php ?>

<?php get_header(); ?>

	<?php if ( is_category() ) : ?>
		<h1><?php single_cat_title(); ?></h1>
	<?php elseif( is_tag() ) : ?>
		<h1><?php single_tag_title(); ?></h1>
	<?php elseif( is_tax() ) : ?>
		<h1><?php single_cat_title(); ?></h1>
	<?php elseif (is_day()) : ?>
		<h1>Archive for <?php the_time('F jS, Y'); ?></h1>
	<?php elseif (is_month()) : ?>
		<h1>Archive for <?php the_time('F, Y'); ?></h1>
	<?php elseif (is_year()) : ?>
		<h1>Archive for <?php the_time('Y'); ?></h1>
	<?php elseif (is_author()) : ?>
		<h1>Author Archive</h1>
	<?php else : ?>
		<h1><?php the_post_type_label(NULL, TRUE); ?></h1>
	<?php endif;?>

	<?php if ( have_posts() ) : the_post(); ?>

		<article>

			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

			<?php the_content(); ?>

		</article>

	<?php endif; ?>

<?php get_footer(); ?>