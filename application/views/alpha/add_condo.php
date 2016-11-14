<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Condo
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
              <span>Add Condo</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
	<form id="addcondo-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            <span class="error_individual" id="name_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Code</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="code" name="code" placeholder="Code">
            <span class="error_individual" id="code_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            <span class="error_individual" id="email_validate"></span>
        </div>
    </div>
   <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Mobile</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
        </div>
    </div>
    <div class="form-group">
    	<label for="inputEmail3" class="col-sm-2 control-label">Logo</label>
        <div class="col-sm-10">
           <input type="file" class="form-control" id="logo" name="logo" >
           <span class="error_individual" id="logo_validate"></span>
        </div>
    </div>
    <div class="form-group">
    	<label for="inputEmail3" class="col-sm-2 control-label">Condo Picture</label>
        <div class="col-sm-10">
           <input type="file" class="form-control" id="condoimg" name="condoimg" >
           <span class="error_individual" id="condoimg_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
        <div class="col-sm-10">
           <input type="text" class="form-control" id="address" name="address" placeholder="Address">
        </div>
    </div>
   
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">State</label>
        <div class="col-sm-10">
        <select class="form-control" id="state" name="state">
        	<option value="">Select State</option>
            <?php foreach($states as $state){?>
            	<option value="<?php echo $state['id'];?>"><?php echo $state['name'];?></option>
            <?php }?>
        </select>

        </div>
    </div>
    
     <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Area</label>
        <div class="col-sm-10">
           <select class="form-control" id="areas" name="areas" >
        	<option>Select Area</option>
        </select>
        <span class="error_individual" id="areas_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Post Code</label>
        <div class="col-sm-10">
           <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Post Code">
        </div>
    </div>
    
    
     <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Privacy</label>
        <div class="col-sm-10">
           <select class="form-control" id="privacy" name="privacy" >
        	<option value="1">Public</option>
        	<option value="0">Private</option>
        </select>
        <span class="error_individual" id="areas_validate"></span>
        </div>
    </div>
    
  
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" id="add_condo_btn" name="add_condo_btn" class="btn btn-primary">Add</button>
        </div>
    </div>
</form>
 </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>