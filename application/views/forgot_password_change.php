<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="author">
<title>Alpha Resident Registratin</title>
<script src="<?php echo base_url()?>assets/admin/css/components/plugins/jquery.latest.js"></script>
<link href="<?php echo base_url()?>assets/front/css/style.css" rel="stylesheet" type="text/css" media="all" />

<script type="text/javascript">

	$( document ).ready(function() {
		
		$( "#signup" ).click(function() {                /*signup layout and popup js*/
			
		  $( "#signup" ).addClass("signup");	
		  $( ".drop-signup" ).toggle();
		  $( "#signin" ).removeClass("signin");
		  var box1 = $('.drop-signup');	
		  if (box1.is(':hidden')) 
		  {
			  $( "#signup" ).removeClass("signup");
		  }
		  $( ".drop-signin" ).hide();
		  $( "#menu" ).hide();
		  
		});
		
		$( "#signin" ).click(function() {             /*signin layout and popup js*/
			
		  $( "#signin" ).addClass("signin");	
		  $( ".drop-signin" ).toggle();
		  $( "#signup" ).removeClass("signup");
		  var box2 = $('.drop-signin');	
		  if (box2.is(':hidden')) 
		  {
			  $( "#signin" ).removeClass("signin");
		  }
		  $( ".drop-signup" ).hide();
		  $( "#menu" ).hide();
		  
		});
		
		$( "#pull" ).click(function() {              /*Responsive menu js*/
			
		  $( "#menu" ).toggle();
		  $( ".drop-signin" ).hide();
		  $( ".drop-signup" ).hide();
		  $( "#signup" ).removeClass("signup");
		  $( "#signin" ).removeClass("signin");
		  
		});
		
	});
	
</script>

</head>
<body>
<?php
?>
	<div class="main-wrapper">
    	<div class="header">
        	<div class="container">
            	<div class="logo">
                	<a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/front/images/logo.png" /></a>
                   
                </div>
                <div class="menu">
                	<a id="pull"> <img src="<?php echo base_url()?>assets/front/images/burger.png" /> Menu </a>
                    <ul id="menu-desktop">                 <!--For Normal resolution Like Desktop view-->
                    	<li>
                        	<a href="#" class="activ">
                            	About Alpha 
                            </a>
                        </li>
                        <li>
                        	<a href="#">
                            	How It Works? 
                            </a>
                        </li>
                        <li>
                        	<a href="#">
                            	Careers 
                            </a>
                        </li>
                        <li>
                        	<a href="#">
                            	Blog
                            </a>
                        </li>
                        <li>
                        	<a href="#">
                            	Contact Us
                            </a>
                        </li>
                    </ul>
                	<ul id="menu">                            <!--For mobile resolutions-->
                    	<li>
                        	<a href="#" class="activ">
                            	About Alpha 
                            </a>
                        </li>
                        <li>
                        	<a href="#">
                            	How It Works? 
                            </a>
                        </li>
                        <li>
                        	<a href="#">
                            	Careers 
                            </a>
                        </li>
                        <li>
                        	<a href="#">
                            	Blog
                            </a>
                        </li>
                        <li>
                        	<a href="#">
                            	Contact Us
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="banner-title">
        	<div class="container">
                <h1>
                    Forgot Password Change
                </h1>
            </div>
        </div>
        <div class="body-content">
        	<div class="container">            	
                <div class="resident-registration">
                	<div class="resident-registration-left">
              <?php if ($this->session->flashdata('message')) { ?>
                  <div class="alert alert-info" style="background:#008C44;margin:20px; color:#fff;"> 
                      <?= $this->session->flashdata('message') ?> 
                  </div>
              <?php } ?>
                   <?php
                       if($verify_data != 'USED'){
                      ?>
                      <form id="forgot-password-change" role="form" method="POST">
                          <input type="hidden" value="<?php echo $verify_data;?>" name="id">
                          <div><span id="password_validate"></span></div>
                          <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
                          <div><span id="repassword_validate"></span></div>
                          <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Retype Password">
                          <input type="submit" name="forgotpasssubbutton" value="Change Password" style="width:180px;">
                      </form>
                   <?php
                       } 
					   else 
					   {
                           ?>
                            <h1 class="separator bottom center">Link Expired.</h1>
                              <p class="margin-none innerT center">
                                  <a href="<?php echo base_url()?>search" class="btn btn-warning">
                                      Try Forgot Password Option again.
                                  </a>
                              </p>  
                           <?php
                           
                       }
                   ?>
                    </div>
                    <div class="resident-registration-right">
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-top">
        	<div class="container">
            	<div class="footer-top-left">
                	<h2>
                    	Your Condo Not Listed ??
                    </h2>
                    <p>
                    	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's <br /> standard dummy text ever since
                        the 1500s.
                    </p>
                </div>
                <a href="#">
                	Let Us Know
                </a>
            </div>
        </div>
        <div class="apha-search-footer">
        	<div class="container">
            	<ul>
                	<li>
                    	&copy; 2016 - ALIA - All Rights Reserved 
                    </li>
                </ul>
                <ul>
                	<li>
                    	<a href="#">
                        	About us
                        </a>
                    </li>
                    <li>
                    	<a href="#">
                        	Partners 
                        </a>
                    </li>
                    <li>
                    	<a href="#">
                        	Investors
                        </a>
                    </li>
                    <li>
                    	<a href="#">
                        	Contact us
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
<?php $this->load->view('template/jqueryvalidatemin');?>
<?php $this->load->view('template/js_functions');?>