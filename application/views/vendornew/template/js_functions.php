<script>

$script.ready(['core', 'plugins_dependency', 'plugins'], function(){
	$script(App.Scripts.bundle, 'bundle');

//Add user
	$("#login-form").validate({
				  rules: {
	                email: {
	                    required: true,
						email: true
	                },	               
					 password: {
	                    required: true
	                },
	            },
	            messages: {
	                email: {
	                    required: "Please enter email.",
						email: "Email is not valid."
	                },				
					password: {
	                    required: "Please enter password."
	                },	              
	            },
				debug: true,		
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) {
		  $.ajax({
                   type: "POST",
                   url: "<?php echo base_url()?>vendor/check_login",
                   data: $("#login-form").serialize(), 
                   cache: false,
				   beforeSend: function(){ $("#logsubbutton").text('Checking...');},
                  success: function(data) {
					   if(data == 'active'){
                           	$('.fornotactive').hide();
							$('.forincorrectunpass').hide();
                            $("#logsubbutton").html('Logging you in... <i class="m-icon-swapright m-icon-white"></i>');
							
							<?php if(isset($_GET['next'])){?>
							window.location.href = "<?php echo $_GET['next'];?>";
							<?php } else {?>
                            window.location.href = "<?php echo base_url()?>vendor/dashboard";
							<?php }?>
                        } else if(data == 'notactive'){
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
                            $('.fornotactive').show();
							$('.forincorrectunpass').hide();
                        } else {
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
							 $("#password").val('');
						   $('.forincorrectunpass').show();
						   $('.fornotactive').hide();
                        }
                    },
                   error: function() {
                        alert('Something went wrong');
                   }
                 });
        }
    });
	//Edit Condo Profile
	$("#condo-profile-manager").validate({
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
	//Edit Condo Profile
	$("#vendor-profile").validate({
				rules: {
	                name: {
	                    required: true
	                },
					email: {
	                   required: true,
					   email: true,
					   remote: 
					   {
						  url: "<?php echo base_url()?>vendor/check_data_exists/email/vendors",
						  type: "post",
						  data: 
						  {
							  email: function(){ return $("#email").val(); },
							  current_name: function(){ return $("#current_email").val(); }
						  }
					   }
	                },
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                },
					email: {
	                    required: "Please enter Email",
						email: "Please enter a valid email address",
						remote: "That email was already registered."
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
	//Change Password
	$("#change-password").validate({
				  rules: {
					password: {
	                    required: true,
	                     remote: {
							url: "<?php echo base_url()?>vendor/check_data_exists_md5/password/vendors",
							type: "post",
							data: {
								password: function(){ return $("#password").val(); }
							}
						}
	                },
					 new_password: {
	                    required: true
	                },
					 retype_password: {
	                    required: true,
						equalTo : "#new_password"
	                }
	            },
	            messages: {
					password: {
	                    required: "Please enter Current Password",
						remote: "Your current password is not correct"
	                },
					 new_password: {
	                    required: "Please enter New Password",
	                },
					 retype_password: {
	                    required: "Please retype Password",
						equalTo : "Password doesn't match."
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
	//Forgot Change Password
	$("#forgot-password-change").validate({
				  rules: {
					 password: {
	                    required: true
	                },
					 repassword: {
	                    required: true,
						equalTo : "#password"
	                }
	            },
	            messages: {
					 password: {
	                    required: "Please enter New Password",
	                },
					 repassword: {
	                    required: "Please retype Password",
						equalTo : "Password doesn't match."
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
	//Forgot Password
	$("#forgot-pass-form-vendor").validate({
				  rules: {
					email_forgot: {
	                    required: true,
						email: true,
	                     remote: {
							url: "<?php echo base_url()?>vendor/check_data_exists_forgot_pass/email_forgot/vendors",
							type: "post",
							data: {
								email_forgot: function(){ return $("#email_forgot").val(); }
							}
						}
	                }
	            },
	            messages: {
					email_forgot: {
	                    required: "Please enter Email",
						email: "Please enter a valid email",
						remote: "Seems we do not have this email address. Please check."
	                }
	            },
				debug: true,
		
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
		
        

        submitHandler: function(form) {
        		$.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>vendor/forgot_password",

                   data: $("#forgot-pass-form-vendor").serialize(), 

                   cache: false,

				   beforeSend: function(){ $("#forgotpasssubbutton").text('Sending Link...');},
				   
                  success: function(data) {
					  if(data == 'LINKSENT'){
					  	$("#success-message").show();
						$("#forgot-password").hide();
					  }
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
		
        }
    });
//Edit update-password Form
	$("#edit-update-password-form").validate({
				  rules: {
	                new_password: {
	                    required: true
	                },
					confirm_password:{
						equalTo: "#new_password"
					}
					
	            },
	            messages: {
                  new_password: {
	                    required: "Please enter Name",
	                },
					confirm_password:{
						equalTo: "Password does not match.",
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
//Edit Block Form
	$("#editblock-form").validate({
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/name/blocks",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); },
							  current_name: function(){ return $("#current_name").val(); }
						  }
						}
	                },
					floors:{
						required: true,
					},
					units:{
						required: true,
					}
					
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
					floors:{
						required: "Please enter Floors",
					},
					units:{
						required: "Please enter Units",
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
 //Add Block Form
	$("#addblock-form").validate({
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/name/blocks",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); }
						  }
						}
	                },
					floors:{
						required: true,
					},
					units:{
						required: true,
					}
					
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
					floors:{
						required: "Please enter Floors",
					},
					units:{
						required: "Please enter Units",
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
	

//Upload Residend CSV file
	
	
	 $('#importresidents-form').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                extension: "csv"
            }
        },
        submitHandler: function (form) { // for demo
            if( document.getElementById("filetoupload").value.toLowerCase().lastIndexOf(".csv")==-1) 
			{
					//alert("Please upload a file with .csv extension.");
					$("#filetoupload_validate").html('Please upload a file with .csv extension.');
					return false;
			}
			else
			{
				$("#filetoupload_validate").html('');
				form.submit();
			}
        }
    });


	 //Add User Form
	$("#adduser-form").validate({
		
				  rules: {
	                full_name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/full_name/condo_admins",
						  type: "post",
						  data: {
							  full_name: function(){ return $("#full_name").val(); }
						  }
						  }
	                },
						
	                email: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/email/condo_admins",
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
	 //edit User Form
	$("#edituser-form").validate({
		
				  rules: {
	                 full_name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/full_name/condo_admins",
						  type: "post",
						  data: {
							  full_name: function(){ return $("#full_name").val(); },
							  current_name: function(){ return $("#current_name").val(); }
						  }
						  }
	                },
						
	                email: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/email/condo_admins",
						  type: "post",
						  data: {
							  email: function(){ return $("#email").val(); },
							  current_name: function(){ return $("#current_email").val(); }
						  }
						}
	                },
	            },
	            messages: {
                  full_name: {
	                    required: "Please enter Name",
						remote: "Name already exists",
	                },
                  email: {
	                    required: "Please enter Email",
						remote: "Email already exists",
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
	
	
	 //Add Resident Form
	$("#addresident-form").validate({
		
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/name/residents",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); }
						  }
						  }
	                },
						
	                email: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/email/residents",
						  type: "post",
						  data: {
							  email: function(){ return $("#email").val(); }
						  }
						}
	                },
					
	                block: {
	                    required: true
	                },
					
	                floor: {
	                    required: true
	                },
					
	                unit: {
	                    required: true
	                },
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
                  email: {
	                    required: "Please enter Email",
	                    remote: "Email Already Exist.",
	                },
                  block: {
	                    required: "Please enter block",
	                },
                  floor: {
	                    required: "Please enter Floors",
	                },
                  unit: {
	                    required: "Please enter Units",
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
	 //Edit Resident Form
	$("#editresident-form").validate({
		
				  rules: {
	                 name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/name/residents",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); },
							  current_name: function(){ return $("#current_name").val(); }
						  }
						  }
	                },
						
	                email: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/email/residents",
						  type: "post",
						  data: {
							  email: function(){ return $("#email").val(); },
							  current_name: function(){ return $("#current_email").val(); }
						  }
						}
	                },
					
	                block: {
	                    required: true
	                },
					
	                floor: {
	                    required: true
	                },
					
	                unit: {
	                    required: true
	                },
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
						 remote: "Name already exists",
	                },
                  email: {
	                    required: "Please enter Email",
						 remote: "Email already exists",
	                },
                  block: {
	                    required: "Please enter block",
	                },
                  floor: {
	                    required: "Please enter Floors",
	                },
                  unit: {
	                    required: "Please enter Units",
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
	
//Delete
	function callCrudAction(table,id,controller) {
		if (confirm('Are you sure?')) {
			queryString = 'table='+table+'&id='+ id;
			
			jQuery.ajax({
			url: "<?php echo base_url()?>manager/"+controller,
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
function edit_field(id, table, field)
	{
		var current_value = $('#category_service_id_'+id).html();
		var postData={ 
						id			:id,
						table		:table,
						field  		:field,
						current_value:current_value
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>manager/edit_field', 
			success: function(result){
					$('#category_service_id_'+id).html(result);
			}
			});
	}
	function edit_field_value(id, field, changed_name, table )
	{
		$('#category_service_id_'+id).html('');
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
			url: '<?php echo base_url();?>manager/edit_field_value', 
			success: function(result){
					$('#category_service_id_'+id).html(result);
				}});
	}
	function change_floors(id)
	{
		var postData={ 
				id				:id
				}
			$.ajax({
			type: 'POST',
			data: postData,
			 dataType: "json",
			url: '<?php echo base_url();?>manager/change_floors', 
			success: function(result){
				var selectbox = document.getElementById("floor");    
				var i;
					for(i=selectbox.options.length-1;i>=0;i--)
					{
						selectbox.remove(i);
					}
				//
				var selectbox2 = document.getElementById("unit");    
				var i;
					for(i=selectbox2.options.length-1;i>=0;i--)
					{
						selectbox2.remove(i);
					}
				//
				var j;
					var x = document.getElementById("floor");
					var option = document.createElement("option");
					option.text = 'G';
					x.add(option);
					for(j=1; j<=parseInt(result.floors); j++)
					{
						var x = document.getElementById("floor");
						var option = document.createElement("option");
						option.text = j;
   						x.add(option);
					}
					
				//
				var k;
					for(k=1; k<=parseInt(result.units); k++)
					{
						var x = document.getElementById("unit");
						var option = document.createElement("option");
						option.text = k;
   						x.add(option);
					}
				//$('#floor').val(result.floors);
				//$('#unit').val(result.units);
			}});
	}
		
	
$('#forgot-pass-click').click(function(){
    $("#forgot-password").show();
     $("#login-form").hide();
});

$('#forgot-pass-back').click(function(){
	$("#login-form").show();
	$("#forgot-password").hide();
});
	$("#edit_state").change(function()
	{
	   var state=$("#edit_state").val();
	   if(state != ''){
		  $.ajax({
			type: 'POST',
			url: '<?php echo base_url('vendor/get_city_from_state_edit'); ?>',
			data: 'state='+state+'&ajax=1',
			dataType : "json",
			success: function( data ) {
			  $("#city").html(data.values);
			  $("#city").removeAttr("name");
			  $("#city" ).next().html(data.values_option); 
			  $("#condo").html(data.condo_values);
			  
			   $(".multiselect").multiselect("destroy").multiselect({
					 columns: 4,
					 placeholder: 'Select options'
			   });
			   $('.multiselect').multiselect({
					columns: 4,
					placeholder: 'Select options'
			   });
	  
			},
			error: function(xhr, status, error) {
			alert(status);
			},
			});
		  }
	});
	//
	$('select.chosen').chosen({width:"100%"});
		$(".my-select").chosen({width:"100%"});
});
function highlightStar(obj,id) {
	removeHighlight(id);		
	$('.demo-table #tutorial-'+id+' li').each(function(index) {
		$(this).addClass('highlight');
		if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
			return false;	
		}
	});
}

function removeHighlight(id) {
	$('.demo-table #tutorial-'+id+' li').removeClass('selected');
	$('.demo-table #tutorial-'+id+' li').removeClass('highlight');
}

function addRating(obj,id) {
	$('.demo-table #tutorial-'+id+' li').each(function(index) {
		$(this).addClass('selected');
		$('#tutorial-'+id+' #rating').val((index+1));
		if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
			return false;	
		}
	});
	/*$.ajax({
	url: "<?php echo base_url();?>vendor/add_rating",
	data:'id='+id+'&feedback='+$('#feedback').val()+'&rating='+$('#tutorial-'+id+' #rating').val(),
	type: "POST"
	});*/
}

function addRating_feeback(id)
{
	$.ajax({
	url: "<?php echo base_url();?>vendor/add_rating",
	data:'id='+id+'&feedback='+$('#feedback').val()+'&rating='+$('#tutorial-'+id+' #rating').val(),
	type: "POST"
	});
	$('.demo-table').hide(); 
	$('.show_message').show(); 
	$('.show_message').html('<h3>Thanks for your feedback. Much appreciated.<h3>'); 
	setTimeout(function(){ 
		window.location.href='<?php echo base_url();?>vendor';
	}, 5000);
}
function resetRating(id) {
	if($('#tutorial-'+id+' #rating').val() != 0) {
		$('.demo-table #tutorial-'+id+' li').each(function(index) {
			$(this).addClass('selected');
			if((index+1) == $('#tutorial-'+id+' #rating').val()) {
				return false;	
			}
		});
	}
} 
</script>