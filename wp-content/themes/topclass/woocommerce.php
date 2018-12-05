<?php
/**
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
			<?php  woocommerce_content(); ?>
		</div>
	</div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
