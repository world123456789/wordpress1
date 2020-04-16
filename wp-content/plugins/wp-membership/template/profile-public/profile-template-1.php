    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <title> </title>
    <!-- Bootstrap -->
    
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
<?php
wp_enqueue_style('wp-iv_membership-style-11', WP_iv_membership_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_script('iv_membership-script-12', WP_iv_membership_URLPATH . 'admin/files/js/bootstrap.min.js');


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
   
    $iv_post = get_option( '_iv_membership_profile_post');
	if($iv_post!=''){
		$post_type=  $iv_post;											
	}else{
		$post_type=  'Post';
	}
  
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>    
<script>
  
function goto_reg_page(){
jQuery('.nav-tabs a[href="#user_reg"]').tab('show');
}
</script>

  </head>
  <style>
  #post-pro1 img{
    width:80px;
    height: 50px;
  }
  #profile-temp1 .entry-content a{
    border:0;
  }
  #profile-temp1 .topmargin{
    margin-top: 25px;
  }
  #profile-temp1 h2{
  margin-bottom: 5px;
  }
  #profile-temp1 .margin-top{
    margin-top: 30px
  }
  #profile-temp1 .active{
    background-color: #fff;
  }
  #profile-temp1 a{
  border:none !important;
  text-decoration: none;
}
  #profile-temp1 .thumb{
    border: 1px solid #ddd;
    
    width:80px;
    height: 80px;
    margin: 15px 
  }
  #profile-temp1 h3{
    margin-top: 25px;
    margin-bottom: 0;
  }
  .bar{
    width: 100%;
    background-color: #48a9d0;
    padding: 10px 10px;
    color:#fff;
  }
  #profile-temp1 .agent{
    width: 140px;
    height: auto;
    margin: 30px 0 0;
  }
 #profile-temp1 .agent1{
    width: 150px;
    height: 30px;
    margin: 0 0 25px;
    text-align: center;
  }
  .agent-name{
    border-bottom: 1px dotted #ddd;
    color:#888;
    padding-bottom: 10px;
    margin-bottom: 1px;
    margin-top: 27px;
    text-transform: capitalize;
  }
  .bottom-dotted{
    border-bottom:1px dotted #ddd;
    margin-bottom: 1px;
  }
  .bottom-dotted1{
    border-bottom:1px dotted #ddd;
    margin-bottom: 10px;
  }
  .para{
    font-size: 15px;
    font-family: 'open-sans',sans-serif;
  }
  .bar ul li {
    display: inline-block;
    color: #fff; 
    margin-top: -10px;
    padding: 19px 10px 0;
  }
  #profile-temp1 .bar h5{
    display: inline-block;
  }
  /* carousel */
blockquote{
  font-size: 12px;
}
#quote-carousel 
{
  padding: 0 10px 30px 10px;
  margin-top: 30px;
}

/* Control buttons  */
#quote-carousel .carousel-control {
background: none;
color: #222;
font-size: 1em;
text-shadow: none;
margin-right: 47px;
margin-left: 5px;
margin-top: 10px;
}/* Previous button  */
#quote-carousel .carousel-control.left 
{
  right: 0px !important; 
}
/* Next button  */
#quote-carousel .carousel-control.right 
{
  right: -2px !important;
}
/* Changes the position of the indicators */
#quote-carousel .carousel-indicators 
{
  right: 50%;
  top: auto;
  bottom: 0px;
  margin-right: -19px;
}
/* Changes the color of the indicators */
#quote-carousel .carousel-indicators li 
{
  background: #c0c0c0;
}
#quote-carousel .carousel-indicators .active 
{
  background: #333333;
}
#quote-carousel img
{
  width: 100px;
  height: 80px
}
/* End carousel */

.item blockquote {
    border-left: none; 
    margin: 0;
}
.carousel-control {
position: absolute;
top: 0;
bottom: 0;
left: -40px;
width: 92%;
font-size: 20px;
color: #fff;
text-align: right;
text-shadow: 0 1px 2px rgba(0,0,0,.6);
filter: alpha(opacity=50);
opacity: .5;
}
#profile-temp1 p{
  color:#888;
}
#profile-temp1 ul{
  margin-left: 0;
  }
#profile-temp1 ul li{
  margin-left: 0;
  }

#profile-temp1 blockquote{
  border-left: 0px;
}
  .pad-left{
      padding-left: 15px;
    }
}
}

.item blockquote img {
    margin-bottom: 10px;
}

.item blockquote p:before {
    content: "\f10d";
    font-family: 'Fontawesome';
    float: left;
    margin-right: 10px;
}
.info .list{
  width: 25%;
}
.info li{
  width: 75%;
  display: inline-block;
  border-bottom: 1px dotted #ddd;
  margin-bottom: 10px;
  color: #888;
  float: left;
  padding:0 5px 10px;
  font-size: 12px;
}
.info li:last-child{
  border-bottom: 0px dotted #ddd;
}
.b-none{
  border-bottom: 0px dotted #ddd !important;
  margin-bottom: 20px !important;
}
.carousel-inner{
  border: 1px solid #eee;
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
 #profile-temp1 .fa{
    font-size: 20px;
  }
  .fa-chevron-right{
    color: #fff;
    opacity: 1;
  }
  .fa-chevron-left{
    color: #fff;
    opacity: 1;
  }
  .reset-margin{
    margin-right: 0 !important;
    margin-left: 0 !important;
  }
  #profile-temp1 .bg{
    background-color: #fff;
    border-right: 1px solid #eee;
    border-left: 1px solid #eee;
    padding: 0 !important;
  }
  .description{
    padding-bottom: 20px;
  }
@media (min-width: 768px) { 
    #quote-carousel 
    {
      margin-bottom: 0;
      padding: 0;
    }
    #quote-carousel .carousel-control.left {
left: 147px !important;
}
 #quote-carousel .carousel-control {
  margin-right: 10px;
 }   
 .agent1{margin-left: 0;}
}

/* Small devices (tablets, up to 768px) */
@media (max-width: 768px) { 
    
    /* Make the indicators larger for easier clicking with fingers/thumb on mobile */
    
    #quote-carousel .carousel-indicators {
        bottom: -20px !important;  
    }
    #quote-carousel .carousel-indicators li {
        display: inline-block;
        margin: 0px 5px;
        width: 15px;
        height: 15px;
    }
    #quote-carousel .carousel-indicators li.active {
        margin: 0px 5px;
        width: 20px;
        height: 20px;
    }
  }
  @media (min-width: 767px){
  #quote-carousel .carousel-control.left {
  left: 70% !important;
  }
  #quote-carousel .carousel-control.left {
  right: 0px !important;
  }
}
  </style>

    <div id="profile-temp1" class="bootstrap-wrapper wrapper">
      <div class="row">
        <div class="col-md-12">
        <div class="row">
          <div class="bar">
            <h2><?php  _e('Profile','wpmembership');?></h2>
          </div>
        </div>
        </div>
      </div>
      <div class="row reset-margin">
        <div class="col-md-12 bg">
        <div class="row bg">
        <div class="col-md-3 topmargin">
					<?php
				  	
				  	if($iv_profile_pic_url!=''){ ?>
					 <img src="<?php echo $iv_profile_pic_url; ?>">
					<?php
					}else{
					 echo'	 <img src="'. WP_iv_membership_URLPATH.'assets/images/Blank-Profile.jpg" class="agent">';
					}
				  	?>
          <div class="agent1">
          <a href="http://www.twitter.com/<?php  echo get_user_meta($user_id,'twitter',true);  ?>/">
          <i class="fa fa-twitter-square"></i>
          </a>
          <a href="http://www.linkedin.com/<?php  echo get_user_meta($user_id,'linkedin',true);  ?>/">             
          <i class="fa fa-linkedin-square"></i>
          </a>
          <a href="http://www.facebook.com/<?php  echo get_user_meta($user_id,'facebook',true);  ?>/">
          <i class="fa fa-facebook-square"></i>
          </a>
          <a href="http://www.plus.google.com/<?php  echo get_user_meta($user_id,'gplus',true);  ?>/">            
          <i class="fa fa-google-plus-square"></i>
          </a>
          </div>
        </div>
        <div class="col-md-5 pad-left">
            <div class="bottom-dotted1"><div class="bottom-dotted">
          <h3 class="agent-name"><i class="fa fa-dot-circle-o"></i><?php 
				   $name_display=get_user_meta($user_id,'first_name',true).' '.get_user_meta($user_id,'last_name',true);
				   echo (trim($name_display)!=""? $name_display : $display_name );?></h3>
          </div></div>
          <div class="clearfix">
          <ul class="list-unstyled info">
            <?php
          if( get_user_meta($user_id,'hide_phone',true)==''){ ?>
            <li class="list"><b><?php  _e('Phone','wpmembership');?></b></li>
            <li class="text-right"><?php echo get_user_meta($user_id,'phone',true); ?>.
            </li>
            <?php
          }
          if( get_user_meta($user_id,'hide_mobile',true)==''){ ?>
            <li class="list"><b><?php  _e('Mobile','wpmembership');?></b></li>
            <li class="text-right">   
          <?php echo  get_user_meta($user_id,'mobile',true); ?>.</li>
            <?php
          }
          
          if( get_user_meta($user_id,'hide_email',true)==''){ ?>
            <li class="list"><b>      
          <?php  _e('Email','wpmembership');?></a></b></li>
            <li class="text-right"><?php echo $email; ?>.</li>
            <?php
          }
        
            ?>
            <li class="b-none list"><b><?php  _e('Website','wpmembership');?></b></li>
            <li class="text-right"><?php  echo get_user_meta($user_id,'web_site',true); ?>.</li>
            
          </ul>
          
          </div>
          <p class="para">
          <?php echo get_user_meta($user_id,'description',true); ?> 
          </p>
        </div>
        <div class="col-md-4" id="#post-pro1">
            
          
           <div class='row'>
              
                <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                  <!-- Bottom Carousel Indicators -->
                 
                  
                  <!-- Carousel Slides / Quotes -->
                  
                     <div class="bar">
                        <?php  _e('Posts','wpmembership');?>
                    </div>
                    <div class="carousel-inner" id="post-pro1">
                    <?php	
                    
							global $wpdb;
							$sql="SELECT * FROM $wpdb->posts WHERE post_type = '".strtolower($post_type)."' and post_author='".$user_id."' and post_status='publish' ORDER BY  ID DESC limit 0, 50";
							
							$authpr_post = $wpdb->get_results($sql);
							$total_post=count($authpr_post);
							//echo'$total_package.....'.$total_package;
							if(sizeof($total_post)>0){
								$i=0;
								foreach ( $authpr_post as $row )								
								{?>
									<div class="item <?php echo ($i==0 ? 'active': ''); ?>">
											  <div class="row">
												<div class="col-sm-4 text-center" >
												  <div class="thumb">
													  <a href="<?php echo get_permalink( $row->ID ); ?>">
												   <?php  echo get_the_post_thumbnail( $row->ID, 'thumbnail' ); //the_post_thumbnail(); ?>
												   </a>
												   </div> 
												</div>
												<div class="col-sm-7 col-sm-offset-1">
											       <div class="margin-top">
														<p class="para"><a href="<?php echo get_permalink( $row->ID ); ?>"> <?php echo $row->post_title;?> </a></p>	
														 <p class="para"><?php  _e('Post date:','wpmembership');?> <?php echo date('d M Y',strtotime($row->post_date)); ?></p>																
													  </div>
													</div>
											  </div>
											</div>	
								
								<?php
								$i++;	
								}
							}		
                    
                    ?>
                   </div>
				   
                  <!-- Carousel Buttons Next/Prev -->
                  <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                  <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                                         
              </div>
            
          </div>
        </div>   
        </div>   
      </div>
      </div>
      <div class="row">
        <div class="col-md-12">
        <div class="row">
          <div class="bar">
            
          </div>
        </div>
      </div>
    </div>
	</div>

		
