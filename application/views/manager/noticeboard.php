<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"><?php echo $title;?>
      <small></small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>manager">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span><?php echo $title;?></span>
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
        <form class="form-horizontal" role="form" method="POST"  id="add-advertisement" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                     <textarea class="form-control" id="title" name="title" placeholder="Title"></textarea>
                     <span class="error_individual" id="title_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                     <textarea class="form-control ckeditor" id="description" name="description" placeholder="Description"  rows="5"></textarea>
                     <span class="error_individual" id="description_validate"></span>
                </div>
            </div><?php /*?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Add featured Image</label>
                <div class="col-sm-10">
                    <input id="post_featured_image" name="file_upload" type="file">
                    <input type="hidden" name="featured_image" id="featured_image" value="0" />
                    <span class="error_individual" id="add_image_validate"></span>
                    <span id="img_featured"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Add Additional images</label>
                <div class="col-sm-10">
                    <input id="post_file_upload" name="file_upload" type="file" multiple="true">
                    <span class="error_individual" id="add_image_validate"></span>
                    <span id="additional_images"></span>
                </div>
            </div><?php */?>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Files</label>
                <div class="col-sm-10">
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Select files...</span>
                        <input id="post_file_upload" type="file" name="files" multiple>
                    </span>
                    <div id="progress" class="progress" style="margin-top: 10px;height:10px;">
                      <div class="progress-bar progress-bar-success" ></div>
                  </div>
                    <span id="additional_images" class="files"></span>
                </div>
            </div>
            
           <div class="form-group">
                <label class="col-sm-2 control-label">Is Featured</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="is_featured" id="is_featured" <?php if(sizeof($feature_limit)>4){ echo 'disabled="disabled"';}?> />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="addadvertisementsub" id="addadvertisementsub" class="btn btn-primary">
                        Add Post
                    </button>
                </div>
            </div>
        </form>
		 </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>
<style>
.image_delete_cross {
    cursor: pointer;
    margin-left: -15px;
    color: #000;
    font-weight: bold;
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: #fff;
    font-size: 20px;
}
</style>