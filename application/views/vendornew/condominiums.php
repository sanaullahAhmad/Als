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
																	<h3 class="innerTB" style="float:left; margin-left:20px;">Condominiums </h3>
                                                                    
                                                                   <!--<a class="btn btn-success button-right">Success</a>-->
                                                                 </div>
                                                            <!-- Widget -->
                                                            <div class="widget">
                                                            
  <?php if ($this->session->flashdata('success_message')) { ?>
    <div style="float:left; width:100%; height:50px; position:relative; z-index:111111; margin-bottom:15px;">
        <div class="alert alert-success"> <?= $this->session->flashdata('success_message') ?> </div>
    </div>
<?php } ?>
<form method="post" class="form-horizontal" >
    <div class="widget-body innerAll inner-2x">
                                                             
    <!--
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">State</label>
        <div class="col-sm-10">
           <select class="form-control" id="edit_state" name="state" >
        	<option>Select State</option>
            	<option value="All">All</option>
            <?php foreach($states as $state){?>
            	<option <?php //if($service_category->state == $state['id']) echo 'selected';?> value="<?php echo $state['id'];?>"><?php echo $state['name'];?></option>
            <?php }?>
        </select>
        </div>
    </div>
    
    <div class="form-group">
   	 <div class="col-sm-12">&nbsp;</div>
    </div>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Area</label>
        <div class="col-sm-10">
           <select class="form-control multiselect" id="city" name="city"  multiple="multiple">
           	<?php /*?><?php $city_name = $this->General_model->get_value_by_id('areas',$service_category->city,'name');?>
            <option value="<?php echo $service_category->city;?>" selected="selected"><?php echo $city_name;?></option><?php */?>
        	<option value="">Select City</option>
        </select>
        </div>
    </div>  
    
    <div class="form-group">
   	 <div class="col-sm-12">&nbsp;</div>
    </div>-->
    
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Condo</label>
        <div class="col-sm-10">
           <!--<select class="form-control " id="condo" name="condo" >
        	  <option value="">Select Condo</option>
           </select>-->
        <?php
        $vendor_services =$this->General_model->get_data_all_using_where('vendor_id',$this->session->userdata('vendor_id'),'vendor_condos');
		$vn_condo_arr = array();
		foreach($vendor_services as $vn_ser)
		{
			array_push($vn_condo_arr, $vn_ser['condo_id']);
		}
		?>
        <select  multiple="multiple" class="my-select" name="condo[]" id="condo" >
               <?php
               foreach($condos_list as $condos_list_item)
               {
               ?>
                    <option data-img-src="<?php echo base_url();?>uploads/condos/condo_pictures/<?php echo $condos_list_item['condo_picture'];?>"
                     <?php if(in_array($condos_list_item['id'],$vn_condo_arr)){?> selected="selected" <?php }?> 
                     value="<?php echo $condos_list_item['id'];?>">
						<?php echo $condos_list_item['name'];?>
                    </option> 
               <?php 
			   }
               ?>
         </select>
        </div>
    </div>  
       
    <div class="form-group">
   	 <div class="col-sm-12">&nbsp;</div>
    </div>
    
    
    
    <div class="form-group">     
    	<div class="col-sm-2"></div>
    	<div class="col-sm-10">             
			<input type="submit" name="condominiums_submit_btn" class="btn btn-info" value="Save" /> 
        </div>
    </div>                                                                           
</div>
</form>
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