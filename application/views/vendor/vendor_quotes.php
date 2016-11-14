<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Quotations
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Quotations</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->                                                            
    <?php if(sizeof($vendor_quotes)>0){?>		
    <div class="widget">
        
        <div class="widget-body innerAll inner-2x">
      <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="genral">
        <thead class="bg-gray">
            <tr class="tr-green-bg">
                <th>Requested By</th>
                <th>Condo</th>
                <th>Service</th>
                <th>Description</th>
                <th>Attachment</th>
                <th>Time Remaining</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($vendor_quotes as $vendor_quote){
			$service_request_info= $this->General_model->get_data_row_using_where('service_requests', "id=".$vendor_quote['service_request_id']);
        ?>
            <tr class="gradeX" id="<?php echo $vendor_quote['id'];?>">
            	<td><?php echo $this->General_model->get_value_by_id('residents', $service_request_info->requested_by, 'name')?></td>
                <td><?php echo $this->General_model->get_value_by_id('condos', $service_request_info->condo_id, 'name')?></td>
                <td><?php echo $this->General_model->get_value_by_id('services', $service_request_info->service_id, 'name')?></td>
                <td><?php echo $vendor_quote['description']?></td>
               
                <td>
				<a href="<?php echo base_url();?>uploads/services_quotes/<?php echo $vendor_quote['quotation_file']?>" target="_blank" class="btn green"> Download
                    <i class="fa fa-edit"></i>
                </a>
                </td>
                <td>
				<?php 
				$request_details =$this->General_model->get_data_row_using_where("service_requests","id=".$vendor_quote['service_request_id']);
				$tomorrow = strtotime($request_details->requested_time . "+".$request_details->duration." days"); 
					  $now = time(); // or your date as well
					  $datediff = $tomorrow - $now;
					  echo floor($datediff/(60*60*24));
				?> Days <?php if(floor($datediff/(60*60*24))>=0){?>remaining<?php }else{?>gone away<?php }?></td>
                <td>
                    <a class="" href="<?php echo base_url();?>vendor/services_quotes_comments/<?php echo $vendor_quote['id']?>" title="Message Board">
                        <i class="fa fa-weixin"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
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