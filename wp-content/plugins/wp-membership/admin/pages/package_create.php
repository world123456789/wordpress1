	

<script>

	function save_the_form() {
		var loader_image = "<img src='<?php echo WP_iv_membership_URLPATH. 'admin/files/images/loader.gif'; ?>' />";
		jQuery("#loading").html(loader_image);
	
				// New Block For Ajax*****
				var search_params={
					"action"  : 	"iv_membership_save_package",	
					"form_data":	jQuery("#package_form_iv").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						var url = "<?php echo WP_iv_membership_ADMINPATH; ?>admin.php?page=wp-iv_membership-package-all&form_submit=success";    						
						jQuery(location).attr('href',url);	
					}
				});
				
	}

			
	jQuery(document).ready(function(){
		jQuery('#package_recurring').click(function(){
			if(this.checked){				
				jQuery('#recurring_block').show();
			}else{				
				jQuery('#recurring_block').hide();
			}
		});
	});	
	jQuery(document).ready(function(){
		jQuery('#package_enable_trial_period').click(function(){
			if(this.checked){				
				jQuery('#trial_block').show();
			}else{				
				jQuery('#trial_block').hide();
			}
		});
	});		
			
			
			
			
			</script>	
			<?php
			
			global $wpdb;			
		
			$last_post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_type = 'iv_membership' ORDER BY `ID` DESC ");
			$form_number = $last_post_id + 1;
			$form_name = 'iv_membership_' . $form_number;
			
			
			
			
			?>
			<div class="bootstrap-wrapper">
				<div class="welcome-panel container-fluid">

				
					
					<!-- /.modal -->
					
					
					<!-- Start Form 101 -->
					<div class="row">					
						<div class="col-xs-12" id="submit-button-holder">					
							<div class="pull-right"><button class="btn btn-info btn-lg" onclick="return save_the_form();">Save Package</button></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12"><h3 class="page-header">Create Package / Membership Level<br /><small> &nbsp;</small> </h3>
						</div>							
							
					</div> 
					<!--
							<form id="contact_form_iv" name="contact_form_iv" class="form-horizontal" role="form" onsubmit="return false;">
									<div class="form-group col-md-6 row" style="z-index:12;">									
										<label for="text" class="col-md-3 control-label">Package Name</label>
										<div class="col-md-8">
											<input type="text"  name="package_name" class="form-control ctrl-textbox"  placeholder="Enter Package Name">
										</div>
									</div>
									
		
					
						</form>
						-->
						<form id="package_form_iv" name="package_form_iv" class="form-horizontal" role="form" onsubmit="return false;">
							  
							  <div class="form-group">
								<label for="text" class="col-md-2 control-label">Package Name</label>
								<div class="col-md-6">
								  <input type="text" class="form-control" name="package_name" id="package_name" placeholder="Enter Package Name">
								</div>
							  </div>
							    <div class="form-group">
								<label for="text" class="col-md-2 control-label">Package Feature List</label>
								<div class="col-md-6">
									<textarea class="form-control" name="package_feature" id="package_feature" rows="5" placeholder="Enter Feature List "></textarea>
								     It'll display on price list table
								</div>
							  </div>
							  <h3 class="page-header"> Billing Details</h3>
							 
							  <div class="form-group">
								<label for="inputEmail3" class="col-md-2 control-label">Initial Payment</label>
								<div class="col-md-6">
								  <input type="text" class="form-control" id="package_cost" name="package_cost" placeholder="Enter Initial Payment">
								  The initial amount collected at user registration.
								</div>
							  </div>
							  
							   <div class="form-group">
								<label for="text" class="col-md-2 control-label">Package Expire After</label>
								<div class="col-md-2">
								  <select id="package_initial_expire_interval" name="package_initial_expire_interval" class="ctrl-combobox form-control">
									  
										<?php 
											$package_id='0';
											
											 $package_initial_period_interval= get_post_meta($package_id, 'iv_membership_package_initial_expire_interval', true); 
											  echo '<option value="">None</option>';
											for($ii=1;$ii<31;$ii++){
												echo '<option value="'.$ii.'" '.($package_initial_period_interval == $ii ? 'selected' : '').'>'.$ii.'</option>';
											
											}
											
											?>
                                           
                                    </select>	
                                     			
								</div>	
											
								
									<div class="col-md-4">
										<?php
											 $package_initial_expire_type= get_post_meta($package_id, 'iv_membership_package_initial_expire_type', true); 
											 ?>
											<select name="package_initial_expire_type" id ="package_initial_expire_type" class=" form-control">		
													<option value="">None </option>								
													<option value="day" <?php echo ($package_initial_expire_type == 'day' ? 'selected' : '') ?>>Day(s)</option>
													<option value="week" <?php echo ($package_initial_expire_type == 'week' ? 'selected' : '') ?>>Week(s)</option>
													<option value="month" <?php echo ($package_initial_expire_type == 'month' ? 'selected' : '') ?>>Month(s)</option>
													<option value="year" <?php echo ($package_initial_expire_type == 'year' ? 'selected' : '') ?>>Year(s)</option>
											</select>		
									 
									</div>
									<div class='col-md-12'><label for="text" class="col-md-2 control-label"></label>
										If select none then user's package will expire after 19 years. Package Expire Option will not work on Recurring Subscription. "Billing Cycle Limit" will Work For Recurring Subscription.
									</div>
								
							  </div>
					
								   <div class="form-group">
									<label for="text" class="col-md-2 control-label"> Recurring Subscription</label>
									<div class="col-md-6 ">
										<label>
										  <input type="checkbox" name="package_recurring" id="package_recurring" value="on" > Enable Recurring Payment
										</label>
									</div>								
								  </div>
				<div id="recurring_block" style="display:none" >	  
								   <div class="form-group">
									<label for="text" class="col-md-2 control-label">Billing Amount</label>
									<div class="col-md-2">
									  <input type="text" class="form-control" name ="package_recurring_cost_initial" id="package_recurring_cost_initial" placeholder="Amount">
									</div>
									<label for="text" class="col-md-1 control-label">Per</label>
									<div class="col-md-1">									
									   <input type="text" class="form-control" id="package_recurring_cycle_count" name="package_recurring_cycle_count" placeholder="Cycle #">
									</div>
										<div class="col-md-2">
												<select name="package_recurring_cycle_type" id ="package_recurring_cycle_type" class="ctrl-combobox form-control">											
														<option value="day">Day(s)</option>
														<option value="week">Week(s)</option>
														<option value="month">Month(s)</option>
														<option value="year">Year(s)</option>
												</select>		
										 
										</div>
										<div class='col-md-12'><label for="text" class="col-md-2 control-label"></label>
											The "Billing Amount" will Collect at User Registration.
										</div>
									  </div>
							   <?php
							  if(get_option('iv_membership_payment_gateway')!='woocommerce'){
							  ?>
							   <div class="form-group">
								<label for="text" class="col-md-2 control-label">Billing Cycle Limit</label>
														
								<div class="col-md-2">
										<select name="package_recurring_cycle_limit" id ="package_recurring_cycle_limit" class="ctrl-combobox form-control">											
												<option value="">Never</option>										
											<?php
											 $package_recurring_cycle_limit= ""; 
											for($ii=1;$ii<35;$ii++){
												echo '<option value="'.$ii.'" '.($package_recurring_cycle_limit == $ii ? 'selected' : '').'>'.$ii.'</option>';
											
											}
											
											?>
												
												
										</select>		
										
								 
								</div>
								
							  </div>
							
								<div class="form-group">
									<label for="text" class="col-md-2 control-label"> Trial</label>
									<div class="col-md-6 ">
										<label>
										  <input type="checkbox" name="package_enable_trial_period" id="package_enable_trial_period"  value='yes'> Enable Trial Period
										</label>
										<br/>
										"Billing Amount" will Collect After Trial Period.  
										
									</div>																
								</div>
						
						<div id="trial_block" style="display:none" >
								  
									   <div class="form-group">
										<label for="inputEmail3" class="col-md-2 control-label">Trial Amount</label>
										<div class="col-md-6">
										  <input type="text" class="form-control" id="package_trial_amount" name="package_trial_amount" placeholder="Enter Amount to Bill for The Trial Period">
											Amount to Bill for The Trial Period. Free is 0.[Stripe will not support this option ]
										</div>
									  </div>
									  
									  <div class="form-group">
										<label for="text" class="col-md-2 control-label">Trial Period</label>
										<div class="col-md-2">
										  <select id="package_trial_period_interval" name="package_trial_period_interval" class="ctrl-combobox form-control">
												   
												<?php
												
													 $package_trial_period_interval= '1'	; 
													for($ii=1;$ii<31;$ii++){
														echo '<option value="'.$ii.'" '.($package_trial_period_interval == $ii ? 'selected' : '').'>'.$ii.'</option>';
													
													}
													
													?>
											</select>
												
											
										</div>	
										
													
										
											<div class="col-md-4">
													<select name="package_recurring_trial_type" id ="package_recurring_trial_type" class="ctrl-combobox form-control">											
															<option value="day">Day(s)</option>
															<option value="week">Week(s)</option>
															<option value="month">Month(s)</option>
															<option value="year">Year(s)</option>
													</select>		
											 
											</div>
											<div class='col-md-12'><label for="text" class="col-md-2 control-label"></label>
												After The Trial Period "Billing Amount"	Will Be Billed.	
											</div>
										
									  </div>
							</div> <!-- Trial Block -->		
							<?php
								}
							?>  
									  
						</div> <!-- Recurring Block -->
						<?php
							if(get_option('iv_membership_payment_gateway')=='woocommerce'){
							if ( class_exists( 'WooCommerce' ) ) {
							
							?>  
							  <div class="form-group">
								<label for="text" class="col-md-2 control-label"><?php _e('Woocommerce Product','epphotographer'); ?></label>
								<div class="col-md-3">							
										<select  class="form-control" id="Woocommerce_product" name="Woocommerce_product">
											<?php 					
											$sql="SELECT * FROM $wpdb->posts where post_type='product'  and post_status='publish'";		
											$product_rows = $wpdb->get_results($sql);	
											if(sizeof($product_rows)>0){									
												foreach ( $product_rows as $row ) 
												{	$selected='';													
													echo '<option value="'.$row->ID.'"'.$selected.' >'.$row->post_title.' </option>';
												}
											}	
											?>											
										</select>                                     			
								</div>		
							</div>						
						<?php
							}
						}	
						?>				
							  
							    <h3 class="page-header"> User Access Control </h3>
									<div class="form-group">
									<label for="text" class="col-md-2  control-label">Maximum Post </label>
									<div class="col-md-6">
									  <input type="text" class="form-control" name="max_pst_no" id="max_pst_no" placeholder="Enter Max Number">
									  Maximum # of post by this package. Blank is unlimited.
									</div>
								  </div>
								  <div class="form-group">
									<label for="text" class="col-md-2  control-label">Categories	 </label>
									<div class="col-md-3">
										
									 <table class="form-table">
											<tbody>
												<tr>
													
													<td>
														<?php
														$categories = get_categories( array( 'hide_empty' => 0 ) );
														echo "<ul>";
															echo "<li><input name='membershipcategory[]' type='checkbox' value='all' checked='checked' /> All</li>\n";
														foreach ( $categories as $cat )
														{                               								
															$checked =''; //in_array( $cat->term_id, $level->categories ) ? "checked='checked'" : '';
															
															echo "<li><input name='membershipcategory[]' type='checkbox' value='{$cat->term_id}' checked='checked' /> {$cat->name}</li>\n";
														}
														echo "</ul>";
														?>
													</td>
												</tr>
												<tr><td>
												 Can Write on the Categories Only.
												 </td>
												</tr>	
											</tbody>
										</table>
																	   
									</div>
								  </div>	
								 	 <!--
								  <h3 class="page-header"> Package Roles </h3>
									
										<div class="panel panel-info">
								  			<div class="panel-heading" role="tab" id="headingOne">
												  <h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#iv-accordion" href="#iv-collapseOne" aria-expanded="true" aria-controls="iv-collapseOne">
													  Package Role Editor
													</a>
												  </h4>
												</div>
												 <div id="iv-collapseOne" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne">
												  <div class="panel-body">
														Test
												  </div>
												</div>											
												
											</div>
										

								  -->
						</form>
					
						<div class="row">					
							<div class="col-xs-12">					
								<div align="center">
									<div id="loading"></div>
									<button class="btn btn-info btn-lg" onclick="return save_the_form();">Save Package</button></div>
									<p>&nbsp;</p>
								</div>
							</div>
						</div>
				</div>		 


				<!-- Zea test end -->

				<!-- End of templates -->

			
