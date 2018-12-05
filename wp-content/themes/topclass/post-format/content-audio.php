<?php
/**
 * @package JW Theme
 */
?>


<article class="post post-<?php the_ID(); ?>">

    <?php $chat_text = rwmb_meta( '_jwtheme_audio_code' ); 
    if($chat_text != ''){?>
        <div class="entry-jwtheme_audio_code">
            <?php echo $chat_text; ?>
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
