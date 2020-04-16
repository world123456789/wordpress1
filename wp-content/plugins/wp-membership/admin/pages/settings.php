<?php
wp_enqueue_style('wp-iv_membership-style-13', WP_iv_membership_URLPATH . 'admin/files/css/form-wizard-style-1.css');
global $wpdb;
?>
<style>
.bs-callout {
    margin: 20px 0;
    padding: 15px 30px 15px 15px;
    border-left: 5px solid #eee;
}
.bs-callout-info {
    background-color: #E4F1FE;
    border-color: #22A7F0;
}
.html-active .switch-html, .tmce-active .switch-tmce {
	height: 28px!important;
	}
	.wp-switch-editor {
		height: 28px!important;
	}
</style>	
	
<div class="bootstrap-wrapper">
	<div class="container-fluid">
		
		<br/>
		<div id="update_message"> </div>
		  <div class="panel with-nav-tabs panel-info">
					<div class="panel-heading">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#page" data-toggle="tab">Page Setting</a></li>
								<li ><a href="#protected_page" data-toggle="tab">Blocked URL</a></li>
								<li><a href="#payment" data-toggle="tab">Payment Page</a></li>
								<li><a href="#email" data-toggle="tab">Email Setting</a></li>
								<li ><a href="#reminder_email" data-toggle="tab">Reminder Email </a></li>
								<li><a href="#mailchimp" data-toggle="tab">MailChimp Setting</a></li>
								<li ><a href="#user_reg" data-toggle="tab">Page Redirect</a></li>
								<li ><a href="#user_post" data-toggle="tab">Post Setting</a></li>								
								
								<li ><a href="#tax" data-toggle="tab">Tax</a></li>
								
								
							</ul>
					</div>
					<div class="panel-body">
						<div class="tab-content">
								<div class="tab-pane fade " id="reminder_email">								
									<?php
										require_once (WP_iv_membership_DIR .'/admin/pages/reminder_email.php');
									?>
								</div>
								<div class="tab-pane fade " id="protected_page">								
									<?php
										require (WP_iv_membership_DIR .'/admin/pages/protected_page.php');
									?>
								</div>
								
								
								
								<div class="tab-pane fade " id="user_post">
									<form class="form-horizontal" role="form"  name='post_settings' id='post_settings'>
									<?php
										$args = array(
											   'public'   => true,
											   '_builtin' => false
											);

											$output = 'names'; // names or objects, note names is the default
											$operator = 'and'; // 'and' or 'or'

											$post_types = get_post_types( $args, $output, $operator ); 
											/*
											foreach ( $post_types  as $post_type ) {

											   echo '<p>====' . $post_type . '</p>';
											}
											$taxonomy = 'genre';
											$tax_terms = get_terms($taxonomy);
											
											foreach ($tax_terms as $tax_term) {
											echo '<li>0000' . '<a href="' . esc_attr(get_term_link($tax_term, $taxonomy)) . '" title="' . sprintf( __( "View all posts in %s" ), $tax_term->name ) . '" ' . '>' . $tax_term->name.'</a></li>';
											}
											*/
												?>
											
											<div class="form-group">
												<h3  class="col-md-12   page-header">My Account And Public Profile Post Type </h3>
												
											</div>
												
											<div class="form-group">
												<label  class="col-md-3   control-label">Post type: </label>
													<div class="checkbox col-md-3 ">														
													<?php
														$iv_post = get_option( '_iv_membership_profile_post');
														echo "<select id='client_post_type' name='client_post_type' class='form-control'>";
														 echo "<option value='post' ".($iv_post=='post'? 'selected':'').">Post</option>";
														 
														foreach ( $post_types  as $post_type ) {
															if($post_type!='iv_payment'){
															echo "<option value='{$post_type}' ".($iv_post==$post_type? 'selected':'').">{$post_type}</option>";									
														  }
														}
														echo "</select>";
													
													?>
														
													 </div>
											</div>	
											<div class="form-group">
											<label  class="col-md-3 control-label"> </label>
											<div class="col-md-8">
												
												<button type="button" onclick="return  iv_update_post_settings();" class="btn btn-success">Update</button>
											</div>
										</div>
												
									</form>
								</div>	
								
						
									<div class="tab-pane fade " id="user_reg">
									<form class="form-horizontal" role="form"  name='account_settings' id='account_settings'>
										<br/>
										
											
											<?php
												$args = array(
															'child_of'     => 0,
															'sort_order'   => 'ASC',
															'sort_column'  => 'post_title',
															'hierarchical' => 1,															
															'post_type' => 'page'
															);
												?>
																<div class="form-group">
																	<label  class="col-md-3   control-label">User Registration Page Redirect: </label>
																	
																
																		<div class="checkbox col-md-3 ">
																			
																		<?php
																			$iv_redirect = get_option( 'iv_membership_signup_redirect');
																			
																		 if ( $pages = get_pages( $args ) ){
																			echo "<select id='signup_redirect' name='signup_redirect' class='form-control'>";
																			 echo "<option value='defult' ".($iv_redirect=='defult' ? 'selected':'').">Defult WP Action</option>";
																			 
																			foreach ( $pages as $page ) {
																			  echo "<option value='{$page->ID}' ".($iv_redirect==$page->ID ? 'selected':'').">{$page->post_title}</option>";
																			}
																			echo "</select>";
																		  }
																		?>
																			
																		 </div>
																		
																		
																</div>
										
																<div class="form-group">
																	<label  class="col-md-3   control-label">User My Account Page Redirect: </label>
																	
																
																		<div class="checkbox col-md-3 ">
																			
																		<?php
																			$iv_redirect = get_option( '_iv_membership_profile_page');
																			
																		 if ( $pages = get_pages( $args ) ){
																			echo "<select id='pri_profile_redirect' name='pri_profile_redirect' class='form-control'>";
																			 echo "<option value='defult' ".($iv_redirect=='defult' ? 'selected':'').">Defult WP Action</option>";
																			 
																			foreach ( $pages as $page ) {
																			  echo "<option value='{$page->ID}' ".($iv_redirect==$page->ID ? 'selected':'').">{$page->post_title}</option>";
																			}
																			echo "</select>";
																		  }
																		?>
																			
																		 </div>
																		
																		
																</div>
															<div class="form-group">
																	<label  class="col-md-3   control-label">User Public Profile Page Redirect: </label>
																	
																
																		<div class="checkbox col-md-3 ">
																			
																		<?php
																			$iv_redirect = get_option( '_iv_membership_profile_public_page');
																			
																		 if ( $pages = get_pages( $args ) ){
																			echo "<select id='profile_redirect' name='profile_redirect' class='form-control'>";
																			 echo "<option value='defult' ".($iv_redirect=='defult' ? 'selected':'').">Defult WP Action</option>";
																			 
																			foreach ( $pages as $page ) {
																			  echo "<option value='{$page->ID}' ".($iv_redirect==$page->ID ? 'selected':'').">{$page->post_title}</option>";
																			}
																			echo "</select>";
																		  }
																		?>
																			
																		 </div>
																		
																		
																</div>
																<div class="form-group">
																	<label  class="col-md-3   control-label">Hide Admin Bar for All Users Except for Administrators: </label>
																	
																
																		<div class=" col-md-3 ">
																			
																		<?php
																			 $hide_admin_bar='';
																			 if( get_option( '_iv_membership_hide_admin_bar' ) ) {
																				  $hide_admin_bar= get_option('_iv_membership_hide_admin_bar'); 
																			 }	 
																			 //echo  $t_terms;
																			?><label>
																		  <input  class="" type="checkbox" name="hide_admin_bar" id="hide_admin_bar" value="yes" <?php echo ($hide_admin_bar=='yes'? 'checked':'' ); ?> > 
																				Hide 
																				</label>
																			
																		 </div>
																		
																		
																</div>
																
																
																
																<div class="form-group">
																	<label  class="col-md-3 control-label"> </label>
																	<div class="col-md-8">
																		
																		<button type="button" onclick="return  iv_update_account_settings();" class="btn btn-success">Update</button>
																	</div>
																</div>
									</form>			
									
									</div>
							
										<div class="tab-pane fade " id="payment">
											<!--Payment  -->
														<form class="form-horizontal" role="form"  name='payment_settings' id='payment_settings'>
																
																<div class="form-group">
																	<label  class="col-md-2   control-label">Terms CheckBox : </label>
																	
																	<div class="col-md-10 col-xs-10 col-sm-10">
																				<div class="checkbox col-md-1 ">
																					<label><?php
																						 $t_terms='';
																						 if( get_option( 'iv_membership_payment_terms' ) ) {
																							  $t_terms= get_option('iv_membership_payment_terms'); 
																						 }	 
																						 //echo  $t_terms;
																						?>
																					  <input type="checkbox" name="iv_terms" id="iv_terms" value="yes" <?php echo ($t_terms=='yes'? 'checked':'' ); ?> > Dispaly
																					</label>
																				  </div>
																		  
																			
																			<div class=" col-md-6 col-xs-6 col-sm-6">	
																			<?php
																			 $t_text='I have read & accept the <a href="#"> Terms & Conditions</a>';
																			 if( get_option( 'iv_membership_payment_terms_text' ) ) {
																				  $t_text= get_option('iv_membership_payment_terms_text'); 
																			 }	 
																			 
																			?>																			
																				<textarea class="form-control" rows="3" name='terms_detail' id='terms_detail' >  <?php echo $t_text; ?></textarea>
																			</div>
																			
																	</div>
																	
																	
																</div>
																	<div class="form-group">
																	<label  class="col-md-2   control-label">Hide Coupon Buton : </label>
																	
																	<div class="col-md-10 col-xs-10 col-sm-10">
																				<div class="checkbox col-md-1 ">
																					<label><?php
																						 $t_coupon='';
																						 if( get_option( '_iv_membership_payment_coupon' ) ) {
																							  $t_coupon= get_option('_iv_membership_payment_coupon'); 
																						 }	 
																						 //echo  $t_terms;
																						?>
																					  <input type="checkbox" name="iv_coupon" id="iv_coupon" value="yes" <?php echo ($t_coupon=='yes'? 'checked':'' ); ?> > Hide
																					</label>
																				  </div>
																	</div>
																	
																	
																</div>
															
																
																<div class="form-group  row">
																	<label  class="col-md-3  control-label"> </label>
																	<div class="col-md-4">
																		<button type="button" onclick="return  iv_update_payment_settings();" class="btn btn-success">Update</button>				
																	 </div>							
																</div>
													</form>
													
										
										</div>
									<div class="tab-pane fade in active" id="page">
										
										
										<form class="form-horizontal" role="form"  name='page_settings' id='page_settings'>
																<?php
										$price_table=get_option('_iv_membership_price_table'); 
										$registration=get_option('_iv_membership_registration'); 
										$profile_page=get_option('_iv_membership_profile_page'); 	
										$profile_public=get_option('_iv_membership_profile_public_page');
										$login_page=get_option('_iv_membership_login_page');  										
										$thank_you=get_option('_iv_membership_thank_you_page'); 	

														$args = array(
															'child_of'     => 0,
															'sort_order'   => 'ASC',
															'sort_column'  => 'post_title',
															'hierarchical' => 1,															
															'post_type' => 'page'
															);
																?>
																<div class="form-group">
																	<label  class="col-md-2   control-label">Price Listing: </label>
																	
																	<div class="col-md-10 col-xs-10 col-sm-10">
																		<div class="checkbox col-md-4 ">
																			
																			<?php
																			
																		 if ( $pages = get_pages( $args ) ){
																			echo "<select id='pricing_page' name='pricing_page' class='form-control'>";
																			foreach ( $pages as $page ) {
																			  echo "<option value='{$page->ID}' ".($price_table==$page->ID ? 'selected':'').">{$page->post_title}</option>";
																			}
																			echo "</select>";
																		  }
																		?>
																			
																		 </div>
																		 <div class="checkbox col-md-1 ">
																		 <?php
																				
																				$reg_page= get_permalink( $price_table); 
																				?>
																				 <a class="btn btn-info " href="<?php  echo $reg_page; ?>"> View</a>
																		 </div>
																	</div>	
																</div>
															<div class="form-group">
																	<label  class="col-md-2   control-label">User Sign Up: </label>
																	
																	<div class="col-md-10 col-xs-10 col-sm-10">
																		<div class="checkbox col-md-4 ">
																			<?php
																					
																				 if ( $pages = get_pages( $args ) ){
																					echo "<select id='signup_page' name='signup_page' class='form-control'>";
																					foreach ( $pages as $page ) {
																					  echo "<option value='{$page->ID}' ".($registration==$page->ID ? 'selected':'').">{$page->post_title}</option>";
																					}
																					echo "</select>";
																				  }
																		?>
																		 </div>
																		 <div class="checkbox col-md-1 ">
																			 <?php
																			
																				$reg_page= get_permalink( $registration); 
																				?>
																				 <a class="btn btn-info " href="<?php  echo $reg_page; ?>"> View</a>
																		 </div>
																	</div>	
																</div>
																<div class="form-group">
																	<label  class="col-md-2   control-label">Signup Thanks : </label>
																	
																	<div class="col-md-10 col-xs-10 col-sm-10">
																		<div class="checkbox col-md-4 ">
																				<?php
																				
																			 if ( $pages = get_pages( $args ) ){
																				echo "<select id='thank_you_page'  name='thank_you_page'  class='form-control'>";
																				foreach ( $pages as $page ) {
																				  echo "<option value='{$page->ID}' ".($thank_you==$page->ID ? 'selected':'').">{$page->post_title}</option>";
																				}
																				echo "</select>";
																			  }
																			?>
																		 </div>
																		 <div class="checkbox col-md-1 ">
																			  <?php
																				
																				$reg_page= get_permalink( $thank_you); 
																				?>
																				 <a class="btn btn-info " href="<?php  echo $reg_page; ?>"> View</a>
																		
																		 </div>
																	</div>	
																</div>
																<div class="form-group">
																	<label  class="col-md-2   control-label">Login Page: </label>
																	
																	<div class="col-md-10 col-xs-10 col-sm-10">
																		<div class="checkbox col-md-4 ">
																				<?php
																				
																			 if ( $pages = get_pages( $args ) ){
																				echo "<select id='login_page'  name='login_page'  class='form-control'>";
																				foreach ( $pages as $page ) {
																				  echo "<option value='{$page->ID}' ".($login_page==$page->ID ? 'selected':'').">{$page->post_title}</option>";
																				}
																				echo "</select>";
																			  }
																			?>
																		 </div>
																		 <div class="checkbox col-md-1 ">
																		  <?php
																				
																				$reg_page= get_permalink( $login_page); 
																				?>
																				 <a class="btn btn-info " href="<?php  echo $reg_page; ?>"> View</a>
																		 </div>
																	</div>	
																</div>
																<div class="form-group">
																	<label  class="col-md-2   control-label">User My Account : </label>
																	
																	<div class="col-md-10 col-xs-10 col-sm-10">
																		<div class="checkbox col-md-4 ">
																				<?php
																				
																			 if ( $pages = get_pages( $args ) ){
																				echo "<select id='profile_page'  name='profile_page'  class='form-control'>";
																				foreach ( $pages as $page ) {
																				  echo "<option value='{$page->ID}' ".($profile_page==$page->ID ? 'selected':'').">{$page->post_title}</option>";
																				}
																				echo "</select>";
																			  }
																			?>
																		 </div>
																		 <div class="checkbox col-md-1 ">
																		  <?php
																				
																				$reg_page= get_permalink( $profile_page); 
																				?>
																				 <a class="btn btn-info " href="<?php  echo $reg_page; ?>"> View</a>
																		 </div>
																	</div>	
																</div>
																
																<div class="form-group">
																	<label  class="col-md-2   control-label">User Public Profile: </label>
																	
																	<div class="col-md-10 col-xs-10 col-sm-10">
																		<div class="checkbox col-md-4 ">
																				<?php
																				
																			 if ( $pages = get_pages( $args ) ){
																				echo "<select id='profile_public'  name='profile_public'  class='form-control'>";
																				foreach ( $pages as $page ) {
																				  echo "<option value='{$page->ID}' ".($profile_public==$page->ID ? 'selected':'').">{$page->post_title}</option>";
																				}
																				echo "</select>";
																			  }
																			?>
																		 </div>
																		 <div class="checkbox col-md-1 ">
																		 <?php
																				
																				$reg_page= get_permalink( $profile_public); 
																				?>
																				 <a class="btn btn-info " href="<?php  echo $reg_page; ?>"> View</a>
																		 </div>
																	</div>	
																</div>
																
																
																
																
															<div class="form-group">
																	<label  class="col-md-2   control-label"> </label>
																	
																	<div class="col-md-10 col-xs-10 col-sm-10">
																		<div class="checkbox col-md-4  ">
																			<button type="button" onclick="return  iv_update_page_settings();" class="btn btn-success">Update</button>
																		 </div>
																		 <div class="checkbox col-md-1 ">
																		
																		 </div>
																	</div>	
																</div>	
																
																
													</form>
									
									</div>
									<div class="tab-pane fade" id="email">
											<div class="row pull-right">
												<div class="col-md-12 ">

													 <button type="button" onclick="return  iv_update_email_settings();" class="btn btn-success">Update Email Setting</button>					</div>							
											</div>	
									<form class="form-horizontal" role="form"  name='email_settings' id='email_settings'>	
										<?php
										
										$form_id='';
										$form_name='iv_membership_account_form';
										$form_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '" . $form_name . "' ORDER BY `ID` DESC");
	
										?>
										<div class="form-group">
												<label  class="col-md-2  control-label"> Email Sender : </label>
												<div class="col-md-4 ">
													

													<?php
													$admin_email_setting='';
													if( get_option( 'admin_email_iv_membership' )==FALSE ) {
																$admin_email_setting = get_option('admin_email');						 
													}else{
														$admin_email_setting = get_option('admin_email_iv_membership');								
													}	
													 
													?>
													<input type="text" class="form-control" id="iv_membership_admin_email" name="iv_membership_admin_email" value="<?php echo $admin_email_setting; ?>" placeholder="">
												
											</div>
											
										</div>	
										<div class="form-group">
												<h3  class="col-md-12   page-header">Signup / Forget password Email </h3>
												
										</div>
										
										<div class="form-group">
												<label  class="col-md-2   control-label"> Email Subject : </label>
												<div class="col-md-4 ">
													
														<?php
														$iv_membership_signup_email_subject = get_option( 'iv_membership_signup_email_subject');
														?>
														<input type="hidden" name="signup_form_id" value="<?php echo $form_id; ?>">
														<input type="text" class="form-control" id="iv_membership_signup_email_subject" name="iv_membership_signup_email_subject" value="<?php echo $iv_membership_signup_email_subject; ?>" placeholder="Enter signup email subject">
												
											</div>
										</div>
										<div class="form-group">
												<label  class="col-md-2   control-label"> Email Tempalte : </label>
												<div class="col-md-10 ">
																							<?php
															$settings_a = array(															
																'textarea_rows' =>20,															 
																);
															$content_client = get_option( 'iv_membership_signup_email');
															$editor_id = 'signup_email_template';
															//wp_editor( $content_client, $editor_id,$settings_a );	
																								
															?>
															<textarea id="signup_email_template" name="signup_email_template" rows="20" class="col-md-12 "><?php echo $content_client; ?>
										</textarea>
															

											</div>
										</div>
												<div class="form-group">
												<label  class="col-md-2   control-label"> Forget Subject : </label>
												<div class="col-md-4 ">
													
														<?php
														$iv_membership_forget_email_subject = get_option( 'iv_membership_forget_email_subject');
														?>
														<input type="hidden" name="forget_form_id" value="<?php echo $form_id; ?>">
														<input type="text" class="form-control" id="iv_membership_forget_email_subject" name="iv_membership_forget_email_subject" value="<?php echo $iv_membership_forget_email_subject; ?>" placeholder="Enter forget email subject">
												
											</div>
										</div>
										<div class="form-group">
												<label  class="col-md-2   control-label"> Forget Tempalte : </label>
												
												<div class="col-md-10 ">
																<?php
															$settings_forget = array(															
																'textarea_rows' =>'20',	
																'editor_class'  => 'form-control',														 
																);
															$content_client = get_option( 'iv_membership_forget_email');
															$editor_id = 'forget_email_template';
															//wp_editor( $content_client, $editor_id,$settings_forget );										
															?>
															
															<textarea id="forget_email_template" name="forget_email_template" rows="20" class="col-md-12 "><?php echo $content_client; ?>
														</textarea>

											</div>
										</div>
										<div class="form-group">
												<h3  class="col-md-12 col-xs-12 col-sm-12  page-header">Order Email </h3>
												
										</div>
										
										<div class="form-group">
												<label  class="col-md-2   control-label"> User Email Subject : </label>
												<div class="col-md-4 ">
													
														<?php
														$iv_membership_order_email_subject = get_option( 'iv_membership_order_client_email_sub');
														?>
														<input type="text" class="form-control" id="iv_membership_order_email_subject" name="iv_membership_order_email_subject" value="<?php echo $iv_membership_order_email_subject; ?>" placeholder="Enter order email subject">
												
											</div>
										</div>
										<div class="form-group">
												<label  class="col-md-2   control-label"> User Email Tempalte : </label>
												<div class="col-md-10 ">
																							<?php
															$settings_a = array(															
																'textarea_rows' =>20,															 
																);
															$content_client = get_option( 'iv_membership_order_client_email');
															$editor_id = 'order_client_email_template';
															//wp_editor( $content_client, $editor_id,$settings_a );										
															?>
															<textarea id="order_client_email_template" name="order_client_email_template" rows="20" class="col-md-12 "><?php echo $content_client; ?></textarea>


											</div>
										</div>
										
										<div class="form-group">
												<label  class="col-md-2   control-label"> Admin Email Subject : </label>
												<div class="col-md-4 ">
													
														<?php
														$iv_membership_order_admin_email_subject = get_option( 'iv_membership_order_admin_email_sub');
														?>
														<input type="text" class="form-control" id="iv_membership_order_admin_email_subject" name="iv_membership_order_admin_email_subject" value="<?php echo $iv_membership_order_admin_email_subject; ?>" placeholder="Enter order email subject">
												
											</div>
										</div>
										<div class="form-group">
												<label  class="col-md-2   control-label"> Admin Email Tempalte : </label>
												<div class="col-md-10 ">
																							<?php
															$settings_a = array(															
																'textarea_rows' =>20,															 
																);
															$content_client = get_option( 'iv_membership_order_admin_email');
															$editor_id = 'order_admin_email_template';
															//wp_editor( $content_client, $editor_id,$settings_a );										
															?>
															<textarea id="order_admin_email_template" name="order_admin_email_template" rows="20" class="col-md-12 "><?php echo $content_client; ?></textarea>

											</div>
										</div>
										<div class="form-group">
												<h3  class="col-md-12 col-xs-12 col-sm-12  page-header">Subscription Cancellation Email [Admin + User] </h3>												
										</div>
										<div class="form-group">
												<label  class="col-md-2   control-label"> Cancellation Email Subject : </label>
												<div class="col-md-4 ">
													
														<?php
													
															$cancellation_email = get_option( 'iv_membership_cancellation_email');
															if($cancellation_email==""){
																	require_once (WP_iv_membership_DIR .'/install/install-cancellation-email.php');
															}
		
														
														
														$iv_membership_order_admin_email_subject = get_option( 'iv_membership_cancellation_email_sub');
														?>
														<input type="text" class="form-control" id="iv_membership_cancellation_email_sub" name="iv_membership_cancellation_email_sub" value="<?php echo $iv_membership_order_admin_email_subject; ?>" placeholder="Enter order email subject">
												
											</div>
										</div>
										<div class="form-group">
												<label  class="col-md-2   control-label"> Cancellation Email Tempalte : </label>
												<div class="col-md-10 ">
																							<?php
															$settings_a = array(															
																'textarea_rows' =>20,															 
																);
															$content_client = get_option( 'iv_membership_cancellation_email');
															$editor_id = 'cancellation_email_template';
															//wp_editor( $content_client, $editor_id,$settings_a );										
															?>
															<textarea id="iv_membership_cancellation_email" name="iv_membership_cancellation_email" rows="20" class="col-md-12 "><?php echo $content_client; ?></textarea>

											</div>
										</div>
									
									</form>
										<div class="row pull-left">
												<div class="col-md-12 ">

													 <button type="button" onclick="return  iv_update_email_settings();" class="btn btn-success">Update Email Setting</button>					</div>							
											</div>	
										
									
									</div>
									<div class="tab-pane fade" id="mailchimp">
										<form class="form-horizontal" role="form"  name='mailchimp_settings' id='mailchimp_settings'>
												<div class="form-group row">
													<label  class="col-md-3 col-xs-6 col-sm-6 control-label"> MailChimp API Key : </label>
													<div class="col-md-4 col-xs-6 col-sm-6">
														<?php
														$iv_mailchimp_api_key='';
														if( get_option( 'iv_membership_mailchimp_api_key' )==FALSE ) {
																	$iv_mailchimp_api_key = get_option('iv_membership_mailchimp_api_key');						 
														}else{
															$iv_mailchimp_api_key = get_option('iv_membership_mailchimp_api_key');								
														}	
														 
														 
														?>
														<input type="text" class="form-control" id="iv_membership_mailchimp_api_key" name="iv_membership_mailchimp_api_key" value="<?php echo $iv_mailchimp_api_key; ?>" placeholder="">
														<a href="http://admin.mailchimp.com/account/api" target="_blank">Get your API key here.</a>
														
													</div>
												</div>
												<div class="form-group row">
													<label  class="col-md-3 col-xs-6 col-sm-6  control-label">Confirmation Message : </label>
													<div class="col-md-4 col-xs-6 col-sm-6 ">
														<?php
														$iv_membership_mailchimp_confirmation='no';
														if( get_option( 'iv_membership_mailchimp_confirmation' )==FALSE ) {
																	$iv_membership_mailchimp_confirmation = get_option('iv_membership_mailchimp_confirmation');						 
														}else{
															$iv_membership_mailchimp_confirmation = get_option('iv_membership_mailchimp_confirmation');								
														}	
														 
														?>
														<select class="form-control" id="iv_membership_mailchimp_confirmation" name="iv_membership_mailchimp_confirmation">
															<option value="no" <?php echo ($iv_membership_mailchimp_confirmation == 'no' ? 'selected' : '') ?>>Yes</option>
															<option value="yes" <?php echo ($iv_membership_mailchimp_confirmation == 'yes' ? 'selected' : '') ?>>No</option>
														</select>
														
													</div>
												</div>
										<div class="form-group row">	
												<label  class="col-md-3 col-xs-6 col-sm-6 control-label">Mailchimp List : </label>
									<div class="col-md-4 col-xs-6 col-sm-6">
										<?php 
											if( ! class_exists('MCAPI' ) ) {
													require_once(WP_iv_membership_DIR . '/inc/MCAPI.class.php');
												}
												$iv_mailchimp_api_key='';
												if( get_option( 'iv_membership_mailchimp_api_key' )==FALSE ) {
														$iv_mailchimp_api_key = get_option('iv_membership_mailchimp_api_key');						 
												}else{
														$iv_mailchimp_api_key = get_option('iv_membership_mailchimp_api_key');								
												}	
												echo '<select class="form-control" id="iv_membership_mailchimp_list" name="iv_membership_mailchimp_list">';
												if($iv_mailchimp_api_key!=''){
													$iv_form_membership_mailchimp_list=get_option( 'iv_membership_mailchimp_list'); 
													
													$api = new MCAPI($iv_mailchimp_api_key);
													$list_data = $api->lists();
													if($list_data){
														foreach($list_data['data'] as $key => $list) :
															$lists[$list['id']] = $list['name'];
															echo '<option value="'.$list['id'].'" '.($iv_form_membership_mailchimp_list==$list['id']? 'selected': '').'>'.$list['name'].' </option>';
														endforeach;
													}else{
														echo '<option value=" " > Not Available</option>';
													}
													
												}
													
											echo'</select>';
											
											
										?>
										</div>
								</div>
									<div class=" col-md-7  bs-callout bs-callout-info">		
					
									Signup user email address will go to the mailchimp list.<br/>
									Please remove require fields :"First Name", "Last Name" from your mailchimp list setting.
								
									</div>
									<div class="clearfix"></div>
								</form>
												<div class="form-group  row">
													<label  class="col-md-3  control-label"> </label>
													<div class="col-md-4">
														 <button type="button" onclick="return  iv_update_mailchamp_settings();" class="btn btn-success">Update MailChimp Setting</button>					
													 </div>							
												</div>	
							
							</div>
									
										<div class="tab-pane fade " id="tax">
									<form class="form-horizontal" role="form"  name='tax_settings' id='tax_settings'>										
											
											 <div class="form-group">
												<h3  class="col-md-12   page-header"><?php _e('Tax Setting','wpmembership'); ?> </h3>												
											</div>
											
											<?php
											
											$tax_type= get_option('_iv_tax_type');
											$countries_tax_array= get_option('_iv_countries_tax');
											$common_tax_value= get_option('_iv_comman_tax_value');
																		
											$active_module=get_option('_iv_membership_active_tax'); 
											$active_check_y=''; $active_check_n='';
											if($active_module=='yes' )
											{	$active_check_n='';
												$active_check_y=' checked';												
											}else{ 
												$active_check_y='';
												$active_check_n=' checked';											
											}
											if($active_module=='' ){ $active_check_y=' checked';$active_check_n='';	}
											
											
											//print_r(get_option('_iv_visibility_serialize_role'));
											
											?>
											 <div class="row">
												<label  class="col-md-2  pull-left"> <?php _e('Tax Module ','wpmembership'); ?>:</label>
												<div class="col-md-3">
													<label>												
													<input type="radio" name="active_tax" id="active_tax" value='yes' <?php echo $active_check_y; ?> > 
													<?php _e('Active Tax On Registration','wpmembership'); ?> 
													</label>	
												</div>
												<div class="col-md-3">	
													<label>											
													<input type="radio"  name="active_tax" id="active_tax" value='no' <?php echo $active_check_n; ?> > <?php _e('No Tax','wpmembership'); ?>
													</label>
												</div>	
												<div class="col-md-3">
												
													<button type="button" onclick="return  iv_update_tax_settings();" class="btn btn-success"><?php _e('Update','wpmembership'); ?></button>
												</div>											
											 </div>
											 <div class="row">
												<label  class="col-md-2  pull-left"> <?php _e('Tax Type ','wpmembership'); ?>:</label>
												<div class="col-md-3">
													<label>												
													<input type="radio" name="tax_type" id="tax_type" value='common' onclick="return iv_show_common_tax();" <?php echo ($tax_type=='common'? 'checked':''); ?> > 
													<?php _e('Common Tax','wpmembership'); ?> 
													</label>	
												</div>
												<div class="col-md-3">	
													<label>											
													<input type="radio"  name="tax_type" id="tax_type" value='country' onclick="return iv_show_country_tax();" <?php echo ($tax_type=='country'? 'checked':''); ?> > <?php _e('Tax By Country','wpmembership'); ?>
													</label>
												</div>	
																						
											 </div>
											 
											
																			
												 <!-- Common -->	
											<div class="row " id="common_tax" style="<?php echo ($tax_type=='common'? '':'display: none;'); ?>">	
											
																							
												<label  class="col-md-2  pull-left"> <?php _e('Common Tax % ','wpmembership'); ?>:</label>
												<div class="col-md-3">																							
													<input type="text" name="common_tax_input" id="common_tax_input" value='<?php echo $common_tax_value; ?>' placeholder="only number. Not %, e.g 10" > 											
												</div>												
											</div>											
											 <!-- Country -->	
											<div class="row " id="country_tax" style="<?php echo ($tax_type=='country'? '':'display: none;'); ?>">
															
												<div class="col-md-8 " style="height: 400px;overflow-y: scroll;">
												<table class="table table-bordered table-responsive table-hover ">												  
												  <thead>
													<tr>
													 
													  <th style="text-align: center;"><?php _e('Country','wpmembership'); ?> </th>
													 <th style="text-align: center;"><?php _e('Tax %','wpmembership'); ?> </th>
													</tr>
												  </thead>
												   <tfoot>
													<tr>
													 
													
													</tr>
												  </tfoot>
												  <tbody>
													 <?php 
														
														$countries = array(
																			"AF" => "Afghanistan (‫افغانستان‬‎)",
																			"AX" => "Åland Islands (Åland)",
																			"AL" => "Albania (Shqipëri)",
																			"DZ" => "Algeria (‫الجزائر‬‎)",
																			"AS" => "American Samoa",
																			"AD" => "Andorra",
																			"AO" => "Angola",
																			"AI" => "Anguilla",
																			"AQ" => "Antarctica",
																			"AG" => "Antigua and Barbuda",
																			"AR" => "Argentina",
																			"AM" => "Armenia (Հայաստան)",
																			"AW" => "Aruba",
																			"AC" => "Ascension Island",
																			"AU" => "Australia",
																			"AT" => "Austria (Österreich)",
																			"AZ" => "Azerbaijan (Azərbaycan)",
																			"BS" => "Bahamas",
																			"BH" => "Bahrain (‫البحرين‬‎)",
																			"BD" => "Bangladesh (বাংলাদেশ)",
																			"BB" => "Barbados",
																			"BY" => "Belarus (Беларусь)",
																			"BE" => "Belgium (België)",
																			"BZ" => "Belize",
																			"BJ" => "Benin (Bénin)",
																			"BM" => "Bermuda",
																			"BT" => "Bhutan (འབྲུག)",
																			"BO" => "Bolivia",
																			"BA" => "Bosnia and Herzegovina (Босна и Херцеговина)",
																			"BW" => "Botswana",
																			"BV" => "Bouvet Island",
																			"BR" => "Brazil (Brasil)",
																			"IO" => "British Indian Ocean Territory",
																			"VG" => "British Virgin Islands",
																			"BN" => "Brunei",
																			"BG" => "Bulgaria (България)",
																			"BF" => "Burkina Faso",
																			"BI" => "Burundi (Uburundi)",
																			"KH" => "Cambodia (កម្ពុជា)",
																			"CM" => "Cameroon (Cameroun)",
																			"CA" => "Canada",
																			"IC" => "Canary Islands (islas Canarias)",
																			"CV" => "Cape Verde (Kabu Verdi)",
																			"BQ" => "Caribbean Netherlands",
																			"KY" => "Cayman Islands",
																			"CF" => "Central African Republic (République centrafricaine)",
																			"EA" => "Ceuta and Melilla (Ceuta y Melilla)",
																			"TD" => "Chad (Tchad)",
																			"CL" => "Chile",
																			"CN" => "China (中国)",
																			"CX" => "Christmas Island",
																			"CP" => "Clipperton Island",
																			"CC" => "Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))",
																			"CO" => "Colombia",
																			"KM" => "Comoros (‫جزر القمر‬‎)",
																			"CD" => "Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)",
																			"CG" => "Congo (Republic) (Congo-Brazzaville)",
																			"CK" => "Cook Islands",
																			"CR" => "Costa Rica",
																			"CI" => "Côte d’Ivoire",
																			"HR" => "Croatia (Hrvatska)",
																			"CU" => "Cuba",
																			"CW" => "Curaçao",
																			"CY" => "Cyprus (Κύπρος)",
																			"CZ" => "Czech Republic (Česká republika)",
																			"DK" => "Denmark (Danmark)",
																			"DG" => "Diego Garcia",
																			"DJ" => "Djibouti",
																			"DM" => "Dominica",
																			"DO" => "Dominican Republic (República Dominicana)",
																			"EC" => "Ecuador",
																			"EG" => "Egypt (‫مصر‬‎)",
																			"SV" => "El Salvador",
																			"GQ" => "Equatorial Guinea (Guinea Ecuatorial)",
																			"ER" => "Eritrea",
																			"EE" => "Estonia (Eesti)",
																			"ET" => "Ethiopia",
																			"FK" => "Falkland Islands (Islas Malvinas)",
																			"FO" => "Faroe Islands (Føroyar)",
																			"FJ" => "Fiji",
																			"FI" => "Finland (Suomi)",
																			"FR" => "France",
																			"GF" => "French Guiana (Guyane française)",
																			"PF" => "French Polynesia (Polynésie française)",
																			"TF" => "French Southern Territories (Terres australes françaises)",
																			"GA" => "Gabon",
																			"GM" => "Gambia",
																			"GE" => "Georgia (საქართველო)",
																			"DE" => "Germany (Deutschland)",
																			"GH" => "Ghana (Gaana)",
																			"GI" => "Gibraltar",
																			"GR" => "Greece (Ελλάδα)",
																			"GL" => "Greenland (Kalaallit Nunaat)",
																			"GD" => "Grenada",
																			"GP" => "Guadeloupe",
																			"GU" => "Guam",
																			"GT" => "Guatemala",
																			"GG" => "Guernsey",
																			"GN" => "Guinea (Guinée)",
																			"GW" => "Guinea-Bissau (Guiné Bissau)",
																			"GY" => "Guyana",
																			"HT" => "Haiti",
																			"HM" => "Heard & McDonald Islands",
																			"HN" => "Honduras",
																			"HK" => "Hong Kong (香港)",
																			"HU" => "Hungary (Magyarország)",
																			"IS" => "Iceland (Ísland)",
																			"IN" => "India (भारत)",
																			"ID" => "Indonesia",
																			"IR" => "Iran (‫ایران‬‎)",
																			"IQ" => "Iraq (‫العراق‬‎)",
																			"IE" => "Ireland",
																			"IM" => "Isle of Man",
																			"IL" => "Israel (‫ישראל‬‎)",
																			"IT" => "Italy (Italia)",
																			"JM" => "Jamaica",
																			"JP" => "Japan (日本)",
																			"JE" => "Jersey",
																			"JO" => "Jordan (‫الأردن‬‎)",
																			"KZ" => "Kazakhstan (Казахстан)",
																			"KE" => "Kenya",
																			"KI" => "Kiribati",
																			"XK" => "Kosovo (Kosovë)",
																			"KW" => "Kuwait (‫الكويت‬‎)",
																			"KG" => "Kyrgyzstan (Кыргызстан)",
																			"LA" => "Laos (ລາວ)",
																			"LV" => "Latvia (Latvija)",
																			"LB" => "Lebanon (‫لبنان‬‎)",
																			"LS" => "Lesotho",
																			"LR" => "Liberia",
																			"LY" => "Libya (‫ليبيا‬‎)",
																			"LI" => "Liechtenstein",
																			"LT" => "Lithuania (Lietuva)",
																			"LU" => "Luxembourg",
																			"MO" => "Macau (澳門)",
																			"MK" => "Macedonia (FYROM) (Македонија)",
																			"MG" => "Madagascar (Madagasikara)",
																			"MW" => "Malawi",
																			"MY" => "Malaysia",
																			"MV" => "Maldives",
																			"ML" => "Mali",
																			"MT" => "Malta",
																			"MH" => "Marshall Islands",
																			"MQ" => "Martinique",
																			"MR" => "Mauritania (‫موريتانيا‬‎)",
																			"MU" => "Mauritius (Moris)",
																			"YT" => "Mayotte",
																			"MX" => "Mexico (México)",
																			"FM" => "Micronesia",
																			"MD" => "Moldova (Republica Moldova)",
																			"MC" => "Monaco",
																			"MN" => "Mongolia (Монгол)",
																			"ME" => "Montenegro (Crna Gora)",
																			"MS" => "Montserrat",
																			"MA" => "Morocco (‫المغرب‬‎)",
																			"MZ" => "Mozambique (Moçambique)",
																			"MM" => "Myanmar (Burma) (မြန်မာ)",
																			"NA" => "Namibia (Namibië)",
																			"NR" => "Nauru",
																			"NP" => "Nepal (नेपाल)",
																			"NL" => "Netherlands (Nederland)",
																			"NC" => "New Caledonia (Nouvelle-Calédonie)",
																			"NZ" => "New Zealand",
																			"NI" => "Nicaragua",
																			"NE" => "Niger (Nijar)",
																			"NG" => "Nigeria",
																			"NU" => "Niue",
																			"NF" => "Norfolk Island",
																			"MP" => "Northern Mariana Islands",
																			"KP" => "North Korea (조선 민주주의 인민 공화국)",
																			"NO" => "Norway (Norge)",
																			"OM" => "Oman (‫عُمان‬‎)",
																			"PK" => "Pakistan (‫پاکستان‬‎)",
																			"PW" => "Palau",
																			"PS" => "Palestine (‫فلسطين‬‎)",
																			"PA" => "Panama (Panamá)",
																			"PG" => "Papua New Guinea",
																			"PY" => "Paraguay",
																			"PE" => "Peru (Perú)",
																			"PH" => "Philippines",
																			"PN" => "Pitcairn Islands",
																			"PL" => "Poland (Polska)",
																			"PT" => "Portugal",
																			"PR" => "Puerto Rico",
																			"QA" => "Qatar (‫قطر‬‎)",
																			"RE" => "Réunion (La Réunion)",
																			"RO" => "Romania (România)",
																			"RU" => "Russia (Россия)",
																			"RW" => "Rwanda",
																			"BL" => "Saint Barthélemy (Saint-Barthélemy)",
																			"SH" => "Saint Helena",
																			"KN" => "Saint Kitts and Nevis",
																			"LC" => "Saint Lucia",
																			"MF" => "Saint Martin (Saint-Martin (partie française))",
																			"PM" => "Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)",
																			"WS" => "Samoa",
																			"SM" => "San Marino",
																			"ST" => "São Tomé and Príncipe (São Tomé e Príncipe)",
																			"SA" => "Saudi Arabia (‫المملكة العربية السعودية‬‎)",
																			"SN" => "Senegal (Sénégal)",
																			"RS" => "Serbia (Србија)",
																			"SC" => "Seychelles",
																			"SL" => "Sierra Leone",
																			"SG" => "Singapore",
																			"SX" => "Sint Maarten",
																			"SK" => "Slovakia (Slovensko)",
																			"SI" => "Slovenia (Slovenija)",
																			"SB" => "Solomon Islands",
																			"SO" => "Somalia (Soomaaliya)",
																			"ZA" => "South Africa",
																			"GS" => "South Georgia & South Sandwich Islands",
																			"KR" => "South Korea (대한민국)",
																			"SS" => "South Sudan (‫جنوب السودان‬‎)",
																			"ES" => "Spain (España)",
																			"LK" => "Sri Lanka (ශ්‍රී ලංකාව)",
																			"VC" => "St. Vincent & Grenadines",
																			"SD" => "Sudan (‫السودان‬‎)",
																			"SR" => "Suriname",
																			"SJ" => "Svalbard and Jan Mayen (Svalbard og Jan Mayen)",
																			"SZ" => "Swaziland",
																			"SE" => "Sweden (Sverige)",
																			"CH" => "Switzerland (Schweiz)",
																			"SY" => "Syria (‫سوريا‬‎)",
																			"TW" => "Taiwan (台灣)",
																			"TJ" => "Tajikistan",
																			"TZ" => "Tanzania",
																			"TH" => "Thailand (ไทย)",
																			"TL" => "Timor-Leste",
																			"TG" => "Togo",
																			"TK" => "Tokelau",
																			"TO" => "Tonga",
																			"TT" => "Trinidad and Tobago",
																			"TA" => "Tristan da Cunha",
																			"TN" => "Tunisia (‫تونس‬‎)",
																			"TR" => "Turkey (Türkiye)",
																			"TM" => "Turkmenistan",
																			"TC" => "Turks and Caicos Islands",
																			"TV" => "Tuvalu",
																			"UM" => "U.S. Outlying Islands",
																			"VI" => "U.S. Virgin Islands",
																			"UG" => "Uganda",
																			"UA" => "Ukraine (Україна)",
																			"AE" => "United Arab Emirates (‫الإمارات العربية المتحدة‬‎)",
																			"GB" => "United Kingdom",
																			"US" => "United States",
																			"UY" => "Uruguay",
																			"UZ" => "Uzbekistan (Oʻzbekiston)",
																			"VU" => "Vanuatu",
																			"VA" => "Vatican City (Città del Vaticano)",
																			"VE" => "Venezuela",
																			"VN" => "Vietnam (Việt Nam)",
																			"WF" => "Wallis and Futuna",
																			"EH" => "Western Sahara (‫الصحراء الغربية‬‎)",
																			"YE" => "Yemen (‫اليمن‬‎)",
																			"ZM" => "Zambia",
																			"ZW" => "Zimbabwe"); 
													
														  foreach($countries as $key=>$country) { 
																echo'<tr>';
																echo ' <th scope="row">'.$country.'</th> ';
																$tax_value=0;
																if(sizeof($countries_tax_array)>0 AND $countries_tax_array!=''){
																	foreach($countries_tax_array as $c_name=>$country_tax) { 
																		
																		 if(isset($countries_tax_array[$key]) and $c_name==$key)
																			{																					
																				if(array_key_exists($key , $countries_tax_array)){
																				
																					$tax_value=$country_tax;
																			}
																		 }				
																	}
																}		
																echo '<td style="text-align: center;"><input type="text" name="'.$key.'" id="'.$key.'"   value="'.$tax_value.'" placeholder="Only Number"></td>';
																
																
																
														echo'</tr>';
														
														}
													 ?> 													
												  </tbody>
												</table>
												</div>			
											</div>	
											<br/>
											<div class=" col-md-12  bs-callout bs-callout-info">						
												<?php
															_e('Note : Tax will not work on Stripe Ruccring Subscriotion Payment','wpmembership');
													?>
											</div>
											<div class="form-group">
											<label  class="col-md-3 control-label" id="tax_message"> </label>
											<div class="col-md-8">												
												<button type="button" onclick="return  iv_update_tax_settings();" class="btn btn-success">Update</button>
												
											</div>
										</div>
												
									</form>
								</div>	
								
							
						</div>
					</div>
            </div>
            
		
	


	</div>
</div>
<script>
function iv_update_reminder_email_settings(){
				
				//tinyMCE.triggerSave();	
				
				var search_params={
					"action"  : 	"iv_membership_update_reminder_email_setting",	
					"form_data":	jQuery("#reminder_email_settings").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
							jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
					}
				});

}

	function iv_update_payment_settings() {
				// New Block For Ajax*****
				var search_params={
					"action"  : 	"iv_membership_update_payment_setting",	
					"form_data":	jQuery("#payment_settings").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
					}
				});
				
	}
function iv_update_page_settings(){
				var search_params={
					"action"  : 	"iv_membership_update_page_setting",	
					"form_data":	jQuery("#page_settings").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
					
					jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						//jQuery('#update_message').html(response.msg);
						
					}
				});

}
function iv_update_email_settings(){
				//tinyMCE.triggerSave();	
				var search_params={
					"action"  : 	"iv_membership_update_email_setting",	
					"form_data":	jQuery("#email_settings").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
							jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
					}
				});
}			
function iv_update_mailchamp_settings(){

				var search_params={
					"action"  : 	"iv_membership_update_mailchamp_setting",	
					"form_data":	jQuery("#mailchimp_settings").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
					}
				});
}

function iv_update_account_settings(){

				var search_params={
					"action"  : 	"iv_membership_update_account_setting",	
					"form_data":	jQuery("#account_settings").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
					}
				});
}
function iv_update_post_settings(){
var search_params={
		"action"  : 	"iv_membership_update_post_setting",	
		"form_data":	jQuery("#post_settings").serialize(), 
	};
	jQuery.ajax({					
		url : ajaxurl,					 
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
			jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
			
		}
	});

}
function iv_update_protected_settings(){
var search_params={
		"action"  : 	"iv_membership_update_protected_setting",	
		"form_data":	jQuery("#protected_settings").serialize(), 
	};
	jQuery.ajax({					
		url : ajaxurl,					 
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
			jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
			
		}
	})

}
function protect_select_all(sel_name) {
	   
	   if(jQuery("#"+sel_name+"_all").prop("checked") == true){			
			jQuery("."+sel_name).prop("checked",jQuery("#"+sel_name+"_all").prop("checked"));
            
		}else{
			
			jQuery("."+sel_name).prop("checked", false);
		}
		
}
function iv_update_tax_settings(){
var search_params={
		"action"  : 	"iv_membership_update_tax_setting",	
		"form_data":	jQuery("#tax_settings").serialize(), 
	};
	jQuery.ajax({					
		url : ajaxurl,					 
		dataType : "json",
		type : "post",
		data : search_params,
		success : function(response){
			jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
			jQuery('#tax_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
			
			
		}
	})

}	
function iv_show_common_tax(){
	jQuery('#common_tax').show();
	jQuery('#country_tax').hide();
}
function iv_show_country_tax(){
	jQuery('#common_tax').hide();
	jQuery('#country_tax').show();

}
</script>





