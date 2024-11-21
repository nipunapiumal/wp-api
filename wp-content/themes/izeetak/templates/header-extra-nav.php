<?php
/**
 * Header / Extra Nav
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get mobi logo from Customizer
$logo_size = '';
$logo_title = get_bloginfo( 'name' );
if ( $menu_logo_width = izeetak_get_mod( 'mobile_menu_logo_width' ) )
	$logo_size .= 'max-width:'. intval( $menu_logo_width ) .'px;';
?>

<ul class="mobi-nav-extra">
	<?php if ( $menu_logo = izeetak_get_mod( 'mobile_menu_logo' ) ) : ?>
		<li class="ext menu-logo"><span class="menu-logo-inner" style="<?php echo esc_attr( $logo_size ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $menu_logo ); ?>" alt="<?php echo esc_attr( $logo_title ); ?>"/></a></span></li>
	<?php endif; ?>

	<?php if ( izeetak_get_mod( 'header_search_icon', false ) ) : ?>
	<li class="ext"><?php get_search_form(); ?></li>
	<?php endif; ?>

	<?php if ( class_exists( 'woocommerce' ) && izeetak_get_mod( 'header_cart_icon', false ) ) : ?>
	<li class="ext"><a class="cart-info" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'izeetak' ); ?>"><i class="ci-cart"></i><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'izeetak' ), WC()->cart->get_cart_contents_count() ); ?> <?php echo WC()->cart->get_cart_total(); ?></a></li>
	<?php endif; ?>
</ul>