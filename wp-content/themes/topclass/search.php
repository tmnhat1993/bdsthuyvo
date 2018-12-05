<?php
/**
 * The template for displaying search results pages.
 *
 * @package Top Class
 */

get_header(); ?>

<div class="container">
	<div class="row">         
		<section id="post-container" class="col-md-8" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'jwtheme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'post-format/content', 'search' );
				?>

			<?php endwhile; ?>

			<?php jwtheme_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'post-format/content', 'none' ); ?>

		<?php endif; ?>

		</section>


      <aside id="blog-sidebar" class="col-md-4">
        <?php if ( is_dynamic_sidebar( 'blog-sidebar' ) ) { ?>
          <?php dynamic_sidebar('blog-sidebar'); ?>
        <?php } else{
          get_sidebar();
        }?>
      </aside>

    </div>
  </div>
  
<?php get_footer(); ?>
