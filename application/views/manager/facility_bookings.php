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
      <a href="<?php echo base_url();?>manager/facility_booking_form" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary"  >Add Booking</a>
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
		<?php if(sizeof($facility_bookings)>0){?>	
        <div class="widget">
            <div class="widget-head">
                <h4 class="heading">Facility</h4>
            </div>
            <div class="widget-body innerAll inner-2x">												
                <table class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
                    <thead class="bg-gray">
                        <tr>
                            <th>Facility</th>
                            <th>Resident</th>
                            <th>Unit No.</th>
                            <th>Booking Date</th>
                            <th>Session Time</th>
                            <th>Status</th>
                            <th>Booking Required</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($facility_bookings as $facility_booking){
                    ?>
                        <tr class="gradeX">
                            <td><?php echo $this->General_model->get_value_by_id('condo_facilities',$facility_booking['facility_id'],'name')?></td>
                            <td><?php echo $this->General_model->get_value_by_id('residents',$facility_booking['resident_id'],'name')?></td>
                            <td><?php echo $this->General_model->get_value_by_id('residents',$facility_booking['resident_id'],'block')?>-<?php echo $this->General_model->get_value_by_id('residents',$facility_booking['resident_id'],'floor')?>-<?php echo $this->General_model->get_value_by_id('residents',$facility_booking['resident_id'],'unit')?></td>
                            
                            <td>
                            <?php echo date('Y-m-d', strtotime($facility_booking['bookedfor_datetime_from']));?> 
                            </td>
                            <td>
                            <?php echo $this->General_model->get_value_by_id('condo_facilities',$facility_booking['facility_id'],'session_time')/60;?> Hrs
                            </td>
                            
                           
        <td>
		  <?php if($this->General_model->get_data_value_using_where('invoices',"booking_id=".$facility_booking['id'],'payment_status')==0){
			  echo "Pending";
		} else if($this->General_model->get_data_value_using_where('invoices',"booking_id=".$facility_booking['id'],'payment_status')==3){
			echo 'Disapproved';
		} else { echo "Approved";}?>
        </td>	
                            
                            <td><?php if($this->General_model->get_value_by_id('condo_facilities',$facility_booking['facility_id'],'is_booking_required')){echo 'Yes';}else{ echo "No";}?></td>
                            
                            <td id="facility_booking_<?php echo $facility_booking['id'];?>"><?php if($this->General_model->get_data_value_using_where('invoices',"booking_id =".$facility_booking['id'],'payment_status') == '1'){ echo 'Paid';} else { ;?>
                                <a class="" href="javascript:;" onclick="approve_facility_booking('<?php echo $facility_booking['id']?>','1')" title="Approve">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </a>
                                <a class="" href="javascript:;" onclick="approve_facility_booking('<?php echo $facility_booking['id']?>','3')" title="Disapprove">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                                <!--<a class="" href="<?php echo base_url();?>manager/edit_facility_booking/<?php echo $facility_booking['id']?>" title="Edit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>-->
                            </td>
                            <?php }?>
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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
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