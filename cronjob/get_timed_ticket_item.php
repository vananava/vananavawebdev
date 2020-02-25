<?php
	require "../wp-config.php";
	
	$BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_TEST;
	if( $go_live ) $BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_PRODUCTION;
	
	$ticket_type_id	=	$_REQUEST['id'];

	/* GET TICKETS FROM CENTAMAN */
	$centaman_api_url = CENTAMAN_URL;
	$credentials = CENTAMAN_CREDENTIALS;
	$curl = curl_init();
	$url = "$centaman_api_url/ticket_services/TimedTicket?TimedTicketTypeId=" . $ticket_type_id;
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_USERPWD, $credentials);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	$json_response = curl_exec($curl);
	$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	if ( $status != 201 && $status != 200 ) echo "Error: call to $url failed with status $status,<br/>response $json_response,<br/>curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl);
	
	curl_close($curl);

	$json_data = json_decode($json_response);
	
	foreach($json_data as $key=>$value) {
		$wpdb->replace('wp_vnnv_ctm_time_ticket', array (
			"ctm_timed_ticket_ID" => $ticket_type_id . $value->TicketId,
			"ctm_ticket_ID" => $value->TicketId,
			"ctm_ticket_description" => $value->TicketDescription,
			"ctm_ticket_price" => $value->TicketPrice,
			"ctm_ticket_booking_fee" => $value->TicketBookingFee,
			"ctm_ticket_fee_item_ID" => $value->TicketFeeItemId,
			"ctm_deposit_percentage" => $value->DepositPercentage,
			"ctm_is_tax_inclusive" => $value->IsTaxInclusive,
			"ctm_tax_percentage" => $value->TaxPercentage,
			"ctm_timed_ticket_type_ID" => $ticket_type_id
		));
	}
	
	//print_r($json_data);
	echo 'success';
	exit;
?>