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
      <a href="<?php echo base_url();?>manager/add_knowledge_base" style="float:right; margin-right:20px; margin-top:15px;" class="btn btn-primary"  >Add Knowledge Base</a>
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
<div class="widget">
	<div class="widget-head">
		<h4 class="heading">Contacts</h4>
	</div>
	<div class="widget-body innerAll inner-2x">												
        <table class="table  table-bordered dt-responsive nowrap" id="genral"  cellspacing="0" width="100%">
            <thead class="bg-gray">
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Privacy</th>
                    <?php /*?><th>Attachement</th><?php */?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
			<?php if(sizeof($knowledge_base)>0){?>	
            <?php
            foreach($knowledge_base as $knowledge){
            ?>
                <tr class="gradeX">
                    <td><?php echo $knowledge['name'];?></td>
                    <td><?php echo substr($knowledge['description'],0,40);?></td>
                    <td><?php if($knowledge['privacy']==1){echo "Public";}else{echo "Private";}?></td> 
                    <?php /*?><td>
                    	<a href="<?php echo base_url();?>uploads/knowledge_base/<?php echo $knowledge['image_url'];?>" target="_blank">
                    		Click here
                        </a>
                    </td><?php */?>
                    <td id="advert_id_<?php echo $knowledge['id']?>">
                        <a href="<?php echo base_url()?>manager/edit_knowledge_base/<?php echo $knowledge['id']?>" title="Edit">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a onclick="callCrudAction('knowledge_base','<?php echo $knowledge['id']?>','delete_data')" href="javascript:;" title="delete">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </td>
                </tr>
                <?php } ?>
<?php }?>
            </tbody>
        </table>
	</div>
</div>	
		 </div>
     </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>