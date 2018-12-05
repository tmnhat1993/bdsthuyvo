<?php
/**
 * @package JW Theme
 */
?>


<article class="post post-<?php the_ID(); ?>">

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
 
        <?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

        <div class="entry">
            <p><?php echo wp_trim_words( get_the_content(), 55, ' '  ); ?></p>
        </div>

        <footer class="post-meta">          
            <div class="continue-reading pull-left">
                <a href="<?php the_permalink();?>">Continue reading ...</a>
            </div>
            <div class="entry-meta pull-right">
                <span class="entry-date"><i class="fa fa-clock-o"></i><time datetime="<?php the_time( 'c' ); ?>">
                    <?php echo get_the_date('M');?> <?php echo get_the_date('y');?> </time>
                </span>
                <span class="author">
                    <?php printf('<a class="post-meta-element author vcard url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="fa fa-user"></i> ' . esc_html( get_the_author_meta('display_name') ) . '</a>' ); ?>
                </span>
                <span class="comments-link">
                    <a class="comments" href="<?php comments_link(); ?>" >
                        <i class="fa fa-comment-o"></i> <?php comments_number( '0', '1', '%' );?>
                    </a> 
                </span>
                <?php if( has_tag() ){ ?>
                    <span class="tag-links"><i class="fa fa-tag"></i><?php the_tags(' ' , ' , '); ?></span>
                <?php } ?>
            </div>
        </footer>

    </div>
</article>
