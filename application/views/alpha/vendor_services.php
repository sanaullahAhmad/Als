<link rel="stylesheet" href="<?php echo base_url()?>assets_v1/admin/css/components/plugins/ImageSelect.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets_v1/admin/css/components/plugins/chosen.min.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets_v1/admin/css/components/plugins/jquery.multiselect.css">
    
<script type="text/javascript" src="<?php echo base_url()?>assets_v1/admin/css/components/plugins/chosen.jquery.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url()?>assets_v1/admin/css/components/plugins/jquery.multiselect.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets_v1/admin/css/components/plugins/ImageSelect.jquery.js"></script>
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Vendors
      <small>Services</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Vendors Services</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
                                                            
  <?php if ($this->session->flashdata('success_message')) { ?>
    <div style="float:left; width:100%; height:50px; position:relative; z-index:111111; margin-bottom:15px;">
        <div class="alert alert-success"> <?= $this->session->flashdata('success_message') ?> </div>
    </div>
<?php } ?>
        <form method="post" class="form-horizontal" >
            <div class="widget-body innerAll inner-2x">
              <?php
              $vendor_services =$this->General_model->get_data_all_using_where('vendor_id',$this->uri->segment(3),'vendor_services');
              $vn_ser_arr = array();
              foreach($vendor_services as $vn_ser)
              {
                  array_push($vn_ser_arr, $vn_ser['service_id']);
              }
              foreach($service_categories as $service_category)
              {
			   $servies =$this->General_model->get_data_all_using_where('category_id',$service_category['id'],'services'); 
			   if(sizeof($servies)==0)
			   {
				   //show nothing
			   }
			   else
			   {
			   ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo $service_category['name'];?></label>
                    <div class="col-sm-10">
                   
                   
                       <select  multiple="multiple"  class="chosen my-select" name="category_<?php echo $service_category['id'];?>[]">
                   <?php
                   foreach($servies as $service)
                   {
                   ?><!--data-img-src="<?php echo base_url();?>uploads/service_categories/<?php echo $service['image_url'];?>"-->
                        <option  <?php if(in_array($service['id'],$vn_ser_arr)){?> selected="selected" <?php }?> value="<?php echo $service['id'];?>"><?php echo $service['name'];?></option> 
                   <?php }
                   }
                   ?>
                    </select>
                 </div>
                </div>
        <?php } ?>
            
            <div class="form-group">
                <div class="col-sm-12 service-btn-padding">             
                    <input type="submit" name="services_submit_btn" class="btn btn-info" value="Save" /> 
                </div>
            </div>                                                                           
        </div>
        </form>
		</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>
<script>
$(document).ready( function() {
  $('select.chosen').chosen({width:"100%"});
  $(".my-select").chosen({width:"100%"});
});
</script>
                                                                