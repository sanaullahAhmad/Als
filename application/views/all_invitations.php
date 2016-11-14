<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/front/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>assets/front/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript" ></script>

<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/search.min.css" />
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>
                    <?php if(isset($title)){ echo $title;}?>                                
                </h1>
            </div>
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE CONTENT BODY -->
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="page-content-inner">
              <div class="left-post">
			  <?php if ($this->session->flashdata('message')) { 
			  echo $this->session->flashdata('message');
			   } ?>
                <!-- BEGIN PAGE HEADER-->
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="search-page search-content-4">
                     <div class="portlet light ">
                        <div class="portlet-body">
                         <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="genral">
                            <thead class="bg-blue">
                                <tr>
                                    <th><a href="javascript:;">Email</a></th>
                                    <th><a href="javascript:;">Type</a></th>
                                    <th><a href="javascript:;">Actions</a></th>
                                </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                              <?php
                                if(sizeof($invitations)>0)
                                 {
                                    foreach($invitations as $resident)
                                    {
                                    ?>
                                        <!-- Table row -->
                                        <tr class="gradeX">
                                              <td class="table-title font-blue"><?php echo $resident['email']?></td>
                                              <td class="table-title font-blue"><?php if($resident['resi_type']==2){ echo "Owner";} elseif($resident['resi_type']==1){ echo "Tanent";} elseif($resident['resi_type']==11){ echo "Primary Owner";}?></td>	
                                              <td class="table-title">
                                              <a class="btn btn-primary" href="javascript:void(0)" title="Move"  data-toggle="modal" data-target="#myModal" onclick="change_modal_id('<?php echo $resident['id']?>','<?php echo $resident['email']?>')">Edit</a>
                                    <!--  -->
                                              </td>
                                        </tr>
                                       <?php
                                        }
                                    }?>
                                    </tbody>
                                </table>
                               </div>
                            </div>
                        </div>
              </div>
			  <?php echo $this->load->view('template/sidebar');?> 
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">User will be permanently deleted after this date</h4>
      </div> 
      <form method="POST" id="user-management-moved-date" class="form-horizontal">   
      <div class="modal-body">
       
            <input type="hidden" name="resident_invite_id" id="resident_invite_id" value="" />   
              <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Email</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="email" name="email" >
                        <span id="moved_date_validate" class="error_individual help-block"></span>
                    </div>
                </div>
                
           </div>
      </div>
      
      <div class="modal-footer">
        <button  class="btn btn-default" type="submit" name="edit_email_btn">Submit</button>
      </div>
      </form>
    </div>

  </div>
</div>

<script>
function change_modal_id(id,email)
	{
		$('#resident_invite_id').val(id);
		$('#email').val(email);
	}
var start = new Date();
</script>