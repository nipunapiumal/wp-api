<?php
/**
 * Featured Title setting for Customizer
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Featured Title General
$this->sections['izeetak_featuredtitle_general'] = array(
	'title' => esc_html__( 'General', 'izeetak' ),
	'panel' => 'izeetak_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'izeetak' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'featured_title_style',
			'default' => 'simple',
			'control' => array(
				'label'  => esc_html__( 'Style', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'simple' => esc_html__( 'Simple', 'izeetak' ),
					'centered' => esc_html__( 'Centered', 'izeetak' ),
				),
				'active_callback' => 'izeetak_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'izeetak' ),
				'description' => esc_html__( 'Example: 250px 0px 150px 0px', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(min-width: 992px)',
				'target' => '#featured-title .inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'featured_title_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_background_img_style',
			'default' => 'repeat',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'izeetak' ),
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
				'active_callback' => 'izeetak_cac_has_featured_title',
			),
		),
	),
);

// Featured Title Headings
$this->sections['izeetak_featuredtitle_heading'] = array(
	'title' => esc_html__( 'Headings', 'izeetak' ),
	'panel' => 'izeetak_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_heading',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'izeetak' ),
				'type' => 'checkbox',
				'active_callback' => 'izeetak_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_heading_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Heading Bottom Margin', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_featured_title_center',
				'description' => esc_html__( 'Example: 30px.', 'izeetak' ),
			),
			'inline_css' => array(
				'target' => '#featured-title.centered .title-group',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'featured_title_heading_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .main-title',
				'alter' => 'color',
			),
		),
	),
);

// Featured Title Breadcrumbs
$this->sections['izeetak_featuredtitle_breadcrumbs'] = array(
	'title' => esc_html__( 'Breadcrumbs', 'izeetak' ),
	'panel' => 'izeetak_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_breadcrumbs',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'izeetak' ),
				'type' => 'checkbox',
				'active_callback' => 'izeetak_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title #breadcrumbs',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'izeetak' ),
				'active_callback' => 'izeetak_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a:hover',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'portfolio_page',
			'control' => array(
				'label'  => esc_html__( 'Projects', 'izeetak' ),
				'type' => 'select',
				'choices' => izeetak_get_pages(),
				'active_callback' => 'izeetak_cac_has_single_project',
			),
		),
	),
);