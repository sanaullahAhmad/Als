<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"><?php echo $title;?>
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
              <span><?php echo $title;?></span>
          </li>
      </ul>
      <a href="<?php echo base_url();?>manager/add_block" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary"  >Add Block</a>
      
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
		<!-- Table -->
       <table  class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">          
       <!-- Table heading -->
          <thead class="bg-gray">
             <tr>
                 <th>Block Name</th>
                 <th>No.of Floors</th>
                 <th>Units/Floor</th>
                 <th>Registered Residents</th>
                 <th>Actions</th>
                 
             </tr>
          </thead>
          <!-- // Table heading END -->
          
          <!-- Table body -->
          <tbody>
			  <?php
              foreach($condo_blocks as $block){
              ?>
             <!-- Table row -->
             <tr class="gradeX">
                 <td><?php echo $block['name'];?></td>
                <td><?php  echo $block['floors'];?></td>
                 <td><?php echo $block['units'];?></td>
                 <td><?php 
                $where = " block = '$block[id]'";
                $registered_residents = $this->General_model->get_data_all_using_Multiwhere($where, 'residents');
                echo sizeof($registered_residents);?></td>
                 <td>
                 <?php
                 if(sizeof($registered_residents)<1){
                 ?>
                 <a href="#" onclick="callCrudAction('blocks',<?php echo $block['id'];?>,'delete_data')" >
                 <span class="glyphicon glyphicon-remove"></span>
                 </a>
                 <?php
                 }
                 ?>
                  <a href="<?php echo base_url();?>manager/edit_block/<?php echo $block['id'];?>" ><span class="glyphicon glyphicon-pencil"></span></a>
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