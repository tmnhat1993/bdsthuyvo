<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>

<li <?php // post_class( $classes ); ?> class="col-md-4 product" >

	<div class="jw-item">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<div class="jw-item-outer">

				<figure class="effect-kira">

					
					<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					//do_action( 'woocommerce_before_shop_loop_item_title' );

					// echo woocommerce_template_loop_product_thumbnail();
					?>

					<?php // echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
					<?php $li = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'products' ); 
						//print_r($li);
						//echo $li[0];
					?>

					<img src="<?php echo $li[0];?>" class="image-responsive" width="400" height="200"/>

					<figcaption>
						<p>
							<a href="<?php echo get_post_meta( $post->ID, '_demo_url', true );?>" class="btn btn-warning" target="_blank">Demo</a>
							<a href="<?php the_permalink();?>" class="btn btn-info">Details</a>
						</p>
					</figcaption>	

					<?php // do_action( 'woocommerce_after_shop_loop_item' ); ?>
				</figure>



				<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
				//echo woocommerce_template_loop_price();
				?>

		</div>

		<div class="jw-item-info">
			<div class="product-title">
				<h1>
					<a href="<?php the_permalink();?>">
						<?php echo get_post_meta( get_the_ID(), '_product_name', true ); ?>
					</a>	
				</h1>

			</div>		


			<div class="short-desc">
				<?php echo get_post_meta( get_the_ID(), '_short_desc', true ); ?>
			</div>	
		</div>

	</div>

</li>
