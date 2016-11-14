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
														<h2 class="innerTB margin-none pull-left">Condo</h2>
														
														
													</div>

													<!-- col-table-row -->
													<div class="col-table-row">

														<!-- col-app -->
														<div class="col-app col-unscrollable">

															<!-- col-app -->
															<div class="col-app">
							
<div class="innerAll">
    <div class="row">
        <div class="col-md-6">
			<div class="widget activity-line medium">
                <div class="widget-body padding-none">
                    <div class="color-widget primary" >
                        <div class="icon inverse"><a class="glyphicons nameplate"><i></i></a></div>
                        <span><a href="javascript:;">Name</a> <?php echo $condo_info->name;?></span>
                        <a class="activity-action pull-right glyphicons chat"><i></i></a>
                    </div>
                </div>
            </div>
            
			<div class="widget activity-line medium">
                <div class="widget-body padding-none">
                    <div class="color-widget primary" >
                        <div class="icon inverse"><a class="glyphicons envelope"><i></i></a></div>
                        <span><a href="javascript:;">Email</a> <?php echo $condo_info->email;?></span>
                        <a class="activity-action pull-right glyphicons chat"><i></i></a>
                    </div>
                </div>
            </div>
            
			<div class="widget activity-line medium">
                <div class="widget-body padding-none">
                    <div class="color-widget primary" >
                        <div class="icon inverse"><a class="glyphicons earphone"><i></i></a></div>
                        <span><a href="javascript:;">Phone</a> <?php echo $condo_info->phone;?></span>
                        <a class="activity-action pull-right glyphicons chat"><i></i></a>
                    </div>
                </div>
            </div>
            
            <div class="widget activity-line medium">
                <div class="widget-body padding-none">
                    <div class="color-widget primary" >
                        <div class="icon inverse"><a class="glyphicons iphone"><i></i></a></div>
                        <span><a href="javascript:;">Mobile</a> <?php echo $condo_info->mobile;?></span>
                        <a class="activity-action pull-right glyphicons chat"><i></i></a>
                    </div>
                </div>
            </div>
            <div class="widget activity-line medium">
                <div class="widget-body padding-none">
                    <div class="color-widget primary" >
                        <div class="icon inverse"><a class="glyphicons barcode"><i></i></a></div>
                        <span><a href="javascript:;">Code</a> <?php echo $condo_info->code;?></span>
                        <a class="activity-action pull-right glyphicons chat"><i></i></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $action 	= "email = '$condo_info->email'";
        $manager_info = $this->General_model->get_data_row_using_where('condo_admins', $action);
        ?>
        <div class="col-md-6">

            <div class="widget widget-heading-simple widget-body-white">
                <div class="widget-body padding-none">
                    
                    <div class="innerAll border-bottom">
                        <!--<div class="pull-right label label-default"> <em></em></div>-->
                        <h5 class="strong muted text-uppercase"><i class="fa fa-user "></i> <?php echo $manager_info->full_name;?></h5>
                        <span>Email <a href="mailto:<?php echo $manager_info->email;?>" ><?php echo $manager_info->email;?></a><span>
                    </div>
                    
                    <div class="bg-inverse">
                        <img class="img-clean" src="<?php echo base_url();?>uploads/condos/condo_pictures/<?php echo $condo_info->condo_picture?>" style="width:100%;"/>
                    </div>
                    
                    
                </div>
            </div>




										<div class="widget widget-heading-simple widget-body-white">
	<div class="widget-body padding-none">
		<div class="row row-merge">
			<div class="col-md-3">
				<div class="innerAll center"><img src="<?php echo base_url();?>uploads/condos/condo_pictures/<?php echo $condo_info->logo?>" alt="image" class="img-rounded img-responsive" /></div>
			</div>
			<div class="col-md-9">
				<div class="innerAll muted">
					
					<h4 class="strong muted text-uppercase"><?php echo $manager_info->full_name;?></h4>
					<ul class="fa-ul margin-bottom-none">
						<li><i class="fa fa-li fa-envelope"></i> Email <a href="mailto:<?php echo $manager_info->email;?>"><?php echo $manager_info->email;?></a></li>
						<li><i class="fa fa-li fa-certificate"></i> Registered On <?php echo date('M-d-Y',strtotime($manager_info->registered_on));?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>



									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	

		

		

		</div>
<!-- // END row-app -->