<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Edit Condo
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
              <span>Edit Condo</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      
      <div class="portlet-body">
                                                        
        <div class="tabbable-line">
            <ul class="nav nav-tabs ">
                <li class="active">
                    <a href="#tab_15_1" data-toggle="tab"> Condo Info </a>
                </li>
                <li>
                    <a href="#tab_15_2" data-toggle="tab"> Module Settings </a>
                </li>
                <li>
                    <a href="#tab_15_3" data-toggle="tab"> Condo Settings </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_15_1">
                
                
                <div class="portlet light ">
                                        
                <div class="portlet-body form">
                    <form id="editcondo-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
<input type="hidden" value="<?php echo $condo_info->id?>" name="id">
<div class="form-group">
<label class="col-sm-2 control-label">Name</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="name" name="name" value="<?php echo $condo_info->name?>" placeholder="Name">
<span class="error_individual" id="name_validate"></span>
</div>
</div>
<div class="form-group">
<label for="inputPassword3" class="col-sm-2 control-label">Code</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="code" name="code" disabled value="<?php echo $condo_info->code?>" placeholder="Code">
<span class="error_individual" id="code_validate"></span>
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Email</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="email" name="email" disabled value="<?php echo $condo_info->email?>" placeholder="Email">
<span class="error_individual" id="email_validate"></span>
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Phone</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $condo_info->phone?>" placeholder="Phone">
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Mobile</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $condo_info->mobile?>" placeholder="Mobile">
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Logo</label>
<div class="col-sm-7">
<input type="file" class="form-control" id="logo" name="logo" >
<span class="error_individual" id="logo_validate"></span>
</div>

<div class="col-sm-3">
<img src="<?php echo base_url()?>uploads/condos/condo_logos/<?php echo $condo_info->logo?>" width="100%" height="100"/>
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Condo Picture</label>
<div class="col-sm-7">
<input type="file" class="form-control" id="condoimg" name="condoimg" >
<span class="error_individual" id="condoimg_validate"></span>
</div>

<div class="col-sm-3">
<img src="<?php echo base_url()?>uploads/condos/condo_pictures/<?php echo $condo_info->condo_picture?>" width="100%" height="100"/>
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Address</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="address" name="address" value="<?php echo $condo_info->address?>" placeholder="Address">
</div>
</div>  
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">State</label>
<div class="col-sm-10">
<select class="form-control" id="edit_state" name="state">
<option>Select State</option>
<?php foreach($states as $state){?>
<option <?php if($condo_info->state == $state['id']) echo 'selected';?> value="<?php echo $state['id'];?>"><?php echo $state['name'];?></option>
<?php }?>
</select>
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Area</label>
<div class="col-sm-5">
<select class="form-control" id="areas" name="areas" >
<?php $city_name = $this->General_model->get_value_by_id('areas',$condo_info->areas,'name');?>
<option value="">Select City</option>
<option value="<?php echo $condo_info->areas;?>" selected="selected"><?php echo $city_name;?></option>
</select>
<span class="error_individual" id="areas_validate"></span>
</div>
<label for="inputEmail3" class="col-sm-2 control-label">Current Area</label>
<div class="col-sm-3">
<input type="text" class="form-control" disabled="disabled" value="<?php echo $this->General_model->get_value_by_id('areas',$condo_info->areas, 'name')?>" >
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Status</label>
<div class="col-sm-5">
<select class="form-control" id="status" name="status" >
<option value="1" <?php if($condo_info->status==1){?> selected="selected" <?php }?>>Active</option>
<option value="0" <?php if($condo_info->status==0){?> selected="selected" <?php }?>>Inactive</option>
</select>
</div>

</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Post Code</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="post_code" name="post_code" value="<?php echo $condo_info->postcode?>" placeholder="Post Code">
</div>
</div>
<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Privacy</label>
<div class="col-sm-10">
<select class="form-control" id="privacy" name="privacy" >
<option value="1" <?php if($condo_info->privacy==1){?> selected="selected" <?php }?>>Public</option>
<option value="0" <?php if($condo_info->privacy==0){?> selected="selected" <?php }?>>Private</option>
</select>
<span class="error_individual" id="areas_validate"></span>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" id="edit_condo_btn" name="edit_condo_btn" class="btn btn-primary">Update</button>
</div>
</div>
</form>
</div>
</div>
    </div>
    
    <div class="tab-pane" id="tab_15_2">
       <div class="portlet light form-fit ">
                        
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php
			$condo_module_count = $this->General_model->get_data_all_like_using_where_count('condo_modules', "condo_id = '$condo_info->id'");
			if($condo_module_count > 0){
			$condo_modules = $this->General_model->get_data_row_using_where('condo_modules', "condo_id = '$condo_info->id'");
			?>
            <form action="#" method="POST" class="form-horizontal form-bordered">
            <input type="hidden" value="<?php echo $condo_info->id?>" name="id">

                <div class="form-body">
                                    
            <div class="form-group">
                <label class="control-label col-md-3">Quick Pay</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="quick_pay" 
					<?php if($condo_modules->quick_pay == '1'){echo 'checked';} else {echo '';}?>
                    data-on-color="primary" data-off-color="danger" data-on-text="&nbsp;Enabled&nbsp;" data-off-text="&nbsp;Disabled&nbsp;">
                     </div>
            </div>
          
        </div>
                                
        <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Facility</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="facility" 
					<?php if($condo_modules->facility == '1'){echo 'checked';} else {echo '';}?>
                    data-on-color="primary" data-off-color="danger" data-on-text="&nbsp;Enabled&nbsp;" data-off-text="&nbsp;Disabled&nbsp;">
                     </div>
            </div>
          
        </div>
        
        <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Services</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="services" 
                    <?php if($condo_modules->services == '1'){echo 'checked';} else {echo '';}?>
                    data-on-color="primary" data-off-color="danger" data-on-text="&nbsp;Enabled&nbsp;" data-off-text="&nbsp;Disabled&nbsp;">
                     </div>
            </div>
          
        </div>
                                
        <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Visitors & Deliveries</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="visitors_delivery" 
                    <?php if($condo_modules->visitors == '1'){echo 'checked';} else {echo '';}?>
                    data-on-color="primary" data-off-color="danger" data-on-text="&nbsp;Enabled&nbsp;" data-off-text="&nbsp;Disabled&nbsp;">
                     </div>
            </div>
          
        </div>
        
        <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Noticeboard</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="noticeboard" 
                    <?php if($condo_modules->noticeboard == '1'){echo 'checked';} else {echo '';}?>
                    data-on-color="primary" data-off-color="danger" data-on-text="&nbsp;Enabled&nbsp;" data-off-text="&nbsp;Disabled&nbsp;">
                     </div>
            </div>
          
        </div>
                                
        <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Incident</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="incident" 
                    <?php if($condo_modules->incident == '1'){echo 'checked';} else {echo '';}?>
                    data-on-color="primary" data-off-color="danger" data-on-text="&nbsp;Enabled&nbsp;" data-off-text="&nbsp;Disabled&nbsp;">
                     </div>
            </div>
          
        </div>
                                
         <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Useful Links</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="useful_links" 
                    <?php if($condo_modules->useful_links == '1'){echo 'checked';} else {echo '';}?>
                    data-on-color="primary" data-off-color="danger" data-on-text="&nbsp;Enabled&nbsp;" data-off-text="&nbsp;Disabled&nbsp;">
                     </div>
            </div>
          
        </div>
                                
         <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Community Wall</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="community_wall"
                    <?php if($condo_modules->community_wall == '1'){echo 'checked';} else {echo '';}?>
                     data-on-color="primary" data-off-color="danger" data-on-text="&nbsp;Enabled&nbsp;" data-off-text="&nbsp;Disabled&nbsp;">
                     </div>
            </div>
          
        </div>
                                
            <div class="form-body">
                
                <div class="form-group">
                    <label class="control-label col-md-3">Advertisement</label>
                    <div class="col-md-9">
                        <input type="checkbox" class="make-switch" name="advertisement"
                    <?php if($condo_modules->advertisement == '1'){echo 'checked';} else {echo '';}?>
                         data-on-color="primary" data-off-color="danger" data-on-text="&nbsp;Enabled&nbsp;" data-off-text="&nbsp;Disabled&nbsp;">
                         </div>
                </div>
              
            </div>
            <div class="form-body">
                
                <div class="form-group">
                    <label class="control-label col-md-3">House Rules & Froms</label>
                    <div class="col-md-9">
                        <input type="checkbox" class="make-switch" name="house_rules_froms"
                    <?php if($condo_modules->house_rules_froms == '1'){echo 'checked';} else {echo '';}?>
                         data-on-color="primary" data-off-color="danger" data-on-text="&nbsp;Enabled&nbsp;" data-off-text="&nbsp;Disabled&nbsp;">
                         </div>
                </div>
              
            </div>
            
        <div class="form-group">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" id="edit_condomodules_btn" name="edit_condomodules_btn" class="btn green">
                        Update
                </div>
            </div>
        </div>
        </form>
        <?php
			} else {
				?>
			<form action="#" method="POST" class="form-horizontal form-bordered">
            <input type="hidden" value="<?php echo $condo_info->id?>" name="id">

                <div class="form-body">
                                    
            <div class="form-group">
                <label class="control-label col-md-3">Quick Pay</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="quick_pay" 
                    data-on-color="primary" data-off-color="danger" data-on-text="&nbsp;Enabled&nbsp;" data-off-text="&nbsp;Disabled&nbsp;">
                     </div>
            </div>
          
        </div>
                                
        <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Facility</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="facility" 
                    data-on-color="primary" data-off-color="danger">
                     </div>
            </div>
          
        </div>
        
         <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Services</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="services" 
                    
                    data-on-color="primary" data-off-color="danger">
                     </div>
            </div>
          
        </div>
        
                                
        <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Visitors & Deliveries</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="visitors_delivery" 
                    data-on-color="primary" data-off-color="danger">
                     </div>
            </div>
          
        </div>
        
         <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Noticeboard</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="noticeboard" 
                    data-on-color="primary" data-off-color="danger">
                     </div>
            </div>
          
        </div>
                                
        <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Incident</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="incident" 
                    data-on-color="primary" data-off-color="danger">
                     </div>
            </div>
          
        </div>
                                
         <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Useful Links</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="useful_links" 
                    data-on-color="primary" data-off-color="danger">
                     </div>
            </div>
          
        </div>
                                
         <div class="form-body">
            
            <div class="form-group">
                <label class="control-label col-md-3">Community Wall</label>
                <div class="col-md-9">
                    <input type="checkbox" class="make-switch" name="community_wall"
                     data-on-color="primary" data-off-color="danger">
                     </div>
            </div>
          
        </div>
                                
            <div class="form-body">
                
                <div class="form-group">
                    <label class="control-label col-md-3">Advertisement</label>
                    <div class="col-md-9">
                        <input type="checkbox" class="make-switch" name="advertisement"
                         data-on-color="primary" data-off-color="danger">
                         </div>
                </div>
              
            </div>
            
        <div class="form-group">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" id="edit_condomodules_btn" name="edit_condomodules_btn" class="btn green">
                        Add
                </div>
            </div>
        </div>
        </form>
			<?php	
			}
		?>
                            
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
                
                
                
                <div class="tab-pane" id="tab_15_3">
                <?php if(isset($msg)){?>
          <div class="alert alert-success alert-dismissable"> <i class="fa fa-check"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?php echo $msg;?> </div>
          <?php } ?>
          <div class="portlet light ">
                                        
                <div class="portlet-body form">
                   <form action="#" method="POST" class="form-horizontal form-bordered">
            <input type="hidden" value="<?php echo $condo_info->id?>" name="id">

                <div class="form-body">
          <?php foreach($condo_settings as $condo_setting){?>         
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo $condo_setting['name'];?></label>
                <?php 
				if($condo_setting['key_id'] == 'condo_logo'){
				?>
                <div class="col-md-9">
                <select class="form-control" name="<?php echo $condo_setting['key_id'];?>">
                	<option <?php if($condo_setting['value'] == 0) echo 'selected';?> value="0">Alpha Logo</option>
                	<option <?php if($condo_setting['value'] == 1) echo 'selected';?> value="1">Condo Logo</option>
                </select>
                </div>
                <?php
				} else {
				?>
                  <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="<?php echo $condo_setting['name'];?>"
                    name="<?php echo $condo_setting['key_id'];?>" value="<?php echo $condo_setting['value'];?>">
                </div>
                <?php
				}
				?>
            </div>
          <?php }?>
        </div>
                     
        
          
        <div class="form-group">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" id="edit_settings_btn" name="edit_settings_btn" class="btn green">
                        Update
                </div>
            </div>
        </div>
        </form>
        </div>
        </div>
				</div>
                
                
            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    
      <!-- Table -->
          
      </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>