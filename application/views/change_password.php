<div class="container">
            	<div class="a-content">
                    <div class="a-left-content">                        
                        <div class="left-grey-box">
                        	<div class="a-heading">
                            	Profile
                            </div>
                            <div class="a-body-text">
                            	<ul class="a-listing">
                                	<li>
                                    	<a href="#" class="a-active-links">
                                        	Edit Profile
                                        </a>
                                    </li>
                                    <li>
                                    	<a href="#">
                                        	Photos, Symbols and Video
                                        </a>
                                    </li>
                                    <li>
                                    	<a href="#">
                                        	Trust and Verification
                                        </a>
                                    </li>
                                    <li>
                                    	<a href="#">
                                        	Reviews
                                        </a>
                                    </li> 
                                    <li>
                                    	<a href="#">
                                        	References
                                        </a>
                                    </li>                                     
                                </ul>
                                <a href="#" class="a-listing" >
                                	View Profile
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="a-right-content">
                    	<div class="left-grey-box">
                        	<div class="a-heading">
                            	Change Password
                            </div>
                            <div class="a-body-text">
                            <?php if ($this->session->flashdata('message')) { ?>
                                <div class="alert alert-info" style="background:#008C44;margin:20px; color:#fff;"> 
									<?= $this->session->flashdata('message') ?> 
                                </div>
                            <?php } ?>
                            <form class="form-horizontal innerT " role="form" method="POST" id="change-password">
                            <input type="hidden" value="<?php echo $resident_info->id?>" name="id">
                              <div class="a-form-row">
                                <label>Current Password</label>
                                 <div class="a-form-section">
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Type here">
                                  <span class="error_individual" id="password_validate"></span>
                               </div>
                              </div>
                              <div class="a-form-row">
                                <label>New Password</label>
                                <div class="a-form-section">
                                  <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Type here">
                                  <span class="error_individual" id="new_password_validate"></span>
                                </div>
                              </div>
                             <div class="a-form-row">
                                <label>Retype New Password</label>
                                <div class="a-form-section">
                                  <input type="password" class="form-control" id="retype_password" name="retype_password" placeholder="Type here">
                                  <span class="error_individual" id="retype_password_validate"></span>
                                </div>
                              </div>
                              <div class="a-form-row">
                                <label>&nbsp;</label>
                                <div class="a-form-section">
                                  <button type="submit" name="changepasssub" class="btn btn-primary">Change Password</button>
                                </div>
                              </div>
                            </form>
				
			
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>