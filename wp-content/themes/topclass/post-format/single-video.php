<?php
/**
 * The template used for displaying page content in single.php
 *
 * @package JW Theme
 */
?>

    <div  id="post-container" class="col-md-8" role="main">
        <div class="post-container">
            <article id="post-<?php the_ID(); ?>"  <?php post_class(); ?>>

                <?php 
                    $video_source = rwmb_meta( '_jwtheme_video_source' ); 
                    $video = rwmb_meta( '_jwtheme_video' );

                if( $video_source ) { ?>
                    <div class="post-thumbnail">
                        <?php  ?>
                        <?php if($video_source == 1): ?>
                            <?php echo rwmb_meta( '_jwtheme_video' ); ?>
                        <?php elseif ($video_source == 2): ?>
                            <?php echo '<iframe width="100%" height="450" src="http://www.youtube.com/embed/'.$video.'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe>'; ?>
                        <?php elseif ($video_source == 3): ?>
                            <?php echo '<iframe src="http://player.vimeo.com/video/'.$video.'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="450" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>'; ?>
                        <?php endif; ?>
                    </div>
                <?php } ?>  

                <div class="post-content">

                    <?php the_title( sprintf( '<h2 class="post-title">' ), '</h2>' ); ?>

                    <div class="entry"><?php the_content();?></div>

                    <footer class="post-meta">
                        <div class="entry-meta pull-left">
                            <span class="entry-date"><i class="fa fa-clock-o"></i><time datetime="<?php the_time( 'c' ); ?>">
                                <?php echo get_the_date('M');?> <?php echo get_the_date('y');?> </time>
                            </span>

                            <?php if( has_tag() ){ ?>
                                <span class="tag-links"><i class="fa fa-tag"></i>
                                    <?php the_tags(' ' , ' , '); ?>
                                </span>
                            <?php } ?>

                        </div><!-- /.entry-meta -->
                        
                       <?php echo topclass_social();?>
                       
                    </footer><!-- /.post-meta -->
                </div><!-- /.post-content --> 
            </article><!-- /.post -->


            <div class="author-bio-container">
                <div class="author-bio">
                    <div class="about-author">
                        
                        <?php echo get_avatar( get_the_author_meta( 'ID' ), 135 ); ?>
                        <div class="author-details">
                            
                            <h5 class="author-name"><?php echo get_the_author_meta('display_name');?></h5>                          
                            <p><?php echo get_the_author_meta('description');?></p>

                            <div class="social-btn">
                                <?php 
                                    $twitter_profile = get_the_author_meta( 'twitter_profile' );
                                    if ( $twitter_profile && $twitter_profile != '' ) {
                                        echo '<a href="' . esc_url($twitter_profile) . '" class="twitter-btn"><i class="fa fa-twitter"></i></a>';
                                    }

                                    $facebook_profile = get_the_author_meta( 'facebook_profile' );
                                    if ( $facebook_profile && $facebook_profile != '' ) {
                                        echo '<a href="' . esc_url($facebook_profile) . '" class="facebook-btn"><i class="fa fa-facebook"></i></a>';
                                    }

                                    $google_profile = get_the_author_meta( 'google_profile' );
                                    if ( $google_profile && $google_profile != '' ) {
                                        echo '<a href="' . esc_url($google_profile) . '" class="google-plus-btn"><i class="fa fa-google-plus"></i></a>';
                                    }

                                    $dribbble_profile = get_the_author_meta( 'dribbble_profile' );
                                    if ( $dribbble_profile && $dribbble_profile != '' ) {
                                     echo '<a href="' . esc_url($dribbble_profile) . '" class="dribbble-btn"><i class="fa fa-dribbble"></i></a>';
                                    }  

                                    $linkedin_profile = get_the_author_meta( 'linkedin_profile' );
                                    if ( $linkedin_profile && $linkedin_profile != '' ) {
                                     echo '<a href="' . esc_url($linkedin_profile) . '" class="linkedin-btn"><i class="fa fa-linkedin"></i></a>';
                                    }
                                ?>                                
                                
                            </div><!-- /.social-btn -->
                        </div>
                    </div><!-- /.about-author -->

                </div><!-- /.author-bio -->
            </div><!-- /.author-bio-container -->
	
		<?php echo jwtheme_post_nav();?>
		
	        <?php
	        // If comments are open or we have at least one comment, load up the comment template
	        if ( comments_open() || '0' != get_comments_number() ) :
	            comments_template();
	        endif;
	        ?>

        </div><!-- /.post-container -->
    </div><!-- /.col-md-8 -->

    <aside id="blog-sidebar" class="col-md-4">
        <?php if ( is_dynamic_sidebar( 'blog-sidebar' ) ) { ?>
        <?php dynamic_sidebar('blog-sidebar'); ?>
        <?php } else{
            get_sidebar();
        }?>
    </aside>