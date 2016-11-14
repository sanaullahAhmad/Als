<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="author">
<title>Resident Registratin</title>
<script src="<?php echo base_url()?>assets/admin/css/components/plugins/jquery.latest.js"></script>
<script src="<?php echo base_url()?>assets/admin/css/components/plugins/jquery.uploadify.min.js" type="text/javascript"></script>
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
$action = "id= ".$this->session->userdata('link_condo_id');
$results = $this->General_model->get_data_row_using_where('condos', $action);
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
                    Resident Registration Page
                </h1>
            </div>
        </div>
        <div class="body-content">
        	<div class="container">            	
                <div class="resident-registration">
                	<div class="resident-registration-left">
                    	<form id="addresident-form" method="POST" enctype="multipart/form-data">
            				<div><span class="error_individual" id="name_validate"></span></div>
                            <input type="text" id="name" name="name" placeholder="Name">
            				<div><span class="error_individual" id="email_validate"></span></div>
                            <input type="text" id="email" name="email" placeholder="Email">
            				<div><span class="error_individual" id="phone_validate"></span></div>
                            <input type="text" id="phone" name="phone" placeholder="Phone Number">
                            <div><span class="error_individual" id="block_validate"></span></div>
                            <select id="block" name="block" onchange="change_floors(this.value)">
                            	<option value="">
                                	Block
                                </option>
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
                            <div><span class="error_individual" id="floors_validate"></span></div>
                            <select id="floors" name="floors">
                            	<option value="">
                                	Floor
                                </option>
                            </select>
                             <div><span class="error_individual" id="unit_validate"></span></div>
                            <select id="unit" name="unit">
                            	<option value="">
                                	Unit
                                </option>
                            </select>
                             <div><span class="error_individual" id="type_validate"></span></div>
                            <select id="type" name="type">
                                <option value="2">
                                	Owner
                                </option>
                                <option value="1">
                                	Tenant
                                </option>
                            </select>
                            <input name="add_resident_btn" type="submit" value="Register Now" />
                        </form>
                    </div>
                    <div class="resident-registration-right">
                    	<div class="resident-registration-right-img">
                        	<!--<img src="<?php echo base_url()?>assets/front/images/resident-register-img.png" />-->
                             <img src="<?php echo base_url()?>uploads/condos/condo_pictures/<?php echo $results->condo_picture;?>" style=""/>
                        </div>
                      <h2>
                        	<?php echo $results->name?>
                        </h2>
                        <p>
                        	<?php echo $results->address?><br/>
                            <?php echo $this->General_model->get_value_by_id('areas',$results->areas,'name');?><br/>
							<?php echo $this->General_model->get_value_by_id('states',$results->state,'name');?>
                        </p>
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