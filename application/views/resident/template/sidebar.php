<div id="menu" class="hidden-print hidden-xs sidebar-blue sidebar-brand-primary">

			
<div id="sidebar-fusion-wrapper">
	<div id="brandWrapper">
		<a href="<?php echo base_url()?>resident" class="display-block-inline pull-left logo"><img src="<?php echo base_url()?>assets/admin/images/logo/alia-logo.png" alt=""></a>
		<!--<a href="<?php echo base_url()?>admin/"><span class="text">ALIA</span></a>-->
	</div>
	

	<ul class="menu list-unstyled" id="navigation_current_page">
    <?php $current_page = base_url(uri_string());
			 $active = 'class = active';
			 ?>
        <li <?php if($current_page == base_url('resident/dashboard')){ echo $active;}?>><a href="<?php echo base_url()?>resident/dashboard" class="glyphicons cardio"><i></i><span>Dashboard</span></a></li>
        

	</ul>
</div>
</div>