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
      <a href="<?php echo base_url();?>manager/add_payment_type" style="float:right; margin-right:20px; margin:15px 0px;" class="btn btn-primary">
      Add Payment Type
      </a>
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
		
            <div class="widget">
                <div class="widget-head">
                    <h4 class="heading">Payment for</h4>
                </div>
                <div class="widget-body innerAll inner-2x">				
                    <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-info" > 
                            <?= $this->session->flashdata('message') ?> 
                        </div>
                    <?php } ?>
                      <!-- Table -->
                      <table class="table table-bordered table-hover dt-responsive" id="genral"  cellspacing="0" width="100%">
                          <!-- Table heading -->
                          <thead class="bg-gray">
                              <tr>
                                  <th>Name</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php
                          foreach($payment_for as $payment){
                          ?>
                              <!-- Table row -->
                              <tr class="gradeX">
                                  <td ><?php echo $payment['name']?></td>
                                  <td><a class="show_delete_claim_type" href="#" onclick="callCrudAction('payment_for',<?php echo $payment['id'];?>,'delete_data')" id="<?php echo $payment['id'];?>"><span class="glyphicon glyphicon-remove"></span></a>
                                  <a  href="<?php echo base_url();?>manager/edit_payment_type/<?php echo $this->encrypt_model->encode($payment['id']);?>" ><span class="glyphicon glyphicon-pencil"></span></a>
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
		 </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>