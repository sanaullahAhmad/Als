<link href="<?php echo base_url();?>assets/front/pages/css/blog.min.css" rel="stylesheet" type="text/css">
<div class="page-container">
<div class="page-content-wrapper">
<div class="page-head">
<div class="container">
    <!-- BEGIN PAGE BREADCRUMBS -->
    <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Management Posts
            </h1>
        </div>
</div>
</div>
   <!-- END PAGE TITLE -->

    <!-- END PAGE BREADCRUMBS -->
    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="page-content">
    <div class="container">
    <div class="page-content-inner">
        <div class="blog-page blog-content-1">
            <div class="row">
                            <?php
                	if(sizeof($managment_posts)>0)
					{
						foreach($managment_posts as $manager_post)
						{
				?>

                <div class="col-lg-6">
                    <div class="blog-post-lg bordered blog-container">
                        <div class="blog-img-thumb">
                            <a href="<?php echo base_url()?>single_management_post/<?php echo $this->encrypt_model->encode($manager_post['id'])?>">
                                <img src="<?php echo base_url()?>uploads/post_images/<?php echo $manager_post['image_url']?>" />
                            </a>
                        </div>
                        <div class="blog-post-content">
                            <h2 class="blog-title blog-post-title">
                                <a href="<?php echo base_url()?>single_management_post/<?php echo $this->encrypt_model->encode($manager_post['id'])?>"><?php echo $manager_post['title']?></a>
                            </h2>
                            <p class="blog-post-desc"> <?php echo substr($manager_post['description'],0,40)?> </p>
                            
                        </div>
                    </div>                   
                </div>
                   <?php
						}
					}?>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
</div>
</div>