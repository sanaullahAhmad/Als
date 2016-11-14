<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/search.min.css" />
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
                            <table class="table table-bordered table-striped table-condensed" id="updates">
                                <thead class="bg-blue">
                                    <tr>
                                        <th><a href="javascript:;">Comment</a></th>
                                        <th><a href="javascript:;">Commented By</a></th>
                                        <th><a href="javascript:;">Time</a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php
                                    foreach($posts_comments as $report){
                                    ?>
                                        <tr class="gradeX">
                                            <td  class="table-desc">
												<?php echo $report['comment']?>
                                            </td>
                                             <td  class="table-desc">
												<?php echo $this->General_model->get_value_by_id('residents',$report['commented_by'],'name');?>
                                            </td>
                                             <td  class="table-desc">
												<?php echo $this->General_model->nicetime2($report['insertDate']);?>
                                            </td>
                                            
                                        </tr>
                                        <?php 
										 $msg_id	=	$report['id'];
                                        } ?>
                                         <!--<tr >
                                            <td colspan="4" align="center" id="more<?php echo $msg_id; ?>" class="morebox">
                                                <a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows(<?php echo $msg_id; ?>)" 
                                                class="more">
                                                    More
                                                </a>
                                            </td>
                                        </tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
             </div>
          </div>
      </div>
  </div>
<script type="text/javascript">
function more_rows(ID) 
{
if(ID)
{
$("#more"+ID).html('<img src="<?php echo base_url()?>assets/admin/images/loading.gif" width="32" height="32"/>');

$.ajax({
type: "POST",
url: "<?php echo base_url();?>home/delivery_request_viewajax",
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