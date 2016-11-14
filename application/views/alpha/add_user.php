<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add User
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
    <form id="adduser-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Name</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="full_name" name="full_name" placeholder="Name">
<span class="error_individual" id="full_name_validate"></span>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Email</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="email" name="email" placeholder="Email">
<span class="error_individual" id="email_validate"></span>
</div>
</div>

<!--<div class="form-group">
<label class="col-sm-2 control-label">Access Level</label>
<div class="col-sm-10">
<select class="form-control" id="access_level" name="access_level" >
<option value="1">1</option>
<option value="2">2</option>
</select>
<span class="error_individual" id="access_level_validate"></span>
</div>
</div>-->



<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<input type="hidden" id="table" name="table" value="admin">
<button type="submit" id="add_user_btn" name="add_user_btn" class="btn btn-primary">Register User</button>
</div>
</div>
</form>
</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>