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
                    <h4 class="heading">Add Report</h4>
                   
                </div>
                <!-- // Widget heading END -->
											
<div class="widget-body">
    <div class="innerLR">
    <div id="logo_validate"></div>
        <form id="addincidentreport-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="description" name="description" placeholder="Description"><?php echo $service_cat->description;?></textarea>
            <span class="error_individual" id="description_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label">Condo</label>
        <div class="col-sm-10">
            <select class="form-control" id="condo" name="condo">
            	<?php
				$this->load->model('General_model');
                $services_categories = $this->General_model->get_data_all('condos');
				foreach($services_categories as $category)
				{
					?>
					<option value="<?php echo $category['id'];?>"  <?php if($category['id']==$service_cat->condo_id){?> selected="selected" <?php }?>><?php echo $category['name'];?></option>
					<?php
				}
				?>
            </select>
            <span class="error_individual" id="condo_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Reported By</label>
        <div class="col-sm-10">
            <select class="form-control" id="reported_by" name="reported_by">
            	<?php
                $services_categories = $this->General_model->get_data_all('admin');
				foreach($services_categories as $category)
				{
					?>
					<option value="<?php echo $category['id'];?>"  <?php if($category['id']==$service_cat->reported_by){?> selected="selected" <?php }?>><?php echo $category['full_name'];?></option>
					<?php
				}
				?>
            </select>
            <span class="error_individual" id="reported_by_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" id="addincedentreportbutton" name="addservicecategoryubbutton" class="btn btn-primary">Edit</button>
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