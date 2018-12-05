<?php
/**
 * The template for displaying all single posts.
 *
 * @package Top Class
 */

get_header(); ?>


<div id="blog-page" class="single-page">
	<div class="container">
		<div class="row">
			<div class="main-content">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'post-format/single', get_post_format() ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php endif; ?>
			
			</div>

		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- #blog-page -->

<?php get_footer(); ?>
