<?php
global $wpdb;
wp_enqueue_style('wp-iv_membership-style-11', WP_iv_membership_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_script('iv_membership-script-12', WP_iv_membership_URLPATH . 'admin/files/js/bootstrap.min.js');
wp_enqueue_style('wp-iv_membership-style-13', WP_iv_membership_URLPATH . 'admin/files/css/form-wizard-style-1.css');

if(isset($_REQUEST['payment_gateway'])){
	
		$payment_gateway=$_REQUEST['payment_gateway'];
		if($payment_gateway=='paypal'){
			//require_once(WP_iv_membership_DIR . '/admin/pages/payment-inc/paypal-submit.php');
							
		}
}
$api_currency='USD';
$iv_gateway='paypal';
		if( get_option( 'iv_membership_payment_gateway' )!=FALSE ) {
			$iv_gateway = get_option('iv_membership_payment_gateway');	
				   if($iv_gateway=='paypal'){
						$post_name='iv_membership_paypal_setting';						
						$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
						$paypal_id='0';
						if(sizeof($row )>0){
							$paypal_id= $row->ID;
						}
						$api_currency=get_post_meta($paypal_id, 'iv_membership_paypal_api_currency', true);	
					}				 
		}
		$package_id='';
		if(isset($_REQUEST['package_id'])){
			$package_id=$_REQUEST['package_id'];
																					
		}
		global $wpdb;
		$form_meta_data= get_post_meta( $package_id,'iv_membership_content',true);			
		$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE id = '".$package_id."' ");
		$package_name='';
		$package_amount='';
		if(sizeof($row)>0){
			$package_name=$row->post_title;
			$count =get_post_meta($package_id, 'iv_membership_package_recurring_cycle_count', true);
			$package_name=$package_name.' '.$count .' '.get_post_meta($package_id, 'iv_membership_package_recurring_cycle_type', true);
																
			$package_amount=get_post_meta($package_id, 'iv_membership_package_cost',true);
		}
		
		 
								
?>


		
<div class="bootstrap-wrapper">
	<div class="container-fluid">
		
		
		
		  <div class="panel with-nav-tabs panel-info">
					<div class="panel-heading">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#user_reg" data-toggle="tab">Account</a></li>
								<li><a href="#payment" data-toggle="tab">Payment</a></li>
								<li><a href="#Thank" data-toggle="tab">Thank You</a></li>
								
							</ul>
					</div>
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="user_reg">
									<!--Account  -->
									
												<?php echo do_shortcode('[iv_membership_registration_form]'); ?>			
												
													<div class="pull-left">
														
														<a  class="btn btn-info ctrl-btn "  href="<?php  $page_name_package=get_option('_iv_membership_price_table' ); 	  echo get_page_link($page_name_package); ?>">Previous</a>
														
													</div>	
													<div class="pull-right">
														
														<button   type="button" onclick="return check_registration_form();" class="btn btn-info ctrl-btn"  > Next</button>
													</div>	
									
							</div>
							
						<div class="tab-pane fade" id="payment">
											<!--Payment  -->
													
						<?php
															
						if($iv_gateway=='paypal-express'){
						 ?>
																 
							<div class="row">	
								
								<div class="col-md-12 ">
								
								<form name ='paypal_form' id ='paypal_form' class="form-horizontal" action="<?php  the_permalink() ?>?package_id=<?php echo $package_id; ?>&payment_gateway=paypal&iv-submit-listing=register" method="post" role="form">
									
										
										<div class="row form-group">
										<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Package Name</label>
										<div class="col-md-8 col-xs-4 col-sm-8 "> 																				
											<?php
																				 if( $package_name==""){													
									
																					$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_membership_pack'";
																					$membership_pack = $wpdb->get_results($sql);
																					$total_package=count($membership_pack);
																					//echo'$total_package.....'.$total_package;
																					if(sizeof($membership_pack)>0){
																						$i=0;
																						echo'<select name="package_sel" id ="package_sel" class=" form-control">';
																						
																						foreach ( $membership_pack as $row )
																						{	
																							
																							echo '<option value="'. $row->ID.'" >'. $row->post_title.'</option>';
																						}	
																											
																						echo '</select>';	
																						$package_id= $membership_pack[0]->ID;
																						$package_amount=get_post_meta($package_id, 'iv_membership_package_cost',true);
																						?>
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
																				"package_amount" 	:'<?php echo $package_amount; ?>',
																				"api_currency" 		:'<?php echo $api_currency; ?>',
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
																						jQuery('#discount').html(response.dis_amount);
																					}
																					});
																				});	
																			});	
																						</script>	
																						<?php
																					}	
																						
																					
																				 }else{
																					echo $package_name;
																					
																				}
																				
																				
																				 ?>
																				</div>
																			
																			</div>
							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Amount</label>
								
								<div class="col-md-8 col-xs-8 col-sm8" id="p_amount">  <?php echo $api_currency.' '.$package_amount; ?>
								</div>										
							</div>
							<div class="row form-group">
							<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Discount Coupon</label>
								
								<div class="col-md-7 col-xs-7 col-sm-7 ">  <input type="text" class="form-control" name="coupon_name" id="coupon_name" value="" placeholder="Enter Coupon Code">
								</div>
								<div class="col-md-1 col-xs-1 col-sm-1 pull-left" id="coupon-result"> 
								</div>										
							</div>
							<div class="row">
							<hr>
							</div>
							
							
							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Subtotal</label>
								
								<div class="col-md-8 col-xs-8 col-sm-8 ">  <?php echo $api_currency.' '.$package_amount; ?>
								</div>										
							</div>
							<div class="row">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">(-) Discount</label>
								
								<div class="col-md-8 col-xs-8 col-sm-8 " id="discount">  --
								</div>										
							</div>
							<div class="row">
							<hr>
							</div>
							<div class="row">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Total</label>												
																				
								<div class="col-md-8 col-xs-8 col-sm-8" id="total">  <?php echo $api_currency.' '.$package_amount; ?>
								</div>										
							</div>
								<input type="hidden" name="form_reg" id="form_reg" value="">
								<input type="hidden" name="reg_error" id="reg_error" value="yes">
								<input type="hidden" name="package_id" id="package_id" value="<?php echo $package_id; ?>">
								<input type="hidden" name="return_page" id="return_page" value="<?php  the_permalink() ?>">
							<div class="row">
								<hr>
							</div>
								<?php
									$iv_membership_payment_terms=get_option('iv_membership_payment_terms'); 
									$term_text='I have read & accept the <a href="#"> Terms & Conditions</a>';
									if( get_option( 'iv_membership_payment_terms_text' ) ) {
										$term_text= get_option('iv_membership_payment_terms_text'); 
									}
									if($iv_membership_payment_terms=='yes'){
									?>
								<script>
					
									jQuery(function(){
										jQuery('#paypal_form').submit(function(e){
																									

										if (!jQuery('#check_terms').is(':checked')) {
											e.preventDefault();
											jQuery("#error_message").html("Please read our terms & conditions");
																									}
										});
									});
								</script>	
								<div class="row">
									<div class="col-md-4 col-xs-4 col-sm-4 "> 
									</div>
											<div class="col-md-8 col-xs-8 col-sm-8 "> 
										<label>
										  <input type="checkbox" name="check_terms" id="check_terms"> <?php echo $term_text; ?>
										</label>
										<div class="text-danger" id="error_message" > </div>
									  </div>									
								</div>
																				
								<?php
								}	 
										 
								?>	
																	
						<div class="row">
							<div class="col-md-4 col-xs-4 col-sm-4 "> 
							</div>
							<div class="col-md-8 col-xs-8 col-sm-8 "> 
							
							<div id="paypal-button">
								<?php 
								 if($package_amount=="0"){ ?>
									<button  id="submit_iv_membership_payment"  type="submit" class="btn btn-info ctrl-btn"  > Submit </button>
								<?php
								}else{
								?>
								<button  id="submit_iv_membership_payment"  type="submit" class="btn btn-info ctrl-btn"  > Payment by Paypal</button>
								<?php 
									}
								?>
								
							</div>	
							
							</div>										
						</div>		
						
						</form>
																		</div>	
																</div>
																<br/>
															<?php	
											}	
										if($iv_gateway=='authorize'){
																
												echo '<input type="hidden" name="form_reg" id="form_reg" value="">';
																
												echo do_shortcode('[iv_membership_payment_form]');
										}
															
													?>
														
															<div class="pull-left">
																
																<button   type="button" onclick="return goto_reg_page();" class="btn btn-info ctrl-btn"  > Previous</button>
																
																
															</div>	
															<?php
									if($iv_gateway!='paypal-express'){ ?>
											<div class="pull-right">
												<button  id="submit_iv_membership_payment"  type="button" class="btn btn-success ctrl-btn"  > Submit</button>
												</div>	
											<?php
									}
															?>
										
										</div>
									<div class="tab-pane fade" id="Thank">
										
										<h3>Thank  You </h3>
									
									</div>
							
						</div>
					</div>
            </div>
            
		
			


	</div>
</div>
<script>
function goto_reg_page(){
	jQuery('.nav-tabs a[href="#user_reg"]').tab('show');
}


jQuery(document).ready(function() {
    jQuery('#coupon_name').on('keyup change', function() {
				
				var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
				var search_params={
					"action"  			: "iv_membership_check_coupon",	
					"coupon_code" 		:jQuery("#coupon_name").val(),
					"package_id" 		:jQuery("#package_id").val(),
					"package_amount" 	:'<?php echo $package_amount; ?>',
					"api_currency" 		:'<?php echo $api_currency; ?>',
					
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
						
						jQuery('#total').html(response.gtotal);
						jQuery('#discount').html(response.dis_amount);
					}
				});
	});
});
</script>	

