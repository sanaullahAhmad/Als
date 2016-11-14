<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php echo $title;?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url()?>assets/front/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url()?>assets/front/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url()?>assets/front/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="<?php echo base_url()?>assets/front/layouts/layout3/img/alia_favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class=" login">
        <!-- BEGIN LOGO -->
                <!-- END LOGO -->
        <!-- BEGIN LOGIN -->
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <div class="logo">
            <a href="<?php echo base_url()?>">
                <img src="<?php echo base_url()?>assets/admin/images/logo/alia-logo.png" width="308" height="81" alt="" /> 
            </a>
        </div>
            <form class="login-form" id="login-form" action="" method="post">
            	<div id="login-holder">
                   <div class="alert alert-danger display-hide forincorrectunpass">
					<button class="close" data-close="alert"></button>
                    Incorrect Email or Password.
                </div>
                                
                <div class="alert alert-warning display-hide fornotactive">
                    <button class="close" data-close="alert"></button>                    
                    Your account is not active. Please activate your account.
                </div>
              
                <div class="form-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="text"  placeholder="Email" name="email" /> 
                    <span id="email_validate" class="error_individual"></span>
                </div>
                
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" type="password" 
                    autocomplete="off" placeholder="Password" name="password" />
                    <span id="password_validate" class="error_individual"></span>
                </div>
                
                <div class="form-actions">
                    <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                    <button type="submit" id="logsubbutton" class="btn green uppercase">Login</button>
                </div>
                
                
            </form>
            <!-- END LOGIN FORM -->
            <!-- BEGIN FORGOT PASSWORD FORM -->
            <form class="forget-form" action="index.html" method="post">
                <h3 class="font-green">Forget Password ?</h3>
                <p> Enter your e-mail address below to reset your password. </p>
                <div class="form-group">
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                <div class="form-actions">
                    <button type="button" id="back-btn" class="btn btn-default">Back</button>
                    <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
                </div>
            </form>
            <!-- END FORGOT PASSWORD FORM -->
           </div>
        <div class="copyright"> 2016 © ALIA. </div>
        <!--[if lt IE 9]>
<script src="<?php echo base_url()?>assets/front/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url()?>assets/front/global/plugins/excanvas.min.js"></script> 
<![endif]-->

        <!-- BEGIN CORE PLUGINS -->
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
      
		<script src="<?php echo base_url()?>assets/front/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
       <script src="<?php echo base_url()?>assets/front/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url()?>assets/front/global/scripts/app.min.js" type="text/javascript"></script>
      
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
<!--        <script src="<?php echo base_url()?>assets/front/pages/scripts/login.min.js" type="text/javascript"></script>
-->        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
      	<script>
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

	                    required: "Please enter email."

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

                   url: "<?php echo base_url()?>alpha/check_login",

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
							window.location.href = "<?php echo base_url()?>alpha/dashboard";
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
	
	        

	//Change Password
	$("#change-password").validate({
				  rules: {
	              
					password: {
	                    required: true,
	                     remote: {
							url: "<?php echo base_url()?>alpha/check_data_exists_md5/password/admin",
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
							url: "<?php echo base_url()?>manager/check_data_exists_forgot_pass/email_forgot/admin",
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

                   url: "<?php echo base_url()?>alpha/forgot_password",

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
		</script>
    </body>

</html>