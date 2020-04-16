<?PHP

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Funfact_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-funfact';
    }

    public function get_title() {
        return esc_html__( 'Seocify Funfact', 'seocify' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'seocify-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Seocify funfact', 'seocify'),
            ]
        );

        $this->add_control(
            'lists',
            [
                'label' => esc_html__('Lists', 'seocify'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [
                        'title'   =>  esc_html__('Happy Clients','seocify'),
                        'number_percentage' => '32548',
                        'suffix' => '',
                    ]
                ],
                'fields' => [
                    [
                        'name' => 'title',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Title', 'seocify'),
                        'default'   =>  esc_html__('Happy Clients','seocify'),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'number_percentage',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Number Percentage', 'seocify'),
                        'default'   =>  '32548',
                        'label_block' => true,
                    ],
                    [
                        'name' => 'suffix',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Suffix', 'seocify'),
                        'default'   =>  '',
                        'label_block' => true,
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style', [
                'label'	 =>esc_html__( 'Title Style', 'seocify' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'title_color', [
				'label'		 => esc_html__( 'Color', 'seocify' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-funfact p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'title_typography',
			'selector'	 => '{{WRAPPER}} .single-funfact p',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'section_number_percentage_style', [
                'label'	 => esc_html__( 'Title Style', 'seocify' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'number_percentage_color', [
				'label'		 => esc_html__( 'Color', 'seocify' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .single-funfact .number-percentage-count' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(), [
			'name'		 => 'number_percentage_typography',
			'selector'	 => '{{WRAPPER}} .single-funfact .number-percentage-count',
			]
		);
        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        $lists = $settings['lists'];
        ?>
        <div class="row funfact-wraper no-gutters">
            <?php if(is_array($lists)): ?>
                <?php foreach($lists as $list): ?>
                    <div class="col-md-4">
                        <div class="single-funfact wow fadeIn text-center" data-wow-duration="1s">
                            <span class="number-percentage-count number-percentage" data-value="<?php echo seocify_kses($list['number_percentage']); ?>" data-animation-duration="10000">0</span>
                            <?php if($list['suffix'] != ''): ?>
                                <span><?php echo seocify_kses($list['suffix']); ?></span>
                            <?php endif ;?>
                            <p><?php echo seocify_kses($list['title']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() { }
}