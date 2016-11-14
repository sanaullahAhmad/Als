<link href="<?php echo base_url();?>assets/front/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
<div class="page-content">
      <!-- BEGIN PAGE HEADER-->
      <h3 class="page-title"> Advertisemt Details
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
                  <span>Advertisemt Details</span>
              </li>
          </ul>
      </div>
      <!-- END PAGE HEADER-->
      <!-- BEGIN DASHBOARD STATS 1-->
      <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <!-- Table -->
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <!--<ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1_1" data-toggle="tab"> Overview </a>
                            </li>
                        </ul>-->
                        <div class="tab-content" style="border:0px; padding-top:0px; padding-bottom:0px;">
                            <div class="tab-pane active" id="tab_1_1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-unstyled profile-nav">
                                            <li>
                                                <img src="<?php echo base_url();?>uploads/advertisement_images/<?php echo $post_details->image_url;?>" class="img-responsive pic-bordered" alt="" />
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12 profile-info">
                                               
                                                <div class="row">
                                                    <div class="col-md-12">
               <?php $posts_images=$this->General_model->get_data_all_using_where('advert_id',$post_details->id,'adverts_images');
                      if(sizeof($posts_images)>0)
                      {
                          foreach($posts_images as $posts_image)
                          {
                          ?>
                          <a class="fancybox" rel="group_<?php echo $post_details->id;?>" 
                            href="<?php echo base_url()?>uploads/advertisement_images/<?php echo $posts_image['image_url']?>">
                                <img src="<?php echo base_url()?>uploads/advertisement_images/<?php echo $posts_image['image_url']?>" 
                                height="131"/>
                          </a>
                    <?php }
                    }?>		
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-md-8-->
                                            
                                            <!--end col-md-4-->
                                        </div>
                                        <!--end row-->
                                        
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3 class="font-green sbold uppercase">
                                           <?php echo $post_details->title;?>
                                        </h3>
                                        <p> 
                                            <?php echo $post_details->description;?>
                                        </p>                                
                                    </div>
                                </div>
                            </div>
                            <!--tab_1_2-->
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    <div class="clearfix"></div>
</div>