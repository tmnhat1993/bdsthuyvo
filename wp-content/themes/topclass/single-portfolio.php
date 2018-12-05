<?php
/**
 * The template for displaying all single posts.
 *
 * @package Top Class
 */

get_header('portfolio'); 

jwtheme_topclass_setPostViews(get_the_ID());

global $jwtheme_topclass, $post;

?>
<div class="main-content">
	<div id="portfolio-page" class="portfolio-page">
		<div class="container">
			<div class="row">
				<div id="portfolio-container">

					<?php if ( have_posts() ) { while ( have_posts() ) { the_post(); ?>

					<?php $portfolio = rwmb_meta('_jwtheme_portfolio_images','type=image_advanced'); ?>
					<?php $count = count($portfolio); ?>
    				<?php if($count > 0){ ?>

						<div id="portfolio-section" class="col-md-8">
							<!-- Portfolio Section Slider -->
							<div id="portfolio-section-slider" class="portfolio-slider-wraper carousel slide" data-ride="carousel">
								
								<ol class="carousel-indicators">

									<?php
										$portfolio_indicator = 0;
										foreach( $portfolio as $portfolio_ind ): 
									?>
										<li data-target="#portfolio-section-slider" data-slide-to="<?php echo $portfolio_indicator; ?>" class="<?php if($portfolio_indicator == 0){ echo 'active'; }; ?>"></li>
									<?php 
										$portfolio_indicator++;
										endforeach; 
									?>

								</ol>
								<!-- Carousel items -->
								<div class="carousel-inner">

									<?php $portfolio_no = 0; ?>
									<?php foreach( $portfolio as $pp ): ?>
										<div class="item <?php if($portfolio_no == 0){ echo 'active'; }; ?>">
											<div id="slide-item-<?php echo $portfolio_no;?>" class="portfolio-slider-bg  slide-element">
												<div class="bg-pattern portfolio-slider-bg">
													<div class="light-dark-transparent-bg portfolio-slider-bg">
														<div class="slider-content">
															<figure>
																<?php $images = wp_get_attachment_image_src( $pp['ID'], 'portfolio-gallery' ); ?>
																<img src="<?php echo $images[0]; ?>" alt="<?php the_title();?>">
															</figure>	
														</div><!-- /.slider-content -->
													</div><!-- /.light-dark-transparent-bg -->
												</div><!-- /.bg-pattern  -->
											</div><!-- /.portfolio-slider-bg --> 
										</div><!--/.active /.item -->
									<?php $portfolio_no++ ?>
									<?php endforeach; ?>


								</div><!-- /.carousel-inner -->	

							</div><!-- /#portfolio-section-slider -->
						</div><!-- /#portfolio-section -->
					<?php } ?>

						<div id="portfolio-sidebar" class="side-bar col-md-4">
							<aside class="widget text-widget">
								<h3 class="widget-title">
									<?php the_title();?>
								</h3>
								<div class="textwidget">
									<?php the_content();?>
								</div><!-- /.textwidget -->					
							</aside><!-- /.widget -->

							<aside class="widget project-details">
								<h3 class="widget-title">
									<?php _e('Project Details','jwtheme');?>
								</h3>
								<ul>
									<?php 
										$portfolio_client_name = get_post_meta( $post->ID,'_jwtheme_portfolio_client_name',true );
										$portfolio_date = get_post_meta( $post->ID,'_jwtheme_portfolio_date',true );
										$portfolio_url = get_post_meta( $post->ID,'_jwtheme_portfolio_url',true );
									?>

									<li class="fa-user"> <?php echo $portfolio_client_name; ?> </li>
									<li class="fa-clock-o"> <?php echo $portfolio_date;?> </li>
									<li class="fa-tags"> <?php 
										$terms = wp_get_post_terms( get_the_ID(), 'portfolio', array("fields" => "all")); 
										$t = array();                    
										foreach($terms as $term)
											$t[] = $term->name;
										 echo implode(', ', $t); $t = array();

									?> </li>
									<li class="fa-eye"> <?php echo jwtheme_topclass_getPostViews(get_the_ID());?> Views </li>
								</ul>
								<p><a class="btn btn-sm btn-default btn-effect" href="<?php echo $portfolio_url;?>" target="_blank"> <?php _e('Launch Project','jwtheme');?> </a></p>
							</aside><!-- /.widget -->
						</div><!-- /#portfolio-sidebar -->
					
					<?php } } ?>


				</div><!-- /.portfolio-container -->
			</div><!-- /.row -->
		</div><!-- container -->
	</div><!-- /#portfolio-page -->


		<section id="similar-project" class="similar-project gray-bg">
		<div class="container">
			<h3 class="similar-project-head">
				Similar Project
			</h3>

			<div id="similar-project-slider" class="owl-carousel owl-theme works-item similar-project-item ">
				
				<?php 
					$similar_portfolio = topclass_get_custom_posts("portfolio", 20); 
					foreach ($similar_portfolio as $post) {
                        setup_postdata($post);
				?>


					<figure class="item">
						
						<?php $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'portfolio-thumb' ) ); ?>
						<img src="<?php echo $url; ?>" alt="<?php echo get_the_title();?>"/>

						<figcaption>
							<a href="<?php the_permalink();?>">	
								<div class="portfolio-caption">
									<span class="protfolio-title"><?php the_title();?></span>
									<span class="protfolio-cat"> <?php 
										$terms = wp_get_post_terms( get_the_ID(), 'portfolio', array("fields" => "all")); 
										$t = array();                    
										foreach($terms as $term)
											$t[] = $term->name;
										 echo implode(', ', $t); $t = array();

										?> 
									</span>
								</div>

								<span class="protfolio-icon">
									<?php echo jwtheme_topclass_getPostViews(get_the_ID());?> <i class="fa fa-eye"></i>
								</span>
							</a>
						</figcaption>
					</figure>
				<?php  } ?>


			</div><!-- /.similar-project-item -->             
		</div><!-- /.container -->
	</section><!-- /#similar-project -->
</div>


<?php get_footer(); ?>