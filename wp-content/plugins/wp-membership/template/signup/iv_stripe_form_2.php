<?php
// wp_enqueue_style('wp-iv_membership-style-13', WP_iv_membership_URLPATH . 'admin/files/css/require 'lib/Stripe.php';';
$newpost_id='';
$post_name='iv_membership_stripe_setting';
$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE post_name = '".$post_name."' ");
			if(sizeof($row )>0){
			  $newpost_id= $row->ID;
			}
$stripe_mode=get_post_meta( $newpost_id,'iv_membership_stripe_mode',true);	
if($stripe_mode=='test'){
	$stripe_publishable =get_post_meta($newpost_id, 'iv_membership_stripe_publishable_test',true);	
}else{
	$stripe_publishable =get_post_meta($newpost_id, 'iv_membership_stripe_live_publishable_key',true);	
}

?>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<div id="payment-errors"></div>

			<div class="row form-group">
										<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Package Name','wpmembership');?></label>
										<div class="col-md-8 col-xs-4 col-sm-8 "> 																				
											<?php
											 if( $package_name==""){													

												$sql="SELECT * FROM $wpdb->posts WHERE post_type = 'iv_membership_pack'  and post_status='draft' ";
												$membership_pack = $wpdb->get_results($sql);
												$total_package=count($membership_pack);
												//echo'$total_package.....'.$total_package;
												if(sizeof($membership_pack)>0){
													$i=0;
													echo'<select name="package_sel" id ="package_sel" class=" form-control">';
													
													foreach ( $membership_pack as $row )
													{	
														
														echo '<option value="'. $row->ID.'" >'. $row->post_title.'</option>';
														if($i==0){$package_id=$row->ID;}
														$i++;
													}	
																		
													echo '</select>';	
													$package_id= $membership_pack[0]->ID;
													$recurring= get_post_meta($package_id, 'iv_membership_package_recurring', true);	
													if($recurring == 'on'){
														$package_amount=get_post_meta($package_id, 'iv_membership_package_recurring_cost_initial', true);
													}else{
														$package_amount=get_post_meta($package_id, 'iv_membership_package_cost',true);
													}	
													
													?>
									
													<?php
												}	
													
												
											 }else{
												echo '<label class="control-label"> '.$package_name.'</label>';
												$recurring= get_post_meta($package_id, 'iv_membership_package_recurring', true);
												if($recurring == 'on'){
														$package_amount=get_post_meta($package_id, 'iv_membership_package_recurring_cost_initial', true);
													}else{
														$package_amount=get_post_meta($package_id, 'iv_membership_package_cost',true);
												}
												
											}
											
											
											 ?>
											</div>
										
										</div>
							<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Amount','wpmembership');?></label>
								
								<div class="col-md-8 col-xs-8 col-sm-8 " id="p_amount"> <label class="control-label"> <?php echo $package_amount.' '.$api_currency ; ?> </label>
								</div>										
							</div>
							<?php
								
							 if( get_option('_iv_membership_payment_coupon')==""){
							?>
							<div class="row form-group" id="show_hide_div">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
								<div class="col-md-8 col-xs-8 col-sm-8 " > 
									<button type="button" onclick="show_coupon();"  class="btn btn-default center"><?php  _e('Have a coupon?','wpmembership');?></button>
								</div>
							</div>
							<?php
								require_once(WP_iv_membership_template.'signup/coupon_form_2.php');
							
							}
							?>
							<?php
							if($tax_active_module=='yes'){
							?>
							<div class="row form-group">
								<label for="text" class="col-md-4 control-label"><?php  esc_html_e('Vat/Tax','wpmembership');?></label>												
																				
								<div class="col-md-8" id="tax">  
									
									<?php 
										$tax_total=0;
										$tax_type= get_option('_iv_tax_type');
										$tax_active_module=get_option('_iv_membership_active_tax');
										
										if($tax_active_module=='' ){ $tax_active_module='yes';	}					
										if($tax_type==''){$tax_type='country';}
											
										if($tax_active_module=='yes' AND $tax_type=='country'){						
											$countries_tax_array= (get_option('_iv_countries_tax')!="" ? get_option('_iv_countries_tax') : array() );
											$country_id= (isset($first_country)? $first_country:'0');
											if(array_key_exists($country_id , $countries_tax_array)){							
												 $country_tax_value= $countries_tax_array[$country_id];
												 $tax_total=$package_amount * $country_tax_value/100;
											}
										}
										if($tax_active_module=='yes' AND $tax_type=='common'){						
											$common_tax_value= get_option('_iv_comman_tax_value');						
											$tax_total=$package_amount * $common_tax_value/100;
											
										}
													echo '<label class="control-label">'.$tax_total.''.$api_currency.'</label>'; 
										
										?>
								</div>										
							</div>
							<?php
							}	
							?>
							<div class="row">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Total','wpmembership');?></label>												
																				
								<div class="col-md-8 col-xs-8 col-sm-8" id="total"><label class="control-label">  <?php echo $package_amount.''.$api_currency; ?></label>
								</div>										
							</div>
							
			<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Card Number','wpmembership');?></label> 
								<div class="col-md-8 col-xs-8 col-sm-8 " >  
									<input type="text" name="card_number" id="card_number"  data-validation="creditcard required"  class="form-control ctrl-textbox" placeholder="<?php  _e('Enter card number','wpmembership');?>"  data-validation-error-msg="<?php  _e('Card number is not correct','wpmembership');?>" >
			</div>										
			</div>
		<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Card CVV','wpmembership');?> </label>
								<div class="col-md-8 col-xs-8 col-sm-8 " >  
									<input type="text" name="card_cvc" id="card_cvc" class="form-control ctrl-textbox"   data-validation="number" 
data-validation-length="2-6" data-validation-error-msg="<?php  _e('CVV number is not correct','wpmembership');?>" placeholder="<?php  _e('Enter card CVC','wpmembership');?>" >
			</div>
		</div>	
		<div class="row form-group">
								<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"><?php  _e('Expiration (MM/YYYY)','wpmembership');?></label>
								<div class="col-md-4 col-xs-4 col-sm4" >  
								
									<select name="card_month" id="card_month"  class="card-expiry-month stripe-sensitive required form-control">
										<option value="01" selected="selected">01</option>
										<option value="02">02</option>
										<option value="03">03</option>
										<option value="04">04</option>
										<option value="05">05</option>
										<option value="06">06</option>
										<option value="07">07</option>
										<option value="08">08</option>
										<option value="09">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12" selected >12</option>
									  </select>
								</div>
							<div class="col-md-4 col-xs-4 col-sm-4 " >  
									 <select name="card_year"  id="card_year"  class="card-expiry-year stripe-sensitive  form-control">
									  </select>
									  <script type="text/javascript">
										var select = jQuery(".card-expiry-year"),
										year = new Date().getFullYear();
							 
										for (var i = 0; i < 12; i++) {
											select.append(jQuery("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
										}
									</script> 
								</div>								
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
											  <input type="checkbox" data-validation="required" 
			 data-validation-error-msg="You have to agree to our terms "  name="check_terms" id="check_terms"> <?php echo $term_text; ?>
											</label>
										<div class="text-danger" id="error_message" > </div>
									  </div>									
								</div>
																				
								<?php
								}	 
										 
								?>	
			<input type="hidden" name="package_id" id="package_id" value="<?php echo $package_id; ?>">	
			<input type="hidden" name="form_reg" id="form_reg" value="">
			<input type="hidden" name="action" value="stripe"/>
			<input type="hidden" name="redirect" value="<?php echo get_permalink(); ?>"/>
			<input type="hidden" name="stripe_nonce" value="<?php echo wp_create_nonce('stripe-nonce'); ?>"/>
			
		
			<div class="row form-group">
				<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label>
				<div class="col-md-8 col-xs-8 col-sm-8 " > 
				 <div id="loading-3" style="display: none;"><img src='<?php echo WP_iv_membership_URLPATH. 'admin/files/images/loader.gif'; ?>' /></div>
					<button  id="submit_iv_membership_payment"  type="submit" class="btn btn-info ctrl-btn"  > <?php  _e('Submit','wpmembership');?> </button>
				</div>
		</div>	
	

		
		
