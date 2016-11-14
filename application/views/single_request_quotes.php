<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript" ></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/search.min.css" />
<style>
.tr-green-bg {
    background: #34302d none repeat scroll 0 0;
    color: #fff;
}
.tr-green-bg a
{
	color:#fff; text-decoration:none;
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
                Service Request
                    <?php //if(isset($title)){ echo $title;}?>                                
                </h1>
            </div>
            
            <div class="page-title pull-right">
                <a href="<?php echo base_url();?>service_requests" class="btn btn-primary pull-right">Back</a> 
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
                    <div class="col-md-6 col-sm-12">
					<?php
                    $service_image ='no-image.jpg';
                    if(sizeof($service_quotes)>0){
                        foreach($service_quotes as $report){
						$service_id = $this->General_model->get_value_by_id('service_requests', $report['service_request_id'], 'service_id');
						$service_name = $this->General_model->get_value_by_id('services', $service_id, 'name');
						$service_description = $this->General_model->get_value_by_id('service_requests', $report['service_request_id'], 'description');
						$service_duration=$this->General_model->get_value_by_id('service_requests', $report['service_request_id'], 'duration');
						$service_image = $this->General_model->get_value_by_id('service_requests', $report['service_request_id'], 'service_request_file');
						?>
                            <div class="portlet yellow-crusta box">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Service Info 
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row static-info">
                                        <div class="col-md-5 name"> Service Name: </div>
                                        <div class="col-md-7 value"> <?php echo $service_name?>
                                           
                                        </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 name"> Description: </div>
                                        <div class="col-md-7 value"> <?php echo $service_description?> </div>
                                    </div>
                                    <div class="row static-info">
                                        <div class="col-md-5 name"> Duration: </div>
                                        <div class="col-md-7 value">
                                            <?php echo 'Within '.$service_duration.' days';?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                    }
                    ?>
                    </div>
                    <?php if($service_image!='no-image.jpg'){?>
                    <div class="col-md-6 col-sm-12">
                        <div class="portlet blue-hoki box">
                            <div class="portlet-title">
                                <div class="caption">
                                   File Attachment </div>
                               
                            </div>
                            <div class="portlet-body">
                                 <div class="row static-info">
                                    <div class="col-md-7 value"> 
                                    <img src="<?php echo base_url()."uploads/services_requests/".$service_image;?>"  
                              width="100"  height="80" />
                                    <?php ?> </div>
                                </div>
    
                            </div>
                        </div>
                    </div>        
                    <?php }?> 
                </div>
            </div>
            <!--<div class="search-table table-responsive">
				<table class="table table-bordered table-striped table-condensed" id="updates">
                    <thead class="bg-blue">
                        <tr>
                        	<th><a href="javascript:;">Service Name</a></th>
                            <th><a href="javascript:;">Quoted By</a></th>
                            <th><a href="javascript:;">Vendor Arrival Date</a></th>
                            <th><a href="javascript:;">Description</a></th>
                            <th><a href="javascript:;">Actions</a></th>
                        </tr>
                    </thead>
                    <tbody>
					<?php
					 if(sizeof($service_quotes)>0)
						 {
                    foreach($service_quotes as $report){
                    ?>
                        <tr class="gradeX">
                        	<td class="table-title">
								<?php 
								$service_id = $this->General_model->get_value_by_id('service_requests', $report['service_request_id'], 'service_id');
								$service_name = $this->General_model->get_value_by_id('services', $service_id, 'name');
								echo $service_name;
								?>
                            </td>
                            <td class="table-title">
								<?php echo $this->General_model->get_value_by_id('vendors', $report['quoted_by'], 'name');?>
                            </td>
                            <td class="table-date font-blue">
                            
								<?php 
								if($report['ven_arival_time'] != '0000-00-00 00:00:00' && $report['status'] == 1){
									echo date("d/m/Y h:i a", strtotime($report['ven_arival_time']));
								} else {
									echo 'N/A';
								}?>
                            </td>
                            
                            <td class="table-desc"><?php echo $report['description']?></td>
                             <td  class="table-title" id="<?php echo $report['id']?>"> 
                            <a href="<?php echo base_url();?>services_quotes_comments/<?php echo $report['id']?>" data-original-title="Comment"><i class="fa fa-weixin"></i></a>
                                <?php if($report['status']=='2')
                                { echo '<span class="label label-info">Waiting for Manager</span>';} 
                                elseif($report['status']=='3') 
                                {echo '<span class="label label-warning">Disapproved</span>';}
								elseif($report['status']=='0') 
                                {echo '<span class="label label-default">Vendor Replied</span>';}
                                elseif($report['status']=='1') 
                                {echo '<span class="label label-success">Approved</span>';}
                                else
                                { //echo $report['status'];?>
                                <?php }?>
                            </td>
                        </tr>
                        
                        <?php 
                        } ?>
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
                             
                </div>-->
            </div>
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
                                        <th><a href="javascript:;">Service Name</a></th>
                                        <th><a href="javascript:;">Quoted By</a></th>
                                        <th><a href="javascript:;">Vendor Arrival Date</a></th>
                                        <th><a href="javascript:;">Description</a></th>
                                        <th><a href="javascript:;">Actions</a></th>
                                    </tr>
                                </thead>
                                <tbody>
					<?php
					 if(sizeof($service_quotes)>0)
						 {
                    foreach($service_quotes as $report){
                    ?>
                        <tr class="gradeX">
                        	<td class="table-title">
								<?php 
								$service_id = $this->General_model->get_value_by_id('service_requests', $report['service_request_id'], 'service_id');
								$service_name = $this->General_model->get_value_by_id('services', $service_id, 'name');
								echo $service_name;
								?>
                            </td>
                            <td class="table-title">
								<?php echo $this->General_model->get_value_by_id('vendors', $report['quoted_by'], 'name');?>
                            </td>
                            <td class="table-date font-blue">
                            
								<?php 
								if($report['ven_arival_time'] != '0000-00-00 00:00:00' && $report['status'] == 1){
									echo date("d/m/Y h:i a", strtotime($report['ven_arival_time']));
								} else {
									echo 'N/A';
								}?>
                            </td>
                            
                            <td class="table-desc"><?php echo $report['description']?></td>
                             <td  class="table-title" id="<?php echo $report['id']?>"> 
                            <a href="<?php echo base_url();?>services_quotes_comments/<?php echo $report['id']?>" data-original-title="Comment"><i class="fa fa-weixin"></i></a>
                                <?php if($report['status']=='2')
                                { echo '<span class="label label-info">Waiting for Manager</span>';} 
                                elseif($report['status']=='3') 
                                {echo '<span class="label label-warning">Disapproved</span>';}
								elseif($report['status']=='0') 
                                {echo '<span class="label label-default">Vendor Replied</span>';}
                                elseif($report['status']=='1') 
                                {echo '<span class="label label-success">Approved</span>';}
                                else
                                { //echo $report['status'];?>
                                <?php }?>
                            </td>
                        </tr>
                        
                        <?php 
                        } ?>
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
<script type="text/javascript">
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
</script>
