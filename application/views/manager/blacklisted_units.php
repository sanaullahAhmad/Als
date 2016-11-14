<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"><?php echo $title;?>
      <small></small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span><?php echo $title;?></span>
          </li>
      </ul>
      <a href="<?php echo base_url();?>manager/add_blacklisted_unit" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary"  >Add Unit</a>
      
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
		<!-- Table -->
<table class="table table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
	<!-- Table heading -->
	<thead class="bg-gray">
		<tr>
			<th>Block</th>
			<th>Floor</th>
			<th>Unit</th>
            <th>Actions</th>
			<?php /*?><th>Facility Disabled</th>
			<th>Service Disabled</th>
			<th>Account Creation Disabled</th><?php */?>
			<?php /*?><?php */?>
		</tr>
	</thead>
	<!-- // Table heading END -->
	
	<!-- Table body -->
	<tbody>
	<?php
	foreach($blacklisted_units as $unit){
	?>
		<!-- Table row -->
		<tr class="gradeX" id="tr_<?php echo $unit['id'];?>">
			<td><?php echo $this->General_model->get_value_by_id('blocks',$unit['block'],'name');?></td>
			<td><?php echo $unit['floor']?></td>
			<td><?php echo $unit['unit']?></td>
			<?php /*?><td><?php if($unit['disable_facility']==1){ echo "Yes"; }else{ echo "NO";}?></td>
			<td><?php if($unit['disable_service']==1){ echo "Yes"; }else{ echo "NO";}?></td>
			<td><?php if($unit['disable_account_creation']==1){ echo "Yes"; }else{ echo "NO";}?></td><?php */?>
            
            <td id="<?php echo $unit['id'];?>">
                <a href="javascript:;" onclick="callCrudAction('blacklisted_units','<?php echo $unit['id'];?>','delete_data')" title="Unblock">
                	<span class="glyphicon glyphicon-remove"></span>
                </a>
            </td>
			
		</tr>
		<!-- // Table row END -->
		<?php 
		} ?>
	</tbody>
	<!-- // Table body END -->
	
</table>
<!-- // Table END -->
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
        <button type="button" class="btn btn-default" type="button" onclick="incident_log_sub()">Submit</button>
      </div>
      </form>
    </div>

  </div>
</div>