<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
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
                    <?php
                    $nowtime = date('Y-m-d H:i:s',time() - 1800);
                    $payments= $this->General_model->get_data_all_like_using_where('facility_booking', " resident_id=".$this->session->userdata('resident_id')." AND datetime_booked >= '$nowtime' AND id IN(select booking_id from invoices where payment_status=0 AND payment_channel='')");
                    ?>
                     <div class="portlet light ">
                        <div class="portlet-body">
                         <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="genral">
                            <thead class="bg-blue">
                                <tr>
                                    <th><a href="javascript:;">Facility</a></th>
                                    <th><a href="javascript:;">from</a></th>
                                    <th><a href="javascript:;">To</a></th>
                                    <th><a href="javascript:;">Actions</a></th>
                                </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                              <?php
                                if(sizeof($payments)>0)
                                 {
                                    foreach($payments as $payment)
                                    {
                                    ?>
                                        <!-- Table row -->
                                        <tr class="gradeX">
                                             <td class="table-title"><?php echo $this->General_model->get_data_value_using_where('condo_facilities',"id=".$payment['facility_id'],'name');?></td>
                                              <td class="table-title font-blue"><?php echo $payment['bookedfor_datetime_from']?></td>
                                              <td class="table-title font-blue"><?php echo $payment['bookedfor_datetime_to']?></td>	
                                              <td class="table-title">
                                              <form method="POST" action="<?php echo base_url();?>manual_payment">
                                                  <input type="hidden" name="invoice_id" value="<?php echo $this->General_model->get_data_value_using_where('invoices',"booking_id=".$payment['id'],'id');?>" />
                                                  <input type="hidden" name="facility_booking_id" value="<?php echo $payment['id'];?>" />
                                                  <button type="submit" name="manual_payment_btn" class="btn btn-primary pull-right">Manual Payment</button>
                                                </form>
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
			  <?php echo $this->load->view('template/sidebar');?> 
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
