<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">
<link href="<?php echo base_url()?>assets/front/layouts/layout2/css/bootstrap.min.css">
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Edit Advertisement
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
              <span>Edit Advertisement</span>
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
        <form class="form-horizontal innerT " role="form" method="POST" id="edit-advertisement" enctype="multipart/form-data">
        <input type="hidden" name="id" value="">
        <div class="form-body">
        <div class="form-group">
            <label class="col-md-3 control-label">Ad Type</label>
            <div class="col-md-9">
                <select class="form-control" id="ad_type" name="ad_type">
                	<option value="">Select Ad Type</option>
                   	<option <?php if($advert->ad_type == 'Premium') echo 'selected';?> value="Premium">Premium</option>
                   	<option <?php if($advert->ad_type == 'Featured') echo 'selected';?> value="Featured">Featured</option>
                   	<option <?php if($advert->ad_type == 'Normal') echo 'selected';?> value="Normal">Normal</option>
                </select>
                <input type="hidden" name="ad_type_saved" id="ad_type_saved" value="<?php echo $advert->ad_type;?>" />
                <span class="error_individual help-block" id="ad_type_validate"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Ad Category</label>
            <div class="col-md-9">
                <select class="form-control" id="ad_category" name="ad_category">
                	<option value="">Select Ad Category</option>
                   	<option <?php if($advert->ad_category == '1') echo 'selected';?> value="1">Advertiser Ad</option>
                   	<option <?php if($advert->ad_category == '2') echo 'selected';?> value="2">Vendor Ad</option>
                </select>
                <span class="error_individual help-block" id="ad_category_validate"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Title</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $advert->title?>" placeholder="Title">
                <span class="error_individual help-block" id="title_validate"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Link</label>
            <div class="col-md-9">
                <input type="text" class="form-control" id="link" name="link" value="<?php echo $advert->link?>" placeholder="Link for eaxample http://www.google.com">
                <span class="error_individual help-block" id="link_validate"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">Description</label>
            <div class="col-md-9">
                <textarea class="form-control" id="description" name="description"  maxlength="150" placeholder="Describe your ad in detail."><?php echo $advert->ad_text?></textarea>
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
                    <div id="files" class="files" style="clear:both;">
                    <?php 
					 $characters = 'abcdefghijklmnopqrstuvwxyz';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            for ($i = 0; $i < 5; $i++) 
                            {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }
					echo '<section style="position:relative; clear:both;" class="'.$randomString.'"><a href="'.base_url().'uploads/advertisement_images/'.$advert->ad_img.'" target="_blank"> '. $advert->ad_img.'</a><span onclick="delete_image_section(&#39;'.$randomString.'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span><input type="hidden" name="images_names[]" value="'.$advert->ad_img.'" class="images_names"></section>';?>
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
            
                  <input type="text" class="form-control datepicker" id="start_date" name="start_date" value="<?php echo $advert->start_date;?>" placeholder="Select start date">
                <span class="error_individual help-block" id="start_date_validate"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-md-3 control-label">End Date</label>
            <div class="col-md-9">
                <input type="text" class="form-control datepicker" id="end_date" value="<?php echo $advert->end_date;?>" name="end_date" placeholder="Select end date">
                <span class="error_individual help-block" id="end_date_validate"></span>
            </div>
          </div>
          
           <div class="form-group">
            <label class="col-md-3 control-label">Display settings</label>
            <div class="col-md-9">
                <select class="form-control" id="display_settings" name="display_settings" onchange="show_area_selection(this.value)">
                	<option value="">Select Display settings</option>
                   	<option <?php if($advert->display_all == '1') echo 'selected';?> value="1">Overall</option>
                   	<option <?php if($advert->display_all == '0') echo 'selected';?> value="0">Specific Areas</option>
                   	<option <?php if($advert->display_all == '2') echo 'selected';?> value="2">Specific Condos</option>
                </select>
                <span class="error_individual help-block" id="display_settings_validate"></span>
            </div>
          </div>
          
          <?php
		  if($advert->display_all == '0'){
			  //Get state ID
			  $state_row = $this->General_model->get_data_row_using_where("ad_display", "ad_id='$advert->id'");
			  $state_id = $state_row->state_id;
			  
		  ?>
          <div class="form-group" id="condos_markup" >
                <link href="<?php echo base_url();?>assets/front/global/plugins/chosen/chosen.css" rel="stylesheet" type="text/css" />
                <script src="<?php echo base_url();?>assets/front/global/plugins/chosen/chosen.js"></script>
                <label class="col-md-3 control-label">Condos</label>
                <div class="col-md-9">
                    <select class="chosen" multiple="multiple" name="condos[]" id="condos" style="width: 100%;" >  
                        <option value="">Select Condo</option>
                        <?php 
                        $condos = $this->General_model->get_data_all('condos');
						$condos_array = explode(',',$advert->condos);
                        if(sizeof($condos)>0)
                        {
                            foreach($condos as $condo)
                            {
                                ?>
                                <option value="<?php echo $condo['id'];?>" <?php if(in_array($condo['id'],$condos_array)){?> selected="selected" <?php }?>>
								<?php echo $condo['name'];?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <span class="error_individual help-block" id="states_validate"></span>
                </div>
              </div>
          <div class="form-group" id="area_markup">
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
							<option  <?php if($state_id == $state['id']) echo 'selected="selected"';?> value="<?php echo $state['id'];?>"><?php echo $state['name'];?></option>
							<?php
						}
					}
					?>
                </select>
                <span class="error_individual help-block" id="states_validate"></span>
            </div>
          </div>
          
          <div id="loadedareas">
              <div class="form-group">
                <label class="col-md-3 control-label">Select Areas</label>
                <div class="col-md-9">
                    <select name="areas[]" multiple class="form-control">
                    <?php
					//Check if the areas selected is all.
					$state_areas_count = $this->General_model->
					get_data_all_like_using_where_count("areas","state_id='$state_id'");
					
					$ad_areas_count = $this->General_model->
					get_data_all_like_using_where_count("ad_display","ad_id='$advert->id'");
					
					//Get area list related to state.
					$state_area = $this->General_model->get_data_all_using_Multiwhere("state_id='$state_id'","areas");
					
					//Get ads area ID
					$area_row_array = $this->General_model->get_data_all_using_Multiwhere("ad_id='$advert->id'","ad_display");
					$reg_areas = array();
					foreach($area_row_array as $area)
					{
						array_push($reg_areas,$area['area_id']);
					}
							
					if($state_areas_count == $ad_areas_count){
						?>
						<option selected value="all">All</option>
							<?php
							
			
                            foreach($state_area as $area)
							{
								$actual_area_id = $area['id'];
								?>
								<option  
                                value="<?php echo $area['id']?>"><?php echo $area['name']?>
                                </option>
                                <?php
							}
					} else {
						?>
						<option value="all">All</option>
							<?php
                            foreach($state_area as $area)
							{
								$actual_area_id = $area['id'];
								?>
								<option <?php if(in_array($actual_area_id, $reg_areas)) echo 'selected'?> 
                                value="<?php echo $area['id']?>"><?php echo $area['name']?>
                                </option>
                                <?php
							}
						
					}
					?>
						
						  </select>
                    <span class="error_individual help-block" id="areas_validate"></span>
                </div>
              </div>
          </div>
          <?php
		  }
		   
		  else
		  {
		  ?>
          <div class="form-group" id="condos_markup" >
                <link href="<?php echo base_url();?>assets/front/global/plugins/chosen/chosen.css" rel="stylesheet" type="text/css" />
                <script src="<?php echo base_url();?>assets/front/global/plugins/chosen/chosen.js"></script>
                <label class="col-md-3 control-label">Condos</label>
                <div class="col-md-9">
                    <select class="chosen" multiple="multiple" name="condos[]" id="condos" style="width: 100%;" >  
                        <option value="">Select Condo</option>
                        <?php 
                        $condos = $this->General_model->get_data_all('condos');
						$condos_array = explode(',',$advert->condos);
                        if(sizeof($condos)>0)
                        {
                            foreach($condos as $condo)
                            {
                                ?>
                                <option value="<?php echo $condo['id'];?>" <?php if(in_array($condo['id'],$condos_array)){?> selected="selected" <?php }?>>
								<?php echo $condo['name'];?></option>
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
          <?php }?>
          
          
         
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
                <button type="submit" name="editadvertisementsub" id="editadvertisementsub" class="btn btn-primary">
                  Update
              </button>
            </div>
          </div>
        </div>
       </form>
      </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>





<script>
$(document).ready( function() {
        	$('select.chosen').chosen();
			<?php if($advert->display_all != '2'){?> 
			setTimeout(function(){ 
				$('#condos_markup').css('display','none');
			 }, 3000);
			<?php }?>
		});
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