		<?php
		$content_reminder = get_option( 'iv_membership_reminder_email');
		if($content_reminder==""){
				require_once (WP_iv_membership_DIR .'/install/install-reminder-email.php');
		}
		?>
		<div class="row pull-right">
				<div class="col-md-12 ">

					 <button type="button" onclick="return  iv_update_reminder_email_settings();" class="btn btn-success">Reminder Email Setting</button>					</div>							
			</div>	
	<form class="form-horizontal" role="form"  name='reminder_email_settings' id='reminder_email_settings'>	
		<?php
		
		$form_id='';
		$form_name='iv_membership_account_form';
		$form_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '" . $form_name . "' ORDER BY `ID` DESC");

		?>
	
		
		
		<div class="form-group">
				<label  class="col-md-2   control-label"> Reminder Email Subject : </label>
				<div class="col-md-4 ">
					
						<?php
						$iv_membership_reminder_email_subject = get_option( 'iv_membership_reminder_email_subject');
						
						?>
						
						<input type="text" class="form-control" id="iv_membership_reminder_email_subject" name="iv_membership_reminder_email_subject" value="<?php echo $iv_membership_reminder_email_subject; ?>" placeholder="Enter reminder email subject">
				
			</div>
		</div>
		<div class="form-group">
				<label  class="col-md-2   control-label">Reminder Email Tempalte : </label>
				<div class="col-md-10 ">
															<?php
							$settings_a = array(															
								'textarea_rows' =>20,															 
								);
							$content_reminder = get_option( 'iv_membership_reminder_email');
							$editor_id = 'reminder_email_template';
							//wp_editor( $content_reminder, $editor_id,$settings_a );										
							?>
							<textarea id="reminder_email_template" name="reminder_email_template" rows="20" class="col-md-12 ">
							<?php echo $content_reminder; ?>
							</textarea>

			</div>
		</div>
				<div class="form-group">
				<label  class="col-md-2   control-label"> Send Email Before # Days : </label>
				<div class="col-md-4 ">
					
						<?php
						$iv_membership_reminder_day = get_option( 'iv_membership_reminder_day');
						?>
						
						<input type="text" class="form-control" id="iv_membership_reminder_day" name="iv_membership_reminder_day" value="<?php echo $iv_membership_reminder_day; ?>" placeholder="Enter number of day">
				
			</div>
		</div>
			<div class="row form-group">
					<label  class="col-md-2   control-label">Reminder  Cron Job URL:
					<br/>( Set the url on your web server cron job schedule for every day. )
					 </label>
					<div class="col-md-4 ">
						
					  <?php
						$cron_page=get_option('_iv_membership_remainder_email_page');
						$cron_page= get_permalink( $cron_page); 
						
						?>
						 <a  href="<?php  echo $cron_page; ?>"> <?php echo  $cron_page; ?></a>
																
																								
				</div>
			</div>
			<div class="row form-group">
					<label  class="col-md-2   control-label">Short Code: </label>
					<div class="col-md-4 ">			
					<h4>  <span class="label label-info">[iv_membership_reminder_email_cron] </span></h4>
																	
																								
				</div>
			</div>
		
		

	</form>
		<div class="row pull-left">
				<div class="col-md-12 ">

					 <button type="button" onclick="return  iv_update_reminder_email_settings();" class="btn btn-success">Update Reminder Email Setting</button>				
				</div>							
		</div>	
		


