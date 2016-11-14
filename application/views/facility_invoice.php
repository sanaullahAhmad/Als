 <link href="<?php echo base_url();?>assets/front/pages/css/invoice.min.css" rel="stylesheet" type="text/css" />
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
    <div class="page-content" style="background:#FFF">
        <div class="container" >
           <!-- BEGIN PAGE CONTENT INNER -->
            <div class="page-content-inner" >
                <div id="invoice" class="invoice" style="background:#FFF;border:none">
                    <div class="row invoice-logo">
                        <div class="col-xs-6 invoice-logo-space">
                            <img src="<?php echo base_url()?>assets/front/layouts/layout3/img/logo-form.png" width="300" height="83" class="img-responsive" alt="" /> </div>
                        <div class="col-xs-6">
                            <p> #0000<?php echo $facility_invoice->id?>  <?php //echo date('jS My', strtotime($facility_invoice->datetime_paid))?>
                                <span class="muted"> Facilty Booking </span>
                            </p>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-xs-8">
<!--                                        <h3>Resident:</h3>
-->                                        <ul class="list-unstyled">
                                <li> <h4><?php echo $this->General_model->get_value_by_id('residents', $facility_invoice->payer_id, 'name')?> </h4></li>
                                <li> <?php echo $this->General_model->get_value_by_id('residents',$facility_invoice->payer_id,'block')?>-<?php echo $this->General_model->get_value_by_id('residents',$facility_invoice->payer_id,'floor')?>-<?php echo $this->General_model->get_value_by_id('residents',$facility_invoice->payer_id,'unit')?></td>
</li>
                                <li> <?php echo $this->General_model->get_value_by_id('residents', $facility_invoice->payer_id, 'email')?> </li>
                                <li> <?php echo $this->General_model->get_value_by_id('residents', $facility_invoice->payer_id, 'phone')?> </li>
                            </ul>
                        </div>
                        
                        <div class="col-xs-4 invoice-payment ">
                        <?php
                        //Get Condo ID
                        $get_condo_id = $this->General_model->get_value_by_id('condos', $facility_invoice->condo_id, 'condo_picture');
                        ?>
                        <ul class="list-unstyled pull-right">
                        <img src="<?php echo base_url()?>uploads/condos/condo_pictures/<?php echo $get_condo_id;?>" width="250" height="150"/>
                        </ul>
                           <!-- <ul class="list-unstyled pull-right">
                                <li>
                                    <strong>V.A.T Reg #:</strong> 542554(DEMO)78 </li>
                                <li>
                                    <strong>Account Name:</strong> FoodMaster Ltd </li>
                                <li>
                                    <strong>SWIFT code:</strong> 45454DEMO545DEMO </li>
                                <li>
                                    <strong>Account Name:</strong> FoodMaster Ltd </li>
                                <li>
                                    <strong>SWIFT code:</strong> 45454DEMO545DEMO </li>
                            </ul>-->
                     </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                       
                                    <th> Description </th>
                                    <th> Price (RM)</th>
<!--                                                <th> Quantity </th>
-->                                                <th> Total (RM)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $action="invoice_id=".$facility_invoice->id;
                                $transactions = $this->General_model->get_data_all_like_using_where('invoice_items', $action);
                                foreach($transactions as $transaction){	
                                ?>
                                    <tr>
                                        <td> <?php
                                        if($transaction['transaction_type'] == 'facility'){
                                            echo $this->General_model->get_value_by_id('condo_facilities',$facility_invoice->facility_id,'name').
                                            ' from <b>'.date('d M h:i A', strtotime($this->General_model->get_value_by_id('facility_booking', $facility_invoice->booking_id, 'bookedfor_datetime_from'))).'</b> to <b>'.
                                            date('h:i A', strtotime($this->General_model->get_value_by_id('facility_booking', $facility_invoice->booking_id, 'bookedfor_datetime_to'))).'</b>';	
                                        } else if($transaction['transaction_type'] == 'gst'){
                                            echo 'GST';	
                                        }
                                        
                                        ?> </td>
                                        <td> <?php echo number_format($transaction['amount'],2);?> </td>
<!--                                                    <td class="hidden-xs"> 1 </td>
-->                                                    
                                        <td> <?php 
                                        echo number_format($transaction['amount'],2);
                                        ?> </td>
                                    </tr>
                                   <?php
                                }
                                   ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                                                       
                    <div class="row">
                        <div class="col-xs-4">
                             <!--<div style="color:red; width:200px;height:200px; border-radius:50%">
                            &bull; 
<img src="http://www.electricvelocity.com.au/Upload/Blogs/smart-e-bike-side_2.jpg" class="rounded" />
</div>-->



                        </div>
                        <div class="col-xs-8 invoice-block">
                            <ul class="list-unstyled amounts">
                                <li>
                                    <strong>Grand Total:</strong> RM<?php echo number_format($facility_invoice->amount_paid,2);?> </li>
                            </ul>
                            
                      </div>
                    </div>
                </div>
                
                
                <br/>
                            <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Print
                                <i class="fa fa-print"></i>
                            </a>
                            <a href="javascript:genPDF()"  class="btn btn-lg green hidden-print margin-bottom-5"> Download Invoice
                                <i class="fa fa-download"></i>
                            </a>
            </div>
            <!-- END PAGE CONTENT INNER -->

                
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>

<script>

/* $("#fg").click(function () {
                html2canvas($("#invoice"), {
                onrendered: function (canvas) {
                var imageData = canvas.toDataURL("image/jpeg");
                var image = new Image();
                image = Canvas2Image.convertToJPEG(canvas);
                var doc = new jsPDF();
                doc.addImage(imageData, 'JPEG', 12, 10);
                var croppingYPosition = 1095;
                count = (image.height) / 1095;

                for (var i =1; i < count; i++) {
                        doc.addPage();
                        var sourceX = 0;
                        var sourceY = croppingYPosition;
                        var sourceWidth = image.width;
                        var sourceHeight = 1095;
                        var destWidth = sourceWidth;
                        var destHeight = sourceHeight;
                        var destX = 0;
                        var destY = 0;
                        var canvas1 = document.createElement('canvas');
                        canvas1.setAttribute('height', destHeight);
                        canvas1.setAttribute('width', destWidth);                         
                        var ctx = canvas1.getContext("2d");
                        ctx.drawImage(image, sourceX, 
                                             sourceY,
                                             sourceWidth,
                                             sourceHeight, 
                                             destX, 
                                             destY, 
                                             destWidth, 
                                             destHeight);
                        var image2 = new Image();
                        image2 = Canvas2Image.convertToJPEG(canvas1);
                        image2Data = image2.src;
                        doc.addImage(image2Data, 'JPEG', 12, 10);
                        croppingYPosition += destHeight;              
                    }                  
                var d = new Date().toISOString().slice(0, 19).replace(/-/g, "");
                filename = 'report_' + d + '.pdf';
                doc.save(filename);
            }

        });
    });
*/








function genPDF() {





var element = $('#invoice');
        html2canvas(element, {
            onrendered: function(canvas) {
			/*var dataUrl = canvas.toDataURL('image/jpeg');

			var doc = new jsPDF();
			doc.addImage(dataUrl,'JPEG',10,10);
			doc.save('ronniekliatest.pdf');   */
			
			var imgData = canvas.toDataURL('image/jpeg');
          /*
          Here are the numbers (paper width and height) that I found to work. 
          It still creates a little overlap part between the pages, but good enough for me.
          if you can find an official number from jsPDF, use them.
          */
          var imgWidth = 190; 
          var pageHeight = 295;  
          var imgHeight = canvas.height * imgWidth / canvas.width;
          var heightLeft = imgHeight;

          var doc = new jsPDF('p', 'mm');
          var position = 10;

          doc.addImage(imgData, 'JPEG', 10, position, imgWidth, imgHeight);
          heightLeft -= pageHeight;

          while (heightLeft >= 0) {
            position = heightLeft - imgHeight;
            doc.addPage();
            doc.addImage(imgData, 'JPEG', 10, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
          }
		  
		  var d = new Date().toISOString().slice(0, 19).replace(/-/g, "");
          filename = 'facility_receipt_' + d + '.pdf';
          doc.save(filename);
            }
        });
			
}


</script>