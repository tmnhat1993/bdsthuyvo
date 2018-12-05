<?php
/**
 * The Header for our theme.
 *
 * @package Top Class
 */

global $jwtheme_topclass, $post;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
    <!-- favicon --> 
	<?php echo jwtheme_favicon();?>
    <?php wp_head(); ?>
    
</head>

<?php if (isset($jwtheme_topclass['custom_css'])) echo $jwtheme_topclass['custom_css']; ?>
<body <?php body_class(); ?>>

<div id="page-top"></div>





<?php
$slider = topclass_get_custom_posts( "slider", 5 );

if ( $jwtheme_topclass['section_topclass_slider_display'] ) { ?>
    
    <section id="top-section" style="background: url('<?php echo $jwtheme_topclass['section_slider_bg_image']['url'];?>')  50% 0 no-repeat fixed;">
        <div class="top-section parallax-style">
            <div id="top-carousel" class="carousel slide top-carousel-container" data-ride="carousel">
                
               
                <ol class="carousel-indicators">
                    <?php for($i = 0; $i<count($slider); $i++){ ?>
                        <li data-target="#top-carousel" data-slide-to="<?php echo $i;?>" class="<?php echo ( ($i == 0) ? "active" : "" );?>"></li>
                    <?php } ?>                    
                </ol>

                <div class="carousel-inner">

                    <?php 
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

<?php } ?>

<?php


if ( $jwtheme_topclass['section_revolution_slider_display'] ) { 


$rev_slider_alias = $jwtheme_topclass['section_slider_alias'];

    putRevSlider("$rev_slider_alias");

} ?>





    <!-- Menu -->
    <div class="main-menu-continer">
        <div id="main-menu" class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <!-- Responsive Navigation -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <i class="fa fa-bars"></i>
                    </button> <!-- /.navbar-toggle -->
                    <!-- Logo -->
                    <a class="navbar-brand" href="./">
                        <?php
                            if ( $jwtheme_topclass['section_header_logo_image'] ) { ?>
                                <img src="<?php echo $jwtheme_topclass['section_header_nav_logo']['url']; ?>" title="<?php echo get_bloginfo('name');?>">
                            <?php } else if ( $jwtheme_topclass['section_header_logo_text'] ) {
                               echo  $jwtheme_topclass['logo_text'];
                            } ?>
                    </a><!-- /.navbar-brand -->
                </div> <!-- /.navbar-header -->

                      <?php if (!has_nav_menu("primary")) { ?>
                          <nav class="collapse navbar-collapse" role="navigation">
                            
                            <ul id="headernavigation" class="nav navbar-nav pull-right">
                                <li class="active"><a href="#page-top">Home</a></li>
                                <?php
                                    $sections = $jwtheme_topclass['jwtheme_sections_order'];
                                    if (!is_array($sections)) {
                                        $sections = jwtheme_get_enabled_sections();
                                    }
                                    if (empty($sections)) {
                                        $sections = jwtheme_get_all_sections();
                                    }
                                    $section_ids = array(
                                       "section_aboutus" => "#about",
                                       "section_team" => "#team",
                                       "section_services" => "#we-do",
                                       "section_pricing" => "#pricing-table",
                                       "section_testimonial" => "#testimonial",
                                       "section_portfolio" => "#works",
                                       "section_blog" => "#blog",                                       
                                       "section_contact" => "#contact"
                                       );
                                    foreach ($sections as $section => $name) {
                                        $ssection = str_replace("section-", "section_", $section);
                                        if($ssection=="section_services")
                                            $menu_key = "section_service_menu_text";
                                        else
                                            $menu_key = "{$ssection}_menu_text";
                                        if ($ssection !== "section_parallax") {
                                            $section_id = $section_ids[$ssection];
                                            ?>
                                            <?php if ($jwtheme_topclass["{$ssection}_display_menu"]) { ?>
                                            <li>
                                                <a href="<?php echo $section_id; ?>"><?php echo $jwtheme_topclass[$menu_key]; ?></a>
                                            </li>
                                            <?php
                                            }
                                        }
                                    }
                                ?>


                            </ul> <!-- /.nav .navbar-nav -->
                        </nav> <!-- /.navbar-collapse  -->
                    <?php } else { ?>

                    <nav class="collapse navbar-collapse" role="navigation">
                        <!-- Main navigation -->
                            <?php
                            $defaults = array(
                                'theme_location' => 'primary',
                                'menu' => 'Primary Menu',
                                'container' => "div",
                                'container_class' => 'nav navbar-nav not-js pull-right',
                                'container_id' => false,
                                'menu_class' => 'nav navbar-nav not-js pull-right',
                                'menu_id' => 'headernavigation',
                                'echo' => false,
                                'fallback_cb' => 'wp_page_menu',
                                'before' => '',
                                'after' => '',
                                'link_before' => '',
                                'link_after' => '',
                                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'depth' => 0,
                                'walker' => ''                               
                            );

                            $menu = wp_nav_menu($defaults);
                            $menu = str_replace('<div class="nav navbar-nav not-js pull-right">', "", $menu);
                            $menu = str_replace('<div class="nav navbar-nav not-js pull-right">', "", $menu);
                            $menu = str_replace("</div>", "", $menu);
                            $menu = str_replace("<ul>", '<ul class="nav navbar-nav not-js pull-right">', $menu);
                            echo $menu;

                             ?>                         
                    </nav> <!-- /.navbar-collapse  -->

                <?php } ?>
                         


            </div> <!-- /.container -->
        </div><!-- /#main-menu -->
    </div><!-- /.main-menu-continer -->
    <!-- Menu End -->


