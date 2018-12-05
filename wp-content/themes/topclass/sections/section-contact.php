<?php
global $jwtheme_topclass, $post;

if ($jwtheme_topclass['section_contact_display']  && isset( $jwtheme_topclass['section_select_contact_page'] ) ) { ?>

    <!-- Contact Section -->
    <section id="contact">
        <!-- Contact Form-->
        <div id="contact-form-section" class="contact-form-section">
            <div class="white-bg">
                <div class="sec-head-container">
                    <div class="sec-head-style">
                        <h2 class="section-title wow bounceInDown">                            
                            <?php if (isset($jwtheme_topclass['section_contact_title'])) echo $jwtheme_topclass['section_contact_title']; ?>
                        </h2><!-- /.section-title -->

                        <div class="section-description">                        
                            <?php if (isset($jwtheme_topclass['section_contact_subtitle'])) echo $jwtheme_topclass['section_contact_subtitle']; ?>
                        </div><!-- /.section-description -->
                    </div><!-- /.sec-head-style -->
                </div><!-- /.sec-head-container -->
                
                <div class="container">
                    <div class="row">
                        <?php 
                        $con_id = $jwtheme_topclass['section_select_contact_page'];
                        $args = array(
                            "posts_per_page" => 1,
                            "post_type" => 'page',
                            "orderby" => "ID",
                            "p" => $con_id
                            );
                        $contact = get_posts($args);

                        foreach ($contact as $post) {
                            setup_postdata($post);
                            the_content();
                        } ?>
                    </div>
                </div>

            </div><!-- /.white-bg -->
        </div><!-- /#contact-form-section -->


        <?php if ( $jwtheme_topclass['section_contact_display'] && $jwtheme_topclass['section_contact_info_display'] ) { ?>

            <div id="contact-details">
                <div class="gray-bg contact-details">
                    <div class="container">
                        <div class="row">
                            <h3 class="text-center title">                                
                                <?php if (isset($jwtheme_topclass['section_contact_details_title'])) echo $jwtheme_topclass['section_contact_details_title']; ?>
                            </h3>
                            <div class="contact-info">

                                <?php 
                                    if ( $jwtheme_topclass['section_contact_info_icon_text'] && count($jwtheme_topclass['section_contact_info_icon_text']) > 0) {
                                    $i = 0;
                                    foreach ($jwtheme_topclass['section_contact_info_icon_text'] as $counter) {
                                        $cparts = explode(",", $counter);
                                        if (count($cparts) > 1) {
                                            $i++;
                                    ?>                           
                                            <div class="col-md-3 col-sm-6 contact-info-box wow bounceInDown center animated" data-wow-delay=".2s">
                                                <span class="icon map-marker">
                                                    <i aria-hidden="true" class="<?php echo $cparts[0]; ?>"> </i>
                                                </span>
                                                <p class="contact-details-title"> <?php echo $cparts[1]; ?> </p>
                                                <span class="texts"> <?php echo $cparts[2]; ?> </span>
                                            </div>

                                        <?php
                                            }
                                        }
                                    }
                                    ?>

                            </div><!-- /.contact-info -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div><!-- /.gray-bg  /.contact-details -->
            </div><!-- /#contact-details -->

        <?php } ?>

    </section><!-- /#contact -->
<?php } ?>

