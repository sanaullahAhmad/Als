<link rel="stylesheet" href="<?php echo base_url();?>assets_v1/admin/css/components/common/forms/editors/wysihtml5/assets/lib/css/bootstrap-wysihtml5-0.0.2.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">

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
      <a href="<?php echo base_url();?>manager/add_resident" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary">
      Add Resident
      </a>
      <a href="<?php echo base_url();?>manager/import_residents" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary">Import residents</a>
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
                                                
		<?php if ($this->session->flashdata('success_message')) { ?>
            <div style="float:left; width:100%; height:50px; position:relative; 
            z-index:111111; margin-bottom:15px;">
                <div class="alert alert-success"> 
                <?= $this->session->flashdata('success_message') ?> 
                </div>
            </div>
        <?php } ?>
        
        <?php if ($this->session->flashdata('failure_message')) { ?>
            <div style="float:left; width:100%; height:50px; position:relative; 
            z-index:111111; margin-bottom:15px;">
                <div class="alert alert-warning"> 
                <?= $this->session->flashdata('failure_message') ?> 
                </div>
            </div>
        <?php } ?>
        
            
        <?php if(isset($message)){?>
        <div class="alert alert-success">
           <?php echo $message;?>
        </div>
        <?php }?>                                                 
        <form class="form-horizontal" method="post" id="resident-search-form">
             
            <div class="form-group">
                <label class="col-md-2 control-label">Block</label>
                <div class="col-md-3 blocks_content">
                    <select id="block" name="block" onchange="change_floors_manager(this.value)" class="form-control">
                        <option value="">
                            Block
                        </option>
                        <?php
                          if(sizeof($blocks)>0)
                          {
                              foreach($blocks as $block)
                              {
                                  ?>
                                  <option value="<?php echo $block['block']?>" ><?php echo $this->General_model->get_value_by_id('blocks',$block['block'],'name')?></option>
                                  <?php
                              }
                          }
                          else
                          {
                              ?>
                                  <option value="" >No blocks available</option>
                              <?php
                          }
                      ?>
                    </select>
                    <span class="error_individual" id="block_validate"></span>
                </div>
            </div>
            <div class="form-group"  >
                <label class="col-md-2 control-label">Floor</label>
                <div class="col-md-3" id="floors">
                    <select name="floors" class="form-control">
                        <option value="">
                            Floor
                        </option>
                    </select>
                    <span class="error_individual" id="floors_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Unit</label>
                <div class="col-md-3" id="unites">
                    <select id="unit" name="unit" class="form-control" onchange="search_resident()">
                        <option value="">
                            Unit
                        </option>
                    </select>
                    <span class="error_individual" id="unit_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">&nbsp;</label>
                <div class="col-md-3" id="unites">
                    <input type="submit" name="search_residents_btn" class="btn btn-primary" />
                </div>
            </div>
                   
            </form>       
              
        <script>
        
            function change_floors_manager(id)
            {
                var res='';
                  res = res.concat('id='+id);
                    $.ajax({
                    type: 'POST',
                    data: res,
                    url: '<?php echo base_url();?>manager/change_floors_manager', 
                    success: function(result){
                        $('#floors').html(result);
                    }});
            }
            function change_unit_manager(floor_id)
            {
                var res='';
                var block_id = $('#block').val();
                   res = res.concat('floor_id="'+floor_id+'"&block_id='+block_id);
                    $.ajax({
                    type: 'POST',
                    data: res,
                    url: '<?php echo base_url();?>manager/change_unit_manager', 
                    success: function(result){
                        $('#unites').html(result);
                    }});
            }
        </script>                                              
                                                                        
        <table   class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
            <!-- Table heading -->
            <thead class="bg-gray">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Type</th>
                    <th>Unit Info</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <!-- // Table heading END -->
            <!-- Table body -->
            <tbody>
            <?php
            foreach($residents as $resident){
            ?>
                <!-- Table row -->
                <tr class="gradeX">
                    <td  ondblclick="edit_field('<?php echo $resident['id'];?>', 'residents', 'name')" id="category_service_id_<?php echo $resident['id'];?>"><?php echo $resident['name']?></td>
                    <td><?php echo $resident['email']?></td>
                    <td><?php echo $resident['phone']?></td>
                    <td><?php if($resident['type']==1){echo "Tenant";} elseif($resident['type']==11) { echo "Primary owner";}else { echo "Owner";}?></td>
                    <td><?php echo $this->General_model->get_value_by_id('blocks', $resident['block'], 'name').'-'.$resident['floor'].'-'.$resident['unit'];?></td>
                    <td id="active_<?php echo  $resident['id']?>"><?php if($resident['status']==1){echo "Active";} else { echo "Inactive";}?></td>
                    <td>
                        <a class="show_delete_claim_type" href="#" onclick="callCrudAction('residents',<?php echo $resident['id'];?>,'delete_data')" id="<?php echo $resident['id'];?>">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                        <a  href="<?php echo base_url();?>manager/edit_resident/<?php echo $resident['id'];?>" >
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <?php if($resident['status']==1){?>
                        <a href="#" id="anchor_<?php echo $resident['id'];?>" onclick="change_resident_status(<?php echo $resident['id'];?>,'0')"
                         title="DeActivate" data-toggle="modal" data-target="#myModal">
                            <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <?php } else { ?>
                        <a href="#" id="anchor_<?php echo $resident['id'];?>" onclick="change_resident_status(<?php echo $resident['id'];?>,'1')"
                         title="Activate" data-toggle="modal" data-target="#myModal">
                            <span class="glyphicon glyphicon-check"></span>
                        </a>
                        <?php }?>
                        
                        <a href="#" id="email_<?php echo $resident['id'];?>" onclick="send_resident_email(<?php echo $resident['id'];?>)"
                         title="Email" data-toggle="modal" data-target="#myModal_email">
                            <span class="glyphicon glyphicon-envelope"></span>
                        </a>
                         
                        <!--<a  href="<?php echo base_url();?>alpha/reset_password/<?php echo $resident['id'];?>" >
                            <span class="glyphicon glyphicon-home"></span>
                        </a>-->
                    </td>
                </tr>
                <!-- // Table row END -->
                <?php } ?>
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
        <h4 class="modal-title">Reason</h4>
      </div>
      <div class="modal-body">
        <textarea name="reason"  id="reason" class="form-control" rows="5"></textarea>
        <input type="hidden" name="hidden_status" id="hidden_status"/>
        <input type="hidden" name="hidden_resident" id="hidden_resident" />
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" onclick="submit_modal()"  data-dismiss="modal">Change</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal Email-->
<div id="myModal_email" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form class="form-horizontal" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Email</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="col-sm-2 control-label">Subject</label>
          <div class="col-sm-10">
              <input type="text" name="subject"  id="subject" class="form-control" placeholder="Subject">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label">Message</label>
          <div class="col-sm-10">
               <textarea name="message"  id="message" class="form-control wysihtml5" rows="5" placeholder="Message"></textarea>
               <span class="error_individual" id="description_validate"></span>
          </div>
        </div>
        
        
        <div class="form-group">
            <label class="col-md-2 control-label">Attachment</label>
            <div class="col-md-10">
                 <span class="btn btn-success fileinput-button" style="margin-bottom:10px;">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Select files...</span>
                        <input id="email_attachement" type="file" name="file_upload">
                    </span>
                    <div id="progress_loading" style="margin-top: 10px; width:100%; display:none; clear:both;">
                      Loading...
                    </div>
                  <div id="progress" class="progress" style="margin-top: 10px; width:50%; display:none; height:10px;">
                      <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <div id="files" class="files" style="clear:both;"></span>
                </div>
                
                <span class="error_individual help-block" id="infomsg"></span>
            </div>
          </div>
        
        
        <input type="hidden" name="hidden_resident_id" id="hidden_resident_id" />
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" onclick="submit_email()"  data-dismiss="modal">Send</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>

  </div>
</div>
<script>

	function send_resident_email(id)
	{
		$('#message').data("wysihtml5").editor.clear();
		$('#subject').val("");
		$("#hidden_resident_id").val(id);
	}
	function submit_email()
	{
		var subject 	=$("#subject").val();
		var message 	=$("#message").val();
		var id			=$("#hidden_resident_id").val();
		var images_names=$(".images_names").val();
	  var postData={ 
					  id			:id,
					  subject		:subject,
					  message		:message,
					  images_names	:images_names
				   }
		  $.ajax({
		  type: 'POST',
		  data: postData,
		  url: '<?php echo base_url();?>manager/send_resident_email/', 
		  success: function(result){
			  
		  }
		  });
	}
	
	<!---->
	
	
	function change_resident_status(id, status)
	{
		$("#reason").val('');
		$("#hidden_status").val(status);
		$("#hidden_resident").val(id);
	}
	function submit_modal()
	{
		var reason 	=$("#reason").val();
		var id		=$("#hidden_resident").val();
		var status	=$("#hidden_status").val();
		$('#active_'+id).html('Loading...');
	    $('#anchor_'+id).hide();
	  var postData={ 
					  id			:id,
					  status		:status,
					  reason		:reason
				   }
		  $.ajax({
		  type: 'POST',
		  data: postData,
		  url: '<?php echo base_url();?>manager/change_resident_status/', 
		  success: function(result){
	    	  $('#anchor_'+id).show();
			  if(status==1){
				  $('#active_'+id).html('Active');
				  $('#anchor_'+id).attr('onclick','change_resident_status('+id+',0)');
				  $('#anchor_'+id).attr('title','Deactivate');
				  $('#anchor_'+id+' span').addClass('glyphicon-edit');
				  $('#anchor_'+id+' span').removeClass('glyphicon-check');
			  }
			  else
			  {
				  $('#active_'+id).html('InActive');
				  $('#anchor_'+id).attr('onclick','change_resident_status('+id+',1)');
				  $('#anchor_'+id).attr('title','Activate');
				  $('#anchor_'+id+' span').removeClass('glyphicon-edit');
				  $('#anchor_'+id+' span').addClass('glyphicon-check');
			  }
		  }
		  });
	}
</script>