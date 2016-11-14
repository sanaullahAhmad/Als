<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Approval to hire service provider
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
              <span>Approval to hire service provider</span>
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



<div class="widget">
	
	<div class="widget-body innerAll inner-2x">		
        <table   class="table  table-bordered dt-responsive nowrap" id="sample_5"  cellspacing="0" width="100%">
	<thead class="bg-gray">
		<tr>
			<th>Name </th>
			<th>Email </th>
			<th>Phone </th>
			<th>Unit </th>
			<th>Vendor </th>
			<th>Appointment Date</th>
			<th>Reason</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($service_quotes as $report){
		$resident_id = $this->General_model->get_value_by_id('service_requests', $report['service_request_id'], 'requested_by');
	?>
		<tr class="gradeX" id="qoute_<?php echo $report['id']?>">
            <td><?php echo $this->General_model->get_value_by_id('residents', $resident_id, 'name');?></td>
            <td><?php echo $this->General_model->get_value_by_id('residents', $resident_id, 'email');?></td>
            <td><?php echo $this->General_model->get_value_by_id('residents', $resident_id, 'phone');?></td>
            <td>
			<?php echo $this->General_model->get_value_by_id("blocks", $this->General_model->get_value_by_id('residents', $resident_id, 'block'), "name")."-".$this->General_model->get_value_by_id('residents', $resident_id, 'floor')."-".$this->General_model->get_value_by_id('residents', $resident_id, 'unit');?>
            </td>
            <td><?php echo $this->General_model->get_value_by_id('vendors', $report['quoted_by'], 'name');?></td>
            <td><?php echo date("j M y H:i", strtotime($report['ven_arival_time']))?></td>
            
            <td class="service_quotes">
				<?php echo substr($report['message'],0, 50);
				if(strlen($report['message'])>50){
				?> 
                <a href="javascript:;" onclick="show_more_text('<?php echo $report['id']?>','service_quotes')" 
                class="show_more_anchor_<?php echo $report['id']?>"> show more </a>
                <span class="show_more_span_<?php echo $report['id']?>" style="display:none">
                    <?php echo substr($report['message'],50, 10000);?>
                </span>
                <a href="javascript:;" onclick="show_less_text('<?php echo $report['id']?>','service_quotes')" 
                class="show_less_anchor_<?php echo $report['id']?>" style="display:none"> show less </a>
                <?php }?>
           </td>
            <td>
                <a class="" href="javascript:;" onclick="approve_quote('<?php echo $report['id']?>','1')" title="Approve">
                	<span class="glyphicon glyphicon-ok"></span>
                </a>
                <a class="" href="javascript:;" onclick="approve_quote('<?php echo $report['id']?>','3')" title="Disapprove">
                	<span class="glyphicon glyphicon-remove"></span>
                </a>
            </td>
		</tr>
        
		<?php 
		} ?>
	</tbody>
</table>
	</div>
</div>	

 		</div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>
<script>
function show_more_text(post_id, myclass)
	{
		$("."+myclass+" .show_more_anchor_"+post_id).hide();
		$("."+myclass+" .show_less_anchor_"+post_id).show();
		$("."+myclass+" .show_more_span_"+post_id).show();
	}
function show_less_text(post_id, myclass)
	{
		$("."+myclass+" .show_more_anchor_"+post_id).show();
		$("."+myclass+" .show_less_anchor_"+post_id).hide();
		$("."+myclass+" .show_more_span_"+post_id).hide();
	}
</script>