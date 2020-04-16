 <?php
 global $wpdb;
 $current_user = wp_get_current_user();
  
		    // Check Express Checkout Here 
		    // IF IF*********
   
		$userId=$current_user->ID;
		//$payment_gateway=get_option('iv_membership_payment_gateway');	
		$payment_gateway=get_user_meta($userId, 'iv_membership_payment_gateway', true);
		
	
	?>    
        
          <div class="profile-content">
            
              <div class="portlet light">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject"><?php  _e('Membership Level','wpmembership');?></span>
                    </div>
					 <ul class="nav nav-tabs">
                      <li class="active">
                        <a href="#tab_current" data-toggle="tab"><?php  _e('Current','wpmembership');?></a>
                      </li>
					  <li class="">
                        <a href="#tab_upgrade" data-toggle="tab"><?php  _e('Upgrade','wpmembership');?></a>
                      </li>
					    
                      <li>
                        <a href="#tab_cancel" data-toggle="tab"><?php  _e('Cancel','wpmembership');?></a>
                      </li>
                   
                    </ul>
                  
                  </div>
                  
                  <div class="portlet-body">
                    <div class="tab-content">
                    
                      <div class="tab-pane active" id="tab_current">
					   <?php
						  	global $wpdb, $post;
							$iv_gateway = get_option('iv_membership_payment_gateway');								
							$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_membership_pack'  and post_status='draft' ";
							$membership_pack = $wpdb->get_results($sql);
							$total_package=count($membership_pack);
							$package_id=get_user_meta($current_user->ID,'iv_membership_package_id',true);
							$iv_pac=$package_id;
						  ?>
						  <div class="table-responsive">
							<table class="table table-striped">
							<tr>
									<td  style="font-size:14px;width:40%"> 
										<?php  _e('Current Package','wpmembership');?>
									</td>
									<td  style="font-size:14px;width:60%"> 
									<?php
										if($package_id!=""){
											$post_p = get_post($package_id); 
											if(!empty($post_p)){
												echo ($post_p->post_title!="" ? $post_p->post_title: 'None');	
											}else{
												echo'None';
											}	
										}else{
											echo'None';
										}
										
										?>
									</td>
							</tr>
							<tr>
									<td width="40%" style="font-size:14px"> 
										<?php  _e('Package Amount','wpmembership');?>
									</td>
									<td width="60%" style="font-size:14px"> 
									<?php	$currencyCode= get_option('_iv_membership_api_currency');
											 $iv_gateway = get_option('iv_membership_payment_gateway');
											if($iv_gateway=='woocommerce'){ 
												$api_currency= get_option( 'woocommerce_currency' );
												$currencyCode= get_woocommerce_currency_symbol( $api_currency );
											}
											$recurring_text='  '; $amount= '';
											if(get_post_meta($package_id, 'iv_membership_package_cost', true)=='0' or get_post_meta($package_id, 'iv_membership_package_cost', true)==""){
											  $amount= 'Free';
											}else{
											  $amount= $currencyCode.' '. get_post_meta($package_id, 'iv_membership_package_cost', true);
											}
											
											$recurring= get_post_meta($package_id, 'iv_membership_package_recurring', true);	
											if($recurring == 'on'){
												$amount= $currencyCode.' '. get_post_meta($package_id, 'iv_membership_package_recurring_cost_initial', true);
												$count_arb=get_post_meta($package_id, 'iv_membership_package_recurring_cycle_count', true); 	
												if($count_arb=="" or $count_arb=="1"){
												$recurring_text=" per ".' '.get_post_meta($package_id, 'iv_membership_package_recurring_cycle_type', true);
												}else{
												$recurring_text=' per '.$count_arb.' '.get_post_meta($package_id, 'iv_membership_package_recurring_cycle_type', true).'s';
												}
												
											}else{
												$recurring_text=' &nbsp; ';
											}
										echo $amount;
										?>
									</td>
							</tr>
							<tr>
									<td width="40%" style="font-size:14px"> 
										<?php  _e('Package Type','wpmembership');?>
									</td>
									<td width="60%" style="font-size:14px"> 
									<?php
										echo $amount.' '.$recurring_text;
										?>
									</td>
							</tr>
							<tr>
									<td width="40%" style="font-size:14px"> 
										<?php  _e('Payment Status','wpmembership');?>
									</td>
									<td width="60%" style="font-size:14px"> 
									<?php 
											$status_result=0;								
											$payment_status= get_user_meta($current_user->ID, 'iv_membership_payment_status', true);
										$payment_gateway = get_option('iv_membership_payment_gateway');
										$package_product_id= get_post_meta( $package_id,'iv_membership_package_woocommerce_product',true);	
										if($payment_gateway=='woocommerce'){ 
												if ( class_exists( 'WC_Subscriptions' ) ) { 
															//WC_Subscriptions::get_my_subscriptions_template();
															$subscriptions = wcs_get_users_subscriptions();
															$user_id       = get_current_user_id();
																											
													foreach ( $subscriptions as $subscription_id => $subscription ) {
														 $payment_status=  esc_attr( wcs_get_subscription_status_name( $subscription->get_status() ) );
														 $status_result=1;
													}											
												 }
												if($status_result==0){ 
													$order_statuses = array('wc-on-hold', 'wc-processing', 'wc-completed');
													$user_id=$current_user->ID;
													$customer_orders = get_posts( array(
													'meta_key'    => '_customer_user',
													'meta_value'  => $user_id,
													'post_type'   => 'shop_order',
													'post_status' => $order_statuses,
													'numberposts' => -1
													));
													$got_status='';
													foreach($customer_orders as $customer_order){													
														$order = wc_get_order($customer_order->ID);
														$order_stat = new WC_Order( $customer_order->ID );																			
														foreach($order->get_items() as $item_id => $item_values){												
															 $product_id = $item_values['product_id'];
															if($product_id==$package_product_id){	
																if($order_stat->has_status( 'completed' )){
																	$payment_status= __('Completed','epphotographer')	;
																}
																else{
																	 $payment_status=__('Processing','epphotographer')	;
																}																
																$got_status='1';														
																break;
															}												
														}
														if($got_status=='1'){   
															break;
														}
													}
											  }
											}else{												
												$payment_status= get_user_meta($current_user->ID, 'iv_membership_payment_status', true);
											}
								
										
								echo ucfirst($payment_status);
								?>
									</td>
							</tr>
							<tr>
									<td style="font-size:14px;width:40%" > 
										<?php  _e('User Role','wpmembership');?>
									</td>
									<td style="font-size:14px;width:60%"> 
									<?php 
										
										 $user = new WP_User( $current_user->ID );
										if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
											foreach ( $user->roles as $role )
												echo ucfirst($role);
										}
										
										?>
									</td>
							</tr>
							 <?php
							 
							   if(get_user_meta($current_user->ID, 'iv_membership_payment_status', true)=='cancel'){
							 ?>
								<tr>
										<td width="40%" style="font-size:14px"> 
											<?php  _e('Exprie Date','wpmembership');?>
										</td>
										<td width="60%" style="font-size:14px"> 
										<?php
											if($recurring == 'on'){
												$exp_date= get_user_meta($current_user->ID, 'iv_membership_exprie_date', true);
												echo date('d-M-Y',strtotime($exp_date));
											}else{
												echo '';	
											}	
											
											?>
										</td>
								</tr>
								<?php
								}else{
								
								?>
								
								<tr>
									<td width="40%" style="font-size:14px"> 
										<?php  _e('Next Payment Date','wpmembership');?>
									</td>
									<td width="60%" style="font-size:14px"> 
									<?php
										if($recurring == 'on'){
											$exp_date= get_user_meta($current_user->ID, 'iv_membership_exprie_date', true);
											echo ($exp_date!=""? date('d-M-Y',strtotime($exp_date)):'');
										}else{
											$exp_date= get_user_meta($current_user->ID, 'iv_membership_exprie_date', true);
											echo ($exp_date!=""? date('d-M-Y',strtotime($exp_date)):'');
										}	
										
										?>
									</td>
							</tr>
							<?php
							}
							?>
							
							</table>
						</div>
 
	                 </div>                   
					
					<div class="tab-pane" id="tab_upgrade">
						
					
							
						<?php
						if($iv_gateway=='woocommerce'){
						?>
			<form class="form-group"  name="profile_upgrade_form" id="profile_upgrade_form" action="<?php  the_permalink() ?>?&payment_gateway=woocommerce&iv-submit-upgrade=upgrade" method="post">

				<div class=" row form-group">
					<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Package Name','epphotographer')	;?></label>
						<div class="col-md-8 col-xs-8 col-sm-8 ">
							<?php
								$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_membership_pack'  and post_status='draft'";
								$membership_pack = $wpdb->get_results($sql);
								$total_package=count($membership_pack);
								//echo'$total_package.....'.$total_package;
								if(sizeof($membership_pack)>0){
									$i=0; $current_package_id=get_user_meta($current_user->ID,'iv_membership_package_id',true);
									echo'<select name="package_sel" id ="package_sel" class=" form-control">';
									foreach ( $membership_pack as $row )
									{
										if($current_package_id==$row->ID){
											echo '<option value="'. $row->ID.'" >'. $row->post_title.' [Your Current Package]</option>';
										}else{
											echo '<option value="'. $row->ID.'" >'. $row->post_title.'</option>';
										}
											if($i==0){
												$package_id=$row->ID;
												if(get_post_meta($row->ID, 'iv_membership_package_recurring',true)=='on'){
													$package_amount=get_post_meta($row->ID, 'iv_membership_package_recurring_cost_initial', true);
												}else{
													$package_amount=get_post_meta($row->ID, 'iv_membership_package_cost',true);

												}
											}
									 $i++;
									}

									echo '</select>';
								}
							 ?>
							</div>

				</div>
						<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Amount','epphotographer')	;?></label>

								<div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount">
									<?php  echo $amount.' '.$recurring_text; ?>

								</div>
						</div>


								<div class="row form-group">
									<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
									<div class="col-md-8 col-xs-8 col-sm-8 " > 	<div id="loading"> </div>
										<input type="hidden" name="package_id" id="package_id" value="<?php echo $package_id; ?>">
										<input type="hidden" name="coupon_code" id="coupon_code" value="">
										<button class="btn green-haze" type="submit"> <?php  _e('Upgrade','epphotographer')	;?></button>
										<input type="hidden" name="return_page" id="return_page" value="<?php  the_permalink() ?>">
									</div>

								</div>
						</form>
						 <?php
						 }				
						if($iv_gateway=='paypal-express'){							
						?>
			<form class="form-group"  name="profile_upgrade_form" id="profile_upgrade_form" action="<?php  the_permalink() ?>?&payment_gateway=paypal&iv-submit-upgrade=upgrade" method="post">
			
				<div class=" row form-group">
					<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Package Name','wpmembership');?></label>
						<div class="col-md-8 col-xs-8 col-sm-8 "> 																				
							<?php
								$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_membership_pack'  and post_status='draft'";
								$membership_pack = $wpdb->get_results($sql);
								$total_package=count($membership_pack);
								//echo'$total_package.....'.$total_package;
								if(sizeof($membership_pack)>0){
									$i=0; $current_package_id=get_user_meta($current_user->ID,'iv_membership_package_id',true);
									echo'<select name="package_sel" id ="package_sel" class=" form-control">';							
									foreach ( $membership_pack as $row )
									{	
										if($current_package_id==$row->ID){
											echo '<option value="'. $row->ID.'" >'. $row->post_title.' [Your Current Package]</option>';
										}else{
											echo '<option value="'. $row->ID.'" >'. $row->post_title.'</option>';
										}
											if($i==0){
												$package_id=$row->ID;
												if(get_post_meta($row->ID, 'iv_membership_package_recurring',true)=='on'){
													$package_amount=get_post_meta($row->ID, 'iv_membership_package_recurring_cost_initial', true);	
												}else{
													$package_amount=get_post_meta($row->ID, 'iv_membership_package_cost',true);
												
												}
											}
									 $i++;		
									}	
														
									echo '</select>';
								}
							 ?>
							</div>
				
				</div>		
						<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Amount','wpmembership');?></label>
								
								<div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount"> 									
									<?php  echo $amount.' '.$recurring_text; ?> 
									
								</div>										
						</div>	
                        <?php
							$api_currency= 'USD';
							if( get_option('_iv_membership_api_currency' )!=FALSE ) {
								$api_currency= get_option('_iv_membership_api_currency' );
							}
							$tax_total=0;
							$tax_type= (get_option('_iv_tax_type')!=""? get_option('_iv_tax_type'):"country");
							$tax_active_module=get_option('_iv_membership_active_tax');
							$country_id= get_user_meta($userId, 'country_code',true);  // Will get from User meta
							if($tax_active_module=='yes'){
							?>
							<div class="row form-group">
								<label for="text" class="col-md-4 control-label"><?php  esc_html_e('Vat/Tax','wpmembership');?></label>												
																				
								<div class="col-md-8" id="tax">  
									<?php 										
										$tax_type= get_option('_iv_tax_type');
										$tax_active_module=get_option('_iv_membership_active_tax');
										
										if($tax_active_module=='' ){ $tax_active_module='yes';	}					
										if($tax_type==''){$tax_type='country';}
											
										if($tax_active_module=='yes' AND $tax_type=='country'){						
											$countries_tax_array= (get_option('_iv_countries_tax')!=''? get_option('_iv_countries_tax'): array()) ;
											
											if(array_key_exists($country_id , $countries_tax_array)){							
												 $country_tax_value= $countries_tax_array[$country_id];
												 $tax_total=$package_amount * $country_tax_value/100;
											}
										}
										if($tax_active_module=='yes' AND $tax_type=='common'){						
											$common_tax_value= get_option('_iv_comman_tax_value');						
											$tax_total=$package_amount * $common_tax_value/100;											
										}
													echo $tax_total.''.$api_currency; 
										
										?>
								</div>										
							</div>
							<?php
							}	
							?>	
					<div class="row form-group">
								<label for="text" class="col-md-4 control-label"><?php  esc_html_e('Total','wpmembership');?></label>												
																				
								<div class="col-md-8" id="total"><label class="control-label">  <?php  $package_amount= $package_amount+$tax_total; echo $package_amount.''.$api_currency; ?></label>
								</div>										
					</div>					
                       
								<div class="row form-group">
									<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
									<div class="col-md-8 col-xs-8 col-sm-8 " > 	<div id="loading"> </div> 
										<input type="hidden" name="country_select" id="country_select" value="<?php echo $country_id; ?>">	
										<input type="hidden" name="package_id" id="package_id" value="<?php echo $package_id; ?>">	
										<input type="hidden" name="coupon_code" id="coupon_code" value="">	
										<button class="btn green-haze" type="submit"><?php  _e('Upgrade','wpmembership');?> </button>
										<input type="hidden" name="return_page" id="return_page" value="<?php  the_permalink() ?>">
									</div>
									
								</div>	
						</form> 
						 <?php
						 }
																			
						if($iv_gateway=='stripe'){ ?>
							<form class="form"  name="profile_upgrade_form" id="profile_upgrade_form" action="" method="post">
						<?php	
							require_once(WP_iv_membership_template.'private-profile/iv_stripe_form_upgrade.php');
								$arb_status =	get_user_meta($current_user->ID, 'iv_membership_payment_status', true);
								$cust_id = get_user_meta($current_user->ID,'iv_membership_stripe_cust_id',true);
								$sub_id = get_user_meta($current_user->ID,'iv_membership_stripe_subscrip_id',true);	
							?>
							
							<input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
							<input type="hidden" name="sub_id" value="<?php echo $sub_id; ?>">
							
						</form>
						<?php		
							}
							?>
						<div class=" row bs-callout bs-callout-info">	
						<?php  _e('Note: Your Successful Upgrade or Downgrade will affect on your user role immediately.','wpmembership');?>
							
						</div>
					</div>
					<div class="tab-pane" id="tab_cancel">
								<?php
									$payment_gateway=get_user_meta($current_user->ID, 'iv_membership_payment_gateway', true);
									if($payment_gateway=='paypal-express'){	
										$arb_status =	get_user_meta($current_user->ID, 'iv_membership_payment_status', true);
										$profile_id = get_user_meta($current_user->ID,'iv_paypal_recurring_profile_id',true);
											if($arb_status!='cancel'  && $profile_id!='' ){											?>
													<div class="" id="update_message_paypal"></div>
													<div id="paypal_cancel_div" name="paypal_cancel_div">
															<form class="form" role="form"  name="paypal_cancel_form" id="paypal_cancel_form" action="" method="post">
																<input type="hidden" name="profile_id" value="<?php echo $profile_id; ?>">	
																<div class="form-group">
																<label class="control-label"><?php  _e('Cancel Reason','wpmembership');?></label>
																<textarea class="form-control" name="cancel_text" id="cancel_text" rows="3" placeholder=""<?php  _e('Canceling Reason','wpmembership');?>"  ></textarea>
															  </div>
																
																<div class="margiv-top-10">
																	<div class="" id="update_message"></div>
																	
																	<button type="button"   class="btn green-haze" onclick="return iv_cancel_membership_paypal();"><?php  _e('Cancel Membership','wpmembership');?></button>
															  
															  </div>	
																					  
														  </form>  
														</div>    
											<?php
											}else{ ?>
											
												<div class="form-group">
															<label class="control-label"><?php  _e('Nothing to Cancel','wpmembership');?>.</label>
															
												</div>
											<?php
											}
						
									}
									if($payment_gateway=='stripe'){
											
											
											
											$arb_status =	get_user_meta($current_user->ID, 'iv_membership_payment_status', true);
											$cust_id = get_user_meta($current_user->ID,'iv_membership_stripe_cust_id',true);
											$sub_id = get_user_meta($current_user->ID,'iv_membership_stripe_subscrip_id',true);
											
											if($arb_status!='cancel'  && $sub_id!='' ){										?>
														<div class="" id="update_message_stripe"></div>
														<div id="stripe_cancel_div" name="stripe_cancel_div">
																<form class="form" role="form"  name="profile_cancel_form" id="profile_cancel_form" action="<?php  the_permalink() ?>" method="post">		
																<input type="hidden" name="cust_id" value="<?php echo $cust_id; ?>">
																<input type="hidden" name="sub_id" value="<?php echo $sub_id; ?>">																	
																	<div class="form-group">
																	<label class="control-label"><?php  _e('Cancel Reason','wpmembership');?></label>
																	<textarea class="form-control" name="cancel_text" id="cancel_text" rows="3" placeholder="<?php  _e('Canceling Reason','wpmembership');?>"  ></textarea>
																  </div>															
																	
																	<div class="margiv-top-10">
																		
																		<button type="button"   class="btn green-haze" onclick="return iv_cancel_membership_stripe();"><?php  _e('Cancel Membership','wpmembership');?></button>
																   </div>
																	
																</form>
														</div>
												<?php
												}else{ ?>
												
												<div class="form-group">
															<label class="control-label"><?php  _e('Nothing to Cancel','wpmembership');?>.</label>
															
														  </div>
												<?php
												}
										
									
									}	
								?>
								
					</div>
                  </div>
                </div>
              </div>
            </div>
   <script>  
   function iv_cancel_membership_paypal (){
	
	 if (confirm('Are you sure to cancel this Membership?')) {
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var loader_image = '<img src="<?php echo WP_iv_membership_URLPATH. "admin/files/images/loader.gif"; ?>" />';
					jQuery('#update_message_paypal').html(loader_image);
					var search_params={
						"action"  : 	"iv_membership_cancel_paypal",	
						"form_data":	jQuery("#paypal_cancel_form").serialize(), 
					};
					jQuery.ajax({					
						url : ajaxurl,					 
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){
							if(response.code=='success'){
								jQuery('#paypal_cancel_div').hide(); 
								jQuery('#update_message_paypal').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
							
							}else{
								jQuery('#update_message_paypal').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
							
							}
							
						}
						
					});
		}			
	
	}        
  function iv_cancel_membership_stripe (){
	
	 if (confirm('Are you sure to cancel this Membership?')) {
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var loader_image = '<img src="<?php echo WP_iv_membership_URLPATH. "admin/files/images/loader.gif"; ?>" />';
					jQuery('#update_message_stripe').html(loader_image);
					var search_params={
						"action"  : 	"iv_membership_cancel_stripe",	
						"form_data":	jQuery("#profile_cancel_form").serialize(), 
					};
					jQuery.ajax({					
						url : ajaxurl,					 
						dataType : "json",
						type : "post",
						data : search_params,
						success : function(response){
							jQuery('#stripe_cancel_div').hide(); 
							jQuery('#update_message_stripe').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
							
						}
					});
		}			
	
	}
 </script>	
<script>
jQuery(function(){	
	jQuery('#package_sel').on('change', function (e) {
		
		var optionSelected = jQuery("option:selected", this);
		var pack_id = this.value;
		
		jQuery("#package_id").val(pack_id);
								
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params={
		"action"  			: "iv_membership_check_package_amount",	
		"coupon_code" 		:jQuery("#coupon_name").val(),
		"package_id" 		: pack_id,
		"package_amount" 	:'',
		"form_data"			:jQuery("#profile_upgrade_form").serialize(),
		"api_currency" 		:'<?php echo $currencyCode; ?>',
		};
		jQuery.ajax({					
			url : ajaxurl,					 
			dataType : "json",
			type : "post",
			data : search_params,
			success : function(response){
				if(response.code=='success'){							
					jQuery('#coupon-result').html('<img src="<?php echo WP_iv_membership_URLPATH; ?>admin/files/images/right_icon.png">');
				}else{
						jQuery('#coupon-result').html('<img src="<?php echo WP_iv_membership_URLPATH; ?>admin/files/images/wrong_16x16.png">');
				}
				jQuery('#p_amount').html(response.p_amount);	
				jQuery('#total').html(response.gtotal);
				jQuery('#tax').html(response.tax_total);						
				
			}
			});
		});	
	});	
</script>	
 
          <!-- END PROFILE CONTENT -->
        
