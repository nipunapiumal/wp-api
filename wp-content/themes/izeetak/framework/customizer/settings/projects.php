<?php
/**
 * Projects setting for Customizer
 *
 * @package izeetak
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Project General
$this->sections['izeetak_projects_general'] = array(
	'title' => esc_html__( 'General', 'izeetak' ),
	'panel' => 'izeetak_projects',
	'settings' => array(
		array(
			'id' => 'project_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Single Project: Featured Title Background', 'izeetak' ),
			),
		),
	),
);

// Project Related 
$this->sections['izeetak_projects_related'] = array(
	'title' => esc_html__( 'Related Projects', 'izeetak' ),
	'panel' => 'izeetak_projects',
	'settings' => array(
		array(
			'id' => 'project_related',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Related Project', 'izeetak' ),
				'type' => 'checkbox',
				'active_callback' => 'izeetak_cac_has_single_project',
			),
		),
		array(
			'id' => 'related_pre_title', 
			'default' => esc_html__( 'EXPLORE PROJECTS', 'izeetak' ),
			'control' => array(
				'label' => esc_html__( 'Project Related Pre-Title', 'izeetak' ),
				'type' => 'izeetak_textarea',
				'rows' => 3,
				'active_callback' => 'izeetak_cac_has_related_project',
			),
		),
		array(
			'id' => 'related_title',
			'default' => esc_html__( 'OUR RECENT PROJECTS', 'izeetak' ),
			'control' => array(
				'label' => esc_html__( 'Project Related Title', 'izeetak' ),
				'type' => 'izeetak_textarea',
				'rows' => 3,
				'active_callback' => 'izeetak_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_query',
			'default' => 7,
			'control' => array(
				'label' => esc_html__( 'Number of items', 'izeetak' ),
				'type' => 'number',
				'active_callback' => 'izeetak_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_column',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Columns', 'izeetak' ),
				'type' => 'select',
				'choices' => array(
					'4' => '4',
					'3' => '3',
					'2' => '2',
				),
				'active_callback' => 'izeetak_cac_has_related_project',
			),
		),
	),
);

// Project Related General
$this->sections['izeetak_projects_nav_links'] = array(
	'title' => esc_html__( 'Prev Next Links', 'izeetak' ),
	'panel' => 'izeetak_projects',
	'settings' => array(
		array(
			'id' => 'project_prev_next_links',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Prev-Next Links', 'izeetak' ),
				'type' => 'checkbox',
				'active_callback' => 'izeetak_cac_has_single_project',
			),
		),
		array(
			'id' => 'project_prev_text',
			'default' => esc_html__( 'Previous Link Text', 'izeetak' ),
			'control' => array(
				'label' => esc_html__( 'Previous', 'izeetak' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'project_next_text',
			'default' => esc_html__( 'Next Link Text', 'izeetak' ),
			'control' => array(
				'label' => esc_html__( 'Next', 'izeetak' ),
				'type' => 'text',
			),
		),
	),
);