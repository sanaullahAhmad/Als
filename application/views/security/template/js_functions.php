<script>
//Add user
$(document).ready( function(){
	
	//
	 $('#timepicker1').timepicker();
	 $('#timepicker2').timepicker();
	 $('#timepicker3').timepicker();
	//Edit Condo Profile
	$("#addentry-visitor").validate({
		rules: {
			description: {
				required: true
			},
			vehicle_no: {
			   required: true,
			},
			visitor_name: {
			   required: true,
			},
			date: {
			   required: true,
			},
			time: {
			   required: true,
			   remote: 
					   {
						  url: "<?php echo base_url()?>home/check_time_formate",
						  type: "post",
						  data: 
						  {
							  time: function(){ return $("#timepicker1").val(); }
						  }
					   }
			},
		},
		messages: {
		  description: {
				required: "Please enter Description",
			},
		  vehicle_no: {
				required: "Please enter Vehicle No",
			},
		  visitor_name: {
				required: "Please enter Visitor Name",
			},
		  date: {
				required: "Please enter Date",
			},
		  time: {
				required: "Please enter Time",
				remote: "Use this time formate 09:45 PM",
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
	
	
	
	//Edit Condo Profile
	$("#addentry-delivery").validate({
				rules: {
	                description: {
	                    required: true
	                },
					company_name: {
					   required: true,
					},
					date: {
					   required: true,
					},
					time: {
					   required: true,
					   remote: 
							   {
								  url: "<?php echo base_url()?>home/check_time_range/condo_admins",
								  type: "post",
								  data: 
								  {
									  time: function(){ return $("#timepicker1").val(); }
								  }
							   }
					},
					
	            },
	            messages: {
				  company_name: {
						required: "Please enter Visitor Name",
					},
				  date: {
						required: "Please enter Date",
					},
				  time: {
				required: "Please enter Time",
				remote: "Visit Allowed in <?php if($this->session->userdata('security_id')!=""){
					$action="condo_id=$this->condo_id AND role='1'";
				$get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
				if($get_admin >0)
				{
					foreach($get_admin as $admin)
					{
						echo date("h:i A",strtotime($admin['delivery_time_starts']))." and ".date("h:i A",strtotime($admin['delivery_time_ends']));
					}
				}
				}?> range",
					},
                  description: {
	                    required: "Please enter Description",
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
	
	//Edit Condo Profile
	$("#addvisitordelivery-form").validate({
				rules: {
	                block: {
	                    required: true
	                },
					floors: {
					   required: true,
					},
					unit: {
					   required: true,
					},/*
					resident: {
					   required: true,
					},*/
					type: {
					   required: true,
					},
					
	            },
	            messages: {
		  			block: {
						required: "Please enter block",
					},
		  			floors: {
						required: "Please enter floors",
					},
							unit: {
						required: "Please enter unit",
					},/*
		  			resident: {
						required: "Please enter resident",
					},*/
		  			type: {
						required: "Please enter type",
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
                   url: "<?php echo base_url()?>security/check_login",
                   data: $("#login-form").serialize(), 
                   cache: false,
				   beforeSend: function(){ $("#logsubbutton").text('Checking...');},
                  success: function(data) {
					  //alert(data);
					   if(data == 'active'){
                           	$('.fornotactive').hide();
							$('.forincorrectunpass').hide();
							$('.condoinactive').hide();
                            $("#logsubbutton").html('Logging you in... <i class="m-icon-swapright m-icon-white"></i>');
							<?php if(isset($_GET['next'])){?>
							window.location.href = "<?php echo $_GET['next'];?>";
							<?php } else {?>
                            window.location.href = "<?php echo base_url()?>security/dashboard";
							<?php }?>
                        } else if(data == 'condo inactive'){
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
							$('.condoinactive').show();
                            $('.fornotactive').hide();
							$('.forincorrectunpass').hide();
                        }else if(data == 'notactive'){
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
                            $('.fornotactive').show();
							$('.forincorrectunpass').hide();
							$('.condoinactive').hide();
                        } else {
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
							 $("#password").val('');
						   $('.forincorrectunpass').show();
						   $('.fornotactive').hide(); 
							$('.condoinactive').hide();
                        }
                    },
                   error: function() {
                        alert('Something went wrong');
                   }
                 });
        }
    });
	//Change Password
	$("#change-password").validate({
				  rules: {
					password: {
	                    required: true,
	                     remote: {
							url: "<?php echo base_url()?>security/check_data_exists_md5/password/condo_admins",
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
	$("#forgot-pass-form-manager").validate({
				  rules: {
					email_forgot: {
	                    required: true,
						email: true,
	                     remote: {
							url: "<?php echo base_url()?>security/check_data_exists_forgot_pass/email_forgot/condo_admins",
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

                   url: "<?php echo base_url()?>security/forgot_password",

                   data: $("#forgot-pass-form-manager").serialize(), 

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
	
	$('#forgot-pass-click').click(function(){
		$("#forgot-password").show();
	    $("#login-form").hide();
	});
	
	$('#forgot-pass-back').click(function(){
		$("#login-form-manager").show();
		$("#forgot-password").hide();
	});
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
			url: '<?php echo base_url();?>security/change_floors', 
			success: function(result){
				var selectbox = document.getElementById("floors");    
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
					var x = document.getElementById("floors");
					var option = document.createElement("option");
					option.text = 'G';
					x.add(option);
					for(j=1; j<=parseInt(result.floors); j++)
					{
						var x = document.getElementById("floors");
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
				//
				
				//$('#floor').val(result.floors);
				//$('#unit').val(result.units);
			}});
	}
	function search_resident()
	{
		var blocks = document.getElementById("block").value;
		var floors = document.getElementById("floors").value;
		var units = document.getElementById("unit").value;
		var postData={ 
			 blocks:blocks,
			 floors:floors,
			 units:units,
		}
		$.ajax({
		type: 'POST',
		data: postData,
		 dataType: "json",
		url: '<?php echo base_url();?>security/search_resident', 
		success: function(result){
				var selectbox = document.getElementById("resident");    
				var i;
					for(i=selectbox.options.length-1;i>=0;i--)
					{
						selectbox.remove(i);
					}
				//
				var x = document.getElementById("resident");
				var option = document.createElement("option");
				option.text = result.name;
				option.value = result.id;
				x.add(option);
			}
		});
	}
	function checkintime(field,visitor_request_id, table)
	{
		//alert(field+visitor_request_id);
		var postData={ 
				field				:field,
				table				:table,
				visitor_request_id	:visitor_request_id
				}
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>security/checkintime', 
			success: function(result){
				var currentdate = new Date(); 
				var datetime = "" + currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + "  "  
                + ((currentdate.getHours()>12)?(currentdate.getHours()-12):currentdate.getHours()) +":"  
                + currentdate.getMinutes() + " " +
                ((currentdate.getHours()>12)?('PM'):'AM');
				if(result=='check_in')
				{
					$('.checkintimecl_'+table+'_'+visitor_request_id).addClass('upload');
					$('.check_in_time_'+table+'_'+visitor_request_id).html('Check In: '+datetime+'<br>');
					$('.checkintimecl_'+table+'_'+visitor_request_id).removeClass('download');
					$('.checkintimecl_'+table+'_'+visitor_request_id+' span').html('Check Out');
					$('.checkintimecl_'+table+'_'+visitor_request_id).attr("onclick","checkintime('check_out','"+visitor_request_id+"','"+table+"')");
					window.location.reload();
					
				}
				if(result=='check_out')
				{
					$('.checkintimecl_'+table+'_'+visitor_request_id).hide();
					$('.check_out_time_'+table+'_'+visitor_request_id).html('Check Out: '+datetime+'<br>');
					window.location.reload();
					/*$('.checkintimecl_'+visitor_request_id).addClass('download');
					$('.checkintimecl_'+visitor_request_id).removeClass('upload');
					$('.checkintimecl_'+visitor_request_id+' span').html('Check In');
					$('.checkintimecl_'+visitor_request_id).attr("onclick","checkintime('check_in',"+visitor_request_id+")");*/
				}
			  }
			});
	}
</script>