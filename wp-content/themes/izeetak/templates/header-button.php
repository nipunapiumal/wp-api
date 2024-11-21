<?php
/**
 * Header / Button
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get defaults from Customizer
$text = izeetak_get_mod( 'header_button_text', '' );
$url = izeetak_get_mod( 'header_button_url', '' );

if ( $text && $url ) : ?>
	<div class="header-button">
	    <?php
	    if ( $text && $url ) : ?>
	        <a class="button" href="<?php echo esc_url( do_shortcode( $url ) ); ?>">
	            <?php echo do_shortcode( $text ); ?>
	        </a>
	    <?php endif; ?>
	</div><!-- /.header-info -->
<?php endif; ?>