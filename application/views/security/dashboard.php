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
      <a href="<?php echo base_url();?>security/add_visitor_delivery" class="btn btn-info pull-right" style="margin:15px 15px 0 0">
          Add Visitor/Delivery Request 
      </a>
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
              <div style="float:left; width:100%; height:50px; position:relative; 
              z-index:111111; margin-bottom:15px;">
                      <h3 class="innerTB" style="float:left; margin-left:20px;">
                          Visitor Registration
                      </h3>
                      
               </div>
              <div class="widget">
                  <div class="widget-body innerAll inner-2x">
                  <!-- Table -->
                  <table class="table  table-bordered dt-responsive nowrap" id="sample_2"  cellspacing="0" width="100%">
                <!-- Table heading -->
                <thead class="bg-gray">
                <tr>
                <th>Visitor for</th>
                <?php /*?> <th>Resident Phone Number</th><?php */?>
                <th>Visit Date and Time</th>
                <th>Vehicle Number</th>
                <th>Reason for Visit</th>
                <th>Checkin/Checkout Time</th>
                <th>Visitor Name</th>
                <th>ID No.</th>
                </tr>
                </thead>
                <!-- // Table heading END -->
                
                <!-- Table body -->
                <tbody>
                <?php
                foreach($visitor_requests as $visitor_request){
                //Check if today or tomorrow
                $current_date   = strtotime(date("Y-m-d"));
                $actual_date    = strtotime($visitor_request['visitdatetime']);
                $datediff = $actual_date - $current_date;
                $difference = floor($datediff/(60*60*24));
                if($difference==0){
                $actual_visitor_time = 'Today';
                }  else if($difference > 0){
                $actual_visitor_time = 'Tomorrow';
                } else {
                $actual_visitor_time = 'N/A';
                }
                
                $block_no = $this->General_model->get_value_by_id('residents', $visitor_request['visitor_for'], 'block');
                $unit_info = $this->General_model->get_value_by_id('blocks', $block_no, 'name').
                '-'.$this->General_model->get_value_by_id('residents', $visitor_request['visitor_for'], 'floor').
                '-'.$this->General_model->get_value_by_id('residents', $visitor_request['visitor_for'], 'unit');
                ?>
                <!-- Table row -->
                <tr class="gradeX" >
                <td><?php echo $this->General_model->get_value_by_id('residents', $visitor_request['visitor_for'], 'name').
                ' ('.$unit_info.')'?></td>
                <?php /*?><td><?php echo $this->General_model->get_value_by_id('residents', $visitor_request['visitor_for'], 'phone')?></td><?php */?>
                <td><?php echo $actual_visitor_time.' '.date('h:i a',strtotime($visitor_request['visitdatetime']))?></td>
                <td><?php echo $visitor_request['vehicle_no']?></td>
                <td><?php echo $visitor_request['visitor_reason']?></td>
                <?php  $checkin = "check_in";$icon = "download"; 
                $visitor_request_id = $visitor_request['id'];
                $check_in_row = $this->General_model->get_data_rowusingwhere_empty_array('visitor_requests',"id=$visitor_request_id  and 
                check_in !='0000-00-00 00:00:00' ");
                $check_out_row = $this->General_model->get_data_rowusingwhere_empty_array('visitor_requests',"id=$visitor_request_id  and 
                check_out !='0000-00-00 00:00:00' ");
                $check_in_time = "";
                $check_out_time = "";
                if(sizeof($check_in_row)>0)
                {
                $checked_in = true;
                $checkin 		= "check_out";
                $checkintitile = "Check Out";
                $icon 	  		= "upload";
                $check_in_time = "Check In: ".date("Y-m-d h:i A",strtotime($check_in_row->check_in))."<br>";
                }
                else
                {
                $checked_in = false;
                $checkin 		= "check_in";
                $checkintitile = "Check In";
                $icon 	  		= "download"; 
                }
                if(sizeof($check_out_row)>0)
                {
                $checked_out = true;
                $check_in_time  = "Check In: ".date("Y-m-d h:i A",strtotime($check_out_row->check_in))."<br>";
                $check_out_time = "Check Out: ".date("Y-m-d h:i A",strtotime($check_out_row->check_out))."<br>";
                }
                else
                {
                $checked_out = false;
                }
                
                
                ?>
                <td>
                <span class="check_in_time_visitor_requests_<?php echo $visitor_request['id'];?>"><?php echo $check_in_time;?></span>
                <span class="check_out_time_visitor_requests_<?php echo $visitor_request['id'];?>"><?php echo $check_out_time;?></span>
                
                <?php if($checked_in ===false && $checked_out===false){?>
                
                <a href="javascript:;" class="glyphicons <?php echo $icon;?> checkintimecl_visitor_requests_<?php echo $visitor_request['id'];?>" 
                onclick="checkintime('<?php echo $checkin;?>','<?php echo $visitor_request['id'];?>', 'visitor_requests')">
                <i></i>
                <span><?php echo $checkintitile;?></span>
                </a>
                <?php }
                elseif($checked_in===true && $checked_out===false){
                ?>
                
                <a href="javascript:;" class="glyphicons <?php echo $icon;?> checkintimecl_visitor_requests_<?php echo $visitor_request['id'];?>" 
                onclick="checkintime('<?php echo $checkin;?>','<?php echo $visitor_request['id'];?>', 'visitor_requests')">
                <i></i>
                <span><?php echo $checkintitile;?></span>
                </a>
                <?php }?>
                </td>
                
                <td><?php echo $visitor_request['visitor_name']?></td>
                <td><?php echo $visitor_request['icid_number']?></td>
                </tr>
                <!-- // Table row END -->
                <?php } ?>
                </tbody>
                <!-- // Table body END -->
                </table>
                  <!-- // Table END -->                      
                </div>
              </div>
              <div style="float:left; width:100%; height:50px; position:relative; z-index:111111; margin-bottom:15px;">
                <h3 class="innerTB" style="float:left; margin-left:20px;">Deliveries Registration</h3>
              </div>
              <div class="widget">
                  <div class="widget-body innerAll inner-2x">
                  <!-- Table -->
                  <table class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
                  <!-- Table heading -->
                  <thead class="bg-gray">
                  <tr>
                  <th>Delivery for</th>
                  <th>Company Name</th>
                  <?php /*?><th>Resident Phone Number</th><?php */?>
                  <th>Delivery Date and Time</th>
                  <th>Delivery Details</th>
                  <th>Checkin/Checkout Time</th>
                  <th>Driver  Name</th>
                  <th>ID No.</th>
                  </tr>
                  </thead>
                  <!-- // Table heading END -->
                  <!-- Table body -->
                  <tbody>
                  <?php
                  foreach($delivery_requests as $delivery_request){
                  //Check if today or tomorrow
                  $current_date   = strtotime(date("Y-m-d"));
                  $actual_date    = strtotime($delivery_request['deliverydatetime']);
                  $datediff = $actual_date - $current_date;
                  $difference = floor($datediff/(60*60*24));
                  if($difference==0){
                  $actual_delivery_time = 'Today';
                  }  else if($difference > 0){
                  $actual_delivery_time = 'Tomorrow';
                  } else {
                  $actual_delivery_time = 'N/A';
                  }
                  
                  $block_no = $this->General_model->get_value_by_id('residents', $delivery_request['delivery_for'], 'block');
                  $unit_info = $this->General_model->get_value_by_id('blocks', $block_no, 'name').
                  '-'.$this->General_model->get_value_by_id('residents', $delivery_request['delivery_for'], 'floor').
                  '-'.$this->General_model->get_value_by_id('residents', $delivery_request['delivery_for'], 'unit');
                  ?>
                  <!-- Table row -->
                  <tr class="gradeX" >
                  <td><?php echo $this->General_model->get_value_by_id('residents', $delivery_request['delivery_for'], 'name').
                  ' ('.$unit_info.')'?></td>
                  <td><?php echo $delivery_request['company_name']?></td>
                  <?php /*?><td><?php echo $this->General_model->get_value_by_id('residents', $delivery_request['delivery_for'], 'phone')?></td><?php */?>
                  <td><?php echo $actual_delivery_time.' '.date('h:i a',strtotime($delivery_request['deliverydatetime']))?></td>
                  <td><?php echo $delivery_request['description']?></td>
                  <?php  $checkin = "check_in";$icon = "download"; 
                  $delivery_request_id = $delivery_request['id'];
                  $check_in_row = $this->General_model->get_data_rowusingwhere_empty_array('delivery_requests',"id=$delivery_request_id  and 
                  check_in !='0000-00-00 00:00:00' ");
                  $check_out_row = $this->General_model->get_data_rowusingwhere_empty_array('delivery_requests',"id=$delivery_request_id  and 
                  check_out !='0000-00-00 00:00:00' ");
                  $check_in_time = "";
                  $check_out_time = "";
                  if(sizeof($check_in_row)>0)
                  {
                  $checked_in = true;
                  $checkin 		= "check_out";
                  $checkintitile = "Check Out";
                  $icon 	  		= "upload";
                  $check_in_time = "Check In: ".date("Y-m-d h:i A",strtotime($check_in_row->check_in))."<br>";
                  }
                  else
                  {
                  $checked_in = false;
                  $checkin 		= "check_in";
                  $checkintitile = "Check In";
                  $icon 	  		= "download"; 
                  }
                  if(sizeof($check_out_row)>0)
                  {
                  $checked_out = true;
                  $check_in_time  = "Check In: ".date("Y-m-d h:i A",strtotime($check_out_row->check_in))."<br>";
                  $check_out_time = "Check Out: ".date("Y-m-d h:i A",strtotime($check_out_row->check_out))."<br>";
                  }
                  else
                  {
                  $checked_out = false;
                  }
                  
                  
                  ?>
                  <td>
                  <span class="check_in_time_delivery_requests_<?php echo $delivery_request['id'];?>"><?php echo $check_in_time;?></span>
                  <span class="check_out_time_delivery_requests_<?php echo $delivery_request['id'];?>"><?php echo $check_out_time;?></span>
                  
                  <?php if($checked_in ===false && $checked_out===false){?>
                  
                  <a href="javascript:;" class="glyphicons <?php echo $icon;?> checkintimecl_delivery_requests_<?php echo $delivery_request['id'];?>" 
                  onclick="checkintime('<?php echo $checkin;?>','<?php echo $delivery_request['id'];?>', 'delivery_requests')">
                  <i></i>
                  <span><?php echo $checkintitile;?></span>
                  </a>
                  <?php }
                  elseif($checked_in===true && $checked_out===false){
                  ?>
                  
                  <a href="javascript:;" class="glyphicons <?php echo $icon;?> checkintimecl_delivery_requests_<?php echo $delivery_request['id'];?>" 
                  onclick="checkintime('<?php echo $checkin;?>','<?php echo $delivery_request['id'];?>', 'delivery_requests')">
                  <i></i>
                  <span><?php echo $checkintitile;?></span>
                  </a>
                  <?php }?>
                  </td> 
                  <td><?php echo $delivery_request['driver_name']?></td>
                  <td><?php echo $delivery_request['icid_number']?></td>
                  </tr>
                  <!-- // Table row END -->
                  <?php } ?>
                  </tbody>
                  <!-- // Table body END -->
                  </table>
                  <!-- // Table END -->                     
                  </div>
              </div>
		</div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>