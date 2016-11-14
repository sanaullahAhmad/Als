<style>
.day_slot_value .form-group
{
	margin:0px;
}
.day_slot_value .form-group .col-md-9
{
	padding-left:14px !important;
}
</style>
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
          <form method="POST" id="add-facility-booking" class="form-horizontal" action="<?php echo base_url();?>manager/add_facility_booking" > 
            <div class="form-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Block</label>
              <div class="col-md-3">
                  <select id="block" name="block" onchange="change_floors(this.value)" class="form-control">
                      <option value="">
                          Block
                      </option>
                      <?php
                        if(sizeof($blocks)>0)
                        {
                            foreach($blocks as $block)
                            {
                                ?>
                                <option value="<?php echo $block['id']?>" ><?php echo $block['name']?></option>
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
            <div class="form-group">
                <label class="col-md-3 control-label">Floor</label>
                <div class="col-md-3">
                    <select id="floors" name="floors" class="form-control">
                        <option value="">
                            Floor
                        </option>
                    </select>
                    <span class="error_individual" id="floors_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">Unit</label>
                <div class="col-md-3">
                    <select id="unit" name="unit" class="form-control" onchange="search_resident()">
                        <option value="">
                            Unit
                        </option>
                    </select>
                    <span class="error_individual" id="unit_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label">resident</label>
                <div class="col-md-3">
                    <select class="form-control" id="resident" name="resident">
                    <?php /*?><?php 
                      $residents=$this->General_model->get_data_all_like_using_where('residents', "condo_id=$this->condo_id");
                      foreach($residents as $resident)
                      {
                    ?>
                      <option value="<?php echo $resident['id'];?>"><?php echo $resident['name'];?></option>
                      <?php }?><?php */?>
                    </select>
                    <span id="resident_validate" class="error_individual help-block"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-3 control-label">Facility</label>
                <div class="col-md-3">
                    <select class="form-control" id="condo_facility" name="condo_facility" onchange="show_calender_button(this.value)">
                      <option value="">Facility</option>
                    <?php 
                      $facilities=$this->General_model->get_data_all_like_using_where('condo_facilities', "condo_id=$this->condo_id order by name ASC");
                      foreach($facilities as $facility)
                      {
                      ?>
                      <option value="<?php echo $facility['id'];?>"><?php echo $facility['name'];?></option>
                      <?php 
					  }
					?>
                    </select>
                    <span id="condo_facility_validate" class="error_individual help-block"></span>
                    <input id="session_time_hidden" value="" type="hidden" />
                </div>
                 <div class="col-md-3" style="display:none">
                    <a href="<?php echo base_url();?>manager/calender" class="btn btn-primary pull-left" style="display:none" id="calender_button">Show Calender</a>
                </div>
            </div>
            
            <div class="day_slot_value">
              		
 			  </div>
             
               
               <input type="hidden" class="form-control" id="day_slot_val_append" name="day_slot_val_append"/>  
            
            <div class="form-group">
                <label class="col-md-3 control-label">Date</label>
                <div class="col-md-3">
                    <input type="text" class="form-control datepicker" id="startdate" name="startdate" readonly="readonly">
                    <span id="startdate_validate" class="error_individual help-block"></span>
                </div>
            </div>
            <div class="form-group" style="display:none;">
                <label class="col-md-3 control-label">StartTime</label>
                <div class="col-md-3">
                    <input type="text" class="form-control timepicker" id="starttime" name="starttime"  readonly="readonly" onchange="calculate_end_time(this.value)"> 
                    <!--onblur="prepare_end_time(this.value)"-->
                    <!-- -->
                    <span id="starttime_validate" class="error_individual help-block"></span>
                </div>
            </div>
           <!-- <div class="form-group">
                <label class="col-md-3 control-label">EndDate</label>
                <div class="col-md-3">
                    <input type="text" class="form-control datepicker" id="enddate" name="enddate"  readonly="readonly">
                    <span id="enddate_validate" class="error_individual help-block"></span>
                </div>
            </div>-->
            <div class="form-group" style="display:none;">
                <label class="col-md-3 control-label">EndTime</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="endtime" name="endtime"  readonly="readonly">
                    <span id="endtime_validate" class="error_individual help-block"></span>
                </div>
            </div>
         </div>
         <div class="form-actions">
                <div class="row">
                    <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="facility_booking_submit" class="btn green">Submit</button>
                    </div>
                </div>
            </div>
         </form>
         </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>