<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"><?php echo $title;?>
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
		<!-- Table -->
       <form class="form-horizontal" role="form" id="condo-profile-manager" method="POST" enctype="multipart/form-data">
								<div class="row">
									<!-- Column -->
									<div class="col-md-6">
										<!-- Widget -->
										<!-- Widget -->
										<div class="widget row widget-inverse">
											<div class="widget-body">
												<div class="innerLR">
                                                <?php
												/*$email_manager = $this->session->userdata('manager_email');
												$action = "email = '$email_manager'";*/
												$action = "id = '$this->condo_id'";
		
												$condo_info = $this->General_model->get_data_row_using_where('condos', $action);
			
												?>
											<input type="hidden" value="<?php echo $condo_info->id?>" name="id">		
    <div class="form-group">
        <label class="col-sm-2 control-label">Picture</label>
        <div class="col-sm-10">
            <p class="form-control-static"><img src="<?php echo base_url()?>uploads/condos/condo_pictures/<?php echo $condo_info->condo_picture?>" width="200" height="100"></p>
            <!--<input type="file" class="form-control" id="condo_picture" name="condo_picture" >-->
           <span class="error_individual" id="logo_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $condo_info->name?>" placeholder="Name" readonly="readonly">
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
        <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" disabled value="<?php echo $condo_info->email?>" placeholder="Email">
            <span class="error_individual" id="email_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Phone</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $condo_info->phone?>" placeholder="Phone" readonly="readonly">
        </div>
    </div>
    
   
    
   
   





												</div>
											</div>
										</div>
										<!-- // Widget END -->

										<!-- // Widget END -->
</div>
<!-- Column -->
									<div class="col-md-6">
										<!-- Widget -->
										<div class="widget row widget-inverse">
											<div class="widget-body">
												<div class="innerLR">
                                               
													<div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Mobile</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $condo_info->mobile?>" placeholder="Mobile" readonly="readonly">
        </div>
    </div>
  <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Address</label>
        <div class="col-sm-10">
           <input type="text" class="form-control" id="address" name="address" value="<?php echo $condo_info->address?>" placeholder="Address" disabled="disabled">
        </div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Area</label>
        <div class="col-sm-10">
           <select class="form-control" id="areas" name="city" disabled="disabled">
        	<?php $city_name = $this->General_model->get_value_by_id('areas',$condo_info->areas,'name');?>
        	<option value="">Select City</option>
            <option value="<?php echo $condo_info->areas;?>" selected="selected"><?php echo $city_name;?></option>
        </select>
        </div>
    </div>
     <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">State</label>
        <div class="col-sm-10">
        <select class="form-control" id="state" name="state" disabled="disabled">
        	<option>Select State</option>
            <?php foreach($states as $state){?>
            	<option <?php if($condo_info->state == $state['id']) echo 'selected';?> value="<?php echo $state['id'];?>">
				<?php echo $state['name'];?>
                </option>
            <?php }?>
        </select>
        </div>
    </div>
    
     
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Post Code</label>
        <div class="col-sm-10">
           <input type="text" class="form-control" id="post_code" name="post_code" value="<?php echo $condo_info->postcode?>" placeholder="Post Code" disabled="disabled">
        </div>
    </div>
    
    <div class="form-group">
        <div class="alert alert-info">
          <strong>Note!</strong> For any changes in profile please contact ALIA Team.
        </div>
    </div>
    
												</div>
											</div>
										</div>
										<!-- // Widget END -->
</div>
</div>
<div class="row">
 <div class="form-group">
 <label for="" class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-offset-2 col-sm-10">
            <!--<button type="submit" name="editcondoprof" class="btn btn-primary">Update</button>
            <a href="#" class="btn btn-primary" onclick="callCrudAction('condo_admins',<?php echo $this->session->userdata('manager_id');?>,'delete_data')" >
            	<span class="glyphicon glyphicon-remove"></span>
            </a>-->
        </div>
    </div>
</div>
	</form>
       </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>