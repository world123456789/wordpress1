<?php
global $wpdb;

wp_enqueue_style('wp-iv_membership-style-signup-11', WP_iv_membership_URLPATH . 'admin/files/css/iv-bootstrap.css');
wp_enqueue_script('iv_membership-script-signup-12', WP_iv_membership_URLPATH . 'admin/files/js/bootstrap.min.js');
wp_enqueue_script('iv_membership-script-signup-2-15', WP_iv_membership_URLPATH . 'admin/files/js/jquery.form-validator.js');



$api_currency= 'USD';
if( get_option('_iv_membership_api_currency' )!=FALSE ) {
	$api_currency= get_option('_iv_membership_api_currency' );
}	
if(isset($_REQUEST['payment_gateway'])){
	
		$payment_gateway=$_REQUEST['payment_gateway'];
		if($payment_gateway=='paypal'){
			//require_once(WP_iv_membership_DIR . '/admin/pages/payment-inc/paypal-submit.php');
							
		}
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

  <style>
  /* Styles that are also copied for Preview */	
	.vcenter{				
		display : table-cell;
		vertical-align : middle !important;				
		float:none;
	}
	.chili{color:red}
	.chili:before{content:" *"}
  
  #iv-form3 h2{
    font-family: 'Oswald', sans-serif;
    font-weight: 400;
    font-size: 32px;
    line-height: 45px;
    margin-top: 0;
    
  }
  #iv-form3 h1 span{
    font-weight: 100;
    
  }
  .dark-txt{color:#333}
  #iv-form3 h1{
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

  #iv-form3 h3 {
  font-family: Oswald;
  
  font-weight: normal;
  font-style: normal;
  line-height:normal
 
  }
  #iv-form3 p{
    font-size: 1em;
    font-family: 'Roboto', sans-serif;
    color: #575757;
    font-weight: 400;
    line-height: 22px;
  }
  #iv-form3 label{ font-weight:normal;font-size:15px; color:#666}
   #iv-form3 .header-profile div{
	border-bottom: 4px solid #BDC3C7; display:inline-block; margin-bottom:-4px   
	}
	#iv-form3 .form-control{ color:#222}
	#iv-form3 .header-profile{ border-bottom:4px solid #eee;}
	#iv-form3{ max-width:960px}
 </style> 


<div class="bootstrap-wrapper">

	<div id="iv-form3" class="col-md-12">
	<?php
		if($iv_gateway=='paypal-express'){	
		 ?>
	
			<form id="iv_membership_registration" name="iv_membership_registration" class="form-horizontal" action="<?php  the_permalink() ?>?package_id=<?php echo $package_id; ?>&payment_gateway=paypal&iv-submit-listing=register" method="post" role="form">
	
	<?php	
	}
	if($iv_gateway=='stripe'){?>
			<form id="iv_membership_registration" name="iv_membership_registration" class="form-horizontal" action="<?php  the_permalink() ?>?&package_id=<?php echo $package_id; ?>&payment_gateway=stripe&iv-submit-stripe=register" method="post" role="form">
			
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
		
				<div class="row">	
					  <div class="col-md-1">
					  </div>
				   
					  <div class="col-md-10"> 
						<h2 class="header-profile"><div><?php  _e('User Info','wpmembership');?></div></h2>
					  </div>
			 </div>
		
			<div class="row">	
				  <div class="col-md-1 ">
				  </div>
           
              <div class="col-md-10 "> 
					<?php
						 if(isset($_REQUEST['message-error'])){?>
						  <div class="row alert alert-info alert-dismissable" id='loading-2'><a class="panel-close close" data-dismiss="alert">x</a> <?php  echo $_REQUEST['message-error']; ?></div>
						  <?php
						  }
					?>
							
	<!--  
		For Form Validation we used plugins http://formvalidator.net/index.html#reg-form  
		This is in line validation so you can add fields easily. 	
	-->

				
				<div>
						<div id="selected-column-1" class=" ">
						<div class="text-center" id="loading"> </div>
						<div class="form-group row"  >									
						<label for="text" class="col-md-4 control-label"><?php  _e('User Name','wpmembership');?><span class="chili"></span></label>
						<div class="col-md-8">
							<input type="text"  name="iv_member_user_name"  data-validation="length alphanumeric" 
data-validation-length="4-12" data-validation-error-msg="<?php  _e('The user name has to be an alphanumeric value between 4-12 characters','wpmembership');?>" class="form-control ctrl-textbox" placeholder="<?php  _e('Enter User Name','wpmembership');?>"  alt="required">

						</div>
					</div>
					<div class="form-group row">									
						<label for="email" class="col-md-4 control-label" ><?php  _e('Email Address','wpmembership');?><span class="chili"></span></label>
						<div class="col-md-8">
							<input type="email" name="iv_member_email" data-validation="email"  class="form-control ctrl-textbox" placeholder="<?php  _e('Enter email address','wpmembership');?>" data-validation-error-msg=" <?php  _e('Please enter a valid email address.','wpmembership');?>" >
						</div>
					</div>
					<div class="form-group row ">									
						<label for="text" class="col-md-4 control-label"><?php  _e('Password','wpmembership');?><span class="chili"></span></label>
						<div class="col-md-8">
							<input type="password" name="iv_member_password"  class="form-control ctrl-textbox" placeholder="" data-validation="strength" 
		 data-validation-strength="2">
						</div>
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
										 <div class="form-group row">
											<label  class="col-md-4 control-label" ><?php echo _e($field_value, 'wp_ep_fitness'); ?><span class="<?php echo($require=='yes'?'chili':''); ?>"></span></label>
											<div class="col-md-8">
												<input type="text"  name="<?php echo $field_key;?>" <?php echo($require=='yes'?'data-validation="length" data-validation-length="2-100"':''); ?>
												class="form-control ctrl-textbox" placeholder="<?php echo 'Enter '.$field_value;?>" >
											</div>
										</div>
									<?php
									}
								  }
							}
							?>
					</div>							
					</div>	
					
					
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
					<div class="form-group row">									
						<label class="col-md-4 control-label"><?php  esc_html_e('Country','wpmembership');?><span class="chili"></span></label>
						<div class="col-md-8">
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
						

              </div>
         </div>
		
		 <br/>
		 
		<div class="row">	
              <div class="col-md-1 ">
              </div>
           
              <div class="col-md-10 "> 
				<h2 class="header-profile"><div><?php  _e('Payment Info','wpmembership');?></div></h2>
              </div>
         </div>
		 <br/>		
		
				<div class="row">	
					  <div class="col-md-1 ">
					  </div>
           
					<div class="col-md-10 ">
						<?php 														
						if($iv_gateway=='paypal-express'){
							require_once(WP_iv_membership_template.'signup/paypal_form_2.php');
						}
						
						if($iv_gateway=='stripe'){
							require_once(WP_iv_membership_template.'signup/iv_stripe_form_2.php');					
						}	
						if($iv_gateway=='woocommerce'){
							include(WP_iv_membership_template.'signup/woocommerce.php');
						}									
						?>			
				</div>		
			</div>	
		</form>
		<div style="display: none;">
			<img src='<?php echo WP_iv_membership_URLPATH. 'admin/files/images/loader.gif'; ?>' />
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
		jQuery('#coupon-result').html('<img src="<?php echo WP_iv_membership_URLPATH; ?>admin/files/images/old-loader.gif">');
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

jQuery(function(){	
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
	

function show_coupon(){
				jQuery("#coupon-div").show();
                 jQuery("#show_hide_div").html('<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label><div class="col-md-8 col-xs-8 col-sm-8 " ><button type="button" onclick="hide_coupon();"  class="btn btn-default center">Hide Coupon</button></div>');
}
function hide_coupon(){
				 jQuery("#coupon-div").hide();
                 jQuery("#show_hide_div").html('<label for="text" class="col-md-4 col-xs-4 col-sm-4 control-label"></label><div class="col-md-8 col-xs-8 col-sm-8 " ><button type="button" onclick="show_coupon();"  class="btn btn-default center">Have a coupon?</button></div>');
}
 
 </script>
 								

