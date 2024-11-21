<?php
/**
 * Entry Content / Single
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} 

?>

<article id="service-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
	<div class="inner-content single-service-inner">
		<?php		
		echo '<div class="post-media">' . get_the_post_thumbnail( get_the_ID(), 'izeetak-post-standard' ) . '</div>';
		echo '<h1 class="post-title">' . get_the_title() . '</h1>';
		the_content();
		?>
	</div>
</article><!-- /.hentry -->