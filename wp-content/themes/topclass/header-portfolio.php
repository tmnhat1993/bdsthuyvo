<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Top Class
 */

global $jwtheme_topclass;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<?php echo jwtheme_favicon();?>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<div id="page-top"></div>

	<div id="page" class="hfeed site">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'jwtheme' ); ?></a>

		<header id="masthead" class="site-header main-menu-continer" role="banner">

			<div id="main-menu" class="navbar navbar-default">
				<div class="container">

					<div class="navbar-header ">
						<!-- responsive navigation -->
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<i class="fa fa-bars"></i>
						</button> <!-- /.navbar-toggle -->
						<!-- Logo -->
						<a class="navbar-brand" href="<?php echo site_url();?>">
                        <?php
                            if ( $jwtheme_topclass['section_header_logo_image'] ) { ?>
                            <img src="<?php echo $jwtheme_topclass['section_header_nav_logo']['url']; ?>" title="<?php echo get_bloginfo('name');?>">
                            <?php } else if ( $jwtheme_topclass['section_header_logo_text'] ) {
                               echo  $jwtheme_topclass['logo_text'];
                            } ?>
                    	</a><!-- /.navbar-brand -->
					</div> <!-- /.navbar-header -->


					<nav class="collapse navbar-collapse" role="navigation">

						<!-- Main navigation -->					
						<div class="collapse navbar-collapse not-js clearfix" id="headernavigation">
							<?php
							$defaults = array(
								'theme_location' => 'secondary',
								'menu' => 'Blog Menu',
								'container' => "div",
								'container_class' => 'nav navbar-nav not-js pull-right',
								'container_id' => false,
								'menu_class' => 'nav navbar-nav pull-right',
								'menu_id' => false,
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
						</div> 

					</nav> 


				</div> 
			</div><!-- /#main-menu -->
		</header><!-- #masthead -->


		<div id="page-name-sec" style="background: url('<?php echo $jwtheme_topclass['settings_portfolio_parallax_image']['url'];?>')  50% 0 no-repeat fixed;">
			<div class="parallax-style page-name-sec">
				<div class="pattern">
					<div class="container">
						<p class="page-name">
							Portfolio Details
						</p><!-- /.page-name -->
						<p class="page-location">
							<a href="<?php echo site_url(); ?>">Home</a> Portfolio Details
						</p><!-- /.page-location -->
					</div><!-- /.container -->
				</div><!-- /.pattern -->
			</div><!-- /.parallax-style  /.page-name-sec-->
		</div><!-- #page-name-sec -->

<div <?php body_class(); ?>>