<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/portfolio.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/global/plugins/cubeportfolio/css/cubeportfolio.css" />
<link href="<?php echo base_url()?>assets/front/global/plugins/thumbnailSlider1/thumbnail-slider.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/front/global/plugins/thumbnailSlider1/thumbnail-slider2.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url()?>assets/front/global/plugins/thumbnailSlider1/thumbnail-slider.js" type="text/javascript"></script>
<?php
	//Get ad id from area id
	$get_area_id_from_condo_featured = $this->General_model->get_value_by_id('condos', $this->condo_id, 'areas');
	$ad_id_from_area_id_featured = "SELECT * from ad_display where area_id = '$get_area_id_from_condo_featured'"; 
	$query_ad_id_from_area_id_featured = $this->db->query($ad_id_from_area_id_featured);
	$result_ad_id_from_area_id_featured = $query_ad_id_from_area_id_featured->result_array();
	
	//$actual_ad_id = array();
		foreach($result_ad_id_from_area_id_featured as $area){
			$ad_id[] = $area['ad_id'];
		}
		
		$implode_ad_id_featured = "'" . implode("','", $ad_id) . "'";

		
		$sql_featured="SELECT * from advertisements where ad_type='Featured' AND ad_category = '1' AND (start_date<NOW() AND end_date>NOW())"; 
		  $query_featured = $this->db->query($sql_featured);
		  $result_featured=$query_featured->result_array();
		  
		
		$sql_normal="SELECT * from advertisements where ad_type='Normal' AND ad_category = '1' AND (start_date<NOW() AND end_date>NOW())"; 
		  $query_normal = $this->db->query($sql_normal);
		  $result_normal=$query_normal->result_array();
		  
		  
	?>
    
    
<div class="page-content-wrapper">
<div class="page-head">
      <div class="container">
          <!-- BEGIN PAGE TITLE -->
          <div class="page-title">
              <h1>
              <?php if(isset($page_title)){ echo $page_title;}?>      
              </h1>
          </div>
          <!--<div class="page-title pull-right">
              <a href="<?php echo base_url();?>add_advertisement" class="btn btn-primary pull-right">Post Ad</a> 
          </div>
-->          <!-- END PAGE TITLE -->
      </div>
  </div>
  <div class="page-content">
      <div class="container">
        <div class="page-content-inner">
          <div class="left-post">
          
          <div class="portlet light">
          			<div class="portlet-title">
                      <div class="caption font-dark"> 
                        <!--<i class="icon-settings font-dark"></i>--> 
                        <span class="caption-subject bold uppercase">Featured Advertisement</span> </div>
                    </div>
          			<div class="portlet-body">
          			<div class="row">
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
               $n4 =0;
               if(sizeof($result_featured)>0)
               {
                  $adver_no=1;
				  foreach($result_featured as $report)
                  {
                  if($report['ad_img']=='')
                  {$src=base_url()."assets/front/global/img/no-image-box.png";}
                  else{$src=base_url()."uploads/advertisement_images/".$report['ad_img'];}
				  
				  
				  //if(empty($report['link'])){ 
				  $link_markup = '  href="#" '; 
				  $div_markup = ' onclick="show_premium_ad('.$report['id'].')"  '; 
				  /*} 
				  else 
				  { 
					  if(substr($report['link'],0,7)!='http://' && substr($report['link'],0,8)!='https://')
					  {
						  $link_markup = ' href="http://'.$report['link'].'" target="_blank"';
						  $div_markup = ' ';
					  }
					  else
					  {
						  $link_markup = ' href="'.$report['link'].'" target="_blank"';
						  $div_markup = ' ';
					  }
				  }*/
				  
				  
				   $limit = 5;
					if (str_word_count($report['ad_text'], 0) > $limit) {
					  $words = str_word_count($report['ad_text'], 2);
					  $pos = array_keys($words);
					  $text = substr($report['ad_text'], 0, $pos[$limit]) . '...';
      				} else {
						$text = $report['ad_text'];
					}
                if($report['display_all']=='1')
					{
					 $adver_no++;
					?>
                  <div class="col-md-4"  <?php echo $div_markup;?>> 
                    <div class="thumbnail widget-thumbnail" style="height:280px; margin-bottom: 10px; text-align:center">
                      <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);"> <a <?php echo $link_markup;?>> <img src="<?php echo $src;?>" alt="<?php echo $report['title'];?>" class="img-responsive" style="height:200px;"> </a> </div>
                      <div class="caption" style="padding: 0px 0;">
                        <h5 > 
                            <a style="color:#000 !important; font-weight:bold !important" href="#"> <?php echo $report['title'];?> </a> 
                            <p><?php echo $text;?></p>
                        </h5>
                                        
                      </div>
                    </div>
                  </div>
                  <?php }
					 elseif($report['display_all']=='0')
					 {
						 //check specific areas settings
						 if(in_array($report['id'],$ad_id))
						 {
							$adver_no++;
							 ?>
                             <div class="col-md-4"  <?php echo $div_markup;?>> 
                    <div class="thumbnail widget-thumbnail" style="height:280px; margin-bottom: 10px; text-align:center">
                      <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);"> <a <?php echo $link_markup;?>> <img src="<?php echo $src;?>" alt="<?php echo $report['title'];?>" class="img-responsive" style="height:200px;"> </a> </div>
                      <div class="caption" style="padding: 0px 0;">
                        <h5 > 
                            <a style="color:#000 !important; font-weight:bold !important" href="#"> <?php echo $report['title'];?> </a> 
                            <p><?php echo $text;?></p>
                        </h5>
                                        
                      </div>
                    </div>
                  </div>
                   <?php
						 }
					 } 
					 elseif($report['display_all']=='2')
					 {
						 //check specific condos settings
						 if(in_array($this->condo_id,explode(',',$report['condos'])))
						 {
							$adver_no++;
							 ?>
                             <div class="col-md-4"  <?php echo $div_markup;?>> 
                    <div class="thumbnail widget-thumbnail" style="height:280px; margin-bottom: 10px; text-align:center">
                      <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);"> <a <?php echo $link_markup;?>> <img src="<?php echo $src;?>" alt="<?php echo $report['title'];?>" class="img-responsive" style="height:200px;"> </a> </div>
                      <div class="caption" style="padding: 0px 0;">
                        <h5 > 
                            <a style="color:#000 !important; font-weight:bold !important" href="#"> <?php echo $report['title'];?> </a> 
                            <p><?php echo $text;?></p>
                        </h5>
                                        
                      </div>
                    </div>
                  </div>
                <?php
						 }
					 } 
                  } 
               }?>
                </div>
           </div>
           </div>
           
           
           <div class="portlet light">
          			<div class="portlet-title">
                      <div class="caption font-dark"> 
                        <!--<i class="icon-settings font-dark"></i>--> 
                        <span class="caption-subject bold uppercase">Normal Advertisement</span> </div>
                    </div>
          			<div class="portlet-body">
          			<div class="row">
                
               <?php
               $n4 =0;
               if(sizeof($result_normal)>0)
               {
                  $adver_no=1;
				  foreach($result_normal as $report)
                  {
                  if($report['ad_img']=='')
                  {$src=base_url()."assets/front/global/img/no-image-box.png";}
                  else{$src=base_url()."uploads/advertisement_images/".$report['ad_img'];}
				  
				  //if(empty($report['link'])){ 
				  $link_markup = '  href="#" '; 
				  $div_markup = ' onclick="show_normal_ad('.$report['id'].')"  '; 
				  /*} 
				  else 
				  { 
					  if(substr($report['link'],0,7)!='http://' && substr($report['link'],0,8)!='https://')
					  {
						  $link_markup = ' href="http://'.$report['link'].'" target="_blank"';
						  $div_markup = ' ';
					  }
					  else
					  {
						  $link_markup = ' href="'.$report['link'].'" target="_blank"';
						  $div_markup = ' ';
					  }
				  }*/
				  
				   $limit = 5;
					if (str_word_count($report['ad_text'], 0) > $limit) {
					  $words = str_word_count($report['ad_text'], 2);
					  $pos = array_keys($words);
					  $text = substr($report['ad_text'], 0, $pos[$limit]) . '...';
      				} else {
						$text = $report['ad_text'];
					}
					//check Display All setttings
					if($report['display_all']=='1')
					{
					 $adver_no++;
					?>
					  <div class="col-md-4"  <?php echo $div_markup;?>> 
						<div class="thumbnail widget-thumbnail" style="height:280px; margin-bottom: 10px; text-align:center">
						  <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);"> <a  <?php echo $link_markup;?>> <img src="<?php echo $src;?>" alt="<?php echo $report['title'];?>" class="img-responsive" style="height:200px;"> </a> </div>
						  <div class="caption" style="padding: 0px 0;">
							<h5 > 
								<a style="color:#000 !important; font-weight:bold !important" href="#"> <?php echo $report['title'];?> </a> 
								<p><?php echo $text;?></p>
							</h5>
											
						  </div>
						</div>
					  </div>
					<?php }
					 elseif($report['display_all']=='0')
					 {
						 //check specific areas settings
						 if(in_array($report['id'],$ad_id))
						 {
							$adver_no++;
							 ?>
							 <div class="col-md-4"  <?php echo $div_markup;?>> 
							<div class="thumbnail widget-thumbnail" style="height:280px; margin-bottom: 10px; text-align:center">
							  <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);"> <a  <?php echo $link_markup;?>> <img src="<?php echo $src;?>" alt="<?php echo $report['title'];?>" class="img-responsive" style="height:200px;"> </a> </div>
							  <div class="caption" style="padding: 0px 0;">
								<h5 > 
									<a style="color:#000 !important; font-weight:bold !important" href="#"> <?php echo $report['title'];?> </a> 
									<p><?php echo $text;?></p>
								</h5>
												
							  </div>
							</div>
						  </div>
						  <?php
						 }
					 } 
					 elseif($report['display_all']=='2')
					 {
						 //check specific condos settings
						 if(in_array($this->condo_id,explode(',',$report['condos'])))
						 {
							$adver_no++;
							 ?>
							 <div class="col-md-4"  <?php echo $div_markup;?>> 
							<div class="thumbnail widget-thumbnail" style="height:280px; margin-bottom: 10px; text-align:center">
							  <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);"> <a  <?php echo $link_markup;?>> <img src="<?php echo $src;?>" alt="<?php echo $report['title'];?>" class="img-responsive" style="height:200px;"> </a> </div>
							  <div class="caption" style="padding: 0px 0;">
								<h5 > 
									<a style="color:#000 !important; font-weight:bold !important" href="#"> <?php echo $report['title'];?> </a> 
									<p><?php echo $text;?></p>
								</h5>
												
							  </div>
							</div>
						  </div>
						  <?php
						 }
					 }
				  } 
               }?>
                </div>
           </div>
           </div>
           
           
          </div>
        <?php echo $this->load->view('template/sidebar');?> 
	  </div>
    </div>
  </div>
</div>

<script>
  
  function show_premium_ad(ad_id)
	{
		$('#premadpostModal').modal('show');
		
		$.ajax({
			'url': '<?php echo base_url();?>home/show_prem_popup_ad',
			'type': 'post',
			'data': {
				'ad_id': ad_id
			},
			'cache': false,
			'success': function(result){
				$(".admodal-body").html(result);
				
			}
		});
		
		
	}
  function show_normal_ad(ad_id)
	{
		$('#normaladpostModal').modal('show');
		
		$.ajax({
			'url': '<?php echo base_url();?>home/show_prem_popup_ad',
			'type': 'post',
			'data': {
				'ad_id': ad_id
			},
			'cache': false,
			'success': function(result){
				$(".adnormalmodal-body").html(result);
				
			}
		});
		
		
	}
  </script>       
  
<div id="premadpostModal" class="modal fade" role="dialog" >
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Featured Advertisement</h4>
      </div>
      <div class="modal-body admodal-body" style="min-height:250px;">
            
       
            
                                                       
      </div>
    
    </div>
  </div>
</div>
<div id="normaladpostModal" class="modal fade" role="dialog" >
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Advertisement</h4>
      </div>
      <div class="modal-body adnormalmodal-body" style="min-height:250px;">
            
       
            
                                                       
      </div>
    
    </div>
  </div>
</div>