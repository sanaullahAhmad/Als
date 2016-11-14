<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">
<script src="<?php echo base_url();?>/assets/front/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>/assets/front/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <link href="<?php echo base_url();?>/assets/front/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        
<script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>

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
                  <!--<div class="portlet-title">
                      <div class="caption">
                          <i class="icon-settings font-dark"></i>
                          <span class="caption-subject font-dark sbold uppercase"><?php if(isset($title)){ echo $title;}?>  Form</span>
                      </div>
                      <div class="actions">
                          
                      </div>
                  </div>-->
                  <div class="portlet-body form">
                    <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-info" > 
                            <?= $this->session->flashdata('message') ?> 
                        </div>
                    <?php } ?>
                    <form class="form-horizontal innerT " role="form" method="POST" id="add-advertisement" enctype="multipart/form-data">
                    <div class="form-body">
                      <div class="form-group">
                        <label class="col-md-3 control-label">Title</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                            <span class="error_individual help-block" id="title_validate"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-9">
                            <textarea class="form-control wysihtml5" id="description" rows="5" name="description" placeholder="Describe your ad in detail."></textarea>
                            <span class="error_individual help-block" id="description_validate"></span>
                        </div>
                      </div>
                      
                      <div class="form-group">
                          <label class="col-sm-3 control-label">Add Images</label>
                          <div class="col-sm-9">
                              <span class="btn btn-success fileinput-button">
                                  <i class="glyphicon glyphicon-plus"></i>
                                  <span>Select files...</span>
                                  <input id="fileupload" type="file" name="files" multiple>
                              </span>
                              <div id="progress" class="progress" style="margin-top: 10px;">
                                <div class="progress-bar progress-bar-success"></div>
                            </div>
                              <span id="files" class="files"></span>
                          </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="col-md-3 control-label">Type</label>
                        <div class="col-md-9">
                            <select class="form-control" id="advert_type" name="advert_type" >
                            	<option value="3">Premium</option>
                            	<option value="2">Featured</option>
                            	<option value="1">Normal</option>
                            </select>
                            <span class="error_individual help-block" id="title_validate"></span>
                        </div>
                      </div>
                      
                      <?php /*?><div class="form-group">
                        <label class="col-md-3 control-label">Add featured Image</label>
                        <div class="col-md-9">
                            <input id="advertisement_featured_image" name="file_upload" type="file">
                            <input type="hidden" name="featured_image" id="featured_image" value="0" />
                            <span class="error_individual" id="add_image_validate"></span>
                            <span id="img_featured"></span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label">Add Additional images</label>
                        <div class="col-md-9">
                            <input id="advertisement_file_upload" name="file_upload" type="file" multiple="true">
                            <span class="error_individual" id="add_image_validate"></span>
                            <span id="additional_images"></span>
                        </div>
                      </div><?php */?>
                  </div>
                  
                  <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" name="addadvertisementsub" id="addadvertisementsub" class="btn green">
                              Add Advertisement
                          </button>
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
            