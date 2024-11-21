<?php
/**
 * Demo Import Data
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function izeetak_import_files() {
    return array(
        array(
            'import_file_name'           => 'Demo Import',
            'import_file_url'            => 'https://tplabs.co/izeetak/_demos/content.xml',
            'import_widget_file_url'     => 'https://tplabs.co/izeetak/_demos/widget.wie',
            'import_customizer_file_url' => 'https://tplabs.co/izeetak/_demos/options.dat',
            'import_preview_image_url'   => 'https://tplabs.co/izeetak/_demos/preview-import.png',
            'preview_url'                => 'https://tplabs.co/izeetak/',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'izeetak_import_files' );

function izeetak_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home 01' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    // Replace URL for Elementor Widget
    izeetak_replace_url();

}
add_action( 'pt-ocdi/after_import', 'izeetak_after_import_setup' );