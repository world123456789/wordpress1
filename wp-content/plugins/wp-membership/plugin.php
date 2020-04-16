<?php

/**
 *
 *
 * @version 1.3.8
 * @package Main
 * @author e-plugins.com
 */

/*
  Plugin Name: WP Membership |  VestaThemes.com
  Plugin URI: http://e-plugins.com/
  Description: Build Paid Member using Wordpress with Jet.
  Author: e-plugin
  Author URI: http://e-plugins.com/
  Version: 1.3.8
  Text Domain: wpmembership
  License: GPLv3

*/

// Exit if accessed directly
  if (!defined('ABSPATH')) {
  	exit;
  }

  if (!class_exists('WP_iv_membership')) {  	
		
		final class WP_iv_membership {
			
			private static $instance;
			
				/**
				 * The Plug-in version.
				 *
				 * @var string
				 */
				public $version = "1.3.8";
				
				/**
				 * The minimal required version of WordPress for this plug-in to function correctly.
				 *
				 * @var string
				 */
				public $wp_version = "3.5";
				
				public static function instance() {
					if (!isset(self::$instance) && !(self::$instance instanceof WP_iv_membership)) {
						self::$instance = new WP_iv_membership;
					}
					return self::$instance;
				}
				
				/**
				 * Construct and start the other plug-in functionality
				 */
				public function __construct() {
					
						//
						// 1. Plug-in requirements
						//
					if (!$this->check_requirements()) {
						return;
					}
					
						//
						// 2. Declare constants and load dependencies
						//
					$this->define_constants();
					$this->load_dependencies();
					
						//
						// 3. Activation Hooks
						//
					register_activation_hook(__FILE__, array(&$this, 'activate'));
					register_deactivation_hook(__FILE__, array(&$this, 'deactivate'));
					register_uninstall_hook(__FILE__, 'WP_iv_membership::uninstall');
					
						//
						// 4. Load Widget
						//
					add_action('widgets_init', array(&$this, 'register_widget'));
					
						//
						// 5. i18n
						//
					add_action('init', array(&$this, 'i18n'));
						//
						// 6. Actions
						//
					
					add_action('wp_ajax_iv_membership_registration_submit', array(&$this, 'iv_membership_registration_submit'));
					add_action('wp_ajax_nopriv_iv_membership_registration_submit', array(&$this, 'iv_membership_registration_submit'));
					add_action('wp_ajax_iv_membership_user_exist_check', array(&$this, 'iv_membership_user_exist_check'));
					add_action('wp_ajax_nopriv_iv_membership_user_exist_check', array(&$this, 'iv_membership_user_exist_check'));
					add_action('wp_ajax_iv_membership_check_coupon', array(&$this, 'iv_membership_check_coupon'));
					add_action('wp_ajax_nopriv_iv_membership_check_coupon', array(&$this, 'iv_membership_check_coupon'));					
					add_action('wp_ajax_iv_membership_check_package_amount', array(&$this, 'iv_membership_check_package_amount'));
					add_action('wp_ajax_nopriv_iv_membership_check_package_amount', array(&$this, 'iv_membership_check_package_amount'));
					add_action('wp_ajax_iv_membership_update_profile_pic', array(&$this, 'iv_membership_update_profile_pic'));
					add_action('wp_ajax_nopriv_iv_membership_update_profile_pic', array(&$this, 'iv_membership_update_profile_pic'));
					add_action('wp_ajax_iv_membership_update_profile_setting', array(&$this, 'iv_membership_update_profile_setting'));
					add_action('wp_ajax_nopriv_iv_membership_update_profile_setting', array(&$this, 'iv_membership_update_profile_setting'));
					add_action('wp_ajax_iv_membership_update_wp_post', array(&$this, 'iv_membership_update_wp_post'));
					add_action('wp_ajax_nopriv_iv_membership_update_wp_post', array(&$this, 'iv_membership_update_wp_post'));
					add_action('wp_ajax_iv_membership_save_wp_post', array(&$this, 'iv_membership_save_wp_post'));
					add_action('wp_ajax_nopriv_iv_membership_save_wp_post', array(&$this, 'iv_membership_save_wp_post'));					
					add_action('wp_ajax_iv_membership_update_setting_fb', array(&$this, 'iv_membership_update_setting_fb'));
					add_action('wp_ajax_nopriv_iv_membership_update_setting_fb', array(&$this, 'iv_membership_update_setting_fb'));
					add_action('wp_ajax_iv_membership_update_setting_hide', array(&$this, 'iv_membership_update_setting_hide'));
					add_action('wp_ajax_nopriv_iv_membership_update_setting_hide', array(&$this, 'iv_membership_update_setting_hide'));
					add_action('wp_ajax_iv_membership_update_setting_password', array(&$this, 'iv_membership_update_setting_password'));
					add_action('wp_ajax_nopriv_iv_membership_update_setting_password', array(&$this, 'iv_membership_update_setting_password'));					
					add_action('wp_ajax_iv_membership_check_login', array(&$this, 'iv_membership_check_login'));
					add_action('wp_ajax_nopriv_iv_membership_check_login', array(&$this, 'iv_membership_check_login'));
					add_action('wp_ajax_iv_membership_forget_password', array(&$this, 'iv_membership_forget_password'));
					add_action('wp_ajax_nopriv_iv_membership_forget_password', array(&$this, 'iv_membership_forget_password'));					
					add_action('wp_ajax_iv_membership_cancel_stripe', array(&$this, 'iv_membership_cancel_stripe'));
					add_action('wp_ajax_nopriv_iv_membership_cancel_stripe', array(&$this, 'iv_membership_cancel_stripe'));					
					add_action('wp_ajax_iv_membership_cancel_paypal', array(&$this, 'iv_membership_cancel_paypal'));
					add_action('wp_ajax_nopriv_iv_membership_cancel_paypal', array(&$this, 'iv_membership_cancel_paypal'));
					add_action('wp_ajax_iv_membership_profile_stripe_upgrade', array(&$this, 'iv_membership_profile_stripe_upgrade'));
					add_action('wp_ajax_nopriv_iv_membership_profile_stripe_upgrade', array(&$this, 'iv_membership_profile_stripe_upgrade'));
					
					add_action('wp_ajax_iv_membership_update_profile_billing', array(&$this, 'iv_membership_update_profile_billing'));
					add_action('wp_ajax_nopriv_iv_membership_update_profile_billing', array(&$this, 'iv_membership_update_profile_billing'));
					
					add_action('plugins_loaded', array(&$this, 'start'));
					add_action('add_meta_boxes', array(&$this, 'prfx_custom_meta_iv_membership'));
					//add_action('save_post', array(&$this, 'iv_membership_meta_save'));					
					add_action( 'init', array(&$this, 'iv_membership_paypal_form_submit') );
					add_action( 'init', array(&$this, 'iv_membership_stripe_form_submit') );					
					add_action('wp_login', array(&$this, 'check_expiry_date'));					
					add_action('pre_get_posts',array(&$this, 'iv_restrict_media_library') );
					
					add_action('init', array(&$this, 'remove_admin_bar') );	
					add_action( 'wp_loaded', array(&$this, 'iv_membership_woocommerce_form_submit') );
						// 7. Shortcode
						
					add_shortcode('iv_membership_display', array(&$this, 'iv_membership_display_func'));					
					add_shortcode('iv_membership_price_table', array(&$this, 'iv_membership_price_table_func'));
					add_shortcode('iv_membership_registration_form', array(&$this, 'iv_membership_registration_form_func'));
					add_shortcode('iv_membership_payment_form', array(&$this, 'iv_membership_payment_form_func'));
					add_shortcode('iv_membership_form_wizard', array(&$this, 'iv_membership_form_wizard_func'));
					add_shortcode('iv_membership_profile_template', array(&$this, 'iv_membership_profile_template_func'));
					add_shortcode('iv_membership_profile_public', array(&$this, 'iv_membership_profile_public_func'));
					//add_shortcode('iv_membership_stripe_form', array(&$this, 'iv_membership_stripe_form_func'));
					add_shortcode('iv_membership_login', array(&$this, 'iv_membership_login_func'));
					add_shortcode('iv_membership_user_directory', array(&$this, 'iv_membership_user_directory_func'));
					
					add_shortcode('iv_membership_reminder_email_cron', array(&$this, 'iv_membership_reminder_email_cron_func'));
						// 8. Filter
					
					
				
					add_filter('user_contactmethods', array(&$this, 'modify_contact_methods') );					
					add_filter('registration_redirect', array(&$this, 'iv_registration_redirect') );
					add_filter( 'author_link',  array(&$this, 'author_public_profile') );
					
					
								
					//---- COMMENT FILTERS ----//					
				
					//add_filter('comments_template', array(&$this,'no_comments_on_page'),10); 					
					add_action( 'template_redirect', array( $this, 'include_template_function' ), 1 ); 	
						
					
				}
				/**
				 * Define constants needed across the plug-in.
				 */
				private function define_constants() {
					define('WP_iv_membership_BASENAME', plugin_basename(__FILE__));					
					if (!defined('WP_iv_membership_DIR')) define('WP_iv_membership_DIR', dirname(__FILE__));
					
					if (!defined('WP_iv_membership_FOLDER'))define('WP_iv_membership_FOLDER', plugin_basename(dirname(__FILE__)));
					if (!defined('WP_iv_membership_ABSPATH'))define('WP_iv_membership_ABSPATH', trailingslashit(str_replace("\\", "/", WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)))));
					if (!defined('WP_iv_membership_URLPATH'))define('WP_iv_membership_URLPATH', trailingslashit(WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__))));
					if (!defined('WP_iv_membership_ADMINPATH'))define('WP_iv_membership_ADMINPATH', get_admin_url());
									
					
					$filename = get_template_directory()."/wpmembership/";
					if (!file_exists($filename)) {					
						define( 'WP_iv_membership_template', WP_iv_membership_ABSPATH.'template/' );
					}else{
						define( 'WP_iv_membership_template', $filename);
					}	
					
				}
				
				/**
				 * Loads PHP files that required by the plug-in
				 */
				

				public function remove_admin_bar() {
					 $iv_hide = get_option( '_iv_membership_hide_admin_bar');
					if (!current_user_can('administrator') && !is_admin()) {
						if($iv_hide=='yes'){							
						  show_admin_bar(false);
						  
						}
					}	
				}
					
					
				
				public function author_public_profile() {
					
					  $author = get_the_author();		    
					
					 $iv_redirect = get_option( '_iv_membership_profile_public_page');
					if($iv_redirect!='defult'){ 
						$reg_page= get_permalink( $iv_redirect) ; 
						return    $reg_page.'?&id='.$author; //$reg_page ;						
						exit;
					}
				}
				
				public function iv_registration_redirect(){
					$iv_redirect = get_option( 'iv_membership_signup_redirect');
					if($iv_redirect!='defult'){
						$reg_page= get_permalink( $iv_redirect); 
						wp_redirect( $reg_page );
						exit;
					}	
						
				}
				public function iv_membership_login_func(){
						require_once(WP_iv_membership_template. 'private-profile/profile-login.php');
				}
				public function iv_membership_forget_password(){
					
					parse_str($_POST['form_data'], $data_a);
						if( ! email_exists($data_a['forget_email']) ) {
							echo json_encode(array("code" => "not-success","msg"=>"There is no user registered with that email address."));
								exit(0);
						} else {
								require_once( WP_iv_membership_ABSPATH. 'inc/forget-mail.php');
								echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
								exit(0);
						}
				}
				public function iv_membership_check_login(){
					
					parse_str($_POST['form_data'], $form_data);
					global $user;
					$creds = array();
					$creds['user_login'] =$form_data['username'];
					$creds['user_password'] =  $form_data['password'];
					$creds['remember'] =  (isset($form_data['remember']) ?'true' : 'false');
					$secure_cookie = is_ssl() ? true : false;
					$user = wp_signon( $creds, $secure_cookie );
					if ( is_wp_error($user) ) {
						//echo $user->get_error_message();
						echo json_encode(array("code" => "not-success","msg"=>$user->get_error_message()));
						exit(0);
					}
					if ( !is_wp_error($user) ) {
						$iv_redirect = get_option( '_iv_membership_profile_page');
						if($iv_redirect!='defult'){
							if ( function_exists('icl_object_id') ) {
								$iv_redirect = icl_object_id($iv_redirect, 'page', true);
							}									
							$reg_page= get_permalink( $iv_redirect); 
							echo json_encode(array("code" => "success","msg"=>$reg_page));
							exit(0);
							//wp_redirect( $reg_page );
							
						}
					}		
				
				}
				public function iv_membership_check_access($content){
					global $post;
					
					
					
					//$content ='22222222222222';
					return $content;
					
					
				 }
				public function iv_membership_update_wp_post(){
					global $current_user;global $wpdb;	
					parse_str($_POST['form_data'], $form_data);
			
					$my_post = array();
					$my_post['ID'] = $form_data['user_post_id'];
					$my_post['post_title'] = $form_data['title'];
					$my_post['post_content'] = $form_data['edit_post_content'];
					$my_post['post_status'] = $form_data['post_status'];
					//wp_update_post( $my_post );
					
					$query = "UPDATE {$wpdb->prefix}posts SET post_title='" . $form_data['title'] . "', post_content='" . $form_data['edit_post_content'] . "', post_status='" . $form_data['post_status'] . "'   WHERE id='" . $form_data['user_post_id'] . "' LIMIT 1";
					$wpdb->query($query);		
					
					 
					if(isset($form_data['feature_image_id'] ) AND $form_data['feature_image_id']!='' ){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $form_data['user_post_id'], $attach_id );
						
					}else{
						$attach_id='0';
						delete_post_thumbnail( $form_data['user_post_id'] );
					
					}
					if(isset($form_data['postcats'] )){ 
						wp_set_post_categories($form_data['user_post_id'], $form_data['postcats'] );
					}
					// Delete All custom Post Meta 
					$custom_fields = get_post_custom($form_data['user_post_id']);
					foreach ( $custom_fields as $field_key => $field_values ) {
						if(!isset($field_values[0])){ continue;}
						if(in_array($field_key,array("_edit_lock","_edit_last"))) {continue;}
						$underscore_str=substr($field_key,0,1);
						if($underscore_str!='_'){
							 delete_post_meta($form_data['user_post_id'] ,$field_key); 
						}
						
					}					
					
					if(isset($form_data['custom_name'] )){
						$custom_metas= $form_data['custom_name'] ;
						$custom_value = $form_data['custom_value'] ;
						$i=0;
						foreach($custom_metas  as $one_meta){
							if(isset($custom_metas[$i]) and isset($custom_value[$i]) ){
								if($custom_metas[$i] !=''){
									update_post_meta($form_data['user_post_id'], $custom_metas[$i], $custom_value[$i]); 
								}
							}
							
						$i++;	
						}
					
					}	
					//update_user_meta($current_user->ID,'first_name', $form_data['first_name']); 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function iv_membership_save_wp_post(){
					global $current_user;global $wpdb;	
					parse_str($_POST['form_data'], $form_data);
					
					
				
					$my_post = array();
					//$my_post['ID'] = $form_data['user_post_id'];
					$my_post['post_title'] = $form_data['title'];
					$my_post['post_content'] = $form_data['new_post_content'];
					$my_post['post_status'] = $form_data['post_status'];
					
					 $newpost_id= wp_insert_post( $my_post );
						
						$post_type = get_option( '_iv_membership_profile_post');
						if($post_type!=''){
							$query = "UPDATE {$wpdb->prefix}posts SET post_type='" . $post_type . "' WHERE id='" . $newpost_id . "' LIMIT 1";
							$wpdb->query($query);										
						}
					// WPML Start******
					if ( function_exists('icl_object_id') ) {
					include_once( WP_PLUGIN_DIR . '/sitepress-multilingual-cms/inc/wpml-api.php' );
					$_POST['icl_post_language'] = $language_code = ICL_LANGUAGE_CODE;
					$query = "UPDATE {$wpdb->prefix}icl_translations SET element_type='post_".$post_type."' WHERE element_id='" . $newpost_id . "' LIMIT 1";
					$wpdb->query($query);					
					//wpml_update_translatable_content( 'post_directories', $newpost_id , $language_code );	
					}
					// End WPML**********
						
					if(isset($form_data['feature_image_id'] )){
							$attach_id =$form_data['feature_image_id'];
							set_post_thumbnail( $newpost_id, $attach_id );
					
					}
						
					if(isset($form_data['postcats'] )){ 
						wp_set_post_categories($newpost_id, $form_data['postcats'] );
					}
					if(isset($form_data['custom_name'] )){
						$custom_metas= $form_data['custom_name'] ;
						$custom_value = $form_data['custom_value'] ;
						$i=0;
						foreach($custom_metas  as $one_meta){
							if(isset($custom_metas[$i]) and isset($custom_value[$i]) ){
								if($custom_metas[$i] !=''){
									update_post_meta($newpost_id, $custom_metas[$i], $custom_value[$i]); 
								}
							}
							
						$i++;	
						}
					
					}	
					//update_user_meta($current_user->ID,'first_name', $form_data['first_name']); 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function iv_membership_woocommerce_form_submit(  ) {
					require_once(WP_iv_membership_DIR . '/admin/pages/payment-inc/woo-submit.php');
				}
				public function iv_membership_cancel_paypal(){
						global $wpdb;
						global $current_user;
						parse_str($_POST['form_data'], $form_data);
						
						if( ! class_exists('Paypal' ) ) {
							require_once(WP_iv_membership_DIR . '/inc/class-paypal.php');
							
						}

						$post_name='iv_membership_paypal_setting';						
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
						$paypal_id='0';
						if(sizeof($row )>0){
							$paypal_id= $row->ID;
						}
						$paypal_api_currency=get_post_meta($paypal_id, 'iv_membership_paypal_api_currency', true);
						
						$paypal_username=get_post_meta($paypal_id, 'iv_membership_paypal_username',true);
						$paypal_api_password=get_post_meta($paypal_id, 'iv_membership_paypal_api_password', true);
						$paypal_api_signature=get_post_meta($paypal_id, 'iv_membership_paypal_api_signature', true);
						
						$credentials = array();
						$credentials['USER'] = (isset($paypal_username)) ? $paypal_username : '';
						$credentials['PWD'] = (isset($paypal_api_password)) ? $paypal_api_password : '';
						$credentials['SIGNATURE'] = (isset($paypal_api_signature)) ? $paypal_api_signature : '';
						
						$paypal_mode=get_post_meta($paypal_id, 'iv_membership_paypal_mode', true);
					
						$currencyCode = $paypal_api_currency;
						$sandbox = ($paypal_mode == 'live') ? '' : 'sandbox.';
						$sandboxBool = (!empty($sandbox)) ? true : false;
						
						$paypal = new Paypal($credentials,$sandboxBool);
						
						$oldProfile = get_user_meta($current_user->ID,'iv_paypal_recurring_profile_id',true);
						if (!empty($oldProfile)) {
							$cancelParams = array(
								'PROFILEID' => $oldProfile,
								'ACTION' => 'Cancel'
							);
							$paypal -> request('ManageRecurringPaymentsProfileStatus',$cancelParams);
							
							update_user_meta($current_user->ID,'iv_paypal_recurring_profile_id','');
							update_user_meta($current_user->ID,'iv_cancel_reason', $form_data['cancel_text']); 
							update_user_meta($current_user->ID,'iv_membership_payment_status', 'cancel'); 
							
							// Email send***
							include(WP_iv_membership_DIR . '/inc/subscription-cancellation-mail.php');
								
							
							echo json_encode(array("code" => "success","msg"=>"Cancel Successfully"));
							exit(0);							
						}else{
						
							echo json_encode(array("code" => "not","msg"=>"Unable to Cancel "));
							exit(0);	
						}
						
				
				}
				public function  iv_membership_profile_stripe_upgrade(){
						require_once(WP_iv_membership_DIR . '/admin/files/lib/Stripe.php');
						global $wpdb;
						global $current_user;
						parse_str($_POST['form_data'], $form_data);	
						
						$newpost_id='';
						$post_name='iv_membership_stripe_setting';
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
									if(sizeof($row )>0){
									  $newpost_id= $row->ID;
									}
						$stripe_mode=get_post_meta( $newpost_id,'iv_membership_stripe_mode',true);	
						if($stripe_mode=='test'){
							$stripe_api =get_post_meta($newpost_id, 'iv_membership_stripe_secret_test',true);	
						}else{
							$stripe_api =get_post_meta($newpost_id, 'iv_membership_stripe_live_secret_key',true);	
						}
						
						
						
						Stripe::setApiKey($stripe_api);						
						// For  cancel ----
						$arb_status =	get_user_meta($current_user->ID, 'iv_membership_payment_status', true);
						$cust_id = get_user_meta($current_user->ID,'iv_membership_stripe_cust_id',true);
						$sub_id = get_user_meta($current_user->ID,'iv_membership_stripe_subscrip_id',true);
						if($sub_id!=''){	
							try{
									$iv_cancel_stripe = Stripe_Customer::retrieve($form_data['cust_id']);
									$iv_cancel_stripe->subscriptions->retrieve($form_data['sub_id'])->cancel();
									
							} catch (Exception $e) {
								//print_r($e);	
								
								//$error_msg=$e;
							}
							update_user_meta($current_user->ID,'iv_membership_payment_status', 'cancel'); 
							update_user_meta($current_user->ID,'iv_membership_stripe_subscrip_id','');
						}
						
						// Start  New 
						$response='';
						parse_str($_POST['form_data'], $form_data);
						require_once(WP_iv_membership_DIR . '/admin/pages/payment-inc/stripe-upgrade.php');
						
						echo json_encode(array("code" => "success","msg"=>$response));
						exit(0);

				}
				public function iv_membership_cancel_stripe(){
						
						require_once(WP_iv_membership_DIR . '/admin/files/lib/Stripe.php');
						global $wpdb;
						global $current_user;
						parse_str($_POST['form_data'], $form_data);	
						
						$newpost_id='';
						$post_name='iv_membership_stripe_setting';
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
									if(sizeof($row )>0){
									  $newpost_id= $row->ID;
									}
						$stripe_mode=get_post_meta( $newpost_id,'iv_membership_stripe_mode',true);	
						if($stripe_mode=='test'){
							$stripe_api =get_post_meta($newpost_id, 'iv_membership_stripe_secret_test',true);	
						}else{
							$stripe_api =get_post_meta($newpost_id, 'iv_membership_stripe_live_secret_key',true);	
						}
						parse_str($_POST['form_data'], $form_data);
						
						
						Stripe::setApiKey($stripe_api);
						
						
						try{
								$iv_cancel_stripe = Stripe_Customer::retrieve($form_data['cust_id']);
								$iv_cancel_stripe->subscriptions->retrieve($form_data['sub_id'])->cancel();
						
						} catch (Exception $e) {
							//print_r($e);	
						}
						
						
						update_user_meta($current_user->ID,'iv_cancel_reason', $form_data['cancel_text']); 
						update_user_meta($current_user->ID,'iv_membership_payment_status', 'cancel'); 
						update_user_meta($current_user->ID,'iv_membership_stripe_subscrip_id','');
						
						// Email Send
						include(WP_iv_membership_DIR . '/inc/subscription-cancellation-mail.php');
						
						echo json_encode(array("code" => "success","msg"=>"Cancel Successfully"));
						exit(0);
				
				}
				public function  iv_membership_stripe_form_func(){
					//echo WP_iv_membership_URLPATH.'files/short_code_file/iv_stripe_form_display';
					require_once(WP_iv_membership_ABSPATH.'files/short_code_file/iv_stripe_form_display.php');
				}
				
				public function iv_membership_update_setting_hide(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);	
					$mobile_hide=(isset($form_data['mobile_hide'])? $form_data['mobile_hide']:'');	
					$email_hide=(isset($form_data['email_hide'])? $form_data['email_hide']:'');	
					$phone_hide=(isset($form_data['phone_hide'])? $form_data['phone_hide']:'');	
					
					update_user_meta($current_user->ID,'hide_email', $email_hide); 
					update_user_meta($current_user->ID,'hide_phone', $phone_hide);					
					update_user_meta($current_user->ID,'hide_mobile',$mobile_hide); 
					
					 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				}
				
				public function iv_membership_update_setting_fb(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);			
					update_user_meta($current_user->ID,'twitter', $form_data['twitter']); 
					update_user_meta($current_user->ID,'facebook', $form_data['facebook']); 
					update_user_meta($current_user->ID,'gplus', $form_data['gplus']); 
					update_user_meta($current_user->ID,'linkedin', $form_data['linkedin']); 
					 
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				}
				public function iv_membership_update_setting_password(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);						
					if ( wp_check_password( $form_data['c_pass'], $current_user->user_pass, $current_user->ID) ){
					  
							if($form_data['r_pass']!=$form_data['n_pass']){
								echo json_encode(array("code" => "not", "msg"=>"New Password & Re Password are not same. "));
								exit(0);
							}else{
								wp_set_password( $form_data['n_pass'], $current_user->ID);
								echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
								exit(0);
							}
					}else{
						
					   echo json_encode(array("code" => "not", "msg"=>"Current password is wrong. "));
						exit(0);
					}
					
					
					
				}
				public function iv_membership_update_profile_billing(){
					global $current_user;			
						
					parse_str($_POST['form_data'], $form_data);		
					update_user_meta($current_user->ID,'billing_first_name', $form_data['first_name']); 
					update_user_meta($current_user->ID,'billing_last_name', $form_data['last_name']); 
					update_user_meta($current_user->ID,'billing_company', $form_data['company']); 
					
					update_user_meta($current_user->ID,'billing_phone', $form_data['phone']); 
					update_user_meta($current_user->ID,'billing_address_1', $form_data['address']); 
					update_user_meta($current_user->ID,'billing_address_2', $form_data['address']);
					update_user_meta($current_user->ID,'billing_city', $form_data['city']);	
					update_user_meta($current_user->ID,'billing_state', $form_data['state']);						
					update_user_meta($current_user->ID,'billing_postcode', $form_data['zip']);	
					update_user_meta($current_user->ID,'billing_country', $form_data['country']);	
					
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function iv_membership_update_profile_setting(){
					global $current_user;
					parse_str($_POST['form_data'], $form_data);			
					foreach ( $form_data as $field_key => $field_value ) { 
						
						update_user_meta($current_user->ID,$field_key, $field_value); 
					}
						
				
					
					echo json_encode(array("code" => "success","msg"=>"Updated Successfully"));
					exit(0);
				
				}
				public function include_template_function( $template_path ) { 
					$all_re_page = array();
					$all_re_page=get_option('_iv_membership_redirect_page',true);
					
					$current_role='';
					if(is_user_logged_in()==1){
						global $current_user;
						 $user = new WP_User( $current_user->ID );
							if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
								foreach ( $user->roles as $role ){
									$current_role= $role; 
									break;
								}	
							}
						
					}else{
						$current_role='visitor';
					}	
					$all_re_page['url'];
					//$template_path =  wp_iv_directories_template. 'listing/listing-layout.php';
					global $wp;
					$current_url = home_url(add_query_arg(array(),$wp->request));
					$urlmain = parse_url($current_url);
					if(isset($all_re_page['url'])){
						$ii=0;												
						foreach($all_re_page['url'] as $row1){ $save_url='';
							if(isset($all_re_page['url'][$ii])){ 
								
								if (filter_var($all_re_page['url'][$ii], FILTER_VALIDATE_URL) === FALSE) { 
										
								}else{ 
								 									
										$current_url2= str_replace('/','',$current_url);
										$row_url=str_replace('/','',$all_re_page['url'][$ii]);
										
									if(strcmp($current_url2,$row_url)==0){
										
											$blocked_roles=explode(',',$all_re_page['roles'][$ii]);
											
											if(in_array($current_role,$blocked_roles)){ 
												 $redirect_link= get_the_permalink($all_re_page['redirectto'][$ii]);												
												 $redirect_link2=str_replace('/','',$redirect_link);											
												 if(strcmp($current_url2,$redirect_link2)!=0){// Prevent Infinitte Loop 
														
														wp_redirect($redirect_link);
														exit();
														
												}	
											
											}											
										
									}
								}									
							}
							$ii++;
						}		
					}
					
					
					return $template_path;
				}
				public function modify_contact_methods($profile_fields) {

					// Add new fields
					$profile_fields['phone'] = 'Phone Number';
					$profile_fields['twitter'] = 'Twitter Username';
					$profile_fields['facebook'] = 'Facebook URL';
					$profile_fields['gplus'] = 'Google+ URL';
					$profile_fields['linkedin'] = 'Linkedin';
					

					return $profile_fields;
				}

				public function iv_restrict_media_library( $wp_query ) {
					global $current_user, $pagenow;
					
						//global $current_user;
						if( is_admin() && !current_user_can('edit_others_posts') ) {
							$wp_query->set( 'author', $current_user->ID );
							add_filter('views_edit-post', 'fix_post_counts');
							add_filter('views_upload', 'fix_media_counts');
						}
					
				}
				public function check_expiry_date($user) {
					
					require_once(WP_iv_membership_DIR . '/inc/check_expire_date.php');
				}
				
				public function iv_membership_update_profile_pic(){
					global $current_user;
					if(isset($_REQUEST['profile_pic_url_1'])){
						$iv_profile_pic_url=$_REQUEST['profile_pic_url_1'];
						$attachment_thum=$_REQUEST['attachment_thum'];
					}else{
						$iv_profile_pic_url='';
						$attachment_thum='';
					
					}
					update_user_meta($current_user->ID, 'iv_profile_pic_thum', $attachment_thum);					
					update_user_meta($current_user->ID, 'iv_profile_pic_url', $iv_profile_pic_url);
					echo json_encode('success');
					exit(0);
				}
				
				public function iv_membership_paypal_form_submit(  ) {
					require_once(WP_iv_membership_DIR . '/admin/pages/payment-inc/paypal-submit.php');
				}	
				public function iv_membership_stripe_form_submit(  ) {
					require_once(WP_iv_membership_DIR . '/admin/pages/payment-inc/stripe-submit.php');
				}
				
				public function plugin_mce_css_iv_membership( $mce_css ) {
					if ( ! empty( $mce_css ) )
						$mce_css .= ',';

					$mce_css .= plugins_url( 'admin/files/css/iv-bootstrap.css', __FILE__ );

					return $mce_css;
				}
												
				/***********************************
				 * Adds a meta box to the post editing screen
				*/
				public function prfx_custom_meta_iv_membership() {
					//add_meta_box('prfx_meta', __('Incredible Form 22 ', 'prfx-textdomain'), array(&$this, 'iv_membership_meta_callback'),'page');
				}
				
				public function iv_membership_check_coupon(){
				
					global $wpdb;
					
					$package_id=$_REQUEST['package_id'];
					$form_data= array();
					 if(isset($_REQUEST['form_data'])){
						parse_str($_REQUEST['form_data'], $form_data);
					}
					//$package_amount =$_REQUEST['package_amount'];
					$coupon_code=(isset($form_data['coupon_name'])? $form_data['coupon_name']:'');					
					if( get_post_meta( $package_id,'iv_membership_package_recurring',true) =='on'  ){
						$package_amount=get_post_meta($package_id, 'iv_membership_package_recurring_cost_initial', true);			
					}else{					
						$package_amount=get_post_meta($package_id, 'iv_membership_package_cost',true);
					}
						// Tax Strat********************
					$tax_total=0;
					 $tax_type= get_option('_iv_tax_type');
					 $tax_active_module=get_option('_iv_membership_active_tax');
					
					if($tax_active_module=='' ){ $tax_active_module='yes';	}					
					if($tax_type==''){$tax_type='country';}
						
					if($tax_active_module=='yes' AND $tax_type=='country'){						
						$countries_tax_array= (get_option('_iv_countries_tax')!=''? get_option('_iv_countries_tax'): array()) ;
						
						
						 $country_id= (isset($form_data['country_select'])?$form_data['country_select']:'0');
						
						if(array_key_exists($country_id , $countries_tax_array)){							
							 $country_tax_value= $countries_tax_array[$country_id];
							 $tax_total=$package_amount * $country_tax_value/100;
						}
					}
					if($tax_active_module=='yes' AND $tax_type=='common'){						
						$common_tax_value= get_option('_iv_comman_tax_value');						
						$tax_total=$package_amount * $common_tax_value/100;
						
					}
						$iv_gateway = get_option('iv_membership_payment_gateway');	
						$iv_membership_package_recurring= get_post_meta( $package_id,'iv_membership_package_recurring',true);
						if($iv_membership_package_recurring=='on' AND $iv_gateway=='stripe'){
							$tax_total=0;
						}
						
					// End TAx****************
					$package_amount=get_post_meta($package_id, 'iv_membership_package_cost',true);
					$api_currency =$_REQUEST['api_currency'];
					
						$post_cont = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = '" . $coupon_code . "' and  post_type='iv_membership_coupon'");	
						
						if(sizeof($post_cont)>0 && $package_amount>0){
							$coupon_name = $post_cont->post_title;
							 
							 $current_date=$today = date("m/d/Y");
							 
							 
							 $start_date=get_post_meta($post_cont->ID, 'iv_membership_coupon_start_date', true);
							 $end_date=get_post_meta($post_cont->ID, 'iv_membership_coupon_end_date', true);
							 $coupon_used=get_post_meta($post_cont->ID, 'iv_membership_coupon_used', true);
							 $coupon_limit=get_post_meta($post_cont->ID, 'iv_membership_coupon_limit', true);
							 $dis_amount=get_post_meta($post_cont->ID, 'iv_membership_coupon_amount', true);							 
							 $package_ids =get_post_meta($post_cont->ID, 'iv_membership_coupon_pac_id', true);
							 
							 $all_pac_arr= explode(",",$package_ids);
							 
							 $today_time = strtotime($current_date);
							 $start_time = strtotime($start_date);
							 $expire_time = strtotime($end_date);
							 
												
							 if(in_array('0', $all_pac_arr)){
								$pac_found=1;
								
							 }else{
								if(in_array($package_id, $all_pac_arr)){
									$pac_found=1;
								}else{
									$pac_found=0;
								}
								
							 }
							 $recurring = get_post_meta( $package_id,'iv_membership_package_recurring',true); 
							
							
							 if($today_time >= $start_time && $today_time<=$expire_time && $coupon_used<=$coupon_limit && $pac_found == '1' && $recurring!='on' ){
						
								$total = ($package_amount -$dis_amount)+ $tax_total;
								$coupon_type= get_post_meta($post_cont->ID, 'iv_membership_coupon_type', true);
								if($coupon_type=='percentage'){
										$dis_amount= $dis_amount * $package_amount/100;
										$total = ($package_amount -$dis_amount)+ $tax_total ;
								}
								
								echo json_encode(array('code' => 'success',
														'dis_amount' => $dis_amount.' '.$api_currency,
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$tax_total.' '.$api_currency,
														'p_amount' => $package_amount.' '.$api_currency,
													));
								
								exit(0);
							}else{
								$dis_amount='';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success-2',
														'dis_amount' => '',
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$tax_total.' '.$api_currency,
														'p_amount' => $package_amount.' '.$api_currency,
														
													));
								exit(0);
							
							}
							
						
						}else{
								if($package_amount=="" or $package_amount=="0"){$package_amount='0';}
								$dis_amount='';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success-1',
														'dis_amount' => '',
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$tax_total.' '.$api_currency,
														'p_amount' => $package_amount.' '.$api_currency,
													));
								exit(0);
						
						}
						
					
					
				}
				public function iv_membership_check_package_amount(){
				
					global $wpdb;
					
					$package_id=$_REQUEST['package_id'];
					 $form_data= array();
					 if(isset($_REQUEST['form_data'])){
						parse_str($_REQUEST['form_data'], $form_data);
					}
					$coupon_code=(isset($form_data['coupon_name'])? $form_data['coupon_name']:'');					
					if( get_post_meta( $package_id,'iv_membership_package_recurring',true) =='on'  ){
						$package_amount=get_post_meta($package_id, 'iv_membership_package_recurring_cost_initial', true);			
					}else{					
						$package_amount=get_post_meta($package_id, 'iv_membership_package_cost',true);
					}
					
						// Tax Strat********************
					$tax_total=0;
					 $tax_type= get_option('_iv_tax_type');
					 $tax_active_module=get_option('_iv_membership_active_tax');
					
					if($tax_active_module=='' ){ $tax_active_module='yes';	}					
					if($tax_type==''){$tax_type='country';}
						
					if($tax_active_module=='yes' AND $tax_type=='country'){						
						$countries_tax_array= (get_option('_iv_countries_tax')!=''? get_option('_iv_countries_tax'): array()) ;
						
						
						 $country_id= (isset($form_data['country_select'])?$form_data['country_select']:'0');
						
						if(array_key_exists($country_id , $countries_tax_array)){							
							 $country_tax_value= $countries_tax_array[$country_id];
							 $tax_total=$package_amount * $country_tax_value/100;
						}
					}
					if($tax_active_module=='yes' AND $tax_type=='common'){						
						$common_tax_value= get_option('_iv_comman_tax_value');						
						$tax_total=$package_amount * $common_tax_value/100;
						
					}
						$iv_gateway = get_option('iv_membership_payment_gateway');	
						$iv_membership_package_recurring= get_post_meta( $package_id,'iv_membership_package_recurring',true);
						if($iv_membership_package_recurring=='on' AND $iv_gateway=='stripe'){
							$tax_total=0;
						}
						
					// End TAx****************
						$api_currency =$_REQUEST['api_currency'];
						
						$post_cont = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_title = '" . $coupon_code . "' and  post_type='iv_membership_coupon'");	
						
						if(sizeof($post_cont)>0){
							$coupon_name = $post_cont->post_title;
							 
							 $current_date=$today = date("m/d/Y");
							 
							 
							 $start_date=get_post_meta($post_cont->ID, 'iv_membership_coupon_start_date', true);
							 $end_date=get_post_meta($post_cont->ID, 'iv_membership_coupon_end_date', true);
							 $coupon_used=get_post_meta($post_cont->ID, 'iv_membership_coupon_used', true);
							 $coupon_limit=get_post_meta($post_cont->ID, 'iv_membership_coupon_limit', true);
							 $dis_amount=get_post_meta($post_cont->ID, 'iv_membership_coupon_amount', true);							 
							 $package_ids =get_post_meta($post_cont->ID, 'iv_membership_coupon_pac_id', true);
							 
							 $all_pac_arr= explode(",",$package_ids);
							 
							 $today_time = strtotime($current_date);
							 $start_time = strtotime($start_date);
							 $expire_time = strtotime($end_date);
							 
							 $pac_found= in_array($package_id, $all_pac_arr);							
							 
							 if($today_time >= $start_time && $today_time<=$expire_time && $coupon_used<=$coupon_limit && $pac_found=="1"){
							// if( $today_time<=$expire_time && $coupon_used<=$coupon_limit){	
								
								$coupon_type= get_post_meta($post_cont->ID, 'iv_membership_coupon_type', true);
								if($coupon_type=='percentage'){
										$dis_amount= $dis_amount * $package_amount/100;
										$total = $package_amount -$dis_amount ;
								}
									$total = ($package_amount -$dis_amount)+ $tax_total;
								echo json_encode(array('code' => 'success',
														'dis_amount' => $dis_amount.' '.$api_currency,
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$tax_total.' '.$api_currency,
														'p_amount' => $package_amount.' '.$api_currency,
													));
								
								exit(0);
							}else{
								$dis_amount='';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success2',
														'dis_amount' => $dis_amount.' '.$api_currency,
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$tax_total.' '.$api_currency,
														'p_amount' => $package_amount.' '.$api_currency,
													));
								exit(0);
							
							}
							
						
						}else{
								
								$dis_amount='';
								$total=$package_amount + $tax_total;
								echo json_encode(array('code' => 'not-success',
														'dis_amount' => $dis_amount.' '.$api_currency,
														'gtotal' => $total.' '.$api_currency,
														'tax_total'	=>$tax_total.' '.$api_currency,
														'p_amount' => $package_amount.' '.$api_currency,
													));
								exit(0);
						
						}
						
					
					
				}
				/**
				 * Outputs the content of the meta box
				 */
				public function iv_membership_meta_callback($post) {
					wp_nonce_field(basename(__FILE__), 'prfx_nonce');
					require_once ('admin/pages/metabox.php');
				}
				public function iv_membership_meta_save($post_id) {
					$is_autosave = wp_is_post_autosave($post_id);
					
					if (isset($_POST['iv_membership_display'])) {
						update_post_meta($post_id, 'iv_membership_display', 'yes');
						update_post_meta($post_id, 'iv_membership_name', $_POST['iv_membership_list']);
						if (isset($_POST['iv_membership_pro_position'])) {
							update_post_meta($post_id, 'iv_membership_pro_position', $_POST['iv_membership_pro_position']);
						}
					} else {
						update_post_meta($post_id, 'iv_membership_display', '');
					}
				}
				
				public function no_comments_on_page( $file )
				{
					
					$current_user = wp_get_current_user(); $user_role= '';	
					global $post ;	
							//echo'<pre>'; print_r($post); echo'</pre>';
					$active_module=get_option('_iv_membership_active_visibility_page'); 					
					
					if($active_module=='yes'){	
							if(isset($current_user->ID) AND $current_user->ID!=''){
								$user_role= $current_user->roles[0];
								if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
									return $file;
								}														
							}else{							
								 $user_role= 'visitor';					
								
							}					
						$have_access=0;
						$store_array=get_option('_iv_visibility_serialize_role');	
						//echo'<pre>'; print_r($store_array); echo'</pre>'.$user_role;
						if(isset($store_array[$user_role]))	{	
							$post_category='';
							if(get_the_category($post->ID)){ 
								 $post_category = get_the_category($post->ID);  // the value is recieved properly
								if(isset($post_category[0]->category_nicename)){
									$post_category=$post_category[0]->category_nicename;
								}
								
							}
							if(in_array($post_category, $store_array[$user_role])){
								$have_access=1; 
							}else{
								 $have_access=0;
							}							
						}
						$have_access_page=0;
						$store_array_page=get_option('_iv_visibility_serialize_page_role');	
						 if(isset($store_array_page[$user_role])){	
							if(in_array($post->post_name, $store_array_page[$user_role])){
								$have_access_page=1;							
							}else{
								$have_access_page=0;
								
							}							
						}
						if($have_access == 0 AND $have_access_page == 0){
							
							 $file =WP_iv_membership_DIR . '/admin/pages/empty-comment-file.php';
						}
						
					}
					
					
					
					return $file;
				}

				public function iv_membership_content_protected($content) { 
					
					$current_user = wp_get_current_user();
					global $post ;
					
					$active_module=get_option('_iv_membership_active_visibility'); 
					ob_start();	
					

					if($active_module=='yes' AND $post->post_type=='post'){	
										
						if(isset($current_user->ID) AND $current_user->ID!=''){
							$user_role= $current_user->roles[0];
							if(isset($current_user->roles[0]) and $current_user->roles[0]=='administrator'){
								
								return $content;
							}
							$message=get_option('_iv_visibility_login_message');
							$iv_redirect = get_option( '_iv_membership_profile_page');							
							$reg_page= '<a href="'.get_permalink( $iv_redirect).'?&profile=level "> Here </a';
							$message= str_replace('[here_link]', $reg_page, $message);							

						}else{							
							$user_role= 'visitor';
							
							$message=get_option('_iv_visibility_visitor_message');
							$iv_redirect = get_option( '_iv_membership_login_page');							
							$reg_page= '<a href="'.get_permalink( $iv_redirect).' "> Here </a';
							$message= str_replace('[here_link]', $reg_page, $message);	
						}
						
						$post_category='';
							if(get_the_category($post->ID)){ 
								 $post_category = get_the_category($post->ID);  // the value is recieved properly
								if(isset($post_category[0]->category_nicename)){
									$post_category=$post_category[0]->category_nicename;
								}
								
							}
						$store_array=get_option('_iv_visibility_serialize_role');
						
						 if(isset($store_array[$user_role]))
						{	
							if(in_array($post_category, $store_array[$user_role])){
								
								return $content;
							}else{
								
								$content = ob_get_clean();
								$content =  $message; 
								return $content;
							}
							//print_r($store_array['Silver']);
						}else{ 
							$content='';
							$content = ob_get_clean();
							$content =  $message; 
							return $content;
							
						}
						
						$output='';
						$output = $content;
					}
					
					
					return $content;
				}
				
				/**
				 * Checks that the WordPress setup meets the plugin requirements
				 * @global string $wp_version
				 * @return boolean
				 */
				private function check_requirements() {
					global $wp_version;
					if (!version_compare($wp_version, $this->wp_version, '>=')) {
						add_action('admin_notices', 'WP_iv_membership::display_req_notice');
						return false;
					}
					return true;
				}
				
				/**
				 * Display the requirement notice
				 * @static
				 */
				static function display_req_notice() {
					global $WP_iv_membership;
					echo '<div id="message" class="error"><p><strong>';
					echo __('Sorry, BootstrapPress re requires WordPress ' . $WP_iv_membership->wp_version . ' or higher.
						Please upgrade your WordPress setup', 'wp-pb');
					echo '</strong></p></div>';
				}
				public function iv_membership_user_exist_check(){
						global $wpdb;
					
					parse_str($_POST['form_data'], $data_a2);
						
						
					
					if(isset($data_a2['contact_captcha'])){
						$captcha_answer="";
						if(isset($data_a2['captcha_answer'])){
							$captcha_answer=$data_a2['captcha_answer'];
						}
						if($data_a2['contact_captcha']!=$captcha_answer){
							echo json_encode('captcha_error');
							exit(0);
						}						
					}
					$userdata = array();
					$user_name='';
					if(isset($data_a2['iv_member_user_name'])){
						$userdata['user_login']=$data_a2['iv_member_user_name'];
					}					
					if(isset($data_a2['iv_member_email'])){
						$userdata['user_email']=$data_a2['iv_member_email'];
					}					
					if(isset($data_a2['iv_member_password'])){
						$userdata['user_pass']=$data_a2['iv_member_password'];
					}
					
					
					if($userdata['user_login']!='' and $userdata['user_email']!='' and $userdata['user_pass']!='' ){
					
						$user_id = username_exists( $userdata['user_login'] );
						if ( !$user_id and email_exists($userdata['user_email']) == false ) {							
							 //$user_id = wp_insert_user( $userdata ) ;
								echo json_encode('success');
								exit(0);
						} else {
								echo json_encode('User or Email exists');
								exit(0);
						}
					}
									
				
						
				
				}
				public function iv_membership_registration_submit() {
					
					global $wpdb;
					
					parse_str($_POST['form_data'], $data_a2);
						
						
						
					if(isset($data_a2['contact_captcha'])){
						$captcha_answer="";
						if(isset($data_a2['captcha_answer'])){
							$captcha_answer=$data_a2['captcha_answer'];
						}
						if($data_a2['contact_captcha']!=$captcha_answer){
							echo json_encode('captcha_error');
							exit(0);
						}						
					}
					$userdata = array();
					$user_name='';
					if(isset($data_a2['iv_member_user_name'])){
						$userdata['user_login']=$data_a2['iv_member_user_name'];
					}					
					if(isset($data_a2['iv_member_email'])){
						$userdata['user_email']=$data_a2['iv_member_email'];
					}					
					if(isset($data_a2['iv_member_password'])){
						$userdata['user_pass']=$data_a2['iv_member_password'];
					}
					if(isset($data_a2['iv_member_password'])){
						$userdata['first_name']=$data_a2['iv_member_fname'];
					}
					if(isset($data_a2['iv_member_password'])){
						$userdata['last_name']=$data_a2['iv_member_lname'];
					}							
					
					//print_r($userdata);
					die('Test 555555555555');
					if($userdata['user_login']!='' and $userdata['user_email']!='' and $userdata['user_pass']!='' ){
					
						$user_id = username_exists( $userdata['user_login'] );
						if ( !$user_id and email_exists($userdata['user_email']) == false ) {							
							 $user_id = wp_insert_user( $userdata ) ;
						} else {
							echo json_encode('User or Email exists');
							exit(0);
						}
					}
					
					//$hidden_form_name = $data_a2['iv_membership_registration'];
					$post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = 'iv_membership_account_form'");
					
					$iv_membership_auto_email = get_post_meta($post_id, 'iv_membership_auto_email', true);
					$admin_mail = get_option('admin_email');
					$wp_title = get_bloginfo();
					
						// email for user
					
					foreach ($data_a2 as $key => $item) {
						$search_sort_key = '[' . $key . ']';
						$iv_membership_auto_email = str_replace($search_sort_key, $item, $iv_membership_auto_email);
						$search_sort_key = '[ ' . $key . ' ]';
						$iv_membership_auto_email = str_replace($search_sort_key, $item, $iv_membership_auto_email);
					}
					
					$iv_membership_admin_email = get_post_meta($post_id, 'iv_membership_admin_email', true);
						
						
					$cilent_email_address = $userdata['user_email'];
							
					$auto_subject=  get_post_meta($post_id, 'iv_membership_auto_email_subject', true); 
							
					$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Content-Type: text/html");
					$h = implode("\r\n", $headers) . "\r\n";
							
					if (get_option('iv_membership_auto_reply') == 'yes') {
								wp_mail($cilent_email_address, $auto_subject, $iv_membership_auto_email, $h);
					}
						
						
				
										
				
						echo json_encode('success');
						exit(0);
				}
				
				
				
				private function load_dependencies() {
					
						// Admin Panel
					if (is_admin()) {
						require_once ('admin/forms.php');
						require_once ('admin/notifications.php');
						require_once ('admin/tables.php');
						require_once ('admin/admin.php');
					}
					
						// Front-End Site
					if (!is_admin()) {
					}
					
						// Global
					require_once ('inc/widget.php');
				}
				
				/**
				 * Called every time the plug-in is activated.
				 */
				public function activate() {
					require_once ('install/install.php');
					
						
				}
				
				/**
				 * Called when the plug-in is deactivated.
				 */
				public function deactivate() {
					global $wpdb;			
					
					$page_name=get_option('_iv_membership_price_table'); 						
					$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
					$wpdb->query($query);

					$page_name=get_option('_iv_membership_registration'); 						
					$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
					$wpdb->query($query);

					$page_name=get_option('_iv_membership_profile_page'); 						
					$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
					$wpdb->query($query);

					$page_name=get_option('_iv_membership_profile_public_page'); 						
					$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
					$wpdb->query($query);

					$page_name=get_option('_iv_membership_login_page'); 						
					$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
					$wpdb->query($query);

					$page_name=get_option('_iv_membership_thank_you_page'); 						
					$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
					$wpdb->query($query);


					$page_name=get_option('_iv_membership_user_dir_page'); 						
					$query = "delete from {$wpdb->prefix}posts where  ID='".$page_name."' LIMIT 1";
					$wpdb->query($query);
					
					
					
				}
				
				/**
				 * Called when the plug-in is uninstalled
				 */
				static function uninstall() {
				}
				
				/**
				 * Register the widgets
				 */
				public function register_widget() {
					//register_widget("WP_iv_membership_widget");
				}
				
				/**
				 * Internationalization
				 */
				public function i18n() {
					//load_plugin_textdomain('wpmembership', false, basename(dirname(__FILE__)) . '/lang/');
					load_plugin_textdomain('wpmembership', false, basename(dirname(__FILE__)) . '/languages/' );
				}
				
				/**
				 * Starts the plug-in main functionality
				 */
				public function start() {
				}
				public function iv_membership_display_func($atts = '', $content = '') {
					global $wpdb;					
						
					if (isset($atts['form'])) {
						$form_name = $atts['form'];
						$post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '" . $form_name . "'");
						
						$content_post = get_post($post_id);
						$content = $content_post->post_content;
						
					}
					return $content;
				}
				
				public function iv_membership_price_table_func($atts = '', $content = '') {
					
							ob_start();						  //include the specified file
							if(isset($atts['style']) and $atts['style']!="" ){
									$tempale=$atts['style']; 
							}else{
								
							
								if(get_option('iv_membership_price-table')){
									$tempale=	get_option('iv_membership_price-table');
									
								}else{
									$tempale=	'style-1';
								}
							}
						
						ob_start();						  //include the specified file
							if($tempale=='style-1'){
									include( WP_iv_membership_ABSPATH. 'admin/pages/price-table/price-table-1.php');
							}
							if($tempale=='style-2'){
									include( WP_iv_membership_ABSPATH. 'admin/pages/price-table/price-table-2.php');
							}
							if($tempale=='style-3'){
									include( WP_iv_membership_ABSPATH. 'admin/pages/price-table/price-table-3.php');
							}
							if($tempale=='style-4'){
									include( WP_iv_membership_ABSPATH. 'admin/pages/price-table/price-table-4.php');
							}
							if($tempale=='style-5'){
									include( WP_iv_membership_ABSPATH. 'admin/pages/price-table/price-table-5.php');
							}
							if($tempale=='style-6'){
									include( WP_iv_membership_ABSPATH. 'admin/pages/price-table/price-table-6.php');
							}
							if($tempale=='style-7'){
									include( WP_iv_membership_ABSPATH. 'admin/pages/price-table/price-table-7.php');
							}
						
						$content = ob_get_clean();	
					
					return $content;
					
					
					
				}
				
				public function iv_membership_registration_form_func($atts = '', $content = '') {
						
						$package_id=0;
						if(isset($_REQUEST['package_id'])){
							$package_id=$_REQUEST['package_id'];
						}
						
						global $wpdb;
						
						$post_name='iv_membership_account_form';
						$post_content = $wpdb->get_row("SELECT post_content FROM $wpdb->posts WHERE post_name = '" . $post_name . "'");	
						
						if(sizeof($post_content)>0){
							$content = $post_content->post_content;
							$content = str_replace('iv_membership_package_id_change', $package_id, $content);
						}
						
					
					return $content;
				}
				public function iv_membership_payment_form_func($atts = '', $content = '') {
						
						
						
						global $wpdb;
						
						$post_name='iv_membership_payment_form';
						$post_content = $wpdb->get_row("SELECT post_content FROM $wpdb->posts WHERE post_name = '" . $post_name . "'");	
						
						if(sizeof($post_content)>0){
							$content = $post_content->post_content;
							//$content = str_replace('iv_membership_package_id_change', $package_id, $content);
						}
						
					
					return $content;
				}
				public function iv_membership_form_wizard_func($atts = '') {
						
						//global $wpdb;
						$template_path=WP_iv_membership_template.'signup/';
						
						ob_start();						  //include the specified file
							if(isset($atts['style']) and $atts['style']!="" ){
								$tempale=$atts['style']; 
							}else{
								if(get_option('iv_membership_signup-template')){
									$tempale=	get_option('iv_membership_signup-template');
									
								}else{
									$tempale=	'signup-style-1';
								}								
							}
						//$tempale=get_option('iv_membership_signup-template'); 
											  //include the specified file
							if($tempale=='signup-style-1'){
									include( $template_path. 'wizard-style-1.php');
							}
							if($tempale=='signup-style-2'){
									include( $template_path. 'wizard-style-2.php');
							}
							if($tempale=='signup-style-3'){
									include( $template_path. 'wizard-style-3.php');
							}
							if($tempale=='signup-style-4'){
									include( $template_path. 'wizard-style-4.php');
							}
						
						$content = ob_get_clean();	
					
					return $content;
				}
				
				public function iv_membership_profile_template_func($atts = '') {
						
						//global $wpdb;
					 global $current_user;
					 ob_start();
					 if($current_user->ID==0){
							require_once(WP_iv_membership_template. 'private-profile/profile-login.php');
					 
					 }else{
					  //update_option('iv_membership_profile-template', 'style-1' );
						$tempale=get_option('iv_membership_profile-template'); 
												  //include the specified file
							if($tempale=='style-1'){
									include( WP_iv_membership_template. 'private-profile/profile-template-1.php');
							}
							if($tempale=='style-2'){
									include( WP_iv_membership_template. 'private-profile/profile-template-1.php');
							}
						
						
					}
					
					$content = ob_get_clean();	
					
					return $content;
						
					
				}
				public function iv_membership_reminder_email_cron_func ($atts = ''){
					
					include( WP_iv_membership_ABSPATH. 'inc/reminder-email-cron.php');
					
				
				}
				public function iv_membership_user_directory_func($atts = ''){
					global $current_user;						 
					
					if(isset($atts['style']) and $atts['style']!="" ){
						$tempale=$atts['style']; 
					}else{
						$tempale=get_option('iv_membership_user_directory'); 
					}
					if($tempale==''){
						$tempale='style-2';
					}	
					
					$filename = get_template_directory()."/wpmembership/";
					$folder_check_theme=get_template_directory()."/wpmembership/user-directory"; 
					
					if (!file_exists($filename)) { 										
						define( 'WP_iv_membership_user_dir', WP_iv_membership_ABSPATH.'template/' );
						
					}else{
						if (!file_exists($folder_check_theme)) {
							
							define( 'WP_iv_membership_user_dir', WP_iv_membership_ABSPATH.'template/' );
						}else{ 
							define( 'WP_iv_membership_user_dir', $filename);
						}	
						
					}							
					
					ob_start();						  //include the specified file
					if($tempale=='style-1'){
							include( WP_iv_membership_user_dir. 'user-directory/directory-template-1.php');
					}
					if($tempale=='style-2'){
							include( WP_iv_membership_user_dir. 'user-directory/directory-template-2.php');
					}
					if($tempale=='style-3'){
							include( WP_iv_membership_user_dir. 'user-directory/directory-template-3.php');
					}	
					
					$content = ob_get_clean();
					return $content;						
							
						
				}
				public function iv_membership_profile_public_func($atts = '') {
						
						//global $wpdb;
						//update_option('iv_membership_profile-template', 'style-1' );
						
						if(isset($atts['style']) and $atts['style']!="" ){
							$tempale=$atts['style']; 
						}else{
							$tempale=get_option('iv_membership_profile-public'); 
						}
						
						ob_start();						  //include the specified file
							if($tempale=='style-1'){
									include(WP_iv_membership_template. 'profile-public/profile-template-1.php');
							}
							if($tempale=='style-2'){
									include( WP_iv_membership_template. 'profile-public/profile-template-2.php');
							}
							if($tempale=='style-3'){
									include(WP_iv_membership_template. 'profile-public/profile-template-3.php');
							}
							if($tempale=='style-4'){
									include( WP_iv_membership_template. 'profile-public/profile-template-4.php');
							}
							if($tempale=='style-5'){
									include( WP_iv_membership_template. 'profile-public/profile-template-5.php');
							}
						
						$content = ob_get_clean();	
					
					return $content;
				}
				
				
				
				
			}
		}

/*
 * Creates a new instance of the BoilerPlate Class
*/
function iv_membershipBootstrap() {
	return WP_iv_membership::instance();
}

iv_membershipBootstrap(); ?>
