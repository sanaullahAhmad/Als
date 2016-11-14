<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Add Quote
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Add quote</span>
          </li>
      </ul>
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      	<div class="portlet yellow-crusta box">
            <div class="portlet-title">
                <div class="caption">
                    Request Info 
                </div>
            </div>
            <div class="portlet-body">
              
              <div class="row static-info">
                  <div class="col-md-2 name"> Requested By: </div>
                  <div class="col-md-4 value"> <?php echo $this->General_model->get_value_by_id('residents', $request_info->requested_by, 'name');?>
                  </div>
                  <div class="col-md-2 name">Condo: </div>
                  <div class="col-md-4 value"> <?php echo $this->General_model->get_value_by_id('condos', $request_info->condo_id, 'name')?> </div>
                  
              </div>
                      
              <div class="row static-info">
                  <div class="col-md-2 name"> Service: </div>
                  <div class="col-md-4 value"><?php echo $this->General_model->get_value_by_id('services', $request_info->service_id, 'name')?>  </div>
                  <div class="col-md-2 name"> Description  </div>
                  <div class="col-md-4 value">
                      <?php echo $request_info->description?> 
                  </div>
                 
              </div>
              <div class="row static-info">
                   <div class="col-md-2 name"> Duration  </div>
                  <div class="col-md-4 value">
                     <?php 
					  $tomorrow = strtotime($request_info->requested_time . "+".$request_info->duration." days"); 
					  $now = time(); // or your date as well
					  $datediff = $tomorrow - $now;
					  echo floor($datediff/(60*60*24));
					 
					?> Days Remaining
                  </div>
                  <div class="col-md-2 name"> Requested Time: </div>
                  <div class="col-md-4 value">
                      <?php echo date('jS M h:i a', strtotime($request_info->requested_time))?>
                  </div>
                  <div class="col-md-2 name"> Attachment: </div>
                      <div class="col-md-4 value">  <?php if($request_info->service_request_file==''){ echo "No File";}else{?>
                <a href="<?php echo base_url()?>uploads/services_requests/<?php echo $request_info->service_request_file;?>" target="_blank" class="btn green"> View
                </a> <?php
				}?> </div>
              </div>
                 
              </div>
          </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->  
        <form id="qoute-request-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                    <span class="error_individual" id="description_validate"></span>
                </div>
            </div>
            
            <!--<div class="form-group">
                <label class="col-sm-2 control-label">Amount</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount">
                    <span class="error_individual" id="amount_validate"></span>
                </div>
            </div>-->
            <div class="form-group">
                <label class="col-sm-2 control-label">Quotation(File)</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="quotation_file" name="quotation_file" >
                    <span class="error_individual" id="quotation_file_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Min Budget</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="min_budget" name="min_budget" placeholder="Min Budget">
                    <span class="error_individual" id="min_budget_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Max Budget</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="max_budget" name="max_budget" placeholder="Max Budget">
                    <span class="error_individual" id="max_budget_validate"></span>
                </div>
            </div>
            
          
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" id="qoute_btn" name="qoute_btn" class="btn btn-primary">Quote</button>
                    <a href="<?php echo base_url();?>vendor/dashboard" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </form>
		</div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>