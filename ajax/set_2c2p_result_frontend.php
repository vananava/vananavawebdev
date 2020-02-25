<?php
	$order_id = $_REQUEST["order_id"];
	
	$payment_status = $_REQUEST["payment_status"];

	include('connect.php');

	$sqlcheckeorderid = "SELECT order_id FROM vananava_wp_vnnv_log_order WHERE order_id = '$order_id'";
	$querycheckeorderid = mysql_db_query($dbname, $sqlcheckeorderid) or die("Can't Querycheckeorderid");
	$rowcheckeorderid = mysql_fetch_array($querycheckeorderid);
	$order_checkeorderid = $rowcheckeorderid[0];

	$sqlpending = "SELECT * FROM vananava_wp_vnnv_order_items WHERE order_id = '$order_id'";
	$querypending = mysql_db_query($dbname, $sqlpending) or die("Can't Query Pending");
	$rowpending = mysql_fetch_array($querypending);

	$MemberLanguage = $rowpending['order_items_language'];

	if ($order_checkeorderid != '') {

	header( "location: https://www.vananavahuahin.com/online-booking/" );

	session_destroy();

	} else if ($order_checkeorderid == '') {
	
	include('connect.php');

	if ($payment_status == '000' && $MemberLanguage == 'EN') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done_frontend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/online-booking-done" );

	} else if ($payment_status == '000' && $MemberLanguage == 'TH') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done-th_frontend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/th/online-booking-done-th" );

	} else if ($payment_status == '00' && $MemberLanguage == 'EN') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done_frontend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/online-booking-done" );
		
	} else if ($payment_status == '00' && $MemberLanguage == 'TH') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done-th_frontend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/th/online-booking-done-th" );

	} else if ($payment_status == '000' && $MemberLanguage == '') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done-none-lang_frontend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/online-booking-done" );

	} else if ($payment_status == '00' && $MemberLanguage == '') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done-none-lang_frontend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/online-booking-done" );

	} else if ($payment_status == '001') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-success-pending_frontend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/online-booking-success-pending" );

	} else {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-payment-is-cancelled_frontend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( 'location: https://www.vananavahuahin.com/online-booking-payment-is-cancelled' );	

	}

	session_destroy();

	}
	
?> 