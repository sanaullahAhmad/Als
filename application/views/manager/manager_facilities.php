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
      <a href="<?php echo base_url();?>manager/add_condo_facility" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary"  >Add Facility</a>
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
        <div class="widget">
            <div class="widget-head">
                <h4 class="heading">Facilities</h4>
            </div>
            <div class="widget-body innerAll inner-2x">												
                <table class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
                    <thead class="bg-gray">
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                           <?php /*?> <th>Image</th><?php */?>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(sizeof($facility_bookings)>0){?>	
                    <?php
                    foreach($facility_bookings as $facility_booking){
                    ?>
                        <tr class="gradeX">
                            <td><?php echo $facility_booking['name'];?></td>
                            <td><?php echo $facility_booking['description'];?></td>
                           <?php /*?> <td><img src="<?php echo base_url();?>uploads/facilities_images/<?php echo $facility_booking['image_url'];?>" style="width:100px;" /></td><?php */?>
                            <td><?php echo $facility_booking['price'];?></td>
                            <td id="advert_id_<?php echo $facility_booking['id']?>">
                                <a href="<?php echo base_url()?>manager/edit_condo_facility/<?php echo $facility_booking['id']?>" title="Edit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a onclick="callCrudAction('condo_facilities','<?php echo $facility_booking['id']?>','delete_data')" href="javascript:;" title="delete">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>	
		 </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>