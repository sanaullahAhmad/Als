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
																	<h3 class="innerTB">Category</h3>
                                                                    <h3 class="innerTB pull-right"><a class="btn btn-success">Success</a></h3>

                                                            <!-- Widget -->
                                                            <div class="widget">
                                                                <div class="widget-body innerAll inner-2x">
                                                                    <!-- Table -->
                                                                    <table class="table  table-bordered dt-responsive nowrap"  id="example"  cellspacing="0" width="100%">
                                                                    
                                                                        <!-- Table heading -->
                                                                        <thead class="bg-gray">
                                                                            <tr>
                                                                                <th>Service Name</th>
                                                                                <th>Category</th>
                                                                                <th>image</th>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                        foreach($condos as $condo){
                                                                        ?>
                                                                            <tr class="gradeX">
                                                                                <td><?php echo $condo['name']?></td>
                                                                                <td><?php echo $this->Alpha_model->get_value_by_id('services_categories', $condo['category_id'], 'name');?></td>
                                                                                <td><img src="<?php echo base_url();?>uploads/service_categories/<?php echo $condo['image_url'];?>" style="width:40px; height:30px" title="<?php echo $condo['name']?>" /></td> 
                                                                            </tr>
                                                                            <?php } ?>
                                                                        </tbody>
                                                                    </table>
                                                                    </div>
                                                                </div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
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