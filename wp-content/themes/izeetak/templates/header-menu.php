<?php
/**
 * Header / Menu
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Menu
if ( has_nav_menu( 'primary' ) || has_nav_menu( 'onepage' ) ) {
	$cls = '';
	if ( izeetak_get_mod( 'menu_show_current' ) ) $cls .= 'show-current';
	$menu = is_page_template( 'templates/page-onepage.php' )
		? 'onepage'
		: 'primary';
	?>

	<nav id="main-nav" class="izeetak-menu <?php echo esc_attr( $cls ); ?>">
		<?php
		wp_nav_menu( array(
			'theme_location' => $menu,
			'link_before' => '<span>',
			'link_after'=>'</span>',
			'fallback_cb' => false,
			'container' => false
		) );
		?>
	</nav>
<?php }

// Search Icon
if ( izeetak_get_mod( 'header_search_icon', false ) ) {
	echo '<div class="izeetak-search"><a href="#" class="search-trigger"><i class="ci-search"></i></a></div>';
} 

// Cart Icon
if ( izeetak_get_mod( 'header_cart_icon', false ) && class_exists( 'woocommerce' ) ) { ?>
    <div class="izeetak-cart">
        <a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ) ?>">
        	<i class="ci-cart"></i>
            <?php if ( $items_count = WC()->cart->get_cart_contents_count() ): ?>
                <span class="shopping-cart-items-count"><?php echo esc_html( $items_count ) ?></span>
            <?php else: ?>
                <span class="shopping-cart-items-count">0</span>
            <?php endif ?>
        </a>

        <div class="nav-shop-cart">
            <div class="widget_shopping_cart_content">      	
                <?php woocommerce_mini_cart() ?>
            </div>
        </div>
    </div>

<?php }

// Side menu for mobile
if ( has_nav_menu( 'primary' ) || has_nav_menu( 'onepage' ) ) {
	$cls = '';
	if ( izeetak_get_mod( 'menu_show_current' ) ) $cls .= 'show-current';
	$menu = is_page_template( 'templates/page-onepage.php' )
		? 'onepage'
		: 'primary';
	?>

	<div class="izeetak-hamburger-icon">
	    <i class="ci-menu"></i>
	</div>

	<div class="izeetak-hamburger-menu">
	    <div class="hidden-menu-overlay"></div>
	    <div class="hidden-menu-wrap">
	        <div class="close-menu"></div>
	        <?php
	        wp_nav_menu( array(
				'theme_location' => $menu,
				'link_before' => '<span>',
				'link_after'=>'</span>',
				'fallback_cb' => false,
				'container' => false
			) );
	        ?>
	    </div>
	</div>
<?php }
