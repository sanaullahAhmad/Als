
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE HEAD-->
                <div class="page-head">
                    <div class="container">
                        <!-- BEGIN PAGE TITLE -->
                        <div class="page-title">
                            <h1>
                            	Welcome To Cengal Condo                                
                            </h1>
                        </div>
                        <!-- END PAGE TITLE -->
                        <!-- BEGIN PAGE TOOLBAR -->
                        
                        <!-- END PAGE TOOLBAR -->
                    </div>
                </div>
                <!-- END PAGE HEAD-->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <div class="container">
                        <!-- BEGIN PAGE CONTENT INNER -->
                        <div class="page-content-inner">
                        	<div class="left-post">
								<div class="left-post-img">
									<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/left-post-image.png" />
									<div class="overlay">
										Water Disruption From 1st March.
									</div>
								</div>
								<div class="post-box">
									<div class="profile-pic">
										<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/profile-pic.png" />
									</div>
									<textarea class="post-here" placeholder="Post here..."></textarea>
								</div>
								<div class="post-action">
									<div class="fileUpload">
                                        <span><img src="<?php echo base_url()?>assets/front/layouts/layout3/img/photo-upload.png"></span>
                                        
                                       <form enctype="multipart/form-data" method="post" name="frmupload" id="myForm" action="">
                                        <input type="file" onchange="upload_image_click()" class="upload" name="upload_file">
                                        <input type="submit" onclick="upload_image()" style="display:none" id="upload_image_submit" name="upload_image_submit">
                                        </form>
                                    </div>
									<a href="#" class="post-post">
										Post
									</a>
								</div>
								<div class="other-post">
                                <?php
                                foreach($posts as $post){
									$post_id = $post['id'];
								$post_comments = $this->db->query("SELECT * FROM posts_comments WHERE post_id='$post_id'");
									?>
									<div class="post-box">
										<div class="profile-pic">
											<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/post-pic.png" />
										</div>
										<div class="pic-detail">
											<b>Zailan Imran</b> <br/>
											2 Hours ago.
										</div>
										<p>
											<?php echo $post['description'];?>
										</p>
										<div id="comments-section-<?php echo $post_id?>" class="posted-comments-sec">
                                         <?php
											foreach($post_comments->result_array() as $post_comment){
													
											
											?>
											<div class="posted-comments-row">
												<div class="small-post-image">
													<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/small-pic.png">
												</div>
												<div class="posted-comment">
													<h3>
														Ronnie : <span>2 Hours ago.</span>
													</h3>
													<p>
														<?php echo $post_comment['comment'];?> <a href="#"> see more </a>
													</p>
												</div>
											</div>
                                            <?php
											}
											?>
											
											
										</div>
                                        <div id="comments-section" class="posted-comments-sec">
                                        <div class="posted-comments-row1">
												<div class="small-post-image">
													<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/profile-pic.png">
												</div>
												<div class="posted-comment">
													<div class="other-post-comment">

                                                        
<form action="<?php echo base_url();?>chatter/start_poll" method="post" class="formPostChat" id="<?php echo $post['id']?>">
		
			<input type="hidden" value="9" id="postUsername<?php echo $post['id']?>" />
            <input type="hidden" value="<?php echo $post['id']?>" id="postID<?php echo $post['id']?>" />
		
		<input id="postText<?php echo $post['id']?>" name="" type="text" placeholder="Comment here..." />

			<input type="submit" value="Post" class="post-post"/>
			<span class="errorMessage" id="postError<?php echo $post['id']?>"></span>

	</form>
														
													</div>
												</div>
											</div>
                                            </div>
                                            
										<div class="view-more-comments">
											<a href="#">
												View All Comments <span>(200)</span>
											</a>
										</div>
									</div>
                                    <?php
								}
									?>
									<div class="post-box">
										<div class="profile-pic">
											<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/post-pic.png" />
										</div>
										<div class="pic-detail">
											<b>Zailan Imran</b> <br/>
											2 Hours ago.
										</div>
										<p>
											Check out the new condos.
										</p>
										<div class="post-images">											
											<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/condo1.png" />
											<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/condo2.png" />
											<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/condo3.png" />
											<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/condo4.png" />
										</div>
										<div class="posted-comments-sec">
											<div class="posted-comments-row">
												<div class="small-post-image">
													<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/small-pic.png">
												</div>
												<div class="posted-comment">
													<h3>
														Ronnie : <span>2 Hours ago.</span>
													</h3>
													<p>
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. <a href="#"> see more </a>
													</p>
												</div>
											</div>
											<div class="posted-comments-row">
												<div class="small-post-image">
													<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/small-pic.png">
												</div>
												<div class="posted-comment">
													<h3>
														Ronnie : <span>2 Hours ago.</span>
													</h3>
													<p>
														Lorem Ipsum is simply dummy text of the printing and typesetting industry. <a href="#"> see more </a>
													</p>
												</div>
											</div>
											<div class="posted-comments-row">
												<div class="small-post-image">
													<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/profile-pic.png">
												</div>
												<div class="posted-comment">
													<div class="other-post-comment">
														<input name="" type="text" placeholder="Comment here..." />
														<a href="#" class="post-post">
															Post
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="view-more-comments">
											<a href="#">
												View All Comments <span>(200)</span>
											</a>
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
                        <!-- END PAGE CONTENT INNER -->
                    </div>
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
          <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>
              <script type="text/javascript">
	function Chatter(){
	this.getMessage = function(callback, lastTime){
		var t = this;
		var latest = null;
		
		$.ajax({
			'url': '<?php echo base_url();?>chatter/start_poll',
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
					callback(result.message, result.ppid);
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
	
	this.postMessage = function(user, text, postID, callback){
		$.ajax({
			'url': '<?php echo base_url();?>chatter/start_poll',
			'type': 'post',
			'dataType': 'json',
			'data': {
				'mode': 'post',
				'user': user,
				'text': text,
				'postID':postID
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
		var id = $(this).attr('id');
		
		var user = $('#postUsername'+id);
		var text = $('#postText'+id);
		var postID = $('#postID'+id);
		var err = $('#postError'+id);
		
		c.postMessage(user.val(), text.val(), postID.val(), function(result){
			if(result){
				text.val('');
			}
			err.html(result.output);
		});
	
		return false;
	});
	
	c.getMessage(function(message, ppid){
		var chat = $("#comments-section-"+ppid).empty();
		//var get_post_id = message[0].postID;
		//var chat = $('#general-item-list'+get_post_id).empty();
		//alert(ppid);
		for(var i = 0; i < message.length; i++){
			if(ppid == message[i].postID){
			chat.append(
				'<div class="posted-comments-row">' +
					'<div class="small-post-image">' +
						'<img src="<?php echo base_url()?>assets/front/layouts/layout3/img/small-pic.png">' +
					'</div>' +
					'<div class="posted-comment">' +
						'<h3>' 
							+ message[i].postID + ': <span>2 Hours ago.</span>' +
						'</h3>' +
 						'<p>' +
							message[i].text+  '<a href="#"> see more </a>' +
						'</p>' +
					'</div>' +
				'</div>'
											
				
			);
			}
		}
		//var get_post_id = '';
		//alert(get_post_id);
		
		//$('.scroller').scrollTop($('.general-item-list')[0].scrollHeight);
	});
});
		
	
		
		</script>