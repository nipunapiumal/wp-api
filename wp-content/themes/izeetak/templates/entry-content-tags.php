<?php
/**
 * Entry Content / Tags
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( is_single() && ! izeetak_get_mod( 'blog_single_tags', true ) )
	return;

$text = izeetak_get_mod( 'blog_single_tags_text', 'Tags' );
if ($text) {
    the_tags( '<div class="post-tags clearfix"><div class="inner"><span class="tag-text">'. esc_html( $text ) . '</span>','','</div></div>' );
} else {
    the_tags( '<div class="post-tags clearfix"><div class="inner">','','</div></div>' );
}



