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
																<div class="condo-heading-con">
																	<h3 class="innerTB condo-heading">Blocks</h3>
                                                                    <a href="<?php echo base_url()?>manager/add_block" class="btn btn-primary condo-btn" >Add Block2</a>
                                                                   <!--<a class="btn btn-success button-right">Success</a>-->
                                                                 </div>

							<!-- Widget -->
							<div class="widget">
								<div class="widget-body innerAll inner-2x">
                                                                    <!-- Table -->
                                                                    <table class="table table-striped table-bordered dt-responsive nowrap" id="example"  cellspacing="0" width="100%">
                                                                    
                                                                        <!-- Table heading -->
                                                                        <thead class="bg-gray">
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>Condo</th>
                                                                                <th>Floors</th>
                                                                                <th>Units</th>
                                                                                <th>Actions</th>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <!-- // Table heading END -->
                                                                        
                                                                        <!-- Table body -->
                                                                        <tbody>
                                                                        <?php
                                                                        foreach($condo_blocks as $condo){
                                                                        ?>
                                                                            <!-- Table row -->
                                                                            <tr class="gradeX">
                                                                                <td><?php echo $condo['name'];?></td>
                                                                                <td><?php echo $this->General_model->get_value_by_id('condos', $condo['condo_id'], 'name');?></td>
                                                                                <td><?php echo $condo['floors'];?></td>
                                                                                <td><?php echo $condo['units'];?></td>
                                                                                <td>
                                                                                <a href="#" onclick="callCrudAction('blocks',<?php echo $condo['id'];?>,'delete_data')" >
                                                                                <span class="glyphicon glyphicon-remove"></span>
                                                                                </a>
                                                                                 <a href="<?php echo base_url();?>manager/edit_block/<?php echo $condo['id'];?>" ><span class="glyphicon glyphicon-pencil"></span></a>
                                                                                </td>
                                                                                
                                                                            </tr>
                                                                            <!-- // Table row END -->
                                                                            
                                                                            <?php } ?>
                                                                        </tbody>
                                                                        <!-- // Table body END -->
                                                                        
                                                                    </table>
                                                                    
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