<style>
	.row.static-info .col-md-10.value
	{
		padding-left:0px;
	}
	.row.static-info .col-md-2.name i
	{
		color:#008F45;
	}
	.row.static-info .col-md-2.name i {
    background: #008f45 none repeat scroll 0 0;
    border-radius: 35px;
    color: #fff;
    font-size: 20px;
    height: 45px;
    line-height: 45px;
    text-align: center;
    width: 45px;
}
.row.static-info .col-md-10.value {
    padding-left: 13px;
    padding-top: 13px;
}
.portlet-body .row .col-md-6 .portlet .portlet-body::before {
    background: rgba(255, 255, 255, 0.9) none repeat scroll 0 0;
    content: "";
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
}

.portlet-body .row .col-md-6 .portlet .portlet-body::before {
    background: rgba(255, 255, 255, 0.95) none repeat scroll 0 0;
    content: "";
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
}
*, *::after, *::before {
    box-sizing: border-box;
}
*, *::after, *::before {
    box-sizing: border-box;
}
.portlet.box > .portlet-body {
    background-color: #fff;
    padding: 15px;
}
.portlet > .portlet-body {
    border-radius: 0 0 4px 4px;
}
.chart-tooltip, .chart-tooltip .label, .chat-form-custom, .dashboard-stat .more, .dashboard-stat2 .progress-info, .dashboard-stat2 .progress-info .progress, .dashboard-stat::after, .dropdown-menu-v2 > li > a, .dropdown-menu > li > a, .feeds li .col1, .feeds li::after, .form .form-actions::after, .general-item-list > .item > .item-head::after, .mt-comments .mt-comment .mt-comment-body .mt-comment-info::after, .mt-widget-2 .mt-body .mt-body-stats::after, .portlet-form .form-actions::after, .portlet > .portlet-body, .portlet > .portlet-title::after, .social-icons::after, .tabbable::after, .table-toolbar::after, .tasks-widget .task-footer::after, .tasks-widget::after, .tiles .tile .tile-object::after, .tiles::after, .timeline .timeline-body::after, .widget-news .widget-news-right-body .widget-news-right-body-title {
    clear: both;
}
.portlet-body .row .col-md-6 .portlet .portlet-body {
    background: rgba(0, 0, 0, 0) url("http://www.avis.sk/upload/apple-keyboard.jpg") repeat scroll left top / 113% auto;
    position: relative;
}
</style>
<div class="page-content-wrapper">
  <div class="page-head">
      <div class="container">
          <!-- BEGIN PAGE TITLE -->
          <div class="page-title">
              <h1>
              <?php if(isset($page_title)){ echo $page_title;}?>      
              </h1>
          </div>
          <!-- END PAGE TITLE -->
      </div>
  </div>
  <div class="page-content">
      <div class="container">
      	<div class="page-content-inner">
          <div class="left-post">
          	<div class="portlet light" style="padding-top:20px;">
              <div class="portlet-body form">
            <div class="row updates_services_requests">
            <?php
            if(sizeof($useful_contacts)>0)
            {
              $i=1;
                foreach($useful_contacts as $useful_contact)
                {
                ?>
                    <div class="col-md-6">
                        
                        <div class="portlet yellow-crusta box">
                            <div class="portlet-title">
                                <div class="caption">
                                    <!--<i class="fa fa-book"></i>--><?php echo $useful_contact['name'];?> </div>
                                
                            </div>
                            <div class="portlet-body">
                                <div class="scroller" style="height:280px" data-rail-visible="1" data-rail-color="#16A246" data-handle-color="#16A246">
                                
                                 <?php if($useful_contact['address']!=''){?>
                                    <div class="row static-info">
                                        <div class="col-md-2 name"> <i class="fa fa-street-view"></i> </div>
                                        <div class="col-md-10 value"> <?php echo $useful_contact['address'];?></div>
                                    </div>
                                <?php } ?>
                                
                                <?php if($useful_contact['phone']!=''){?>
                                    <div class="row static-info">
                                        <div class="col-md-2 name"> <i class="fa fa-phone"></i> </div>
                                        <div class="col-md-10 value"> <?php echo $useful_contact['phone'];?></div>
                                    </div>
                                <?php } ?>
                                
                                <?php if($useful_contact['mobile']!=''){?>
                                    <div class="row static-info">
                                        <div class="col-md-2 name"> <i class="fa fa-mobile"></i> </div>
                                        <div class="col-md-10 value"> <?php echo $useful_contact['mobile'];?></div>
                                    </div>
                                <?php } ?>
      
                                <?php if($useful_contact['email']!=''){?>
                                    <div class="row static-info">
                                        <div class="col-md-2 name"> <i class="fa fa-envelope"></i> </div>
                                        <div class="col-md-10 value"> <?php echo $useful_contact['email'];?></div>
                                    </div>
                                <?php } ?>
                                
                                <?php if($useful_contact['website']!=''){?>
                                    <div class="row static-info">
                                        <div class="col-md-2 name"> <i class="fa fa-laptop"></i> </div>
                                        <div class="col-md-10 value"> <?php echo $useful_contact['website'];?></div>
                                    </div>
                                <?php } ?>
      
                               
                                
                                </div>
                            </div>
                        
                    </div>
      </div>
                <?php                        
                $i++;
				$msg_id=$useful_contact['id'];
                }
				?>
                
                    <div id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests ">
                        <a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" 
                        class="more_services_requests btn btn-primary">Show more</a>
                    </div>
                
                <?php
              } 
              else 
              {
                ?>
                <div class="note note-success">
                    <h4 class="block"><i class="fa fa-info-circle"></i> Information</h4>
                    <p> No useful contacts at the moment. </p>
                </div>
                <?php
              }
          ?>     
          
           
                         
        </div>
          </div>
          
      </div>
      <?php
	  echo $this->load->view('template/feature_ad');
	  ?>
      </div>
      <?php echo $this->load->view('template/sidebar');?> 
    </div>
  </div>
  </div>
  </div>
<script>
function more_rows_services_requests(ID) 
{
	if(ID)
	{
		$("#more_services_requests"+ID).html('<img src="<?php echo base_url()?>assets/admin/images/loading.gif" width="32" height="32"/>');
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>home/useful_contacts_viewajax",
			data: "lastmsg="+ ID, 
			cache: false,
			success: function(html){
			$(".updates_services_requests").append(html);
			$("#more_services_requests"+ID).remove(); // removing old more button
			}
		});
	}
	else
	{
	$(".morebox_services_requests").html('No more quotes');// no results
	}
	return false;
}
</script>