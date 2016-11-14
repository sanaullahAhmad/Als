<?php
//Load the library file
require_once 'MOLPay/distribution/InpageMolpay.php';
//Instantiate the library
$molpay = new MOLPay\distribution\InpageMolpay();
$molpay->checkReturn();

//echo $this->load->view('template/MOLPay_header');
//Get
//Define the parameters by using attribute initialize
$molpay->amount = $this->General_model->get_value_by_id('invoices', $this->session->userdata('justpay_invoice_id'), 'amount_paid');
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
$get_merchant_id = $get_merchant_row->value;

//Get Resident ID
$get_resident_id = $this->General_model->get_value_by_id('invoices', $this->session->userdata('justpay_invoice_id'), 'payer_id');
?>

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
            
            <div class="page-title pull-right">
                <a href="<?php echo base_url()?>quick_pay" class="btn btn-primary pull-right">Quick Pay</a>

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
                  <div class="portlet light" style="min-height:479px;">
                   
                    <div class="portlet-body form">
                     <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-info"> 
                            <?= $this->session->flashdata('message') ?> 
                        </div>
                    <?php } ?>
                    
                    <?php
					//Fetch Invoice Details
					$justpay_invoice_id = $this->session->userdata('justpay_invoice_id');					
					$action="id='$justpay_invoice_id'";
					$invoice_detail = $this->General_model->get_data_row_using_where('invoices', $action);
					$amount = $invoice_detail->amount_paid;
					$transaction_info = $invoice_detail->transaction_info;
					$order_id = $invoice_detail->system_transaction_id;
					?>
                    
                    
                    <div class="row">
                               
                                        
                                <div class="col-xs-12 ">
                                <div class="portlet-body">

                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th> Payment Purpose </th>
                                                    <th> Amount (RM)</th>
                                                    <th> Total (RM)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
            $action="invoice_id=".$this->session->userdata('justpay_invoice_id');
            $transactions = $this->General_model->get_data_all_like_using_where('invoice_items', $action);
            foreach($transactions as $transaction){	
                ?>
                    <tr>
                         <td><?php
                                  echo $transaction['description'];
                          ?> </td>
 
                        <td> <?php echo number_format($transaction['amount'],2);?> </td>
                        <td> <?php 
                        echo number_format($transaction['amount'],2);
                        ?>
                         </td>
                    </tr>
                <?php
            }
            ?>
                                             
                                              <tr>
                         <td colspan="2"><strong>Grand Total</strong> </td>
 
                        <td> <?php echo number_format($this->General_model->get_value_by_id('invoices',$this->session->userdata('justpay_invoice_id'),'amount_paid'),2);?> </td>
                     
                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                           
                        </div>
                    </div>
                    
                    
                    
                   

                    
                    <div class="row pull-right">
                                <div class="col-xs-12">
                                 <form action="https://www.onlinepayment.com.my/MOLPay/pay/<?php echo $get_merchant_id;?>/" 
                                  id="molpayresubmitform12" ​method="POST" ​>
                                      <input type="hidden" name="amount" value="<?php if(isset($molpay->amount)) echo $molpay->amount; else 0;?>">
                                      <input type="hidden" name="orderid" value="<?php echo $order_id;?>">
                                      <input type="hidden" name="bill_name" value="<?php echo $molpay->bill_name;?>">
                                      <input type="hidden" name="bill_email" value="<?php echo $molpay->bill_email;?>">
                                      <input type="hidden" name="bill_mobile" value="<?php echo $molpay->bill_mobile;?>">
                                      <input type="hidden" name="bill_desc" value="<?php echo $molpay->bill_description;?>">
                                      <input type="hidden" name="country" value="<?php echo $molpay->country;?>">
                                      <input type="hidden" name="vcode" value="<?php echo $molpay->vcode;?>">
                                      <input type="hidden" name="returnurl" value="<?php echo base_url();?>molpay_response/just_pay/<?php echo $this->encrypt_model->encode($this->session->userdata('justpay_invoice_id'));?>">
                                      <button class="btn green" name="reason_payment_submit" id="reason_payment_submit" style="margin-right: 5px;" type="submit" name="subreq">Pay Now</button>
                                  </form>

                                   
                                    
                                </div>
                            </div>

                    
                    <!--<div class="form-horizontal">
                        <div class="form-body">
                        
                            <div class="form-group">
                                <label class="col-md-3 control-label">Amount</label>
                                <div class="col-md-9">
                                      <input name="amount" id="amount" disabled  value="<?php echo $amount?>"
                                      placeholder="Amount" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Processing Fee</label>
                                <div class="col-md-9">
                                <?php
								$condo_id = $this->session->userdata('condo_id');
								$action="condo_id='$this->condo_id' and key_id='processing_fee'";
								$get_merchant_row = $this->General_model->get_data_row_using_where('condo_settings', $action);
								if($get_merchant_row){
									$get_processing_fee = $get_merchant_row->value;
								} else {
									$get_processing_fee = 0;
								}
								?>
                                      <input name="processing_fee" id="processing_fee" 
                                      placeholder="Processing Fee" value="<?php echo $get_processing_fee?>" disabled class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Payment Purpose</label>
                                <div class="col-md-9">
                                      <textarea name="reason_payment" id="reason_payment" disabled  
                                      placeholder="Please tell us for what purpose you are making a payment" class="form-control"><?php echo $transaction_info?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Total Amount</label>
                                <div class="col-md-9">
                                      <input name="total_amount" id="total_amount" 
                                      placeholder="Total Amount" value="<?php echo $amount+$get_processing_fee?>" disabled class="form-control">

                            </div>

                            
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                 <form action="https://www.onlinepayment.com.my/MOLPay/pay/<?php echo $get_merchant_id;?>/" 
                                  id="molpayresubmitform12" ​method="POST" ​>
                                      <input type="hidden" name="amount" value="<?php if(isset($molpay->amount)) echo $molpay->amount; else 0;?>">
                                      <input type="hidden" name="orderid" value="<?php echo $order_id;?>">
                                      <input type="hidden" name="bill_name" value="<?php echo $molpay->bill_name;?>">
                                      <input type="hidden" name="bill_email" value="<?php echo $molpay->bill_email;?>">
                                      <input type="hidden" name="bill_mobile" value="<?php echo $molpay->bill_mobile;?>">
                                      <input type="hidden" name="bill_desc" value="<?php echo $molpay->bill_description;?>">
                                      <input type="hidden" name="country" value="<?php echo $molpay->country;?>">
                                      <input type="hidden" name="vcode" value="<?php echo $molpay->vcode;?>">
                                      <input type="hidden" name="returnurl" value="<?php echo base_url();?>home/molpay_response/just_pay/<?php echo $this->encrypt_model->encode($this->session->userdata('justpay_invoice_id'));?>">
                                      <button class="btn green" name="reason_payment_submit" id="reason_payment_submit" style="margin-right: 5px;" type="submit" name="subreq">Pay Now</button>
                                  </form>

                                   
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>-->
                  </div>        
                </div>

                
                
            </div>
            
                             <?php echo $this->load->view('template/sidebar');?>

        </div>
    </div>
</div>