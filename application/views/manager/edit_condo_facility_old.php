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
                                                                      <h4 class="heading"><?php echo $title;?></h4>
                                                                  </div>
                                                                    <!-- // Widget heading END -->
                                                                    <div class="widget-body">
                                                                      <div class="innerLR">
<?php if($this->session->flashdata("message")){ echo "<h3 style='color:green;'>".$this->session->flashdata("message")."</h3>";}?>
<form id="addfacility-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?php echo $condo_facility->name?>">
            <span class="error_individual" id="name_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="description" name="description" placeholder="Description"><?php echo $condo_facility->description?></textarea>
            <span class="error_individual" id="description_validate"></span>
        </div>
    </div>
    
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Image</label>
        <div class="col-sm-10">
            <input type="file" id="image_url_edit" name="image_url_edit">
            <span class="error_individual" id="image_url_edit_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Price</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="price" name="price" placeholder="Price" value="<?php echo $condo_facility->price?>">
            <span class="error_individual" id="price_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Opening Hour</label>
        <div class="col-sm-10">
            <input type="text" class="form-control timepicker" id="opening_hour" name="opening_hour" placeholder="Opening Hour" value="<?php echo date('h:i A', strtotime($condo_facility->opening_hour));?>">
            <span class="error_individual" id="opening_hour_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Closing Hour</label>
        <div class="col-sm-10">
            <input type="text" class="form-control timepicker" id="closing_hour" name="closing_hour" placeholder="Closing Hour"value="<?php echo date('h:i A', strtotime($condo_facility->closing_hour));?>">
            <span class="error_individual" id="closing_hour_validate"></span>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-2 control-label">Session Time</label>
        <div class="col-sm-10">
            <select class="form-control" id="session_time" name="session_time">
            	<option value="">Session Time</option>
            	<option value="1" <?php if($condo_facility->session_time==1){?> selected="selected"<?php }?>>1</option>
            	<option value="2" <?php if($condo_facility->session_time==2){?> selected="selected"<?php }?>>2</option>
            	<option value="3" <?php if($condo_facility->session_time==3){?> selected="selected"<?php }?>>3</option>
            	<option value="4" <?php if($condo_facility->session_time==4){?> selected="selected"<?php }?>>4</option>
            	<option value="5" <?php if($condo_facility->session_time==5){?> selected="selected"<?php }?>>5</option>
            	<option value="6" <?php if($condo_facility->session_time==6){?> selected="selected"<?php }?>>6</option>
            	<option value="7" <?php if($condo_facility->session_time==7){?> selected="selected"<?php }?>>7</option>
            	<option value="8" <?php if($condo_facility->session_time==8){?> selected="selected"<?php }?>>8</option>
            	<option value="9" <?php if($condo_facility->session_time==8){?> selected="selected"<?php }?>>9</option>
            	<option value="10" <?php if($condo_facility->session_time==10){?> selected="selected"<?php }?>>10</option>
            	<option value="11" <?php if($condo_facility->session_time==11){?> selected="selected"<?php }?>>11</option>
            	<option value="12" <?php if($condo_facility->session_time==12){?> selected="selected"<?php }?>>12</option>
            </select>
            <span class="error_individual" id="session_time_validate"></span>
        </div>
    </div>
   
  
    
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        	<input type="hidden" id="table" name="table" value="admin">
            <button type="submit" id="add_facility_btn" name="edit_facility_btn" class="btn btn-primary">Edit Facility</button>
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