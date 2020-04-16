<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!function_exists('seocify_widget_init')) {

    function seocify_widget_init()
    {
        if (function_exists('register_sidebar')) {
            register_sidebar(
                array(
                    'name' => esc_html__('Main Widget Area', 'seocify'),
                    'id' => 'sidebar-1',
                    'description' => esc_html__('Appears on posts and pages.', 'seocify'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<div class="widget-header"><h3 class="xs-title">',
                    'after_title' => '</h3></div>',
                )
            );


            $show_footer_widget = seocify_option('show_footer_widget');
            if($show_footer_widget):
                $footer_column = seocify_get_footer_column(seocify_option('footer_widget_layout'));
                for ($i = 1; $i <= $footer_column; $i++) {
                    $args_sidebar = array(
                        'name' => esc_html__('Footer Widget ', 'seocify') . $i,
                        'id' => 'footer-widget-' . $i,
                        'description' => esc_html__('Appears on footer area ', 'seocify').$i,
                        'before_widget' => '<div class="footer-widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h4 class="xs-content-title">',
                        'after_title' => '</h4>',
                    );

                    register_sidebar($args_sidebar);
                }
            endif;
        }
    }

    add_action('widgets_init', 'seocify_widget_init');
}


