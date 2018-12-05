<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package JW Theme
 */
?>
<section class="single-page">
	<div id="post-container" class="col-md-8" role="main">
		<div class="post-container">
			<article class="post type-post">

				<?php if ( has_post_thumbnail() ) { ?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail('blog-thumb'); ?>
					</div>
				<?php } ?>

				<div class="post-content">					

					<?php the_title( sprintf( '<h1 class="post-title">' ), '</h1>' ); ?>

					<div class="entry">
						<?php the_content();?>
					</div>

				</div><!-- /.post-content --> 
			</article><!-- /.post -->


		</div><!-- /.post-container -->
	</div><!-- /.col-md-8 -->

	<aside id="blog-sidebar" class="col-md-4">
		<?php if ( is_dynamic_sidebar( 'blog-sidebar' ) ) { ?>
		<?php dynamic_sidebar('blog-sidebar'); ?>
		<?php } else{
			get_sidebar();
		}?>
	</aside>
</section>
