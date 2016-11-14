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
														<h4 class="innerTB margin-none pull-left">Profile</h4>														
													</div>
													<!-- col-table-row -->
													<div class="col-table-row">
														<!-- col-app -->
														<div class="col-app col-unscrollable">
															<!-- col-app -->
															<div class="col-app">
																
	<!-- Tab content -->
			<div id="tabPayments" class="tab-pane innerAll">
				<div class="row">
					<div class="col-md-8">
						<div class="box-generic padding-none">
                        <?php
							//Get condo Address
							//$email_manager = $this->session->userdata('manager_email');
						?>
							<div class="innerAll inner-2x">
								<form method="POST" id="vendor-profile">
                                <input type="hidden" value="<?php echo $vendor_info->id?>" name="id">		
								  	<div class="form-group">
								    	<label for="name">Name</label>
								    	<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $vendor_info->name;?>">
                                        <span class="error_individual" id="name_validate"></span>
								  	</div>
                                    
                                    
                                    
     <div class="form-group">
        <label >Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name"  value="<?php echo $vendor_info->company_name?>">
            <span class="error_individual" id="company_name_validate"></span>
        
    </div>
    <div class="form-group">
        <label >Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"  value="<?php echo $vendor_info->phone?>">
            <span class="error_individual" id="phone_validate"></span>
    </div>
    <div class="form-group">
        <label >Mobile</label>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile"  value="<?php echo $vendor_info->mobile?>">
            <span class="error_individual" id="mobile_validate"></span>
    </div>
    <div class="form-group">
        <label >Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address"  value="<?php echo $vendor_info->address?>">
            <span class="error_individual" id="address_validate"></span>
        
    </div>
    <!--<div class="form-group">
        <label>City</label>
           <select class="form-control" id="city" name="city">
        	<option>Select City</option>
            <?php foreach($areas as $area){?>
            	<option <?php if($vendor_info->areas == $area['id']) echo 'selected';?> value="<?php echo $area['id'];?>">
					<?php echo $area['name'];?>
                </option>
            <?php }?>
        </select>
        <span class="error_individual" id="city_validate"></span>
    </div>-->
    <div class="form-group">
        <label >Email</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="Email"  value="<?php echo $vendor_info->email?>">
            <input type="hidden" id="current_email" value="<?php echo $vendor_info->email?>">
            <span class="error_individual" id="email_validate"></span>
    </div>
									<div class="text-right">
								  		<button type="submit" name="venprofsubmit" class="btn btn-primary">Update Profile</button>
								  	</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-4">
					  	<div class="box-generic strong">
						  	<i class="fa fa-user fa-3x pull-left text-faded"></i> <?php echo $this->session->userdata('name');?> <br/>
                            <small class="text-faded">Last Login: <?php echo date("jS M'y h:i a", strtotime($vendor_info->last_login))?></small>
						</div>    
					    

					</div>
				</div>
			</div>
			<!-- // Tab content END -->
							
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