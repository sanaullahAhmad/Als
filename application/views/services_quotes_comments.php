<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript" ></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/search.min.css" />
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
                    
                    <!-- BEGIN PORTLET-->
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
                                              Vendor Info 
                                          </div>
                                      </div>
                                      <div class="portlet-body">
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Vendor Name: </div>
                                            <div class="col-md-7 value"> <?php echo $vendor_info->name?>
                                               
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Company Name: </div>
                                            <div class="col-md-7 value"> <?php echo $vendor_info->company_name?> </div>
                                        </div>
                                                
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Profile and Reviews: </div>
                                            <div class="col-md-7 value"><a href="<?php echo base_url();?>vendor_profile/<?php echo $this->encrypt_model->encode($vendor_info->id)?>" target="_blank">Click here</a>  </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Rating  </div>
                                            <div class="col-md-7 value">
                                            	<?php
													$action="quoted_by=".$vendor_info->id." AND ven_arival_time<NOW()";
                                                    $rating = $this->General_model->get_data_all_like_using_where('service_quotes', $action);
													$vendor_rating =0;
													$n=0;
													if(sizeof($rating)>0)
													{
														foreach($rating as $rat)
														{
															$vendor_rating +=$rat['rating'];
															$n++;
														}
													}
													if($n==0)
													{
														echo "No Rating Yet";
														$my_rating ='';
													}
													else
													{
														 $my_rating = $vendor_rating/$n;
													}
												?>
                                                <table class="demo-table">
                                                  <tbody>
                                                  
                                                  <tr>
                                                    <td valign="top">
                                                    <div>
                                                    <ul>
                                                      <?php
                                                      for($i=1;$i<=5;$i++) {
                                                      $selected = "";
                                                      if(!empty($my_rating) && $i<=$my_rating) {
                                                        $selected = "selected";
                                                      }
                                                      ?>
                                                      <li class='<?php echo $selected; ?>' >&#9733;</li>  
                                                      <?php }  ?>
                                                    <ul>
                                                    </div>
                                                    </td>
                                                  </tr>
                                                  </tbody>
                                                  </table>
<style>
  .demo-table {width: 100%;border-spacing: initial;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333;}
  .demo-table th {background: #999;padding: 5px;text-align: left;color:#FFF;}
  .demo-table td {/*border-bottom: #f0f0f0 1px solid;*/background-color: #ffffff;padding: 5px;}
  .demo-table td div.feed_title{text-decoration: none;color:#00d4ff;font-weight:bold;}
  .demo-table ul{margin:0;padding:0;}
  .demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
  .demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
</style>
                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Address: </div>
                                            <div class="col-md-7 value">
                                                <?php echo $vendor_info->address;?><br/>
                                                <?php echo $this->General_model->get_value_by_id('areas', $vendor_info->areas, 'name');?><br/>
                                                <?php echo $this->General_model->get_value_by_id('states', $vendor_info->state, 'name');?>
                                            </div>
                                        </div>
                                            <!--<div class="row static-info">
                                                <div class="col-md-5 name"> Area: </div>
                                                <div class="col-md-7 value"> <?php echo $this->General_model->get_value_by_id('areas', $vendor_info->areas, 'name');?> </div>
                                            </div>-->
                                           <!-- <div class="row static-info">
                                                <div class="col-md-5 name"> State: </div>
                                                <div class="col-md-7 value"> <?php echo $this->General_model->get_value_by_id('areas', $vendor_info->state, 'name');?> </div>
                                            </div>-->
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Contact Number: </div>
                                                <div class="col-md-7 value"> <?php echo $vendor_info->phone;?> </div>
                                            </div>
                                           
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
                                            <div class="col-md-5 name"> Price Range: </div>
                                            <div class="col-md-7 value"> <?php if($quotes_details->min_budget != '' || $quotes_details->max_budget != ''){
                                                echo 'RM'.$quotes_details->min_budget.' - RM'.$quotes_details->max_budget;
                                                } else {
                                                    echo 'Not Provided';
                                                }?> </div>
                                        </div>
                                        
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Description: </div>
                                            <div class="col-md-7 value"> <?php echo $quotes_details->description?> </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"> Quotation: </div>
                                            <div class="col-md-7 value"> <a href="<?php echo base_url();?>uploads/services_quotes/<?php echo $quotes_details->quotation_file?>" target="_blank" class="btn red"> Download
                                                                                        <i class="fa fa-edit"></i>
                                                                                    </a> </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                
                                 <div class="alert alert-info">
                                                  <strong>Note:</strong> The price range shown are estimates only, and the final quotation is subject to vendor's site visit. 
                                                </div>
                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                    	<div class="row">
                                    	<div class="scroller"  id="contentchatdiv" style="height: 525px;" data-always-visible="1" data-rail-visible1="1">
                                        <ul class="chats">
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
                                        </ul>
                                    </div>
                                    </div>
                                    
                                    <?php if($quotes_details->status == '0')
										{
										?>
                                    <div class="chat-form-custom">
                                        <form action="<?php echo base_url();?>chatter/start_poll_quote_comments" method="post" class="formPostChat">
                                            <div class="input-cont">
                                              <input type="hidden" value="<?php echo $this->resident_id?>" id="postUsername" />
                                              <input type="hidden" value="<?php echo $id?>" id="serviceID" />
                                              <input type="hidden" value="resident" id="actor" />
                                              <input class="form-control" id="postText" type="text" placeholder="Comment here..." />
                                            </div>
                                            <div class="btn-cont">
                                             <span class="arrow"> </span> 
                                                <input type="submit" value="Send" class="btn blue icn-only"/> 
                                           </div>
                                       </form>
                                     </div>						
										<?php
										} ?> 

                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                
                                
                                
                                    
								                                        </div>        
                                	</div>
                            
                            <?php if($quotes_details->status == '0')
							{
							?>
                            <a class="btn btn-primary" href="javascript:;" title="Approve"  data-toggle="modal" data-target="#myModal">Hire</a>
                            <!-- onclick="approve_quote('<?php echo $this->uri->segment('2')?>','2')" -->
                            <?php
							} ?> 
                            <!-- END PORTLET-->
                        
                    
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
        <h4 class="modal-title">Service Appointment</h4>
      </div> 
      <form method="POST" id="add-facility-booking" class="form-horizontal" action="<?php echo base_url();?>service_quotes" >   
      <div class="modal-body">
       
            <input type="hidden" name="quote_id" id="quote_id" value="<?php echo $this->uri->segment(2);?>" />   
              <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Date & Time</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control datetimepicker" id="arivaldatetime" name="arivaldatetime" >
                        <span id="enddatetime_validate" class="error_individual help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Phone</label>
                    <div class="col-md-9">
                        <input type="text" required class="form-control" id="phone" name="phone" placeholder="Contact given to vendor for communication purpose">
                        <span id="phone_validate" class="error_individual help-block"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Message</label>
                    <div class="col-md-9">
                        <textarea required class="form-control" id="message" name="message" placeholder="State your purpose of hiring for management's approval.  (eg. air-con leaking, need to do repairs and servicing)"></textarea>
                        <span id="message_validate" class="error_individual help-block"></span>
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


<script type="text/javascript">
	function Chatter(){
	this.getMessage = function(callback, lastTime){
		var t = this;
		var latest = null;
		
		$.ajax({
			'url': '<?php echo base_url();?>chatter/start_poll_quote_comments',
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
			'url': '<?php echo base_url();?>chatter/start_poll_quote_comments',
			'type': 'post',
			'dataType': 'json',
			'data': {
				'mode': 'post',
				'user': user,
				'text': encodeURIComponent(text),
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
				    var itemContainer = $("#contentchatdiv");
    itemContainer.slimScroll({
        height: '525px',
        start: 'bottom',
        alwaysVisible: true
    });
	
	//$('#contentchatdiv').slimScroll({ scroll: '520px' });

	
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
		
		 
          
       
		$(".scroller").animate({ scrollTop: $('.chats').height() }, "slow");
			//$('.scroller').scrollTop($('.chats')[0].scrollHeight);
			//$(".scroller").scrollTop($('.scroller').height())
	});
		//$(".scroller").animate({ scrollTop: $('.chats').prop("scrollHeight")}, 1000);

});
		
	



		
		</script>        



<script type="text/javascript">
$('.datetimepicker').datetimepicker({
    locale: 'en',
	autoclose: true,
    widgetPositioning: {
        vertical: 'top',
        horizontal: 'left',
    }
}); 
</script>