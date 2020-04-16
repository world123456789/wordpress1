<?PHP

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Doodle_Parallax_Widget extends Widget_Base {

    public function get_name() {
        return 'xs-doodle-parallax';
    }

    public function get_title() {
        return esc_html__( 'Seocify Doodle Parallax', 'seocify' );
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
                'label' => esc_html__('Seocify Doodle Parallax', 'seocify'),
            ]
        );

        $this->add_control(
            'images',
            [
                'label' => esc_html__('Parallax Images', 'seocify'),
                'type' => Controls_Manager::REPEATER,
                'separator' => 'before',
                'default' => [
                    [
                        'image' => Utils::get_placeholder_image_src(),
                        'bg_y_position' => '100',
                    ],
                ],
                'fields' => [

                    [
                        'name' => 'image',
                        'label' => esc_html__('Image', 'seocify'),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                        'label_block' => true,
                    ],
                    [
                        'name' => 'bg_y_position',
                        'label' => esc_html__('Background Y Position(%)', 'seocify'),
                        'type' => Controls_Manager::NUMBER,
                        'min'     => -200,
                        'max'     => 200,
                        'step'    => 1,
                        'default' => 100,
                    ],
                    [
                        'name' => 'top_position',
                        'label' => esc_html__('Top Position(px)', 'seocify'),
                        'type' => Controls_Manager::NUMBER,
                        'step'    => 1,
                    ],
                    [
                        'name' => 'left_position',
                        'label' => esc_html__('Left Position(px)', 'seocify'),
                        'type' => Controls_Manager::NUMBER,
                        'step'    => 1,
                    ],
                    [
                        'name' => 'right_position',
                        'label' => esc_html__('Right Position(px)', 'seocify'),
                        'type' => Controls_Manager::NUMBER,
                        'step'    => 1,
                    ],
                    [
                        'name' => 'bottom_position',
                        'label' => esc_html__('Bottom Position(px)', 'seocify'),
                        'type' => Controls_Manager::NUMBER,
                        'step'    => 1,
                    ],

                ],
            ]
        );
        $this->end_controls_section();

    }

    protected function render( ) {
        $settings = $this->get_settings();
        $images = $settings['images'];
        
        ?>
        <div class="doodle-parallax">
            <?php if(is_array($images)): ?>
                <?php $i=0; foreach($images as $image): ?>
                    <?php
                        $items = array('one', 'two', 'three', 'four', 'five');
                        $top = $left = $right = $bottom = '';
                        if($image['top_position'] != ''){
                            $top = 'top:'.$image['top_position'].'px';
                            $bottom = 'bottom:initial';
                        }
                        if($image['left_position'] != ''){
                            $left = 'left:'.$image['left_position'].'px';
                            $right = 'right:initial';
                        }
                        if($image['right_position'] != ''){
                            $right = 'right:'.$image['right_position'].'px';
                            $left = 'left:initial';
                        }
                        if($image['bottom_position'] != ''){
                            $bottom = 'bottom:'.$image['bottom_position'].'px';
                            $top = 'top:initial';
                        }
                        $style = $top.';'.$left.';'.$right.';'.$bottom.';';

                    ?>
                    <?php if(!empty($image['image']['url'])): ?>
                        <?php if(!empty($image['image']['id'])){
                            $alt = get_post_meta($image['image']['id'], '_wp_attachment_image_alt', true);
                            if(!empty($alt)) {
                                $alt = $alt;
                            }else{
                                $alt = get_the_title($image['image']['id']);
                            }
                        } ?>
                        <img src="<?php echo esc_url($image['image']['url'])?>"  data-scrollax="properties: { translateY: '<?php echo esc_attr($image['bg_y_position']);?>%' }" class="single-doodle <?php echo esc_attr($items[$i]);?>" alt="<?php echo esc_attr($alt); ?>" style="<?php echo esc_attr($style);?>">
                    <?php endif; ?>
                <?php $i++; endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
    }

    protected function _content_template() { }
}