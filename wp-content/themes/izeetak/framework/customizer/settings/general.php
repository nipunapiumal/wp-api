<?php
/**
 * General setting for Customizer
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Accent Colors
$this->sections['izeetak_Accent_Colors'] = array(
	'title' => esc_html__( 'Accent Colors', 'izeetak' ),
	'panel' => 'izeetak_general',
	'settings' => array(
		array(
			'id' => 'accent_color',
			'default' => '#1989FB',
			'control' => array(
				'label' => esc_html__( 'Accent Color', 'izeetak' ),
				'type' => 'color',
				'active_callback' => 'izeetak_cac_no_elementor_accent_color'
			),
		),
	)
);

// PreLoader
$this->sections['izeetak_preloader'] = array(
	'title' => esc_html__( 'PreLoader', 'izeetak' ),
	'panel' => 'izeetak_general',
	'settings' => array(
		array(
			'id' => 'preloader',
			'default' => 'animsition',
			'control' => array(
				'label' => esc_html__( 'Preloader Option', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'animsition' => esc_html__( 'Enable','izeetak' ),
					'' => esc_html__( 'Disable','izeetak' )
				),
			),
		),
		array(
			'id' => 'preload_color_1',
			'default' => '#1989FB',
			'control' => array(
				'label' => esc_html__( 'Color 1', 'izeetak' ),
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => '.animsition-loading',
				'alter' => 'border-top-color',
			),
		),
		array(
			'id' => 'preload_color_2',
			'default' => '#42D9BE',
			'control' => array(
				'label' => esc_html__( 'Color 2', 'izeetak' ),
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => '.animsition-loading:before',
				'alter' => 'border-top-color',
			),
		),
	)
);

// Header Site
$header_style = array( '1' => esc_html__( 'Basic', 'izeetak' ) );
$header_fixed = array( '1' => esc_html__( 'None', 'izeetak' ));
$args = array(  
    'post_type' => 'header',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
);

$loop = new WP_Query( $args ); 
while ( $loop->have_posts() ) : $loop->the_post(); 
	$header_style[get_the_id()] = get_the_title();
	$header_fixed[get_the_id()] = get_the_title();
endwhile;
wp_reset_postdata();

$this->sections['izeetak_header_site'] = array(
	'title' => esc_html__( 'Header', 'izeetak' ),
	'panel' => 'izeetak_general',
	'settings' => array(
		array(
			'id' => 'header_site_style',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Style', 'izeetak' ),
				'type' => 'select',
				'choices' => $header_style,
				'desc' => esc_html__( 'Header Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings Elementor when edit.', 'izeetak' )
			),
		),
		array(
			'id' => 'header_fixed',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Fixed', 'izeetak' ),
				'type' => 'select',
				'choices' => $header_fixed,
				'active_callback' => 'izeetak_cac_header_elementor_builder'
			),
		),
	),
);

// Footer
$footer_style = array( '1' => esc_html__( 'Basic', 'izeetak' ) );
$args = array(  
    'post_type' => 'footer',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
);

$loop = new WP_Query( $args ); 
while ( $loop->have_posts() ) : $loop->the_post(); 
	$footer_style[get_the_id()] = get_the_title();
endwhile;
wp_reset_postdata();

$this->sections['izeetak_footer_site'] = array(
	'title' => esc_html__( 'Footer', 'izeetak' ),
	'panel' => 'izeetak_general',
	'settings' => array(
		array(
			'id' => 'footer_site_style',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Style', 'izeetak' ),
				'type' => 'select',
				'choices' => $footer_style,
				'desc' => esc_html__( 'Footer Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings Elementor when edit.', 'izeetak' )
			),
		),
	),
);

// Scroll to top
$this->sections['izeetak_scroll_top'] = array(
	'title' => esc_html__( 'Scroll Top Button', 'izeetak' ),
	'panel' => 'izeetak_general',
	'settings' => array(
		array(
			'id' => 'scroll_top',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'izeetak' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Forms
$this->sections['izeetak_general_forms'] = array(
	'title' => esc_html__( 'Forms', 'izeetak' ),
	'panel' => 'izeetak_general',
	'settings' => array(
		array(
			'id' => 'input_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'input_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'input_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'input_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'izeetak' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 1px', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'input_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'color',
			),
		),
	),
);

// Responsive
$this->sections['izeetak_responsive'] = array(
	'title' => esc_html__( 'Responsive', 'izeetak' ),
	'panel' => 'izeetak_general',
	'settings' => array(
		// Mobile Logo
		array(
			'id' => 'heading_mobile_logo',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Mobile Logo', 'izeetak' ),
				'active_callback' => 'izeetak_cac_header_basic'
			),
		),
		array(
			'id' => 'mobile_logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Width', 'izeetak' ),
				'description' => esc_html__( 'Example: 150px', 'izeetak' ),
				'active_callback' => 'izeetak_cac_header_basic'
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo',
				'alter' => 'max-width',
			),
		),
		array(
			'id' => 'mobile_logo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Margin', 'izeetak' ),
				'description' => esc_html__( 'Example: 20px 0px 20px 0px', 'izeetak' ),
				'active_callback' => 'izeetak_cac_header_basic'
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo-inner',
				'alter' => 'margin',
			),
		),
		// Mobile Menu
		array(
			'id' => 'heading_mobile_menu',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Mobile Menu', 'izeetak' ),
				'active_callback' => 'izeetak_cac_header_basic'
			),
		),
		array(
			'id' => 'mobile_menu_item_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Height', 'izeetak' ),
				'description' => esc_html__( 'Example: 40px', 'izeetak' ),
				'active_callback' => 'izeetak_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav-mobi ul > li > a',
					'#main-nav-mobi .menu-item-has-children .arrow'
				),
				'alter' => 'line-height'
			),
		),
		array(
			'id' => 'mobile_menu_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo', 'izeetak' ),
				'active_callback' => 'izeetak_cac_header_basic',
				'type' => 'image',
			),
		),
		array(
			'id' => 'mobile_menu_logo_width',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo: Width', 'izeetak' ),
				'type' => 'text',
				'active_callback' => 'izeetak_cac_header_basic'
			),
		),
		// Featured Title
		array(
			'id' => 'heading_featured_title',
			'control' => array(
				'type' => 'izeetak-heading',
				'label' => esc_html__( 'Mobile Featured Title', 'izeetak' ),
			),
		),
		array(
			'id' => 'mobile_featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'izeetak' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#featured-title .inner-wrap, #featured-title.centered .inner-wrap, #featured-title.creative .inner-wrap',
				'alter' => 'padding',
			),
		),
	)
);

// 404 Page
$this->sections['izeetak_404_page'] = array(
	'title' => esc_html__( '404 Page', 'izeetak' ),
	'panel' => 'izeetak_general',
	'settings' => array(
		array(
			'id' => '404_image',
			'default' => '',
			'control' => array(
				'label' => esc_html__( '404 Image', 'izeetak' ),
				'type' => 'image',
			),
		),
		array(
			'id' => '404_image_max_width',
			'control' => array(
				'label' => esc_html__( '404 Image: Width', 'izeetak' ),
				'type' => 'text',
			),
		),
	)
);
