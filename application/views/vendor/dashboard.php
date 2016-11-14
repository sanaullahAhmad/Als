<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Dashboard
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
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?php echo sizeof($service_requests);?>">0</span>
                        </div>
                        <div class="desc"> Service Requests </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="<?php echo base_url()?>vendor/vendor_quotes">
                    <div class="visual">
                        <i class="fa fa-file-pdf-o"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup" data-value="<?php echo sizeof($vendor_quotes);?>">0</span></div>
                        <div class="desc"> My Quotes </div>
                    </div>
                </a>
            </div>
          </div>
      <!-- Table -->
   <?php if(sizeof($service_requests)>0){?>		
    <div class="widget">
      <?php if ($this->session->flashdata('success_message')) { ?>
    <div style="float:left; width:100%; height:50px; position:relative; z-index:111111; margin-bottom:15px;">
        <div class="alert alert-success"> <?= $this->session->flashdata('success_message') ?> </div>
    </div>
<?php } ?>
        <div class="widget-head">
            <h4 class="heading">Service Requests</h4>
        </div>
        <div class="widget-body innerAll inner-2x">
            <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="genral">
        <thead class="tr-green-bg">
            <tr>
                <th>Requested By</th>
                <th>Condo</th>
                <th>Service</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Requested Time</th>
                <th>Attachment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
		if(sizeof($service_requests)>0)
		{
        foreach($service_requests as $service_request){
			$tomorrow = strtotime($service_request['requested_time'] . "+".$service_request['duration']." days"); 
			$now=time();
			$datediff = $tomorrow - $now;
			$res_diff = floor($datediff/(60*60*24));
			/*$count=$this->General_model->get_data_all_like_using_where_count('service_quotes',"service_request_id=".$service_request['id']);
			
			if($count==0 && $res_diff >0){*/
        ?>
            <tr class="gradeX" id="<?php echo $service_request['id'];?>">
                <td><?php echo $this->General_model->get_value_by_id('residents', $service_request['requested_by'], 'name')?></td>
                <td><?php echo $this->General_model->get_value_by_id('condos', $service_request['condo_id'], 'name')?></td>
                <td><?php echo $this->General_model->get_value_by_id('services', $service_request['service_id'], 'name')?></td>
                <td><?php echo $service_request['description']?></td>
                <td>
				<?php 
					  echo $res_diff;
				?> Days remaining</td>
                <td><?php echo date('jS M h:i a', strtotime($service_request['requested_time']))?></td>
                <td>
				 
                <?php if($service_request['service_request_file']==''){ echo "No File";}else{
				$n=$this->General_model->get_data_all_like_using_where('service_requests_images',"service_request_id=".$service_request['id']);
				if(sizeof($n)>0)
				{
					foreach($n as $request_image)
					{
						?>
                        <a href="<?php echo base_url()?>uploads/services_requests/<?php echo $request_image['image_url']?>" 
                        target="_blank" class="btn green"> View</a>
                        <?php
					}
				}
                //echo '<a href="'.base_url().'uploads/services_requests/'.$service_request['service_request_file'].'" target="_blank" class="btn green"> View</a>';
               
				}?>
                </td>
                
                <td>
                <?php $rows=$this->General_model->get_data_all_like_using_where('service_quotes',"service_request_id=".$service_request['id']);
				if(sizeof($rows)>0)
				{ echo "<span class='label label-info'>Quote Sent</span>";}//.sizeof($rows);print_r($rows);
				else{?>
                    <a class="" href="<?php echo base_url();?>vendor/quote_request/<?php echo $service_request['id']?>" title="Send Quote">
                        <span class="fa fa-send"></span>
                    </a>
                <?php }?>
                </td>
            </tr>
            <?php //}
			}
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