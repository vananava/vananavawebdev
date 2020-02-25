<?php
	require "../wp-config.php";
	
	$go_live = CENTAMAN_GOLIVE;

	$table_vnnv_ctm_extrameta = $table_prefix . 'vnnv_ctm_extrameta';

	$BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_TEST;
	$ctm_server = SERVER_STATUS_TEST;
	if( $go_live ) {
		$BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_PRODUCTION;
		$ctm_server = SERVER_STATUS_PRODUCTION;
	}

	$req_date = date('Y-m-d');

	$start_date = $req_date . 'T00:00:00';

	$table_time_ticket_type =  $table_prefix . 'vnnv_ctm_time_ticket_type';

	$query = $wpdb->get_results( "SELECT ctm_timed_ticket_type_ID FROM $table_time_ticket_type WHERE ctm_start_date LIKE '$start_date' AND ctm_server LIKE '$ctm_server' LIMIT 1", ARRAY_A );


	foreach($query as $key=>$value) {
		$TimedTicketTypeId = $value['ctm_timed_ticket_type_ID'];
	}

	/* GET TICKETS FROM CENTAMAN */
	$centaman_api_url = CENTAMAN_URL;
	$credentials = CENTAMAN_CREDENTIALS;
	$curl = curl_init();
	$url = "$centaman_api_url/ticket_services/TimedTicketExtra?TimedTicketTypeId=" . $TimedTicketTypeId;
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

	/*
	echo '<pre>';
    print_r($json_data);
    echo '</pre>';
	exit;
	*/
	
	foreach($json_data as $obj) {
		//echo "$obj->ExtraId --<br>";
		$query = $wpdb->get_results( "SELECT * FROM $table_vnnv_ctm_extrameta WHERE ctm_extra_ID LIKE '$obj->ExtraId' LIMIT 1", ARRAY_A );
		foreach($query as $key=>$value) {
			$ctm_is_active = $value['ctm_is_active'];
			$ctm_extra_slug = $value['ctm_extra_slug'];
			$ctm_extra_name_en = $value['ctm_extra_name_en'];
			$ctm_extra_name_th = $value['ctm_extra_name_th'];
		}
		//echo $obj->ExtraId."<br>";
		$wpdb->replace($table_prefix . 'vnnv_ctm_extrameta', array (
			"ctm_extra_ID" => $obj->ExtraId,
			"ctm_extra_description" => $obj->ExtraDescription,
			"ctm_extra_price" => $obj->ExtraPrice,
			"ctm_deposit_percentage" => $obj->DepositPercentage,
			"ctm_is_tax_inclusive" => $obj->IsTaxInclusive,
			"ctm_tax_percentage" => $obj->TaxPercentage,
			"ctm_server" => $ctm_server,
			"ctm_is_active" => $ctm_is_active,
			"ctm_extra_slug" => $ctm_extra_slug,
			"ctm_extra_extra_item" => $ctm_extra_extra_item,
			"ctm_extra_name_en" => $ctm_extra_name_en,
			"ctm_extra_name_th" => $ctm_extra_name_th
		));	
		/*if ($obj->ExtraId == '1333') { 
			echo "yes<br>";

		}*/

	}

	//print_r($json_data);
	echo 'success';
	exit;
?>