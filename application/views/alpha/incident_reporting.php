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
													<!-- col-table-row -->
													<div class="col-table-row">
														<!-- col-app -->
														<div class="col-app col-unscrollable">
															<!-- col-app -->
															<div class="col-app">
                                                                <div style="float:left; width:100%; height:50px; position:relative; z-index:111111; margin-bottom:15px;">
																	<h3 class="innerTB" style="float:left; margin-left:20px;">Incedent Reporting </h3>
                                                                    <a href="<?php echo base_url();?>alpha/add_report" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary" type="submit">
                                                                    Add Report
                                                                    </a>
                                                                   <!--<a class="btn btn-success button-right">Success</a>-->
                                                                 </div>

                                                            <!-- Widget -->
                                                            <div class="widget">
                                                                <div class="widget-body innerAll inner-2x">
                                                                    <!-- Table -->
                                                                    <table class="dynamicTable table">
                                                                    
                                                                        <!-- Table heading -->
                                                                        <thead class="bg-gray">
                                                                            <tr>
                                                                                <th>Reported By</th>
                                                                                <th>Condo</th>
                                                                                <th>Description</th>
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
                                                                                <td><?php echo $this->Alpha_model->get_value_by_id('admin', $condo['reported_by'], 'full_name');?></td>
                                                                                <td><?php echo $this->Alpha_model->get_value_by_id('condos', $condo['condo_id'], 'name');?></td>
                                                                                <td><?php echo substr($condo['description'], 0, 50);?></td>
                                                                                <td>
                                                                                <a href="#" onclick="callCrudAction('incident_reporting',<?php echo $condo['id'];?>,'delete_data')" >
                                                                                <span class="glyphicon glyphicon-remove"></span>
                                                                                </a>
                                                                                 <a href="<?php echo base_url();?>alpha/edit_report/<?php echo $condo['id'];?>" ><span class="glyphicon glyphicon-pencil"></span></a>
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