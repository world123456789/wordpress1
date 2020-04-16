          <div class="profile-content">
            
              <div class="portlet light">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject"><?php  _e('Edit','wpmembership');?> <?php
											$iv_post = get_option( '_iv_membership_profile_post');
											if($iv_post!=''){
												echo $iv_post;											
											}else{
												echo 'Post';
											}			
											?></span>
                    </div>
					<!--
			                    <ul class="nav nav-tabs">
			                      <li class="active">
			                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
			                      </li>
			                      <li>
			                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
			                      </li>
			                      <li>
			                        <a href="#tab_1_4" data-toggle="tab">Privacy Settings</a>
			                      </li>
			                    </ul>
					-->
                  </div>
                  
                  <div class="portlet-body">
                    <div class="tab-content">
                    
                      <div class="tab-pane active" id="tab_1_1">
					  <?php
						
					
						$curr_post_id=$_REQUEST['post-id'];
						$current_post = $curr_post_id;
						$post_edit = get_post($curr_post_id); 
						
						$title = $post_edit->post_title;
						$content = $post_edit->post_content;
						// Author Check						
						if ( $post_edit->post_author != $current_user->ID) {
							
							$iv_redirect = get_option( '_iv_membership_login_page');
							 $reg_page= get_permalink( $iv_redirect); 
							?>
							
							<?php  _e('Please','wpmembership');?> <a href="<?php echo $reg_page; ?>" title="Login"><?php  _e('Login','wpmembership');?></a> <?php  _e('To Edit The Post.','wpmembership');?>
							
						<?php
						}else{
					
					?>
						<div class="row">
							<div class="col-md-12">	 
							
							 
							<form action="" id="edit_post" name="edit_post"  method="POST" role="form">
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Title','wpmembership');?></label>
									
									<div class="  "> 
										<input type="text" class="form-control" name="title" id="title" value="<?php echo $title;?>" placeholder="Enter Title Here">
									</div>
																		
								</div>
								<div class="form-group">
										
										<div class=" ">
												<?php
													$settings_a = array(															
														'textarea_rows' =>10,	
														'editor_class' => 'form-control'															 
														);
													$content_client =$content;//get_option( 'iv_membership_signup_email');
													$editor_id = 'edit_post_content';
													wp_editor( $content_client, $editor_id,$settings_a );										
													?>
									
										</div>
									
								</div>
								<div class=" row form-group ">
									<label for="text" class=" col-md-5 control-label"><?php  _e('Feature Image','wpmembership');?> </label>
									
										<div class="col-md-4" id="post_image_div">										
												
												<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $curr_post_id ), 'thumbnail' ); 
												
												
												if($feature_image[0]!=""){ ?>
												
												<img title="profile image" class=" img-responsive" src="<?php  echo $feature_image[0]; ?>">
												
												<?php												
												}else{ ?>
												<a href="javascript:void(0);" onclick="edit_post_image('post_image_div');"  >									
											<?php  echo '<img src="'. WP_iv_membership_URLPATH.'assets/images/image-add-icon.png">'; ?>			
											</a>	
												<?php
												}
												$feature_image_id=get_post_thumbnail_id( $curr_post_id );
												?>
																							
										</div>
										<input type="hidden" name="feature_image_id" id="feature_image_id" value="<?php echo $feature_image_id;  ?>">
										<div class="col-md-3" id="post_image_edit">	
												<?php
												if($feature_image[0]!=""){
													
													 ?>
													<button type="button" onclick="edit_post_image('post_image_div');"  class="btn btn-xs green-haze"><?php  _e('Edit','wpmembership');?></button>
													<button type="button" onclick="remove_post_image('post_image_div');"  class="btn btn-xs green-haze"><?php  _e('Remove','wpmembership');?></button>
													
												<?php
												}else{ ?>
												
													<button type="button" onclick="edit_post_image('post_image_div');"  class="btn btn-xs green-haze"><?php  _e('Add','wpmembership');?></button>
													
												<?php
												}
												?>
												
											
										</div>									
								</div>
								<div class="clearfix"></div>
								<?php 								
									$custom_fields = get_post_custom($curr_post_id);
									?>
								
								<label for="text" class="row col-md-12 control-label"><?php  _e('Custom Fields','wpmembership');?> </label>
								<div id="custom_field_div">
									
											<?php
											foreach ( $custom_fields as $field_key => $field_values ) {
												
												if(!isset($field_values[0])){ continue;}
												//if(in_array($field_key,array("_edit_lock","_edit_last"))) {continue;}
												//if(in_array($field_key,array("_thumbnail_id","_edit_last"))) {continue;} 
												$underscore_str=substr($field_key,0,1);
												if($underscore_str!='_'){
													echo '<div class="row form-group "><div class=" col-md-6"> <input type="text" class="form-control" name="custom_name[]" id="custom_name[]" value="'.$field_key . '" placeholder="Custom Field Name"> </div>		
													<div  class=" col-md-6">
													<textarea name="custom_value[]" id="custom_value[]"  class="form-control col-md-12"  rows="1" placeholder="Value">'.$field_values[0].'</textarea>
													</div></div>';
												}
											}						
												
											?>
											
										
								</div>		
								<div class=" row  form-group ">
									<div class="col-md-12" >	
									<button type="button" onclick="add_custom_field();"  class="btn btn-xs green-haze"><?php  _e('More Field','wpmembership');?></button>
									</div>
								</div>	
								<div class="clearfix"></div>
								<div class=" row form-group ">
									<label for="text" class=" col-md-12 control-label"><?php  _e('Post Status','wpmembership');?>  </label>
								
										<div class="col-md-12" id="">										
										<select name="post_status" id="post_status"  class="form-control">
											<option value="pending"<?php echo (get_post_status( $post_edit->ID )=='pending'?'selected="selected"':'' ) ; ?> ><?php  _e('Pending Review','wpmembership');?></option>
											<option value="draft" <?php echo (get_post_status( $post_edit->ID )=='draft'?'selected="selected"':'' ) ; ?> ><?php  _e('Draft','wpmembership');?></option>
										</select>										
											
											
										</div>				
																		
								</div>
								<div class="clearfix"></div>
								<div class=" row form-group">
									<label for="text" class=" col-md-10 control-label"><?php  _e('Category','wpmembership');?></label>
									
									<div class=" col-md-12 "> 
									<?php
										$postId = $curr_post_id; // the value is recieved properly
										$currentCategory='';$currentCategoryId='';
										if(get_the_category($postId)){ 
											$currentCategory = get_the_category($postId);  // the value is recieved properly
											$currentCategoryId = $currentCategory[0]->term_id; // the value is assigned properly
										}
										$categories = get_categories('hide_empty=0'); // the value is recieved properly
										
										$package_id= get_user_meta($post_edit->post_author,'iv_membership_package_id',true);
										$allow_cats= explode("|",get_post_meta($package_id, 'iv_membership_package_category_ids', true));
										
										$optionname = "postcats"; // the value is recieved properly
										$emptyvalue = "";
										$selected="";
										// SELECET DROP DOWN TERMS
										echo '<select name="'.$optionname.'" class="form-control">
											<option selected="'.$selected.'" value="'.$emptyvalue.'">'.__('Choose a category','sagive').'</option>';
										foreach($categories as $category){											
											if($currentCategoryId == $category->term_id) {
												$selected = 'selected="selected"';
											} else {
													$selected = '';
											}
											$allow =in_array( 'all', $allow_cats) ? 'all' : '';
											$allow_2 =in_array( $category->term_id, $allow_cats) ? '1' : '0';
											
											if($allow=='all' or $allow_2=='1'){
												echo '<option name="'.$category->term_id.'" value="'.$category->term_id.'" '.$selected.'>'.$category->name.'</option>';
											}
											
										}

										echo '</select>';
										
										?>
										

										
									</div>
																		
								</div>
								
								<div class="margiv-top-10">
								    <div class="" id="update_message"></div>
									<input type="hidden" name="user_post_id" id="user_post_id" value="<?php echo $curr_post_id; ?>">
								    <button type="button" onclick="iv_update_post();"  class="btn green-haze"><?php  _e('Update Post','wpmembership');?></button>
		                          
		                        </div>	
									 
							</form>
						  </div>
						</div>
			<?php
			
				} // for Role
			
				
			?>
					
			

                      
					 </div>
                     
                  </div>
                </div>
              </div>
            </div>
          <!-- END PROFILE CONTENT -->
	 <script>
function iv_update_post (){
	tinyMCE.triggerSave();	
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo WP_iv_membership_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"iv_membership_update_wp_post",	
					"form_data":	jQuery("#edit_post").serialize(), 
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
function add_custom_field(){
	jQuery('#custom_field_div').append('<div class="row form-group "><div class=" col-md-6"> <input type="text" class="form-control" name="custom_name[]" id="custom_name[]" value="" placeholder="Custom Field Name"> </div><div  class=" col-md-6"><textarea name="custom_value[]" id="custom_value[]"  class="form-control  col-md-12"  rows="1" placeholder="Value"></textarea></div></div>');

}		
function  remove_post_image	(profile_image_id){
	jQuery('#'+profile_image_id).html('');
	jQuery('#feature_image_id').val(''); 
	jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Add</button>');  

}
 function edit_post_image(profile_image_id){	
				var image_gallery_frame;

               // event.preventDefault();
                image_gallery_frame = wp.media.frames.downloadable_file = wp.media({
                    // Set the title of the modal.
                    title: '<?php _e( 'Set Feature Image ', 'easy-image-gallery' ); ?>',
                    button: {
                        text: '<?php _e( 'Set Feature Image', 'easy-image-gallery' ); ?>',
                    },
                    multiple: false,
                    displayUserSettings: true,
                });                
                image_gallery_frame.on( 'select', function() {
                    var selection = image_gallery_frame.state().get('selection');
                    selection.map( function( attachment ) {
                        attachment = attachment.toJSON();
                        if ( attachment.id ) {
							jQuery('#'+profile_image_id).html('<img  class="img-responsive"  src="'+attachment.sizes.thumbnail.url+'">');
							jQuery('#feature_image_id').val(attachment.id ); 
							jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Edit</button>&nbsp;<button type="button" onclick="remove_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Remove</button>');  
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
			}	
			
 </script>	  
        
