<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Dashboard
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
              <span>Dashboard</span>
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
<?php if(sizeof($residents)>0){?>		
<div class="widget">
	<div class="widget-head">
		<h4 class="heading">Residents</h4>
	</div>
	<div class="widget-body innerAll inner-2x">

		<table class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
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
	<tbody>
	<?php
	foreach($residents as $resident){
	?>
		<tr class="gradeX" id="<?php echo $resident['id'];?>">
            <td><?php echo $resident['name']?></td>
            <td><?php echo $resident['email']?></td>
            <td><?php echo $resident['phone']?></td>
            <td><?php if($resident['type']==1){echo "Tenant";} else { echo "Owner";}?></td>
            <td><?php echo $this->General_model->get_value_by_id('blocks', $resident['block'], 'name').'-'.$resident['floor'].'-'.$resident['unit'];?></td>
            <td><?php if($resident['status']==1){echo "Active";} else { echo "Inactive";}?></td>
            <td>
                <a class="" href="javascript:;" onclick="approve_resident('<?php echo $resident['id']?>','1')" title="Approve">
                	<span class="glyphicon glyphicon-ok"></span>
                </a>
                <a class="" href="javascript:;" onclick="approve_resident('<?php echo $resident['id']?>','3')" title="Disapprove">
                	<span class="glyphicon glyphicon-remove"></span>
                </a>
            </td>
		</tr>
		<?php } ?>
	</tbody>
</table>
	</div>
</div>										

<?php }?>	



<?php /*if(sizeof($adverts)>0){?>	
<div class="widget">
	<div class="widget-head">
		<h4 class="heading">Advertisements</h4>
	</div>
	<div class="widget-body innerAll inner-2x">												
        <table class="table  table-bordered dt-responsive nowrap" id="example1"  cellspacing="0" width="100%">
            <thead class="bg-gray">
                <tr>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Image</th>
                    <th>Payment Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($adverts as $advert){
            ?>
                <tr class="gradeX" id="advert_<?php echo $advert['id'];?>">
                    <td><?php echo $advert['title']?></td>
                    <td><?php echo $advert['ad_link']?></td>
                    <td><img src="<?php echo base_url()."uploads/advertisement_images/".$advert['image_url']?>"  width="100" height="100"/></td>
                    <td><?php if($advert['payment_status'] == '1'){ echo 'Paid';} else { echo 'Not Paid';}?></td>
                    <td>
                        <a class="" href="javascript:;" onclick="approve_advert('<?php echo $advert['id']?>','1')" title="Approve">
                            <span class="glyphicon glyphicon-ok"></span>
                        </a>
                        <a class="" href="javascript:;" onclick="approve_advert('<?php echo $advert['id']?>','3')" title="Disapprove">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
	</div>
</div>	
<?php }*/?>



<?php if(sizeof($posts)>0){?>		
<div class="widget">
	<div class="widget-head">
		<h4 class="heading">Posts</h4>
	</div>
	<div class="widget-body innerAll inner-2x">												
        <table class="table  table-bordered dt-responsive nowrap" id="sample_2"  cellspacing="0" width="100%">
            <thead class="bg-gray">
                <tr>
                    <th>Posted By</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($posts as $post){
            ?>
                <tr class="gradeX" id="<?php echo $post['id'];?>">
                    <td><?php echo $this->General_model->get_value_by_id('residents', $post['posted_by'], 'name')?></td>
                    <td class="posts">
						<?php echo substr($report['description'],0, 50);?> 
                        <a href="javascript:;" onclick="show_more_text('<?php echo $report['id']?>','posts')" 
                        class="show_more_anchor_<?php echo $report['id']?>"> show more </a>
                        <span class="show_more_span_<?php echo $report['id']?>" style="display:none">
                            <?php echo substr($report['description'],50, 10000);?>
                        </span>
                        <a href="javascript:;" onclick="show_less_text('<?php echo $report['id']?>','posts')" 
                        class="show_less_anchor_<?php echo $report['id']?>" style="display:none"> show less </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
	</div>
</div>	
<?php }?>


<?php if(sizeof($visitor_requests)>0){?>		
<div class="widget">
	<div class="widget-head">
		<h4 class="heading">Visitor Requests</h4>
	</div>
	<div class="widget-body innerAll inner-2x">		
        <table   class="table  table-bordered dt-responsive nowrap" id="sample_3"  cellspacing="0" width="100%">
            <thead class="bg-gray">
                <tr>
                    <th>vehicle number</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($visitor_requests as $report){
            ?>
                <tr class="gradeX">
                    <td><?php echo $report['vehicle_no'];?></td>
                    <td><?php echo date("Y-m-d", strtotime($report['visitdatetime']))?></td>
                    <td><?php echo date("H:i:s", strtotime($report['visitdatetime']))?></td>
                    <td class="visitor_requests">
                    	<?php echo substr($report['visitor_reason'],0, 50);?> 
                        <a href="javascript:;" onclick="show_more_text('<?php echo $report['id']?>','visitor_requests')" 
                        class="show_more_anchor_<?php echo $report['id']?>"> show more </a>
                        <span class="show_more_span_<?php echo $report['id']?>" style="display:none">
                            <?php echo substr($report['visitor_reason'],50, 10000);?>
                        </span>
                        <a href="javascript:;" onclick="show_less_text('<?php echo $report['id']?>','visitor_requests')" 
                        class="show_less_anchor_<?php echo $report['id']?>" style="display:none"> show less </a>
                    
						
                    </td>	
                </tr>
                <?php 
                } ?>
            </tbody>
        </table>
	</div>
</div>	
<?php }

 if(sizeof($delivery_requests)>0){?>		
<div class="widget">
	<div class="widget-head">
		<h4 class="heading">Delivery Requests</h4>
	</div>
	<div class="widget-body innerAll inner-2x">	
        <table   class="table  table-bordered dt-responsive nowrap" id="sample_4"  cellspacing="0" width="100%">
            <!-- Table heading -->
            <thead class="bg-gray">
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Description</th>
                    <th>Attachment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <!-- // Table heading END -->
            <!-- Table body -->
            <tbody>
            <?php
            foreach($delivery_requests as $report){
            ?>
                <!-- Table row -->
                <tr class="gradeX">
                    <td><?php echo date("Y-m-d", strtotime($report['deliverydatetime']))?></td>
                    <td><?php echo date("H:i:s", strtotime($report['deliverydatetime']))?></td>
                    <td class="delivery_requests">
                    <?php echo substr($report['description'],0, 50);?> 
                    <a href="javascript:;" onclick="show_more_text('<?php echo $report['id']?>','delivery_requests')" 
                    class="show_more_anchor_<?php echo $report['id']?>"> show more </a>
                    <span class="show_more_span_<?php echo $report['id']?>" style="display:none">
                        <?php echo substr($report['description'],50, 10000);?>
                    </span>
                    <a href="javascript:;" onclick="show_less_text('<?php echo $report['id']?>','delivery_requests')" 
                    class="show_less_anchor_<?php echo $report['id']?>" style="display:none"> show less </a>
                     
                     <td><a target="_blank" href="<?php echo base_url()?>uploads/post_images/<?php echo $report['reciept']?>" />View Receipt</a></td>
                     
                     <td>
                        <a class="" href="javascript:;" onclick="approve_delivery('<?php echo $report['id']?>','1')" title="Approve">
                            <span class="glyphicon glyphicon-ok"></span>
                        </a>
                        <a class="" href="javascript:;" onclick="approve_delivery('<?php echo $report['id']?>','3')" title="Disapprove">
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
	</div>
</div>	
<?php }?>

<?php if(sizeof($service_quotes)>0){?>		
<div class="widget">
	<div class="widget-head">
		<h4 class="heading">Vendors Qoutes</h4>
	</div>
	<div class="widget-body innerAll inner-2x">		
        <table   class="table  table-bordered dt-responsive nowrap" id="sample_5"  cellspacing="0" width="100%">
	<thead class="bg-gray">
		<tr>
			<th>Quoted By</th>
			<th>Arrival Date</th>
			<th>Message</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach($service_quotes as $report){
	?>
		<tr class="gradeX" id="qoute_<?php echo $report['id']?>">
            <td><?php echo $this->General_model->get_value_by_id('vendors', $report['quoted_by'], 'name');?></td>
            <td><?php echo date("Y-m-d h:i:s a", strtotime($report['ven_arival_time']))?></td>
            
            <td class="service_quotes">
				<?php echo substr($report['message'],0, 50);?> 
                <?php if(strlen(strip_tags($report['message']))>50){?>
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
<?php }?>
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