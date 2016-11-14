<?php $current_page = base_url(uri_string());
	  $active = 'start active open';
	  $selected = '<span class="selected"></span>';
	  $arrow = 'open';

?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " 
        data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item <?php if($current_page == base_url('security/dashboard')){ echo $active;}?>">
                <a href="<?php echo base_url()?>security/dashboard" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                     <?php if($current_page == base_url('security/dashboard')){ echo $selected;}?>	
                     <span class="arrow <?php if($current_page == base_url('security/dashboard')){ echo $arrow;}?>"></span>
                </a>
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