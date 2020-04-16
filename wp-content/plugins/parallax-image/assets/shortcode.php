<?php

// Check if Mobile_Detect is already included

if (!class_exists('Mobile_Detect')) {
	require_once 'mobile_detect.php';
}

add_action( 'wp_enqueue_scripts', 'DuckParallaxScripts' );

/**
 * Register style sheet and scripts.
 */
function DuckParallaxScripts() {
	wp_register_script ('duck-parallax', plugins_url('/js/parallax.min.js' ,  __FILE__), array('jquery'), '1.4.2', true);
	wp_register_script ('duck-px-offset', plugins_url('/js/dd-parallax-offset.js' ,  __FILE__), array('jquery'), '1.0', true);
    wp_register_style( 'duck-parallax', plugins_url('/css/duck-parallax.css',  __FILE__ ));
}

// The Shortcode 

function duck_parallax_shortcode($atts, $content = null){

	$atts = shortcode_atts(
		array(
			'img' 		=> '',
			'speed' 	=> '2',
			'height' 	=> '',
			'z-index' 	=> '0',
			'mobile' 	=> '',
			'position' 	=> 'left',
			'offset' 	=> false,
			'text-pos' => 'top',
		), $atts, 'duck-parallax' );

/* Enqueue only for shortcode */ 
	wp_enqueue_script('duck-parallax');
	wp_enqueue_style('duck-parallax');

if ( ( null !== $atts['offset'] ) && ( $atts['offset'] == 'true' ) ) {
	wp_enqueue_script('duck-px-offset');
}

if ( !$atts['img']) {return;}	

// Detect Mobile
$detect = new Mobile_Detect;

// If Mobile Image isn't set
	if ($atts['mobile'] !== ""){
		$mobile_img = $atts['mobile'];
	}
	else {
		$mobile_img = $atts['img'];
	}
    $args = array(
        'post_type' => 'attachment',
        'post_mime_type' =>'image',
        'post_status' => 'inherit',
        'posts_per_page' => -1,
    );

    $query_images = new WP_Query( $args );
	
	if (strpos($atts['img'], 'http') === 0){
		$image_url = esc_url($atts['img']);
	}
	else {
		if ( $query_images->have_posts() ) {
		  foreach ( $query_images->posts as $item) { 
			$filename = wp_basename($item->guid);
			if($atts['img'] == $filename) {$image_url = $item->guid;}
			}
		}
	}
	if ($atts['speed'] < 10) {
		$speed = '.'.$atts['speed'];
	}
	else {
		$speed = 1;
	}
	$zindex = $atts['z-index'];
    wp_reset_postdata(); 
	if ( $detect->isMobile() ) {
		
		if (strpos($mobile_img, 'http') === 0){
			$image_path = esc_url($mobile_img);
			}
			else {
				if ($query_images->have_posts() ) {
					foreach ($query_images->posts as $item) {
						$filename = wp_basename($item->guid);
							if($mobile_img == $filename) {
							$mobile_img = $item->guid;
							$image_path = get_attached_file($item->ID);
						}
					}
				}
			}

		list($width, $height) = getimagesize($image_path);
		$factor = $height / $width;
		$divID = preg_replace('/\\.[^.\\s]{3,4}$/', '', $atts['img']);

		$textPos = strtolower($atts['text-pos']);
		
		switch($textPos){
			case 'top':
				$align = "top: 0;";
				break;
			case 'bottom':
				$align = "bottom: 0;";
				break;
			default: 
				$align = "top: 50%;transform:translate(0,-50%)";
				break;
		}
		
		$output  ='<div class="px-mobile-container" id="#'.$divID.'" data-factor="'.$factor.'" data-height="'.$height.'"><div class="parallax-mobile">';
		$output .='<img src="'. $mobile_img .'" class="px-mobile-img" />';
			$output .= '<div class="parallax-content" style="'.$align.'">';
			$output .= do_shortcode($content);
			$output .= '</div>';
		$output .='</div></div>';
	}
	
	else{
			
		$textPos = strtolower($atts['text-pos']);
		switch($textPos){
			case 'top':
				$align = "flex-start;";
				break;
			case 'bottom':
				$align = "flex-end;";
				break;
			default: 
				$align = "center";
				break;
		}

			$output = '<section class="parallax-section">';
			$output .= '<div class="parallax-window" data-z-index="'.$zindex.'" data-position-x="'.$atts['position'].'" data-parallax="scroll" data-speed="'.$speed.'" data-image-src="'.$image_url.'"';
			$output .= ' style="align-items: ' . $align .';'; 
			if ($atts['height'] !== '') $output .= 'min-height: '.$atts['height'].'px;';
			$output .='">';
			
			
			$output .= '<div class="parallax-container parallax-content">';
			$output .= do_shortcode($content);
			$output .= '</div></div></section>';
	
		}	
			
			return $output;
		
}
add_shortcode('dd-parallax', 'duck_parallax_shortcode');
