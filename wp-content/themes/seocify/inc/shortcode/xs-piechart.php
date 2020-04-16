<?PHP

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Piechart_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-piechart';
    }

    public function get_title() {
        return esc_html__( 'Seocify Piechart', 'seocify' );
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
                'label' => esc_html__('Seocify Piechart', 'seocify'),
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Piechart Items', 'seocify'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [
                        'title' => esc_html__('Achieved','seocify'),
                        'number' => '76',
                        'data_color' => '#50e2c2',
                    ],
                    [
                        'title' => esc_html__('Loaded','seocify'),
                        'number' => '93',
                        'data_color' => '#ffac42',
                    ],
                    [
                        'title' => esc_html__('Done','seocify'),
                        'number' => '85',
                        'data_color' => '#9013fd',
                    ],
                ],
                'fields' => [

                    [
                        'name' => 'title',
                        'label' => esc_html__('Title', 'seocify'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('Achieved','seocify'),
                        'label_block' => true,
                    ],

                    [
                        'name' => 'number',
                        'label' => '76',
                        'type' => Controls_Manager::TEXT,
                    ],
                    [
                        'name' => 'data_color',
                        'label' => 'Data Color',
                        'type' => Controls_Manager::COLOR,
                    ],

                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $items = $settings['items'];

       
        ?>

        <div class="piechats-wraper clearfix">
            <?php if(is_array($items)): ?>
                <?php foreach($items as $item): 
                
                
                ?>

                    <div class="single-piechart">
                        <div class="chart" data-percent="<?php echo esc_attr( $item['number'] ); ?>" data-color="<?php echo esc_attr( $item['data_color'] ); ?>">
                            <div class="chart-content"> 
                                <p><?php echo esc_html( $item['title'] ); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() { }
}