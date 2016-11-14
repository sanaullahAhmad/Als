<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/portfolio.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/global/plugins/cubeportfolio/css/cubeportfolio.css" />
<div class="page-content">
      <!-- BEGIN PAGE HEADER-->
      <h3 class="page-title"> Advertisemts
          <small></small>
      </h3>
      <div class="page-bar">
          <ul class="page-breadcrumb">
              <li>
                  <i class="icon-home"></i>
                  <a href="<?php echo base_url();?>">Home</a>
                  <i class="fa fa-angle-right"></i>
              </li>
              <li>
                  <span>Advertisemts</span>
              </li>
          </ul>
          
          <div class="page-toolbar">
              <div class="btn-group pull-right">
                  <a href="<?php echo base_url();?>alpha/add_advertisement" class="btn btn-fit-height btn-primary" >
                      Add advertisement
                  </a>   
              </div>
          </div>
      </div>
      <!-- END PAGE HEADER-->
      <!-- BEGIN DASHBOARD STATS 1-->
      <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <!-- Table -->
			<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');}?>
            <div class="portfolio-content portfolio-1">
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
              <div id="js-filters-juicy-projects" class="cbp-l-filters-button">
                  <!--<div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase"> All
                      <div class="cbp-filter-counter"></div>
                  </div>-->
              </div>
              <div id="js-grid-juicy-projects" class="cbp">
			 <?php
			 $n4 =0;
             if(sizeof($adverts)>0)
             {
                foreach($adverts as $ad)
                {
                /*$img = $this->General_model->get_data_rowusingwhere_empty_array('advertisements',"ad_id=".$report['id']);*/
                if($ad['ad_img']=='')
                {$src=base_url()."assets/front/global/img/no-image-box.png";}
                else{$src=base_url()."uploads/advertisement_images/".$ad['ad_img'];}
              ?>
              <div class="cbp-item">
              
              
              <div class="cbp-caption">
                        <div class="cbp-caption-defaultWrap">
                            <img src="<?php echo $src;?>"  alt="" style="width:262px; height:220px;"> 
                        </div>
                        <div class="cbp-caption-activeWrap">
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body">
                                 <a href="<?php echo base_url()?>alpha/edit_advertisement/<?php echo $this->encrypt_model->encode($ad['id'])?>"
                                  class=" btn red" >Edit</a>
                                 <a href="#" onclick="callCrudAction('advertisements','<?php echo $ad['id'];?>','delete_data')" 
                                 class="btn red " >Delete</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                  <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center"><?php 
                    echo $ad['title'];
                    ?></div>
                  <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center">
                   <?php //echo $report['title']?>
                  </div>
              </div>
              
              <?php 
			    
                } 
             } else {
				 ?>	
            <div class="note note-success">
                <h4 class="block"><i class="fa fa-info-circle"></i> Information</h4>
                <p style="color:black"> No Advertisement added at the moment. </p>
            </div>
		<?php	
				 
				 
				 
			 }?>
              </div>
              <!--<div id="js-loadMore-juicy-projects" class="cbp-l-loadMore-button">
                  <a href="../assets/global/plugins/cubeportfolio/ajax/loadMore.html" 
                  class="cbp-l-loadMore-link btn grey-mint btn-outline" rel="nofollow">
                      <span class="cbp-l-loadMore-defaultText">LOAD MORE</span>
                      <span class="cbp-l-loadMore-loadingText">LOADING...</span>
                      <span class="cbp-l-loadMore-noMoreLoading">NO MORE WORKS</span>
                  </a>
                  onclick="callCrudAction('advertisement','<?php  echo $ad['id'];?>','delete_data')" 
                 
              </div>-->
          </div>
            
            <?php /*?><table  class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="genral">
                <thead class="bg-gray">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(sizeof($adverts)>0)
                {
                foreach($adverts as $condo){
                ?>
                <tr class="gradeX">
                    <td><?php echo $condo['title'];?></td>
                    <td><?php echo $condo['description'];?></td>
                    <td><img src="<?php echo base_url();?>uploads/advertisement_images/<?php echo $condo['image_url'];?>" style="width:100px; height:100px;"></td>
                </tr>		
                <?php } 
                }?>
                </tbody>
            </table><?php */?>
             </div>
    	</div>
    <div class="clearfix"></div>
</div>