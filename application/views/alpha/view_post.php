<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title"> Post
        <small>view Post</small>
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo base_url();?>">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>view Post</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN DASHBOARD STATS 1-->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- Table -->
	<div class="form-horizontal">												
    <!--<div class="form-group">
        <label class="col-sm-2 control-label">Post Title</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Name" readonly="readonly" value="<?php echo $this->General_model->get_value_by_id("posts",$post_details->post_id,'title')?>">
            <span class="error_individual" id="full_name_validate"></span>
        </div>
    </div>-->
   
  <div class="form-group">
        <label class="col-sm-2 control-label">Post Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="description" name="description" readonly="readonly"><?php echo $this->General_model->get_value_by_id("posts",$post_details->post_id,'description')?></textarea>
            <span class="error_individual" id="name_validate"></span>
        </div>
    </div>
    
     <div class="form-group">
        <label class="col-sm-2 control-label">Posted By</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Name" readonly="readonly" value="<?php $posted_by_id = $this->General_model->get_value_by_id("posts",$post_details->post_id,'posted_by');
				echo $this->General_model->get_value_by_id("residents",$posted_by_id,'name')?>">
            <span class="error_individual" id="full_name_validate"></span>
        </div>
    </div>
    
     <div class="form-group">
        <label class="col-sm-2 control-label">Reported By</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Name" readonly="readonly" value="<?php echo $this->General_model->get_value_by_id("residents",$post_details->reported_by,'name')?>">
            <span class="error_individual" id="full_name_validate"></span>
        </div>
    </div>
    
     <div class="form-group">
        <label class="col-sm-2 control-label">Images</label>
        <div class="col-sm-10">
            <?php 
			$posts_images=$this->General_model->get_data_all_using_where('post_id',$post_details->post_id,'posts_images');
			if(sizeof($posts_images)>0)
			{
				foreach($posts_images as $posts_image)
				{
				  echo  '<img src="'.base_url().'uploads/post_images/'.$posts_image['image_url'].'" style="max-width:300px;" />';
				}
			}	
			?>
        </div>
    </div>
     <div class="form-group">
        <label class="col-sm-2 control-label">Comments</label>
        <div class="col-sm-10">
            <?php 
			$posts_images=$this->General_model->get_data_all_using_where('post_id',$post_details->post_id,'posts_comments');
			if(sizeof($posts_images)>0)
			{
				foreach($posts_images as $posts_image)
				{
				  echo  '<input type="text" value="'.$posts_image['comment'].'" class="form-control" /><br>';
				}
			}	
			?>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Actions</label>
        <div class="col-sm-10">
           <form method="post" style="float:left">
           	<input type="hidden" name="post_id" value="<?php echo $post_details->post_id;?>" />
           	<button class="btn btn-primary" name="delet_post_btn" type="submit">Delete Post</button>
           </form>
           <form method="post" style="float:left;  margin:0 15px;">
           	<input type="hidden" name="post_id" value="<?php echo $post_details->post_id;?>" />
           	<button class="btn btn-primary" name="send_warning_btn" type="submit">Send Warning</button>
           </form>
            <form method="post" style="float:left">
           	<input type="hidden" name="post_id" value="<?php echo $post_details->post_id;?>" />
           	<button class="btn btn-primary" name="suspend_account_btn" type="submit">Suspend Account</button>
           </form>
        </div>
    </div>
    
    
    
</div>


	</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->  
</div>