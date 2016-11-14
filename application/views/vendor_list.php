
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
						<?php if ($this->session->flashdata('message')) { ?>
                            <div class="alert alert-info"> 
                                <?= $this->session->flashdata('message') ?> 
                            </div>
                        <?php } ?>
                    <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
				<?php
				//echo sizeof($quotes_comments);
                foreach($quotes_comments as $report){
                    $id = 	$report['service_qoute_id'];
                    
                    $vendor_id = $this->General_model->get_value_by_id('service_quotes', $id, 'quoted_by');
                    $action="id='$vendor_id'";
					//echo $id;exit; 
                    $vendor_info = $this->General_model->get_data_row_using_where('vendors', $action);
                    
                    //Get Quote Info
                    $action_quotes="id='$id'";
                    $quotes_details = $this->General_model->get_data_row_using_where('service_quotes', $action_quotes);
                }
                ?>
                    <div class="col-md-6 col-sm-6">
                             <div class="portlet light portlet-fit ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-microphone font-dark hide"></i>
                                                <span class="caption-subject bold font-dark uppercase"> Vendor List</span>
                                            </div>
                                            
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mt-widget-2">
                                                        <div class="mt-head" style="background-image: url(../assets/pages/img/background/32.jpg);">
                                                            <div class="mt-head-label">
                                                                <button type="button" class="btn btn-success">Manhattan</button>
                                                            </div>
                                                            <div class="mt-head-user">
                                                                <div class="mt-head-user-img">
                                                                    <img src="../assets/pages/img/avatars/team7.jpg"> </div>
                                                                <div class="mt-head-user-info">
                                                                    <span class="mt-user-name">Chris Jagers</span>
                                                                    <span class="mt-user-time">
                                                                        <i class="icon-emoticon-smile"></i> 3 mins ago </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-body">
                                                            <h3 class="mt-body-title"> Thomas Clark </h3>
                                                            <p class="mt-body-description"> It is a long established fact that a reader will be distracted </p>
                                                            <ul class="mt-body-stats">
                                                                <li class="font-green">
                                                                    <i class="icon-emoticon-smile"></i> 3,7k</li>
                                                                <li class="font-yellow">
                                                                    <i class=" icon-social-twitter"></i> 3,7k</li>
                                                                <li class="font-red">
                                                                    <i class="  icon-bubbles"></i> 3,7k</li>
                                                            </ul>
                                                            <div class="mt-body-actions">
                                                                <div class="btn-group btn-group btn-group-justified">
                                                                    <a href="javascript:;" class="btn">
                                                                        <i class="icon-bubbles"></i> Bookmark </a>
                                                                    <a href="javascript:;" class="btn ">
                                                                        <i class="icon-social-twitter"></i> Share </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mt-widget-2">
                                                        <div class="mt-head" style="background-image: url(../assets/pages/img/background/43.jpg);">
                                                            <div class="mt-head-label">
                                                                <button type="button" class="btn btn-danger">London</button>
                                                            </div>
                                                            <div class="mt-head-user">
                                                                <div class="mt-head-user-img">
                                                                    <img src="../assets/pages/img/avatars/team3.jpg"> </div>
                                                                <div class="mt-head-user-info">
                                                                    <span class="mt-user-name">Harry Harris</span>
                                                                    <span class="mt-user-time">
                                                                        <i class="icon-user"></i> 3 mins ago </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-body">
                                                            <h3 class="mt-body-title"> Christian Davidson </h3>
                                                            <p class="mt-body-description"> It is a long established fact that a reader will be distracted </p>
                                                            <ul class="mt-body-stats">
                                                                <li class="font-green">
                                                                    <i class="icon-emoticon-smile"></i> 3,7k</li>
                                                                <li class="font-yellow">
                                                                    <i class=" icon-social-twitter"></i> 3,7k</li>
                                                                <li class="font-red">
                                                                    <i class="  icon-bubbles"></i> 3,7k</li>
                                                            </ul>
                                                            <div class="mt-body-actions">
                                                                <div class="btn-group btn-group btn-group-justified">
                                                                    <a href="javascript:;" class="btn ">
                                                                        <i class="icon-bubbles"></i> Bookmark </a>
                                                                    <a href="javascript:;" class="btn ">
                                                                        <i class="icon-social-twitter"></i> Share </a>
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
                    
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    
                </div>
             </div>
          </div>
      </div>
  </div>
  
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Vendor Comming Time</h4>
      </div> 
      <form method="POST" id="add-facility-booking" class="form-horizontal" action="<?php echo base_url();?>service_quotes" >   
      <div class="modal-body">
       
            <input type="hidden" name="quote_id" id="quote_id" value="" />   
              <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Arival Date time</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control datetimepicker" id="arivaldatetime" name="arivaldatetime" >
                        <span id="enddatetime_validate" class="error_individual help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Phone</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="phone" name="phone" >
                        <span id="phone_validate" class="error_individual help-block"></span>
                    </div>
                </div>
           </div>
      </div>
      
      <div class="modal-footer">
        <button  class="btn btn-default" type="submit" name="arival_datetime_btn">Submit</button>
      </div>
      </form>
    </div>

  </div>
</div>


