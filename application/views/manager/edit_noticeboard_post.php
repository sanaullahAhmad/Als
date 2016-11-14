<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">
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
                     <input type="text" value="<?php echo $post_details->title?>" class="form-control" id="title" name="title" placeholder="Title"></textarea>
                     <span class="error_individual" id="title_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                     <textarea class="form-control ckeditor" id="description" name="description" placeholder="Description"   rows="5"><?php echo $post_details->description?></textarea>
                     <span class="error_individual" id="description_validate"></span>
                </div>
            </div>
            
            
            
            
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Files</label>
                <div class="col-sm-10">
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Select files...</span>
                        <input id="post_file_upload" type="file" name="files" multiple>
                    </span>
                    <div id="progress" class="progress" style="margin-top: 10px;height:10px;">
                      <div class="progress-bar progress-bar-success"></div>
                  </div>
                    <span id="additional_images" class="files">
                    <?php 
                    $images=$this->General_model->get_data_all_like_using_where('posts_images',"post_id=".$this->uri->segment(3));
                    if(sizeof($images)>0)
                    {
                        foreach($images as $image)
                        {
                            $characters = 'abcdefghijklmnopqrstuvwxyz';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            for ($i = 0; $i < 5; $i++) 
                            {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }
                            if(pathinfo($image['image_url'], PATHINFO_EXTENSION)=='pdf')
                                    {
                                    
                                    echo '<section style="position:relative; clear:both;" class="'.$randomString.'"><a href="'.base_url().'uploads/post_images/'.$image['image_url'].'" target="_blank"> '. $image['image_url'].'</a><span onclick="delete_image_section(&#39;'.$randomString.'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span><input type="hidden" name="images_names[]" value="'.$image['image_url'].'" class="images_names"></section>';
                                    }
                                    else
                                    {
                    ?>
                    <section style="position:relative; float:left" class="<?php echo $randomString?>"><img src="<?php echo base_url()?>uploads/post_images/<?php echo $image['image_url']?>" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_section('<?php echo $randomString?>')" style="cursor:pointer;margin-left: -10px;">&#120;</span><input type="hidden" name="images_names[]" value="<?php echo $image['image_url']?>" class="images_names"></section>
                    
                    <?php 			}
                    }
                    }?>
                    </span>
                </div>
            </div>
           
           <div class="form-group">
                <label class="col-sm-2 control-label">Is Featured</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="is_featured" id="is_featured" <?php if(sizeof($feature_limit)>4){ echo 'disabled="disabled"';}?> <?php if($post_details->image_url=="1"){ echo 'checked="checked"';}?> />
                </div>
            </div>
           
          
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="addadvertisementsub" id="addadvertisementsub" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>
        </form>
		 </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>