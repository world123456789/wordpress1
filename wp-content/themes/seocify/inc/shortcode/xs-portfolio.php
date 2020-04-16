<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class Xs_Portfolio_Widget extends Widget_Base {

  public $base;

    public function get_name() {
        return 'xs-portfolio';
    }

    public function get_title() {
        return esc_html__( 'Seocify Portfolios', 'seocify' );
    }

    public function get_icon() {
        return 'eicon-portfolio-grid';
    }

    public function get_categories() {
        return [ 'seocify-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_tab',
            [
                'label' => esc_html__('Portfolios', 'seocify'),
            ]
        );

        $this->add_control(
          'post_count',
          [
            'label'         => esc_html__( 'Portfolio count', 'seocify' ),
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
          'xs_portfolio_cat',
          [
             'label'    =>esc_html__( 'Select category', 'seocify' ),
             'type'     => Controls_Manager::SELECT,
             'options'  => seocify_category_list( 'portfolio_cat' ),
             'default'  => '0',
             'condition' => [
                'filter' => 'no',
            ]
          ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_subtitle_style', [
                'label'	 =>esc_html__( 'Sub Title', 'seocify' ),
                'tab'	 => Controls_Manager::TAB_STYLE,
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
                'label'		 =>esc_html__( 'Border color', 'seocify' ),
                'type'		 => Controls_Manager::COLOR,
                'selectors'	 => [
                    '{{WRAPPER}} .xs-news-content' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render( ) {
          $settings = $this->get_settings();
          $xs_portfolio_cat = $settings['xs_portfolio_cat'];
          $count_col = $settings['count_col'];
          $filter = $settings['filter'];
          $post_count = $settings['post_count'];
          
          $paged = 1;
          if ( get_query_var('paged') ) $paged = get_query_var('paged');
          if ( get_query_var('page') ) $paged = get_query_var('page');
          $portfolio_cat = array(
            'taxonomy' => 'portfolio_cat',
           );
          $portfolio_cats = get_terms( $portfolio_cat );
          if( $filter =='yes'){
            ?>
            <div class="agency-filter-wraper">
                <div class="filter-button-wraper">
                    <ul id="filters" class="option-set clearfix main-filter" data-option-key="filter">
                        <li><a href="#" data-option-value="*" class="selected"><?php esc_html_e('All','seocify');?></a></li>
                        <?php 
                        foreach($portfolio_cats as $portfolio_cat) { ?>
                            <li><a href="#" data-option-value=".<?php echo esc_attr($portfolio_cat->slug); ?>"><?php echo esc_html($portfolio_cat->name); ?></a></li>
                                                    
                        <?php }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
                    

            
                $query = array(
                    'post_type'      => 'portfolio',
                    'post_status'    => 'publish',
                    'posts_per_page' => $post_count,
    
                );
            }else{
                $query = array(
                    'post_type'      => 'portfolio',
                    'post_status'    => 'publish',
                    'posts_per_page' => $post_count,
                    'tax_query'     => array(
                        array(
                            'taxonomy'  => 'portfolio_cat',
                            'field'     => 'id',
                            'terms'     => $xs_portfolio_cat,
                        ),
                    ),
                    'paged' => $paged,
                );
            }
            
          $xs_query = new \WP_Query( $query );
          
          if($xs_query->have_posts()):
          ?>
              <div class="cases-grid">
                <?php
                while ($xs_query->have_posts()) :
                    $xs_query->the_post();

                    $cats = array();
                    $categories = get_the_terms( get_the_ID(), 'portfolio_cat' );

                    foreach($categories as $category){					
                        array_push($cats,$category->slug);
                    }
                    $project_terms = implode(' ',$cats);
                

                    require SEOCIFY_SHORTCODE_DIR_STYLE.'/portfolio/style1.php';


                endwhile;
                ?>
              </div>
            <?php
          endif;
          wp_reset_postdata();
    }
    protected function _content_template() { }
}