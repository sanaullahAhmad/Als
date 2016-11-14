<?php $current_page = base_url(uri_string());
	  $active = 'start active open';
	  $selected = '<span class="selected"></span>';
	  $arrow = 'open';

?>
<div class="page-sidebar-wrapper">
                <div class="page-sidebar navbar-collapse collapse">
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                        <li class="nav-item <?php if($current_page == base_url('alpha/dashboard')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>alpha/dashboard" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                 <?php if($current_page == base_url('alpha/dashboard')){ echo $selected;}?>	
                                 <span class="arrow <?php if($current_page == base_url('alpha/dashboard')){ echo $arrow;}?>"></span>
                            </a>
                            
                        </li>
                     <li class="nav-item <?php if($current_page == base_url('alpha/condos')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>alpha/condos" class="nav-link nav-toggle">
                                <i class="fa fa-building"></i>
                                <span class="title">Condos</span>
								<?php if($current_page == base_url('alpha/condos')){ echo $selected;}?>								
                                <span class="arrow <?php if($current_page == base_url('alpha/condos')){ echo $arrow;}?>"></span>
                            </a>
                            
                        </li>
                     
                     <li class="nav-item <?php if($current_page == base_url('alpha/residents')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>alpha/residents" class="nav-link nav-toggle">
                                <i class="fa fa-user"></i>
                                <span class="title">Residents</span>
								<?php if($current_page == base_url('alpha/residents')){ echo $selected;}?>								
                                <span class="arrow <?php if($current_page == base_url('alpha/residents')){ echo $arrow;}?>"></span>
                            </a>
                            
                        </li>
                        <li class="nav-item <?php if($current_page == base_url('alpha/reported_posts')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>alpha/reported_posts" class="nav-link nav-toggle">
                                <i class="fa fa-warning"></i>
                                <span class="title">Reported Posts</span>
								<?php if($current_page == base_url('alpha/reported_posts')){ echo $selected;}?>								
                                <span class="arrow <?php if($current_page == base_url('alpha/reported_posts')){ echo $arrow;}?>"></span>
                            </a>
                            
                        </li>
                     	<li class="nav-item <?php if($current_page == base_url('alpha/advertisements')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>alpha/advertisements" class="nav-link nav-toggle">
                                <i class="fa fa-image"></i>
                                <span class="title">Advertisements</span>
								<?php if($current_page == base_url('alpha/advertisements')){ echo $selected;}?>								
                                <span class="arrow <?php if($current_page == base_url('alpha/advertisements')){ echo $arrow;}?>"></span>
                            </a>
                        </li>
                        
                        <!--<li class="nav-item <?php if($current_page == base_url('alpha/modules')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>alpha/modules" class="nav-link nav-toggle">
                                <i class="fa fa-image"></i>
                                <span class="title">Modules</span>
								<?php if($current_page == base_url('alpha/modules')){ echo $selected;}?>								
                                <span class="arrow <?php if($current_page == base_url('alpha/modules')){ echo $arrow;}?>"></span>
                            </a>
                        </li>-->
                        
                        <li class="nav-item  <?php if($current_page == base_url('alpha/vendors')){ echo $active;}?>">
                            <a href="<?php echo base_url()?>alpha/vendors" class="nav-link nav-toggle">
                                <i class="fa fa-legal"></i>
                                <span class="title">Vendors</span>
                                <?php if($current_page == base_url('alpha/vendors')){ echo $selected;}?>
                                <span class="arrow <?php if($current_page == base_url('alpha/vendors')){ echo $arrow;}?>"></span>
                            </a>
                            
                        </li>
                        <li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-settings"></i>
                                <span class="title">Settings</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item <?php if($current_page == base_url('alpha/users')){ echo $active;}?>">
                                    <a href="<?php echo base_url()?>alpha/users" class="nav-link nav-toggle">
                                        <i class="fa fa-building"></i>
                                        <span class="title">Users</span>
                                        <?php if($current_page == base_url('alpha/users')){ echo $selected;}?>								
                                        <span class="arrow <?php if($current_page == base_url('alpha/users')){ echo $arrow;}?>"></span>
                                    </a>
                                </li>
                                <li class="nav-item <?php if($current_page == base_url('alpha/service_categories')){ echo $active;}?>">
                                    <a href="<?php echo base_url()?>alpha/service_categories" class="nav-link nav-toggle">
                                        <i class="fa fa-building"></i>
                                        <span class="title">Services Categories</span>
                                        <?php if($current_page == base_url('alpha/service_categories')){ echo $selected;}?>								
                                        <span class="arrow <?php if($current_page == base_url('alpha/service_categories')){ echo $arrow;}?>"></span>
                                    </a>
                                </li>
                                <li class="nav-item <?php if($current_page == base_url('alpha/services')){ echo $active;}?>">
                                    <a href="<?php echo base_url()?>alpha/services" class="nav-link nav-toggle">
                                        <i class="fa fa-building"></i>
                                        <span class="title">Services</span>
                                        <?php if($current_page == base_url('alpha/services')){ echo $selected;}?>								
                                        <span class="arrow <?php if($current_page == base_url('alpha/services')){ echo $arrow;}?>"></span>
                                    </a>
                                </li>
                                <li class="nav-item <?php if($current_page == base_url('alpha/closing_account_options')){ echo $active;}?>">
                                    <a href="<?php echo base_url()?>alpha/closing_account_options" class="nav-link nav-toggle">
                                        <i class="fa fa-building"></i>
                                        <span class="title">Closing Account Options</span>
                                        <?php if($current_page == base_url('alpha/closing_account_options')){ echo $selected;}?>								
                                        <span class="arrow <?php if($current_page == base_url('alpha/closing_account_options')){ echo $arrow;}?>"></span>
                                    </a>
                                </li>
                                <li class="nav-item <?php if($current_page == base_url('alpha/announcement')){ echo $active;}?>">
                                    <a href="<?php echo base_url()?>alpha/announcement" class="nav-link nav-toggle">
                                        <i class="fa fa-building"></i>
                                        <span class="title">Announcement</span>
                                        <?php if($current_page == base_url('alpha/announcement')){ echo $selected;}?>								
                                        <span class="arrow <?php if($current_page == base_url('alpha/announcement')){ echo $arrow;}?>"></span>
                                    </a>
                                </li>
                                
                            </ul>
                        </li>

                        </ul>
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>







<!--<div id="menu" class="hidden-print hidden-xs sidebar-blue sidebar-brand-primary">

			
<div id="sidebar-fusion-wrapper">
	<div id="brandWrapper">
		<a href="<?php echo base_url()?>alpha" class="display-block-inline pull-left logo"><img src="<?php echo base_url()?>assets/admin/images/logo/alia-logo.png" alt=""></a>
		<!--<a href="<?php echo base_url()?>admin/"><span class="text">ALIA</span></a>
	</div>
	

	<ul class="menu list-unstyled" id="navigation_current_page">
            <li <?php if($current_page == base_url('alpha/dashboard')){ echo $active;}?>><a href="<?php echo base_url()?>alpha/dashboard" class="glyphicons cardio"><i></i><span>Dashboard</span></a></li>
        <li <?php if($current_page == base_url('alpha/condos')){ echo $active;}?>><a href="<?php echo base_url()?>alpha/condos" class="glyphicons building"><i></i><span>Condos</span></a></li>
         <li <?php if($current_page == base_url('alpha/vendors')){ echo $active;}?>><a href="<?php echo base_url()?>alpha/vendors" class="glyphicons group"><i></i><span>Vendors</span></a></li>
        
        <li class="hasSubmenu">
            <a href="#settings_tables" data-toggle="collapse"><i class="fa fa-cog"></i> Settings</a>
            <ul class="collapse" id="settings_tables">
            	<li <?php if($current_page == base_url('alpha/users')){ echo $active;}?>><a href="<?php echo base_url()?>alpha/users" class="glyphicons user"><i></i><span>Users</span></a></li>
                 <li <?php if($current_page == base_url('alpha/service_categories')){ echo $active;}?>><a href="<?php echo base_url()?>alpha/service_categories" class="glyphicons cardio"><i></i><span>Services Categories</span></a></li>
        		 <li <?php if($current_page == base_url('alpha/services')){ echo $active;}?>><a href="<?php echo base_url()?>alpha/services" class="glyphicons wrench"><i></i><span>Services</span></a></li>
                 <li <?php if($current_page == base_url('alpha/incident_categories')){ echo $active;}?>><a href="<?php echo base_url()?>alpha/incident_categories" class="glyphicons cardio"><i></i><span>Incident Categories</span></a></li>

            </ul>
        </li>
	</ul>
</div>
</div>-->