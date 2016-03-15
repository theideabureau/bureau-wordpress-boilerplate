<?php // parts/content.php ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<?php the_content(); ?>
	
	<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>

<?php endwhile; ?>
