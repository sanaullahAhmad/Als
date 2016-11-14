<link rel="stylesheet" href="<?php echo base_url()?>assets/front/pages/css/portfolio.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/front/global/plugins/cubeportfolio/css/cubeportfolio.css" />
<style>
label.error {
    background-color: #fbe1e3;
    border-color: #fbe1e3;
    color: #e73d4a;
    float: right;
    padding: 15px;
    width: 97.2% !important;
}
.modal_button
{
	margin-top:7px;
}
</style>
<div class="page-content-wrapper">
 <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>
                <?php if(isset($page_title)){ echo $page_title;}?>      
                </h1>
            </div>
            <div class="page-title pull-right">
                <?php /*?><a href="<?php echo base_url();?>all_facility_payments" class="btn btn-primary pull-right">Pending Payments</a> <?php */?>
                <a href="<?php echo base_url();?>my_bookings" class="btn btn-primary pull-right">My bookings</a>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
 <div class="page-content">
  <div class="container">
    <div class="page-content-inner">
      <div class="left-post" style="background:#fff; padding:15px;">
		<?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-info"> 
                <?= $this->session->flashdata('message') ?> 
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('message_danger')) { ?>
            <div class="alert alert-danger"> 
                <?= $this->session->flashdata('message_danger') ?> 
            </div>
        <?php } ?>
        <?php
        if(sizeof($facilities)>0)
        {
        ?>
        <div class="portfolio-content portfolio-1">
           
            
            <div id="js-grid-juicy-projects" class="cbp">
		    <?php              
			foreach($facilities as $report){
              if($report['image_url']=='')
              {$src=base_url()."assets/front/global/img/no-image-box.png";}
              else{$src=base_url()."uploads/facilities_images/". $report['image_url'];}
            ?>
                <div class="cbp-item">
                    <div class="cbp-caption">
                        <div class="cbp-caption-defaultWrap">
                        
                            <img src="<?php echo $src;?>" alt="">
                       
                        </div>
                        <div class="cbp-caption-activeWrap">
                            <div class="cbp-l-caption-alignCenter">
                                <div class="cbp-l-caption-body" style="color:#fff;">
                                
                                 Opening hours:  
								 <?php echo date('H:i',strtotime($report['opening_hour']))?> to
                                 <?php echo date('H:i',strtotime($report['closing_hour']))?><br />
                                 (Mon-Sun strictly for residents only)
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cbp-l-grid-projects-title uppercase text-center uppercase text-center"><?php 
                      echo $report['name'];
                      ?></div>
                    <div class="cbp-l-grid-projects-desc uppercase text-center uppercase text-center">
                     <?php echo substr($report['description'],0,100);?>
                     <?php //echo date('h A',strtotime($report['closing_hour']))?>
                    </div>
                </div>
            
            
            <?php
            } 
			
			?>
			
            </div>
          
        </div>
        <?php
		} else {
		?>	
            <div class="note note-success">
                <h4 class="block"><i class="fa fa-info-circle"></i> Information</h4>
                <p> No Facilities added at the moment. </p>
            </div>
		<?php		
        }?>
		</div>
        <?php echo $this->load->view('template/sidebar');?> 
	  </div>
	</div>
  </div>
</div>     