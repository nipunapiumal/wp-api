<?php
/*
Widget Name: Menu
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
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
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Menu_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-menu';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Nav Menu', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-nav-menu';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {
        // Content
            $arr = array();
            $menus = wp_get_nav_menus();
            foreach ( $menus as $menu ) {
                $arr[$menu->slug] = $menu->name;
            }

            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Nav Menu', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'menu_style',
                [
                    'label'     => __( 'Style', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'hamburger-on-mobi',
                    'options'   => [
                        'hamburger-on-mobi'   => __( 'Standard (Hamburger Icon on Mobile)', 'masterlayer'),
                        'default'             => __( 'Standard (No Hamburger Icon)', 'masterlayer'),
                        'hamburger'           => __( 'Hamburger Menu', 'masterlayer'),
                    ]
                ]
            );

            $this->add_control(
                'menu_icon',
                [
                    'label' => __( 'Hamburger Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'default' => [
                        'value' => 'ci-menu',
                        'library' => 'core',
                    ],
                    'condition' => ['menu_style!' => 'default']
                ]
            );

            $this->add_control(
                'menu_name',
                [
                    'label'     => __( 'Select Menu', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => '',
                    'options'   => $arr
                ]
            );

            $this->add_control(
                'menu_extra',
                [
                    'label'     => __( 'Search & Cart', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'none',
                    'options'   => [
                        'none'          => __( 'None', 'masterlayer'),
                        'search'        => __( 'Search', 'masterlayer'),
                        'cart'          => __( 'Cart', 'masterlayer'),
                        'both'          => __( 'Both', 'masterlayer')
                    ],
                ]
            );

            $this->add_control(
                'show_sep',
                [
                    'label' => __( 'Separator', 'masterlayer' ),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'masterlayer' ),
                    'label_off' => __( 'Hide', 'masterlayer' ),
                    'return_value' => 'yes',
                    'default' => 'no',
                    'prefix_class' => 'menu-sep-',
                    'condition' => [ 'menu_style' => 'default' ]
                ]
            );

            $this->end_controls_section();

        // Content - Hidden Menu
            $this->start_controls_section( 'content_section_hidden_menu',
                [
                    'label' => __( 'Hidden Menu', 'masterlayer' ),
                    'condition' => ['menu_style!' => 'default']
                ]
            );

            $this->add_control(
                'hidden_menu_review',
                [
                    'label'     => __( 'Show Hidden Menu (Editor Mode)', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => '-100%',
                    'options'   => [
                        '-100%'       => __( 'Hide', 'masterlayer'),
                        '0%'           => __( 'Show', 'masterlayer'),
                    ],
                    'selectors' => [ '.elementor-preview {{WRAPPER}} .izeetak-hamburger-menu .hidden-menu-wrap' => 'right: {{VALUE}}' ]
                ]
            );

            $this->add_control(
                'hidden_menu_logo',
                [
                    'label'     => __( 'Logo', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'none',
                    'options'   => [
                        'none'      => __( 'None', 'masterlayer'),
                        'image'     => __( 'Image', 'masterlayer'),
                    ]
                ]
            );

            $this->add_control(
                'hidden_menu_logo_image',
                [
                    'label' => __( 'Logo Image', 'masterlayer' ),
                    'type' => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'hidden_menu_logo' => 'image'
                    ]
                ]
            );

            $this->add_responsive_control(
                'hidden_menu_logo_max_width',
                [
                    'label'      => __( 'Logo Image Max Width', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 50,
                            'max' => 300,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .izeetak-hamburger-menu .menu-logo' => 'max-width: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                ]
            );

            $this->add_control(
                'hidden_menu_extra',
                [
                    'label'     => __( 'Search & Cart', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'none',
                    'options'   => [
                        'none'          => __( 'None', 'masterlayer'),
                        'search'        => __( 'Search', 'masterlayer'),
                        'cart'          => __( 'Cart', 'masterlayer'),
                        'both'          => __( 'Both', 'masterlayer')
                    ],
                ]
            );

            $this->add_control(
                'desc',
                [
                    'label' => 'Description',
                    'type' => Controls_Manager::TEXTAREA,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'masterlayer' ),
                    'placeholder' => __( 'Enter your description', 'masterlayer' ),
                    'rows' => 10,
                    'show_label' => false,
                ]
            );

            $this->add_control(
                'social_icons',
                [
                    'label'     => __( 'Social Icons', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'no',
                    'options'   => [
                        'no'      => __( 'No', 'masterlayer'),
                        'yes'     => __( 'Yes', 'masterlayer'),
                    ]
                ]
            );

            $this->add_control(
                'socials_heading1',
                [
                    'label'     => __( 'Social 1', 'masterlayer'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => ['social_icons' => 'yes']
                ]
            );

            $this->add_control(
                'social_icon1',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-twitter',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => ['social_icons' => 'yes']

                ]
            );

            $this->add_control(
                'social_url1',
                [
                    'label'      => __( 'URL', 'masterlayer'),
                    'type'       => Controls_Manager::URL,
                    'dynamic'    => [ 'active'        => true, ],
                    'placeholder'       => 'https://www.your-link.com',
                    'default'           => [ 'url' => '#', ],
                    'label_block'      => false,
                    'condition' => ['social_icons' => 'yes']
                ]
            );

            $this->add_control(
                'socials_heading2',
                [
                    'label'     => __( 'Social 2', 'masterlayer'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => ['social_icons' => 'yes']
                ]
            );

            $this->add_control(
                'social_icon2',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-facebook-square',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => ['social_icons' => 'yes']
                ]
            );

            $this->add_control(
                'social_url2',
                [
                    'label'      => __( 'URL', 'masterlayer'),
                    'type'       => Controls_Manager::URL,
                    'dynamic'    => [ 'active'        => true, ],
                    'placeholder'       => 'https://www.your-link.com',
                    'default'           => [ 'url' => '#', ],
                    'label_block'      => false,
                    'condition' => ['social_icons' => 'yes']
                ]
            );

            $this->add_control(
                'socials_heading3',
                [
                    'label'     => __( 'Social 3', 'masterlayer'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => ['social_icons' => 'yes']
                ]
            );

            $this->add_control(
                'social_icon3',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-pinterest',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => ['social_icons' => 'yes']
                ]
            );

            $this->add_control(
                'social_url3',
                [
                    'label'      => __( 'URL', 'masterlayer'),
                    'type'       => Controls_Manager::URL,
                    'dynamic'    => [ 'active'        => true, ],
                    'placeholder'       => 'https://www.your-link.com',
                    'default'           => [ 'url' => '#', ],
                    'label_block'      => false,
                    'condition' => ['social_icons' => 'yes']
                ]
            );

            $this->add_control(
                'socials_heading4',
                [
                    'label'     => __( 'Social 4', 'masterlayer'),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => ['social_icons' => 'yes']
                ]
            );

            $this->add_control(
                'social_icon4',
                [
                    'label' => __( 'Icon', 'masterlayer' ),
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'default' => [
                        'value' => 'ci-instagram',
                        'library' => 'core',
                    ],
                    'label_block'      => false,
                    'skin'             => 'inline',
                    'condition' => ['social_icons' => 'yes']
                ]
            );

            $this->add_control(
                'social_url4',
                [
                    'label'      => __( 'URL', 'masterlayer'),
                    'type'       => Controls_Manager::URL,
                    'dynamic'    => [ 'active'        => true, ],
                    'placeholder'       => 'https://www.your-link.com',
                    'default'           => [ 'url' => '#', ],
                    'label_block'      => false,
                    'condition' => ['social_icons' => 'yes']
                ]
            );

            $this->end_controls_section();

        // Style - General
            $this->start_controls_section(
                'section__style',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
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
                            'justify' => [
                                'title' => __( 'Justify', 'masterlayer' ),
                                'icon' => 'eicon-text-align-justify',
                            ],
                        ],
                        'default' => '',
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
                            'justify' => [
                                'title' => __( 'Justify', 'masterlayer' ),
                                'icon' => 'eicon-text-align-justify',
                            ],
                        ],
                        'default' => '',
                        'prefix_class' => 'align-%s'
                    ]
                );
            }
            

            $this->add_responsive_control(
                'menu_height',
                [
                    'label'      => __( 'Menu Height', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 50,
                            'max' => 400,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .izeetak-menu > ul > li > a, {{WRAPPER}} .izeetak-hamburger-icon' => 'line-height: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                ]
            );

            $this->add_responsive_control(
                'social_icons_size',
                [
                    'label'      => __( 'Social Icon Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 50,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 24,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-social-icons' => 'font-size: {{SIZE}}{{UNIT}}',
                    ],
                    50,
                    'condition' => [ 'social_icons!' => 'yes' ]
                ]
            );

            $this->add_responsive_control(
                'social_icons_bg_size',
                [
                    'label'      => __( 'Social Icon Bg Size', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 50,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 24,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .master-social-icons' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                    ],
                    50,
                    'condition' => [ 'social_icons!' => 'yes' ]
                ]
            );

            $this->end_controls_section();

        // Style - Color
            $this->start_controls_section(
                'section__style_color',
                [
                    'label' => __( 'Color', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );
            
            $this->add_control(
    			'menu_heading',
    			[
    				'label' => esc_html__( 'Menu', 'masterlayer' ),
    				'type' => \Elementor\Controls_Manager::HEADING,
    				'separator' => 'before',
    			]
    		);
            
            $this->add_control(
                'hmain_color',
                [
                    'label' => __( 'Main Menu: Default', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .izeetak-hamburger-menu li > a' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 'menu_style!' => 'default' ]
                ]
            );
            
            $this->add_control(
                'hmain_color_current',
                [
                    'label' => __( 'Main Menu: Current', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}}.not(.menu-onepage) .izeetak-hamburger-menu li.current-menu-item > a' => 'color: {{VALUE}};',
                        '{{WRAPPER}}.menu-onepage .izeetak-hamburger-menu li.active > a' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 'menu_style!' => 'default' ]
                ]
            );
            
            $this->add_control(
                'hmain_color_hover',
                [
                    'label' => __( 'Main Menu: Hover', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .izeetak-hamburger-menu li:hover > a' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 'menu_style!' => 'default' ]
                ]
            );
            
            $this->add_control(
                'subm_color',
                [
                    'label' => __( 'Sub Menu: Default', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .izeetak-menu .sub-menu li a' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 'menu_style!' => 'default' ]
                ]
            );
            
            $this->add_control(
                'hsub_color_hover',
                [
                    'label' => __( 'Sub Menu: Hover', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .izeetak-menu .sub-menu li:hover a' => 'color: {{VALUE}};',
                    ],
                    'condition' => [ 'menu_style!' => 'default' ]
                ]
            );
            
            $this->add_control(
                'hsub_bcolor_hover',
                [
                    'label' => __( 'Sub Menu Background: Hover', 'masterlayer' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .izeetak-menu .sub-menu li:hover' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [ 'menu_style!' => 'default' ]
                ]
            );
            
            $this->add_control(
    			'panel_heading',
    			[
    				'label' => esc_html__( 'Mobile Menu', 'masterlayer' ),
    				'type' => \Elementor\Controls_Manager::HEADING,
    				'separator' => 'before',
    			]
    		);

            $this->start_controls_tabs( 'menu_hover_tabs' );
                //Tab - normal
                    $this->start_controls_tab(
                        'normal_panel',
                        [
                            'label' => __( 'Normal', 'masterlayer' ),
                        ]
                    );

                    $this->add_control(
                        'heading_main_nav',
                        [
                            'label' => __( 'Menu', 'masterlayer' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'after',
                            'condition' => [ 'menu_style!' => 'hamburger' ]
                        ]
                    );

                    $this->add_control(
                        'main_color',
                        [
                            'label' => __( 'Main Menu', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}}:not(.menu-onepage) .izeetak-menu > ul > li > a > span' => 'color: {{VALUE}};',
                                '{{WRAPPER}}.menu-sep-yes:not(.menu-onepage) .izeetak-menu .menu-item:after' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 'menu_style!' => 'hamburger' ]
                        ]
                    );
                    
                    $this->add_control(
                        'main_bgcolor',
                        [
                            'label' => __( 'Main Menu Background', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}}:not(.menu-onepage) .izeetak-menu > ul > li > a > span' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 'menu_style!' => 'hamburger' ]
                        ]
                    );

                    $this->add_control(
                        'sub_color',
                        [
                            'label' => __( 'Sub Menu', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .izeetak-menu .sub-menu .menu-item a > span' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 'menu_style!' => 'hamburger' ]
                        ]
                    );

                    $this->add_control(
                        'line_color',
                        [
                            'label' => __( 'Line Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .izeetak-menu > ul > li > a > span:before' => 'background-color: {{VALUE}};',
                            ],
                                    'condition' => [ 'menu_style!' => 'hamburger' ]
                        ]
                    );

                    $this->add_control(
                        'heading_icon',
                        [
                            'label' => __( 'Icon', 'masterlayer' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'after',
                        ]
                    );

                    $this->add_control(
                        'hamburger_color',
                        [
                            'label' => __( 'Hamburger Icon', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .izeetak-hamburger-icon' => 'color: {{VALUE}}',
                            ],
                            'condition' => [ 'menu_style!' => 'default' ]
                        ]
                    );

                    $this->add_control(
                        'social_icon_color',
                        [
                            'label' => __( 'Social Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-social-icons a' => 'color: {{VALUE}}',
                            ],
                            'condition' => [ 'social_icons' => 'yes' ]
                        ]
                    );

                    $this->add_control(
                        'social_icon_bg_color',
                        [
                            'label' => __( 'Social Icon Bg Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-social-icons a' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [ 'social_icons' => 'yes' ]
                        ]
                    );

                    $this->end_controls_tab();

                //Tab - hover
                    $this->start_controls_tab(
                        'hover_panel',
                        [
                            'label' => __( 'Hover', 'masterlayer' ),
                        ]
                    );

                    $this->add_control(
                        'heading_main_navh',
                        [
                            'label' => __( 'Menu', 'masterlayer' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'after',
                            'condition' => [ 'menu_style!' => 'hamburger' ]
                        ]
                    );

                    $this->add_control(
                        'hover_main_color',
                        [
                            'label' => __( 'Main Menu', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .izeetak-menu > ul > li:hover > a > span,
                                {{WRAPPER}} .izeetak-menu > ul > li.current-menu > a > span,
                                {{WRAPPER}} .izeetak-menu > ul > li.current-menu-parent > a > span' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 'menu_style!' => 'hamburger' ]
                        ]
                    );
                    
                    $this->add_control(
                        'main_hover_bgcolor',
                        [
                            'label' => __( 'Main Menu Background', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}}.izeetak-menu>ul>li.current-menu-item>a span, .izeetak-menu>ul>li.current-menu-parent>a span, {{WRAPPER}} .izeetak-menu>ul>li:hover>a span' => 'background-color: {{VALUE}};',
                            ],
                            'condition' => [ 'menu_style!' => 'hamburger' ]
                        ]
                    );

                    $this->add_control(
                        'hover_sub_color',
                        [
                            'label' => __( 'Sub Menu', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .izeetak-menu .sub-menu .menu-item:hover a > span' => 'color: {{VALUE}};',
                            ],
                            'condition' => [ 'menu_style!' => 'hamburger' ]
                        ]
                    );

                    $this->add_control(
                        'hover_line_color',
                        [
                            'label' => __( 'Line Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .izeetak-menu > ul > li:hover > a > span:before' => 'background-color: {{VALUE}}',
                            ],
                                    'condition' => [ 'menu_style!' => 'hamburger' ]
                        ]
                    );

                    $this->add_control(
                        'heading_icon_hover',
                        [
                            'label' => __( 'Icon', 'masterlayer' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'after',
                        ]
                    );

                    $this->add_control(
                        'hover_hamburger_color',
                        [
                            'label' => __( 'Hamburger Icon', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .izeetak-hamburger-icon:hover' => 'color: {{VALUE}}',
                            ],
                            'condition' => [ 'menu_style!' => 'default' ]
                        ]
                    );

                    $this->add_control(
                        'social_icon_color_hover',
                        [
                            'label' => __( 'Social Icon Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-social-icons a:hover' => 'color: {{VALUE}}',
                            ],
                            'condition' => [ 'social_icons' => 'yes' ]
                        ]
                    );

                    $this->add_control(
                        'social_icon_bg_color_hover',
                        [
                            'label' => __( 'Social Icon Bg Color', 'masterlayer' ),
                            'type' => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .master-social-icons a:hover' => 'background-color: {{VALUE}}',
                            ],
                            'condition' => [ 'social_icons' => 'yes' ]
                        ]
                    );

                    $this->end_controls_tab();
            $this->end_controls_tabs();

            $this->end_controls_section();

        // Style - Typography
            $this->start_controls_section(
                'section__style_typography',
                [
                    'label' => __( 'Typography', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'main_nav_typography',
                    'label' => __('Main Menu', 'masterlayer'),
                    'selector' => 
                        '{{WRAPPER}} .izeetak-menu > ul > li > a > span, {{WRAPPER}}.menu-sep-yes .izeetak-menu .menu-item:after',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'sub_nav_typography',
                    'label' => __('Sub Menu', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .izeetak-menu .sub-menu .menu-item a > span',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'desc_typography',
                    'label' => __('Description', 'masterlayer'),
                    'selector' => '{{WRAPPER}} .desc',
                    'condition' => ['desc!' => '']
                ]
            );

            $this->end_controls_section();

        // Style - Spacing
            $this->start_controls_section(
                'section__style_spacing',
                [
                    'label' => __( 'Spacing', 'masterlayer' ),
                    'tab'   => Controls_Manager::TAB_STYLE,
                ]
            );

            $this->add_responsive_control(
                'menu_item_spacing',
                [
                    'label'      => __( 'Menu Items', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 20,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .izeetak-menu > ul > li' => 'margin: 0 {{SIZE}}{{UNIT}}',
                    ],
                    50,
                    'condition' => [ 'menu_style!' => 'hamburger' ]
                ]
            );

            if ( is_rtl() ) {
                $this->add_responsive_control(
                    'hamburger_icon_spacing',
                    [
                        'label'      => __( 'Hamburger Icon', 'masterlayer' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [
                                'min' => 10,
                                'max' => 100,
                            ]
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 30,
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .izeetak-hamburger-icon' => 'margin-right: {{SIZE}}{{UNIT}}',
                        ],
                        50,
                        'condition' => [ 'menu_style!' => 'default' ]
                    ]
                );
            } else {
                $this->add_responsive_control(
                    'hamburger_icon_spacing',
                    [
                        'label'      => __( 'Hamburger Icon', 'masterlayer' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => [ 'px' ],
                        'range'      => [
                            'px' => [
                                'min' => 10,
                                'max' => 100,
                            ]
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 30,
                        ],
                        'selectors'  => [
                            '{{WRAPPER}} .izeetak-hamburger-icon' => 'margin-left: {{SIZE}}{{UNIT}}',
                        ],
                        50,
                        'condition' => [ 'menu_style!' => 'default' ]
                    ]
                );

            }     

            $this->add_responsive_control(
                'desc_spacing',
                [
                    'label'      => __( 'Description', 'masterlayer' ),
                    'type'       => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range'      => [
                        'px' => [
                            'min' => 10,
                            'max' => 100,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .desc' => 'margin: {{SIZE}}{{UNIT}} 0',
                    ],
                    50,
                    'condition' => [ 'desc!' => '' ]
                ]  
            );

            $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display(); 
        ?>
        <div class="izeetak-menu-wrap <?php echo 'menu-' . esc_attr($settings['menu_style']); ?>">
            <?php 
                if( $settings['menu_style'] !== 'hamburger') { ?>
                    <nav class="izeetak-menu">
                        <?php
                        if ($settings['menu_name'] !== '') {
                            wp_nav_menu( array(
                                'menu' => $settings['menu_name'],
                                'link_before' => '<span>',
                                'link_after'=>'</span>',
                                'fallback_cb' => false,
                                'container' => false,
                                'menu_id' => 'menu-' . uniqid()
                            ) );
                        } ?>
                    </nav>
                <?php } ?>
                <?php if ($settings['menu_extra'] !== 'none') { echo '<div class="menu-extra">'; } ?>
                    <?php 
                    if( $settings['menu_style'] !== 'default') { ?>
                        <div class="hamburger-menu-wrap">
                            <div class="izeetak-hamburger-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['menu_icon'], [ 'aria-hidden' => 'true' ]); ?>
                            </div>

                            <div class="izeetak-hamburger-menu align-left">
                                <div class="hidden-menu-overlay"></div>
                                <div class="hidden-menu-wrap">
                                    <div class="close-menu"></div>

                                    <?php if ( $settings['hidden_menu_logo_image'] ) { ?>
                                        <div class="menu-logo">
                                            <a aria-label="logo" href="<?php echo esc_url(get_home_url()); ?>">
                                                <?php echo wp_get_attachment_image( $settings['hidden_menu_logo_image']['id'], 'full' ); ?>
                                            </a>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    if ($settings['menu_name'] !== '') {
                                        wp_nav_menu( array(
                                            'menu' => $settings['menu_name'],
                                            'link_before' => '<span>',
                                            'link_after'=>'</span>',
                                            'fallback_cb' => false,
                                            'container' => false,
                                            'menu_id' => 'menu-' . uniqid()
                                        ) );
                                    } ?>

                                    <?php if ($settings['hidden_menu_extra'] !== 'none') { ?>
                                        <div class="extra-nav">
                                            <?php if ($settings['hidden_menu_extra'] !== 'cart') { ?>
                                                <div class="ext"><?php get_search_form(); ?></div>
                                            <?php } ?>

                                            <?php if (class_exists( 'woocommerce' )) { 
                                                if ($settings['hidden_menu_extra'] !== 'search') { ?>
                                                    <div class="ext">
                                                        <a class="cart-info" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'masterlayer' ); ?>">
                                                            <i class="ci-cart"></i>
                                                            <?php 
                                                            if ( WC()->cart ) {
                                                                echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'masterlayer' ), WC()->cart->get_cart_contents_count() );  
                                                                echo WC()->cart->get_cart_total(); 
                                                            } else {
                                                                echo __('No Item in Shop', 'masterlayer');
                                                            }
                                                            ?> 
                                                            </a>
                                                    </div>
                                                <?php }
                                            } ?>
                                        </div>
                                    <?php } ?>

                                    <?php if ($settings['desc']) { ?>
                                        <div class="desc"><?php echo $settings['desc']; ?></div>
                                    <?php } ?>

                                    <?php if ($settings['social_icons'] == 'yes') { ?>
                                        <div class="master-social-icons">
                                            <?php if ($settings['social_url1']['url']) { ?>
                                                <a aria-label="icon" href="<?php echo esc_url($settings['social_url1']['url']); ?>">
                                                    <?php Icons_Manager::render_icon( $settings['social_icon1'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </a>
                                            <?php } ?>

                                            <?php if ($settings['social_url2']['url']) { ?>
                                                <a aria-label="icon" href="<?php echo esc_url($settings['social_url2']['url']); ?>">
                                                    <?php Icons_Manager::render_icon( $settings['social_icon2'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </a>
                                            <?php } ?>

                                            <?php if ($settings['social_url3']['url']) { ?>
                                                <a aria-label="icon" href="<?php echo esc_url($settings['social_url3']['url']); ?>">
                                                    <?php Icons_Manager::render_icon( $settings['social_icon3'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </a>
                                            <?php } ?>

                                            <?php if ($settings['social_url4']['url']) { ?>
                                                <a aria-label="icon" href="<?php echo esc_url($settings['social_url4']['url']); ?>">
                                                    <?php Icons_Manager::render_icon( $settings['social_icon4'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php if ($settings['menu_extra'] !== 'none') { echo '</div>'; } ?>
            </div>
        <?php
    }

    protected function content_template() {}
}

