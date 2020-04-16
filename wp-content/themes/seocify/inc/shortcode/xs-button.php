<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Button_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-button';
    }

    public function get_title() {
        return esc_html__( 'Seocify Button', 'seocify' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_categories() {
        return [ 'seocify-elements' ];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' =>esc_html__('Button', 'seocify'),
            ]
        );
        $this->add_control(

            'btn_style', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Choose Style', 'seocify'),
                'default' => 'btn-secondary',
                'options' => [
                    'btn-primary' => esc_html__('Primary', 'seocify'),
                    'btn-secondary' => esc_html__('Secondary', 'seocify'),
                ],
            ]
        );
        $this->add_control(
			'btn_text',
			[
				'label' =>esc_html__( 'Label', 'seocify' ),
				'type' => Controls_Manager::TEXT,
				'default' =>esc_html__( 'Learn more ', 'seocify' ),
				'placeholder' =>esc_html__( 'Learn more ', 'seocify' ),
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' =>esc_html__( 'Link', 'seocify' ),
				'type' => Controls_Manager::URL,
				'placeholder' =>esc_html__('http://your-link.com','seocify' ),
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' =>esc_html__( 'Icon', 'seocify' ),
				'type' => Controls_Manager::ICON,
				'label_block' => true,
				'default' => '',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' =>esc_html__( 'Icon Position', 'seocify' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' =>esc_html__( 'Before', 'seocify' ),
					'right' =>esc_html__( 'After', 'seocify' ),
				],
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'btn_align',
			[
				'label' =>esc_html__( 'Alignment', 'seocify' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' =>esc_html__( 'Left', 'seocify' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' =>esc_html__( 'Center', 'seocify' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' =>esc_html__( 'Right', 'seocify' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			]
		);
        $this->add_control(
            'button_class',
            [
                'label' =>esc_html__( 'Class', 'seocify' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' =>esc_html__( 'Custom Class', 'seocify' ),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
			'section_style',
			[
				'label' =>esc_html__( 'Button Style', 'seocify' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' =>esc_html__( 'Padding', 'seocify' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'label' =>esc_html__( 'Typography', 'seocify' ),
				'selector' => '{{WRAPPER}} a.xs-btn',
			]
		);

		$this->start_controls_tabs( 'xs_tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' =>esc_html__( 'Normal', 'seocify' ),
			]
		);

		$this->add_control(
			'btn_text_color',
			[
				'label' =>esc_html__( 'Text Color', 'seocify' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'color: {{VALUE}};',
				],
			]
		);


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'seocify' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} a.xs-btn',
            ]
        );


        $this->end_controls_tab();

		$this->start_controls_tab(
			'btn_tab_button_hover',
			[
				'label' =>esc_html__( 'Hover', 'seocify' ),
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label' =>esc_html__( 'Text Color', 'seocify' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.xs-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover',
                'label' => __( 'Background', 'seocify' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} a.xs-btn:hover',
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		


		
        $this->start_controls_section(
			'border_style',
			[
				'label' =>esc_html__( 'Border Style', 'seocify' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'btn_border_style',
			[
				'label' => _x( 'Border Type', 'Border Control', 'seocify' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' => __( 'None', 'seocify' ),
					'solid' => _x( 'Solid', 'Border Control', 'seocify' ),
					'double' => _x( 'Double', 'Border Control', 'seocify' ),
					'dotted' => _x( 'Dotted', 'Border Control', 'seocify' ),
					'dashed' => _x( 'Dashed', 'Border Control', 'seocify' ),
					'groove' => _x( 'Groove', 'Border Control', 'seocify' ),
				],
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'border-style: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_border_dimensions',
			[
				'label' => _x( 'Width', 'Border Control', 'seocify' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'xs_tabs_button_border_style' );
		$this->start_controls_tab(
			'tab_button_border_normal',
			[
				'label' =>esc_html__( 'Normal', 'seocify' ),
			]
		);

		$this->add_control(
			'btn_border_color',
			[
				'label' => _x( 'Color', 'Border Control', 'seocify' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_tab_button_border_hover',
			[
				'label' =>esc_html__( 'Hover', 'seocify' ),
			]
		);
		$this->add_control(
			'btn_hover_border_color',
			[
				'label' => _x( 'Color', 'Border Control', 'seocify' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} a.xs-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label' =>esc_html__( 'Border Radius', 'seocify' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'default' => [
					'top' => '',
					'right' => '',
					'bottom' => '' ,
					'left' => '',
				],
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

        $this->start_controls_section(
			'box_shadow_style',
			[
				'label' =>esc_html__( 'Box Shadow Style', 'seocify' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'btn_box_shadow_dimensions',
			[
				'label' => _x( 'Dimensions', 'Border Control', 'seocify' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => 'box-shadow: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} var(--box-shadow-color);',
				],
			]
		);
		$this->add_control(
			'btn_box_shadow_color',
			[
				'label' =>esc_html__( 'Box Shadow Color', 'seocify' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} a.xs-btn' => '--box-shadow-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
    }

    protected function render( ) {
        $settings = $this->get_settings();

        $btn_text = $settings['btn_text'];
        $btn_class = $settings['button_class'];
        $btn_style = ($btn_class != '') ? $settings['btn_style'].' '.$btn_class : $settings['btn_style'];
        $icon_align = $settings['icon_align'];
		$btn_link = (! empty( $settings['btn_link']['url'])) ? $settings['btn_link']['url'] : '';
		
		$btn_target = ( $settings['btn_link']['is_external']) ? '_blank' : '_self';

        $this->add_render_attribute( 'icon-align', 'class', 'xs-button-icon xs-align-icon-' . $settings['icon_align'] );
        ?>
		<a href="<?php echo esc_url( $btn_link ); ?>" target="<?php echo esc_html( $btn_target ); ?>" class="xs-btn btn <?php echo esc_attr( $btn_style ); ?>">
			<?php if($icon_align == 'right'): ?>
				<span class="xs-button-text"><?php echo esc_html( $btn_text ); ?></span>
			<?php endif; ?>
			<span ><i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i></span>
			<?php if($icon_align == 'left'): ?>
			<span class="xs-button-text"><?php echo esc_html( $btn_text ); ?></span>
			<?php endif; ?>
		</a>
        <?php
    }

    protected function _content_template() { }
}