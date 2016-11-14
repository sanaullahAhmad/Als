<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="<?php echo base_url()?>vendor">
                <img src="<?php echo base_url()?>assets/front/layouts/layout2/img/logo-new1.png" alt="logo" class="logo-default" width="140"/> </a>
            <div class="menu-toggler sidebar-toggler">
            </div>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <div class="page-top">
            
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <span style="display:none;" class="badge badge-default"></span>
                                </a>
                                <input type="hidden" id="badge_value" value="0"/>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">Notifications</h3>
                                        <!--<a href="page_user_profile_1.html">view all</a>-->
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                        
                                        <?php
										$session_id = $this->session->userdata('vendor_id');
										$condo_id = $this->session->userdata('condo_id');
										$actions = "session_id=$session_id and code='New Chat' order by msg_time desc";
										$notifications = $this->General_model->
										get_data_all_like_using_where('notifications',$actions);
	
									  if( sizeof($notifications) >= 1){
										  foreach($notifications as $notification){												  											$noti_id = $notification['id'];
											$curr_session_id = $notification['session_id'];
											$posted_by = $notification['person_id'];
											$log_content = $notification['code'];
							
											//For comment actor display field
											$display_field_actor = '';
											
								$display_field_actor = $this->General_model->get_value_by_id('residents', $posted_by, 'name');
							
		
								$display_field ='';
								  if($log_content == 'New Chat'){
									  $display_field = 'sent you a new message';
								  } 
                              ?>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> <?php echo $display_field_actor.' '.$display_field;?> </span>
                                                </a>
                                            </li>
                                            <?php
										  }} else {
											?>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> No notification at the moment. </span>
                                                </a>
                                            </li>
                                          
                                          <?php
										  }
										  ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- END NOTIFICATION DROPDOWN -->
                            
                            
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <?php $get_profile_img = $this->General_model->get_value_by_id('vendors',$this->session->userdata('vendor_id'),'image_url');
                        if($get_profile_img == ''){
                            $src=base_url().'assets/front/layouts/layout2/img/avatar3_small.jpg';
                        } else {
                            $src=base_url().'uploads/vendor_images/'.$get_profile_img;
                        }
                        ?>
                            <img alt="" class="img-circle" src="<?php echo $src;?>" />
                            <span class="username username-hide-on-mobile"> <?php echo $this->session->userdata('vendor_name');?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                        	<li>
                                <a href="<?php echo base_url()?>vendor/profile">
                                    <i class="icon-user"></i> Profile </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()?>vendor/change_password">
                                    <i class="icon-user"></i> Change Password </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="<?php echo base_url()?>vendor/do_logout">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!--<li class="dropdown dropdown-extended quick-sidebar-toggler">
                        <span class="sr-only">Toggle Quick Sidebar</span>
                        <i class="icon-logout"></i>
                    </li>-->
                </ul>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery( function(){
	
		$('.dropdown-toggle').click(function(){
			document.getElementById('badge_value').value = 0;
			$('.badge').hide();
			
		});
	// Start Long-polling for notifications
	function notification_longpolling_vendor( timestamp, sess_id, lastId ){
		var t;

		if( typeof lastId == 'undefined' ){
			lastId = 0;
		}
		
		if( typeof sess_id == 'undefined' ){
			sess_id = <?php echo $this->session->userdata('vendor_id');?>;
		}
			
		jQuery.ajax({
			url: '<?php echo base_url()?>chatter/stream_vendor_notification',
			type: 'GET',
			data: 'timestamp=' + timestamp + '&sess_id=' + sess_id + '&lastId=' + lastId,
			dataType: 'json',
			success: function( payload ){
				clearInterval( t );
				if( payload.status == 'results' || payload.status == 'no-results' ){
					t=setTimeout( function(){
						notification_longpolling_vendor( payload.timestamp, payload.sess_id, payload.lastId );
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

							 jQuery('.dropdown-menu-list').prepend( 
								'<li id="actual_list'+msg.id+'">' +
								'<a href="javascript:;">' +
								
								'<span class="details">' +
									'<span class="label label-sm label-icon label-success">' +
										'<i class="fa fa-bolt"></i>' +
									'</span>' + msg.display_field_actor + ' ' + msg.code + '</span>' +
								'</a>' +
								'</li>'
								);
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
					notification_longpolling_vendor( payload.timestamp, payload.sess_id, payload.lastId );
				}, 15000 );
			}
		});
	}
	notification_longpolling_vendor( '<?php echo time(); ?>', '<?php echo $this->session->userdata('vendor_id'); ?>');
});
		</script>        