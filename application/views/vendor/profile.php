<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/profile.min.css" />

<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Profile
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
					$details = $this->General_model->get_data_row_using_where('vendors','id='.$this->session->userdata('vendor_id'));
					if($details->image_url==''){?>
                    <img src="<?php echo base_url()?>assets/front/images/no-image.jpg" class="img-responsive" alt="" />                  
            <?php } else {?>                   
                    <img src="<?php echo base_url()?>uploads/vendor_images/<?php echo $details->image_url; ?>"  class="img-responsive profie_image" alt=""/>             
            <?php }?>
                                        
                                        
                                        </div>
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"> <?php echo $details->name?>  </div>
                                        <div class="profile-usertitle-job"> <?php echo $details->company_name?> </div>
                                    </div>
                                     
                                   <div class="profile-usermenu">
                                        
                                    </div>

                                </div>
                                <!-- END PORTLET MAIN -->
                               
                            </div>
                            <!-- END BEGIN PROFILE SIDEBAR -->
                            <!-- BEGIN PROFILE CONTENT -->
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
                        <form role="form" action="#">
                            <!--<div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" value="<?php echo $details->name?>" class="form-control" readonly/> </div>
                            <div class="form-group">
                                <label class="control-label">Company Name</label>
                                <input type="text" value="<?php echo $details->company_name?>" class="form-control" readonly/> </div>
-->                         <div class="form-group">
                                <label class="control-label">Email</label>
                                <div class="alert alert-info">
                                	<span><?php echo $details->email?></span>
                                </div> 
                                </div>
                            <div class="form-group">
                                <label class="control-label">Phone</label>
                                <div class="alert alert-info">
                                	<span><?php echo $details->phone?></span>
                                </div>
                                </div>
                            <div class="form-group">
                                <label class="control-label">Mobile</label>
                                <div class="alert alert-info">
                                	<span><?php echo $details->mobile?> </span>
                                </div>
                                </div>
                            <div class="form-group">
                                <label class="control-label">Address</label>
                                <div class="alert alert-info">
                                         <span><?php echo $details->address?> <br />
                                <?php echo $this->General_model->get_value_by_id('areas', $details->areas, 'name');?><br />
                                <?php echo $this->General_model->get_value_by_id('states', $details->state, 'name');?>
                                </span> 
                            </div>
                               
                            </div>
                            </form>
                                                    </div>
                                                    <!-- END PERSONAL INFO TAB -->
                                                    <!-- CHANGE AVATAR TAB -->
                                                    
                                                                                                        
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