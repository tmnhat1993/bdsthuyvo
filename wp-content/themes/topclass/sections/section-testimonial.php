<?php
global $jwtheme_topclass, $post;

if ($jwtheme_topclass['section_testimonial_display'] && isset($jwtheme_topclass['section_testimonial_page']) ) { ?>

    <section id="testimonial" style="background: url('<?php echo $jwtheme_topclass['section_testimonial_bg_image']['url'];?>')  50% 0 no-repeat fixed;">
        <div class="parallax-style testimonial-section">
            <div class="pattern">
                
                <h3 class="text-center title">
                    <?php if (isset($jwtheme_topclass['section_testimonial_title'])) echo $jwtheme_topclass['section_testimonial_title']; ?>
                </h3>
                
                <div class="content_slider_wrapper testimonial-slider" id="testimonial-slider">
                <?php 

                $ids = $jwtheme_topclass['section_testimonial_page'];
                $args = array(
                    "posts_per_page" => 1,
                    "post_type" => 'page',
                    "orderby" => "ID",
                    "p" => $ids
                    );
                $testimonial = get_posts($args);

                    foreach ($testimonial as $post) {
                        setup_postdata($post);
                            the_content();
                    }
                ?>
                
                </div>
            </div>
        </div>
    </section>

<?php } ?>