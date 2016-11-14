<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" /><link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.js" type="text/javascript" ></script>
<div class="portfolio-content">
    <div class="cbp-l-project-title"><?php echo $title;?></div>
    <div class="cbp-l-project-subtitle">Title : <?php echo $adverts->title;?></div>
    <div class="cbp-l-project-container">
        <div class="cbp-l-project-desc">
            <div class="cbp-l-project-desc-title">
                <span>Images</span>
            </div>
            
        </div>
        <div class="cbp-l-project-details">
            <div class="cbp-l-project-details-title">
                <span>Advertisement Details</span>
            </div>
            <ul class="cbp-l-project-details-list">
                <!--<li>
                    <strong>Condo</strong><?php  echo $this->General_model->get_value_by_id('condos',$adverts->condo_id,'name');?></li>
                <li>-->
            </ul>
            
        </div>
    </div>
    <div class="cbp-slider">
        <ul class="cbp-slider-wrap">
        	<?php
			$imgs = $this->General_model->get_data_all_like_using_where('adverts_images',"advert_id=".$adverts->id);
			if(sizeof($imgs)>0)
			{
				foreach($imgs as $img)
				{
				?>
            <li class="cbp-slider-item">
                <a href="<?php echo base_url()."uploads/advertisement_images/".$img['image_url'];?>" class="cbp-lightbox">
                    <img src="<?php echo base_url()."uploads/advertisement_images/".$img['image_url'];?>" alt=""> 
                </a>
            </li>
            <?php 
				}
			}
			else{?>
            <li class="cbp-slider-item">
                <a href="<?php echo base_url()."assets/front/global/img/no-image-box.png";?>" class="cbp-lightbox">
                    <img src="<?php echo base_url()."assets/front/global/img/no-image-box.png";?>" alt=""> 
                </a>
            </li>
            <?php }?>
        </ul>
    </div>
    
    <div class="cbp-l-project-container">
        
    </div>
    <br>
    <br>
    <br> </div>
<script> 

</script>