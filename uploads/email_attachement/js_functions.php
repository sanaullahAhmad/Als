<script>
		$('.outlet_login_form').validate({

	            errorElement: 'label', //default input error message container
	            errorClass: 'help-inline', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                outlet: {
	                    required: true
	                },
	                password: {
	                    required: true
	                },
	            },
	            messages: {
	                outlet: {
	                    required: "Outlet is required."
	                },
	                password: {
	                    required: "Password is required."
	                }
	            },
	            invalidHandler: function (event, validator) { //display error alert on form submit   

	                $('.alert-error', $('.outlet_login_form')).show();

	            },



	            highlight: function (element) { // hightlight error inputs

	                $(element)

	                    .closest('.control-group').addClass('error'); // set error class to the control group

	            },



	            success: function (label) {

	                label.closest('.control-group').removeClass('error');

	                label.remove();

	            },



	            errorPlacement: function (error, element) {

	                error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));

	            },



	            submitHandler: function (form) {

	                
                $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/check_outlet_login",

                   data: $(".outlet_login_form").serialize(), 

                   cache: false,

                  beforeSend: function(){ $("#logsubbutton").text('Checking...');},

                  success: function(data) {

                       if(data == 'active'){
                           	$('.fornotactive').hide();
							$('.forincorrectunpass').hide();
                            $("#logsubbutton").html('Logging you in... <i class="m-icon-swapright m-icon-white"></i>');
                            window.location.href = "<?php echo base_url()?>admin/dashboard";
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

            
            	return false; // prevent normal form posting

	            }

	        });



	        $('.outlet_login_form input').keypress(function (e) {

	            if (e.which == 13) {

	                if ($('.outlet_login_form').validate().form()) {

	                    $('.outlet_login_form').submit();

	                }

	                return false;

	            }

	        });

	
var handleLogin = function() {
		$('.login-form').validate({
	            errorElement: 'label', //default input error message container
	            errorClass: 'help-inline', // default input error message class
	            focusInvalid: false, // do not focus the last invalid input
	            rules: {
	                email: {
	                    required: true
	                },
	                password: {
	                    required: true
	                },
	            },
	            messages: {
	                email: {
	                    required: "Email is required."
	                },
	                password: {
	                    required: "Password is required."
	                }
	            },
	            invalidHandler: function (event, validator) { //display error alert on form submit   
	                $('.alert-error', $('.login-form')).show();
	            },
	            highlight: function (element) { // hightlight error inputs
	                $(element)
	                    .closest('.control-group').addClass('error'); // set error class to the control group
	            },
	            success: function (label) {
	                label.closest('.control-group').removeClass('error');
	                label.remove();
	            },
	            errorPlacement: function (error, element) {
	                error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));
	            },



	            submitHandler: function (form) {

	                
                $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/check_login",

                   data: $(".login-form").serialize(), 

                   cache: false,

                  beforeSend: function(){ $("#logsubbutton").text('Checking...');},

                  success: function(data) {

                       if(data == 'active'){
                           	$('.fornotactive').hide();
							$('.forincorrectunpass').hide();
                            $("#logsubbutton").html('Logging you in... <i class="m-icon-swapright m-icon-white"></i>');
                            window.location.href = "<?php echo base_url()?>admin/dashboard";
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

            
            	return false; // prevent normal form posting

	            }

	        });
	        $('.login-form input').keypress(function (e) {

	            if (e.which == 13) {

	                if ($('.login-form').validate().form()) {

	                    $('.login-form').submit();

	                }

	                return false;

	            }

	        });
	}
	var handleForgetPassword = function () {

		$('.forget-form').validate({

	            errorElement: 'label', //default input error message container

	            errorClass: 'help-inline', // default input error message class

	            focusInvalid: false, // do not focus the last invalid input

	            ignore: "",

	            rules: {

	                email: {
                		required: true,
                		email: true,
						remote: {
						url: "<?php echo base_url()?>admin/check_email_exists",
						type: "post",
						data: {
								email: function(){ return $("#email").val(); 
							}
						}
					}
              }


	            },



	            messages: {
	               'email': {
						required: "Please enter an email",
						email: "Please enter a valid email address",
						remote: "That email was not registered with us."
					 }

	            },


				invalidHandler: function (event, validator) { //display error alert on form submit   
	            },


	            highlight: function (element) { // hightlight error inputs

	                $(element)

	                    .closest('.control-group').addClass('error'); // set error class to the control group

	            },


	            success: function (label) {

	                label.closest('.control-group').removeClass('error');

	                label.remove();

	            },


	            errorPlacement: function (error, element) {

	                error.addClass('help-small no-left-padding').insertAfter(element.closest('.input-icon'));

	            },


	            submitHandler: function (form) {

                $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/send_code",

                   data: $(".forget-form").serialize(), 

                   cache: false,

                   

                   success: function(data) {
						 jQuery('.forget-form').hide();
	            		 jQuery('.forget-form-code').show();
						 $('#oriemail').val(data);
						$('#oriemail_np').val(data);
                   },

                   error: function() {
                        alert('Something went wrong');
                   }

                 });

            
            	return false; // prevent normal form posting
	            }

	        });

			$('#forgotlogin_vc').click(function(event){
					event.preventDefault();
					 $.ajax({

						   type: "POST",
		
						   url: "<?php echo base_url()?>admin/verify_code",
		
						   data: $(".forget-form-code").serialize(), 
		
						   cache: false,
		
						   
		
						   success: function(data) {
							   if(data == 'verified')
							   {
								 jQuery('.forget-form-code').hide();
								 jQuery('.forget-form-newpassword').show();
							   }
							   else
							   {
								   alert('Code Mismatch');
							   }
						   },
		
						   error: function() {
								alert('Something went wrong');
						   }
		
					});
				})
				
			$('#forgotlogin_np').click(function(event){
					event.preventDefault();
					 $.ajax({

						   type: "POST",
		
						   url: "<?php echo base_url()?>admin/new_password",
		
						   data: $(".forget-form-newpassword").serialize(), 
		
						   cache: false,
		
						   
		
						   success: function(data) {
								 jQuery('.forget-form-newpassword').hide();
								 jQuery('.login-form').show();
						   },
		
						   error: function() {
								alert('Something went wrong');
						   }
		
					});
				})
				
			$('#changepassword_btn').click(function(event){
					event.preventDefault();
					 $.ajax({

						   type: "POST",
		
						   url: "<?php echo base_url()?>admin/change_password_action",
		
						   data: $(".form-changepassword").serialize(), 
		
						   cache: false,
		
						   
		
						   success: function(data) {
							   if(data == 'password_mismatch')
							   {
								   alert('New Password and confirm new password Mismath');
							   }
							   else
							   {
								 jQuery('.form-changepassword').hide();
								 jQuery('.login-form').show();
							   }
						   },
		
						   error: function() {
								alert('Something went wrong');
						   }
		
					});
				})

	        $('.forget-form input').keypress(function (e) {

	            if (e.which == 13) {

	                if ($('.forget-form').validate().form()) {

	                    $('.forget-form').submit();

	                }

	                return false;

	            }

	        });



	        jQuery('#forget-password').click(function () {

	            jQuery('.login-form').hide();

	            jQuery('.forget-form').show();

	        });



	        jQuery('#back-btn').click(function () {

	            jQuery('.login-form').show();

	            jQuery('.forget-form').hide();

	        });



	}
	
	
	//Add user
	$( "#add-user-validate").validate({
		  rules: {
			
			user_id: {

				required: true

			},
			name: {

				required: true

			},

			email: {

				required: true

			},

			phone: {

				required: true

			},
			 password: {

				required: true

			},

		},



	            messages: {
                   user_id: {

	                    required: "User ID is required."

	                  },
					

					 name: {

	                    required: "Name is required."

	                },
					
	                email: {

	                    required: "Email is required."

	                },
					
					phone: {

	                    required: "Phone is required."

	                },
					password: {

	                    required: "Password is required."

	                },

	               

	            },


				debug: true,
		
				errorElement : 'div',
		
				errorLabelContainer: '#show_errors_add_user',
		
				errorPlacement: function(error, element) {
					error.appendTo("div#show_errors_add_user");
				}, 
		
        	invalidHandler: function (event, validator) {

            var errors = validator.numberOfInvalids();

            if (errors) {

                //var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';

                var message = errors;

                if(message != '' && message > 0){

                    $('#show_errors_add_user').show();

                } 
            }

        },

        submitHandler: function(form) {
		  $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/add_user",

                   data: $("#add-user-validate").serialize(), 

                   cache: false,

                  success: function(data) {
					  if(data == 'failed')
					  {
						 alert('Email already exist.');
					  }
					  else
					  {
//alert(data);
                      	 prompt("User Password is, Copy to clipboard: Ctrl+C, Enter", data);
							 // alert('User Password is '+data);
							  location.reload();
					  }
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
        }
    });
	

	//Edit User
	$( ".btnEditUser").on( "click", function() {
		openEditBox2($(this).attr("id"));
	});
	
	function openEditBox2(id) {
		edit_window = $(".edit-user-form").bPopup();

		var user_id = $("#userdataholder_" + id + " .useriddata").html();
		var name = $("#userdataholder_" + id + " .usernamedata").html();
		var email = $("#userdataholder_" + id + " .useremaildata").html();
		var phone = $("#userdataholder_" + id + " .userphonedata").html();
		var role = $("#userdataholder_" + id + " .userroleid").val();
		
		
		var outlets_ids = $("#userdataholder_" + id + " .outlets_ids").val();
		var valArr =  outlets_ids.split(","); 
		i = 0, size = valArr.length;
		for(i; i < size; i++){
		  $("#outlets").multiselect("widget").find(":checkbox[value='"+valArr[i]+"']").attr("checked","checked");
		  $("#outlets option[value='" + valArr[i] + "']").attr("selected", 1);
		  $("#outlets").multiselect("refresh");
		}
		
		$("#edituser_id").val(user_id); 
		$("#hiddenuserid").val(id); 
		$("#editusername").val(name); 
		$("#edituseremail").val(email); 
		$("#edituserphone").val(phone);
		$("#userrool").val(role); 
	}
	
	
	
	
	//Edit User
	$( ".regenerateUserPassword").on( "click", function() {
		openregenerateUserPassword($(this).attr("id"));
	});
	
	function openregenerateUserPassword(id) {
		edit_window = $(".edit-generate-password-form").bPopup();
		$("#hiddenuseridgp").val(id); 
	}
	
	//Add password
	$( "#generate-password-validate").validate({
				  rules: {
					
					edituser_id: {

	                    required: true

	                },
					
					editname: {

	                    required: true

	                },

	                editemail: {

	                    required: true

	                },

	                editphone: {

	                    required: true

	                },

	            },



	            messages: {


					 edituser_id: {

	                    required: "User ID is required."

	                },
					
					 editname: {

	                    required: "Name is required."

	                },
					
	                editemail: {

	                    required: "Email is required."

	                },
					
					editphone: {

	                    required: "Phone is required."

	                },

	               

	            },


				debug: true,
		
				errorElement : 'div',
		
				errorLabelContainer: '#show_errors_edit_user',
		
				errorPlacement: function(error, element) {
					error.appendTo("div#show_errors_edit_user");
				}, 
		
        	invalidHandler: function (event, validator) {

            var errors = validator.numberOfInvalids();

            if (errors) {

                //var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';

                var message = errors;

                if(message != '' && message > 0){

                    $('#show_errors_edit_user').show();

                } 
            }

        },

        submitHandler: function(form) {
		  $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/update_user_password",

                   data: $("#generate-password-validate").serialize(), 

                   cache: false,

                  success: function(data) {

                      window.location.reload();
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
        }
    });
	
	
	//Validate Edit User
	//Add user
	$( "#edit-user-validate").validate({
				  rules: {
					
					mypassword: {

	                    required: true

	                }
	            },



	            messages: {


					 mypassword: {

	                    required: "User password is required."

	                },
	            },


				debug: true,
		
				errorElement : 'div',
		
				errorLabelContainer: '#show_errors_edit_user',
		
				errorPlacement: function(error, element) {
					error.appendTo("div#show_errors_edit_user");
				}, 
		
        	invalidHandler: function (event, validator) {

            var errors = validator.numberOfInvalids();

            if (errors) {

                //var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';

                var message = errors;

                if(message != '' && message > 0){

                    $('#show_errors_edit_user').show();

                } 
            }

        },

        submitHandler: function(form) {
		  $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/edit_user",

                   data: $("#edit-user-validate").serialize(), 

                   cache: false,

                  success: function(data) {

                      window.location.reload();
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
        }
    });
	
	
	//Delete
	function callCrudAction(action,id) {
		
		queryString = 'action='+action+'&ID='+ id;
		
		jQuery.ajax({
		url: "<?php echo base_url()?>admin/del_user",
		data:queryString,
		type: "POST",
		success:function(data){
			window.location.reload();
		},
	
		error:function (){
		}
	});
	}
	
	$( ".add-outlet").on( "click", function() {
		edit_window = $(".add-user-form").bPopup();
	});
	$( ".add-user-btn").on( "click", function() {
		edit_window = $(".add-user-form").bPopup();
	});
	
		
	//Add Outlet
	$( "#add-outlet-validate").validate({
				  rules: {
					name: {
	                    required: true
	                },
					code: {
	                    required: true
	                },
					phone: {
	                    required: true
	                },
					address: {
	                    required: true
	                },
					contact_person: {
	                    required: true
	                },
	            },
	            messages: {
					 name: {
	                    required: "Name is required."
	                },
					 code: {
	                    required: "Name is required."
	                },
					 phone: {
	                    required: "Name is required."
	                },
					 address: {
	                    required: "Name is required."
	                },
					 contact_person: {
	                    required: "Name is required."
	                },
	            },
				debug: true,
		
				errorElement : 'div',
		
				errorLabelContainer: '#show_errors_add_user',
		
				errorPlacement: function(error, element) {
					error.appendTo("div#show_errors_add_user");
				}, 
		
        	invalidHandler: function (event, validator) {

            var errors = validator.numberOfInvalids();

            if (errors) {

                //var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';

                var message = errors;

                if(message != '' && message > 0){

                    $('#show_errors_add_user').show();

                } 
            }

        },

        submitHandler: function(form) {
		  $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/add_outlet",

                   data: $("#add-outlet-validate").serialize(), 

                   cache: false,

                  success: function(data) {
//alert(data);
                      window.location.reload();
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
        }
    });
	
	
	
	$( ".add_new_lead").on( "click", function() {
		edit_window = $(".add-new-lead-form").bPopup();
	});
	//Add Lead
	$( "#add-new-lead-form-validate").validate({
				  rules: {
					name: {
	                    required: true
	                },
					email: {
	                    required: true
	                },
					phone: {
	                    required: true
	                },
					outlet: {
	                    required: true
	                }
	            },
	            messages: {
					 name: {
	                    required: "Name is required."
	                },
					 email: {
	                    required: "Email is required."
	                },
					 phone: {
	                    required: "Phone is required."
	                },
					 outlet: {
	                    required: "Outlet is required."
	                }
	            },
				debug: true,
				errorElement : 'div',
				errorLabelContainer: '#show_errors_add_user',
				errorPlacement: function(error, element) {
					error.appendTo("div#show_errors_add_user");
				}, 
		
        	invalidHandler: function (event, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = errors;
                if(message != '' && message > 0){
                    $('#show_errors_add_user').show();
                } 
            }
        },

        submitHandler: function(form) {
		  $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/add_lead",

                   data: $("#add-new-lead-form-validate").serialize(), 

                   cache: false,

                  success: function(data) {
//alert(data);
                      window.location.reload();
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
        }
    });
	
	//Validate Edit Outlet
	//Edit User
	$( ".btnEditOutlet").on( "click", function() {
		openEditBox($(this).attr("id"));
	});
	
	function openEditBox(id) {
		edit_window = $(".edit-outlet-form").bPopup();

		var name = $("#userdataholder_" + id + " .usernamedata").html();
		var code = $("#userdataholder_" + id + " .usercodedata").html();
		var password = $("#userdataholder_" + id + " .userpassworddata").html();
		var phone = $("#userdataholder_" + id + " .userphonedata").html();
		var address = $("#userdataholder_" + id + " .useraddressdata").html();
		var person = $("#userdataholder_" + id + " .userpersondata").html();
		var google_map_link = $("#userdataholder_" + id + " .google_map_link").val();
		var waze_link = $("#userdataholder_" + id + " .waze_link").val();
		$("#hiddenuserid").val(id); 
		$("#editusername").val(name); 
		$("#edituseremail").val(code);
		$("#editpassword").val(password); 
		$("#edituserphone").val(phone); 
		$("#edituseraddress").val(address); 
		$("#edituserperson").val(person); 
		$("#google_map_link").val(google_map_link); 
		$("#waze_link").val(waze_link); 
	}
	//Add Outlet
	$( "#edit-outlet-validate").validate({
				  rules: {
					
					
					editname: {

	                    required: true

	                },
					editpassword: {

	                    required: true

	                }

	                
	            },



	            messages: {


					 editname: {

	                    required: "Name is required."

	                },
					 editpassword: {

	                    required: "Password is required."

	                },
					
	               
	               

	            },


				debug: true,
		
				errorElement : 'div',
		
				errorLabelContainer: '#show_errors_edit_user',
		
				errorPlacement: function(error, element) {
					error.appendTo("div#show_errors_edit_user");
				}, 
		
        	invalidHandler: function (event, validator) {

            var errors = validator.numberOfInvalids();

            if (errors) {

                //var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';

                var message = errors;

                if(message != '' && message > 0){

                    $('#show_errors_edit_user').show();

                } 
            }

        },

        submitHandler: function(form) {
		  $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/edit_outlet",

                   data: $("#edit-outlet-validate").serialize(), 

                   cache: false,

                  success: function(data) {
//alert(data);
                      window.location.reload();
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
        }
    });
		//Delete
	function callCrudAction(action,id,controller) {
		if (confirm('Are you sure?')) {
			queryString = 'action='+action+'&ID='+ id;
			
			jQuery.ajax({
			url: "<?php echo base_url()?>admin/"+controller,
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
	function delete_user_assign(action,id,controller) {
		edit_window = $(".delete_user_assign").bPopup();
		$('#newuseraction').val(action);
		$('#olduserid').val(id);
		$('#newcontroller').val(controller);
	}
	
	//Add Outlet
	$( "#delete_user_assign_validate").validate({
				  rules: {
					newuser: {
	                    required: true
	                },
	            },
	            messages: {
					 editname: {
	                    required: "Name is required."
	                },
	            },
				debug: true,
				errorElement : 'div',
				errorLabelContainer: '#user_assign_delte',
				errorPlacement: function(error, element) {
					error.appendTo("div#user_assign_delte");
				}, 
        	invalidHandler: function (event, validator) {

            var errors = validator.numberOfInvalids();

            if (errors) {

                //var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';

                var message = errors;

                if(message != '' && message > 0){

                    $('#user_assign_delte').show();

                } 
            }

        },

        submitHandler: function(form) {
		  $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/del_user",

                   data: $("#delete_user_assign_validate").serialize(), 

                   cache: false,

                  success: function(data) {
//alert(data);
                      window.location.reload();
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
        }
    });
	
	
	/**********************************************************************/
	//Add Lead
	$( "#add-lead-validate").validate({
		  rules: {
			name: {
				required: true
			},

			email: {
				required: true
			},

			phone: {
				required: true
			},
			 sc: {
				required: true
			},
			
			 outlet: {
				required: true
			},
			sp: {
				required: true
			}

		},

		messages: {
			 name: {
				required: "Name is required."
			},
			
			email: {
				required: "Email is required."
			},
			
			phone: {
				required: "Phone is required."
			},
			 sc: {
				required: "Source Code is required"
			},
			
			 outlet: {
				required: "Outlet is required"
			},
			sp: {
				required: "Sales Person is required"
			}
		},


		debug: true,

		errorElement : 'div',

		errorLabelContainer: '#show_errors_add_lead',

		errorPlacement: function(error, element) {
			error.appendTo("div#show_errors_add_lead");
		}, 
		
		invalidHandler: function (event, validator) {

		var errors = validator.numberOfInvalids();

		if (errors) {

			//var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';

			var message = errors;

			if(message != '' && message > 0){

				$('#show_errors_add_lead').show();

			} 
		}

        },

        submitHandler: function(form) {
		  $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/add_lead",

                   data: $("#add-lead-validate").serialize(), 

                   cache: false,

                  success: function(data) {
//alert(data);
                      window.location.reload();
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
        }
    });
	
	
	//Edit Lead
	//Edit User
	$( ".btnEditLead").on( "click", function() {
		openEditBoxLead($(this).attr("id"));
	});
	
	function openEditBoxLead(id) {
		edit_window = $(".edit-lead-form").bPopup();

		var name    = $("#leaddataholder_" + id + " .leadnamedata").html();
		var email   = $("#leaddataholder_" + id + " .leademaildata").html();
		var phone   = $("#leaddataholder_" + id + " .leadphonedata").html();
		var sc      = $("#leaddataholder_" + id + " .leadscdata").html();
		var outlet  = $("#leaddataholder_" + id + " .leadoutdata").html();
		var sp  	= $("#leaddataholder_" + id + " .leadspdata").html();
		var ls      = $("#leaddataholder_" + id + " .leadstatusdata").html();
		
		$("#id").val(id); 
		$("#name").val(name); 
		$("#email").val(email); 
		$("#phone").val(phone); 
		$("#sc").val(sc); 
		$("#outlet").val(outlet);
		$("#sp").val(sp);
		$("#ls").val(ls); 
	}
	//Add Outlet
	$( "#edit-lead-validate").validate({
		rules: {
			name: {
				required: true
			},

			email: {
				required: true
			},

			phone: {
				required: true
			},
			 sc: {
				required: true
			},
			
			 outlet: {
				required: true
			},
			sp: {
				required: true
			}

		},

		messages: {
			 name: {
				required: "Name is required."
			},
			
			email: {
				required: "Email is required."
			},
			
			phone: {
				required: "Phone is required."
			},
			 sc: {
				required: "Source Code is required"
			},
			
			 outlet: {
				required: "Outlet is required"
			},
			sp: {
				required: "Sales Person is required"
			}
		},


				debug: true,
		
				errorElement : 'div',
		
				errorLabelContainer: '#show_errors_edit_lead',
		
				errorPlacement: function(error, element) {
					error.appendTo("div#show_errors_edit_lead");
				}, 
		
        	invalidHandler: function (event, validator) {

            var errors = validator.numberOfInvalids();

            if (errors) {

                //var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';

                var message = errors;

                if(message != '' && message > 0){

                    $('#show_errors_edit_lead').show();

                } 
            }

        },

        submitHandler: function(form) {
		  $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/edit_lead",

                   data: $("#edit-lead-validate").serialize(), 

                   cache: false,

                  success: function(data) {
//alert(data);
                      window.location.reload();
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
        }
    });
	/**********************************************************************/
	
	
	//Status Script
	
	$( ".btnEditStatus").on( "click", function() {
		var id = $(this).attr("id");
		openEditBoxStatus2(id);
	});
	
	function openEditBoxStatus2(id) {
		//alert('ok');
		edit_window = $(".edit-status-form").bPopup();

		var status = $("#statusholder_" + id + " .statusdata").html();
		var dashboard = $("#statusholder_" + id + " .dashboarddata").html();
		//alert(dashboard);
		$("#hiddenstatusid").val(id); 
		$("#editstatus").val(status);
		if(dashboard == "No")
		$("#editdashboard").val('No');
		else
		$("#editdashboard").val('Yes');
		//$('#editdashboard').prop('checked', true);
		//$("#editdashboard").selected(true);
		//$("#editdashboard").val(dashboard); 
	}
	//Add Outlet
	$( "#edit-status-validate").validate({
				  rules: {
					
					
					editname: {

	                    required: true

	                },

	                
	            },



	            messages: {


					 editname: {

	                    required: "Name is required."

	                },
					
	               
	               

	            },


				debug: true,
		
				errorElement : 'div',
		
				errorLabelContainer: '#show_errors_edit_user',
		
				errorPlacement: function(error, element) {
					error.appendTo("div#show_errors_edit_user");
				}, 
		
        	invalidHandler: function (event, validator) {

            var errors = validator.numberOfInvalids();

            if (errors) {

                //var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';

                var message = errors;

                if(message != '' && message > 0){

                    $('#show_errors_edit_user').show();

                } 
            }

        },

        submitHandler: function(form) {
		  $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/edit_status",

                   data: $("#edit-status-validate").serialize(), 

                   cache: false,

                  success: function(data) {
//alert(data);
                    window.location.reload();
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
        }
    });
	

	
	/**********************************************************************/
	//Add Status
	$( "#add-status-validate").validate({
		  rules: {
			status: {
				required: true
			},

				

		},

		messages: {
			status: {
				required: "Status is required."
			}
		},


		debug: true,

		errorElement : 'div',

		errorLabelContainer: '#show_errors_add_status',

		errorPlacement: function(error, element) {
			error.appendTo("div#show_errors_add_status");
		}, 
		
		invalidHandler: function (event, validator) {

		var errors = validator.numberOfInvalids();

		if (errors) {

			//var message = (errors == 1) ? '1 invalid field.' : errors + ' invalid fields.';

			var message = errors;

			if(message != '' && message > 0){

				$('#show_errors_add_status').show();

			} 
		}

        },

        submitHandler: function(form) {
		  $.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>admin/add_status",

                   data: $("#add-status-validate").serialize(), 

                   cache: false,

                  success: function(data) {
                      window.location.reload();
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
        }
    });
	
	
	
	
	
	
<?php	
//for avaoiding error in login
if($this->uri->segment(2)=='dashboard' || $this->uri->segment(2)=='calling' || $this->uri->segment(2)=='reports' || $this->uri->segment(2)=='logs'){
	if($this->uri->segment(2)=='dashboard' || $this->uri->segment(2)=='calling' ){ // on date select submit form on in dashboard.?>
	function submithiddenform()
	{
		//setTimeout(function(){ $( "#datrangeformhidden" ).submit(); }, 500);
	}
	<?php }?>
	
function show_email_popup()
{
	$('#email_input_modal').modal('show');
	$('.email_sent').html('');
}
function send_email_popup()
{
	$('.email_sent').html('Please Wait...');
	$.ajax({

                   type: "POST",

                   url: "<?php echo base_url();?>admin/reportsAsemail",

                   data: $(".send_email").serialize(), 

                   cache: false,

                  success: function(data) {
//alert(data);
                      $('.email_sent').html(data);
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
}
function changefromvalue(datvalue)
{
	$('.fromdatepickerhidden').val(datvalue);
}
function changetovalue(datvalue)
{
	$('.todatepickerhidden').val(datvalue);
}
function reloadlocation()
{
	<?php if($this->uri->segment(2)=='dashboard' || $this->uri->segment(2)=='calling'){?>
	$( "#daterangehidden" ).val('<?php echo date('Y-m-d').','.date('Y-m-d')?>');
	setTimeout(function(){ $( "#datrangeformhidden" ).submit(); }, 500);
	<?php }else{?>
	window.location.href = window.location.href;
	<?php }?>
}
	$(function() {
    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		$('#daterangehidden').val(start.format('YYYY-MM-DD') + ',' + end.format('YYYY-MM-DD'));
		<?php if($this->uri->segment(2)=='reports'){ // email and CSV require daterange.?>
		$('#daterangehidden_csv').val(start.format('YYYY-MM-DD') + ',' + end.format('YYYY-MM-DD'));
		$('#daterangehidden_email').val(start.format('YYYY-MM-DD') + ',' + end.format('YYYY-MM-DD'));
		<?php }?>
		//$( "#datrangeformhidden" ).submit();
    }
	  <?php if(isset($_GET['daterange']) || isset($_POST['daterange']))
			{
				if(isset($_GET['daterange']))
				{
					$start_end  = explode(',',$_GET['daterange']);
				}
				else
				{
					$start_end  = explode(',',$_POST['daterange']);
				}
				$start 		= strtotime($start_end[0]);
				$end 		= strtotime($start_end[1]);
				
				$now = time();
				$start_datediff = $now - $start;
				$start_days_gap = floor($start_datediff/(60*60*24));
				
				$end_datediff = $now - $end;
				$end_days_gap = floor($end_datediff/(60*60*24));
					if($start_days_gap==0)
					{
						?>
						cb(moment(), moment());
						<?php
					}
					else
					{
						?> 
						cb(moment().subtract(<?php echo $start_days_gap-1?>, 'days'), moment().subtract(<?php echo $end_days_gap-1?>, 'days'));
						<?php 
					}
		  }
		  else 
		  {
			   if($this->uri->segment(2)=='dashboard' || $this->uri->segment(2)=='reports' || $this->uri->segment(2)=='calling'  || $this->uri->segment(2)=='logs')
			   {
					$from = strtotime(date('Y-m-01'));
					$today = time();
					$difference = $today - $from;
					$days =  floor($difference / (60 * 60 * 24));
					//echo $days.'sana';exit;
					?>
					cb( moment().subtract(<?php echo $days-1;?>, 'days'), moment());
				<?php 
				}
				else
				{?>
					cb( moment(), moment());
		  <?php }  
		  }?>
	<?php /*?>
	 <?php if(isset($_GET['daterange']) && $_GET['daterange']==date('Y-m-d',strtotime("-1 days")).','.date('Y-m-d',strtotime("-1 days"))){?> 
	cb(moment().subtract(1, 'days'), moment().subtract(1, 'days'));
	<?php }?>
	
	 <?php if(isset($_GET['daterange']) && $_GET['daterange']==date('Y-m-d',strtotime("-7 days")).','.date('Y-m-d')){?> 
	cb(moment().subtract(7, 'days'), moment());
	<?php }?>
	
	 <?php if(isset($_GET['daterange']) && $_GET['daterange']==date('Y-m-d',strtotime("-365 days")).','.date('Y-m-d')){?> 
    cb(moment().subtract(365, 'days'), moment());
	<?php }?><?php */?>

    $('#reportrange').daterangepicker({
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 1 Year': [moment().subtract(365, 'days'), moment()]
        }
    }, cb);

});
<?php }?>
function isNumberKey(evt,myclass)
	{
		
    var keylenght = $('.'+myclass).val().length;
	if(keylenght==0)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode != 43 )
		{
			$('.error3').css('display','inline');
			return false;
		}
		else
		{
			$('.error3').css('display','none');
			return true;
		}
	}
	else
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		{
			$('.error3').css('display','inline');
			return false;
		}
		else
		{
			$('.error3').css('display','none');
			return true;
		}
	  }
	}
	<?php if($this->session->userdata('user_id')!=""){?>
		
	$(function () {
	  $(".datetimepicker").datetimepicker({
			  sideBySide: true,
			  widgetPositioning: {
				  horizontal: "right",
				  vertical: "top"
			  }
		  });
	});

	$(".datepicker").datepicker({
		format:'yyyy-mm-dd'
	});
	
	function chekallcheckboxes() {
		console.log('success');
	  // $(".myleads").prop("checked", this.checked);
	  
       $('.myleads').parent().toggleClass("checked");
	   var nn = $('.myleads').attr('checked')
	   if(nn)
	   {
		   $('.myCheckbox').attr('checked', false);
	   }
	   else
	   {
		    $('.myleads').attr('checked', true);
	   }
		//
	}
	
	<?php }?>	
function update_my_lead()
	{
		$('.submit_btn').html('Please Wait...');
		$.ajax({

			   type: "POST",

			   url: "<?php echo base_url();?>admin/enter_remarks_action",

			   data: $("#enter_remarks_form").serialize(), 

			   cache: false,

			  success: function(data) {
			      $( ".bClose2" ).trigger( "click" );
				},
			   		error: function() {
					alert('Something went wrong');
			   }
			 });
	}  
 $(document).ready( function(){
   var expried_appointment_hidden_coount = $('.expried_appointment_hidden_coount').val();
   $('.exprired_appointment_spaan').html(expried_appointment_hidden_coount);
   //
   var upcomming_appointment_hidden_coount = $('.upcomming_appointment_hidden_coount').val();
   $('.upcomming_appointment_spaan').html(upcomming_appointment_hidden_coount);
});
</script>