
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
                            	Verification
                                <img src="<?php echo base_url()?>assets/front/images/a-verification.png" />
                            </div>
                            <div class="a-body-text">
                            	<ul class="a-verification">
                                	<li>
                                    	Email Address Verified
                                    </li>
                                    <li>
                                    	Phone No Verified
                                    </li>
                                </ul>
                                <a href="#" class="a-verification">
                                	Add Verifications
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
                                        	Email Address Verified
                                        </a>
                                    </li>
                                    <li>
                                    	<a href="#">
                                        	Phone No Verified
                                        </a>
                                    </li>
                                    <li>
                                    	<a href="#">
                                        	Email Address Verified
                                        </a>
                                    </li>
                                    <li>
                                    	<a href="#">
                                        	Phone No Verified
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="a-right-content">
                    	<div class="left-grey-box">
                            <div class="a-heading">
                                Reason Of Closing
                            </div>
                            <div class="a-body-text">
                                <form method="post">
                                <p>
                                	<div class="a-form-row">
                                        
                                        <div class="a-form-section">
                                            <textarea name="reason" cols="" rows="" placeholder="Reason"></textarea>
                                        </div>
                                	</div>
                                </p>
                                <p>
                                	<div class="a-form-row">
                                        
                                        <div class="a-form-section">
                                            <input type="submit" name="reason_submit_btn" value="Send" />
                                        </div>
                                	</div>
                                </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>