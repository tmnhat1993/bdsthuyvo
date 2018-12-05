<?php
global $jwtheme_topclass, $post;
$service = topclass_get_custom_posts("service", 20);

if ($jwtheme_topclass['section_services_display']) { ?>

<section id="we-do">
    <div class="white-bg we-do-section">
        <div class="sec-head-container">

            <div class="sec-head-style">
                <h2 class="section-title wow bounceInDown">
                    <?php if (isset($jwtheme_topclass['section_service_title'])) echo $jwtheme_topclass['section_service_title']; ?>
                </h2><!-- /.section-title -->

                <div class="section-description">
                    <?php if (isset($jwtheme_topclass['section_service_subtitle'])) echo $jwtheme_topclass['section_service_subtitle']; ?>
                </div><!-- /.section-description -->
            </div><!-- /.sec-head-style -->
        </div><!-- /.sec-head-container -->

        <div class="container">             
            <div class="services"> 
                <ul class="service-container">
                    <?php 
                    foreach ($service as $key =>$post) {
                        setup_postdata($post);

                        $service_title = get_post_meta( $post->ID,'_jwtheme_service_title',true );
                        $service_desc = get_post_meta( $post->ID,'_jwtheme_service_desc',true );
                        $service_icon = get_post_meta( $post->ID,'_jwtheme_service_icon',true );
                    ?>
                    
                        <a href="<?php the_permalink();?>" >
                            <li class="item col-md-3 col-sm-6">
                                <div class="service-icon">                                     
                                        <i class="fa <?php echo $service_icon;?>"></i>                           
                                </div><!-- /.service-icon -->
                                <p class="item-title">
                                    <?php echo $service_title;?>
                                </p><!-- /.item-title -->
                                <p class="item-description">
                                    <?php echo $service_desc;?>
                                </p><!-- /.item-description -->
                            </li><!-- /.item -->
                        </a>
                        
                    <?php } ?>

                </ul><!-- /.service-container -->           
            </div><!-- /.service -->            
        </div><!-- /.container -->
    </div><!-- /.we-do-section -->
</section> <!-- /#service -->
<?php } ?>