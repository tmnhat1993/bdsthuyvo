<?php
/**
 * Template name: Full Width
 * The template for displaying Full Width Pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Top Class
 */

get_header('page'); ?>

<div class="container">
	<div class="row">
		<?php while ( have_posts() ) { the_post(); ?>

		<?php the_title( sprintf( '<h2 class="post-title">' ), '</h2>' ); ?>

		<?php the_content();?>

		<?php } // end of the loop. ?>

	</div>
</div>

<?php get_footer(); ?>
