 <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.dataTables.min.js"></script> 
 <script src="<?php echo base_url()?>assets/front/global/plugins/dataTables.responsive.min.js"></script>
 <script src="<?php echo base_url()?>assets/front/global/plugins/dataTables.bootstrap.min.js"></script>
 <script src="<?php echo base_url()?>assets/front/global/plugins/datatables.init2.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/global/plugins/jquery.dataTables.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/global/plugins/dataTables.bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/global/plugins/responsive.bootstrap.min.css" />
  

            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <div class="container">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>
                            	<?php if(isset($title)){ echo $title;}?>                                
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
                    
                            
                            <div class="left-post">
                              <div class="portlet light ">
                                 <div class="portlet-body form">
								<?php if ($this->session->flashdata('message')) { ?>
                                    <div class="alert alert-info" style="background:#008C44;margin:20px; color:#fff;"> 
                                        <?= $this->session->flashdata('message') ?> 
                                    </div>
                                <?php } ?>
                                <div class="relativeWrap" >
                                    <div class="box-generic">
                                        <div class="tabsbar">
                                            <ul class="nav nav-tabs">
                                                <li class="glyphicons camera active"><a href="#tab1-3" data-toggle="tab"><i></i>Visitor Requests</a></li>
                                                <li class="glyphicons folder_open"><a href="#tab2-3" data-toggle="tab"><i></i> Delivery Requests</a></li>
                                            </ul>
                                        </div>
                                        <div class="tab-content">
                                            <!-- Tab content -->
                                            <div class="tab-pane active" id="tab1-3"> 
                                            <a href="<?php echo base_url();?>add_visitor" class="btn btn-primary" style="float:right;margin:20px 0 20px 0;">
                                                Add Visitor Request
                                            </a>
                                                <table   class="table  table-bordered dt-responsive nowrap" id="example"  cellspacing="0" width="100%">
                                    <thead class="bg-gray">
                                        <tr>
                                            <th>vehicle number</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									if(sizeof($visitor_requests)>0)
									{
                                    foreach($visitor_requests as $report){
                                    ?>
                                        <tr class="gradeX">
                                            <td><?php echo $report['vehicle_no'];?></td>
                                            <td><?php echo date("Y-m-d", strtotime($report['visitdatetime']))?></td>
                                            <td><?php echo date("H:i:s", strtotime($report['visitdatetime']))?></td>
                                            <td><textarea style="background: #fff;padding: 10px 15px; height: 60px;line-height: 20px;margin-top: 0px;width: 200px; float: left;border: 2px solid #007037;color: #000;font-size: 14px; font-family: 'HelveticaWorld-Regular';"><?php echo $report['visitor_reason']?></textarea></td>
                                            
                                        </tr>
                                        <?php 
											}
                                        } ?>
                                    </tbody>
                                </table>
                                            </div>
                                            <div class="tab-pane" id="tab2-3">
                                            <a href="<?php echo base_url();?>add_delivery" class="btn btn-primary" style="float:right;margin:20px 0 20px 0;">
                                                Add Delivery Request
                                            </a>
                                                <table   class="table  table-bordered dt-responsive nowrap" id="example2"  cellspacing="0" width="100%">
                                                  <thead class="bg-gray">
                                                      <tr>
                                                          <th>Date</th>
                                                          <th>Time</th>
                                                          <th>Description</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                  <?php
												   if(sizeof($delivery_requests)>0)
												 {
                                                  foreach($delivery_requests as $report){
                                                  ?>
                                                      <tr class="gradeX">
                                                          <td><?php echo date("Y-m-d", strtotime($report['deliverydatetime']))?></td>
                                                          <td><?php echo date("H:i:s", strtotime($report['deliverydatetime']))?></td>
                                                          <td><textarea style="background: #fff;padding: 10px 15px; height: 60px;line-height: 20px;margin-top: 0px;width: 200px; float: left;border: 2px solid #007037;color: #000;font-size: 14px; font-family: 'HelveticaWorld-Regular';"><?php echo $report['description']?></textarea></td>
                                                      </tr>
                                                      <?php 
												  }
                                                      } ?>
                                                  </tbody>
                                              </table>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                            <div class="right-post">
								<div class="right-post-img">
									<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/ad1.png" />
									<div class="overlay">
										I Lost My Pet.
									</div>
								</div>
								<div class="right-post-img">
									<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/ad2.png" />
									<div class="overlay">
										Check out my new room.
									</div>
								</div>
								<div class="right-post-img">
									<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/ad3.png" />
									<div class="overlay">
										Heavens on earth. Its amazing i used to go their in a year.
									</div>
								</div>
								<a href="#" class="post-ur-ad-btn">
									Post Your Ad
								</a>
							</div>
                            
                            
                        </div>
                    </div>
                </div>
            </div>