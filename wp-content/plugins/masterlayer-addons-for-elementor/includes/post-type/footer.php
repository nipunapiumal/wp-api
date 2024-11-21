<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Register footer post type
function register_footer_post_type() {
    $footer_slug = 'footer';

    $labels = array(
        'name'               => esc_html__( 'Footer', 'masterlayer' ),
        'singular_name'      => esc_html__( 'Footer Item', 'masterlayer' ),
        'add_new'            => esc_html__( 'Add New', 'masterlayer' ),
        'add_new_item'       => esc_html__( 'Add New Item', 'masterlayer' ),
        'new_item'           => esc_html__( 'New Item', 'masterlayer' ),
        'edit_item'          => esc_html__( 'Edit Item', 'masterlayer' ),
        'view_item'          => esc_html__( 'View Item', 'masterlayer' ),
        'all_items'          => esc_html__( 'All Items', 'masterlayer' ),
        'search_items'       => esc_html__( 'Search Items', 'masterlayer' ),
        'parent_item_colon'  => esc_html__( 'Parent Items:', 'masterlayer' ),
        'not_found'          => esc_html__( 'No items found.', 'masterlayer' ),
        'not_found_in_trash' => esc_html__( 'No items found in Trash.', 'masterlayer' )
    );

    $args = array(
        'labels'        => $labels,
        'rewrite'       => array( 'slug' => $footer_slug ),
        'supports'      => array( 'title', 'editor', 'thumbnail' ),
        'public'        => true,
        'menu_icon'     => 'dashicons-editor-table'
    );

    register_post_type( 'footer', $args );
}

add_action('init', 'register_footer_post_type');

// footer update messages.
function footer_updated_messages( $messages ) {
    $post             = get_post();
    $post_type        = get_post_type( $post );
    $post_type_object = get_post_type_object( $post_type );

    $messages['footer'] = array(
        0  => '', // Unused. Messages start at index 1.
        1  => esc_html__( 'Footer updated.', 'masterlayer' ),
        2  => esc_html__( 'Custom field updated.', 'masterlayer' ),
        3  => esc_html__( 'Custom field deleted.', 'masterlayer' ),
        4  => esc_html__( 'Footer updated.', 'masterlayer' ),
        5  => isset( $_GET['revision'] ) ? sprintf( esc_html__( 'Footer restored to revision from %s', 'masterlayer' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6  => esc_html__( 'Footer published.', 'masterlayer' ),
        7  => esc_html__( 'Footer saved.', 'masterlayer' ),
        8  => esc_html__( 'Footer submitted.', 'masterlayer' ),
        9  => sprintf(
            esc_html__( 'Footer scheduled for: <strong>%1$s</strong>.', 'masterlayer' ),
            date_i18n( esc_html__( 'M j, Y @ G:i', 'masterlayer' ), strtotime( $post->post_date ) )
        ),
        10 => esc_html__( 'Footer draft updated.', 'masterlayer' )
    );
    return $messages;
}

add_filter( 'post_updated_messages', 'Footer_updated_messages' );

// Register footer taxonomy
function register_footer_taxonomy() {
    $cat_slug = 'footer_category';

    $labels = array(
        'name'                       => esc_html__( 'Footer Categories', 'masterlayer' ),
        'singular_name'              => esc_html__( 'Category', 'masterlayer' ),
        'search_items'               => esc_html__( 'Search Categories', 'masterlayer' ),
        'menu_name'                  => esc_html__( 'Categories', 'masterlayer' ),
        'all_items'                  => esc_html__( 'All Categories', 'masterlayer' ),
        'parent_item'                => esc_html__( 'Parent Category', 'masterlayer' ),
        'parent_item_colon'          => esc_html__( 'Parent Category:', 'masterlayer' ),
        'new_item_name'              => esc_html__( 'New Category Name', 'masterlayer' ),
        'add_new_item'               => esc_html__( 'Add New Category', 'masterlayer' ),
        'edit_item'                  => esc_html__( 'Edit Category', 'masterlayer' ),
        'update_item'                => esc_html__( 'Update Category', 'masterlayer' ),
        'add_or_remove_items'        => esc_html__( 'Add or remove categories', 'masterlayer' ),
        'choose_from_most_used'      => esc_html__( 'Choose from the most used categories', 'masterlayer' ),
        'not_found'                  => esc_html__( 'No Category found.', 'masterlayer' ),
        'menu_name'                  => esc_html__( 'Categories', 'masterlayer' )
    );
    $args = array(
        'labels'        => $labels,
        'rewrite'       => array( 'slug'=>$cat_slug ),
        'hierarchical'  => true,
    );
    register_taxonomy( 'footer_category', 'footer', $args );
}

add_action( 'init', 'register_footer_taxonomy' );