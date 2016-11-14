<!DOCTYPE html>

<html>

    <head>

        <meta charset="UTF-8">

        <title><?php echo $title;?></title>

        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <!-- Ionicons -->

        <link href="//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css" rel="stylesheet" type="text/css" />


        <!-- jvectormap -->

        <link href="<?php echo base_url();?>assets/admin/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- Date Picker -->

        <link href="<?php echo base_url();?>assets/admin/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />

        <!-- Daterange picker -->

        <link href="<?php echo base_url();?>assets/admin/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

        <!-- bootstrap wysihtml5 - text editor -->

        <link href="<?php echo base_url();?>assets/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

         <!-- DATA TABLES -->

        <link href="<?php echo base_url();?>assets/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        
        
                


       <!-- Ion Slider -->
        <link href="<?php echo base_url();?>assets/admin/css/ionslider/ion.rangeSlider.css" rel="stylesheet" type="text/css" />
        <!-- ion slider Nice -->
        <link href="<?php echo base_url();?>assets/admin/css/ionslider/ion.rangeSlider.skinNice.css" rel="stylesheet" type="text/css" />

        <!-- Theme style -->

        <link href="<?php echo base_url();?>assets/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
        <!-- plus a jQuery UI theme, here I use "flick" -->
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.4/themes/flick/jquery-ui.css">

		<link href="<?php echo base_url();?>assets/admin/css/jquery-ui-slider-pips.css" rel="stylesheet" type="text/css" />
        
		<link href="<?php echo base_url();?>assets/admin/css/custom.css" rel="stylesheet" type="text/css" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

        <!--[if lt IE 9]>

          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>

        <![endif]-->

    </head>

    <body class="skin-black">

        <!-- header logo: style can be found in header.less -->

     <?php echo $this->load->view('admin/template/header');?>

     

        <div class="wrapper row-offcanvas row-offcanvas-left">

            <!-- Left side column. contains the logo and sidebar -->

            <?php echo $this->load->view('admin/template/sidebar');?>



            <!-- Right side column. Contains the navbar and content of the page -->

            <aside class="right-side">

           <?php echo $this->load->view($view);?>

            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->



        <!-- add new calendar event modal -->





        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>

        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.min.js" type="text/javascript"></script>

       

       

        <!-- Sparkline -->

        <script src="<?php echo base_url();?>assets/admin/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>

        <!-- jvectormap -->

        <script src="<?php echo base_url();?>assets/admin/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>

        <!-- jQuery Knob Chart -->

        <script src="<?php echo base_url();?>assets/admin/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>

        <!-- daterangepicker -->

        <script src="<?php echo base_url();?>assets/admin/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>

        <!-- datepicker -->

        <script src="<?php echo base_url();?>assets/admin/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

        <!-- Bootstrap WYSIHTML5 -->

        <script src="<?php echo base_url();?>assets/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>

        <!-- iCheck -->

        <script src="<?php echo base_url();?>assets/admin/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

         <!-- DATA TABES SCRIPT -->

        <script src="<?php echo base_url();?>assets/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>

        <script src="<?php echo base_url();?>assets/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

         <!-- Ion Slider -->
    	<script src="<?php echo base_url();?>assets/admin/js/plugins/ionslider/ion.rangeSlider.min.js" type="text/javascript"></script>

  <!-- Datepicker SCRIPT -->

        <script src="<?php echo base_url();?>assets/admin/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

        

        <!-- AdminLTE App -->

        <script src="<?php echo base_url();?>assets/admin/js/AdminLTE/app.js" type="text/javascript"></script>
        <script src="<?php echo base_url();?>assets/admin/js/jquery-ui-slider-pips.js" type="text/javascript"></script>



        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

       <!-- <script src="<?php echo base_url();?>assets/js/AdminLTE/dashboard.js" type="text/javascript"></script>-->



        <!-- AdminLTE for demo purposes -->

        <script src="<?php echo base_url();?>assets/admin/js/bpop.js" type="text/javascript"></script>
        
        <script src="<?php echo base_url();?>assets/admin/js/jquery.validate.min.js" type="text/javascript"></script>

        <script type="text/javascript">

            $(function() {

                $("#example1").dataTable({"order": [[ 1, "asc" ]]});

				$("#example3").dataTable({"order": [[ 1, "asc" ]]});

				$("#example_pc").dataTable({"order": [[ 1, "asc" ]]});

                $('#example2').dataTable({"order": [[ 1, "asc" ]]});

				 $("#example4").dataTable({"order": [[ 1, "asc" ]]});

				  $("#example5").dataTable({"order": [[ 1, "asc" ]]});

            });


		
	  
	  /*$(".slider").slider().slider("pips").slider("float");*/
	 	$(".slider")
		  .slider({
			  min: 0, 
			  max: 100,
			  
			  values: [25, 30, 45, 75]
		  })
		  .slider("pips", {
			  step: 5,
			  rest: "label",
			  labels: { first: "0", last: "100" }
		  })
		  .slider("float");
        </script>

        

        <script type="text/javascript">

        $('.datepicker').datepicker({

		format: 'dd-mm-yyyy'

	   });

	    </script>

        
<?php $this->load->view('admin/template/js_functions');?>
       

    </body>

</html>

