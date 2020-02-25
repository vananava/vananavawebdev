<?php

require "../wp-config.php";

$go_live = CENTAMAN_GOLIVE;

$server_status = SERVER_STATUS_TEST;
if ( $go_live )$server_status = SERVER_STATUS_PRODUCTION;

$show_status = show;

header('Content-Type: text/html; charset=utf-8');

$table_vnnv_order_items = $table_prefix . 'vnnv_order_items';
$table_vnnv_order_itemmeta = $table_prefix . 'vnnv_order_itemmeta';

$debug	=	$_REQUEST['debug'];

$lang					=	$_REQUEST['lang'];
$fname					=	$_REQUEST['fname'];
$lname					=	$_REQUEST['lname'];
$email					=	$_REQUEST['email'];
$street1				=	$_REQUEST['street1'];
$street2				=	$_REQUEST['street2'];
$city					=	$_REQUEST['city'];
$state					=	$_REQUEST['state'];
$postalcode				=	$_REQUEST['postalcode'];
$country				=	$_REQUEST['country'];
$yourpromocode			=	$_REQUEST['yourpromocode'];
$addcurrentdate			=	$_REQUEST['addcurrentdate'];
$extrabeachhutquantity	=	$_REQUEST['extrabeachhutquantity'];
$extracabanaquantity	=	$_REQUEST['extracabanaquantity'];
$home_phone				=	$_REQUEST['home_phone'];
$work_phone				=	$_REQUEST['work_phone'];
$mobile_phone			=	$_REQUEST['mobile_phone'];

if($debug) {
	$fname			=	'fname';
	$lname			=	'lname';
	$email			=	'wittachai@digitiv.net';
	$street1		=	'street1';
	$street2		=	'street2';
	$city			=	'city';
	$state			=	'state';
	$postalcode		=	'00000';
	$country		=	'country';
	$home_phone		=	'022222222';
	$work_phone		=	'022222222';
	$mobile_phone	=	'0888888888';
}

$json_data = array(
	'Language' => $lang,
	'FirstName' => $fname,
	'LastName' => $lname,
	'Email' => $email,
	'Address' => array(
		'Street1' => $street1,
		'Street2' => $street2,
		'City' => $city,
		'State' => $state,
		'Postalcode' => $postalcode,
		'Country' => $country,
		'HomePhone' => $home_phone,
		'WorkPhone' => $work_phone,
		'MobilePhone' => $mobile_phone
	)
);

/*
	$curl = curl_init();
	$centaman_api_url = CENTAMAN_URL;
	$credentials = CENTAMAN_CREDENTIALS;
	$url = "$centaman_api_url/ticket_services/TimedTicket";
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

	$json_data = json_decode($json_data);

*/	
	include('connect.php');
	
	if ($yourpromocode != "") {

		$sql1 =	"SELECT co_promotion_id FROM vananava_wp_vnnv_co_promotion_code WHERE co_promotion_code_num = '$yourpromocode'";
		$query1 = mysql_query($sql1) or die("Can't Query1");
		$row1 = mysql_fetch_array($query1);
		$co_promotion_code_id = $row1[0];

		$sql2 =	"SELECT co_promotion_name FROM vananava_wp_vnnv_co_promotion WHERE co_promotion_id = '$co_promotion_code_id'";
		$query2 = mysql_query($sql2) or die("Can't Query2");
		$row2 = mysql_fetch_array($query2);
		$yourpromocodename = $row2[0];

		$sql3 =	"SELECT co_promotion_id FROM vananava_wp_vnnv_co_promotion WHERE co_promotion_id = '$co_promotion_code_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);
		$yourpromocodeid = $row3[0];

	}
	
	if ($yourpromocode == "") {

		$wpdb->insert($table_vnnv_order_items, array(
			'order_items_language' 			=> $lang,
			'order_item_name' 				=> $fname . ' ' . $lname,
			'order_item_email' 				=> $email,
			'order_item_phone' 				=> $mobile_phone,
			'order_item_country' 			=> $country,
			'order_item_status' 			=> 'pending',
			'order_items_add_currentdate' 	=> $addcurrentdate,
			'order_items_beachhut' 			=> $extrabeachhutquantity,
			'order_items_cabana' 			=> $extracabanaquantity,
			'order_item_add_date' 			=> date('Y-m-d H:i:s'),
			'order_server' 					=> $server_status,
			'order_show' 					=> $show_status
		));

	} else if ($yourpromocode != "") {

		$wpdb->insert($table_vnnv_order_items, array(
			'order_items_language' 			=> $lang,
			'order_item_name' 				=> $fname . ' ' . $lname,
			'order_item_email' 				=> $email,
			'order_item_phone' 				=> $mobile_phone,
			'order_item_country' 			=> $country,
			'order_item_status' 			=> 'pending',
			'order_items_add_currentdate' 	=> $addcurrentdate,
			'order_items_beachhut' 			=> $extrabeachhutquantity,
			'order_items_cabana' 			=> $extracabanaquantity,
			'order_items_promotion' 		=> $yourpromocode,
			'order_items_promotion_name' 	=> $yourpromocodename,
			'order_items_promotion_id' 		=> $yourpromocodeid,
			'order_item_add_date' 			=> date('Y-m-d H:i:s'),
			'order_server' 					=> $server_status,
			'order_show' 					=> $show_status
		));	

	}	



	$order_item_id = $wpdb->insert_id;

	$order_id = $order_item_id + 10000000;

	$wpdb->update($table_vnnv_order_items, 
		array( 
			'order_id' => $order_id
		), 
		array( 'order_item_id' => $order_item_id )
	);

	foreach($json_data as $key=>$value) {
		if (is_array($value)) {
			foreach($value as $key2=>$value2) {
				$wpdb->insert($table_vnnv_order_itemmeta, array ( 
					"order_item_id" => $order_item_id,
					"meta_key" => $key2,
					"meta_value" => $value2
				));
			}
		} else {
			$wpdb->insert($table_vnnv_order_itemmeta, array ( 
				"order_item_id" => $order_item_id,
				"meta_key" => $key,
				"meta_value" => $value
			));
		}
	}

	$_SESSION['centaman_contact_data'] = json_encode($json_data, JSON_UNESCAPED_UNICODE);

	$contact_data_pending = $_SESSION['centaman_contact_data'];

	$result = json_encode(
		array(
			'Language' 		=> $lang,
			'OrderItemId' 	=> $order_id,
			'MemberName' 	=> $fname . ' ' . $lname,
			'yourpromocode' => $yourpromocode,
			'MemberEmail' 	=> $email,
			'MemberMobile' 	=> $mobile_phone
		)
	);
	
	echo $result;

	include('connect.php');

	$sql4 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_log_contact_data_pending = '$contact_data_pending' WHERE order_id = '$order_id'";
	$query4 = mysql_query($sql4) or die("Can't Query4");

	?>