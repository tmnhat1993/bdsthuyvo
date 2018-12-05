<?php
global $jwtheme_topclass, $post;
$portfolio = topclass_get_custom_posts("portfolio", 20);

if ($jwtheme_topclass['section_portfolio_display']) { ?>

<section id="works">
    <div class="white-bg works-section">
        <div class="sec-head-container">

            <div class="sec-head-style">
                <h2 class="section-title wow bounceInDown">
                    <?php if (isset($jwtheme_topclass['section_portfolio_title'])) echo $jwtheme_topclass['section_portfolio_title']; ?> 
                </h2><!-- /.section-title -->

                <div class="section-description">
                    <?php if (isset($jwtheme_topclass['section_portfolio_subtitle'])) echo $jwtheme_topclass['section_portfolio_subtitle']; ?>                     
                </div><!-- /.section-description -->
            </div><!-- /.sec-head-style -->
        </div><!-- /.sec-head-container -->

        <div id="works-container" class="clearfix">

            <div class="container">
                <div class="portfolioFilter">
                    <a href="#" data-filter="" class="current">All</a>
                    <?php 
                    $category = get_terms( 'portfolio' );
                    foreach ($category as $cat) { 
                        echo '<a href="#" data-filter=".'.trim($cat->slug).'">'.$cat->name.'</a>';
                    } ?> 
                </div> <!-- /.worksFilter -->



                <div id="works-item" class="works-item">

                    <?php
                    foreach ($portfolio as $post) {
                        setup_postdata($post);
                        $terms = wp_get_post_terms( get_the_ID(), 'portfolio', array("fields" => "all"));  

                        $t = array();                    
                        foreach($terms as $term)
                            $t[] = $term->slug;
                        $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(),array(300,100)) );
                        ?>

                        <figure class="item <?php echo implode(' ', $t); $t = array(); ?>">
                            <img src="<?php echo $url; ?>" alt="<?php echo get_the_title();?>"/>
                            <figcaption>
                                <a href="<?php the_permalink();?>">   
                                    <div class="portfolio-caption">
                                        <span class="protfolio-title"><?php echo get_the_title();?></span>
                                        <span class="protfolio-cat">
                                            <?php 
                                                $ter = wp_get_post_terms( get_the_ID(), 'portfolio', array("fields" => "all"));  
                                                $c = array();
                                                foreach ($ter as $tt )
                                                $c[] = $tt->name;
                                            ?>
                                            <?php echo implode(' , ', $c); $c = array(); ?>
                                        </span>
                                    </div>
                                    <span class="protfolio-icon">
                                        <?php echo jwtheme_topclass_getPostViews(get_the_ID());?> <i class="fa fa-eye"></i>
                                    </span>
                                </a>
                            </figcaption>
                        </figure>
                    
                    <?php } ?>

                </div><!-- /.works-item -->
            </div><!-- /.container -->  
        </div><!-- /#works-container -->

        <div class="container">
            <div class="more-works">
               
            </div><!-- /.load-more -->
        </div><!-- /.container -->

    </div><!-- /.works-section -->
</section><!-- #works -->

<?php } ?>



<?php if ($jwtheme_topclass['section_our_clients']) { ?>
    <section id="our-clients">
        <div class="gray-bg our-clients-section">
            <div class="container">
                <div class="row">

                    <div class="col-md-12">
                        <h3 class="text-center title">  
                            <?php if (isset($jwtheme_topclass['section_our_clients_title'])) echo $jwtheme_topclass['section_our_clients_title']; ?> 
                        </h3>
                    </div><!-- /.col-md-12 -->

                    <div class="col-md-12">
                        <?php
                            if (isset($jwtheme_topclass['section_client_gallery']) && trim($jwtheme_topclass['section_client_gallery']) != "") {
                                $cimages = explode(",", trim($jwtheme_topclass['section_client_gallery']));
                                if (count($cimages) > 0) {
                        ?>

                            <div id="clients-logo-slider" class="owl-carousel owl-theme clients-logo-slider">
                                <?php
                                foreach ($cimages as $aid) {
                                    $logo = wp_get_attachment_image_src($aid, "client-logo");
                                    ?>
                                    <div class="item">
                                        <img src="<?php echo $logo[0]; ?> " alt="clients">
                                    </div> <!-- /.item -->

                                <?php } ?>
                            </div><!-- /#clients-logo-slider -->

                        <?php 
                                } 
                            }
                        ?>

                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.our-clients-section -->
    </section><!-- /#our-clients -->

<?php } ?>



<?php if ($jwtheme_topclass['section_parallax_client_display']) { ?>
    <div id="quote" class="quote-area" style="background:url('<?php echo $jwtheme_topclass['section_parallax_client_bg']['url']; ?>') 50% 0 no-repeat fixed;">
        <div class="quote-section parallax-style">
            <div class="pattern">
                <div class="container">
                    <div class="row">
                        <blockquote>                            
                            <?php if (isset($jwtheme_topclass['section_parallax_client_desc'])) echo $jwtheme_topclass['section_parallax_client_desc']; ?>
                        </blockquote>
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.pattern -->
        </div><!-- /.quote-section -->
    </div><!-- /#quote -->
<?php } ?>

<div class="clear"></div>