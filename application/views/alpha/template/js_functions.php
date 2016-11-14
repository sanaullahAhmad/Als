<?php 
	$timestamp = time();?>
<script>

//setTimeout(function(){
	
	$(document).ready( function(){
		$('#start_date').datepicker({
			format: 'yyyy-mm-dd',
		});
		$('#end_date').datepicker({
			format: 'yyyy-mm-dd',
		});
	});

	
	
	//Add Knowledge base
	$("#send_resident_email").validate({
				  rules: {
					condo: {
	                    required: true,
	                },
					subject: {
	                    required: true,
	                },
					 message: {
	                    required: true
	                },
	            },
	            messages: {
					condo: {
	                    required: "Please select condo",
	                },
					subject: {
	                    required: "Please enter subject",
	                },
					 message: {
	                    required: "Please enter message",
	                },
					/* add_link: {
	                    required: "Please enter link",
	                }*/
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) {
        		form.submit();
        }
    });
	
//Add Condo
	$("#addcondo-form").validate({
				  rules: {
	                name: {
	                    required: true
	                },
					
					code: {
	                    required: true,
	                     remote: {
				url: "<?php echo base_url()?>alpha/check_data_exists/code/condos",
				type: "post",
				data: {
					code: function(){ return $("#code").val(); }
				}
				}
	                },
					
					email: {
	                    required: true,
				email: true,
				 remote: {
				url: "<?php echo base_url()?>alpha/check_data_exists/email/condos",
				type: "post",
				data: {
					email: function(){ return $("#email").val(); }
				}
				}
	                },
	                
	               
					
					logo: {
						required: true,
						fileType: {
							types: ["jpeg", "jpg", "png", "gif"]
						},
						maxFileSize: {
							"unit": "KB",
							"size": 2000
						},
						minFileSize: {
							"unit": "KB",
							"size": "10"
						}
					  },
					  
					  condoimg: {
						required: true,
						fileType: {
							types: ["jpeg", "jpg", "png", "gif"]
						},
						maxFileSize: {
							"unit": "KB",
							"size": 2000
						},
						minFileSize: {
							"unit": "KB",
							"size": "10"
						}
					  }
	            },



	            messages: {
                  name: {
	                    required: "Please enter Name",
	                },
					
					code: {
	                    required: "Please enter Code",
	                    remote: "That code was already registered."
	                },
					
					email: {
	                    required: "Please enter Email",
						email: "Please enter a valid email address",
						remote: "That email was already registered."
	                },
					
					logo: {
						required: "Please choose a file",
						fileType: "File Type must be jpeg/jpg/png",
						maxFileSize: "Maximum of 2MB is allowed",
						minFileSize: "Minimum File size required 10KB"
					 },
					 
					 condoimg: {
						required: "Please choose a file",
						fileType: "File Type must be jpeg/jpg/png",
						maxFileSize: "Maximum of 2MB is allowed",
						minFileSize: "Minimum File size required 10KB"
					 }
	            },


				debug: true,
		
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
		
        

        submitHandler: function(form) {
				$("#areas_validate").html("");
				var state = $("#state").val();
				var areas = $("#areas").val();
				if(state!='')
				{
					if(areas=='')
					{
						$("#areas_validate").html("<label for='email' class='error' style='display: inline-block;'>Please Select an area first.</label>");
						return false;
					}
				}
        		form.submit();
		
        }
    });
	
	
	//Add Advertizement
	$("#add-advertisement").validate({
				  rules: {
					title: {
	                    required: true,
	                },
					 ad_type: {
	                    required: true,
						  remote: {
							  url: "<?php echo base_url()?>alpha/check_premium_ads_count/",
							  type: "post",
							  data: {
								  ad_type: function(){ return $("#ad_type").val(); }
							  }
							}
	                },
					 ad_category: {
	                    required: true
	                },
					 description: {
	                    required: true
	                },
					 start_date: {
	                    required: true
	                },
					 end_date: {
	                    required: true
	                },
					display_settings: {
	                    required: true
	                },
	            },
	            messages: {
					title: {
	                    required: "Please enter title",
	                },
					 ad_type: {
	                    required: "Please select Ad Type",
	                    remote: "Only 2 ads are allowed for premium.",
	                },
					 ad_category: {
	                    required: "Please select Ad Category",
	                },
					 description: {
	                    required: "Please select Ad Category",
	                },
					start_date: {
	                    required: "Please select a date",
	                },
					end_date: {
	                    required: "Please select a date",
	                },
					display_settings: {
	                    required: "Please select display settings",
	                },
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) {
        		form.submit();
        }
    });
	//Add Advertizement
	$("#edit-advertisement").validate({
				  rules: {
					title: {
	                    required: true,
	                },
					 ad_type: {
	                    required: true,
						  remote: {
							  url: "<?php echo base_url()?>alpha/check_premium_ads_count/",
							  type: "post",
							  data: {
								  ad_type: function(){ return $("#ad_type").val(); },
								  ad_type_saved: function(){ return $("#ad_type_saved").val(); }
							  }
							}
	                },
					 ad_category: {
	                    required: true
	                },
					 description: {
	                    required: true
	                },
					 start_date: {
	                    required: true
	                },
					 end_date: {
	                    required: true
	                },
					display_settings: {
	                    required: true
	                },
	            },
	            messages: {
					title: {
	                    required: "Please enter title",
	                },
					 ad_type: {
	                    required: "Please select Ad Type",
	                    remote: "Only 2 ads are allowed for premium.",
	                },
					 ad_category: {
	                    required: "Please select Ad Category",
	                },
					 description: {
	                    required: "Please select Ad Category",
	                },
					start_date: {
	                    required: "Please select a date",
	                },
					end_date: {
	                    required: "Please select a date",
	                },
					display_settings: {
	                    required: "Please select display settings",
	                },
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) {
        		form.submit();
        }
    });
	//Add Advertizement
	$("#resident-search-form").validate({
				  rules: {
					condos: {
	                    required: true,
	                },
					/* block: {
	                    required: true
	                },
					 floors: {
	                    required: true
	                },
					 unit: {
	                    required: true
	                },
					 add_link: {
	                    required: true,
	                }
*/	            },
	            messages: {
					condos: {
	                    required: "Please Select  Condos",
	                },
					 block: {
	                    required: "Please select a block",
	                },
					 floors: {
	                    required: "Please select a floor",
	                },
					 unit: {
	                    required: "Please select a unit",
	                },
					/* add_link: {
	                    required: "Please enter link",
	                }*/
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) {
        		form.submit();
        }
    });
	//Edit Condo
	$("#editcondo-form").validate({
				  rules: {
	                name: {
	                    required: true
	                },
					
					
					logo: {
						fileType: {
							types: ["jpeg", "jpg", "png", "gif"]
						},
						maxFileSize: {
							"unit": "KB",
							"size": 2000
						},
						minFileSize: {
							"unit": "KB",
							"size": "10"
						}
					  },
					  
					  condoimg: {
						fileType: {
							types: ["jpeg", "jpg", "png", "gif"]
						},
						maxFileSize: {
							"unit": "KB",
							"size": 2000
						},
						minFileSize: {
							"unit": "KB",
							"size": "10"
						}
					  }
	            },



	            messages: {
                  name: {
	                    required: "Please enter Name",
	                },
	
					logo: {
						fileType: "File Type must be jpeg/jpg/png",
						maxFileSize: "Maximum of 2MB is allowed",
						minFileSize: "Minimum File size required 10KB"
					 },
					 
					 condoimg: {
						fileType: "File Type must be jpeg/jpg/png",
						maxFileSize: "Maximum of 2MB is allowed",
						minFileSize: "Minimum File size required 10KB"
					 }
	            },


				debug: true,
		
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
		
        

        submitHandler: function(form) {
			$("#areas_validate").html("");
				var state = $("#state").val();
				var areas = $("#areas").val();
				if(state!='')
				{
					if(areas=='')
					{
						$("#areas_validate").html("<label for='email' class='error' style='display: inline-block;'>Please Select an area first.</label>");
						return false;
					}
				}
        		form.submit();
		
        }
    });
 //Add Services Category Form
	$("#addservicecategory-form").validate({
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>alpha/check_data_exists/name/services_categories",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); }
						  }
						}
	                },
					
					imagefile: {
						required: true,
						fileType: {
							types: ["jpeg", "jpg", "png", "gif"]
						},
						maxFileSize: {
							"unit": "KB",
							"size": 2000
						},
						minFileSize: {
							"unit": "KB",
							"size": "10"
						}
					  }
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
						remote: "Name Already Exists",
	                },
					imagefile: {
						required: "Please choose a file",
						fileType: "File Type must be jpeg/jpg/png",
						maxFileSize: "Maximum of 2MB is allowed",
						minFileSize: "Minimum File size required 10KB"
					 }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });
 //Edit Services Category Form
	$("#editservicecategory-form").validate({
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>alpha/check_data_exists/name/services_categories",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); },
							  current_name: function(){ return $("#current_name").val(); }
						  }
						}
	                }
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exit",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
			 {
				form.submit();
			 }
    });

 //Add User Form
	$("#adduser-form").validate({
		
				  rules: {
	                full_name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>alpha/check_data_exists/full_name/admin",
						  type: "post",
						  data: {
							  full_name: function(){ return $("#full_name").val(); }
						  }
						  }
	                },
						
	                email: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>alpha/check_data_exists/email/admin",
						  type: "post",
						  data: {
							  email: function(){ return $("#email").val(); }
						  }
						}
	                },
	            },
	            messages: {
                  full_name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
                  email: {
	                    required: "Please enter Email",
	                    remote: "Email Already Exist.",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
			//alert('success');
			//return false;
		}
    });	
 //Add Vendor Form
	$("#addvendor-form").validate({
		
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>alpha/check_data_exists/name/vendors",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); }
						  }
						  }
	                },
	                company_name: {
	                    required: true,
	                },
	                phone: {
	                    required: true,
	                },
	                address: {
	                    required: true,
	                },
	                city: {
	                    required: true,
	                },
	                suburb: {
	                    required: true,
	                },
						
	                email: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>alpha/check_data_exists/email/vendors",
						  type: "post",
						  data: {
							  email: function(){ return $("#email").val(); }
						  }
						}
	                },
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
                  company_name: {
	                    required: "Please enter Company Name",
	                },
                  phone: {
	                    required: "Please enter  Phone",
	                },
                  address: {
	                    required: "Please enter Address",
	                },
                  city: {
	                    required: "Please enter City",
	                },
                  suburb: {
	                    required: "Please enter Suburb",
	                },
                  email: {
	                    required: "Please enter Email",
	                    remote: "Email Already Exist.",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
			//alert('success');
			//return false;
		}
    });
 //Edit Vendor Form
	$("#editvendor-form").validate({
		
				  rules: {
	                name: {
	                    required: true,
						  remote: {
							  url: "<?php echo base_url()?>alpha/check_data_exists/name/vendors",
							  type: "post",
							  data: {
								  name: function(){ return $("#name").val(); },
								  current_name: function(){ return $("#current_name").val(); }
							  }
						  }
	                },
	                company_name: {
	                    required: true,
	                },
	                phone: {
	                    required: true,
	                },
	                address: {
	                    required: true,
	                },
	                city: {
	                    required: true,
	                },
	                suburb: {
	                    required: true,
	                },
						
	                email: {
	                    required: true,
						  remote: {
							  url: "<?php echo base_url()?>alpha/check_data_exists/email/vendors",
							  type: "post",
							  data: {
								  email: function(){ return $("#email").val(); },
								  current_name: function(){ return $("#current_email").val(); }
							  }
						}
	                },
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
                  company_name: {
	                    required: "Please enter Company Name",
	                },
                  phone: {
	                    required: "Please enter  Phone",
	                },
                  address: {
	                    required: "Please enter Address",
	                },
                  city: {
	                    required: "Please enter City",
	                },
                  suburb: {
	                    required: "Please enter Suburb",
	                },
                  email: {
	                    required: "Please enter Email",
	                    remote: "Email Already Exist.",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
			//alert('success');
			//return false;
		}
    });	
 //Add Services Form
	$("#addservice-form").validate({
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>alpha/check_data_exists/name/services",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); }
						  }
						}
	                },
					category: {
	                    required: true
	                },
					
					imagefile: {
						required: true,
						fileType: {
							types: ["jpeg", "jpg", "png", "gif"]
						},
						maxFileSize: {
							"unit": "KB",
							"size": 2000
						},
						minFileSize: {
							"unit": "KB",
							"size": "10"
						}
					  }
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
                  category: {
	                    required: "Please enter Category",
	                },
					imagefile: {
						required: "Please choose a file",
						fileType: "File Type must be jpeg/jpg/png",
						maxFileSize: "Maximum of 2MB is allowed",
						minFileSize: "Minimum File size required 10KB"
					 }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) 
		{
			form.submit();
		}
    });
 //Edit Services Form
	$("#editservice-form").validate({
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>alpha/check_data_exists/name/services",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); },
							  current_name: function(){ return $("#current_name").val(); }
						  }
						}
	                },
					category: {
	                    required: true
	                }
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
                  category: {
	                    required: "Please enter Category",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) 
		{
			form.submit();
		}
    });
	$("#import_states_csv").validate({
				  rules: {
					filetoupload_states: {
						required: true, 
						extension: "xls|csv",
						maxFileSize: {
							"unit": "KB",
							"size": 2000
						},
					  }
	            },
	            messages: {
					filetoupload_states: {
						required: "File is required", 
						extension: "Please upload a CSV File",
						maxFileSize: "Maximum of 2MB is allowed"
					 }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) {
        		form.submit();
        }
    });
	$("#import_areas_csv").validate({
				  rules: {
					filetoupload_areas: {
						required: true, 
						extension: "xls|csv",
						maxFileSize: {
							"unit": "KB",
							"size": 2000
						},
					  }
	            },
	            messages: {
					filetoupload_areas: {
						required: "File is required", 
						extension: "Please upload a CSV File",
						maxFileSize: "Maximum of 2MB is allowed"
					 }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) {
        		form.submit();
        }
    });
	$('#forgot-pass-click').click(function(){
    $("#forgot-password").show();
     $("#login-form").hide();
	});
	$('#forgot-pass-back').click(function(){
	$("#login-form").show();
	$("#forgot-password").hide();
	});
//Get city list from State
	$("#state").change(function(){
		 var state=$("#state").val();
		 if(state != ''){
			$.ajax({
			  type: 'POST',
			  url: '<?php echo base_url('alpha/get_city_from_state'); ?>',
			  data: 'state='+state+'&ajax=1',
			  dataType : "json",
			  success: function( data ) {
				$("#areas").html(data.values);
		
			  },
			  error: function(xhr, status, error) {
			  alert(status);
			  },
			  });
		 	}
		});	
	$("#edit_state").change(function(){
		 var state=$("#edit_state").val();
		 if(state != ''){
			$.ajax({
			  type: 'POST',
			  url: '<?php echo base_url('alpha/get_city_from_state_edit'); ?>',
			  data: 'state='+state+'&ajax=1',
			  dataType : "json",
			  success: function( data ) {
				$("#areas").html(data.values);
		
			  },
			  error: function(xhr, status, error) {
			  alert(status);
			  },
			  });
		 	}
		});
  //}); 		
  
  
  
  
		//for advertizment page
		$('#advertisement_file_upload').uploadify({
			'queueSizeLimit' : 4,
			'onUploadStart' : function(file) 
			{
				$("#addadvertisementsub").prop('disabled', true);
				lenth = $('.images_names').length;
				if(lenth<5)
				{ 
					return true
				}
				else
				{
					alert("You have already Selected Five images.");
					$('#incidents_file_upload').uploadify('cancel', file.id)
					return false;//this will stop add progress bar
				}
			},
			'onSelect' : function(e,q,f) 
			{
				lenth = $('.images_names').length;
				if(lenth<5)
				{ 
					return true
				}
				else
				{
					alert("You have already Selected Five images.");
					$('#incidents_file_upload').uploadify('cancel', file.id)
					return false;//this will stop add progress bar
				}
			},
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
			},
			'swf'      : '<?php echo base_url();?>assets/front/images/uploadify.swf',
			'uploader' : '<?php echo base_url();?>alpha/uploadify_advert_images',
			'onUploadSuccess' : function(file, data, response) {
				//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
				if(data!='Invalid file type.')
				{
					//$('#images_ids').val($('#images_ids').val() + ','+data);}
					//$('#additional_images').append('<img src="<?php echo base_url()?>uploads/advertisement_images/'+data+'" class="img_responsive" style="height:100px; width:100px;" />');
					$("#addadvertisementsub").prop('disabled', false);
					var ran = "";
					var charset = "abcdefghijklmnopqrstuvwxyz";
					for( var i=0; i < 5; i++ )
						ran += charset.charAt(Math.floor(Math.random() * charset.length));
					$('#additional_images').append('<section style="position:relative; float:left" class="'+ran+'"><img src="<?php echo base_url()?>uploads/advertisement_images/'+data+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross">&#120;</span><input type="hidden" name="images_names[]" value="'+data+'" class="images_names"></section>');
				}
			}
		});
		
		
		
		
		
		//for advertizment featured image
		/*$('#advertisement_featured_image').uploadify({
			'queueSizeLimit' : 1,
			'onUploadStart' : function(file) 
			{
				$("#addadvertisementsub").prop('disabled', true);
			},
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
			},
			'swf'      : '<?php echo base_url();?>assets/front/images/uploadify.swf',
			'uploader' : '<?php echo base_url();?>alpha/advertisement_featured_image',
			'onUploadSuccess' : function(file, data, response) {
				//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
				if(data!='Invalid file type.')
				{
					$('#featured_image').val(data);
					$('#img_featured').html('<section style="position:relative"><img src="<?php echo base_url()?>uploads/advertisement_images/'+data+'" class="img_responsive" style="width:400px;"/><span onclick="delete_image(&#39;featured_image&#39;,&#39;img_featured&#39;)"  class="image_delete_cross" style="top:0px;position:absolute;">&#120;</span></section>');
					$("#addadvertisementsub").prop('disabled', false);
				}
			}
		});*/
		
	
	//For Add Incidents Page
	$(function () {
		'use strict';
		//$("#progress").hide();
			$('#advertisement_featured_image').fileupload({
				url: '<?php echo base_url()?>alpha/upload_ad_image',
				dataType: 'json',
				done: function (e, data) 
				{
					$.each(data.result.files, function (index, file) 
					{
						//check if file upload exeeded
						var check_images = $("#files").html();
						if(check_images!='')
						{
							var lenth = $('.images_names').length;
							if(lenth>0)
							{ 
								alert("You have already selected 1 image.");
								return false;//this will stop add progress bar
							}
						}
						//check if file upload exeeded ends
						var res = file.name.split(".");
						var ran = "";
						var charset = "abcdefghijklmnopqrstuvwxyz";
						for( var i=0; i < 5; i++ )
							ran += charset.charAt(Math.floor(Math.random() * charset.length));
						if(file.valid_file=='yes')
						{
							if(file.extension=='pdf')
							{
							
							$('#files').append('<section style="position:relative;" class="'+ran+'">'+file.name+'<span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
							else
							{
						$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><img src="<?php echo base_url()?>uploads/advertisement_images/'+file.name+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;incident_images&#39;, &#39;incident_images&#39;)" class="image_delete_cross" >&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
						}
						else
						{
							$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><span class="label label-warning">'+file.name+'</span><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span></section>');
						}
					});
				},
				progressall: function (e, data) 
				{
					$("#progress").show();
					$("#progress_loading").show();
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$('#progress .progress-bar').css(
						'width',
						progress + '%'
					);
						if(progress>99){ setTimeout(function(){ $("#progress, #progress_loading").css( 'display', 'none'); }, 3000); }
				}
			}).prop('disabled', !$.support.fileInput)
				.parent().addClass($.support.fileInput ? undefined : 'disabled');
			$('#email_attachement').fileupload({
				url: '<?php echo base_url()?>manager/email_attachement',
				dataType: 'json',
				done: function (e, data) 
				{
					$.each(data.result.files, function (index, file) 
					{
						//check if file upload exeeded
						var check_images = $("#files").html();
						if(check_images!='')
						{
							var lenth = $('.images_names').length;
							if(lenth>0)
							{ 
								alert("You have already selected 1 image.");
								return false;//this will stop add progress bar
							}
						}
						//check if file upload exeeded ends
						var res = file.name.split(".");
						var ran = "";
						var charset = "abcdefghijklmnopqrstuvwxyz";
						for( var i=0; i < 5; i++ )
							ran += charset.charAt(Math.floor(Math.random() * charset.length));
						if(file.valid_file=='yes')
						{
							if(file.extension=='pdf' || file.extension=='psd' || file.extension=='doc' || file.extension=='docx' )
							{
							
							$('#files').append('<section style="position:relative;" class="'+ran+'">'+file.name+'<span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
							else
							{
						$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><img src="<?php echo base_url()?>uploads/email_attachement/'+file.name+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;email_attachement&#39;, &#39;email_attachment_files&#39;)" class="image_delete_cross" >&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
						}
						else
						{
							$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><span class="label label-warning">'+file.name+'</span><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span></section>');
						}
					});
				},
				progressall: function (e, data) 
				{
					$("#progress").show();
					$("#progress_loading").show();
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$('#progress .progress-bar').css(
						'width',
						progress + '%'
					);
						if(progress>99){ setTimeout(function(){ $("#progress, #progress_loading").css( 'display', 'none'); }, 3000); }
				}
			}).prop('disabled', !$.support.fileInput)
		    .parent().addClass($.support.fileInput ? undefined : 'disabled');
		
	
	});
	
	
	
	function delete_image()
	{
		$('#featured_image').val('0');
		$('#img_featured').html('');
	}
	
	function edit_field(id, table, field, current_value_id)
	{
		var current_value = $('#'+current_value_id).html();
		var postData={ 
						id				  :id,
						table			  :table,
						field  			  :field,
						current_value_id  :current_value_id,
						current_value	  :current_value
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>alpha/edit_field', 
			success: function(result){
					$('#'+current_value_id).html(result);
			}
			});
	}
	function edit_field_value(id, field, changed_name, table,current_value_id )
	{
		$('#'+current_value_id).html('');
		//alert('feild = '+field+', change_id = '+change_id+', lead_id = '+ lead_id+', targettable = '+ targettable+', target_table_name = '+ target_table_name);
		var postData={ 
				id				:id,
				field			:field,
				table			:table,
				changed_name	:changed_name
				}
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>alpha/edit_field_value', 
			success: function(result){
					$('#'+current_value_id).html(result);
				}});
	}
//Delete
	function callCrudAction(table,id,controller,image_url) {
		image_url = image_url || 0;
		if (confirm('Are you sure?')) {
			queryString = 'table='+table+'&id='+ id+'&image_url='+ image_url;
			
			jQuery.ajax({
			url: "<?php echo base_url()?>alpha/"+controller,
			data:queryString,
			type: "POST",
			success:function(data){
				window.location.reload();
			},
		
			error:function (){
			}
		});
	} else {
           return false;
       }
	}
//status inactive
	function callinActiveAction(table,changefield,changeuvalue,wherefield,wherevalue,controller) {
		if (confirm('Are you sure?')) {
			queryString = 'table='+table+'&changefield='+ changefield+'&changeuvalue='+ changeuvalue+'&wherefield='+ wherefield+'&wherevalue='+ wherevalue;
			
			jQuery.ajax({
			url: "<?php echo base_url()?>alpha/"+controller,
			data:queryString,
			type: "POST",
			success:function(data){
				window.location.reload();
			},
		
			error:function (){
			}
		});
	} else {
           return false;
       }
	}
	
	function delete_image_section(classname)
	{
		$('.'+classname).remove();
	}
	
	function delete_image_and_section(classname, imagename, imageextention, imagefolder, table)
	{
		$('.'+classname).remove();
		var postData={ 
						imagefolder			:imagefolder,
						imagename			:imagename,
						imageextention		:imageextention,
						table				:table,
					 }
		$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url().'home/delete_image_and_section/'; ?>', 
			success: function(result){
			  
			}
		});
	}
</script>
