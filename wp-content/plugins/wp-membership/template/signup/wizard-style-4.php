<?php
global $wpdb;
wp_enqueue_style('wp-iv_membership-style-11', WP_iv_membership_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_script('iv_membership-script-12', WP_iv_membership_URLPATH . 'admin/files/js/bootstrap.min.js');
wp_enqueue_style('wp-iv_membership-style-13', WP_iv_membership_URLPATH . 'admin/files/css/form-wizard-style-1.css');

$api_currency= 'USD';
if( get_option('_iv_membership_api_currency' )!=FALSE ) {
	$api_currency= get_option('_iv_membership_api_currency' );
}	
if(isset($_REQUEST['payment_gateway'])){
	
		$payment_gateway=$_REQUEST['payment_gateway'];
		if($payment_gateway=='paypal'){
			//require_once(WP_iv_membership_DIR . '/admin/pages/payment-inc/paypal-submit.php');
							
		}
}

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
  <style>
  body {
    font-family: Roboto;
    font-weight: normal;
    font-style: normal;
    font-size: 14px;
    line-height: 22px;
  }
  #iv-form3 h2{
    font-family: 'Oswald', sans-serif;
    font-weight: 400;
    font-size: 32px;
    line-height: 45px;
    margin-top: 0;
    
  }
  #iv-form3 h1 span{
    font-weight: 100;
    
  }
  #iv-form3 h1{
    font-family: 'Oswald', sans-serif;
    font-weight: 400;
    font-size: 45px;
    line-height: 45px;
    color: #fff;
    border: none;
    text-transform: uppercase;
    line-height: 50px;
    padding-bottom: 0;
    font-size: 45px;
  }

  #iv-form3 h3 {
  font-family: Oswald;
  font-size: 16px;
  font-weight: normal;
  font-style: normal;
  margin-top:40px;
  }
  #iv-form3 p{
    font-size: 1em;
    font-family: 'Roboto', sans-serif;
    color: #575757;
    font-weight: 400;
    line-height: 22px;
  }
   #iv-form3 .header-profile span{
	border-bottom: 5px solid #ffb400;    
    padding-bottom: 15px;
    margin-bottom: 20px;
	}
 </style> 

<div class="bootstrap-wrapper">
	<div id="iv-form3" class="container-fluid">
		
		
		<div class="row">	
              <div class="col-md-2 ">
              </div>
           
              <div class="col-md-8 "> 
				<h2 class="header-profile"><span>User Info</span></h2>
              </div>
         </div>
		 <br/>
		<div class="row">	
              <div class="col-md-2 ">
              </div>
           
              <div class="col-md-8 "> 
				<?php
				if(isset($_REQUEST['message-error'])){?>
				<div class="row alert alert-info alert-dismissable" id='loading-2'><a class="panel-close close" data-dismiss="alert">x</a> User or Email exists</div>
				<?php
				}
				?>
				 <?php echo do_shortcode('[iv_membership_registration_form]'); ?>	
              </div>
         </div>
		
		 <br/>
		<div class="row">	
              <div class="col-md-2 ">
              </div>
           
              <div class="col-md-8 "> 
				<h2 class="header-profile"><span>Payment Info</span></h2>
              </div>
         </div>
		 <br/>		
		
		<div class="row">	
              <div class="col-md-2 ">
              </div>
           
             <div class="col-md-8 ">
				<?php
															
						if($iv_gateway=='paypal-express'){
						 ?>
								
									<form name ='paypal_form' id ='paypal_form' class="form-horizontal" action="<?php  the_permalink() ?>?package_id=<?php echo $package_id; ?>&payment_gateway=paypal&iv-submit-listing=register" method="post" role="form">
									
										
										<div class="row form-group">
										<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Package Name</label>
										<div class="col-md-6 col-xs-4 col-sm-8 "> 																				
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
												echo '<label class="control-label"> '.$package_name.'</label>';
												
											}
											
											
											 ?>
											</div>
										
										</div>
							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Amount</label>
								
								<div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount"> <label class="control-label"> <?php echo $package_amount.' '.$api_currency ; ?> </label>
								</div>										
							</div>
							<div class="row form-group">
							<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Discount Coupon</label>
								
								<div class="col-md-6 col-xs-6 col-sm-6 ">  <input type="text" class="form-control" name="coupon_name" id="coupon_name" value="" placeholder="Enter Coupon Code">
								</div>
								<div class="col-md-1 col-xs-1 col-sm-1 pull-left" id="coupon-result"> 
								</div>										
							</div>
							<div class="row">
							<hr>
							</div>
							
							
							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Subtotal</label>
								
								<div class="col-md-8 col-xs-8 col-sm-8 ">  <label class="control-label"> <?php echo $package_amount.' '.$api_currency ; ?></label>
								</div>										
							</div>
							<div class="row">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">(-) Discount</label>
								
								<div class="col-md-8 col-xs-8 col-sm-8 " id="discount">  
								</div>										
							</div>
							<div class="row">
							<hr>
							</div>
							<div class="row">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label">Total</label>												
																				
								<div class="col-md-8 col-xs-8 col-sm-8" id="total"><label class="control-label">  <?php echo $package_amount.''.$api_currency; ?></label>
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
								 if($package_amount=="0" or trim($package_amount)==""  ){ ?>
									<div id="loading-3"></div>
									<button  id="submit_iv_membership_payment"  type="submit" class="btn btn-info ctrl-btn"  > Submit </button>
									
								<?php
								}else{	
									?>
									<div id="loading-3"></div>
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
					if($iv_gateway=='stripe'){
																
						echo 'sssssssssssssssssssssssssssss<input type="hidden" name="form_reg" id="form_reg" value="">';
																
						echo do_shortcode('[iv_membership_stripe_form]');
					}										
				?>
					
									
         </div>		

		
	</div>
</div>
	<script>
								
																		
jQuery(function(){
	var loader_image = '<img src="<?php echo WP_iv_membership_URLPATH. "admin/files/images/loader.gif"; ?>" />';
	
	jQuery('#paypal_form').submit(function(e){
			
			jQuery('#form_reg').val(jQuery("#iv_membership_registration").serialize());  
			jQuery('#loading-2').remove();
			jQuery('#reg_error').val('yes'); 
			//jQuery('#loading').html('');
			
			
						// Registration Form Validation
						
						var form_name = "#iv_membership_registration";
						var valid = 1;
						var succes_mess= "<?php echo get_option('iv_membership_success_message'); ?>";
						var fail_mess= "<?php echo get_option('iv_membership_fail_message'); ?>";
						
						
						
						var values = {};
						jQuery.each(jQuery(form_name).serializeArray(), function(i, field) {
							values[field.name] = field.value;
						});
						jQuery.each(values, function(name,value) {
							var field_name = "[name="+name+"]";
							var label_name = jQuery("[name="+name+"]").parent().prev().text()
							val = jQuery(field_name).attr("required");
							if (typeof val !== "undefined") {
								if(value==""){
									valid =0;
									jQuery(field_name).css("border-color","red");									
									
									jQuery('#loading').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>A required field ('+jQuery.trim(label_name)+') is empty</div>');
									return false;
								}
								else{
									jQuery(field_name).css("border-color","#cccccc");
								}
							}
							if((name.indexOf("iv_member_email") !== -1) && jQuery.trim(value)!=""){
								if(!isValidEmailAddress(jQuery.trim(value))){
									valid =0;
									jQuery(field_name).css("border-color","red");									
									
									jQuery('#loading').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>Email address is invalid.88888</div>');
									return false;
								}
								else{
									jQuery(field_name).css("border-color","#cccccc");
								}
							}
							if((name.indexOf("iv_member_email") !== -1) && jQuery.trim(value)=="" && typeof val === "undefined"){
								jQuery(field_name).css("border-color","#cccccc");
							}
						});
						
						// end validation
						if(valid == 1){
						
							var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
							var search_params={
								
								"action"  : "iv_membership_user_exist_check",
								"form_data":	jQuery("#iv_membership_registration").serialize(), 
							};
							
							jQuery("#loading").html(loader_image);
							jQuery.ajax({					
								url : ajaxurl,								
								dataType : "json",
								type : "post",
								data : search_params,
								success : function(response){
									
									if(response=="success"){
											jQuery("#loading").html(loader_image);
											
											
											jQuery('#form_reg').val(jQuery("#iv_member_form_iv").serialize());  
											 
											valid =1;	
											//jQuery("#theform_contact")[0].reset();
									}else{
									
										valid =0;	
										jQuery('#loading').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response +'.</div>');
										
									
									}								
									if(response=="captcha_error"){
												valid =0;	
												jQuery('#loading').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>Math Error: You have entered an incorrect result value. Please try again.</div>');
												
										
									}
								}
							});
						}
			
			var check_terms='<?php echo $iv_membership_payment_terms; ?>';	
		    if(check_terms=='yes'){			
				if (!jQuery('#check_terms').is(':checked')) {
					valid =0;
																							
					jQuery('#loading').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>Please read our terms & conditions.</div>');					
					jQuery("#error_message").html("Please read terms & conditions");
				}															
			}
			
			if(valid == 0 ){	
						
				e.preventDefault();	
			}else{
				jQuery("#loading-3").html(loader_image);
				jQuery("#loading").html(loader_image);
			}
		// for Success submit
		
		
		
	});
		
});
									
									
									

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
						
						jQuery('#total').html('<label class="control-label">'+response.gtotal +'</label>');
						jQuery('#discount').html('<label class="control-label">'+response.dis_amount +'</label>');
					}
				});
	});
});
</script>	

