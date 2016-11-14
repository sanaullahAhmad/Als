<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Add Knowledge Base
      <small></small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Add Knowledge Base</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
		<?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-info" > 
                <?= $this->session->flashdata('message') ?> 
            </div>
        <?php } ?>
        <form class="form-horizontal" role="form" method="POST"  id="add-knowledge-base" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                     <textarea class="form-control" id="name" name="name" placeholder="Name"></textarea>
                     <span class="error_individual" id="name_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                     <textarea class="form-control ckeditor" id="description" name="description" placeholder="Description"  rows="5"></textarea>
                     <span class="error_individual" id="description_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Files</label>
                <div class="col-sm-10">
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
                <label class="col-sm-2 control-label">Privacy</label>
                <div class="col-sm-10">
                    <select class="form-control" id="privacy" name="privacy">
                        <option value="1">Public</option>
                        <option value="0">Private</option>
                    </select>
                    <span class="error_individual" id="privacy_validate"></span>
                </div>
            </div>
            
            
           
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="add_knowledgebase_btn" id="add_knowledgebase_btn" class="btn btn-primary">
                        Add Knowledge Base
                    </button>
                </div>
            </div>
        </form>
        </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>