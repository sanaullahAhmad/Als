<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Vendors
      <small>Vendors</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Vendors</span>
          </li>
      </ul>
      <a href="<?php echo base_url();?>alpha/add_vendor" style="float:right; margin-right:20px; " class="btn btn-primary" id="" type="submit">Add Vendor</a>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
          <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="genral">
              <!-- Table heading -->
              <thead class="bg-gray">
                  <tr>
                      <th>Vendor Name</th>
                      <th>Company Name</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>State</th>
                      <th>Area</th>
                      <!--<th>Suburb</th>-->
                      <th>Email</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <!-- // Table heading END -->
              <!-- Table body -->
              <tbody>
              <?php
              foreach($vendors as $vendor){
              ?>
                  <!-- Table row -->
                  <tr class="gradeX">
                      <td  ondblclick="edit_field('<?php echo $vendor['id'];?>', 'vendors', 'name', 'category_service_id_<?php echo $vendor['id'];?>')" id="category_service_id_<?php echo $vendor['id'];?>"><?php echo $vendor['name']?></td>
                      <td><?php echo $vendor['company_name']?></td>
                      <td><?php echo $vendor['phone']?></td>
                      <td><?php echo $vendor['address']?></td>
                      <td><?php echo $this->General_model->get_value_by_id('states',$vendor['state'],'name');?></td>
                      <td><?php echo $this->General_model->get_value_by_id('areas',$vendor['areas'],'name');?></td>
                     <!-- <td><?php echo $vendor['suburb']?></td>-->
                      <td><?php echo $vendor['email']?></td>
                      <td>
                          <a class="show_delete_claim_type" href="#" onclick="callCrudAction('vendors',<?php echo $vendor['id'];?>,'delete_data')" id="<?php echo $vendor['id'];?>">
                              <span class="glyphicon glyphicon-remove"></span>
                          </a>
                          <a  href="<?php echo base_url();?>alpha/edit_vendor/<?php echo $vendor['id'];?>" >
                              <span class="glyphicon glyphicon-pencil"></span>
                          </a>
                          <!--<a  href="<?php echo base_url();?>alpha/reset_password/<?php echo $vendor['id'];?>" >
                              <span class="glyphicon glyphicon-home"></span>
                          </a>-->
                          <a  href="<?php echo base_url();?>alpha/vendor_condominiums/<?php echo $vendor['id'];?>" title="Condominiums">
                              <span class="glyphicon glyphicon-home"></span>
                          </a>
                           <a  href="<?php echo base_url();?>alpha/vendor_services/<?php echo $vendor['id'];?>" title="Services" >
                              <span class="glyphicon glyphicon-cog"></span>
                          </a>
                           <a  href="<?php echo base_url();?>alpha/service_condo_subsc/<?php echo $vendor['id'];?>" title="Services Condo Sub" >
                              <span class="glyphicon glyphicon-glass"></span>
                          </a>
                      </td>
                  </tr>
                  <!-- // Table row END -->
                  <?php } ?>
              </tbody>
              <!-- // Table body END -->
          </table>
      </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>