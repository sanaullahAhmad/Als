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
            <div class="widget-body innerAll inner-2x">
        <form method="post" class="form-horizontal" >
                                                                     
            <div class="form-group">
              <label class="col-sm-2 control-label">&nbsp;</label>
              <div class="col-sm-10">
                <?php
                $vendor_services =$this->General_model->get_data_all_using_where('vendor_id',$this->uri->segment(3),'vendor_condos');
                $vn_condo_arr = array();
                foreach($vendor_services as $vn_ser)
                {
                    array_push($vn_condo_arr, $vn_ser['condo_id']);
                }
                ?>
                <select  multiple="multiple" class="my-select" name="condo[]" id="condo" >
                       <?php
                       foreach($condos_list as $condos_list_item)
                       {
                       ?>
                            <option data-img-src="<?php echo base_url();?>uploads/condos/condo_pictures/<?php echo $condos_list_item['condo_picture'];?>"
                             <?php if(in_array($condos_list_item['id'],$vn_condo_arr)){?> selected="selected" <?php }?> 
                             value="<?php echo $condos_list_item['id'];?>">
                                <?php echo $condos_list_item['name'];?>
                            </option> 
                       <?php 
                       }
                       ?>
                 </select>
              </div>
            </div>
               
            <div class="form-group">
             <div class="col-sm-12">&nbsp;</div>
            </div>
            
            
            
            <div class="form-group">     
                <div class="col-sm-2"></div>
                <div class="col-sm-10">             
                    <input type="submit" name="condominiums_submit_btn" class="btn btn-info" value="Save" /> 
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
                                                              