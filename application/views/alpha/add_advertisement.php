<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">


<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Advertisement
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
              <span>Advertisement</span>
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
        <form class="form-horizontal innerT " role="form" method="POST" id="add-advertisement" enctype="multipart/form-data">
        
                <link href="<?php echo base_url();?>assets/front/global/plugins/chosen/chosen.css" rel="stylesheet" type="text/css" />
                <script src="<?php echo base_url();?>assets/front/global/plugins/chosen/chosen.js"></script>
        <div class="form-body">
        <div class="form-group">
            <label class="col-md-3 control-label">Ad Type</label>
            <div class="col-md-9">
                <select class="form-control" id="ad_type" name="ad_type">
                	<option value="">Select Ad Type</option>
                   	<option value="Premium">Premium</option>
                   	<option value="Featured">Featured</option>
                   	<option value="Normal">Normal</option>
                </select>
                <span class="error_individual help-block" id="ad_type_validate"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Ad Category</label>
            <div class="col-md-9">
                <select class="form-control" id="ad_category" name="ad_category">
                	<option value="">Select Ad Category</option>
                   	<option value="1">Advertiser Ad</option>
                   	<option value="2">Vendor Ad</option>
                </select>
                <span class="error_individual help-block" id="ad_category_validate"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Title</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                <span class="error_individual help-block" id="title_validate"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Link</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="link" name="link" placeholder="Link for eaxample http://www.google.com">
                <span class="error_individual help-block" id="link_validate"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Description</label>
            <div class="col-md-9">
                <textarea class="form-control" id="description" name="description"  maxlength="150" placeholder="Describe your ad in detail."></textarea>
                <span class="error_individual help-block" id="description_validate"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Add Image</label>
            <div class="col-md-9">
                 <span class="btn btn-success fileinput-button" style="margin-bottom:10px;">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Select files...</span>
                        <input id="advertisement_featured_image" type="file" name="file_upload">
                    </span>
                    <div id="progress_loading" style="margin-top: 10px; width:100%; display:none; clear:both;">
                      Loading...
                    </div>
                  <div id="progress" class="progress" style="margin-top: 10px; width:50%; display:none; height:10px;">
                      <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <div id="files" class="files" style="clear:both;"></span>
                </div>
                
                <span class="error_individual help-block" id="infomsg">Recommended Image size for Advertisement: 282 x 425</span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Start Date</label>
            <div class="col-md-9">
            
            <!--<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
                <input type="text" class="form-control" readonly="" name="datepicker" aria-required="true" aria-invalid="false" aria-describedby="datepicker-error">
                <span class="input-group-btn">
                    <button class="btn default" type="button">
                        <i class="fa fa-calendar"></i>
                    </button>
                </span>
            </div>-->
            
                  <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Select start date">
                <span class="error_individual help-block" id="start_date_validate"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">End Date</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Select end date">
                <span class="error_individual help-block" id="end_date_validate"></span>
            </div>
          </div>
          
           <div class="form-group">
            <label class="col-md-3 control-label">Display settings</label>
            <div class="col-md-9">
                <select class="form-control" id="display_settings" name="display_settings" onchange="show_area_selection(this.value)">
                	<option value="">Select Display settings</option>
                   	<option value="1">Overall</option>
                   	<option value="0">Specific Areas</option>
                   	<option value="2">Specific Condos</option>
                </select>
                <span class="error_individual help-block" id="display_settings_validate"></span>
            </div>
          </div>
          
          <div class="form-group" id="condos_markup" >
            <label class="col-md-3 control-label">Condos</label>
            <div class="col-md-9">
                <select class="chosen" multiple="multiple" name="condos[]" id="condos" style="width: 100%;" >  
                	<option value="">Select Condo</option>
                    <?php 
					$condos = $this->General_model->get_data_all('condos');
					if(sizeof($condos)>0)
					{
						foreach($condos as $condo)
						{
							?>
							<option value="<?php echo $condo['id'];?>"><?php echo $condo['name'];?></option>
							<?php
						}
					}
					?>
                </select>
                <span class="error_individual help-block" id="states_validate"></span>
            </div>
          </div>
          
          <div class="form-group" id="area_markup" style="display:none">
            <label class="col-md-3 control-label">States</label>
            <div class="col-md-9">
                <select class="form-control" id="states" name="states" onchange="select_states(this.value)">
                	<option value="">Select State</option>
                    <?php 
					if(sizeof($states)>0)
					{
						foreach($states as $state)
						{
							?>
							<option value="<?php echo $state['id'];?>"><?php echo $state['name'];?></option>
							<?php
						}
					}
					?>
                </select>
                <span class="error_individual help-block" id="states_validate"></span>
            </div>
          </div>
          
          <div id="loadedareas">
              
          </div>
          
         
         <!-- <div class="form-group">
            <label class="col-md-3 control-label">Select condos</label>
            <div class="col-md-9 condos_div">
            	
            </div>
          </div>-->
          
        <!--  <div class="form-group">
            <label class="col-md-3 control-label">Add Additional images</label>
            <div class="col-md-9">
                <input id="advertisement_file_upload" name="file_upload" type="file" multiple="true">
                <span class="error_individual" id="add_image_validate"></span>
                <span id="additional_images"></span>
            </div>
          </div>-->
          
          
        </div>
      
        <div class="form-actions">
          <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <button type="submit" name="addadvertisementsub" id="addadvertisementsub" class="btn btn-primary">
                  Add Advertisement
              </button>
            </div>
          </div>
        </div>
        <script>
		$(document).ready( function() {
        	$('select.chosen').chosen();
			setTimeout(function(){ 
				$('#condos_markup').css('display','none');
			 }, 3000);
			
		})
    	</script>
       </form>
      </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>

<!--<select name="areas[]" id="vb" multiple class="form-control hj">
						<option selected value="all">All</option>
                        </select>-->





<script>
function show_area_selection(val){
	if(val == 0){
		$('#area_markup').show();
		$('#condos_markup').hide();
		$('#loadedareas').show();
	} 
	else if(val == 2)
	{
		$('#condos_markup').show();
		$('#area_markup').hide();
		$('#loadedareas').hide();
	}
	else {
		$('#condos_markup').hide();
		$('#area_markup').hide();
		$('#loadedareas').hide();
	}
}

function select_states(id)
{
	var postData={ 
					id:id,
				 }
	$.ajax({
		type: 'POST',
		data: postData,
		url: '<?php echo base_url();?>alpha/load_areas', 
		success: function(result)
		{
			$('#loadedareas').html(result);
		}
	});
}
</script>                         