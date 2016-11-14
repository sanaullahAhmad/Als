<?php
//Load the library file
require_once 'MOLPay/distribution/InpageMolpay.php';

//Instantiate the library
$molpay = new MOLPay\distribution\InpageMolpay();

$molpay->checkReturn();

//Define the parameters by using attribute initialize
$molpay->merchantID = 'test7441';
$molpay->orderID = 'DG873';
$molpay->amount = 1.20;
$molpay->bill_name = 'MOLPay demo';
$molpay->bill_email = 'demo@molpay.com';
$molpay->bill_mobile = '0355218438';
$molpay->bill_description = 'testing by MOLPay';
$molpay->country = 'MY';
$molpay->returnURL = 'http://als.com.my/v2/resident/processing';
$molpay->vcode = 'e1d4bf3aa8dfd96f7bd89aefdd1e9be6';
$molpay->currency = 'MYR';
$molpay->langcode = 'en';
$molpay->payment_type = 'fpx.php';
	//$molpay_inpage = $molpay->trigger();

//Generate the inpage code and save it into the variables
//if(isset($_POST['subreq'])){
	//echo $molpay_inpage;
	
	

	//Important - checking if the page should redirect to the real return URL

//}

//Assuming the HTML markup below is template that you already develop
?>
<!DOCTYPE html>
<html>
    <body>
    
<form action="https://www.onlinepayment.com.my/MOLPay/pay/test7441/" ​method="POST" ​>
<input type="hidden" name="amount" value="<?php echo $molpay->amount;?>">
<input type="hidden" name="orderid" value="<?php echo $molpay->orderID;?>">
<input type="hidden" name="bill_name" value="<?php echo $molpay->bill_name;?>">
<input type="hidden" name="bill_email" value="<?php echo $molpay->bill_email;?>">
<input type="hidden" name="bill_mobile" value="<?php echo $molpay->bill_mobile;?>">
<input type="hidden" name="bill_desc" value="<?php echo $molpay->bill_description;?>">
<input type="hidden" name="country" value="<?php echo $molpay->country;?>">
<input type="hidden" name="vcode" value="<?php echo $molpay->vcode;?>">

<input type="submit" name="subreq" value="PAY NOW">
</form>


 <!--<div class="topic-header">
            <h2>MOLPay in-page Payment</h2>
        </div>
        <h3>Examples</h3>
        <a href="javascript.html">Javascript version</a><br />
        <a href="full_template.php">PHP classes full template</a><br />
        <a href="inject_template.php">PHP classes inject template</a><br />
        <h3>Documentation</h3>
        <a href="../docs/javascript.html">Javascript version</a><br />
        <a href="../docs/full_template.php">PHP classes full template</a><br />
        <a href="../docs/inject_template.php">PHP classes inject template</a><br />-->
        <?php //Display the molpay inpage in a segment. ?>
        <? //$molpay_inpage ?>
    </body>
</html>