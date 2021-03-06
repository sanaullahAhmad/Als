<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Condo Facility
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
              <span>Add Condo Facility</span>
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
        <form id="addfacility-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">Facility Category</label>
                <div class="col-sm-10">
                    <select class="form-control" id="facility_category" name="facility_category" onchange="check_info_only(this.value)" >
                        <option value="">Facility Category</option>
                        <?php 
                        if(sizeof($facility_categories)>0)
                        {
                            foreach($facility_categories as $category)
                            {
                        ?>
                        <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
                        <?php }
                        }?>
                    </select>
                    <span class="error_individual" id="facility_category_validate"></span>
                </div>
            </div>
            <div class="form-group check_info_only_file" style="display:none;">
                <label class="col-sm-2 control-label">File </label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="image_url" name="image_url"  >
                    <span class="error_individual" id="image_url_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    <span class="error_individual" id="name_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                    <span class="error_individual" id="description_validate"></span>
                </div>
            </div>
            
            
            <div class="form-group check_info_only">
                <label class="col-sm-2 control-label">Deposit required?</label>
                <div class="col-sm-10">
                    <select class="form-control" name="is_deposit_required" onchange="deposit_required(this.value)">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    <span class="error_individual" id="is_deposit_required_validate"></span>
                </div>
            </div>
            <div class="form-group deposit_amount_markup" style="display:none;">
                <label class="col-sm-2 control-label">Amount (RM)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="deposit_amount" name="deposit_amount" placeholder="xxxxx" >
                    <span class="error_individual" id="deposit_amount_validate"></span>
                </div>
            </div>
            
            <div class="form-group " style="display:none;">
                <label class="col-sm-2 control-label">Booking required?</label>
                <div class="col-sm-10">
                    <select class="form-control" id="is_booking_required" name="is_booking_required" onchange="bookingchange(this.value)">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <span class="error_individual" id="is_booking_required_validate"></span>
                </div>
            </div>
            <div class="form-group check_info_only">
                <label class="col-sm-2 control-label">Day range settings required?</label>
                <div class="col-sm-10">
                    <select class="form-control" id="is_day_rang_settings" name="is_day_rang_settings" onchange="day_rang_settings_change(this.value)">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    <span class="error_individual" id="is_day_rang_settings_validate"></span>
                </div>
            </div>
            
            <div class="form-group day_rang_settings_change" style="display:none;">
                <label class="col-sm-2 control-label">Min days(0-14) </label>
                <div class="col-sm-4">
                    <input class="form-control" id="is_day_rang_settings_min" name="is_day_rang_settings_min" placeholder="0-14">
                    <span class="error_individual" id="is_day_rang_settings_min_validate"></span>
                </div>
                <label class="col-sm-2 control-label">Max days </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="is_day_rang_settings_max" name="is_day_rang_settings_max" >
                    <span class="error_individual" id="is_day_rang_settings_max_validate"></span>
                </div>
            </div>
            
            <div class="form-group bookingchange check_info_only">
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="price" name="price" placeholder="Price">
                    <span class="error_individual" id="price_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Opening Hour</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control timepicker" id="opening_hour" name="opening_hour" placeholder="Opening Hour">
                    <span class="error_individual" id="opening_hour_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Closing Hour</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control timepicker" id="closing_hour" name="closing_hour" placeholder="Closing Hour">
                    <span class="error_individual" id="closing_hour_validate"></span>
                </div>
            </div>
            
            <div class="form-group bookingchange check_info_only">
                <label class="col-sm-2 control-label">Session Time</label>
                <div class="col-sm-5">
                    <select class="form-control" id="session_hour" name="session_hour">
                        <option value="">Session Hour</option>
                        <!--<option value="0">0</option>-->
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                    </select>
                    <span class="error_individual" id="session_hour_validate"></span>
                </div>
                <!--<div class="col-sm-5">
                    <select class="form-control" id="session_minute" name="session_minute">
                        <option value="">Minutes</option>
                        <option value="0">00</option>
                        <option value="30">30</option>
                    </select>
                    <span class="error_individual" id="session_minute_validate"></span>
                </div>-->
            </div>
            
            <div id="append-div">
                
            </div>
            
            <div class="form-group bookingchange check_info_only">
                <label class="col-sm-2 control-label">Booking Limit</label>
                <div class="col-sm-4">
                    <select class="form-control" id="booking_limit" name="booking_limit">
                        <option value="">Select Hours</option>
                        <option value="1">1 Hour</option>
                        <option value="2">2 Hours</option>
                        <option value="3">3 Hours</option>
                        <option value="4">4 Hours</option>
                        <option value="5">5 Hours</option>
                        <option value="6">6 Hours</option>
                        <option value="7">7 Hours</option>
                        <option value="8">8 Hours</option>
                        <option value="9">9 Hours</option>
                        <option value="10">10 Hours</option>
                        <option value="11">11 Hours</option>
                        <option value="12">12 Hours</option>
                    </select>
                    <span class="error_individual" id="booking_limit_validate"></span>
                </div>
                <label class="col-sm-1 control-label">Per</label>
                <div class="col-sm-5">
                    <select class="form-control" id="per" name="per">
                        <option value="7">Week</option>
                        <option value="30">Month</option>
                    </select>
                    <span class="error_individual" id="per_validate"></span>
                </div>
            </div>
           
          
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" id="table" name="table" value="admin">
                    <button type="submit" id="add_facility_btn" name="add_facility_btn" class="btn btn-primary">Add Facility</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>
<script>
/*$('#opening_hour').timepicker({
    pickDate: false,
    minuteStep: 30,
  });
  */
function deposit_required(id)
{
	if(id==0)
	{
		$('.deposit_amount_markup').hide();
	}
	else
	{
		$('.deposit_amount_markup').show();
	}
}
function bookingchange(id)
{
	if(id==0)
	{
		$('.bookingchange').hide();
	}
	else
	{
		$('.bookingchange').show();
	}
}
function day_rang_settings_change(id)
{
	if(id==0)
	{
		$('.day_rang_settings_change').hide();
	}
	else
	{
		$('.day_rang_settings_change').show();
	}
}
function check_info_only(id)
{
	var postData={ 
						id			:id,
					 }
	$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url().'manager/check_info_only/'; ?>', 
			success: function(result){
			  if(result==1)
			  {
				  $('.check_info_only_file').show();
				  $('.check_info_only').hide();
				  $('#is_booking_required').val(0).change();
			  }
			  else
			  {
				  $('.check_info_only').show();
				  $('.check_info_only_file').hide();
				  $('#is_booking_required').val(1).change();
			  }
			}
		});
}
function check_max_min(min_val)
{
	var max_val = parseInt($("#is_day_rang_settings_max").val());
	var min_val = parseInt($("#is_day_rang_settings_min").val());
	//alert('Min valu= '+min_val+' Max value = '+max_val);
	if(min_val>max_val)
	{
		$("#is_day_rang_settings_max").val('');
	}
}	
function ConvertTimeformat(format, str) {
		var time = str;
		var hours = Number(time.match(/^(\d+)/)[1]);
		var minutes = Number(time.match(/:(\d+)/)[1]);
		var AMPM = time.match(/\s(.*)$/)[1];
		if (AMPM == "PM" && hours < 12) hours = hours + 12;
		if (AMPM == "AM" && hours == 12) hours = hours - 12;
		var sHours = hours.toString();
		var sMinutes = minutes.toString();
		if (hours < 10) sHours = "0" + sHours;
		if (minutes < 10) sMinutes = "0" + sMinutes;
		return sHours + ":" + sMinutes;
	}
$(document).ready( function()
{
	$('#closing_hour').timepicker().on('changeTime.timepicker', function (e) {
			var session_hour = $('#session_hour').val();
			if(session_hour!=''){
			$("#append-div").html('');
				//var session_hr =  this.value ; // or $(this).val()
				
		
				var opening_hour = $('#opening_hour').data("timepicker").getTime();
				var closing_hour = $('#closing_hour').data("timepicker").getTime();
		
				var op_hrs = ConvertTimeformat("24", opening_hour);
				var cl_hrs = ConvertTimeformat("24", closing_hour);
	
				var op_hrstomin = op_hrs.split(":");
				var cl_hrstomin = cl_hrs.split(":");
				
				var op_hrstomin_val = parseInt(op_hrstomin[0])*60+parseInt(op_hrstomin[1]);
				var cl_hrstomin_val = parseInt(cl_hrstomin[0])*60+parseInt(cl_hrstomin[1]);
				
				//alert(op_hrstomin_val+' ' +cl_hrstomin_val);
				/*var hr_start = op_hrstomin_val;
				var hr_end =cl_hrstomin_val;*/
				var sess = session_hour * 60;
				var i = session_hour * 60;
				var icount = 1;
				while(i<cl_hrstomin_val){
					
					var itohrs = Math.floor( op_hrstomin_val /  60);
					var itomin = Math.floor( op_hrstomin_val %  60);
					
					//condition to add 0 in front
					if (itomin < 10) {
						sitomin = "0" + itomin;
					} else {
						sitomin = itomin;
					}
					
					var session_interval = op_hrstomin_val + (session_hour * 60);
					var i = session_interval;
					var op_hrstomin_val = session_interval;
					var hours = Math.floor( session_interval / 60);
					var mins = Math.floor( session_interval % 60);
					
					//condition to add 0 in front
					if (mins < 10) {
						smin = "0" + mins;
					} else {
						smin = mins;
					}
					
					if(i<=cl_hrstomin_val){
					//alert(hours);
					$("#append-div").append('<div class="form-group">'+
						'<label class="col-sm-2 control-label">Slot '+icount+'</label>'+
						
						'<div class="col-sm-3 control-label">'+
						itohrs+':'+sitomin+' to '+hours+':'+smin+					
						'</div>'+
						'<input type="hidden" value="'+itohrs+':'+sitomin+'" name="slot_time_from[]">'+
						'<input type="hidden" value="'+hours+':'+smin+'" name="slot_time_to[]">'+
						'<label class="col-sm-2 control-label">Can Book?</label>'+
						'<div class="col-sm-2">'+
						'<select class="form-control" name="can_book_check[]">'+
						'<option value="1">Yes</option>'+
						'<option value="0">No</option>'+
						'</select>'+
						'</div>'+
					'</div>');		
					//alert(i+' '+cl_hrstomin_val +' ' +op_hrstomin_val);
					icount++;
					} 
				}
			}
			});
		$('#session_hour').on('change', function() {
			$("#append-div").html('');
				//var session_hr =  this.value ; // or $(this).val()
				var session_hour = $('#session_hour').val();
		
				var opening_hour = $('#opening_hour').data("timepicker").getTime();
				var closing_hour = $('#closing_hour').data("timepicker").getTime();
		
				var op_hrs = ConvertTimeformat("24", opening_hour);
				var cl_hrs = ConvertTimeformat("24", closing_hour);
	
				var op_hrstomin = op_hrs.split(":");
				var cl_hrstomin = cl_hrs.split(":");
				
				var op_hrstomin_val = parseInt(op_hrstomin[0])*60+parseInt(op_hrstomin[1]);
				var cl_hrstomin_val = parseInt(cl_hrstomin[0])*60+parseInt(cl_hrstomin[1]);
				
				//alert(op_hrstomin_val+' ' +cl_hrstomin_val);
				/*var hr_start = op_hrstomin_val;
				var hr_end =cl_hrstomin_val;*/
				var sess = session_hour * 60;
				var i = session_hour * 60;
				var icount = 1;
				while(i<cl_hrstomin_val){
					
					var itohrs = Math.floor( op_hrstomin_val /  60);
					var itomin = Math.floor( op_hrstomin_val %  60);
					
					//condition to add 0 in front
					if (itomin < 10) {
						sitomin = "0" + itomin;
					} else {
						sitomin = itomin;
					}
					
					var session_interval = op_hrstomin_val + (session_hour * 60);
					var i = session_interval;
					var op_hrstomin_val = session_interval;
					var hours = Math.floor( session_interval / 60);
					var mins = Math.floor( session_interval % 60);
					
					//condition to add 0 in front
					if (mins < 10) {
						smin = "0" + mins;
					} else {
						smin = mins;
					}
					
					if(i<=cl_hrstomin_val){
					//alert(hours);
					$("#append-div").append('<div class="form-group">'+
						'<label class="col-sm-2 control-label">Slot '+icount+'</label>'+
						
						'<div class="col-sm-3 control-label">'+
						itohrs+':'+sitomin+' to '+hours+':'+smin+					
						'</div>'+
						'<input type="hidden" value="'+itohrs+':'+sitomin+'" name="slot_time_from[]">'+
						'<input type="hidden" value="'+hours+':'+smin+'" name="slot_time_to[]">'+
						'<label class="col-sm-2 control-label">Can Book?</label>'+
						'<div class="col-sm-2">'+
						'<select class="form-control" name="can_book_check[]">'+
						'<option value="1">Yes</option>'+
						'<option value="0">No</option>'+
						'</select>'+
						'</div>'+
					'</div>');		
					//alert(i+' '+cl_hrstomin_val +' ' +op_hrstomin_val);
					icount++;
					} /*else {
						alert('Slot arrangement failed. Please change the opening and closing hour time settings accordingly.');	
					}*/
				}
		
				//var newDate =(e.time.hours)+1;
				//$("#txtEndTime").val(newDate);
				
			});
});

</script>