<link href="<?php echo base_url();?>assets/front/pages/css/search.min.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><?php if(isset($page_title)){ echo $page_title;}?>      
                </h1>
            </div>
            
            <div class="page-title pull-right">
                <a href="<?php echo base_url();?>archived_posts" class="btn btn-primary pull-right" target="_blank">
                    Archived Posts
                </a>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE CONTENT BODY -->
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE BREADCRUMBS -->
            <!-- END PAGE BREADCRUMBS -->
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="page-content-inner">
              <div class="left-post">
              	<div class="portlet light">
                <div class="search-page search-content-1">
                   <div class="row">
                      <div class="col-md-12">
                        <div class="search-container ">
                           <ul class="updates_services_requests">
							  <?php
                              if(sizeof($managment_posts)>0)
                              {
                                  foreach($managment_posts as $manager_post)
                                  {
                                      ?>
                                   <li class="search-item clearfix">
                                  <!--  <h3></h3>
                                    <p><?php echo substr($manager_post['description'],0,200)?> </p>-->
                                        <div class="search-content">
                                              <h3 class="search-title">
                                                  <a href="<?php echo base_url()?>single_management_post/<?php echo $this->encrypt_model->encode($manager_post['id'])?>"><?php echo $manager_post['title'];?></a>
                                              </h3>
                            				  <div class="blog-post-desc"> 
											  <?php echo substr($manager_post['description'],0,200)?> 
                                              </div>
                                          </div>
                                      </li>
                                  <?php
								  $msg_id=$manager_post['id'];
								  }
								  ?>
									  <li id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests search-item clearfix">
										  <a href="javacript:;" id="<?php echo $msg_id; ?>" 
                                          onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" 
										  class="more_services_requests btn btn-primary">Show more</a>
									  </li>
								  <?php
                              }
                              ?>
                       </ul>
                       </div>
                     </div>
                    
                  </div>
                  </div>
                  </div>
                   <?php
			  echo $this->load->view('template/feature_ad');
			  ?>
                </div>
              
              <?php echo $this->load->view('template/sidebar');?> 
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>
<script>
function more_rows_services_requests(ID) 
{
	if(ID)
	{
		$("#more_services_requests"+ID).html('<img src="<?php echo base_url()?>assets/admin/images/loading.gif" width="32" height="32"/>');
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>home/management_posts_viewajax",
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