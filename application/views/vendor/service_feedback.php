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
	<link rel="stylesheet" href="<?php echo base_url()?>assets_v1/admin/css/module.admin.stylesheet-complete.sidebar_type.fusion.min.css" />
	
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
		'<?php echo base_url()?>assets_v1/admin/css/components/library/jquery/jquery.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/library/modernizr/modernizr.js?v=v1.9.6&sv=v0.0.1'
		
		
	],

	/* PLUGINS_DEPENDENCY always load after CORE but before PLUGINS; */
	plugins_dependency: [
		'<?php echo base_url()?>assets_v1/admin/css/components/library/bootstrap/js/bootstrap.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/library/jquery/jquery-migrate.min.js?v=v1.9.6&sv=v0.0.1',
		
		
	'<?php echo base_url()?>assets_v1/admin/css/components/plugins/jquery.validate.min.js',
	'<?php echo base_url()?>assets_v1/admin/css/components/plugins/chosen.jquery.min.js',
    '<?php echo base_url()?>assets_v1/admin/css/components/plugins/jquery.multiselect.js',
	],

	/* PLUGINS always load after CORE and PLUGINS_DEPENDENCY, but before the BUNDLE / initialization scripts; */
	plugins: [
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/nicescroll/jquery.nicescroll.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/breakpoints/breakpoints.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/preload/pace/pace.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/less-js/less.min.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/modules/admin/charts/flot/assets/lib/excanvas.js?v=v1.9.6&sv=v0.0.1', 
		'<?php echo base_url()?>assets_v1/admin/css/components/plugins/browser/ie/ie.prototype.polyfill.js?v=v1.9.6&sv=v0.0.1'
	],

	/* The initialization scripts always load last and are automatically and dynamically loaded when AJAX navigation is enabled; */
	bundle: [
		'<?php echo base_url()?>assets_v1/admin/css/components/core/js/preload.pace.init.js?v=v1.9.6', 
		'<?php echo base_url()?>assets_v1/admin/css/components/core/js/core.init.js?v=v1.9.6', 
		'<?php echo base_url()?>assets_v1/admin/css/components/core/js/animations.init.js?v=v1.9.6'
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
                                	<img src="<?php echo base_url()?>assets_v1/admin/images/logo/alia-logo.png" alt="logo">
                                </div>
								<div class="panel panel-default col-sm-6 col-sm-offset-3">
    	
								  <div  class="panel-body">
								 
                                
                                    
				
<style>
.demo-table {width: 100%;border-spacing: initial;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333;}
.demo-table th {background: #999;padding: 5px;text-align: left;color:#FFF;}
.demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
.demo-table td div.feed_title{text-decoration: none;color:#00d4ff;font-weight:bold;}
.demo-table ul{margin:0;padding:0;}
.demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
.demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
</style>
<?php 
$id = $this->uri->segment(3);
$result= $this->General_model->get_data_all_like_using_where("service_requests"," id=".$this->encrypt_model->decode($id));?>
<table class="demo-table">
<tbody>
<tr>
<th><strong>Feeback</strong></th>
</tr>
<?php
if(!empty($result)) {
$i=0;
foreach ($result as $tutorial) {
?>
<tr>
<td valign="top">
<div id="tutorial-<?php echo $tutorial["id"]; ?>">
<input type="hidden" name="rating" id="rating" value="<?php echo $tutorial["rating"]; ?>" />
<ul onMouseOut="resetRating(<?php echo $tutorial["id"]; ?>);">
  <?php
  for($i=1;$i<=5;$i++) {
  $selected = "";
  if(!empty($tutorial["rating"]) && $i<=$tutorial["rating"]) {
	$selected = "selected";
  }
  ?>
  <li class='<?php echo $selected; ?>' onMouseOver="highlightStar(this,<?php echo $tutorial["id"]; ?>);" onMouseOut="removeHighlight(<?php echo $tutorial["id"]; ?>);" onClick="addRating(this,<?php echo $tutorial["id"]; ?>);">&#9733;</li>  
  <?php }  ?>
<ul>
</div>
</td>
</tr>
<?php		
}
?>
<tr><td>
<textarea class="form-control" placeholder="Feedback" name="feedback" id="feedback"><?php echo $tutorial["feedback"]; ?></textarea>
</td></tr>
<tr>
    <td>
        <a href="javascript:;" class="btn btn-primary" onClick="addRating_feeback(<?php echo $tutorial["id"]; ?>);">Submit Feedback</a>
    </td>
</tr>
<?php
}
?>
</tbody>
</table>
<div class="show_message">
</div>


                                                                      
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
		commonPath = '<?php echo base_url()?>assets_v1/',
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