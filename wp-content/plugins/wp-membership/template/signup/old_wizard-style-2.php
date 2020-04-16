<?php
global $wpdb;
wp_enqueue_style('wp-iv_membership-reg-style-11', WP_iv_membership_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_script('iv_membership-script-reg-12', WP_iv_membership_URLPATH . 'admin/files/js/bootstrap.min.js');
//wp_enqueue_style('wp-iv_membership-style-13', WP_iv_membership_URLPATH . 'admin/files/css/form-wizard-style-1.css');


wp_enqueue_style('wp-iv_membership-reg-style-2-14', WP_iv_membership_URLPATH . 'admin/files/css/turnjs/jquery.jscrollpane.custom.css');
wp_enqueue_style('wp-iv_membership-reg-style-2-16', WP_iv_membership_URLPATH . 'admin/files/css/turnjs/bookblock.css');
wp_enqueue_style('wp-iv_membership-reg-style-2-17', WP_iv_membership_URLPATH . 'admin/files/css/turnjs/custom.css');


wp_enqueue_script('iv_membership-reg-script-2-16', WP_iv_membership_URLPATH . 'admin/files/js/turnjs/jquery.mousewheel.js');
wp_enqueue_script('iv_membership-reg-script-2-15', WP_iv_membership_URLPATH . 'admin/files/js/turnjs/modernizr.custom.79639.js');

wp_enqueue_script('iv_membership-reg-script-2-20', WP_iv_membership_URLPATH . 'admin/files/js/turnjs/jquery.bookblock.js');
wp_enqueue_script('iv_membership-reg-script-2-17', WP_iv_membership_URLPATH . 'admin/files/js/turnjs/jquery.jscrollpane.min.js');
wp_enqueue_script('iv_membership-reg-script-2-18', WP_iv_membership_URLPATH . 'admin/files/js/turnjs/jquerypp.custom.js');
wp_enqueue_script('iv_membership-reg-script-2-19', WP_iv_membership_URLPATH . 'admin/files/js/turnjs/page.js');


		
		
		

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
		

<!--  TrrnJS Start *********-->
			
				<div id="container-turn" class="container-turn">	

							

							<div class="bb-custom-wrapper">
								<div id="bb-bookblock" class="bb-bookblock">
									<div class="bb-item" id="item1">
											<nav>
													<span   id="bb-nav-prev">&larr;</span>
													<span  id="bb-user-next">&rarr;</span>
											</nav>
										<div class="content">
											<div class="scroller"> 
													
												<br/>
													<div class="row">
															<h2 class="page-header">User Registration</h2>
															<!--Account  -->
																	<?php echo do_shortcode('[iv_membership_registration_form]'); ?>			
																	
																	
																		
																<!--Account  -->
																
																												
														</div>
											</div>											
										</div>										
									</div>
									<div class="bb-item" id="item2">
											<nav>
													<span  id="bb-go-user-prev">&larr;</span>
													<span id="bb-nav-next">&rarr;</span>
											</nav>
										<div class="content">
											<div class="scroller">
											<br/>
												<div class="row">
												<h2 class="page-header">Payment</h2>
														
														
						<?php
															
						if($iv_gateway=='paypal-express'){
						 ?>
																 
							<div class="row">	
								<label for="text" class="col-md-2 control-label"></label>
								<div class="col-md-10 ">
									<form name ='paypal_form' id ='paypal_form'  action="<?php  the_permalink() ?>?package_id=<?php echo $package_id; ?>&payment_gateway=paypal&iv-submit-listing=register" method="post">
										<div class="row">
											<div class="col-md-3 col-xs-3 col-sm-3 "> Package Name 
										</div>
										<div class="col-md-4 col-xs-4 col-sm-4 "> 																				
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
																			<div class="row">
																				<div class="col-md-3 col-xs-3 col-sm-3 "> Amount
																				</div>
																				<div class="col-md-9 col-xs-9 col-sm-9 " id="p_amount">  <?php echo $api_currency.' '.$package_amount; ?>
																				</div>										
																			</div>
																			<div class="row">
																				<div class="col-md-3 col-xs-3 col-sm-3 "> Discount Coupon
																				</div>
																				<div class="col-md-4 col-xs-4 col-sm-4 ">  <input type="text" class="form-control" name="coupon_name" id="coupon_name" value="" placeholder="Enter Coupon Code">
																				</div>
																				<div class="col-md-1 col-xs-1 col-sm-1 pull-left" id="coupon-result"> 
																				</div>										
																			</div>
																			<div class="row">
																			<hr>
																			</div>
																			<div class="row">
																				<div class="col-md-3 col-xs-3 col-sm-3"> Subtotal
																				</div>
																				<div class="col-md-9 col-xs-9 col-sm-9 ">  <?php echo $api_currency.' '.$package_amount; ?>
																				</div>										
																			</div>
																			<div class="row">
																				<div class="col-md-3 col-xs-3 col-sm-3 ">(-) Discount
																				</div>
																				<div class="col-md-9 col-xs-9 col-sm-9 " id="discount">  --
																				</div>										
																			</div>
																			<div class="row">
																			<hr>
																			</div>
																			<div class="row">
																				<div class="col-md-3 col-xs-3 col-sm-3 "> Total
																				</div>
																				<div class="col-md-9 col-xs-9 col-sm-9 " id="total">  <?php echo $api_currency.' '.$package_amount; ?>
																				</div>										
																			</div>
																					<input type="hidden" name="form_reg" id="form_reg" value="">
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
																						<div class="col-md-3 col-xs-3 col-sm-3 ">
																						</div>
																							<div class="checkbox col-md-9 col-xs-9 col-sm-9">
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
																				<div class="col-md-3 col-xs-3 col-sm-3 "> 
																				</div>
																				<div class="col-md-9 col-xs-9 col-sm-9 "> <button  id="submit_iv_membership_payment"  type="submit" class="btn btn-info ctrl-btn"  > Payment by Paypal</button>
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
															
															
															if($iv_gateway!='paypal'){ ?>
																<div class="pull-right">
																	<button  id="submit_iv_membership_payment"  type="button" class="btn btn-success ctrl-btn"  > Submit</button>
																</div>	
															<?php
																}
															?>
											</div>
										</div>
										</div>
									</div>
									<div class="bb-item" id="item3">
											<nav>
													<span  id="bb-paypant-page">&larr;</span>
													
											</nav>
										<div class="content">
											<div class="scroller">
												<h2 class="page-header">Thank You</h2>
												<p>The origin of the honeymoon is not generally known.</p>

												<p>The Saxons long and long ago got up the delightful occasion. Amongst the
												ancient Saxons and Teutons a beverage was made of honey and water, and
												sometimes flavored with mulberries. This drink was used especially at
												weddings and the after festivals. These festivals were kept up among the
												nobility sometimes for a month--"monath." The "hunig monath" was thus
												established, and the next moon after the marriage was called the
												honeymoon.</p>								

												<p><em>From <a href="http://www.gutenberg.org/ebooks/41595" target="_blank">"The Funny Side of Physic"</a> by A. D. Crabtre</em></p>
											</div>
										</div>
									</div>
									
									</div>
								
								
								
									

							</div>								
						</div><!-- /container -->
						
					<!--  TrrnJS End *********-->
					
		</div>
</div>			
					
<script>
	
	jQuery(function() {

				Page.init();

	});
	jQuery(function() {
             
		jQuery( '#bb-bookblock' ).bookblock();
 
	});
	function go_next_user_page(){	
			Page.init();	
			jQuery( '#bb-bookblock' ).bookblock( 'next' );
	}
	
	
			
			
</script>
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

