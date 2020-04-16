          <div class="profile-content">
            
              <div class="portlet light">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject"><?php  _e('Add New','wpmembership');?> <?php
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
					  							
						
						// Check Max\
						$package_id=get_user_meta($current_user->ID,'iv_membership_package_id',true);						
						$max=get_post_meta($package_id, 'iv_membership_package_max_post_no', true);
						if($max==""){
							$max=999999;
						}
								
						$my_post_count= count_user_posts( $current_user->ID);
						
						if ( $my_post_count>=$max or !current_user_can('edit_posts') )  {
								$iv_redirect = get_option( '_iv_membership_profile_page');							
								$reg_page= get_permalink( $iv_redirect); 							
							?>
							<?php  _e('Please Upgrade Your Account','wpmembership');?>
							 <a href="<?php echo $reg_page.'?&profile=level'; ?>" title="Upgarde"><b><?php  _e('Here','wpmembership');?> </b></a>  <?php  _e('To Add More Post','wpmembership');?>
							
						<?php
						}else{
					
					?>
						<div class="row">
							<div class="col-md-12">	 
							
							 
							<form action="" id="new_post" name="new_post"  method="POST" role="form">
								<div class=" form-group">
									<label for="text" class=" control-label"><?php  _e('Title','wpmembership');?></label>
									
									<div class="  "> 
										<input type="text" class="form-control" name="title" id="title" value="" placeholder="<?php  _e('Enter Title Here','wpmembership');?>">
									</div>
																		
								</div>
								<div class="form-group">
										
										<div class=" ">
												<?php
													$settings_a = array(															
														'textarea_rows' =>10,
														'editor_class' => 'form-control'															 
														);
													
													$editor_id = 'new_post_content';
													wp_editor( '', $editor_id,$settings_a );										
													?>
									
										</div>
									
								</div>
								<div class=" row form-group ">
									<label for="text" class=" col-md-5 control-label"><?php  _e('Feature Image','wpmembership');?>  </label>
									
										<div class="col-md-4" id="post_image_div">
											<a  href="javascript:void(0);" onclick="edit_post_image('post_image_div');"  >									
											<?php  echo '<img src="'. WP_iv_membership_URLPATH.'assets/images/image-add-icon.png">'; ?>			
											</a>					
										</div>
										
										<input type="hidden" name="feature_image_id" id="feature_image_id" value="">
										
										<div class="col-md-3" id="post_image_edit">	
											<button type="button" onclick="edit_post_image('post_image_div');"  class="btn btn-xs green-haze"><?php  _e('Add','wpmembership');?></button>
											
										</div>									
								</div>
								
								<div class="clearfix"></div>
								<label for="text" class="row col-md-12 control-label"><?php  _e('Custom Fields','wpmembership');?> </label>
								<div id="custom_field_div">
									<div class=" row form-group " >									
										<div class=" col-md-6"> <input type="text" class="form-control" name="custom_name[]" id="custom_name[]" value="" placeholder="<?php  _e('Custom Field Name','wpmembership');?>" > </div>		
											<div  class=" col-md-6">
											<textarea name="custom_value[]" id="custom_value[]"  class=" col-md-12 form-control"  rows="1"placeholder="<?php  _e('Value','wpmembership');?>" ></textarea>
										</div>
										
									</div>
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
											<option value="pending"><?php  _e('Pending Review','wpmembership');?></option>
											<option value="draft"><?php  _e('Draft','wpmembership');?></option>
										</select>										
											
											
										</div>				
																		
								</div>
								<div class="clearfix"></div>
								<div class=" row form-group">
									<label for="text" class=" col-md-12 control-label"><?php  _e('Category','wpmembership');?></label>
									
									<div class=" col-md-12 "> 
									<?php
										global $current_user; 
										$postId = ''; $curr_post_id='';// the value is recieved properly
										$currentCategory = '';  // the value is recieved properly
										$currentCategoryId =''; // the value is assigned properly
										
										$categories = get_categories('hide_empty=0'); // the value is recieved properly
										$package_id= get_user_meta($current_user->ID,'iv_membership_package_id',true);
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
								    <button type="button" onclick="iv_save_post();"  class="btn green-haze"><?php  _e('Save Post','wpmembership');?></button>
		                          
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
function iv_save_post (){
	tinyMCE.triggerSave();	
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo WP_iv_membership_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"iv_membership_save_wp_post",	
					"form_data":	jQuery("#new_post").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						if(response.code=='success'){
								var url = "<?php echo get_permalink(); ?>?&profile=all-post";    						
								jQuery(location).attr('href',url);	
						}
						//jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
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
							jQuery('#post_image_edit').html('<button type="button" onclick="edit_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Edit</button> &nbsp;<button type="button" onclick="remove_post_image(\'post_image_div\');"  class="btn btn-xs green-haze">Remove</button>');  
						   
						}
					});
                   
                });               
				image_gallery_frame.open(); 
				
			}	
			
 </script>	  
        
