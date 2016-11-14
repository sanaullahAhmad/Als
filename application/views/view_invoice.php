 
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Official Receipt</title>
 
<link rel="icon" href="/images/favicon.png" type="image/x-icon">
 
 <style>
    @font-face {
  font-family: SourceSansPro;
  src: url(SourceSansPro-Regular.ttf);
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  position: relative;
  width: 21cm;  
  height: 16.7cm; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family: SourceSansPro;
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 1px solid #AAAAAA;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  /*border-left: 6px solid #0087C3;*/
  border-left: 6px solid #41B146;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  /*color: #0087C3;*/
  color: #41B146;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 20px;
  background: #EEEEEE;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}

table th {
  white-space: nowrap;        
  font-weight: normal;
}

table td {
  /*text-align: right;*/
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  color: #FFFFFF;
  font-size: 1.6em;
  background: #41B146;
}

table .desc {
  text-align: left;
  margin: 0 0 0.2em 0;
}

table .unit {
}

table .qty {
	  /*background: #DDDDDD;*/

}

table .total {
  background: #41B146;
  color: #FFFFFF;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #41B146;
  font-size: 1.4em;
  /*border-top: 1px solid #57B223; */

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #41B146;  
}

#notices .notice {
  font-size: 1.2em;
}

footer {
  color: #777777;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
}


    </style>
</head>



<body>
			<?php
				$action_inv = "id = '$invoice_details->condo_id'";
				$condo_info = $this->General_model->get_data_row_using_where('condos', $action_inv);
			?>
    <header class="clearfix">
      <div id="logo">
        <img src="<?php echo base_url()?>uploads/condos/condo_pictures/<?php echo $this->General_model->get_value_by_id('condos',$invoice_details->condo_id,'condo_picture')?>">
      </div>
      <div id="company">
        <h2 class="name"><?php echo $condo_info->name?></h2>
        <div><?php echo $condo_info->address?></div>
        <div><?php echo $this->General_model->get_value_by_id('areas',$condo_info->areas,'name');?> <?php echo $condo_info->postcode?></div>
        <div><a href="mailto:<?php echo $condo_info->email?>"><?php echo $condo_info->email?></a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name"><?php echo $this->General_model->get_value_by_id('residents', $invoice_details->payer_id, 'name')?> (<?php echo $this->General_model->get_value_by_id('residents',$invoice_details->payer_id,'block')?>-
								<?php echo $this->General_model->get_value_by_id('residents',$invoice_details->payer_id,'floor')?>-
								<?php echo $this->General_model->get_value_by_id('residents',$invoice_details->payer_id,'unit')?>)</h2>
          <div class="address"><?php echo $this->General_model->get_value_by_id('residents', $invoice_details->payer_id, 'phone')?></div>
          <div class="email"><a href="mailto:<?php echo $this->General_model->get_value_by_id('residents', $invoice_details->payer_id, 'email')?>"><?php echo $this->General_model->get_value_by_id('residents', $invoice_details->payer_id, 'email')?></a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE #<?php echo $invoice_details->id?></h1>
          <div class="date">Date of Invoice: <?php echo date('j M y',strtotime($invoice_details->date_created))?></div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">DESCRIPTION</th>
            <th class="unit">&nbsp;</th>
            <th class="qty">&nbsp;</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
         <?php
                                $action="invoice_id=".$invoice_details->id;
                                $transactions = $this->General_model->get_data_all_like_using_where('invoice_items', $action);
								$icount = 1;
                                foreach($transactions as $transaction){	
                                ?>
          <tr>
            <td class="no"><?php echo $icount?></td>
            <td class="desc"><?php
                         echo $transaction['description'];
                    ?></td>
            <td class="unit">&nbsp;</td>
            <td class="qty">&nbsp;</td>
            <td class="total">RM<?php echo number_format($transaction['amount'],2);?></td>
          </tr>
            <?php
			$icount++;
				}
			?>
          
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>RM<?php echo number_format($invoice_details->amount_paid,2);?></td>
          </tr>
          <!--<tr>
            <td colspan="2"></td>
            <td colspan="2">Processing Fee</td>
            <td>0</td>
          </tr>-->
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>RM<?php echo number_format($invoice_details->amount_paid,2);?></td>
          </tr>
        </tfoot>
      </table>
      <div id="notices">
        <div class="notice">Powered by ALIA. <a href="<?php echo base_url()?>print_invoice/<?php echo $this->encrypt_model->encode($invoice_details->id)?>"  target="_blank" class="btn btn-lg green hidden-print margin-bottom-5"> Download Invoice
                 <i class="fa fa-download"></i>
            </a></div>
      </div>
    </main>
    <footer>
      Invoice was created on a computer and is valid without the signature and seal.
    </footer>
  </body>
</html>

