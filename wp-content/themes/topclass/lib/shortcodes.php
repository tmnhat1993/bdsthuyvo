<?php
global $jwtheme_topclass, $post;

//Slider Shortcode
add_shortcode( 'slider', 'jw_slider_shortcode');


function jw_slider_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array(
      'slidesno'  => '',
      'content'  => ''
      ), $atts);

  extract($atts);

  ob_start();
?>
  <section id="top-section" style="background: url('<?php echo $jwtheme_topclass['section_slider_bg_image']['url'];?>')  50% 0 no-repeat fixed;">
        <div class="top-section parallax-style">
            <div id="top-carousel" class="carousel slide top-carousel-container" data-ride="carousel">
                
               
                <ol class="carousel-indicators">
                    <?php for($i = 0; $i<$slidesno; $i++){ ?>
                        <li data-target="#top-carousel" data-slide-to="<?php echo $i;?>" class="<?php echo ( ($i == 0) ? "active" : "" );?>"></li>
                    <?php } ?>                    
                </ol>

                <div class="carousel-inner">

                    <?php 
                    $slider = topclass_get_custom_posts( "slider", 5 );
                    foreach ($slider as $key =>$post) {
                        setup_postdata($post);

                        $heading1 = get_post_meta( $post->ID,'_jwtheme_heading1',true );
                        $heading1_anim = get_post_meta( $post->ID,'_jwtheme_heading1_anim',true );

                        $heading2 = get_post_meta( $post->ID,'_jwtheme_heading2',true );
                        $heading2_anim = get_post_meta( $post->ID,'_jwtheme_heading2_anim',true );

                        $heading3 = get_post_meta( $post->ID,'_jwtheme_heading3',true );
                        $heading3_anim = get_post_meta( $post->ID,'_jwtheme_heading3_anim',true );

                        $slider_more_text = get_post_meta( $post->ID,'_jwtheme_slider_more_text',true );
                        $slider_text_url = get_post_meta( $post->ID,'_jwtheme_slider_text_url',true );

                    ?>
                        <div class="item <?php echo ( ($key == 0) ? "active" : "" );?>">
                            <div class="top-headings">

                                <h2 class="top-heading-1 wow <?php echo $heading1_anim;?> <?php echo ( ($key == 0) ? "" : "center animated" );?>">                                
                                    <?php echo $heading1; ?>
                                </h2>

                                <h3 class="top-heading-2 wow <?php echo $heading2_anim;?> <?php echo ( ($key == 0) ? "" : "center animated" );?>">                                
                                    <?php echo $heading2; ?>
                                </h3>

                                <h3 class="top-heading-3 wow <?php echo $heading3_anim;?> <?php echo ( ($key == 0) ? "" : "center animated" );?>">
                                    <?php echo $heading3; ?>
                                </h3>

                            </div><!-- /.top-headings -->
                            
                            <?php if ( $slider_more_text ){ ?>
                                <div class="button-container"> 
                                     <a class="btn btn-sm btn-default btn-effect" href="<?php echo $slider_text_url;?>"><?php echo $slider_more_text;?></a>
                                </div>
                            <?php } ?>

                        </div><!-- /.item -->

                   <?php } ?> 

                </div><!-- /.carousel-inner -->
                
                

                <a class="slide-nav left" href="#top-carousel" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                <a class="slide-nav right" href="#top-carousel" data-slide="next"><i class="fa fa-chevron-right"></i></a>
            </div><!-- /#top-carousel /.top-carousel-container -->

            <div class="next-section">
                <button id="go-to-next" class="btn"><i class="fa fa-angle-double-down"></i></button>
            </div>

        </div><!-- /.top-section -->    
    </section><!-- /#top-section -->

<?php
$output = ob_get_clean();
  return do_shortcode($output);
}



//Portfolio Shortcode
add_shortcode( 'portfolio', 'jw_portfolio_shortcode');


function jw_portfolio_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('content'  => ''), $atts);

  extract($atts);

  ob_start();

  global $jwtheme_topclass, $post;
  $portfolio = topclass_get_custom_posts("portfolio", 20);
?>
  <section id="works">
    <div class="white-bg works-section">
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
<?php
$output = ob_get_clean();
  return do_shortcode($output);
}



//pricing Shortcode
add_shortcode( 'pricing', 'jw_pricing_shortcode');

function jw_pricing_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('content'  => ''), $atts);

  extract($atts);

  ob_start();

  global $jwtheme_topclass, $post;
  $pricing = topclass_get_custom_posts("pricing", 20);
?>
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
<?php
$output = ob_get_clean();
  return do_shortcode($output);
}



//team Shortcode
add_shortcode( 'team', 'jw_team_shortcode');


function jw_team_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('content'  => ''), $atts);

  extract($atts);

  ob_start();

  global $jwtheme_topclass, $post;
  $team = topclass_get_custom_posts("team", 20);
?>
  <section id="team">
        <div class="white-bg team-section">
            <div class="container">
                <div id="team-member-slider" class="team-member-slider owl-carousel owl-theme">

                  <?php 
                  $i= 0.1;
                    foreach ($team as $key =>$post) {
                        setup_postdata($post);

                        $team_member_name = get_post_meta( $post->ID,'_jwtheme_team_member_name',true );
                        $team_member_designation = get_post_meta( $post->ID,'_jwtheme_team_member_designation',true );
                        $team_desc = get_post_meta( $post->ID,'_jwtheme_team_desc',true );
                        $team_animation = get_post_meta( $post->ID,'_jwtheme_team_animation',true );

                    ?>
                    <div class="col-md-3">
                        <div class="item">
                            <div class="member-container wow <?php echo $team_animation;?>" data-wow-delay="<?php echo "$i";?>s">
                                <div class="inner-container">
                                    
                                    <?php if ( has_post_thumbnail() ) { 
                                      the_post_thumbnail('team-thumb');
                                    } ?>

                                    <div class="member-details">
                                        <h4 class="name">
                                            <?php echo $team_member_name; ?>
                                        </h4>
                                        <p class="designation">
                                            <?php echo $team_member_designation; ?>
                                        </p>
                                        <p>
                                            <?php echo $team_desc; ?>
                                        </p>
                                        <div class="member-social-link">
                                            <?php 
                                            $social_twitter = get_post_meta( $post->ID,'_jwtheme_social_twitter',true );
                                            $social_facebook = get_post_meta( $post->ID,'_jwtheme_social_facebook',true );
                                            $social_dribbble = get_post_meta( $post->ID,'_jwtheme_social_dribbble',true );
                                            $social_google_plus = get_post_meta( $post->ID,'_jwtheme_social_google_plus',true );
                                            $social_linkedin = get_post_meta( $post->ID,'_jwtheme_social_linkedin',true );

                                            if ( $social_twitter != '' ) {
                                              echo '<a href="' . esc_url($social_twitter) . '" class="twitter-btn"><i class="fa fa-twitter"></i></a>';
                                            }

                                          if ( $social_facebook != '' ) {
                                              echo '<a href="' . esc_url($social_facebook) . '" class="facebook-btn"><i class="fa fa-facebook"></i></a>';
                                            }

                                            if ( $social_dribbble != '' ) {
                                              echo '<a href="' . esc_url($social_dribbble) . '" class="dribbble-btn"><i class="fa fa-dribbble"></i></a>';
                                            }

                                            if ( $social_google_plus != '' ) {
                                              echo '<a href="' . esc_url($social_google_plus) . '" class="google-plus-btn"><i class="fa fa-google-plus"></i></a>';
                                              
                                            }  

                                            if ( $social_linkedin != '' ) {
                                              echo '<a href="' . esc_url($social_linkedin) . '" class="linkedin-btn"><i class="fa fa-linkedin"></i></a>';
                                            }
                                            ?>
                                        </div>
                                    </div><!-- /.member-details -->
                                </div><!-- /.inner-container -->
                            </div><!-- /.member-container -->
                        </div><!-- /.item -->
                    </div>

                <?php 
                  $i = $i + 0.1;
                } ?>                   

                </div><!-- /.team-member-slider -->
            </div><!-- /.container -->
        </div><!-- /.team-section -->
    </section><!-- #team -->
<?php
$output = ob_get_clean();
  return do_shortcode($output);
}



//team Shortcode
add_shortcode( 'testimonial', 'jw_testimonial_shortcode');

function jw_testimonial_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('content'  => ''), $atts);

  extract($atts);

  ob_start();

  global $jwtheme_topclass, $post;
?>
  <section id="testimonial" style="background: url('<?php echo $jwtheme_topclass['section_testimonial_bg_image']['url'];?>')  50% 0 no-repeat fixed;">
        <div class="parallax-style testimonial-section">
            <div class="pattern">

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
<?php
$output = ob_get_clean();
  return do_shortcode($output);
}


//service Shortcode
add_shortcode( 'service', 'jw_service_shortcode');

function jw_service_shortcode( $atts, $content= null ){

  $atts = shortcode_atts(
    array('content'  => ''), $atts);

  extract($atts);

  ob_start();

  global $jwtheme_topclass, $post;
?>
  <section id="we-do">
    <div class="white-bg we-do-section">
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

                        <li class="item col-md-3 col-sm-6">
                            <div class="service-icon">
                                <span aria-hidden="true" class="<?php echo $service_icon;?>"></span>
                            </div><!-- /.service-icon -->
                            <p class="item-title">
                                <?php echo $service_title;?>
                            </p><!-- /.item-title -->
                            <p class="item-description">
                                <?php echo $service_desc;?>
                            </p><!-- /.item-description -->
                        </li><!-- /.item -->
                        
                    <?php } ?>

                </ul><!-- /.service-container -->           
            </div><!-- /.service -->            
        </div><!-- /.container -->
    </div><!-- /.we-do-section -->
</section> <!-- /#service -->
<?php
$output = ob_get_clean();
  return do_shortcode($output);
}
?>