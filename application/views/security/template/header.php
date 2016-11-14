<li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default" style="display:none"> </li>
<div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="<?php echo base_url()?>security">
                        <img src="<?php echo base_url()?>assets/front/layouts/layout2/img/logo-new1.png" 
                        alt="logo" class="logo-default" width="140"/> 
                    </a>
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE ACTIONS -->
                <!-- DOC: Remove "hide" class to enable the page header actions -->
                
                <!-- END PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                   <form class="search-form search-form-expanded" action="page_general_search_3.html" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?php echo $this->General_model->get_value_by_id('condos',$this->condo_id,'name');?>" name="query" style="font-weight:bold !important;font-size: 22px">
                          
                          
                        </div>
                         
                    </form>
                    
                
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li class="dropdown dropdown-user">
                     <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                     
                              <img src="<?php echo base_url()?>assets/front/global/img/no-image.jpg"  alt="" class="" />
                     
                                    
                      <span class="username username-hide-on-mobile"> 
                          <?php echo $this->session->userdata('security_name');?> 
                      </span>
                      <i class="fa fa-angle-down"></i>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-default">
                            <li><a href="<?php echo base_url()?>security/profile"><i class="icon-user"></i> Profile</a></li>
                            <li class="divider"> </li>
                            <li><a href="<?php echo base_url()?>security/change_password"><i class="icon-pencil"></i>Change Password</a></li>
                            <li class="divider"> </li>
                            <li><a href="<?php echo base_url()?>security/do_logout"><i class="icon-key"></i>Logout</a></li>
                            
                        </ul>
                       </li>
                            
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>