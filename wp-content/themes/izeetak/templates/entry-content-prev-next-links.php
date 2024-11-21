<?php
/**
 * Entry Content / Prev Next Link
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// // Exit if disabled via Customizer
if ( is_single() && ! izeetak_get_mod( 'blog_single_prev_next_links', false ) )
	return;

?>

<div class="nav-links">
	<?php $prev = get_previous_post(); 
	if ( $prev ) { ?>
		<div class="prev">
	        <?php 
	        
	        $thumb = get_the_post_thumbnail( $prev->ID, 'izeetak-post-widget' );
	        if ( !empty( $thumb ) ) { ?>
	        	<div class="thumb">
			        <a href="<?php echo esc_url(get_the_permalink($prev->ID)); ?>">
			            <?php echo get_the_post_thumbnail( $prev->ID, 'izeetak-post-widget' ); ?>
			        </a>
			    </div>
	        <?php } ?>
		    
			<?php previous_post_link('%link'); ?>    
		</div>
	<?php } ?>

	<?php $next = get_next_post();
	if ( $next  !== '' ) { ?>
		<div class="next">
	        <?php 
	        $next = get_next_post();
	        $thumb = get_the_post_thumbnail( $next->ID, 'izeetak-post-widget' );
	        if ( !empty( $thumb ) ) { ?>
	        	<div class="thumb">
			        <a href="<?php echo esc_url(get_the_permalink($next->ID)); ?>">
			            <?php echo get_the_post_thumbnail( $next->ID, 'izeetak-post-widget' ); ?>
			        </a>
			    </div>
		    <?php } ?>
		    
			<?php next_post_link('%link'); ?>
		</div>
	<?php }	?>
</div>
