<?php

if ( !defined( 'ABSPATH' ) )
    die( 'Direct access forbidden.' );

/**
 * Register theme menus
 */

class wp_main_mobile_navwalker extends Walker_Nav_Menu {

    private $current_Item; 

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if( $args->has_children ){
            $output .= "\n$indent<ul role=\"menu\" class=\"collapse collapse-".$this->current_Item->ID." \">\n";
        }

    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $this->current_Item = $item;

        if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
        } else if (strcasecmp($item->attr_title, 'disabled') == 0) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
        } else {

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            if($args->has_children  && $depth>0 ) $class_names .= ' dropdown ';

            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names .'>';

            $atts = array();
            $atts['title']  = ! empty( $item->title )   ? $item->title  : '';
            $atts['target'] = ! empty( $item->target )  ? $item->target : '';
            $atts['rel']    = ! empty( $item->xfn )     ? $item->xfn    : '';
            $atts['href']   = ! empty( $item->url )     ? $item->url    : '';

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;

            if(! empty( $item->attr_title )){
                $item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
            } else {
                $item_output .= '<a'. $attributes .'>';
            }

            $caret = ($depth === 0) ? 'down' : 'right';

            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .=  '</a>';
            $item_output .= $args->after;

            if($args->has_children) {

                $item_output .= '
                <span class="menu-toggler collapsed" data-toggle="collapse" data-target=".collapse-'.$item->ID.'">
                <i class="fa fa-angle-right"></i>
                </span>';
            }


            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( !$element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

class seocify_main_nav_walker extends Walker_Nav_Menu {

    private $current_Item;

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        if( $args->has_children ){
            $output .= "\n$indent<ul role=\"menu\" class=\"nav-dropdown xs-icon-menu clearfix nav-submenu \">\n";
        }
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $this->current_Item = $item;
        $menu_icon_class = get_post_meta($item->ID, '_menu_item_icon', true);
        if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
        } else if (strcasecmp($item->attr_title, 'disabled') == 0) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
        } else {

            $class_names = $value = '';

            $classes = empty( $item->classes ) ? array() : (array) $item->classes;
            $classes[] = 'menu-item-' . $item->ID;
            $classes[] = 'single-menu-item';

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

            if($args->has_children  && $depth>0 ) $class_names .= ' dropdown ';

            if(in_array('current-menu-parent', $classes)) { $class_names .= ' active'; }
            if(in_array('current_page_parent', $classes)) { $class_names .= ' active'; }
            if(in_array('current-menu-item', $classes)) { $class_names .= ' active'; }
            
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names .'>';



            $atts = array();
            $atts['title']  = ! empty( $item->title )   ? $item->title  : '';
            $atts['target'] = ! empty( $item->target )  ? $item->target : '';
            $atts['rel']    = ! empty( $item->xfn )     ? $item->xfn    : '';
            $atts['href']   = ! empty( $item->url )     ? $item->url    : '';

            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

            $attributes = '';
            foreach ( $atts as $attr => $value ) {
                if ( ! empty( $value ) ) {
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            if($menu_icon_class !=""){
                $menu_icon_html = '<i class="'.esc_attr($menu_icon_class).'"></i>';
            }else{
                $menu_icon_html = '';
            }
            $item_output = $args->before;
            if($item->object == 'mega_menu' && $depth ==1){
                $content = '';
                if ( class_exists( 'Elementor\Plugin' ) ) {
                    $elementor = Elementor\Plugin::instance();
                    $content   = $elementor->frontend->get_builder_content_for_display( $item->object_id );
                }

                $item_output .= '<div class="megamenu-content">'.$content.'</div>';
            }else{

                $item_output .= '<a'. $attributes .'>';
                $item_output .= $menu_icon_html;


                $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

                $item_output .=  '</a>';
            }


            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
    }

    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( !$element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}




/**
 * Register theme menus
 */
class Seocify_Custom_Nav_Walker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent	 = str_repeat( "\t", $depth );
		$output	 .= "\n$indent<ul role=\"menu\" class=\"nav-dropdown\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
			$menu_icon_class = get_post_meta($item->ID, '_menu_item_icon', true);
			$frontpage_ID	 = seocify_main( get_option( 'page_on_front' ), false );
			$home			 = (seocify_main( get_the_ID(), false ) == $frontpage_ID) ? true : false;
			if ( seocify_get_post_meta( seocify_main( $item->object_id, false ), 'hide_title_from_menu' ) != 'yes' ) {

				$section = seocify_get_post_meta( seocify_main( $item->object_id, false ), 'xs_page_section' );
				$prefx	 = ($home != true) ? esc_url( home_url( '/#' ) ) : '#';
				$class_names = $value		 = '';

				$classes	 = empty( $item->classes ) ? array() : (array) $item->classes;
				$classes[]	 = 'menu-item-' . $section;

				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

				if ( in_array( 'current-menu-item', $classes ) ) {
					$class_names .= ' active';
				}

				$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

				$id	 = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
				$id	 = $id ? ' id="' . esc_attr( $id ) . '"' : '';

				$output .= $indent . '<li' . $id . $value . $class_names . '>';

				$atts			 = array();
				$atts[ 'title' ]	 = !empty( $item->title ) ? $item->title : '';
				$atts[ 'target' ]	 = !empty( $item->target ) ? $item->target : '';
				$atts[ 'rel' ]	 = !empty( $item->xfn ) ? $item->xfn : '';

				// If item has_children add atts to a.
				if ( $args->has_children && $depth === 0 ) {

					//attr
					$atts[ 'href' ] = '#';

				} else {
					//attr
					if ( !empty( $item->url ) ) {
						if ( $section == 'on' ) {
							$atts[ 'href' ] = esc_url( $prefx . seocify_sectionID( seocify_main( $item->object_id, false ) ) );
						} else {
							$atts[ 'href' ] = esc_url( $item->url );
						}
					} else {
						$atts[ 'href' ] = '';
					}
				}

				$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

				$attributes = '';
				foreach ( $atts as $attr => $value ) {
					if ( !empty( $value ) ) {
						$value		 = ( 'href' === $attr ) ? esc_attr( $value ) : esc_attr( $value );
						$attributes	 .= ' ' . $attr . '="' . $value . '"';
					}
				}

				
				
				if($menu_icon_class !=""){
					$menu_icon_html = '<i class="'.esc_attr($menu_icon_class).'"></i>';
				}else{
					$menu_icon_html = '';
				}
				$item_output = $args->before;
				if($item->object == 'mega_menu' && $depth ==1){
					$content = '';
					if ( class_exists( 'Elementor\Plugin' ) ) {
						$elementor = Elementor\Plugin::instance();
						$content   = $elementor->frontend->get_builder_content_for_display( $item->object_id );
					}
					$item_output .= '<div class="megamenu-content">'.$content.'</div>';
				}else{
	
					if ( !empty( $item->attr_title ) ) {
						$item_output .= '<a' . $attributes . '><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';
					} else {
						$item_output .= '<a' . $attributes . '>';
						$item_output .= $menu_icon_html;
					}
	
					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
					$item_output .= ( $args->has_children && 0 === $depth ) ? '</a>' : '</a>';
				}
	
	
				$item_output .= $args->after;

				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker::end_el()
	 *
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( seocify_get_post_meta( seocify_main( $item->object_id, false ), 'hide_title_from_menu' ) != 'yes' ) {
			$output .= "</li>\n";
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( !$element ) {
			return;
		}

		$id_field = $this->db_fields[ 'id' ];

		// Display this element.
		if ( is_object( $args[ 0 ] ) ) {
			$args[ 0 ]->has_children = !empty( $children_elements[ $element->$id_field ] );
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id ) {
					$fb_output .= ' id="' . $container_id . '"';
				}

				if ( $container_class ) {
					$fb_output .= ' class="' . $container_class . '"';
				}

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id ) {
				$fb_output .= ' id="' . $menu_id . '"';
			}

			if ( $menu_class ) {
				$fb_output .= ' class="' . $menu_class . '"';
			}

			$fb_output	 .= '>';
			$fb_output	 .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">'.esc_html__('Add a Menu','seocify').'</a></li>';
			$fb_output	 .= '</ul>';

			if ( $container ) {
				$fb_output .= '</' . $container . '>';
			}

			echo seocify_return( $fb_output );
		}
	}

}

