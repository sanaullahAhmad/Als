<link href="<?php echo base_url();?>assets/front/pages/css/profile-2.min.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><?php echo $title;?>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE CONTENT BODY -->
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE BREADCRUMBS -->
            
            <!-- END PAGE BREADCRUMBS -->
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="page-content-inner">
            	<div class="left-post">
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
                                    <!--<div class="col-md-6">
                                        <ul class="list-unstyled profile-nav">
                                            <li>
                                              <a class="fancybox" rel="group_<?php echo $post_details->id;?>" 
                                              href="<?php echo base_url()?>uploads/post_images/<?php echo $post_details->image_url?>">
                                                <img src="<?php echo base_url();?>uploads/post_images/<?php echo $post_details->image_url;?>" 
                                                class="img-responsive pic-bordered" alt=""  />
                                              </a>
                                            </li>
                                        </ul>
                                    </div>-->
                                    
                                  <div class="col-md-12">
                                  <!--<h3 class="font-green sbold uppercase">
								  	<?php echo $post_details->title;?>
                                  </h3>
-->                                  <p style="margin-top:0px;">
								  	<?php echo $post_details->description;?>
                                  </p>
                                  </div>
                                
                                    <div class="col-md-12">
                                        
                                            <div class="profile-info">
                                                
                                                    
               <?php $posts_images=$this->General_model->get_data_all_using_where('post_id',$post_details->id,'posts_images');
                      if(sizeof($posts_images)>0)
                      {
                          foreach($posts_images as $posts_image)
                          {
							if(pathinfo($posts_image['image_url'], PATHINFO_EXTENSION)=='pdf')
							{
								echo '<div style="clear:both"><a href="'.base_url().'uploads/post_images/'.$posts_image['image_url'].'" target="_blank"> '. $posts_image['image_url'].'</a></div>';
							}
							else
							{
								?>
								<a class="fancybox" rel="group_<?php echo $post_details->id;?>" 
								  href="<?php echo base_url()?>uploads/post_images/<?php echo $posts_image['image_url']?>">
									  <img src="<?php echo base_url()?>uploads/post_images/<?php echo $posts_image['image_url']?>" 
									  height="131"/>
								</a>
					  <?php } 
						}
                    }?>		
                                                    
                                               
                                            </div>
                                            
                                    </div>
                                </div>
                                
                            </div>
                            <!--tab_1_2-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
            
            	<?php echo $this->load->view('template/sidebar');?>
            
            </div>
            
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>