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
      <a href="<?php echo base_url();?>manager/add_incident_category" 
          style="float:right; margin-right:20px; margin-top:15px;" 
          class="btn btn-primary">Add Incident Category</a>
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
		<?php if ($this->session->flashdata('success_message')) { ?>
           
                <div class="alert alert-success"> 
                <?= $this->session->flashdata('success_message') ?> 
                </div>
        <?php } ?>
        
        <?php if ($this->session->flashdata('failure_message')) { ?>
                <div class="alert alert-warning"> 
                <?= $this->session->flashdata('failure_message') ?> 
                </div>
        <?php } ?>
      <!-- Table -->
      <table class="table table-bordered table-hover dt-responsive" id="genral"  cellspacing="0" width="100%">
          <!-- Table heading -->
          <thead class="bg-gray">
              <tr>
                  <th>Incident Category Name</th>
                  <th>Reports Per Day</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <!-- // Table heading END -->
          
          <!-- Table body -->
          <tbody>
          <?php
          foreach($condos as $condo){
          ?>
              <!-- Table row -->
              <tr class="gradeX">
                  <td  ondblclick="edit_field('<?php echo $condo['id'];?>', 'incident_categories', 'name', 'category_service_id_<?php echo $condo['id'];?>')" id="category_service_id_<?php echo $condo['id'];?>"><?php echo $condo['name']?></td>
                  <td><?php echo $condo['reports_per_day']?></td>
                  <td><a class="show_delete_claim_type" href="#" onclick="callCrudAction('incident_categories',<?php echo $condo['id'];?>,'delete_data')" id="<?php echo $condo['id'];?>"><span class="glyphicon glyphicon-remove"></span></a>
                  <a  href="<?php echo base_url();?>manager/edit_incident_category/<?php echo $condo['id'];?>" ><span class="glyphicon glyphicon-pencil"></span></a>
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