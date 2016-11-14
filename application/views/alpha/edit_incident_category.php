<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Edit Incident Category
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
              <span>Edit Incident Category</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
     <form id="editincedentcategory-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
          <div class="form-group">
              <label class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name"  value="<?php echo $service_cat->name?>">
                  <span class="error_individual" id="name_validate"></span>
              </div>
          </div>
         
        
          
          <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                  <input type="hidden" id="table" name="table" value="incident_categories">
                  <input type="hidden" id="current_name" name="current_name" value="<?php echo $service_cat->name?>">
                  <button type="submit" id="edit_incident_category_btn" name="edit_incident_category_btn" class="btn btn-primary">Update</button>
              </div>
          </div>
      </form>
      <!-- // Table END -->
		</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>