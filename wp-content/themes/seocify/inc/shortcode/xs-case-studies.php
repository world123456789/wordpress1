<?php
namespace Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;
class Xs_Case_studies_Widget extends Widget_Base {
    public $base;
    public function get_name() {
        return 'xs-case-studies';
    }
    public function get_title() {
        return esc_html__( 'Seocify Case Studies', 'seocify' );
    }
    public function get_icon() {
        return 'eicon-case-studies-grid';
    }
    public function get_categories() {
        return [ 'seocify-elements' ];
    }
    protected function _register_controls() {
        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Case Studies', 'seocify'),
            ]
        );
        $this->add_control(
            'style', [
                'type' => Controls_Manager::SELECT,
                'label' => esc_html__('Choose Style', 'seocify'),
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Card Style', 'seocify'),
                    'style3' => esc_html__('Card Style2', 'seocify'),
                    'style2' => esc_html__('Animated Style', 'seocify'),
                ],
            ]
        );
        $this->add_control(
            'post_count',
            [
                'label'         => esc_html__( 'Case count', 'seocify' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => esc_html__( '3', 'seocify' ),
            ]
        );
        $this->add_control(
            'filter',
            [
                'label'     => esc_html__( 'Enable Category Filter', 'seocify' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'yes',
                'options'   => [
                    'yes'     => esc_html__( 'Yes', 'seocify' ),
                    'no'     => esc_html__( 'No', 'seocify' ),
                ],
                'condition' => [
                        'style!' => 'style3'
                ]
            ]
        );
        $this->add_control(
            'carousel',
            [
                'label'     => esc_html__( 'Enable Carousel', 'seocify' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'no',
                'options'   => [
                    'yes'     => esc_html__( 'Yes', 'seocify' ),
                    'no'     => esc_html__( 'No', 'seocify' ),
                ],
                'condition' => [
                    'filter' => 'no',
                ]
            ]
        );
        $this->add_control(
            'seocify_style_case_carousel_dot',
            [
                'label' => esc_html__( 'Enable Dots', 'seocify' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'seocify' ),
                'label_off' => __( 'No', 'seocify' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                        'carousel' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'seocify_style_case_carousel_nav',
            [
                'label' => esc_html__( 'Enable Nav', 'seocify' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'seocify' ),
                'label_off' => __( 'No', 'seocify' ),
                'return_value' => 'yes',
                'default' => '',
                'condition' => [
                    'carousel' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'count_col',
            [
                'label'     => esc_html__( 'Select Column', 'seocify' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 4,
                'options'   => [
                    '6'     => esc_html__( '2 Column', 'seocify' ),
                    '4'     => esc_html__( '3 Column', 'seocify' ),
                ],
            ]
        );
        $this->add_control(
            'xs_case_cat',
            [
                'label'    =>esc_html__( 'Select category', 'seocify' ),
                'type'     => Controls_Manager::SELECT,
                'options'  => seocify_category_list( 'case_study_cat' ),
                'default'  => '0',
                'condition' => [
                    'filter' => 'no',
                ]
            ]
        );
        $this->add_control(
            'seocify_hide_content_area',
            [
                'label' => esc_html__( 'Hide Content area?', 'seocify' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'seocify' ),
                'label_off' => esc_html__( 'Hide', 'seocify' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_subtitle_style', [
                'label'  =>esc_html__( 'Sub Title', 'seocify' ),
                'tab'    => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'boder_width',
            [
                'label' =>esc_html__( 'Border Width', 'seocify' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0 ,
                    'left' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .xs-news-content' =>  'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'border_color', [
                'label'      =>esc_html__( 'Border color', 'seocify' ),
                'type'       => Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .xs-news-content' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'seocify_case_border_Radius',
            [
                'label' =>esc_html__( 'Border Radius', 'seocify' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => [
                    'top' => 5,
                    'right' => 5,
                    'bottom' => 5 ,
                    'left' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .single-case-studies' =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'seocfy_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'seocify' ),
                'selector' => '{{WRAPPER}} .single-case-studies',
            ]
        );
        $this->end_controls_section();
    }
    protected function render( ) {
        $settings = $this->get_settings();
        extract($settings);
        $paged = 1;
        if ( get_query_var('paged') ) $paged = get_query_var('paged');
        if ( get_query_var('page') ) $paged = get_query_var('page');
        if($xs_case_cat != '0'):
            $query = array(
                'post_type'      => 'case_study',
                'post_status'    => 'publish',
                'posts_per_page' => $post_count,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'case_study_cat',
                        'terms' => $xs_case_cat,
                        'field' => 'id',
                    )
                ),
                'paged' => $paged,
            );
        else:
            $query = array(
                'post_type'      => 'case_study',
                'post_status'    => 'publish',
                'posts_per_page' => $post_count,
                'cat' => $xs_case_cat,
                'paged' => $paged,
            );
        endif;
        $xs_query = new \WP_Query( $query );
        if($xs_query->have_posts()):
            if($filter == 'yes'){ $carousel='no';?>
                <div class="col-md-12">
                    <div class="agency-filter-wraper">
                        <div class="filter-button-wraper">
                            <ul id="filters" class="option-set clearfix main-filter" data-option-key="filter">
                                <li><a href="#" data-option-value="*" class="selected"><?php esc_html_e('All','seocify');?></a></li>
                                <?php $args = array(
                                    'taxonomy' => 'case_study_cat',
                                    'hide_empty' => true,
                                );
                                $categories = get_terms( $args );
                                foreach($categories as $category) { ?>
                                    <li><a href="#" data-option-value=".<?php echo esc_attr($category->slug); ?>"><?php echo esc_html($category->name); ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php if($carousel == 'yes'){ ?>
                    <div class="case-study-slider owl-carousel" data-nav="<?php echo esc_attr($seocify_style_case_carousel_nav); ?>" data-dot="<?php echo esc_attr($seocify_style_case_carousel_dot); ?>">
                <?php }else{
                    ?><div class="row cases-grid <?php echo esc_attr( $style == 'style3' ? 'case_study_3' : ''); ?>"><?php
                } ?>
            <?php }else{ ?>
                <?php if($carousel == 'yes'){ ?>
                    <div class="case-study-slider owl-carousel <?php echo esc_attr( $style == 'style3' ? 'case_study_3' : ''); ?>" data-nav="<?php echo esc_attr($seocify_style_case_carousel_nav); ?>" data-dot="<?php echo esc_attr($seocify_style_case_carousel_dot); ?>">
                <?php }else{
                    ?><div class="row <?php echo esc_attr($style == 'style3' ? 'case_study_3' : ''.$dot_nav_class); ?>"><?php
                }
            } ?>
            <?php
            while ($xs_query->have_posts()) :
                $xs_query->the_post();
                $cats = array();
                $categories = get_the_terms( get_the_ID(), 'case_study_cat' );
                foreach($categories as $category){
                    array_push($cats,$category->slug);
                }
                $case_terms = implode(' ',$cats);
                require SEOCIFY_SHORTCODE_DIR_STYLE.'/case-studies/'.$style.'.php';
            endwhile;
            ?>
            </div>
        <?php
        endif;
        wp_reset_postdata();
    }
    protected function _content_template() { }
}