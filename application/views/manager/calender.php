<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Facility Calender
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
              <span>Facility Calender</span>
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
                <div class="row">
                    <div class="col-md-12">
                	<div style="float:left; margin-right:20px;"><strong>Booking Status: </strong></div>
                    <div class="calender_legends" style="background:#378006"></div>
                	<div style="float:left;">Booked</div>
                                        <div class="calender_legends"></div>On Hold

                </div>
                    <div class="col-md-12">
                        <div id='calendar'></div>
                    </div>
                </div>
                <style>
				.calender_legends{
					width: 30px;
					height: 25px;
					background: #FF1493;
					border-radius: 5px;
					border-radius: 5px;
					float: left;
					color: #fff;
					text-align: center;
					margin: 0 10px 10px 5px;
					display: inline-block;
					}
				</style>
        </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>