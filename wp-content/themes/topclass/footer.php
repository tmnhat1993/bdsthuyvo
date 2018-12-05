<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Top Class
 */

global $jwtheme_topclass;

?>

	</div><!-- #content -->


<?php if ($jwtheme_topclass['section_display_social_section']) { ?>
	<footer id="footer-section" style="background:url('<?php echo $jwtheme_topclass['section_footer_parallax_image']['url']; ?>') 50% 0 no-repeat fixed;">
		<div class="footer-section parallax-style">
			<div class="pattern">
				<div class="container">
					<div class="footer-social-btn">
					
						<?php
						if(isset($jwtheme_topclass['section_social_facebook']) && trim($jwtheme_topclass['section_social_facebook'])!="") echo "<a href='{$jwtheme_topclass['section_social_facebook']}' class='facebook-btn wow rollIn center animated' data-wow-delay='.1s'><i class='fa fa-facebook'></i></a>";
						?><?php
						if(isset($jwtheme_topclass['section_social_linkedin'])  && trim($jwtheme_topclass['section_social_linkedin'])!="") echo "<a href='{$jwtheme_topclass['section_social_linkedin']}' class='linkedin-btn wow rollIn center animated' data-wow-delay='.1s'><i class='fa fa-linkedin'></i></a>";
						?><?php
						if(isset($jwtheme_topclass['section_social_github'])  && trim($jwtheme_topclass['section_social_github'])!="") echo "<a href='{$jwtheme_topclass['section_social_github']}' class='github-btn wow rollIn center animated' data-wow-delay='.1s'><i class='fa fa-github'></i></a>";
						?><?php
						if(isset($jwtheme_topclass['section_social_twitter']) && trim($jwtheme_topclass['section_social_twitter'])!="") echo "<a href='{$jwtheme_topclass['section_social_twitter']}' class='twitter-btn wow rollIn center animated' data-wow-delay='.1s'><i class='fa fa-twitter'></i></a>";
						?><?php
						if(isset($jwtheme_topclass['section_social_pinterest'])  && trim($jwtheme_topclass['section_social_pinterest'])!="") echo "<a href='{$jwtheme_topclass['section_social_pinterest']}' class='pinterest-btn wow rollIn center animated' data-wow-delay='.1s'><i class='fa fa-pinterest'></i></a>";
						?><?php
						if(isset($jwtheme_topclass['section_social_google']) && trim($jwtheme_topclass['section_social_google'])!="") echo "<a href='{$jwtheme_topclass['section_social_google']}' class='google-plus-btn wow rollIn center animated' data-wow-delay='.1s'><i class='fa fa-google-plus'></i></a>";
						?><?php
						if(isset($jwtheme_topclass['section_social_dribbble']) && trim($jwtheme_topclass['section_social_dribbble'])!="") echo "<a href='{$jwtheme_topclass['section_social_dribbble']}' class='dribbble-btn wow rollIn center animated' data-wow-delay='.1s'><i class='fa fa-dribbble'></i></a>";
						?><?php
						if(isset($jwtheme_topclass['section_social_flickr']) && trim($jwtheme_topclass['section_social_flickr'])!="") echo "<a href='{$jwtheme_topclass['section_social_flickr']}' class='flickr-btn wow rollIn center animated' data-wow-delay='.1s'><i class='fa fa-flickr'></i></a>";
						?><?php
						if(isset($jwtheme_topclass['section_social_instagram']) && trim($jwtheme_topclass['section_social_instagram'])!="") echo "<a href='{$jwtheme_topclass['section_social_instagram']}' class='instagram-btn wow rollIn center animated' data-wow-delay='.1s'><i class='fa fa-instagram'></i></a>";
						?><?php
						if(isset($jwtheme_topclass['section_social_youtube']) && trim($jwtheme_topclass['section_social_youtube'])!="") echo "<a href='{$jwtheme_topclass['section_social_youtube']}' class='youtube-btn wow rollIn center animated' data-wow-delay='.1s'><i class='fa fa-youtube'></i></a>";
						?><?php
						if(isset($jwtheme_topclass['section_social_rss']) && trim($jwtheme_topclass['section_social_rss'])!="") echo "<a href='{$jwtheme_topclass['section_social_rss']}' class='rss-btn wow rollIn center animated' data-wow-delay='.1s'><i class='fa fa-rss'></i></a>";
						?>

					</div><!-- /.footer-social-btn -->
				</div><!-- /.container -->
			</div><!-- /.pattern -->
		</div><!-- /.footer-section -->
	</footer><!-- /#footer-section -->
<?php } ?>


	<section class="bottom_panel">
		<div class="container">
			<div class="company_details">

				<?php 
					if ( is_dynamic_sidebar( 'footer-sidebar' ) ) {
						 dynamic_sidebar('footer-sidebar');		
					}
				?>
            				
			</div>			
		</div>

	</section>

<div class="copyrights">
	<div class="container">
		<?php if(isset($jwtheme_topclass['jwtheme_copyright_text'])) echo $jwtheme_topclass['jwtheme_copyright_text'];?>
	</div><!-- /.container -->
</div><!-- /.copyrights -->


<?php if (isset($jwtheme_topclass['custom_ga'])) echo $jwtheme_topclass['custom_ga']; ?>

	<div id="scroll-to-top">
		<span>
			<i class="fa fa-chevron-up"></i>    
		</span>
	</div>

</div>

<script>	 
	jQuery(document).ready(function(){
	 jQuery(".video-container").fitVids();
	});
</script>

<?php wp_footer(); ?>

</body>
</html>
