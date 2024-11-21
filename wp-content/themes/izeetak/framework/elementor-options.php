<?php
namespace izeetak\Settings;

if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow as Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

class Izeetak_Settings
{

    public function __construct()
    {	
    	add_action('elementor/documents/register_controls', [$this, 'izeetak_register_settings'], 10);
    }

    public function izeetak_register_settings($element)
    {	 	
    	$post_id = $element->get_id();
    	$post_type = get_post_type($post_id);

        //if ( !is_singular( 'header' ) && !is_singular( 'footer' ) )
            $this->izeetak_general_settings($element);

    	if ( $post_type == 'page' )
    		$this->izeetak_page_settings($element);

    	if ( is_singular( 'project' ) ) 
    		$this->izeetak_project_settings($element);

        if ( is_singular( 'post' ) ) {
            $this->izeetak_post_settings($element);
        }	
    }

    public function izeetak_general_settings($element) {
        $element->start_controls_section(
            'izeetak_general_settings',
            [
                'label' => esc_html__('Page Settings', 'izeetak'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'page_accent_color',
            [
                'label' => esc_html__( 'Accent Color', 'izeetak' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--e-global-color-izeetak_accent_h1: {{VALUE}}'
                ]
            ]
        );

        $element->add_control(
            'layout',
            [
                'label'     => esc_html__( 'Layout', 'izeetak'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'site_layout_position',
            [
                'label' => esc_html__( 'Sidebar Position', 'izeetak' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'sidebar-left' => [
                        'title' => esc_html__( 'Sidebar Left', 'izeetak' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'no-sidebar' => [
                        'title' => esc_html__( 'No Sidebar', 'izeetak' ),
                        'icon' => 'eicon-ban',
                    ],
                    'sidebar-right' => [
                        'title' => esc_html__( 'Sidebar Right', 'izeetak' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
            ]
        );

        // Featured Title
        $element->add_control(
            'featured_title_heading',
            [
                'label'     => esc_html__( 'Featured Title', 'izeetak'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'hide_featured_title',
            [
                'label'     => esc_html__( 'Hide?', 'izeetak'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'none'       => esc_html__( 'Yes', 'izeetak'),
                    'block'      => esc_html__( 'No', 'izeetak'),
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'featured_title_bg',
                'label' => esc_html__( 'Background', 'izeetak' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #featured-title',
                'condition' => [ 'hide_featured_title' => 'block' ]
            ]
        );

        $element->add_control(
            'custom_featured_title',
            [
                'label'   => esc_html__( 'Custom Title', 'izeetak' ),
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
                'condition' => [ 'hide_featured_title' => 'block' ]
            ]
        );

        $element->add_control(
            'main_content_heading',
            [
                'label'     => esc_html__( 'Main Content', 'izeetak'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__('Content Padding', 'izeetak'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'allowed_dimensions' => [ 'top', 'bottom' ],
                'selectors' => [ 
                    '{{WRAPPER}} #page #main-content' => 'padding-top: {{TOP}}{{UNIT}}; padding-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );

        $element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'main_content_bg',
                'label' => esc_html__( 'Background', 'izeetak' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} #main-content',
            ]
        );

        $element->end_controls_section();
    }

    public function izeetak_page_settings($element) {
        $header_style = array( 
            '0'      => esc_html__( 'Default', 'izeetak'),
        );
        $header_fixed = array( 
            '0'      => esc_html__( 'Default', 'izeetak'),
            '1'      => esc_html__( 'None', 'izeetak' ) 
        );
        $args = array(  
            'post_type' => 'header',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        );

        $loop = new \WP_Query( $args ); 
        while ( $loop->have_posts() ) : $loop->the_post(); 
            $header_style[get_the_id()] = get_the_title();
            $header_fixed[get_the_id()] = get_the_title();
        endwhile;
        wp_reset_postdata();

        $footer_style = array( 
            '0'      => esc_html__( 'Default', 'izeetak'), 
        );
        $args = array(  
            'post_type' => 'footer',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        );

        $loop = new \WP_Query( $args ); 
        while ( $loop->have_posts() ) : $loop->the_post(); 
            $footer_style[get_the_id()] = get_the_title();
        endwhile;
        wp_reset_postdata();

        // Header
        $element->start_controls_section(
            'izeetak_hf_settings',
            [
                'label' => esc_html__('Header & Footer', 'izeetak'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'header_heading',
            [
                'label'     => esc_html__( 'Header', 'izeetak'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        );

        $element->add_control(
            'header_float',
            [
                'label' => esc_html__( 'Header Float?', 'izeetak' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'izeetak' ),
                'label_off' => esc_html__( 'No', 'izeetak' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'header_style',
            [
                'label'     => esc_html__( 'Header Style', 'izeetak'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => $header_style,
                'render_type' => 'template'
            ]
        );

        $element->add_control(
            'header_fixed',
            [
                'label'     => esc_html__( 'Header Fixed', 'izeetak'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => $header_style
            ]
        );

        $element->add_control(
            'footer_heading',
            [
                'label'     => esc_html__( 'Footer', 'izeetak'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

        $element->add_control(
            'footer_hide',
            [
                'label'     => esc_html__( 'Hide Footer', 'izeetak'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'show',
                'options'   => [
                    'show'    => esc_html__( 'Show', 'izeetak'),
                    'hide'    => esc_html__( 'Hide', 'izeetak'),
                ]
            ]
        );

        $element->add_control(
            'footer_style',
            [
                'label'     => esc_html__( 'Footer Style', 'izeetak'),
                'type'      => Controls_Manager::SELECT,
                'default'   => '0',
                'options'   => $footer_style,
                'condition' => [
                    'footer_hide' => 'show'
                ]
            ]
        );

        $element->end_controls_section();
    }

    public function izeetak_project_settings($element) {
    	$element->start_controls_section(
            'izeetak_project_settings',
            [
                'label' => esc_html__('Project Settings', 'izeetak'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'project_hide_image',
            [
                'label'     => esc_html__( 'Featured Image', 'izeetak'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'block'         => esc_html__( 'Show', 'izeetak'),
                    'none'          => esc_html__( 'Hide', 'izeetak'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-media' => 'display: {{VALUE}}'
                ]
            ]
        );

        $element->add_control(
            'project_hide_title',
            [
                'label'     => esc_html__( 'Project Title', 'izeetak'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'block',
                'options'   => [
                    'block'         => esc_html__( 'Show', 'izeetak'),
                    'none'          => esc_html__( 'Hide', 'izeetak'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .post-title' => 'display: {{VALUE}}'
                ]
            ]
        );

        $element->add_control(
            'show_project_media_title',
            [
                'label' => esc_html__( 'Show Featured Image & Title ?', 'izeetak' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'izeetak' ),
                'label_off' => esc_html__( 'Hide', 'izeetak' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        

        $element->add_control(
            'project_desc',
            [
                'label'      => esc_html__( 'Short Description', 'izeetak' ),
                'type'       => Controls_Manager::WYSIWYG,
            ]
        );

        $element->end_controls_section();
    }

    public function izeetak_post_settings($element) {

        $element->start_controls_section(
            'izeetak_post_settings',
            [
                'label' => esc_html__('Post Settings', 'izeetak'),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );


        $element->add_control(
            'video_url',
            [
                'label'     => esc_html__( 'Video URL or Embeded Code', 'izeetak'),
                'type'      => Controls_Manager::TEXT,
                'default'   => '',
            ]
        );

        $element->add_control(
            'gallery_images',
            [
                'label' => esc_html__( 'Add Images', 'izeetak' ),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $element->end_controls_section();
    }
}

new Izeetak_Settings();