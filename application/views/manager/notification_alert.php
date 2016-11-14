<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"><?php echo $title;?>
      <small></small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>manager">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span><?php echo $title;?></span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
		<?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-info" > 
                <?= $this->session->flashdata('message') ?> 
            </div>
        <?php } ?>
		<!-- Tabs -->
        <div class="relativeWrap" >
            <div class="box-generic">
            
                <!-- Tabs Heading -->
                <div class="tabsbar">
                    <ul>
                        <li class="glyphicons camera active"><a href="#tab1-3" data-toggle="tab"><i></i>Notification Alert<strong></strong></a></li>
                        <li class="glyphicons folder_open"><a href="#tab2-3" data-toggle="tab"><i></i> Delivery Timings <strong></strong></a></li>
                    </ul>
                </div>
                <!-- // Tabs Heading END -->
                
                <div class="tab-content">
                        
                    <!-- Tab content -->
                    <div class="tab-pane active" id="tab1-3">
                        <h4>Notification Alert</h4>
                        <?php $not=$this->General_model->get_value_by_id('condo_admins',  $this->session->userdata('manager_id'), 'notification_alert');?>
        <form id="notification-alert-form" class="form-horizontal" role="form" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="col-sm-2 control-label">Notification Alert</label>
                <div class="col-sm-10">
                    <select class="form-control" id="notification_alert" name="notification_alert" >
                        <option value="1" <?php if($not==1){ echo "selected";}?>>Email</option>
                        <option value="2" <?php if($not==2){ echo "selected";}?>>SMS</option>
                    </select>
                    <span class="error_individual" id="notification_alert_validate"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="hidden" id="table" name="table" value="admin">
                    <button type="submit" id="add_notification_alert_btn" name="add_notification_alert_btn" class="btn btn-primary">Add Notification Alert</button>
                </div>
            </div>
        </form>
                    </div>
                    <!-- // Tab content END -->
                    
                    <!-- Tab content -->
                    <div class="tab-pane" id="tab2-3">
                        <h4>Delivery Timings </h4>
                        <div class="widget">
        
                                            <div class="widget-head">
        
                                                <h4 class="heading">Time Pickers</h4>
        
                                            </div>
        
                                            <div class="widget-body padding-none">
                                                <div class="row row-merge">
                                                <?php $delivery_time_starts=$this->General_model->get_value_by_id('condo_admins',  $this->session->userdata('manager_id'), 'delivery_time_starts');
                                                $hour = substr($delivery_time_starts,0,2);
                                                if($hour>12)
                                                {
                                                    $hour = $hour-12;
                                                    $time_starts = "$hour:".substr($delivery_time_starts,3,2)." PM";
                                                }
                                                else
                                                {
                                                    $time_starts = "$hour:".substr($delivery_time_starts,3,2)." AM";
                                                }
                                                $delivery_time_ends=$this->General_model->get_value_by_id('condo_admins',  $this->session->userdata('manager_id'), 'delivery_time_ends');
                                                $hour = substr($delivery_time_ends,0,2);
                                                if($hour>12)
                                                {
                                                    $hour = $hour-12;
                                                    $time_ends = "$hour:".substr($delivery_time_ends,3,2)." PM";
                                                }
                                                else
                                                {
                                                    $time_ends = "$hour:".substr($delivery_time_ends,3,2)." AM";
                                                }
                                                
                                                ?>
                                                <form method="post" id="delivery_time_form">
                                                    <div class="col-md-6">
                                                        <div class="innerAll">
                                                            <p>From:</p>
                                                            <div class="input-group bootstrap-timepicker">
                                                                <input id="timepicker1" name="delivery_time_starts" value="<?php echo $time_starts;?>" type="text" class="form-control">
                                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="innerAll">
                                                            <p>To:</p>
                                                            <div class="input-group bootstrap-timepicker">
                                                                <input id="timepicker2" name="delivery_time_ends" value="<?php echo $time_ends;?>"  type="text" class="form-control">
                                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            </div>
                                                            <div class="separator bottom"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="innerAll">
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-8 col-sm-12">
                                                                    <button type="submit" id="add_delivery_time_btn" name="add_delivery_time_btn" class="btn btn-primary">Add Delivery Time</button>
                                                                </div>
                                                            </div>
                                                            <div class="separator bottom"></div>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
      	<!-- // Tabs END -->
       </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>
<style>

}.tabsbar {
    height: 62px;
    border: 1px solid #efefef;
    position: relative;
    overflow: hidden;
    margin: 0 0 10px;
}
.tabsbar ul {
    list-style: none;
    margin: 0;
    padding: 0;
    height: 60px;
}
.tabsbar ul li {
    float: left;
    display: block;
    height: 60px;
    border-right: 1px solid #efefef;
    background: #fdfdfd;
    padding: 3px;
}
.tabsbar ul li.glyphicons a i {
    display: inline-block;
    float: left;
    width: 39px;
    height: 54px;
}
.tabsbar ul li.glyphicons a i:before {
    color: #525252;
    position: relative;
    top: auto;
    left: auto;
    line-height: 54px;
    text-align: center;
}
.tabsbar ul li a {
    display: block;
    height: 54px;
    line-height: 54px;
    background: #fdfdfd;
    padding: 0 15px;
    color: #525252;
    text-decoration: none;
}
.tabsbar ul li a.glyphicons i {
    display: inline-block;
    float: left;
    width: 39px;
    height: 54px;
}
.tabsbar ul li a.glyphicons i:before {
    color: #525252;
    position: relative;
    top: auto;
    left: auto;
    line-height: 54px;
    text-align: center;
}
.tabsbar ul li.active a {
    background: #eb6a5a;
    color: #fff;
}
.tabsbar ul li.active a i:before {
    color: #fff;
}
.tabsbar.tabsbar-2 {
    height: 39px;
}
.tabsbar.tabsbar-2 ul {
    height: 39px;
}
.tabsbar.tabsbar-2 ul li {
    height: 39px;
    padding: 0;
    background: none;
    border: none;
}
.tabsbar.tabsbar-2 ul li.glyphicons a i {
    height: 39px;
    width: 33px;
    top: 0;
}
.tabsbar.tabsbar-2 ul li.glyphicons a i:before {
    line-height: 39px;
    font-size: 20px;
}
.tabsbar.tabsbar-2 ul li a {
    height: 39px;
    line-height: 39px;
    background: none;
}
.tabsbar.tabsbar-2 ul li a i {
    vertical-align: middle;
    position: relative;
    top: -2px;
    font-size: 20px;
}
.tabsbar.tabsbar-2 ul li a.glyphicons i {
    height: 39px;
    width: 33px;
    top: 0;
}
.tabsbar.tabsbar-2 ul li a.glyphicons i:before {
    line-height: 39px;
    font-size: 20px;
}
.tabsbar.tabsbar-2 ul li.active {
    background: #eb6a5a;
}
.tabsbar.tabsbar-2 ul li.active a {
    color: #fff;
    font-weight: 600;
}
.tabsbar.tabsbar-2 ul li.active a i:before {
    color: #fff;
}
.tabsbar.tabsbar-2 ul li:not(.active):hover a {
    color: #eb6a5a;
}
.tabsbar.tabsbar-2 ul li:not(.active):hover a i:before {
    color: #eb6a5a;
}
.tabsbar.tabsbar-2.active-fill ul li.active a {
    background: #eb6a5a;
    color: #fff;
}
.tabsbar.tabsbar-2.active-fill ul li.active a i:before {
    color: #fff;
}
@media (max-width:991px) {
    .tabsbar, .tabsbar.tabsbar-2 {
    height: auto;
}
.tabsbar ul, .tabsbar.tabsbar-2 ul {
    height: auto;
}
.tabsbar ul li, .tabsbar.tabsbar-2 ul li {
    display: block;
    float: none;
    border-right: none;
    border-bottom: 1px solid #efefef;
}
.tabsbar ul li:last-of-type, .tabsbar.tabsbar-2 ul li:last-of-type {
    border-bottom: none;
}
.tabsbar ul li:after, .tabsbar.tabsbar-2 ul li:after {
    display: none;
}
.box-generic {
    border: 1px solid #efefef;
    padding: 10px;
    position: relative;
    background: #fff;
    -webkit-border-radius: 5px 5px 5px 5px;
    -moz-border-radius: 5px 5px 5px 5px;
    border-radius: 5px 5px 5px 5px;
    margin: 0 0 10px;
}
.tab-content {
    overflow: visible;
    padding: 0;
}
.widget .tab-content {
    padding: 0;
}
</style>