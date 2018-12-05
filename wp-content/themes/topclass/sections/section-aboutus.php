<?php
global $jwtheme_topclass, $post;
?>

<section id="about">
    <?php if ($jwtheme_topclass['section_aboutus_display']) { ?>
    
        <div class="white-bg about-us-section">
            <div class="sec-head-container">
                <div class="sec-head-style">
                    <h2 class="section-title wow bounceInDown">
                        <?php if (isset($jwtheme_topclass['section_aboutus_title'])) echo $jwtheme_topclass['section_aboutus_title']; ?>
                    </h2><!-- /.section-title -->

                    <div class="section-description">
                        <?php if (isset($jwtheme_topclass['section_aboutus_subtitle'])) echo $jwtheme_topclass['section_aboutus_subtitle']; ?>
                    </div><!-- /.section-description -->
                </div><!-- /.sec-head-style -->
            </div><!-- /.sec-head-container -->

            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="about-us-thumb">
                            <img src="<?php echo $jwtheme_topclass['section_aboutus_image']['url']; ?>" alt="About Us Image">
                        </div><!-- /.about-us-thumb -->
                    </div><!-- /.col-md-6 -->

                    <div class="col-md-6">
                        <h3 class="content-title">
                         <?php if (isset($jwtheme_topclass['section_aboutus_posttitle'])) echo $jwtheme_topclass['section_aboutus_posttitle']; ?>
                     </h3>
                     <?php if (isset($jwtheme_topclass['section_aboutus_text'])) echo $jwtheme_topclass['section_aboutus_text']; ?>
                 </div><!-- /.col-md-6 -->

             </div><!-- /.row -->
         </div><!-- /.container -->

     </div><!-- /.about-us-section -->
     <?php } ?>

    <?php if ($jwtheme_topclass['section_show_counter_display']) { ?>
        <div class="gray-bg over-view">
            <div class="container">
                <div class="row">

                    <?php 
                        if (isset($jwtheme_topclass['section_show_counter_display']) && count($jwtheme_topclass['section_about_us_review_counter'])) {
                        $i = 0;
                        foreach ($jwtheme_topclass['section_about_us_review_counter'] as $counter) {
                        $cparts = explode(",", $counter);
                        if (count($cparts) > 1) {
                            $i++;
                    ?>

                        <div class="col-md-3 col-sm-6">
                            <div class="over-view-circle wow bounceInUp  center animated" data-wow-delay=".4s">
                                <span class="value counter"><?php echo $cparts[0]; ?></span>
                                <span class="cat-name"><?php echo $cparts[1]; ?></span>  
                            </div>
                        </div>

                    <?php
                                }
                            }
                        }
                    ?>
                
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.over-view -->
    <?php } ?>

    </section><!-- #about -->
    <!-- About Us Section End-->



<?php if ($jwtheme_topclass['section_video_parallax_display']) { ?>
    <section id="video-section" style="background: url('<?php echo $jwtheme_topclass['section_video_bg_image']['url'];?>')  50% 0 no-repeat fixed;">
        <div class="video-section parallax-style">
            <div class="pattern">
                <h3 class="video-title"><?php echo $jwtheme_topclass['section_video_title'];?></h3>
                <p class="play-video"> 
                    <a href="<?php echo $jwtheme_topclass['section_video_url'];?>" data-gallery="videos" class="boxer button small play-btn wow rollIn animated" title="Our Video">
                        <img class="play-now" src="<?php echo $jwtheme_topclass['section_video_image']['url'];?>" data-gallery="videos" alt="<?php echo $jwtheme_topclass['section_video_title'];?>">
                    </a>  
                </p>
                <h3 class="video-title">Learn More</h3>
            </div>
        </div>
        <div class="video-box" id="video-box"></div>
    </section>
<?php } ?>


