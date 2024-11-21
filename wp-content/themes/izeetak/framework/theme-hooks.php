<?php
// Custom classes to body tag
function izeetak_body_classes() {
	$classes[] = '';

	// Elementor
	if ( class_exists( '\Elementor\Plugin' ) ) {
		if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$classes[] = 'elementor-preview';
		}
	}
	
	if ( get_post_type() == 'elementor_library' )
		$classes[] = 'elementor-template';

	// Get layout position
	$classes[] = izeetak_layout_position();
	$layout_position = izeetak_layout_position();
	if ( ! is_page() && $layout_position != 'no-sidebar' && ! is_active_sidebar( 'sidebar-blog' ) )
		$classes[] = 'blog-empty-widget';

	if ( is_page() && $layout_position != 'no-sidebar' && ! is_active_sidebar( 'sidebar-page' ) )
		$classes[] = 'page-empty-widget';

	// Get layout style
	$layout_style = izeetak_get_mod( 'site_layout_style', 'full-width' );
	$classes[] = 'site-layout-'. $layout_style;


	if ( is_page() ) $classes[] = 'is-page';

	if ( is_page_template( 'templates/page-onepage.php' ) )
		$classes[] = 'one-page';

	// Add classes for Woo pages
	if ( izeetak_is_woocommerce_page() )
		$classes[] = 'woocommerce-page';

	if ( izeetak_is_woocommerce_shop() )
		$classes[] = 'main-shop-page';

	if ( izeetak_is_woocommerce_shop() || izeetak_is_woocommerce_archive_product() ) {
		$shop_cols = izeetak_get_mod( 'shop_columns', '3' );
		$classes[] = 'shop-col-'. $shop_cols;
	}

	// Add class for search page
	if ( is_search() )
		$classes[] = 'search-page';

	// Boxed Layout dropshadow
	if ( 'boxed' == $layout_style && izeetak_get_mod( 'site_layout_boxed_shadow' ) )
		$classes[] = 'box-shadow';

	if ( izeetak_get_mod( 'header_search_icon' ) )
		$classes[] = 'header-simple-search';

	if ( is_singular( 'post' ) )
		$classes[] = 'is-single-post';

	if ( is_singular( 'project' ) )
		$classes[] = 'page-single-project';

	if ( is_singular( 'service' ) )
		$classes[] = 'page-single-service';

	if ( izeetak_get_mod( 'izeetak_blog_single_related', false ) )
		$classes[] = 'has-related-post';

	if ( izeetak_get_mod( 'project_related', false ) )
		$classes[] = 'has-related-project';

	if ( ! is_active_sidebar( 'sidebar-footer-1' ) &&
		! is_active_sidebar( 'sidebar-footer-2' ) &&
		! is_active_sidebar( 'sidebar-footer-3' ) &&
		! is_active_sidebar( 'sidebar-footer-4' ) &&
		! is_active_sidebar( 'sidebar-footer-5' ))
		$classes[] = 'footer-no-widget';

	// CPT pages
	if ( is_singular( 'header' ) )
		$classes[] = 'page-header-single';
	
	if ( is_singular( 'footer' ) )
		$classes[] = 'page-footer-single';

	// Return classes
	return $classes;
}
add_filter( 'body_class', 'izeetak_body_classes' );

// Remove products and pages results from the search form widget
function izeetak_custom_search_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return;

	if ( isset( $_GET['post_type'] ) && ( $_GET['post_type'] == 'product' ) )
		return;

	if ( $query->is_search() ) {
    	$in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );

	    $post_types_to_remove = array( 'product' );

	    foreach ( $post_types_to_remove as $post_type_to_remove ) {
			if ( is_array( $in_search_post_types ) 
				&& in_array( $post_type_to_remove, $in_search_post_types ) 
			) {
				unset( $in_search_post_types[ $post_type_to_remove ] );
				$query->set( 'post_type', $in_search_post_types );
			}
	    }
	}
}
add_action( 'pre_get_posts', 'izeetak_custom_search_query' );

// Update Woocommerce Cart
function izeetak_woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();

	if ( class_exists( 'woocommerce' ) ) : ?>
		<a class="cart-info" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr__( 'View your shopping cart', 'izeetak' ); ?>"><i class="ci-cart"></i><?php echo sprintf( _n( '%d item', '%d items', WC()->cart->cart_contents_count, 'izeetak' ), WC()->cart->cart_contents_count); ?> <?php echo WC()->cart->get_cart_total(); ?></a>
	<?php endif;

	$fragments['a.cart-info'] = ob_get_clean();
	
	return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'izeetak_woocommerce_header_add_to_cart_fragment');

// Sets the content width in pixels, based on the theme's design and stylesheet.
function izeetak_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'izeetak_content_width', 1140 );
}
add_action( 'after_setup_theme', 'izeetak_content_width', 0 );

// Modifies tag cloud widget arguments to have all tags in the widget same font size.
function izeetak_widget_tag_cloud_args( $args ) {
	$args['largest'] = 11;
	$args['smallest'] = 11;
	$args['unit'] = 'px';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'izeetak_widget_tag_cloud_args' );

// Change default read more style
function izeetak_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'izeetak_excerpt_more', 10 );

// Custom excerpt length for posts
function izeetak_content_length() {
	$length = izeetak_get_mod( 'blog_excerpt_length', '50' );
	$length = intval( $length );

	if ( ! empty( $length ) || $length != 0 )
		return $length;
}
add_filter( 'excerpt_length', 'izeetak_content_length', 999 );

// Prevent page scroll when clicking the more link
function izeetak_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );

	return $link;
}
add_filter( 'the_content_more_link', 'izeetak_remove_more_link_scroll' );

// Remove read-more link so we can custom it
function izeetak_remove_read_more_link() {
    return '';
}
add_filter( 'the_content_more_link', 'izeetak_remove_read_more_link' );

// Custom html categories widget
function cat_count_span( $link ) {
  $link = str_replace( '</a> (', '</a> <span>', $link );
  $link = str_replace( ')', '</span>', $link );
  return $link;
}
add_filter( 'wp_list_categories', 'cat_count_span' );
 
// Column of related product
function izeetak_related_products_args( $args ) {
	$column = izeetak_get_mod( 'shop_realted_columns', 3 );
	$args['posts_per_page'] = $column; 
	$args['columns'] = $column; 
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'izeetak_related_products_args', 20 );

// Remove p in CF7
add_filter('wpcf7_autop_or_not', '__return_false');

