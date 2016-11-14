<link href="<?php echo base_url();?>assets/front/pages/css/search.min.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><?php if(isset($title)){ echo $title;}?>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
           
            <!-- END PAGE TOOLBAR -->
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
                <div class="search-page search-content-1">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search-container ">
                                <ul id="updates">
                                 <?php
								 if(sizeof($adverts)>0)
								 {
									foreach($adverts as $report)
									{
									$img = $this->General_model->get_data_rowusingwhere_empty_array('adverts_images',"advert_id=".$report['id']);
									if($report['image_url']=='')
									{$src=base_url()."assets/front/global/img/no-image-box.png";}
									else{$src=base_url()."uploads/advertisement_images/".$report['image_url'];}
								  ?>
                                    <li class="search-item clearfix">
                                        <a href="javascriptt:;">
                                            <img src="<?php echo $src;?>" />
                                        </a>
                                        <div class="search-content">
                                            <h2 class="search-title">
                                                <a href="javascript:;"> <?php echo $report['title']?></a>
                                            </h2>
                                            <p class="search-desc">  <?php echo $report['description']?> </p>
                                        </div>
                                    </li>
								<?php 
								 $msg_id	=	$report['id'];
                                      } 
                              ?>
                                    <li class="search-item clearfix morebox" id="more<?php echo $msg_id; ?>" >
                                        <div class="search-content">
                                            <h2 class="search-title">
                                                <a href="javascript:;" id="<?php echo $msg_id; ?>" onclick="more_rows(<?php echo $msg_id; ?>)" class="more"> More</a>
                                            </h2>
                                        </div>
                                    </li>
                                    <?php }?>
                                </ul>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>

<script type="text/javascript">
function more_rows(ID) 
{
if(ID)
{
$("#more"+ID).html('<img src="<?php echo base_url()?>assets/admin/images/loading.gif" width="32" height="32"/>');

$.ajax({
type: "POST",
url: "<?php echo base_url();?>home/advertisements_viewajax",
data: "lastmsg="+ ID, 
cache: false,
success: function(html){
$("#updates").append(html);
$("#more"+ID).remove(); // removing old more button
}
});
}
else
{
$(".morebox").html('The End');// no results
}
return false;
}
</script>