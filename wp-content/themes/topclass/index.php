<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Top Class
 */

get_header(); ?>

	<div class="container">
		<div class="row">	
				<div class="main-content">
				<section id="post-container" class="col-md-8" role="main">
					<?php 

						/* Start the Loop */ 
						if ( have_posts() ) { while ( have_posts() ) { the_post(); 
							get_template_part( 'post-format/content', get_post_format() ); 
						}
						
						echo jwtheme_pagination();

						} else {
							get_template_part( 'post-format/content', 'none' ); 
						}
					?>
				</section>

				<aside id="blog-sidebar" class="col-md-4">
					<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
					<?php dynamic_sidebar('blog-sidebar'); ?>
					<?php } else{
						get_sidebar();
					}?>
				</aside>
			</div>
		</div>
	</div>


<?php get_footer(); ?>
