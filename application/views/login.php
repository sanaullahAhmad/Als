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
<link href="<?php echo base_url()?>assets/front/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/front/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="<?php echo base_url()?>assets/front/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="<?php echo base_url()?>assets/front/global/css/plugins.min.css" rel="stylesheet" type="text/css" />

<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url()?>assets/front/pages/css/login-2.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/front/layouts/layout3/css/alpha-search.css" rel="stylesheet" type="text/css" media="all" />

<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<!-- END THEME LAYOUT STYLES -->
<link rel="shortcut icon" href="<?php echo base_url()?>assets/front/layouts/layout3/img/alia_favicon.ico" />
</head>
<!-- END HEAD -->

<body class=" login">
<div class="alpha-top-bar">
  <div class="logo"> <a href="<?php echo base_url();?>"> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/new-logo.png" /> </a> </div>
  <div class="welcome"> Welcome Home </div>
</div>
<!-- BEGIN LOGIN -->
<div class="content"> 
  <!-- BEGIN LOGO --> 
  <!--<div class="logo">
            <a href="javascript: void(0)">
                    <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/logo-form.png" alt="" /> </a>
            </div>--> 
  <!-- END LOGO --> 
  <!-- BEGIN LOGIN FORM -->
  <?php if ($this->session->flashdata('message')) { ?>
  <div class="alert alert-info" style="background:#008C44; color:#fff;">
    <?= $this->session->flashdata('message') ?>
  </div>
  <?php } ?>
  <div class="alert alert-info fornotactive" style="background:#008C44; color:#fff; display:none"> Your account is not approved. </div>
  <div class="alert alert-info unitblocked" style="background:#008C44; color:#fff; display:none"> Your Unit is blocked. </div>
  <div class="alert alert-info forincorrectunpass" style="background:#008C44;color:#fff; display:none"> Incorrect Email or Password. </div>
  <form id="login-form" method="post" class="login-form">
    <div class="form-title"> <span class="form-title">
      <?php if($this->session->userdata('link_condo_id')!=""){
			echo $this->General_model->get_value_by_id('condos', $this->session->userdata('link_condo_id'), "name");
		} ?>
      </span> 
      <!--                    <span class="form-subtitle">Please login.</span>
--> </div>
    <div class="alert alert-danger display-hide">
      <button class="close" data-close="alert"></button>
      <span> Enter any username and password. </span> </div>
    <div class="form-group"> 
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label visible-ie8 visible-ie9">Username</label>
      <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" />
      <span class="error_individual" id="email_validate"></div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Password</label>
      <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" />
      <span class="error_individual" id="password_validate"></span></div>
    <div class="form-actions">
      <button type="submit" class="btn red btn-block uppercase" id="logsubbutton">Login</button>
    </div>
    <div class="form-actions">
      <div class="pull-left forget-password-block"> <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a> </div>
      <div class="create-account pull-right">
        <p> <a href="javascript:;" class="btn-primary btn" id="register-btn">Create an account</a> </p>
      </div>
    </div>
    <div class="form-actions">
      <p> By logging into ALIA , you agree to our <a href="<?php echo base_url()?>terms_of_use">Terms & Conditions</a> and have read our <a href="<?php echo base_url()?>privacy_policy">Privacy Policy</a>. </p>
    </div>
  </form>
  <!-- END LOGIN FORM --> 
  <!-- BEGIN FORGOT PASSWORD FORM -->
  <form class="forget-form"  method="post" id="forgot-pass-form">
    <div class="form-title"> <span class="form-title">Forgot Password ?</span> <span class="form-subtitle">Enter your e-mail to reset it.</span> </div>
    <div class="form-group">
      <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email_forgot" id="email_forgot" />
      <span class="error_individual" id="email_forgot_validate"></span> </div>
    <div class="form-actions">
      <button type="button" id="back-btn" class="btn btn-default">Back</button>
      <button type="submit" class="btn btn-primary uppercase pull-right">Submit</button>
    </div>
  </form>
  <div id="success-message" style="display:none;">
    <div class="alert alert-success"> Link sent to your email. Please check. </div>
    <div>
      <button type="button" id="forgetsent-back-btn" class="btn btn-default">Back</button>
    </div>
    <div class="clearfix"></div>
  </div>
  <!-- END FORGOT PASSWORD FORM --> 
  <!-- BEGIN REGISTRATION FORM -->
  <form class="register-form" action="<?php echo base_url()?>resident" method="post" id="addresident-form">
    <div class="form-title"> <span class="form-title">Sign Up |
      <?php if($this->session->userdata('link_condo_id')!=""){
			echo $this->General_model->get_value_by_id('condos', $this->session->userdata('link_condo_id'), "name");
		} ?>
      </span> </div>
    <p class="hint" style="text-align:left;"> Enter your personal details below: </p>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Name</label>
      <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="name" id="name" />
      <span class="error_individual" id="name_reg_validate"></span> </div>
    <div class="form-group"> 
      <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
      <label class="control-label visible-ie8 visible-ie9">Email</label>
      <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" id="email_reg" />
      <span class="error_individual" id="email_reg_validate"></span> </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Phone Number</label>
      <input class="form-control placeholder-no-fix" type="text" placeholder="Phone Number" name="phone" id="phone" />
      <span class="error_individual" id="phone_reg_validate"></span> </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Block</label>
      <select name="block" id="block" onChange="change_floors(this.value)" class="form-control">
        <option value=""> Block </option>
        <?php
                          if(sizeof($blocks)>0)
                          {
                              foreach($blocks as $block)
                              {
                                  ?>
        <option value="<?php echo $block['id']?>" ><?php echo $block['name']?></option>
        <?php
                              }
                          }
                          else
                          {
                              ?>
        <option value="" >No blocks available</option>
        <?php
                          }
                      ?>
      </select>
      <span class="error_individual" id="block_reg_validate"></span> </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Floor</label>
      <select name="floors" id="floors" class="form-control">
        <option value=""> Floor </option>
      </select>
      <span class="error_individual" id="floors_reg_validate"></span> </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Unit</label>
      <select name="unit" id="unit" class="form-control" onChange="check_primary_owner_exist(this.value)">
        <option value=""> Unit </option>
      </select>
      <span class="error_individual" id="unit_reg_validate"></span> </div>
    <div class="form-group">
      <label class="control-label visible-ie8 visible-ie9">Owner</label>
      <select name="type" id="type" class="form-control">
        <option value="2"> Owner </option>
        <option value="1"> Tenant </option>
      </select>
      <span class="error_individual" id="type_reg_validate"></span> </div>
    <!--<div class="form-group margin-top-20 margin-bottom-20">
                <a  data-toggle="modal" href="#responsive"> I agree to Terms & Conditions </a>
                     
                </div>-->
    <div class="form-actions">
      <p style="text-align:left;"> By logging into ALIA , you agree to our <a href="<?php echo base_url()?>terms_of_use">Terms & Conditions</a> and have read our <a href="<?php echo base_url()?>privacy_policy">Privacy Policy</a>. </p>
    </div>
    <div class="form-actions">
      <button type="button" id="register-back-btn" class="btn btn-success pull-left" style="color:#fff;">Login</button>
      <button type="submit" id="register-submit-btn" class="btn red uppercase pull-right" name="add_resident_btn">Submit</button>
    </div>
  </form>
  <!-- END REGISTRATION FORM --> 
</div>

<!-- /.modal -->

<div class="copyright hide"> 2016 © ALIA. </div>
<!-- END LOGIN --> 
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
<script src="<?php echo base_url()?>assets/front/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script> 
<script src="<?php echo base_url()?>assets/front/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script> 

<!-- END PAGE LEVEL PLUGINS --> 
<!-- BEGIN THEME GLOBAL SCRIPTS --> 
<script src="<?php echo base_url()?>assets/front/global/scripts/app.min.js" type="text/javascript"></script> 
<!-- END THEME GLOBAL SCRIPTS --> 
<!-- BEGIN PAGE LEVEL SCRIPTS --> 
<script src="<?php echo base_url()?>assets/front/pages/scripts/login.min.js" type="text/javascript"></script> 
<!-- END PAGE LEVEL SCRIPTS --> 
<!-- BEGIN THEME LAYOUT SCRIPTS --> 
<!-- END THEME LAYOUT SCRIPTS --> 
<script>
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
		function check_primary_owner_exist(unit)
		{
			//$('#type').hide();
			var condo_id = '<?php echo $this->session->userdata('link_condo_id');?>';
			var block = $('#block').val();
			var floors = $('#floors').val();
			//var type = $('#type').val();
			var postData={ 
					condo_id	: condo_id,
					block		: block,
					floors		: floors,
					unit		: unit,
					}
				$.ajax({
				type: 'POST',
				data: postData,
				dataType: "json",
				url: '<?php echo base_url();?>home/check_primary_owner_signup', 
				success: function(result){
					//$('#type').show();
					if(result==1)
						{
							var x = document.getElementById("type");
    						x.remove(2);
							var x = document.getElementById("type");
							var option = document.createElement("option");
							option.text = 'Primary Owner';
							option.value = '11';
							x.add(option);
						}
					else
						{
							var x = document.getElementById("type");
    						x.remove(2);
						}
					}
				});
		}
		
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
							  url: "<?php echo base_url()?>manager/check_data_exists/email/residents",
							  type: "post",
							  data: {
								  email: function(){ return $("#email_reg").val(); }
							  }
							}
						},
						
						phone: {
							required: true,
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
							required: true,
							  remote: {
							  url: "<?php echo base_url()?>home/check_primary_owner_exists",
							  type: "post",
							  data: {
								  block		: function(){ return $("#block").val(); },
								  floors	: function(){ return $("#floors").val(); },
								  unit		: function(){ return $("#unit").val(); },
								  type		: function(){ return $("#type").val(); },
								  condo_id	: '<?php echo $this->session->userdata('link_condo_id');?>',
							  }
							}
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
					  phone: {
							required: "Please enter Phone number",
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
							remote: "Primary owner of this unit already exists.",
						}
					},
					debug: true,
					errorPlacement: function(error, element) {
						var name = $(element).attr("name");
						error.appendTo($("#" + name + "_reg_validate"));
					}, 
	
			submitHandler: function(form) 
			{
				form.submit();
				//alert('success');
				//return false;
			}
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
        jQuery('#forgetsent-back-btn').click(function() {
			jQuery('.login-form').show();
			jQuery('#success-message').hide();
        });
		</script>
</body>
</html>