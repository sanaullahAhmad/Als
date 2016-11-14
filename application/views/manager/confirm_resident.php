<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Residents
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
              <span>Residents</span>
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
<!-- // Table END -->                                                       
          <form id="edit-update-password-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label">New Password</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="new_password" name="new_password"  >
                        <span class="error_individual" id="new_password_validate"></span>
                    </div>
                </div>
               
                <div class="form-group">
                    <label class="col-sm-2 control-label">Confirm Password</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="confirm_password" name="confirm_password" >
                        <span class="error_individual" id="confirm_password_validate"></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" id="table" name="table" value="residents">
                        <button type="submit"  class="btn btn-primary">Update</button>
                    </div>
                </div>
        </form>
       </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>