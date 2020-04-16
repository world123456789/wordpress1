<div class="bootstrap-wrapper">
	<div class="welcome-panel container-fluid">
		
		<div class="row">
			<div class="col-md-12">
				
				<h3 class="page-header" >My Account <small>  </small> </h3>
				
				
				
			</div>
		</div>
		
		
		<div class="form-group col-md-12 row">
			
			<div class="row ">
				<label for="text" class="col-md-2 control-label">Short Code</label>
				<div class="col-md-4" >
					[iv_membership_profile_template]
				</div>
				<div class="col-md-4" id="success_message">
				</div>
			</div>
			<div class="row ">
				<label for="text" class="col-md-2 control-label">Php Code</label>
				<div class="col-md-10" >
							<p>
										&lt;?php
										echo do_shortcode('[iv_membership_profile_template]');
										?&gt;</p>	
				</div>
			</div>
			<div class="row ">
				<label for="text" class="col-md-2 control-label"> My Account Page</label>
				<div class="col-md-10" >
					<!--
					 get_option('_iv_membership_registration','73');
					-->
					<?php 
					$form_wizard=get_option('_iv_membership_profile_page');
							//echo get_the_title( $form_wizard );  ?>
					<a class="btn btn-info btn-xs " href="<?php echo get_permalink( $form_wizard ); ?>" target="blank">View Page</a>
				
					
				</div>
			</div>
			<div class="row ">
				<label for="text" class="col-md-2 control-label"> Profile Fields Setting</label>
				<div class="col-md-10" >	
					<a class="btn btn-primary btn-xs" href="?page=wp-iv_membership-profile-fields"> Add /Edit/ Remove Profile Fields </a>
											
				</div>
			</div>
			
			<br/>
			
			<table class="table">
				<?php
					$opt_style=	get_option('iv_membership_profile-template');
				?>
				<tr>
					<td >
							<label >
									<input type="radio" name="option-profile" id="option-profile" value="style-1"  <?php  echo ($opt_style=='style-1' ? 'checked': ''); ?> >
									Style 1 
								</label>
					</td>
					<td>
						<?php include( WP_iv_membership_template. 'private-profile/profile-template-1.php');?>
					</td>	
				</tr>
				
					
				
			</table>	
				
				
			
		</div>
		
			
		
	</div>
</div>
<script type="text/javascript">
	 jQuery(document).ready(function () {

		   jQuery("input[type='radio']").click(function(){
				update_profile_template();
		   });

		});
function update_profile_template(){
	
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params = {
			"action": 			"iv_membership_update_profile_template",
			"profile-st": jQuery("input[name=option-profile]:checked").val(),	
		};
		jQuery.ajax({
			url: ajaxurl,
			dataType: "json",
			type: "post",
			data: search_params,
			success: function(response) {              		
				jQuery("#success_message").html('<h4><span style="color: #04B404;"> ' + response.code + '</span></h4>');
			}
		});
}
</script>
