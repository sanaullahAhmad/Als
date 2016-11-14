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
<div class="widget">
	<div class="widget-head">
		<h4 class="heading">Contacts</h4>
	</div>
	<div class="widget-body innerAll inner-2x">												
        
        <table  class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="genral">
          <thead><!-- class="bg-blue"-->
              <tr class="tr-green-bg">
                  <th class="all">Payment Type</th>
                  <th class="all">Payment Purpose</th>
                  <th class="min-phone-l">Amount (RM)</th>
                  <th class="min-phone-l">Date</th>
                  <th class="min-phone-l">Status</th>
                  <th class="min-phone-l">Resident Name</th>
                  <th class="min-tablet">Unit Info</th>
                 
              </tr>
          </thead>
          <tbody>
               <?php
               if(sizeof($payments)>0)
               {
                  foreach($payments as $payment)
                  {
					  $inv_id = $payment['id'];
               ?>
                  <tr>
                      <td><?php echo $this->General_model->get_value_by_id('payment_for',
                      $payment['payment_for'],'name');?></td>

                      <td><?php echo $this->General_model->
											get_data_value_using_where("invoice_items",
											"invoice_id='$inv_id' and description != 'Processing Fee'",'description');?></td>
                      <td><?php echo $payment['amount_paid'];?></td>
                      <td><?php echo date('j M Y',strtotime($payment['date_created']));?></td>
                      <td><?php 
                       if($payment['payment_status']== 1){ 
                           ?>
                              <a target="_blank" href="<?php echo base_url()?>view_invoice/<?php echo $this->encrypt_model->encode($payment['id'])?>">View Receipt</a>
                              <?php
                         } else { 
                                echo "Not Paid";
                            }
                      ?></td>
                      <td><?php echo $this->General_model->get_value_by_id('residents', $payment['payer_id'], 'name'); ?></td>
                       <td>
					   <?php echo $this->General_model->get_value_by_id('blocks', $this->General_model->get_value_by_id('residents', $payment['payer_id'], 'block'),'name').'-'.$this->General_model->get_value_by_id('residents', $payment['payer_id'], 'floor').'-'.$this->General_model->get_value_by_id('residents', $payment['payer_id'], 'unit');?>
                       </td>
                  </tr>
                  <?php 
                 }
              }?>
          </tbody>
      </table>
	</div>
</div>	
		 </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>