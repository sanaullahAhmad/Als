<link href="<?php echo base_url();?>assets/front/pages/css/search.min.css" rel="stylesheet" type="text/css" />
<style>
.right-post-img
{
	float:none;
}
.search-content-1 .search-container > ul .search-item > .search-content > .search-title {
    color: #000;
    font-size: 20px;
    font-weight: 600;
    margin: 0 0 20px;
}
.search-content-1 .search-container > ul .search-item > .search-content > .search-title > a:hover, .search-content-1 .search-container > ul .search-item > .search-content > .search-title > a:focus
{
	color:#20bb6b; text-decoration:none;
}
.search-content-1 .search-container > ul .search-item > a > img {
    height: 81px;
	max-width:100%;
}
.demo-table th {
    background: #eff3f8 none repeat scroll 0 0 !important;
    color: #4e5a64 !important;
}
.demo-table li
{
	color:#4e5a64 !important;
}
.demo-table .highlight, .demo-table .selected {
    color: #f4b30a !important;
    text-shadow: 0 0 1px #f48f0a;
}
.search-content-1 .search-container > ul .search-item > .search-content > .search-title
{
	font-size:17px;
}
</style>
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
                <div class="search-page search-content-1">
                <div class="search-bar ">
                            <form method="get">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn blue uppercase bold" type="submit">Search</button>
                                </span>
                            </div>
                        </div>
                        <!--<div class="col-md-5">
                            <p class="search-desc clearfix"> Type vendor name here  like ABC, Sdn, Bhd. </p>
                        </div>-->
                    </div>
                            </form>
                </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="search-container ">
                        <ul>
                            <?php
                            if(sizeof($vendors)>0)
                            {
                                foreach($vendors as $vendor)
                                {
                                  //check if this vendor have any subscription of condos
								  $action = " vendor_id=".$vendor['id'];
								  $vendor_condos=$this->General_model->get_data_all_like_using_where('sp_condos_subscription', $action);
								  if(sizeof($vendor_condos)>0)//if yes 
                            		{
										$ven_sub_condos=array();
										foreach($vendor_condos as $ven_con)
										{
											array_push($ven_sub_condos,$ven_con['condo_id']);
										}
										if(in_array($this->condo_id, $ven_sub_condos))//than check if this vendor have subcribed for this condo
										{
											?>
											<li class="search-item clearfix">
                                        <a href="javascriptt:;">
                                        <?php
                                        $prof_pic = $vendor['image_url'];
                                        if($prof_pic==''){$prof_pic=base_url().'assets/front/images/no-image.jpg';}
                                        else{$prof_pic=base_url().'uploads/vendor_images/'.$prof_pic;}
                                        ?>
                                            <img src="<?php echo $prof_pic;?>" />
                                        </a>
                                        <div class="search-content">
                                          <h2 class="search-title">
                                                <a href="<?php echo base_url()?>vendor_profile/<?php echo $this->encrypt_model->encode($vendor['id'])?>"><?php echo $vendor['company_name'];?></a>
                                          </h2>
                                          <ul class="ratting-ul">
											  <?php
                                          $action="quoted_by=".$vendor['id']." AND ven_arival_time<NOW()";
                                          $rating = $this->General_model->get_data_all_like_using_where('service_quotes', $action);
                                          $vendor_rating =0;
                                          $n=0;
                                          if(sizeof($rating)>0)
                                          {
                                              foreach($rating as $rat)
                                              {
                                                  $vendor_rating +=$rat['rating'];
                                                  $n++;
                                              }
                                          }
                                          if($n==0)
                                          {
                                              $my_rating ='0';
                                          }
                                          else
                                          {
                                              $my_rating = $vendor_rating/$n;
                                          }
                                          
                                              for($i=1;$i<=5;$i++) {
                                              $selected = "";
                                              if(!empty($my_rating) && $i<=$my_rating) {
                                                $selected = "selected";
                                              }
                                              ?>
                                              <li class='<?php echo $selected; ?>' >&#9733;</li>  
                                              <?php }  ?>
                                              <li>( <?php echo $my_rating;?> )</li>
                                              
                                            </ul> 
                                            <!--<div style="float:right; color:#666">Ratting ( <?php echo $my_rating;?> )</div>-->
                                            <p>
                                            	<?php echo  $vendor['address'];?>
                                            </p>
                                            <p>
                                            	<?php echo  strip_tags($vendor['phone']);?>
                                            </p>
                                        
                                      </div>
                                    </li>
											<?php
										}
									}
									else//if no specific condos selection show him no 
									{
								    ?>
                                    
                                    <?php
									}
                                }
                            }
							else
							{
								echo"<h4 style='margin-top:12px; float:left;'>Sorry! No vendors available</h4>";
							}
                            ?>
                        </ul>
                        <div class="search-pagination">
                            <ul class="pagination">
                            <?php 
                                echo $pagination;
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
                  </div>
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



<style>
.demo-table {width: 100%;border-spacing: initial;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333;}
.demo-table th {background: #999;padding: 5px;text-align: left;color:#FFF;}
.demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
.demo-table td div.feed_title{text-decoration: none;color:#00d4ff;font-weight:bold;}
.demo-table ul{margin:0;padding:0;}
.demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
.demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
</style>