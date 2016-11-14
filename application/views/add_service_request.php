<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>
                    <?php if(isset($page_title)){ echo $page_title;}?>                               
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
                <form method="POST" class="form-horizontal" id="add-service-request" enctype="multipart/form-data">        
                 <div class="form-body">
                      <div class="form-group">
                          <label class="col-md-3 control-label">Category</label>
                          <div class="col-md-9">
                              <select id="service_category" name="service_category" onchange="select_services(this.value)" 
                              class="form-control">
                                <option value="">--Select Category--</option>
                                <?php foreach($service_categories as $service_category){?>
                                <option value="<?php echo $service_category['id']?>"><?php echo $service_category['name']?></option>
                                <?php }?>
                              </select>
                              <span class="error_individual" id="service_category_validate"></span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-md-3 control-label">Service</label>
                          <div class="col-md-9 service_box">
                              <select id="service" name="service" class="form-control">
                                <option value="">--Select Service--</option>
                              </select>
                              <span class="error_individual help-block" id="service_validate"></span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label class="col-md-3 control-label">Description</label>
                          <div class="col-md-9">
                              <textarea name="description" id="description" placeholder="Please describe the job in detail" class="form-control"></textarea>
                              <span class="error_individual help-block" id="description_validate"></span>
                          </div>
                      </div>
                      
                      <div class="form-group">
                          <label class="col-md-3 control-label">When do you need it?</label>
                          <div class="col-md-9">
                             <select id="duration" name="duration" class="form-control">
                                <option value="7">Within 7 Days</option>
                                <option value="15">Within 15 Days</option>
                                <option value="30">Within 30 Days</option>
                              </select>
                             <span class="error_individual help-block" id="duration_validate"></span>
                          </div>
                      </div>
                      <?php /*?>
                      <div class="form-group">
                          <label class="col-md-3 control-label">Attachment</label>
                          <div class="col-md-9">
                             
                             <input id="service_request_file" name="file_upload" type="file">
                             <input type="hidden" name="service_request_input" id="service_request_input" value="0" />
                             <span class="error_individual" id="service_request_file"></span>
                             <span id="service_request_span"></span>
                          </div>
                      </div>
                      <?php */?>
                      <div class="form-group">
                          <label class="col-sm-3 control-label">Attachment</label>
                          <div class="col-sm-9">
                              <span class="btn btn-success fileinput-button">
                                  <i class="glyphicon glyphicon-plus"></i>
                                  <span>Select files...</span>
                                  <input id="service_request_file" type="file" name="file_upload" multiple>
                              </span>
                              <div id="progress" class="progress" style="margin-top: 10px;">
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                              <div id="files" class="files" style="margin-top:15px;"></div>
                          </div>
                      </div>
                  </div>
                  <div class="form-actions">
                      <div class="row">
                          <div class="col-md-offset-3 col-md-9">
                              <button type="submit" name="service_request_submit" id="service_request_submit" class="btn green">
                                Submit
                              </button>
                              <a href="<?php echo base_url();?>service_requests" class="btn default">Cancel</a>
                          </div>
                      </div>
                  </div>
                 </form>
                 </div>
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