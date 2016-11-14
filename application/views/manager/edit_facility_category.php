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

<form id="edit-facilitycategory-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    <?php if($this->session->flashdata("message")){ echo "<div class='form-group'>
        <label class='col-sm-2 control-label'>&nbsp;</label>
        <div class='col-sm-10'  style='color:green;'>".$this->session->flashdata("message")."</div></div>";}?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $category_details->name;?>">
            <span class="error_individual" id="name_validate"></span>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Image</label>
        <div class="col-sm-5">
            <input type="file" id="image_url" name="image_url">
            <span class="error_individual" id="image_url_validate"></span>
        </div>
        <div class="col-sm-5">
        	<img src="<?php echo base_url();?>uploads/facilities_images/<?php echo $category_details->image_url;?>" class="img-responsive"/>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Info only</label>
        <div class="col-sm-10">
            <input type="checkbox" id="info_only" name="info_only" <?php if($category_details->info_only==1){?> checked="checked" <?php }?> >
            <span class="error_individual" id="info_only_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" id="edit_category_btn" name="edit_category_btn" class="btn btn-primary">Edit Facility Category</button>
        </div>
    </div>
</form>
          </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>