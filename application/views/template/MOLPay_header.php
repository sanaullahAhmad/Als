<?php
//Load the library file
require_once 'MOLPay/distribution/InpageMolpay.php';

//Instantiate the library
$molpay = new MOLPay\distribution\InpageMolpay();

$molpay->checkReturn();
?>