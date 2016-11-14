<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript" ></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/search.min.css" />
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
						<?php if ($this->session->flashdata('message')) { ?>
                            <div class="alert alert-info"> 
                                <?= $this->session->flashdata('message') ?> 
                            </div>
                        <?php } ?>
                    <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                   
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light form-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bubble font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">Optional Information</span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form action="#" class="form-horizontal form-bordered">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Manimum Budget</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" maxlength="25" name="defaultconfig" id="maxlength_defaultconfig" readonly="readonly" value="<?php echo $quotes_details->min_budget?>">
                                                    <span class="help-block"> This is optional. Vendor is free to either give manimum budget or not. </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Maximum Budget</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control" maxlength="25" name="defaultconfig" id="maxlength_thresholdconfig" readonly="readonly" value="<?php echo $quotes_details->max_budget?>">
                                                    <span class="help-block">  This is optional. Vendor is free to either give maximum budget or not.</code> </span>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">File</label>
                                                <div class="col-md-4">
                                                    <a href="<?php echo base_url();?>uploads/services_quotes/<?php echo $quotes_details->quotation_file?>" target="_blank">
                                                    	<img src="<?php echo base_url();?>uploads/services_quotes/<?php echo $quotes_details->quotation_file?>" class="img-responsive" />
                                                    </a>
                                                    <span class="help-block">  This is optional. Vendor is free to either Attach a file or not.</code> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
                    </div>
                    
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    
                </div>
             </div>
          </div>
      </div>
  </div>
  
<!-- Modal -->


 
                      



