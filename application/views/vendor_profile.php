<script src="<?php echo base_url()?>assetsfrontpagesscripts/profile-1.js"></script>
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/profile-2.min.css" />
<style>
.tab-pane p strong
{
	font-weight:normal;
}
.profile-info li {
    color: #ddd;
    font-size: 18px;
    margin-bottom: 5px;
    margin-right: 8px;
    padding: 0 !important;
}
.profile-info h1
{
	font-size:20px; color:#000 !important;
}
</style>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Vendor Profile
                    <small></small>
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
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        
                        <div class="tab-content" style="border:0px; padding-top:5px;">
                            <div class="tab-pane active" id="tab_1_1">
                                <div class="row">
                                    <div class="col-md-3">
                                        <ul class="list-unstyled profile-nav">
                                            <li>
                                                 <?php
												$prof_pic = $vendor_details->image_url;
												if($prof_pic==''){$prof_pic=base_url().'assets/front/images/no-image.jpg';}
												else{$prof_pic=base_url().'uploads/vendor_images/'.$prof_pic;}
												?>
                                                <img src="<?php echo $prof_pic;?>"  class="img-responsive pic-bordered" alt=""/>
                                                </a>
                                            </li>
                                           
                                        </ul>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-12 profile-info">
                                                <h1 class="font-green sbold uppercase"><?php echo $vendor_details->company_name;?></h1>
                                                <!--<p> <?php //echo $vendor_details->description;?> </p>-->
                                                
                                                 <?php
													$action="quoted_by=".$vendor_details->id." AND ven_arival_time<NOW()";
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
														//echo "No Rating Yet";
														$my_rating ='';
													}
													else
													{
														/*echo*/ $my_rating = $vendor_rating/$n;
													}
													?>
                                                    <div>
                                                    <ul class="ratting-ul">
                                                      <?php
                                                      for($i=1;$i<=5;$i++) {
                                                      $selected = "";
                                                      if(!empty($my_rating) && $i<=$my_rating) {
                                                        $selected = "selected";
                                                      }
                                                      ?>
                                                      <li class='<?php echo $selected; ?>' >&#9733;</li>  
                                                      <?php }  ?>
                                                    <ul>
                                                    
                                                    </div>
                                                  <!--<table class="demo-table">
                                                  <tbody>
                                                  <tr>
                                                  <th><strong>Ratings</strong></th>
                                                  </tr>
                                                  <tr>
                                                    <td valign="top">
                                                    <div>
                                                    <ul>
                                                      <?php
                                                      for($i=1;$i<=5;$i++) {
                                                      $selected = "";
                                                      if(!empty($my_rating) && $i<=$my_rating) {
                                                        $selected = "selected";
                                                      }
                                                      ?>
                                                      <li class='<?php echo $selected; ?>' >&#9733;</li>  
                                                      <?php }  ?>
                                                    <ul>
                                                    </div>
                                                    </td>
                                                  </tr>
                                                  </tbody>
                                                  </table>-->
                                                  ( 0 )
                                                
                                                
                                                <p style="float:right; margin:0px;">
                                                	&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <i class="fa fa-phone"></i> &nbsp; <?php echo $vendor_details->phone;?>
                                                </p>
                                                <p style="float:right; margin:0px;">
                                                    <a href="mailto:<?php echo $vendor_details->email;?>">
														<i class="fa fa-globe"></i> &nbsp;<?php echo $vendor_details->email;?> 
                                                    </a>
                                                </p>
                                                
                                                <p style="float:left; width:100%; margin:0px 0px 10px;"> <?php echo $vendor_details->address;?> </p>
                                                
                                            </div>
                                            <!--end col-md-8-->
                                            
                                            <!--end col-md-4-->
                                        </div>
                                        <!--end row-->
                                        <div class="tabbable-line tabbable-custom-profile">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab_1_22" data-toggle="tab"> Overview </a>
                                                </li>
                                                <li class="">
                                                    <a href="#tab_1_23" data-toggle="tab"> Feedback </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                
                                                <!--tab-pane-->
                                                <div class="tab-pane active" id="tab_1_22">
                                                    <p> <?php echo $vendor_details->description;?> </p>
                                                </div>
                                                <div class="tab-pane" id="tab_1_23">
                                                	<div class="tab-pane active" id="tab_1_1_1">
                                                        <div class="scroller" data-height="290px" data-always-visible="1" data-rail-visible1="1">
                                                            <ul class="feeds">
                                                            <?php 
															if(sizeof($vendor_com)>0)
															{
																foreach($vendor_com as $comment)
																{
																	?>
																	<li>
                                                                    <div class="col1">
                                                                        <div class="cont">
                                                                            <div class="cont-col1">
                                                                                <div class="label label-danger">
                                                                                    <i class="fa fa-bolt"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="cont-col2">
                                                                                <div class="desc"> <?php echo $comment['feedback'];?> </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col2">
                                                                        <div class="date"> 
																		<?php echo $this->General_model->nicetime2($comment['ven_arival_time']);?>
                                                                        </div>
                                                                    </div>
                                                                </li>
																	<?php
																}
															}
															else
															{
																 ?>
																 <li>
                                                                    <div class="col1">
                                                                        <div class="cont">
                                                                            <div class="cont-col1">
                                                                                <div class="label label-danger">
                                                                                    <i class="fa fa-bolt"></i>
                                                                                </div>
                                                                            </div>
                                                                            <div class="cont-col2">
                                                                                <div class="desc"> No comments at the moment. </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col2">
                                                                        <div class="date"> 
																		
                                                                        </div>
                                                                    </div>
                                                                </li>
																 <?php
															}
															?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--tab-pane-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--tab_1_2-->
                            
                            <!--end tab-pane-->
                            
                            <!--end tab-pane-->
                        </div>
                    </div>
                </div>
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