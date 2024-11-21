<?php
/**
 * Layout setting for Customizer
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Layout Style
$this->sections['izeetak_layout_style'] = array(
	'title' => esc_html__( 'Layout Site', 'izeetak' ),
	'panel' => 'izeetak_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_style',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout Style', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'full-width' => esc_html__( 'Full Width','izeetak' ),
					'boxed' => esc_html__( 'Boxed','izeetak' )
				),
			),
		),
		array(
			'id' => 'site_layout_boxed_shadow',
			'control' => array(
				'label' => esc_html__( 'Box Shadow', 'izeetak' ),
				'type' => 'checkbox',
				'active_callback' => 'izeetak_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'site_layout_wrapper_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrapper Margin', 'izeetak' ),
				'desc' => esc_html__( 'Top Right Bottom Left. Default: 30px 0px 30px 0px.', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'wrapper_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Outer Background Color', 'izeetak' ),
				'type' => 'color',
				'active_callback' => 'izeetak_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'wrapper_background_img',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image', 'izeetak' ),
				'type' => 'image',
				'active_callback' => 'izeetak_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'wrapper_background_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image Style', 'izeetak' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'izeetak' ),
					'cover'        => esc_html__( 'Cover', 'izeetak' ),
					'center-top'        => esc_html__( 'Center Top', 'izeetak' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'izeetak' ),
					'fixed'        => esc_html__( 'Fixed Center', 'izeetak' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'izeetak' ),
					'repeat'       => esc_html__( 'Repeat', 'izeetak' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'izeetak' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'izeetak' ),
				),
				'active_callback' => 'izeetak_cac_has_boxed_layout',
			),
		),
	),
);

// Layout Position
$this->sections['izeetak_layout_position'] = array(
	'title' => esc_html__( 'Layout Position', 'izeetak' ),
	'panel' => 'izeetak_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Site Layout Position', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'izeetak' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'izeetak' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'izeetak' ),
				),
				'desc' => esc_html__( 'Specify layout for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings elementor when edit.', 'izeetak' )
			),
		),
		array(
			'id' => 'custom_page_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Custom Page Layout Position', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'izeetak' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'izeetak' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'izeetak' ),
				),
				'desc' => esc_html__( 'Specify layout for all custom pages.', 'izeetak' )
			),
		),
		array(
			'id' => 'single_post_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Single Post Layout Position', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'izeetak' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'izeetak' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'izeetak' ),
				),
				'desc' => esc_html__( 'Specify layout for all single post pages.', 'izeetak' )
			),
		),
		array(
			'id' => 'single_project_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Single Project Layout Position', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'izeetak' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'izeetak' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'izeetak' ),
				),
				'desc' => esc_html__( 'Specify layout for all single project pages.', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_single_project',
			),
		),
		array(
			'id' => 'single_service_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Single Service Layout Position', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'izeetak' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'izeetak' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'izeetak' ),
				),
				'desc' => esc_html__( 'Specify layout for all single service pages.', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_single_service',
			),
		),
	),
);

// Layout Widths
$this->sections['izeetak_layout_widths'] = array(
	'title' => esc_html__( 'Layout Widths', 'izeetak' ),
	'panel' => 'izeetak_layout',
	'settings' => array(
		array(
			'id' => 'site_desktop_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Container', 'izeetak' ),
				'type' => 'text',
				'desc' => esc_html__( 'Default: 1170px', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => array( 
					'.site-layout-full-width .izeetak-container',
					'.site-layout-boxed #page'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'left_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Content', 'izeetak' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 66%', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '#site-content',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'sidebar_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Sidebar', 'izeetak' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 28%', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '#sidebar',
				'alter' => 'width',
			),
		),
	),
);