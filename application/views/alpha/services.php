<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Service 
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
              <span>Service </span>
          </li>
      </ul> <a href="<?php echo base_url();?>alpha/add_service" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary" type="submit"> Add Service</a>
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->                                                      
	<?php
    foreach($condos as $condo)
    {
    ?>
   <div class="col-md-12"  style="/*height:335px;*/ overflow:auto; margin:20px 0;">
      <!-- Thumbnail -->
      <div class="thumbnail widget-thumbnail">
              <h2 class="pull-left" ondblclick="edit_field('<?php echo $condo['id'];?>', 'services_categories', 'name','category_service_id_<?php echo $condo['id'];?>')" id="category_service_id_<?php echo $condo['id'];?>" style="padding: 10px 0 0 20px; width: 100%;"><?php echo $condo['name'];?></h2>
             <br />
             <br />
             <div class="row">
             <?php
             $servies =$this->General_model->get_data_all_using_where('category_id',$condo['id'],'services');
             if(sizeof($servies)==0)
             {
                 ?>
                 <h6 style="padding-left:27px;">No services</h6>
                 <?php
             }
             else
             {
             foreach($servies as $service)
             {
             ?>
               
                  
               <div class="col-md-4">
                <div class="thumbnail widget-thumbnail" style="height:275px; margin-bottom: 10px;">
                    
                    <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);">
                    <img src="<?php echo base_url();?>uploads/service_categories/<?php echo $service['image_url'];?>" alt="<?php echo $service['name'];?>" class="img-responsive" style="height:200px;">
                    </div>
                    <div class="caption" style="padding: 0px 0;">
                    <br />
                        <h4 class="pull-right" ondblclick="edit_field('<?php echo $service['id'];?>', 'services', 'name','service_id_<?php echo $service['id'];?>')" id="service_id_<?php echo $service['id'];?>" style="margin: 0 5px 0 0;line-height: 11px;"><?php echo $service['name'];?></h4><br />
                        
                       
                        <a class="btn btn-primary btn-xs pull-right" href="#" onclick="callCrudAction('services',<?php echo $service['id'];?>,'delete_data', 'service_categories/<?php echo $service['image_url'];?>')"><span class="glyphicon glyphicon-remove"></span></a>
                        <a class="btn btn-primary pull-right btn-xs" href="<?php echo base_url();?>alpha/edit_service/<?php echo $service['id'];?>" ><span class="glyphicon glyphicon-pencil"></span></a>

                        
                    </div>
                </div>
                </div>
             <?php }
             }
             ?>
              </div>
          </div>
       </div>  
<?php } ?>
      <!-- // Table END -->
	</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>                                                           