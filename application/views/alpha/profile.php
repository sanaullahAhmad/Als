<script src="<?php echo base_url()?>assetsfrontpagesscripts/profile-1.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/profile.css" />
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> User Profile
      <small>Profile</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Profile</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet ">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                <?php 
				$details = $this->General_model->get_data_row_using_where('residents','id='.$this->uri->segment(3));
				if($details->image_url==''){?>
                    <span id='output_image'>
                    <img src="<?php echo base_url()?>assets/front/images/no-image.jpg" class="img-responsive" alt="" />
                    <div class="fileUpload">
                        <span>
                        
                        <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/photo-upload.png" />
                        
                        </span>
                        
                       <form action="<?php echo base_url()?>home/upload_progress" id="myForm" name="frmupload" method="post" enctype="multipart/form-data">
                        <input name="upload_file" type="file" class="upload" onchange="upload_image_click()"/>
                       
                        <input name="upload_image_submit" id="upload_image_submit" type="submit" style="display:none" onclick="upload_image()"/>
                        </form>
                    </div>
                    </span>
            <?php } else {?>
                    <span id='output_image'>
                    <img src="<?php echo base_url()?>uploads/profile_pictures/<?php echo $details->image_url; ?>"  class="img-responsive" alt=""/>
                    <div class="fileUpload">
                        <span>
                        <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/photo-upload.png" />
                        </span>
                    </div>
                    </span>
            <?php }?>
            <img class="loadergif" style="display:none; width:32px; height:32px; margin-left:100px;" src="<?php echo base_url()?>assets_v1/front/images/ajax-loader.gif" />
                        </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name"> <?php echo $details->name?> </div>
                        <div class="profile-usertitle-job"> &nbsp; </div>
                    </div>
                    <div style="height:53px;"></div>
                </div>
            </div>
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                    </li>
                                    
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
<!-- PERSONAL INFO TAB -->
<div class="tab-pane active" id="tab_1_1">
<form method="POST" id="resident-profile">
<input type="hidden" value="<?php echo $resident_info->id?>" name="id">	                     	
<?php if ($this->session->flashdata('message')) { ?>
  <div class="alert alert-info"> 
      <?= $this->session->flashdata('message') ?> 
  </div>
<?php } ?>
<div class="form-group">
<label class="control-label">Name</label>
<input type="text" id="name" name="name" placeholder="Name" value="<?php echo $resident_info->name;?>" class="form-control" readonly="readonly"> 
<span class="error_individual" id="name_validate"></span>
</div>
<div class="form-group">
<label class="control-label">Phone</label>
<input type="text" id="phone" name="phone" placeholder="Phone" value="<?php echo $resident_info->phone?>" class="form-control" readonly="readonly"> 
<span class="error_individual" id="phone_validate"></span>
</div>
<div class="form-group">
<label class="control-label">Email</label>
<input type="text"  id="email" name="email" placeholder="Email"  value="<?php echo $resident_info->email?>" class="form-control" readonly="readonly"> 
 <input type="hidden" id="current_email" value="<?php echo $resident_info->email?>">
    <span class="error_individual" id="email_validate"></span>
</div>

<div class="margiv-top-10">
</div>
</form>           
</div>
<!-- END PERSONAL INFO TAB -->


<!-- END PRIVACY SETTINGS TAB -->
        </div>
    </div>
</div>
</div>
</div>
</div>
            <!-- END PROFILE CONTENT -->
        </div>
       </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>