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
							<!-- Widget -->
							<div class="widget row widget-inverse">

											<!-- Widget heading -->
											<div class="widget-head">
												<h4 class="heading">Update Password</h4>
                                               
											</div>
											<!-- // Widget heading END -->
											
											<div class="widget-body">
												<div class="innerLR">
													<form id="editpassword-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Name"  value="<?php echo $service_cat->full_name?>" readonly="readonly">
            <span class="error_individual" id="full_name_validate"></span>
        </div>
    </div>
   
  <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $service_cat->email?>" readonly="readonly">
            <span class="error_individual" id="name_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Access Level</label>
        <div class="col-sm-10">
            <select class="form-control" id="access_level" name="access_level" disabled="disabled">
            	<option value="1" <?php if($service_cat->access_level == 1){?> selected="selected"<?php }?>>1</option>
            	<option value="2" <?php if($service_cat->access_level == 2){?> selected="selected"<?php }?>>2</option>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="password" name="password" placeholder="Password"  >
            <span class="error_individual" id="password_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        	<input type="hidden" id="table" name="table" value="admin">
            <input type="hidden" id="current_name" name="current_name" value="<?php echo $service_cat->full_name?>">
            <button type="submit" id="addservicecategoryubbutton" name="addservicecategoryubbutton" class="btn btn-primary">Update Password</button>
        </div>
    </div>
</form>




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