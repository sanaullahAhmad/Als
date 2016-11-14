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
			$nowtime = date('Y-m-d H:i:s',time() - 1800);
            $payments= $this->General_model->get_data_all_like_using_where('facility_booking', " condo_id=".$this->condo_id." AND datetime_booked >= '$nowtime' AND id IN(select booking_id from invoices where payment_status=0)");
			?>
            <div class="widget">
                <div class="widget-head">
                    <h4 class="heading">Payments</h4>
                </div>
                <div class="widget-body innerAll inner-2x">
                <table class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
                    <thead class="bg-blue">
                                <tr>
                                    <th><a href="javascript:;">Facility</a></th>
                                    <th><a href="javascript:;">Booking Date</a></th>
                                    <th><a href="javascript:;">To</a></th>
<!--                                    <th><a href="javascript:;">Actions</a></th>
-->                                </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                            <?php
                            foreach($payments as $payment)
							{
                            ?>
                                <!-- Table row -->
                                <tr class="gradeX">
                                     <td class="table-title"><?php echo $this->General_model->get_data_value_using_where('condo_facilities',"id=".$payment['facility_id'],'name');?></td>
                                      <td class="table-title font-blue"><?php echo $payment['bookedfor_datetime_from']?></td>
                                     <!-- <td class="table-title font-blue"><?php echo $payment['bookedfor_datetime_to']?></td>	-->
                                      <!--<td class="table-title">
                                      <form method="POST" action="<?php echo base_url();?>manager/manual_payment">
                                          <input type="hidden" name="invoice_id" value="<?php echo $this->General_model->get_data_value_using_where('facility_invoice',"booking_id=".$payment['id'],'id');?>" />
                                          <input type="hidden" name="facility_booking_id" value="<?php echo $payment['id'];?>" />
                                          <button type="submit" name="manual_payment_btn" class="btn btn-primary pull-right">Manual Payment</button>
                                        </form>
                                      </td>-->
                                    
                                </tr>
                                <?php 
								} ?>
								
                            </tbody>
                        </table>
                      </div>
                  </div>										
             </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>