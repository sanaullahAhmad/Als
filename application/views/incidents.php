<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">
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
            
            <!--<div class="page-title pull-right">
                <a href="<?php echo base_url()?>all_incidents" class="btn btn-primary pull-right">Reported Incidents</a>

            </div>-->
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE CONTENT BODY -->
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="page-content-inner">
                <div class="left-post">
                  <div class="portlet light">
                    <!--<div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase"><?php if(isset($title)){ echo $title;}?>
                            Form
                            </span>
                        </div>
                        <div class="actions">
                            
                        </div>
                    </div>-->
                    <div class="portlet-body form">
                     <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-info"> 
                            <?= $this->session->flashdata('message') ?> 
                        </div>
                    <?php } ?>
                    <form class="form-horizontal" role="form"  id="incident-reporting" method="post">
                        <div class="form-body">
                        <div class="form-group">
                                <label class="col-md-3 control-label">Category</label>
                                <div class="col-md-9">
                                    <select class="form-control" id="incident_category" name="incident_category">
                                      <?php
                                      if(sizeof($incident_categories)>0)
                                      {
                                          foreach($incident_categories as $incident_category)
                                          {
                                              ?>
                                              <option value="<?php echo $incident_category['id'];?>">
                                                  <?php echo $incident_category['name'];?>
                                              </option>
                                              <?php
                                          }
                                      }
                                      ?>
                                    </select>
                                    <span class="error_individual" id="incident_category_validate"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>
                                <div class="col-md-9">
                                      <textarea name="incident_report" id="incident_report" placeholder="Please describe the incident in detail" class="form-control"  maxlength="150"></textarea>
                                      <input type="hidden" name="images_ids" id="images_ids" value="0" />
                                      <span id="incident_report_validate" class="error_individual help-block"></span>
                                </div>
                            </div>
                            
                            <?php /*?>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Attachment</label>
                                <div class="col-md-9" style="position:relative">
                                     <div id="queue" style="float:right"></div>
                                      <input id="incidents_file_upload" name="file_upload" type="file" multiple="true">
                                      <span id="incidents_span"></span>
                                </div>
                            </div>
                            <?php */?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Attachment</label>
                                <div class="col-sm-9">
                                    <span class="btn btn-success fileinput-button" style="margin-bottom:10px;">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Select files...</span>
                                        <input id="incidents_file_upload" type="file" name="file_upload" multiple>
                                    </span>
                                    <div id="progress_loading" style="margin-top: 10px; width:100%; display:none; clear:both;">
                                      Loading...
                                    </div>
                                    <div id="progress" class="progress" style="margin-top: 10px; width:50%; display:none; height:10px;">
                                      <div class="progress-bar progress-bar-success"></div>
                                  	</div>
                                    <div id="files" class="files" style="clear:both;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" name="incidentreportingsub" id="incidentreportingsub"  class="btn green">Submit</button>
                                    <a href="<?php echo base_url();?>dashboard" class="btn default">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                    
                  </div>  
                   <?php
			  echo $this->load->view('template/feature_ad');
			  ?>      
                </div>
                 <?php echo $this->load->view('template/sidebar');?>
            </div>
        </div>
    </div>
</div>