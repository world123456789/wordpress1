<?php

if ( !defined( 'FW' ) ) {
    die( 'Forbidden' );
}

include_once get_template_directory() . '/inc/includes/demo-page-meta.php';
$options = array(
    '_page_meta' => array(
        'title'		 => esc_html__( 'Page Settings', 'seocify' ),
        'type'		 => 'box',
        'priority'	 => 'high',
        'options'	 => array(
            'page_sections' => array(
                'type'			 => 'multi-picker',
                'label'			 => false,
                'desc'			 => false,
                'picker'		 => array(
                    'xs_page_section' => array(
                        'label'			 => esc_html__( 'This page is a section:', 'seocify' ),
                        'type'			 => 'switch',
                        'right-choice'	 => array(
                            'value'	 => 'on',
                            'label'	 => esc_html__( 'Yes', 'seocify' )
                        ),
                        'left-choice'	 => array(
                            'value'	 => 'no',
                            'label'	 => esc_html__( 'No', 'seocify' )
                        ),
                        'value'			 => 'no',
                        'desc'			 => seocify_kses( 'If this a <b>One page Section</b>,  set this field to <b>yes</b>. And if this page is not section, set it to <b>no</b>', 'seocify' ),
                        'help'			 => sprintf( "%s \n\n'\"<br/><br/>\n\n <b>%s</b>", esc_html__( 'If this page for one page section. set yes ', 'seocify' ), esc_html__( 'For One page always will be <b>yes</b>', 'seocify' )
                        ),
                    )
                ),
                'choices'		 => array(
                    'on' => array(
                        'hide_title_from_menu' => array(
                            'type'			 => 'switch',
                            'label'			 => esc_html__( 'Hide title from menu ?', 'seocify' ),
                            'right-choice'	 => array(
                                'value'	 => 'yes',
                                'label'	 => esc_html__( 'Yes', 'seocify' )
                            ),
                            'left-choice'	 => array(
                                'value'	 => 'no',
                                'label'	 => esc_html__( 'No', 'seocify' )
                            ),
                            'value'			 => 'no',
                            'desc'			 => esc_html__( 'If you dont want to add title(or this page) on menu. you can set yes. if you set yes. this menu will be hide in menu.', 'seocify' ),
                        ),
                    ),
                ),
                'show_borders'	 => false,
            ),
            'show_breadcrumb'	 => array(
                'type'  => 'switch',
                'label' => esc_html__('Show Breadcrumb', 'seocify'),
                'left-choice' => array(
                    'value' => false,
                    'label' => esc_html__('Default', 'seocify'),
                ),
                'right-choice' => array(
                    'value' => true,
                    'label' => esc_html__('Show', 'seocify'),
                ),
            ),
            'header_title'	 => array(
                'type'	 => 'text', 
                'label'	 => esc_html__( 'Banner title', 'seocify' ),
                'desc'	 => esc_html__( 'Add your Page hero title', 'seocify' ),
            ),
            'header_image'	 => array(
                'label'	 => esc_html__( ' Banner Image', 'seocify' ),
                'desc'	 => esc_html__( 'Upload a Page header image', 'seocify' ),
                'help'	 => esc_html__( "This default header image.", 'seocify' ),
                'type'	 => 'upload'
            ),
            'overlay'		 => array(
                'type'		 => 'color-picker',
                'value'		 => '',
                'label'		 => esc_html__( 'Overlay', 'seocify' ),
                'desc'		 => esc_html__( 'This is optional Overlay', 'seocify' ),
            ),
        ),
    ),
);
$options['_page_meta']['options'] = array_merge($options['_page_meta']['options'], get_meta_page_feild(true));