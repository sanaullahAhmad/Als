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
      <a href="<?php echo base_url();?>manager/add_contact" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary"  >Add Contact</a>
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
        <div class="widget">
            <div class="widget-head">
                <h4 class="heading">Contacts</h4>
            </div>
            <div class="widget-body innerAll inner-2x">												
                <table class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
                    <thead class="bg-gray">
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Website</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if(sizeof($useful_contacts)>0){?>	
                    <?php
                    foreach($useful_contacts as $useful_contact){
                    ?>
                        <tr class="gradeX">
                            <td><?php echo $useful_contact['name'];?></td>
                            <td><?php echo $useful_contact['phone'];?></td>
                            <td><?php echo $useful_contact['email'];?></td>
                            <td><?php echo $useful_contact['mobile'];?></td>
                            <td><?php echo $useful_contact['website'];?></td>
                            <td><?php echo $useful_contact['address'];?></td>
                            <td><?php if($useful_contact['status']==1){echo "Active";}else{echo "Inactive";}?></td>
                            <td id="advert_id_<?php echo $useful_contact['id']?>">
                                <a href="<?php echo base_url()?>manager/edit_contact/<?php echo $useful_contact['id']?>" title="Edit">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a onclick="callCrudAction('useful_contacts','<?php echo $useful_contact['id']?>','delete_data')" href="javascript:;" title="delete">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>	
         </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>