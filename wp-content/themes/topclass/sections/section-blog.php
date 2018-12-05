<?php
global $jwtheme_topclass;
$posts = topclass_get_custom_posts("post", 3);

$username = $jwtheme_topclass['section_twitter_username'];
$twitter_consumer_key = $jwtheme_topclass['section_twitter_consumer_key'];
$consumer_secret = $jwtheme_topclass['section_twitter_consumer_secret'];
$access_token = $jwtheme_topclass['section_twitter_access_token'];
$oauth_access_token_secret = $jwtheme_topclass['section_twitter_oauth_access_token_secret'];
// Twitter API Settings
$settings = array(
    'oauth_access_token' => "$access_token",
    'oauth_access_token_secret' => "$oauth_access_token_secret",
    'consumer_key' => "$twitter_consumer_key",
    'consumer_secret' => "$consumer_secret"
);

$url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

$getfield = "?screen_name=$username"; // Change it

$requestMethod = 'GET';

$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
                    ->buildOauth($url, $requestMethod)
                    ->performRequest();
                    
//var_dump(json_decode($response)); /* Here you will get all info from user timeline */

$valid_data = json_decode($response); //JSON data to PHP.
?>


<?php if ($jwtheme_topclass['section_blog_display']) { ?>
    <section id="blog">
        <div class="white-bg blog-section">
            <div class="sec-head-container">

                <div class="sec-head-style">
                    <h2 class="section-title wow bounceInDown">
                        <?php if (isset($jwtheme_topclass['section_blog_title'])) echo $jwtheme_topclass['section_blog_title']; ?>
                    </h2><!-- /.section-title -->

                    <div class="section-description">
                        <?php if (isset($jwtheme_topclass['section_blog_subtitle'])) echo $jwtheme_topclass['section_blog_subtitle']; ?>
                    </div><!-- /.section-description -->
                </div><!-- /.sec-head-style -->
            </div><!-- /.sec-head-container -->

            <div class="container">
                <div class="row">
                    <div id="blog-post-slider" class="owl-carousel owl-theme">

                        <?php
                        $i= 0.1;
                        foreach ($posts as $post) {
                            setup_postdata($post);
                            $meta = get_post_meta($post->ID);                           
                            ?>
                                <div class="item col-md-12">
                                    <article class="post-content wow bounceInUp" data-wow-delay="<?php echo "$i";?>s">

                                        <?php if ( has_post_thumbnail() ) { ?>
                                            <div class="eatured-img">
                                                <?php the_post_thumbnail('blog-thumb'); ?>
                                            </div>
                                        <?php } ?>

                                        <div class="post-container">
                                            <h2 class="post-title">
                                                <a href="<?php the_permalink();?>">
                                                    <?php the_title();?>
                                                </a>
                                            </h2><!-- /.post-title -->
                                            <p class="post-description">
                                                <?php echo wp_trim_words( get_the_content(), 25, ' '  ); ?>
                                            </p>
                                            <div class="post-meta">
                                                <div class="continue-reading pull-left">
                                                    <a href="<?php the_permalink();?>">Continue reading...</a>
                                                </div><!-- /.continue-reading -->
                                                <div class="entry-meta pull-right">
                                                    <span class="entry-date">
                                                        <i class="fa fa-clock-o"></i>
                                                        <?php //the_time('F j'); ?>
                                                        <?php echo get_the_date('F j');?>
                                                    </span>
                                                    <span class="comments-link">
                                                        <a href="<?php comments_link(); ?>"> 
                                                            <i class="fa fa-comment-o"></i> <?php comments_number( '0', '1', '%' ); ?>
                                                        </a>
                                                    </span>
                                                </div><!-- /.entry-meta -->
                                            </div><!-- /.post-meta -->
                                        </div><!-- /.post-container -->
                                    </article><!-- /.post-content -->
                                </div><!-- /.item -->
                        <?php 
                                $i = $i + 0.1;
                            } 
                        ?>

                        
                    </div><!-- /#blog-post-slider -->
                </div><!-- /.row -->
            </div><!-- /.container -->
            <div class="button-container">
                <a href="<?php echo topclass_get_blog_link();?>" class="btn btn-sm btn-default btn-effect">
                    <?php if (isset($jwtheme_topclass['section_blog_view_all_posts'])) echo $jwtheme_topclass['section_blog_view_all_posts']; ?>
                </a>
            </div>
        </div><!-- /.blog-section -->
    </section><!-- #blog -->
<?php } ?>

<?php if ($jwtheme_topclass['section_twitter_display']) { ?>
    <div id="tweet">
        <div class="gray-bg tweet-section">
            <div class="container">
                <div id="tweet-slider" class="carousel slide tweet-slider" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        foreach ($valid_data as $key=>$value) { ?>

                            <div class="item <?php echo ( ($key == 0) ? "active" : "" );?>">
                                <div class="tweet-details">
                                    <div class="tweet-icon">
                                        <i class="fa fa-twitter"></i>
                                    </div><!-- /.tweet-icon -->
                                    <p class="tweet-description">
                                        <a href="https://twitter.com/<?php echo $value->user->screen_name;?>">@<?php echo $value->user->screen_name;?></a> <br>
                                        <?php echo $value->text;?>
                                    </p><!-- /.tweet-description -->
                                </div><!-- /.tweet-icon -->
                            </div><!-- /.item -->

                        <?php } ?>

                    </div><!-- /.carousel-inner -->
                    <a class="slide-nav left" href="#tweet-slider" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
                    <a class="slide-nav right" href="#tweet-slider" data-slide="next"><i class="fa fa-chevron-right"></i></a>
                </div><!-- /#tweet-slider -->
            </div><!-- /.container -->
        </div><!-- /.tweet-section -->
    </div><!-- /#tweet -->
<?php } ?>



<?php if ($jwtheme_topclass['section_subscribe_display']) { ?>
<section id="subscribe" style="background: url('<?php echo $jwtheme_topclass['section_subscribe_bg']['url'];?>')  50% 0 no-repeat fixed;">
    <div class="subscribe-section parallax-style">
        <div class="pattern">
            <div class="container"> 
                <div class="subscribe-details">
                    <h3 class="text-center plx-section-title">
                        <?php if (isset($jwtheme_topclass['section_subscribe_title'])) echo $jwtheme_topclass['section_subscribe_title']; ?>
                    </h3>
                    <p class="text-center subscribe-description">
                        <?php if (isset($jwtheme_topclass['section_subscribe_subtitle'])) echo $jwtheme_topclass['section_subscribe_subtitle']; ?>                        
                    </p><!-- /.subscribe-description -->

                    <?php 

                     $blog_id = $jwtheme_topclass['section_select_subscribe_page'];
                        $args = array(
                            "posts_per_page" => 1,
                            "post_type" => 'page',
                            "orderby" => "ID",
                            "p" => $blog_id
                            );
                    $subscribe = get_posts($args);

                    foreach ($subscribe as $post) {
                        setup_postdata($post);
                        the_content();
                    } ?>

                </div><!-- /.subscribe-details --> 
            </div><!-- /.container -->
        </div><!-- /.pattern -->
    </div><!-- /.subscribe-section -->
</section><!-- /#subscribe -->
<?php } ?>