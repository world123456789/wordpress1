<?PHP

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Boosting_lists_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-boosting-lists';
    }

    public function get_title() {
        return esc_html__( 'Seocify Boosting Lists', 'seocify' );
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
                'label' => esc_html__('Seocify boosting lists', 'seocify'),
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
                        'content' => esc_html__('A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm','seocify'),
                    ]
                ],
                'fields' => [
                    [
                        'name' => 'content',
                        'type' => Controls_Manager::TEXT,
                        'label' => esc_html__('Content', 'seocify'),
                        'default'   =>  esc_html__('A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm','seocify'),
                        'label_block' => true,
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style', [
                'label'	 =>esc_html__( 'Content Style', 'seocify' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'content_color', [
				'label'		 => esc_html__( 'Color', 'seocify' ),
				'type'		 => Controls_Manager::COLOR,
				'selectors'	 => [
					'{{WRAPPER}} .xs-heading .line::after' => 'background-color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        $lists = $settings['lists'];
        ?>
        <div class="boosting-lists">
            <?php if(is_array($lists)): ?>
                <?php foreach($lists as $list): ?>
                    <?php if(!empty($list['content'])): ?>
                        
                        <div class="boosting-list">
                            <span class="count-number"></span>
                            <p><?php echo seocify_kses($list['content']); ?></p>
                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() { }
}