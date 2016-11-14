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
        <?php } ?>
<?php 
if($last_sms_id != ''){
	echo $last_sms_id.' - Message Sent!';
}?>
	<form id="sendsms-form" class="form-horizontal" role="form" method="POST" >
    <div class="form-group">
        <label class="col-sm-2 control-label">Number</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="number" name="number" placeholder="Number">
            <span class="error_individual" id="number_validate"></span>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" id="send_sms_btn" name="send_sms_btn" class="btn btn-primary">Send SMS</button>
        </div>
    </div>
</form>
		 </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>