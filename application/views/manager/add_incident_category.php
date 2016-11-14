<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Add Incident Category
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
              <span>Add Incident Category</span>
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
                                                             
	<form id="addincedentcategory-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            <span class="error_individual" id="name_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Reports Per Day</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="reports_per_day" name="reports_per_day" placeholder="Reports Per Day">
            <span class="error_individual" id="reports_per_day_validate"></span>
        </div>
    </div>
   
  
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        	<input type="hidden" id="table" name="table" value="incident_categories">
            <button type="submit" id="add_incident_category_btn" name="add_incident_category_btn" class="btn btn-primary">Add</button>
        </div>
    </div>
	</form>
      </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>