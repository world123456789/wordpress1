	

<script>

	function update_the_package() {
		var loader_image = "<img src='<?php echo WP_iv_membership_URLPATH. 'admin/files/images/loader.gif'; ?>' />";
		jQuery("#loading").html(loader_image);
				// New Block For Ajax*****
				
				var search_params={
					"action"  : 	"iv_membership_update_package",	
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
			$package_id='';
			if(isset($_REQUEST['id'])){
				$package_id=$_REQUEST['id'];
			}
			$form_meta_data= get_post_meta( $package_id,'iv_membership_content',true);			
		
			$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE id = '".$package_id."' ");
			//echo'<br/>ID..'.$package_id;
			//echo '-----------------------------'.get_post_meta($package_id, 'iv_membership_package_recurring', true);
			
			
			
			
			?>
			<div class="bootstrap-wrapper">
				<div class="welcome-panel container-fluid">

				
					
					<!-- /.modal -->
					
					
					<!-- Start Form 101 -->
					<div class="row">					
						<div class="col-xs-12" id="submit-button-holder">					
							<div class="pull-right"><button class="btn btn-info btn-lg" onclick="return update_the_package();">Update Package</button></div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12"><h3 class="page-header">Update Package / Membership Level<br /><small> &nbsp;</small> </h3>
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
							  <input type="hidden"  name="package_id" value="<?php echo $package_id; ?>">
							  <div class="form-group">
								<label for="text" class="col-md-2 control-label">Package Name</label>
								<div class="col-md-6">
								  <input type="text" class="form-control" name="package_name" id="package_name" value="<?php echo $row->post_title; ?>"placeholder="Enter Package Name">
								</div>
							  </div>
							  <div class="form-group">
								<label for="text" class="col-md-2 control-label">Package Feature List</label>
								<div class="col-md-6">
									<textarea class="form-control" name="package_feature" id="package_feature" placeholder="Enter Feature List " rows="5"><?php echo $row->post_content; ?></textarea>
								     It'll display on price list table
								</div>
							  </div>
							  <h3 class="page-header"> Billing Details</h3>
							 
							  <div class="form-group">
								<label for="inputEmail3" class="col-md-2 control-label">Initial Payment</label>
								<div class="col-md-6">
								  <input type="text" class="form-control" id="package_cost" name="package_cost" value="<?php echo get_post_meta($package_id, 'iv_membership_package_cost', true); ?>"  placeholder="Enter Initial Payment">The Initial Amount Collected at User Registration.
								</div>
							  </div>
							  
							    <div class="form-group">
								<label for="text" class="col-md-2 control-label">Package Expire After</label>
								<div class="col-md-2">
								  <select id="package_initial_expire_interval" name="package_initial_expire_interval" class="ctrl-combobox form-control">
									  
										<?php
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
									  <input type="checkbox"  <?php echo (get_post_meta($package_id, 'iv_membership_package_recurring', true)=='on'?'checked': ''); ?> name="package_recurring" id="package_recurring" value="on" > Enable Recurring Payment
									</label>
								</div>								
							  </div>
					<div id="recurring_block" style="display:<?php echo (get_post_meta($package_id, 'iv_membership_package_recurring', true)=='on'?'': 'none'); ?>" >		  
							   <div class="form-group">
								<label for="text" class="col-md-2 control-label">Billing Amount</label>
								<div class="col-md-2">
								  <input type="text" class="form-control" value="<?php echo get_post_meta($package_id, 'iv_membership_package_recurring_cost_initial', true); ?>" name ="package_recurring_cost_initial" id="package_recurring_cost_initial" placeholder="Amount">
								</div>
								<label for="text" class="col-md-1 control-label">Per</label>
								<div class="col-md-1">									
								   <input type="text" class="form-control" value="<?php echo get_post_meta($package_id, 'iv_membership_package_recurring_cycle_count', true); ?>" id="package_recurring_cycle_count" name="package_recurring_cycle_count" placeholder="Cycle #">
								</div>
									<div class="col-md-2">
										<?php $package_recurring_cycle_type= get_post_meta($package_id, 'iv_membership_package_recurring_cycle_type', true); ?>
											<select name="package_recurring_cycle_type" id ="package_recurring_cycle_type" class="form-control">											
													<option value="day" <?php echo ($package_recurring_cycle_type == 'day' ? 'selected' : '') ?>>Day(s)</option>
													<option value="week" <?php echo ($package_recurring_cycle_type == 'week' ? 'selected' : '') ?>>Week(s)</option>
													<option value="month" <?php echo ($package_recurring_cycle_type == 'month' ? 'selected' : '') ?>>Month(s)</option>
													<option value="year" <?php echo ($package_recurring_cycle_type == 'year' ? 'selected' : '') ?>>Year(s)</option>
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
											 $package_recurring_cycle_limit= get_post_meta($package_id, 'iv_membership_package_recurring_cycle_limit', true); 
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
									  <input type="checkbox" <?php echo (get_post_meta($package_id, 'iv_membership_package_enable_trial_period', true)=='yes'? 'checked': ''); ?> name="package_enable_trial_period" id="package_enable_trial_period" value='yes'> Enable Trial Period
									</label>
									<br/>
									 "Billing Amount" will Collect After Trial Period.   
								</div>								
							  </div>
					<div id="trial_block" style="display:<?php echo (get_post_meta($package_id, 'iv_membership_package_enable_trial_period', true)=='yes'? '': 'none'); ?>" >		  
							   <div class="form-group">
								<label for="inputEmail3" class="col-md-2 control-label">Trial Amount</label>
								<div class="col-md-6">
								  <input type="text" class="form-control" value="<?php echo get_post_meta($package_id, 'iv_membership_package_trial_amount', true); ?>" id="package_trial_amount" name="package_trial_amount" placeholder="Enter Amount to Bill for The Trial Period">
								  Amount to Bill for The Trial Period. Free is 0.[Stripe will not support this option ]
								</div>
							  </div>
							  
							  <div class="form-group">
								<label for="text" class="col-md-2 control-label">Trial Period</label>
								<div class="col-md-2">
								  <select id="package_trial_period_interval" name="package_trial_period_interval" class="ctrl-combobox form-control">
									  
										<?php
											 $package_trial_period_interval= get_post_meta($package_id, 'iv_membership_package_trial_period_interval', true); 
											for($ii=1;$ii<31;$ii++){
												echo '<option value="'.$ii.'" '.($package_trial_period_interval == $ii ? 'selected' : '').'>'.$ii.'</option>';
											
											}
											
											?>
                                           
                                    </select>	
                                     			
								</div>	
											
								
									<div class="col-md-4">
										<?php
											 $package_recurring_trial_type= get_post_meta($package_id, 'iv_membership_package_recurring_trial_type', true); 
											 ?>
											<select name="package_recurring_trial_type" id ="package_recurring_trial_type" class=" form-control">											
													<option value="day" <?php echo ($package_recurring_trial_type == 'day' ? 'selected' : '') ?>>Day(s)</option>
													<option value="week" <?php echo ($package_recurring_trial_type == 'week' ? 'selected' : '') ?>>Week(s)</option>
													<option value="month" <?php echo ($package_recurring_trial_type == 'month' ? 'selected' : '') ?>>Month(s)</option>
													<option value="year" <?php echo ($package_recurring_trial_type == 'year' ? 'selected' : '') ?>>Year(s)</option>
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
								 $woo_pro= get_post_meta($package_id, 'iv_membership_package_woocommerce_product', true);
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
													if($woo_pro==$row->ID){$selected=' selected';}												
																										
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
									  <input type="text" class="form-control" name="max_pst_no" id="max_pst_no" value="<?php echo get_post_meta($package_id, 'iv_membership_package_max_post_no', true); ?>" placeholder="Enter Max Number">
									  Maximum # of post by this package. Blank is unlimited.
									</div>
								  </div>
								  <div class="form-group">
									<label for="text" class="col-md-2  control-label">Categories	 </label>
									<div class="col-md-6">
										
									 <table class="form-table">
											<tbody>
												<tr>
													
													<td>
														<?php
														$user_cat=  array();
														$cat_meta=	get_post_meta($package_id, 'iv_membership_package_category_ids', true);
														
														
														if(trim($cat_meta)!=''){
																$user_cat= explode("|",get_post_meta($package_id, 'iv_membership_package_category_ids', true));
														}
														
														
														$categories = get_categories( array( 'hide_empty' => 0 ) );
														
														$checked =in_array( 'all', $user_cat) ? "checked='checked'" : '';
														echo "<ul>";
															echo "<li><input name='membershipcategory[]' type='checkbox' value='all' ".$checked." /> All</li>\n";
														foreach ( $categories as $cat )
														{                               								
															$checked =in_array( $cat->term_id, $user_cat) ? "checked='checked'" : '';
															
															echo "<li><input name='membershipcategory[]' id='membershipcategory[]' type='checkbox' value='{$cat->term_id}' $checked /> {$cat->name}</li>\n";
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
						  
						</form>
					
						<div class="row">					
							<div class="col-xs-12">					
								<div align="center">
									<div id="loading"></div>
									<button class="btn btn-info btn-lg" onclick="return update_the_package();">Update Package</button></div>
									<p>&nbsp;</p>
								</div>
							</div>
						</div>
				</div>		 


				<!-- Zea test end -->

				<!-- End of templates -->

			
