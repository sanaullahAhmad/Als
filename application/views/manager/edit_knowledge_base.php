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
            <form class="form-horizontal" role="form" method="POST"  id="add-knowledge-base" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                         <textarea class="form-control" id="name" name="name" placeholder="Name"><?php echo $knowledge_base->name;?></textarea>
                         <span class="error_individual" id="name_validate"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-10">
                         <textarea class="form-control ckeditor" id="description" name="description" placeholder="Description" rows="5"><?php echo $knowledge_base->description;?></textarea>
                         <span class="error_individual" id="description_validate"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">jquery file upload</label>
                    <div class="col-sm-10">
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Select files...</span>
                            <input id="fileupload" type="file" name="files" multiple>
                        </span>
                        <div id="progress" class="progress" style="margin-top: 10px;">
                          <div class="progress-bar progress-bar-success"></div>
                      </div>
                        <span id="files" class="files">
                         <?php 
                        $images=$this->General_model->get_data_all_like_using_where('knowledge_base_files',"knowledge_base_id=".$this->uri->segment(3));
                        if(sizeof($images)>0)
                        {
                            foreach($images as $image)
                            {
                                $characters = 'abcdefghijklmnopqrstuvwxyz';
                                $charactersLength = strlen($characters);
                                $randomString = '';
                                for ($i = 0; $i < 5; $i++) {
                                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                                }
                        ?>
                        <section style="position:relative;" class="<?php echo $randomString?>"><a href="<?php echo base_url();?>uploads/knowledge_base/<?php echo $image['file_url']?>" target="_blank"><?php echo $image['file_url']?></a><span onclick="delete_image_section('<?php echo $randomString?>')" class="image_delete_cross" style="margin-left:5px">&#120;</span><input type="hidden" name="images_names[]" value="<?php echo $image['file_url']?>" class="images_names"></section>
                        
                        <?php }
                        }?>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Privacy</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="privacy" name="privacy">
                            <option value="1" <?php if($knowledge_base->privacy==1){?> selected="selected" <?php }?>>Public</option>
                            <option value="0" <?php if($knowledge_base->privacy==0){?> selected="selected" <?php }?>>Private</option>
                        </select>
                        <span class="error_individual" id="privacy_validate"></span>
                    </div>
                </div>
                
                
               
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="edit_knowledgebase_btn" id="edit_knowledgebase_btn" class="btn btn-primary">
                            Edit Knowledge Base
                        </button>
                    </div>
                </div>
            </form>
		 </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>