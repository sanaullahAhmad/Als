<?php $current_page = base_url(uri_string());
	  $active = 'start active open';
	  $selected = '<span class="selected"></span>';
	  $arrow = 'open';

?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " 
        data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item <?php if($current_page == base_url('manager/dashboard')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/dashboard" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                     <?php if($current_page == base_url('manager/dashboard')){ echo $selected;}?>	
                     <span class="arrow <?php if($current_page == base_url('manager/dashboard')){ echo $arrow;}?>"></span>
                </a>
            </li>
            <li class="nav-item <?php if($current_page == base_url('manager/residents')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/residents" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">Residents</span>
                    <?php if($current_page == base_url('manager/residents')){ echo $selected;}?>								
                    <span class="arrow <?php if($current_page == base_url('manager/residents')){ echo $arrow;}?>"></span>
                </a>
            </li>
            <li class="nav-item <?php if($current_page == base_url('manager/online_payment')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/online_payment" class="nav-link nav-toggle">
                    <i class="fa fa-usd"></i>
                    <span class="title">Payment</span>
                    <?php if($current_page == base_url('manager/online_payment')){ echo $selected;}?>								
                    <span class="arrow <?php if($current_page == base_url('manager/online_payment')){ echo $arrow;}?>"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php if($current_page == base_url('manager/online_payment')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/online_payment" class="nav-link nav-toggle">
                            <i class="fa fa-usd"></i>
                            <span class="title">Online Payment</span>
                            <?php if($current_page == base_url('manager/online_payment')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/online_payment')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($current_page == base_url('manager/payment_type')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/payment_type" class="nav-link nav-toggle">
                            <i class="fa fa-eur"></i>
                            <span class="title">Payment Type</span>
                            <?php if($current_page == base_url('manager/payment_type')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/payment_type')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                     <li class="nav-item <?php if($current_page == base_url('manager/processing_fee')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/processing_fee" class="nav-link nav-toggle">
                            <i class="fa fa-eur"></i>
                            <span class="title">Processing Fee</span>
                            <?php if($current_page == base_url('manager/processing_fee')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/processing_fee')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                </ul>
            </li>
            
            <?php if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "community_wall")==1){?>
            <li class="nav-item  <?php if($current_page == base_url('manager/posts')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/posts" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">Community Posts</span>
                    <?php if($current_page == base_url('manager/posts')){ echo $selected;}?>
                    <span class="arrow <?php if($current_page == base_url('manager/posts')){ echo $arrow;}?>"></span>
                </a>
            </li>
            <?php }?>
            
            <?php if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "visitors")==1){?>
            <li class="nav-item  <?php if($current_page == base_url('manager/visitor_delivery')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/visitor_delivery" class="nav-link nav-toggle">
                    <i class="fa fa-truck"></i>
                    <span class="title">Visitors & Deliveries</span>
                    <?php if($current_page == base_url('manager/visitor_delivery')){ echo $selected;}?>
                    <span class="arrow <?php if($current_page == base_url('manager/visitor_delivery')){ echo $arrow;}?>"></span>
                </a>
            </li>
            <?php }?>
            
            
            <?php if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "services")==1){?>
            <li class="nav-item  <?php if($current_page == base_url('manager/hire_service_provider')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/hire_service_provider" class="nav-link nav-toggle">
                    <i class="fa fa-check"></i>
                    <span class="title">Service Provider Hiring</span>
                    <?php if($current_page == base_url('manager/hire_service_provider')){ echo $selected;}?>
                    <span class="arrow <?php if($current_page == base_url('manager/hire_service_provider')){ echo $arrow;}?>"></span>
                </a>
            </li>
            <?php }?>
            
            <?php if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "facility")==1){?>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-futbol-o"></i>
                    <span class="title">Facilities</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php if($current_page == base_url('manager/facility_category')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/facility_category" class="nav-link nav-toggle">
                            <i class="fa fa-cubes"></i>
                            <span class="title">Facility Category</span>
                            <?php if($current_page == base_url('manager/facility_category')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/facility_category')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($current_page == base_url('manager/manager_facilities')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/manager_facilities" class="nav-link nav-toggle">
                            <i class="fa fa-dashboard"></i>
                            <span class="title">Facility Settings</span>
                            <?php if($current_page == base_url('manager/manager_facilities')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/manager_facilities')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($current_page == base_url('manager/facility_bookings')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/facility_bookings" class="nav-link nav-toggle">
                            <i class="fa fa-book"></i>
                            <span class="title">Bookings</span>
                            <?php if($current_page == base_url('manager/facility_bookings')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/facility_bookings')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($current_page == base_url('manager/pending_facility_payments')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/pending_facility_payments" class="nav-link nav-toggle">
                            <i class="fa fa-bookmark"></i>
                            <span class="title">Pre-bookings (pending)</span>
                            <?php if($current_page == base_url('manager/pending_facility_payments')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/pending_facility_payments')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                    
                    
                </ul>
            </li>
            <?php }?>
            
            <li class="nav-item  <?php if($current_page == base_url('manager/noticeboard_posts')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/noticeboard_posts" class="nav-link nav-toggle">
                    <i class="fa fa-clipboard"></i>
                    <span class="title">Noticeboard</span>
                    <?php if($current_page == base_url('manager/noticeboard_posts')){ echo $selected;}?>
                    <span class="arrow <?php if($current_page == base_url('manager/noticeboard_posts')){ echo $arrow;}?>"></span>
                </a>
            </li>
            
            <li class="nav-item <?php if($current_page == base_url('manager/announcement')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/announcement" class="nav-link nav-toggle">
                    <i class="fa fa-volume-up"></i>
                    <span class="title">Announcement</span>
                    <?php if($current_page == base_url('manager/announcement')){ echo $selected;}?>								
                    <span class="arrow <?php if($current_page == base_url('manager/announcement')){ echo $arrow;}?>"></span>
                </a>
            </li>
            
            <?php if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "incident")==1){?>
            <li class="nav-item <?php if($current_page == base_url('manager/incidents')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/incidents" class="nav-link nav-toggle">
                    <i class="fa fa-image"></i>
                    <span class="title">Incidents Reports</span>
                    <?php if($current_page == base_url('manager/incidents')){ echo $selected;}?>								
                    <span class="arrow <?php if($current_page == base_url('manager/incidents')){ echo $arrow;}?>"></span>
                </a>
            </li>
            <?php }?>
         
            <?php if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "useful_links")==1){?>
            <li class="nav-item <?php if($current_page == base_url('manager/useful_contacts')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/useful_contacts" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">Useful Contacts</span>
                    <?php if($current_page == base_url('manager/useful_contacts')){ echo $selected;}?>								
                    <span class="arrow <?php if($current_page == base_url('manager/useful_contacts')){ echo $arrow;}?>"></span>
                </a>
            </li>
            <?php }?>
            <?php if($this->General_model->get_data_value_using_where("condo_modules","condo_id=$this->condo_id", "house_rules_froms")==1){?>
            <li class="nav-item <?php if($current_page == base_url('manager/knowledge_base')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/knowledge_base" class="nav-link nav-toggle">
                    <i class="fa fa-reorder"></i>
                    <span class="title">House Rules & Forms</span>
                    <?php if($current_page == base_url('manager/knowledge_base')){ echo $selected;}?>								
                    <span class="arrow <?php if($current_page == base_url('manager/knowledge_base')){ echo $arrow;}?>"></span>
                </a>
            </li>
            <?php }?>
            
            <!--<li class="nav-item <?php if($current_page == base_url('manager/modules')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/modules" class="nav-link nav-toggle">
                    <i class="fa fa-image"></i>
                    <span class="title">Modules</span>
                    <?php if($current_page == base_url('manager/modules')){ echo $selected;}?>								
                    <span class="arrow <?php if($current_page == base_url('manager/modules')){ echo $arrow;}?>"></span>
                </a>
            </li>-->
            
            <li class="nav-item  <?php if($current_page == base_url('manager/blacklisted_units')){ echo $active;}?>">
                <a href="<?php echo base_url()?>manager/blacklisted_units" class="nav-link nav-toggle">
                    <i class="fa fa-user-times"></i>
                    <span class="title">Blacklisted Units</span>
                    <?php if($current_page == base_url('manager/blacklisted_units')){ echo $selected;}?>
                    <span class="arrow <?php if($current_page == base_url('manager/blacklisted_units')){ echo $arrow;}?>"></span>
                </a>
            </li>
            
            
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Settings</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php if($current_page == base_url('manager/users')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/users" class="nav-link nav-toggle">
                            <i class="fa fa-user-md"></i>
                            <span class="title">User Management</span>
                            <?php if($current_page == base_url('manager/users')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/users')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($current_page == base_url('manager/condo')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/condo" class="nav-link nav-toggle">
                            <i class="fa fa-recycle"></i>
                            <span class="title">Residence Profile</span>
                            <?php if($current_page == base_url('manager/condo')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/condo')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($current_page == base_url('manager/blocks')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/blocks" class="nav-link nav-toggle">
                            <i class="fa fa-cube"></i>
                            <span class="title">Blocks</span>
                            <?php if($current_page == base_url('manager/blocks')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/blocks')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($current_page == base_url('manager/notification_alert')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/notification_alert" class="nav-link nav-toggle">
                            <i class="fa fa-reorder"></i>
                            <span class="title">Notification Alert</span>
                            <?php if($current_page == base_url('manager/notification_alert')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/notification_alert')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($current_page == base_url('manager/incident_categories')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>manager/incident_categories" class="nav-link nav-toggle">
                            <i class="fa fa-shield"></i>
                            <span class="title">Incident Categories</span>
                            <?php if($current_page == base_url('manager/incident_categories')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('manager/incident_categories')){ echo $arrow;}?>"></span>
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
		<a href="<?php echo base_url()?>manager" class="display-block-inline pull-left logo"><img src="<?php echo base_url()?>assets/admin/images/logo/alia-logo.png" alt=""></a>
		<!--<a href="<?php echo base_url()?>admin/"><span class="text">ALIA</span></a>
	</div>
	

	<ul class="menu list-unstyled" id="navigation_current_page">
            <li <?php if($current_page == base_url('manager/dashboard')){ echo $active;}?>><a href="<?php echo base_url()?>manager/dashboard" class="glyphicons cardio"><i></i><span>Dashboard</span></a></li>
        <li <?php if($current_page == base_url('manager/condos')){ echo $active;}?>><a href="<?php echo base_url()?>manager/condos" class="glyphicons building"><i></i><span>Condos</span></a></li>
         <li <?php if($current_page == base_url('manager/vendors')){ echo $active;}?>><a href="<?php echo base_url()?>manager/vendors" class="glyphicons group"><i></i><span>Vendors</span></a></li>
        
        <li class="hasSubmenu">
            <a href="#settings_tables" data-toggle="collapse"><i class="fa fa-cog"></i> Settings</a>
            <ul class="collapse" id="settings_tables">
            	<li <?php if($current_page == base_url('manager/users')){ echo $active;}?>><a href="<?php echo base_url()?>manager/users" class="glyphicons user"><i></i><span>Users</span></a></li>
                 <li <?php if($current_page == base_url('manager/service_categories')){ echo $active;}?>><a href="<?php echo base_url()?>manager/service_categories" class="glyphicons cardio"><i></i><span>Services Categories</span></a></li>
        		 <li <?php if($current_page == base_url('manager/services')){ echo $active;}?>><a href="<?php echo base_url()?>manager/services" class="glyphicons wrench"><i></i><span>Services</span></a></li>
                 <li <?php if($current_page == base_url('manager/incident_categories')){ echo $active;}?>><a href="<?php echo base_url()?>manager/incident_categories" class="glyphicons cardio"><i></i><span>Incident Categories</span></a></li>

            </ul>
        </li>
	</ul>
</div>
</div>-->