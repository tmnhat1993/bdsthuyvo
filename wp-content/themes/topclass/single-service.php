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

get_header('page'); ?>

	<div class="container">
		<div class="row">					
			<div class="main-content">
			<?php 

				/* Start the Loop */ 
				if ( have_posts() ) { while ( have_posts() ) { the_post(); 
					get_template_part( 'post-format/single', 'service' ); 
				}
				
				echo jwtheme_pagination();

				} else {
					get_template_part( 'post-format/content', 'none' ); 
				}
			?>
		
			</div>

		</div>
	</div>


<?php get_footer(); ?>
