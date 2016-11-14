<?php 
	  $current_page = base_url(uri_string());
	  $active = 'start active open';
	  $selected = '<span class="selected"></span>';
	  $arrow = 'open';
?>
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" 
        data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item <?php if($current_page == base_url('vendor/dashboard')){ echo $active;}?>">
                <a href="<?php echo base_url()?>vendor/dashboard" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                     <?php if($current_page == base_url('vendor/dashboard')){ echo $selected;}?>	
                     <span class="arrow <?php if($current_page == base_url('vendor/dashboard')){ echo $arrow;}?>"></span>
                </a>
                
            </li>
         <li class="nav-item <?php if($current_page == base_url('vendor/vendor_quotes')){ echo $active;}?>">
                <a href="<?php echo base_url()?>vendor/vendor_quotes" class="nav-link nav-toggle">
                    <i class="fa fa-file-pdf-o"></i>
                    <span class="title">My Quotes</span>
                    <?php if($current_page == base_url('vendor/vendor_quotes')){ echo $selected;}?>								
                    <span class="arrow <?php if($current_page == base_url('vendor/vendor_quotes')){ echo $arrow;}?>"></span>
                </a>
                
            </li>
            
            <li class="nav-item <?php if($current_page == base_url('vendor/profile')){ echo $active;}?>">
                <a href="<?php echo base_url()?>vendor/profile" class="nav-link nav-toggle">
                    <i class="fa fa-user"></i>
                    <span class="title">Profile</span>
                    <?php if($current_page == base_url('vendor/profile')){ echo $selected;}?>								
                    <span class="arrow <?php if($current_page == base_url('vendor/profile')){ echo $arrow;}?>"></span>
                </a>
            </li>
            
            <li class="nav-item <?php if($current_page == base_url('vendor/do_logout')){ echo $active;}?>">
                <a href="<?php echo base_url()?>vendor/do_logout" class="nav-link nav-toggle">
                    <i class="icon-logout"></i>
                    <span class="title">Log out</span>
                    <?php if($current_page == base_url('vendor/do_logout')){ echo $selected;}?>								
                    <span class="arrow <?php if($current_page == base_url('vendor/do_logout')){ echo $arrow;}?>"></span>
                </a>
            </li>

            <?php /*?><li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Settings</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php if($current_page == base_url('vendor/services')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>vendor/services" class="nav-link nav-toggle">
                            <i class="fa fa-building"></i>
                            <span class="title">Services</span>
                            <?php if($current_page == base_url('vendor/services')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('vendor/services')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php if($current_page == base_url('vendor/condominiums')){ echo $active;}?>">
                        <a href="<?php echo base_url()?>vendor/condominiums" class="nav-link nav-toggle">
                            <i class="fa fa-building"></i>
                            <span class="title">Condominiums</span>
                            <?php if($current_page == base_url('vendor/condominiums')){ echo $selected;}?>								
                            <span class="arrow <?php if($current_page == base_url('vendor/condominiums')){ echo $arrow;}?>"></span>
                        </a>
                    </li>
                </ul>
            </li><?php */?>
            </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>