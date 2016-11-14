<!--datepicker-->
<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!--timepicker-->
<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
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

              <div class="left-post">
              <div class="portlet light ">
                
                <div class="portlet-body form">
                 <?php if ($this->session->flashdata('message')) { ?>
                    <div class="alert alert-info"> 
                        <?= $this->session->flashdata('message') ?> 
                    </div>
                <?php } ?>
                <form class="form-horizontal" role="form" id="resident-delivery" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="3" name="description" id="description" placeholder="eg. New furniture delivery. Please guide driver to loading bay and deliver item to Unit A-10-1"></textarea>
                                <span class="error_individual help-block" id="description_validate"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date</label>
                            <div class="col-md-9 date-picker" data-date-format="dd-mm-yyyy">
                                <input type="text" class="form-control datepicker" id="date" name="date">
                                <span class="error_individual help-block" id="date_validate"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Time</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control timepicker timepicker-default" id="time" name="time" <?php echo date('h:i A');?>>
                                <span id="time_validate" class="error_individual help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Company Name</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name">
                                <span class="error_individual help-block" id="company_name_validate"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Attachment</label>
                            <div class="col-md-9">
                                <input type="file"  name="file_upload" >
                                <span class="error_individual help-block" id="file_upload_validate"></span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" name="adddeliverysubmit" class="btn green">Submit</button>
                                <a href="<?php echo base_url();?>add_delivery" class="btn default">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
              </div>
              
              
              
              <div class="portlet light ">
                
                <?php
			  echo $this->load->view('template/feature_ad');
			  ?>
           
              </div>
              
              </div>
                  <?php echo $this->load->view('template/sidebar');?>
          </div>
      </div>
   </div>
</div>
            
<style>
label.error
{
	width:100% !important
}
</style>
<script>
$('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
});  
$('.timepicker').timepicker();  
</script>
                            