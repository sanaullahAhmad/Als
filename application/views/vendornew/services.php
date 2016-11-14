<div class="row row-app margin-none">
	<!-- col -->
	<div class="col-md-12">
		<!-- col-separator -->
		<div class="col-separator col-separator-first border-none">
			<!-- col-table -->
			<div class="col-table">
				<!-- col-table-row -->
				<div class="col-table-row">
					<!-- col-app -->
					<div class="col-app">
						<!-- row-app -->
						<div class="row row-app margin-none">
							<!-- col -->
							<div class="col-lg-12 col-md-9 col-sm-12">
								<!-- col-separator -->
								<div class="col-separator col-unscrollable">
									<!-- col-table -->
									<div class="col-table">
										<!-- col-table-row -->
										<div class="col-table-row">
											<!-- box -->
											<div class="col-app box col-unscrollable overflow-hidden">
												<!-- col-table -->
												<div class="col-table">
													<!-- col-table-row -->
													<div class="col-table-row">
														<!-- col-app -->
														<div class="col-app col-unscrollable">
															<!-- col-app -->
															<div class="col-app">
                                                                <div style="float:left; width:100%; height:50px; position:relative; z-index:111111; margin-bottom:15px;">
																	<h3 class="innerTB" style="float:left; margin-left:20px;">Services </h3>
                                                                    
                                                                   <!--<a class="btn btn-success button-right">Success</a>-->
                                                                 </div>
                                                            <!-- Widget -->
                                                            <div class="widget">
                                                            
  <?php if ($this->session->flashdata('success_message')) { ?>
    <div style="float:left; width:100%; height:50px; position:relative; z-index:111111; margin-bottom:15px;">
        <div class="alert alert-success"> <?= $this->session->flashdata('success_message') ?> </div>
    </div>
<?php } ?>
<form method="post" class="form-horizontal" >
    <div class="widget-body innerAll inner-2x">
      <?php
      $vendor_services =$this->General_model->get_data_all_using_where('vendor_id',$this->session->userdata('vendor_id'),'vendor_services');
      $vn_ser_arr = array();
      foreach($vendor_services as $vn_ser)
      {
          array_push($vn_ser_arr, $vn_ser['service_id']);
      }
      foreach($service_categories as $service_category)
      {
          $servies =$this->General_model->get_data_all_using_where('category_id',$service_category['id'],'services'); 
               if(sizeof($servies)==0)
               {
                   //show nothing
               }
               else
               {
               ?>
               <h3 class="pull-left"  style="padding: 10px 0 0 0px; width: 100%; font-size:21px;"><?php echo $service_category['name'];?></h3>
               <br />
               <br />
               <div class="row">
                   <select  multiple="multiple"  class="chosen my-select" name="category_<?php echo $service_category['id'];?>[]">
               <?php
               foreach($servies as $service)
               {
               ?><!--data-img-src="<?php echo base_url();?>uploads/service_categories/<?php echo $service['image_url'];?>"-->
                    <option  <?php if(in_array($service['id'],$vn_ser_arr)){?> selected="selected" <?php }?> value="<?php echo $service['id'];?>"><?php echo $service['name'];?></option> 
               <?php }
               }
               ?>
                </select>
                </div>
<?php } ?>
                                                            
      
    
    <div class="form-group">
    	<div class="col-sm-12 service-btn-padding">             
			<input type="submit" name="services_submit_btn" class="btn btn-info" value="Save" /> 
        </div>
    </div>                                                                           
</div>
</form>
                                                                </div>
                                                                <!-- // Widget END -->
															</div>
															<!-- // END col-app -->
														</div>
														<!-- // END col-app -->
													</div>
													<!-- // END col-table-row -->
												</div>
												<!-- // END col-table -->
											</div>
											<!-- // END col-app.box -->
										</div>
										<!-- // END col-table-row -->
									</div>
									<!-- // END col-table -->
								</div>
								<!-- // END col-separator -->
							</div> 
							<!-- // END col -->
						</div>
						<!-- // END row -->
					</div>
					<!-- // END col-app -->
				</div>
				<!-- // END col-table-row -->
			</div>
			<!-- // END col-table -->
		</div>
		<!-- // END col-separator -->
	</div>
	<!-- // END col -->
</div>
<!-- // END row-app -->