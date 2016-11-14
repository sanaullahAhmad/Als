
        	<div class="container">
            	<div class="a-content">
                    <div class="a-left-content">
                        <div class="left-grey-box">
                        	<div class="a-profile-image">
						<?php 
						$details = $this->General_model->get_data_row_using_where('residents','id='.$this->session->userdata('resident_id'));
						if($details->image_url==''){?>
                                <span id='output_image'><img src="<?php echo base_url()?>assets/front/images/no-image.jpg" /></span>
                        <?php } else {?>
                        		<span id='output_image'><img src="<?php echo base_url()?>uploads/profile_pictures/<?php echo $details->image_url; ?>" /></span>
                        <?php }?>
                        <img class="loadergif" style="display:none; width:32px; height:32px; margin-left:100px;" src="<?php echo base_url()?>assets/front/images/ajax-loader.gif" />
                                <div class="a-edit-profile">                                    
                                    <div class="fileUpload">
                                        <span><img src="<?php echo base_url()?>assets/front/images/edit-pic.png" /></span>
                                        
                                       <form action="<?php echo base_url()?>home/upload_progress" id="myForm" name="frmupload" method="post" enctype="multipart/form-data">
                                        <input name="upload_file" type="file" class="upload" onchange="upload_image_click()"/>
                                        <input name="upload_image_submit" id="upload_image_submit" type="submit" style="display:none" onclick="upload_image()"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="a-profile">
                            	<h2>
                                	<?php echo $details->name?>
                                </h2>
                                <p>
                                	<a href="#">
                                    	View Profile
                                    </a>
                                </p>
                                <a href="#">
                                	Complete Profile
                                </a>
                            </div>
                        </div>
                        <div class="left-grey-box">
                        	<div class="a-heading">
                            	Alert Notification
                                <img src="<?php echo base_url()?>assets/front/images/a-verification.png" />
                            </div>
                            <div class="a-body-text">
                            	<ul class="a-verification">
                                	<li>
                                    	Phone Number Alert
                                    </li>
                                    <li>
                                    	Email Alert
                                    </li>
                                </ul>
                                <a href="#" class="a-verification">
                                	Change Settings
                                </a>
                            </div>
                        </div>
                        <div class="left-grey-box">
                        	<div class="a-heading">
                            	Quick Links
                            </div>
                            <div class="a-body-text">
                            	<ul class="quick-links">
                                	<li>
                                    	<a href="#">
                                        	Link 1
                                        </a>
                                    </li>
                                    <li>
                                    	<a href="#">
                                        	Link 2
                                        </a>
                                    </li>
                                    <li>
                                    	<a href="#">
                                        	Link 3
                                        </a>
                                    </li>
                                    <li>
                                    	<a href="#">
                                        	Link 4
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="a-right-content">
                    	<div class="left-grey-box">
                            <div class="a-heading">
                                Post on Noticeboard
                            </div>
                            <div class="a-body-text">
                            <?php if( $this->session->flashdata('message')){?>
                            <div class="alert alert-primary forincorrectunpass"><?php echo $this->session->flashdata('message');?></div>
                            <?php }?>
                            	<form method="post" id="dashboar-post-form">
                                
                                	<div class="a-form-row">
                                        
                                        <div class="a-form-section full-widht-nopadding">
                                            <textarea name="post" id="post" cols="" rows="" placeholder="Enter Post" class="low-heigh-textarea"></textarea>
                                            <span id="post_validate"></span>
                                            <input type="hidden" name="post_id" id="post_id" value="0" />
                                            <input type="hidden" name="images_ids" id="images_ids" value="0" />
                                        </div>
                                	</div>
                                                                           
                                        <div class="a-form-section default-form-setter">
                                            <input type="submit" name="post_submit_btn" id="post_submit_btn" value="Post" />
                                        </div>
                                    
                                </form>
                                <form>
                                    <div id="queue" style="float:right"></div>
                                    <input id="file_upload" name="file_upload" type="file" multiple="true">
                                </form>
                                <h3 class="h3-margin">
                                	My Posts
                                </h3>
                                <p></p>
                                <?php if(sizeof($posts)>0)
									  {
										foreach($posts as $post)
										{
								?>
                                <p>
                                	<?php echo $post['description'];?>
                                </p>
                                <?php $posts_images=$this->General_model->get_data_all_using_where('post_id',$post['id'],'posts_images');
											if(sizeof($posts_images)>0)
											{
												foreach($posts_images as $posts_image)
												{
											?>
                                            <img src="<?php echo base_url()?>uploads/post_images/<?php echo $posts_image['image_url']?>"
                                            class="post_image" width="250" height="250"/>
										  <?php }
                                          }?>
                               		
                               		 <div class="a-form-row">
                                        <div class="a-form-section full-widht-nopadding">
                                            <textarea name="comment" placeholder="Enter Comment" class="low-heigh-textarea comment comment_<?php echo $post['id'];?>" postid="<?php echo $post['id'];?>"></textarea>
                                            <span id="comment_validate"></span>
                                        </div>
                                	</div>
                                    <div id="new_comments_<?php echo $post['id'];?>" class="a-form-row"></div>
                                     <?php $posts_comments=$this->General_model->get_data_all_like_using_where('posts_comments',"post_id=".$post['id']." ORDER BY id DESC");
									if(sizeof($posts_comments)>0)
									{
										foreach($posts_comments as $comment)
										{
									?>
									<div class="a-form-row">
										<div class="a-form-section full-widht-nopadding">
											<?php echo urldecode($comment['comment']);?>                                        
										</div>
									</div>
								  <?php }
								  }?>
                                      
						  <?php }
                              }?>
                               
                                
                            </div>
                        </div>
                        <div class="left-grey-box">
                            <div class="a-heading">
                            	Notifications
                            </div>
                            <div class="a-body-text">
                            	<ul class="a-notification">
                                	<li>
                                    	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is dummy text.
                                    </li>
                                    <li>
                                    	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is dummy text.
                                    </li>
                                    <li>
                                    	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is dummy text.
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--<div class="left-grey-box">
                        	<div class="a-heading">
                            	Invite Friends, Earn Travel Cridet ! 
                            </div>
                            <div class="a-body-text">
                            	<div class="a-column">
                                    <p>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                    </p>
                                    <a href="#">
                                        Travel Cridet
                                    </a>
                                </div>
                            </div>
                        </div>-->
                        <div class="left-grey-box">
                        	<div class="a-heading">
                            	Messages ( 0 ) 
                            </div>
                            <div class="a-body-text">
                            	<p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>