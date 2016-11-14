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
														<h4 class="innerTB margin-none pull-left">Vendor Quotation</h4>
													</div>
													<!-- col-table-row -->
													<div class="col-table-row">
														<!-- col-app -->
														<div class="col-app col-unscrollable">
															<!-- col-app -->
															<div class="col-app">
																
                                                                
    <?php if(sizeof($vendor_quotes)>0){?>		
    <div class="widget">
        <div class="widget-head">
            <h4 class="heading">Vendor Quotation</h4>
        </div>
        <div class="widget-body innerAll inner-2x">
      <table class="table  table-bordered dt-responsive nowrap" id="example"  cellspacing="0" width="100%">
        <thead class="bg-gray">
            <tr>
                <th>Description</th>
                <th>Service</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach($vendor_quotes as $vendor_quote){
        ?>
            <tr class="gradeX" id="<?php echo $vendor_quote['id'];?>">
                <td><?php echo $vendor_quote['description']?></td>
                <td><?php $service_id =  $this->General_model->get_value_by_id('service_requests', $vendor_quote['service_request_id'], 'service_id');
				           echo $this->General_model->get_value_by_id('services', $service_id, 'name');?></td>
                
                <td>
                    <a class="" href="<?php echo base_url();?>vendor/services_quotes_comments/<?php echo $vendor_quote['id']?>" title="comment">
                        <span class="glyphicon glyphicon-comment"></span>
                    </a>
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