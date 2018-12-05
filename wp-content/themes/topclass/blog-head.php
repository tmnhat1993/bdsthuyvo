<?php
global $jwtheme_topclass;
?> 
<div id="page-name-sec" class="parallax-image" style="background: url('<?php echo $jwtheme_topclass['section_blog_bg']['url'];?>')  50% 0 no-repeat fixed;">
	<div class="parallax-style page-name-sec">
		<div class="pattern">
			<div class="container">
				<p class="page-name">
					<?php the_title();?>
				</p>
				<p class="page-location">
					<a href="<?php echo site_url(); ?>">Home</a> <?php the_title();?>
				</p>
			</div>
		</div>
	</div>
</div>
