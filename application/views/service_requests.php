<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript" ></script>
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/search.min.css" />
<style>
.search-content-4 .search-table .table-date {
    width: 248px;
}
.search-page .search-bar {
    background-color: #fff;
    margin-bottom: 20px;
    padding: 10px 20px;
}
.table-scrollable > .table-bordered > thead > tr > th:first-child
{
	width:200px !important;
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
             <a href="<?php echo base_url();?>add_service_request" class="btn btn-primary pull-right">
                New Service Request
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
                      <div class="portlet-title">
                          <div class="caption font-dark">
                              <!--<i class="icon-settings font-dark"></i>-->
                              <span class="caption-subject bold uppercase">Quotes</span>
                          </div>
                          <div class="tools"> </div>
                      </div>
                      <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="genral">
                            <thead>
                                <tr class="tr-green-bg">
                                    <th class="all">Service Name</th>
                                    <th class="min-phone-l">Quoted By</th>
                                    <th class="min-tablet">Appointment Date</th>
                                    <th class="desktop">Description</th>
                                    <th class="desktop">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             if(sizeof($service_quotes)>0)
                              {
                                foreach($service_quotes as $report)
                                  {
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
                                            echo date("j M y H:i", strtotime($report['ven_arival_time']));
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
                                <?php }
                                }?>
                            </tbody>
                        </table>
                                     
                            </div>      
                        </div>
                        
                        
                        <div class="portlet light ">
                      <div class="portlet-title">
                          <div class="caption font-dark">
                              <!--<i class="icon-settings font-dark"></i>-->
                              <span class="caption-subject bold uppercase">Requests</span>
                          </div>
                          <div class="tools"> </div>
                      </div>
                      <div class="portlet-body">
                        <table  class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="delivery_requests">
                            <thead>
                                <tr class="tr-green-bg">
                                    <th class="all">Service</th>
                                    <th class="min-tablet">No. of Quotes received</th>
                                    <th class="min-phone-l">Description</th>
                                    <th class="desktop">Duration</th>
                                    <th class="desktop">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php
                        if(sizeof($service_requests)>0)
                            {
                            foreach($service_requests as $report){
                            ?>
                                <tr class="gradeX rowclss_<?php echo $report['id']; ?>">
                                    <td class="table-title font-blue">
                                        <a href="<?php echo base_url();?>single_request_quotes/<?php echo $this->encrypt_model->encode($report['id'])?>">
                                        <?php 
                                        echo $this->General_model->get_value_by_id('services', $report['service_id'], 'name');
                                        ?>
                                        </a>
                                    </td> 
                                    <td class="table-desc">
                                    <?php echo sizeof($this->General_model->get_data_all_like_using_where('service_quotes', "service_request_id=".$report['id']));?>
                                    </td>
                                    <td class="table-desc"><?php echo $report['description']?></td>
                                   
                                    <td class="table-desc">Within <?php echo $report['duration']?> days</td>
                                    <td class="table-desc">
                                    <a onclick="delete_service_request('<?php echo $report['id']; ?>')" title="Delete"
                                    href="javascript:;" >
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                    </td>
                                </tr>
                                <?php 
                                    }  
                                }?>
                            </tbody>
                        </table>       
                        </div>    
                    </div>
                         <?php
			  echo $this->load->view('template/vendor_featured');
			  ?>
                    </div>
                
              </div>
			  <?php echo $this->load->view('template/vendor_premium');?> 
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
function more_rows_services_requests(ID) 
{
	if(ID)
	{
		$("#more_services_requests"+ID).html('<img src="<?php echo base_url()?>assets/admin/images/loading.gif" width="32" height="32"/>');
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>home/service_requests_viewajax",
			data: "lastmsg="+ ID+"<?php if(isset($_POST['service'])){ echo "&service=".$_POST['service'];}?>", 
			cache: false,
			success: function(html){
			$("#updates_services_requests").append(html);
			$("#more_services_requests"+ID).remove(); // removing old more button
			}
		});
	}
	else
	{
	$(".morebox_services_requests").html('No more quotes');// no results
	}
	return false;
}

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
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reciept</h4>
      </div>
      <div class="modal-body">
        <img src="" class="updatesrc" style="max-width:500px" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
function show_image(id)
{
	var src = $("#"+id).attr('src');
	//alert(id);
	$('.updatesrc').attr('src',src);
}
</script>