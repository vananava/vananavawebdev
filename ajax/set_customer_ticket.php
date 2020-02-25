<?php
if(empty($_POST['ip'])){
	$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
}

$checkip = $_POST['ip'];

require "../wp-config.php";

$lang = 'TH';

/*$BookingTypeId = CENTAMAN_BOOKING_TYPE_ID;*/

$go_live = CENTAMAN_GOLIVE;
$BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_TEST;
if( $go_live ) $BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_PRODUCTION;

$table_vnnv_order_itemmeta = $table_prefix . 'vnnv_order_itemmeta';

$debug	=	$_REQUEST['debug'];

$OrderItemId				=	$_REQUEST['OrderItemId'];
$MemberName					=	$_REQUEST['MemberName'];
$yourpromocode				=	$_REQUEST['yourpromocode'];
$MemberEmail				=	$_REQUEST['MemberEmail'];
$MemberMobile				=	$_REQUEST['MemberMobile'];

$ItemDescription			=	$_REQUEST['ItemDescription'];
$ItemCode					=	$_REQUEST['ItemCode'];
$Quantity					=	$_REQUEST['Quantity'];
$QuantityMain				=	$_REQUEST['QuantityMain'];
$ItemCost					=	$_REQUEST['ItemCost'];
$TotalPaid					=	$_REQUEST['TotalPaid'];
$TaxPaid					=	$_REQUEST['TaxPaid'];
$IsExtraItem 				=	$_REQUEST['IsExtraItem'];

$ItemDescriptionMail		=	$_REQUEST['ItemDescriptionMail'];
$ItemDescriptionsubMail		=	$_REQUEST['ItemDescriptionsubMail'];
$ItemCodeMail				=	$_REQUEST['ItemCodeMail'];
$QuantityMail				=	$_REQUEST['QuantityMail'];
$QuantityMainMail			=	$_REQUEST['QuantityMainMail'];
$ItemCostMail				=	$_REQUEST['ItemCostMail'];
$TotalPaidMail				=	$_REQUEST['TotalPaidMail'];
$TaxPaidMail				=	$_REQUEST['TaxPaidMail'];
$IsExtraItemMail 			=	$_REQUEST['IsExtraItemMail'];

$TimedTicketTypeId			=	$_REQUEST['TimedTicketTypeId'];
$TimedTicketTypeDescription	=	$_REQUEST['TimedTicketTypeDescription'];
$StartDate					=	$_REQUEST['StartDate'];

$orderidnumber				= 	$OrderItemId + 10000000;

$AttendeeName = '';
$Barcode = '';
$CouponCode = '';

$StartTime = "9:00:00";
$EndTime = "17:00:00";
$PaymentReference = $OrderItemId;
$Ticket_TaxPaid = 0;
$TransactionDate = '';
$BookingContactID = '';
$BalanceAmount = null;
$ReceiptNo = null;
$BookingId = null;
$Notes = null;
if($debug){
	$OrderItemId = time();
	$ItemDescription[0] = 'TEST WEB Admission Ticket Adult';
	$ItemCode[0] = 1092;
	$Quantity[0] = 1;
	$ItemCost[0] = 800;
	$TotalPaid[] = $Quantity[0] * $ItemCost[0];
	$TaxPaid[] = $TotalPaid;
	$IsExtraItem[] = false;
	
	$MemberEmail	=	'wittachai@digitiv.net';
	$MemberMobile	=	'0963565469';

	$TimedTicketTypeId = 1258251;
	$TimedTicketTypeDescription = "Test Web Admission";
	$BookingTypeId = $BookingTypeId;
	$StartDate = "2019-08-28T00:00:00";
	$PaymentReference = "00000001";
	$BookingCost = 800;
	$Ticket_TotalPaid = 800;
	$Ticket_TaxPaid = 0;
	$TransactionDate = "2019-07-17T00:00:00";
	$BookingContactID = 000001;
	$BookingContactName = "test name";
	$TotalTickets = 1;
}

$i = 0;
foreach($ItemCode as $value) {
	$items[] = array(
		'ItemDescription' => $ItemDescription[$i],
		'ItemCode' => $ItemCode[$i],
		'Quantity' => $Quantity[$i],
		'ItemCost' => (float)$ItemCost[$i],
		'TotalPaid' => (float)$TotalPaid[$i],
		'TaxPaid' => (float)$TaxPaid[$i],
		'AttendeeName' => $AttendeeName,
		'Barcode' => $Barcode,
		'IsExtraItem' => $IsExtraItem[$i],
		'CouponCode' => $CouponCode
	);

	// 1351 %#ONR Once in every 4 years Buy 4 Pay 2 AD 2400
	if ( $ItemCode[$i]==1351){
		$items[] = array(
			'ItemDescription' => "ONR AD Ticket Spawn 0000",
			'ItemCode' => 1153,
			'Quantity' => 2*$Quantity[$i],
			'ItemCost' => 0.0,
			'TotalPaid' => 0.0*$Quantity[$i],
			'TaxPaid' => 0,
			'AttendeeName' => $AttendeeName,
			'Barcode' => $Barcode,
			'IsExtraItem' => false,
			'CouponCode' => $CouponCode
			);
			$TotalTickets += 2*$Quantity[$i];
	}
	// %#ONR Chinese New Year 3pay2 Adult Ticket 2400
	if($ItemCode[$i]==1337 ){
        
	    $items[] = array(
			'ItemDescription' => "ONR AD Ticket Spawn 0000",
			'ItemCode' => 1153,
			'Quantity' => 2*$Quantity[$i],
			'ItemCost' => 0.0,
			'TotalPaid' => 0.0*$Quantity[$i],
			'TaxPaid' => 0,
			'AttendeeName' => $AttendeeName,
			'Barcode' => $Barcode,
			'IsExtraItem' => false,
			'CouponCode' => $CouponCode
			);
		$items[] = array(
			'ItemDescription' => "EXT ONR Towel Complimentary 0000",
			'ItemCode' => 1263,
			'Quantity' => 3*$Quantity[$i],
			'ItemCost' => 0.0,
			'TotalPaid' => 0.0*$Quantity[$i],
			'TaxPaid' => 0,
			'AttendeeName' => $AttendeeName,
			'Barcode' => $Barcode,
			'IsExtraItem' => true,
			'CouponCode' => $CouponCode
			);
			$TotalTickets += 2;
	}

	// %#ONR Valentine AD 1520
	if($ItemCode[$i]==1345){
		$items[] = array(
			'ItemDescription' => "EXT ONR Towel 0040",
			'ItemCode' => 1158,
			'Quantity' => $Quantity[$i],
			'ItemCost' => 40.0,
			'TotalPaid' => 40.0*$Quantity[$i],
			'TaxPaid' => 0,
			'AttendeeName' => $AttendeeName,
			'Barcode' => $Barcode,
			'IsExtraItem' => true,
			'CouponCode' => $CouponCode
			);
		$items[] = array(
			'ItemDescription' => "EXT ONR AD Buffet Lunch Food 0230",
			'ItemCode' => 1346,
			'Quantity' => $Quantity[$i],
			'ItemCost' => 230.0,
			'TotalPaid' => 230.0*$Quantity[$i],
			'TaxPaid' => 0,
			'AttendeeName' => $AttendeeName,
			'Barcode' => $Barcode,
			'IsExtraItem' => true,
			'CouponCode' => $CouponCode
			);
		$items[] = array(
			'ItemDescription' => "EXT ONR AD Buffet Lunch Beverage 0050",
			'ItemCode' => 1163,
			'Quantity' => $Quantity[$i],
			'ItemCost' => 50.0,
			'TotalPaid' => 50.0*$Quantity[$i],
			'TaxPaid' => 0,
			'AttendeeName' => $AttendeeName,
			'Barcode' => $Barcode,
			'IsExtraItem' => true,
			'CouponCode' => $CouponCode
			);

		$Booking_TotalPaid+=320.0*$Quantity[$i];
	}
	// %#ONR Chinese New Year 4pay3 Adult Ticket 3000
	if($ItemCode[$i]==1339 ){
        
	    $items[] = array(
			'ItemDescription' => "ONR AD Ticket Spawn 0000",
			'ItemCode' => 1153,
			'Quantity' => 3*$Quantity[$i],
			'ItemCost' => 0.0,
			'TotalPaid' => 0.0*$Quantity[$i],
			'TaxPaid' => 0,
			'AttendeeName' => $AttendeeName,
			'Barcode' => $Barcode,
			'IsExtraItem' => false,
			'CouponCode' => $CouponCode
			);
		$items[] = array(
			'ItemDescription' => "EXT ONR Towel Complimentary 0000",
			'ItemCode' => 1263,
			'Quantity' => 4*$Quantity[$i],
			'ItemCost' => 0.0,
			'TotalPaid' => 0.0*$Quantity[$i],
			'TaxPaid' => 0,
			'AttendeeName' => $AttendeeName,
			'Barcode' => $Barcode,
			'IsExtraItem' => true,
			'CouponCode' => $CouponCode
			);
			$TotalTickets += 3;

	}
	//beachhut and cabana
	if($ItemCode[$i]==1184 || $ItemCode[$i]==1185 ){
        
	    $items[] = array(
		'ItemDescription' => "EXT ONR Food Cabana Beach Hut 0100",
		'ItemCode' => 1333,
		'Quantity' => $Quantity[$i],
		'ItemCost' => 100.0,
		'TotalPaid' => 100.0*$Quantity[$i],
		'TaxPaid' => 0,
		'AttendeeName' => $AttendeeName,
		'Barcode' => $Barcode,
		'IsExtraItem' => true,
		'CouponCode' => $CouponCode
        );
        $Booking_TotalPaid+=100.0*$Quantity[$i];
    }
    
	$Booking_TotalPaid += $TotalPaid[$i];
    $TotalTickets += $QuantityMain[$i];
    
	$i++;
}

$i = 0;
foreach($ItemCodeMail as $value) {

	
	//beach hut and cabana aad on mail
	if($ItemCodeMail[$i]==1184 || $ItemCodeMail[$i]==1185 ){
        
		$TotalPaidMail[$i]+=100.0*$QuantityMail[$i];
		$ItemCostMail[$i]+=100.0*$QuantityMail[$i];
	}
	
	
	$itemsMail[] = array(
		'ItemDescriptionMail' => $ItemDescriptionMail[$i],
		'ItemDescriptionsubMail' => $ItemDescriptionsubMail[$i],
		'ItemCodeMail' => $ItemCodeMail[$i],
		'QuantityMail' => $QuantityMail[$i],
		'ItemCostMail' => (float)$ItemCostMail[$i],
		'TotalPaidMail' => (float)$TotalPaidMail[$i],
		'TaxPaidMail' => (float)$TaxPaidMail[$i],
		'AttendeeName' => $AttendeeName,
		'Promocode' => $yourpromocode,
		'Barcode' => $Barcode,
		'IsExtraItemMail' => $IsExtraItemMail[$i],
		'CouponCode' => $CouponCode
	);
	//%#ONR Valentine  aad on mail
	if($ItemCodeMail[$i]==1345 ){
			
		$TotalPaidMail[$i]+=320.0*$QuantityMail[$i];
		$ItemCostMail[$i]+=320.0*$QuantityMail[$i];
	}
	
	$Booking_TotalPaidMail += $TotalPaidMail[$i];
	$TotalTicketsMail += $QuantityMainMail[$i];
	
	$i++;
}

/*$BookingCost = $Booking_TotalPaid / 1.07;*/
$BookingCost = round($Booking_TotalPaid / 1.07,2);
/*$BookingCostTwo = number_format($BookingCost, 2, '.', '');*/
/*$Ticket_TaxPaid = $Booking_TotalPaid - $BookingCost;*/
$Ticket_TaxPaid = round($Booking_TotalPaid - $BookingCost,2);

/*$BalanceAmountTwo = number_format($BalanceAmount, 2, '.', '');*/
$BalanceAmountTwo = round($BalanceAmount,2);

/*$Booking_TotalPaidTwo = number_format($Booking_TotalPaid, 2, '.', '');*/
$Booking_TotalPaidTwo = round($Booking_TotalPaid,2);


$json_data = array(
	array(
		'Item' => $items,
		'TimedTicketTypeId' => $TimedTicketTypeId,
		'TimedTicketTypeDescription' => $TimedTicketTypeDescription,
		'BookingTypeId' => $BookingTypeId,
		'StartDate' => $StartDate,
		'StartTime' => $StartTime,
		'EndTime' => $EndTime,
		'PaymentReference' => $PaymentReference,
		'BookingCost' => (float)$BookingCost,
		'TotalPaid' => (float)$Booking_TotalPaidTwo,
		'TaxPaid' => (float)$Ticket_TaxPaid,
		'TransactionDate' => $TransactionDate,
		'BookingContactID' => $BookingContactID,
		'BookingContactName' => $MemberName,
		'TotalTickets' => $TotalTickets,
		'BalanceAmount' => $BalanceAmountTwo,
		'ReceiptNo' => $ReceiptNo,
		'BookingId' => $BookingId,
		'Notes' => $Notes,
	)
);

$json_data_mail = array(
	array(
		'Item' => $itemsMail,
		'TimedTicketTypeId' => $TimedTicketTypeId,
		'TimedTicketTypeDescription' => $TimedTicketTypeDescription,
		'BookingTypeId' => $BookingTypeId,
		'StartDate' => $StartDate,
		'StartTime' => $StartTime,
		'EndTime' => $EndTime,
		'PaymentReference' => $PaymentReference,
		'BookingCost' => (float)$BookingCost,
		'TotalPaid' => (float)$Booking_TotalPaidTwo,
		'TaxPaid' => (float)$Ticket_TaxPaid,
		'TransactionDate' => $TransactionDate,
		'BookingContactID' => $BookingContactID,
		'BookingContactName' => $MemberName,
		'TotalTicketsMail' => $TotalTicketsMail,
		'BalanceAmount' => $BalanceAmountTwo,
		'ReceiptNo' => $ReceiptNo,
		'BookingId' => $BookingId,
		'Notes' => $Notes,
	)
);
/*
	$curl = curl_init();
	$centaman_api_url = CENTAMAN_URL;
	$credentials = CENTAMAN_CREDENTIALS;
	$url = "$centaman_api_url/ticket_services/TimedTicketTransaction";
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_USERPWD, $credentials);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($json_data))
	);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);
	$json_response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	if ( $status != 201 && $status != 200 ) echo "Error: call to $url failed with status $status,<br/>response $json_response,<br/>curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl);
	
	curl_close($curl);

	//print_r($json_data[0]);

	$json_response = '[{"Item":[{"ItemDescription":" TEST WEB Admission Advance 15 Day Adult","ItemCode":1133,"Quantity":1,"ItemCost":1200,"TotalPaid":2400,"TaxPaid":2400,"AttendeeName":"","Barcode":"003210082019140805538852","IsExtraItem":false,"CouponCode":"","CostRateId":0},{"ItemDescription":" TEST WEB Admission Advance 15 Day Adult","ItemCode":1133,"Quantity":1,"ItemCost":1200,"TotalPaid":2400,"TaxPaid":2400,"AttendeeName":"","Barcode":"003210082019140805793821","IsExtraItem":false,"CouponCode":"","CostRateId":0},{"ItemDescription":" TEST WEB Admission Advance 15 Day Child","ItemCode":1135,"Quantity":1,"ItemCost":800,"TotalPaid":800,"TaxPaid":800,"AttendeeName":"","Barcode":"003210082019140805150585","IsExtraItem":false,"CouponCode":"","CostRateId":0},{"ItemDescription":" TEST WEB Admission Advance 15 Day Senior","ItemCode":1136,"Quantity":1,"ItemCost":800,"TotalPaid":2400,"TaxPaid":2400,"AttendeeName":"","Barcode":"003210082019140805217784","IsExtraItem":false,"CouponCode":"","CostRateId":0},{"ItemDescription":" TEST WEB Admission Advance 15 Day Senior","ItemCode":1136,"Quantity":1,"ItemCost":800,"TotalPaid":2400,"TaxPaid":2400,"AttendeeName":"","Barcode":"003210082019140805113272","IsExtraItem":false,"CouponCode":"","CostRateId":0},{"ItemDescription":" TEST WEB Admission Advance 15 Day Senior","ItemCode":1136,"Quantity":1,"ItemCost":800,"TotalPaid":2400,"TaxPaid":2400,"AttendeeName":"","Barcode":"003210082019140805271612","IsExtraItem":false,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Locker spawn","ItemCode":1100,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Locker spawn","ItemCode":1100,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Locker spawn","ItemCode":1100,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Locker spawn","ItemCode":1100,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Locker spawn","ItemCode":1100,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Locker spawn","ItemCode":1100,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Towel spawn","ItemCode":1101,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Towel spawn","ItemCode":1101,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Towel spawn","ItemCode":1101,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Towel spawn","ItemCode":1101,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Towel spawn","ItemCode":1101,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0},{"ItemDescription":"TEST WEB Facilities Towel spawn","ItemCode":1101,"Quantity":6,"ItemCost":0,"TotalPaid":0,"TaxPaid":0,"AttendeeName":"","Barcode":"","IsExtraItem":true,"CouponCode":"","CostRateId":0}],"TimedTicketTypeId":1258295,"TimedTicketTypeDescription":"Test Web Admission","BookingTypeId":1000206,"StartDate":"2019-08-30T00:00:00","StartTime":"9:00:00","EndTime":"17:00:00","PaymentReference":"00000001","BookingCost":5600,"TotalPaid":5600,"TaxPaid":0,"TransactionDate":"0001-01-01T00:00:00","BookingContactID":1042779,"BookingContactName":"Wittachai Asawapaisanchai","TotalTickets":18,"BalanceAmount":0,"ReceiptNo":1006631,"BookingId":1265172,"Notes":null}]';

	$json_data = json_decode($json_response);
*/

	$i = 0;

	foreach($json_data[0] as $key=>$value) {
		if (is_array($value[0])) {
			foreach($value as $key2=>$value2) {
				foreach($value2 as $key3=>$value3) {
					$wpdb->insert($table_vnnv_order_itemmeta, array ( 
						"order_item_id" => $OrderItemId - 10000000,
						"meta_key" => $key3 . '_' . $i,
						"meta_value" => $value3
					));
				}
				$i++;
			}
		} else {
			$wpdb->insert($table_vnnv_order_itemmeta, array ( 
				"order_item_id" => $OrderItemId - 10000000,
				"meta_key" => $key,
				"meta_value" => $value
			));
		}
	}

	//print_r($json_data[0]);

	$date_show = substr($json_data[0]->StartDate, 0, 10);

	/* redirect to 2C2P */
	$payment_url = TWOC2P_PAYMENT_URL_TEST;
	$result_url_1 = TWOC2P_RETURN_URL_TEST;
	$secretkey = TWOC2P_SECRET_KEY_TEST;
	$version = TWOC2P_VERSION;
	$merchant_id = TWOC2P_MID_TEST;
	$payment_description  = 'Vana Nava Online Booking';
	$order_id  = $PaymentReference;

	if ($checkip == "119.63.87.178") {

	if( TWOC2P_GOLIVE ) :
		$payment_url = TWOC2P_PAYMENT_URL_PRODUCTION;
		$result_url_1 = TWOC2P_RETURN_URL_PRODUCTION;
		$merchant_id = TWOC2P_MID_PRODUCTION;
		$secretkey = TWOC2P_SECRET_KEY_PRODUCTION;
	endif;

	} else if ($checkip != "119.63.87.178") {

	if( TWOC2P_GOLIVE ) :
		$payment_url = TWOC2P_PAYMENT_URL_PRODUCTION;
		$result_url_1 = TWOC2P_RETURN_URL_PRODUCTION;
		$merchant_id = TWOC2P_MID_PRODUCTION;
		$secretkey = TWOC2P_SECRET_KEY_PRODUCTION;
	endif;	
		
	}	



	//if($debug) $BookingCost = 1;

	$amount  = number_format($Booking_TotalPaid, 2, '' , $thousands_sep = '');
	$amount = str_pad($amount, 12, '0', STR_PAD_LEFT);
	$currency = '764';
	$customer_email = $MemberEmail;
	$default_lang = $lang;
	$start_date = $StartDate;
	$user_defined_1 = $order_id;
	$user_defined_2 = $start_date;
	$user_defined_3 = $MemberName;
	$user_defined_4 = $MemberEmail . '|' . $MemberMobile . '|' . $default_lang;
	$user_defined_5 = $BookingTypeId;
	//$params = $version.$merchant_id.$payment_description.$order_id.$currency.$amount.$result_url_1.$customer_email.$user_defined_1.$user_defined_2.$user_defined_3.$user_defined_4.$user_defined_5.$default_lang;
	$params = $version.$merchant_id.$payment_description.$order_id.$currency.$amount.$result_url_1;
	$hash_value = hash_hmac('sha256', $params, $secretkey, false);

	$_SESSION['centaman_ticket_data'] = json_encode($json_data, JSON_UNESCAPED_UNICODE);
	$_SESSION['centaman_ticket_data_mail'] = json_encode($json_data_mail, JSON_UNESCAPED_UNICODE);

	$ticket_data_code_pending = $_SESSION['centaman_ticket_data'];
	$ticket_data_pending = $_SESSION['centaman_ticket_data_mail'];

	$result = json_encode(
		array(
			'BookingId' => $json_data[0]->BookingId,
			'StartDate' => $date_show,
			'BookingContactName' => $json_data[0]->BookingContactName,
			'MemberEmail' => $MemberEmail,
			'MemberMobile' => $MemberMobile,
			'ReceiptNo' => $json_data[0]->ReceiptNo,
			'_2c2p_payment_url' => $payment_url,
			'_2c2p_result_url_1' => $result_url_1,
			'_2c2p_secretkey' => $secretkey,
			'_2c2p_version' => $version,
			'_2c2p_merchant_id' => $merchant_id,
			'_2c2p_payment_description' => $payment_description,
			'_2c2p_order_id' => $order_id,
			'_2c2p_amount' => $amount,
			'_2c2p_currency' => $currency,
			'_2c2p_customer_email' => $customer_email,
			'_2c2p_default_lang' => $default_lang,
			'_2c2p_start_date' => $start_date,
			'_2c2p_user_defined_1' => $user_defined_1,
			'_2c2p_user_defined_2' => $user_defined_2,
			'_2c2p_user_defined_3' => $user_defined_3,
			'_2c2p_user_defined_4' => $user_defined_4,
			'_2c2p_user_defined_5' => $user_defined_5,
			'_2c2p_params' => $params,
			'_2c2p_hash_value' => $hash_value
		)
	);
	
	echo $result;

	include('connect.php');

	$sql4 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_log_ticket_data_pending = '$ticket_data_pending', order_item_log_ticket_data_code_pending = '$ticket_data_code_pending' WHERE order_id = '$OrderItemId'";
	$query4 = mysql_query($sql4) or die("Can't Query4");

	if ($yourpromocode != "") {

	$sql2 =	"UPDATE vananava_wp_vnnv_co_promotion_code SET co_promotion_code_status = 'N' WHERE co_promotion_code_num = '$yourpromocode'";
	$query2 = mysql_query($sql2) or die("Can't Query2");

}

?>