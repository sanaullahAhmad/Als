<?php
function getUrl() {
	$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
	//$url .= ( $_SERVER["SERVER_PORT"] !== 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
	$url .= $_SERVER["REQUEST_URI"];
	return $url;
}

$page_current = getUrl();

 $current_page = base_url(uri_string());
 $active = 'active';

?>
        	<div class="page-header">
            
            <!-- BEGIN HEADER TOP -->
            <div class="page-header-top">
                <div class="container">
                    <!-- BEGIN LOGO -->
                   <?php
				   $get_logo_settings = $this->General_model->get_data_row_using_where("condo_settings", "condo_id='$this->condo_id' and key_id='condo_logo' and value='1'");
				   if($get_logo_settings){
				   ?>
                   <div class="page-logo">
                        <a href="<?php echo base_url();?>">
                            <img src="<?php echo base_url()?>uploads/condos/condo_logos/<?php echo $this->General_model->get_value_by_id('condos', $this->condo_id, 'logo');?>" alt="logo"  width="229" height="47">
                        </a>
                    </div>
                    <?php
				   } else {
					?>
                    <div class="page-logo">
                        <a href="<?php echo base_url();?>">
                            <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/logo-final.png" alt="logo" class="logo-default">
                        </a>
                    </div>
                    <?php
				   }
					?>
                    
                    <!-- END LOGO -->                   
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                         <?php
								 $session_id = $this->session->userdata('resident_id');
								 $where = "read_noti=0 and session_id = '$session_id'";
								 $count_unread_notifications = $this->General_model->
								 get_data_all_using_Multiwhere($where,'notifications');
						 ?>
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"  data-close-others="true">
                                    <i class="icon-bell"></i>
                                    
                                    <span <?php if(sizeof($count_unread_notifications)<1){?>style="display:none;"<?php }?> class="badge badge-default"><?php echo sizeof($count_unread_notifications);?></span>
                                </a>
                                <input type="hidden" id="badge_value" value="0"/>
                                <ul class="dropdown-menu">
                                
                                  <li class="external">
                                  <h3><strong>Notifications</strong></h3>
                                        <!--<h3>You have
                                            <strong><?php echo sizeof($count_unread_notifications);?> unread</strong> notifications</h3>-->
                                        <a href="<?php echo base_url()?>notifications">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
										<?php
										$session_id = $this->session->userdata('resident_id');
										$condo_id = $this->session->userdata('condo_id');
										$actions = "condo_id=$condo_id and session_id = '$session_id' order by msg_time desc";
										$notifications = $this->General_model->
										get_data_all_like_using_where('notifications',$actions);
										//check for if session user doesn't have notification
										/*if( sizeof($notifications) >= 1){
										$counter_find = 0;
                                              foreach($notifications as $notification){	
											  	 if($notification['person_id'] == $session_id){
													 $counter_find++;
												 }
											  }
										}
										echo '<span style="color:white">'.$counter_find.'</span>';*/
                                        
                                        if( sizeof($notifications) >= 1){
                                              foreach($notifications as $notification){												  $noti_id = $notification['id'];
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
								  $display_field = 'new Quote';
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
								<li id="actual_list"<?php echo $noti_id?>>
								<a href="javascript:;">
<!--									<span class="time">x</span>
-->									<span class="details">
										<span class="label label-sm label-icon label-danger"><i class="fa fa-bolt"></i>
										</span> <?php echo $actor.' '.$display_field;?>
									</span>
								</a>
							</li>
                             <?php
								 
								 } else if($curr_session_id == $this->session->userdata('resident_id') && $log_content == 'Delivery Approved'){
									  $actor = 'Your delivery';
								 ?>
                            <li id="actual_list"<?php echo $noti_id?>>
								<a href="javascript:;">
<!--									<span class="time">x</span>
-->									<span class="details">
										<span class="label label-sm label-icon label-danger"><i class="fa fa-bolt"></i>
										</span> <?php echo $actor.' '.$display_field;?>
									</span>
								</a>
							</li>
                             <?php
									 
								 } else if($curr_session_id == $this->session->userdata('resident_id') && $log_content == 'New Quote'){
									  $actor = 'You have receied a';
								?>
                             <li id="actual_list"<?php echo $noti_id?>>
								<a href="javascript:;">
<!--									<span class="time">x</span>
-->									<span class="details">
										<span class="label label-sm label-icon label-danger"><i class="fa fa-bolt"></i>
										</span> <?php echo $actor.' '.$display_field;?>
									</span>
								</a>
							</li>
                            
                            <?php
									 
								 }  else if($curr_session_id == $this->session->userdata('resident_id') && $log_content == 'Vendor Arrival Approved'){
									  $actor = 'Vendor Arrival';
								?>
                            
                            <li id="actual_list"<?php echo $noti_id?>>
								<a href="javascript:;">
<!--									<span class="time">x</span>
-->									<span class="details">
										<span class="label label-sm label-icon label-danger"><i class="fa fa-bolt"></i>
										</span> <?php echo $actor.' '.$display_field;?>
									</span>
								</a>
							</li>
                             <?php
									 
								 }
							 } else {
								if($log_content == 'New Notice'){
									?>
                                   <li id="actual_list"<?php echo $noti_id?>>
								<a href="javascript:;">
<!--									<span class="time">x</span>
-->									<span class="details">
										<span class="label label-sm label-icon label-danger"><i class="fa fa-bolt"></i>
										</span> Your Management posted a new Notice
									</span>
								</a>
							</li>  
                                     <?php
									
								} else {
									$actor = $this->General_model->get_value_by_id('residents', $posted_by, 'name');
									?>
                                     <li id="actual_list"<?php echo $noti_id?>>
								<a href="javascript:;">
<!--									<span class="time">x</span>
-->									<span class="details">
										<span class="label label-sm label-icon label-danger"><i class="fa fa-bolt"></i>
										</span> <?php echo $actor.' '.$display_field;?>
									</span>
								</a>
							</li>  
                                    
                                    
							  <?php
								}
							 }
								}
												 
                                             }
                                        } 
										?>
                                        </ul>
                                        
                                        
                                    </li>
                                </ul>
                            </li>
                            <li class="droddown dropdown-separator">
                                <span class="separator"></span>
                            </li>
                            <li class="dropdown dropdown-user dropdown-dark">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"  data-close-others="true">
            <?php $image = $this->General_model->get_value_by_id('residents',$this->session->userdata('resident_id'),'image_url');?>
            <?php if($image==''){?>
                    <img src="<?php echo base_url()?>assets/front/global/img/no-image.jpg"  alt="" class="" />
            <?php } else {
				?>
                <img src="<?php echo base_url()?>uploads/profile_pictures/<?php echo $this->General_model->get_thumb_of_image($image,'_40_40')?>"/>
            <?php }?>
                                    <span class="username username-hide-mobile"><?php echo $this->session->userdata('name');?></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="<?php echo base_url()?>profile">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                                                        <?php 
									if($this->General_model->get_value_by_id('residents',$this->session->userdata('resident_id'),'type')==11)
									{?>
                                    <li>
                                        <a href="<?php echo base_url();?>home/users_management">
                                            <i class="fa fa-user-plus"></i> Users Management </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url();?>home/invite_users">
                                            <i class="icon-envelope"></i> Invite Users </a>
                                    </li>
                                   <!-- <li>
                                        <a href="<?php echo base_url();?>home/all_invitations">
                                            <i class="icon-envelope"></i> All Invitations </a>
                                    </li>-->
                                    <?php }?>

                                    <li>
                                        <a href="<?php echo base_url();?>home/do_logout">
                                            <i class="icon-logout"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->

                            <!--<li class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                                	<i class="icon-logout"></i>
                            </li>-->

                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                     <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler"></a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                </div>
            </div>
            <!-- END HEADER TOP -->
            <!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
                <div class="container">
             
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!--<form class="search-form" action="page_general_search.html" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                        </div>
                    </form>-->
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN MEGA MENU -->
                    <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                    <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                    <div class="hor-menu  ">
                        <ul class="nav navbar-nav">
                            <li class="menu-dropdown classic-menu-dropdown <?php if($current_page == base_url('dashboard')){ echo $active;}?>">
                                <a href="<?php echo base_url();?>"> <span class="fa-home fa"></span> 
                                    <span class="arrow"></span>
                                </a>                                
                            </li>
                            <?php
		 if($this->General_model->check_module_settings($this->condo_id, 'quick_pay')){
			  ?>

                            <li class="menu-dropdown mega-menu-dropdown  <?php if($current_page == base_url('make_payment')){ echo $active;}?>">
                                <a href="<?php echo base_url();?>make_payment"> Quick Pay
                                    <span class="arrow"></span>
                                </a>                                
                            </li>
                            <?php
		  }
	
		 if($this->General_model->check_module_settings($this->condo_id, 'facility')){
			  ?>
							
                            <li class="menu-dropdown mega-menu-dropdown  <?php if($current_page == base_url('add_facility_booking')){ echo $active;}?>">
                                <a href="<?php echo base_url();?>add_facility_booking"> Facility Booking
                                    <span class="arrow"></span>
                                </a>                                
                            </li>
                            <?php
		 }
							?>
                            
                            
                              <?php
                             if($this->General_model->check_module_settings($this->condo_id, 'services')){
			  ?>
                            <li class="menu-dropdown classic-menu-dropdown <?php if($current_page == base_url('service_requests')|| $current_page == base_url('service_providers')){ echo $active;}?>">
                                <a href="javascript:void(0)"> Services
<!--                                    <span class="icon-arrow-down"></span>
-->                                </a>    
                                <ul class="dropdown-menu pull-left">
                                <li class=" <?php if($current_page == base_url('service_providers')){ echo $active;}?>">
                                        <a href="<?php echo base_url();?>service_providers" class="nav-link  ">
                                            <i class="fa fa-legal"></i> Service Providers</a>
                                    </li>
                                    <li class=" <?php if($current_page == base_url('service_requests')){ echo $active;}?>">
                                        <a href="<?php echo base_url();?>service_requests" class="nav-link  ">
                                            <i class="icon-user"></i> Requests & Quotes
                                        </a>
                                    </li>
                                    
                                </ul>                            
                            </li>
                            <?php
							 }
							?>
                            
                            <?php
                             if($this->General_model->check_module_settings($this->condo_id, 'visitors')){
			  ?>
                            <li class="menu-dropdown classic-menu-dropdown <?php if($current_page == base_url('visitor_request') || $current_page == base_url('delivery_request')){ echo $active;}?>">
                                <a href="javascript:;"> Visitors & Deliveries
<!--                                    <span class="icon-arrow-down"></span>
-->                                </a>    
                                <ul class="dropdown-menu pull-left">
                                    <li class=" <?php if($current_page == base_url('visitor_request')){ echo $active;}?>">
                                        <a href="<?php echo base_url();?>visitor_request" class="nav-link  ">
                                            <i class="icon-user"></i> Visitors
                                        </a>
                                    </li>
                                    <li class=" <?php if($current_page == base_url('delivery_request')){ echo $active;}?>">
                                        <a href="<?php echo base_url();?>delivery_request" class="nav-link  ">
                                            <i class="fa-bus fa"></i> Deliveries </a>
                                    </li>
                                </ul>                            
                            </li>
                            <?php
							 }
							?>
                            <!--<li class="menu-dropdown classic-menu-dropdown <?php if($current_page == base_url('management_posts') || $current_page == base_url('advertisements')){ echo $active;}?>">
                                <a href="javascript:;"> Posts 
                                	<span class="icon-arrow-down"></span>
                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li class="<?php if($current_page == base_url('management_posts')){ echo $active;}?> ">
                                        <a href="<?php echo base_url()?>management_posts" class="nav-link  ">
                                            <i class="fa-clipboard fa"></i> Management Noticeboard
                                        </a>
                                    </li>
                                    <li class="<?php if($current_page == base_url('advertisements')){ echo $active;}?> ">
                                        <a href="<?php echo base_url()?>advertisements" class="nav-link  ">
                                            <i class="fa-buysellads fa"></i> Advertisement </a>
                                    </li>
                                    <li class="">
                                        <a href="#" class="nav-link  active">
                                            <i class="fa-group fa"></i> ALIA Community
                                        </a>
                                    </li>
                                </ul>                              
                            </li>-->
                              <?php
                             if($this->General_model->check_module_settings($this->condo_id, 'noticeboard')){
			  ?>
                            <li class="menu-dropdown mega-menu-dropdown  <?php if($current_page == base_url('management_posts')){ echo $active;}?>">
                                <a href="<?php echo base_url()?>management_posts"> Noticeboard
                                    <span class="arrow"></span>
                                </a>                                
                            </li>
                            <?php
							 }
							?>
                            
                            <?php
                             if($this->General_model->check_module_settings($this->condo_id, 'incident')){
			  ?>
                            <li class="menu-dropdown classic-menu-dropdown <?php if($current_page == base_url('incidents')){ echo $active;}?>">
                                <a href="<?php echo base_url();?>incidents">
                                     Report A Case
                                    <span class="arrow"></span>
                                </a>                                
                            </li>
                            <?php
							 }
							?>
                            
                            <?php
                             if($this->General_model->check_module_settings($this->condo_id, 'useful_links')){
			  ?>
                            <li class="menu-dropdown classic-menu-dropdown <?php if($current_page == base_url('useful_contacts') || $current_page == base_url('download_forms')){ echo $active;}?>">
                                <a href="javascript:;"> Useful Links
<!--                                    <span class="icon-arrow-down"></span>
-->                                </a>
                                <ul class="dropdown-menu pull-left">
                                    <li class="<?php if($current_page == base_url('useful_contacts')){ echo $active;}?> ">
                                        <a href="<?php echo base_url()?>useful_contacts" class="nav-link  ">
                                            <i class="icon-user"></i> Contacts
                                        </a>
                                    </li>
                                    
                                   <li class="<?php if($current_page == base_url('download_forms')){ echo $active;}?> ">
                                        <a href="<?php echo base_url()?>download_forms" class="nav-link  ">
                                            <i class="fa fa-file-pdf-o"></i> House Rules & Forms
                                        </a>
                                    </li>
                                    
                                </ul>                              
                            </li>
                            <?php
							 }						
							?>
                            
                             <?php
                             if($this->General_model->check_module_settings($this->condo_id, 'advertisement')){
			  ?>
                            <li class="menu-dropdown mega-menu-dropdown <?php if($current_page == base_url('advertisements')){ echo $active;}?>">
                                <a href="<?php echo base_url()?>advertisements"> Offers <span>&amp;</span> Promos
                                    <span class="arrow"></span>
                                </a>                                
                            </li>
                            <?php
							 } else {
								 ?>
								  <script type="text/javascript">
								  $(".hor-menu .nav.navbar-nav li:last-child").css('float:left');
								  </script>
                                 <?php
								 
							 }
							?>
                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                </div>
            </div>
            <!-- END HEADER MENU -->
        </div>
        <!-- END HEADER -->
        
<script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>
              <script type="text/javascript">
	jQuery( function(){
		$('.dropdown-toggle').click(function(){
			document.getElementById('badge_value').value = 0;
			$('.badge').hide();
			jQuery.ajax({
			url: '<?php echo base_url()?>home/notification_checked',
			type: 'POST',
			data: 'sess_id=' + <?php echo $this->session->userdata('resident_id')?>,
			dataType: 'json',
			success: function( payload ){
				
			}
		});
	});
	// Start Long-polling for notifications
	function notification_longpolling( timestamp, sess_id, condo_id, lastId ){
		var t;

		if( typeof lastId == 'undefined' ){
			lastId = 0;
		}
		
		if( typeof sess_id == 'undefined' ){
			sess_id = <?php echo $this->session->userdata('resident_id');?>;
		}
		
		if( typeof condo_id == 'undefined' ){
			condo_id = <?php echo $this->session->userdata('condo_id');?>;
		}
				
		jQuery.ajax({
			url: '<?php echo base_url()?>chatter/stream_comments',
			type: 'GET',
			data: 'timestamp=' + timestamp + '&sess_id=' + sess_id + '&condo_id=' + condo_id + '&lastId=' + lastId,
			dataType: 'json',
			success: function( payload ){
				clearInterval( t );
				if( payload.status == 'results' || payload.status == 'no-results' ){
					t=setTimeout( function(){
						notification_longpolling( payload.timestamp, payload.sess_id, payload.condo_id, payload.lastId );
					}, 1000 );
					if( payload.status == 'results' ){
						jQuery.each( payload.data, function(i,msg){
							var av = document.getElementById('badge_value').value;
							var n = parseInt(av,10) + 1;
							document.getElementById('badge_value').value = n;
							$('.badge').show();
							$(".badge").html(n);
								
							//if(msg.person_id!=sess_id){
							if( jQuery('.no-items').size() == 1 ){
								jQuery('.dropdown-menu-list').empty();
							}
							//if( jQuery('#actual_list'+msg.id).size() == 0 ){
//alert (msg.icount+1);

							
							var display_field ='';
							  if(msg.code == 'New Comment'){
								  display_field = 'commented on '+msg.display_field_actor+' post';
							  } else if(msg.code == 'New Post'){
								  display_field = 'added a new post';
							  } else if(msg.code == 'Facility Approved'){
								  display_field = ' has been approved';
							  } else if(msg.code == 'Delivery Approved'){
								  display_field = ' has been approved';
							  } else if(msg.code == 'New Quote'){
								  display_field = 'new Quote';
							  } else if(msg.code == 'Vendor Arrival Approved'){
								  display_field = 'has been approved';
							  }
							  
							  if(msg.person_id != sess_id){
							  var actor = '';	
							 if(msg.person_id == 0 ){
								 if(msg.session_id == sess_id && msg.code == 'Facility Approved'){
								 actor = 'Your booking for Facility <b>'+msg.facility_id+'</b>';
									jQuery('.dropdown-menu-list').prepend( 
										'<li id="actual_list'+msg.id+'">' +
										'<a href="javascript:;">' +
										
										'<span class="details">' +
											'<span class="label label-sm label-icon label-danger">' +
												'<i class="fa fa-bolt"></i>' +
											'</span>' + actor + ' ' + display_field + '</span>' +
										'</a>' +
										'</li>'
										);
							  	  } else if(msg.session_id == sess_id && msg.code == 'Delivery Approved'){
									  actor = 'Your delivery';
									jQuery('.dropdown-menu-list').prepend( 
										'<li id="actual_list'+msg.id+'">' +
										'<a href="javascript:;">' +
										
										'<span class="details">' +
											'<span class="label label-sm label-icon label-danger">' +
												'<i class="fa fa-bolt"></i>' +
											'</span>' + actor + ' ' + display_field + '</span>' +
										'</a>' +
										'</li>'
										);
								  } else if(msg.session_id == sess_id && msg.code == 'New Quote'){
									  actor = 'You have receied a';
									jQuery('.dropdown-menu-list').prepend( 
										'<li id="actual_list'+msg.id+'">' +
										'<a href="javascript:;">' +
										
										'<span class="details">' +
											'<span class="label label-sm label-icon label-danger">' +
												'<i class="fa fa-bolt"></i>' +
											'</span>' + actor + ' ' + display_field + '</span>' +
										'</a>' +
										'</li>'
										);
								  } else if(msg.session_id == sess_id && msg.code == 'Vendor Arrival Approved'){
									  actor = 'Vendor Arrival';
									jQuery('.dropdown-menu-list').prepend( 
										'<li id="actual_list'+msg.id+'">' +
										'<a href="javascript:;">' +
										
										'<span class="details">' +
											'<span class="label label-sm label-icon label-danger">' +
												'<i class="fa fa-bolt"></i>' +
											'</span>' + actor + ' ' + display_field + '</span>' +
										'</a>' +
										'</li>'
										);
								  }
							 } else {
								 if(msg.code == 'New Notice'){
									 actor = 'Your Management posted a new Notice';
									 jQuery('.dropdown-menu-list').prepend( 
										'<li id="actual_list'+msg.id+'">' +
										'<a href="javascript:;">' +
										
										'<span class="details">' +
											'<span class="label label-sm label-icon label-danger">' +
												'<i class="fa fa-bolt"></i>' +
											'</span>' + actor + ' ' + display_field + '</span>' +
										'</a>' +
										'</li>'
										);
								 } else {
									 actor = msg.actor;
									jQuery('.dropdown-menu-list').prepend( 
										'<li id="actual_list'+msg.id+'">' +
										'<a href="javascript:;">' +
										
										'<span class="details">' +
											'<span class="label label-sm label-icon label-danger">' +
												'<i class="fa fa-bolt"></i>' +
											'</span>' + actor + ' ' + display_field + '</span>' +
										'</a>' +
										'</li>'
										);
								 }
							 }
								 
							 }
							//}
							//}
						});
					}
				} else if( payload.status == 'error' ){
					alert('Something went wrong, Please refresh the page!');
				}
			},
			error: function(){
				clearInterval( t );
				t=setTimeout( function(){
					notification_longpolling( payload.timestamp, payload.sess_id,  payload.condo_id, payload.lastId );
				}, 15000 );
			}
		});
	}
	notification_longpolling( '<?php echo time(); ?>', '<?php echo $this->session->userdata('resident_id'); ?>','<?php echo $this->session->userdata('condo_id'); ?>');
});
		</script>        