<?php

require "../wp-config.php";

$cur_lang = pll_current_language();

$go_live = CENTAMAN_GOLIVE;

$table_vnnv_ctm_ticketmeta = $table_prefix . 'vnnv_ctm_ticketmeta';
$table_vnnv_ctm_time_ticket_type = $table_prefix . 'vnnv_ctm_time_ticket_type';
$table_vnnv_ctm_extrameta = $table_prefix . 'vnnv_ctm_extrameta';
$table_vnnv_co_promotion = $table_prefix . 'vnnv_co_promotion';
$table_vnnv_co_promotion_code = $table_prefix . 'vnnv_co_promotion_code';

$BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_TEST;
if( $go_live ) $BookingTypeId = CENTAMAN_BOOKING_TYPE_ID_PRODUCTION;

$debug = $_REQUEST['debug'];
$req_date = $_REQUEST['start_date'];
$promo_code = $_REQUEST['promo_code'];
$current_date = date("Y-m-d");
//$req_date = '03/08/2019';

?>
<?php
include('connect.php');

$datebooking = $_GET['datebooking'];

$sql1 =	"SELECT SUM(order_items_beachhut) FROM vananava_wp_vnnv_order_items WHERE order_item_payment_status = '000' AND order_items_add_currentdate = '$req_date'";
$query1 = mysql_db_query($dbname, $sql1) or die($sql1);
$row1 = mysql_fetch_array($query1);
$order_items_beachhut_sum_date = $row1[0];
$order_items_beachhut_sum = 5 - $order_items_beachhut_sum_date;

if ($order_items_beachhut_sum <= '0') {

	$order_items_beachhut_use = 0;

} else if ($order_items_beachhut_sum > '0') {

	$order_items_beachhut_use = $order_items_beachhut_sum;

}

$sql2 =	"SELECT SUM(order_items_cabana) FROM vananava_wp_vnnv_order_items WHERE order_item_payment_status = '000' AND order_items_add_currentdate = '$req_date'";
$query2 = mysql_db_query($dbname, $sql2) or die("Can't Query2");
$row2 = mysql_fetch_array($query2);
$order_items_cabana_sum_date = $row2[0];
$order_items_cabana_sum = 3 - $order_items_cabana_sum_date;

if ($order_items_cabana_sum <= '0') {

	$order_items_cabana_use = 0;

} else if ($order_items_cabana_sum > '0') {

	$order_items_cabana_use = $order_items_cabana_sum;

}

?>
<input name="addcurrentdate" class="addcurrentdate" type="hidden" value="<?php echo $req_date ?>">
<input name="beachhutqty" class="beachhutqty" type="hidden" value="<?php echo $order_items_beachhut_use ?>">
<input name="cabanaqty" class="cabanaqty" type="hidden" value="<?php echo $order_items_cabana_use ?>" id="cabanaqty">
<?php if ($cur_lang == 'th') { ?>
	<input name="pagelang" class="pagelang" type="hidden" value="TH" id="pagelang">
<?php } else { ?>
	<input name="pagelang" class="pagelang" type="hidden" value="EN" id="pagelang">
<?php } ?>
<?php
$req_date = explode( '/', $req_date);
$req_date = $req_date[2] . '-' . $req_date[1] . '-' . $req_date[0];

$select_date = strtotime($req_date);
$advance_date  = strtotime('+15 days');

$is_advance = 'standard';
if($select_date < $advance_date){
	$is_advance = 'advance';
}
$start_date = $req_date . 'T00:00:00';

$sql_promo_code = "AND ctm_ticket_status NOT LIKE 'promotion'";
if($promo_code){
	$query = $wpdb->get_results( "SELECT * FROM $table_vnnv_co_promotion_code WHERE co_promotion_code_num LIKE '$promo_code' AND co_promotion_code_status LIKE 'Y' LIMIT 1", ARRAY_A );

	foreach($query as $key=>$value) {
		$co_promotion_id = $value['co_promotion_id'];
	}

	$query = $wpdb->get_results( "SELECT * FROM $table_vnnv_co_promotion WHERE co_promotion_id LIKE '$co_promotion_id' AND co_promotion_status LIKE 'Y' AND co_promotion_ticket_start_date <= '$current_date' AND co_promotion_ticket_end_date >= '$current_date' LIMIT 1", ARRAY_A );

	foreach($query as $key=>$value) {
		$co_promotion_name = $value['co_promotion_name'];
		$co_promotion_ticket_show = $value['co_promotion_ticket_show'];
		$co_promotion_ticket_not_show = $value['co_promotion_ticket_not_show'];
	}
	if($co_promotion_id && $co_promotion_name) {
		$sql_promo_code = "AND ctm_ticket_ID IN($co_promotion_ticket_show)";
	}
}

if(!$debug) {
	$query = $wpdb->get_results( "SELECT ctm_timed_ticket_type_ID,ctm_timed_ticket_type_description FROM $table_vnnv_ctm_time_ticket_type WHERE ctm_start_date LIKE '$start_date' AND ctm_booking_type_ID LIKE $BookingTypeId LIMIT 1", ARRAY_A );

	foreach($query as $key=>$value) {
		$TimedTicketTypeId = $value['ctm_timed_ticket_type_ID'];
		$TimedTicketTypeDescription = $value['ctm_timed_ticket_type_description'];
	}

	$server_status = SERVER_STATUS_TEST;
	if ( $go_live )$server_status = SERVER_STATUS_PRODUCTION;

	$query = $wpdb->get_results( "SELECT * FROM $table_vnnv_ctm_ticketmeta WHERE ctm_server LIKE '$server_status' AND ctm_is_display LIKE 'Y' AND ctm_ticket_start_date <= '$current_date' AND ctm_ticket_end_date >= '$current_date' AND ctm_ticket_start_date_use <= '$req_date' AND ctm_ticket_end_date_use >= '$req_date' AND ctm_ticket_status NOT LIKE '$is_advance' $sql_promo_code ORDER BY ABS(ctm_ticket_set) ASC " );
	
	$result = '';
		//$result = date('d/m/Y H:i:s');
	foreach($query as $obj){
		$ctm_ticket_name = $obj->ctm_ticket_name_en;
		$ctm_ticket_sub_description = $obj->ctm_ticket_sub_description_en;
		if ($cur_lang == 'th'){
			$ctm_ticket_name = $obj->ctm_ticket_name_th;
			$ctm_ticket_sub_description = $obj->ctm_ticket_sub_description_th;
		}

		$extra_item_ID = '';
		$extra_item_description = '';
		$extra_item_description_new = '';
		$extra_item_name_lang = '';
		$extra_item_price_num = '';
		$extra_item_quantity = '';
		$extra_item_name = '';
		$extra_item_price = 0;
		$extra_item = '';
		//edit
		if($obj->ctm_ticket_ID == '1345'){
			$extra_item_price+=(320);
		}

		if ($obj->ctm_ticket_extra_item) {
			$sub_query = $wpdb->get_results( "SELECT * FROM $table_vnnv_ctm_ticketmeta WHERE ctm_ticket_ID IN ($obj->ctm_ticket_extra_item)" );
			if ($sub_query) {
				foreach($sub_query as $sub_obj){
					$extra_item_ID .= $sub_obj->ctm_ticket_ID . '|';
					$extra_item_description .= $sub_obj->ctm_ticket_description . '|';
					if ($cur_lang == 'th'){
						$extra_item_description_new .= $sub_obj->ctm_ticket_name_th . '|';
					} else {
						$extra_item_description_new .= $sub_obj->ctm_ticket_name_en . '|';
					}
					$extra_item_price_num .= $sub_obj->ctm_ticket_price . '|';
					$extra_item_quantity .= $sub_obj->ctm_is_tax_inclusive . '|';
					$extra_item_name_lang = $sub_obj->ctm_ticket_name_en;
					if ($cur_lang == 'th'){
						$extra_item_name_lang = $sub_obj->ctm_ticket_name_th;
					}
					$extra_item_name .= $extra_item_name_lang . '|';

					$extra_item_price += $sub_obj->ctm_ticket_price;
				}
			}
			
			$sub_query = $wpdb->get_results( "SELECT * FROM $table_vnnv_ctm_extrameta WHERE ctm_extra_ID IN ($obj->ctm_ticket_extra_item)" );
			if ($sub_query) {
				foreach($sub_query as $sub_obj){
					$extra_item_ID .= $sub_obj->ctm_extra_ID . '|';
					$extra_item_description .= $sub_obj->ctm_extra_description . '|';
					if ($cur_lang == 'th'){
						$extra_item_description_new .= $sub_obj->ctm_extra_name_th . '|';
					} else {
						$extra_item_description_new .= $sub_obj->ctm_extra_name_en . '|';
					}
					$extra_item_price_num .= $sub_obj->ctm_extra_price . '|';
					$extra_item_quantity .= $sub_obj->ctm_is_tax_inclusive . '|';
					$extra_item_name_lang = $sub_obj->ctm_extra_name_en;
					if ($cur_lang == 'th'){
						$extra_item_name_lang = $sub_obj->ctm_extra_name_th;
					}
					$extra_item_name .= $extra_item_name_lang . '|';

					$extra_item_price += $sub_obj->ctm_extra_price;
				}
			}

			$extra_item_ID = rtrim($extra_item_ID, '|');
			$extra_item_description = rtrim($extra_item_description, '|');
			$extra_item_description_new = rtrim($extra_item_description_new, '|');
			$extra_item_name_lang = rtrim($extra_item_name_lang, '|');
			$extra_item_price_num = rtrim($extra_item_price_num, '|');
			$extra_item_quantity = rtrim($extra_item_quantity, '|');
			$extra_item_name = rtrim($extra_item_name, '|');

			$extra_item = '<input name="ExtraItemID" class="ExtraItemID" type="hidden" value="';
			$extra_item .= $extra_item_ID;
			$extra_item .= '"><input name="ExtraItemDescriptionCode" class="ExtraItemDescriptionCode" type="hidden" value="';
			$extra_item .= $extra_item_description;
			$extra_item .= '"><input name="ExtraItemDescription" class="ExtraItemDescription" type="hidden" value="';
			$extra_item .= $extra_item_description_new;
			$extra_item .= '"><input name="ExtraItemPriceNum" class="ExtraItemPriceNum" type="hidden" value="';
			$extra_item .= $extra_item_price_num;
			$extra_item .= '"><input name="ExtraItemQuantity" class="ExtraItemQuantity" type="hidden" value="';
			$extra_item .= $extra_item_quantity;
			$extra_item .= '" id="ExtraQty-'.$obj->ctm_ticket_ID.'"><input name="ExtraItemName" class="ExtraItemName" type="hidden" value="';
			$extra_item .= $extra_item_name;
			$extra_item .= '">';
		}
/*
			if($not_advance && $obj->ctm_ticket_status = 'advance'){
				continue;
			}
			if(!$not_advance && $obj->ctm_ticket_status = 'standard'){
				continue;
			}


*/
			$item_name_lang_code = $obj->ctm_ticket_description;
			if ($cur_lang == 'th'){
				$item_name_lang = $obj->ctm_ticket_name_th;
				$item_name_lang_sub = $obj->ctm_ticket_sub_description_th;
			} else {
				$item_name_lang = $obj->ctm_ticket_name_en;
				$item_name_lang_sub = $obj->ctm_ticket_sub_description_en;
			}

			$item_ticket_group = $obj->ctm_ticket_group;
			?>
			<?php if ($item_ticket_group == "Special Ticket") { ?>

			<?php
			$result .= '<div class="row-1"><div class="color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '"><img src="/wp-content/uploads/2019/07/hotdeal.png">&nbsp;&nbsp;<span class="font-bold ticket_name">';
			$result .= $ctm_ticket_name;
			$result .= '</span><br/>';
			$result .= $ctm_ticket_sub_description;
			$result .= '</div><div class="ml-auto font-bold color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '">฿ <span class="price" data-price="';
			$result .= $obj->ctm_ticket_price + $extra_item_price;
			$result .= '">';
			$result .= number_format($obj->ctm_ticket_price + $extra_item_price);
			$result .= '</span></div><div class="controlvalpass"><span class="down" onClick="button_down(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');" >-</span><span id="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '" class="valpass">0</span><span class="up" onClick="button_up(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');">+</span>';
			$result .= $extra_item;
			$result .= '</div><input type="hidden" name="description" class="description" value="';
			$result .= $item_name_lang;
			$result .= '"><input type="hidden" name="descriptionsub" class="descriptionsub" value="';
			$result .= $item_name_lang_sub;
			$result .= '"><input type="hidden" name="descriptioncode" class="descriptioncode" value="';
			$result .= $item_name_lang_code;
			$result .= '"><input type="hidden" name="ticketcode" class="ticketcode" value="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '"><input type="hidden" name="ticketcodegroup" class="ticketcodegroup" value="';
			$result .= $item_ticket_group;
			$result .= '"><input type="hidden" name="ticketpricemain" class="ticketpricemain" value="';
			$result .= $obj->ctm_ticket_price;
			$result .= '"><input type="hidden" name="ticketcabana" class="ticketcabana" value="';
			$result .= $order_items_cabana_use;
			$result .= '"><input type="hidden" name="ticketquantity" class="ticketquantity" value="';
			$result .= 1;
			$result .= '" id="ExtraQty-'.$obj->ctm_ticket_ID.'"></div>';

			}
			?>

			<?php if ($item_ticket_group == "Pass Ticket") { ?>

			<?php  $result .= $obj->ctm_ticket_group_name; ?>
			
			<?php } ?>

			<?php if ($item_ticket_group == "Pass Ticket") { ?>
			
			<?php	

			$result .= '<div class="row-1"><div class="color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '"><span class="font-bold ticket_name">';
			$result .= $ctm_ticket_name;
			$result .= '</span><br/>';
			$result .= $ctm_ticket_sub_description;
			$result .= '</div><div class="ml-auto font-bold color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '">฿ <span class="price" data-price="';
			$result .= $obj->ctm_ticket_price + $extra_item_price;
			$result .= '">';
			$result .= number_format($obj->ctm_ticket_price + $extra_item_price);
			$result .= '</span></div><div class="controlvalpass"><span class="down" onClick="button_down(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');" >-</span><span id="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '" class="valpass">0</span><span class="up" onClick="button_up(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');">+</span>';
			$result .= $extra_item;
			$result .= '</div><input type="hidden" name="description" class="description" value="';
			$result .= $item_name_lang;
			$result .= '"><input type="hidden" name="descriptionsub" class="descriptionsub" value="';
			$result .= $item_name_lang_sub;
			$result .= '"><input type="hidden" name="descriptioncode" class="descriptioncode" value="';
			$result .= $item_name_lang_code;
			$result .= '"><input type="hidden" name="ticketcode" class="ticketcode" value="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '"><input type="hidden" name="ticketcodegroup" class="ticketcodegroup" value="';
			$result .= $item_ticket_group;
			$result .= '"><input type="hidden" name="ticketpricemain" class="ticketpricemain" value="';
			$result .= $obj->ctm_ticket_price;
			$result .= '"><input type="hidden" name="ticketcabana" class="ticketcabana" value="';
			$result .= $order_items_cabana_use;
			$result .= '"><input type="hidden" name="ticketquantity" class="ticketquantity" value="';
			$result .= 1;
			$result .= '" id="ExtraQty-'.$obj->ctm_ticket_ID.'"></div>';

			}
			?>

			<?php if ($item_ticket_group == "Family Package") { ?>

			<?php  $result .= $obj->ctm_ticket_group_name; ?>
			
			<?php } ?>

			<?php if ($item_ticket_group == "Family Package") { ?>

			<?php
			$result .= '<div class="row-1"><div class="color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '"><span class="font-bold ticket_name">';
			$result .= $ctm_ticket_name;
			$result .= '</span><br/>';
			$result .= $ctm_ticket_sub_description;
			$result .= '</div><div class="ml-auto font-bold color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '">฿ <span class="price" data-price="';
			$result .= $obj->ctm_ticket_price + $extra_item_price;
			$result .= '">';
			$result .= number_format($obj->ctm_ticket_price + $extra_item_price);
			$result .= '</span></div><div class="controlvalpass"><span class="down" onClick="button_down(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');" >-</span><span id="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '" class="valpass">0</span><span class="up" onClick="button_up(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');">+</span>';
			$result .= $extra_item;
			$result .= '</div><input type="hidden" name="description" class="description" value="';
			$result .= $item_name_lang;
			$result .= '"><input type="hidden" name="descriptionsub" class="descriptionsub" value="';
			$result .= $item_name_lang_sub;
			$result .= '"><input type="hidden" name="descriptioncode" class="descriptioncode" value="';
			$result .= $item_name_lang_code;
			$result .= '"><input type="hidden" name="ticketcode" class="ticketcode" value="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '"><input type="hidden" name="ticketcodegroup" class="ticketcodegroup" value="';
			$result .= $item_ticket_group;
			$result .= '"><input type="hidden" name="ticketpricemain" class="ticketpricemain" value="';
			$result .= $obj->ctm_ticket_price;
			$result .= '"><input type="hidden" name="ticketcabana" class="ticketcabana" value="';
			$result .= $order_items_cabana_use;
			$result .= '"><input type="hidden" name="ticketquantity" class="ticketquantity" value="';
			$result .= 1;
			$result .= '" id="ExtraQty-'.$obj->ctm_ticket_ID.'"></div>';
				
			}
			?>

			<?php if ($item_ticket_group == "All-In Day Pass Lunch Buffet") { ?>

			<?php  $result .= $obj->ctm_ticket_group_name; ?>
			
			<?php } ?>

			<?php if ($item_ticket_group == "All-In Day Pass Lunch Buffet") { ?>

			<?php
			$result .= '<div class="row-1"><div class="color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '"><span class="font-bold ticket_name">';
			$result .= $ctm_ticket_name;
			$result .= '</span><br/>';
			$result .= $ctm_ticket_sub_description;
			$result .= '</div><div class="ml-auto font-bold color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '">฿ <span class="price" data-price="';
			$result .= $obj->ctm_ticket_price + $extra_item_price;
			$result .= '">';
			$result .= number_format($obj->ctm_ticket_price + $extra_item_price);
			$result .= '</span></div><div class="controlvalpass"><span class="down" onClick="button_down(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');" >-</span><span id="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '" class="valpass">0</span><span class="up" onClick="button_up(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');">+</span>';
			$result .= $extra_item;
			$result .= '</div><input type="hidden" name="description" class="description" value="';
			$result .= $item_name_lang;
			$result .= '"><input type="hidden" name="descriptionsub" class="descriptionsub" value="';
			$result .= $item_name_lang_sub;
			$result .= '"><input type="hidden" name="descriptioncode" class="descriptioncode" value="';
			$result .= $item_name_lang_code;
			$result .= '"><input type="hidden" name="ticketcode" class="ticketcode" value="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '"><input type="hidden" name="ticketcodegroup" class="ticketcodegroup" value="';
			$result .= $item_ticket_group;
			$result .= '"><input type="hidden" name="ticketpricemain" class="ticketpricemain" value="';
			$result .= $obj->ctm_ticket_price;
			$result .= '"><input type="hidden" name="ticketcabana" class="ticketcabana" value="';
			$result .= $order_items_cabana_use;
			$result .= '"><input type="hidden" name="ticketquantity" class="ticketquantity" value="';
			$result .= 1;
			$result .= '" id="ExtraQty-'.$obj->ctm_ticket_ID.'"></div>';
				
			}
			?>

			<?php if ($item_ticket_group == "All-In Day Pass Dinner Seafood Buffet") { ?>

			<?php  $result .= $obj->ctm_ticket_group_name; ?>
			
			<?php } ?>

			<?php if ($item_ticket_group == "All-In Day Pass Dinner Seafood Buffet") { ?>

			<?php
			$result .= '<div class="row-1"><div class="color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '"><span class="font-bold ticket_name">';
			$result .= $ctm_ticket_name;
			$result .= '</span><br/>';
			$result .= $ctm_ticket_sub_description;
			$result .= '</div><div class="ml-auto font-bold color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '">฿ <span class="price" data-price="';
			$result .= $obj->ctm_ticket_price + $extra_item_price;
			$result .= '">';
			$result .= number_format($obj->ctm_ticket_price + $extra_item_price);
			$result .= '</span></div><div class="controlvalpass"><span class="down" onClick="button_down(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');" >-</span><span id="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '" class="valpass">0</span><span class="up" onClick="button_up(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');">+</span>';
			$result .= $extra_item;
			$result .= '</div><input type="hidden" name="description" class="description" value="';
			$result .= $item_name_lang;
			$result .= '"><input type="hidden" name="descriptionsub" class="descriptionsub" value="';
			$result .= $item_name_lang_sub;
			$result .= '"><input type="hidden" name="descriptioncode" class="descriptioncode" value="';
			$result .= $item_name_lang_code;
			$result .= '"><input type="hidden" name="ticketcode" class="ticketcode" value="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '"><input type="hidden" name="ticketcodegroup" class="ticketcodegroup" value="';
			$result .= $item_ticket_group;
			$result .= '"><input type="hidden" name="ticketpricemain" class="ticketpricemain" value="';
			$result .= $obj->ctm_ticket_price;
			$result .= '"><input type="hidden" name="ticketcabana" class="ticketcabana" value="';
			$result .= $order_items_cabana_use;
			$result .= '"><input type="hidden" name="ticketquantity" class="ticketquantity" value="';
			$result .= 1;
			$result .= '" id="ExtraQty-'.$obj->ctm_ticket_ID.'"></div>';
				
			}
			?>

			<?php if ($item_ticket_group == "All-In Day Pass Lunch Buffet + Dinner Seafood Buffet") { ?>

			<?php  $result .= $obj->ctm_ticket_group_name; ?>
			
			<?php } ?>

			<?php if ($item_ticket_group == "All-In Day Pass Lunch Buffet + Dinner Seafood Buffet") { ?>

			<?php
			$result .= '<div class="row-1"><div class="color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '"><span class="font-bold ticket_name">';
			$result .= $ctm_ticket_name;
			$result .= '</span><br/>';
			$result .= $ctm_ticket_sub_description;
			$result .= '</div><div class="ml-auto font-bold color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '">฿ <span class="price" data-price="';
			$result .= $obj->ctm_ticket_price + $extra_item_price;
			$result .= '">';
			$result .= number_format($obj->ctm_ticket_price + $extra_item_price);
			$result .= '</span></div><div class="controlvalpass"><span class="down" onClick="button_down(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');" >-</span><span id="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '" class="valpass">0</span><span class="up" onClick="button_up(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');">+</span>';
			$result .= $extra_item;
			$result .= '</div><input type="hidden" name="description" class="description" value="';
			$result .= $item_name_lang;
			$result .= '"><input type="hidden" name="descriptionsub" class="descriptionsub" value="';
			$result .= $item_name_lang_sub;
			$result .= '"><input type="hidden" name="descriptioncode" class="descriptioncode" value="';
			$result .= $item_name_lang_code;
			$result .= '"><input type="hidden" name="ticketcode" class="ticketcode" value="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '"><input type="hidden" name="ticketcodegroup" class="ticketcodegroup" value="';
			$result .= $item_ticket_group;
			$result .= '"><input type="hidden" name="ticketpricemain" class="ticketpricemain" value="';
			$result .= $obj->ctm_ticket_price;
			$result .= '"><input type="hidden" name="ticketcabana" class="ticketcabana" value="';
			$result .= $order_items_cabana_use;
			$result .= '"><input type="hidden" name="ticketquantity" class="ticketquantity" value="';
			$result .= 1;
			$result .= '" id="ExtraQty-'.$obj->ctm_ticket_ID.'"></div>';
				
			}
			?>

			<?php if ($item_ticket_group == "Other Promotion") { ?>

			<?php  $result .= $obj->ctm_ticket_group_name; ?>
			
			<?php } ?>

			<?php if ($item_ticket_group == "Other Promotion") { ?>

			<?php
			$result .= '<div class="row-1"><div class="color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '"><span class="font-bold ticket_name">';
			$result .= $ctm_ticket_name;
			$result .= '</span><br/>';
			$result .= $ctm_ticket_sub_description;
			$result .= '</div><div class="ml-auto font-bold color-';
			$result .= $obj->ctm_ticket_color;
			$result .= '">฿ <span class="price" data-price="';
			$result .= $obj->ctm_ticket_price + $extra_item_price;
			$result .= '">';
			$result .= number_format($obj->ctm_ticket_price + $extra_item_price);
			$result .= '</span></div><div class="controlvalpass"><span class="down" onClick="button_down(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');" >-</span><span id="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '" class="valpass">0</span><span class="up" onClick="button_up(';
			$result .= $obj->ctm_ticket_ID;
			$result .= ');">+</span>';
			$result .= $extra_item;
			$result .= '</div><input type="hidden" name="description" class="description" value="';
			$result .= $item_name_lang;
			$result .= '"><input type="hidden" name="descriptionsub" class="descriptionsub" value="';
			$result .= $item_name_lang_sub;
			$result .= '"><input type="hidden" name="descriptioncode" class="descriptioncode" value="';
			$result .= $item_name_lang_code;
			$result .= '"><input type="hidden" name="ticketcode" class="ticketcode" value="';
			$result .= $obj->ctm_ticket_ID;
			$result .= '"><input type="hidden" name="ticketcodegroup" class="ticketcodegroup" value="';
			$result .= $item_ticket_group;
			$result .= '"><input type="hidden" name="ticketpricemain" class="ticketpricemain" value="';
			$result .= $obj->ctm_ticket_price;
			$result .= '"><input type="hidden" name="ticketcabana" class="ticketcabana" value="';
			$result .= $order_items_cabana_use;
			$result .= '"><input type="hidden" name="ticketquantity" class="ticketquantity" value="';
			$result .= 1;
			$result .= '" id="ExtraQty-'.$obj->ctm_ticket_ID.'"></div>';
				
			}
			?>
			
			<?php


		}

	} else {
		$result = '<div class="row-1"><div><span class="font-bold">';
		$result .= 'Test Ticket';
		$result .= '</span>';
		//$result .= '(Age 60 yrs. & up)';
		$result .= '</div><div class="ml-auto color-pink font-bold">฿ ';
		$result .= '1200';
		$result .= '</div><div class="controlvalpass"><span class="down" onClick="button_down(1133);">-</span><span id="';
		$result .= '1133';
		$result .= '" class="valpass">0</span><span class="up" onClick="button_up(1133);">+</span></div></div>';
	}

	$result .= '<input name="TimedTicketTypeId" type="hidden" value="' . $TimedTicketTypeId . '">';
	$result .= '<input name="TimedTicketTypeDescription" type="hidden" value="' . $TimedTicketTypeDescription . '">';
	$result .= '<input name="StartDate" type="hidden" value="' . $req_date . '">';	

	$query_extra = $wpdb->get_results( "SELECT * FROM $table_vnnv_ctm_extrameta WHERE ctm_server LIKE '$server_status' AND ctm_is_active LIKE 'Y'" );
	foreach($query_extra as $obj_extra) {
		$result .= '<input class="description_extra_';
		$result .= $obj_extra->ctm_extra_slug;
		$result .= '" name="description_extra_';
		$result .= $obj_extra->ctm_extra_slug;
		$result .= '" type="hidden" value="';
		$result .= $obj_extra->ctm_extra_ID;
		$result .= '|';
		if ($cur_lang == 'th'){
			$result .= $obj_extra->ctm_extra_name_th;
		} else {
			$result .= $obj_extra->ctm_extra_name_en;
		}	
		$result .= '|';
		$result .= $obj_extra->ctm_extra_price;
		$result .= '">';

		$result .= '<input class="descriptioncode_extra_';
		$result .= $obj_extra->ctm_extra_slug;
		$result .= '" name="descriptioncode_extra_';
		$result .= $obj_extra->ctm_extra_slug;
		$result .= '" type="hidden" value="';
		$result .= $obj_extra->ctm_extra_ID;
		$result .= '|';
		$result .= $obj_extra->ctm_extra_description;
		$result .= '|';
		$result .= $obj_extra->ctm_extra_price;
		$result .= '">';	

	}
	
	echo $result;
	exit;
	?>
