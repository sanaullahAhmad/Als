<script>
//Delete
	function callCrudAction(table,id,controller) {
		if (confirm('Are you sure?')) {
			queryString = 'table='+table+'&id='+ id;
			
			jQuery.ajax({
			url: "<?php echo base_url()?>manager/"+controller,
			data:queryString,
			type: "POST",
			success:function(data){
				window.location.reload();
			},
		
			error:function (){
			}
		});
	} else {
           return false;
       }
	}
	
	
	function delete_image_and_section(classname, imagename, imageextention, imagefolder, table)
	{
		$('.'+classname).remove();
		var postData={ 
						imagefolder			:imagefolder,
						imagename			:imagename,
						imageextention		:imageextention,
						table				:table,
					 }
		$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url().'home/delete_image_and_section/'; ?>', 
			success: function(result){
			  
			}
		});
	}
	
	function approve_quote(id, status)
	{
		var postData={ 
						id			:id,
						status		:status
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>manager/approve_quote/', 
			success: function(result){
					$('#qoute_'+id).html('');
			}
			});
	}
	
	function approve_delivery(id, status)
	{
		var postData={ 
						id			:id,
						status		:status
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>manager/approve_delivery/', 
			success: function(result){
					$('.deleivery_request_'+id).hide();
			}
			});
	}
	function approve_advert(id, status)
	{
		var postData={ 
						id			:id,
						status		:status
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>manager/approve_advert/', 
			success: function(result){
					$('#advert_'+id).html('');
					$('#advert_id_'+id).html(result);
			}
			});
	}
	function approve_facility_booking(id, status)
	{
		var postData={ 
						id			:id,
						status		:status
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>manager/approve_facility_booking/', 
			success: function(result){
				if(result=='Approved'){
					$('#facility_booking_'+id).html('Paid');
				}
				else
				{
					$('#facility_booking_'+id).html('Not Approved');
				}
			}
			});
	}
	function approve_resident(id, status)
	{
			var postData={ 
							id			:id,
							status		:status
						 }
				$.ajax({
				type: 'POST',
				data: postData,
				url: '<?php echo base_url();?>manager/approve_resident/', 
				success: function(result){
						$('#'+id).html('');
				}
				});
		}
	function incident_status(id, status)
	{
	  var postData={ 
					  id			:id,
					  status		:status
				   }
		  $.ajax({
		  type: 'POST',
		  data: postData,
		  url: '<?php echo base_url();?>manager/incident_status/', 
		  success: function(result){
				  $('#'+id).html('N/A &nbsp;<a href="javascript:;" title="Incident Log" data-toggle="modal" data-target="#myModal" onclick="update_modal_id('+id+')"><span class="glyphicon glyphicon-ban-circle"></span></a>');
		  }
		  });
	}
	function approve_post(id, status)
	{
	  var postData={ 
					  id			:id,
					  status		:status
				   }
		  $.ajax({
		  type: 'POST',
		  data: postData,
		  url: '<?php echo base_url();?>manager/approve_post/', 
		  success: function(result){
			  if(status==1)
			  	{
				  $('#'+id).html('Approved');
		  		}
				else
				{
					$('#'+id).html('DisApproved');
				}
		  }
		  });
	}
	function update_modal_id(id)
	{
		$('#incident_id').val(id);
		var postData={ 
					id			:id,
				 }
		$.ajax({
		type: 'POST',
		data: postData,
		url: '<?php echo base_url();?>manager/incident_log/', 
		success: function(result){
				$('#incident_log').val(result);
		}
		});
				
	}
	function  incident_log_sub()
	{
		incident_id	=$("#incident_id").val(),
		incident_log=$("#incident_log").val()
		var postData={ 
					incident_id	:incident_id,
					incident_log:incident_log
				 }
		$.ajax({
		type: 'POST',
		data: postData,

		url: '<?php echo base_url();?>manager/incident_log_sub/', 
		success: function(result){
			$('#myModal').modal('hide');
		}
		});
				
	}
	
	function change_floors(id)
	{
		var postData={ 
				id				:id
				}
			$.ajax({
			type: 'POST',
			data: postData,
			 dataType: "json",
			url: '<?php echo base_url();?>manager/change_floors', 
			success: function(result){
				var selectbox = document.getElementById("floors");    
				var i;
					for(i=selectbox.options.length-1;i>=0;i--)
					{
						selectbox.remove(i);
					}
				//
				var selectbox2 = document.getElementById("unit");    
				var i;
					for(i=selectbox2.options.length-1;i>=0;i--)
					{
						selectbox2.remove(i);
					}
				//
				var j;
					var x = document.getElementById("floors");
					var option = document.createElement("option");
					option.text = 'G';
					x.add(option);
					for(j=1; j<=parseInt(result.floors); j++)
					{
						var x = document.getElementById("floors");
						var option = document.createElement("option");
						option.text = j;
   						x.add(option);
					}
					
				//
				var k;
					for(k=1; k<=parseInt(result.units); k++)
					{
						var x = document.getElementById("unit");
						var option = document.createElement("option");
						option.text = k;
   						x.add(option);
					}
				//
				
				//$('#floor').val(result.floors);
				//$('#unit').val(result.units);
			}});
	}
	function change_floors_blacklist(id)
	{
		var postData={ 
				id				:id
				}
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>manager/change_floors_blacklist', 
			success: function(result){
				
				
				$('#floors').html(result);
			}});
	}
	
	function change_unit_blacklist(floor_id)
	{
		var block_id = $('#block').val();
		var postData={ 
				block_id				:block_id,
				floor_id				:floor_id
				}
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>manager/change_unit_blacklist', 
			success: function(result){
				
				
				$('#unites').html(result);
			}});
	}
	
	function search_resident()
	{
		var blocks = document.getElementById("block").value;
		var floors = document.getElementById("floors").value;
		var units = document.getElementById("unit").value;
		var postData={ 
			 blocks:blocks,
			 floors:floors,
			 units:units,
		}
		$.ajax({
		type: 'POST',
		data: postData,
		 dataType: "json",
		url: '<?php echo base_url();?>manager/search_resident', 
		success: function(result){
				var selectbox = document.getElementById("resident");    
				var i;
					for(i=selectbox.options.length-1;i>=0;i--)
					{
						selectbox.remove(i);
					}
				//
				var x = document.getElementById("resident");
				var option = document.createElement("option");
				option.text = result.name;
				option.value = result.id;
				x.add(option);
			}
		});
	}
	function show_calender_button(facility_id)
	{
		$("#calender_button").show();
		var postData={ 
			faility_hidden_id:facility_id,
		}
		$.ajax({
		type: 'POST',
		data: postData,
		url: '<?php echo base_url().'manager/add_facility_session/'; ?>', 
		success: function(result)
		  {
			$("#session_time_hidden").val(result);
			//window.location.href='<?php echo base_url().'login/'; ?><?php if(isset($_GET['next'])){ echo "?next=".$_GET['next'];}?>';
		  }
		});
	}
	function calculate_end_time(starttime)
	{
		session_time= $("#session_time_hidden").val();
		var postData={ 
			session_time:session_time,
			starttime:starttime,
		}
		$.ajax({
		type: 'POST',
		data: postData,
		url: '<?php echo base_url().'manager/calculate_end_time/'; ?>', 
		success: function(result)
		  {
			$("#endtime").val(result);
		  }
		});
	}
	function delete_image()
	{
		$('#featured_image').val('0');
		$('#img_featured').html('');
	}
	
	function delete_image_section(classname)
	{
		$('.'+classname).remove();
	}
	function edit_field(id, table, field)
	{
		var current_value = $('#category_service_id_'+id).html();
		var postData={ 
						id			:id,
						table		:table,
						field  		:field,
						current_value:current_value
					 }
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>manager/edit_field', 
			success: function(result){
					$('#category_service_id_'+id).html(result);
			}
			});
	}
	function edit_field_value(id, field, changed_name, table )
	{
		$('#category_service_id_'+id).html('');
		//alert('feild = '+field+', change_id = '+change_id+', lead_id = '+ lead_id+', targettable = '+ targettable+', target_table_name = '+ target_table_name);
		var postData={ 
				id				:id,
				field			:field,
				table			:table,
				changed_name	:changed_name
				}
			$.ajax({
			type: 'POST',
			data: postData,
			url: '<?php echo base_url();?>manager/edit_field_value', 
			success: function(result){
					$('#category_service_id_'+id).html(result);
				}});
	}
	function delete_post(post_id)
	{
			$.ajax({
			'url': '<?php echo base_url();?>manager/delete_post',
			'type': 'post',
			'data': {
				'post_id': post_id
			},
			'cache': false,
			'success': function(result){
				$("#tr_"+post_id).hide();
			}
		});
	}
	function prepare_end_time(starttime)
	{
		//console.log(starttime);
		var session	=	$("#session_time_hidden").val();
		var session	=	parseInt(session);
		var starttime_space_split = starttime.split(" ");
		var starttime_colon_split = starttime_space_split[0].split(":");
		hours 		= parseInt(starttime_colon_split[0])+parseInt(session) ;
		minutes 	= parseInt(starttime_colon_split[1]);
		meridian 	= starttime_space_split[1];
		console.log("hours="+hours+" minutes="+minutes+" meridian="+meridian);
		if(meridian=='PM')
		{
			hours = hours+12;
		}
	  if (minutes !== 0) {
		minutes = Math.ceil(minutes / 15) * 15;
		if (minutes === 60) {
		  hours += 1;
		  minutes = 0;
		}
	  }
		if (hours === 0) {
		  hours = 12;
		} else if (hours >= 24) {
		  if (hours > 24) {
			hours = hours - 24;
		  }
		  meridian = 'AM';
		}else if (hours >= 12) {
		  if (hours > 12) {
			hours = hours - 12;
		  }
		  meridian = 'PM';
		} else {
		  meridian = 'AM';
		}
	  endtime = hours+':'+minutes+' '+meridian
	  $("#endtime").val(endtime);
	}
	function get_slot_value(slot_id){
		$('#day_slot_val_append').val(slot_id);
		$(".slot_c").css('color','#333');
		$(".slot_c").css('background-color','#ddd');
		$(".slot_s_"+slot_id).css('color','#fff');
		$(".slot_s_"+slot_id).css('background-color','#3598dc');
	}

$(document).ready(function(){
	 $('#timepicker1').timepicker();
	 $('#timepicker2').timepicker();
	 $('#timepicker3').timepicker();
	 $('.timepicker').timepicker({
			format: 'HH:mm',
			showMeridian:true
		});  
	 <?php if($this->uri->segment(2)=='facility_booking_form'){?>
		var start = new Date();
		var end = new Date(new Date().setYear(start.getFullYear()+1));
		$('#startdate').datepicker({
			startDate : start,
			format:'yyyy-mm-dd',
			/*endDate   : end*/
		}).on('changeDate', function(){
			$('#day_slot_val_append').val('');
			var date 		= $('#startdate').val();
			var facility_id = $('#condo_facility').val();
			var resident_id = $('#resident').val();
			var postData={ 
							date		:date,
							facility_id	:facility_id,
							resident_id	:resident_id,
						 }
			$.ajax({
			type: 'POST',
			data: postData,
			dataType: 'json',
			url: '<?php echo base_url();?>manager/show_date_bookings_ajax', 
			success: function(result)
			  {
				 //$('.show_bookings').html(result);
				  $('.day_slot_value').html('<div class="form-group"><div class="row"><label class="col-md-3 control-label">&nbsp;</label><div class="col-md-9" style="padding-left:23px;"><div class="row"> <p style="margin: 0 0 20px; padding-left: 15px; font-weight:bold;">Please select a slot.</p>'+ result.day_slot_value+'<span id="day_slot_val_append_validate" class="error_individual help-block"></span></div></div></div></div>');
			  }
			});
			$(this).datepicker('hide');
		}); 
		
		/*$('#enddate').datepicker({
			startDate : start,
			format:'yyyy-mm-dd',
			endDate   : end
		}).on('changeDate', function(){
			$('#startdate').datepicker('setEndDate', new Date($(this).val()));
			$(this).datepicker('hide');
		});*/
		
		$('.timepicker').timepicker({
			format: 'HH:mm',
			showMeridian:true
		});  
	<?php }?>
	
	$.validator.addMethod("greaterThan",
		function (value, element, param) {
			  var $otherElement = $(param);
			  return parseInt(value, 10) > parseInt($otherElement.val(), 10);
		});
	
//add-facility-booking
$("#add-facility-booking").validate({
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
			/*starttime: {
			   required: true,
			    remote: 
					   {
						  url: "<?php echo base_url()?>manager/check_timerange_availability",
						  type: "post",
						  data: 
						  {
							  condo_facility: function(){ return $("#condo_facility").val(); },
							  unit: function(){ return $("#unit").val(); },
							  startdate: function(){ return $("#startdate").val(); },
							  starttime: function(){ return $("#starttime").val(); },
							  enddate  : function(){ return $("#startdate").val(); },
							  endtime  : function(){ return $("#endtime").val(); }
						  }
					   },
			},*/
			
			day_slot_val_append: {
				required: true
			},
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
		  starttime: {
				required: "Please enter starttime",
				remote: "Facility Already booked in this time range.",
			},
			
			 day_slot_val_append: {
				required: "Please select atleast one slot",
			},
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
		
	$(function () {
		'use strict';
		//$("#progress").hide();
		$("#progress").css( 'visibility', 'hidden');
		$('#fileupload').fileupload({
			url: '<?php echo base_url()?>manager/knowledge_base_image',
			dataType: 'json',
			done: function (e, data) 
			{
				$.each(data.result.files, function (index, file) 
				{
					var ran = "";
					var charset = "abcdefghijklmnopqrstuvwxyz";
					for( var i=0; i < 5; i++ )
						ran += charset.charAt(Math.floor(Math.random() * charset.length));
					if(file.valid_file=='yes')
					{
					
					$('#files').append('<section style="position:relative;" class="'+ran+'">'+file.name+'<span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
					}
					else
					{
						$('#files').append('<section style="position:relative;" class="'+ran+'">'+file.name+'<span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span></section>');
					}
				});
			},
			progressall: function (e, data) 
			{
				$("#progress").show();
				var progress = parseInt(data.loaded / data.total * 100, 10);
				$('#progress .progress-bar').css(
					'width',
					progress + '%'
				);
			}
		}).prop('disabled', !$.support.fileInput)
			.parent().addClass($.support.fileInput ? undefined : 'disabled');
  
		  $('#post_file_upload').fileupload({
			  url: '<?php echo base_url()?>manager/post_file_upload',
			  dataType: 'json',
			  done: function (e, data) 
			  {
				  $.each(data.result.files, function (index, file) 
				  {
					  //check if file upload exeeded
					  var check_images = $("#additional_images").html();
					  if(check_images!='')
					  {
						  var lenth = $('#additional_images .images_names').length;
						  if(lenth>4)
						  { 
							  alert("You have already Selected Five images.");
							  return false;//this will stop add progress bar
						  }
					  }
					  //check if file upload exeeded ends
					  var res = file.name.split(".");
					  var ran = "";
					  var charset = "abcdefghijklmnopqrstuvwxyz";
					  for( var i=0; i < 5; i++ )
						  ran += charset.charAt(Math.floor(Math.random() * charset.length));
					  if(file.valid_file=='yes')
					  {
					  	if(file.extension=='pdf')
							{
							
							$('#additional_images').append('<section style="position:relative;" class="'+ran+'">'+file.name+'<span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
							else
							{
					  $('#additional_images').append('<section style="position:relative; float:left;" class="'+ran+'"><img src="<?php echo base_url()?>uploads/post_images/'+file.name+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;post_images&#39;, &#39;posts_images&#39;)" class="image_delete_cross" >&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
					  }
					  else
					  {
						  $('#additional_images').append('<section style="position:relative; float:left;" class="'+ran+'"><span class="label label-warning">'+file.name+'</span><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span></section>');
					  }
				  });
			  },
			  progressall: function (e, data) 
			  {
				  $("#progress").css( 'visibility', 'visible');
				  var progress = parseInt(data.loaded / data.total * 100, 10);
				  $('#progress .progress-bar').css(
					  'width',
					  progress + '%'
				  );
				  if(progress>99){ setTimeout(function(){ $("#progress").css( 'visibility', 'hidden'); }, 3000); }
			  }
		  }).prop('disabled', !$.support.fileInput)
		  .parent().addClass($.support.fileInput ? undefined : 'disabled');
		  
		  $('#email_attachement').fileupload({
				url: '<?php echo base_url()?>manager/email_attachement',
				dataType: 'json',
				done: function (e, data) 
				{
					$.each(data.result.files, function (index, file) 
					{
						//check if file upload exeeded
						var check_images = $("#files").html();
						if(check_images!='')
						{
							var lenth = $('.images_names').length;
							if(lenth>0)
							{ 
								alert("You have already selected 1 image.");
								return false;//this will stop add progress bar
							}
						}
						//check if file upload exeeded ends
						var res = file.name.split(".");
						var ran = "";
						var charset = "abcdefghijklmnopqrstuvwxyz";
						for( var i=0; i < 5; i++ )
							ran += charset.charAt(Math.floor(Math.random() * charset.length));
						if(file.valid_file=='yes')
						{
							if(file.extension=='pdf')
							{
							
							$('#files').append('<section style="position:relative;" class="'+ran+'">'+file.name+'<span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
							else
							{
						$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><img src="<?php echo base_url()?>uploads/email_attachement/'+file.name+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;email_attachement&#39;, &#39;email_attachment_files&#39;)" class="image_delete_cross" >&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
						}
						else
						{
							$('#files').append('<section style="position:relative; float:left;" class="'+ran+'"><span class="label label-warning">'+file.name+'</span><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span></section>');
						}
					});
				},
				progressall: function (e, data) 
				{
					$("#progress").show();
					$("#progress_loading").show();
					var progress = parseInt(data.loaded / data.total * 100, 10);
					$('#progress .progress-bar').css(
						'width',
						progress + '%'
					);
						if(progress>99){ setTimeout(function(){ $("#progress, #progress_loading").css( 'display', 'none'); }, 3000); }
				}
			}).prop('disabled', !$.support.fileInput)
				.parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
		
	//Add Advertizement
	$("#add-advertisement").validate({
				  rules: {
					description: {
	                    required: true,
	                },
					 add_image: {
	                    required: true
	                },
					 /*add_link: {
	                    required: true,
	                }
*/	            },
	            messages: {
					description: {
	                    required: "Please enter description",
	                },
					 add_image: {
	                    required: "Please select image",
	                },
					/* add_link: {
	                    required: "Please enter link",
	                }*/
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
	//Add Knowledge base
	$("#add-knowledge-base").validate({
				  rules: {
					name: {
	                    required: true,
	                },
					description: {
	                    required: true,
	                },
					 privacy: {
	                    required: true
	                },
					files: {
						fileType: {
							types: ["pdf"]
						},
						maxFileSize: {
							"unit": "KB",
							"size": 20000
						},
						minFileSize: {
							"unit": "KB",
							"size": "1"
						}
					  }
	            },
	            messages: {
					name: {
	                    required: "Please enter name",
	                },
					description: {
	                    required: "Please enter description",
	                },
					 privacy: {
	                    required: "Please select privacy",
	                },
					/* add_link: {
	                    required: "Please enter link",
	                }*/
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
	//Add Knowledge base
	$("#send_resident_email").validate({
				  rules: {
					block: {
	                    required: true,
	                },
					subject: {
	                    required: true,
	                },
					 message: {
	                    required: true
	                },
	            },
	            messages: {
					block: {
	                    required: "Please select block",
	                },
					subject: {
	                    required: "Please enter subject",
	                },
					 message: {
	                    required: "Please enter message",
	                },
					/* add_link: {
	                    required: "Please enter link",
	                }*/
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
	
	 //Edit incident Category Form
	$("#editincedentcategory-form").validate({
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>alpha/check_data_exists/name/incident_categories",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); },
							  current_name: function(){ return $("#current_name").val(); }
						  }
						}
	                },
	                reports_per_day: {
	                    required: true,
						number: true,
	                }
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
                  reports_per_day: {
	                    required: "Please enter reports per day",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });	
 //Add incident Category Form
	$("#addincedentcategory-form").validate({
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_incident_cat_exists/",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); },
						  }
						}
	                },
					
	                reports_per_day: {
	                    required: true,
						number: true,
	                }
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
                  reports_per_day: {
	                    required: "Please enter reports per day",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });	
	//Add Advertizement
	$("#resident-search-form").validate({
				  rules: {
					condos: {
	                    required: true,
	                },
					/* block: {
	                    required: true
	                },
					 floors: {
	                    required: true
	                },
					 unit: {
	                    required: true
	                },
					 add_link: {
	                    required: true,
	                }
					*/
				},
	            messages: {
					condos: {
	                    required: "Please Select  Condos",
	                },
					 block: {
	                    required: "Please select a block",
	                },
					 floors: {
	                    required: "Please select a floor",
	                },
					 unit: {
	                    required: "Please select a unit",
	                },
					/* add_link: {
	                    required: "Please enter link",
	                }*/
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
//Login manager
	$("#login-form-manager").validate({
				  rules: {
	                email: {
	                    required: true,
						email: true
	                },	               
					 password: {
	                    required: true
	                },
	            },
	            messages: {
	                email: {
	                    required: "Please enter email.",
						email: "Email is not valid."
	                },				
					password: {
	                    required: "Please enter password."
	                },	              
	            },
				debug: true,		
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
        submitHandler: function(form) {
		  $.ajax({
                   type: "POST",
                   url: "<?php echo base_url()?>manager/check_login",
                   data: $("#login-form-manager").serialize(), 
                   cache: false,
				   beforeSend: function(){ $("#logsubbutton").text('Checking...');},
                  success: function(data) {
					   if(data == 'active'){
                           	$('.fornotactive').hide();
							$('.forincorrectunpass').hide();
							$('.condoinactive').hide();
                            $("#logsubbutton").html('Logging you in... <i class="m-icon-swapright m-icon-white"></i>');
                            
							<?php if(isset($_GET['next'])){?>
							window.location.href = "<?php echo $_GET['next'];?>";
							<?php } else {?>
							window.location.href = "<?php echo base_url()?>manager/dashboard";
							<?php }?>
                        } else if(data == 'condo inactive'){
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
							$('.condoinactive').show();
                            $('.fornotactive').hide();
							$('.forincorrectunpass').hide();
                        }else if(data == 'notactive'){
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
                            $('.fornotactive').show();
							$('.forincorrectunpass').hide();
							$('.condoinactive').hide();
                        } else {
							$("#logsubbutton").html('Login <i class="m-icon-swapright m-icon-white"></i>');
							 $("#password").val('');
						   $('.forincorrectunpass').show();
						   $('.fornotactive').hide();
							$('.condoinactive').hide();
                        }
                    },
                   error: function() {
                        alert('Something went wrong');
                   }
                 });
        }
    });
	//Edit Condo Profile
	$("#state").change(function(){
		 var state=$("#state").val();
		 if(state != ''){
			$.ajax({
			  type: 'POST',
			  url: '<?php echo base_url('alpha/get_city_from_state'); ?>',
			  data: 'state='+state+'&ajax=1',
			  dataType : "json",
			  success: function( data ) {
				$("#areas").html(data.values);
		
			  },
			  error: function(xhr, status, error) {
			  alert(status);
			  },
			  });
		 	}
		});
	$("#condo-profile-manager").validate({
				  rules: {
	                name: {
	                    required: true
	                },
					logo: {
						fileType: {
							types: ["jpeg", "jpg", "png", "gif"]
						},
						maxFileSize: {
							"unit": "KB",
							"size": 2000
						},
						minFileSize: {
							"unit": "KB",
							"size": "10"
						}
					  }
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                },
	
					logo: {
						fileType: "File Type must be jpeg/jpg/png",
						maxFileSize: "Maximum of 2MB is allowed",
						minFileSize: "Minimum File size required 10KB"
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
	//Edit Condo Profile
	$("#manager-profile").validate({
				rules: {
	                name: {
	                    required: true
	                }
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                },
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
	//Change Password
	$("#change-password").validate({
				  rules: {
					password: {
	                    required: true,
	                     remote: {
							url: "<?php echo base_url()?>manager/check_data_exists_md5/password/condo_admins",
							type: "post",
							data: {
								password: function(){ return $("#password").val(); }
							}
						}
	                },
					 new_password: {
	                    required: true
	                },
					 retype_password: {
	                    required: true,
						equalTo : "#new_password"
	                }
	            },
	            messages: {
					password: {
	                    required: "Please enter Current Password",
						remote: "Your current password is not correct"
	                },
					 new_password: {
	                    required: "Please enter New Password",
	                },
					 retype_password: {
	                    required: "Please retype Password",
						equalTo : "Password doesn't match."
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
	//Change Password
	$("#sendsms-form").validate({
			    rules: {
					number: {
	                    required: true,
	                }
	            },
	            messages: {
					number: {
	                    required: "Please enter number",
	                },
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
	//Forgot Change Password
	$("#forgot-password-change").validate({
				  rules: {
					 password: {
	                    required: true
	                },
					 repassword: {
	                    required: true,
						equalTo : "#password"
	                }
	            },
	            messages: {
					 password: {
	                    required: "Please enter New Password",
	                },
					 repassword: {
	                    required: "Please retype Password",
						equalTo : "Password doesn't match."
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
	//Forgot Password
	$("#forgot-pass-form-manager").validate({
				  rules: {
					email_forgot: {
	                    required: true,
						email: true,
	                     remote: {
							url: "<?php echo base_url()?>manager/check_data_exists_forgot_pass/email_forgot/condo_admins",
							type: "post",
							data: {
								email_forgot: function(){ return $("#email_forgot").val(); }
							}
						}
	                }
	            },
	            messages: {
					email_forgot: {
	                    required: "Please enter Email",
						email: "Please enter a valid email",
						remote: "Seems we do not have this email address. Please check."
	                }
	            },
				debug: true,
		
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 
		
        

        submitHandler: function(form) {
        		$.ajax({

                   type: "POST",

                   url: "<?php echo base_url()?>manager/forgot_password",

                   data: $("#forgot-pass-form-manager").serialize(), 

                   cache: false,

				   beforeSend: function(){ $("#forgotpasssubbutton").text('Sending Link...');},
				   
                  success: function(data) {
					  if(data == 'LINKSENT'){
					  	$("#success-message").show();
						$("#forgot-pass-form-manager").hide();
					  }
                    },

                   
                   error: function() {
                        alert('Something went wrong');
                   }

                 });
		
        }
    });
//Edit update-password Form
	$("#edit-update-password-form").validate({
				  rules: {
	                new_password: {
	                    required: true
	                },
					confirm_password:{
						equalTo: "#new_password"
					}
					
	            },
	            messages: {
                  new_password: {
	                    required: "Please enter Name",
	                },
					confirm_password:{
						equalTo: "Password does not match.",
					}
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });		
//Edit Block Form
	$("#editblock-form").validate({
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/name/blocks",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); },
							  current_name: function(){ return $("#current_name").val(); }
						  }
						}
	                },
					floors:{
						required: true,
					},
					units:{
						required: true,
					}
					
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
					floors:{
						required: "Please enter Floors",
					},
					units:{
						required: "Please enter Units",
					}
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });	
 //Add Block Form
 //Add Block Form
	$("#addblacklistedunit-form").validate({
				  rules: {
	                block: {
	                    required: true,
	                },
					floors:{
						required: true,
					},
					unit:{
						required: true,
					}
					
	            },
	            messages: {
                  block: {
	                    required: "Please select bloack",
	                },
					floors:{
						required: "Please select Floor",
					},
					unit:{
						required: "Please select Units",
					}
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });	
	
	$("#addfacilitycategory-form").validate({
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/name/facility_categories",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); }
						  }
						}
	                },
					image_url:{
						required: true,
					},
					
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
					image_url:{
						required: "Please select an image",
					}
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });	
 //Add Block Form
	$("#edit-facilitycategory-form").validate({
				  rules: {
	                name: {
	                    required: true,
	                },
					
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });		
//Upload Residend CSV file
	 $('#importresidents-form').validate({ // initialize the plugin
        rules: {
            field1: {
                required: true,
                extension: "csv"
            }
        },
        submitHandler: function (form) { // for demo
            if( document.getElementById("filetoupload").value.toLowerCase().lastIndexOf(".csv")==-1) 
			{
					//alert("Please upload a file with .csv extension.");
					$("#filetoupload_validate").html('Please upload a file with .csv extension.');
					return false;
			}
			else
			{
				$("#filetoupload_validate").html('');
				form.submit();
			}
        }
    });
	
	
	
	 //edit User Form
	$("#edituser-form").validate({
		
				  rules: {
	                 full_name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/full_name/condo_admins",
						  type: "post",
						  data: {
							  full_name: function(){ return $("#full_name").val(); },
							  current_name: function(){ return $("#current_name").val(); }
						  }
						  }
	                },
						
	                email: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/email/condo_admins",
						  type: "post",
						  data: {
							  email: function(){ return $("#email").val(); },
							  current_name: function(){ return $("#current_email").val(); }
						  }
						}
	                },
	            },
	            messages: {
                  full_name: {
	                    required: "Please enter Name",
						remote: "Name already exists",
	                },
                  email: {
	                    required: "Please enter Email",
						remote: "Email already exists",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });	
	 //Add Facility Form
	$("#addfacility-form").validate({
				  rules: {
	                 facility_category: {
	                    required: true,
	                },
	                 name: {
	                    required: true,
	                },
						
	                description: {
	                    required: true,
	                },
						
	                price: {
	                    required: true,
	                },
						
	                opening_hour: {
	                    required: true,
	                },
	                session_hour: {
	                    required: true,
	                },
	                session_minute: {
	                    required: true,
	                },
	                booking_limit: {
	                    required: true,
	                },
	                per: {
	                    required: true,
	                },
	                is_day_rang_settings_min: {
	                    required: true,
						number: true,
   						min: 0,
   						max: 14,
	                },
	                is_day_rang_settings_max: {
	                    required: true,
						number: true,
   						min: 0,
   						max: 90,
    					greaterThan: "#is_day_rang_settings_min"
	                },
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                },
                  facility_category: {
	                    required: "Please enter facility category",
	                },
                  description: {
	                    required: "Please enter Description",
	                },
                  price: {
	                    required: "Please enter price",
	                },
                  opening_hour: {
	                    required: "Please enter opening hour",
	                },
                  session_hour: {
	                    required: "Please enter session Hours",
	                },
                  session_minute: {
	                    required: "Please enter session Minutes",
	                },
                  booking_limit: {
	                    required: "Please enter booking limit",
	                },
                  per: {
	                    required: "Please enter per",
	                },
                  is_day_rang_settings_min: {
	                    max: "Values allowed 0 to 14",
	                },
                  is_day_rang_settings_max: {
	                    greaterThan: "This should be greater than min value",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });	
	 //Add Useful Contact Form
	$("#add_useful_contact_form").validate({
		
				  rules: {
	                 name: {
	                    required: true,
	                },
	                phone: {
	                    required: true,
	                },
	                /*email: {
	                    required: true,
	                    email: true,
	                },
	                mobile: {
	                    required: true,
	                },
	                website: {
	                    required: true,
	                    url: true,
	                },
	                address: {
	                    required: true,
	                },
	                status: {
	                    required: true,
	                },*/
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                },
                  phone: {
	                    required: "Please enter phone",
	                },
                 /* email: {
	                    required: "Please enter email",
	                    email: 	  "Please enter valid email",
	                },
                  mobile: {
	                    required: "Please enter mobile",
	                },
                  website: {
	                    required: "Please enter website",
	                    url: 	  "Please enter valid url for example http://www.example.com",
	                },
                  address: {
	                    required: "Please enter address",
	                },
                  status: {
	                    required: "Please enter status",
	                }*/
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });	
	 //notification_alert Form
	$("#notification-alert-form").validate({
		
				rules: {
	                notification_alert: {
	                    required: true,
	                },
	            },
	            messages: {
                  notification_alert: {
	                    required: "Please enter notification alert",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
		}
    });	
	 //Add Resident Form
	$("#addresident-form").validate({
		
				  rules: {
	                name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/name/residents",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); }
						  }
						  }
	                },
						
	                email: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/email/residents",
						  type: "post",
						  data: {
							  email: function(){ return $("#email").val(); }
						  }
						}
	                },
					
	                block: {
	                    required: true
	                },
					
	                floor: {
	                    required: true
	                },
					
	                unit: {
	                    required: true
	                },
					
	                type: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_primay_owner_exists/",
						  type: "post",
						  data: {
							  email: function(){ return $("#email").val(); },
							  block: function(){ return $("#block").val(); },
							  floor: function(){ return $("#floors").val(); },
							  unit: function(){ return $("#unit").val(); },
							  type: function(){ return $("#type").val(); }
						  }
						}
	                },
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
	                    remote: "Name Already Exist.",
	                },
                  email: {
	                    required: "Please enter Email",
	                    remote: "Email Already Exist.",
	                },
                  block: {
	                    required: "Please enter block",
	                },
                  floor: {
	                    required: "Please enter Floors",
	                },
                  unit: {
	                    required: "Please enter Units",
	                },
                  type: {
	                    required: "Please enter type",
	                    remote: "primary owner already exist",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
			//alert('success');
			//return false;
		}
    });	
	 //Edit Resident Form
	$("#editresident-form").validate({
		
				  rules: {
	                 name: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/name/residents",
						  type: "post",
						  data: {
							  name: function(){ return $("#name").val(); },
							  current_name: function(){ return $("#current_name").val(); }
						  }
						  }
	                },
						
	                email: {
	                    required: true,
						  remote: {
						  url: "<?php echo base_url()?>manager/check_data_exists/email/residents",
						  type: "post",
						  data: {
							  email: function(){ return $("#email").val(); },
							  current_name: function(){ return $("#current_email").val(); }
						  }
						}
	                },
					
	                block: {
	                    required: true
	                },
					
	                floor: {
	                    required: true
	                },
					
	                unit: {
	                    required: true
	                },
	            },
	            messages: {
                  name: {
	                    required: "Please enter Name",
						 remote: "Name already exists",
	                },
                  email: {
	                    required: "Please enter Email",
						 remote: "Email already exists",
	                },
                  block: {
	                    required: "Please enter block",
	                },
                  floor: {
	                    required: "Please enter Floors",
	                },
                  unit: {
	                    required: "Please enter Units",
	                }
	            },
				debug: true,
				errorPlacement: function(error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				}, 

        submitHandler: function(form) 
		{
			form.submit();
			//alert('success');
			//return false;
		}
    });
	$('#forgot-pass-click').click(function(){
		$("#forgot-password").show();
		 $("#login-form-manager").hide();
	});
	$('#forgot-pass-back').click(function(){
		$("#login-form-manager").show();
		$("#forgot-password").hide();
	});
	
	
	
	
	
    <?php 
	if($this->uri->segment(2)=='calender')
	{?>      
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: '<?php echo date('Y-m-d')?>',
                selectable: true,
                selectHelper: true,
                select: function(start, end) {
                    var title = prompt('Event Title:');
                    var eventData;
                    if (title) {
                        eventData = {
                            title: title,
                            start: start,
                            end: end
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    }
                    $('#calendar').fullCalendar('unselect');
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                <?php foreach($facility_booking as $booking){
					$payment_channel=2;
				    $payment_status=2;
					  $invoice = $this->General_model->get_data_rowusingwhere_empty_array('facility_invoice', " booking_id=".$booking['id']);
					  if(sizeof($invoice)>0)
					  {
						  $payment_channel=$invoice->payment_channel;
						  $payment_status=$invoice->payment_status;
					  }
				?>
                    {
                        <?php 
						if($payment_channel=="" && $payment_status=="0"){
						$nowtime = date('Y-m-d H:i:s',time() - 1800);
						$to_time = strtotime($nowtime);
						$from_time = strtotime($booking['datetime_booked']);
						
						?>
						title: '<?php echo round(abs($to_time - $from_time) / 60,0). " minutes Left";?>',
						<?php }else{?>
						title: '<?php echo $this->General_model->get_value_by_id('condo_facilities', $booking['facility_id'],'name');?>',
						<?php }?>
						
                        start: '<?php echo date('Y-m-d', strtotime($booking['bookedfor_datetime_from']));?>T<?php echo date('H:i:s', strtotime($booking['bookedfor_datetime_from']));?>',
                        end: '<?php echo date('Y-m-d', strtotime($booking['bookedfor_datetime_to']));?>T<?php echo date('H:i:s', strtotime($booking['bookedfor_datetime_to']));?>',
						<?php 
						if($payment_channel=="" && $payment_status=="0"){?>
						color: '#FF1493'
						<?php }else{?>
						color: '#378006'
						<?php }?>
                    },
                    <?php }?>
                ]
            });
            
<?php }?>
        
});
</script>

