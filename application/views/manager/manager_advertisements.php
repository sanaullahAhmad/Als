<div class="page-content">
  <!-- BEGIN PAGE HEADER-->
  <h3 class="page-title"><?php echo $title;?>
      <small></small>
  </h3>
  <div class="page-bar">
      <ul class="page-breadcrumb">
          <li>
              <i class="icon-home"></i>
              <a href="<?php echo base_url();?>manager">Home</a>
              <i class="fa fa-angle-right"></i>
          </li>
          <li>
              <span><?php echo $title;?></span>
          </li>
      </ul>
      
  </div>
  <!-- END PAGE HEADER-->
  <!-- BEGIN DASHBOARD STATS 1-->
  <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <!-- Table -->
		<?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-info" > 
                <?= $this->session->flashdata('message') ?> 
            </div>
        <?php } ?>                                                           
        <!-- Table -->
        <table   class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
        
            <!-- Table heading -->
            <thead class="bg-gray">
                <tr>
                    <th>Posted By</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <!-- // Table heading END -->
            
            <!-- Table body -->
            <tbody>
            <?php
            foreach($adverts as $advert){
            ?>
                <!-- Table row -->
                <tr class="gradeX">
                    <td><?php echo $this->General_model->get_value_by_id('residents',$advert['advert_by'],'name')?></td>
                    <td><?php echo $advert['title']?></td>
                   <td id="<?php echo $advert['id'];?>">
                        <a href="<?php echo base_url()."uploads/advertisement_images/".$advert['image_url']?>">
                                    <img src="<?php echo base_url()."uploads/advertisement_images/".$advert['image_url']?>"  width="100" height="100" data-toggle="modal" data-target="#myModal2" onclick="show_image('modal_image_<?php echo $advert['id'];?>')" id="modal_image_<?php echo $advert['id'];?>"/>
                                </a>
                    </td>
                    <td id="advert_id_<?php echo $advert['id']?>">
                    <?php if($advert['status']==0){?>
                        <a class="" href="javascript:;" onclick="approve_advert('<?php echo $advert['id']?>','1')" title="Approve">
                            <span class="glyphicon glyphicon-ok"></span>
                        </a>
                        <a class="" href="javascript:;" onclick="approve_advert('<?php echo $advert['id']?>','3')" title="Disapprove">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    <?php 
                    }elseif($advert['status']==1){ echo "Approved";}
                    elseif($advert['status']==3){ echo "DisApproved";}
                    ?>
                    </td>
                </tr>
                <!-- // Table row END -->
                
                <?php 
                } ?>
            </tbody>
            <!-- // Table body END -->
        </table>
		 </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Incident Log</h4>
      </div>
      <form method="post">
      <div class="modal-body">
        <textarea class="form-control" name="incident_log" id="incident_log"></textarea>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="incident_id" id="incident_id" />
        <button type="button" class="btn btn-default"  onclick="incident_log_sub()">Submit</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Reciept</h4>
      </div>
      <div class="modal-body">
        <img src="" class="updatesrc" style="max-width:550px;"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
function show_image(id)
{
	var src = $("#"+id).attr('src');
	//alert(id);
	$('.updatesrc').attr('src',src);
}
</script>