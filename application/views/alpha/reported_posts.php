<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Post
      <small>Reported Post</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Reported Post</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- Table -->
		<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');}?>
        <table  class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="genral">
            <!-- Table heading -->
            <thead class="bg-gray">
                <tr>
                    <th>Post</th>
                    <th>Posted By</th>
                    <th>Reported By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <!-- // Table heading END -->
            <!-- Table body -->
            <tbody>
            <?php
            foreach($reported_posts as $condo){
            ?>
                <!-- Table row -->
                <tr class="gradeX">
                    <td><?php echo $this->General_model->get_value_by_id("posts",$condo['post_id'],'title')?></td>
                    <td><?php $posted_by_id = $this->General_model->get_value_by_id("posts",$condo['post_id'],'posted_by');
                        echo $this->General_model->get_value_by_id("residents",$posted_by_id,'name')?></td>
                    <td><?php echo $this->General_model->get_value_by_id("residents",$condo['reported_by'],'name')?></td>
                    <td>
                    <a href="<?php echo base_url()?>alpha/view_post/<?php echo $condo['id']?>" title="View">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a title="Email" data-toggle="modal" href="#action_alert" onclick="update_id('<?php echo $condo['post_id']?>')">
                        <i class="fa fa-envelope"></i>
                    </a>
                    </td>
                </tr>
                <!-- // Table row END -->
                <?php } ?>
            </tbody>
            <!-- // Table body END -->
        </table>
 		</div>
  	 </div>
     <div class="clearfix"></div>
  	 <!-- END DASHBOARD STATS 1-->
</div>
<div class="modal fade" id="action_alert" tabindex="-1" role="basic" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <form method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title action_alert_title">Email Resident</h4>
      </div>
      <div class="modal-body">
        <label class="control-label action_alert_label">Email</label>
        <textarea class="form-control" rows="5" name="email" id="email"></textarea>
      </div>
      <div class="modal-footer">
      	<input type="hidden" name="report_id" id="report_id" />
        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
        <button type="button" class="btn green action_alert_submit" onclick="send_email()">Send</button>
      </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<script>
function update_id(id)
{
	$("#report_id").val(id);
	$("#email").val('');
	$(".action_alert_submit").show();
	$(".action_alert_label").html('Email');
}
function send_email()
{
	post_id = $("#report_id").val();
	email = $("#email").val();
	$.ajax({
	'url': '<?php echo base_url();?>alpha/send_email',
	'type': 'post',
	'data': {
		'post_id': post_id,
		'email': email
	},
	'cache': false,
	'success': function(result){
		$(".action_alert_submit").hide();
		$(".action_alert_label").html('Sent Succussfully.');
	}
	});
}
</script>