<?php

// WooCommerce Functions for dazzling theme

if ( ! function_exists( 'dazzling_woo_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function dazzling_woo_setup() {
	/*
	 * Enable support for WooCemmerce.
	*/
	add_theme_support( 'woocommerce' );

}
endif; // dazzling_woo_setup
add_action( 'after_setup_theme', 'dazzling_woo_setup' );

/**
 * Set Default Thumbnail Sizes for Woo Commerce Product Pages, on Theme Activation
*/
global $pagenow;

if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'dazzling_woocommerce_image_dimensions', 1 );
/**
 * Define image sizes
*/
function dazzling_woocommerce_image_dimensions() {
  $catalog = array(
		'width' 	=> '350',	// px
		'height'	=> '453',	// px
		'crop'		=> 1 		// true
	);
	$single = array(
		'width' 	=> '570',	// px
		'height'	=> '708',	// px
		'crop'		=> 1 		// true
	);
	$thumbnail = array(
		'width' 	=> '350',	// px
		'height'	=> '453',	// px
		'crop'		=> 0 		// false
	);
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

/*
 * Add basic WooCommerce template support
 *
 */

// First let's remove original WooCommerce wrappers
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Now we can add our own, the same used for theme Pages
add_action('woocommerce_before_main_content', 'dazzling_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'dazzling_wrapper_end', 10);

function dazzling_wrapper_start() {
  echo '<div id="content" class="site-content container">';
  echo '<div id="primary" class="content-area col-sm-12 col-md-8 '.of_get_option('site_layout').' ">';
  echo '<main id="main" class="site-main" role="main">';
}


function dazzling_wrapper_end() {
  echo '</main></div>';
}

// Replace WooComemrce button class with Bootstrap
add_filter('woocommerce_loop_add_to_cart_link', 'dazzling_commerce_switch_buttons');

function dazzling_commerce_switch_buttons( $button ){

  $button = str_replace('button', 'btn btn-default', $button);

  return $button;

}

/**
 * Place a cart icon with number of items and total cost in the menu bar.
 */
function dazzling_woomenucart($menu, $args) {

	// Check if WooCommerce is active and add a new item to a menu assigned to Primary Navigation Menu location
	if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) || 'primary' !== $args->theme_location )
		return $menu;

	ob_start();
		global $woocommerce;
		$viewing_cart = __('View your shopping cart', 'dazzling');
		$start_shopping = __('Start shopping', 'dazzling');
		$cart_url = $woocommerce->cart->get_cart_url();
		$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
		$cart_contents_count = $woocommerce->cart->cart_contents_count;
		$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'dazzling'), $cart_contents_count);
		$cart_total = $woocommerce->cart->get_cart_total();
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// if ( $cart_contents_count > 0 ) {
			if ($cart_contents_count == 0) {
				$menu_item = '<li class="pull-right"><a class="woo-menu-cart" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
			} else {
				$menu_item = '<li class="pull-right"><a class="woo-menu-cart" href="'. $cart_url .'" title="'. $viewing_cart .'">';
			}

			$menu_item .= '<i class="fa fa-shopping-cart"></i> ';

			$menu_item .= $cart_contents.' - '. $cart_total;
			$menu_item .= '</a></li>';
		// Uncomment the line below to hide nav menu cart item when there are no items in the cart
		// }
		echo $menu_item;
	$social = ob_get_clean();
	return $menu . $social;

}
add_filter('wp_nav_menu_items','dazzling_woomenucart', 10, 2);


add_filter('add_to_cart_fragments', 'header_add_to_cart_fragment');
function header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	ob_start();

	woocommerce_cart_link();

	$fragments['.cart-button'] = ob_get_clean();

	return $fragments;

}

// Remove Quantity fields from Shop Page
function wc_remove_all_quantity_fields( $return, $product ) {
    return true;
}
add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );

// Change Add to Cart to Buy Now Button
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
function woo_custom_cart_button_text() { 
        return __( 'Buy Now', 'woocommerce' ); 
}



add_filter( 'woocommerce_product_add_to_cart_text', 'custom_woocommerce_product_add_to_cart_text' );    // 2.1 +
function custom_woocommerce_product_add_to_cart_text() { 
	global $product;
	
	$product_type = $product->product_type;
	
	switch ( $product_type ) {
		case 'external':
		return __( 'Buy product', 'woocommerce' );
		break;
		case 'grouped':
		return __( 'View products', 'woocommerce' );
		break;
		case 'simple':
		return __( 'Add to cart', 'woocommerce' );
		break;
		case 'variable':
		return __( 'Select options', 'woocommerce' );
		break;
		default:
		return __( 'Read more', 'woocommerce' );
	}
}

/**
* start the customisation
*/
function custom_woo_before_shop_link() {
    add_filter('woocommerce_loop_add_to_cart_link', 'custom_woo_loop_add_to_cart_link', 10, 2);
    add_action('woocommerce_after_shop_loop', 'custom_woo_after_shop_loop');
}
add_action('woocommerce_before_shop_loop', 'custom_woo_before_shop_link');
 
/**
* customise Add to Cart link/button for product loop
* @param string $button
* @param object $product
* @return string
*/
function custom_woo_loop_add_to_cart_link($button, $product) {
    // not for variable, grouped or external products
    if (!in_array($product->product_type, array('variable', 'grouped', 'external'))) {
        // only if can be purchased
        if ($product->is_purchasable()) {
            // show qty +/- with button
            ob_start();
            woocommerce_simple_add_to_cart();
            $button = ob_get_clean();
 
            // modify button so that AJAX add-to-cart script finds it
            $replacement = sprintf('data-product_id="%d" data-quantity="1" $1 add_to_cart_button product_type_simple ', $product->id);
            $button = preg_replace('/(class="single_add_to_cart_button)/', $replacement, $button);
        }
    }
 
    return $button;
}
 
/**
* add the required JavaScript
*/
function custom_woo_after_shop_loop() {
    ?>
 
    <script>
    jQuery(function($) {
 
    <?php /* when product quantity changes, update quantity attribute on add-to-cart button */ ?>
    $("form.cart").on("change", "input.qty", function() {
        $(this.form).find("button[data-quantity]").attr("data-quantity", this.value);
    });
 
    <?php /* remove old "view cart" text, only need latest one thanks! */ ?>
    $(document.body).on("adding_to_cart", function() {
        $("a.added_to_cart").remove();
    });
 
    });
    </script>
 
    <?php
}

//Click to Enlarge Thumbnail Image on Single Product page
function skyverge_add_below_featured_image() {
    echo '<h5 style="text-align:center;margin-top:10px;">Click to Enlarge</h5>';
}
add_action( 'woocommerce_product_thumbnails' , 'skyverge_add_below_featured_image', 9 );




// Modify the default WooCommerce orderby dropdown
//
// Options: menu_order, popularity, rating, date, price, price-desc
// In this example I'm removing price & price-desc but you can remove any of the options
// function my_woocommerce_catalog_orderby( $orderby ) {
// 	unset($orderby["price"]);
// 	unset($orderby["price-desc"]);
// 	return $orderby;
// }
// add_filter( "woocommerce_catalog_orderby", "my_woocommerce_catalog_orderby", 20 );

// // Remove Default Sorting and Selecting Options on Shope Page
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 30 );

//Woocommerce Category Image
add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
function woocommerce_category_image() {
    if ( is_product_category() ){
	    global $wp_query;
	    $cat = $wp_query->get_queried_object();
	    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
	    $image = wp_get_attachment_url( $thumbnail_id );
	    if ( $image ) {
		    echo '<img src="' . $image . '" alt="" />';
		}
	}
}



// Display Fields
add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );
// Save Fields
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields() {
 
  global $woocommerce, $post;
  
  echo '<div class="options_group">';
  
  	// Custom fields

	// Textarea
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_product_name', 
			'label'       => __( 'Product Name', 'woocommerce' ), 
			'placeholder' => 'Product Name', 
			'description' => __( 'Enter the Product Name.', 'woocommerce' ) 
			)
	);
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_create_date', 
			'label'       => __( 'Create Date', 'woocommerce' ), 
			'placeholder' => 'Product Created Date', 
			'description' => __( 'Enter the Product Created Date.', 'woocommerce' ) 
			)
	);
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_update_date', 
			'label'       => __( 'Update Date', 'woocommerce' ), 
			'placeholder' => 'Product Updated Date', 
			'description' => __( 'Enter the Product Updated Date.', 'woocommerce' ) 
			)
	);

	woocommerce_wp_textarea_input( 
		array( 
			'id'          => '_short_desc', 
			'label'       => __( 'Short Description', 'woocommerce' ), 
			'placeholder' => 'Short Description', 
			'description' => __( 'Enter the Product Short Description.', 'woocommerce' ) 
			)
	);

	// Text Field
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_demo_url', 
			'label'       => __( 'Demo URL', 'woocommerce' ), 
			'placeholder' => 'http://',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the Demo URL.', 'woocommerce' ) 
			)
		);	
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_download_url', 
			'label'       => __( 'Download(External) URL', 'woocommerce' ), 
			'placeholder' => 'http://',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the Download URL.', 'woocommerce' ) 
			)
		);
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_github_url', 
			'label'       => __( 'Github URL', 'woocommerce' ), 
			'placeholder' => 'http://',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the Github URL.', 'woocommerce' ) 
			)
		);
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_documentation_url', 
			'label'       => __( 'Documentation URL', 'woocommerce' ), 
			'placeholder' => 'http://',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the Documentation URL.', 'woocommerce' ) 
			)
		);
	woocommerce_wp_text_input( 
		array( 
			'id'          => '_support_url', 
			'label'       => __( 'Support Forum URL', 'woocommerce' ), 
			'placeholder' => 'http://',
			'desc_tip'    => 'true',
			'description' => __( 'Enter the Support Forum URL.', 'woocommerce' ) 
			)
		);

	// Version Field
	woocommerce_wp_text_input( 
		array( 
			'id'                => '_version_number', 
			'label'             => __( 'Version', 'woocommerce' ), 
			'placeholder'       => '1.0.0', 
			'description'       => __( 'Enter the current version here.', 'woocommerce' )
		)
	);	

	woocommerce_wp_text_input( 
		array( 
			'id'                => '_requirements', 
			'label'             => __( 'Requirements', 'woocommerce' ), 
			'placeholder'       => 'Minimum Version Requires', 
			'description'       => __( 'Enter the Product version Requires.', 'woocommerce' )
		)
	);

	woocommerce_wp_text_input( 
		array( 
			'id'                => '_suitable_for', 
			'label'             => __( 'Suitable For', 'woocommerce' ), 
			'placeholder'       => 'WordPress', 
			'description'       => __( 'Enter the Product Dependency Suitable For.', 'woocommerce' )
		)
	);

	woocommerce_wp_text_input( 
		array( 
			'id'                => '_file_size', 
			'label'             => __( 'File Size', 'woocommerce' ), 
			'placeholder'       => 'File Size', 
			'description'       => __( 'Enter the Product File Size.', 'woocommerce' )
		)
	);



 
  echo '</div>';
	
}


function woo_add_custom_general_fields_save( $post_id ){
	
	// Text Field

	$woocommerce_text_field = $_POST['_product_name'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_product_name', esc_attr( $woocommerce_text_field ) );

	$woocommerce_text_field = $_POST['_create_date'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_create_date', esc_attr( $woocommerce_text_field ) );

	$woocommerce_text_field = $_POST['_update_date'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_update_date', esc_attr( $woocommerce_text_field ) );
	
	$woocommerce_text_field = $_POST['_short_desc'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_short_desc', esc_attr( $woocommerce_text_field ) );
	
	$woocommerce_text_field = $_POST['_demo_url'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_demo_url', esc_attr( $woocommerce_text_field ) );
	
	$woocommerce_text_field = $_POST['_download_url'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_download_url', esc_attr( $woocommerce_text_field ) );

	$woocommerce_text_field = $_POST['_github_url'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_github_url', esc_attr( $woocommerce_text_field ) );
	
	$woocommerce_text_field = $_POST['_documentation_url'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_documentation_url', esc_attr( $woocommerce_text_field ) );
	
	$woocommerce_text_field = $_POST['_support_url'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_support_url', esc_attr( $woocommerce_text_field ) );
	
	$woocommerce_text_field = $_POST['_version_number'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_version_number', esc_attr( $woocommerce_text_field ) );
	
	$woocommerce_text_field = $_POST['_suitable_for'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_suitable_for', esc_attr( $woocommerce_text_field ) );
	
	$woocommerce_text_field = $_POST['_requirements'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_requirements', esc_attr( $woocommerce_text_field ) );

	$woocommerce_text_field = $_POST['_file_size'];
	if( !empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_file_size', esc_attr( $woocommerce_text_field ) );

	
	// Product Field Type
	$product_field_type =  $_POST['product_field_type'];
	update_post_meta( $post_id, '_product_field_type_ids', $product_field_type );
	
}



// Hide Shop Page Title
add_filter('woocommerce_show_page_title','jw_show_title');
function jw_show_title(){
	return false;
}

// // Show Unit Product Sold
function tt_show_product_loop_unitsold() {
  global $product;
  $units_sold = get_post_meta( $product->id, 'total_sales', true );
 
  echo '<p>' . sprintf( __( 'Downloads: %s', 'woocommerce' ), $units_sold ) . '</p>'; //you can change text Units Sold to any text liked Total Downloads
} 
add_action( 'woocommerce_single_product_summary',  'tt_show_product_loop_unitsold', 8 );


// E-mail Purchased Payment Type
add_action( 'woocommerce_email_after_order_table', 'custom_add_payment_type_to_emails', 15, 2 );
function custom_add_payment_type_to_emails( $order, $is_admin_email ) {
	$args = array(
		'status' => 'approve', 
		'post_id' => $order->id
		);
	$comments = get_comments($args);

	echo '<p><strong>Payment Type:</strong> ' . $order->payment_method_title . '</p>';
	echo '<p><strong>Order Notes:</strong> ';
	foreach($comments as $comment) :
		echo $comment->comment_content . '<br />';
	endforeach;
	echo '</p>';
}
