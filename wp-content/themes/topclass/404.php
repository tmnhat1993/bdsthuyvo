<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Top Class
 */

get_header('404'); ?>

<div class="container">
	<div class="row">   
		<!-- 404 Page -->
		<div class="page page-not-found">
			<div class="container">
				<div class="row">
					
					<div class="col-md-4">
						<div class="error-icon">
							<span class="icon-eye left"></span>
							<span class="icon-eye right"></span>
							<span class="icon-lip"></span>
						</div><!-- /.error-icon -->
					</div><!-- /.col-md-4 -->

					<div class="col-md-8">
						<h2> <?php if (isset($jwtheme_topclass['settings_404_heading'])) echo $jwtheme_topclass['settings_404_heading']; ?> </h2>

						<p> <?php if (isset($jwtheme_topclass['settings_404_subheading'])) echo $jwtheme_topclass['settings_404_subheading']; ?> </p>

						<aside class="widget widget_search">
							<?php get_search_form(); ?>
						</aside><!-- /.widget -->
					</div><!-- /.col-md-8 -->

				</div><!-- /.row -->
			</div><!-- /.container -->
		</div><!-- /.page-not-found -->

	</div>
</div>
<?php get_footer(); ?>
