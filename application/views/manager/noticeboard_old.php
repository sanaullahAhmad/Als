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
													<!-- col-table-row -->
													<div class="col-table-row">
														<!-- col-app -->
														<div class="col-app col-unscrollable">
															<!-- col-app -->
															<div class="col-app">
							<!-- Widget -->
							<div class="widget row widget-inverse">
											<!-- Widget heading -->
											<div class="widget-head">
												<h4 class="heading">Noticeboard Posts</h4>
											</div>
											<!-- // Widget heading END -->
											<div class="widget-body">
												<div class="innerLR">
<table style="width: 100%;">
	<tbody>
		<tr>
			<td width="50%">
				<h4>Received Posts (Live Stream)</h4>
                
				<ul class="items">
				<?php 
				if( sizeof($noticeboard_posts) >= 1){
				 	foreach($noticeboard_posts as $post){
                     
				?>
					<li><?php echo $post['id'] . '. ' . htmlspecialchars( $post['comment'] ); ?></li>
				<?php 
					}
				} else {
				?>
				<li class="no-items">There are no messages yet.</li>
				<?php } ?>
				</ul>
				
			</td>
			<td width="50%">
				<h4>Post</h4>
				<form method="POST" id="send-message">
					<div style="display:none;" id="loader"><img src="<?php echo base_url()?>assets/front/images/ajax-loader.gif"></div>
                    <input id="message" name="message" rows="10" style="width: 100%;" placeholder="Enter message and hit Enter" />
				</form>
			</td>
		</tr>
	</tbody>
</table>




                                                                            </div>
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
<script src="<?php echo base_url()?>assets/admin/css/components/plugins/jquery.latest.js" type="text/javascript"></script>
<script>
jQuery( function(){
	// Form Submission
	jQuery('#send-message').submit( function(){
		var message = jQuery('#send-message input[name=message]').val();
		if( jQuery.trim( message ) == '' ){
			alert('Enter a message!');
			return false;
		}
		$("#loader").show();
		$("#message").attr("disabled", "disabled"); 
		jQuery.ajax({
			url: '<?php echo base_url()?>manager/submit_comment',
			type: 'POST',
			data: 'message=' + message,
			dataType: 'json',
			success: function( payload ){
				if( payload.status == 'error' ){
					alert('Error!');
				} else if( payload.status == 'empty-message' ){
					alert('Enter a message!');
				} else if( payload.status == 'success' ){
					jQuery('#send-message input[name=message]').val('');
					$("#loader").hide();
					$("#message").removeAttr("disabled"); 
				}
			}
		});
		return false;
	});

	// Start Long-polling for messages
	function messages_longpolling( timestamp, lastId ){
		var t;

		if( typeof lastId == 'undefined' ){
			lastId = 0;
		}
				
		jQuery.ajax({
			url: '<?php echo base_url()?>manager/stream_comments',
			type: 'GET',
			data: 'timestamp=' + timestamp + '&lastId=' + lastId,
			dataType: 'json',
			success: function( payload ){
				clearInterval( t );
				if( payload.status == 'results' || payload.status == 'no-results' ){
					t=setTimeout( function(){
						messages_longpolling( payload.timestamp, payload.lastId );
					}, 1000 );
					if( payload.status == 'results' ){
						jQuery.each( payload.data, function(i,msg){
							if( jQuery('.no-items').size() == 1 ){
								jQuery('.items').empty();
							}
							if( jQuery('#' + msg.id).size() == 0 ){
								jQuery('.items').prepend( '<li id="' + msg.id + '">' + msg.id + '. ' + msg.comment + '</li>' );
							}
						});
					}
				} else if( payload.status == 'error' ){
					alert('We got confused, Please refresh the page!');
				}
			},
			error: function(){
				clearInterval( t );
				t=setTimeout( function(){
					messages_longpolling( payload.timestamp, payload.lastId );
				}, 15000 );
			}
		});
	}
	messages_longpolling( '<?php echo time(); ?>' );
});
</script>