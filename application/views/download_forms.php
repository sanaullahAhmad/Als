<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/todo-2.min.css" />
<style>
a:hover
{
	text-decoration:none;
}
.badge
{
	height:auto;
	padding: 9px 7px;
}
.morebox_services_requests 
{
	margin-bottom:15px;
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
      <div class="row">
        <div class="col-md-8 col-sm-4">
          <div class="todo-tasklist updates_services_requests">
            <?php
          if(sizeof($download_forms)>0){
			  $i=1;
                foreach($download_forms as $download_form){
                ?>
            <div class="todo-tasklist-item todo-tasklist-item-border-green" style="padding-bottom:20px;">
              <div class="todo-tasklist-item-title"> <?php echo $download_form['name']?> </div>
              <div class="todo-tasklist-item-text"> <?php echo $download_form['description']?> </div>
              <div class="todo-tasklist-controls pull-left"> <!--<span class="todo-tasklist-date"> 
                Uploaded: <?php echo date('jS M y',strtotime($download_form['date_uploaded']))?>
                </span>-->  <span class="todo-tasklist-date">
                <?php
								//Get PDF files.
								$download_forms_files = $this->General_model->get_data_all_like_using_where('knowledge_base_files',"knowledge_base_id=".$download_form['id']);
								if(sizeof($download_forms_files)>0){
									$icount = 1;
									foreach($download_forms_files as $download_forms_file){
										?>
                <a target="_blank" href="<?php echo base_url()?>uploads/knowledge_base/<?php echo $download_forms_file['file_url']?>"><span class="todo-tasklist-badge badge badge-roundless"><i class="fa fa-download"></i>  <?php echo $download_forms_file['file_url']?>
                <?php //echo $icount;?>
                </span> </a>
                <?php	
										$icount++;								
								}}
								?>
                </span> </div>
            </div>
            <?php  
				$i++;
				$msg_id=$download_form['id'];
                }
				?>
                
                    <div id="more_services_requests<?php echo $msg_id; ?>" class="morebox_services_requests ">
                        <a href="javacript:;" id="<?php echo $msg_id; ?>" onclick="more_rows_services_requests(<?php echo $msg_id; ?>)" 
                        class="more_services_requests btn btn-primary">Show more</a>
                    </div>
                
                <?php
			  } else {
				?>
            <div class="note note-success">
              <h4 class="block"><i class="fa fa-info-circle"></i> Information</h4>
              <p> No forms at the moment. </p>
            </div>
            <?php
			  }
			  ?>
          </div>
          <?php			
			  echo $this->load->view('template/feature_ad');
			  ?>
        </div>
        <?php echo $this->load->view('template/sidebar');?> </div>
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
			url: "<?php echo base_url();?>home/download_forms_viewajax",
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