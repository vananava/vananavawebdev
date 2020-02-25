<?php
	require "../wp-config.php";
	
	$go_live = CENTAMAN_GOLIVE;

	$table_vnnv_ctm_ticketmeta = $table_prefix . 'vnnv_ctm_ticketmeta';

	$BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_TEST;
	$ctm_server = SERVER_STATUS_TEST;
	if( $go_live ) {
		$BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_PRODUCTION;
		$ctm_server = SERVER_STATUS_PRODUCTION;
	}

	//$req_date = '2019-09-30';
	$req_date = date('Y-m-d');

	$start_date = $req_date . 'T00:00:00';

	$table_time_ticket_type = $table_prefix . 'vnnv_ctm_time_ticket_type';

	$query = $wpdb->get_results( "SELECT ctm_timed_ticket_type_ID FROM $table_time_ticket_type WHERE ctm_start_date LIKE '$start_date' AND ctm_server LIKE '$ctm_server' LIMIT 1", ARRAY_A );

	foreach($query as $key=>$value) {
		$TimedTicketTypeId = $value['ctm_timed_ticket_type_ID'];
	}

	/* GET TICKETS FROM CENTAMAN */
	$centaman_api_url = CENTAMAN_URL;
	$credentials = CENTAMAN_CREDENTIALS;
	$curl = curl_init();
	$url = "$centaman_api_url/ticket_services/TimedTicket?TimedTicketTypeId=" . $TimedTicketTypeId;
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
	
	foreach($json_data as $obj) {
		$query = $wpdb->get_results( "SELECT * FROM $table_vnnv_ctm_ticketmeta WHERE ctm_ticket_ID LIKE '$obj->TicketId' LIMIT 1", ARRAY_A );
		foreach($query as $key=>$value) {
			$ctm_is_display = $value['ctm_is_display'];
			$ctm_ticket_color = $value['ctm_ticket_color'];
			$ctm_ticket_name_en = $value['ctm_ticket_name_en'];
			$ctm_ticket_name_th = $value['ctm_ticket_name_th'];
			$ctm_ticket_sub_description_en = $value['ctm_ticket_sub_description_en'];
			$ctm_ticket_sub_description_th = $value['ctm_ticket_sub_description_th'];
			$ctm_ticket_extra_item = $value['ctm_ticket_extra_item'];
			$ctm_ticket_status = $value['ctm_ticket_status'];
		}
		$wpdb->replace($table_prefix . 'vnnv_ctm_ticketmeta', array (
			"ctm_ticket_ID" => $obj->TicketId,
			"ctm_ticket_description" => $obj->TicketDescription,
			"ctm_ticket_price" => $obj->TicketPrice,
			"ctm_ticket_booking_fee" => $obj->TicketBookingFee,
			"ctm_ticket_fee_item_ID" => $obj->TicketFeeItemId,
			"ctm_deposit_percentage" => $obj->DepositPercentage,
			"ctm_is_tax_inclusive" => $obj->IsTaxInclusive,
			"ctm_tax_percentage" => $obj->TaxPercentage,
			"ctm_server" => $ctm_server,
			"ctm_is_display" => $ctm_is_display,
			"ctm_ticket_color" => $ctm_ticket_color,
			"ctm_ticket_name_en" => $ctm_ticket_name_en,
			"ctm_ticket_name_th" => $ctm_ticket_name_th,
			"ctm_ticket_sub_description_en" => $ctm_ticket_sub_description_en,
			"ctm_ticket_sub_description_th" => $ctm_ticket_sub_description_th,
			"ctm_ticket_extra_item" => $ctm_ticket_extra_item,
			"ctm_ticket_status_show" => $ctm_ticket_status_show,
			"ctm_ticket_start_date" => $ctm_ticket_start_date,
			"ctm_ticket_end_date" => $ctm_ticket_end_date,
			"ctm_ticket_status_show_use" => $ctm_ticket_status_show_use,
			"ctm_ticket_start_date_use" => $ctm_ticket_start_date_use,
			"ctm_ticket_end_date_use" => $ctm_ticket_end_date_use,
			"ctm_ticket_set" => $ctm_ticket_set,
			"ctm_ticket_group" => $ctm_ticket_group,
			"ctm_ticket_group_name" => $ctm_ticket_group_name,
			"ctm_ticket_status" => $ctm_ticket_status
		));
	}

	//print_r($json_data);
	echo 'success';
	exit;
?>