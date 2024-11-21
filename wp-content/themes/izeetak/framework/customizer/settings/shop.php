<?php
/**
 * Shop setting for Customizer
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Main Shop
$this->sections['izeetak_shop_general'] = array(
	'title' => esc_html__( 'Main Shop', 'izeetak' ),
	'panel' => 'izeetak_shop',
	'settings' => array(
		array(
			'id' => 'shop_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Layout Position', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'izeetak' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'izeetak' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'izeetak' ),
				),
				'desc' => esc_html__( 'Specify layout for main shop page.', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title',
			'default' => esc_html__( 'Our Shop', 'izeetak' ),
			'control' => array(
				'label' => esc_html__( 'Shop: Featured Title', 'izeetak' ),
				'type' => 'izeetak_textarea',
				'active_callback' => 'izeetak_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop: Featured Title Background', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_products_per_page',
			'default' => 6,
			'control' => array(
				'label' => esc_html__( 'Products Per Page', 'izeetak' ),
				'type' => 'number',
				'active_callback' => 'izeetak_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Shop Columns', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'izeetak_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Bottom Margin', 'izeetak' ),
				'description' => esc_html__( 'Example: 30px.', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_woo',
			),
			'inline_css' => array(
				'target' => '.products li',
				'alter' => 'margin-top',
			),
		),
	),
);

// Single Shop
$this->sections['izeetak_single_shop_general'] = array(
	'title' => esc_html__( 'Single Shop', 'izeetak' ),
	'panel' => 'izeetak_shop',
	'settings' => array(
		array(
			'id' => 'shop_single_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Single Layout Position', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'izeetak' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'izeetak' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'izeetak' ),
				),
				'desc' => esc_html__( 'Specify layout on the shop single page.', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title',
			'default' => esc_html__( 'Our Shop', 'izeetak' ),
			'control' => array(
				'label' => esc_html__( 'Shop Single: Featured Title', 'izeetak' ),
				'type' => 'text',
				'active_callback' => 'izeetak_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Shop Single: Featured Title Background', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_realted_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Related Product Columns', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'izeetak_cac_has_woo',
			),
		),
	),
);