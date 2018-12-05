<?php
/**
 * Template Name: Forum
 * The template for displaying all pages.
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
		<div class="main-content">
			<?php while ( have_posts() ) { the_post(); ?>

			<?php get_template_part( 'post-format/content', 'forum' ); ?>

			<?php } // end of the loop. ?>
		</div>

	</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
