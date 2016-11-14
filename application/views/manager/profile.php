<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"><?php echo $title;?>
      <small></small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>manager">Home</a>
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
			<!-- Tab content -->
			<div id="tabPayments" class="tab-pane innerAll">
				<div class="row">
					<div class="col-md-8">
						<div class="box-generic padding-none">
                        <?php
							//Get condo Address
							//$email_manager = $this->session->userdata('manager_email');
							$action = "id = '$manager_info->condo_id'";
							$condo_info = $this->General_model->get_data_row_using_where('condos', $action);
						?>
							<div class="innerAll inner-2x">
								<form method="POST" id="manager-profile" enctype="multipart/form-data">
                                <input type="hidden" value="<?php echo $manager_info->id?>" name="id">		
								  	<div class="form-group">
								    	<label for="name">Name</label>
								    	<input type="text" class="form-control" id="name" name="name" 
                                        placeholder="Name" value="<?php echo $manager_info->full_name;?>">
                                        <span class="error_individual" id="name_validate"></span>
								  	</div>
								  	<div class="form-group">
								    	<label for="name">Phone</label>
								    	<input type="text" class="form-control" id="phone" name="phone" 
                                        placeholder="Phone" value="<?php echo $manager_info->phone;?>">
                                        <span class="error_individual" id="phone_validate"></span>
								  	</div>
								  	
								 	<div class="form-group">
								    	<label for="exampleInputEmail1">Role</label>
                                        <?php 
										if($this->session->userdata('manager_email') == $condo_info->email){
											$user_role = 'Condo Admin';
										} else {
											$user_role = 'User';
										}
										?>
								    	<input type="text" class="form-control" disabled id="role" 
                                        placeholder="Role" value="<?php echo $user_role?>">
								  	</div>
                                    
                                    <div class="form-group">
								    	<label for="name">Profile Image</label>
								    	<input type="file" id="image_url" name="image_url">
                                        <span class="error_individual" id="image_url_validate"></span>
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
						  	<!--fa-user--><i class="fa  fa-3x pull-left text-faded"></i> <?php echo $manager_info->full_name;?> <br/>
                            <small class="text-faded">Last Login: <?php echo date("jS M'y h:i a", strtotime($manager_info->last_login))?>
                            </small>
						</div>    
					    <div class="box-generic padding-none">
					        <div class="innerAll border-bottom">
					        	<a href="" class="pull-right text-primary"></a>
					          	<h4 class="panel-title strong">Condo Info</h4>
					        </div>
					        <div class="innerAll">
					        	<!--fa-building fa  pull-left fa-3x--><i class=""></i> <span><?php echo $condo_info->name;?></span><br/>
                                <span><?php echo $condo_info->address;?></span><br/>
                                <span><?php echo $this->General_model->get_value_by_id('areas',$condo_info->areas,'name');?></span><br/>
                                <span><?php echo $this->General_model->get_value_by_id('areas',$condo_info->state,'name');?></span><br/>
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