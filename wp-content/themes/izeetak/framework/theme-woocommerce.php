<?php
/**
 * Woocommerce
 *
 * @package izeetak
 * @version 3.6.8
 */

// Disable WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Remove breadcrumb (we're using the WooFramework default breadcrumb)
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Removes the "shop" title on the main shop page
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Remove Heading Text Tab
add_filter( 'woocommerce_product_description_heading', '__return_false' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

// Change gravatar size
add_filter( 'woocommerce_review_gravatar_size', 'izeetak_woocommerce_gravatar_size', 10 );
function izeetak_woocommerce_gravatar_size() { return 100; }

// Adjust markup on all WooCommerce pages
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Fix html on item product 
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action( 'woocommerce_before_shop_loop_item', 'izeetak_before_shop_loop_item' );
add_action( 'izeetak_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 2 );
add_action( 'izeetak_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 4 );
add_action( 'izeetak_before_shop_loop_item', 'woocommerce_template_loop_product_link_close', 6 );
add_action( 'izeetak_before_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 8 );

// Relayout shop item
function izeetak_before_shop_loop_item() {
	global $product;
	echo '<div class="product-thumbnail">';
		echo '<a class="woocommerce_loop_product_link" href="' . get_the_permalink($product->get_id()) . '">'; 
		do_action( 'izeetak_before_shop_loop_item' );
	echo '</div>';

	echo '<div class="product-info">';
}
add_action( 'woocommerce_after_shop_loop_item', function() {
	global $product;
	echo '</div>';
}, 99 );

// Update the number on cart icon
add_filter( 'woocommerce_add_to_cart_fragments', 'izeetak_cart_fragments', 100 );
function izeetak_cart_fragments( $fragments ) {
	$cart_items = \WooCommerce::instance()->cart->get_cart_contents_count();
	$fragments['script#shopping-cart-items-updater'] = sprintf( '
		<script id="shopping-cart-items-updater" type="text/javascript">
			( function( $ ) {
				"use strict";

				$( document ).trigger( \'woocommerce-cart-changed\', { items_count: %d } );
			} ).call( this, jQuery );
		</script>
	', $cart_items );

	return $fragments;
}

// Output the script placeholder for cart updater
add_action( 'wp_footer', 'izeetak_cart_fragments_placeholder', 100 );
function izeetak_cart_fragments_placeholder() {
	echo '<script id="shopping-cart-items-updater" type="text/javascript"></script>';
}

// Display products per page
add_filter( 'loop_shop_per_page', 'izeetak_products_per_page', 20 );
function izeetak_products_per_page() {
	if ( ! $items = izeetak_get_mod('shop_products_per_page') ) {
		return 6;
	} else {
		return $items;
	}
}

// Change columns in product loop
add_filter( 'loop_shop_columns', 'izeetak_shop_loop_columns', 20 );
function izeetak_shop_loop_columns() {
	if ( ! $cols = izeetak_get_mod('shop_columns') ) {
		return 3;
	} else {
		if ( $cols == '2' ) return 2;
		if ( $cols == '3' ) return 3;
		if ( $cols == '4' ) return 4;
	}
}

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Change columns in related products output to 4
add_filter( 'woocommerce_output_related_products_args', 'izeetak_related_products' );
function izeetak_related_products() {
	$args = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);
	return $args;
}

// Change product thumbnails columns to 6
add_filter('woocommerce_product_thumbnails_columns','izeetak_custom_storefront_gallery' );
function izeetak_custom_storefront_gallery( $column ) {
	$column  = 6;
	return $column ;
}

// Add category to product item
function izeetak_product_cat(){
    $cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
    if ( $cats && ! is_wp_error ( $cats ) ){
        $cat = array_shift( $cats ); ?>

        <div class="product-cat"><?php echo esc_html( $cat->name ); ?></div>
<?php }
}
add_action( 'woocommerce_shop_loop_item_title', 'izeetak_product_cat', 9 );

//
add_filter('woocommerce_get_availability', 'izeetak_custom_get_availability', 1, 2);
function izeetak_custom_get_availability($availability, $product) {
  	if ($availability['availability'] == '') {
    	$availability['availability'] = esc_html__('Available in store', 'izeetak');
  	} else {
  		$availability['availability'] = esc_html__('Product sold out!', 'izeetak');
  	}
  	return $availability;
}

