<?php

// Sets up theme defaults and registers support for various WordPress features.
function izeetak_theme_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'izeetak', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Make Embed Responsive
	add_theme_support( 'responsive-embeds' );

	// Custom background color.
	add_theme_support( 'custom-background' );

	// Custom Header
	add_theme_support( 'custom-header' );

	// Enable woocommerce support
	add_theme_support( 'woocommerce' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'izeetak-post-standard', 1170, 705, true );
	add_image_size( 'izeetak-post-widget', 60, 60, true );
	add_image_size( 'izeetak-project-standard', 1170, 533, true );

	// Register menus
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'izeetak' ) );
	
	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
		'image',
		'gallery',
		'video'
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );
}
add_action( 'after_setup_theme', 'izeetak_theme_setup' );

// Enqueues scripts and styles.
function izeetak_theme_scripts() {
	// Core style & script for theme
	wp_enqueue_style( 'animsition', get_template_directory_uri() . '/assets/css/animsition.css', array(), '4.0.1' );

	wp_enqueue_style( 'elementor-icons-core', get_template_directory_uri() . '/assets/css/core-icons.css', array(), '1.0.0' );
	wp_enqueue_script( 'animsition', get_template_directory_uri() . '/assets/js/animsition.js', array('jquery'), '4.0.1', true );
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/assets/js/easing.js', array('jquery'), '1.3.0', true );

	// Theme Style
	wp_enqueue_style( 'izeetak-theme-style', get_stylesheet_uri(), array(), '1.0' );
	wp_add_inline_style( 'izeetak-theme-style', apply_filters( 'izeetak_custom_colors_css', null ) );

	// Theme Script
	wp_enqueue_script( 'izeetak-theme-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0', true );

	// Carousel
	$post_format = get_post_format();
	if ( (is_single() && ( 'post-gallery' == $post_format )) ||
		(is_singular('project') && izeetak_get_mod( 'project_related', false )) ) {
		wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.0.0' );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'izeetak-slide', get_template_directory_uri() . '/assets/js/slide.js', array('jquery'), '1.0.0', true );
	}

	// Woocommerce
    if ( class_exists( 'woocommerce' ) ) {
    	if ( izeetak_is_woocommerce_page() || 
	    	izeetak_is_woocommerce_shop() || 
	    	izeetak_is_woocommerce_archive_product() ||
	    	is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
    		wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), '1.0' );
	    }
    }

	// Comment JS
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'izeetak_theme_scripts' );

// Registers a widget areas.
function izeetak_sidebars_init() {
	// Sidebar for Blog
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Blog', 'izeetak' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Add widgets here to appear in Sidebar Blog.', 'izeetak' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>'
	) );

	// Sidebar for Pages
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Page', 'izeetak' ),
		'id'			=> 'sidebar-page',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Page', 'izeetak' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// Sidebar for Portfolio
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Portfolio', 'izeetak' ),
		'id'			=> 'sidebar-portfolio',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Portfolio', 'izeetak' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// Sidebar for Services
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Service', 'izeetak' ),
		'id'			=> 'sidebar-service',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Service', 'izeetak' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// Sidebar for Shop
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Shop', 'izeetak' ),
		'id'			=> 'sidebar-shop',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Shop', 'izeetak' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	// 4 Sidebars for Footer
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 1', 'izeetak' ),
		'id'			=> 'sidebar-footer-1',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 1', 'izeetak' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 2', 'izeetak' ),
		'id'			=> 'sidebar-footer-2',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 2', 'izeetak' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 3', 'izeetak' ),
		'id'			=> 'sidebar-footer-3',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 3', 'izeetak' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Footer 4', 'izeetak' ),
		'id'			=> 'sidebar-footer-4',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 4', 'izeetak' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );
}
add_action( 'widgets_init', 'izeetak_sidebars_init' );

// Include required files.
require( get_template_directory() . '/framework/get-mods.php' );
require( get_template_directory() . '/framework/theme-hooks.php' );
require( get_template_directory() . '/framework/theme-functions.php' );
require( get_template_directory() . '/framework/theme-admin.php' );
require( get_template_directory() . '/framework/fonts.php' );
require( get_template_directory() . '/framework/typography.php' );
require( get_template_directory() . '/framework/accent-color.php' );
require( get_template_directory() . '/framework/customizer/customizer.php' );
require( get_template_directory() . '/framework/elementor-options.php' );
require( get_template_directory() . '/framework/widget-areas.php' );
require( get_template_directory() . '/framework/breadcrumbs.php' );
require( get_template_directory() . '/framework/plugins.php' );
require( get_template_directory() . '/framework/theme-woocommerce.php' );
require( get_template_directory() . '/framework/demo-install.php' );

// Update checker
require( get_template_directory() . '/framework/update-checker/plugin-update-checker.php');
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$settings = get_option('izeetak_activate_settings');
$code = isset($settings['izeetak_code_purchase']) ? $settings['izeetak_code_purchase'] : '';
$site_url = parse_url(get_home_url());
$web = $site_url['host'];

$url = 'https://tplabs.co/api/checkUpdate?theme=izeetak&code=' . $code . '&web=' . $web;

$MAEUpdateChecker = PucFactory::buildUpdateChecker(
	$url,
	get_template_directory() . '/functions.php', 
	'izeetak'
);

// //subscriber redirects to custom page
// function custom_login_redirect( $redirect_to, $request, $user ) {
//     // Check if user is logged in and is a subscriber
//     if ( isset( $user->roles ) && in_array( 'subscriber', $user->roles ) ) {
//         // Redirect non-admin users to a custom page
//         return home_url('/api-key-generator/');
//     }

//     // Default redirect for admin or others
//     return $redirect_to;
// }
// add_filter( 'login_redirect', 'custom_login_redirect', 10, 3 );

//custom api template css/js
function enqueue_custom_template_styles() {
    wp_enqueue_style('custom-api-template-style', get_template_directory_uri() . '/assets/css/custom-api-template.css', array());
}
add_action('wp_enqueue_scripts', 'enqueue_custom_template_styles');


//checkable tree
// function enqueue_checkable_tree_assets() {
//     if ( is_page_template( 'custom-api-template.php' ) ) {
//         wp_enqueue_style( 'checkable-tree-css', 'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css' );
//         wp_enqueue_script( 'jquery' );
//         wp_enqueue_script( 'jstree', 'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js', [ 'jquery' ], null, true );
//         wp_enqueue_script( 'custom-tree-js', get_template_directory_uri() . '/assets/js/custom-api-template.js', [ 'jquery', 'jstree' ], null, true );
//     }
// }
// add_action( 'wp_enqueue_scripts', 'enqueue_checkable_tree_assets' );

function enqueue_modern_tree_assets() {
    if (is_page_template('custom-api-template.php')) {
        // CSS for jsTree
        wp_enqueue_style('jstree-style', 'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/themes/default/style.min.css');
        
        // JavaScript Libraries
        wp_enqueue_script('jquery');
        wp_enqueue_script('jstree', 'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.12/jstree.min.js', ['jquery'], null, true);
        
        // Custom JavaScript
        wp_enqueue_script('modern-tree-script', get_template_directory_uri() . '/assets/js/custom-api-template.js', ['jquery', 'jstree'], null, true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_modern_tree_assets');


