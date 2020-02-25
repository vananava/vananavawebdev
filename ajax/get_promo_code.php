<?php
require "../wp-config.php";

$table_vnnv_co_promotion = $table_prefix . 'vnnv_co_promotion';
$table_vnnv_co_promotion_code = $table_prefix . 'vnnv_co_promotion_code';

$promo_code = $_REQUEST['promo_code'];
$current_date = date("Y-m-d");

$query = $wpdb->get_results( "SELECT * FROM $table_vnnv_co_promotion_code WHERE co_promotion_code_num LIKE '$promo_code' AND co_promotion_code_status LIKE 'Y' LIMIT 1", ARRAY_A );

foreach($query as $key=>$value) {
	$co_promotion_id = $value['co_promotion_id'];
}

$query = $wpdb->get_results( "SELECT * FROM $table_vnnv_co_promotion WHERE co_promotion_id LIKE '$co_promotion_id' AND co_promotion_status LIKE 'Y' AND co_promotion_ticket_start_date <= '$current_date' AND co_promotion_ticket_end_date >= '$current_date' LIMIT 1", ARRAY_A );

foreach($query as $key=>$value) {
	$co_promotion_name = $value['co_promotion_name'];
}

if($co_promotion_id && $co_promotion_name) {
	$result = json_encode(
		array(
			'status' => 'success',
			'msg' => 'รหัส '.$promo_code.' ของคุณถูกต้อง'
		)
	);
} else {
	$result = json_encode(
		array(
			'status' => 'error',
			'msg' => 'ไม่พบโปรโมชั่นนี้ หรือ โค้ดโปรโมชั่นนี้ถูกใช้งานไปแล้ว'
		)
	);
}

echo $result;
exit;
?>