<style>
.right-post {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    padding: 0;
}
.right-post .col-md-12 {
    background: #fff none repeat scroll 0 0;
    padding: 15px;
    width: 100%;
	margin-bottom:25px;
}

</style>

<div class="right-post example-class">
<?php

	//Get ad id from area id
	$get_area_id_from_condo = $this->General_model->get_value_by_id('condos', $this->condo_id, 'areas');
	$ad_id_from_area_id = "SELECT * from ad_display where area_id = '$get_area_id_from_condo'"; 
	$query_ad_id_from_area_id = $this->db->query($ad_id_from_area_id);
	$result_ad_id_from_area_id = $query_ad_id_from_area_id->result_array();
	if(sizeof($result_ad_id_from_area_id) >0){
?>
    <div class="col-md-12">

	<h4 class="pull-left" style="font-size:12px; float:right !important; line-height: 7px;
    padding-bottom: 10px;">
    	Advertisements
    </h4>
	<!--<a href="<?php echo base_url()?>add_advertisement" class="post-ur-ad-btn">
        Post Ad
    </a> 
-->    
 
	<?php
	//$actual_ad_id = array();
		foreach($result_ad_id_from_area_id as $area){
			$ad_id[] = $area['ad_id'];
		}
		
		$implode_ad_id = "'" . implode("','", $ad_id) . "'";

		// specific areas settings removed from query. it is now checked below in if condition if display_ll=0
		$sql="SELECT * from advertisements where ad_type='Premium' AND ad_category = '2'  AND (start_date<NOW() AND end_date>NOW()) ORDER BY RAND() LIMIT 2"; 
		  $query = $this->db->query($sql);
		  $result=$query->result_array();
	?>
<section id="sidebar_resident_ads_section">
    <?php
	
		if($result>0)
		{
			foreach($result as $advert)
			{
				if(empty($advert['link'])){ 
				$link_markup = ' onclick="show_premium_ad('.$advert['id'].')" href="#" '; 
				} 
				else 
				{ 
					if(substr($advert['link'],0,7)!='http://' && substr($advert['link'],0,8)!='https://')
					{
						$link_markup = ' href="http://'.$advert['link'].'" target="_blank"';
					}
					else
					{
						$link_markup = ' href="'.$advert['link'].'" target="_blank"';
					}
				}
				if($advert['display_all']=='1')
				{
				?>
					<a <?php echo $link_markup;?>>
						<div class="right-post-img sidebar_resident_ads" sidebard="<?php echo $advert['id'];?>">
								<img src="<?php echo base_url()?>uploads/advertisement_images/<?php echo $advert['ad_img'];?>" />
							<div class="overlay">
							<?php echo $advert['title']?><br /><small><?php echo substr($advert['ad_text'],0,40)?></small>
							</div>
						</div>
					</a>
			<?php }
				 elseif($advert['display_all']=='0')
				 {
					 //check specific areas settings
					 if(in_array($advert['id'],$ad_id))
					 {
						 ?>
						 <a <?php echo $link_markup;?>>
							<div class="right-post-img sidebar_resident_ads" sidebard="<?php echo $advert['id'];?>">
									<img src="<?php echo base_url()?>uploads/advertisement_images/<?php echo $advert['ad_img'];?>" />
								<div class="overlay">
								<?php echo $advert['title']?><br /><small><?php echo substr($advert['ad_text'],0,40)?></small>
								</div>
							</div>
						</a>
						 <?php
					 }
					 
				 } 
				 elseif($advert['display_all']=='2')
				 {
					 //check specific areas settings
					 if(in_array($this->condo_id,explode(',',$advert['condos'])))
					 {
						 ?>
						 <a <?php echo $link_markup;?>>
							<div class="right-post-img sidebar_resident_ads" sidebard="<?php echo $advert['id'];?>">
									<img src="<?php echo base_url()?>uploads/advertisement_images/<?php echo $advert['ad_img'];?>" />
								<div class="overlay">
								<?php echo $advert['title']?><br /><small><?php echo substr($advert['ad_text'],0,40)?></small>
								</div>
							</div>
						</a>
						 <?php
					 }
					 
				 }
			  }
		
	}
	?>
    </section>
    </div>
    <?php } ?>
    <!--<div class="col-md-12">
    <section id="sidebar_resident_ads_section">
    <?php
	
		if($result>2)
		{
			foreach($result as $advert)
			{
	?>
    <a href="#">
            <div class="right-post-img sidebar_resident_ads" sidebard="<?php echo $advert['id'];?>">
               
                	<img src="<?php echo base_url()?>uploads/advertisement_images/<?php echo $advert['ad_img'];?>" />
                
                <div class="overlay">
				<?php echo $advert['title']?><br /><small><?php echo substr($advert['ad_text'],0,40)?></small>
                </div>
            </div>
            </a>
    <?php }
	}
	else
	{
	?>
    
	<?php
	}?>
    </section>
    </div>-->
     <!--<section id="sidebar_alpha_ads_section">
    <?php
		$action = "condo_id = $this->condo_id AND status=1 AND payment_status=1  AND  is_resident_ad=0 ORDER BY RAND() LIMIT 2";
		$adverts=$this->General_model->get_data_all_like_using_where('adverts', $action);
		if($adverts>0)
		{
			foreach($adverts as $advert)
			{
	?>
            <div class="right-post-img">
                <a target="_blank" href="<?php echo base_url()?>uploads/advertisement_images/<?php echo $advert['image_url'];?>">
                	<img src="<?php echo base_url()?>uploads/advertisement_images/<?php echo $advert['image_url'];?>" />
                </a>
                <div class="overlay">
				<?php echo $advert['title']?><br /><small><?php echo substr($advert['description'],0,40)?></small>
                </div>
            </div>
    <?php }
	}?>
    </section>-->
    
    
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
  </script>          

<div id="premadpostModal" class="modal fade" role="dialog" >
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Premium Advertisement</h4>
      </div>
      <div class="modal-body admodal-body" style="min-height:250px;">
            
       
            
                                                       
      </div>
    
    </div>
  </div>
</div>


<script>
/*function change_sidebar_advertisement() {
			var ad_id = $('.sidebar_resident_ads').attr('sidebard');
			//alert(ad_id);
	
	$.ajax({
			'url': '<?php echo base_url();?>home/change_sidebar_advertisement',
			'type': 'post',
			'data': {
				'ad_id': ad_id
			},
			'cache': false,
			'success': function(result){
				$("#sidebar_resident_ads_section").html(result);
			}
		});
}
$(document).ready( function(){
	
setInterval(change_sidebar_advertisement, 30000);

});*/
</script>		