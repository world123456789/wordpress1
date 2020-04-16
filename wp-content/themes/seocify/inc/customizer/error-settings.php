<?php
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'error_title',
    'label'       => esc_html__( 'Error Title', 'seocify' ),
    'section'     => 'error_section',
    'default'     =>  '',
);
$fields[]= array(
    'type'        => 'text',
    'settings'    => 'error_subtitle',
    'label'       => esc_html__( 'Error Subtitle', 'seocify' ),
    'section'     => 'error_section',
    'default'     =>  '',
);

$fields[]= array(
    'type'        => 'text',
    'settings'    => 'back_to_home_label',
    'label'       => esc_html__( 'Back to home button label', 'seocify' ),
    'section'     => 'error_section',
    'default'     =>  '',
);

$fields[] = array(
	'type'        => 'image',
	'settings'    => 'error_logo',
	'label'       => esc_html__( 'Error Logo', 'seocify' ),
	'section'     => 'error_section',
);