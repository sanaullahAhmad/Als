<?php
//Load the library file
require_once 'MOLPay/distribution/InpageMolpay.php';
//Instantiate the library
$molpay = new MOLPay\distribution\InpageMolpay();
$molpay->checkReturn();

//echo $this->load->view('template/MOLPay_header');
//Get
//Define the parameters by using attribute initialize
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

//To get merchant id
$condo_id = $this->session->userdata('condo_id');
$action="condo_id='$this->condo_id' and key_id='merchant_id'";//AND role='1'//as both manager and security will recive email
$get_merchant_row = $this->General_model->get_data_row_using_where('condo_settings', $action);
$get_merchant_id = $get_merchant_row->value;

//To get advertisemt amount
$action_advert="condo_id='$this->condo_id' and key_id='advert'";//AND role='1'//as both manager and security will recive email
$get_merchant_row_advert = $this->General_model->get_data_row_using_where('condo_settings', $action_advert);
$get_advert_amount = $get_merchant_row_advert->value;

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
            <div class="page-title pull-right">
                <a href="<?php echo base_url();?>add_advertisement" class="btn btn-primary pull-right">
                      Add Advertisement
                </a>
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
        <!-- BEGIN PAGE HEADER-->
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="search-page search-content-4">
            
            
            <div class="search-table table-responsive">
                <table class="table table-bordered table-striped table-condensed" id="updates">
                    <thead class="bg-blue">
                                <tr>
                                    <th><a href="javascript:;">Title</a></th>
                                    <th><a href="javascript:;">Link</a></th>
                                    <th><a href="javascript:;">Image</a></th>
                                    <th><a href="javascript:;">Actions</a></th>
                                </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                            <?php
							if(sizeof($adverts)>0)
						 {

                            foreach($adverts as $advert){
                            ?>
                                <!-- Table row -->
                                <tr class="gradeX">
                                     <td class="table-title"><?php echo $advert['title']?></td>
                                      <td class="table-title font-blue"><?php echo $advert['ad_link']?></td>
                                      <td class="table-title"><img src="<?php echo base_url()."uploads/advertisement_images/".$advert['image_url']?>"  width="100" height="100"/></td>
                                      <td class="table-title">
                                      <form action="https://www.onlinepayment.com.my/MOLPay/pay/<?php echo $get_merchant_id;?>/" ​method="POST" ​>
    <input type="hidden" name="amount" value="<?php echo $get_advert_amount;?>">
    <input type="hidden" name="orderid" value="<?php echo time();?>">
    <input type="hidden" name="bill_name" value="<?php echo $molpay->bill_name;?>">
    <input type="hidden" name="bill_email" value="<?php echo $molpay->bill_email;?>">
    <input type="hidden" name="bill_mobile" value="<?php echo $molpay->bill_mobile;?>">
    <input type="hidden" name="bill_desc" value="<?php echo $molpay->bill_description;?>">
    <input type="hidden" name="country" value="<?php echo $molpay->country;?>">
    <input type="hidden" name="vcode" value="<?php echo $molpay->vcode;?>">
    <input type="hidden" name="returnurl" value="<?php echo base_url();?>home/molpay_response/advert/">
    <button class="btn btn-primary" type="submit" name="subreq">Pay Now</button>
</form>
                                     
                                      </td>
                                    
                                </tr>
                                <?php 
								$msg_id	=	$advert['id'];
								} ?>
								<tr>
									<td colspan="5" align="center" id="more<?php echo $msg_id; ?>" class="morebox">
										<a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows(<?php echo $msg_id; ?>)" class="more">
											More
										</a>
									</td>
								</tr>
                                 <?php
							}else{?>
                           <tr >
                              <td colspan="5" align="center">
                                 No Results Found
                              </td>
                          </tr>
                          <?php }?>
                            </tbody>
                        </table>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script type="text/javascript">
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
$(".morebox").html('No more results.');// no results
}

return false;

}
</script>
