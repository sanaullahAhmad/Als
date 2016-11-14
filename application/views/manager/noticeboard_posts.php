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
      <a href="<?php echo base_url();?>manager/noticeboard" class="btn btn-primary pull-right">Add Notice</a>
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
        <table class="table table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
            <thead class="bg-gray">
                <tr>
                    <th>Title</th>
                    <th>Date Posted</th>
                    <th>Details of Notice</th>
                    <th>View</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($posts as $post){
            ?>
                <tr class="gradeX">
                    <td><?php echo $post['title']?></td>
                    <td>
                        <?php echo date('M d Y h:i A', strtotime($post['post_time']));?> 
                    </td> 
                    
                     <td class="visitor_requests">
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
                    <td>
                        <a href="<?php echo base_url()?>manager/view_management_post/N00000<?php echo $post['id'];?>" target="_blank" title="View Notice">
                            N00000<?php echo $post['id'];?>
                        </a> 
                    </td> 
                    <td id="<?php echo $post['id'];?>">
                        <?php if($post['status']==0){?>
                        <a href="<?php echo base_url()?>manager/edit_noticeboard_post/<?php echo $post['id'];?>"  title="Edit">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="javascript:;" onclick="callCrudAction('posts', '<?php echo $post['id'];?>','delete_data')" title="Delete">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                        <?php }else{ }
                        $rows = $this->General_model->get_data_all_like_using_where_count("archived_posts", "post_id=".$post['id']);
                        if($rows<1){?>
                        <a href="javascript:;" onclick="callCrudAction('archived_posts', '<?php echo $post['id'];?>','archive_notice')" 
                        title="Archive Notice">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
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
<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reciept</h4>
      </div>
      <div class="modal-body">
        <img src="" class="updatesrc" />
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