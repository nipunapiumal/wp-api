<?php
/**
 * Preloader
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( izeetak_get_mod( 'preloader', 'animsition' ) == '' ) return false;

$text = izeetak_get_mod( 'preloader_text', 'PLEASE WAIT' );
?>

<div id="preloader">
    <svg width="0" height="0">
     <filter id="gooey-plasma">
          <feGaussianBlur in="SourceGraphic" stdDeviation="20" result="blur"/>
          <feColorMatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 50 -16" result="goo" />
      </filter>
    </svg>
    <div class="inner">
        <div class="plasma">
          <div class="gooey-container">
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
            <span class="bubble"></span>
          </div>
        </div>
        <?php if ( $text ) { ?>
            <span class="preloader-text"><?php echo esc_html($text); ?></span>
        <?php } ?>
    </div>
</div>