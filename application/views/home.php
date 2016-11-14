<link href="<?php echo base_url();?>assets/front/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">
<style>
.left-post .col-md-12 .row {
	padding:15px 0px;
}
.left-post .col-md-12 {
	margin-bottom:30px;
}
.tab-content h2 {
	font-size: 20px;
	font-weight: 600;
	margin-top: 10px;
}
.tab-content .tab-pane div {
	float: left;
	height: 138px;
	line-height: 23px;
	overflow: hidden;
	width: 100%;
	padding: 0px;
	/*text-align:justify;*/
	margin: 12px 0;
}
.tab-content .tab-pane div p
{
	margin:0px 0px 18px !important;
}
.left-post .col-md-12 .row .col-md-11 {
	padding-left:5px; padding-right: 12px;
}
.left-post .col-md-12 .row .col-md-1
{
	padding-right:5px;
}
.left-post .col-md-12 .row .col-md-11 .tab-content
{
	 border:1px solid #414141; border-right:8px solid #414141; display:inline-block; border-radius:5px !important; padding:0px 10px; width:100%;
}
.left-post .col-md-12 .row .col-md-11 .tab-content a.post-post
{
	margin-right:0px; margin-bottom:15px;
}
.left-post .col-md-12 .row .col-md-11 .tab-content .post-post
{
	background:#414141;
}
.tab-content h2 {
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#45484d+0,000000+100;Black+3D+%231 */
/*background: #A3A3A3;*/
/*background: -moz-linear-gradient(top,  #45484d 0%, #20bb6b 100%);
background: -webkit-linear-gradient(top,  #45484d 0%,#20bb6b 100%);
background: linear-gradient(to bottom,  #45484d 0%,#20bb6b 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#45484d', endColorstr='#20bb6b',GradientType=0 );*/
    color: #414141;
    font-size: 18px;
    margin: 0;
    padding: 10px 0px 30px;
	border-bottom:1px solid #414141;
}
.tab-content h2 span
{
	float:left; width:100%; font-size:12px; color:#666; margin-top:5px;
}
.tab-content p
{
	color: #A3A3A3;
}
.tabs-left.nav-tabs > li, .tabs-right.nav-tabs > li
{
	margin-bottom:10px;
}
.tabs-left.nav-tabs
{
	border:0px;
}
.nav.nav-tabs.tabs-left span {
    color: #a3a3a3;
    display: inline-block;
    font-size: 10px;
    width: 100%;
}
.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover
{
/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#45484d+0,000000+100;Black+3D+%231 */
background:#20bb6b;
color:#fff;
border-radius: 5px !important;
border:0px !important;
}
.nav-tabs > li > a
{
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#45484d+0,000000+100;Black+3D+%231 */
background: #414141; /* Old browsers */
color:#fff;
font-weight:bold;
}
.nav-tabs > li > a span
{
	color:#a3a3a3;
}
.tabs-left.nav-tabs > li > a {
    border-radius: 5px !important;
    display: block;
	text-align:center;
	border:0px !important;
}
.tabs-left.nav-tabs > li > a:focus, .tabs-left.nav-tabs > li > a:hover
{
	background:#20bb6b;
}
.post-post:focus
{
	color:#fff; text-decoration:none;
}
</style>
<div class="page-content-wrapper"> 
  <!-- BEGIN CONTENT BODY --> 
  <!-- BEGIN PAGE HEAD-->
  <div class="page-head">
    <div class="container"> 
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
        <h1> Welcome to <?php echo $this->General_model->get_value_by_id('condos',$this->condo_id,'name');?> </h1>
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
          <?php if ($this->session->flashdata('message')) { ?>
          <div class="alert alert-info">
            <?= $this->session->flashdata('message') ?>
          </div>
          <?php } ?>
          <?php
		   $condo_module_count = $this->General_model->get_data_all_like_using_where_count('condo_modules', "condo_id = '$this->condo_id'");
		    
         if($this->General_model->check_module_settings($this->condo_id, 'noticeboard')){
			  
		   if(sizeof($manager_posts)>0)
		   {
			   ?>
          <div class="col-md-12">
            <div class="row" style="background:#fff;">
              <div class="col-md-1 col-sm-1 col-xs-1">
                <ul class="nav nav-tabs tabs-left">
                  <?php
					$icount = 1;
					foreach($manager_posts as $manager_post){
					  if($icount == 1){ $class='active';} else {$class='';}
				  ?>
                  <li class="<?php echo $class;?>"> 
                  	<!--<a href="#tab_6_<?php echo $manager_post['id']?>" data-toggle="tab"><?php echo $manager_post['title']?> 
                    	<span><i class="fa fa-upload"></i> <?php echo date('j M h:i a', strtotime($manager_post['post_time']))?></span>
                    </a>-->
                    <a href="#tab_6_<?php echo $manager_post['id']?>" data-toggle="tab"> <?php echo $icount; ?></a>
                  </li>
                  <?php
				  $icount++;
				  }
				  ?>
                </ul>
              </div>
              <div class="col-md-11 col-sm-11 col-xs-11">
                <div class="tab-content">
                  <?php
					  $icount_content = 1;
					  foreach($manager_posts as $manager_post){
						  if($icount_content == 1){ $class_content='active';} else {$class_content='';}
				  ?>
                  <div class="tab-pane <?php echo $class_content;?>" id="tab_6_<?php echo $manager_post['id']?>">
                    <h2>
					<?php echo $manager_post['title']?>
                    <span>Published on <?php echo date('j M h:i a', strtotime($manager_post['post_time']))?></span> 
                    </h2>
                    <div> <?php 
					//echo htmlspecialchars($manager_post['description']);
					//echo preg_replace('/\s&nbsp;\s/i', ' ', $manager_post['description']);
					//echo htmlspecialchars_decode(htmlspecialchars_decode(stripslashes($manager_post['description'])));
					//add word count limit
					$limit = 70;
					if (str_word_count($manager_post['description'], 0) > $limit) {
					  $words = str_word_count($manager_post['description'], 2);
					  $pos = array_keys($words);
					  $text = substr($manager_post['description'], 0, $pos[$limit]) . '...';
      				} else {
						$text = $manager_post['description'];
					}
					//echo $text;
					
					echo $manager_post['description'];
					?> 
                    </div>
                    <a class="post-post pull-left" target="_blank" href="<?php echo base_url()?>home/single_management_post/<?php echo $this->encrypt_model->encode($manager_post['id']);?>">View Full Post</a> </div>
                  <?php
					  $icount_content++;
					  }
				  ?>
                </div>
                <a class="post-post pull-right" style="margin-top:15px;" target="_blank" href="#">View All Posts</a> </div>
              </div>
            </div>    
            <?php
		   }
			?>
            
            
                  <!--<div id="myCarousel" class="carousel slide" data-ride="carousel">
                    
                    <ol class="carousel-indicators">
                       <?php
					   if(sizeof($manager_posts)>0)
						 {
							$n=1;
							foreach($manager_posts as $manager_post){
							?>
							<li data-target="#myCarousel" data-slide-to="0" class="<?php if($n==1){ echo "active";}?>"></li>
							<?php 
							$n++;
							}
						 }else{?>
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						 <?php }?>
                    </ol>
                    <div class="carousel-inner">
                         <?php
						 if(sizeof($manager_posts)>0)
						 {
							$n=1;
							foreach($manager_posts as $manager_post){
							?>
							<div class="item <?php if($n==1){ echo "active";}?>" style="height:500px;">
                            <div class="container">
                                <div class="carousel-caption">
                                    <img src="<?php echo base_url()?>uploads/post_images/<?php echo $manager_post['image_url']?>" />
                                     <div class="overlay"><a href="<?php echo base_url();?>management_posts"><?php echo $manager_post['title']?></a><br /><small><?php echo substr($manager_post['description'],0,80)?></small></div>
                                </div>
                            </div>
                        </div>
							<?php 
							$n++;
							}
						 }
						 ?>
                    </div> 
                    <?php
					 if(sizeof($manager_posts)>0)
					 {?>
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    	<span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                    <?php } ?>
                </div>-->
          <?php
				}
				?>
          
          <!--<div class="right-post">
    <?php
		$action = "condo_id = $this->condo_id AND payment_status=1 AND  status=1 ORDER BY RAND() LIMIT 3";//AND status=0
		$adverts=$this->General_model->get_data_all_like_using_where('adverts', $action);
		if($adverts>0)
		{
			foreach($adverts as $advert)
			{
	?>
            <div class="right-post-img">
                <a target="_blank" href="<?php echo base_url()?>uploads/advertisement_images/<?php echo $advert['image_url'];?>">
                	<img src="<?php echo base_url()?>uploads/advertisement_images/<?php echo $advert['image_url'];?>" />
                </a>
                <div class="overlay">
				<?php echo $advert['title']?><br /><small><?php echo substr($advert['description'],0,40)?></small>
                </div>
            </div>
    <?php }
	}?>
    
    <a href="<?php echo base_url()?>add_advertisement" class="post-ur-ad-btn">
        Post Your Ad
    </a>
</div>--> 
          
          <?php 
		  /*if($condo_module_count > 0){
			$condo_modules = $this->General_model->get_data_row_using_where('condo_modules', "condo_id = '$this->condo_id'");
		  if($condo_modules->advertisement==1){
		  echo $this->load->view('template/sidebar');
		  }
		  }*/?>
          <?php if( $this->session->flashdata('message')){?>
          <div class="alert alert-primary forincorrectunpass"><?php echo $this->session->flashdata('message');?></div>
          <?php }?>
          <?php
		 
			if($condo_module_count > 0){
			$condo_modules = $this->General_model->get_data_row_using_where('condo_modules', "condo_id = '$this->condo_id'");
		  if($condo_modules->community_wall==1){
			$prof_pic = $this->General_model->get_value_by_id('residents',$this->resident_id,'image_url');
			if($prof_pic==''){$prof_pic=base_url().'assets/front/images/no-image.jpg';}
			else{$prof_pic=base_url().'uploads/profile_pictures/'.$prof_pic;}
		  ?>
          <form method="post" id="dashboar-post-form">
            <div class="post-box">
              <div class="profile-pic"> <img width="41" height="41" src="<?php echo $prof_pic;?>" /> </div>
              <textarea class="post-here" placeholder="Post here..." name="post" id="post" ></textarea>
              <span id="post_validate" class="error_individual"></span>
              <input type="hidden" name="images_ids" id="images_ids" value="0" />
            </div>
            <div class="post-action">
              <div class="fileUpload" style="/*width:100%;*/"> 
                <!--<span><img src="<?php echo base_url()?>assets/front/layouts/layout3/img/photo-upload.png"></span>--> 
                <span class="btn btn-success fileinput-button" style="margin-bottom:10px;"> <i class="glyphicon glyphicon-plus"></i> <span>Select files...</span>
                <input id="home_file_upload" type="file" name="file_upload" multiple>
                </span>
                <div id="progress_loading" style="margin-top: 10px; width:100%; display:none; clear:both;">
                  Loading...
                </div>
                <div id="progress" class="progress" style="margin-top: 10px; width:50%; display:none; height:10px;">
                  <div class="progress-bar progress-bar-success"></div>
                </div>
                <div id="files" class="files" style="clear:both;"></div> 
              </div>
              <input type="submit" name="post_submit_btn" id="post_submit_btn" value="Post" class="post-post"/>
            </div>
          </form>
          <div class="other-post">
            <?php
			
			if(sizeof($posts)>0)
			{
              foreach($posts as $post){
              $post_id = $post['id'];
              $post_prof_name = $this->General_model->get_value_by_id('residents',$post['posted_by'],'name');
              $post_prof_pic = $this->General_model->get_value_by_id('residents',$post['posted_by'],'image_url');
			   if($post_prof_pic==''){$post_prof_pic=base_url().'assets/front/images/no-image.jpg';}
			   else{$post_prof_pic=base_url().'uploads/profile_pictures/'.$post_prof_pic;}
              $post_comments = $this->db->query("SELECT * FROM posts_comments WHERE post_id='$post_id' ORDER BY  insertDate DESC ");
          ?>
            <div class="post-box post_number_<?php echo $post_id;?>">
              <div class="profile-pic"> <img src="<?php echo $post_prof_pic;?>" 
                                  width="41" height="41"/> </div>
              <div class="pic-detail"> <b><?php echo $this->General_model->get_value_by_id('residents', $post['posted_by'], 'name')?></b> <br/>
                <?php 
				   if($post['edit_time']!="0000-00-00 00:00:00") {
					  echo $this->General_model->nicetime2($post['edit_time']);  
					  echo " - Edited "; 
				   }
				   else
				   {
					   echo $this->General_model->nicetime2($post['post_time']);  
				   }
				?>
              </div>
              <div class="actions pull-right">
                <div class="btn-group"> <a class="btn green-haze btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true"> Actions <i class="fa fa-angle-down"></i> </a>
                  <ul class="dropdown-menu pull-right report_delete_actions">
                    <?php if( $post['posted_by']!=$this->session->userdata('resident_id')){?>
                    <li> <a title="Report" onclick="report_post('<?php echo $post_id;?>')"  data-toggle="modal"  href="#action_alert"> Report</a><!--href="javascript:;"--> 
                    </li>
                    <?php } ?>
                    <?php if( $post['posted_by']==$this->session->userdata('resident_id')){?>
                    <li class="divider"> </li>
                    <li> <a href="javascript:;"  onclick="edit_post('<?php echo $post_id;?>')" title="Edit">Edit</a> </li>
                    <li class="divider"> </li>
                    <li> <a onclick="delete_post_step1('<?php echo $post_id;?>')" title="Delete" href="#action_alert" data-toggle="modal">Delete</a> </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
              <p> <?php echo $post['description'];?> </p>
              <div class="post-images">
                <?php $posts_images=$this->General_model->get_data_all_using_where('post_id',$post['id'],'posts_images');
					  if(sizeof($posts_images)>0)
					  {
						  foreach($posts_images as $posts_image)
						  {
						  ?>
                          <a class="fancybox" rel="group_<?php echo $post['id'];?>" 
                          href="<?php echo base_url()?>uploads/post_images/<?php echo $posts_image['image_url']?>"> 
                                <img src="<?php echo base_url()?>uploads/post_images/<?php echo $posts_image['image_url']?>"  height="132"/> 
                          </a>
					<?php }
                    }?>
              </div>
              <div id="comments-section-<?php echo $post_id?>" class="posted-comments-sec">
                <?php
				$comment_count =1;
				foreach($post_comments->result_array() as $post_comment){
					if($comment_count>5)
					{
						break;
					}
						$post_prof_pic_comment = $this->General_model->get_value_by_id('residents',$post_comment['commented_by'],'image_url');
						if($post_prof_pic_comment==''){$post_prof_pic_comment=base_url().'assets/front/images/no-image.jpg';}
						else{$post_prof_pic_comment=base_url().'uploads/profile_pictures/'.$post_prof_pic_comment;}
						$commenter_name = $this->General_model->get_value_by_id('residents',$post_comment['commented_by'],'name');
				?>
                <div class="posted-comments-row">
                  <div class="small-post-image"> <img src="<?php echo $post_prof_pic_comment;?>"  width="31" height="31" > </div>
                  <div class="posted-comment">
                    <h3> <?php echo $commenter_name;?> : <span><?php echo $this->General_model->nicetime2($post_comment['insertDate']);?>.</span> </h3>
                    <p>
                      <?php $more = substr($post_comment['comment'],90,10000);
						if ($more!='')
						{
							$str =  '<a href="javascript:;" onclick="show_more_text('.$post_comment['id'].')"  
							class="show_more_anchor_'.$post_comment['id'].'"> see more </a>
							<span class="show_more_span_'.$post_comment['id'].'" style="display:none">'.$more.'</span>';
						  }
						  else
						  {
							  $str = '';
						  }
						?>
                      <?php echo substr($post_comment['comment'],0,90).$str;?> </p>
                  </div>
                </div>
                <?php         
				$comment_count++;
				}
				?>
              </div>
              <div id="comments-section" class="posted-comments-sec">
                <div class="posted-comments-row">
                  <div class="small-post-image"> <img width="31" height="31" src="<?php echo $prof_pic;?>" /> </div>
                  <div class="posted-comment">
                    <div class="other-post-comment">
                      <form action="<?php echo base_url();?>chatter/start_poll" method="post" class="formPostChat" id="<?php echo $post['id']?>">
                        <input type="hidden" value="<?php echo $this->resident_id?>" id="postUsername<?php echo $post['id']?>" />
                        <input type="hidden" value="<?php echo $post['id']?>" id="postID<?php echo $post['id']?>" />
                        <input type="hidden" value="<?php echo $this->condo_id?>" id="postCondoid" />
                        <input id="postText<?php echo $post['id']?>" name="" type="text" placeholder="Comment here..." />
                        <input type="submit" value="Post" class="post-post"/>
                        <span class="errorMessage" id="postError<?php echo $post['id']?>"></span>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <?php if(sizeof($post_comments->result_array())>4) {?>
              <div class="view-more-comments"> <a href="<?php echo base_url()?>view_all_comments/<?php echo $post['id']?>"> View All Comments <span>(<?php echo sizeof($post_comments->result_array())?>)</span> </a> </div>
              <?php }?>
            </div>
            <?php
                      }
				if(sizeof($posts)==5)
				{
					?>
					<div class="post-box morebox" id="more<?php echo $post_id; ?>" style="text-align: center;">
              		<button type="button" class="btn btn-primary more" id="<?php echo $post_id; ?>" onclick="more_rows(<?php echo $post_id?>)">
                    	Load More
                    </button>
            		</div>
                    <script>
					function more_rows(ID) 
					{
					if(ID)
					{
						$("#more"+ID).html('<img src="<?php echo base_url()?>assets/admin/images/loading.gif" width="32" height="32"/>');
						
						$.ajax({
							type: "POST",
							url: "<?php echo base_url();?>home/dashboar_more_posts_viewajax",
							data: "lastmsg="+ ID, 
							cache: false,
							success: function(html){
							$(".other-post").append(html);
							$("#more"+ID).remove(); // removing old more button
							var c = new Chatter();
								$('.formPostChat_'+ID).submit(function(e){
									e.preventDefault();
									var id = $(this).attr('id');
									
									var user 	= $('#postUsername'+id);
									var text 	= $('#postText'+id);
									var postID  = $('#postID'+id);
									var condoID = $('#postCondoid');		
									var err 	= $('#postError'+id);
									
									c.postMessage(user.val(), text.val(),  postID.val(), condoID.val(), function(result){
										if(result){
											text.val('');
										}
										err.html(result.output);
									});
								
									return false;
								});
								
								
							
							}
						});
					}
					else
					{
					$(".morebox").html('No more quotes');// no results
					}
					
					return false;
					
				}
					</script>
					
					<?php
				}
			}
           ?>
          </div>
          <?php
		  }
			}
		  ?>
        </div>
        <?php 
		
		  if($condo_module_count > 0){
			$condo_modules = $this->General_model->get_data_row_using_where('condo_modules', "condo_id = '$this->condo_id'");
		  if($condo_modules->advertisement==1){
		  echo $this->load->view('template/sidebar');
		  }
		  }?>
		
      </div>
      <!-- END PAGE CONTENT INNER --> 
    </div>
  </div>
  <!-- END PAGE CONTENT BODY --> 
  <!-- END CONTENT BODY --> 
</div>
<!-- END CONTENT --> 
<!-- Trigger the modal with a button --> 

<!-- Modal -->
<div id="editpostModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Post</h4>
      </div>
      <div class="modal-body editpostModal-body" style="min-height:250px;">
        <p>&nbsp;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="action_alert" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
          <h4 class="modal-title action_alert_title">Delete Post</h4>
        </div>
        <div class="modal-body">
          <label class="control-label action_alert_label">This Post will be deleted permanently.<br />
            Are you sure?</label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
          <button type="button" class="btn green action_alert_submit" onclick="delete_post()">Delete</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
<script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script> 
<script type="text/javascript">
	function show_more_text(post_id)
	{
		$(".show_more_anchor_"+post_id).hide();
		$(".show_more_span_"+post_id).show();
	}
	function delete_post(post_id)
	{
		/*if (confirm("This Post will be deleted Permanently."+"\n"+" Are you sure?")) 
		{*/
			$.ajax({
			'url': '<?php echo base_url();?>home/delete_post',
			'type': 'post',
			'data': {
				'post_id': post_id
			},
			'cache': false,
			'success': function(result){
				$(".post_number_"+post_id).hide();
				//$(".action_alert_submit").hide();
				//$(".action_alert_label").html('Deleted Succussfully.');
				location.reload();
			}
		});
		/*} 
		else 
		{
           return false;
        }*/
	}
	function delete_post_step1(post_id)
	{
		$(".action_alert_submit").attr('onclick','delete_post('+post_id+')');
		$(".action_alert_label").html("This Post will be deleted permanently."+"\n"+" Are you sure?");
		$(".action_alert_title").html("Delete Post");
		$(".action_alert_submit").show();
	}
	<?php $timestamp = time();?>
	function edit_post(post_id)
	{
		$('#editpostModal').modal('show');
			$.ajax({
			'url': '<?php echo base_url();?>home/edit_post',
			'type': 'post',
			'data': {
				'post_id': post_id
			},
			'cache': false,
			'success': function(result){
				$(".editpostModal-body").html(result);
				//uploadify here..
				$("#progress2").css( 'visibility', 'hidden');
				$('#file_upload2').fileupload({
					url: '<?php echo base_url()?>home/upload_home_post_images',
					dataType: 'json',
					done: function (e, data) 
					{
						$.each(data.result.files, function (index, file) 
						{
							//check if file upload exeeded
							var check_images = $("#additional_images2").html();
							if(check_images!='')
							{
								var lenth = $('#additional_images2 .images_names').length;
								if(lenth>4)
								{ 
									alert("You have already Selected Five images.");
									return false;//this will stop add progress bar
								}
							}
							//check if file upload exeeded ends
							var res = file.name.split(".");
							var ran = "";
							var charset = "abcdefghijklmnopqrstuvwxyz";
							for( var i=0; i < 5; i++ )
								ran += charset.charAt(Math.floor(Math.random() * charset.length));
							if(file.valid_file=='yes')
							{
							
							$('#additional_images2').append('<section style="position:relative; float:left;" class="'+ran+'"><img src="<?php echo base_url()?>uploads/post_images/'+file.name+'" class="img_responsive" style="width:100px; float:left"/><span onclick="delete_image_and_section(&#39;'+ran+'&#39;, &#39;'+res[0]+'&#39;, &#39;'+res[1]+'&#39;, &#39;post_images&#39;, &#39;posts_images&#39;) class="image_delete_cross" >&#120;</span><input type="hidden" name="images_names[]" value="'+file.name+'" class="images_names"></section>');
							}
							else
							{
								$('#additional_images2').append('<section style="position:relative; float:left;" class="'+ran+'"><span class="label label-warning">'+file.name+'</span><span onclick="delete_image_section(&#39;'+ran+'&#39;)" class="image_delete_cross" style="margin-left:5px">&#120;</span></section>');
							}
						});
					},
					progressall: function (e, data) 
					{
						$("#progress2").css( 'visibility', 'visible');
						var progress = parseInt(data.loaded / data.total * 100, 10);
						$('#progress2 .progress-bar').css(
							'width',
							progress + '%'
						);
						if(progress>99){ setTimeout(function(){ $("#progress2").css( 'visibility', 'hidden'); }, 3000); }
					}
				}).prop('disabled', !$.support.fileInput)
				.parent().addClass($.support.fileInput ? undefined : 'disabled');
			}
		});
	}
	function report_post(post_id)
	{
		$(".action_alert_label").html('Thanks for reporting. We will look into this matter and necessary action will be taken if the post is found to be inappropriate.');
		$(".action_alert_title").html("Report Post");
		$(".action_alert_submit").hide();
		$.ajax({
			'url': '<?php echo base_url();?>home/report_post',
			'type': 'post',
			'data': {
				'post_id': post_id
			},
			'cache': false,
			'success': function(result){
				$(".report_post_"+post_id).html('Reported');
				//location.reload();
				$(".action_alert_submit").hide();
				$(".action_alert_label").html('Reported Succussfully.');
			}
		});
	}
	function empty_post_check()
	{
		post_modal = $('#post_modal').val();
		if(post_modal=='')
		{
			alert("Please enter some text");
			return false;
		}
		else
		{
			return true;
		}
		
	}
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
	
	this.postMessage = function(user, text, postID, condoID, callback){
		$.ajax({
			'url': '<?php echo base_url();?>chatter/start_poll',
			'type': 'post',
			'dataType': 'json',
			'data': {
				'mode': 'post',
				'user': user,
				'text': text,
				'condoID': condoID,
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
		var condoID = $('#postCondoid');		
		var err = $('#postError'+id);
		
		c.postMessage(user.val(), text.val(),  postID.val(), condoID.val(), function(result){
			if(result){
				text.val('');
			}
			err.html(result.output);
		});
	
		return false;
	});
	
	c.getMessage(function(message, ppid){
		//alert(ppid);
		var chat = $("#comments-section-"+ppid).empty();
		
		//var get_post_id = message[0].postID;
		//var chat = $('#general-item-list'+get_post_id).empty();
		for(var i = 0; i < message.length; i++){
			if(ppid == message[i].postID){
				
				//alert(num_rows);
			if (message[i].seemore_text!=false){
			  str =  '<a href="javascript:;" onclick="show_more_text('+message[i].commentID+')"  class="show_more_anchor_'+message[i].commentID+'"> see more </a>' +
							'<span class="show_more_span_'+message[i].commentID+'" style="display:none">'+message[i].seemore_text+'</span>';
			}
			else
			{
				str = '';
			}
			chat.append(
				'<div class="posted-comments-row">' +
					'<div class="small-post-image">' +
						'<img width="31" height="31" src="<?php echo base_url()?>uploads/profile_pictures/'+ message[i].pic +'">' +
					'</div>' +
					'<div class="posted-comment">' +
						'<h3>' 
							+ message[i].name + ': <span>'+ message[i].nicetime +'.</span>' +
						'</h3>' +
 						'<p>' +
							message[i].text+str+
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
<style>
.fancybox-desktop
{
	width: 80% !important;
    height: 510px !important;
    top: 10% !important;
    left: 10% !important;
}
.fancybox-skin
{
	width: 100% !important;
    height: 100% !important;
	background:#000 !important;
}
.fancybox-outer {
    width: 100% !important;
    height: 480px !important;
	display:table !important;
	text-align:center;
}
.fancybox-inner {
    display: table-cell !important;
    height:auto !important;
    text-align: center !important;
    vertical-align: middle !important;
    width: auto !important;
}
.fancybox-image, .fancybox-iframe {
    height: auto !important;
	max-height:480px !important;
    width: auto !important;
	max-width:100% !important;
	display:inline-block !important;
}
</style>
