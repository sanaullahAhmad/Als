<meta http-equiv="refresh" content="5;url=<?php echo base_url()?>dashboard" />

 <link href="<?php echo base_url();?>assets/front/pages/css/invoice.min.css" rel="stylesheet" type="text/css" />

 <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <div class="container">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>
                            	<?php if(isset($title)){ echo $title;}?>                                
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                       <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
                        <div class="note note-success">
				  <h4 class="block">Payment Successful</h4>
				  <p><?php echo $view_data;?></p>
				 </div>
                            
                        </div>
                        <!-- END PAGE CONTENT INNER -->

                		    
                        </div>
                    </div>
                </div>
            </div>
