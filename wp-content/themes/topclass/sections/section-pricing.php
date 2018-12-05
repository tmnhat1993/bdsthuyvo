<?php
global $jwtheme_topclass, $post;
$pricing = topclass_get_custom_posts("pricing", 20);

if ($jwtheme_topclass['section_pricing_display']) { ?>

    <section id="pricing-table">
        <div class="gray-bg pricing-table-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="text-center title">
                            <?php if (isset($jwtheme_topclass['section_pricing_title'])) echo $jwtheme_topclass['section_pricing_title']; ?> 
                        </h3>
                    </div><!-- /.col-md-12 -->

                    <div id="pricing-table-slider" class="owl-carousel owl-theme clearfix"> 
                        <?php 
                        $i= 0.1;
                        foreach ($pricing as $price) {

                            $price_meta = get_post_meta($price->ID);
                            $is_popular = false;
                            if (isset($price_meta['_jwtheme_pricing_featured'])) $is_popular = $price_meta['_jwtheme_pricing_featured'][0];
                            $mpclass = "";
                            if ($is_popular) $mpclass = "popular";
                        ?>

                            <div class="item col-md-12">
                                <div class="pricing-table wow <?php echo $price_meta['_jwtheme_pricing_animation'][0]; ?> <?php echo $price_meta['_jwtheme_pricing_bg_color'][0]; ?>" data-wow-delay="<?php echo "$i";?>s">
                                    <div class="table-head">
                                        <p class="package-name"> 
                                            <?php echo $price->post_title; ?>
                                        </p>
                                        <p class="package-price">
                                            <span class="currency"> <?php echo $price_meta['_jwtheme_pricing_currency'][0]; ?> </span>
                                            <span class="price"> <?php echo $price_meta['_jwtheme_pricing_price'][0]; ?> </span>
                                            <span class="price-decimal"> <?php echo $price_meta['_jwtheme_pricing_price_fraction'][0]; ?> </span>                                                    
                                            <span class="duration">/<?php echo $price_meta['_jwtheme_pricing_price_dur'][0]; ?></span>
                                        </p>
                                    </div><!-- /.table-head -->
                                    <ul class="package-description">
                                       <?php
                                           $elements = $price_meta['_jwtheme_pricing_elements'][0];
                                           $el_parts = explode("\n", $elements);
                                           foreach ($el_parts as $el) {
                                                $el = do_shortcode($el);
                                                echo "<li>{$el}</li>";
                                            }
                                        ?>
                                    </ul><!-- /.package-description -->
                                    <div class="package-footer">
                                        <a href="<?php echo $price_meta['_jwtheme_pricing_button_link'][0]; ?>" class="btn btn-xs btn-default btn-effect"> <?php echo $price_meta['_jwtheme_pricing_button'][0]; ?> </a>
                                    </div>
                                </div><!-- /.pricing-table -->
                            </div><!-- /.col-md-12 -->

                        <?php 

                        $i = $i + 0.1;

                        } ?>



                    </div><!-- /#pricing-table-slider -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.pricing-table-section -->
    </section><!-- /#pricing-table -->

<?php } ?>

<div class="clear"></div>