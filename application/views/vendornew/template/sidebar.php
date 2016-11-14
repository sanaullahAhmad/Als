<div id="menu" class="hidden-print hidden-xs sidebar-blue sidebar-brand-primary">

			
<div id="sidebar-fusion-wrapper">
	<div id="brandWrapper">
		<a href="<?php echo base_url()?>manager" class="display-block-inline pull-left logo"><img src="<?php echo base_url()?>assets/admin/images/logo/alia-logo.png" alt=""></a>
		<!--<a href="<?php echo base_url()?>admin/"><span class="text">ALIA</span></a>-->
	</div>
	

	<ul class="menu list-unstyled" id="navigation_current_page">
    <?php $current_page = base_url(uri_string());
			 $active = 'class = active';
			 ?>
        <li <?php if($current_page == base_url('vendor/dashboard')){ echo $active;}?>><a href="<?php echo base_url()?>vendor/dashboard" class="glyphicons cardio"><i></i><span>Dashboard</span></a></li>
        <!--<li <?php if($current_page == base_url('vendor/Quotations')){ echo $active;}?>><a href="javascript:;" class="glyphicons parents"><i></i><span>Quotations</span></a></li>-->
        <li <?php if($current_page == base_url('vendor/vendor_quotes')){ echo $active;}?>><a href="<?php echo base_url('vendor/vendor_quotes');?>" class="glyphicons home"><i></i><span>My Quotations</span></a></li>
       
        <li class="hasSubmenu">
            <a href="#settings_tables" data-toggle="collapse"><i class="fa fa-cog"></i> Settings</a>
            <ul class="collapse" id="settings_tables">
            
            	<li <?php if($current_page == base_url('vendor/services')){ echo $active;}?>><a href="<?php echo base_url('vendor/services');?>" class="glyphicons user">
                <i></i><span>Services</span></a></li>
                
                <li <?php if($current_page == base_url('vendor/condominiums')){ echo $active;}?>><a href="<?php echo base_url('vendor/condominiums');?>" class="glyphicons cardio">
                <i></i><span>Condominiums</span></a></li>
        		 
            </ul>
        </li>

	</ul>
</div>
</div>