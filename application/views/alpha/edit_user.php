<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Edit User
      <small>User</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>User</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
<form id="edituser-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Name"  value="<?php echo $service_cat->full_name?>">
            <span class="error_individual" id="full_name_validate"></span>
        </div>
    </div>
   
  <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $service_cat->email?>">
            <span class="error_individual" id="name_validate"></span>
        </div>
    </div>
    
   <!-- <div class="form-group">
        <label class="col-sm-2 control-label">Access Level</label>
        <div class="col-sm-10">
            <select class="form-control" id="access_level" name="access_level" >
            	<option value="1" <?php if($service_cat->access_level == 1){?> selected="selected"<?php }?>>1</option>
            	<option value="2" <?php if($service_cat->access_level == 2){?> selected="selected"<?php }?>>2</option>
            </select>
        </div>
    </div>-->
    
    
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="password" name="password" placeholder="Password"  >
            <span class="error_individual" id="password_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        	<input type="hidden" id="table" name="table" value="admin">
            <input type="hidden" id="current_name" name="current_name" value="<?php echo $service_cat->full_name?>">
            <button type="submit" id="edit_user_btn" name="edit_user_btn" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>