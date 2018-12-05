<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	
	global $post;

	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>



<div id="primary" class="item-content col-md-8">
		<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>
</div>

<div id="secondary" class="item-sidebar col-md-4">

	<?php if( get_post_meta( $post->ID, '_demo_url', true ) ){ ?>
		<a href="<?php echo get_post_meta( $post->ID, '_demo_url', true );?>" class="btn btn-success item-preview" target="_blank">
			<i class="fa fa-desktop"></i>Live Preview
		</a>
	<?php } ?>
	<div class="clear"></div>
	<div class="purchase-info">
		<h3 class="purchase-heading">Purchase</h3>	
	</div>

	<div class="single-product-info">

	<?php 
	
	if( function_exists('get_product') ){
		$product = get_product( $post->ID );
		if( $product->is_type( 'simple' ) ){ 

			if( (get_post_meta(get_the_ID(),'_regular_price',true)) ){ ?>
				<div class="col-md-12">
					<div class="col-sm-4">
						<h3 class="price-head">
							<span itemprop="price">Price</span>
						</h3>
					</div>

					<div class="col-sm-8">
						<div class="col-sm-8 pull-right">
							<?php echo woocommerce_template_single_price();?>		
						</div>
						<div class="add-cart col-sm-12">
							<?php echo woocommerce_template_single_add_to_cart();?>	
						</div>
					</div>
				</div>
			<?php } else{ ?>
				<div class="col-md-12">
					<div class="col-sm-4">
						<h3 class="price-head">
							<span itemprop="price">Price</span>
						</h3>
					</div>

					<div class="col-sm-8">
						<p class="free">Free !!!</p>
					</div>
				</div>
			<?php } ?>
		
		
		
		<?php } elseif ( $product->is_type( 'variable' ) ) { ?>

		<div class="col-md-12">
			<div class="col-sm-4">
				<h3 class="price-head">
					<span itemprop="price">Price</span>
				</h3>
			</div>

			<div class="col-sm-8">
				<div class="pull-right">
					<?php echo woocommerce_template_single_price();?>		
				</div>
				<div class="license">
					<h3 class="item-license">
						<span>License</span>
					</h3>
					<div class="add-cart">
						<?php echo woocommerce_template_single_add_to_cart();?>		
					</div>
					
				</div>
			</div>
		</div>	
		<?php	} elseif ( $product->is_type( 'external' ) ) { ?>

		<div class="col-md-12">
			<div class="col-sm-4">
				<h3 class="price-head">
					<span itemprop="price">Price</span>
				</h3>
			</div>

			<div class="col-sm-8">
				<div class="pull-left">
					<?php echo woocommerce_template_single_price();?>		
				</div>

				<div class="pull-right">
					<div class="add-cart">
						<?php echo woocommerce_template_single_add_to_cart();?>		
					</div>					
				</div>

			</div>
		</div>	
		<?php	} 
	}
	?>
		<?php// echo woocommerce_template_single_price();?>
		<?php //echo woocommerce_template_single_add_to_cart();?>
	</div>

	<div id="product-info" class="purchase-info">
		<h3 class="purchase-heading">Product Info</h3>
		<table class="table table-striped table-bordered monts" style="font-size: 9pt;color: #444444">
			<tbody>
				<tr>
					<td><i class="fa  fa-github-alt"></i>Create Date</td>
					<td><meta itemprop="datePublished" content="<?php echo get_post_meta(get_the_ID(),'_create_date',true); ?>"><?php echo get_post_meta(get_the_ID(),'_create_date',true); ?></td>
				</tr>
				<tr>
					<td><i class="fa  fa-github-alt"></i>Update Date</td>
					<td><?php echo get_post_meta(get_the_ID(),'_update_date',true); ?></td>
				</tr>
				<tr>
					<td><i class="fa  fa-github-alt"></i>Requirements</td>
					<td><?php echo get_post_meta(get_the_ID(),'_requirements',true); ?></td>
				</tr>
				
				<tr>
					<td><i class="fa  fa-github-alt"></i>Suitable For</td>
					<td><?php echo get_post_meta(get_the_ID(),'_suitable_for',true); ?></td>
				</tr>
				<tr>
					<td><i class="fa  fa-github-alt"></i>File Size</td>
					<td><?php echo get_post_meta(get_the_ID(),'_file_size',true); ?></td>
				</tr>
			</tbody>
		</table>


		
			<div class="support">
				<?php if( get_post_meta(get_the_ID(),'_documentation_url',true) ){ ?>
					<div class="col-sm-6 btn btn-success documentation">
						<a href="<?php echo get_post_meta(get_the_ID(),'_documentation_url',true); ?>" target="_blank">
							<i class="fa fa-folder-open-o"></i> Documentation
						</a>
					</div>
				<?php } ?>

				<?php if( get_post_meta(get_the_ID(),'_github_url',true) ){ ?>
					<div class="col-sm-6 btn btn-info github-url pull-left">
						<a href="<?php echo get_post_meta(get_the_ID(),'_github_url',true); ?>" target="_blank">
							<i class="fa  fa-github-alt"></i>Github
						</a>
					</div>
				<?php } ?>

				<?php if( get_post_meta(get_the_ID(),'_support_url',true) ){ ?>
					<div class="col-sm-6 btn btn-success pull-right support-url">
						<a href="<?php echo get_post_meta(get_the_ID(),'_support_url',true); ?>" target="_blank">
							Support Forum
						</a>
					</div>
				<?php } ?>
			</div>


	</div>


	<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			
		//	do_action( 'woocommerce_single_product_summary' );
			?>
</div>
	<div id="product-summary" class="item-summary">

		<h3><?php  echo woocommerce_template_single_title();?></h3>


			<?php
				/**
				 * woocommerce_after_single_product_summary hook
				 *
				 * @hooked woocommerce_output_product_data_tabs - 10
				 * @hooked woocommerce_upsell_display - 15
				 * @hooked woocommerce_output_related_products - 20
				 */
				do_action( 'woocommerce_after_single_product_summary' );
				//echo woocommerce_output_product_data_tabs();
			?>
		<meta itemprop="url" content="<?php the_permalink(); ?>" />
	</div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
