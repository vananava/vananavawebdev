<?php
require "../wp-config.php";

$debug	=	$_REQUEST['debug'];

$BookingId			=	$_REQUEST['BookingId'];
$StartDate			=	$_REQUEST['StartDate'];
$BookingContactName	=	$_REQUEST['BookingContactName'];
$MemberEmail		=	$_REQUEST['MemberEmail'];
$MemberMobile		=	$_REQUEST['MemberMobile'];
$ReceiptNo			=	$_REQUEST['ReceiptNo'];

if($debug){
	$BookingId			=	'0000001';
	$StartDate			=	'2019-08-10';
	$BookingContactName	=	'Wittachai Asawapaisanchai';
	$MemberEmail		=	'wittachai@digitiv.net';
	$MemberMobile		=	'0888888888';
	$ReceiptNo			=	'10000101';

		//$ReceiptNo			=	'<div id="barcodeTarget" class="barcodeTarget" style="padding: 0px; overflow: auto; width: 230px;"><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 20px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0; width:0; border-left: 4px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 8px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0; width:0; border-left: 6px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 4px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 6px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 8px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 6px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 6px"></div><div style="float: left; font-size: 0; width:0; border-left: 6px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0; width:0; border-left: 6px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 4px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0; width:0; border-left: 4px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 4px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 4px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 4px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 6px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 2px"></div><div style="float: left; font-size: 0; width:0; border-left: 2px solid #000000; height: 50px;"></div><div style="float: left; font-size: 0; background-color: #FFFFFF; height: 50px; width: 20px"></div><div style="clear:both; width: 100%; background-color: #FFFFFF; color: #000000; text-align: center; font-size: 10px; margin-top: 5px;">1234567890128</div></div>';
}
?>

<?php $body = "
<!DOCTYPE html>
<html>
<head>
<title></title>
<style>
* { font-size:16px!important; }
h1 { font-size:30px!important; }
h2 { font-size:20px!important; }
</style>
</head>
<body>
<table>
<tr><td><img src='https://www.vananavahuahin.com/edm/logo-resize.png' height='120' /></td><td><h1>Your Booking Confirmation with Vana Nava Water Jungle</h1></td>
</tr>
<tr><td colspan='2'><br/><img alt='$BookingId' src='https://www.vananavahuahin.com/edm/barcode.php?text=$BookingId' /><br/></td></tr>
<tr><td colspan='2'><h2>Your Visit Date: $StartDate</td></h2><br/></tr>
<tr><td colspan='2'><b>Customer Details</b></td><br/></tr>
<tr><td colspan='2'>Contact Name: $BookingContactName</td></tr>
<tr><td colspan='2'>Contact Email: $MemberEmail</td></tr>
<tr><td colspan='2'>Contact Mobile: $MemberMobile<br/><br/></td></tr>
<tr><td colspan='2'>Thank you very much for selecting Vana Nava Water Jungle as your holiday destination. We are delighted to confirm your online ticket booking as below. Please show this email and the credit card used for this booking to get RFID Wristband at Jaras Lounge or counter 5,6 on arrival.<br/><br/>Thankyou for your purchase. See you at Vana Nava Water Jungle, Asia's first Water Jungle soon :)<br/><br/></td></tr>
<tr><td colspan='2'><b>Payment Details</b><br/><br/>Payment Reference: $ReceiptNo<br/><br/>Booking Reference: $BookingId</td></tr>
<table>
</body>
</html>
";
?>

<?php
	//echo $body;
$headers[] = 'Content-Type: text/html; charset=UTF-8';
$headers[] = 'From: Vana Nava <sales@vananavahuahin.com>';
$headers[] = 'Bcc: Booking <booking@vananava.com>';
$headers[] = 'Bcc: Ruttpahong.w <ruttaphong.w@vananava.com>';
$headers[] = 'Bcc: Income <income@vananava.com>';
$headers[] = 'Bcc: Ar <ar@vananava.com>';

echo wp_mail( 'wittachai@digitiv.net', 'Vana Nava Confirm Email', $body, $headers );
?>