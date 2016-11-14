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
							<!-- Widget -->
							<div class="widget row widget-inverse">

											<!-- Widget heading -->
											<div class="widget-head">
												<h4 class="heading">Import States and cities</h4>
                                               
											</div>
											<!-- // Widget heading END -->
											
											<div class="widget-body">
												<div class="innerLR">
                                                
                                                <?php
                                                if(isset($error_message))
												{
													?>
													<div class="alert alert-warning">
                                                      <strong>Warning!</strong> <?php echo $error_message;?>
                                                    </div>
													<?php
												}
												?>
													

												 <!-- BEGIN FORM-->
                <form id="import_states_csv" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <div class="controls controls-row import-page">
                
                
                
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">States (CSV)</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="filetoupload_states" name="filetoupload_states" >
                        <span class="error_individual" id="filetoupload_states_validate"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="submit_states" name="submit_states" class="btn btn-primary">Upload</button>
                    </div>
                </div>
                 
                    
				</div>
                </form>
             <!-- END FORM--> 
             


												</div>
											</div>
										
                                        
                                        
                                        <div class="widget-body">
												<div class="innerLR">
                                                
                                                <?php
                                                if(isset($error_message))
												{
													?>
													<div class="alert alert-warning">
                                                      <strong>Warning!</strong> <?php echo $error_message;?>
                                                    </div>
													<?php
												}
												?>
													

												 <!-- BEGIN FORM-->
                <form id="import_areas_csv" method="POST" class="form-horizontal" enctype="multipart/form-data">
                <div class="controls controls-row import-page">
                
                
                
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Areas (CSV)</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="filetoupload_areas" name="filetoupload_areas" >
                        <span class="error_individual" id="filetoupload_areas_validate"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" id="submit_areas" name="submit_areas" class="btn btn-primary">Upload</button>
                    </div>
                </div>
                 
                    
				</div>
                </form>
             <!-- END FORM--> 
             


												</div>
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
         
        