<div class="navbar hidden-print navbar-inverse box main" role="navigation">
            <div class="user-action user-action-btn-navbar pull-left border-right">
                <button class="btn btn-sm btn-navbar btn-primary btn-stroke"><i class="fa fa-bars fa-2x"></i></button>
            </div>
            
            <div class="col-md-3 visible-md visible-lg padding-none">
                <div class="input-group innerL">
                    <input type="text" class="form-control input-sm" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div><!-- /input-group -->
            </div>

  	

	<div class="user-action pull-right menu-right-hidden-xs menu-left-hidden-xs">
		<div class="dropdown username hidden-xs pull-left">
			<a class="dropdown-toggle " data-toggle="dropdown" href="#">
				<span class="media margin-none">
					<!--<span class="pull-left"><img src="<?php echo base_url()?>assets/admin/images/people/35/16.jpg" alt="user" class="img-circle"></span>-->
					<span class="media-body">
						<?php echo $this->session->userdata('vendor_name');?> <span class="caret"></span> 
					</span>
				</span>
			</a>
			<ul class="dropdown-menu pull-right">
				<li class="active"><a href="<?php echo base_url()?>vendor/profile" class="glyphicons user"><i></i> Profile</a></li>
				<li><a href="<?php echo base_url()?>vendor/change_password">Change Password</a></li>
				<li><a href="<?php echo base_url()?>vendor/do_logout">Logout</a></li>
		    </ul>
		</div>
		
	</div>
	<div class="clearfix"></div>
</div>