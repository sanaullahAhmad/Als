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
												<h4 class="heading">Add User</h4>
                                               
											</div>
											<!-- // Widget heading END -->
											
											<div class="widget-body">
												<div class="innerLR">
													<form id="adduser-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Name">
            <span class="error_individual" id="full_name_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            <span class="error_individual" id="email_validate"></span>
        </div>
    </div>
    
    <!--<div class="form-group">
        <label class="col-sm-2 control-label">Condo</label>
        <div class="col-sm-10">
            <select class="form-control" id="condo" name="condo" >
            	<?php
                	if(sizeof($condos)>0)
					{
						foreach($condos as $condo)
						{
							?>
							<option value="<?php echo $condo['id']?>"><?php echo $condo['name']?></option>
							<?php
						}
					}
				?>
            </select>
            <span class="error_individual" id="condo_validate"></span>
        </div>
    </div>-->
    
    <div class="form-group">
        <label class="col-sm-2 control-label">User Role</label>
        <div class="col-sm-10">
            <select class="form-control" id="role" name="role" >
            	<option value="1">Manager</option>
            	<option value="2">Security</option>
            </select>
            <span class="error_individual" id="role_validate"></span>
        </div>
    </div>
   
  
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        	<input type="hidden" id="table" name="table" value="admin">
            <button type="submit" id="add_user_btn" name="add_user_btn" class="btn btn-primary">Register User</button>
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