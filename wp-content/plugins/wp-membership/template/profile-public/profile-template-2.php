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
              $iv_profile_pic_url=get_user_meta($user_id, 'iv_profile_pic_url',true);
				
				  	
			if($iv_profile_pic_url==''){ 
			 $iv_profile_pic_url= WP_iv_membership_URLPATH.'assets/images/Blank-Profile.jpg' ;
			}
				  
?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>  
 <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Bootstrap -->
  
    <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>

  <style>
  body {
    font-family: Roboto;
    font-weight: normal;
    font-style: normal;
    font-size: 14px;
    line-height: 22px;
  }
  #iv-profile3 h2{
    font-family: 'Oswald', sans-serif;
    font-weight: 400;
    font-size: 44px;
    line-height: 45px;
    margin-top: 0;
    
  }
  #iv-profile3 h1 span{
    font-weight: 100;
    
  }
  #iv-profile3 .entry-content a{
    border:0;
  }
  #iv-profile3 h1{
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

  #iv-profile3 h3 {
  font-family: Oswald;
  font-size: 16px;
  font-weight: normal;
  font-style: normal;
  margin-top:40px;
  }
  #iv-profile3 p{
    font-size: 1em;
    font-family: 'Roboto', sans-serif;
    color: #575757;
    font-weight: 400;
    line-height: 22px;
  }

  .bg-profile3{
    background: url('<?php echo $iv_profile_pic_url; ?>') center center no-repeat;
    background-size: cover;
    background-repeat: no-repeat;
    height: 800px;
 
  }
  #iv-profile3 ul li {
    list-style: none;
  }
   #iv-profile3 .hey{
    margin: 0 30px 0 ;
    position: relative;
    top: 70%;
    left:16%;
    background-color: rgba(0,0,0,.4);
    padding: 20px 20px 0;
    display: inline-block;
  }
  #iv-profile3 ul li{
    font-size: 1.1em;
    font-family: 'Roboto', sans-serif;
    color: #575757;
    padding: 12px 0;
    border-bottom: 1px solid #dfdfdf;
    margin-left:0px;
    word-wrap: break-word;
  }
  #iv-profile3 .para{
    font-family: 'Roboto', sans-serif;
    font-size: 15px;
  }
  .header-border{
    border-top: 5px solid #ffb400;
    margin-bottom: 20px;
  }
   #iv-profile3 .header-profile span{
	border-bottom: 5px solid #ffb400;    
    padding-bottom: 15px;
    margin-bottom: 20px;
	}
  .bg{
    background-color: #fff;
    height: 100%;
    padding: 50px  !important;
   
  }
 .por-img{
    width: 100%;
    height: 100%;
 }
 #iv-profile3 ul{
	margin-left:0px;
 }
 .fa-linkedin-square{
     float: left;
     color: #1184cd;
     margin: 5px;
   }
   .fa-google-plus-square{
     color:#d63b3b;
     float: left;
     margin: 5px;
   }
   .fa-twitter-square{
     color:#2bbfec;
     float: left;
     margin: 5px;
   }
   .fa-facebook-square{
     color: #395b89;
     float: left;
     margin: 5px;
   }
   .fa-dot-circle-o{
     color: #888;
     margin-right: 5px;
       }
   #iv-profile3 .fa{
     font-size: 30px;
   }
  
  #iv-profile3 .pro-button3{
        border: 2px solid #ffb400;
        background-color: #FFF;
        
        text-transform: uppercase;
        margin: 20px 0;
        padding: 10px 15px;
        display: inline-block;
        letter-spacing: 1px;
        transition-duration: .2s;
        -moz-transition-duration: .2s;
        -webkit-transition-duration: .2s;
        -o-transition-duration: .2s;
        background: none;
        outline: none;
        box-shadow: none;
}
#iv-profile3 .pro-button3 a{
  background-color: #FFF;
  font-family: 'Oswald', sans-serif;
  font-weight: 400;
  color: #000;
  font-size: 16px;
  text-decoration: none;
  border-bottom: none;
  display: inline-block;
}
#iv-profile3 .pro-button3:hover a{
    background: #ffb400 !important;
    color: #fff;
    display: inline-block;
}
#iv-profile3 .pro-button3:hover {
    background: #ffb400 !important;
    color: #fff;
    display: inline-block;
}
@media (max-width: 767px) {
    .bg-profile3{
      height: 400px;
    }
    #iv-profile3 h1{
    font-size: 20px;
    margin: 0;
 }
 #iv-profile3 .bg{
  padding: 15px;
 }
 .hey{ 
  bottom:0%;
  right:0;
  position: absulate;
  padding: 10px;
  }
  span.title{
    border-bottom: 0px solid #7a7a7a;
    border-top: 0px solid #7a7a7a;
    color: #fff;
    padding: 10px 0;
    letter-spacing: 1px;
    text-transform: uppercase;
    font-size: 13px;
  }
  }
  @media (max-width: 320px){
      .hey{
        margin: 0 0 0;
      }
  }
    </style>
  
    <div class="bootstrap-wrapper">
      <div id="iv-profile3" class="container-fluid">
        <div class="row">
          <div class="col-md-8 bg-profile3 col-xs-12">
            <div class="hey">
            <h1>
            <span><?php  _e("HEllO, I'm",'wpmembership');?></span><br>
          <?php 
				   $name_display=get_user_meta($user_id,'first_name',true).' '.get_user_meta($user_id,'last_name',true);
				   echo (trim($name_display)!=""? $name_display : $display_name );?>
            </h1>
           
            </div>
          </div>
          <div class="col-md-4 bg col-xs-12">
             <div class="row">
              <div class="col-md-12 text-left">
                <h2 class="header-profile"><span><?php  _e('ABOUT','wpmembership');?></span></h2>
                
              </div>
            </div>
            
              <h3><?php  _e('Professional Profile','wpmembership');?></h3>
              <p class="para"><?php echo get_user_meta($user_id,'description',true); ?></p>
              <ul  class="list-unstyled">
                <li>
					<?php 
				   $name_display=get_user_meta($user_id,'first_name',true).' '.get_user_meta($user_id,'last_name',true);
				   echo (trim($name_display)!=""? $name_display : $display_name );?>
                
                </li>
                <?php
          if( get_user_meta($user_id,'hide_phone',true)==''){ ?>
                <li><?php  _e('Phone','wpmembership');?><?php echo ' :'. get_user_meta($user_id,'phone',true); ?></li>
                   <?php
                }
                if( get_user_meta($user_id,'hide_mobile',true)==''){ ?>
                <li><?php  _e('Mobile','wpmembership');?><?php echo ' :'. get_user_meta($user_id,'mobile',true); ?></li>
                   <?php
                }
                
                if( get_user_meta($user_id,'hide_email',true)==''){ ?>
                <li><?php  _e('Email','wpmembership');?>: <?php echo $email; ?></li>
                   <?php
                }
                ?>
                <li><?php  echo get_user_meta($user_id,'web_site',true);  ?></li>
                <li><?php  _e('Address','wpmembership');?><?php echo ' : '. get_user_meta($user_id,'address',true); ?></li>
               
              </ul>
              <div class="clearfix">
               <a href="http://www.twitter.com/<?php  echo get_user_meta($user_id,'twitter',true);  ?>/">
              <i class="fa fa-twitter-square"></i>
              </a>
              </a>
              <a href="http://www.linkedin.com/<?php  echo get_user_meta($user_id,'linkedin',true);  ?>/">
              </a>
              <i class="fa fa-linkedin-square"></i>
              <a href="http://www.facebook.com/<?php  echo get_user_meta($user_id,'facebook',true);  ?>/">
              <i class="fa fa-facebook-square"></i>
              </a>
              
              <a href="http://www.plus.google.com/<?php  echo get_user_meta($user_id,'gplus',true);  ?>/">
              <i class="fa fa-google-plus-square"></i>
              </a>
              </div>
              <button class="pro-button3"><a href="mailto: <?php echo $email; ?>"><?php  _e('SEND MESSAGE','wpmembership');?></a></button>
              
          </div>
        </div>
      </div>
    </div>
