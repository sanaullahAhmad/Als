<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

<style>
	table.dataTable thead .sorting::after, table.dataTable thead .sorting_asc::after, table.dataTable thead .sorting_desc::after, table.dataTable thead .sorting_asc_disabled::after, table.dataTable thead .sorting_desc_disabled::after {
    bottom: 14px;
    display: block;
    font-family: "Glyphicons Halflings";
    opacity: 0.5;
    position: absolute;
    right: 5px;
}
.dt-buttons
{
	display:none;
}
</style>
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
                   <a href="<?php echo base_url();?>make_payment" class="btn btn-primary pull-right" >
                        Make a Payment
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
                       <!-- <div class="portlet-title">
                            <div class="caption font-dark">
                                <!--<i class="icon-settings font-dark"></i>                        <span class="caption-subject bold uppercase"><?php if(isset($title)){ echo $title;}?></span>
                            </div>-->
        <!--                    <div class="tools"> </div>
                      </div>-->  
                        <div class="portlet-body">
                            <table  class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="genral">
                                <thead><!-- class="bg-blue"-->
                                    <tr class="tr-green-bg">
                                        <th class="all">Payment Type</th>
                                        <th class="all">Payment Purpose</th>
                                        <th class="min-phone-l">Amount (RM)</th>
                                        <th class="min-phone-l">Date</th>
                                        <th class="min-tablet">Action</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                     if(sizeof($payments)>0)
                                     {
                                        foreach($payments as $payment)
                                        {
                                     ?>
                                        <tr>
                                        	<td><?php 
											$inv_id = $payment['id'];
											echo $this->General_model->get_value_by_id('payment_for',
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
                                        </tr>
                                        <?php 
                                       }
                                    }?>
                                </tbody>
                            </table>
                            <?php /*?>
                            <div class="row">
                                <div class="col-md-5 col-sm-5">
                                    <div class="dataTables_info" id="genral_info" role="status" aria-live="polite">&nbsp;</div>
                                    </div>
                                <div class="col-md-7 col-sm-7">
                                    <div class="dataTables_paginate paging_bootstrap_number" id="genral_paginate">
                                        <ul class="pagination" style="visibility: visible;">
                                            <?php echo $pagination;?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php */?>
                       </div>
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
<script type="text/javascript">
function more_rows(ID) 
{
if(ID)
{
$("#more"+ID).html('<img src="<?php echo base_url()?>assets/admin/images/loading.gif" width="32" height="32"/>');

$.ajax({
type: "POST",
url: "<?php echo base_url();?>home/visitor_request_viewajax",
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