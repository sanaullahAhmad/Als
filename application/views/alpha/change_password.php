<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Password
      <small>Change Password</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Password</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
				<form class="form-horizontal innerT " role="form" method="POST" id="change-password">
                <input type="hidden" value="<?php echo $alpha_info->id?>" name="id">
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-2 control-label">Current Password</label>
				    <div class="col-sm-6">
				      <input type="password" class="form-control" id="password" name="password" placeholder="Type here">
                      <span class="error_individual" id="password_validate"></span>
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">New Password</label>
				    <div class="col-sm-6">
				      <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Type here">
                      <span class="error_individual" id="new_password_validate"></span>
				    </div>
				  </div>
				 <div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">Retype New Password</label>
				    <div class="col-sm-6">
				      <input type="password" class="form-control" id="retype_password" name="retype_password" placeholder="Type here">
                      <span class="error_individual" id="retype_password_validate"></span>
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-2 col-sm-10">
				      <button type="submit" name="changepasssub" class="btn btn-primary">Change Password</button>
				    </div>
				  </div>
				</form>
		</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>