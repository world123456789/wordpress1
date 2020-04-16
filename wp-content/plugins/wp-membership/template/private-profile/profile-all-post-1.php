<?php
	$profile_url=get_permalink(); 
	global $current_user;
	$current_user = wp_get_current_user();
	$user = $current_user->ID;
	$message='';
if(isset($_GET['delete_id']))  {
	$post_id=$_GET['delete_id'];
	$post_edit = get_post($post_id); 
	
	if($post_edit->post_author==$current_user->ID){
		wp_delete_post($post_id);
		delete_post_meta($post_id,true);
		$message="Deleted Successfully";
	}

	
	
}
?>     
     <div class="profile-content">
            
              <div class="portlet light">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject"><?php  _e('All','wpmembership');?> <?php
											$iv_post = get_option( '_iv_membership_profile_post');
											if($iv_post!=''){
												echo $iv_post;											
											}else{
												echo 'Posts';
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
					  //$iv_post ='';// get_option( '_iv_membership_profile_post');
						
						if($iv_post==''){
							$iv_post='post';											
						}		
						
						if($message!=''){
						 echo  '<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'.$message.'.</div>';
						}
						
						?>
					<div class="table-responsive">
					 <table class="table table-striped ">
		 
							<tr>
								<th><?php  _e('Title','wpmembership');?></th>
								
								<th><?php  _e('Status','wpmembership');?></th>
								<th><?php  _e('Actions','wpmembership');?></th>
							</tr>
						 
							<?php
								//if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 
								global $wpdb;
									$per_page=10;$row_strat=0;$row_end=$per_page;
									$current_page=0 ;
									if(isset($_REQUEST['cpage']) and $_REQUEST['cpage']!=1 ){   
										$current_page=$_REQUEST['cpage']; $row_strat =($current_page-1)*$per_page; 
										$row_end=$per_page;
									}
									$sql="SELECT * FROM $wpdb->posts WHERE post_type = '".$iv_post."' and post_author='".$current_user->ID."' and post_status IN ('publish','pending','draft' ) limit ".$row_strat.", ".$row_end;									
									$authpr_post = $wpdb->get_results($sql);
									$total_post=count($authpr_post);									
									if(sizeof($total_post)>0){
										$i=0;
										foreach ( $authpr_post as $row )								
										{									
										?>
								<tr>
									<td style="width:65%"> 
									<a class="profile-desc-link" href="<?php echo get_permalink($row->ID); ?>" style="font-size:15px;">
									<?php $feature_image = wp_get_attachment_image_src( get_post_thumbnail_id( $row->ID), 'thumbnail' ); 
									if($feature_image[0]!=""){ ?>												
												<img title="profile image" style="width:45px;"  src="<?php  echo $feature_image[0]; ?>">
									<?php												
									}
												
									?>
									&nbsp; <?php echo $row->post_title; ?></a></td>
									
									 <td width="15%" style="font-size:15px"><?php echo get_post_status( $row->ID ) ?></td>
									<td width="20%" >
										<?php											
											$edit_post= $profile_url.'?&profile=post-edit&post-id='.$row->ID;										
											?>											
										<a href="<?php echo $edit_post; ?>" class="btn btn-xs green-haze" ><?php  _e('Edit','wpmembership');?></a> 										
										<a href="<?php echo $profile_url.'?&profile=all-post&delete_id='.$row->ID ;?>"  onclick="return confirm('<?php  _e('Are you sure to delete this post?','wpmembership');?>');"  class="btn btn-xs btn-danger"><?php  _e('Delete','wpmembership');?>										
										</a></td>
								</tr>
								 
								<?php 
								}
							}	
								
								 ?>	
								
								 
	
					</table>
					
					
					</div>
							<div class="center">
								<?php
								$sql2="SELECT * FROM $wpdb->posts WHERE post_type =  '".$iv_post."'  and post_author='".$current_user->ID."' and post_status IN ('publish','pending','draft' ) ";
								$authpr_post2 = $wpdb->get_results($sql2);
								$total_post=count($authpr_post2);
								$total_page= $total_post/$per_page;
								$total_page=ceil( $total_page);
								$current_page =($current_page==''? '1': $current_page );
								echo ' <ul class="iv-pagination">';										
								for($i=1;$i<= $total_page;$i++){
										echo '<li class="list-pagi '.($i==$current_page  ? 'active-li': '').'"><a href="'.get_permalink().'?&profile=all-post&cpage='.$i.'"> '.$i.'</a></li>';		
										
							
								}
								echo'</ul>';
							
							?>
							 </div> 
					 </div>
                     
                  </div>
                </div>
              </div>
            </div>
          <!-- END PROFILE CONTENT -->
        
