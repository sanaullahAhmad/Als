<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"><?php echo $title;?>
      <small></small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>manager">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span><?php echo $title;?></span>
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
        <?php } 
              if(isset($error_message))
              {
                  ?>
                  <div class="alert alert-warning">
                    <strong>Warning!</strong> <?php echo $error_message;?>
                  </div>
                  <?php
              }
              ?>
               <!-- BEGIN FORM-->
                <form id="importresidents-form" method="POST" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url()?>manager/import_residents">
                <div class="controls controls-row import-page">
                
                
                
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Select a CSV file</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="filetoupload" name="filetoupload" >
                        <span class="error_individual" id="filetoupload_validate"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="submit" name="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
                 
                    
				</div>
                </form>
             <!-- END FORM--> 
             <table class="table table-striped table-bordered table-hover table-full-width">
           <?php echo $import_residents;?>
           </table>

		 </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>