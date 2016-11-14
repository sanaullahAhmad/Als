<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Contact
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
              <span>Add Contact</span>
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
<form id="add_useful_contact_form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
            <span class="error_individual" id="name_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Phone</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
            <span class="error_individual" id="phone_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            <span class="error_individual" id="email_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Mobile</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile">
            <span class="error_individual" id="mobile_validate"></span>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Website</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="website" name="website" placeholder="Website">
            <span class="error_individual" id="website_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Waze</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="waze" name="waze" placeholder="Waze">
            <span class="error_individual" id="waze_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Google map link</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="google_map_link" name="google_map_link" placeholder="Google Map Link">
            <span class="error_individual" id="google_map_link_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Address</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="address" name="address" placeholder="Address">
            <span class="error_individual" id="address_validate"></span>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Status</label>
        <div class="col-sm-10">
            <select class="form-control" id="status" name="status">
            	<option value="1">Active</option>
            	<option value="2">Inactive</option>
            </select>
            <span class="error_individual" id="status_validate"></span>
        </div>
    </div>
   
  
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" id="add_contact_btn" name="add_contact_btn" class="btn btn-primary">Add Contact</button>
        </div>
    </div>
</form>
       </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>