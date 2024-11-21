<?php
/**
 * Header
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( izeetak_header_style() == '1' ) {
    $cls ='';
    $has_info = false;
    $has_social = false;
    $has_top = false;
    if (izeetak_get_mod('header_info_phone', '') ||
        izeetak_get_mod('header_info_email', '') ||
        izeetak_get_mod('header_info_address', ''))
        $has_info = true;

    if (izeetak_get_mod('header_socials', false))
        $has_social = true;

    if ($has_social || $has_info)
        $has_top = true;

    // Get header style
    $cls = izeetak_get_mod( 'header_class' );
    ?>

    <header id="site-header" class="<?php echo esc_attr( $cls ); ?>">
        <?php if ($has_top) { ?>
            <div class="top-bar">
                <div class="izeetak-container">
                    <div class="top-bar-inner">
                        <div class="topbar-left">
                            <?php get_template_part( 'templates/header-social'); ?>
                        </div> 

                        <div class="topbar-right">
                            <?php get_template_part( 'templates/header-info'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="izeetak-container">
        	<div class="site-header-inner">
                <?php 
                get_template_part( 'templates/header-logo');  
                get_template_part( 'templates/header-menu');       
            	get_template_part( 'templates/header-button');
            	?>
        	</div>
        </div>
    </header><!-- /#site-header -->
<?php } else {

    $float = izeetak_get_elementor_option('header_float');
    ?>
    <div class="izeetak-header izeetak-container <?php if ($float == 'yes') echo 'header-float'; ?>">
        <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display(izeetak_header_style(), false); ?>
    </div>
    <?php

    $idf = izeetak_get_mod( 'header_fixed', '1' );
    if (!is_null(izeetak_get_elementor_option('header_fixed')) && (izeetak_get_elementor_option('header_fixed') !== '0'))
       $idf = izeetak_get_elementor_option('header_fixed');
    if ($idf !== '1') { ?>
        <div class="izeetak-header-fixed fixed-hide izeetak-container">
            <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($idf, false); ?>
        </div>
    <?php }
    
} ?>
