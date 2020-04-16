<?php
$fields[] = array(
    'type'        => 'select',
    'settings'    => 'page_sidebar',
    'label'       => esc_html__( 'Page Sidebar Position', 'seocify' ),
    'section'     => 'page_section',
    'default'     => '1',
    'choices'     => array(
      '1'      => esc_html__('Full Width','seocify'),
      '2'      => esc_html__('Left Sidebar','seocify'),
      '3'      => esc_html__('Right Sidebar','seocify'),
    ),
);
