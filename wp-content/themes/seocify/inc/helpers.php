<?php
if ( !defined( 'ABSPATH' ) )
	die( 'Direct access forbidden.' );
/**
 * Helper functions used all over the theme
 */
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package xs
 */
/*
  Return
 *
 *  */

// simply echos the variable
if ( !function_exists( 'seocify_return' ) ) {

	function seocify_return( $s ) {
		return $s;
	}

}
/*
 * FOR ONE PAGE Section
 * since 1.0
 */

if ( !function_exists( 'seocify_editor_data' ) ) {

	function seocify_editor_data( $value ) {
		return wp_kses_post( $value );
	}

}
// Gets unyson option data in safe mode
// since 1.0
if ( !function_exists( 'seocify_get_option' ) ) {

	function seocify_get_option( $k, $v = '', $m = 'theme-settings' ) {
		if ( defined( 'FW' ) ) {
			switch ( $m ) {
				case 'theme-settings':
					$v = fw_get_db_settings_option( $k );
					break;

				default:
					$v = '';
					break;
			}
		}
		return $v;
	}

}
if ( !function_exists( 'seocify_resize' ) ) {

	function seocify_resize( $url, $width = false, $height = false, $crop = false ) {
		if ( function_exists( 'fw_resize' ) ) {
			$fw_resize	 = FW_Resize::getInstance();
			$response	 = $fw_resize->process( $url, $width, $height, $crop );
			return (!is_wp_error( $response ) && !empty( $response[ 'src' ] ) ) ? $response[ 'src' ] : $url;
		} else {
			if ( !empty( $url ) ) {
				return $url;
			}
		}
	}

}
// Gets unyson image url from option data in a much simple way
// sience 1.0
if ( !function_exists( 'seocify_get_image' ) ) {

	function seocify_get_image( $k, $v = '', $d = false ) {

		if ( $d == true ) {
			$attachment = $k;
		} else {
			$attachment = seocify_get_option( $k );
		}

		if ( isset( $attachment[ 'url' ] ) && !empty( $attachment ) ) {
			$v = $attachment[ 'url' ];
		}

		return $v;
	}

}
/* Gets unyson image url from variable
 * sience 1.0
 * seocify_image($img, $alt )
 */

if ( !function_exists( 'seocify_image' ) ) {

	function seocify_image( $img, $alt, $v = '' ) {

		if ( isset( $img[ 'url' ] ) && !empty( $img ) ) {
			$i	 = $img[ 'url' ];
			$v	 = "<img src=" . $i . " alt=" . $alt . " />";
		}

		return $v;
	}

}
// Gets original page ID/ Slug
// since 1.0
if ( !function_exists( 'seocify_main' ) ) {

	function seocify_main( $id, $name = true ) {
		if ( function_exists( 'icl_object_id' ) ) {
			$id = icl_object_id( $id, 'page', true, 'en' );
		}

		if ( $name === true ) {
			$post = get_post( $id );
			return $post->post_name;
		} else {
			return $id;
		}
	}

}
if ( !function_exists( 'seocify_page_list' ) ) {

	function seocify_page_list() {
		$xs_pagess	 = array();
		$xs_pages	 = get_pages();
		if ( is_array( $xs_pages ) ) {
			foreach ( $xs_pages as $xs_page ) {
				$xs_pagess[ $xs_page->ID ] = $xs_page->post_title;
			}
		}
		return $xs_pagess;
	}

}
// Gets post's meta data in a much simplier way.
// since 1.0

if ( !function_exists( 'seocify_get_post_meta' ) ) {

	function seocify_get_post_meta( $id, $needle ) {
		$data = get_post_meta( $id, 'fw_options' );
		if ( is_array( $data ) && isset( $data[ 0 ][ 'page_sections' ] ) ) {
			$data = $data[ 0 ][ 'page_sections' ];

			if ( is_array( $data ) ) {
				return seocify_seekKey( $data, $needle );
			}
		}
	}

}

/*
 * btn Function
 * since 1.0
 */
//btn function

if ( !function_exists( 'seocify_theme_button_class' ) ) :

	function seocify_theme_button_class( $style ) {
		/**
		 * Display specific class for buttons - depends on theme
		 */
		if ( $style == 'default' ) {
			echo 'btn btn-border';
		} elseif ( $style == 'primary' ) {
			echo 'btn btn-primary';
		} else {
			echo 'default';
		}
	}

endif;





/*
 * This fucntion for recent post shortcode.
 * people can select show from one category or from all category
 * since 1.0
 */

// term
if ( !function_exists( 'seocify_get_category_term_list' ) ) :

	function seocify_get_category_term_list() {
		/**
		 * Return array of categories
		 */
		$taxonomy	 = 'category';
		$args		 = array(
			'hide_empty' => true,
		);

		$terms		 = get_terms( $taxonomy, $args );
		$result		 = array();
		$result[ 0 ] = esc_html__( 'All Categories', 'seocify' );

		if ( !empty( $terms ) )
			foreach ( $terms as $term ) {
				$result[ $term->term_id ] = $term->name;
			}
		return $result;
	}

endif;



/*
 * Function for color RGB
 */
if ( !function_exists( 'seocify_color_rgb' ) ) {

	function seocify_color_rgb( $hex ) {
		$hex		 = preg_replace( "/^#(.*)$/", "$1", $hex );
		$rgb		 = array();
		$rgb[ 'r' ]	 = hexdec( substr( $hex, 0, 2 ) );
		$rgb[ 'g' ]	 = hexdec( substr( $hex, 2, 2 ) );
		$rgb[ 'b' ]	 = hexdec( substr( $hex, 4, 2 ) );

		$color_hex = $rgb[ "r" ] . ", " . $rgb[ "g" ] . ", " . $rgb[ "b" ];

		return $color_hex;
	}

}
/*
 * Section Edit option
 *
 * This function for show section edit option in every section in one page
 *
 * Since 1.0
 *  */
if ( !function_exists( 'seocify_edit_section' ) ) {

	function seocify_edit_section() {
		if ( is_user_logged_in() ) {
			?>
			<div class="section-edit">
				<div class="container relative">
					<?php
					edit_post_link( esc_html__( 'Edit', 'seocify' ), '', '' );
					?>
					<span class="section-abc"><?php echo esc_html( get_the_title() ); ?> <?php echo esc_attr_e( 'Or', 'seocify' ) ?>
						<a href="<?php echo esc_url( home_url() ); ?>/wp-admin/post.php?post=<?php the_ID(); ?>&action=elementor" target="_blank"><?php echo esc_attr_e( 'Edit with elementor', 'seocify' ) ?></a></span>

				</div>
			</div>
			<?php
		}
	}

}


// breadcrumbs

if ( !function_exists( 'seocify_get_breadcrumbs' ) ) {

	function seocify_get_breadcrumbs( $seperator = ' / ' ) {

		echo '<ul class="breadcumbs list-inline"><li>';
		if ( !is_home() ) {
			echo '<a href="';
			echo esc_url( get_home_url( '/' ) );
			echo '">';
			echo esc_html__( 'Home', 'seocify' );
			echo "</a>";
			if ( is_category() || is_single() ) {
				$category	 = get_the_category();
				$post		 = get_queried_object();
				$postType	 = get_post_type_object( get_post_type( $post ) );
				if ( !empty( $category ) ) {
					echo esc_attr( $seperator );
					echo esc_html( $category[ 0 ]->cat_name );
				} else if ( $postType ) {
					echo esc_attr( $seperator );
					echo esc_html( $postType->labels->singular_name );
				}
				if ( is_single() ) {
					echo esc_attr( $seperator );
					echo wp_trim_words( get_the_title(), 3 );
				}
			} elseif ( is_page() ) {
				echo esc_attr( $seperator );
				echo wp_trim_words( get_the_title(), 3 );
			}
		}
		if ( is_tag() ) {
			echo esc_attr( $seperator );
			single_tag_title();
		} elseif ( is_day() ) {
			echo esc_attr( $seperator );
			echo esc_html__( 'Blogs for', 'seocify' ) . " ";
			the_time( 'F jS, Y' );
		} elseif ( is_month() ) {
			echo esc_attr( $seperator );
			echo esc_html__( 'Blogs for', 'seocify' ) . " ";
			the_time( 'F, Y' );
		} elseif ( is_year() ) {
			echo esc_attr( $seperator );
			echo esc_html__( 'Blogs for', 'seocify' ) . " ";
			the_time( 'Y' );
		} elseif ( is_author() ) {
			echo esc_attr( $seperator );
			echo esc_html__( 'Author Blogs', 'seocify' );
		} elseif ( isset( $_GET[ 'paged' ] ) && !empty( $_GET[ 'paged' ] ) ) {
			echo esc_html__( 'Blogs', 'seocify' );
		} elseif ( is_search() ) {
			echo esc_attr( $seperator );
			echo esc_html__( 'Search Result', 'seocify' );
		} elseif ( is_404() ) {
			echo esc_attr( $seperator );
			echo esc_html__( '404 Not Found', 'seocify' );
		}
		echo '</li></ul>';
	}

}


/*
 * WP Kses Allowed HTML Tags Array in function
 * @Since Version 0.1
 * @param ar
 * Use: seocify_kses($raw_string);
 * */
if ( !function_exists( 'seocify_kses' ) ) {

	function seocify_kses( $raw ) {

		$allowed_tags = array(
			'span'							 => array(
				'class' => array(),
			),
			'a'								 => array(
				'class'	 => array(),
				'href'	 => array(),
				'rel'	 => array(),
				'title'	 => array(),
			),
			'abbr'							 => array(
				'title' => array(),
			),
			'b'								 => array(),
			'blockquote'					 => array(
				'cite' => array(),
			),
			'cite'							 => array(
				'title' => array(),
			),
			'code'							 => array(),
			'del'							 => array(
				'datetime'	 => array(),
				'title'		 => array(),
			),
			'dd'							 => array(),
			'div'							 => array(
				'class'	 => array(),
				'title'	 => array(),
				'style'	 => array(),
			),
			'dl'							 => array(),
			'dt'							 => array(),
			'em'							 => array(),
			'h1'							 => array(),
			'h2'							 => array(),
			'h3'							 => array(),
			'h4'							 => array(),
			'h5'							 => array(),
			'h6'							 => array(),
			'i'								 => array(
				'class' => array(),
			),
			'img'							 => array(
				'alt'	 => array(),
				'class'	 => array(),
				'height' => array(),
				'src'	 => array(),
				'width'	 => array(),
			),
			'li'							 => array(
				'class' => array(),
			),
			'ol'							 => array(
				'class' => array(),
			),
			'p'								 => array(
				'class' => array(),
			),
			'q'								 => array(
				'cite'	 => array(),
				'title'	 => array(),
			),
			'span'							 => array(
				'class'	 => array(),
				'title'	 => array(),
				'style'	 => array(),
			),
			'iframe'						 => array(
				'width'			 => array(),
				'height'		 => array(),
				'scrolling'		 => array(),
				'frameborder'	 => array(),
				'allow'			 => array(),
				'src'			 => array(),
			),
			'strike'						 => array(),
			'br'							 => array(),
			'strong'						 => array(),
			'data-wow-duration'				 => array(),
			'data-wow-delay'				 => array(),
			'data-wallpaper-options'		 => array(),
			'data-stellar-background-ratio'	 => array(),
			'ul'							 => array(
				'class' => array(),
			),
		);

		if ( function_exists( 'wp_kses' ) ) { // WP is here
			$allowed = wp_kses( $raw, $allowed_tags );
		} else {
			$allowed = $raw;
		}


		return $allowed;
	}

}
/**
 *
 * Load Goggle Font
 * @since 1.0.0
 *
 */
if ( !function_exists( 'seocify_google_fonts_url' ) ) {

	function seocify_google_fonts_url() {
		$fonts_url		 = '';
		$font_families	 = array();
		//Body Font
		$body_font		 = seocify_option( 'body_font' );
		if ( !empty( $body_font ) ) {
			$body_families	 = isset( $body_font[ 'font-family' ] ) ? $body_font[ 'font-family' ] : '';
			$body_variant	 = isset( $body_font[ 'variant' ] ) ? $body_font[ 'variant' ] : '';
			$font_families[] = $body_families . ":" . $body_variant;
		}
		//Heading font
		if ( !empty( $head_font ) ) {
			$head_font		 = seocify_option( 'heading_font' );
			$head_families	 = isset( $head_font[ 'font-family' ] ) ? $head_font[ 'font-family' ] : '';
			$head_variant	 = isset( $head_font[ 'variant' ] ) ? $head_font[ 'variant' ] : '';
			$font_families[] = $head_families . ":" . $head_variant;
		}

		$font_families[] = 'Nunito:300,400,600,700,900';

		if ( $font_families ) {
			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) )
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}

}
/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 *
 */
if ( !function_exists( 'seocify_category_list_slug' ) ) {

	function seocify_category_list_slug( $cat ) {
		$query_args = array(
			'orderby'	 => 'ID',
			'order'		 => 'DESC',
			'hide_empty' => 1,
			'taxonomy'	 => $cat
		);

		$categories	 = get_categories( $query_args );
		$options	 = array( esc_html__( '0', 'seocify' ) => 'All Category' );
		if ( is_array( $categories ) && count( $categories ) > 0 ) {
			return $categories;
		}
	}

}
/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 *
 */
if ( !function_exists( 'seocify_featured_product' ) ) {

	function seocify_featured_product() {
		$query_args	 = array(
			'post_type'		 => 'product',
			'tax_query'		 => array(
				'relation' => 'AND',
				array(
					'taxonomy'	 => 'product_type',
					'field'		 => 'slug',
					'terms'		 => 'wp_fundraising',
				),
				array(
					'taxonomy'	 => 'product_visibility',
					'field'		 => 'name',
					'terms'		 => 'featured',
				),
			),
			'posts_per_page' => -1,
		);
		$xs_query	 = new WP_Query( $query_args );
		$options	 = array( esc_html__( '0', 'seocify' ) => 'Select Product' );
		if ( $xs_query->have_posts() ):
			while ( $xs_query->have_posts() ) {
				$xs_query->the_post();
				$options[ get_the_ID() ] = get_the_title();
			}
			wp_reset_postdata();
			return $options;
		endif;
	}

}
if ( !function_exists( 'seocify_option' ) ) {

	function seocify_option( $option ) {
		// Get options
		return get_theme_mod( $option, seocify_defaults( $option ) );
	}

}
if ( !function_exists( 'seocify_defaults' ) ) {

	function seocify_defaults( $options ) {

		$default = array(
			'header_layout'			 => 1,
			'header_style'			 => 1,
			'show_top_header'		 => false,
			'show_top_nav'			 => true,
			'page_show_breadcrumb'	 => 1,
			'nav_search'			 => false,
			'nav_sidebar'			 => false,
			'footer_style'			 => 1,
			'footer_widget_layout'	 => 3,
			'show_terms'			 => false,
			'show_footer_widget'	 => false,
			'blog_single_sidebar'	 => 3,
			'shop_sidebar'			 => '1',
			'shop_grid_column'		 => '6',
			'blog_sidebar'			 => 3,
			'blog_style'			 => '1',
			'blog_column_number'	 => '2',
			'show_page_banner'		 => true,
			'show_blog_banner'		 => true,
			'blog_banner_title'		 => esc_html__( 'Blog Page', 'seocify' ),
			'show_footer_widget'	 => false,
			'page_sidebar'			 => '3',
			'copyright_text'		 => esc_html__( 'Copyrights By Xpeedstudio - 2018', 'seocify' ),
			'error_title'			 => esc_html__( 'Error Page', 'seocify' ),
			'error_subtitle'		 => esc_html__( 'Either Something went wrong or the page doesn\'t exist anymore', 'seocify' ),
			'back_to_home_label'	 => esc_html__( 'Back to Home', 'seocify' ),
			'error_logo'			 => SEOCIFY_IMAGES . '/404.png',
		);

		if ( !empty( $default[ $options ] ) )
			return $default[ $options ];
	}

}
/**
 *
 * Get Catagories/Taxonomies List
 * @since 1.0.0
 *
 */
if ( !function_exists( 'seocify_category_list' ) ) {

	function seocify_category_list( $cat ) {
		$query_args = array(
			'orderby'	 => 'ID',
			'order'		 => 'DESC',
			'hide_empty' => 1,
			'taxonomy'	 => $cat
		);

		$categories	 = get_categories( $query_args );
		$options	 = array( esc_html__( '0', 'seocify' ) => 'All Category' );
		if ( is_array( $categories ) && count( $categories ) > 0 ) {
			foreach ( $categories as $cat ) {
				$options[ $cat->term_id ] = $cat->name;
			}
			return $options;
		}
	}

}
if ( !function_exists( 'seocify_get_posts' ) ) {

	function seocify_get_posts( $post_type ) {
		$mega_menus	 = array();
		$args		 = array(
			'post_type' => $post_type,
		);
		$posts		 = get_posts( $args );
		foreach ( $posts as $post ) {
			$mega_menus[ $post->post_name ] = $post->post_title;
		}
		return $mega_menus;
	}

}
if ( !function_exists( 'seocify_get_mega_item_child_slug' ) ) {

	function seocify_get_mega_item_child_slug( $location, $option_id ) {

		$mega_item	 = '';
		$locations	 = get_nav_menu_locations();
		$menu		 = wp_get_nav_menu_object( $locations[ $location ] );
		$menuitems	 = wp_get_nav_menu_items( $menu->term_id );

		foreach ( $menuitems as $menuitem ) {

			$id			 = $menuitem->ID;
			$mega_item	 = fw_ext_mega_menu_get_db_item_option( $id, $option_id );
		}
		return $mega_item;
	}

}
if ( !function_exists( 'seocify_get_post_content' ) ) {

	function seocify_get_post_content( $title ) {
		$args = array(
			'title'			 => $title,
			'post_type'		 => 'mega_menu',
			'post_status'	 => 'publish',
			'numberposts'	 => 1
		);

		$the_query	 = new WP_Query( $args );
		$output		 = '';
		if ( $the_query->have_posts() ) :
			while ( $the_query->have_posts() ) : $the_query->the_post();
				ob_start();
				the_content();
				$output = ob_get_clean();

			endwhile;
		endif;
		wp_reset_postdata();

		return $output;
	}

}
if ( !function_exists( 'seocify_wc_get_product_list' ) ) {

	function seocify_wc_get_product_list() {
		$query_args	 = array(
			'post_type'		 => 'product',
			'posts_per_page' => -1,
		);
		$xs_query	 = new WP_Query( $query_args );
		$options	 = array( esc_html__( '0', 'seocify' ) => 'Select Product' );
		if ( $xs_query->have_posts() ):
			while ( $xs_query->have_posts() ) {
				$xs_query->the_post();
				$options[ get_the_ID() ] = get_the_title();
			}
			wp_reset_postdata();
			return $options;
		endif;
	}

}
if ( !function_exists( 'seocify_content_read_more' ) ) {

	function seocify_content_read_more( $num = 20, $button = true ) {

		$excerpt		 = get_the_excerpt();
		$trimmed_content = wp_trim_words( $excerpt,
											$num_words = $num,
											$more = null );
		echo '<div class="entry-content">';
		echo wp_kses_post( $trimmed_content );
		echo '</div>';
		if ( $button == true ) {
			echo '<div class="btn-wraper"><a href="' . get_the_permalink() . '" class="btn btn-primary icon-right">' . esc_html__( 'Continue Reading', 'seocify' ) . '<i class="icon icon-arrow-right"></i></a></div>';
		}
	}

}
if ( !function_exists( 'seocify_get_alt_name' ) ) {

	function seocify_get_alt_name( $id ) {
		if ( !empty( $id ) ) {
			$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
			if ( !empty( $alt ) ) {
				$alt = $alt;
			} else {
				$alt = get_the_title( $id );
			}
			return $alt;
		}
	}

}

/*
 *
 * Get Footer Column
 */

if ( !function_exists( 'seocify_get_footer_column' ) ) {

	function seocify_get_footer_column( $footer_columns ) {
		if ( $footer_columns == 12 ) {
			return 1;
		} elseif ( $footer_columns == 6 ) {
			return 2;
		} elseif ( $footer_columns == 4 ) {
			return 3;
		} else {
			return 4;
		}
	}

}

if ( !function_exists( 'seocify_preloader' ) ) {

	function seocify_preloader() {

		if ( defined( 'FW' ) ) {
			$loader = seocify_option( 'show_preloader' );
			if ( $loader ) {
				?>
				<div id="preloader">
					<div class="preloader-wrapper">
						<div class="spinner"></div>
					</div>
					<div class="preloader-cancel-btn">
						<a href="#" class="btn btn-secondary prelaoder-btn"><?php esc_html_e( 'Cancel Preloader', 'seocify' ); ?></a>
					</div>
				</div>
				<?php
			}
		}
	}

}
if ( !function_exists( 'seocify_get_youtube_image' ) ) {

	function seocify_get_youtube_image( $e ) {
		//GET THE URL
		if ( $e != '' ):
			$url = $e;

			$queryString = parse_url( $url, PHP_URL_QUERY );

			parse_str( $queryString, $params );

			$v = $params[ 'v' ];
			//DISPLAY THE IMAGE
			if ( strlen( $v ) > 0 ) {
				echo "<img src='http://i3.ytimg.com/vi/$v/default.jpg' width='600' />";
			}
		endif;
	}

}

/*
 * FOR ONE PAGE Section
 * since 1.0
 */

function seocify_editor_data( $value ) {
	return wp_kses_post( $value );
}

// Gets original page ID/ Slug
// since 1.0

function seocify_main( $id, $name = true ) {
	if ( function_exists( 'icl_object_id' ) ) {
		$id = icl_object_id( $id, 'page', true, 'en' );
	}

	if ( $name === true ) {
		$post = get_post( $id );
		return $post->post_name;
	} else {
		return $id;
	}
}

// Creates SEO friendly section ID from page ID. Returns page ID directly if $return = true
// since 2.0
function seocify_sectionID( $id, $returnID = false ) {

	if ( $returnID == false ) {

		$str		 = get_the_title( $id );
		$patterns	 = array(
			"/[:#+*+&+!+@+!+\.+?+%+$+\"+'+^+\[+<+{+\(+\)}+>+\]+,+`+;+,+=+\\\\]/", // match unwanted special characters
			"@<(script|style)[^>]*?>.*?</\\1>@si", // match <script>, <style> tags
			"/[~\r\n\t \/_|+ -]+/" // match newline, tab and more unwanted characters
		);

		$replacements = array(
			"", // for 1st match
			"", // for 2nd match
			"-" // for 3rd match
		);

		$str = preg_replace( $patterns, $replacements, strip_tags( $str ) );
		return strtolower( trim( $str, '-' ) );
	} else {

		return "section-$id";
	}
}

// Gets post's meta data in a much simplier way.
// since 1.0

function seocify_get_post_meta( $id, $needle ) {
	$data = get_post_meta( $id, 'fw_options' );
	if ( is_array( $data ) && isset( $data[ 0 ][ 'page_sections' ] ) ) {
		$data = $data[ 0 ][ 'page_sections' ];

		if ( is_array( $data ) ) {
			return seocify_seekKey( $data, $needle );
		}
	}
}

function seocify_seekKey( $haystack, $needle ) {
	foreach ( $haystack as $key => $value ) {

		if ( $key == $needle ) {
			return $value;
		} elseif ( is_array( $value ) ) {
			return seocify_seekKey( $value, $needle );
		}
	}
}

/*
 * wpml compatitible
 */

if ( !function_exists( 'seocify_theme_translate' ) ) :

	function seocify_theme_translate( $content ) {
		/**
		 * Return the content for translations plugins
		 * @param string $content
		 */
		$content = html_entity_decode( $content, ENT_QUOTES, 'UTF-8' );

		if ( function_exists( 'icl_object_id' ) && strpos( $content, 'wpml_translate' ) == true ) {
			$content = do_shortcode( $content );
		} elseif ( function_exists( 'qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage' ) ) {
			$content = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage( $content );
		}

		return $content;
	}

endif;


//WPML CUSTOM Swicther
if ( !function_exists( 'seocify_languages_list_popup' ) ) :

	function seocify_languages_list_popup() {
		$languages = icl_get_languages( 'skip_missing=0&orderby=code' );
		if ( !empty( $languages ) ) {
			echo '<div class="wpml-ls-legacy-list-horizontal"><ul>';
			foreach ( $languages as $l ) {
				echo '<li>';
				if ( $l[ 'country_flag_url' ] ) {
					if ( !$l[ 'active' ] )
						echo '<a href="' . $l[ 'url' ] . '">';
					echo '<img src="' . $l[ 'country_flag_url' ] . '" height="12" alt="' . $l[ 'language_code' ] . '" width="18" />';
					if ( !$l[ 'active' ] )
						echo '</a>';
				}
				if ( !$l[ 'active' ] )
					echo '<a href="' . $l[ 'url' ] . '">';
				echo icl_disp_language( $l[ 'native_name' ], $l[ 'translated_name' ] );
				if ( !$l[ 'active' ] )
					echo '</a>';
				echo '</li>';
			}
			echo '</ul></div>';
		}
	}




endif;



//  Grid line parallax animation on/off

function xs_grid_line_parallax_animation($classes) {

	$on_parallax  =  seocify_option('xs_grid_line_parallax_animation');
	$on_parallax_line  =  seocify_option('xs_grid_line_parallax_animation_line_style');

	$classes[] = '';
	
	   if(is_front_page()) {

         if($on_parallax){
			$classes[] .= 'xs-grid-line-parallax-animation';
		 }

		 if($on_parallax_line){
			$classes[] .= 'xs-grid-line-parallax-line-style';
		 }
       }

		return $classes;

}

add_filter('body_class', 'xs_grid_line_parallax_animation');


