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
																	<h3 class="innerTB" style="float:left; margin-left:20px;">Services Quotes</h3>
                                                                    
                                                                   <!--<a class="btn btn-success button-right">Success</a>-->
                                                                 </div>
                                                            <!-- Widget -->
                                                            
<!-- <ul class="list-unstyled">
	<li >
			
            <div class="media innerAll margin-none">
                <a class="pull-left" href="#"><img src="../assets/images/people/80/8.jpg" alt="photo" class="media-object" width="35"></a>
                <div class="media-body">
                    <a href="" class="strong">Andrew</a> Good Job. Congrats and hope to see more admin templates like this in the future.
                    <div class="timeline-bottom">
                        <i class="fa fa-clock-o"></i> 2 days ago  
                    </div>
                </div>
            </div>
            
	</li>
</ul>

 <div class="innerAll">
    <input class="form-control" placeholder="Comment here..."/>
</div>  -->                                                  
                                                           
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                <?php
				if(sizeof($quotes_comments)>0)
				{
					foreach($quotes_comments as $report)
					{
						$id = 	$report['service_qoute_id'];
					}
				}
					?>
                    
                      <ul class="chats">
                      </ul>

                      
	<form action="<?php echo base_url();?>chatter/start_poll_quote_comments_vendor" method="post" class="formPostChat">
        <div class="input-cont">
          <input type="hidden" value="<?php echo $this->vendor_id?>" id="postUsername" />
          <input type="hidden" value="<?php echo $id?>" id="serviceID" />
          <input type="hidden" value="vendor" id="actor" />
		  <input class="form-control" id="postText" type="text" placeholder="Comment here..." />
		</div>
        <div class="btn-cont">
         <span class="arrow"> </span> 
            <input type="submit" value="Send" class="btn blue icn-only"/> 
       </div>
   </form>
  

 

                                                               
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




   
           
                              
                                       <!-- <ul class="chats">-->
                                        <?php
										/*foreach($quotes_comments as $report){
											$details = $this->General_model->get_data_row_using_where('residents','id='.$report['sender']);
											if($report['sender']==$this->session->userdata('resident_id'))
												{
										?>
                                                    <li class="out">
                                                        <img class="avatar" alt="" src="<?php echo base_url()?>uploads/profile_pictures/<?php echo $details->image_url; ?>" />
                                                        <div class="message">
                                                            <span class="arrow"> </span>
                                                            <a href="javascript:;" class="name"> <?php echo $details->name; ?> </a>
                                                            <span class="datetime"> at <?php echo date('H:i', strtotime($report['insertDate']));?> </span>
                                                            <span class="body"> <?php echo $report['comment']?>  </span>
                                                        </div>
                                                    </li>
                                            <?php }
											else
												  { ?>
                                                    <li class="in">
                                                       <img class="avatar" alt="" src="<?php echo base_url()?>uploads/profile_pictures/<?php echo $details->image_url; ?>" />
                                                        <div class="message">
                                                            <span class="arrow"> </span>
                                                <a href="javascript:;" class="name"> <?php echo $this->General_model->get_value_by_id('vendors',$commented_by,'name'); ?> </a>
                                                            <span class="datetime"> at <?php echo date('H:i', strtotime($report['insertDate']))?> </span>
                                                            <span class="body"> <?php echo $report['comment']?>  </span>
                                                        </div>
                                                    </li>
                                            <?php } 
											}*/?>
                                       <!-- </ul>-->
                                  
                                    

	                                    
                               
                            
     
  
<!-- Modal -->


<script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>
              <script type="text/javascript">
	function Chatter(){
	this.getMessage = function(callback, lastTime){
		var t = this;
		var latest = null;
		
		$.ajax({
			'url': '<?php echo base_url();?>chatter/start_poll_quote_comments_vendor',
			'type': 'post',
			'dataType': 'json',
			'data': {
				'mode': 'get',
				'lastTime': lastTime
			},
			'timeout': 30000,
			'cache': false,
			'success': function(result){
				if(result.result){
					callback(result.message);
					latest = result.latest;
				}	
			},
			'error': function(e){
				console.log(e);
			},
			'complete': function(){
				t.getMessage(callback, latest);
			}
		});
	};
	
	this.postMessage = function(user, text, actor, serviceID, callback){
		$.ajax({
			'url': '<?php echo base_url();?>chatter/start_poll_quote_comments_vendor',
			'type': 'post',
			'dataType': 'json',
			'data': {
				'mode': 'post',
				'user': user,
				'text': text,
				'actor': actor,
				'serviceID':serviceID
			},
			'success': function(result){
				callback(result);
			},
			'error': function(e){
				console.log(e);
			}
		});
	};
};

var c = new Chatter();

$(document).ready(function(){
	$('.formPostChat').submit(function(e){
		e.preventDefault();
		var user = $('#postUsername');
		var text = $('#postText');
		var actor = $('#actor');
		var serviceID = $('#serviceID');
		
		c.postMessage(user.val(), text.val(), actor.val(), serviceID.val(), function(result){
			if(result){
				
				text.val('');
			}
		});
	
		return false;
	});
	
	c.getMessage(function(message){

		var chat = $(".chats").empty();
		//var get_post_id = message[0].postID;
		//var chat = $('#general-item-list'+get_post_id).empty();
		for(var i = 0; i < message.length; i++){
			
			if(<?php echo $id?> == message[i].service_qoute_id){
				//alert(message[i].service_qoute_id);
				/*alert(message[i].text + ' ' + message[i].user + ' ' + message[i].pic + ' ' + message[i].name + ' ' +message[i].actor + ' ' + message[i].time + ' ' + message[i].nicetime);*/
				//alert(num_rows);
			chat.append(
			'<li><img src="'+ message[i].pic +'" width="41" height="41">'  + ' ' + message[i].text + ' <span style="float: right">' + message[i].nicetime + '</span></li>'
			 
			 /*'<div class="media innerAll margin-none">' +
                '<a class="pull-left" href="#"><img src="../assets/images/people/80/8.jpg" alt="photo" class="media-object" width="35"></a>' +
                '<div class="media-body">' +
                   ' <a href="" class="strong">Andrew</a>' + message[i].text + '' +
                    '<div class="timeline-bottom">' +
                        '<i class="fa fa-clock-o"></i> 2 days ago '  +
                   ' </div>' +
                '</div>' +
           ' </div>'*/
            
			);	
									
				
			}
		}	
		
		$('.chats').scrollTop($('.chats')[0].scrollHeight);
	});
});
		
	
		
		</script>        



