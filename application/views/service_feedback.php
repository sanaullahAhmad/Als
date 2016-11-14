<?php //echo $this->encrypt_model->decode($this->uri->segment(2)); exit;?>
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

        <div class="left-post">
        <div class="portlet light ">
          <div class="portlet-title">
              <div class="caption">
                  <i class="icon-settings font-dark"></i>
                  <span class="caption-subject font-dark sbold uppercase"><?php if(isset($title)){ echo $title;}?> </span>
              </div>
              <div class="actions">
                  
              </div>
          </div>
          <div class="portlet-body form">
           <?php if ($this->session->flashdata('message')) { ?>
              <div class="alert alert-info"> 
                  <?= $this->session->flashdata('message') ?> 
              </div>
          <?php } ?>
          
          <?php 
		  $id = $this->uri->segment(2);
		  $result= $this->General_model->get_data_all_like_using_where("service_quotes"," id=".$this->encrypt_model->decode($id));?>
<table class="demo-table">
<tbody>
<tr>
<th><strong>Feeback</strong></th>
</tr>
<?php
if(!empty($result)) {
$i=0;
foreach ($result as $tutorial) {
?>
<tr>
  <td valign="top">
  <div id="tutorial-<?php echo $tutorial["id"]; ?>">
  <input type="hidden" name="rating" id="rating" value="<?php echo $tutorial["rating"]; ?>" />
  <ul onMouseOut="resetRating(<?php echo $tutorial["id"]; ?>);">
    <?php
    for($i=1;$i<=5;$i++) {
    $selected = "";
    if(!empty($tutorial["rating"]) && $i<=$tutorial["rating"]) {
      $selected = "selected";
    }
    ?>
    <li class='<?php echo $selected; ?>' onMouseOver="highlightStar(this,<?php echo $tutorial["id"]; ?>);" onMouseOut="removeHighlight(<?php echo $tutorial["id"]; ?>);" onClick="addRating(this,<?php echo $tutorial["id"]; ?>);">&#9733;</li>  
    <?php }  ?>
  <ul>
  </div>
  </td>
</tr>
<?php		
}
?>
<tr>
    <td>
        <textarea class="form-control" placeholder="Feedback" name="feedback" id="feedback"><?php echo $tutorial["feedback"]; ?></textarea>
    </td>
</tr>
<tr>
    <td>
        <a href="javascript:;" class="btn btn-primary" onClick="addRating_feeback(<?php echo $tutorial["id"]; ?>);">Submit Feedback</a>
    </td>
</tr>
<?php
}
?>
</tbody>
</table>
<div class="show_message">
</div>
          
          </div>
        </div>
        </div>
            <?php //echo $this->load->view('template/sidebar');?>
    </div>
</div>
</div>
</div>         
<script>
function highlightStar(obj,id) {
	removeHighlight(id);		
	$('.demo-table #tutorial-'+id+' li').each(function(index) 
	{
		$(this).addClass('highlight');
		if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) 
		{
			return false;	
		}
	});
}
function removeHighlight(id) {
	$('.demo-table #tutorial-'+id+' li').removeClass('selected');
	$('.demo-table #tutorial-'+id+' li').removeClass('highlight');
}
function addRating(obj,id) {
	$('.demo-table #tutorial-'+id+' li').each(function(index) {
		$(this).addClass('selected');
		$('#tutorial-'+id+' #rating').val((index+1));
		if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
			return false;	
		}
	});
	/*$.ajax({
	url: "<?php echo base_url();?>home/add_rating",
	data:'id='+id+'&feedback='+$('#feedback').val()+'&rating='+$('#tutorial-'+id+' #rating').val(),
	type: "POST"
	});*/
}
function addRating_feeback(id)
{
	$.ajax({
	url: "<?php echo base_url();?>home/add_rating",
	data:'id='+id+'&feedback='+$('#feedback').val()+'&rating='+$('#tutorial-'+id+' #rating').val(),
	type: "POST"
	});
	$('.demo-table').hide(); 
	$('.show_message').show(); 
	$('.show_message').html('<h3>Thanks for your feedback. Much appreciated.<h3>'); 
	setTimeout(function(){ 
		window.location.href='<?php echo base_url();?>';
	}, 5000);
}
function resetRating(id) {
	if($('#tutorial-'+id+' #rating').val() != 0) {
		$('.demo-table #tutorial-'+id+' li').each(function(index) {
			$(this).addClass('selected');
			if((index+1) == $('#tutorial-'+id+' #rating').val()) {
				return false;	
			}
		});
	}
} 
</script>     
<style>
.demo-table {width: 100%;border-spacing: initial;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333;}
.demo-table th {background: #999;padding: 5px;text-align: left;color:#FFF;}
.demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
.demo-table td div.feed_title{text-decoration: none;color:#00d4ff;font-weight:bold;}
.demo-table ul{margin:0;padding:0;}
.demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
.demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
</style>