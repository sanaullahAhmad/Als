
 <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>
                    <?php if(isset($page_title)){ echo $page_title;}?>                                
                </h1>
            </div>
            
            <div class="page-title pull-right">
                <a href="<?php echo base_url()?>quick_pay" class="btn btn-primary pull-right">My Payments</a>

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
                  <div class="portlet light" style="">
                   
                    <div class="portlet-body form">
                     <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-info"> 
                            <?= $this->session->flashdata('message') ?> 
                        </div>
                    <?php } ?>
                    <form class="form-horizontal" role="form"  id="make_payment" method="post">
                        <div class="form-body">
                        
                        	<div class="form-group">
                                <label class="col-md-3 control-label">Payment Type</label>
                                <div class="col-md-9">
                                      <select name="payment_type" id="payment_type" 
                                      class="form-control">
                                      	<option value="">Select Payment Type</option>
                                           <?php 
										   foreach($payment_types as $payment_type){
											   ?>
                                               <option value="<?php echo $payment_type['id']?>">
                                               		<?php echo $payment_type['name']?>
                                               </option>
                                               <?php
										   }
										   ?>                                   	

                                      </select>
                                      <span id="payment_type_validate" class="error_individual help-block"></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Amount (RM)</label>
                                <div class="col-md-9">
                                      <input name="amount" id="amount" 
                                      placeholder="eg. 100.00" class="form-control">
                                      <span id="amount_validate" class="error_individual help-block"></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Processing Fee (RM)</label>
                                <div class="col-md-9">
                                <?php
								$condo_id = $this->session->userdata('condo_id');
								$action="condo_id='$condo_id' and key_id='processing_fee'";
								$get_merchant_row = $this->General_model->get_data_row_using_where('condo_settings', $action);
								if($get_merchant_row){
									$get_processing_fee = $get_merchant_row->value;
								} else {
									$get_processing_fee = 0;
								}
								?>
                                      <input name="processing_fee" id="processing_fee" 
                                      placeholder="Processing Fee" value="<?php echo $get_processing_fee?>" disabled class="form-control">
                                      <span id="processing_fee_validate" class="error_individual help-block"></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Payment Purpose</label>
                                <div class="col-md-9">
                                      <textarea name="reason_payment" id="reason_payment" 
                                      placeholder="eg. Maintenance fee for Jan to Mar 2016" class="form-control"
                                      maxlength="150"></textarea>
                                      <span id="reason_payment_validate" class="error_individual help-block"></span>
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                      <button type="submit" name="reason_payment_submit" id="reason_payment_submit"  class="btn green">Confirm & Pay</button>
                                </div>
                            </div>
                            
                        </div>
                        
                    </form>
                    </div>
                  </div>      
                  
                  <?php
                  		  echo $this->load->view('template/feature_ad');
						  ?>
  
                </div>

                 <?php echo $this->load->view('template/sidebar');?>
                
                
            </div>
        </div>
    </div>
</div>