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
			  <?php if ($this->session->flashdata('message')) { ?>
                  <div class="alert alert-info"> 
                      <?= $this->session->flashdata('message') ?> 
                  </div>
              <?php } ?>
                <!-- BEGIN PAGE HEADER-->
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <div class="search-page search-content-4">
                     <div class="portlet light ">
                        <div class="portlet-body">
                         <table class="table table-striped table-bordered table-hover dt-responsive" width="100%"  id="genral">
                            <thead class="bg-blue">
                                <tr>
                                    <th><a href="javascript:;">Name</a></th>
                                    <th><a href="javascript:;">Email</a></th>
                                    <th><a href="javascript:;">Phone</a></th>
                                    <th><a href="javascript:;">Actions</a></th>
                                </tr>
                            </thead>
                            <!-- // Table heading END -->
                            <!-- Table body -->
                            <tbody>
                              <?php
                                if(sizeof($residents)>0)
                                 {
                                    foreach($residents as $resident)
                                    {
                                    ?>
                                        <!-- Table row -->
                                        <tr class="gradeX">
                                              <td class="table-title"><?php echo $resident['name']?></td>
                                              <td class="table-title font-blue"><?php echo $resident['email']?></td>
                                              <td class="table-title font-blue"><?php echo $resident['phone']?></td>	
                                              <td class="table-title">
                                              <a class="btn btn-primary" href="javascript:void(0)" title="Move"  data-toggle="modal" data-target="#myModal" onclick="change_modal_id('<?php echo $resident['id']?>')">Exit</a>
                                              <?php if($resident['status']!=1){?>
                                              <a class="btn btn-primary po_approve_resident_<?php echo $resident['id']?>" 
                                              href="javascript:void(0)" title="Approve" 
                                              onclick="po_approve_resident('<?php echo $resident['id']?>','1')">
                                                 Approve
                                              </a>
                                              <?php }?>
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
       
            <input type="hidden" name="resident_id" id="resident_id" value="" />   
              <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Exit Date</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="moved_date" name="moved_date" >
                        <span id="moved_date_validate" class="error_individual help-block"></span>
                    </div>
                </div>
                
           </div>
      </div>
      
      <div class="modal-footer">
        <button  class="btn btn-default" type="submit" name="moved_date_btn">Submit</button>
      </div>
      </form>
    </div>

  </div>
</div>

<script>
function change_modal_id(id)
	{
		$('#resident_id').val(id);
	}
var start = new Date();
$('#moved_date').datepicker({
	startDate : start,
	format:'yyyy-mm-dd',
})
</script>