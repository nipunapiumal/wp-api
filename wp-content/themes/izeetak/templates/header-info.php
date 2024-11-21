<?php
/**
 * Header / Info
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get defaults from Customizer
$cls = '';

$email = izeetak_get_mod('header_info_email', '');
$phone = izeetak_get_mod('header_info_phone', '');
$address = izeetak_get_mod('header_info_address', '');

?>

<div class="header-info <?php echo esc_attr( $cls ); ?>">
    <?php
    if ( $email ) : ?>
        <span class="email content">
            <?php echo do_shortcode( $email ); ?>
        </span>
    <?php endif;

    if ( $phone ) : ?>
        <span class="phone content">
            <?php echo do_shortcode( $phone ); ?>
        </span>
    <?php endif; 

    if ( $address ) : ?>
        <span class="address content">
            <?php echo do_shortcode( $address ); ?>
        </span>
    <?php endif; ?>
</div><!-- /.header-info -->