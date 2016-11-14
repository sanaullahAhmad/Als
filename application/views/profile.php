<script src="<?php echo base_url()?>assets/front/pages/scripts/profile-1.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/profile.css" />
<style>
#demo8_form
{
	text-align:center;
}
.btn.btn-large.green
{
	margin-top: 8px; display: inline-block; float: none;
}
/*.fileUpload input.upload {
    cursor: pointer;
    font-size: 20px;
    height: 49px;
    margin: 0;
    opacity: 0;
    padding: 0;
    position: absolute;
    right: 5px;
    top: 5px;
}*/
</style>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>
                  <?php if(isset($page_title)){ echo $page_title;}?>                              
                </h1>
            </div>
            <!-- END PAGE TITLE -->
            <!-- BEGIN PAGE TOOLBAR -->
            
            <!-- END PAGE TOOLBAR -->
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE CONTENT BODY -->
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="page-content-inner">
              <div class="row">
                  <div class="left-post">
                      <!-- BEGIN PROFILE SIDEBAR -->
                      <div class="profile-sidebar">
                          <!-- PORTLET MAIN -->
                          <div class="portlet light profile-sidebar-portlet ">
                              <!-- SIDEBAR USERPIC -->
                              <div class="profile-userpic">
                              <?php 
            $details = $this->General_model->get_data_row_using_where('residents','id='.$this->session->userdata('resident_id'));
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
                    <span id='output_image' style="position:relative">
                    <span onclick="remove_profile_image('<?php echo $this->session->userdata('resident_id'); ?>')" class="image_delete_cross" style="background: rgba(255,255,255,0.9);
margin-left: 0; padding:0 5px 1px; position: absolute; right: 0; top: 0; z-index: 100; color:#000; font-size:15px;">
                    x
                    </span>
                   <!-- <img src="<?php echo base_url()?>uploads/profile_pictures/<?php echo $details->image_url; ?>"  class="img-responsive profie_image" alt="" id="demo_crop"/>-->
                      <img src="<?php echo base_url()?>uploads/profile_pictures/<?php echo $details->image_url; ?>"  class="img-responsive profie_image" alt=""  id="demo_crop"/>
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
                    <?php if($this->session->flashdata('crop')){?>
                    <form action="<?php echo base_url();?>home/jacrop"  method="post" id="demo8_form">
                      <input type="hidden" id="image_url" name="image_url" value="<?php echo $details->image_url;?>"  />
                      <input type="hidden" id="crop_x" name="x"  />
                      <input type="hidden" id="crop_y" name="y" />
                      <input type="hidden" id="crop_w" name="w" />
                      <input type="hidden" id="crop_h" name="h" />
                      <input type="hidden" id="targ_h" name="targ_h" />
                      <input type="hidden" id="targ_w" name="targ_w" />
                      <input type="submit" value="Crop Image" class="btn btn-large green" /> 
                   </form>
            <?php }}?>
            <img class="loadergif" style="display:none; width:32px; height:32px; margin-left:100px;" src="<?php echo base_url()?>assets_v1/front/images/ajax-loader.gif" />
            
                          </div>
                      <div class="profile-usertitle">
                          <div class="profile-usertitle-name"> <?php echo $details->name?> </div>
                          <div class="profile-usertitle-job-custom"> 
                          <?php
						  $condo_id = $this->session->userdata('condo_id');
                          $action_condo = "id = $condo_id";
						  $condo_info = $this->General_model->get_data_row_using_where('condos', $action_condo);
                          $block_id = $this->General_model->get_value_by_id('residents',$details->id,'block');
                          echo $condo_info->name.' '.$this->General_model->get_value_by_id('blocks', $block_id,'name');
						  ?>-
								<?php echo $this->General_model->get_value_by_id('residents',$details->id,'floor')?>-
								<?php echo $this->General_model->get_value_by_id('residents',$details->id,'unit')?>
                                <br/>
                                <?php echo $condo_info->address?><br/>
                                <?php echo $this->General_model->get_value_by_id('areas',$condo_info->areas,'name');?> -
                                <?php echo $condo_info->postcode?>

                           </div>
                      </div>
                      <div style="height:53px;"></div>
                  </div>
              </div>
              <div class="profile-content">
                  <div class="row">
                      <div class="col-md-12">
                          <div class="portlet light" style="min-height: 436px;">
                              <div class="portlet-title tabbable-line">
                                  <div class="caption caption-md">
                                      <i class="icon-globe theme-font hide"></i>
                                      <!--<span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>-->
                                  </div>
                                  <ul class="nav nav-tabs" style="float:left">
                                      <li class="active">
                                          <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                      </li>
                                      <li>
                                          <a href="#tab_1_2" data-toggle="tab">Close Account</a>
                                      </li>
                                      <li>
                                          <a href="#tab_1_3" data-toggle="tab">Change Password</a>
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
                        <input type="text" id="name" name="name" placeholder="Name" value="<?php echo $resident_info->name;?>" class="form-control"> 
                        <span class="error_individual" id="name_validate"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Phone</label>
                        <input type="text" id="phone" name="phone" placeholder="Phone" value="<?php echo $resident_info->phone?>" class="form-control"> 
                        <span class="error_individual" id="phone_validate"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="text"  id="email" name="email" placeholder="Email"  value="<?php echo $resident_info->email?>" class="form-control" readonly="readonly"> 
                         <input type="hidden" id="current_email" value="<?php echo $resident_info->email?>">
                            <span class="error_individual" id="email_validate"></span>
                    </div>
                    
                    <div class="margiv-top-10">
                        <input name="resiprofsubmit" type="submit" class="btn default" value="Submit" />
                        <a href="javascript:;" class="btn default"> Cancel </a>
                    </div>
                </form>           
              </div>
              <!-- END PERSONAL INFO TAB -->
              
              
              
              
              
              <!-- CHANGE AVATAR TAB -->
              <div class="tab-pane" id="tab_1_2">
              <form method="post" action="<?php echo base_url();?>close_account">
              
              <div class="form-group">
                  <label class="control-label">Reason</label>
                  <!--<textarea  id="reason" name="reason" placeholder="Reason" class="form-control"></textarea>-->
                  <select class="form-control" name="reason" id="reason">
                  <?php 
				  $closing_account_options=$this->General_model->get_data_all('closing_account_options');
				  if(sizeof($closing_account_options)>0)
				  {
					  foreach($closing_account_options as $option)
					  {
						  ?>
						  <option><?php echo $option['name']?></option>
						  <?php
					  }
				  }
				  ?>
                  </select>
                  <span class="error_individual" id="reason_validate"></span>
              </div>
              
              <div class="margiv-top-10">
                  <input name="reason_submit_btn" type="submit" class="btn default" value="Submit" />
                  <a href="javascript:;" class="btn default"> Cancel </a>
              </div>
              </form>
              </div>
              <!-- END CHANGE AVATAR TAB -->
              <!-- CHANGE PASSWORD TAB -->
              <div class="tab-pane" id="tab_1_3">
                  <form action="<?php echo base_url();?>change_password"  method="POST" id="change-password">
                  <input type="hidden" value="<?php echo $this->session->userdata('resident_id');?>" name="id">
                      <div class="form-group">
                          <label class="control-label">Current Password</label>
                          <input type="password" class="form-control" id="password" name="password" placeholder="Type here">
                          <span class="error_individual" id="password_validate"></span> </div>
                      <div class="form-group">
                          <label class="control-label">New Password</label>
                          <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Type here">
                          <span class="error_individual" id="new_password_validate"></span> </div>
                      <div class="form-group">
                          <label class="control-label">Re-type New Password</label>
                          <input type="password" class="form-control" id="retype_password" name="retype_password" placeholder="Type here">
                          <span class="error_individual" id="retype_password_validate"></span> </div>
                      <div class="margin-top-10">
                          <button type="submit" name="changepasssub" class="btn green"> Change Password </button>
                          <a href="javascript:;" class="btn default"> Cancel </a>
                      </div>
                  </form>
              </div>
              <!-- END CHANGE PASSWORD TAB -->
              
              
              
              
              
              
              <!-- PRIVACY SETTINGS TAB -->
              
              <!-- END PRIVACY SETTINGS TAB -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                         
                      
                        </div>
                        <!-- END PROFILE CONTENT -->
                        <div class="row">
                              <div class="col-md-12">
                              <?php
			  echo $this->load->view('template/feature_ad');
			  ?>
                              </div>
                      	</div>
                    </div>
                    
                    <?php echo $this->load->view('template/sidebar');?> 
                </div>
                
                
                
                 
                      
            </div>
             
        </div>
    </div>
</div>