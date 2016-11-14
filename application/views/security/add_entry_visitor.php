<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Entry Visitor
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
              <span>Add Entry Visitor</span>
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

        <form id="addentry-visitor" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="resident_del_vis_id" value="<?php echo $this->session->userdata('resident_del_vis_id');?>" />
            <div class="form-group">
                <label class="col-sm-2 control-label">Visitor Name</label>
                <div class="col-sm-10">
                    <input type="text" id="visitor_name" name="visitor_name" placeholder="Name" class="form-control">
                    <span class="error_individual" id="visitor_name_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea name="description" id="description" placeholder="Description"  class="form-control"></textarea>
                    <span class="error_individual" id="description_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Date</label>
                <div class="col-sm-10">
                   <input type="text" id="datepicker1" name="date"  class="form-control datepicker">
                    <span class="error_individual" id="date_validate"></span>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Time</label>
                <div class="col-sm-10 bootstrap-timepicker">
                    <input type="text" id="timepicker1" name="time" value="<?php echo date('h:i A');?>" class="form-control">
                    <span class="error_individual" id="time_validate"></span>
                </div>
            </div>
            
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Vehicle No.</label>
                <div class="col-sm-10">
                   <input type="text"  id="vehicle_no" name="vehicle_no" placeholder="Vehicle Number" class="form-control">
                    <span class="error_individual" id="vehicle_no_validate"></span>
                </div>
            </div>
           
          
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" id="addvisitersubmit" name="addvisitersubmit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
		</div>
       </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>