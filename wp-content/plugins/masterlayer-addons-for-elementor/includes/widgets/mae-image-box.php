<?php
/*
Widget Name: Image Box
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-masterlayer/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Image_Box_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-image-box';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Image Box', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-image-box';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    } 

    protected function register_controls() {

        // Content Section
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Content', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'title',
                [
                    'label'   => __( 'Title', 'masterlayer' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => __( 'Box Title', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true,
                    ],
                    'label_block' => true
                ]
            );

            $this->add_control(
                'url_type',
                [
                    'label'     => __( 'URL Type', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'button',
                    'options'   => [
                        'none'      => __( 'None', 'masterlayer'),
                        'link'      => __( 'Link', 'masterlayer'),
                        'button'    => __( 'Button', 'masterlayer'),
                        'arrow'     => __( 'Icon Button on Image', 'masterlayer'),
                    ],
                    'separator' => 'before'
                ]
            );

            $this->add_control(
                'url_text',
                [
                    'label'     => __( 'URL Text', 'masterlayer'),
                    'type'      => Controls_Manager::TEXT,
                    'dynamic'   => [
                        'active'   => true,
                    ],
                    'default'   => __( 'Learn More', 'masterlayer'),
                    'condition' => [ 'url_type!' => [ 'none', 'arrow' ] ]
                ]
            );

            $this->add_control(
                'url',
                [
                    'label'      => __( 'URL', 'masterlayer'),
                    'type'       => Controls_Manager::URL,
                    'dynamic'    => [
                        'active'        => true,
                        'categories'    => [
                            TagsModule::POST_META_CATEGORY,
                            TagsModule::URL_CATEGORY
                        ],
                    ],
                    'placeholder'       => 'https://www.your-link.com',
                    'default'           => [
                        'url' => '#',
                    ],
                    'condition' => [ 'url_type!' => 'none' ]
                ]
            );

            $this->add_control(
                'image',
                [
                    'label'   => __( 'Image', 'masterlayer' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [ 'url' => Utils::get_placeholder_image_src(), ]
                ],
            );

            $this->add_control(
                'desc',
                [
                    'label'      => __( 'Description', 'masterlayer' ),
                    'type'       => Controls_Manager::WYSIWYG,
                    'default'    => __( 'We believe architecture and design are critically important to addressing the most pressing challenges of our time.', 'masterlayer' ),
                    'dynamic' => [
                        'active' => true,
                    ]
                ]
            );

            $this->end_controls_section();

        // Style - General
            $this->start_controls_section( 'style_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'style',
                [
                    'label'     => __( 'Style', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'style-1',
                    'options'   => [
                        'style-1'      => __( 'Style 1', 'masterlayer'),
                        'style-2'      => __( 'Style 2', 'masterlayer'),
                        'style-3'      => __( 'Style 3', 'masterlayer'),
                    ],
                    'prefix_class' => 'image-box-'
                ]
            );

            if ( is_rtl() ) {
                $this->add_responsive_control(
                    'align',
                    [
                        'label' => __( 'Alignment', 'masterlayer' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'right'    => [
                                'title' => __( 'Left', 'masterlayer' ),
                                'icon' => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => __( 'Center', 'masterlayer' ),
                                'icon' => 'eicon-text-align-center',
                            ],
                            'left' => [
                                'title' => __( 'Right', 'masterlayer' ),
                                'icon' => 'eicon-text-align-right',
                            ],
                        ],
                        'prefix_class' => 'align-%s'
                    ]
                );
            } else {
                $this->add_responsive_control(
                    'align',
                    [
                        'label' => __( 'Alignment', 'masterlayer' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            'left'    => [
                                'title' => __( 'Left', 'masterlayer' ),
                                'icon' => 'eicon-text-align-left',
                            ],
                            'center' => [
                                'title' => __( 'Center', 'masterlayer' ),
                                'icon' => 'eicon-text-align-center',
                            ],
                            'right' => [
                                'title' => __( 'Right', 'masterlayer' ),
                                'icon' => 'eicon-text-align-right',
                            ],
                        ],
                        'prefix_class' => 'align-%s'
                    ]
                );
            }

            $this->add_control(
                'sep',
                [
                    'label'     => __( 'Separator', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'none',
                    'options'   => [
                        'none'         => __( 'None', 'masterlayer'),
                        'before'       => __( 'Before Title', 'masterlayer'),
                        'after'        => __( 'After Title', 'masterlayer'),
                    ],
                ]
            );

            $this->add_responsive_control(
                'sep_width',
                [
                    'label'      => __( 'Separator Width', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 200,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-text-box .sep' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'sep!' => 'none' ]
                ]
            );

            $this->end_controls_section();

        // Style - Color
            $this->start_controls_section( 'style_color_section',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'box_bg',
                [
                    'label' => __( 'Box Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box' => 'background-color: {{VALUE}};',
                    ]
                ]
            );
            
              $this->add_control(
                'bar_bg',
                [
                    'label' => __( 'Bar Background', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content-wrap:after' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => ['style' => 'style-3']
                ]
            );

            $this->start_controls_tabs( 'box' );

            // Normal
                $this->start_controls_tab(
                    'box_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'title_color',
                    [
                        'label' => __( 'Title Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-image-box .headline-2' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'desc_color',
                    [
                        'label' => __( 'Description Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-image-box .desc' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'sep_color',
                    [
                        'label' => __( 'Separator Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .sep' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [ 'sep!' => 'none' ]
                    ]
                );  

                $this->end_controls_tab();

            // Hover
                $this->start_controls_tab(
                    'service_box_hover',
                    [
                        'label' => __( 'Hover', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'title_color_hover',
                    [
                        'label' => __( 'Title Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-image-box:hover .headline-2' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'desc_color_hover',
                    [
                        'label' => __( 'Description Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-image-box:hover .desc' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'sep_color_hover',
                    [
                        'label' => __( 'Separator Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-icon-box:hover .sep' => 'background-color: {{VALUE}};',
                        ],
                        'condition' => [ 'sep!' => 'none' ]
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

        // Border & Shadow
            $this->start_controls_section( 'bs_style_section',
                [
                    'label' => __( 'Border & Shadow', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->start_controls_tabs( 'box1' );

                // Normal
                    $this->start_controls_tab(
                        'box1_normal',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'border',
                            'label' => __( 'Border', 'masterlayer' ),
                            'selector' => '{{WRAPPER}} .master-image-box',
                        ]
                    );

                    $this->add_control(
                        'border_radius',
                        [
                            'label' => __('Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .master-image-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow',
                            'selector' => '{{WRAPPER}} .master-image-box',
                        ]
                    );

                    $this->end_controls_tab();

                // Hover
                    $this->start_controls_tab(
                        'box1_hover',
                        [
                            'label' => __( 'Hover', 'masterlayer' ),
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'border_hover',
                            'label' => __( 'Border', 'masterlayer' ),
                            'selector' => '{{WRAPPER}} .master-image-box:hover',
                        ]
                    );

                    $this->add_control(
                        'border_radius_hover',
                        [
                            'label' => __('Rounded', 'masterlayer'),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => ['px', '%'],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .master-image-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'box_shadow_hover',
                            'selector' => '{{WRAPPER}} .master-image-box:hover',
                        ]
                    );

                    $this->end_controls_tab();
                $this->end_controls_tabs();
            $this->end_controls_section();

        // URL
            $this->start_controls_section( 'setting_url_section',
                [
                    'label' => __( 'URL', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            // URL - Link
            if ( is_rtl() ) {
                $this->add_control(
                    'link_icon_position',
                    [
                        'label'     => __( 'Icon ?', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'none',
                        'options'   => [
                            'none'      => __( 'None', 'masterlayer'),
                            'left'      => __( 'Icon Right', 'masterlayer'),
                            'right'     => __( 'Icon Left', 'masterlayer')
                        ],
                        'condition' => [ 'url_type' => 'link' ]
                    ]
                );
            } else {
                $this->add_control(
                    'link_icon_position',
                    [
                        'label'     => __( 'Icon ?', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'none',
                        'options'   => [
                            'none'      => __( 'None', 'masterlayer'),
                            'left'      => __( 'Icon Left', 'masterlayer'),
                            'right'     => __( 'Icon Right', 'masterlayer')
                        ],
                        'condition' => [ 'url_type' => 'link' ]
                    ]
                );
            }
            

            $this->add_control(
                'link_icon',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-right-arrow1',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_responsive_control(
                'link_icon_font_size',
                [
                    'label'      => __( 'Icon Font Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 50,
                        ],
                        '%' => [
                            'min' => 50,
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-link .icon ' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_margin',
                [
                    'label' => __('Icon Margin', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .master-link .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->start_controls_tabs( 'link_hover_tabs' );

            // Link normal
            $this->start_controls_tab(
                'link_normal',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_color',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link ' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_color',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->end_controls_tab();

            // Box hover
            $this->start_controls_tab(
                'link_box_hover',
                [
                    'label' => __( 'Box Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_color_box_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box:hover .master-link' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_color_box_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box:hover .master-link .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->end_controls_tab();

            // Link hover
            $this->start_controls_tab(
                'link_hover',
                [
                    'label' => __( 'URL Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'link' ]
                ]
            );

            $this->add_control(
                'link_color_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link:hover' => 'color: {{VALUE}} !important;',
                    ],
                    'condition' => [ 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->add_control(
                'link_icon_color_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-link:hover .icon' => 'color: {{VALUE}} !important;',
                    ],
                    'condition' => [ 
                        'link_icon_position!' => 'none', 
                        'url_type' => 'link',
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            // URL - Button
            $this->add_control(
                'button_style',
                [
                    'label'     => __( 'Style', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'btn-accent',
                    'options'   => [
                        'btn-accent'      => __( 'Accent', 'masterlayer'),
                        'btn-white'       => __( 'White', 'masterlayer'),
                        'btn-outline'     => __( 'Outline', 'masterlayer')
                    ],
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            if ( is_rtl() ) {
                $this->add_control(
                    'button_icon_position',
                    [
                        'label'     => __( 'Icon ?', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'none',
                        'options'   => [
                            'none'      => __( 'None', 'masterlayer'),
                            'left'      => __( 'Icon Right', 'masterlayer'),
                            'right'     => __( 'Icon Left', 'masterlayer')
                        ],
                        'condition' => [ 'url_type' => 'button' ]
                    ]
                );
            } else {
                $this->add_control(
                    'button_icon_position',
                    [
                        'label'     => __( 'Icon ?', 'masterlayer'),
                        'type'      => Controls_Manager::SELECT,
                        'default'   => 'none',
                        'options'   => [
                            'none'      => __( 'None', 'masterlayer'),
                            'left'      => __( 'Icon Left', 'masterlayer'),
                            'right'     => __( 'Icon Right', 'masterlayer')
                        ],
                        'condition' => [ 'url_type' => 'button' ]
                    ]
                );
            }
            

            $this->add_control(
                'button_icon',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-right-arrow1',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_responsive_control(
                'button_icon_font_size',
                [
                    'label'      => __( 'Icon Font Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 50,
                        ],
                        '%' => [
                            'min' => 50,
                            'max' => 150,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-button .icon ' => 'font-size: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_margin',
                [
                    'label' => __('Icon Margin', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px'],
                    'selectors' => [
                        '{{WRAPPER}} .master-button .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->start_controls_tabs( 'button_hover_tabs' );

            // Button normal
            $this->start_controls_tab(
                'button_normal',
                [
                    'label' => __( 'Normal', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_color',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button .content-base' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_color',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_bg_color',
                [
                    'label' => __( 'Background Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_rounded',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_border_color',
                [
                    'label' => __( 'Border Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_control(
                'button_border_width',
                [
                    'label' => __('Border Width', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow',
                    'selector' => '{{WRAPPER}} .master-button',
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->end_controls_tab();

            // Box hover
            $this->start_controls_tab(
                'button_box_hover',
                [
                    'label' => __( 'Box Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_color_box_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box:hover .master-button .content-base' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_color_box_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box:hover .master-button .content-base .icon' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_bg_color_box_hover',
                [
                    'label' => __( 'Background Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box:hover .master-button' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_rounded_box_hover',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box:hover .master-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_border_color_box_hover',
                [
                    'label' => __( 'Border Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box:hover .master-button' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_control(
                'button_border_width_box_hover',
                [
                    'label' => __('Border Width', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box:hover .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow_box_hover',
                    'selector' => '{{WRAPPER}} .master-image-box:hover .master-button',
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->end_controls_tab();

            // Button hover
            $this->start_controls_tab(
                'button_hover',
                [
                    'label' => __( 'URL Hover', 'masterlayer' ),
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->add_control(
                'button_color_hover',
                [
                    'label' => __( 'Text Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button:hover' => 'color: {{VALUE}} !important;',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_icon_color_hover',
                [
                    'label' => __( 'Icon Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-button:hover .icon' => 'color: {{VALUE}} !important;',
                    ],
                    'condition' => [ 
                        'button_icon_position!' => 'none', 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_bg_color_hover',
                [
                    'label' => __( 'Background Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box .master-button:hover' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_rounded_hover',
                [
                    'label' => __('Rounded', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box .master-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                    ]
                ]
            );

            $this->add_control(
                'button_border_color_hover',
                [
                    'label' => __( 'Border Color', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box .master-button:hover' => 'border-color: {{VALUE}};'
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_control(
                'button_border_width_hover',
                [
                    'label' => __('Border Width', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'top' => 1,
                        'right' => 1,
                        'bottom' => 1,
                        'left' => 1,
                        'unit' => 'px',
                        'isLinked' => true
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box .master-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'condition' => [ 
                        'url_type' => 'button',
                        'button_style' => [ 'btn-outline' ]
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'button_box_shadow_hover',
                    'selector' => '{{WRAPPER}} .master-image-box .master-button:hover',
                    'condition' => [ 'url_type' => 'button' ]
                ]
            );

            $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

        // Spacing
            $this->start_controls_section( 'setting_spacing_section',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_control(
                'padding',
                [
                    'label' => __('Content Padding', 'masterlayer'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box .content-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'title_space',
                [
                    'label' => __( 'Title', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'defautl' => [
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box .headline-2' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [ 'title!' => '' ]
                ]
            );

            $this->add_responsive_control(
                'desc_space',
                [
                    'label' => __( 'Description', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'defautl' => [
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .master-image-box .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [ 'desc!' => '' ]
                ]
            );

            $this->add_responsive_control(
                'sep_space',
                [
                    'label' => __( 'Separator', 'masterlayer' ),
                    'type' => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'defautl' => [
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .sep' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [ 'sep!' => 'none' ]
                ]
            );

            $this->end_controls_section();

        // Typography
            $this->start_controls_section( 'setting_typography_section',
                [
                    'label' => __( 'Typography', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'headline_typography',
                    'label' => __('Heading', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .headline-2'
                ],
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_typography',
                    'label' => __('Description', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .desc'
                ],
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'link_typography',
                    'label' => __('Link', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .master-link',
                    'condition' => [ 'url_type' => 'link' ]
                ],
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'label' => __('Button', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .master-button',
                    'condition' => [ 'url_type' => 'button' ]
                ],
            );

            $this->end_controls_section();
    }

    protected function render() {
        $config = array();
        $cls = $css = $data = "";
        $settings = $this->get_settings_for_display();

        $html = $title = $content = $image = $url = "";
        
        // Title
        if ($settings['title'])
            $title = sprintf('<h3 class="headline-2">%1$s</h3>', 
                $settings['title'] );

        //Separator
        if ($settings['sep'] !== 'none')
            $sep = '<div class="sep"></div>';

        // Description
        if ($settings['desc'])
            $content = sprintf('<div class="desc">%1$s</div>', 
                $settings['desc'] );

        // Image URL
        if ($settings['image']['id']) {
            $image = sprintf('<div class="thumb"><div class="inner">%1$s</div></div>', 
                wp_get_attachment_image( $settings['image']['id'], 'full' ) );
        } else {
            $image = sprintf('<div class="thumb"><img alt="Image" src="%1$s" ></div>', 
                esc_url( $settings['image']['url'] ) );
        }

        // URL
        if ($settings['url_type'] != 'none')
            $url = $this->render_link( $settings['url']['url'], $settings['url_text']);
        
        if ( $settings['url_type'] == 'arrow' ) {
            $image = sprintf('<div class="thumb">%1$s<div class="url-wrap"><a class="arrow" href="%2$s"></a></div></div>', 
                wp_get_attachment_image( $settings['image']['id'], 'full' ), 
                esc_url( $settings['url']['url'] )
            );
        }
        // HTML render

        ?>
        <div class="master-image-box <?php echo esc_attr($cls); ?>">
            <?php echo $image; ?>

            <div class="content-wrap">
                <?php
                if ($settings['sep'] == 'before') echo $sep;
                echo $title;
                if ($settings['sep'] == 'after') echo $sep;
                echo $content;
                echo $url;
                ?>
            </div>
        </div>

        <?php
    }

    public function render_link( $url, $text ) {
        $link = $this->get_settings_for_display();

        if ($link['url_type'] == 'link') {
            $cls = $url_attr = "";
            $cls .= ' icon-' . $link['link_icon_position'];

            if ( $link['url']['is_external'] ) {
                $url_attr .= 'target="_blank" ';
            }

            if ( ! empty( $link['url']['nofollow'] ) ) {
                $url_attr .= 'rel="nofollow" ';
            }

            $link_icon = '';
            if ($link['link_icon'])  {
                $link_icon = sprintf('<span class="icon %1$s"></span>', $link['link_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-link <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>" <?php echo esc_attr($url_attr); ?>>
                    <?php if ( $link['link_icon_position'] == 'left' ) echo $link_icon; ?>
                    <span><?php echo $text; ?></span>
                    <?php if ( $link['link_icon_position'] == 'right' ) echo $link_icon; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        } else if ($link['url_type'] == 'button') {
            $button = $link;
            $cls = $url_attr = "";
            $cls .= $button['button_style'] . ' icon-' . $button['button_icon_position'];

            if ( $button['url']['is_external'] ) {
                $url_attr .= 'target="_blank" ';
            }

            if ( ! empty( $button['url']['nofollow'] ) ) {
                $url_attr .= 'rel="nofollow" ';
            }

            $button_icon = '';
            if ($button['button_icon'])  {
                $button_icon = sprintf('<span class="icon %1$s"></span>', $button['button_icon']['value']);
            }
            
            ob_start(); ?>
            <div class="url-wrap">
                <a class="master-button small <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>" <?php echo esc_attr($url_attr); ?>>
                    <span class="inner">
                        <span class="content-base">
                            <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                            <span class="text"><?php echo $text; ?></span>
                            <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                        </span>

                        <span class="content-hover">
                            <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                            <span class="text"><?php echo $text; ?></span>
                            <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                        </span>
                    </span>

                    <?php echo '<span class="bg-hover"></span>'; ?>
                </a>
            </div>

            <?php
            $return = ob_get_clean();
            return $return;
        }
        

    }

    protected function content_template() {}
}

