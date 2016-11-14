<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Processing Fee
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
              <span>Processing Fee</span>
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
                                                             
            <form id="addblock-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Processing Fee</label>
                    <div class="col-sm-10">
                    <?php
					$check_processing_fee = $this->General_model->get_data_row_using_where("condo_settings", 
			"condo_id='$this->condo_id' and key_id='processing_fee'");
			$fee = $check_processing_fee->value;
					?>
                        <input type="text" class="form-control" id="processing_fee" name="processing_fee" placeholder="Processing Fee" value="<?php echo $fee;?>">
                        <span class="error_individual" id="name_validate"></span>
                    </div>
                </div>
               
                
                
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" id="table" name="table" value="blocks">
                        <button type="submit" id="add_processing_fee" name="add_processing_fee" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
      </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>