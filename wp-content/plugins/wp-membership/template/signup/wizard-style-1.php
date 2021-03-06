<?php
global $wpdb;
wp_enqueue_style('wp-iv_membership-piblic-11', WP_iv_membership_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_script('iv_membership-piblic-12', WP_iv_membership_URLPATH . 'admin/files/js/bootstrap.min.js');
wp_enqueue_script('iv_membership-script-signup-15', WP_iv_membership_URLPATH . 'admin/files/js/jquery.form-validator.js');


$api_currency= 'USD';
if( get_option('_iv_membership_api_currency' )!=FALSE ) {
	$api_currency= get_option('_iv_membership_api_currency' );
}	


		$iv_gateway='paypal-express';
		if( get_option( 'iv_membership_payment_gateway' )!=FALSE ) {
			$iv_gateway = get_option('iv_membership_payment_gateway');	
				   if($iv_gateway=='paypal-express'){
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
			
			$recurring= get_post_meta($package_id, 'iv_membership_package_recurring', true);	
			if($recurring == 'on'){
				$package_amount=get_post_meta($package_id, 'iv_membership_package_recurring_cost_initial', true);
			}else{
				$package_amount=get_post_meta($package_id, 'iv_membership_package_cost',true);
			}	
			if($package_amount=='' || $package_amount=='0' ){$iv_gateway='paypal-express';}
																					
		}
		
		$form_meta_data= get_post_meta( $package_id,'iv_membership_content',true);			
		$row = $wpdb->get_row("SELECT * FROM $wpdb->posts WHERE id = '".$package_id."' ");
		$package_name='';
		$package_amount='';
		if(sizeof($row)>0){
			$package_name=$row->post_title;
			$count =get_post_meta($package_id, 'iv_membership_package_recurring_cycle_count', true);
			
			
			$package_name=$package_name;
																
			$package_amount=get_post_meta($package_id, 'iv_membership_package_cost',true);
		}
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
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script> 

 <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Bootstrap -->
  
    <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>
<style>
body{
   
   font-family: 'Open Sans', sans-serif;
 }
 #profile-template-5 label {
 font-weight: 400;
 font-size: 14px;
 }
 #profile-template-5  .form-control {
 font-size: 14px;
 font-weight: normal;
 color: #333333;
 background-color: #fff;
 border: 1px solid #e5e5e5;
 -webkit-box-shadow: none;
 box-shadow: none;
 border-radius:0 !important; 
 -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
 transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
 }
 #profile-template-5profile-template-5 .btn.default {
 color: #333333;
 background-color: #e5e5e5;
 border:1px solid #e5e5e5;
 outline: 0;
 }
 #profile-template-5profile-template-5 label {
 font-weight: 400;
 font-size: 14px;
 }
 #profile-template-5profile-template-5 .default {
   color: #333333;
   background-color: #e5e5e5;
   border-color: "";
   }

#profile-template-5 .wrapper{
  width:98%;
  padding-left: 15px;
}
 #profile-template-5 .green-haze.btn {
 color: white;
 background-color: #44b6ae;
 border-color:  #44b6ae;
 box-shadow: none;
 outline: none;
 }
 #profile-template-5  .form-control:focus{
 border-color: #999999;
 outline: 0;
 -webkit-box-shadow: none;
 box-shadow: none;
 }
 #profile-template-5 .profile-usertitle-name {
 color: #5a7391;
 font-size: 20px;
 font-weight: 600;
 margin: 10px 0;
 }
 #profile-template-5 .nav  li a{
   padding: 10px;
 }
 #profile-template-5 .profile-sidebar {
   float: left;
   width: 100%;
   margin-right: 0;
   padding: 0 0 10px 0;
    border: 1px solid #59ABE3;
 }
 #profile-template-5 .icon-round{
   border: 1px solid #93a3b5;
   border-radius: 50%;
   padding: 4px;
   font-size: 8px !important;
 }
 #profile-template-5  .nav{
   margin-left: 0;
 }
  #profile-template-5  .nav li{
   margin-left: 0;
 }
 #profile-template-5  .nav li:hover .icon-round{
   border: 1px solid #5b9bd1;
 }

  #profile-template-5  .portlet-title  .nav li:hover{
   border-bottom: 5px solid #d9534f;
 }
  #profile-template-5 .portlet-title  .nav li.active{
   border-bottom: 5px solid #d9534f;
 }
  #profile-template-5 .portlet-title  .nav li a:focus{
   box-shadow: 0 0 0 0px #5b9dd9,0 0 0px 0px rgba(30,140,190,.0);
   -web-kit-box-shadow:  0 0 0 0px #5b9dd9,0 0 0px 0px rgba(30,140,190,.0);
 }
 #profile-template-5 .nav-tabs > li.active > a{
   border: 1px solid #fff; 

 }
 #profile-template-5 .profile-content {
   overflow: hidden;
   background: #fff;
   padding: 15px;
   border: 1px solid #59ABE3;
 }

 /* PROFILE SIDEBAR */
 #profile-template-5  .profile-sidebar-portlet {
   padding: 30px 0 0 0 !important;
 }

 #profile-template-5  .profile-userpic img {
   float: none;
   margin: 0 auto;
   width: 50%;
   height: 50%;
   -webkit-border-radius: 50% !important;
   -moz-border-radius: 50% !important;
   border-radius: 50% !important;
 }

 #profile-template-5  .profile-usertitle {
   text-align: center;
   margin-top: 20px;
 }

 #profile-template-5  .profile-usertitle-name {
   color: #5a7391;
   font-size: 20px;
   font-weight: 600;
   margin-bottom: 7px;
 }

 #profile-template-5  .profile-usertitle-job {
   text-transform: uppercase;
   color: #5b9bd1;
   font-size: 13px;
   font-weight: 800;
   margin-bottom: 7px;
 }

 #profile-template-5 .profile-userbuttons {
   text-align: center;
   margin-top: 10px;
 }

 #profile-template-5  .profile-userbuttons .btn {
   margin-right: 5px;
 }
 #profile-template-5 .profile-userbuttons .btn:last-child {
   margin-right: 0;
 }
 #profile-template-5  .caption {
 float: left;
 display: inline-block;
 font-size: 18px;
 line-height: 18px;
 font-weight: 100%;
 padding: 10px 0;
 }
 #profile-template-5 .profile-userbuttons button {
   text-transform: uppercase;
   font-size: 11px;
   font-weight: 600;
   padding: 6px 15px;
 }

 #profile-template-5 .profile-usermenu {
   margin-top: 30px;
   padding-bottom: 20px;
 }

 #profile-template-5  .profile-usermenu ul li {
   border-bottom: 1px solid #f0f4f7;
 }

 #profile-template-5 .profile-usermenu ul li:last-child {
   border-bottom: none;
 }

 #profile-template-5  .profile-usermenu ul li a {
   color: #93a3b5;
   font-size: 16px;
   font-weight: 400;
 }

 #profile-template-5 .profile-usermenu ul li a {
   font-size: 16px;
 }

 #profile-template-5 .profile-usermenu ul li a:hover {
   background-color: #fafcfd;
   color: #5b9bd1;
 }

 .profile-usermenu ul li.active a {
   color: #5b9bd1 !important;
   background-color: #f6f9fb;
   border-left: 2px solid #5b9bd1;
   margin-left: -2px;
 }

 #profile-template-5 .profile-stat {
   padding-bottom: 20px;
   border-bottom: 1px solid #f0f4f7;
 }

 #profile-template-5  .profile-stat-title {
   color: #7f90a4;
   font-size: 25px;
   text-align: center;
 }
 #profile-template-5 .tabbable-line{
   border-bottom: 1px solid #ececec;
   margin-bottom: 30px;
 }
  #profile-template-5 .profile-stat-text {
   color: #5b9bd1;
   font-size: 11px;
   font-weight: 800;
   text-align: center;
 }
 .bm{margin-bottom: 40px}

 #profile-template-5 .profile-desc-title {
   color: #7f90a4;
   font-size: 17px;
   font-weight: 600;
 }
 #profile-template-5 .profile-desc-text {
   color: #7e8c9e;
   font-size: 14px;
 }
 #profile-template-5 .caption-subject{
   font-weight: 600;
   font-size: 15px !important;
   font-family: 'open-sans',sans-serif;
   text-transform: uppercase;
   color: #333 !important;
 }
 #profile-template-5 .profile-desc-link i {
   width: 22px;
   font-size: 19px;
   color: #abb6c4;
   margin-right: 5px;
 }
 #profile-template-5 .portlet{
   background: #fff;
   padding: 20px 30px 20px 20px;
   margin-bottom: 0;
 }
#profile-template-5 .margin-top-10{
  margin-top: 10px
}
 #profile-template-5 .profile-desc-link a {
   font-size: 14px;
   font-weight: 600;
   color: #5b9bd1;
 }
 #profile-template-5 .margin-top-20{
   margin-top: 20px
 }
 #profile-template-5  h2 {
   font-weight: 700;
   font-family: 'open-sans',sans-serif;
   font-size: 16px;
   padding-bottom: 15px;
   display: block;
   color:#578ebe !important;
   }
   #profile-template-5 .nav-tabs {
   border-bottom: 1px solid #ddd;
   }
  #profile-template-5 .nav-tabs {
   background: none;
   margin: 0;
   float: right;
   display: inline-block;
   border: 0;
   }

   #profile-template-5 .around-separetor{
   background-color: #eff3f8 !important;
   }

 /* RESPONSIVE MODE */
 @media (max-width: 767px) {
  
 #profile-template-5 .profile-sidebar {
     float: none;
     width: 100%;
     margin-right: 20px;
     padding: 0 0 15px 15px;
     text-align: center;
     border: 1px solid #59ABE3;
     }

 #profile-template-5  .profile-sidebar > .portlet {
     margin-bottom: 0;
   }

 #profile-template-5  .profile-content {
     overflow: visible;
   }
 }
 .view:hover .s2{
  -webkit-transform: translate3d(59px,0,0) rotate3d(0,1,0,-45deg);
  -moz-transform: translate3d(59px,0,0) rotate3d(0,1,0,-45deg);
  -o-transform: translate3d(59px,0,0) rotate3d(0,1,0,-45deg);
  -ms-transform: translate3d(59px,0,0) rotate3d(0,1,0,-45deg);
  transform: translate3d(59px,0,0) rotate3d(0,1,0,-45deg);
 }
 .view:hover .s3, 
 .view:hover .s5{
  -webkit-transform: translate3d(59px,0,0) rotate3d(0,1,0,90deg);
  -moz-transform: translate3d(59px,0,0) rotate3d(0,1,0,90deg);
  -o-transform: translate3d(59px,0,0) rotate3d(0,1,0,90deg);
  -ms-transform: translate3d(59px,0,0) rotate3d(0,1,0,90deg);
  transform: translate3d(59px,0,0) rotate3d(0,1,0,90deg);
 }
 .view:hover .s4{
  -webkit-transform: translate3d(59px,0,0) rotate3d(0,1,0,-90deg);
  -moz-transform: translate3d(59px,0,0) rotate3d(0,1,0,-90deg);
  -o-transform: translate3d(59px,0,0) rotate3d(0,1,0,-90deg);
  -ms-transform: translate3d(59px,0,0) rotate3d(0,1,0,-90deg);
  transform: translate3d(59px,0,0) rotate3d(0,1,0,-90deg);
 }

 .view .s1 > .overlay {
  background: -moz-linear-gradient(right, rgba(0,0,0,0.05) 0%, rgba(0,0,0,0) 100%);
  background: -webkit-linear-gradient(right, rgba(0,0,0,0.05) 0%,rgba(0,0,0,0) 100%);
  background: -o-linear-gradient(right, rgba(0,0,0,0.05) 0%,rgba(0,0,0,0) 100%);
  background: -ms-linear-gradient(right, rgba(0,0,0,0.05) 0%,rgba(0,0,0,0) 100%);
  background: linear-gradient(right, rgba(0,0,0,0.05) 0%,rgba(0,0,0,0) 100%);
 }

 .view .s2 > .overlay {
  background: -moz-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255, 255, 255, 0.2) 100%);
  background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255, 255, 255, 0.2) 100%);
  background: -o-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255, 255, 255, 0.2) 100%);
  background: -ms-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255, 255, 255, 0.2) 100%);
  background: linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255, 255, 255, 0.2) 100%);
 }

 .view .s3 > .overlay {
  background: -moz-linear-gradient(right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 100%);
  background: -webkit-linear-gradient(right, rgba(0,0,0,0.8) 0%,rgba(0,0,0,0.2) 100%);
  background: -o-linear-gradient(right, rgba(0,0,0,0.8) 0%,rgba(0,0,0,0.2) 100%);
  background: -ms-linear-gradient(right, rgba(0,0,0,0.8) 0%,rgba(0,0,0,0.2) 100%);
  background: linear-gradient(right, rgba(0,0,0,0.8) 0%,rgba(0,0,0,0.2) 100%);
 }

 .view .s4 > .overlay {
  background: -moz-linear-gradient(left, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0) 100%);
  background: -webkit-linear-gradient(left, rgba(0,0,0,0.8) 0%,rgba(0,0,0,0) 100%);
  background: -o-linear-gradient(left, rgba(0,0,0,0.8) 0%,rgba(0,0,0,0) 100%);
  background: -ms-linear-gradient(left, rgba(0,0,0,0.8) 0%,rgba(0,0,0,0) 100%);
  background: linear-gradient(left, rgba(0,0,0,0.8) 0%,rgba(0,0,0,0) 100%);
 }

 .view .s5 > .overlay {
  background: -moz-linear-gradient(left, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0) 100%);
  background: -webkit-linear-gradient(left, rgba(0,0,0,0.3) 0%,rgba(0,0,0,0) 100%);
  background: -o-linear-gradient(left, rgba(0,0,0,0.3) 0%,rgba(0,0,0,0) 100%);
  background: -ms-linear-gradient(left, rgba(0,0,0,0.3) 0%,rgba(0,0,0,0) 100%);
  background: linear-gradient(left, rgba(0,0,0,0.3) 0%,rgba(0,0,0,0) 100%);
 }
 .view-tenth img {
    -webkit-transform: scaleY(1);
    -moz-transform: scaleY(1);
    -o-transform: scaleY(1);
    -ms-transform: scaleY(1);
    transform: scaleY(1);
    -webkit-transition: all 0.7s ease-in-out;
    -moz-transition: all 0.7s ease-in-out;
    -o-transition: all 0.7s ease-in-out;
    -ms-transition: all 0.7s ease-in-out;
    transition: all 0.7s ease-in-out;
 }
 .view-tenth .mask {
    background-color: rgba(174, 168, 211,0.3);
    -webkit-transition: all 0.5s linear;
    -moz-transition: all 0.5s linear;
    -o-transition: all 0.5s linear;
    -ms-transition: all 0.5s linear;
    transition: all 0.5s linear;
    -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    opacity: 0;
 }

 .view-tenth a.info {
    -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    opacity: 0;
    -webkit-transform: scale(0);
    -moz-transform: scale(0);
    -o-transform: scale(0);
    -ms-transform: scale(0);
    transform: scale(0);
    -webkit-transition: all 0.5s linear;
    -moz-transition: all 0.5s linear;
    -o-transition: all 0.5s linear;
    -ms-transition: all 0.5s linear;
    transition: all 0.5s linear;
 }
 .view-tenth:hover img {
    -webkit-transform: scale(10);
    -moz-transform: scale(10);
    -o-transform: scale(10);
    -ms-transform: scale(10);
    transform: scale(10);
    -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: alpha(opacity=0);
    opacity: 0;
 }
 .view-tenth:hover .mask {
    -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)";
    filter: alpha(opacity=100);
    opacity: 1;
 }
 .view-tenth:hover h2,.view-tenth:hover p,.view-tenth:hover a.info {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -o-transform: scale(1);
    -ms-transform: scale(1);
    transform: scale(1);
    -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)";
    filter: alpha(opacity=100);
    opacity: 1;
 }
 .view {
    width: 100%;
    height: 100%;
    margin: 0 0 10px 0;
    float: left;
    border: 5px solid #ABB7B7;
    overflow: hidden;
    position: relative;
    text-align: center;
    -webkit-box-shadow: 1px 1px 2px #e6e6e6;
    -moz-box-shadow: 1px 1px 2px #e6e6e6;
    box-shadow: 1px 1px 2px #e6e6e6;
    cursor: default;
    background: #fff url(../images/bgimg.jpg) no-repeat center center;
 }
 .view .mask,.view .content {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
 }
 .view img {
    display: block;
    width: 100%;
    height: 100%;
    position: relative;
 }
 .view h2 {
    text-transform: uppercase;
    color: #fff;
    text-align: center;
    position: relative;
    font-size: 17px;
    padding: 10px;
    background: rgba(27, 163, 156);
    margin: 0 0 10px !important;
 }
 .view p {
    font-family: Georgia, serif;
    font-style: italic;
    font-size: 45px;
    position: relative;
    color: #fff;
    padding: 25px;
    text-align: center;
 }
 .view a.info {
    display: inline-block;
    text-decoration: none;
    padding: 7px 14px;
    background: #000;
    color: #fff;
    text-transform: uppercase;
    -webkit-box-shadow: 0 0 1px #000;
    -moz-box-shadow: 0 0 1px #000;
    box-shadow: 0 0 1px #000;
 }
 .view a.info: hover {
    -webkit-box-shadow: 0 0 5px #000;
    -moz-box-shadow: 0 0 5px #000;
    box-shadow: 0 0 5px #000;
 }
 #profile-template-5 .margin-bottom-15{
  margin-bottom: 15px;
 }
 .border-blue{
 border: 1px solid #ececec;
 background-color: #fff;
 }
.padding-0{
  padding: 0 !important;
}
.padding-left-10{
 padding-left: 10px;
 margin: 0 auto;
}
.profile-usertitle-nameI{
font-weight: 600;
font-size: 15px !important;
font-family: 'open-sans',sans-serif;
text-transform: uppercase;
color: #578ebe !important;
padding-bottom: 10px;
border-bottom: 1px solid #EEE;
margin: 10px 0 35px;
}
.chili{color:red}
.chili:before{content:" *"}
</style>
 <div id="profile-template-5" class="bootstrap-wrapper around-separetor margin-top-10">
    <div class="wrapper">
      <div class="border-blue row">
        <?php
          if(isset($_REQUEST['message-error'])){?>
          <div class="row alert alert-info alert-dismissable" id='loading-2'><a class="panel-close close" data-dismiss="alert">x</a> <?php  echo $_REQUEST['message-error']; ?></div>
          <?php
          }
          ?>
			<?php
				if($iv_gateway=='paypal-express'){	
				 ?>
			
					<form id="iv_membership_registration" name="iv_membership_registration" class="" action="<?php  the_permalink() ?>?package_id=<?php echo $package_id; ?>&payment_gateway=paypal&iv-submit-listing=register" method="post" role="form">
			
			<?php	
			}
			if($iv_gateway=='stripe'){?>
					<form id="iv_membership_registration" name="iv_membership_registration" class="" action="<?php  the_permalink() ?>?&package_id=<?php echo $package_id; ?>&payment_gateway=stripe&iv-submit-stripe=register" method="post" role="form">
					
					<input type="hidden" name="payment_gateway" id="payment_gateway" value="stripe">	
					<input type="hidden" name="iv-submit-stripe" id="iv-submit-stripe" value="register">	
			<?php	
			}
			if($iv_gateway=='woocommerce'){
				?>
				<form id="iv_membership_registration" name="iv_membership_registration" class="form-horizontal" action="<?php  the_permalink() ?>?package_id=<?php echo $package_id; ?>&payment_gateway=woocommerce&iv-submit-listing=register" method="post" role="form">
				<?php
				}
			if($iv_gateway=='stripe'){?>
					<form id="iv_membership_registration" name="iv_membership_registration" class="form-horizontal" action="<?php  the_permalink() ?>?&package_id=<?php echo $package_id; ?>&payment_gateway=stripe&iv-submit-stripe=register" method="post" role="form">
					
					<input type="hidden" name="payment_gateway" id="payment_gateway" value="stripe">	
					<input type="hidden" name="iv-submit-stripe" id="iv-submit-stripe" value="register">	
			<?php	
			}
			?>
           
           
            <div class="col-md-6 col-xs-12">
					
			
              <div class="portlet light row">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md pull-left">
                      <i class="icon-globe theme-font hide"></i>
                      <span class="caption-subject font-blue-madison bold uppercase"><?php  _e('User Info','wpmembership');?> </span>
                    </div>
                  </div>
                  <div class="portlet-body">
                    <div class="tab-content">
						
							<div class="form-group">
								<label><?php  _e('User Name','wpmembership');?><span class="chili"></span></label>
								<input type="text" class="form-control" id="iv_member_user_name"  name="iv_member_user_name"  data-validation="length alphanumeric" 
	data-validation-length="4-12" data-validation-error-msg="<?php  _e('The user name has to be an alphanumeric value between 4-12 characters','wpmembership');?>" class="form-control ctrl-textbox" placeholder=""  alt="required" />
                          </div>
                          <div class="form-group">
                            <label><?php  _e('Email Address','wpmembership');?><span class="chili"></span></label>
                            <input type="email" name="iv_member_email" data-validation="email"  class="form-control ctrl-textbox" placeholder="" data-validation-error-msg=" <?php  _e('Email','wpmembership');?>Please enter a valid email address." />
                          </div>
                          <div class="form-group">
                            <label><?php  _e('Password','wpmembership');?><span class="chili"></span></label>
                            <input type="password" name="iv_member_password"  class="form-control ctrl-textbox" placeholder="" data-validation="strength"  data-validation-strength="2"  />
                          </div>
                          
                          <?php
							   $i=1;
							  $default_fields = array();
							$default_fields=get_option('iv_membership_profile_fields');
							$sign_up_array=get_option( 'iv_membership_signup_fields');
							$require_array=get_option( 'iv_membership_signup_require');
							if(is_array($default_fields)){
								 foreach ( $default_fields as $field_key => $field_value ) {

										$sign_up='no';
										if(isset($sign_up_array[$field_key]) && $sign_up_array[$field_key] == 'yes') {
												$sign_up='yes';
										}
										 $require='no';
										if(isset($require_array[$field_key]) && $require_array[$field_key] == 'yes') {
											  $require='yes';
										 }
									if($sign_up=='yes'){
									 ?>
										 <div class="form-group ">
											<label  class=" control-label" ><?php echo _e($field_value, 'wp_ep_fitness'); ?><span class="<?php echo($require=='yes'?'chili':''); ?>"></span></label>
											
												<input type="text"  name="<?php echo $field_key;?>" <?php echo($require=='yes'?'data-validation="length" data-validation-length="2-100"':''); ?>
												class="form-control ctrl-textbox" placeholder="<?php echo 'Enter '.$field_value;?>" >											
										</div>
									<?php
									}
								  }
							}
							?>
                          
							<?php
					$tax_type= (get_option('_iv_tax_type')!=""?get_option('_iv_tax_type'):"country");
					$tax_active_module=get_option('_iv_membership_active_tax');
					
					if($tax_active_module=='' ){ $tax_active_module='yes';	}
					$country_show=0;
					if($tax_type=='country'){
					 $country_show=1;
					}else{
						$country_show=0;
					}
					if($tax_active_module=='yes' AND $country_show==1){
					?>
					<div class="form-group ">									
						<label><?php  esc_html_e('Country','wpmembership');?><span class="chili"></span></label>
						<div class="">
							<select name="country_select" id ="country_select" class=" form-control" data-validation="required" 
		 data-validation-error-msg="<?php  esc_html_e('Please select your country','medico');?>">
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
								$i=0;
								echo '<option value="" >'. __('Select Country','medico').'</option>';
								$first_country='select';
								foreach($countries as $key=>$country) {
										echo '<option value="'. $key.'" >'. $country.'</option>';
										
										$i++;
									}	
								?>
							</select>	
							
						</div>
					</div>
					
					<?php
					}	
					?>	
							
							  
                    												
						<input type="hidden" name="hidden_form_name" id="hidden_form_name" value="iv_membership_registration">
						
                      <div>
                        
                          
                         
                       
                      </div>
                    </div>
                  </div>
                </div>
          </div>    
			  <div class="col-md-6 col-xs-12">
			   <div class="portlet light row">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md pull-left">
                      <i class="icon-globe theme-font hide"></i>
                      <span class="caption-subject font-blue-madison bold uppercase"><?php  _e('Payment Info','wpmembership');?> </span>
                    </div>
                  </div>
                  <div class="portlet-body">
                    <div class="tab-content">
					
                      <div>
						<?php 														
							if($iv_gateway=='paypal-express'){
								include(WP_iv_membership_template.'signup/paypal_form_1.php');
							}
							
							if($iv_gateway=='stripe'){
								include(WP_iv_membership_template.'signup/iv_stripe_form_1.php');					
							}	
							if($iv_gateway=='woocommerce'){
								include(WP_iv_membership_template.'signup/woocommerce.php');
							}									
							?>
                          
                      </div>
                   
				   </div>
                  </div>
               
			   </div>
			      </div>
				  
				 
		</form> 
			</div> 		
    </div>
        </div>
<script type="text/javascript">

var loader_image = '<img src="<?php echo WP_iv_membership_URLPATH. "admin/files/images/loader.gif"; ?>" />';
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';		
(function($) {
	
	var active_payment_gateway='<?php echo $iv_gateway; ?>'; 
	
	jQuery(document).ready(function($) {
			
						jQuery.validate({
							form : '#iv_membership_registration',
							modules : 'security',		
												
							onSuccess : function() {
							
							  	jQuery("#loading-3").show();
								jQuery("#loading").html(loader_image);
								
								if(active_payment_gateway=='stripe'){
									
										 Stripe.createToken({
											number: jQuery('#card_number').val(),
											cvc: jQuery('#card_cvc').val(),
											exp_month: jQuery('#card_month').val(),
											exp_year: jQuery('#card_year').val(),
											//name: $('.card-holder-name').val(),
											//address_line1: $('.address').val(),
											//address_city: $('.city').val(),
											//address_zip: $('.zip').val(),
											//address_state: $('.state').val(),
											//address_country: $('.country').val()
										}, stripeResponseHandler);
									
									return false;
									
								}else{ // Else for paypal
									
									return true; // false Will stop the submission of the form
								}
								
							},
							
					  })
 
	 })
	 
	 
	 // this identifies your website in the createToken call below
	 if(active_payment_gateway=='stripe'){
		Stripe.setPublishableKey('<?php echo  $stripe_publishable; ?>');

			function stripeResponseHandler(status, response) {
				if (response.error) {				
					jQuery("#payment-errors").html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.error.message +'.</div> ');
					jQuery("#loading-3").hide();
					
					
				} else {
					var form$ = jQuery("#iv_membership_registration");
					// token contains id, last4, and card type
					var token = response['id'];
					// insert the token into the form so it gets submitted to the server
					form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
					// and submit
					form$.get(0).submit();
				}
			}
	}
	 
	 
})(jQuery);
		
		
jQuery(document).ready(function() {
    jQuery('#coupon_name').on('keyup change', function() {
				
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params={
			"action"  			: "iv_membership_check_coupon",	
			"coupon_code" 		:jQuery("#coupon_name").val(),
			"package_id" 		:jQuery("#package_id").val(),
			"package_amount" 	:'<?php echo $package_amount; ?>',
			"api_currency" 		:'<?php echo $api_currency; ?>',
			"form_data"			:jQuery("#iv_membership_registration").serialize(),
			
		};
		jQuery('#coupon-result').html('<img  src="<?php echo WP_iv_membership_URLPATH; ?>admin/files/images/old-loader.gif">');
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
				
				jQuery('#total').html('<label class="control-label">'+response.gtotal +'</label>');
				jQuery('#discount').html('<label class="control-label">'+response.dis_amount +'</label>');
			}
		});
	});
});
</script>	
<script>
jQuery('#country_select').on('change', function (e) {
		var optionSelected = jQuery("option:selected", this);
		var pack_id = jQuery("#package_id").val();
		
		
		//jQuery("#package_id").val(pack_id);
								
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		var search_params={
		"action"  			: "iv_membership_check_package_amount",	
		"coupon_code" 		:jQuery("#coupon_name").val(),
		"package_id" 		: pack_id,
		"package_amount" 	:'<?php echo $package_amount; ?>',
		"api_currency" 		:'<?php echo $api_currency; ?>',
		"form_data"			:jQuery("#iv_membership_registration").serialize(),
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
				jQuery('#p_amount').html('<label class="control-label">'+response.p_amount+'</label>');							
				jQuery('#total').html('<label class="control-label">'+response.gtotal+'</label>');
				jQuery('#tax').html('<label class="control-label">'+response.tax_total+'</label>');
				jQuery('#discount').html('<label class="control-label">'+response.dis_amount+'</label>');
			}
			});
});

	
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
		"form_data"			:jQuery("#iv_membership_registration").serialize(),
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
				jQuery('#p_amount').html('<label class="control-label">'+response.p_amount+'</label>');							
				jQuery('#total').html('<label class="control-label">'+response.gtotal+'</label>');
				jQuery('#tax').html('<label class="control-label">'+response.tax_total+'</label>');
				jQuery('#discount').html('<label class="control-label">'+response.dis_amount+'</label>');
			}
			});
		});	
	});	
</script>	
<script type="text/javascript">
function show_coupon(){
				jQuery("#coupon-div").show();
                 jQuery("#show_hide_div").html('<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label><div class="col-md-8 col-xs-8 col-sm-8 " ><button type="button" onclick="hide_coupon();"  class="btn btn-default center">Hide Coupon</button></div>');
}
function hide_coupon(){
				 jQuery("#coupon-div").hide();
                 jQuery("#show_hide_div").html('<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label><div class="col-md-8 col-xs-8 col-sm-8 " ><button type="button" onclick="show_coupon();"  class="btn btn-default center">Have a coupon?</button></div>');
}
 
 </script>
 								

 


