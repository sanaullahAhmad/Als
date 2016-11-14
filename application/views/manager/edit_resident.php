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
        <form id="editresident-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"  value="<?php echo $service_cat->name?>">
                    <span class="error_individual" id="name_validate"></span>
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
                <label class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?php echo $service_cat->phone?>">
                    <span class="error_individual" id="phone_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Block</label>
                <div class="col-sm-10">
                    <select class="form-control" id="block" name="block" onchange="change_floors(this.value)">
                        <?php
                            if(sizeof($blocks)>0)
                            {
                                foreach($blocks as $block)
                                {
                                    ?>
                                    <option value="<?php echo $block['id']?>" <?php if($block['id']==$service_cat->block){?> selected="selected" <?php }?>><?php echo $block['name']?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    <span class="error_individual" id="block_validate"></span>
                </div>
            </div>
            
            <?php
                $res = $this->General_model->get_data_row_using_where('blocks', 'id= '.$service_cat->block);
            ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Floor</label>
                <div class="col-sm-10">
                    <select class="form-control" id="floor" name="floor">
                        <option value="G" <?php if('G'==$service_cat->floor){?> selected="selected"<?php }?>>G</option>
                        <?php
                        for($i=1; $i<=$res->floors; $i++ )
                        {
                            ?>
                            <option value="<?php echo $i;?>" <?php if($i==$service_cat->floor){?> selected="selected"<?php }?>><?php echo $i;?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="error_individual" id="floor_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Unit</label>
                <div class="col-sm-10">
                    <select class="form-control" id="unit" name="unit">
                        <?php
                        for($i=1; $i<=$res->units; $i++ )
                        {
                            ?>
                            <option value="<?php echo $i;?>" <?php if($i==$service_cat->unit){?> selected="selected"<?php }?>><?php echo $i;?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <span class="error_individual" id="unit_validate"></span>
                </div>
            </div>
            
           <!-- <div class="form-group">
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
            </div>-->
            
            <div class="form-group">
                <label class="col-sm-2 control-label">type</label>
                <div class="col-sm-10">
                    <select class="form-control" id="type" name="type" >
                        <option value="1" <?php if(1==$service_cat->type){?> selected="selected" <?php }?>>Tenant</option>
                        <option value="2" <?php if(2==$service_cat->type){?> selected="selected" <?php }?>>Owner</option>
                        <option value="11" <?php if(11==$service_cat->type){?> selected="selected" <?php }?>>Primary Owner</option>
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
                    <input type="hidden" id="table" name="table" value="residents">
                    <input type="hidden" id="current_name" name="current_name" value="<?php echo $service_cat->name?>">
                    <input type="hidden" id="current_email" name="current_email" value="<?php echo $service_cat->email?>">
                    <button type="submit" id="edit_resident_btn" name="edit_resident_btn" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
		</div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>