<?php
	if(empty($_POST['ip'])){
		$_POST['ip'] = $_SERVER['REMOTE_ADDR'];
	}

	$checkip = $_POST['ip'];

	$order_id = $_REQUEST["order_id"];

	$payment_channel = $_REQUEST["payment_channel"];

	if ($payment_channel == "001") {

		$payment_channel_name = "Credit/Debit Cards";

	} else if ($payment_channel == "002") {

		$payment_channel_name = "123 Over The Counter";

	} else if ($payment_channel == "003") {

		$payment_channel_name = "123 Bank Channels";

	} else if ($payment_channel == "") {

		$payment_channel_name = "No Payment";	

	}

	include('connect.php');

	$sqlcheckeorderid = "SELECT order_id FROM vananava_wp_vnnv_log_order WHERE order_id = '$order_id'";
	$querycheckeorderid = mysql_db_query($dbname, $sqlcheckeorderid) or die("Can't Querycheckeorderid");
	$rowcheckeorderid = mysql_fetch_array($querycheckeorderid);
	$order_checkeorderid = $rowcheckeorderid[0];

	$sqlpending = "SELECT * FROM vananava_wp_vnnv_order_items WHERE order_id = '$order_id'";
	$querypending = mysql_db_query($dbname, $sqlpending) or die("Can't Query Pending");
	$rowpending = mysql_fetch_array($querypending);

	$order_item_log_contact_data_pending = $rowpending['order_item_log_contact_data_pending'];
	$order_item_log_ticket_data_pending = $rowpending['order_item_log_ticket_data_pending'];
	$order_item_log_ticket_data_code_pending = $rowpending['order_item_log_ticket_data_code_pending'];

	if ($order_checkeorderid != '') {

	header( "location: https://www.vananavahuahin.com/online-booking/" );

	session_destroy();

	} else if ($order_checkeorderid == '') {

	require "../wp-config.php";
	
	$table_vnnv_order_items = $table_prefix . 'vnnv_order_items';
	$table_vnnv_order_itemmeta = $table_prefix . 'vnnv_order_itemmeta';
	$table_vnnv_log_ctm_contact = $table_prefix . 'vnnv_log_ctm_contact';
	$table_vnnv_log_ctm_ticket = $table_prefix . 'vnnv_log_ctm_ticket';
	$table_vnnv_log_2c2p = $table_prefix . 'vnnv_log_2c2p';
	$table_vnnv_log_2c2p_recheck = $table_prefix . 'vnnv_log_2c2p_recheck';
	$table_vnnv_log_order = $table_prefix . 'vnnv_log_order';

	/* redirect to 2C2P */
	if ($checkip == "119.63.87.178") {

	} else if ($checkip != "119.63.87.178") {

	$secretkey = TWOC2P_SECRET_KEY_TEST;

	if( TWOC2P_GOLIVE ) :
	$payment_url = TWOC2P_PAYMENT_URL_PRODUCTION;
	$result_url_1 = TWOC2P_RETURN_URL_PRODUCTION;
	$merchant_id = TWOC2P_MID_PRODUCTION;
	$secretkey = TWOC2P_SECRET_KEY_PRODUCTION;  
	endif;
	
	}	

	/*
	$secretkey = TWOC2P_SECRET_KEY_TEST;

	if( TWOC2P_GOLIVE ) :
		$secretkey = TWOC2P_SECRET_KEY_PRODUCTION;
	endif;

	if( TWOC2P_GOLIVE ) :
		$payment_url = TWOC2P_PAYMENT_URL_PRODUCTION;
		$result_url_1 = TWOC2P_RETURN_URL_PRODUCTION;
		$merchant_id = TWOC2P_MID_PRODUCTION;
		$secretkey = TWOC2P_SECRET_KEY_PRODUCTION;  
	endif;
	*/

	/*$secretkey = TWOC2P_SECRET_KEY_TEST;
	if( TWOC2P_GOLIVE ) :
		$secretkey = TWOC2P_SECRET_KEY_TEST;
	endif;*/

  	$response = file_get_contents('php://input');
	echo "Response:<br/><textarea style='width:100%;height:80px'>".$response."</textarea>";

	if ($checkip == "119.63.87.178") {

	$request_save = str_replace(array("\r\n", "\n", "\r", "\t"), '', $response);

	$date_log = date("Y-m-d H:i:s");
		
	$sqlreferer = " INSERT INTO vananava_wp_log_backend2c2p (order_id, request, referer, date_log) VALUES ('$order_id', '$response', '$request_save', '$date_log') ";
	$queryreferer = mysql_query($sqlreferer) or die("Can't Queryreferer");

	} else if ($checkip != "119.63.87.178") {
	

	}

	//each response params:
	$version = $_REQUEST["version"];
	$request_timestamp = $_REQUEST["request_timestamp"];
	$merchant_id = $_REQUEST["merchant_id"];
	$currency = $_REQUEST["currency"];
	$order_id = $_REQUEST["order_id"];
	$amount = $_REQUEST["amount"];
	$invoice_no = $_REQUEST["invoice_no"];
	$transaction_ref = $_REQUEST["transaction_ref"];
	$approval_code = $_REQUEST["approval_code"];
	$eci = $_REQUEST["eci"];
	$transaction_datetime = $_REQUEST["transaction_datetime"];
	$payment_channel = $_REQUEST["payment_channel"];
	$payment_status = $_REQUEST["payment_status"];
	$channel_response_code = $_REQUEST["channel_response_code"];
	$channel_response_desc = $_REQUEST["channel_response_desc"];
	$masked_pan = $_REQUEST["masked_pan"];
	$stored_card_unique_id = $_REQUEST["stored_card_unique_id"];
	$backend_invoice = $_REQUEST["backend_invoice"];
	$paid_channel = $_REQUEST["paid_channel"];
	$recurring_unique_id = $_REQUEST["recurring_unique_id"];
	$paid_agent = $_REQUEST["paid_agent"];
	$payment_scheme = $_REQUEST["payment_scheme"];
	$user_defined_1 = $_REQUEST["user_defined_1"];
	$user_defined_2 = $_REQUEST["user_defined_2"];
	$user_defined_3 = $_REQUEST["user_defined_3"];
	$user_defined_4 = $_REQUEST["user_defined_4"];
	$user_defined_5 = $_REQUEST["user_defined_5"];
	$browser_info = $_REQUEST["browser_info"];
	$ippPeriod = $_REQUEST["ippPeriod"];
	$ippInterestType = $_REQUEST["ippInterestType"];
	$ippInterestRate = $_REQUEST["ippInterestRate"];
	$ippMerchantAbsorbRate = $_REQUEST["ippMerchantAbsorbRate"];
	$payment_scheme = $_REQUEST["payment_scheme"];
	$process_by = $_REQUEST["process_by"];
	$sub_merchant_list = $_REQUEST["sub_merchant_list"];
	$hash_value = $_REQUEST["hash_value"];   
	echo "version: ".$version."<br/>";
	echo "request_timestamp: ".$request_timestamp."<br/>";
	echo "merchant_id: ".$merchant_id."<br/>";
	echo "currency: ".$currency."<br/>";
	echo "order_id: ".$order_id."<br/>";
	echo "amount: ".$amount."<br/>";
	echo "invoice_no: ".$invoice_no."<br/>";
	echo "transaction_ref: ".$transaction_ref."<br/>";
	echo "approval_code: ".$approval_code."<br/>";
	echo "eci: ".$eci."<br/>";
	echo "transaction_datetime: ".$transaction_datetime."<br/>";
	echo "payment_channel: ".$payment_channel."<br/>";
	echo "payment_status: ".$payment_status."<br/>";
	echo "channel_response_code: ".$channel_response_code."<br/>";
	echo "channel_response_desc: ".$channel_response_desc."<br/>";
	echo "masked_pan: ".$masked_pan."<br/>";
	echo "stored_card_unique_id: ".$stored_card_unique_id."<br/>";
	echo "backend_invoice: ".$backend_invoice."<br/>";
	echo "paid_channel: ".$paid_channel."<br/>";
	echo "recurring_unique_id: ".$recurring_unique_id."<br/>";
	echo "sub_merchant_list: " .$sub_merchant_list."<br/>";
	echo "payment_scheme: ".$payment_scheme."<br/>";
	echo "user_defined_1: ".$user_defined_1."<br/>";
	echo "user_defined_2: ".$user_defined_2."<br/>";
	echo "user_defined_3: ".$user_defined_3."<br/>";
	echo "user_defined_4: ".$user_defined_4."<br/>";
	echo "user_defined_5: ".$user_defined_5."<br/>";
	echo "browser_info: ".$browser_info."<br/>"; 
	echo "ippPeriod: " .$ippPeriod."<br/>";
	echo "ippInterestType: " .$ippInterestType."<br/>";
	echo "ippInterestRate: " .$ippInterestRate."<br/>";
	echo "ippMerchantAbsorbRate: " .$ippMerchantAbsorbRate."<br/>";
	echo "payment_scheme: " .$payment_scheme."<br/>";
	echo "process_by: " .$process_by."<br/>";
	echo "sub_merchant_list: " .$sub_merchant_list."<br/>";
	echo "hash_value: ".$hash_value."<br/>";
  	
	//check response hash value (for security, hash value validation is Mandatory)
	$checkHashStr = $version . $request_timestamp . $merchant_id . $order_id . 
	$invoice_no . $currency . $amount . $transaction_ref . $approval_code . 
	$eci . $transaction_datetime . $payment_channel . $payment_status . 
	$channel_response_code . $channel_response_desc . $masked_pan . 
	$stored_card_unique_id . $backend_invoice . $paid_channel . $paid_agent . 
	$recurring_unique_id . $user_defined_1 . $user_defined_2 . $user_defined_3 . 
	$user_defined_4 . $user_defined_5 . $browser_info . $ippPeriod . 
	$ippInterestType . $ippInterestRate . $ippMerchantAbsorbRate . $payment_scheme .
	$process_by . $sub_merchant_list;
	  
	$SECRETKEY = $secretkey;
	$checkHash = hash_hmac('sha256',$checkHashStr, $SECRETKEY,false); 
	echo "checkHash: ".$checkHash."<br/><br/>";
	
	/*
	echo $json_data_contact = $order_item_log_contact_data_pending;
	echo $json_data_ticket = $order_item_log_ticket_data_code_pending;
	echo $json_data_ticket_mail = $order_item_log_ticket_data_pending;
	*/
	
	echo $json_data_contact = $_SESSION['centaman_contact_data'];
	echo $json_data_ticket = $_SESSION['centaman_ticket_data'];
	echo $json_data_ticket_mail = $_SESSION['centaman_ticket_data_mail'];

	if(strcmp(strtolower($hash_value), strtolower($checkHash))==0){

		$wpdb->update($table_vnnv_order_items, 
			array( 
				'order_item_status' => $channel_response_desc,
				'order_item_log_contact_data' => $json_data_contact,
				'order_item_log_ticket_data' => $json_data_ticket_mail,
				'order_item_log_ticket_data_code' => $json_data_ticket,
				'order_item_payment_status' => $payment_status,
				'order_item_payment_channel' => $payment_channel,
				'order_item_payment_channel_name' => $payment_channel_name
			), 
			array( 'order_id' => $order_id )
		);
		
		if ($payment_status == "000" || $payment_status == "00") {
			$curl = curl_init();
			$centaman_api_url = CENTAMAN_URL;
			$credentials = CENTAMAN_CREDENTIALS;

			$url = "$centaman_api_url/ticket_services/TimedTicket";
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($curl, CURLOPT_USERPWD, $credentials);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($json_data_contact))
			);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data_contact);
			$json_response_contact = curl_exec($curl);
			$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

			if ( $status != 201 && $status != 200 ) echo "Error: call to $url failed with status $status,<br/>response $json_response,<br/>curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl);

			$json_return_data_contact = json_decode($json_response_contact);
			$json_return_data_contact_new = json_decode($json_data_contact);

			$json_data_ticket = json_decode($json_data_ticket);
			$json_data_ticket[0]->BookingContactID = $json_return_data_contact->MemberCode;
			$MemberEmail = $json_return_data_contact->Email;
			$MemberLanguage = $json_return_data_contact_new->Language;
			$MemberFirstName = $json_return_data_contact->FirstName;
			$MemberLastName = $json_return_data_contact->LastName;
			$MemberMobile = $json_return_data_contact->Address->MobilePhone;

			$json_data_ticket = json_encode($json_data_ticket);

			$url = "$centaman_api_url/ticket_services/TimedTicketTransaction";
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($curl, CURLOPT_USERPWD, $credentials);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json',
				'Content-Length: ' . strlen($json_data_ticket))
			);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data_ticket);
			$json_response_ticket = curl_exec($curl);
			$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

			if ( $status != 201 && $status != 200 ) echo "Error: call to $url failed with status $status,<br/>response $json_response,<br/>curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl);
			
			$json_return_data_ticket = json_decode($json_response_ticket);
			$json_return_data_ticket_new = json_decode($json_data_ticket);
			$json_return_data_ticket_new_mail = json_decode($json_data_ticket_mail);
			
			curl_close($curl);

			$StartDate = $json_return_data_ticket[0]->StartDate;
			$StartDate = explode('T',$StartDate);
			list($y,$m,$d) = explode('-',$StartDate[0]);
			$StartDate = "$d-$m-$y";

			$BookingContactID = $json_return_data_ticket[0]->BookingContactID;
			$BookingContactName = $json_return_data_ticket[0]->BookingContactName;
			$BalanceAmount = $json_return_data_ticket[0]->BalanceAmount;
			$PaymentReference = $json_return_data_ticket[0]->PaymentReference;
			$ReceiptNo = $json_return_data_ticket[0]->ReceiptNo;
			$BookingId = $json_return_data_ticket[0]->BookingId;
			$TotalSumPaid = number_format($json_return_data_ticket_new[0]->TotalPaid);
			$ItemDetail = $json_return_data_ticket[0]->Item->ItemDescription;

			$Information_ticket_new = "";
			foreach ($json_return_data_ticket_new[0]->Item as $value) {
				$ItemCodeOrder = $value->ItemCode;
				$ItemDescriptionOrder = $value->ItemDescription;
				$QuantityOrder = $value->Quantity;
				$TotalPaidOrder = number_format($value->TotalPaid);
				$Information_ticket_new .= "
					<tr>
						<td style='color:#000000;border: 1px solid black;'><font style='color:#000000;'>$ItemDescriptionOrder</font></td>
						<td style='color:#000000;border: 1px solid black;text-align:center'><font style='color:#000000;'>$QuantityOrder</font></td>
						<td style='color:#000000;border: 1px solid black;text-align:center'><font style='color:#000000;'>$TotalPaidOrder</font></td>
					</tr>
				";
			}

			$Information_ticket_new_now = "";
			foreach ($json_return_data_ticket_new_mail[0]->Item as $value) {
				$ItemCodeMailOrderMail = $value->ItemCodeMail;
				$ItemDescriptionOrderMail = $value->ItemDescriptionMail;
				$ItemDescriptionsubOrderMail = $value->ItemDescriptionsubMail;
				$QuantityOrderMail = $value->QuantityMail;
				$TotalPaidOrderMail = number_format($value->TotalPaidMail);
				$Information_ticket_new_now .= "
					<tr>
						<td style='color:#000000;border: 1px solid black;'><div style='color:#000000;'>$ItemDescriptionOrderMail</div><div style='color:#000000;'>$ItemDescriptionsubOrderMail</div></td>
						<td style='color:#000000;border: 1px solid black;text-align:center'><font style='color:#000000;'>$QuantityOrderMail</font></td>
						<td style='color:#000000;border: 1px solid black;text-align:center'><font style='color:#000000;'>$TotalPaidOrderMail</font></td>
					</tr>
				";
			}

			/*Terms and Conditions (EN) โดยเช็คจาก item code ว่าตรงกับ Terms and Conditions ตัวใหน*/

			$Information_terms_en = "";
			foreach ($json_return_data_ticket_new_mail[0]->Item as $value) {
				$ItemCodeOrderMailEN = $value->ItemCodeMail;

				$sql4 =	"SELECT * FROM vananava_wp_vnnv_terms_conditions WHERE terms_conditions_ticket_id = '$ItemCodeOrderMailEN'";
				$query4 = mysql_db_query($dbname, $sql4) or die("Can't Query4");
				$row4 = mysql_fetch_array($query4);
				$terms_conditions_ticket_id = $row4['terms_conditions_ticket_id'];
				$terms_conditions_detail_en = $row4['terms_conditions_detail_en'];

				if ($terms_conditions_ticket_id != "") {

					$Information_terms_en .= $terms_conditions_detail_en;
					break;

				} if ($terms_conditions_ticket_id == "") {

					$Information_terms_en .= "
					<font style='color:#000000;'>1.	The online booking is valid only on the specific date mentioned in the booking confirmation.</font><br/>
					<font style='color:#000000;'>2.	Once reserved, this promotion cannot be cancelled or refunded.</font><br/>
					<font style='color:#000000;'>3.	Once purchased and the date is selected, the date of use may be changed with a notice of at least 7 days prior to the selected date appearing in the purchase confirmation email. Otherwise the date of use cannot be changed. (within 30 November 2019)</font><br/>
					<font style='color:#000000;'>4.	Identify your booking confirmation with printed copy or show from your mobile screen at Counter 1 to 6 to get your RFID wristband for park entry.</font><br/>
					<font style='color:#000000;'>5.	The company reserves the right to change these terms and conditions without prior notice.</font><br/>
					<font style='color:#000000;'>6.	All visitors must strictly follow the company’s safety rules and regulations in the water park.</font><br/><br/>
					";
					break;

				}
			}

			/*Terms and Conditions (TH) โดยเช็คจาก item code ว่าตรงกับ Terms and Conditions ตัวใหน*/

			$Information_terms_th = "";
			foreach ($json_return_data_ticket_new_mail[0]->Item as $value) {
				$ItemCodeOrderMailTH = $value->ItemCodeMail;

				$sql5 =	"SELECT * FROM vananava_wp_vnnv_terms_conditions WHERE terms_conditions_ticket_id = '$ItemCodeOrderMailTH'";
				$query5 = mysql_db_query($dbname, $sql5) or die("Can't Query5");
				$row5 = mysql_fetch_array($query5);
				$terms_conditions_ticket_id = $row5['terms_conditions_ticket_id'];
				$terms_conditions_detail_th = $row5['terms_conditions_detail_th'];

				if ($terms_conditions_ticket_id != "") {

					$Information_terms_th .= $terms_conditions_detail_th;
					break;

				} if ($terms_conditions_ticket_id == "") {

					$Information_terms_th .= "
					<font style='color:#000000;'>1.	สามารถใช้บัตรสวนน้ำออนไลน์ได้เฉพาะวันที่ระบุไว้ในอีเมล์ยืนยันการสั่งซื้อเท่านั้น</font><br/>
					<font style='color:#000000;'>2.	โปรโมชั่นนี้เปลี่ยนแปลงวันที่เข้าใช้บริการได้ และต้องแจ้งล่วงหน้าอย่างน้อย 7 วัน ก่อนถึงวันที่ระบุในอีเมลยืนยันการสั่งซื้อ (เลื่อนได้ถึง 30 พฤศจิกายน 2562 เท่านั้น)</font><br/>
					<font style='color:#000000;'>3.	โปรโมชั่นนี้ไม่สามารถแจ้งยกเลิกหรือคืนเงินทุกจำนวนไม่ว่ากรณีใดๆ</font><br/>
					<font style='color:#000000;'>4.	ลูกค้าที่ซื้อบัตรออนไลน์ต้องแสดงอีเมลยืนยันการสั่งซื้อในรูปแบบของเอกสารหรือแสดงอีเมลผ่านหน้าจอโทรศัพท์มือถือกับเจ้าหน้าที่ ณ จุดจำหน่ายบัตร เพื่อรับสายรัดข้อมือ RFID</font><br/>
					<font style='color:#000000;'>5.	ลูกค้าทุกท่านจะต้องปฏิบัติตามกฎของสวนน้ำฯ อย่างเคร่งครัด</font><br/>
					<font style='color:#000000;'>6.	สวนน้ำฯ ขอสงวนสิทธิ์ในการเปลี่ยนแปลงเงื่อนไขและข้อกำหนดใดๆโดยไม่ต้องแจ้งให้ทราบล่วงหน้า</font><br/><br/>
					";
					break;

				}
			}

			if($BookingContactID){
				$wpdb->update($table_vnnv_order_itemmeta,
					array(
						'meta_value' => $BookingContactID,
					),
					array(
						'order_item_id' => $order_id - 10000000,
						'meta_key' => 'BookingContactID'
					)
				);
			}

			if($BalanceAmount){
				$wpdb->update($table_vnnv_order_itemmeta,
					array(
						'meta_value' => $BalanceAmount,
					),
					array(
						'order_item_id' => $order_id - 10000000,
						'meta_key' => 'BalanceAmount'
					)
				);
			}

			if($ReceiptNo){
				$wpdb->update($table_vnnv_order_itemmeta,
					array(
						'meta_value' => $ReceiptNo,
					),
					array(
						'order_item_id' => $order_id - 10000000,
						'meta_key' => 'ReceiptNo'
					)
				);
			}

			if($BookingId){
				$wpdb->update($table_vnnv_order_itemmeta,
					array(
						'meta_value' => $BookingId,
					),
					array( 
						'order_item_id' => $order_id - 10000000,
						'meta_key' => 'BookingId'
					)
				);
			}

			$Information_ticket = "";
			foreach ($json_return_data_ticket[0]->Item as $value) {
				$ItemDescription = $value->ItemDescription;
				$Quantity = $value->Quantity;
				$ItemCost = number_format($value->ItemCost,0);
				$TotalPaid = number_format($value->TotalPaid,0);
				$Information_ticket .= "
					<tr>
						<td style='color:#000000;border: 1px solid black;'><font style='color:#000000;'>$ItemDescription</font></td>
						<td style='color:#000000;border: 1px solid black;text-align:center'><font style='color:#000000;'>$Quantity</font></td>
						<td style='color:#000000;border: 1px solid black;text-align:center'><font style='color:#000000;'>$ItemCost</font></td>
					</tr>
				";
			}

			$TotalPaid = number_format($json_return_data_ticket[0]->TotalPaid,0);

			$wpdb->update($table_vnnv_order_items, 
				array( 
					'booking_id' => $BookingId,
					'payment_id' => $ReceiptNo,
					'order_items_total_cost' => $TotalPaid
				), 
				array( 'order_id' => $order_id )
			);

			if ($MemberLanguage == "EN") {

			echo $body = "
			<!DOCTYPE html>
			<html>
				<head>
					<title></title>
					<style>
						* { font-size:16px!important; }
						h1 { font-size:30px!important; }
						h2 { font-size:20px!important; }
						table { border-spacing: 0; }
					</style>
				</head>
				<body>
					<table>
						<tr>
							<td><img src='https://www.vananavahuahin.com/edm/logo-resize.png' height='120' /></td><td><h1>Your Booking Confirmation with Vana Nava Water Jungle</h1></td>
						</tr>
						<tr>
							<td colspan='2'><br/><img alt='$BookingId' src='https://www.vananavahuahin.com/edm/barcode.php?text=$BookingId' /><br/></td>
						</tr>
						<tr><td colspan='2'><h2><font style='color:#000000;'>Your Visit Date: $StartDate</font></td></h2><br/></tr>
						<tr><td colspan='2'><b><font style='color:#000000;'>Customer Details<font></b></td><br/></tr>
						<tr><td colspan='2'><font style='color:#000000;'>Contact Name: $MemberFirstName $MemberLastName</font></td></tr>
						<tr><td colspan='2'><font style='color:#000000;'>Contact Email: $MemberEmail</font></td></tr>
						<tr><td colspan='2'><font style='color:#000000;'>Contact Mobile: $MemberMobile</font><br/><br/></td></tr>
						<tr>
							<td colspan='2'><font style='color:#000000;'>Thank you very much for selecting Vana Nava Water Jungle as your holiday destination. We are delighted to confirm your online ticket booking as below. Please show this email and the credit card used for this booking to get RFID Wristband at Counter 1 to 6 on arrival.</font><br/><br/><font style='color:#000000;'>Thank you for your purchase. See you at Vana Nava Water Jungle, Asia’s first Water Jungle soon :)</font><br/><br/>
							</td>
						</tr>
						<tr>
							<td colspan='2'><b>
							<font style='color:#000000;'>Payment Details</font></b><br/><br/>
							<font style='color:#000000;'>Payment Reference: $PaymentReference</font><br/><br/>
							<font style='color:#000000;'>Booking Reference: $BookingId</font>
							</td>
						</tr>
						<tr>
							<td colspan='2'><br/>
								<table style='width:100%;'>
									<tr>
										<th style='color:#000000;border: 1px solid black;'><font style='color:#000000;'>Ticket and Extra Items</font></th>
										<th style='color:#000000;border: 1px solid black;'><font style='color:#000000;'>QTY</font></th> 
										<th style='color:#000000;border: 1px solid black;'><font style='color:#000000;'>Total</font></th>
									</tr>
									$Information_ticket_new_now
									<tr>
									    <td style='color:#000000;border: 0px solid black;'></td>
										<td style='color:#000000;border: 1px solid black;text-align:center'><font style='color:#000000;'>Total Price</font></td>
										<td style='color:#000000;border: 1px solid black;text-align:center'><font style='color:#000000;'>$TotalSumPaid</font></td> 
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan='2'><br/>
								<b><font style='color:#000000;'>Vana Nava Terms & Conditions for Online Booking</font></b><br/><br/>
								$Information_terms_en
							</td>
						</tr>
						<tr>
							<td colspan='2'><font style='color:#000000;'>
							Vana Nava Hua Hin Online booking contact: <br/>
							Tel. 032-909-606<br/>
							email: booking@vananava.com</font>
							</td>
						</tr>
					<table>
				</body>
			</html>
			";

			} else if ($MemberLanguage == "TH") {

			echo $body = "
			<!DOCTYPE html>
			<html>
				<head>
					<title></title>
					<style>
						* { font-size:16px!important; }
						h1 { font-size:30px!important; }
						h2 { font-size:20px!important; }
						table { border-spacing: 0; }
					</style>
				</head>
				<body>
					<table>
						<tr>
							<td><img src='https://www.vananavahuahin.com/edm/logo-resize.png' height='120' /></td><td><h1>Your Booking Confirmation with Vana Nava Water Jungle </h1></td>
						</tr>
						<tr>
							<td colspan='2'><br/><img alt='$BookingId' src='https://www.vananavahuahin.com/edm/barcode.php?text=$BookingId' /><br/></td>
						</tr>
						<tr><td colspan='2'><h2><font style='color:#000000;'>วันมาใช้บริการที่สวนน้ำ : $StartDate</font></td></h2><br/></tr>
						<tr><td colspan='2'><b><font style='color:#000000;'>ข้อมูลลูกค้า</font></b></td><br/></tr>
						<tr><td colspan='2'><font style='color:#000000;'>ชื่อ - นามสกุล: $MemberFirstName $MemberLastName</font></td></tr>
						<tr><td colspan='2'><font style='color:#000000;'>อีเมล์: $MemberEmail</font></td></tr>
						<tr><td colspan='2'><font style='color:#000000;'>เบอร์โทรศัพท์: $MemberMobile</font><br/><br/></td></tr>
						<tr>
							<td colspan='2'><font style='color:#000000;'>ขอบพระคุณที่วางแผนมาพักผ่อนที่สวนน้ำวานา นาวา วอเตอร์ จังเกิ้ล ในวันหยุดของท่านนะคะ และขอยืนยันรายการสั่งซื้อบัตรสวนน้ำออนไลน์ของท่านตามรายละเอียดด้านล่างค่ะ เมื่อไปถึงสวนน้ำแล้วแสดงอีเมล์นี้กับเจ้าหน้าที่ ณ จุดจำหน่ายบัตร พร้อมแสดงหน้าบัตรเครดิตที่มีชื่อตรงกับข้อมูลลูกค้าที่ระบุไว้เพื่อรับสาย RFID Wristband ค่ะ</font><br/><br/><font style='color:#000000;'>ขอบคุณสำหรับการซื้อบัตรสวนน้ำออนไลน์ แล้วพบกันที่วานา นาวา วอเตอร์ จังเกิ้ล ที่สุดสวนน้ำระดับโลก นะคะ :)</font><br/><br/>
							</td>
						</tr>
						<tr>
							<td colspan='2'><b>
							<font style='color:#000000;'>รายละเอียดค่าใช้จ่าย</font></b><br/><br/>
							<font style='color:#000000;'>หมายเลขอ้างอิงการชำระเงิน: $PaymentReference</font><br/><br/>
							<font style='color:#000000;'>หมายเลขการสั่งซื้อ: $BookingId</font>
							</td>
						</tr>
						<tr>
							<td colspan='2'><br/>
								<table style='width:100%;'>
									<tr>
										<th style='color:#000000;border: 1px solid black;'><font style='color:#000000;'>รายการสั่งซื้อ</font></th>
										<th style='color:#000000;border: 1px solid black;'><font style='color:#000000;'>จำนวน</font></th> 
										<th style='color:#000000;border: 1px solid black;'><font style='color:#000000;'>ราคา</font></th>
									</tr>
									$Information_ticket_new_now
									<tr>
									    <td style='color:#000000;border: 0px solid black;'></td>
										<td style='color:#000000;border: 1px solid black;text-align:center'><font style='color:#000000;'>รวมทั้งสิ้น</font></td>
										<td style='color:#000000;border: 1px solid black;text-align:center'><font style='color:#000000;'>$TotalSumPaid</font></td> 
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan='2'><br/>
								<b><font style='color:#000000;'>เงื่อนไขและข้อกำหนดสำหรับการซื้อบัตรสวนน้ำออนไลน์วานา นาวา วอเตอร์ จังเกิ้ล</font></b><br/><br/>
								$Information_terms_th
							</td>
						</tr>
						<tr>
							<td colspan='2'><font style='color:#000000;'>
							ติดต่อฝ่ายบริการบัตรสวนน้ำออนไลน์ <br/>
							โทรศัพท์. 032-909-606<br/>
							อีเมล์: booking@vananava.com</font>
							</td>
						</tr>
					<table>
				</body>
			</html>
			";

			}

			if ($BookingId == "") {

			echo $body;
			$headers[] = 'Content-Type: text/html; charset=UTF-8';
			$headers[] = 'From: Vana Nava <sales@vananavahuahin.com>';

			//echo wp_mail( "pachara@digitiv.net", 'Vana Nava Confirm Email', $body, $headers );

			} else if ($BookingId != "") {

			echo $body;
			$headers[] = 'Content-Type: text/html; charset=UTF-8';
			$headers[] = 'From: Vana Nava <sales@vananavahuahin.com>';
			$headers[] = 'Bcc: Booking <booking@vananava.com>';
			$headers[] = 'Bcc: Ruttpahong.w <ruttaphong.w@vananava.com>';
			$headers[] = 'Bcc: Income <income@vananava.com>';
			$headers[] = 'Bcc: Ar <ar@vananava.com>';

			echo wp_mail( "$MemberEmail", 'Vana Nava Confirm Email', $body, $headers );

			}

		}
	} else {
		echo "Hash check = failed. do not use this response data.";
	}
	
	$json_response_contact = json_encode($json_return_data_contact, JSON_UNESCAPED_UNICODE);
	$wpdb->insert($table_vnnv_log_ctm_contact, array(
		'log_ctm_contact_response' => $json_response_contact,
		'log_ctm_contact_data' => $json_data_contact,
		'order_id' => $order_id
	));

	
	$json_response_ticket = json_encode($json_return_data_ticket, JSON_UNESCAPED_UNICODE);
	$wpdb->insert($table_vnnv_log_ctm_ticket, array(
		'log_ctm_ticket_response_code' => $json_response_ticket,
		'log_ctm_ticket_response' => $json_data_ticket,
		'log_ctm_ticket_data' => $json_data_ticket_mail,
		'order_id' => $order_id
	));

	if ($checkip == "119.63.87.178") {

	$wpdb->insert($table_vnnv_log_2c2p, array(
		'log_2c2p_response' => $response,
		'log_2c2p_status' => $channel_response_desc,
		'order_id' => $order_id
	));

	} else if ($checkip != "119.63.87.178") {

	$wpdb->insert($table_vnnv_log_2c2p, array(
		'log_2c2p_response' => $response,
		'log_2c2p_status' => $channel_response_desc,
		'order_id' => $order_id
	));

	}	

	$wpdb->insert($table_vnnv_log_2c2p_recheck, array(
		'log_2c2p_response' => $response,
		'log_2c2p_status' => $channel_response_desc,
		'order_id' => $order_id
	));

	$wpdb->insert($table_vnnv_log_order, array(
		'log_contact_data' => $json_data_contact,
		'log_ticket_data' => $json_data_ticket,
		'log_ticket_data_mail' => $json_data_ticket_mail,
		'order_id' => $order_id,
		'booking_id' => $BookingId,
		'receiptno_id' => $ReceiptNo
	));

	
	include('connect.php');

	$sql0 =	"SELECT MAX(order_item_id) FROM vananava_wp_vnnv_order_items";
	$query0 = mysql_db_query($dbname, $sql0) or die("Can't Query0");
	$row0 = mysql_fetch_array($query0);
	$order_item_id = $row0[0] ;

	$sql1 =	"SELECT order_items_promotion FROM vananava_wp_vnnv_order_items WHERE order_item_id = '$order_item_id'";
	$query1 = mysql_query($sql1) or die("Can't Query1");
	$row1 = mysql_fetch_array($query1);
	$order_items_promotion = $row1[0];


	if ($payment_status == '000') {

		$sql2 =	"UPDATE vananava_wp_vnnv_co_promotion_code SET co_promotion_code_status = 'N' WHERE co_promotion_code_num = '$order_items_promotion'";
		$query2 = mysql_query($sql2) or die("Can't Query2");				

	} else if ($payment_status != '000') {

		$sql2 =	"UPDATE vananava_wp_vnnv_co_promotion_code SET co_promotion_code_status = 'Y' WHERE co_promotion_code_num = '$order_items_promotion'";
		$query2 = mysql_query($sql2) or die("Can't Query2");

	}

	if ($payment_status == '000' && $MemberLanguage == 'EN') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done_backend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/online-booking-done" );

	} else if ($payment_status == '000' && $MemberLanguage == 'TH') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done-th_backend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/th/online-booking-done-th" );

	} else if ($payment_status == '00' && $MemberLanguage == 'EN') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done_backend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/online-booking-done" );
		
	} else if ($payment_status == '00' && $MemberLanguage == 'TH') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done-th_backend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/th/online-booking-done-th" );

	} else if ($payment_status == '000' && $MemberLanguage == '') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done-none-lang_backend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/online-booking-done" );

	} else if ($payment_status == '00' && $MemberLanguage == '') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-done-none-lang_backend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/online-booking-done" );

	} else if ($payment_status == '001') {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-success-pending_backend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( "location: https://www.vananavahuahin.com/online-booking-success-pending" );

	} else {

		$sql3 =	"UPDATE vananava_wp_vnnv_order_items SET order_item_payment_page = 'online-booking-payment-is-cancelled_backend' WHERE order_id = '$order_id'";
		$query3 = mysql_query($sql3) or die("Can't Query3");
		$row3 = mysql_fetch_array($query3);

		header( 'location: https://www.vananavahuahin.com/online-booking-payment-is-cancelled' );	

	}

	session_destroy();

	}
	
?> 