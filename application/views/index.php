<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta content="IE=edge" http-equiv="X-UA-Compatible">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta content="" name="description">
<meta content="" name="author">
<title><?php echo $title;?></title>
<link href="<?php echo base_url()?>assets/front/layouts/layout3/css/alpha-search.css" rel="stylesheet" type="text/css" media="all" />
<link rel="shortcut icon" href="<?php echo base_url()?>assets/front/layouts/layout3/img/alia_favicon.ico" />

<style>
.contact-section:before {
	content:"";
	position:absolute;
	left:0px;
	top:0px;
	width:100%;
	height:100%;
	background:rgba(0, 0, 0, 0.30);
}
.search-footer-con {
	margin:0 auto;
	width:98%;
	overflow:hidden;
}
</style>
</head>
<body>
<div class="alpha-search-container" id="Signup">
  <div class="search-content">
    <div class="alpha-top-bar">
      <div class="logo"> <a href="<?php echo base_url()?>"><img src="<?php echo base_url()?>assets/front/layouts/layout3/img/new-logo.png" /> </a></div>
      <a href="#contact" id="contact-us"> Contact </a> </div>
    <div class="banner-text"> 
    <!--<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/banner-text.png" /> -->
    	<div class="normal-text">
        	<strong>Creating Smarter, Safer, and Sustainable<br /> Communities</strong> 
            <span>The community platform for apartments, condominiums and gated residences.</span>
        </div>
        <!--<div class="house-image">
        	<span>Residential <br /> Community Platform</span>
        </div>-->
    </div>
    <div class="search-con"> 
      <!--<div class="search-container">
                    <div class="logo">
                       <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/alia-slogan.png" />
                    </div>                
                </div>-->
      <div class="search-condo">
        <div class="search-box">
          <form method="POST" action="<?php echo base_url('search');?>">
            <input name="keyword" id="search-box-input" type="text" autocomplete="off" placeholder="Search your residence..." />
            <button type="submit" name="index_btn"> Search </button>
          </form>
        </div>
        <div id="suggesstion-box"></div>
      </div>
      <!--<a href="#move" class="fancy-arrow"> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/down-arow.png" /> </a>-->
      <a href="#move" class="fancy-arrow signup-new"> FIND OUT MORE </a>
     </div>
  </div>
</div>
<div class="detail-section" id="move">
  <div class="detail-left"></div>
  <div class="detail-right">
    <h2> Pay online. </h2>
    <h2> Pay on-time. </h2>
    <h2> Chance to win cash rewards. </h2>
    <p> <strong>ALIA</strong> is a residential community platform that provides seamless convenience to residents. </p>
    <ul>
      <li> Pay your maintenance fees online. </li>
      <li> Book facilities. </li>
      <li> Hire qualified service providers. </li>
      <li> Get notified of notices the moment it's posted in your portal by your management office. </li>
      <li> And many more cool stuff. </li>
    </ul>
    <p> Living at home made simple. </p>
    <a href="#contact" class="signup-new"> REQUEST DEMO </a>
  </div>
</div>
<div class="feature-section">
  <div class="feature-section-container">
    <h2> Key Features </h2>
    <div class="feature-row">
      <div class="feature-left">
        <div class="feature-image"> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/feature1.png" /> </div>
        <div class="feature-detail">
          <h3> Pay Online & View History </h3>
          <p> Pay your bills securely and hassle- free. All transactions are recorded and viewable in your payment history. </p>
        </div>
      </div>
      <div class="feature-right">
        <div class="feature-image"> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/feature5.png" /> </div>
        <div class="feature-detail">
          <h3> Facility Booking </h3>
          <p> Check availability of facilities in real time and make a booking directly. Your time, at your convenience. </p>
        </div>
      </div>
    </div>
    <div class="feature-row">
      <div class="feature-left">
        <div class="feature-image"> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/feature3.png" /> </div>
        <div class="feature-detail">
          <h3> Community <br /> Engagement </h3>
          <p> You can post and share useful information with your residents in your own community wall. What a great way to look out for each other. </p>
        </div>
      </div>
      <div class="feature-right">
        <div class="feature-image"> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/feature4.png" /> </div>
        <div class="feature-detail">
          <h3> Community Offers & Promotions </h3>
          <p> Are you a home-based yoga teacher looking to provide yoga lessons to interested neighbours? Easily promote your services and reach out to your community. </p>
        </div>
      </div>
    </div>
    <div class="feature-row">
      <div class="feature-left">        
        <div class="feature-image"> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/feature2.png" /> </div>
        <div class="feature-detail">
          <h3> Hire Service Providers </h3>
          <p> Whether it is a broken-pipe, air- con servicing, or cleaning services, we will help you find the right provider. All service providers are pre-screened and qualified. </p>
        </div>
      </div>
      <div class="feature-right">
        <div class="feature-image"> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/feature6.png" /> </div>
        <div class="feature-detail">
          <h3> E-Noticeboard </h3>
          <p> Get notified on the latest announcements and important notices as soon as it is posted by your management office. Always engaging, always assuring. </p>
        </div>
      </div>
    </div>
    <div class="feature-row" style="text-align:center"> <a href="#contact" class="signup-new"> REQUEST DEMO </a> </div>
  </div>
</div>
<div class="contact-section" id="contact">
  <div class="contact-section-container">
    <h2> GET STARTED <span> Get in touch with us now on how ALIA can add value to your property. </span> </h2>
    <div class="contact-left" id="leftcontentnone">
    <form id="contact-form-front" method="POST">
      <div class="contact-row">
        <label>Name</label>
        <input name="contact_name" id="contact_name" type="text" />
      </div>
      <div class="contact-row" >
        <span id="contact_name_validate"></span> </div>
      <div class="contact-row">
        <label>Email</label>
        <input name="contact_email" id="contact_email" type="text" />
      </div>
       <div class="contact-row" >
        <label></label>
        <span id="contact_email_validate"></span> </div>
        
      <div class="contact-row">
        <label>Contact</label>
        <input name="contact_number" id="contact_number" type="text" />
      </div>
       <div class="contact-row" >
        <label></label>
        <span id="contact_number_validate"></span> </div>
        
      <div class="contact-row">
        <label>Name of your Residence</label>
        <input name="contact_name_of_residence" id="contact_name_of_residence" type="text" />
      </div>
       <div class="contact-row" >
        <label></label>
        <span id="contact_name_of_residence_validate"></span> </div>
        
      <div class="contact-row">
        <label>Message</label>
        <textarea name="contact_message" id="contact_message" cols="" rows=""></textarea>
      </div>
       <div class="contact-row" >
        <label></label>
        <span id="contact_message_validate"></span> </div>
        
      <div class="contact-row">
        <label>I am a</label>
        <select name="contact_type" id="contact_type">
          <option value="">Please Select</option>
          <option value="Owner">Owner</option>
          <option value="Tenant">Tenant</option>
          <option value="Council Member">Council Member</option>
          <option value="Property Manager">Property Manager</option>
          <option value="Property Developer">Property Developer</option>
          <option value="Other">Other</option>
        </select>
      </div>
       <div class="contact-row" >
        <label></label>
        <span id="contact_type_validate"></span> </div>
        
      <div class="contact-row">
        <label>&nbsp;</label>
        <input type="submit" name="contactfrontbtn" id="contactfrontbtn" value="SUBMIT"/>
      </div>
      </form>
    </div>
    <div class="contact-left" id="thanksmsg" style="display:none">
      <h3> Thank you for writing to us. We will get in touch with you soon. </h3>
    </div>
    <div class="contact-right">
      <h3> Alpha Relation Sdn Bhd <br /><span>(1161246-P)</span> </h3>
      <ul>
        <li> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/address.png" /> &nbsp;&nbsp; C3-5-13A, Solaris Dutamas, <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; No.1, Jalan Dutamas 1, <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 50480 Kuala Lumpur, Malaysia </li>
        <li> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/phone.png" /> &nbsp;&nbsp;+603-26315655 </li>
        <li> <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/email.png" /> &nbsp;&nbsp;support@als.com.my </li>
      </ul>
    </div>
  </div>
</div>
<?php echo $this->load->view('template/footer');?>
<!--<script src="<?php echo base_url()?>assets/admin/css/components/plugins/jquery.latest.js" type="text/javascript"></script>-->

<script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>

<?php $this->load->view('template/jqueryvalidatemin');?>
<?php $this->load->view('template/js_functions');?>

<script type="text/javascript">


//Landing Page Contact us 
		$("#contact-form-front").validate({
			rules: {
				contact_name: {
					required: true
				},
				contact_email: {
					required: true,
					email:true
				},
				contact_number: {
				   required: true
				},
				contact_name_of_residence: {
				   required: true
				},
				contact_message: {
					required: true
				},
				contact_type: {
					required: true
				}
			},
			messages: {
			  contact_name: {
					required: "Please enter a name",
				},
			  contact_email: {
					required: "Please enter an email",
					email: "Please enter a valid email address"
				},
			  contact_number: {
					required: "Please enter a phone number",
				},
			  contact_name_of_residence: {
					required: "Please enter Name of Residence",
				},
			  contact_message: {
					required: "Please enter a message",
				},
			  contact_type: {
					required: "Please enter a contact type",
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
                   url: "<?php echo base_url()?>home/send_contacts_front",
                   data: $("#contact-form-front").serialize(), 
                   cache: false,
				   beforeSend: function(){ $("#contactfrontbtn").text('Sending Email...');},
                   success: function(data) {
					   $("#leftcontentnone").hide();
					    $("#thanksmsg").show();
						$("#contact_name").val("");
						$("#contact_email").val("");
						$("#contact_number").val("");
						$("#contact_message").val("");
						$("#contact_name_of_residence").val("");
						$("#contact_type").val("");
					   //if(data == 'contactsent'){
                           	//alert('success');
                            
                      //  } 
                    },
                   error: function() {
                        alert('Something went wrong');
                   }
                 });
			}
		});



	$( document ).ready(function() {
		
		$(function() {
		  $('a[href*="#"]:not([href="#"])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			  var target = $(this.hash);
			  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			  if (target.length) {
				$('html, body').animate({
				  scrollTop: target.offset().top
				}, 500);
				return false;
			  }
			}
		  });
		});
		
		$( "#signin_home" ).click(function() {             /*signin layout and popup js*/
			
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
</body>
</html>
