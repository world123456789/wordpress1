<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Tabs_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-tab';
    }

    public function get_title() {
        return esc_html__( 'Seocify Tab', 'seocify' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return ['seocify-elements'];
    }

    protected function _register_controls() {

        /**
         *
         * Tabs
         *
         */

        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__( 'Tabs', 'seocify' ),
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => esc_html__( 'Tabs Items', 'seocify' ),
                'type' => Controls_Manager::REPEATER,
                'default' => [
                    [
                        'tab_title' => esc_html__( 'Tab #1', 'seocify' ),
                        'title_image' => Utils::get_placeholder_image_src(),
                        'tab_content' => esc_html__( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'seocify' ),
                        'content_image' => Utils::get_placeholder_image_src(),
                        'title' => esc_html__( 'Real Time Analytics', 'seocify' ),
                        'btn_style' => 'btn-secondary',
                        'btn_label' => esc_html__( 'Read More', 'seocify' ),
                        'btn_link' => '#',
                    ],
                    [
                        'tab_title' => esc_html__( 'Tab #2', 'seocify' ),
                        'title_image' => Utils::get_placeholder_image_src(),
                        'tab_content' => esc_html__( 'I am tab content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'seocify' ),
                        'content_image' => Utils::get_placeholder_image_src(),
                        'title' => esc_html__( 'Real Time Analytics', 'seocify' ),
                        'btn_style' => 'btn-secondary',
                        'btn_label' => esc_html__( 'Read More', 'seocify' ),
                        'btn_link' => '#',
                    ],
                ],
                'fields' => [
                    [
                        'name' => 'tab_title',
                        'label' => esc_html__( 'Tab Title', 'seocify' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Tab Title', 'seocify' ),
                        'placeholder' => esc_html__( 'Tab Title', 'seocify' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'title_image',
                        'label' => esc_html__('Title Image', 'seocify'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],
                    [
                        'name' => 'title',
                        'label' => esc_html__( 'Title', 'seocify' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Title', 'seocify' ),
                        'placeholder' => esc_html__( 'Title', 'seocify' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'tab_content',
                        'label' => esc_html__( 'Content', 'seocify' ),
                        'default' => esc_html__( 'Tab Content', 'seocify' ),
                        'placeholder' => esc_html__( 'Tab Content', 'seocify' ),
                        'type' => Controls_Manager::WYSIWYG,
                        'show_label' => true,
                    ],
                    [
                        'name' => 'btn_style',
                        'label' => esc_html__( 'Choose Style', 'seocify' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'btn-secondary',
                        'options' => [
                            'btn-primary' => esc_html__('Primary', 'seocify'),
                            'btn-secondary' => esc_html__('Secondary', 'seocify'),
                        ],
                        'label_block' => true,
                    ],
                    [
                        'name' => 'button_label',
                        'label' => esc_html__( 'Button Label', 'seocify' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__( 'Learn more', 'seocify' ),
                        'placeholder' => esc_html__( 'Learn more', 'seocify' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'button_link',
                        'label' => esc_html__( 'Button Link', 'seocify' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' => esc_html__('http://your-link.com','seocify' ),
                        'default' => [
                            'url' => '#',
                        ],
                        'label_block' => true,
                    ],
                    [
                        'name' => 'content_image',
                        'label' => esc_html__('Content Image', 'seocify'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );
        $this->end_controls_section();


        /**
         *
         * Genarel
         *
         */


        $this->start_controls_section(
            'section_genarel_style',
            [
                'label' => esc_html__('Tab Nav', 'seocify'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'tab_bg_color',
            [
                'label' => esc_html__( 'Tab BG Color', 'seocify' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-tabs .nav-item .nav-link' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .main-tabs .nav-item .nav-link::before' => 'border-top-color: {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'tab_active_bg_color',
            [
                'label' => esc_html__( 'Active Tab BG Color', 'seocify' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-tabs .nav-item .nav-link.active' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .main-tabs .nav-item .nav-link.active::before' => 'border-top-color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'tab_text_color',
            [
                'label' => esc_html__( 'Tab Text Color', 'seocify' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-tabs .nav-item .nav-link' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'tab_active_text_color',
            [
                'label' => esc_html__( 'Active Tab Text Color', 'seocify' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .main-tabs .nav-item .nav-link.active' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_title_typography',
                'label' => esc_html__( 'Typography', 'seocify' ),
                'selector' => ' {{WRAPPER}} .main-tabs .nav-item .nav-link',
            ]
        );
        $this->end_controls_section();

        /**
         *
         * Client Name
         *
         */

        $this->start_controls_section(
            'section_name_style',
            [
                'label' => esc_html__('Title', 'seocify'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'seocify' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .xs-content-title' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'seocify' ),
                'selector' => ' {{WRAPPER}} .xs-content-title',
            ]
        );

        $this->end_controls_section();


        /**
         *
         * Designnation Name
         *
         */

        $this->start_controls_section(
            'section_tab_content_style',
            [
                'label' => esc_html__('Content', 'seocify'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'tab_content_color',
            [
                'label' => esc_html__( 'Content Color', 'seocify' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .feature-text-content p' => 'color: {{VALUE}};'
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_content_typography',
                'label' => esc_html__( 'Typography', 'seocify' ),
                'selector' => ' {{WRAPPER}} .feature-text-content p',
            ]
        );

        $this->end_controls_section();

        /**
         *
         * Testimonial
         *
         */


        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__('Button', 'seocify'),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'button_label_bg',
            [
                'label' => esc_html__( 'Button BG', 'seocify' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn-wraper .btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_label_color',
            [
                'label' => esc_html__( 'Button Color', 'seocify' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn-wraper .btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_label_hover_bg',
            [
                'label' => esc_html__( 'Button Hover BG', 'seocify' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn-wraper .btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_label_hover_color',
            [
                'label' => esc_html__( 'Button Hover Color', 'seocify' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .btn-wraper .btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_label_typography',
                'label' => esc_html__( 'Typography', 'seocify' ),
                'selector' => '{{WRAPPER}} .btn-wraper .btn',
            ]
        );

        $this->end_controls_section();


    }

    protected function render( ) {

        $settings = $this->get_settings();

        $tabs_item = $settings['tabs'];

        require SEOCIFY_SHORTCODE_DIR_STYLE .'/tabs/style1.php';

 
    }

    protected function _content_template() { }
}