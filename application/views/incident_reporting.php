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
                          <div class="portfolio-content portfolio-1">
                              <div id="js-filters-juicy-projects" class="cbp-l-filters-button">
                                  <div data-filter="*" class="cbp-filter-item-active cbp-filter-item btn dark btn-outline uppercase"> All
                                      <div class="cbp-filter-counter"></div>
                                  </div>
                                  <div data-filter=".Waitng" class="cbp-filter-item btn dark btn-outline uppercase"> Waiting
                                      <div class="cbp-filter-counter"></div>
                                  </div>
                                  <div data-filter=".Solved" class="cbp-filter-item btn dark btn-outline uppercase"> Resolved
                                      <div class="cbp-filter-counter"></div>
                                  </div>
                                  <div data-filter=".Rejected" class="cbp-filter-item btn dark btn-outline uppercase"> Rejected
                                      <div class="cbp-filter-counter"></div>
                                  </div>
                              </div>
                              <div id="js-grid-juicy-projects" class="cbp">
                                  
                                  
                                   <?php
                                      foreach($reports as $report){
                                                  if($report['status']==0){
                                                  $status="Waitng";
                                                  }
                                                  elseif($report['status']==1){
                                                  $status="Solved";
                                                  }
                                                  elseif($report['status']==2){
                                                  $status="Rejected";
                                                  }
                                      $img = $this->General_model->get_data_rowusingwhere_empty_array('incident_images',"incident_id=".$report['id']);
                                      if(sizeof($img)>0)
                                      {$src=base_url()."uploads/incident_images/".$img->image_url;}
                                      else{$src=base_url()."assets/front/global/img/no-image-box.png";}
                                    ?>
                                          
                                          <div class="cbp-item <?php echo $status;?>">
                                              <div class="cbp-caption">
                                                  <div class="cbp-caption-defaultWrap">
                                                      <img src="<?php echo $src;?>" alt="" style="height:300px"> </div>
                                                  <div class="cbp-caption-activeWrap">
                                                      <div class="cbp-l-caption-alignCenter">
                                                          <div class="cbp-l-caption-body">
                                                              <a href="<?php echo base_url()?>home/show_incident_details/<?php echo $report['id'];?>"
                                                              class="cbp-singlePage cbp-l-caption-buttonLeft btn red uppercase btn red uppercase" 
                                                              rel="nofollow">more info</a>
                                                              <a href=<?php echo $src;?>" class="cbp-lightbox cbp-l-caption-buttonRight btn red uppercase btn red uppercase" data-title="Dashboard"><br>by Paul Flavius Nechita">view larger</a>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center"><?php echo substr($report['description'],0,30)?></div>
                                              <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center">
                                               <?php 
                                                echo $this->General_model->get_value_by_id('incident_categories',$report['incident_category'],'name');
                                                ?>
                                              </div>
                                          </div>
                                          
                                          <!-- Table row -->
                                          <!--<tr class="gradeX">
                                              <td class="table-status">
                                                  <?php echo $status; ?>
                                              </td>
                                              <td class="table-date font-blue">
                                                  <?php echo date('F d, Y  h:i A', strtotime($report['reported_date']))?>
                                              </td>
      
                                              <td class="table-title">
                                               <h3>
                                                <?php 
                                                echo $this->General_model->get_value_by_id('incident_categories',$report['incident_category'],'name');
                                                ?>
                                                </h3>
                                              </td>
                                              <td class="table-desc">
                                                <?php echo substr($report['description'],0,50)?>...<a href="javascript:;">More</a>
                                              </td>
                                              
                                              <td class="table-desc">
                                                  <?php if($report['incident_log']==''){?>
                                                  No log
                                                  <?php }else{
                                                  echo substr($report['incident_log'],0,50);?>
                                                  <?php
                                                  }?>
                                              </td>
                                              
                                          </tr>-->
                                          <!-- // Table row END -->
                                          
                                          <?php 
                                          } ?>
                                
                              </div>
                              <div id="js-loadMore-juicy-projects" class="cbp-l-loadMore-button">
                                  <a href="../assets/global/plugins/cubeportfolio/ajax/loadMore.html" class="cbp-l-loadMore-link btn grey-mint btn-outline" rel="nofollow">
                                      <span class="cbp-l-loadMore-defaultText">LOAD MORE</span>
                                      <span class="cbp-l-loadMore-loadingText">LOADING...</span>
                                      <span class="cbp-l-loadMore-noMoreLoading">NO MORE WORKS</span>
                                  </a>
                              </div>
                          </div>
                          
                          
                      </div>
                  </div>
            </div>
            
            
		<!--<script src="<?php echo base_url()?>assets/front/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" 
		type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url()?>assets/front/global/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript">
        </script>
        <script src="<?php echo base_url()?>assets/front/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/pages/scripts/portfolio-1.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>assets/front/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>-->   
            
            
            
            
            
            