<!DOCTYPE html>
<!--[if lt IE 7]> <html class="ie lt-ie9 lt-ie8 lt-ie7 app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if IE 7]>    <html class="ie lt-ie9 lt-ie8 app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if IE 8]>    <html class="ie lt-ie9 app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if gt IE 8]> <html class="ie app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"> <![endif]-->
<!--[if !IE]><!--><html class="app sidebar sidebar-fusion sidebar-kis footer-sticky navbar-sticky"><!-- <![endif]-->
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
	<link rel="stylesheet" href="<?php echo base_url()?>assets_v1/admin/css/module.admin.stylesheet-complete.sidebar_type.fusion.min.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets_v1/admin/css/components/custom.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets_v1/admin/css/components/responsive.bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets_v1/admin/css/components/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url()?>assets_v1/admin/css/components/jquery.dataTables.min.css" />
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

	<script src="<?php echo base_url()?>assets_v1/admin/css/components/plugins/ajaxify/script.min.js?v=v1.9.6&sv=v0.0.1"></script>

<script>var App = {};</script>

<script data-id="App.Scripts">
App.Scripts = {

	/* CORE scripts always load first; */
	core: [
		/*'<?php echo base_url()?>assets_v1/admin/css/components/library/jquery/jquery.min.js?v=v1.9.6&sv=v0.0.1', */
		'<?php echo base_url()?>assets_v1/admin/css/components/library/jquery/jquery-1.12.0.min.js',
		'<?php echo base_url()?>assets_v1/admin/css/components/library/modernizr/modernizr.js?v=v1.9.6&sv=v0.0.1'
	],

	/* PLUGINS_DEPENDENCY always load after CORE but before PLUGINS; */
	plugins_dependency: [
		'<?php echo base_url()?>assets_v1/admin/css/components/library/bootstrap/js/bootstrap.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/library/jquery/jquery-migrate.min.js?v=v1.9.6&sv=v0.0.1',
		'<?php echo base_url()?>assets_v1/admin/css/components/common/tables/datatables/assets/lib/js/jquery.dataTables.min.js?v=v1.9.6&sv=v0.0.1',
		'<?php echo base_url()?>assets_v1/admin/css/components/common/tables/datatables/assets/lib/js/dataTables.bootstrap.min.js',
	'<?php echo base_url()?>assets_v1/admin/css/components/plugins/jquery.validate.min.js',
	'<?php echo base_url()?>assets_v1/admin/css/components/plugins/chosen.jquery.min.js',
	],

	/* PLUGINS always load after CORE and PLUGINS_DEPENDENCY, but before the BUNDLE / initialization scripts; */
	plugins: [
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/nicescroll/jquery.nicescroll.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/breakpoints/breakpoints.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/ajaxify/davis.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/ajaxify/jquery.lazyjaxdavis.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/preload/pace/pace.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/common/gallery/blueimp-gallery/assets/lib/js/blueimp-gallery.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/common/gallery/blueimp-gallery/assets/lib/js/jquery.blueimp-gallery.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/common/forms/elements/bootstrap-select/assets/lib/js/bootstrap-select.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/modules/admin/charts/easy-pie/assets/lib/js/jquery.easy-pie-chart.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/less-js/less.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/common/tables/responsive/assets/lib/js/footable.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/modules/admin/charts/flot/assets/lib/excanvas.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/browser/ie/ie.prototype.polyfill.js?v=v1.9.6&sv=v0.0.1',
		/*'<?php echo base_url()?>assets_v1/admin/css/components/modules/admin/tables/datatables/assets/lib/extras/ColVis/media/js/ColVis.min.js?v=v1.9.6', */
		
		'<?php echo base_url()?>assets_v1/admin/css/components/common/tables/datatables/assets/lib/js/responsive.bootstrap.min.js',
		'<?php echo base_url()?>assets_v1/admin/css/components/common/tables/datatables/assets/lib/js/dataTables.responsive.min.js', 
	],

	/* The initialization scripts always load last and are automatically and dynamically loaded when AJAX navigation is enabled; */
	bundle: [
		

		'<?php echo base_url()?>assets_v1/admin/css/components/core/js/sidebar.main.init.js?v=v1.9.6', 
		'<?php echo base_url()?>assets_v1/admin/css/components/core/js/sidebar.collapse.init.js?v=v1.9.6', 
		'<?php echo base_url()?>assets_v1/admin/css/components/common/tables/datatables/assets/custom/js/datatables.init2.js?v=v1.9.6&sv=v0.0.1',
		'<?php echo base_url()?>assets_v1/admin/css/components/common/tables/responsive/assets/custom/js/tables-responsive-footable.init.js?v=v1.9.6&sv=v0.0.1',
		'<?php echo base_url()?>assets_v1/admin/css/components/common/forms/elements/bootstrap-select/assets/custom/js/bootstrap-select.init.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/core/js/sidebar.kis.init.js?v=v1.9.6', 
		'<?php echo base_url()?>assets_v1/admin/css/components/modules/admin/charts/easy-pie/assets/custom/easy-pie.init.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/core/js/core.init.js?v=v1.9.6', 
		'<?php echo base_url()?>assets_v1/admin/css/components/core/js/animations.init.js?v=v1.9.6', 
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/image-preview/image-preview.js?v=v1.9.6&sv=v0.0.1'
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
<body class="scripts-async menu-right-hidden">
	
	<!-- Main Container Fluid -->
	<div class="container-fluid menu-hidden">

				<!-- Main Sidebar Menu -->
		<?php $this->load->view('vendor/template/sidebar');?>
		
				
		<!-- Content -->
		<div id="content">

			<?php $this->load->view('vendor/template/header');?>

				<div class="layout-app">
					<?php $this->load->view($view);?>
				</div>
		</div>
		<!-- // Content END -->
		
		<div class="clearfix"></div>
		<!-- // Sidebar menu & content wrapper END -->
		
		<!-- Footer -->
		<?php $this->load->view('vendor/template/footer');?>
		<!-- // Footer END -->
	</div>
	<!-- // Main Container Fluid END -->
	

	<!-- Global -->
	<script data-id="App.Config">
	var basePath = '',
		commonPath = '<?php echo base_url()?>assets_v1/admin/',
		rootPath = '<?php echo base_url()?>',
		DEV = false,
		componentsPath = '<?php echo base_url()?>assets_v1/admin/css/components/',
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
	
     <?php $this->load->view('vendor/template/js_functions');?>
  
</body>
</html>