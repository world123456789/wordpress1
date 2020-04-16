<?php

namespace Elementor;

if ( !defined( 'ABSPATH' ) )
	exit;

class Xs_Heading_Widget extends Widget_Base {

	public function get_name() { 
		return 'xs-heading';
	}

	public function get_title() {
		return esc_html__( 'Seocify Heading', 'seocify' );
	}
 
	public function get_icon() {
		return 'eicon-type-tool';
	}

	public function get_categories() {
		return [ 'seocify-elements' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_tab', [
				'label' =>esc_html__( 'Seocify Heading', 'seocify' ),
			]
		);
        $this->add_control(

            'style', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Choose Style', 'seocify'),
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'seocify'),
                    'style2' => esc_html__('Style 2', 'seocify'),
                    'style3' => esc_html__('Style 3', 'seocify'),
                ],
            ]
        );

		$this->add_control(
			'title_text', [
				'label'			 =>esc_html__( 'Heading Title', 'seocify' ),
				'type'			 => Controls_Manager::TEXT,
				'label_block'	 => true,
				'placeholder'	 =>esc_html__( 'Best SEO', 'seocify' ),
				'default'		 =>esc_html__( 'Best SEO', 'seocify' ),
			]
		);
 
		$this->add_control(
			'sub_title', [
				'label'			 => esc_html__( 'Heading Sub Title', 'seocify' ),
				'type'			 => Controls_Manager::TEXTAREA,
				'label_block'	 => true,
				'placeholder'	 => esc_html__( 'Sub Title', 'seocify' ),
				'default'		 => '',
			]
		);
		$this->add_control(
			'xs_separator', [
				'type' => Controls_Manager::SWITCHER,
				'label' => esc_html__('Do you want to Use separator?', 'seocify'),
				'label_block'       => true,
				'default' => 'label_off',
				'label_on' => esc_html__( 'Yes', 'seocify' ),
				'label_off' => esc_html__( 'No', 'seocify' ),
			]
		);

 
		$this->add_responsive_control(
			'title_align', [
				'label'			 =>esc_html__( 'Alignment', 'seocify' ),
				'type'			 => Controls_Manager::CHOOSE,
				'options'		 => [

					'left'		 => [
						'title'	 =>esc_html__( 'Left', 'seocify' ),
						'icon'	 => 'fa fa-align-left',
					],
					'center'	 => [
						'title'	 =>esc_html__( 'Center', 'seocify' ),
						'icon'	 => 'fa fa-align-center',
					],
					'right'		 => [
						'title'	 =>esc_html__( 'Right', 'seocify' ),
						'icon'	 => 'fa fa-align-right',
					],
					'justify'	 => [
						'title'	 =>esc_html__( 'Justified', 'seocify' ),
						'icon'	 => 'fa fa-align-justify',
					],
				],
				'default'		 => 'left',
                'selectors' => [
                    '{{WRAPPER}} .xs-heading' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();

		//Title Style Section
		$this->start_controls_section(
			'section_title_style', [
				'label'	 => esc_html__( 'Title', 'seocify' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color_one', [
				'label'		 =>esc_html__( 'Title color', 'seocify' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .xs-heading .section-title' => 'color: {{VALUE}};'
				],
			]
		);

        $this->add_control(
            'title_color_two', [
                'label'		 => esc_html__( 'Color Two', 'seocify' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-heading .section-title span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xs-heading .line' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .xs-heading .line:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .xs-heading .section-title',
			]
		);

		$this->end_controls_section();

		//Subtitle Style Section
		$this->start_controls_section(
			'section_subtitle_style', [
				'label'	 => esc_html__( 'Sub Title', 'seocify' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'subtitle_color', [
				'label'		 => esc_html__( 'color', 'seocify' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .xs-heading .section-subtitle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'subtitle_typography',
			'selector'	 => '{{WRAPPER}} .xs-heading .section-subtitle',
			]
		);

        $this->add_control(
            'subtitle_margin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'seocify' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '',
                ],

                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .xs-heading .section-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

		//Border Style Section
		$this->start_controls_section(
			'section_border_style', [
				'label'	 => esc_html__( 'Border', 'seocify' ),
				'tab'	 => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => 'style2',
				],
			]
		);

		$this->add_control(
			'border_color', [
				'label'		 => esc_html__( 'Color', 'seocify' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .xs-heading .line::after' => 'background-color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();
		$style = $settings[ 'style' ];
		$title = $settings[ 'title_text' ];
		$sub_title = $settings[ 'sub_title' ];
		$title_align = $settings[ 'title_align' ];
		$xs_separator = $settings[ 'xs_separator' ];
		require SEOCIFY_SHORTCODE_DIR_STYLE . '/heading/'.$style.'.php';
	}

	protected function _content_template() {
		
	}
}
