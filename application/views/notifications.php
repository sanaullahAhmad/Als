<style>
.feeds li .col2 {
    float: right;
    margin-left: 0;
    text-align: right;
    width: 20%;
}
.feeds li .col1, .feeds li .col1 > .cont > .cont-col2 {
    float: left;
    width: 80%;
}
.feeds li .col1 > .cont
{
	width:100%;
}
</style>
<div class="page-content-wrapper">
<div class="page-head">
  <div class="container"> 
    <!-- BEGIN PAGE TITLE -->
    <div class="page-title">
      <h1>
        <?php if(isset($title)){ echo $title;}?>
      </h1>
    </div>
    
    <!-- END PAGE TITLE --> 
  </div>
</div>
<div class="page-content" style="min-height:500px;">
  <div class="container">
    <div class="page-content-inner">
    	<div class="left-post">
          <div class="row">
            <div class="col-md-12"> 
              <!-- BEGIN PORTLET-->
              <div class="portlet light ">
                <div class="portlet-body"> 
                  <!--BEGIN TABS-->
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1_1">
                      <div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
                        <ul class="feeds updates_services_requests">
                          <?php
                    
                     if( sizeof($notifications) >= 1){
                              foreach($notifications as $notification){	
                                $noti_id = $notification['id'];
                                $curr_session_id = $notification['session_id'];
                                $posted_by = $notification['person_id'];
                                $log_content = $notification['code'];
                                $facility_id = $notification['facility_id'];
                                
                                //For comment actor display field
                                $display_field_actor = '';
                                if($curr_session_id == $this->session->userdata('resident_id')){
                                    $display_field_actor = 'your';
                                } else if($curr_session_id == $posted_by){
                                    $display_field_actor = 'his/her';
                                } else {
                                    $display_field_actor = $this->General_model->get_value_by_id('residents', $curr_session_id, 'name').'\'s';
                                }
            
                                $display_field ='';
                                  if($log_content == 'New Comment'){
                                      $display_field = 'commented on '.$display_field_actor.' post';
                                  } else if($log_content == 'New Post'){
                                      $display_field = 'added a new post';
                                  } else if($log_content == 'Facility Approved'){
                                      $display_field = ' has been approved';
                                  } else if($log_content == 'Delivery Approved'){
                                      $display_field = ' has been approved';
                                  } else if($log_content == 'New Quote'){
                                      $display_field = 'service quote';
                                  } else if($log_content == 'Vendor Arrival Approved'){
                                      $display_field = 'has been approved';
                                  }
                    
                                if($posted_by == $this->session->userdata('resident_id')){
                                    
                                    } else {
                                     $actor = '';	
                                 if($posted_by == 0 ){
                                     if($curr_session_id == $this->session->userdata('resident_id') && $log_content == 'Facility Approved'){
                                     $actor = 'Your booking for Facility <b>'.$this->General_model->get_value_by_id('condo_facilities', $facility_id, 'name').'</b>';
                                     ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> <?php echo $actor.' '.$display_field;?> </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
                          <?php
                                     
                                     } else if($curr_session_id == $this->session->userdata('resident_id') && $log_content == 'Delivery Approved'){
                                          $actor = 'Your delivery';
                                     ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> <?php echo $actor.' '.$display_field;?> </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
                          <?php
                                         
                                     } else if($curr_session_id == $this->session->userdata('resident_id') && $log_content == 'New Quote'){
                                          $actor = 'You have received a new';
                                    ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> <?php echo $actor.' '.$display_field;?> </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
                          <?php
                                         
                                     }  else if($curr_session_id == $this->session->userdata('resident_id') && $log_content == 'Vendor Arrival Approved'){
                                          $actor = 'Service appointment';
                                    ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> <?php echo $actor.' '.$display_field;?> </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
                          <?php
                                         
                                     }
                                 } else {
                                    if($log_content == 'New Notice'){
                                        ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> Your Management posted a new Notice </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
                          <?php
                                        
                                    } else {
                                        $actor = $this->General_model->get_value_by_id('residents', $posted_by, 'name');
                                        ?>
                          <li>
                            <div class="col1">
                              <div class="cont">
                                <div class="cont-col1">
                                  <div class="label label-sm label-success"> <i class="fa fa-bell-o"></i> </div>
                                </div>
                                <div class="cont-col2">
                                  <div class="desc"> <?php echo $actor.' '.$display_field;?> </div>
                                </div>
                              </div>
                            </div>
                            <div class="col2">
                              <div class="date"> <?php echo $this->General_model->nicetime2($notification['insertDate']);?> </div>
                            </div>
                          </li>
                          <?php	
                                    }
                                 }
          
                                    
                                }
                              $msg_id=$notification['id'];
								  }
								  ?>
									  <div id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests search-item clearfix">
										  <a href="javacript:;" id="<?php echo $msg_id; ?>" 
                                          onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" 
										  class="more_services_requests btn btn-primary">Show more</a>
									  </div>
                                      <?php
                     }
                    
                    
                    /*if( sizeof($notifications) >= 1){
        
          foreach($notifications as $notification){												  
          $noti_id = $notification['id'];
          $curr_session_id = $notification['session_id'];
          $posted_by = $notification['person_id'];
          $log_content = $notification['code'];
          //if($posted_by!=$this->session->userdata('resident_id')){
          $actor = '';
              
          $actor = $this->General_model->get_value_by_id('residents', $posted_by, 'name');
                                                  
                                                    
    if(($log_content=='New Comment' && $posted_by!=$this->session->userdata('resident_id'))
    ||
    ($log_content=='New Post' && $posted_by!=$this->session->userdata('resident_id'))
     ){
                                                
                                                    
            //For comment actor display field
            $display_field_actor = '';
            if($curr_session_id == $this->session->userdata('resident_id')){
                $display_field_actor = 'your';
            } else if($curr_session_id == $posted_by){
                $display_field_actor = 'his/her';
            } else {
                $display_field_actor = $this->General_model->get_value_by_id('residents', $curr_session_id, 'name').'\'s';
            }
                                                    
                $display_field ='';
                  if($log_content == 'New Comment'){
                      $display_field = 'commented on '.$display_field_actor.' post';
                  } else if($log_content == 'New Post'){
                    $display_field = 'added a new post';
                }
                if($curr_session_id!=$this->session->userdata('resident_id')){
                      ?>
                      <li>
                            <div class="col1">
                                <div class="cont">
                                    <div class="cont-col1">
                                        <div class="label label-sm label-success">
                                            <i class="fa fa-bell-o"></i>
                                        </div>
                                    </div>
                                    <div class="cont-col2">
                                        <div class="desc"> <?php echo $actor.' '.$display_field;?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col2">
                                <div class="date"> 
                                <?php echo $this->General_model->nicetime2($notification['insertDate']);?>
                                 </div>
                            </div>
                     </li>
    
                                                          
                                                         <?php 
                                                    }
                                                      } /*if($log_content=='New Post' && $posted_by==$this->session->userdata('resident_id') && 
                                                    $curr_session_id==$this->session->userdata('resident_id')){
                                                        //Dont show anything.
                                                    }  
                                                   }
                                            } else {
                                                ?>
                                                                <li>
                                                                    <a href="javascript:;">
                                                                        <div class="col1">
                                                                            <div class="cont">
                                                                                <div class="cont-col1">
                                                                                    <div class="label label-sm label-success">
                                                                                        <i class="fa fa-bell-o"></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="cont-col2">
                                                                                    <div class="desc"> No Notification at the moment!</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </a>
                                                                </li>
                                                                                                            <?php
                                            }*/
                                                ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <!--END TABS--> 
                </div>
              </div>
              <div class="portlet light ">
                <?php
                  echo $this->load->view('template/feature_ad');
                  ?>
              </div>
              <!-- END PORTLET--> 
            </div>
          </div>
        </div>
        <?php echo $this->load->view('template/sidebar');?>
    </div>
  </div>
</div>
<script>
function more_rows_services_requests(ID) 
{
	if(ID)
	{
		$("#more_services_requests"+ID).html('<img src="<?php echo base_url()?>assets/admin/images/loading.gif" width="32" height="32"/>');
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>home/notifications_viewajax",
			data: "lastmsg="+ ID, 
			cache: false,
			success: function(html){
			$(".updates_services_requests").append(html);
			$("#more_services_requests"+ID).remove(); // removing old more button
			}
		});
	}
	else
	{
	$(".morebox_services_requests").html('No more quotes');// no results
	}
	return false;
}
</script>