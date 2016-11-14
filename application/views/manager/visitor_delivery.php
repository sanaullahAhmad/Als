<link rel="stylesheet" href="<?php echo base_url();?>assets_v1/admin/css/components/common/forms/editors/wysihtml5/assets/lib/css/bootstrap-wysihtml5-0.0.2.css">

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
               
              
                                                          
        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="genral">
                            <thead>
                                <tr class="tr-green-bg">
<!--                                    <th class="min-phone-l">Delivery for</th>
-->                                    <th class="min-phone-l">Company Name</th>
                                    <th class="min-phone-l">Date & Time</th>
                                    <th class="desktop">Description</th>
                    				<th class="min-phone-l">Attachment</th>
                                    <th class="min-phone-l">Status</th>
                                    <th class="min-phone-l">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php
                             if(sizeof($delivery_requests)>0)
                              {
                                foreach($delivery_requests as $delivery)
                                  {
                            ?>
                                <tr class="gradeX">
<!--                                 <td><?php echo $delivery['icid_number'];?></td>
-->                   				 <td><?php echo $delivery['company_name'];?></td>
                                 <td><?php echo date("j M y H:i", strtotime($delivery['deliverydatetime']))?></td>
                   				 <td class="visitor_requests">
									<?php echo substr($delivery['description'],0, 50);?> 
                                    <?php if(strlen($delivery['description'])>50){?>
                                    <a href="javascript:;" onclick="show_more_text('<?php echo $delivery['id']?>','visitor_requests')" 
                                    class="show_more_anchor_<?php echo $delivery['id']?>"> show more </a>
                                    <span class="show_more_span_<?php echo $delivery['id']?>" style="display:none">
                                        <?php echo substr($delivery['description'],50, 10000);?>
                                    </span>
                                    <a href="javascript:;" onclick="show_less_text('<?php echo $delivery['id']?>','visitor_requests')" 
                                    class="show_less_anchor_<?php echo $delivery['id']?>" style="display:none"> show less </a>
                                    <?php }?>
                    			</td>	
                                    
                                 <td>
                                  <?php 
								 if(date('YmdHis',strtotime($delivery['deliverydatetime'])) > date('YmdHis') && $delivery['check_in']!= '0000-00-00 00:00:00' && $delivery['check_out']!= '0000-00-00 00:00:00')
								  { 
									  echo '<span class="label label-info">Delivered</span>';
								  }
								  elseif(date('YmdHis',strtotime($delivery['deliverydatetime'])) < date('YmdHis') && $delivery['check_in']!= '0000-00-00 00:00:00' && $delivery['check_out']!= '0000-00-00 00:00:00')
								  {
									  echo '<span class="label label-warning">Delivered and Expired</span>';
								  }
								  elseif(date('YmdHis',strtotime($delivery['deliverydatetime'])) < date('YmdHis') && $delivery['check_in']== '0000-00-00 00:00:00' && $delivery['check_out']== '0000-00-00 00:00:00')
								  {
									  echo '<span class="label label-danger">Expired</span>';
								  }
								  else
								  {
									  echo '<span class="label label-default">In Progress</span>';
								  }
							?>
                                 
                                 </td>
                                 
                                 <td><a target="_blank" href="<?php echo base_url()?>uploads/post_images/<?php echo $delivery['reciept']?>" />View Receipt</a></td>
                                 
                                  <td>
                        <a class="" href="javascript:;" onclick="approve_delivery('<?php echo $delivery['id']?>','1')" title="Approve">
                            <span class="glyphicon glyphicon-ok"></span>
                        </a>
                        <a class="" href="javascript:;" onclick="approve_delivery('<?php echo $delivery['id']?>','3')" title="Disapprove">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </td>
                                </tr>
                                <?php }
                                }?>
                            </tbody>
                        </table>
        <!-- // Table END -->
        
        
        
                        
         </div>
     </div>
     
     
      <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          &nbsp;
          </div>
      </div>
   
    
    
      <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="delivery_requests">
            <thead>
                <tr class="tr-green-bg">
                    <th class="min-phone-l">Visitor Name</th>
                    <th class="min-phone-l">Vehicle Number</th>
                    <th class="min-phone-l">Date & Time</th>
                    <th class="desktop">Description</th>
                    <th class="desktop">Status</th>
                </tr>
            </thead>
                            <tbody>
                            <?php
                             if(sizeof($visitor_requests)>0)
                              {
                                foreach($visitor_requests as $visitor)
                                  {
                            ?>
                                <tr class="gradeX">
                                 <td><?php echo $visitor['visitor_name'];?></td>
                                 <td><?php echo $visitor['vehicle_no'];?></td>
                                 <td><?php echo date("j M y H:i", strtotime($visitor['visitdatetime']))?></td>
                   				 <td class="visitor_requests">
									<?php echo substr($visitor['visitor_reason'],0, 50);?> 
                                    <?php if(strlen($visitor['visitor_reason'])>50){?>
                                    <a href="javascript:;" onclick="show_more_text('<?php echo $visitor['id']?>','visitor_requests')" 
                                    class="show_more_anchor_<?php echo $visitor['id']?>"> show more </a>
                                    <span class="show_more_span_<?php echo $visitor['id']?>" style="display:none">
                                        <?php echo substr($visitor['visitor_reason'],50, 10000);?>
                                    </span>
                                    <a href="javascript:;" onclick="show_less_text('<?php echo $visitor['id']?>','visitor_requests')" 
                                    class="show_less_anchor_<?php echo $visitor['id']?>" style="display:none"> show less </a>
                                    <?php }?>
                    			</td>	
                                    
                                 <td>
                                  <?php 
							 if(date('YmdHis',strtotime($delivery['deliverydatetime'])) > date('YmdHis') && $delivery['check_in']!= '0000-00-00 00:00:00' && $delivery['check_out']!= '0000-00-00 00:00:00')
							  { 
								  echo '<span class="label label-info">Delivered</span>';
							  }
							  elseif(date('YmdHis',strtotime($delivery['deliverydatetime'])) < date('YmdHis') && $delivery['check_in']!= '0000-00-00 00:00:00' && $delivery['check_out']!= '0000-00-00 00:00:00')
							  {
								  echo '<span class="label label-warning">Delivered and Expired</span>';
							  }
							  elseif(date('YmdHis',strtotime($delivery['deliverydatetime'])) < date('YmdHis') && $delivery['check_in']== '0000-00-00 00:00:00' && $delivery['check_out']== '0000-00-00 00:00:00')
							  {
								  echo '<span class="label label-danger">Expired</span>';
							  }
							  else
							  {
								  echo '<span class="label label-default">In Progress</span>';
							  }
							?>
                                 
                                 </td>
                                </tr>
                                <?php }
                                }?>
                            </tbody>
                        </table>
                        </div>
                        </div>
                         <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>
<!-- Modal -->


<!-- Modal Email-->

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
	  var postData={ 
					  id			:id,
					  subject		:subject,
					  message		:message
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