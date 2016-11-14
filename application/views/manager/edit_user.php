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
        <form id="edituser-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Name"  value="<?php echo $service_cat->full_name?>">
                    <span class="error_individual" id="full_name_validate"></span>
                </div>
            </div>
           
          <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $service_cat->email?>">
                    <span class="error_individual" id="email_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Condo</label>
                <div class="col-sm-10">
                    <select class="form-control" id="condo" name="condo" >
                        <?php
                            if(sizeof($condos)>0)
                            {
                                foreach($condos as $condo)
                                {
                                    ?>
                                    <option value="<?php echo $condo['id']?>" <?php if($condo['id']==$service_cat->condo_id){?> selected="selected" <?php }?>><?php echo $condo['name']?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">User Role</label>
                <div class="col-sm-10">
                    <select class="form-control" id="role" name="role" >
                        <option value="1" <?php if(1==$service_cat->role){?> selected="selected" <?php }?>>Manager</option>
                        <option value="2" <?php if(2==$service_cat->role){?> selected="selected" <?php }?>>Security</option>
                    </select>
                    <span class="error_individual" id="role_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password"  >
                    <span class="error_individual" id="password_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" id="table" name="table" value="admin">
                    <input type="hidden" id="current_name" name="current_name" value="<?php echo $service_cat->full_name?>">
                    <input type="hidden" id="current_email" name="current_email" value="<?php echo $service_cat->email?>">
                    <button type="submit" id="edit_user_btn" name="edit_user_btn" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
		</div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>