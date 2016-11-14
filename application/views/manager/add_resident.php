<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title">Add Resident
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
              <span>Add Resident</span>
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
        <form id="addresident-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    <span class="error_individual" id="name_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    <span class="error_individual" id="email_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                    <span class="error_individual" id="phone_validate"></span>
                </div>
            </div>
            <?php //print_r($blocks);?>
           <div class="form-group">
                <label class="col-sm-2 control-label">Block</label>
                <div class="col-sm-10">
                    <select class="form-control" id="block" name="block" onchange="change_floors(this.value)">
                        <option value="" >--Select--</option>
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
                        ?>
                    </select>
                    <span class="error_individual" id="block_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Floor</label>
                <div class="col-sm-10">
                    <select class="form-control" id="floors" name="floor">
                        <option value="" >--Select--</option>
                    </select>
                    <span class="error_individual" id="floor_validate"></span>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Unit</label>
                <div class="col-sm-10">
                    <select class="form-control" id="unit" name="unit">
                        <option value="" >--Select--</option> 
                    </select>
                    <span class="error_individual" id="unit_validate"></span>
                </div>
            </div>
            
        <!--    <div class="form-group">
                <label class="col-sm-2 control-label">Condo</label>
                <div class="col-sm-10">
                    <select class="form-control" id="condo" name="condo" >
                        <?php
                            if(sizeof($condos)>0)
                            {
                                foreach($condos as $condo)
                                {
                                    ?>
                                    <option value="<?php echo $condo['id']?>"><?php echo $condo['name']?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
                    <span class="error_individual" id="condo_validate"></span>
                </div>
            </div>-->
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                    <select class="form-control" id="type" name="type" >
                        <option value="2">Owner</option>
                        <option value="1">Tenant</option>
                        <option value="11">Primary Owner</option>
                    </select>
                    <span class="error_individual" id="type_validate"></span>
                </div>
            </div>
           
          
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                   <button type="submit" id="add_resident_btn" name="add_resident_btn" class="btn btn-primary">Register User</button>
                </div>
            </div>
        </form>
         </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>