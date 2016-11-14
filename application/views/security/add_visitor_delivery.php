<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Visitor/Delivery
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
              <span>Add Visitor/Delivery</span>
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
        <form id="addvisitordelivery-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <select id="block" name="block" onchange="change_floors(this.value)" class="form-control">
                        <option value="">
                            Block
                        </option>
                        <?php
                          if(sizeof($blocks)>0)
                          {
                              foreach($blocks as $block)
                              {
                                  ?>
                                  <option value="<?php echo $block['id']?>" ><?php echo $block['name']?></option>
                                  <?php
                              }
                          }
                          else
                          {
                              ?>
                                  <option value="" >No blocks available</option>
                              <?php
                          }
                      ?>
                    </select>
                    <span class="error_individual" id="block_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Floor</label>
                <div class="col-sm-10">
                    <select id="floors" name="floors" class="form-control">
                        <option value="">
                            Floor
                        </option>
                    </select>
                    <span class="error_individual" id="floors_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Unit</label>
                <div class="col-sm-10">
                    <select id="unit" name="unit" class="form-control" onchange="search_resident()">
                        <option value="">
                            Unit
                        </option>
                    </select>
                    <span class="error_individual" id="unit_validate"></span>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Resident</label>
                <div class="col-sm-10">
                    <select id="resident" name="resident" class="form-control">
                        <option value="">
                            Resident
                        </option>
                    </select>
                    <span class="error_individual" id="resident_validate"></span>
                </div>
            </div>
            
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                    <select class="form-control" id="type" name="type" >
                        <?php 
                        if($this->session->userdata('security_id')!="")
                        {
                            //echo '<option value="delivery">Delivery</option>';
                            $admin_id=0;
                            $action="condo_id=$this->condo_id AND role='1'";
                            $get_admin = $this->General_model->get_data_all_like_using_where('condo_admins', $action);
                            if($get_admin >0)
                            {
                                foreach($get_admin as $admin)
                                {
                                    $admin_id 			  = $admin['id'];
                                    $sunrise = $admin['delivery_time_starts'];
                                    $sunset   = $admin['delivery_time_ends'];
                                }
                            }
                            $current_time = date('H:i:s');
                            $date1 = date('Hi', strtotime($current_time));
                            $date2 = date('Hi', strtotime($sunrise));
                            $date3 = date('Hi', strtotime($sunset));
                            if ($date1 > $date2 && $date1 < $date3)
                            {
                               echo '<option value="delivery">Delivery</option>';
                            }
                            else 
                            {
                                //
                            }
                            
                          }
                        ?>
                        
                        <option value="visitor">Visitor</option>
                    </select>
                    <span class="error_individual" id="role_validate"></span>
                </div>
            </div>
           
          
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" id="add_visitor_delivery_btn" name="add_visitor_delivery_btn" class="btn btn-primary">Add<?php //echo $this->condo_id;?></button>
                </div>
            </div>
        </form>
		 </div>
       </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>