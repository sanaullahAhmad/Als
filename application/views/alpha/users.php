<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Users
      <small>Users</small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Users</span>
          </li>
      </ul>
      <a href="<?php echo base_url();?>alpha/add_user" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary" id="" type="submit">Add User</a>
      
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
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <!-- // Table heading END -->
          
          <!-- Table body -->
          <tbody>
          <?php
          foreach($users as $user){
          ?>
              <!-- Table row -->
              <tr class="gradeX">
                  <td  ondblclick="edit_field('<?php echo $user['id'];?>', 'admin', 'full_name', 'category_service_id_<?php echo $user['id'];?>')" id="category_service_id_<?php echo $user['id'];?>"><?php echo $user['full_name']?></td>
                  <td><?php echo $user['email']?></td>
                  <td>
                      <a class="show_delete_claim_type" href="#" onclick="callCrudAction('admin',<?php echo $user['id'];?>,'delete_data')" id="<?php echo $user['id'];?>">
                          <span class="glyphicon glyphicon-remove"></span>
                      </a>
                      <a  href="<?php echo base_url();?>alpha/edit_user/<?php echo $user['id'];?>" >
                          <span class="glyphicon glyphicon-pencil"></span>
                      </a>
                      <!--<a  href="<?php echo base_url();?>alpha/reset_password/<?php echo $user['id'];?>" >
                          <span class="glyphicon glyphicon-home"></span>
                      </a>-->
                  </td>
                  
              </tr>
              <!-- // Table row END -->
              
              <?php } ?>
          
              
              
              
          </tbody>
          <!-- // Table body END -->
          
      </table>
      <!-- // Table END -->
      </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>