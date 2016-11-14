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
        <!-- BEGIN PAGE HEADER-->
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="search-page search-content-4">
            <div class="search-bar bordered">
                <div class="row">
                    <div class="col-lg-6 extra-buttons">
                        <form method="POST" id="manual-payment" enctype="multipart/form-data">
                          <input type="hidden" name="invoice_id" value="<?php echo $this->session->userdata('invoice_id');?>" />
                          <input type="hidden" name="facility_booking_id" value="<?php echo $this->session->userdata('facility_booking_id');?>" />
                          <input type="file" name="manual_receipt" id="manual_receipt" />
                          <span id="manual_receipt_validate" class="error_individual help-block"></span>
                          <button type="submit" name="proced_to_payment" class="btn btn-primary pull-right">Proceed to Payment</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="search-table table-responsive">
                
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
$(".morebox").html('The End');// no results
}

return false;

}
</script>
