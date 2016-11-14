<!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper">
                            <!-- BEGIN CONTENT BODY -->
                            <!-- BEGIN PAGE HEAD-->
                            <div class="page-head">
                                <div class="container">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <h1><?php if(isset($page_title)){ echo $page_title;}?>           
                                        </h1>
                                    </div>
                                    <!-- END PAGE TITLE -->
                                   
                                </div>
                            </div>
                            <!-- END PAGE HEAD-->
                            <!-- BEGIN PAGE CONTENT BODY -->
                            <div class="page-content">
                                <div class="container">
                                    <!-- BEGIN PAGE BREADCRUMBS -->
                                    
                                    <!-- END PAGE BREADCRUMBS -->
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <div class="page-content-inner">
                                    <div class="left-post">
                                        <div class="c-contact">
                                                        <div class="c-content-title-1">
                                                            <div class="c-line-left bg-dark"></div>
                                                            <p class="c-font-lowercase">Our helpline is always open to receive any inquiry or feedback. Please feel free to drop us an email from the form below and we will get back to you as soon as we can.</p>
                                                        </div>
    <form id="contact-us" method="POST" >
        <div class="form-group">
            <input type="text" name="name" placeholder="Your Name" class="form-control input-md">
             <span id="name_validate" class="error_individual help-block"></span>
        </div>
        <div class="form-group">
            <input type="text" name="email" placeholder="Your Email" class="form-control input-md"> 
            <span id="email_validate" class="error_individual help-block"></span>
        </div>
        <div class="form-group">
            <input type="text" name="phone" placeholder="Contact Phone" class="form-control input-md"> 
            <span id="phone_validate" class="error_individual help-block"></span>
        </div>
        <div class="form-group">
            <textarea rows="8" name="message" placeholder="Write message here ..." class="form-control input-md"></textarea>
            <span id="message_validate" class="error_individual help-block"></span>            
        </div>
        <button name="contactussub" id="contactussub" type="submit" class="btn grey">Submit</button>
    </form>
                                                    </div>
                                        
                                    </div>
                                    
                                    <?php echo $this->load->view('template/sidebar');?>
                                    </div>
                                    <!-- END PAGE CONTENT INNER -->
                                </div>
                            </div>
                            <!-- END PAGE CONTENT BODY -->
                            <!-- END CONTENT BODY -->
                        </div>
                        <!-- END CONTENT -->
                        
        
            <!--    <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>
                
    <script src="<?php echo base_url()?>assets/front/pages/scripts/contact.min.js" type="text/javascript"></script>-->                    
<script>

//add-facility-booking

</script>