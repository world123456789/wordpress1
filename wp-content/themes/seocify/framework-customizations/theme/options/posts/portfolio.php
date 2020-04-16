<?php if ( !defined( 'FW' ) ) {	die( 'Forbidden' ); }

$options = array(
	'_portfolio_meta' => array(
		'title'		 => __( 'Portfolio Settings', 'seocify' ),
		'type'		 => 'box',
		'priority'	 => 'high',
		'options'	 => array(
			'header_title'	 => array(
				'type'	 => 'text',
				'label'	 => esc_html__( 'Banner title', 'seocify' ),
				'desc'	 => esc_html__( 'Add your post hero title', 'seocify' ),
			),
			'header_image'	 => array( 
				'label'	 => esc_html__( ' Banner Image', 'seocify' ),
				'desc'	 => esc_html__( 'Upload a post header image', 'seocify' ),
				'help'	 => esc_html__( "This default header image will be used for all your post.", 'seocify' ),
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
