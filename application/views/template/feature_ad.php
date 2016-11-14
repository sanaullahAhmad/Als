<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/portfolio.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/global/plugins/cubeportfolio/css/cubeportfolio.css" />

<style>
.portlet-body p{
	padding: 10px 0 10px 0;	
	font-size:13px;
}
.modal-body .col-md-5 img
{
	width:100%; height:auto;
}
</style>
<?php
	//Get ad id from area id
	$get_area_id_from_condo_featured = $this->General_model->get_value_by_id('condos', $this->condo_id, 'areas');
	$ad_id_from_area_id_featured = "SELECT * from ad_display where area_id = '$get_area_id_from_condo_featured'"; 
	$query_ad_id_from_area_id_featured = $this->db->query($ad_id_from_area_id_featured);
	$result_ad_id_from_area_id_featured = $query_ad_id_from_area_id_featured->result_array();
	if(sizeof($result_ad_id_from_area_id_featured) > 0){
	
	//$actual_ad_id = array();
		foreach($result_ad_id_from_area_id_featured as $area){
			$ad_id[] = $area['ad_id'];
		}
		
		$implode_ad_id_featured = "'" . implode("','", $ad_id) . "'";

		
		$sql_featured="SELECT * from advertisements where ad_type='Featured' AND ad_category = '1'  AND (start_date<NOW() AND end_date>NOW()) LIMIT 3"; 
		  $query_featured = $this->db->query($sql_featured);
		  $result_featured=$query_featured->result_array();
		  
		  $implode_ad_id_featured;
	?>
     <div class="portlet light" style="padding-top:20px;">
                   
                    <div class="portlet-body form">
                    <h3 style="font-size: 12px; padding:0px 0px 15px; margin:0px; font-weight:bold;">
                    	Advertisement
                    </h3>
                  <?php
               $n4 =0;
               if(sizeof($result_featured)>0)
               {
				   ?>
                <div class="row">
              <?php
			  
					foreach($result_featured as $advert)
					{
						//For text decription
						$limit = 5;
						if (str_word_count($advert['ad_text'], 0) > $limit) {
						  $words = str_word_count($advert['ad_text'], 2);
						  $pos = array_keys($words);
						  $text = substr($advert['ad_text'], 0, $pos[$limit]) . '...';
						} else {
							$text = $advert['ad_text'];
						}
						
						
						//For image
						if($advert['ad_img']=='')
						  {$src=base_url()."assets/front/global/img/no-image-box.png";}
						  else{$src=base_url()."uploads/advertisement_images/".$advert['ad_img'];}
				  
					
						if(empty($advert['link'])){ 
							$link_markup = ' onclick="show_model_ad('.$advert['id'].')" href="#" '; 
						} else { 
							if(substr($advert['link'],0,7)!='http://' && substr($advert['link'],0,8)!='https://'){
								$link_markup = ' href="http://'.$advert['link'].'" target="_blank"';
							} else {
								$link_markup = ' href="'.$advert['link'].'" target="_blank"';
							}
						}
				  
				  		if($advert['display_all']=='1'){
	
                    ?>
                    <!--onclick="show_model_ad(<?php echo $report['id']?>)"-->
              	<div class="col-md-4" > 
                <!-- Thumbnail -->
                    <div class="thumbnail widget-thumbnail" style="height:280px; margin-bottom: 10px; text-align:center">
                      <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);"> <a <?php echo $link_markup;?>> <img src="<?php echo $src;?>" alt="<?php echo $advert['title'];?>" class="img-responsive" style="height:200px;"> </a> </div>
                      <div class="caption" style="padding: 0px 0;">
                        <h5 > <a style="color:#000 !important; font-weight:bold !important" <?php echo $link_markup;?>> <?php echo $advert['title'];
                                        
                                        ?> </a> 
                                       <p><?php echo $text;?></p>
                                        </h5>
                                    
                     </div>
                </div>
                <!-- // Thumbnail END --> 
              </div>
              <?php
						}  elseif($advert['display_all']=='0'){
					 //check specific areas settings
					 if(in_array($advert['id'],$ad_id)){
			  ?>
              <a >
              <div class="col-md-4" > 
                <!-- Thumbnail -->
                    <div class="thumbnail widget-thumbnail" style="height:280px; margin-bottom: 10px; text-align:center">
                      <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);"> <a <?php echo $link_markup;?>> <img src="<?php echo $src;?>" alt="<?php echo $advert['title'];?>" class="img-responsive" style="height:200px;"> </a> </div>
                        <h5 > <a <?php echo $link_markup;?> style="color:#000 !important; font-weight:bold !important" > <?php echo $advert['title'];
						?> </a> 
					   <p><?php echo $text;?></p>
						</h5>
                                    
                </div>
                <!-- // Thumbnail END --> 
              </div>

              <?php
					 }
					 
				}  elseif($advert['display_all']=='2'){
					 //check specific areas settings
					 if(in_array($this->condo_id,explode(',',$advert['condos'])))
					 {
			  
			  ?>
              <div class="col-md-4" onclick="show_model_ad(<?php echo $advert['id']?>)"> 
                <!-- Thumbnail -->
                    <div class="thumbnail widget-thumbnail" style="height:280px; margin-bottom: 10px; text-align:center">
                      <div class=" holderjs-fluid"  style="color: rgb(170, 170, 170); width: 100%; height: 200px; line-height: 200px; background-color: rgb(238, 238, 238);"> <a <?php echo $link_markup;?>> <img src="<?php echo $src;?>" alt="<?php echo $advert['title'];?>" class="img-responsive" style="height:200px;"> </a> </div>
                      <div class="caption" style="padding: 0px 0;">
                        <h5 > <a style="color:#000 !important; font-weight:bold !important" <?php echo $link_markup;?>> <?php echo $advert['title'];
						?> </a> 
					   <p><?php echo $text;?></p>
						</h5>
                                    
                     </div>
                </div>
                <!-- // Thumbnail END --> 
              </div>
              <?php
					 } }
			  ?>
              
              
              
              
              <?php
                     }
					 ?>
            </div>
              <?php
			   }
	}
			  ?>
            </div>
            
            </div>
            
  <script>
  
  function show_model_ad(ad_id)
	{
		$('#adpostModal').modal('show');
		
		$.ajax({
			'url': '<?php echo base_url();?>home/show_popup_ad',
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
  </script>          
            
<div id="adpostModal" class="modal fade" role="dialog" >
  <div class="modal-dialog" style=" width:50%;"> 
    
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