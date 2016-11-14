<script src="<?php echo base_url();?>/assets/front/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Vendor
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
              <span>Add Vendor</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
        <form id="addvendor-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    <span class="error_individual" id="name_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Company Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name">
                    <span class="error_individual" id="company_name_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control ckeditor" id="description" name="description" placeholder="Description"></textarea>
                    <span class="error_individual" id="description_validate"></span>
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
                <label class="col-sm-2 control-label">Address</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                    <span class="error_individual" id="address_validate"></span>
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
                <label for="inputEmail3" class="col-sm-2 control-label">State</label>
                <div class="col-sm-10">
                <select class="form-control" id="state" name="state">
                    <option>Select State</option>
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
                </div>
            </div>
           
           
          <div class="form-group">
                <label class="col-sm-2 control-label">Profile Picture</label>
                <div class="col-sm-10">
                    <input type="file"  name="Filedata" id="Filedata" >
                    <span class="error_individual" id="Filedata_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" id="table" name="table" value="admin">
                    <button type="submit" id="add_vendor_btn" name="add_vendor_btn" class="btn btn-primary">Register vendor</button>
                </div>
            </div>
        </form>
         </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>