<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title"> Dashboard
        <small>dashboard & statistics</small>
    </h3>
    <a href="<?php echo base_url()?>alpha/add_condo" class="btn btn-primary condo-btn pull-right" >Add Condo</a>
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="icon-home"></i>
                <a href="<?php echo base_url();?>">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span>Condos</span>
            </li>
        </ul>
        
    </div>
    <!-- END PAGE HEADER-->
    <!-- BEGIN DASHBOARD STATS 1-->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
            <table  class="table table-striped table-bordered table-hover dt-responsive" width="100%" id="genral">
                <!-- Table heading -->
                <thead class="bg-gray">
                    <tr>
                        <th>Condo Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        
                        <th>Action</th>
                    </tr>
                </thead>
                <!-- // Table heading END -->
                <!-- Table body -->
                <tbody>
                <?php
                foreach($condos as $condo){
                ?>
                    <!-- Table row -->
                    <tr class="gradeX">
                        <td><?php echo $condo['name']?></td>
                        <td><?php echo $condo['email']?></td>
                        <td><?php if( $condo['status']=='1'){echo "Active";}else{echo "Inactive";}?></td>
                        
                        <td>
                        <a href="<?php echo base_url()?>alpha/edit_condo/<?php echo $condo['id']?>" title="Edit">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="#"  onclick="callinActiveAction('condos','status','<?php if( $condo['status']=='1'){echo 0;}else{echo 1;}?>','id', <?php echo $condo['id'];?>,'update_data')" title="Inactivate">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                       <!-- <a href="<?php echo base_url()?>alpha/view_condo/<?php echo $condo['id']?>" title="View">
                            <i class="fa fa-eye"></i>
                        </a>-->
                        </td>
                    </tr>
                    <!-- // Table row END -->
                    <?php } ?>
                </tbody>
                <!-- // Table body END -->
            </table>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- END DASHBOARD STATS 1-->
</div>