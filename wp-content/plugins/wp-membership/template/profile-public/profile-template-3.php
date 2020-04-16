<?php
wp_enqueue_style('wp-iv_membership-piblic-11', WP_iv_membership_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_script('iv_membership-piblic-12', WP_iv_membership_URLPATH . 'admin/files/js/bootstrap.min.js');


       //wp_enqueue_media(); 
      $display_name='';
      $email='';$user_id=1;
       if(isset($_REQUEST['id'])){  
           $author_name= $_REQUEST['id'];
          $user = get_user_by( 'login', $author_name );
        if(isset($user->ID)){
          $user_id=$user->ID;
          $display_name=$user->display_name;
          $email=$user->user_email;
        }
        }else{
          global $current_user;
         $current_user = wp_get_current_user();
          $user_id=$current_user->ID;
          $display_name=$current_user->display_name;
          $email=$current_user->user_email;
          if($user_id==0){
          $user_id=1;
          }
        } 
        //print_r($current_user);
              $iv_profile_pic_url=get_user_meta($user_id, 'iv_profile_pic_thum',true);
  
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>  
 <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Bootstrap -->
  
    <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>

  <style>
 #profile-temp-3 h3{
      font-family: 'Open Sans', sans-serif;
      font-weight: 100;
      color: #555;
      margin-top: 0;
    }
   #profile-temp-3 .wapper{
      border-top:1px solid #eee;
      border-right:1px solid #eee;
      border-left:1px solid #eee;
      margin: 20px 20px 0;
      padding: 20px;
    }
   #profile-temp-3 .wapper1{
      border-bottom:1px solid #eee;
      border-right:1px solid #eee;
      border-left:1px solid #eee;
      margin: 0 20px 20px;
      padding: 0 0;
      border-top: 1px solid #eee;

    }
    #profile-temp-3 .details{
      font-family: 'Open Sans', sans-serif;
      line-height: 20px;
      color:#8b9293;
      font-size: 14px;
    }
    #iv-profile3 .entry-content a{
    border:0;
  }
  #profile-temp-3 .fa{
      font-size:15px;
      padding: 12.5px 15px;
      border-left:1px solid #eee;
      margin-left: 0;
      color:#888;
    }
    .fa.pull-left {
      margin-right: 0 !important;
  }
   #profile-temp-3 .fa-linkedin:hover{
      color:#fff;
      background-color: #1184cd;
    }
    #profile-temp-3 .fa-google-plus:hover{
      background-color:#d63b3b;
      color:#fff; 
    }
    #profile-temp-3 .fa-twitter:hover{
      background-color:#2bbfec;
      color:#fff; 
    }
    #profile-temp-3 .fa-facebook:hover{
      background-color: #395b89;
      color:#fff;
    }
    #profile-temp-3 .prof-0-button{
      font-size: 14px;
      color: #fff;
      background: #ec894d;
      padding: 10px 15px;
      outline: 0;
      border:0;
      box-shadow: none;
    }

   #profile-temp-3 button a{
    font-size: 14px;
      color: #fff;
      background-color: #ec894d;
      padding: 10px 15px;
      outline: 0;
      border:0;
      background-image: none;
      background: none;
      border-radius: 0;
      text-decoration: none;
   }
   #profile-temp-3 .prof-0-button:hover{
      background-color:#df5400;
    }
    #profile-temp-3 .agent{
      width: 150px;
      height: auto;
      margin-top: 0;
    }
    @media (max-width: 977px){
      .details{
        text-align: center;
        margin-top:10px;
      }     
    }
    @media (max-width: 767px) { 
      .details{
        text-align: center;
        margin-top:10px;
      }
      
      .pull-right{
        float: none;
      }
      .wapper1{
        text-align: center;
      }
      .fa{
        border-bottom: 1px solid #eee;
      }
     }
    </style>
  
    <div id="profile-temp-3" class="bootstrap-wrapper">
       <div class="wapper">
           <div class="row">
               <div class="col-md-6 col-sm-6 text-left">
                   <h3><?php 
				   $name_display=get_user_meta($user_id,'first_name',true).' '.get_user_meta($user_id,'last_name',true);
				   echo (trim($name_display)!=""? $name_display : $display_name );?></h3>
               </div>
           </div>
           <div class="row">
             <div class="col-md-2 col-sm-2 col-xs-2 text-center">
				<?php				  	
				  	if($iv_profile_pic_url!=''){ ?>
					 <img src="<?php echo $iv_profile_pic_url; ?>" class="img-responsive">
					<?php
					}else{
					 echo'	 <img src="'. WP_iv_membership_URLPATH.'assets/images/Blank-Profile.jpg" class="agent">';
					}
				  	?>
              
             </div>
             <div class="col-md-10 col-sm-10 col-xs-10">            
                 <p class="details"><?php echo get_user_meta($user_id,'description',true); ?> </p>
             
             </div>
            </div>
             <div class="row"> 
             <?php
				  if( get_user_meta($user_id,'hide_phone',true)==''){ ?>
					 <div class="col-md-offset-2 col-xs-offset-2  col-sm-offset-2 col-xs-5 col-md-5 col-sm-5  details">
					  <?php  _e('Phone','wpmembership');?><?php echo ': '. get_user_meta($user_id,'phone',true); ?>
					 </div>
					 <?php
				  }
				  if( get_user_meta($user_id,'hide_mobile',true)==''){ ?>
					 <div class="col-md-5 col-sm-5 col-xs-5  details">
						<?php  _e('Mobile','wpmembership');?><?php echo ': '. get_user_meta($user_id,'mobile',true); ?>
					 </div>
					 <?php
				  }
				  ?>
           </div>
           <div class="row"> 
           <?php
          if( get_user_meta($user_id,'hide_email',true)==''){ ?>
           <div class="col-md-offset-2 col-sm-offset-2 col-xs-offset-2 col-xs-8 col-md-5 col-sm-5 details" style="word-wrap: break-word;">
             <?php  _e('Email','wpmembership');?>:  <?php echo $email; ?>
           </div>
           <?php
          }
          ?>
          <div class="col-md-5 col-sm-5 col-xs-8 details" style="word-wrap: break-word;">
             <?php  echo get_user_meta($user_id,'web_site',true);  ?>
           </div>
         </div>
         </div>
         <div class="wapper1 clearfix">
             <div class="pull-right">
             <a href="http://www.facebook.com/<?php  echo get_user_meta($user_id,'facebook',true);  ?>/">
             <i class="fa fa-facebook pull-left"></i>
             </a>
             <a href="http://www.twitter.com/<?php  echo get_user_meta($user_id,'twitter',true);  ?>/">
             <i class="fa fa-twitter pull-left"></i>
             </a>
            <a href="http://www.linkedin.com/<?php  echo get_user_meta($user_id,'linkedin',true);  ?>/">             
             <i class="fa fa-linkedin pull-left"></i>
             </a>
             <a href="http://www.plus.google.com/<?php  echo get_user_meta($user_id,'gplus',true);  ?>/">            
             <i class="fa fa-google-plus pull-left"></i>
             </a>
             <button class="prof-0-button"><a href="mailto: <?php echo $email; ?>"><?php  _e('Send Message','wpmembership');?></a></button>
             <div class="clearfix"></div>
        </div>
      </div>
    </div>
