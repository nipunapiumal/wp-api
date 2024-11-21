<?php
/*
Widget Name: Button
Description: 
Author: Masterlayer
Author URI: http://masterlayer.edu.vn
Plugin URI: https://masterlayer.edu.vn/masterlayer-addons-for-elementor/
*/

namespace MasterlayerAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use \Elementor\Group_Control_Box_Shadow;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class MAE_Button_Widget extends Widget_Base {

    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
    }

    // The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
    public function get_name() {
        return 'mae-button';
    }

    // The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
    public function get_title() {
        return __( 'Special Button', 'masterlayer' );
    }

    // The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
    public function get_icon() {
        return 'mae-button';
    }

    // The get_categories method, lets you set the category of the widget, return the category name as a string.
    public function get_categories() {
        return [ 'masterlayer-addons' ];
    }

    protected function register_controls() {
        // Content
            $this->start_controls_section( 'content_section',
                [
                    'label' => __( 'Button', 'masterlayer' ),
                ]
            );

            $this->add_control(
                'button_style',
                [
                    'label'     => __( 'Style', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'btn-accent',
                    'options'   => [
                        'btn-accent'      => __( 'Accent', 'masterlayer'),
                        'btn-white'       => __( 'White', 'masterlayer'),
                        'btn-dark'        => __( 'Dark', 'masterlayer'),
                        'btn-outline'     => __( 'Outline', 'masterlayer')
                    ]
                ]
            );

            $this->add_control(
                'button_size',
                [
                    'label'     => __( 'Size', 'masterlayer'),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'big',
                    'options'   => [
                        'big'       => __( 'Big', 'masterlayer'),
                        'medium'    => __( 'Medium', 'masterlayer'),
                        'small'     => __( 'Small', 'masterlayer'),
                    ]
                ]
            );

            $this->add_control(
                'button_text',
                [
                    'label'     => __( 'URL Text', 'masterlayer'),
                    'type'      => Controls_Manager::TEXT,
                    'dynamic'   => [
                        'active'   => true,
                    ],
                    'default'   => __( 'Learn More', 'masterlayer'),
                ]
            );

            $this->add_control(
                'button_url',
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
                        'button_icon_position!' => 'none'
                    ]
                ]
            );

            $this->end_controls_section();

        // Style
            $this->start_controls_section( 'setting_general_section',
                [
                    'label' => __( 'General', 'masterlayer' ),
                    'tab' => Controls_Manager::TAB_STYLE,
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

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} .master-button',
                ]
            );

            $this->add_responsive_control(
                'button_font_size',
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
                        'button_icon_position!' => 'none'
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
                        'button_icon_position!' => 'none'
                    ]
                ]
            );

            $this->start_controls_tabs( 'button_hover_tabs' );

            // Normal
                $this->start_controls_tab(
                    'button_normal',
                    [
                        'label' => __( 'Normal', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'button_color',
                    [
                        'label' => __( 'Text Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-button .content-base' => 'color: {{VALUE}};',
                        ]
                    ]
                );

                $this->add_control(
                    'button_icon_color',
                    [
                        'label' => __( 'Icon Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-button .inner .icon' => 'color: {{VALUE}};',
                        ],
                        'condition' => [ 
                            'button_icon_position!' => 'none', 
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
                            'unit' => 'px',
                            'isLinked' => true
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .master-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [ 
                            'button_style' => [ 'btn-outline' ]
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_box_shadow',
                        'selector' => '{{WRAPPER}} .master-button',
                    ]
                );

                $this->end_controls_tab();

            // Button hover
                $this->start_controls_tab(
                    'button_hover',
                    [
                        'label' => __( 'URL Hover', 'masterlayer' ),
                    ]
                );

                $this->add_control(
                    'button_color_hover',
                    [
                        'label' => __( 'Text Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-button .content-hover .text' => 'color: {{VALUE}} !important;',
                        ]
                    ]
                );

                $this->add_control(
                    'button_icon_color_hover',
                    [
                        'label' => __( 'Icon Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-button .content-hover .icon' => 'color: {{VALUE}} !important;',
                        ],
                        'condition' => [ 
                            'button_icon_position!' => 'none', 
                        ]
                    ]
                );

                $this->add_control(
                    'button_bg_color_hover',
                    [
                        'label' => __( 'Background Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-button .bg-hover' => 'background-color: {{VALUE}};',
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
                            '{{WRAPPER}} .master-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ]
                    ]
                );

                $this->add_control(
                    'button_border_color_hover',
                    [
                        'label' => __( 'Border Color', 'masterlayer' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .master-button:hover' => 'border-color: {{VALUE}};'
                        ],
                        'condition' => [ 
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
                            'unit' => 'px',
                            'isLinked' => true
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .master-button:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'condition' => [ 
                            'button_style' => [ 'btn-outline' ]
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_box_shadow_hover',
                        'selector' => '{{WRAPPER}} .master-button:hover',
                    ]
                );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->end_controls_section();

    }

    protected function render() {
        $button = $this->get_settings_for_display();
        $url = $button['button_url'];

        $cls = $url_attr = "";
        $cls .= $button['button_style'] . ' icon-' . $button['button_icon_position'] . ' ' . $button['button_size'];

        if ( $url['is_external'] ) {
            $url_attr .= 'target="_blank" ';
        }

        if ( ! empty( $url['nofollow'] ) ) {
            $url_attr .= 'rel="nofollow" ';
        }

        $button_icon = '';
        if ($button['button_icon'])  {
            $button_icon = sprintf('<span class="icon %1$s"></span>', $button['button_icon']['value']);
        } ?>

        <a class="master-button <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url['url']); ?>" 
            <?php echo esc_attr($url_attr); ?>>

            <span class="inner">
                <span class="content-base">
                    <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                    <span class="text"><?php echo $button['button_text']; ?></span>
                    <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                </span>

                <span class="content-hover">
                    <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                    <span class="text"><?php echo $button['button_text']; ?></span>
                    <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                </span>
            </span>

            <?php echo '<span class="bg-hover"></span>'; ?>
        </a>

        <?php
    }

    protected function content_template() {}
}

