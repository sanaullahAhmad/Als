<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="author">
<title>Alpha Search</title>
<script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>
<link href="<?php echo base_url()?>assets/front/layouts/layout3/css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="<?php echo base_url()?>assets/front/layouts/layout3/css/alpha-search.css" rel="stylesheet" type="text/css" media="all" />
<link rel="shortcut icon" href="<?php echo base_url()?>assets/front/layouts/layout3/img/alia_favicon.ico" />
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
<style>
.search-footer-con {
	margin:0 auto;
	width:98%;
	overflow:hidden;
}
</style>
</head>
<body>
<!--<div class="main-wrapper">
    	<div class="header">
        	<div class="container">
            	<div class="logo">
                	 <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/front/layouts/layout3/img/logo.png" /></a>
                </div>
                <div class="menu">
                	<a id="pull"> <img src="<?php echo base_url()?>assets/front/images/burger.png" /> Menu </a>
                    <ul id="menu-desktop">                 
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
                	<ul id="menu">                            
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
                    </ul                     
                ></div>                
            </div>
            <div class="account-section">
                        <ul>
                            <li>
                                <a id="signin">                        	
                                    <span> Login </span>
                                </a>
                                <div class="drop-signin">
                                    <form id="login-form" role="form" method="POST">
                                        <div class="alert alert-primary jquery_val_error forincorrectunpass">
                                            Incorrect Email or Password.
                                        </div>
                                        
                                        <div class="alert alert-primary jquery_val_error fornotactive">
                                            Account not approved.
                                        </div>
                                        <input  id="email" name="email" type="text" placeholder="Email" />
                                        <span id="email_validate" class="error_individual "></span>
                                        <input  id="password" name="password" type="password" placeholder="Password" />
                                        <span id="password_validate" class="error_individual "></span>
                                        <label id="forgot-pass-click">
                                        Forgot&nbsp;Password?
                                        </label>                                
                                        <button name="login"  id="logsubbutton" type="submit" >Login</button>
                                        
                                    </form>
                                </div>
                                <div class="drop-forgotpassword">  
                                    <form id="forgot-pass-form" role="form" method="POST" style="display:none;">
                                      <input type="text"  id="email_forgot" name="email_forgot" placeholder="Email">
                                      <span id="email_forgot_validate" class="error_individual"></span>
                                         <button type="submit" id="forgotpasssubbutton" >Send Link</button>
                                     </form>
                                    <div id="success-message" style="display:none;">
                                      <div class="alert alert-success">
                                          Link sent to your email. Please check.
                                       </div>
                                    </div>
                                      <button   id="forgot-pass-back" type="button" >Back</button>
                                </div>
                                  
                            </li>
                        </ul>
                    </div>
        </div>
        </div>-->
<div class="contact-section search-fix">
  <div class="alpha-top-bar">
    <div class="logo"><a href="<?php echo base_url()?>"> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/new-logo.png" /></a></div>
    <a href="<?php echo base_url()?>#contact" id="contact-us"> Contact </a> </div>
  <div class="search-con">
    <div class="search-condo">
      <div class="search-box">
        <form method="POST" action="<?php echo base_url('search');?>">
          <input name="keyword" id="search-box-input-second" type="text" placeholder="Search your residence..." value="<?php echo $this->input->post('keyword');?>">
          <button type="submit" name="index_btn"> Search </button>
        </form>
        <div id="suggesstion-box-second"></div>
      </div>
    </div>
  </div>
  <div class="body-content">
    <div class="container">
      <h2> <?php echo sizeof($search_results);?> Result
        <?php if(sizeof($search_results) > 1) echo 's';?>
        Found </h2>
      <div class="search-results">
        <?php
					$count = 1;
					foreach($search_results as $search){
						if ($count % 3 == 0){
							 $class = "search-results-section margin-right-setter";
						} else {
							$class = "search-results-section";
						}
					?>
        <div class="<?php echo $class;?>" onclick="add_resident('<?php echo $search["id"];?>')"> <img src="<?php echo base_url()?>uploads/condos/condo_pictures/<?php echo $search['condo_picture'];?>" />
          <div class="search-results-detail">
            <div class="results-detail"> <span> <?php echo $search['name'];?> </span>
              <p> <?php echo $this->General_model->get_value_by_id('areas',$search['areas'],'name')?> </p>
              <span> <?php echo $this->General_model->get_value_by_id('states',$search['state'],'name')?> </span> </div>
            <a href="javascript:;" onclick="add_resident('<?php echo $search["id"];?>')"> I Live Here </a> </div>
        </div>
        <?php
					$count++;
					}
					?>
      </div>
    </div>
  </div>
  <div class="know-us">
    <div class="container">
      <h2> Your Residence Not Listed Here? </h2>
      <a class="fancy-arrow signup-new" href="<?php echo base_url()?>#contact"> LET US KNOW </a> </div>
  </div>
  <div class="apha-search-footer">
    <div class="search-footer-con">
      <ul>
        <li> &copy; 2016 ALIA - All Rights Reserved. </li>
      </ul>
      <ul>
        <li> <a href="<?php echo base_url()?>about_us"> About </a> </li>
        <li> <a href="<?php echo base_url()?>privacy_policy"> Privacy </a> </li>
        <li> <a href="<?php echo base_url()?>terms_of_use"> Terms </a> </li>
      </ul>
    </div>
  </div>
</div>
<?php $this->load->view('template/jqueryvalidatemin');?>
<?php $this->load->view('template/js_functions');?>
</body>
</html>
