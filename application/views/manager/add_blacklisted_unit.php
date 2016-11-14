<!--<link href="<?php echo base_url()?>assets/front/layouts/layout2/css/bootstrap.min.css">
-->         <link href="<?php echo base_url()?>assets/front/layouts/layout2/css/multiselect.css">


<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Blacklisted Units
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
              <span>Add Blacklisted Units</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
<?php if($this->session->flashdata("message")){ echo "<h3 style='color:green;'>".$this->session->flashdata("message")."</h3>";}?>
<form id="addblacklistedunit-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-md-3 control-label">Block</label>
        <div class="col-md-3">
            <select id="block" name="block" onchange="change_floors_blacklist(this.value)" class="form-control">
                <option value="">
                    Block
                </option>
                <?php
                  if(sizeof($blocks)>0)
                  {
                      foreach($blocks as $block)
                      {
                          ?>
                          <option value="<?php echo $block['block']?>" ><?php echo $this->General_model->get_value_by_id('blocks',$block['block'],'name')?></option>
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
    <div class="form-group"  >
        <label class="col-md-3 control-label">Floor</label>
        <div class="col-md-3" id="floors">
            <select name="floors" class="form-control">
                <option value="">
                    Floor
                </option>
            </select>
            <span class="error_individual" id="floors_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label">Unit</label>
        <div class="col-md-3" id="unites">
            <select id="unit" name="unit" class="form-control" onchange="search_resident()">
                <option value="">
                    Unit
                </option>
            </select>
            <span class="error_individual" id="unit_validate"></span>
        </div>
    </div>
    <?php /*?>
    <div class="form-group">
        <label class="col-sm-2 control-label">Unit</label>
        <div class="col-sm-10">
            <select class="form-control" id="unit" name="unit" >
                <?php 
				if(sizeof($unites)>0)
				{
					foreach($unites as $unit)
					{
				?>
                <option value="<?php echo $unit['block'];?>" onchange="change_floors(this.value)">
				<?php echo $this->General_model->get_value_by_id('blocks',$unit['block'],'name').'-',$unit['floor'].'-'.$unit['unit'];?>
                </option>
                <?php }
				}?>
            </select>
            <span class="error_individual" id="facility_category_validate"></span>
        </div>
    </div>
  
    <div class="form-group">
        <label class="col-sm-2 control-label">Facility Disabled?</label>
        <div class="col-sm-10">
            <select class="form-control" id="disable_facility" name="disable_facility" >
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <span class="error_individual" id="disable_facility_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Service Disabled?</label>
        <div class="col-sm-10">
            <select class="form-control" id="disable_service" name="disable_service" >
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <span class="error_individual" id="disable_service_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Account Creation Disabled?</label>
        <div class="col-sm-10">
            <select class="form-control" id="disable_account_creation" name="disable_account_creation" >
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
            <span class="error_individual" id="disable_account_creation_validate"></span>
        </div>
    </div>
	<?php */?>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        	<input type="hidden" id="table" name="table" value="admin">
            <button type="submit" id="add_blacklistedunit_btn" name="add_blacklistedunit_btn" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
     </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>