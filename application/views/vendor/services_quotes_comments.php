<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"> Services Quote Comments
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span>Services Quotes Comments</span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <?php
		  ?>
  <div class="row">
  	  <?php
      if(sizeof($quotes_comments)>0)
      {
          foreach($quotes_comments as $report)
          {
              $id = 	$report['service_qoute_id'];
          }
      }
	  
	  $service_quotes	= $this->General_model->get_data_row_using_where('service_quotes', "id='$id'");
	  $service_request_id		= $service_quotes->service_request_id;
	  $get_service_request_row	= $this->General_model->get_data_row_using_where('service_requests', "id='$service_request_id'");

      ?>

  
  <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bubble font-hide hide"></i>
                                        <span class="caption-subject font-hide bold uppercase">Message Board</span>
                                    </div>
                                    
                                </div>
                                <div class="portlet-body" id="chats">
                                
                                
                                
                                <div class="row">
                                    <div class="col-md-6">
                                    	<div class="row">
                                        <div class="col-md-12 col-sm-12">
                                        <div class="portlet yellow-crusta box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    Service Request </div>
                                                
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row static-info">
                                                    <div class="col-md-4 name"> Requested by: </div>
                                                    <div class="col-md-8 value"> <?php echo $this->General_model->get_value_by_id('residents', $get_service_request_row->requested_by, 'name')?>
                                                       
                                                    </div>
                                                </div>
                                                <div class="row static-info">
                                                    <div class="col-md-4 name"> Condo: </div>
                                                    <div class="col-md-8 value"> 
													<?php echo 
													$this->General_model->get_value_by_id('condos', $get_service_request_row->condo_id, 
													'name')?>
</div>
                                                </div>
                                            <div class="row static-info">
                                                <div class="col-md-4 name"> Service: </div>
                                                <div class="col-md-8 value">
                                                    <?php echo $this->General_model->get_value_by_id('services', $get_service_request_row->service_id, 'name');?><br/>
                                                </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-4 name"> Days Left: </div>
                                                <div class="col-md-8 value"> <?php 
												 $now = strtotime($get_service_request_row->requested_time); // or your date as well
												 $your_date = strtotime($get_service_request_row->requested_time. ' -'.$get_service_request_row->duration.' days');
												 $datediff = $now - $your_date;
												 echo floor($datediff/(60*60*24));
												//echo $get_service_request_row->duration;
												?> days</div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-4 name"> Requested Time: </div>
                                                <div class="col-md-8 value"> <?php echo date('jS M h:i a', strtotime($get_service_request_row->requested_time));?> </div>
                                            </div>
                                            <?php
											if($get_service_request_row->service_request_file != ''){
											?>
                                            <div class="row static-info">
                                                <div class="col-md-4 name"> Attachment: </div>
                                                <div class="col-md-8 value"> <?php  echo '<a class="btn green" target="_blank" href="'. base_url().'uploads/services_requests/'.$get_service_request_row->service_request_file.'" >Click Here</a>';?> </div>
                                            </div>
                                            <?php
											}
											?>
                                        </div>
                                    </div>
                                     <div class="alert alert-info">
                                                  <strong>Note:</strong> We recommend that you communicate with vendors through our message board for your reference and record.
                                                </div>
                                </div>
                                		
                                
                                        <div class="col-md-12 col-sm-12">
                                <div class="portlet yellow-crusta box">
                                    <div class="portlet-title">
                                        <div class="caption">
                                           Quotation Details </div>
                                       
                                    </div>
                                    <div class="portlet-body">
                                         <div class="row static-info">
                                            <div class="col-md-4 name"> Price Range: </div>
                                            <div class="col-md-8 value"> 
                                            <?php if($service_quotes->min_budget != '' || $service_quotes->max_budget != ''){
                                                echo 'RM'.$service_quotes->min_budget.' - RM'.$service_quotes->max_budget;
                                                } else {
                                                    echo 'Not Provided';
                                                }?>
                                            </div>
                                        </div>
                                        
                                        <div class="row static-info">
                                            <div class="col-md-4 name"> Description: </div>
                                            <div class="col-md-8 value"> <?php echo $service_quotes->description?> </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-4 name"> Quotation: </div>
                                            <div class="col-md-8 value">
                                            <?php if($service_quotes->quotation_file==''){?>
                                            <form method="post" enctype="multipart/form-data">
                                                <input type="file" name="quotation_file" style="float:left; width:70%;"/>
                                                <input type="hidden" name="quote_hidden_id" value="<?php echo $service_quotes->id?>" />
                                                <button type="submit" class="btn green" name="quotation_file_upload"> Submit
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </form>
                                            <?php } else {?>
                                            <a href="<?php echo base_url();?>uploads/services_quotes/<?php echo $service_quotes->quotation_file?>" target="_blank" class="btn green"> Download
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <?php } ?>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                
                                 
                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    	<div class="row">
                                    	<div class="scroller" style="height: 525px;" data-always-visible="1" data-rail-visible1="1">
                                        <ul class="chats">
                                        </ul>
                                    </div>
                                    </div>
                                  
                                    <div class="chat-form-custom">
	<form action="<?php echo base_url();?>chatter/start_poll_quote_comments_vendor" method="post" class="formPostChat">
        <div class="input-cont">
          <input type="hidden" value="<?php echo $this->vendor_id?>" id="postUsername" />
          <input type="hidden" value="<?php echo $id?>" id="serviceID" />
          <input type="hidden" value="vendor" id="actor" />
		  <input class="form-control" id="postText" type="text" autocomplete="off" placeholder="Comment here..." />
		</div>
        <div class="btn-cont">
         <span class="arrow"> </span> 
            <input type="submit" value="Send" class="btn blue icn-only"/> 
       </div>
   </form>
                                        </div>						
										
                                    </div>
                                </div>
					 </div>        
   </div>
  
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>

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
				if(message[i].actor == 'resident'){

				//alert(message[i].service_qoute_id);
				/*alert(message[i].text + ' ' + message[i].user + ' ' + message[i].pic + ' ' + message[i].name + ' ' +message[i].actor + ' ' + message[i].time + ' ' + message[i].nicetime);*/
				//alert(num_rows);
			chat.append(
			 '<li class="in">' +				
			 '<img class="avatar" alt="" src="'+ message[i].pic +'">' +
				'<div class="message">' +
					'<span class="arrow"> </span>' +
					'<a href="javascript:;" class="name">' + message[i].name + '</a>' +
					'<span class="datetime"> at '+ message[i].nicetime + '</span>' +
					'<span class="body">' + message[i].text + '</span>' +
				'</div>' +
			'</li>'	
			);	
			} else {
					chat.append(
				 '<li class="out">' +				
				 '<img class="avatar" alt="" src="'+ message[i].pic +'">' +
					'<div class="message">' +
						'<span class="arrow"> </span>' +
						'<a href="javascript:;" class="name">' + message[i].name + '</a>' +
						'<span class="datetime"> at '+ message[i].nicetime + '</span>' +
						'<span class="body">' + message[i].text + '</span>' +
					'</div>' +
				'</li>'	

            
			);	
			}
				
			}
		}	
		
		//$('.chats').scrollTop($('.chats')[0].scrollHeight);
				$(".scroller").animate({ scrollTop: $('.chats')[0].scrollHeight }, "slow");

	});
});
		
	
		
		</script>        



