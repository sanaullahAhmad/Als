<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>
                    <?php if(isset($title)){ echo $title;}?>                                
                </h1>
            </div>
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE CONTENT BODY -->
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="page-content-inner">
                    <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-info"> 
                            <?= $this->session->flashdata('message') ?> 
                        </div>
                    <?php } ?>
        <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- END PAGE TITLE-->
        <!-- END PAGE HEADER-->
        <div class="search-page search-content-4">
            <div class="search-table table-responsive">
            <div class="row">
            	<div class="col-md-12">
                	<div style="float:left; margin-right:20px;"><strong>Booking Status: </strong></div>
                    <div class="calender_legends" style="background:#378006"></div>
                	<div style="float:left;">Booked</div>
                                        <div class="calender_legends" style="margin-left:20px;"></div>On Hold

                </div>
            	<div class="col-md-12">
                	<div id='calendar'></div>
                </div>
            </div>
                <style>
				.calender_legends{
					width: 30px;
					height: 25px;
					background: #FF1493;
					border-radius: 5px;
					border-radius: 5px;
					float: left;
					color: #fff;
					text-align: center;
					margin: 0 10px 10px 5px;
					display: inline-block;
					}
				body {
					margin: 40px 10px;
					padding: 0;
					font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
					font-size: 14px;
				}
				#calendar {
					max-width: 100%;
					margin: 0 auto;
				}
				</style>
                <div style="clear:both; height:50px;"></div>  
                </div>
            </div>
        </div>
    </div>
</div>    