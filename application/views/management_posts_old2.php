<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/portfolio.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/global/plugins/cubeportfolio/css/cubeportfolio.css" />
<div class="page-content-wrapper">
 <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>
                <?php if(isset($title)){ echo $title;}?>      
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
 <div class="page-content">
    <div class="container">
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
			if(sizeof($managment_posts)>0)
			{
?>
        <div class="portfolio-content portfolio-1">
           
            <div id="js-filters-juicy-projects" class="cbp-l-filters-button">
            </div>
            <div id="js-grid-juicy-projects" class="cbp">
		    <?php              foreach($managment_posts as $report){
              if($report['image_url']=='')
              {$src=base_url()."assets/front/global/img/no-image-box.png";}
              else{$src=base_url()."uploads/post_images/". $report['image_url'];}
            ?>
                <div class="cbp-item">
                    <div class="cbp-caption">
                        <div class="">
                            <a href="<?php echo base_url()?>home/single_management_post/<?php echo $this->encrypt_model->encode($report['id']);?>">
                            <img src="<?php echo $src;?>" alt="">
                            </a> </div>
                        
                    </div>
                    <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center"><?php 
                      echo $report['title'];
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
</div>     