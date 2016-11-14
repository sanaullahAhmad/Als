<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Entry Dellivery
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
              <span>Add Entry Dellivery</span>
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
        <form id="addentry-delivery" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="resident_del_vis_id" value="<?php echo $this->session->userdata('resident_del_vis_id');?>" />
           
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Delivery Details</label>
                <div class="col-sm-10">
                    <textarea name="description" id="description" placeholder="Description"  class="form-control"></textarea>
                    <span class="error_individual" id="description_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Driver Name</label>
                <div class="col-sm-10">
                   <input type="text" id="driver_name" name="driver_name" class="form-control">
                    <span class="error_individual" id="driver_name_validate"></span>
                </div>
            </div>
            
            
             <div class="form-group">
                <label class="col-sm-2 control-label">IC/ID number</label>
                <div class="col-sm-10">
                    <input type="text" id="icid_number" name="icid_number" placeholder="IC/ID number" class="form-control">
                    <span class="error_individual" id="icid_number_validate"></span>
                </div>
            </div>
            
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Company Name</label>
                <div class="col-sm-10">
                   <input type="text" id="company_name" name="company_name" placeholder="Company Name" class="form-control">
                    <span class="error_individual" id="vehicle_company_name"></span>
                </div>
            </div>
           
          
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" id="adddeliverysubmit" name="adddeliverysubmit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
 		</div>
       </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>