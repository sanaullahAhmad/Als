<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Service Categories
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
              <span>Service Categories</span>
          </li>
      </ul>
      <a href="<?php echo base_url();?>alpha/add_service_category" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary" id="" type="submit">Add Category</a>
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
      <div class="row">
  <?php
      foreach($condos as $condo){
      ?>
      
      

      
      
      
  <div class="col-md-4">
  <!-- Thumbnail -->
  <div class="thumbnail widget-thumbnail" style="height:275px; margin-bottom: 10px;">
      
      <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);">
      <img src="<?php echo base_url();?>uploads/service_categories/<?php echo $condo['image_url'];?>" alt="<?php echo $condo['name'];?>" class="img-responsive" style="height:200px;">
      </div>
      <div class="caption" style="padding: 0px 0;">
      <br />
          <h4 class="pull-right" ondblclick="edit_field('<?php echo $condo['id'];?>', 'services_categories', 'name', 'category_service_id_<?php echo $condo['id'];?>')" id="category_service_id_<?php echo $condo['id'];?>" style="margin: 0 5px 0 0;line-height: 11px;"><?php echo $condo['name'];?></h4><br />
          
          <a href="<?php echo base_url();?>alpha/category/<?php echo $condo['id'];?>" class="btn btn-primary pull-right btn-xs">
          Services
          </a>
          <a class="btn btn-primary btn-xs pull-right" href="#" onclick="callCrudAction('services_categories',<?php echo $condo['id'];?>,'delete_data', 'service_categories/<?php echo $condo['image_url'];?>')"><span class="glyphicon glyphicon-remove"></span></a>
          <a class="btn btn-primary pull-right btn-xs" href="<?php echo base_url();?>alpha/edit_service_category/<?php echo $condo['id'];?>" ><span class="glyphicon glyphicon-pencil"></span></a>

          
      </div>
  </div>
  <!-- // Thumbnail END -->
  </div>
   <?php
      }
      ?>
          </div>
     </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>