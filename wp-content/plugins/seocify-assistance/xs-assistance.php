<?php
/**
 Plugin Name: Seocify Assistance
 Plugin URI:http://xpeedstudio.com
 Description: Seocify Assistance is a plugin for our Seocify Theme.
 Author: xpeedstudio
 Author URI: http://xpeedstudio.com
 Version: 1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define("XS_PLUGIN_DIR", plugin_dir_path(__FILE__ ));

class Xs_Main{

	/**
     * Holds the class object.
     *
     * @since 1.0.0
     *
     */
    
	public static $_instance;

	/**
     * Plugin Name
     *
     * @since 1.0.0
     *
     */

	public $plugin_name = 'Seocify Assistance';

	/**
     * Plugin Version
     *
     * @since 1.0.0
     *
     */

	public $plugin_version = '1.0.0';

	/**
     * Plugin File
     *
     * @since 1.0.0
     *
     */

	public $file = __FILE__;

	/**
     * Load Construct
     * 
     * @since 1.0.0
     */

	public function __construct(){
		$this->xs_plugin_init();
	}

	/**
     * Plugin Initialization
     *
     * @since 1.0.0
     *
     */

	public function xs_plugin_init(){

		require_once (plugin_dir_path($this->file). 'post-type/xs-post-class.php');
		require_once (plugin_dir_path($this->file). 'init.php');
          add_action( 'wp_enqueue_scripts', array( $this, 'xs_enqueue_script'));
		
	}
    public function xs_enqueue_script(){}
	public static function xs_get_instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new Xs_Main();
        }
        return self::$_instance;
    }
    public function get_social_share(){
        ?>
        <ul class="social-list version-2">
            <li class="title"><?php esc_html_e('Share :','seocify');?></li>
            <li><a class="facebook" target="_blank" href="http://www.facebook.com/share.php?u=<?php esc_url(the_permalink());?>" title="<?php esc_url(the_title());?>"><i class="fa fa-facebook"></i></a></li>
            <li><a class="twitter" target="_blank" href="http://twitter.com/intent/tweet?status=<?php esc_url(the_title());?>+<?php esc_url(the_permalink());?>"><i class="fa fa-twitter"></i></a></li>
            <li><a class="linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php esc_url(the_permalink());?>&amp;title=<?php esc_url(the_title());?>&amp;source=<?php echo esc_url(home_url('/'));?>"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="vimeo" target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?url=<?php esc_url(the_permalink());?>&amp;is_video=false&amp;description=<?php esc_url(the_title());?>"><i class="fa fa-pinterest-p"></i></a></li>
            <li><a class="googlePlus" target="_blank" href="https://plus.google.com/share?url=<?php esc_url(the_permalink());?>"><i class="fa fa-google-plus"></i></a></li>
        </ul>
        <?php


    }
}
$Xs_Main = Xs_Main::xs_get_instance();