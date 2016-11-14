<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"><?php echo $title;?>
      <small></small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>manager">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span><?php echo $title;?></span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
		<?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-info" > 
                <?= $this->session->flashdata('message') ?> 
            </div>
        <?php } ?>
<form  id="incident_types" method="post">
<p class="form-group">
  <select class="form-control" name="incident_category" style="width:30%;" onchange="this.form.submit()">
  	<option value="0">Select Incident Type</option>
  <?php
  $eports=$this->General_model->get_data_all_like_using_where('incident_categories',"condo_id=$this->condo_id");
  foreach($eports as $row)
  {
	  ?>
  		<option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
	  <?php
  }
  ?>
  </select>
</p>

</form>
<table   class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
	<!-- Table heading -->
	<thead class="bg-gray">
		<tr>
        	<th><input type="checkbox" id="checkall" title="Select all" onClick="checkall()"/></th>
			<th>Incident Type</th>
			<!--<th>No. of Reports Received</th>-->
			<th>Block </th>
			<th>Resident </th>
			<th>Status</th>
            
			<th>Actions</th>
		</tr>
	</thead>
	<!-- // Table heading END -->
	
	<!-- Table body -->
	<tbody>
	<?php
	foreach($reports as $report){
	?>
		<!-- Table row -->
		<tr class="gradeX">
			<td><input type='checkbox' name='numbers[]' class="singlecheckbox" id="single_inci_<?php echo $report['id'];?>" onclick="check_single('<?php echo $report['id'];?>')" value='<?php echo $report['id'];?>'/></td>
            <td><?php echo $this->General_model->get_value_by_id('incident_categories',$report['incident_category'],'name')?></td>
			<!--<td>0</td>-->
			<td><?php echo $this->General_model->get_value_by_id('blocks',$this->General_model->get_value_by_id('residents',$report['reported_by'],'block'),'name')?>-<?php echo $this->General_model->get_value_by_id('residents',$report['reported_by'],'floor');?>-<?php echo $this->General_model->get_value_by_id('residents',$report['reported_by'],'unit');?></td>
            <td><?php echo $this->General_model->get_value_by_id('residents',$report['reported_by'],'name');?></td>
           
            <td><?php if($report['status']==0){?>Resolved<?php }else{ echo "Not Resolved";}?></td>
            <td id="<?php echo $report['id'];?>">
                <?php if($report['status']==0){?>
                <a href="javascript:;" onclick="incident_status(<?php echo $report['id'];?>,'1')" title="Mark Resolved">
                	<span class="glyphicon glyphicon-check"></span>
                </a>
                <?php }else{?>
                
                N/A &nbsp; 
					<?php if($report['incident_log']==''){?>
                    <a href="javascript:;" title="Incident Log" data-toggle="modal" data-target="#myModal" onclick="update_modal_id(<?php echo $report['id'];?>)">
                        <span class="glyphicon glyphicon-ban-circle"></span>
                    </a>
                    <?php }?>
                <?php }?>
            </td>
			
		</tr>
		<!-- // Table row END -->
		
		<?php 
		} ?>
	</tbody>
	<!-- // Table body END -->
</table>
<!-- // Table END -->
<form name="frm-example" id="frm-example" method="post">
<p class="form-group">
  <select class="form-control" name="status" style="width:30%;">
  	<option value="1">Resolved</option>
  	<option value="0">Not Resolved</option>
  </select>
  <section class="checked_ids"></section>
</p>
<p class="form-group">
   <button type="submit" name="bulk_incident_sub" class="btn btn-primary">Submit</button>
</p>

</form>
        </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Incident Log</h4>
      </div>
      <form method="post">
      <div class="modal-body">
        <textarea class="form-control" name="incident_log" id="incident_log"></textarea>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="incident_id" id="incident_id" />
        <button type="button" class="btn btn-default"  onclick="incident_log_sub()">Submit</button>
      </div>
      </form>
    </div>

  </div>
</div>
<script>
function checkall()
{
	//alert('success');
	var checkAll = $("#checkall").prop('checked');
	if (checkAll) {
		$(".singlecheckbox").prop("checked", true);
		 $(".singlecheckbox").each(function(){
			  $('.checked_ids').append('<input type="hidden" name="incidents[]" id="incident_id_'+$(this).val()+'" value="'+$(this).val()+'">');
		  });
		
	} else {
		$(".singlecheckbox").prop("checked", false);
		$('.checked_ids').html('');
	}
}
function check_single(id)
{
	//alert('success');
	var checkAll = $("#single_inci_"+id).prop('checked');
	if (checkAll) {
			  $('.checked_ids').append('<input type="hidden" name="incidents[]" id="incident_id_'+id+'" value="'+id+'">');
		 
		
	} else {
		$('.checked_ids #incident_id_'+id).remove();
	}
}
</script>