<!-- row -->
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
													<div class="innerLR heading-buttons border-bottom">
														<h4 class="innerTB margin-none pull-left">Dashboard</h4>
													</div>
													<!-- col-table-row -->
													<div class="col-table-row">
														<!-- col-app -->
														<div class="col-app col-unscrollable">
															<!-- col-app -->
															<div class="col-app">
                                                                <?php if(sizeof($service_requests)>0){?>		
    <div class="widget">
      <?php if ($this->session->flashdata('success_message')) { ?>
    <div style="float:left; width:100%; height:50px; position:relative; z-index:111111; margin-bottom:15px;">
        <div class="alert alert-success"> <?= $this->session->flashdata('success_message') ?> </div>
    </div>
<?php } ?>
        <div class="widget-head">
            <h4 class="heading">Service Requests</h4>
        </div>
        <div class="widget-body innerAll inner-2x">
            <table class="table  table-bordered dt-responsive nowrap" id="example"  cellspacing="0" width="100%">
        <thead class="bg-gray">
            <tr>
                <th>Requested By</th>
                <th>Condo</th>
                <th>Service</th>
                <th>Description</th>
                <th>Duration</th>
                <th>Requested Time</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($service_requests as $service_request){
        ?>
            <tr class="gradeX" id="<?php echo $service_request['id'];?>">
                <td><?php echo $this->General_model->get_value_by_id('residents', $service_request['requested_by'], 'name')?></td>
                <td><?php echo $this->General_model->get_value_by_id('condos', $service_request['condo_id'], 'name')?></td>
                <td><?php echo $this->General_model->get_value_by_id('services', $service_request['service_id'], 'name')?></td>
                <td><?php echo $service_request['description']?></td>
                <td><?php echo $service_request['duration']?> Days</td>
                <td><?php echo $service_request['requested_time']?></td>
                <td><?php if($service_request['service_request_file']==''){ echo "No File";}else{ echo '<a href="'. base_url().'uploads/services_requests/'.$service_request['service_request_file'].'" >Click Here</a>';}?> </td>
                
                <td>
                <?php $rows = $this->General_model->get_data_all_like_using_where('service_quotes', "service_request_id=".$service_request['id']);
				if(sizeof($rows)>0)
				{ echo "Quote Sent";}//.sizeof($rows);print_r($rows);
				else{?>
                    <a class="" href="<?php echo base_url();?>vendor/quote_request/<?php echo $service_request['id']?>" title="quote">
                        <span class="glyphicon glyphicon-ok"></span>
                    </a>
                <?php }?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
        </div>
    </div>	
                                                                <?php }?>	
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