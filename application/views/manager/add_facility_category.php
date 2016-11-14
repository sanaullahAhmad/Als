<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Add Facility category
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
              <span>Add Facility category</span>
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

<form id="addfacilitycategory-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    <?php if($this->session->flashdata("message")){ echo "<div class='form-group'>
        <label class='col-sm-2 control-label'>&nbsp;</label>
        <div class='col-sm-10'  style='color:green;'>".$this->session->flashdata("message")."</div></div>";}?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            <span class="error_individual" id="name_validate"></span>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Image</label>
        <div class="col-sm-10">
            <input type="file" id="image_url" name="image_url">
            <span class="error_individual" id="image_url_validate"></span>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Info only</label>
        <div class="col-sm-10">
            <input type="checkbox" id="info_only" name="info_only">
            <span class="error_individual" id="info_only_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        	<input type="hidden" id="table" name="table" value="admin">
            <button type="submit" id="add_category_btn" name="add_category_btn" class="btn btn-primary">Add Facility Category</button>
        </div>
    </div>
</form>
      </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>