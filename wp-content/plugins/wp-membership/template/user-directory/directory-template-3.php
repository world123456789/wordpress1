<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<title> </title> 
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,700' rel='stylesheet' type='text/css'>
<?php
wp_enqueue_style('wp-iv_membership-style-11', WP_iv_membership_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_script('iv_membership-script-12', WP_iv_membership_URLPATH . 'admin/files/js/bootstrap.min.js');
//wp_enqueue_media(); 
?>
<style>
#directory-template1 .view-first img {
	   -webkit-transition: all 0.2s linear;
	   -moz-transition: all 0.2s linear;
	   -o-transition: all 0.2s linear;
	   -ms-transition: all 0.2s linear;
	   transition: all 0.2s linear;
	}
#directory-template1 .view-first .mask {
	   -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
	   filter: alpha(opacity=0);
	   opacity: 0;
	   background-color: rgba(0,0,0, 0.5);
	   -webkit-transition: all 0.4s ease-in-out;
	   -moz-transition: all 0.4s ease-in-out;
	   -o-transition: all 0.4s ease-in-out;
	   -ms-transition: all 0.4s ease-in-out;
	   transition: all 0.4s ease-in-out;
	}
#directory-template1 .view-first h2 {
	   -webkit-transform: translateY(-100px);
	   -moz-transform: translateY(-100px);
	   -o-transform: translateY(-100px);
	   -ms-transform: translateY(-100px);
	   transform: translateY(-100px);
	   -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
	   filter: alpha(opacity=0);
	   opacity: 0;
	   -webkit-transition: all 0.2s ease-in-out;
	   -moz-transition: all 0.2s ease-in-out;
	   -o-transition: all 0.2s ease-in-out;
	   -ms-transition: all 0.2s ease-in-out;
	   transition: all 0.2s ease-in-out;
	}
#directory-template1 .view-first p {
	   -webkit-transform: translateY(100px);
	   -moz-transform: translateY(100px);
	   -o-transform: translateY(100px);
	   -ms-transform: translateY(100px);
	   transform: translateY(100px);
	   -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
	   filter: alpha(opacity=0);
	   opacity: 0;
	   -webkit-transition: all 0.2s linear;
	   -moz-transition: all 0.2s linear;
	   -o-transition: all 0.2s linear;
	   -ms-transition: all 0.2s linear;
	   transition: all 0.2s linear;
	}
#directory-template1 .view-first:hover img {
	   -webkit-transform: scale(1.1,1.1);
	   -moz-transform: scale(1.1,1.1);
	   -o-transform: scale(1.1,1.1);
	   -ms-transform: scale(1.1,1.1);
	   transform: scale(1.1,1.1);
	}
#directory-template1 .view-first a.info {
	   -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=0)";
	   filter: alpha(opacity=0);
	   opacity: 0;
	   -webkit-transition: all 0.2s ease-in-out;
	   -moz-transition: all 0.2s ease-in-out;
	   -o-transition: all 0.2s ease-in-out;
	   -ms-transition: all 0.2s ease-in-out;
	   transition: all 0.2s ease-in-out;
	}
#directory-template1 .view-first:hover .mask {
	   -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)";
	   filter: alpha(opacity=100);
	   opacity: 1;
	}
#directory-template1 .view-first:hover h2,
#directory-template1 .view-first:hover p,
#directory-template1 .view-first:hover a.info {
	   -ms-filter: "progid: DXImageTransform.Microsoft.Alpha(Opacity=100)";
	   filter: alpha(opacity=100);
	   opacity: 1;
	   -webkit-transform: translateY(0px);
	   -moz-transform: translateY(0px);
	   -o-transform: translateY(0px);
	   -ms-transform: translateY(0px);
	   transform: translateY(0px);
	}
#directory-template1 .view-first:hover p {
	   -webkit-transition-delay: 0.1s;
	   -moz-transition-delay: 0.1s;
	   -o-transition-delay: 0.1s;
	   -ms-transition-delay: 0.1s;
	   transition-delay: 0.1s;
	}
#directory-template1 .view-first:hover a.info {
	   -webkit-transition-delay: 0.2s;
	   -moz-transition-delay: 0.2s;
	   -o-transition-delay: 0.2s;
	   -ms-transition-delay: 0.2s;
	   transition-delay: 0.2s;
	}
#directory-template1 .view {
	   width: 300px;
	   display: inline-block;
	   overflow: hidden;
	   position: relative;
	   text-align: center;
	   -webkit-box-shadow: 1px 1px 2px #e6e6e6;
	   -moz-box-shadow: 1px 1px 2px #e6e6e6;
	   box-shadow: 1px 1px 2px #e6e6e6;
	   cursor: default;
	   background: #fff url(../images/bgimg.jpg) no-repeat center center;
	}
#directory-template1 .view .mask,.view .content {
	   width: 300px;
	   height: 100%;
	   position: absolute;
	   overflow: hidden;
	   top: 0;
	   left: 0;
	}
#directory-template1 .view img {
	   display: block;
	   position: relative;
	}
#directory-template1 .view h4 {
	   text-transform: uppercase;
	   color: #fff;
	   text-align: center;
	   position: relative;
	   font-size: 17px;
	   padding: 10px;
	   margin: 20px 0 0 0;
	   font-size: 18px;
	}
#directory-template1 .view p {
	   font-family: Georgia, serif;
	   font-style: italic;
	   font-size: 40px;
	   position: relative;
	   color: #fff;
	   padding: 10px 20px 20px;
	   text-align: center;
	   margin: 15px auto;
	}
#directory-template1 .view a.info {
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
#directory-template1 .view a.info:hover {
	   -webkit-box-shadow: 0 0 5px #000;
	   -moz-box-shadow: 0 0 5px #000;
	   box-shadow: 0 0 5px #000;
	}
#directory-template1  .main{
	   margin: 0 auto;
	   text-align: center;
	}
#directory-template1  .search{
	   margin: 20px auto;
	   width: 250px;
	   padding: 15px 15px;
	   font-size: 16px;
	   outline: none;
	   height: 30px
	}
#directory-template1  input:focus{
	border: 1px solid #555;
	outline: none;
	}
#directory-template1  .submit{
	   position: relative;
	   right: 50px;
	   background: transparent;
	   border: none;
	   outline: none;
	   box-shadow: none;
	   filter:none;
	}
#directory-template1  .fa{
	   font-size: 20px;
	}
	 .home-img {
	   width:100%; height:200px; overflow:hidden; text-align:center
	}
	.home-img img.wide {
	    max-width: 100%;
	    max-height: 100%;
	    height: auto;
	}

	.home-img img.tall  {
	    max-height: 100%;
	    max-width: 100%;
	    width: auto;
	  }
</style>
<body>
        <div id="directory-template1" class="container">
            <div  class="main">
                <form>
                    <input type="text" class="search" placeholder="User Name">
                    <button class="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="main">
        <?php
        $user_query = new WP_User_Query( array( 'number' => 10 ) );
        // User Loop
        if ( ! empty( $user_query->results ) ) {
        	foreach ( $user_query->results as $user ) {        		
        		 $iv_profile_pic_url=get_user_meta($user->ID, 'iv_profile_pic_thum',true);
		    ?><div class="view view-first">
                    <?php
                    if($iv_profile_pic_url!=''){ ?>
		        	 <img src="<?php echo $iv_profile_pic_url; ?>" class="home-img wide tall">
		        	<?php
		        	}else{
		        	 echo'	 <img src="'. WP_iv_membership_URLPATH.'assets/images/Blank-Profile.jpg" class="home-img wide tall">';
		   		} ?>
                    <div class="mask">
                        <h4><?php echo  $user->display_name; ?></h4>
                        <p><i class="fa fa-link"></i></p>
                    </div>
                </div><?php
	}
        } else {
        	echo 'No users found.';
        }

        ?>
            </div>
        </div>
    </body>
    <script>
    (function($){
      jQuery(window).load(function() {
          jQuery('.home-img').find('img').each(function() {
              var imgClass = (this.width / this.height > 1) ? 'wide' : 'tall';
              jQuery(this).addClass(imgClass);
          })    
       
      })
     }); 
    </script>
