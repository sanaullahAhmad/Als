<link href="<?php echo base_url();?>assets/front/pages/css/search.min.css" rel="stylesheet" type="text/css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><?php if(isset($page_title)){ echo $page_title;}?>      
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
                <div class="search-page search-content-1">
                   <div class="row">
                      <div class="col-md-12">
                         <div class="row">
                           
                           <div class="col-md-12">
                             <div class="search-container ">
                               <ul>
                                  <?php 
                                  if(sizeof($managment_posts)>0)
                                  {
                                      foreach($managment_posts as $manager_post)
                                      {
                                          $count=$this->General_model->get_data_all_like_using_where_count('archived_posts',"post_id=".$manager_post['id']);
                                        if($count>0){?>
                                          <li class="search-item clearfix">
                                              
                                              <?php
                                              $prof_pic = $manager_post['image_url'];
                                              if($prof_pic==''){$prof_pic=base_url().'assets/front/images/no-image.jpg';}
                                              else{$prof_pic=base_url().'uploads/post_images/'.$prof_pic;}
                                              ?>
                                                  
                                              <div class="search-content">
                                                  <h3 class="search-title">
                                                      <a href="<?php echo base_url()?>single_management_post/<?php echo $this->encrypt_model->encode($manager_post['id'])?>"><?php echo $manager_post['title'];?></a>
                                                  </h3>
                                                  <div class="blog-post-desc"> <?php echo substr($manager_post['description'],0,200)?> </div>
                                              </div>
                                          </li>
                                        <?php }
                                      }
                                   }
								   else
								  {
									  ?>
                                      <li class="search-item clearfix">
                                      <?php
									  echo "This Month have no archived posts";
									  ?>
                                      </li>
                                      <?php
								  }
                                  ?>
                              </ul>
                             </div>
                           </div>
                     </div>
                    <!--Archives starts-->
                      
                    <!--Archives end-->
                  </div>
                </div>
                 <?php
			  echo $this->load->view('template/feature_ad');
			  ?>
              </div>
              </div>
              <?php echo $this->load->view('template/sidebar');?> 
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>
<script>
function archived_posts_by_date(year,month)
{
	$('.search-container').html("Loading..");
	var queryString={
		year:year,
		month:month
	}
	jQuery.ajax({
			url: "<?php echo base_url()?>home/archived_posts_by_date",
			data:queryString,
			type: "POST",
			success:function(data){
				$('.search-container').html(data);
			},
		
			error:function (){
			}
		});
}
</script>