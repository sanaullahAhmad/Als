<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/portfolio.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/global/plugins/cubeportfolio/css/cubeportfolio.css" />
<style>
label.error {
    background-color: #fbe1e3;
    border-color: #fbe1e3;
    color: #e73d4a;
    float: right;
    padding: 15px;
    width: 97.2% !important;
}
.modal_button
{
	margin-top:7px;
}
.portfolio-content
{
	padding-top:0px;
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
            <div class="page-title pull-right">
                <?php /*?><a href="<?php echo base_url();?>all_facility_payments" class="btn btn-primary pull-right">Pending Payments</a> <?php */?>
                <a href="<?php echo base_url();?>my_bookings" class="btn btn-primary pull-right">My bookings</a>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
 <div class="page-content">
  <div class="container">
    <div class="page-content-inner">
      <div class="left-post">
		<?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-info"> 
                <?= $this->session->flashdata('message') ?> 
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('message_danger')) { ?>
            <div class="alert alert-danger"> 
                <?= $this->session->flashdata('message_danger') ?> 
            </div>
        <?php } ?>
        <?php
        if(sizeof($facility_categories)>0)
        {
        ?>
        <div class="portfolio-content portfolio-1">
           
            <div class="portlet light updates_services_requests" style="padding-top:20px;">
            <div id="js-grid-juicy-projects" class="cbp ">
		    <?php              foreach($facility_categories as $report){
              if($report['image_url']=='')
              {$src=base_url()."assets/front/global/img/no-image-box.png";}
              else{$src=base_url()."uploads/facilities_images/". $this->General_model->get_thumb_of_image($report['image_url'],'_262_262');}
            ?>
                <div class="cbp-item">
                    <div class="cbp-caption">
                        <div class="<?php if($report['info_only']==0){?>cbp-caption-defaultWrap<?php }?>">
                        <?php if($report['info_only']==0){?>
                        <a href="<?php echo base_url()?>home/facility_booking_form/<?php echo $this->encrypt_model->encode($report['id']);?>"
                         class="cbp-singlePage" rel="nofollow">
						<?php }else{?>
                        <a href="<?php echo base_url();?>infonlycat_facilities/<?php echo $this->encrypt_model->encode($report['id']);?>" 
                        target="_blank">
                        <?php }?>
                            <img src="<?php echo $src;?>" alt="">
                        </a>
                        </div>
                        <?php if($report['info_only']==0){?>
                        <div class="cbp-caption-activeWrap">
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body">
                                 <a href="<?php echo base_url()?>home/facility_booking_form/<?php echo $this->encrypt_model->encode($report['id']);?>"
                                    class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase" 
                                    rel="nofollow"  style="padding:2px; margin:2px;">Book Now</a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                    <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center"><?php 
                      echo $report['name'];
                      ?></div>
                    <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center">
                     <?php //echo date('h A',strtotime($report['opening_hour']))?>
                     <?php //echo date('h A',strtotime($report['closing_hour']))?>
                    </div>
                </div>
            
            
            <?php
            $msg_id=$report['id'];
			}
			?>
				
			
            </div>
            <!--<div id="js-loadMore-juicy-projects" class="cbp-l-loadMore-button">
                <a href="../assets/global/plugins/cubeportfolio/ajax/loadMore.html" 
                class="cbp-l-loadMore-link btn grey-mint btn-outline" rel="nofollow">
                    <span class="cbp-l-loadMore-defaultText">LOAD MORE</span>
                    <span class="cbp-l-loadMore-loadingText">LOADING...</span>
                    <span class="cbp-l-loadMore-noMoreLoading">NO MORE WORKS</span>
                </a>
            </div>-->
            </div>
        </div>
        
        <div id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests search-item clearfix">
					<a href="javacript:;" id="<?php echo $msg_id; ?>" 
					onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" 
					class="more_services_requests btn btn-primary">Show more</a>
				</div>
        <?php
		} else {
		?>	
            <div class="note note-success">
                <h4 class="block"><i class="fa fa-info-circle"></i> Information</h4>
                <p> No Facilities added at the moment. </p>
            </div>
		<?php		
        }?>
        <div class="portfolio-content portfolio-1">
           
            
             <?php
			  echo $this->load->view('template/feature_ad');
			  ?>
           
        </div>
       
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
			url: "<?php echo base_url();?>home/add_facility_booking_viewajax",
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