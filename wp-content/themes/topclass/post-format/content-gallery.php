<?php
/**
 * @package JW Theme
 */
?>


<article class="post post-<?php the_ID(); ?>">
    
    <?php $slides = rwmb_meta('_jwtheme_gallery_images','type=image_advanced'); ?>
    <?php $count = count($slides); ?>
    <?php if($count > 0){ ?>
        <div id="blog-gallery" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                $slide_indicator = 0;
                ?>
                <?php foreach( $slides as $slide_ind ): ?>
                    <li data-target="#blog-gallery" data-slide-to="<?php echo $slide_indicator; ?>" class="<?php if($slide_indicator == 0){ echo 'active'; }; ?>"></li>
                    <?php $slide_indicator++ ?>
                <?php endforeach; ?>
            </ol>

            <div class="carousel-inner">
                <?php $slide_no = 0; ?>
                <?php foreach( $slides as $slide ): ?>
                    <div class="item <?php if($slide_no == 0){ echo 'active'; }; ?>">
                        <?php $images = wp_get_attachment_image_src( $slide['ID'], 'gallery-thumb' ); ?>
                        <img src="<?php echo $images[0]; ?>" alt="">
                    </div>
                    <?php $slide_no++ ?>
                <?php endforeach; ?>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#blog-gallery" data-slide="prev"><i class="fa fa-angle-left"></i></a>
            <a class="right carousel-control" href="#blog-gallery" data-slide="next"><i class="fa fa-angle-right"></i></a>

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
