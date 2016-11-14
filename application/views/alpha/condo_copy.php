
   <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
      <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css">
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
							<div class="col-lg-12 col-md-12 col-sm-12">

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
																<div class="condo-heading-con">
																	<h3 class="innerTB condo-heading">Condos</h3>
                                                                    <a href="<?php echo base_url()?>alpha/add_condo" class="btn btn-primary condo-btn" >Add Condo</a>
                                                                   <!--<a class="btn btn-success button-right">Success</a>-->
                                                                 </div>

							<!-- Widget -->
							<div class="widget">
								<div class="widget-body innerAll inner-2x">
									<!-- Table -->
<table class="" id="example1">

	<!-- Table heading -->
	<thead class="bg-gray">
		<tr>
			<th>Condo Name</th>
			<th>Email</th>
			
			<th>Action</th>
		</tr>
	</thead>
	<!-- // Table heading END -->
	
	<!-- Table body -->
	<tbody>
	<?php
	foreach($condos as $condo){
	?>
		<!-- Table row -->
		<tr class="gradeX">
			<td><?php echo $condo['name']?></td>
			<td><?php echo $condo['email']?></td>
			
			<td><a href="<?php echo base_url()?>alpha/edit_condo/<?php echo $condo['id']?>"><i class="fa fa-pencil"></i></a></td>
		</tr>
		<!-- // Table row END -->
		
		<?php } ?>
	
		
		
		
	</tbody>
	<!-- // Table body END -->
	
</table>
<!-- // Table END -->


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

<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/jquery.dataTables.min.js"></script>
        
        <script>
		$(document).ready(function() {
    $('#example').dataTable({"sPaginationType": "full_numbers"});
});
		</script>