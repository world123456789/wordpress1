<?php
global $wpdb;
	$cancellation_email = get_option( 'iv_membership_cancellation_email');
	if($cancellation_email==""){
			require_once (WP_iv_membership_DIR .'/install/install-cancellation-email.php');
	}			
	$email_body = get_option( 'iv_membership_cancellation_email');
	$cancellation_email_sub = get_option( 'iv_membership_cancellation_email_sub');			
					
		$admin_mail = get_option('admin_email');	
		if( get_option( 'admin_email_iv_membership' )==FALSE ) {
			$admin_mail = get_option('admin_email');						 
		}else{
			$admin_mail = get_option('admin_email_iv_membership');								
		}						
		$wp_title = get_bloginfo();
	
	parse_str($_POST['form_data'], $data_a);
	
	$user_info = get_userdata(get_current_user_id());
	if(isset($user_info->ID) ){

        
		$email_body = str_replace("[user_name]", $user_info->user_login, $email_body);
		$email_body = str_replace("[email_address]", $user_info->user_email, $email_body);	
		$email_body = str_replace("[reason]", $data_a['cancel_text'] , $email_body);
				
		$cilent_email_address =$user_info->user_email; //trim(get_post_meta($post_id, 'iv_form_modal_client_email', true));
						
		$auto_subject=  $cancellation_email_sub; 								
		$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Content-Type: text/html");
		$h = implode("\r\n", $headers) . "\r\n";
		wp_mail($cilent_email_address, $auto_subject, $email_body, $h);
		
		// For Admin
		$cilent_email_address =$admin_mail;
		$headers = array("From: " . $wp_title . " <" . $admin_mail . ">", "Content-Type: text/html");
		$h = implode("\r\n", $headers) . "\r\n";
		wp_mail($cilent_email_address, $auto_subject, $email_body, $h);	
		
	}
					
			
	

