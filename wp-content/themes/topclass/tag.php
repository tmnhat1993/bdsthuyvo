<?php
/**
 * @package Biz-WP
 */
get_header();
?>

  <div class="container">
    <div class="row">         
      <section id="post-container" class="col-md-8" role="main">

          <?php if ( have_posts() ) : ?>

          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>

          <?php
          /* Include the Post-Format-specific template for the content.
           * If you want to override this in a child theme, then include a file
           * called content-___.php (where ___ is the Post Format name) and that will be used instead.
           */
          get_template_part( 'post-format/content', get_post_format() );
          ?>

          <?php endwhile; ?>

          <?php echo jwtheme_pagination(); ?>

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

<?php get_footer();?>