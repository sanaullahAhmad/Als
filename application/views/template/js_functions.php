<script>

<?php if(isset($_GET['next'])){?>
$(document).ready(function(){
	
$("#signin_home").trigger("click");
});
/*Ads position fixed script starts here*/


<?php } ?>
	
	
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
                   url: "<?php echo base_url()?>home/check_login",
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
							window.location.href = "<?php echo base_url()?>dashboard";
							<?php }?>
                            
                        } else if(data == 'notactive'){
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
                            $('.fornotactive').show();
							$('.forincorrectunpass').hide();
							$('.unitblocked').hide();
                        } else if(data == 'unitblocked'){
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
                            $('.unitblocked').show();
                            $('.fornotactive').hide();
							$('.forincorrectunpass').hide();
                        }
						else {
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
							 $("#password").val('');
						   $('.forincorrectunpass').show();
						   $('.fornotactive').hide();
							$('.unitblocked').hide();
                        }
                    },
                   error: function() {
                        alert('Something went wrong');
                   }
                 });
        }
    });
	
	$('#forgot-pass-click').click(function(){
		$("#forgot-pass-form").show();
		$(".drop-forgotpassword").show();
		$("#login-form").hide();
		$(".drop-signin").hide();
	});
	$('#forgot-pass-back').click(function(){
		$("#login-form").show();
		$(".drop-signin").show();
		$(".drop-forgotpassword").hide();
		$("#forgot-pass-form").hide();
		$("#success-message").hide();
		$("#forgotpasssubbutton").html("Send Link");
	});
		
	//Forgot Password
	$("#forgot-pass-form").validate({
				  rules: {
					email_forgot: {
	                    required: true,
						email: true,
	                     remote: {
							url: "<?php echo base_url()?>home/check_data_exists_forgot_pass/email_forgot/residents",
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

                   url: "<?php echo base_url()?>home/forgot_password",

                   data: $("#forgot-pass-form").serialize(), 

                   cache: false,

				   beforeSend: function(){ $("#forgotpasssubbutton").text('Sending Link...');},
				   
                  success: function(data) {
					  if(data == 'LINKSENT'){
					  	$("#success-message").show();
						$("#forgot-pass-form").hide();
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
							url: "<?php echo base_url()?>home/check_data_exists_md5/password/residents",
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
	//Add Advertizement
	$("#add-advertisement").validate({
				  rules: {
					title: {
	                    required: true,
	                },
					 add_image: {
	                    required: true
	                },
					 /*add_link: {
	                    required: true,
	                }
*/	            },
	            messages: {
					title: {
	                    required: "Please enter title",
	                },
					 add_image: {
	                    required: "Please select image",
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
	//Add manual payment
	$("#manual-payment").validate({
				  rules: {
					 manual_receipt: {
	                    required: true
	                }
	            },
	            messages: {
					 manual_receipt: {
	                    required: "Please select image",
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
	
	//Change Password
	$("#dashboar-post-form").validate({
			rules: {
				post: {
					required: true
				}
			},
			messages: {
				 post: {
					required: "Please enter some text.",
				}
			},
			debug: true,
			errorPlacement: function(error, element) 
			{
				var name = $(element).attr("name");
				error.appendTo($("#" + name + "_validate"));
			}, 
        submitHandler: function(form) 
		{
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
	
	
	//Edit Condo Profile
	$("#resident-profile").validate({
				rules: {
	                name: {
	                    required: true
	                },
	                
					email: {
	                   required: true,
					   email: true,
					   remote: 
					   {
						  url: "<?php echo base_url()?>home/check_data_exists/email/residents",
						  type: "post",
						  data: 
						  {
							  email: function(){ return $("#email").val(); },
							  current_name: function(){ return $("#current_email").val(); }
						  }
					   }
	                },
	                phone: {
	                    required: true
	                }
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
                  phone: {
	                    required: "Please enter phone",
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
	$("#resident-visitor").validate({
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
							  time: function(){ return $("#time").val(); }
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
	
	//add-service-request
	$("#add-service-request").validate({
		rules: {
			service_category: {
				required: true
			},
			service: {
			   required: true,
			},
			description: {
			   required: true,
			},
			duration: {
			   required: true,
			},
		},
		messages: {
		  service_category: {
				required: "Please Select Service Category",
			},
		  service: {
				required: "Please enter Service",
			},
		  description: {
				required: "Please enter Description",
			},
		  duration: {
				required: "Please enter duration",
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
	
	//add-facility-booking
	$("#add-facility-booking").validate({
		rules: {
			condo_facility: {
				required: true
			},
			startdatetime: {
			   required: true,
			},
			arivaldatetime: {
			   required: true,
			},
			enddatetime: {
			   required: true,
			}
		},
		messages: {
		  condo_facility: {
				required: "Please Select facility",
			},
		  startdatetime: {
				required: "Please enter startdatetime",
			},
		  arivaldatetime: {
				required: "Please enter arival datetime",
			},
		  enddatetime: {
				required: "Please enter enddatetime",
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
	//users management moved date
	$("#user-management-moved-date").validate({
		rules: {
			moved_date: {
				required: true
			},
		},
		messages: {
		  moved_date: {
				required: "Please Select moved date",
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
	$("#resident-delivery").validate({
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
					file_upload: {
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
					time: {
					   required: true,
					   remote: 
							   {
								  url: "<?php echo base_url()?>home/check_time_range/condo_admins",
								  type: "post",
								  data: 
								  {
									  time: function(){ return $("#time").val(); }
								  }
							   }
					},
					
	            },
	            messages: {
		  company_name: {
				required: "Please enter Company Name",
			},
		  date: {
				required: "Please enter Date",
			},
		  file_upload: {
				required: "Please select an image",
				fileType: "File Type must be jpeg/jpg/png",
				maxFileSize: "Maximum of 2MB is allowed",
				minFileSize: "Minimum File size required 10KB"
				},
		  time: {
				required: "Please enter Time",
				remote: "Visit Allowed in <?php if($this->session->userdata('resident_id')!=""){
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
	$("#incident-reporting").validate({
				rules: {
	                incident_report: {
	                    required: true
	                },
	                
	                incident_category: {
	                    required: true
	                }
	            },
	            messages: {
                  incident_report: {
	                    required: "Please enter incident report",
	                },
                  incident_category: {
	                    required: "Please enter incident category",
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
	$("#invite_users").validate({
				rules: {
	                email: {
	                    required: true
	                },
	            },
	            messages: {
                  email: {
	                    required: "Please enter emails",
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
	
	//Just Pay
	$("#make_payment").validate({
		rules: {
			payment_type: {
				required: true,
			},
			amount: {
				required: true,
				number: true
			},
			reason_payment: {
			   required: true,
			}
		},
		messages: {
		  payment_type: {
				required: "Please select payment type",
			},
		  amount: {
				required: "Please enter an amount",
			},
		  reason_payment: {
				required: "Please tell us for what purpose you are making a payment",
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

	
	
	
	function delete_image(vlu,htm)
	{
		$('#'+vlu).val('0');
		$('#'+htm).html('');
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
	function delete_service_request(id)
	{
		if (confirm('Are you sure?')) 
		{
			$('.rowclss_'+id).remove();
			var postData={ 
							id:id,
						 }
			$.ajax({
				type: 'POST',
				data: postData,
				url: '<?php echo base_url().'home/delete_service_request/'; ?>', 
				success: function(result){
				  
				}
			});
		} 
		else 
		{
           return false;
        }
	}
	function add_resident(link_condo_id)
	{
		var postData={ 
						link_condo_id			:link_condo_id,
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url().'home/add_resident_session/'; ?>', 
			success: function(result){
					window.location.href='<?php echo base_url().'login/'; ?><?php if(isset($_GET['next'])){ echo "?next=".$_GET['next'];}?>';
			}
			});
	}
	
	
	function select_facility_desc_n_img(facility_id)
	{
		var postData={ 
						facility_id			:facility_id,
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			dataType: "json",
			url: '<?php echo base_url().'home/select_select_facility_desc_n_img/'; ?>', 
			success: function(result){
					$('.facility_image').html(result.image);
					$('#facility_description').val(result.description);
			}
			});
	}
	function po_approve_resident(id, status)
	{
		var postData={ 
						id			:id,
						status		:status
				 }
		$.ajax({
		type: 'POST',
		data: postData,
		url: '<?php echo base_url();?>home/po_approve_resident/', 
		success: function(result){
				$('.po_approve_resident_'+id).html('');
		}
		});
	}
	
	function select_services(category_id)
	{
		var postData={ 
						category_id			:category_id,
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url().'home/select_category_services/'; ?>', 
			success: function(result){
					$('.service_box').html(result);
			}
			});
	}
	
	
	function approve_quote(id, status)
	{
		$('#quote_id').val(id);
		var postData={ 
						id			:id,
						status		:status
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>home/approve_quote/', 
			success: function(result){
					if(status==2)
					{
						$('#'+id).html('Waiting for Manager');
					}
					else
					{
						$('#'+id).html('Disapproved');
					}
			}
			});
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
			url: '<?php echo base_url();?>resident/change_floors', 
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
				//$('#floor').val(result.floors);
				//$('#unit').val(result.units);
			}});
	}
	$(document).ready(function(){
		$("#search-box-input").blur(function(){
			setTimeout(function(){ 
				$(".fancy-arrow").css("display","inline-block");
				$("#suggesstion-box").css("display","none");
			 }, 300);
			});
		$("#search-box-input").keyup(function(){
			
			var keyword = $(this).val();
			   
			var obj = new Object();
			obj.keyword = keyword;
			   
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>home/fetch_condos",
				data: 'json_data='+JSON.stringify(obj),
				beforeSend: function(){
					$("#search-box-input").css("background","#FFF url(assets/front/images/ajax-loader.gif) no-repeat 430px");
				},
				success: function(data){
					//alert(data.condo_lists);
					$("#suggesstion-box").show();
					$("#suggesstion-box").html(data.condo_lists);
					$("#search-box-input").css("background","#FFF");
					$(".fancy-arrow").css("display","none");
				},
				error: function() {
					alert('Something went wrong');
				 },
				 dataType: 'json'
			});
		});
		//Search page 
		$("#search-box-input-second").keyup(function(){
			
			var keyword = $(this).val();
			   
			var obj = new Object();
			obj.keyword = keyword;
			   
			$.ajax({
				type: "POST",
				url: "<?php echo base_url()?>home/fetch_condos",
				data: 'json_data='+JSON.stringify(obj),
				beforeSend: function(){
					$("#search-box-input-second").css("background","#FFF url(assets/front/images/ajax-loader.gif) no-repeat 430px");
				},
				success: function(data){
					//alert(data.condo_lists);
					$("#suggesstion-box-second").show();
					$("#suggesstion-box-second").html(data.condo_lists);
					$("#search-box-input-second").css("background","#FFF");
				},
				error: function() {
					alert('Something went wrong');
				 },
				 dataType: 'json'
			});
		});
		
		
		/*$( ".checkalert").on( "click", function() {
			alert($(this).attr("id"));
		});*/
		
		
		$("#contact-us").validate({
			rules: {
				name: {
					required: true
				},
				email: {
					required: true,
					email:true
				},
				phone: {
				   required: true
				},
				message: {
					required: true
				}
			},
			messages: {
			  name: {
					required: "Please enter a name",
				},
			  email: {
					required: "Please enter an email",
					email: "Please enter a valid email address"
				},
			  phone: {
					required: "Please enter a phone number",
				},
			  message: {
					required: "Please enter a message",
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
                   url: "<?php echo base_url()?>home/send_contacts_data",
                   data: $("#contact-form-front").serialize(), 
                   cache: false,
				   beforeSend: function(){ $("#contactussub").text('Sending Email...');},
                   success: function(data) {
					   
					   if(data == 'contactsent'){
                           	alert('success');
                            
                        } 
                    },
                   error: function() {
                        alert('Something went wrong');
                   }
                 });
			}
		});
		
		
		
		
		
		 //Add Resident Form
		$("#addresident-form").validate({
			
					  rules: {
						name: {
							required: true/*,
							  remote: {
							  url: "<?php echo base_url()?>manager/check_data_exists/name/residents",
							  type: "post",
							  data: {
								  name: function(){ return $("#name").val(); }
								}
							  }*/
						},
							
						email: {
							required: true,
							  remote: {
							  url: "<?php echo base_url()?>home/check_data_exists/email/residents",
							  type: "post",
							  data: {
								  email: function(){ return $("#email").val(); }
							  }
							}
						},
						
						block: {
							required: true
						},
						
						floors: {
							required: true
						},
						
						unit: {
							required: true
						},
						
						type: {
							required: true
						},
					},
					messages: {
					  name: {
							required: "Please enter Name"/*,
							remote: "Name Already Exist.",*/
						},
					  email: {
							required: "Please enter Email",
							remote: "Email Already Exist.",
						},
					  block: {
							required: "Please enter block",
						},
					  floors: {
							required: "Please enter Floors",
						},
					  unit: {
							required: "Please enter Units",
						},
					  type: {
							required: "Please enter Type",
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
	});
	
	function selectCountry(val) {
		alert('ssd');
	/*$("#search-box-input").val(val);
	$("#suggesstion-box").hide();*/
	}
	
	function checkalert(sd){
		$("#search-box-input").val(sd);
		$("#suggesstion-box").hide();
		
		$("#search-box-input-second").val(sd);
		$("#suggesstion-box-second").hide();
	}
	
	<?php 
	$timestamp = time();
	if($this->uri->segment(1)=='' || $this->uri->segment(1)=='search')
	{
		//
	} 
	else 
	{?>
	$(function() {
		$('#file_upload').uploadify({
			'queueSizeLimit' : 5,
			'onUploadStart' : function(file) 
			{
				$("#post_submit_btn").prop('disabled', true);
				
				lenth = $('.images_names').length;
				if(lenth<6)
				{ 
					return true
				}
				else
				{
					alert("You have already Selected Five images.");
					$('#file_upload').uploadify('cancel', file.id)
					return false;//this will stop add progress bar
				}
			},
			'onSelect' : function(e,q,f) 
			{
				lenth = $('.images_names').length;
				if(lenth<6)
				{ 
					return true
				}
				else
				{
					alert("You have already Selected Five images.");
					$('#file_upload').uploadify('cancel', '*')
					return false;//this will stop add progress bar
				}
			},
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
			},
			'swf'      : '<?php echo base_url();?>assets/front/images/uploadify.swf',
			'uploader' : '<?php echo base_url();?>home/uploadify_new',
			'onUploadSuccess' : function(file, data, response) {
				//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
				if(data!='Invalid file type.')
				{
					//$('#images_ids').val($('#images_ids').val() + ','+data);}
					var res = data.split(".");
					$("#post_submit_btn").prop('disabled', false);
					//$('#featured_image').val(data);
					var ran = "";
					var charset = "abcdefghijklmnopqrstuvwxyz";
					for( var i=0; i < 5; i++ )
						ran += charset.charAt(Math.floor(Math.random() * charset.length));
					$('#additional_images').append('<section style="position:relative; float:left" class="'+ran+'"><img src="<?php echo base_url()?>uploads/post_images/'+data+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;post_images&#39;, &#39;posts_images&#39;)" class="image_delete_cross">&#120;</span><input type="hidden" name="images_names[]" value="'+data+'" class="images_names"></section>');
					
				}
			}
		});
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
			'uploader' : '<?php echo base_url();?>home/uploadify_advert_images',
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
		$('#advertisement_featured_image').uploadify({
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
			'uploader' : '<?php echo base_url();?>home/advertisement_featured_image',
			'onUploadSuccess' : function(file, data, response) {
				//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
				if(data!='Invalid file type.')
				{
					$('#featured_image').val(data);
					$('#img_featured').html('<section style="position:relative"><img src="<?php echo base_url()?>uploads/post_images/'+data+'" class="img_responsive" style="width:400px;"/><span onclick="delete_image(&#39;featured_image&#39;,&#39;img_featured&#39;)"  class="image_delete_cross" style="top:0px;position:absolute;">&#120;</span></section>');
					$("#addadvertisementsub").prop('disabled', false);
				}
			}
		});
		
		//For Add Service Page this function no longer uses, jquery file upload is used now
		/*$('#service_request_file').uploadify({
			'queueSizeLimit' : 5,
			'onUploadStart' : function(file) 
			{
				$("#service_request_submit").prop('disabled', true);
				
				lenth = $('.images_names').length;
				if(lenth<5)
				{ 
					return true
				}
				else
				{
					alert("You have already Selected Five images.");
					$('#file_upload').uploadify('cancel', file.id)
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
					$('#file_upload').uploadify('cancel', '*')
					return false;//this will stop add progress bar
				}
			},
			'formData'     : {
				'timestamp' : '<?php echo $timestamp;?>',
				'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
			},
			'swf'      : '<?php echo base_url();?>assets/front/images/uploadify.swf',
			'uploader' : '<?php echo base_url();?>home/uploadify_service_request',
			'onUploadSuccess' : function(file, data, response) {
				if(data!='Invalid file type.')
				{
					$("#service_request_submit").prop('disabled', false);
					var ran = "";
					var charset = "abcdefghijklmnopqrstuvwxyz";
					for( var i=0; i < 5; i++ )
						ran += charset.charAt(Math.floor(Math.random() * charset.length));
					$('#service_request_span').append('<section style="position:relative; float:left" class="'+ran+'"><img src="<?php echo base_url()?>uploads/services_requests/'+data+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross">&#120;</span><input type="hidden" name="images_names[]" value="'+data+'" class="images_names"></section>');
				}
			}
		});*/
		
		$(function () {
			'use strict';
			//$("#progress").hide();
			$("#progress").css( 'display', 'none');
			$("#progress_loading").css( 'display', 'none');
			//For home Page
			$('#home_file_upload').fileupload({
				url: '<?php echo base_url()?>home/upload_home_post_images',
				dataType: 'json',
				done: function (e, data) 
				{
					$.each(data.result.files, function (index, file) 
					{
						//check if file upload exeeded
						var check_images = $("#files").html();
						if(check_images!='')
						{
							var lenth = $('#files .images_names').length;
							if(lenth>4)
							{ 
								alert("You have already Selected Five images.");
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
						
						$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><img src="<?php echo base_url()?>uploads/post_images/'+file.name+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;post_images&#39;, &#39;posts_images&#39;)" class="image_delete_cross" >&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
						}
						else
						{
							$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><span class="label label-warning">'+file.name+'</span><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span></section>');
						}
					});
				},
				progressall: function (e, data) 
				{
					$("#progress").css( 'display', 'block');
					$("#progress_loading").css( 'display', 'block');
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$('#progress .progress-bar').css(
						'width',
						progress + '%'
					);
					if(progress>99){ setTimeout(function(){ $("#progress, #progress_loading").css( 'display', 'none'); }, 3000); }
				}
			}).prop('disabled', !$.support.fileInput)
				.parent().addClass($.support.fileInput ? undefined : 'disabled');
			//For Add Advertisement Page
			$('#fileupload').fileupload({
				url: '<?php echo base_url()?>home/upload_advert_images',
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
							if(lenth>4)
							{ 
								alert("You have already Selected Five images.");
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
						
						$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><img src="<?php echo base_url()?>uploads/advertisement_images/'+file.name+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;advertisement_images&#39;, &#39;advert_images&#39;) class="image_delete_cross" >&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"><input type="radio" class="ftr_img_radio" name="featured_image" value="'+file.name+'" title="Mark Featured"></section>');
						}
						else
						{
							$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><span class="label label-warning">'+file.name+'</span><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span></section>');
						}
					});
				},
				progressall: function (e, data) 
				{
					$("#progress").css( 'visibility', 'visible');
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$('#progress .progress-bar').css(
						'width',
						progress + '%'
					);
					if(progress>99){$("#progress").css( 'visibility', 'hidden');}
				}
			}).prop('disabled', !$.support.fileInput)
				.parent().addClass($.support.fileInput ? undefined : 'disabled');
			//For Add Service Page
			$('#service_request_file').fileupload({
				url: '<?php echo base_url()?>home/upload_service_request',
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
							if(lenth>4)
							{ 
								alert("You have already Selected Five images.");
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
						$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><img src="<?php echo base_url()?>uploads/services_requests/'+file.name+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;services_requests&#39;, &#39;service_requests_images&#39;)" class="image_delete_cross" >&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
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
			//For Add Incidents Page
			$('#incidents_file_upload').fileupload({
				url: '<?php echo base_url()?>home/upload_incidents',
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
							if(lenth>4)
							{ 
								alert("You have already Selected Five images.");
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
						$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><img src="<?php echo base_url()?>uploads/incident_images/'+file.name+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;incident_images&#39;, &#39;incident_images&#39;)" class="image_delete_cross" >&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
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
		
		
		// for incident page  this function no longer uses, jquery file upload is used now
		/*$('#incidents_file_upload').uploadify({
			'queueSizeLimit' : 5,
			'onUploadStart' : function(file) 
			{
				$("#incidentreportingsub").prop('disabled', true);
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
			'uploader' : '<?php echo base_url();?>home/uploadify_incidents',
			'onUploadSuccess' : function(file, data, response) {
				//alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
				if(data!='Invalid file type.')
				{
					//$('#images_ids').val($('#images_ids').val() + ','+data);}
					$("#incidentreportingsub").prop('disabled', false);
					var ran = "";
					var charset = "abcdefghijklmnopqrstuvwxyz";
					for( var i=0; i < 5; i++ )
						ran += charset.charAt(Math.floor(Math.random() * charset.length));
					$('#incidents_span').append('<section style="position:relative; float:left" class="'+ran+'"><img src="<?php echo base_url()?>uploads/incident_images/'+data+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross">&#120;</span><input type="hidden" name="images_names[]" value="'+data+'" class="images_names"></section>');
				}
			}
		});*/
	});
	<?php } ?>
	$(function(){
		 $(".comment").keyup(function(e)
		 {
			  var post_id = $(this).attr('postid')
			  var comment = $(".comment_"+post_id).val();
			 
			  if (e.keyCode === 13) 
			  {
				    $(".comment_"+post_id).val('');
					$("#new_comments_"+post_id).prepend('<div class="a-form-section full-widht-nopadding">'+comment+'</div>');
					var postData={ 
								comment	:comment,
								post_id :post_id
								}
					$.ajax(
					{
						type: 'POST',
						data: postData,
						dataType: "json",
						url: '<?php echo base_url();?>home/comment_submit', 
						success: function(result)
						{
							
						}
				    });
			  }
		 });
	});
	function remove_profile_image(id)
	{
		if (confirm('Are you sure?')) 
		{
			$('.profie_image').attr('src','<?php echo base_url()?>assets/front/images/no-image.jpg');
			$.ajax({
				'url': '<?php echo base_url();?>home/remove_profile_image',
				'type': 'post',
				'data': {
					'id': id
				},
				'cache': false,
				'success': function(result){
					location.reload();
					//$("#tr_"+post_id).hide();
				}
			});
		} 
		else 
		{
           return false;
        }
		
		
	}
	
	function callCrudAction(table,id,controller) {
	if (confirm('Are you sure?')) {
		queryString = 'table='+table+'&id='+ id;
		
		jQuery.ajax({
		url: "<?php echo base_url()?>home/"+controller,
		data:queryString,
		type: "POST",
		success:function(data)
		{
			window.location.reload();
		},
		error:function (){}
	  });
	} 
	else 
	{
	   return false;
    }
	}
	
	
</script>
<?php 
	if($this->uri->segment(1)=='calender')
	{?>
	<script>
        $(document).ready(function() {
            
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: '<?php echo date('Y-m-d')?>',
				defaultView: 'agendaWeek',
                selectable: true,
                selectHelper: true,
                select: function(start, end) {
                    var title = prompt('Event Title:');
                    var eventData;
                    if (title) {
                        eventData = {
                            title: title,
                            start: start,
                            end: end
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    }
                    $('#calendar').fullCalendar('unselect');
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                <?php foreach($facility_booking as $booking){
					$payment_channel=2;
				    $payment_status=2;
					  $invoice = $this->General_model->get_data_rowusingwhere_empty_array('invoices', " booking_id=".$booking['id']);
					  if(sizeof($invoice)>0)
					  {
						  $payment_channel=$invoice->payment_channel;
						  $payment_status=$invoice->payment_status;
					  }
				?>
                    {
                        <?php 
						if($payment_channel=="" && $payment_status=="0"){
						$nowtime = date('Y-m-d H:i:s',time() - 1800);
						$to_time = strtotime($nowtime);
						$from_time = strtotime($booking['datetime_booked']);
						
						?>
						title: '<?php echo round(abs($to_time - $from_time) / 60,0). " minutes Left";?>',
						
						<?php }else{?>
						title: '<?php echo $this->General_model->get_value_by_id('condo_facilities', $booking['facility_id'],'name');?>',
						<?php }?>
						
                        start: '<?php echo date('Y-m-d', strtotime($booking['bookedfor_datetime_from']));?>T<?php echo date('H:i:s', strtotime($booking['bookedfor_datetime_from']));?>',
                        end: '<?php echo date('Y-m-d', strtotime($booking['bookedfor_datetime_to']));?>T<?php echo date('H:i:s', strtotime($booking['bookedfor_datetime_to']));?>',
						<?php 
						if($payment_channel=="" && $payment_status=="0"){?>
						color: '#FF1493'
						<?php }else{?>
						color: '#378006'
						<?php }?>
                    },
                    <?php }?>
                ],
            });
            
        });
    </script>
<?php }?>