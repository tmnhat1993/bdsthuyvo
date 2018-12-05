<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package JW Theme
 */
?>
<section class="single-page">
	<div id="post-container" class="col-md-9" role="main">
		<div class="post-container">
			<article class="post type-post">

				<div class="forum-content">					
					<div class="truebreadcrumbs">
						<?php bbp_breadcrumb(); ?>
					</div>

					<div class="entry">
						<?php the_content();?>
					</div>
				</div><!-- /.post-content --> 
			</article><!-- /.post -->


		</div><!-- /.post-container -->
	</div><!-- /.col-md-8 -->

	<aside id="blog-sidebar" class="col-md-3">
		<?php if ( is_dynamic_sidebar( 'forum-sidebar' ) ) { ?>
		<?php dynamic_sidebar('forum-sidebar'); ?>
		<?php } else{
			get_sidebar();
		}?>
	</aside>
</section>
