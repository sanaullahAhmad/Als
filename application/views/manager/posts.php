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
		<table   class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
	<!-- Table heading -->
	<thead class="bg-gray">
		<tr>
			<th>Posted By</th>
			<th>Description</th>
			<th>Actions</th>
		</tr>
	</thead>
	<!-- // Table heading END -->
	
	<!-- Table body -->
	<tbody>
	<?php
	foreach($posts as $post){
	?>
		<!-- Table row -->
		<tr class="gradeX" id="tr_<?php echo $post['id'];?>">
			<td><?php echo $this->General_model->get_value_by_id('residents',$post['posted_by'],'name')?></td>
            <td>
            <div class="visitor_requests">
				<?php echo substr(strip_tags($post['description']),0, 50);?> 
                    <?php if(strlen(strip_tags($post['description']))>50){?>
                        <a href="javascript:;" onclick="show_more_text('<?php echo $post['id']?>','visitor_requests')" 
                        class="show_more_anchor_<?php echo $post['id']?>"> show more </a>
                        <span class="show_more_span_<?php echo $post['id']?>" style="display:none">
                            <?php echo substr(strip_tags($post['description']),50, 10000);?>
                        </span>
                        <a href="javascript:;" onclick="show_less_text('<?php echo $post['id']?>','visitor_requests')" 
                        class="show_less_anchor_<?php echo $post['id']?>" style="display:none"> show less </a>
                    <?php }?>
            </div>
            </td>
            <td id="<?php echo $post['id'];?>">
                <?php if($post['status']==4){//0 before?>
                <a href="javascript:;" onclick="approve_post(<?php echo $post['id'];?>,'1')" title="Approve">
                	<span class="glyphicon glyphicon-ok"></span>
                </a>
                <a href="javascript:;" onclick="approve_post(<?php echo $post['id'];?>,'2')" title="DisApprove">
                	<span class="glyphicon glyphicon-remove"></span>
                </a>
                <?php }?>
                <a href="javascript:;" onclick="delete_post('<?php echo $post['id'];?>')" title="Delete">
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
<script>
function show_more_text(post_id, myclass)
	{
		//alert(post_id);alert(myclass);
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