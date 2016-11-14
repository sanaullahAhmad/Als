<link href="<?php echo base_url();?>assets/front/pages/css/search.min.css" rel="stylesheet" type="text/css" />
<style>
.btn-width .btn
{
	width:16.2%;
}
h4
{
	font-weight:bold; font-size:16px;
}
</style>
<div class="page-content-wrapper"> 
  <!-- BEGIN CONTENT BODY --> 
  <!-- BEGIN PAGE HEAD-->
  <div class="page-head">
    <div class="container"> 
      <!-- BEGIN PAGE TITLE -->
      <div class="page-title">
        <h1>
          <?php if(isset($page_title)){ echo $page_title;}?>
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
          <div class="portlet light">
            <div class="search-page search-content-1">
              <div class="row">
                <div class="col-md-12">
                  <h4>2016</h4>
                  <div class="row">
                    <div class="col-md-12 btn-width">
                      <button type="button" onclick="archived_posts_by_date('2016','1')" class="btn blue">JAN</button>
                      <button type="button" onclick="archived_posts_by_date('2016','2')" class="btn blue">FEB</button>
                      <button type="button" onclick="archived_posts_by_date('2016','3')" class="btn blue">MAR</button>
                      <button type="button" onclick="archived_posts_by_date('2016','4')" class="btn blue">APR</button>
                      <button type="button" onclick="archived_posts_by_date('2016','5')" class="btn blue">MAY</button>
                      <button type="button" onclick="archived_posts_by_date('2016','6')" class="btn blue">JUN</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="height:20px;">&nbsp; </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 btn-width">
                      <button type="button" onclick="archived_posts_by_date('2016','7')" class="btn blue">JUL</button>
                      <button type="button" onclick="archived_posts_by_date('2016','8')" class="btn blue">AUG</button>
                      <button type="button" onclick="archived_posts_by_date('2016','9')" class="btn blue">SEP</button>
                      <button type="button" onclick="archived_posts_by_date('2016','10')" class="btn blue">OCT</button>
                      <button type="button" onclick="archived_posts_by_date('2016','11')" class="btn blue">NOV</button>
                      <button type="button" onclick="archived_posts_by_date('2016','12')" class="btn blue">DEC</button>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12" style="height:20px;">&nbsp; </div>
                </div>
                <div class="col-md-12">
                  <h4>2015</h4>
                  <div class="row">
                    <div class="col-md-12 btn-width">
                      <button type="button" onclick="archived_posts_by_date('2015','1')" class="btn red">JAN</button>
                      <button type="button" onclick="archived_posts_by_date('2015','2')" class="btn red">FEB</button>
                      <button type="button" onclick="archived_posts_by_date('2015','3')" class="btn red">MAR</button>
                      <button type="button" onclick="archived_posts_by_date('2015','4')" class="btn red">APR</button>
                      <button type="button" onclick="archived_posts_by_date('2015','5')" class="btn red">MAY</button>
                      <button type="button" onclick="archived_posts_by_date('2015','6')" class="btn red">JUN</button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12" style="height:20px;">&nbsp; </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 btn-width">
                      <button type="button" onclick="archived_posts_by_date('2015','7')" class="btn red">JUL</button>
                      <button type="button" onclick="archived_posts_by_date('2015','8')" class="btn red">AUG</button>
                      <button type="button" onclick="archived_posts_by_date('2015','9')" class="btn red">SEP</button>
                      <button type="button" onclick="archived_posts_by_date('2015','10')" class="btn red">OCT</button>
                      <button type="button" onclick="archived_posts_by_date('2015','11')" class="btn red">NOV</button>
                      <button type="button" onclick="archived_posts_by_date('2015','12')" class="btn red">DEC</button>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="search-container ">
                    <?php /*
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
                                                  <h2 class="search-title">
                                                      <a href="<?php echo base_url()?>single_management_post/<?php echo $this->encrypt_model->encode($manager_post['id'])?>"><?php echo $manager_post['title'];?></a>
                                                  </h2>
                                                  <div class="blog-post-desc"> <?php echo substr($manager_post['description'],0,40)?> </div>
                                              </div>
                                          </li>
                                        <?php }
                                      }
                                   }*/
                                  ?>
                  </div>
                  <!--Archives starts--> 
                  
                  <!--Archives end--> 
                </div>
              </div>
            </div>
          </div>
          <?php
			  echo $this->load->view('template/feature_ad');
			  ?>
        </div>
        <?php echo $this->load->view('template/sidebar');?> </div>
      <!-- END PAGE CONTENT INNER --> 
    </div>
  </div>
  <!-- END PAGE CONTENT BODY --> 
  <!-- END CONTENT BODY --> 
</div>
<script>
function archived_posts_by_date(year,month)
{
	//$('.search-container').html("Loading..");
	var queryString={
		year:year,
		month:month
	}
	jQuery.ajax({
			url: "<?php echo base_url()?>home/archived_posts_by_date",
			data:queryString,
			type: "POST",
   			async: false,
			success:function(data){
				//window.location.href='<?php echo base_url()?>home/month_archived_posts';
				//window.open('<?php echo base_url()?>home/month_archived_posts','_blank');
				var redirectWindow = window.open('<?php echo base_url()?>home/month_archived_posts','_blank');
    			redirectWindow.location;
				//$('.search-container').html(data);
			},
		
			error:function (){
			}
		});
}
function openInNewTab(url) {
    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
}
</script>