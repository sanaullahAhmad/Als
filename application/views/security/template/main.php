<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title><?php if(isset($title)){ echo $title;} else{ echo "";}?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?php echo base_url()?>assets/front/global/css/fonts.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?php echo base_url()?>assets/front/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo base_url()?>assets/front/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url()?>assets/front/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?php echo base_url()?>assets/front/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        
       
        
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url()?>assets/front/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url()?>assets/front/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo base_url()?>assets/front/layouts/layout2/css/themes/default.min.css" rel="stylesheet" type="text/css" />
        
        <link href="<?php echo base_url()?>assets/front/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/front/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        

        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="<?php echo base_url()?>assets/front/layouts/layout3/img/alia_favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        <!-- BEGIN HEADER -->
        <?php $this->load->view('security/template/header');?>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
			<?php $this->load->view('security/template/sidebar');?>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <?php echo $this->load->view($view);?>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <?php $this->load->view('security/template/footer');?>
        <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="<?php echo base_url()?>assets/front/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url()?>assets/front/global/plugins/excanvas.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.form.min.js"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/upload_progress.js"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.uploadify.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/front/global/plugins/uploadify.css">
        
        <script type="text/javascript" src="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.js"></script>
        
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.validate.min.js"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.validate.file.js"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/additional-methods.min.js"></script>


        
        <script src="<?php echo base_url()?>assets/front/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo base_url()?>assets/front/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        
        <script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/front/global/scripts/datatable.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>assets/front/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>assets/front/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>assets/front/pages/scripts/table-datatables-responsive.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/front/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
        <script src="<?php echo base_url();?>assets/front/pages/scripts/portfolio-1.min.js" type="text/javascript"></script>
        
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="<?php echo base_url()?>assets/front/global/scripts/app.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url()?>assets/front/pages/scripts/components-bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?php echo base_url()?>assets/front/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets_v1/admin/css/components/common/forms/editors/wysihtml5/assets/lib/js/wysihtml5-0.3.0_rc2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets_v1/admin/css/components/common/forms/editors/wysihtml5/assets/lib/js/bootstrap-wysihtml5-0.0.2.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets_v1/admin/css/components/common/forms/editors/wysihtml5/assets/custom/wysihtml5.init.js?v=v1.9.6" type="text/javascript"></script>
        
        <link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript" ></script>

        <script src="<?php echo base_url();?>/assets/front/global/plugins/ckinplace/ck/ckeditor.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>/assets/front/global/plugins/ckinplace/ck/adapters/jquery.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>/assets/front/global/plugins/ckinplace/ck-in-place.js" type="text/javascript"></script>
        
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js" type="text/javascript" ></script>
      



        <?php $this->load->view('security/template/js_functions');?>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>