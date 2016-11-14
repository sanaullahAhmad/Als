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
                                                                      <h4 class="heading">Add Condo Facility</h4>
                                                                  </div>
                                                                    <!-- // Widget heading END -->
                                                                    <div class="widget-body">
                                                                      <div class="innerLR">
<?php if($this->session->flashdata("message")){ echo "<h3 style='color:green;'>".$this->session->flashdata("message")."</h3>";}?>
<form class="form-horizontal" role="form" method="POST"  id="add-advertisement" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
             <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
             <span class="error_individual" id="description_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Add featured Image</label>
        <div class="col-sm-10">
            <input id="advertisement_featured_image" name="file_upload" type="file">
            <input type="hidden" name="featured_image" id="featured_image" value="0" />
            <span class="error_individual" id="add_image_validate"></span>
            <span id="img_featured"></span>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Add Additional images</label>
        <div class="col-sm-10">
            <input id="advertisement_file_upload" name="file_upload" type="file" multiple="true">
            <span class="error_individual" id="add_image_validate"></span>
            <span id="additional_images"></span>
        </div>
    </div>
   
  
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="addadvertisementsub" id="addadvertisementsub" class="btn btn-primary">
                Add Post
            </button>
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