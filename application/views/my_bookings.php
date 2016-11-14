<?php
//Load the library file
require_once 'MOLPay/distribution/InpageMolpay.php';
//Instantiate the library
$molpay = new MOLPay\distribution\InpageMolpay();
$molpay->checkReturn();
?>

<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>
                    <?php if(isset($title)){ echo $title;}?>                                
                </h1>
            </div>
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE CONTENT BODY -->
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="page-content-inner">
              <div class="left-post">
			  <?php if ($this->session->flashdata('message')) { ?>
                  <div class="alert alert-info"> 
                      <?= $this->session->flashdata('message') ?> 
                  </div>
              <?php } ?>
          
                  <!-- BEGIN PAGE HEADER-->
                  <!-- END PAGE TITLE-->
                  <!-- END PAGE HEADER-->
                  <div class="search-page search-content-4">
                     <div class="portlet light ">
                       <div class="portlet-body">
                           <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="genral">
                              <thead class="bg-blue">
                                  <tr>
                                      <th><a href="javascript:;">Facility Name</a></th>
                                      <th><a href="javascript:;">Booking Date</a></th>
                                      <th><a href="javascript:;">Session Time</a></th>
                                      <!--<th><a href="javascript:;">To</a></th>
          <th><a href="javascript:;">Session</a></th>-->                                    
                                      <th><a href="javascript:;">Status</a></th>
                                      <th><a href="javascript:;">Action</a></th>
                                      
                                  </tr>
                              </thead>
                              <!-- // Table heading END -->
                              <!-- Table body -->
                              <tbody>
                                 <?php
                                  if(sizeof($my_bookings)>0)
                                   {
                                      foreach($my_bookings as $payment)
                                      {
                                      ?>
                                          <!-- Table row -->
                                          <tr class="gradeX">
                                               <td class="table-title"><?php echo $this->General_model->get_data_value_using_where('condo_facilities',"id=".$payment['facility_id'],'name');?></td>
                                                <td class="table-title"><?php echo date('M d Y h:i A', strtotime($payment['datetime_booked']))?></td>
                                                <td class="table-title font-blue">
                                                <?php echo date('M d', strtotime($payment['bookedfor_datetime_from']))?> (<?php echo date('H:i', strtotime($this->General_model->get_value_by_id('day_slots', $payment['slot_id'], 'start_time')));?> -
    <?php echo date('H:i', strtotime($this->General_model->get_value_by_id('day_slots', $payment['slot_id'], 'end_time')));?>                                            
                                                )</td>
                                                <!--<td class="table-title font-blue"><?php echo date('M d h:i A', strtotime($payment['bookedfor_datetime_to']))?></td>	-->
          <!--                                      <td class="table-title"><?php echo date('hA', strtotime($this->General_model->get_data_value_using_where('condo_facilities',"id=".$payment['facility_id'],'opening_hour')))?>-<?php echo date('hA', strtotime($this->General_model->get_data_value_using_where('condo_facilities',"id=".$payment['facility_id'],'closing_hour')))?></td>
          -->                                   <td class="table-title">
		  <?php if($this->General_model->get_data_value_using_where('invoices',"booking_id=".$payment['id'],'payment_status')==0){
			  echo "Pending";
		} else if($this->General_model->get_data_value_using_where('invoices',"booking_id=".$payment['id'],'payment_status')==3){
			echo 'Disapproved';
		} else { echo "Confirmed";}?></td>	
                                                <td class="table-title"><?php 
												 if($this->General_model->get_data_value_using_where('invoices',"booking_id=".$payment['id'],'payment_status')==3){
													 echo 'N/A';
												 }
                                                else if($this->General_model->get_data_value_using_where('invoices',"booking_id=".$payment['id'],'payment_status')==1 
												&&
			($this->General_model->get_data_value_using_where('invoices',"booking_id=".$payment['id'],'payment_channel')=='MOLPAY' || $this->General_model->get_data_value_using_where('invoices',"booking_id=".$payment['id'],'payment_channel')=='Manual Payment' )
												
												){
													$to_encrypt_invid = $this->General_model
													->get_data_value_using_where('invoices',"booking_id=".$payment['id'],'id')?>
                                                    
<a title="View Receipt" target="_blank" href="<?php echo base_url()?>view_invoice/<?php echo $this->encrypt_model->encode($to_encrypt_invid)?>" class="btn btn-icon-only blue">
    <i class="fa fa-file-o"></i>
</a>
                                                    <?php
                                                    } else if($this->General_model->get_data_value_using_where('invoices',"booking_id=".$payment['id'],'payment_status')==0 && $this->General_model->get_data_value_using_where('invoices',"booking_id=".$payment['id'],'payment_channel')=='Manual Payment') { 
													
													echo 'N/A';
													} else {
													
													$to_encrypt_invid = $this->General_model
													->get_data_value_using_where('invoices',"booking_id=".$payment['id'],'id');
													
													//Get Resident ID
$get_resident_id = $this->General_model->get_value_by_id('invoices', $to_encrypt_invid, 'payer_id');
//$get_facility_id = $this->General_model->get_value_by_id('invoices', $this->session->userdata('invoice_id'), 'facility_id');
$get_booking_id = $this->General_model->get_value_by_id('invoices', $to_encrypt_invid, 'booking_id');
$get_order_id = $this->General_model->get_value_by_id('invoices', $to_encrypt_invid, 'system_transaction_id');
													//Define the parameters by using attribute initialize
$molpay->amount = $this->General_model->get_value_by_id('invoices', $to_encrypt_invid, 'amount_paid');
$molpay->bill_name = 'MOLPay demo';
$molpay->bill_email = 'demo@molpay.com';
$molpay->bill_mobile = '0355218438';
$molpay->bill_description = 'testing by MOLPay';
$molpay->country = 'MY';

$molpay->vcode = 'e1d4bf3aa8dfd96f7bd89aefdd1e9be6';
$molpay->currency = 'MYR';
$molpay->langcode = 'en';
/*$molpay->payment_type = 'fpx.php';
*/
$condo_id = $this->session->userdata('condo_id');
$action="condo_id='$this->condo_id' and key_id='merchant_id'";//AND role='1'//as both manager and security will recive email
$get_merchant_row = $this->General_model->get_data_row_using_where('condo_settings', $action);
if($get_merchant_row){
	$get_merchant_id = $get_merchant_row->value;
} else {
	$get_merchant_id = 0;
}
 ?>
 <form action="https://www.onlinepayment.com.my/MOLPay/pay/<?php echo $get_merchant_id;?>/" ​method="POST" ​>
          <input type="hidden" name="amount" value="<?php if(isset($molpay->amount)) echo $molpay->amount; else 0;?>">
          <input type="hidden" name="orderid" value="<?php echo $get_order_id;?>">
          <input type="hidden" name="bill_name" value="<?php echo $molpay->bill_name;?>">
          <input type="hidden" name="bill_email" value="<?php echo $molpay->bill_email;?>">
          <input type="hidden" name="bill_mobile" value="<?php echo $molpay->bill_mobile;?>">
          <input type="hidden" name="bill_desc" value="<?php echo $molpay->bill_description;?>">
          <input type="hidden" name="country" value="<?php echo $molpay->country;?>">
          <input type="hidden" name="vcode" value="<?php echo $molpay->vcode;?>">
<input type="hidden" name="returnurl" value="<?php echo base_url();?>molpay_response/facility/<?php echo  $to_encrypt_invid;?>">
          <button class="btn btn-icon-only blue" title="Pay Online" type="submit" name="subreq"><i class="fa fa-credit-card"></i></button>
      </form>
 
 
                                                 <?php }
												 
												 ?></td>	
                                          </tr>
                                          <?php
                                          }
                                      }?>
                                      </tbody>
                                  </table>
                              
                          </div>
                      </div>
                      
                       <?php
			  echo $this->load->view('template/feature_ad');
			  ?>
              
                  </div>
              </div>
			  <?php echo $this->load->view('template/sidebar');?> 
        </div>
    </div>    
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Vendor Comming Time</h4>
      </div> 
      <form method="POST" id="add-facility-booking" class="form-horizontal" >   
      <div class="modal-body">
       
            <input type="hidden" name="quote_id" id="quote_id" value="" />   
              <div class="form-body">
              <div class="form-group">
                  <label class="col-md-3 control-label">Arival Date time</label>
                  <div class="col-md-9">
                      <input type="text" class="form-control datetimepicker" id="arivaldatetime" name="arivaldatetime" >
                      <span id="enddatetime_validate" class="error_individual help-block"></span>
                  </div>
              </div>
           </div>
      </div>
      
      <div class="modal-footer">
        <button  class="btn btn-default" type="submit" name="arival_datetime_btn">Submit</button>
      </div>
      </form>
    </div>

  </div>
</div>
<style>
label.error
{
    width:100% !important
}
</style>
<!--<script type="text/javascript">
$('.datetimepicker').datetimepicker({
    locale: 'en',
    widgetPositioning: {
        vertical: 'top',
        horizontal: 'left'
    }
});  
function more_rows(ID) 
	{
	if(ID)
	{
		$("#more"+ID).html('<img src="<?php echo base_url()?>assets/admin/images/loading.gif" width="32" height="32"/>');
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>home/service_quotes_viewajax",
			data: "lastmsg="+ ID, 
			cache: false,
			success: function(html){
			$("#updates").append(html);
			$("#more"+ID).remove(); // removing old more button
			}
		});
	}
	else
	{
	$(".morebox").html('No more quotes');// no results
	}
	
	return false;
	
}
</script>-->
