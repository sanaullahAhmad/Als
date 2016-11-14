<meta http-equiv="refresh" content="1680; url=<?php echo base_url()?>add_facility_booking/">
<?php
//Load the library file
require_once 'MOLPay/distribution/InpageMolpay.php';
//Instantiate the library
$molpay = new MOLPay\distribution\InpageMolpay();
$molpay->checkReturn();

//echo $this->load->view('template/MOLPay_header');
//Get
//Define the parameters by using attribute initialize
$molpay->amount = $this->General_model->get_value_by_id('invoices', $this->session->userdata('facility_invoice_id'), 'amount_paid');
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
 

//Get Resident ID
$get_resident_id = $this->General_model->get_value_by_id('invoices', $this->session->userdata('facility_invoice_id'), 'payer_id');
//$get_facility_id = $this->General_model->get_value_by_id('invoices', $this->session->userdata('invoice_id'), 'facility_id');
$get_booking_id = $this->General_model->get_value_by_id('invoices', $this->session->userdata('facility_invoice_id'), 'booking_id');
$get_order_id = $this->General_model->get_value_by_id('invoices', $this->session->userdata('facility_invoice_id'), 'system_transaction_id');

?>

<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/search.min.css" />
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
			<?php if ($this->session->flashdata('message')) { ?>
                <div class="alert alert-info"> 
                    <?= $this->session->flashdata('message') ?> 
                </div>
            <?php } ?>
        <div class="page-content">
          <div class="page-content-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- Begin: life time stats -->
                    <div class="portlet light portlet-fit portlet-datatable ">
                      <div class="portlet-body">
                            <div class="alert alert-danger">
                              <strong>Attention!</strong> Your booking will not be confirmed until you make a payment. Your slot will be released to other residents if you fail to make payment within the next 30 minutes.
                            </div>      
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="portlet yellow-crusta box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                Order Details </div>
                                            
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Order #: </div>
                                                <div class="col-md-7 value"> 
                                                    <?php echo $this->General_model->get_value_by_id('invoices', $this->session->userdata('facility_invoice_id'), 'system_transaction_id');?>
                                                 </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Order Date & Time: </div>
                                                <div class="col-md-7 value"> 
                                                <?php echo date('d M Y h:i A', strtotime($this->General_model->get_value_by_id('invoices', $this->session->userdata('facility_invoice_id'), 'date_created')));?></div>
                                            </div>
                                            <div class="row static-info">
                                            <div class="col-md-5 name"> Order Status: </div>
                                            <div class="col-md-7 value">
                                                <span class="label label-danger"> Not Paid </span>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Grand Total: </div>
                                            <div class="col-md-7 value"> 
                                            RM<?php echo number_format($this->General_model->get_value_by_id('invoices', $this->session->userdata('facility_invoice_id'), 'amount_paid'),2)?> </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="portlet yellow-crusta box">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            Customer Information </div>
                                        
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Customer Name: </div>
                                            <div class="col-md-7 value"> <?php echo $this->General_model->get_value_by_id('residents', $get_resident_id, 'name')?> </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Email: </div>
                                            <div class="col-md-7 value"> <?php echo $this->General_model->get_value_by_id('residents', $get_resident_id, 'email')?> </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Unit Info: </div>
                                            <div class="col-md-7 value"> 
                                             <?php 
                                             $block_id = $this->General_model->get_value_by_id('residents',$get_resident_id,'block');
                                             echo $this->General_model->get_value_by_id('blocks',$block_id,'name')?>-<?php echo $this->General_model->get_value_by_id('residents',$get_resident_id,'floor')?>-<?php echo $this->General_model->get_value_by_id('residents',$get_resident_id,'unit')?>
    
                                             </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Phone Number: </div>
                                            <div class="col-md-7 value"> <?php echo $this->General_model->get_value_by_id('residents', $get_resident_id, 'phone')?> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="portlet yellow-crusta box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                Transaction Details </div>
                                            
                                        </div>
                                <div class="portlet-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th> Description </th>
                                                    <th> Total (RM)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
			$booking_id=$this->General_model->get_value_by_id('invoices',$this->session->userdata('facility_invoice_id'),'booking_id');
			$facility_id=$this->General_model->get_value_by_id('facility_booking',$booking_id,'facility_id');
            $action="invoice_id=".$this->session->userdata('facility_invoice_id');
            $transactions = $this->General_model->get_data_all_like_using_where('invoice_items', $action);
            foreach($transactions as $transaction){	
                ?>
                    <tr>
                         <td> <?php											     
								echo $transaction['description'];      
                        ?> </td>
                        <td> <?php 
                        echo number_format($transaction['amount'],2);
                        ?>
                         </td>
                    </tr>
                <?php
            }
            ?>
                                             
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            <div class="row">
                                <div class="col-md-6"> </div>
                                <div class="col-md-6">
                                    <div class="well">
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Sub Total: </div>
                                            <div class="col-md-3 value"> 
                                            <?php
                                            //Calculate Sub Total
                                            echo 'RM'.number_format($this->General_model->get_value_by_id('invoices', $this->session->userdata('facility_invoice_id'), 'amount_paid'),2);
                                            ?>
                                             </div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> GST %: </div>
                                            <div class="col-md-3 value"> <?php 
                                            echo 'RM'.number_format($this->General_model->get_value_by_id('invoices', $this->session->userdata('facility_invoice_id'), 'amount_paid') * 0.06,2);
                                            ?> </div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Grand Total: </div>
                                            <div class="col-md-3 value"> 
                                                <?php
                                            //Calculate Grand Total
                                            echo 'RM'.number_format($this->General_model->get_value_by_id('invoices', $this->session->userdata('facility_invoice_id'), 'amount_paid'),2);
                                            
                                            ?>
            
                                             </div>
                                        </div>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                               <div class="col-lg-12 pull-right">
                               <a href="#" class="btn green pull-right" data-toggle="modal" data-target="#myModal" onclick="check_office_timings(<?php echo $get_booking_id;?>)">Manual Payment</a>
                                 <!-- <form method="POST" action="<?php echo base_url();?>manual_payment">
                                      <input type="hidden" name="invoice_id" value="<?php echo $this->session->userdata('invoice_id');?>" />
                                      <input type="hidden" name="facility_booking_id" 
                                      value="<?php echo $this->session->userdata('facility_booking_id');?>" />
                                      <button type="submit" name="manual_payment_btn" class="btn green pull-right">Manual Payment</button>
                                  </form>
                                  -->
                                  <!--if deposit_required than don't show online payment option-->
                                 <?php if($this->General_model->get_value_by_id('condo_facilities',$facility_id,'is_deposit_required')=='0'){?>
                                  <form action="https://www.onlinepayment.com.my/MOLPay/pay/<?php echo $get_merchant_id;?>/" 
                                  id="molpayresubmitform" ​method="POST" ​>
                                      <input type="hidden" name="amount" value="<?php if(isset($molpay->amount)) echo $molpay->amount; else 0;?>">
                                      <input type="hidden" name="orderid" value="<?php echo $get_order_id;?>">
                                      <input type="hidden" name="bill_name" value="<?php echo $molpay->bill_name;?>">
                                      <input type="hidden" name="bill_email" value="<?php echo $molpay->bill_email;?>">
                                      <input type="hidden" name="bill_mobile" value="<?php echo $molpay->bill_mobile;?>">
                                      <input type="hidden" name="bill_desc" value="<?php echo $molpay->bill_description;?>">
                                      <input type="hidden" name="country" value="<?php echo $molpay->country;?>">
                                      <input type="hidden" name="vcode" value="<?php echo $molpay->vcode;?>">
 									  <input type="hidden" name="returnurl" 
                                      value="<?php echo base_url();?>molpay_response/facility/<?php echo $this->encrypt_model->encode($this->session->userdata('facility_invoice_id'));?>">
                                      <button class="btn green pull-right" style="margin-right: 5px;" type="submit" name="subreq" onclick="pay_online_email('<?php echo $this->General_model->get_value_by_id('invoices', $this->session->userdata('facility_invoice_id'), 'amount_paid');?>')">
                                      	Pay Online
                                      </button>
                                  </form>
                                  <?php }?>
                              </div>
                              <!--  <form method="POST">
                              <input type="hidden" name="invoice_id" value="<?php echo $this->session->userdata('invoice_id');?>" />
                              <input type="hidden" name="facility_booking_id" value="<?php echo $this->session->userdata('facility_booking_id');?>" />
                              <button type="submit" name="proced_to_payment" class="btn btn-primary">Proceed to Payment</button>
                              </form>-->
                          </div>
                      </div>
                   </div>
                 </div>
               </div>
          </div>
       </div>
      </div>
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
        <h4 class="modal-title">Manual Payment</h4>
      </div>
      <div class="modal-body alertmessage">
        <div class="alert alert-info">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
function molpayCloseFrames(){
	jQuery( "#molpayframe" ).remove();
	jQuery( "#molpayresubmitform" ).submit();
}

function check_office_timings(booking_id)
{
	//$(".alertmessage").hide();
	$.ajax({
	type: "POST",
	data: "booking_id="+ booking_id, 
	url: "<?php echo base_url();?>home/check_office_timings",
	cache: false,
	success: function(res){
		//$(".alertmessage").show();
		$(".alertmessage").html(res);
		setTimeout(function(){ window.location.href='<?php echo base_url();?>home/my_bookings' }, 10000);
	  }
	});
}
function pay_online_email(amount)
{
	//$(".alertmessage").hide();
	$.ajax({
	type: "POST",
	data: "amount="+ amount, 
	url: "<?php echo base_url();?>home/pay_online_email",
	cache: false,
	success: function(res){
		//$(".alertmessage").show();
	  }
	});
}
function more_rows(ID) 
{
if(ID)
{
$("#more"+ID).html('<img src="<?php echo base_url()?>assets/admin/images/loading.gif" width="32" height="32"/>');

$.ajax({
type: "POST",
url: "<?php echo base_url();?>home/payment_viewajax",
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
$(".morebox").html('The End');// no results
}
return false;
}
</script>
