<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Block
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
              <span>Add Block</span>
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
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" >
                    <span class="error_individual" id="name_validate"></span>
                </div>
            </div>
           
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Floor</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="floors" name="floors" placeholder="No. of Floors"  >
                    <span class="error_individual" id="floors_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Units</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="units" name="units" placeholder="No. of Units"  >
                    <span class="error_individual" id="units_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" id="table" name="table" value="blocks">
                    <button type="submit" id="add_block_btn" name="add_block_btn" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
	   </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>