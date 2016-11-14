<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Profile
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
              <span>Profile</span>
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
		  <!-- Tab content -->
          <div id="tabPayments" class="tab-pane innerAll">
              <div class="row">
                  <div class="col-md-8">
                      <div class="box-generic padding-none">
                      <?php
                          //Get condo Address
                          //$email_manager = $this->session->userdata('manager_email');
                          $action = "id = '$security_info->condo_id'";
                          $condo_info = $this->General_model->get_data_row_using_where('condos', $action);
                      ?>
                          <div class="innerAll inner-2x">
                              <form method="POST" id="manager-profile">
                              <input type="hidden" value="<?php echo $security_info->id?>" name="id">		
                                  <div class="form-group">
                                      <label for="name">Name</label>
                                      <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $security_info->full_name;?>">
                                      <span class="error_individual" id="name_validate"></span>
                                  </div>
                                  
                                  <div class="form-group">
                                      <label for="exampleInputEmail1">Email</label>
                                    
                                      <input type="text" class="form-control" disabled id="email" placeholder="Email" value="<?php echo $security_info->email?>">
                                  </div>
                                  <div class="text-right">
                                      <button type="submit" name="manprofsubmit" class="btn btn-primary">Update Profile</button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="box-generic strong">
                          <!--fa fa-user-->
                          <i class=" fa-3x pull-left text-faded"></i> <?php echo $security_info->full_name;?> <br/>
                          <small class="text-faded">Last Login: <?php echo date("jS M'y h:i a",strtotime($security_info->last_login))?></small>
                      </div>    
                      <!--box-generic-->
                      <div class=" padding-none">
                          <div class="innerAll border-bottom">
                              <a href="" class="pull-right text-primary"></a>
                              <h4 class="panel-title strong">Condo Info</h4>
                          </div>
                          <div class="innerAll">
                          <!--fa fa-building -->
                              <i class="pull-left fa-3x"></i> <span><?php echo $condo_info->name;?></span><br/>
                              <span><?php echo $condo_info->address;?></span><br/>
                              <span><?php echo $this->General_model->get_value_by_id('areas',$condo_info->areas,'name');?></span><br/>
                              <span><?php echo $this->General_model->get_value_by_id('states',$condo_info->state,'name');?></span><br/>
                              <span><?php echo $condo_info->postcode;?></span>
                          </div>
                      </div>

                  </div>
              </div>
          </div>
          <!-- // Tab content END -->
          </div>
       </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>