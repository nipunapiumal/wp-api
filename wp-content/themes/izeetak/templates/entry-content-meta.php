<?php
/**
 * Entry Content / Meta
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( is_single() && ! izeetak_get_mod( 'blog_single_meta', true ) )
	return;
?>

<div class="post-meta <?php echo esc_attr( izeetak_get_mod( 'blog_custom_meta', 'style-1' ) ); ?>">
	<div class="post-meta-content">
		<div class="post-meta-content-inner clearfix">
			<?php izeetak_entry_meta(); ?>
		</div>
	</div>
</div>



