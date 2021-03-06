		<style>	
		
		.activeDroppable {
			background-color: #eeffee;
		}

		.hoverDroppable {
			background-color: lightgreen;
		}

		.draggableField {
			/* float: left; */
			padding-left:5px;
		}
		
		.draggableField > input,select, button, .checkboxgroup, .selectmultiple, .radiogroup {
			margin-top: 10px;
			
			margin-right: 10px;
			margin-bottom: 10px;
		}

		.draggableField:hover{
			background-color: #ccffcc;
		}
		.modal-body{
			text-align:center;
		}
		.min-height{
			min-height:200px !important;
		}
		.checkbox_custom{
			margin-left:-100px !important;
		}	
		button.bookmark {
			border:none;
			background: none;
			padding: 0;
			vertical-align: middle;
		}
		.html-active .switch-html,.tmce-active .switch-tmce {
			height: 28px!important;
		}
		.wp-switch-editor {
			height: 28px!important;
		}
		.vcenter {
			display: inline-block;
			vertical-align: middle;
			float: none;
		}
		<!--
		.bg-image_drag{
			background-image: url(<?php echo WP_iv_membership_URLPATH; ?>admin/files/images/DragDropFile.png);
			background-position:center center;
		}
		-->
		.custom_style{
			background:url("<?php echo WP_iv_membership_URLPATH; ?>admin/files/images/images1.jpg") center 60% no-repeat;
			text-align:center;
		}
		.custom_style:before{content:"Drop Here From Left"; margin-top:100px;}
		.drop_dashed{border: 2px dashed grey;}
		.arrow_right{margin-top:195px;}
		.onlypadding{padding:0 8px 0 11px}
		.chili{color:red}
		.chili:before{content:" *"}
		</style>
		
		
	</style>
	
	
	<style id="content-styles">
	/* Styles that are also copied for Preview */
	
	.chili{color:red}
	.chili:before{content:" *"}

	</style>
	
	<script id="content-script">		
	
	jQuery(document).ready(function(){
		jQuery("#submit_iv_membership_payment").on("click",function(){
						// validation
						
						
						var form_name = "#iv_membership_payment";
						var valid = 1;
						var succes_mess= "<?php echo get_option('iv_membership_success_message'); ?>";
						var fail_mess= "<?php echo get_option('iv_membership_fail_message'); ?>";
						var loader_image = "<img src='<?php echo WP_iv_membership_URLPATH. 'admin/files/images/loader.gif'; ?>' />";
					
						
						var values = {};
						jQuery.each(jQuery(form_name).serializeArray(), function(i, field) {
							values[field.name] = field.value;
						});
						
						jQuery.each(values, function(name,value) {
							var field_name = "[name="+name+"]";
							
							var label_name = jQuery("[name="+name+"]").parent().prev().text()
							val = jQuery(field_name).attr("required");
							if (typeof val !== "undefined") {
								if(value==""){
									valid =0;
									jQuery(field_name).css("border-color","red");									
									jQuery('#loading_payment').html("A required field ("+jQuery.trim(label_name)+") is empty"); 
									return false;
								}
								else{
									jQuery(field_name).css("border-color","#cccccc");
								}
							}
							if((name.indexOf("iv_member_email") !== -1) && jQuery.trim(value)!=""){
								if(!isValidEmailAddress(jQuery.trim(value))){
									valid =0;
									jQuery(field_name).css("border-color","red");									
									jQuery('#loading_payment').html("Email address is invalid."); 
									return false;
								}
								else{
									jQuery(field_name).css("border-color","#cccccc");
								}
							}
							if((name.indexOf("iv_member_email") !== -1) && jQuery.trim(value)=="" && typeof val === "undefined"){
								jQuery(field_name).css("border-color","#cccccc");
							}
						});
						// end validation
						if(valid == 1){
							var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
							var search_params={
								"action"  : "iv_membership_payment_submit",
								"form_data":	jQuery("#iv_member_form_iv").serialize(), 
								"form_reg":	jQuery("#iv_member_form_iv").serialize(), 
							};
							
							jQuery("#loading_payment").html(loader_image);
							jQuery.ajax({					
								url : ajaxurl,								
								dataType : "json",
								type : "post",
								data : search_params,
								success : function(response){
									jQuery('#loading_payment').html(response);
									
									if(response=="success"){
											jQuery('#loading_payment').html(succes_mess); 
										jQuery("#theform_contact")[0].reset();
									}
									if(response=="mail-error"){
										
										jQuery('#loading_payment').html(fail_mess); 
									}
									if(response=="captcha_error"){
												jQuery("#loading_payment").html("Email address is invalid");
												jQuery('#loading_payment').html("Math Error: You have entered an incorrect result value. Please try again."); 
										
									}
								}
							});
						}

					});


	});
	
		</script>	
			
		<script>
		jQuery(document).on("click", ".draggableField", function () {
			var me = jQuery(this)
			var ctrl = me.find("[class*=ctrl]")[0];
			var ctrl_type = jQuery.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
				//console.log(this.id)
				customize_ctrl(ctrl_type, this.id);
				
			});
		
		/* fucntion to check wehther right form has element or not*/
		function dropContentCheck(){
			var content = jQuery.trim(jQuery("#selected-column-1").html())
			if(content==""){
				jQuery("#selected-column-1").addClass( "custom_style" );
			}
			jQuery("#selected-column-1").addClass( "drop_dashed" );
		}
		/* function to remove drop image and text */
		function dropImageRemove(){
			jQuery("#selected-column-1").removeClass( "custom_style" );
		}
		/* Make the control draggable */
		function makeDraggable() {
			jQuery(".selectorField").draggable({ helper: "clone",stack: "div",cursor: "move", cancel: null  });
		}

		var _ctrl_index = 100;
		var name_number = 1;
		function docReady() {
				//console.log("document ready");
				dropContentCheck();		
				compileTemplates();
				
				makeDraggable();
				
				jQuery( ".droppedFields" ).droppable({
					activeClass: "activeDroppable",
					hoverClass: "hoverDroppable",
					accept: ":not(.ui-sortable-helper)",
					drop: function( event, ui ) {
						dropImageRemove();
						//console.log(event, ui);
						var draggable = ui.draggable;				
						draggable = draggable.clone();
						draggable.removeClass("selectorField");
						draggable.addClass("droppedField");
						draggable[0].id = "CTRL-DIV-"+(_ctrl_index++); // Attach an ID to the rendered control
						draggable.appendTo(this);		
						var checkInput = (jQuery(this).find("div:last input:last").attr("name"))
						if (typeof checkInput !== "undefined") {
							var currentName = jQuery(this).find('input:last').attr('name')
							var counter =-2;
							jQuery("input[name='"+currentName+"']").each(function(){counter++});
							if(counter>1){
								var newName = currentName+name_number;
								jQuery(this).find('input:last').attr('name', newName);
								if(currentName.indexOf('captcha') !== -1){
									newName = jQuery(this).find("input[type=hidden]").attr('name')+name_number
									jQuery(this).find("input[type=hidden]").attr('name', newName);
								}
								name_number++;								
							}
						}		
						

						/* Once dropped, attach the customization handler to the control */
						draggable.click(function () {
							
												// The following assumes that dropped fields will have a ctrl-defined. 
												//   If not required, code needs to handle exceptions here. 
												var me = jQuery(this)
												var ctrl = me.find("[class*=ctrl]")[0];
												var ctrl_type = jQuery.trim(ctrl.className.match("ctrl-.*")[0].split(" ")[0].split("-")[1]);
												customize_ctrl(ctrl_type, this.id);
												//window["customize_"+ctrl_type](this.id);
											});

						makeDraggable();
					}
				});		

		/* Make the droppedFields sortable and connected with other droppedFields containers*/
		jQuery( ".droppedFields" ).sortable({
												cancel: null, // Cancel the default events on the controls
												connectWith: ".droppedFields"
											}).disableSelection();
	}
	

			/*
				Preview the customized form 
					-- Opens a new window and renders html content there.
					*/
function update_payment_form() {
						
						//tinyMCE.triggerSave();			
						
						
						var selected_content =jQuery("#selected-content").clone();
						selected_content.find("div").each(function(i,o) {
							var obj = jQuery(o)
							obj.removeClass("draggableField ui-draggable well ui-droppable ui-sortable");
						});
						selected_content.find("#form-title-div").remove();
						
						var selected_content_main =jQuery("#selected-content").clone();
						selected_content_main.find("#form-title-div").remove();
						
						var selected_content_html = selected_content.html();	
						
						var scriptContent='\n'+jQuery("#content-script").html()+'\n';
						
						
						var dialogContent  ='';
						//dialogContent+= '<link href="<?php echo WP_iv_membership_URLPATH; ?>admin/files/css/iv-bootstrap.css" rel="stylesheet" media="screen">\n';
						dialogContent+='<style>\n'+jQuery("#content-styles").html()+'\n</style>\n';
						
						
						
						//dialogContent+= '<div class="bootstrap-wrapper "><div class="container-fluid iv-custom-width">';
						dialogContent+= '';
						dialogContent+= selected_content_html;
						dialogContent+= '';

						var source_dialogContent='<br/><br/><b>Source code: </b><pre>'+jQuery('<div/>').text(dialogContent).html();+'</pre>\n\n';
						
						
						//dialogContent+= '</div></div>';
						var form_elements="";
						
						jQuery('#iv_member_form_iv input, textarea, select').each(function() {				
							form_elements=form_elements + '|'+ jQuery(this).attr('name');
							
						});
						
									
						
						
						var iv_client_email =		jQuery("#client-email").val();				 
						var hidden_form_id =		jQuery("#hidden_form_id").val();
						var hidden_form_name =		jQuery("#hidden_form_name").val();  
						var search_params={
							"action"  : 				"iv_membership_update_form_payment", 
							"source_formContent" : 	source_dialogContent,								
							"form_content" : 			dialogContent,
							"script_content" : 		scriptContent,					  
							"form_mdata" :     		selected_content_main.html(),							
							"hidden_form_id" 	:	hidden_form_id, 
							'hidden_form_name': 	hidden_form_name,
							
							
						};
						jQuery.ajax({					
							url : ajaxurl,					 
							dataType : "json",
							type : "post",
							data : search_params,
							success : function(response){
								//jQuery('#p_title').html('Your Form ['+jQuery("[name=post-title]").val() +']' );
								alert('Successfully Updated');
							}
						});
					//jQuery('#update_message').html('<h3>Successfully Updated</h3>');
					
					
				}
				
				if(typeof(console)=='undefined' || console==null) { console={}; console.log=function(){}}
				
				/* Delete the control from the form */
				function delete_ctrl() {
				//if(window.confirm("Are you sure about this?")) {
					var ctrl_id = jQuery("#theForm").find("[name=forCtrl]").val();
					//console.log(ctrl_id);
					
					jQuery("#"+ctrl_id).remove();
					dropContentCheck();	
				//}
			}
			
			/* Compile the templates for use */
			function compileTemplates() {
				window.templates = {};
				window.templates.common = Handlebars.compile(jQuery("#control-customize-template").html());
				
				
				// Mostly we donot need so many templates
				
				window.templates.textbox = Handlebars.compile(jQuery("#textbox-template").html());
				window.templates.passwordbox = Handlebars.compile(jQuery("#textbox-template").html());
				window.templates.combobox = Handlebars.compile(jQuery("#combobox-template").html());
				window.templates.selectmultiplelist = Handlebars.compile(jQuery("#combobox-template").html());
				window.templates.radiogroup = Handlebars.compile(jQuery("#combobox-template").html());
				window.templates.checkboxgroup = Handlebars.compile(jQuery("#combobox-template").html());
				
				
				window.templates.textarea = Handlebars.compile(jQuery("#textarea-template").html());
				window.templates.textbox = Handlebars.compile(jQuery("#textbox-template").html()+jQuery("#textbox-required-template").html());
				window.templates.passwordbox = Handlebars.compile(jQuery("#textbox-template").html()+jQuery("#textbox-required-template").html());
				
				
			}
			
			// Object containing specific "Save Changes" method
			save_changes = {};
			
			// Object comaining specific "Load Values" method. 
			load_values = {};
			
			
			/* Common method for all controls with Label and Name */
			load_values.common = function(ctrl_type, ctrl_id) {
				var form = jQuery("#theForm");
				var div_ctrl = jQuery("#"+ctrl_id);
				
				form.find("[name=label]").val(div_ctrl.find('.control-label').text())
				var specific_load_method = load_values[ctrl_type];
				if(typeof(specific_load_method)!='undefined') {
					specific_load_method(ctrl_type, ctrl_id);		
				}
			}
			
			
			
			/* Specific method to load values from a textbox control to the customization dialog */
			load_values.textbox = function(ctrl_type, ctrl_id) {
				var form = jQuery("#theForm");
				var div_ctrl = jQuery("#"+ctrl_id);
				var ctrl = div_ctrl.find("input")[0];
				if(typeof(div_ctrl.find("input")[1])!=='undefined'){
					var captchaName = jQuery(div_ctrl).find('input:last').attr('name')
					if(captchaName.indexOf('captcha') !== -1){
						ctrl = div_ctrl.find("input")[1];
					}
				}		
				form.find("[name=name]").val(ctrl.name)	;	
				form.find("[name=placeholder]").val(ctrl.placeholder);
				// start required @zea
				if(ctrl.alt=="required"){
					form.find("[name=required]").prop('checked', true);
				}
				else{
					form.find("[name=required]").prop('checked', false);
				}
				// end required
				
			}
			load_values.textarea = function(ctrl_type, ctrl_id) {
				
				var form = jQuery("#theForm");
				var div_ctrl = jQuery("#"+ctrl_id);
				var ctrl = div_ctrl.find("textarea")[0];			
				form.find("[name=name]").val(ctrl.name);		
				form.find("[name=placeholder]").val(ctrl.placeholder);
				// start required @zea
				if(ctrl.alt=="required" || ctrl.required==true){
					form.find("[name=required]").prop('checked', true);
				}
				else{
					form.find("[name=required]").prop('checked', false);
				}				
				// end required
				
			}
			
			// Passwordbox uses the same functionality as textbox - so just point to that
			load_values.passwordbox = load_values.textbox;

			
			/* Specific method to load values from a combobox control to the customization dialog  */
			load_values.combobox = function(ctrl_type, ctrl_id) {
				var form = jQuery("#theForm");
				var div_ctrl = jQuery("#"+ctrl_id);
				var ctrl = div_ctrl.find("select")[0];
				form.find("[name=name]").val(ctrl.name)
				// start required @zea
				if(ctrl.alt=="required" || ctrl.required==true){
					form.find("[name=required]").prop('checked', true);
				}
				else{
					form.find("[name=required]").prop('checked', false);
				}				
				// end required
				var options= '';
				jQuery(ctrl).find('option').each(function(i,o) { options+=o.text+'\n'; });
				form.find("[name=options]").val(jQuery.trim(options));
			}
			// Multi-select combobox has same customization features
			load_values.selectmultiplelist = load_values.combobox;
			
			
			/* Specific method to load values from a radio group */
			load_values.radiogroup = function(ctrl_type, ctrl_id) {
				var form = jQuery("#theForm");
				var div_ctrl = jQuery("#"+ctrl_id);
				var options= '';
				var ctrls = div_ctrl.find("div").find("label");
				var radios = div_ctrl.find("div").find("input");
				
				ctrls.each(function(i,o) { options+=jQuery(o).text()+'\n'; });
				form.find("[name=name]").val(radios[0].name)
				form.find("[name=options]").val(jQuery.trim(options));
				// start required @zea
				if(ctrl.alt=="required" || ctrl.required==true){
					form.find("[name=required]").prop('checked', true);
				}
				else{
					form.find("[name=required]").prop('checked', false);
				}				
				// end required
			}
			
			// Checkbox group  customization behaves same as radio group
			load_values.checkboxgroup = load_values.radiogroup;
			
			/* Specific method to load values from a checkbox */
			load_values.checkbox = load_values.radiogroup;
			
			/* Specific method to load values from a button */
			load_values.btn = function(ctrl_type, ctrl_id) {
				var form = jQuery("#theForm");
				var div_ctrl = jQuery("#"+ctrl_id);
				var ctrl = div_ctrl.find("button")[0];
				form.find("[name=name]").val(ctrl.name)		
				form.find("[name=label]").val(jQuery(ctrl).text().trim())		
			}
			
			/* Common method to save changes to a control  - This also calls the specific methods */
			
			save_changes.common = function(values) {
				var div_ctrl = jQuery("#"+values.forCtrl);
				if(values.type!="btn"){
					div_ctrl.find('.control-label').text(values.label);
				}
				var specific_save_method = save_changes[values.type];
				//console.log(values);
				if(typeof(specific_save_method)!='undefined') {
					specific_save_method(values);		
				}
			}
			
			/* Specific method to save changes to a text box */
			save_changes.textbox = function(values) {
				
				var div_ctrl = jQuery("#"+values.forCtrl);
				var ctrl = div_ctrl.find("input")[0];
				if(typeof(div_ctrl.find("input")[1])!=='undefined'){
					var captchaName = jQuery(div_ctrl).find('input:last').attr('name')
					if(captchaName.indexOf('captcha') !== -1){
						ctrl = div_ctrl.find("input")[1];
					}
				}	
				
				ctrl.placeholder = values.placeholder;
				ctrl.name = values.name;
				//changes for required field @zea
				ctrl.required = values.required;
				if(values.required == true){
					ctrl.alt="required";
					ctrl.required="required";
					div_ctrl.find('.control-label').append("<span class='chili'></span>")
				}
				else{
					ctrl.alt="";
					ctrl.required="";
					div_ctrl.find('.control-label').removeClass( "chili" )
					//ctrl.data-bv-notempty="";
				}			
				//end required
			}

			// Password box customization behaves same as textbox
			save_changes.passwordbox= save_changes.textbox;
			
			/* Specific method to save changes to a text Area */
			save_changes.textarea = function(values) {
				var div_ctrl = jQuery("#"+values.forCtrl);
				var ctrl = div_ctrl.find("textarea")[0];
				ctrl.placeholder = values.placeholder;
				ctrl.name = values.name;
				//changes for required field @zea
				ctrl.required = values.required;
				if(values.required == true){
					ctrl.alt="required";
					div_ctrl.find('.control-label').append("<span class='chili'></span>")
				}
				else{
					ctrl.alt="";
					div_ctrl.find('.control-label').removeClass( "chili" )
				}			
				//end required				
			}
			
			/* Specific method to save changes to a combobox */
			save_changes.combobox = function(values) {
				console.log(values);
				var div_ctrl = jQuery("#"+values.forCtrl);
				var ctrl = div_ctrl.find("select")[0];
				ctrl.name = values.name;
				//changes for required field @zea
				ctrl.required = values.required;
				if(values.required == true){
					ctrl.alt="required";
					div_ctrl.find('.control-label').append("<span class='chili'></span>")
				}
				else{
					ctrl.alt="";
					div_ctrl.find('.control-label').removeClass( "chili" )
				}			
				//end required
				jQuery(ctrl).empty();
				jQuery(values.options.split('\n')).each(function(i,o) {
					jQuery(ctrl).append("<option>"+jQuery.trim(o)+"</option>");
				});
			}
			
			/* Specific method to save a radiogroup */
			save_changes.radiogroup = function(values) {
				var div_ctrl = jQuery("#"+values.forCtrl);
				
				var label_template = jQuery(".selectorField .ctrl-radiogroup label")[0];
				var radio_template = jQuery(".selectorField .ctrl-radiogroup input")[0];
				
				var ctrl = div_ctrl.find(".ctrl-radiogroup");
				ctrl.empty();
				jQuery(values.options.split('\n')).each(function(i,o) {
					var label = jQuery(label_template).clone().text(jQuery.trim(o))
					var radio = jQuery(radio_template).clone();
					radio[0].name = values.name;
					//changes for required field @zea
					ctrl.required = values.required;
					if(values.required == true){
						ctrl.alt="required";
						div_ctrl.find('.control-label').append("<span class='chili'></span>")
					}
					else{
						ctrl.alt="";
						div_ctrl.find('.control-label').removeClass( "chili" )
					}			
					//end required
					label.append(radio);
					jQuery(ctrl).append(label);
				});
			}
			
			/* Same as radio group, but separated for simplicity */
			save_changes.checkboxgroup = function(values) {
				var div_ctrl = jQuery("#"+values.forCtrl);
				
				var label_template = jQuery(".selectorField .ctrl-checkboxgroup label")[0];
				var checkbox_template = jQuery(".selectorField .ctrl-checkboxgroup input")[0];
				
				var ctrl = div_ctrl.find(".ctrl-checkboxgroup");
				ctrl.empty();
				jQuery(values.options.split('\n')).each(function(i,o) {
					var label = jQuery(label_template).clone().text(jQuery.trim(o))
					var checkbox = jQuery(checkbox_template).clone();
					checkbox[0].name = values.name;
					//changes for required field @zea
					ctrl.required = values.required;
					if(values.required == true){
						ctrl.alt="required";
						div_ctrl.find('.control-label').append("<span class='chili'></span>")
					}
					else{
						ctrl.alt="";
						div_ctrl.find('.control-label').removeClass( "chili" )
					}			
					//end required
					label.append(checkbox);
					jQuery(ctrl).append(label);
				});
			}
			
			// Multi-select customization behaves same as combobox
			save_changes.selectmultiplelist = save_changes.combobox;
			
			/* Specific method for Button */
			save_changes.btn = function(values) {
				var div_ctrl = jQuery("#"+values.forCtrl);
				var ctrl = div_ctrl.find("button")[0];
				jQuery(ctrl).html(jQuery(ctrl).html().replace(jQuery(ctrl).text()," "+jQuery.trim(values.label)));
				ctrl.name = values.name;
				//console.log(values);
			}

			
			/* Save the changes due to customization 
				- This method collects the values and passes it to the save_changes.methods
				*/
				function save_customize_changes(e, obj) {
				//console.log('save clicked', arguments);
				var formValues = {};
				var val=null;
				jQuery("#theForm").find("input, textarea").each(function(i,o) {
					if(o.type=="checkbox"){
						val = o.checked;
					} else {
						val = o.value;
					}
					formValues[o.name] = val;
				});
				
				save_changes.common(formValues);
			}
			
			/*
				Opens the customization window for this
				*/
				function customize_ctrl(ctrl_type, ctrl_id) {
					
					var ctrl_params = {};

					/* Load the specific templates */
					var specific_template = templates[ctrl_type];
					if(typeof(specific_template)=='undefined') {
						specific_template = function(){return ''; };
					}
					var modal_header = jQuery("#"+ctrl_id).find('.control-label').text();
					
					var template_params = {
						header:modal_header, 
						content: specific_template(ctrl_params), 
						type: ctrl_type,
						forCtrl: ctrl_id
						
					}
					
				// Pass the parameters - along with the specific template content to the Base template
				var s = templates.common(template_params)+"";
				
				
				// jQuery("[name=customization_modal]").remove(); // Making sure that we just have one instance of the modal opened and not leaking
				jQuery('#customization_modal').html(s).modal('show');
				// jQuery('<div id="customization_modal" aria-labelledby="customization_modal" role="dialog" name="customization_modal" class="modal fade" aria-hidden="false" />').append(s).modal('show');
				
				
				setTimeout(function() {
					// For some error in the code  modal show event is not firing - applying a manual delay before load
					load_values.common(ctrl_type, ctrl_id);
				},300);
			}
			
				
			</script>
			
			<?php
			
			global $wpdb;
			$form_id='';
			$form_name='iv_membership_payment_form';
			$form_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '" . $form_name . "' ORDER BY `ID` DESC");
	
			if(isset($_REQUEST['id'])){
				//$form_id=$_REQUEST['id'];
			}
			
			$form_meta_data= get_post_meta( $form_id,'iv_membership_content',true);
			$post_title='Payment Form';
			$queried_post = get_post($form_id); 
			if(isset($queried_post->post_title)){
				$post_title= $queried_post->post_title;
				
			}else{
				//die();
			}
			
			
			$iv_membership_width= get_post_meta( $form_id,'iv_membership_width',true);
			
			
			?>
			<script>
				jQuery(function(){				 
				  var radioButton = jQuery("#fixed_width");
				  var  iv_membership_width = jQuery("#iv_membership_width-input");
				  var iv_responsive =jQuery("#Responsive"); 

					  radioButton.change(function () { 
						if( this.checked ) { 
						  iv_membership_width.show();
						}
					  });
					iv_responsive.click(function (){
					 iv_membership_width.hide(); 
					});
				});
				jQuery(function(){	
						jQuery('#all-tempalte').on('change', function (e) {
						var optionSelected = jQuery("option:selected", this);
						var valueSelected = this.value;
						
							var tempalte_params={
								"action"  : 				"iv_membership_email_admin_template_change",										
								"iv_membership_template" 	:		valueSelected,	
							};
							jQuery.ajax({					
								url : ajaxurl,					 
								//dataType : "json",
								type : "post",
								cache: false,
								data : tempalte_params,
								success : function(response){	
									 tinyMCE.get('admin_email_template').setContent(response);													
								}
							});
							var tempalte_params={
								"action"  : 				"iv_membership_email_client_template_change",										
								"iv_membership_template" 	:		valueSelected,	
							};
							jQuery.ajax({					
								url : ajaxurl,					 
								//dataType : "json",
								type : "post",
								cache: false,
								data : tempalte_params,
								success : function(response){	
									 tinyMCE.get('client_email_template').setContent(response);													
								}
							});
				
				});
			});
			
			function insert_control_name_admin(btn_name){
				 tinyMCE.get('admin_email_template').execCommand("mceInsertContent", true, btn_name);
			}
			function insert_control_name_client(btn_name){
				 tinyMCE.get('client_email_template').execCommand("mceInsertContent", true, btn_name);
			}
			
			</script>
			
				
				
			<div class="bootstrap-wrapper">
				<div class="welcome-panel container-fluid">
					 
					<div class="row">
						<div class="col-md-12" style="z-index: 1017;">
							<div id="customization_modal"  aria-labelledby="customization_modal" role="dialog" name="customization_modal" class="modal fade" aria-hidden="true"></div>
						</div>
					</div>
					
					<!-- modal email template -->
					<div class="modal fade " id="modal_template_help" tabindex="-1" role="dialog" aria-labelledby="modal_template_helpLabel" aria-hidden="true">
						<div class="modal-dialog modal-lg">
						
							<div class="modal-content">
								
							</div>
							<!-- /.modal-content -->
						</div>
						
						<!-- /.modal-dialog -->
					</div>
					
					<!-- /.modal -->
					
					
					<!-- Start Form 101 -->
					<div class="row">					
						<div class="col-xs-12" id="submit-button-holder">					
							<div class="pull-right">
								<input type="hidden" name="hidden_form_id" id="hidden_form_id" value="<?php echo $form_id; ?>">
								<button class="btn btn-info btn-lg" onclick="return update_payment_form();">Update Form</button>
								
							</div>
							
						</div>
					</div>
					<div class="row">
						<div class="col-md-5"><h3 class="page-header">Payment Form Controls  <br /><small> Drag Controls to Right Panel</small> </h3>
						</div>	
						<div class="col-md-1">
						</div>
						<div class="col-md-6"><h3 class="page-header"><span id="p_title"><?php echo $post_title; ?> - Authorize.net </span><br /><small> Edit Your Form Elements</small> </h3>
						</div>
					</div> 
					
					
					<div class="row" >
						
						
						<div class="col-md-12" >
							<div id="listOfFields" class="col-md-5 well tab-content">
								<div class="tab-pane active form-group" id="simple">
									
									<div class="form-group selectorField draggableField row" style="z-index:12;">									
										<label for="text" class="col-md-4 control-label">Street Address</label>
										<div class="col-md-8">
											<input type="text"  name="iv_member_street_address" class="form-control ctrl-textbox"  placeholder="Enter Street Address">

										</div>
									</div>
									<div class="form-group selectorField draggableField row" style="z-index:12;">									
										<label for="text" class="col-md-4 control-label">Street Address 2</label>
										<div class="col-md-8">
											<input type="text"  name="iv_member_street_address2" class="form-control ctrl-textbox"  placeholder="Enter Street Address 2">

										</div>
									</div>
									<div class="form-group selectorField draggableField row" style="z-index:12;">									
										<label for="text" class="col-md-4 control-label">City</label>
										<div class="col-md-8">
											<input type="text"  name="iv_member_city" class="form-control ctrl-textbox"  placeholder="Enter City">

										</div>
									</div>
									<div class="form-group selectorField draggableField row" style="z-index:12;">									
										<label for="text" class="col-md-4 control-label">Zip Code</label>
										<div class="col-md-8">
											<input type="text"  name="iv_member_zip_code" class="form-control ctrl-textbox"  placeholder="Enter Zip Code">

										</div>
									</div>
									<div class="form-group selectorField draggableField row" style="z-index:12;">									
										<label for="text" class="col-md-4 control-label">State/Province/Region</label>
										<div class="col-md-8">
											<input type="text"  name="iv_member_state" class="form-control ctrl-textbox"  placeholder="Enter State">

										</div>
									</div>									
									<div class="form-group selectorField draggableField row" style="z-index:12;">									
										<label for="text" class="col-md-4 control-label">Name on Credit Card</label>
										<div class="col-md-8">
											<input type="text"  name="iv_member_name_on_card" class="form-control ctrl-textbox"  placeholder="Enter Name on Credit Card">

										</div>
									</div>	
									<div class="form-group selectorField draggableField row" style="z-index:12;">									
										<label for="text" class="col-md-4 control-label">Credit Card Number</label>
										<div class="col-md-8">
											<input type="text"  name="iv_member_card number" class="form-control ctrl-textbox"  placeholder="Enter Credit Card Number">

										</div>
									</div>
									<div class="form-group selectorField draggableField row" style="z-index:12;">									
										<label for="text" class="col-md-4 control-label">Expiration Date</label>
										<div class="col-md-8">
											<input type="text"  name="iv_member_expiration_date" class="form-control ctrl-textbox"  placeholder="Enter Expiration Date">

										</div>
									</div>
								<div class="form-group selectorField draggableField row" style="z-index:12;">									
										<label for="text" class="col-md-4 control-label">Security Code</label>
										<div class="col-md-8">
											<input type="text"  name="iv_member_security_code" class="form-control ctrl-textbox"  placeholder="Enter Security Code">

										</div>
									</div>
								
								

								
									
									
																
									
								</div>
							</div>			
							
							
							
							
							<div class="col-md-1 arrow_right" id="">
								<img  class="col-md-12" src="<?php echo WP_iv_membership_URLPATH; ?>admin/files/images/icon-arrow-right.png"> 
							</div>
							
							<div class="col-md-6" id="selected-content"  style="z-index:10;">	
								<div class="form-group row top-buffer " id="form-title-div">									
									<div class="onlypadding">
										
										
										
									</div>
									
								</div>						
								<?php echo $form_meta_data; ?>							
							</div>						
						</div>
					</div>
					
					<!-- End Form 101-->
							
						
				
					
					
						<div class="row">					
							<div class="col-xs-12">					
								<div align="center">
									<button class="btn btn-info btn-lg" onclick="return update_payment_form();">Update Form</button></div>
									<p>&nbsp;</p>
								</div>
							</div>
						</div>
					</div>			 
					
					<script id="control-customize-template" type="text/x-handlebars-template">			
					
					<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
					<h3>{{header}}</h3>
					</div>
					
					<div class="modal-body" >
					<form id="theForm" class="form-horizontal" role="form">								
					
					<input type="hidden" value="{{type}}" name="type" />
					<input type="hidden" value="{{forCtrl}}" name="forCtrl" />
					
					<div class="form-group">									
					<label for="text" class="col-md-3 control-label">Label</label>
					<div class="col-md-6">
					<input class="form-control" type="text" name="label" value="" />
					</div>
					</div>
					
					
					<div class="form-group">									
					<label for="text" class="col-md-3 control-label">Name</label>
					<div class="col-md-6">
					<input class="form-control" readonly type="text" value="" name="name" />
					</div>
					</div>
					
					<div class="form-group">
					{{{content}}}	
					</div>	
					<!-- creating the typebox @ zea 
					<div class="form-group">									
					<label for="required" class="col-md-3 control-checkbox-required">Required *</label>
					<div class="col-md-3">
					<input type="checkbox" value="" name="required" class="checkbox_custom" />
					</div>
					</div>	
					<!-- end typebox -->					
					</form>
					</div>
					
					<div class="modal-footer">
					<button class="btn btn-primary" data-dismiss="modal" onclick='save_customize_changes()'>Save changes</button>
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
					<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" onclick='delete_ctrl()'>Delete</button>
					</div>
					</div>
					</div>		
					
					</script>
					
					<script id="textbox-template" type="text/x-handlebars-template">
					<label for="text" class="col-md-3 control-label">Placeholder</label> 
					<div class="col-md-6">
					<input type="text"  class="form-control" name="placeholder" value="" />
					</div>			
					</script>
					
					<script id="combobox-template" type="text/x-handlebars-template">
					<label for="text" class="col-md-3 control-label">Options</label> <div class="col-md-6"><textarea class="form-control" name="options" rows="5"></textarea></div>
					</script>
					
					<!-- Zea test -->
					<script id="textarea-template" type="text/x-handlebars-template">
					<label for="text" class="col-md-3 control-label">Placeholder</label> 
					<div class="col-md-6"><input type="text" class="form-control" name="placeholder" value="" /></div>			
					</div>
					
					
					<div class="form-group">
					<label for="required" class="col-md-3 control-label control-checkbox-required">Required *</label>
					<div class="col-md-3">
					<input type="checkbox" value="" name="required" class="checkbox_custom" />
					</div>
					
					</script>
					<script id="textbox-required-template" type="text/x-handlebars-template">
					
					</div>
					<div class="form-group">
					<label for="text" class="col-md-3 control-label control-checkbox-required ">    Required *</label>
					<div class="col-md-3">
					<input type="checkbox" value=""   name="required" class="checkbox_custom" />
					</div>
					
					</script>
					<!-- Zea test end -->

					<!-- End of templates -->


					<script>
					jQuery(document).ready(docReady); 
					
					</script>
