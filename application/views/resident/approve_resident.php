<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 app footer-sticky"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 app footer-sticky"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 app footer-sticky"> <![endif]-->
<!--[if gt IE 8]> <html class="ie app footer-sticky"> <![endif]-->
<!--[if !IE]><!--><html class="app footer-sticky"><!-- <![endif]-->
<head>
	<title><?php echo $title;?></title>
	
	<!-- Meta -->
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	
	<!-- 
	**********************************************************
	In development, use the LESS files and the less.js compiler
	instead of the minified CSS loaded by default.
	**********************************************************
	<link rel="stylesheet/less" href="../assets/less/admin/module.admin.stylesheet-complete.sidebar_type.fusion.less" />
	-->

		<!--[if lt IE 9]><link rel="stylesheet" href="../assets/components/library/bootstrap/css/bootstrap.min.css" /><![endif]-->
	<link rel="stylesheet" href="<?php echo base_url()?>assets/admin/css/module.admin.stylesheet-complete.sidebar_type.fusion.min.css" />
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

	<script src="<?php echo base_url()?>assets/admin/css/components/plugins/ajaxify/script.min.js?v=v1.9.6&sv=v0.0.1"></script>
    
<script>var App = {};</script>

<script data-id="App.Scripts">
App.Scripts = {

	/* CORE scripts always load first; */
	core: [
		'<?php echo base_url()?>assets/admin/css/components/library/jquery/jquery.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets/admin/css/components/library/modernizr/modernizr.js?v=v1.9.6&sv=v0.0.1'
		
		
	],

	/* PLUGINS_DEPENDENCY always load after CORE but before PLUGINS; */
	plugins_dependency: [
		'<?php echo base_url()?>assets/admin/css/components/library/bootstrap/js/bootstrap.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets/admin/css/components/library/jquery/jquery-migrate.min.js?v=v1.9.6&sv=v0.0.1',
		
	],

	/* PLUGINS always load after CORE and PLUGINS_DEPENDENCY, but before the BUNDLE / initialization scripts; */
	plugins: [
		'<?php echo base_url()?>assets/admin/css/components/plugins/nicescroll/jquery.nicescroll.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets/admin/css/components/plugins/breakpoints/breakpoints.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets/admin/css/components/plugins/preload/pace/pace.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets/admin/css/components/plugins/less-js/less.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets/admin/css/components/modules/admin/charts/flot/assets/lib/excanvas.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets/admin/css/components/plugins/browser/ie/ie.prototype.polyfill.js?v=v1.9.6&sv=v0.0.1'
	],

	/* The initialization scripts always load last and are automatically and dynamically loaded when AJAX navigation is enabled; */
	bundle: [
		'<?php echo base_url()?>assets/admin/css/components/core/js/preload.pace.init.js?v=v1.9.6', 
		'<?php echo base_url()?>assets/admin/css/components/core/js/core.init.js?v=v1.9.6', 
		'<?php echo base_url()?>assets/admin/css/components/core/js/animations.init.js?v=v1.9.6'
	]

};
</script>

<script>
$script(App.Scripts.core, 'core');

$script.ready(['core'], function(){
	$script(App.Scripts.plugins_dependency, 'plugins_dependency');
});
$script.ready(['core', 'plugins_dependency'], function(){
	$script(App.Scripts.plugins, 'plugins');
});
$script.ready(['core', 'plugins_dependency', 'plugins'], function(){
	$script(App.Scripts.bundle, 'bundle');
});
</script>
	<script>if (/*@cc_on!@*/false && document.documentMode === 10) { document.documentElement.className+=' ie ie10'; }</script>
   
</head>
<body class="scripts-async loginWrapper">
	
	<!-- Main Container Fluid -->
	<div class="container-fluid menu-hidden">

		
				
		<!-- Content -->
		<div id="content">

			
			


			<div class="layout-app login-page">

			<!-- row-app -->
<div class="row row-app">

	<!-- col -->
	

		<!-- col-separator.box -->
		<div class="col-separator col-unscrollable box">
			
			<!-- col-table -->
			<div class="col-table">
				
				<!--<h4 class="innerAll margin-none border-bottom text-center"> Alpha Admin Panel </h4>-->

				<!-- col-table-row -->
				<div class="col-table-row">

					<!-- col-app -->
					<div class="col-app col-unscrollable">

						<!-- col-app -->
						<div class="col-app">
							<div  class="login">
								<div class="col-sm-4 col-sm-offset-4 text-center">
                                	<img src="<?php echo base_url()?>assets/admin/images/logo/alia-logo.png" alt="logo">
                                </div>
								<div class="panel panel-default col-sm-6 col-sm-offset-3">
    	
								  <div  class="panel-body">
								 
                                    <?php if(isset($message) && $message == 'Email Approve'){?>
                                    <div class="alert alert-success">
                                       <?php echo $message;?>
                                    </div>
                                    
				
								  	
                                
                                 <?php
									 } else {
										 ?>
                                          <div class="alert alert-warning">
											   <?php echo $message;?>
                                            </div>  
                                         <?php
										 
									 }
								 ?>
								  
								
                
								 <a href="<?php echo base_url();?>manager" class="btn btn-info">Retrun</a>
								  </div>
								
								
								</div>
								
								<div class="clearfix"></div>
							
							</div>




						</div>
						<!-- // END col-app -->

					</div>
					<!-- // END col-app.col-unscrollable -->

				</div>
				<!-- // END col-table-row -->
				<h4 class="login-copy">
                	&copy; 2016 - ALIA - All Rights Reserved
                </h4>
			</div>
			<!-- // END col-table -->
			
		</div>
		<!-- // END col-separator.box -->


</div>
<!-- // END row-app -->

		

	<!-- Global -->
	<script data-id="App.Config">
	var basePath = '',
		commonPath = '<?php echo base_url()?>assets/',
		rootPath = '<?php echo base_url()?>',
		DEV = false,
		componentsPath = '<?php echo base_url()?>assets/admin/css/components/',
		layoutApp = true,
		module = 'admin';
	
	var primaryColor = '#eb6a5a',
		dangerColor = '#b55151',
		successColor = '#609450',
		infoColor = '#4a8bc2',
		warningColor = '#ab7a4b',
		inverseColor = '#45484d';
	
	var themerPrimaryColor = primaryColor;
	</script>
	
	 <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	 <script src="<?php echo base_url()?>assets/admin/css/components/plugins/jquery.validate.min.js"  type="text/javascript"></script>
	<?php $this->load->view('manager/template/js_functions');?>
</body>
</html>