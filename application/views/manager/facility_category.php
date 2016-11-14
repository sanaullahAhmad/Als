<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/portfolio.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/global/plugins/cubeportfolio/css/cubeportfolio.css" />
<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"><?php echo $title;?>
      <small></small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>manager">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span><?php echo $title;?></span>
          </li>
      </ul>
      <a href="<?php echo base_url();?>manager/add_facility_category" class="btn btn-primary pull-right">Add Facility Category</a>
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
		<?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-info" > 
                <?= $this->session->flashdata('message') ?> 
            </div>
        <?php } ?>
          

		<?php
        if(sizeof($facility_categories)>0)
        {
        ?>
        <div class="portfolio-content portfolio-1">
           
            <div id="js-filters-juicy-projects" class="cbp-l-filters-button">
            </div>
            <div id="js-grid-juicy-projects" class="cbp">
		    <?php foreach($facility_categories as $report)
			{
              if($report['image_url']=='')
              {$src=base_url()."assets/front/global/img/no-image-box.png";}
              else{$src=base_url()."uploads/facilities_images/". $this->General_model->get_thumb_of_image($report['image_url'],'_262_262');}
            ?>
                <div class="cbp-item">
                    <div class="cbp-caption">
                        <div class="cbp-caption-defaultWrap">
                            <img src="<?php echo $src;?>" alt=""> 
                        </div>
                        <div class="cbp-caption-activeWrap">
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body">
                                 <a href="<?php echo base_url()?>manager/edit_facility_category/<?php echo $this->encrypt_model->encode($report['id']);?>" class=" btn red uppercase btn red uppercase"   style="padding:2px; margin:2px;background-color: #547EB1; color: #FFFFFF; display: inline-block; font: 400 12px/30px "Open Sans", sans-serif;min-width: 90px;text-align: center;">Edit</a>
                                 <a href="#" onclick="callCrudAction('facility_categories','<?php  echo $report['id'];?>','delete_data')" class=" btn red uppercase btn red uppercase"   style="padding:2px; margin:2px;background-color: #547EB1; color: #FFFFFF; display: inline-block; font: 400 12px/30px "Open Sans", sans-serif;min-width: 90px;text-align: center;">Delete</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center"><?php 
                      echo $report['name'];
                      ?></div>
                    <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center">
                     <?php //echo date('h A',strtotime($report['opening_hour']))?>
                     <?php //echo date('h A',strtotime($report['closing_hour']))?>
                    </div>
                </div>
            
            
            <?php
            } 
			
			?>
			
            </div>
            <div id="js-loadMore-juicy-projects" class="cbp-l-loadMore-button">
                <a href="../assets/global/plugins/cubeportfolio/ajax/loadMore.html" 
                class="cbp-l-loadMore-link btn grey-mint btn-outline" rel="nofollow">
                    <span class="cbp-l-loadMore-defaultText">LOAD MORE</span>
                    <span class="cbp-l-loadMore-loadingText">LOADING...</span>
                    <span class="cbp-l-loadMore-noMoreLoading">NO MORE WORKS</span>
                </a>
            </div>
        </div>
        <?php
		} else {
		?>	
            <div class="note note-success">
                <h4 class="block"><i class="fa fa-info-circle"></i> Information</h4>
                <p> No Facilities added at the moment. </p>
            </div>
		<?php		
        }?>
          </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>