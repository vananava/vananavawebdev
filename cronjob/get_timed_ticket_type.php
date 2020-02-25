<?php
	require "../wp-config.php";
	
	$go_live = CENTAMAN_GOLIVE;

	$BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_TEST;
	$ctm_server = SERVER_STATUS_TEST;
	if( $go_live ) {
		$BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_PRODUCTION;
		$ctm_server = SERVER_STATUS_PRODUCTION;
	}

	$start_date =  date("Y-m-d") . 'T00:00:00';
	$end_date = date("Y-m-d", strtotime("+12 months")) . 'T00:00:00';

	/* GET TICKETS FROM CENTAMAN */
	$centaman_api_url = CENTAMAN_URL;
	$credentials = CENTAMAN_CREDENTIALS;
	$curl = curl_init();
	$url = "$centaman_api_url/ticket_services/TimedTicketType?BookingTypeId=$BookingTypeId&StartDate=$start_date&EndDate=$end_date";
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_USERPWD, $credentials);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$json_response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	if ( $status != 201 && $status != 200 ) echo "Error: call to $url failed with status $status,<br/>response $json_response,<br/>curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl);
	$json_data = json_decode($json_response);
		
	curl_close($curl);

	foreach($json_data as $key=>$value) {
		$wpdb->replace($table_prefix . 'vnnv_ctm_time_ticket_type', array (
			"ctm_timed_ticket_type_ID" => $value->TimedTicketTypeId,
			"ctm_timed_ticket_type_description" => $value->TimedTicketTypeDescription,
			"ctm_start_date" => $value->StartDate,
			"ctm_start_time" => $value->StartTime,
			"ctm_end_time" => $value->EndTime,
			"ctm_capacity" => $value->Capacity,
			"ctm_vacancy" => $value->vacancy,
			"ctm_bookingfee" => $value->Bookingfee,
			"ctm_booking_fee_item_code" => $value->BookingFeeItemCode,
			"ctm_cancelled" => $value->Cancelled,
			"ctm_server" => $ctm_server,
			"ctm_booking_type_ID" => $BookingTypeId
		));
	}

	//print_r($json_data);
	if ($json_data) echo 'success';
	else echo $status;
	exit;
?>