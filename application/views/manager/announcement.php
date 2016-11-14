<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets_v1/admin/css/components/common/forms/editors/wysihtml5/assets/lib/css/bootstrap-wysihtml5-0.0.2.css" />
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Announcement
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
              <span>Announcement</span>
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
<form class="form-horizontal" role="form" method="POST"  id="send_resident_email" enctype="multipart/form-data">
    
    <div class="form-group">
        <label class="col-md-2 control-label">Block</label>
        <div class="col-md-10">
            <select id="block" name="block" class="form-control">
                <option value="">
                    Block
                </option>
                <?php
                  if(sizeof($blocks)>0)
                  {
                      foreach($blocks as $block)
                      {
                          ?>
                          <option value="<?php echo $block['block']?>" ><?php echo $this->General_model->get_value_by_id('blocks',$block['block'],'name')?></option>
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
              <option value="all">All</option>
            </select>
            <span class="error_individual" id="block_validate"></span>
        </div>
    </div>
    <div class="form-group">
          <label class="col-sm-2 control-label">Subject</label>
          <div class="col-sm-10">
              <input type="text" name="subject"  id="subject" class="form-control" placeholder="Subject">
               <span class="error_individual" id="subject_validate"></span>
          </div>
        </div>
        
    <div class="form-group">
          <label class="col-sm-2 control-label">Message</label>
          <div class="col-sm-10">
               <textarea name="message"  id="description" class="form-control ckeditor" rows="5" placeholder="Message"></textarea>
               <span class="error_individual" id="message_validate"></span>
          </div>
        </div>
   <div class="form-group">
            <label class="col-md-2 control-label">Attachment</label>
            <div class="col-md-10">
                 <span class="btn btn-success fileinput-button" style="margin-bottom:10px;">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Select files...</span>
                        <input id="email_attachement" type="file" name="file_upload">
                    </span>
                    <div id="progress_loading" style="margin-top: 10px; width:100%; display:none; clear:both;">
                      Loading...
                    </div>
                  <div id="progress" class="progress" style="margin-top: 10px; width:50%; display:none; height:10px;">
                      <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <div id="files" class="files" style="clear:both;"></span>
                </div>
                
                <span class="error_individual help-block" id="infomsg"></span>
            </div>
          </div>
   
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="send_resident_email" id="send_resident_email" class="btn btn-primary">
                Send
            </button>
        </div>
    </div>
</form>
       </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>