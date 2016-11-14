<?php
$img = $this->General_model->get_data_rowusingwhere_empty_array('incident_images',"incident_id=".$incidents->id);
if(sizeof($img)>0)
{$src=base_url()."uploads/incident_images/".$img->image_url;}
else
{$src=base_url()."assets/front/global/img/no-image-box.png";}
?>
<div class="portfolio-content">
    <div class="cbp-l-project-title"><?php echo $title;?></div>
    <div class="cbp-l-project-subtitle">by  <?php  echo $this->General_model->get_value_by_id('residents',$incidents->reported_by,'name');?></div>
    <div class="cbp-slider">
        <ul class="cbp-slider-wrap">
        	<?php
			$rows = $this->General_model->get_data_all_like_using_where('incident_images',"incident_id=".$incidents->id);
			if(sizeof($rows)>0)
			{
				foreach($rows as $row)
				{?>
            <li class="cbp-slider-item">
                <a href="<?php echo base_url()."uploads/incident_images/".$row['image_url'];?>" class="cbp-lightbox">
                    <img src="<?php echo base_url()."uploads/incident_images/".$row['image_url'];?>" alt=""> 
                </a>
            </li>
            <?php }
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
        <div class="cbp-l-project-desc">
            <div class="cbp-l-project-desc-title">
                <span>Project Description</span>
            </div>
            <div class="cbp-l-project-desc-text"><?php echo $incidents->description?></div>
        </div>
        <div class="cbp-l-project-details">
            <div class="cbp-l-project-details-title">
                <span>Project Details</span>
            </div>
            <ul class="cbp-l-project-details-list">
                <li>
                    <strong>Condo</strong><?php  echo $this->General_model->get_value_by_id('condos',$incidents->condo_id,'name');?></li>
                <li>
                    <strong>Date</strong><?php echo date('F d, Y  h:i A', strtotime($incidents->reported_date))?></li>
                <li>
                    <strong>Categories</strong> <?php echo $this->General_model->get_value_by_id('incident_categories',$incidents->incident_category,'name'); ?></li>
            </ul>
            <a href="#" target="_blank" class="cbp-l-project-details-visit btn red uppercase">visit the site</a>
        </div>
    </div>
    <div class="cbp-l-project-container">
        
    </div>
    <br>
    <br>
    <br> </div>