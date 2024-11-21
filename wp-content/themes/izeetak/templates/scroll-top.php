<?php
/**
 * Scroll Top Button
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! izeetak_get_mod( 'scroll_top', true ) ) return false;
?>

<div id="scroll-top"></div>