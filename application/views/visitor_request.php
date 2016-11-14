<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/search.min.css" />
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
                   <a href="<?php echo base_url();?>add_visitor" class="btn btn-primary pull-right" >
                        Register Visitors
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
                            <table  class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="visitor_request">
                                <thead><!-- class="bg-blue"-->
                                    <tr class="tr-green-bg">
                                        <th class="all">Visitor Name</th>
                                        <th class="min-phone-l">Vehicle Number</th>
                                        <th class="min-tablet">Date & Time</th>
                                        <th class="desktop">Description</th>
                                        <th class="desktop">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                     if(sizeof($visitor_requests)>0)
                                     {
                                        foreach($visitor_requests as $report)
                                        {
                                     ?>
                                        <tr>
                                            <td><?php echo $report['visitor_name'];?></td>
                                            <td><?php echo $report['vehicle_no'];?></td>
                                            <td><?php echo date("d M y h:iA", strtotime($report['visitdatetime']))?></td>
                                            <td><?php echo $report['visitor_reason']?></td>
                                            <td><?php 
                                             if(date('YmdHis',strtotime($report['visitdatetime'])) > date('YmdHis') && $report['check_in']!= '0000-00-00 00:00:00' && $report['check_out']!= '0000-00-00 00:00:00')
											  { 
											  	   echo '<span class="label label-info">Visited</span>';
											  }
											  elseif(date('YmdHis',strtotime($report['visitdatetime'])) < date('YmdHis') && $report['check_in']!= '0000-00-00 00:00:00' && $report['check_out']!= '0000-00-00 00:00:00')
											  {
												   echo '<span class="label label-warning">Visited and Expired</span>';
											  }
											  elseif(date('YmdHis',strtotime($report['visitdatetime'])) < date('YmdHis') && $report['check_in']== '0000-00-00 00:00:00' && $report['check_out']== '0000-00-00 00:00:00')
											  {
												   echo '<span class="label label-danger">Expired</span>';
											  }
											  else
											  {
												   echo '<span class="label label-default">In Progress</span>';
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
                    
                    <?php
			  echo $this->load->view('template/feature_ad');
			  ?>
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