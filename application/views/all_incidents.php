<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/search.min.css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
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
			  <?php if ($this->session->flashdata('message')) { 
			  echo $this->session->flashdata('message');
			   } ?>
              <div class="page-content">
              <!-- BEGIN PAGE HEADER-->
              
              <!-- END PAGE TITLE-->
              <!-- END PAGE HEADER-->
              <!--<div class="search-page search-content-4">
                  
                  <div class="portlet light">
                      <div class="portlet-body">
                      <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="genral">
                          <thead class="bg-blue">
                              <tr>
                                  <th><a href="javascript:;">Description</a></th>
                                  <th><a href="javascript:;">Reported Date</a></th>
                                  <th><a href="javascript:;">Resolved Date</a></th>
                                  <th><a href="javascript:;">Comments</a></th>
                                  <th><a href="javascript:;">Attachment</a></th>
                                  <th><a href="javascript:;">Status</a></th>
                              </tr>
                          </thead>
                          <tbody>
                               <?php
                              if(sizeof($all_incidents)>0)
                              {
                              foreach($all_incidents as $report){
                              ?>
                                  <tr class="gradeX">
                                      <td class="table-title">
                                          <?php echo $report['description'];?>
                                      </td>
                                      <td  class="table-title" >
                                          <?php
                                          if($report['reported_date'] != '0000-00-00 00:00:00'){
                                              echo date('d F Y, h:i A',strtotime($report['reported_date']));
                                          } else {
                                              echo 'N/A';
                                          }
                                          
                                           ?>
                                      </td>
                                      <td  class="table-title" >
                                          <?php 
                                          if($report['resolved_date'] != '0000-00-00 00:00:00'){
                                              echo date('d F Y, h:i A',strtotime($report['resolved_date']));
                                          } else {
                                              echo 'N/A';
                                          }
                                          ?>
                                      </td>
                                      <td  class="table-title" >
                                          <?php echo $report['incident_log'];?>
                                      </td>
                                      <td  class="table-title">
                                      <?php
                                      $img = $this->General_model->get_data_rowusingwhere_empty_array('incident_images',"incident_id=".$report['id']);
                                      if(sizeof($img)>0)
                                      {$src=base_url()."uploads/incident_images/".$img->image_url;}
                                      else{$src=base_url()."assets/front/global/img/no-image-box.png";}
                                      ?>
                                          <a href="<?php echo $src;?>">Click Here</a>
                                      </td>
                                      <td  class="table-title" >
                                          <?php if($report['status'] == 1){
                                              //echo 'Resolved';
                                              echo '<span class="label label-success">Resolved</span>';
                                          } else {
                                              //echo 'Not Resolved';
                                              echo '<span class="label label-warning">Not Resolved</span>';
                                          }?>
                                      </td>
                                  </tr>
                                  <?php 
                                   $msg_id	=	$report['id'];
                              }?>
                                   <?php /*?><tr >
                                      <td colspan="6" align="center" id="more<?php echo $msg_id; ?>" class="morebox">
                                          <a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows(<?php echo $msg_id; ?>)" 
                                          class="more">
                                              More
                                          </a>
                                      </td>
                                  </tr><?php */?>
                                  <?php
                                  }else{?>
                                   <?php /*?><tr >
                                      <td colspan="6" align="center">
                                         No Results Found
                                      </td>
                                  </tr><?php */?>
                                   <?php
                                  }?>
                          </tbody>
                      </table>
                  </div>
                  </div>
              </div>-->
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
		url: "<?php echo base_url();?>home/all_incidents_viewajax",
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