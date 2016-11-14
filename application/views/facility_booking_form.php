<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" /><link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js" type="text/javascript" ></script>
<style>
.cbp-l-project-title {
    font: 600 34px/46px "Open Sans",sans-serif;
	text-transform: none;
}
.portlet.light
{
	padding-left:0px; padding-right:0px;
}
</style>
<div class="portfolio-content">
    <div class="cbp-l-project-title">Facility Booking For: <?php echo $facility_categories->name;?></div>
    
    <div class="cbp-l-project-container">
        <div class="cbp-l-project-desc">
            <div class="cbp-l-project-desc-title">
                <span>Book Facility </span>
            </div>
            <form method="POST" id="add-facility-booking" class="form-horizontal" action="<?php echo base_url();?>add_facility_booking" > 
              <div class="form-body">
              
              <div class="form-group" style="margin-bottom:0px;">
                  <label class="col-md-3 control-label">Select Facility & Date</label>
                  <div class="col-md-5">
                      <select class="form-control" id="condo_facility" name="condo_facility" onchange="load_facility_details(this.value)">
                      	<option value="">Select Facility</option>
						<?php 
						  $action= "facility_category_id=". $facility_categories->id." AND condo_id=$this->condo_id order by name ASC";
						  $condo_facilities = $this->General_model->get_data_all_like_using_where('condo_facilities', $action);
						  if(sizeof($condo_facilities)>0)
						  {
							foreach($condo_facilities as $facility){
						  ?>
							   <option value="<?php echo $facility['id'];?>"><?php echo $facility['name'];?></option>
							 <?php }
						  }?>
                      </select>
                      <span id="condo_facility_validate" class="error_individual help-block"></span>
                      <input id="session_time_hidden" value="0" type="hidden">
                  </div>
                  <div class="col-md-4">
                      <div class="form-group">
                          <input type="text" class="form-control datepicker" id="startdate" name="startdate" readonly="readonly" placeholder="Select Date">
                          <span id="startdate_validate" class="error_individual help-block"></span>
                      </div>
                  </div>
              </div>             
              <div class="form-group">
                  <label class="col-md-3 control-label"></label>
                  <div class="col-md-9 cbp-l-project-details-list" style="padding-left:8px;">
                  	
                  </div>
              </div>
              <div class="day_slot_value">
              		
 			  </div>
             
               
               <input type="hidden" class="form-control" id="day_slot_val_append" name="day_slot_val_append"/>  
              	           
              <!--<div class="form-group">
                  <label class="col-md-3 control-label">Time</label>
                  <div class="col-md-3">
                      <input type="text" class="form-control timepicker" id="starttime" name="starttime"  readonly="readonly" onchange="calculate_end_time(this.value)">
                      <span id="starttime_validate" class="error_individual help-block"></span>
                  </div>
                  <div class="col-md-3">
                      <input type="text" class="form-control" id="endtime" name="endtime"  readonly="readonly">
                      <span id="endtime_validate" class="error_individual help-block"></span>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-md-3 control-label">&nbsp;</label>
                  <div class="col-md-9 show_bookings">
                  
                  </div>
                  
                 
              </div>-->
              
              <div class="form-group">
                  <label class="col-md-3 control-label">&nbsp;</label>
                  <div class="col-md-2">
                  	<button type="submit" name="facility_booking_submit" class="btn green">Submit</button>
                  </div>
                  <div class="col-md-4 modal_button">
                  	
                  </div>
              </div>
              
              
           </div>
           
           </form>
           <?php
			  echo $this->load->view('template/feature_ad');
			  ?>
        </div>
        <div class=""><?php /*?>cbp-l-project-details<?php */?>
        <?php echo $this->load->view('template/sidebar');?>
        </div>
    </div>
    
    <!--<div class="cbp-l-project-container">
        
    </div>
    <br>
    <br>
    <br> -->
    </div>
    
    
<script src="<?php echo base_url();?>assets/front/global/plugins/ion.rangeslider/js/ion.rangeSlider.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/front/pages/scripts/components-ion-sliders.min.js" type="text/javascript"></script>
<link href="<?php echo base_url();?>assets/front/global/plugins/ion.rangeslider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/ion.rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" type="text/css" />
<script>
var start = new Date();
var end = new Date(new Date().setYear(start.getFullYear()+1));
$('#startdate').datepicker({
	startDate : start,
	format:'yyyy-mm-dd',
}).on('changeDate', function(){
	$('#day_slot_val_append').val('');
	var date 		= $('#startdate').val();
	var facility_id = $('#condo_facility').val();
	var postData={ 
					date		:date,
					facility_id	:facility_id,
				 }
	$.ajax({
	type: 'POST',
	data: postData,
	dataType: 'json',
	url: '<?php echo base_url();?>home/show_date_bookings_ajax', 
	success: function(result)
	  {
		 //$('.show_bookings').html(result);
		  $('.day_slot_value').html('<div class="form-group"><div class="row"><label class="col-md-3 control-label">&nbsp;</label><div class="col-md-9" style="padding-left:23px;"><div class="row"> <p style="margin: 0 0 20px; padding-left: 15px; font-weight:bold;">Please select a slot.</p>'+ result.day_slot_value+'<span id="day_slot_val_append_validate" class="error_individual help-block"></span></div></div></div></div>');
	  }
	});
	$(this).datepicker('hide');
}); 
$('.timepicker').timepicker({
	format: 'HH:mm',
	showMeridian:true
});  
//add-facility-booking
$("#add-facility-booking").validate({
	ignore: "",
		rules: {
			condo_facility: {
				required: true
			},
			resident: {
				required: true
			},
			startdate: {
			   required: true
			},
			day_slot_val_append: {
				required: true,
				remote: 
					   {
						  url: "<?php echo base_url()?>home/check_unit_advance_booking_limit",
						  type: "post",
						  data: 
						  {
							  facility_id: function(){ return $("#condo_facility").val(); },
							  date: function(){ return $("#startdate").val(); },
							  day_slot_id: function(){ return $("#day_slot_val_append").val(); }
						  }
					   },
			},
			/*starttime: {
			   required: true,
			    remote: 
					   {
						  url: "<?php echo base_url()?>home/check_timerange_availability",
						  type: "post",
						  data: 
						  {
							  condo_facility: function(){ return $("#condo_facility").val(); },
							  unit: '<?php echo $this->General_model->get_value_by_id('residents', $this->session->userdata('resident_id'),'unit')?>',
							  startdate: function(){ return $("#startdate").val(); },
							  starttime: function(){ return $("#starttime").val(); },
							  enddate  : function(){ return $("#startdate").val(); },
							  endtime  : function(){ return $("#endtime").val(); }
						  }
					   },
			},*/
			enddate: {
			   required: true
			},
			endtime: {
			   required: true
			}
		},
		messages: {
		  condo_facility: {
				required: "Please Select facility",
			},
		  resident: {
				required: "Please Select resident",
			},
		  startdate: {
				required: "Please enter startdate",
			},
			 day_slot_val_append: {
				required: "Please select atleast one slot",
				remote: "You Exceed Booking hours limit for your unit.",
			},
		  /*starttime: {
				required: "Please enter starttime",
				remote: "Facility Already booked in this time range.",
			},*/
		  enddate: {
				required: "Please enter enddate",
			},
		  endtime: {
				required: "Please enter endtime",
			}
		},
		debug: true,
		errorPlacement: function(error, element) {
			var name = $(element).attr("name");
			error.appendTo($("#" + name + "_validate"));
		}, 
        submitHandler: function(form) {
        		form.submit();
        }
    });

function load_facility_details(id)
{
	/*$('#day_slot_val_append').val('');
	var date 		= $('#startdate').val();
	var facility_id = $('#condo_facility').val();
	var postData1={ 
					date		:date,
					facility_id	:facility_id,
				 }
	$.ajax({
	type: 'POST',
	data: postData1,
	dataType: 'json',
	url: '<?php echo base_url();?>home/show_date_bookings_ajax', 
	success: function(result)
	  {
		 //$('.show_bookings').html(result);
		  $('.day_slot_value').html('<div class="form-group"><div class="row"><label class="col-md-3 control-label">&nbsp;</label><div class="col-md-9" style="padding-left:23px;"><div class="row">'+ result.day_slot_value+'</div></div></div></div>');
	  }
	});*/
	
	
                    
	
	var postData={ 
					id	:id,
				 }
	$.ajax({
	type: 'POST',
	data: postData,
	dataType: 'json',
	url: '<?php echo base_url();?>home/load_facility_details/', 
	success: function(result)
	  {
		 $('.cbp-l-project-details-list').html(result.string);
		 $('.modal_message').html(result.modal_content);
		 $('.modal_button').html(result.modal_button);
		
	  }
	});
	//
	$.ajax({
	type: 'POST',
	data: postData,
	url: '<?php echo base_url().'home/add_facility_session/'; ?>', 
	success: function(result)
	  {
		$("#session_time_hidden").val(result);
		// run another ajax now to change end time according t session
			starttime= $("#starttime").val();
			var postData={ 
				session_time:result,
				starttime:starttime,
			}
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url().'home/calculate_end_time/'; ?>', 
			success: function(result)
			  {
				$("#endtime").val(result);
			  }
			});
		// run another ajax end
	  }
	});
}

function calculate_end_time(starttime)
{
	session_time= $("#session_time_hidden").val();
	var postData={ 
		session_time	:	session_time,
		starttime		:	starttime,
	}
	$.ajax({
	type: 'POST',
	data: postData,
	url: '<?php echo base_url().'home/calculate_end_time/'; ?>', 
	success: function(result)
	  {
		$("#endtime").val(result);
	  }
	});
}

//Get Slot Value
function get_slot_value(slot_id){
	$('#day_slot_val_append').val(slot_id);
}
</script>
<style>
label.error
{
	color:#F00;
}
.modal-backdrop
{
	z-index:1;
}
#myModal
{
	top:80px;
}
</style>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Need more sessions?</h4>
      </div>
      <div class="modal-body modal_message">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>