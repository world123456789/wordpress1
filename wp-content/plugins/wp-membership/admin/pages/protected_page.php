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
	<?php
	$i=0;
	 global $wp_roles;
	?>

		<h3  class=""><?php  _e('URL Restriction By Roles','wpmembership');?> <small></small>	
		</h3>
		<form  role="form"  name='protected_page_settings2' id='protected_page_settings2'>		
		<div id="custom_field_div">	
			  <div class="form-group row">
				<label for="staticEmail" class="col-md-2  col-form-label"><?php  _e('Block UR','wpmembership');?>L</label>
				<div class=" col-md-6 ">
				  <input type="text" class="form-control" name="page_url" id="page_url" placeholder="Enter Full URL e.g. http://www.google.com">
				</div>
			  </div>			  
			  <div class="form-group row">
								<label  class="col-md-2   control-label"><?php  _e('Role [Hold Ctrl to select more than 1 role]','wpmembership');?></label>
								
								<div class="col-md-6 ">									
										<select id='notaccessroles' name='notaccessroles' multiple class=' form-control' size="12" >	
										<?php							
										 foreach ( $wp_roles->roles as $key=>$value ){		
													echo "<option value='{$key}' >{$value['name']}</option>";
												   
											
										}						 
										?>
										<option value='visitor' >Visitor</option>							
										</select>				 
								</div>	
			</div>
			
				<?php
				
					$args = array(
						'child_of'     => 0,
						'sort_order'   => 'ASC',
						'sort_column'  => 'post_title',
						'hierarchical' => 1,															
						'post_type' => 'page'
						);
							?>
							<div class="form-group row">
								<label  class="col-md-2   control-label"><?php  _e('Redirect to/Destination: ','wpmembership');?></label>
								
								<div class="col-md-6 ">									
										<?php
										
									 if ( $pages = get_pages( $args ) ){
										echo "<select id='redpage' name='redpage' class='form-control'>";
										foreach ( $pages as $page ) {
										  echo "<option value='{$page->ID}'>{$page->post_title}</option>";
										}
										echo "</select>";
									  }
									?>
										
																 
								</div>	
							</div>
			
						
		</div>	
</form>
<div class="col-xs-12">	
		<label  class="col-md-2   control-label"></label>
	<button class="btn btn-warning btn-xs" onclick="return iv_update_protected_settings_page();"><?php  _e('Add URL','wpmembership');?></button>
</div>	
<div class=" col-md-12  bs-callout bs-callout-info">							
						<?php  _e('Blocked URL','wpmembership');?>									
</div>
<form class="form-horizontal" role="form"  name='protected_page_table' id='protected_page_table'>	
	<div id="all_pages">
		<table id="allredirects" class="table table-bordered table-hover table-responsive">												  
			  <thead>
				<tr>
				  <th><?php  _e('Blocked URL','wpmembership');?></th>
				  <th><?php  _e('Target User Role','wpmembership');?></th>
				  <th><?php  _e('Redirect To/ Destination','wpmembership');?></th>
				  <th><?php  _e('Action','wpmembership');?></th>
				</tr>
			  </thead>
			   <tbody>
					<?php
						$all_re_page=get_option('_iv_membership_redirect_page',true);
						
						$ii=0;	
						if(isset($all_re_page['url'])){									
							foreach($all_re_page['url'] as $row1){
								if(isset($all_re_page['url'][$ii])){ ?>
								
								<tr><td><?php echo $all_re_page['url'][$ii];?></td><td><?php echo $all_re_page['roles'][$ii];?></td><td><?php echo get_the_title($all_re_page['redirectto'][$ii]);?></td><td><button type="button"  class="btnDelete">Delete</button><input type="hidden" name="url[]" id="url[]" value="<?php echo $all_re_page['url'][$ii];?>"><input type="hidden" name="roles[]" id="roles[]" value="<?php echo $all_re_page['roles'][$ii];?>"><input type="hidden" name="redirectto[]" id="redirectto[]" value="<?php echo $all_re_page['redirectto'][$ii];?>"></td></tr>
								<?php
								}	
								$ii++;
							}
						}	
					?>
				</tbody>	
		</table>		  
	</div>	
</form>	
		
			

	
<script>
var i=<?php echo $i; ?>;
jQuery("#allredirects").on('click', '.btnDelete', function () {
    jQuery(this).closest('tr').remove();
    var search_params={
				"action"  : 	"iv_update_protected_page_setting",	
				"form_data":	jQuery("#protected_page_table").serialize(), 
			};
			jQuery.ajax({					
				url : ajaxurl,					 
				dataType : "json",
				type : "post",
				data : search_params,
				success : function(response){					
					
				}
			})
    
});

function iv_update_protected_settings_page(){
	var page_url = jQuery("#page_url").val();
	var notaccessroles = jQuery("#notaccessroles").val();
	var redirectto = jQuery("#redpage").val();
	var redirecttotext = jQuery("#redpage :selected").text(); 
	var userroles='';	
	for (i = 0; i < notaccessroles.length; i++) { 
		userroles += notaccessroles[i] + ",";
	}
    if(page_url!=''){
		
		
		var newRowContent = '<tr><td>'+page_url+'</td><td>'+userroles+'</td><td>'+redirecttotext+'</td><td><button type="button"  class="btnDelete">Delete</button><input type="hidden" name="url[]" id="url[]" value="'+page_url+'"><input type="hidden" name="roles[]" id="roles[]" value="'+userroles+'"><input type="hidden" name="redirectto[]" id="redirectto[]" value="'+redirectto+'"></td></tr>';		
		jQuery(newRowContent).appendTo(jQuery("#allredirects"));		
	
		var search_params={
				"action"  : 	"iv_update_protected_page_setting",	
				"form_data":	jQuery("#protected_page_table").serialize(), 
			};
			jQuery.ajax({					
				url : ajaxurl,					 
				dataType : "json",
				type : "post",
				data : search_params,
				success : function(response){
				jQuery('#protected_page_settings2').trigger("reset");
					
				}
			})
	
	}		

}
	

</script>
