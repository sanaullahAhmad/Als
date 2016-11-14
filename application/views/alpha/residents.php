<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title"> Residents
    </h3>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo base_url();?>">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Residents</span>
            </li>
        </ul>
        
    </div>
    
    <form class="form-horizontal" method="post" id="resident-search-form">
    <link href="<?php echo base_url();?>assets/front/global/plugins/chosen/chosen.css" rel="stylesheet" type="text/css" />
	<script src="<?php echo base_url();?>assets/front/global/plugins/chosen/chosen.js"></script>
    <div class="form-group">
        <label class="col-sm-2 control-label">Condo</label>
        <div class="col-sm-9">
            <select class="chosen" multiple="multiple" name="condos[]" id="condos" style="width: 100%;" 
            onchange="chang_block_residnets(this.value)">    
            	 <?php
				 /*if(sizeof($condos)>0)
                  {
                      foreach($condos as $condo)
                      {
                          ?>
                          <option value="<?php echo $condo['condo_id']?>" >
						  <?php echo $this->General_model->get_value_by_id('condos',$condo['condo_id'],'name');?>
                          </option>
                          <?php
                      }
                  }*/
				  $condos = $this->General_model->get_data_all('condos');
				  if(sizeof($condos)>0)
				  {
					  foreach($condos as $condo)
					  {
						  ?>
						  <option value="<?php echo $condo['id'];?>"><?php echo $condo['name'];?></option>
						  <?php
					  }
				  }
                  else
                  {
                      ?>
                          <option value="" >No Condos available</option>
                      <?php
                  }
                 ?>   
                  
            </select>   
            <span class="error_individual" id="condos_validate"></span>
        </div>
    </div> 
    <div class="form-group">
        <label class="col-md-2 control-label">Block</label>
        <div class="col-md-3 blocks_content">
            <select id="block" name="block" onchange="change_floors_blacklist(this.value)" class="form-control">
                <option value="">
                    Block
                </option>
                <?php
                  if(sizeof($blocks)>0)
                  {
                      foreach($blocks as $block)
                      {
                          ?>
                          <option value="<?php echo $block['block']?>" ><?php echo $this->General_model->get_value_by_id('blocks',$block['block'],'name')?></option>
                          <?php
                      }
                  }
                  else
                  {
                      ?>
                          <option value="" >No blocks available</option>
                      <?php
                  }
              ?>
            </select>
            <span class="error_individual" id="block_validate"></span>
        </div>
    </div>
    <div class="form-group"  >
        <label class="col-md-2 control-label">Floor</label>
        <div class="col-md-3" id="floors">
            <select name="floors" class="form-control">
                <option value="">
                    Floor
                </option>
            </select>
            <span class="error_individual" id="floors_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">Unit</label>
        <div class="col-md-3" id="unites">
            <select id="unit" name="unit" class="form-control" onchange="search_resident()">
                <option value="">
                    Unit
                </option>
            </select>
            <span class="error_individual" id="unit_validate"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label">&nbsp;</label>
        <div class="col-md-3" id="unites">
            <input type="submit" name="search_residents_btn" class="btn btn-primary" />
        </div>
    </div>
           
    <script>
        $('select.chosen').chosen();
    </script>
    </form>
    
    <!-- END PAGE HEADER-->
    <!-- BEGIN DASHBOARD STATS 1-->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- Table -->
		<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message');}?>
        <table class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="genral">
        
            <!-- Table heading -->
            <thead class="bg-gray">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Condo</th>
                    <th>Unit Info</th>
                    <th>Action</th>
                </tr>
            </thead>
            <!-- // Table heading END -->
            
            <!-- Table body -->
            <tbody>
            <?php
            if(sizeof($residents)>0)
            {
            foreach($residents as $condo){
            ?>
                <!-- Table row -->
                <tr class="gradeX">
                    <td><?php echo $condo['name'];?></td>
                    <td><?php echo $condo['email'];?></td>
                    <td><?php echo $condo['phone'];?></td>
                    <td><?php echo $this->General_model->get_value_by_id("condos",$condo['condo_id'],'name')?></td>
                    <td><?php echo $this->General_model->get_value_by_id('blocks', $condo['block'], 'name').'-'.$condo['floor'].'-'.$condo['unit'];?></td>
                    <td>
                    <?php if($condo['status']==0){?>
                    <a href="javascript:;" onclick="callCrudAction('residents',<?php echo $condo['id']?>,'activate_resident')" title="Activate">
                        <i class="glyphicon glyphicon-ok"></i>
                    </a>
                    <?php } else {?>
                     <a href="javascript:;" onclick="callCrudAction('residents',<?php echo $condo['id']?>,'suspend_resident')" title="Suspend">
                        <i class="fa fa-remove"></i>
                    </a>
                    <?php }?>
                    <a href="<?php echo base_url();?>alpha/view_profile/<?php echo $condo['id']?>" title="View Full Profile">
                        <i class="fa fa-eye"></i>
                    </a>
                    </td>
                </tr>
                <!-- // Table row END -->
                
                <?php } 
            }?>
            
                
                
                
            </tbody>
            <!-- // Table body END -->
            
        </table>
 		</div>
      </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>
<script>

	function change_floors_alpha(id)
	{
		var res='';
		$('#condos option:selected').each(function() {
			  res = res.concat('str'+$(this).val()+'='+$(this).val()+'&');
		  });
		  res = res.concat('id='+id);
			$.ajax({
			type: 'POST',
			data: res,
			url: '<?php echo base_url();?>alpha/change_floors_alpha', 
			success: function(result){
				$('#floors').html(result);
			}});
	}
	function change_unit_alpha(floor_id)
	{
		var res='';
		var block_id = $('#block').val();
		$('#condos option:selected').each(function() {
			  res = res.concat('str'+$(this).val()+'='+$(this).val()+'&');
		  });
		   res = res.concat('floor_id="'+floor_id+'"&block_id='+block_id);
			$.ajax({
			type: 'POST',
			data: res,
			url: '<?php echo base_url();?>alpha/change_unit_alpha', 
			success: function(result){
				
				
				$('#unites').html(result);
			}});
	}
	function chang_block_residnets(condo_id)
	{
		var res='';
		
		$('#condos option:selected').each(function() {
			  res = res.concat('str'+$(this).val()+'='+$(this).val()+'&');
		  });
			
			$.ajax({
			type: 'POST',
			data: res,
			url: '<?php echo base_url();?>alpha/chang_block_residnets', 
			success: function(result){
				$('.blocks_content').html(result);
			}});
	}
</script>
