          <div class="profile-content">            
              <div class="portlet row light">
                  <div class="portlet-title tabbable-line clearfix">
                    <div class="caption caption-md">
                      <span class="caption-subject"><?php  _e('Billing Address','wpmembership');?></span>
                    </div>
                 
                  </div>
                  
                  <div class="portlet-body">
                    <div class="tab-content">
                   
                   
                        <form role="form" name="profile_setting_form" id="profile_setting_form" action="#">
                          <div class="form-group">
                            <label class="control-label"><?php  _e('First Name','wpmembership');?> </label>
                            <input type="text" placeholder="John" name="first_name" id="first_name"  class="form-control" value="<?php echo get_user_meta($current_user->ID,'billing_first_name',true); ?>"/>
                          </div>
                          
                          
                          <div class="form-group">
                            <label class="control-label"><?php  _e('Last Name','wpmembership');?></label>
                            <input type="text" placeholder="Doe"  name="last_name" id="last_name" class="form-control"  value="<?php echo get_user_meta($current_user->ID,'billing_last_name',true); ?>" />
                          </div>
                           
                          <div class="form-group">
                            <label class="control-label"><?php  _e('Company','wpmembership');?></label>
                            <input type="text" placeholder="Doe"  name="company" id="company" class="form-control"  value="<?php echo get_user_meta($current_user->ID,'billing_company',true); ?>" />
                          </div>
                          
                          <div class="form-group">
                            <label class="control-label"><?php  _e('Phone','wpmembership');?> </label>
                            <input type="text" placeholder="+1 646 580 232" name="phone" id="phone" class="form-control"  value="<?php echo get_user_meta($current_user->ID,'billing_phone',true); ?>"/>
                          </div>
						 
                          
                          <div class="form-group">
                            <label class="control-label"><?php  _e('Address','wpmembership');?></label>
                            <input type="text" placeholder="" name="address" id="address" value="<?php echo get_user_meta($current_user->ID,'billing_address_1',true); ?>" class="form-control"/>
                          </div>
                          <div class="form-group">
                            <label class="control-label"><?php  _e('Address 2','wpmembership');?></label>
                            <input type="text" placeholder="apartment, Suite, unit etc" class="form-control"  name="address2" id="address2" value="<?php echo get_user_meta($current_user->ID,'billing_address_2',true); ?>" />
                          </div>
                         
                          <div class="form-group">
                            <label class="control-label"><?php  _e('City','wpmembership');?> </label>
                            <input type="text"id="city" name="city" placeholder="<?php  _e('Enter City','wpmembership');?>" class="form-control" value ="<?php echo get_user_meta($current_user->ID,'billing_city',true);?>"/>
                          </div>	
                          <div class="form-group">
                            <label class="control-label"><?php  _e('State','wpmembership');?> </label>
                            <input type="text"id="state" name="state" placeholder="<?php  _e('Enter State','wpmembership');?>" class="form-control" value ="<?php echo get_user_meta($current_user->ID,'billing_state',true);?>"/>
                          </div>
                          <div class="form-group">
                            <label class="control-label"><?php  _e('Zip','wpmembership');?> </label>
                            <input type="text"id="zip" name="zip" placeholder="<?php  _e('Enter Zip','wpmembership');?>" class="form-control" value ="<?php echo get_user_meta($current_user->ID,'billing_postcode',true);?>"/>
                          </div>
                           <div class="form-group">
                            <label class="control-label"><?php  _e('Country','wpmembership');?> </label>
                            
                           <select name="country" id ="country" class=" form-control">
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
								$current_country= get_user_meta($current_user->ID,'billing_country',true);
								foreach($countries as $key=>$country) {
										echo '<option value="'. $key.'" '.($current_country==$key?' selected':'').'>'. $country.'</option>';
										if($i==0){$first_country=$key;}
										$i++;
									}	
								?>
                            </select>
                                                       
                            
                          </div>
                         
                          <div class="margiv-top-10">
						    <div class="" id="update_message"></div>
						    <button type="button" onclick="update_profile_billing();"  class="btn green-haze"><?php  _e('Save Changes','wpmembership');?></button>
                          
                          </div>
                        </form>
                  </div>
                </div>
              </div>
            </div>
          <!-- END PROFILE CONTENT -->
 <script>
 
function update_profile_billing (){
	
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	var loader_image = '<img src="<?php echo WP_iv_membership_URLPATH. "admin/files/images/loader.gif"; ?>" />';
				jQuery('#update_message').html(loader_image);
				var search_params={
					"action"  : 	"iv_membership_update_profile_billing",	
					"form_data":	jQuery("#profile_setting_form").serialize(), 
				};
				jQuery.ajax({					
					url : ajaxurl,					 
					dataType : "json",
					type : "post",
					data : search_params,
					success : function(response){
						
						jQuery('#update_message').html('<div class="alert alert-info alert-dismissable"><a class="panel-close close" data-dismiss="alert">x</a>'+response.msg +'.</div>');
						
					}
				});
	
	} 

 </script>	
        
