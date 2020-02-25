<?php
session_start();

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

function get_ticket_by_date_func( $date ) {
	return "date = $date";
}
add_shortcode( 'get_ticket_by_date', 'get_ticket_by_date_func' );

add_action( 'phpmailer_init', 'wpse8170_phpmailer_init' );
function wpse8170_phpmailer_init( PHPMailer $phpmailer ) {
	$phpmailer->Host = 'ssl://smtp.gmail.com';
    $phpmailer->Port = 465; // could be different
    $phpmailer->Username = 'booking@vananava.com'; // if required
    $phpmailer->Password = 'V@nanava2'; // if required
    $phpmailer->SMTPAuth = true; // if required
    // $phpmailer->SMTPSecure = 'ssl'; // enable if required, 'tls' is another possible value

    $phpmailer->IsSMTP();
}
/*
add_action( 'admin_menu', 'extra_post_info_menu_co_promotion' );
function extra_post_info_menu_co_promotion() {
	$page_title = 'Vananava Huahin Co-Promotion Code';
	$menu_title = 'Co-Promotion Code';
	$capability = 'manage_options_co_promotion';
	$menu_slug  = 'vananava_co_promotion';
	$function   = 'vananava_order_contents';
	$icon_url   = 'dashicons-media-default';
	$position   = 59;
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}
function vananava_co_promotion_contents() {
	$listTable = new Order_List_Table();
	$listTable->prepare_items();
	?>
		<div class="wrap">
		    <h2>Vananava Huahin Co Promotion <!--a href="" class="add-new-h2">Add New</a--></h2>
		    <?php $listTable->display(); ?>
		</div>
	<?php
}
*/
add_action( 'admin_menu', 'extra_post_info_menu' );
function extra_post_info_menu() {
	$page_title = 'Vananava Huahin Ticket Order';
	$menu_title = 'Ticket Order';
	$capability = 'manage_options';
	$menu_slug  = 'vananava_order';
	$function   = 'vananava_ticket_order_contents';
	$icon_url   = 'dashicons-media-default';
	$position   = 59;
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_submenu_page( $menu_slug, $page_title, '', 'manage_options', $menu_slug.'_view_order', 'vananava_order_view_order');

	$page_title = 'Vananava Huahin Co-Promotion Code';
	$menu_title = 'Co-Promotion Code';
	$capability = 'manage_options';
	$menu_slug  = 'vananava_co_promotion';
	$function   = 'vananava_co_promotion_contents';
	$icon_url   = 'dashicons-media-default';
	$position   = 59;
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_submenu_page( $menu_slug, $page_title, 'All Promotion Code', 'manage_options', $menu_slug);
	add_submenu_page( $menu_slug, $page_title, 'Add New Promotion Code', 'manage_options', $menu_slug.'_add_new', 'vananava_co_promotion_add_new');
	add_submenu_page( $menu_slug, $page_title, '', 'manage_options', $menu_slug.'_edit_new', 'vananava_co_promotion_edit_new');
	add_submenu_page( $menu_slug, $page_title, '', 'manage_options', $menu_slug.'_view_new', 'vananava_co_promotion_view_new');
	add_submenu_page( $menu_slug, $page_title, '', 'manage_options', $menu_slug.'_addmore_new', 'vananava_co_promotion_addmore_new');
	//add_action("load-$vananava_order_page", "vananava_order_screen_options");

	$page_title = 'Vananava Huahin Ticket Item';
	$menu_title = 'Product Ticket Item';
	$capability = 'manage_options';
	$menu_slug  = 'vananava_ticket_item';
	$function   = 'vananava_ticket_item_contents';
	$icon_url   = 'dashicons-media-default';
	$position   = 59;
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_submenu_page( $menu_slug, $page_title, 'All Product Ticket Item', 'manage_options', $menu_slug);
	add_submenu_page( $menu_slug, $page_title, '', 'manage_options', $menu_slug.'_add', 'vananava_ticket_item_add');
	add_submenu_page( $menu_slug, $page_title, '', 'manage_options', $menu_slug.'_edit', 'vananava_ticket_item_edit');

	$page_title = 'Vananava Huahin Extra Item';
	$menu_title = 'Product Extra Item';
	$capability = 'manage_options';
	$menu_slug  = 'vananava_extra_item';
	$function   = 'vananava_extra_item_contents';
	$icon_url   = 'dashicons-media-default';
	$position   = 59;
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_submenu_page( $menu_slug, $page_title, 'All Product Extra Item', 'manage_options', $menu_slug);
	add_submenu_page( $menu_slug, $page_title, '', 'manage_options', $menu_slug.'_add', 'vananava_extra_item_add');
	add_submenu_page( $menu_slug, $page_title, '', 'manage_options', $menu_slug.'_edit', 'vananava_extra_item_edit');

	$page_title = 'Vananava Huahin Member';
	$menu_title = 'Member';
	$capability = 'manage_options';
	$menu_slug  = 'vananava_member';
	$function   = 'vananava_member_contents';
	$icon_url   = 'dashicons-media-default';
	$position   = 59;
	add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
	add_submenu_page( $menu_slug, $page_title, 'All Member', 'manage_options', $menu_slug);
}
function vananava_ticket_item_contents() {
	$listTable = new Ticket_Item_List_Table();
	$listTable->prepare_items();
	?>
	<div class="wrap">
		<h2>Vananava Huahin Ticket Item</h2>
		<br>
		<div><strong>วิธีการดึง Ticket Item</strong></div>
		<br>
		<div>1. กดปุ่มนี้เพื่อดึงข้อมูล Ticket Item มาจาก Centaman <a href="https://www.vananavahuahin.com/cronjob/get_ticket_item.php" target="_blank" class="add-new-h2">กดเพื่อดึงข้อมูล</a> รอจนกว่าจะขึ้นคำว่า success เป็นอันเสร็จสมบูรณ์</div>
		<br>
		<div>2. กดปุ่มนี้เมื่อข้อมูลที่ต้องการไม่ปรากฎในระบบ <a href="admin.php?page=vananava_ticket_item_add" class="add-new-h2">Add Ticket Item</a> </div>
		<br>
		<?php $listTable->display(); ?>
	</div>
	<?php
}
function vananava_extra_item_contents() {
	$listTable = new Extra_Item_List_Table();
	$listTable->prepare_items();
	?>
	<div class="wrap">
		<h2>Vananava Huahin Extra Item</h2>
		<br>
		<div><strong>วิธีการดึง Extra Item</strong></div>
		<br>
		<div>1. กดปุ่มนี้เพื่อดึงข้อมูล Extra Item มาจาก Centaman <a href="https://www.vananavahuahin.com/cronjob/get_extra_item.php" target="_blank" class="add-new-h2">กดเพื่อดึงข้อมูล</a> รอจนกว่าจะขึ้นคำว่า success เป็นอันเสร็จสมบูรณ์</div>
		<br>
		<div>2. กดปุ่มนี้เมื่อข้อมูลที่ต้องการไม่ปรากฎในระบบ <a href="admin.php?page=vananava_extra_item_add" class="add-new-h2">Add Extra Item</a> </div>
		<br>
		<?php $listTable->display(); ?>
	</div>
	<?php
}
/*
function vananava_order_contents() {
	$listTable = new Order_List_Table();
	$listTable->prepare_items();
	?>
	<div class="wrap">
		<h2>Vananava Huahin Ticket Order</h2>
		<?php $listTable->display(); ?>
	</div>
	<?php
}
*/
function vananava_ticket_order_contents() {
	$listTable = new Ticket_Order_List_Table();
	$listTable->prepare_items();
	?>
	<div class="wrap">
		<h2>Vananava Huahin Ticket Order</h2>
		<?php $listTable->display(); ?>
	</div>
	<?php
}
function vananava_member_contents() {
	$listTable = new Member_List_Table();
	$listTable->prepare_items();
	?>
	<div class="wrap">
		<h2>Vananava Huahin Member</h2>
		<?php $listTable->display(); ?>
	</div>
	<?php
}
function vananava_order_view_order() {
	
	include('connect.php');

	$order_id = $_GET["order_id"];

	if($order_id == ""){ header("HTTP/1.1 301 Moved Permanently"); header('Location: admin.php?page=vananava_order'); exit(); }

	$sql1 =	" SELECT * FROM vananava_wp_vnnv_log_ctm_ticket WHERE order_id = '$order_id' ";
	$query1 = mysql_db_query($dbname, $sql1) or die("Can't Query1");
	$row1 = mysql_fetch_array($query1);

	$ctm_ticket = $row1["log_ctm_ticket_data"];

	$sql2 =	" SELECT * FROM vananava_wp_vnnv_log_ctm_contact WHERE order_id = '$order_id' ";
	$query2 = mysql_db_query($dbname, $sql2) or die("Can't Query2");
	$row2 = mysql_fetch_array($query2);

	$ctm_contact = $row2["log_ctm_contact_data"];

	$sql3 =	" SELECT * FROM vananava_wp_vnnv_order_items WHERE order_id = '$order_id' ";
	$query3 = mysql_db_query($dbname, $sql3) or die("Can't Query3");
	$row3 = mysql_fetch_array($query3);

	$sql4 =	" SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE meta_value LIKE '$order_id' ";
	$query4 = mysql_db_query($dbname, $sql4) or die("Can't Query4");
	$row4 = mysql_fetch_array($query4);

	$itemmeta_order_item_id = $row4["order_item_id"];

	$sql5 =	" SELECT * FROM vananava_wp_vnnv_log_order WHERE order_id = '$order_id' ";
	$query5 = mysql_db_query($dbname, $sql5) or die("Can't Query5");
	$row5 = mysql_fetch_array($query5);
	?>
	<script language="javascript" type="text/javascript">
  		function checkcentaman() {
    		if (confirm('คุณต้องการส่งค่าไปที่ centaman หรือไม่')==true) {
      			return true;
    		} else {
        		return false;
    		}
  		}
	</script>
	<script language="javascript" type="text/javascript">
  		function checkemail() {
    		if (confirm('คุณต้องการส่ง email อีกครั้งหรือไม่')==true) {
      			return true;
    		} else {
        		return false;
    		}
  		}
	</script>
	<div class="wrap">
		<h2>Order Detail</h2>
			<br>
			<font style='color:#000000;'><b> Order No : </b><?php echo $order_id ?> </font><br>
			<font style='color:#000000;'><b> Booking No : </b><?php echo $row3["booking_id"]?> </font><br>
			<font style='color:#000000;'><b> Receipt No : </b><?php echo $row5["receiptno_id"]?> </font><br>
			<font style='color:#000000;'><b> Planned Date : </b><?php echo $row3["order_items_add_currentdate"]?> </font><br>
			<div id="poststuff">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content" class="edit-form-section edit-comment-section">
						<div id="namediv" class="stuffbox">
							<div class="inside">
								<fieldset>
									<?php if ($ctm_contact == "") { ?>
									<table role="presentation" style='width:100%;'>
										<tbody>
											<tr>
												<th style='color:#000000; border: 1px solid black; width:80%; height:40px;' align="center"><font style='color:#000000;'>Contact Information</font></th>
											</tr>
											<tr>
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'>
													<font style='color:#000000;'><b> Name : </b><?php echo $row3["order_item_name"]?> </font><br>
													<font style='color:#000000;'><b> Email : </b><?php echo $row3["order_item_email"]?> </font><br>
													<font style='color:#000000;'><b> MobilePhone : </b><?php echo $row3["order_item_phone"]?> </font><br>
													<font style='color:#000000;'><b> Address </b></font><br>
													<font style='color:#000000;'><b> Country : </b><?php echo $row3["order_item_country"]?> </font><br>
												</td>
											</tr>
										</tbody>
									</table>
									<?php } else if ($ctm_contact != "") { ?>
									<table role="presentation" style='width:100%;'>
										<tbody>
											<tr>
												<th style='color:#000000; border: 1px solid black; width:80%; height:40px;' align="center"><font style='color:#000000;'>Contact Information</font></th>
											</tr>
											<?php
											$json_ctm_contact = json_decode($ctm_contact,true);

												foreach($json_ctm_contact as $key_ctm_contact) {
    
												}

											?>
											<tr>
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'>
													<font style='color:#000000;'><b> Name : </b><?php echo $json_ctm_contact['FirstName'];?> <?php echo $json_ctm_contact['LastName'];?> </font><br>
													<font style='color:#000000;'><b> Email : </b><?php echo $json_ctm_contact['Email'];?> </font><br>
													<font style='color:#000000;'><b> MobilePhone : </b><?php echo $key_ctm_contact['MobilePhone'];?> </font><br>
													<font style='color:#000000;'><b> WorkPhone : </b><?php echo $key_ctm_contact['WorkPhone'];?> </font><br>
													<font style='color:#000000;'><b> HomePhone : </b><?php echo $key_ctm_contact['HomePhone'];?> </font><br>
													<font style='color:#000000;'><b> Address </b></font><br>
													<font style='color:#000000;'><b> Street 1 : </b><?php echo $key_ctm_contact['Street1'];?> </font><br>
													<font style='color:#000000;'><b> Street 2 : </b><?php echo $key_ctm_contact['Street2'];?> </font><br>
													<font style='color:#000000;'><b> City : </b><?php echo $key_ctm_contact['City'];?> </font><br>
													<font style='color:#000000;'><b> State : </b><?php echo $key_ctm_contact['State'];?> </font><br>
													<font style='color:#000000;'><b> Country : </b><?php echo $key_ctm_contact['Country'];?> </font><br>
													<font style='color:#000000;'><b> Postalcode : </b><?php echo $key_ctm_contact['Postalcode'];?> </font><br>
												</td>
											</tr>
										</tbody>
									</table>
									<?php } ?>
									<br>
									<?php if ($ctm_ticket == "") { ?>
									
									<table role="presentation" style='width:100%;'>
										<tbody>
											<tr>
												<th style='color:#000000; border: 1px solid black; width:80%; height:40px;' align="center"><font style='color:#000000;'>Ticket and Extra Items</font></th>
												<th style='color:#000000; border: 1px solid black; width:10%; height:40px;' align="center"><font style='color:#000000;'>QTY</font></th> 
												<th style='color:#000000; border: 1px solid black; width:10%; height:40px;' align="center"><font style='color:#000000;'>Total</font></th>
											</tr>
											
											<tr>
												<?php
              									$sqlDes0 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemDescription_0' ORDER BY meta_id ASC ";
			  									$queryDes0 = mysql_db_query($dbname, $sqlDes0) or die("Can't QueryDes0");
			  									$rowDes0 = mysql_fetch_array($queryDes0);
			  									?>
			  									<?php if ($rowDes0["meta_value"] == "") { ?>
			  									<?php } else if ($rowDes0["meta_value"] != "") { ?>	
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $rowDes0["meta_value"]?> </td>
												<?php } ?>

												<?php
              									$sqlQua0 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'Quantity_0' ORDER BY meta_id ASC ";
			  									$queryQua0 = mysql_db_query($dbname, $sqlQua0) or die("Can't QueryQua0");
			  									$rowQua0 = mysql_fetch_array($queryQua0);
			  									?>
			  									<?php if ($rowQua0["meta_value"] == "") { ?>
			  									<?php } else if ($rowQua0["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowQua0["meta_value"]?> </font></td>
												<?php } ?>

												<?php
              									$sqlCos0 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemCost_0' ORDER BY meta_id ASC ";
			  									$queryCos0 = mysql_db_query($dbname, $sqlCos0) or die("Can't QueryCos0");
			  									$rowCos0 = mysql_fetch_array($queryCos0);
			  									?>
			  									<?php if ($rowCos0["meta_value"] == "") { ?>
			  									<?php } else if ($rowCos0["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowCos0["meta_value"]?></font></td>
												<?php } ?>
											</tr>

											<tr>
												<?php
              									$sqlDes1 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemDescription_1' ORDER BY meta_id ASC ";
			  									$queryDes1 = mysql_db_query($dbname, $sqlDes1) or die("Can't QueryDes1");
			  									$rowDes1 = mysql_fetch_array($queryDes1);
			  									?>
			  									<?php if ($rowDes1["meta_value"] == "") { ?>
			  									<?php } else if ($rowDes1["meta_value"] != "") { ?>	
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $rowDes1["meta_value"]?> </td>
												<?php } ?>

												<?php
              									$sqlQua1 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'Quantity_1' ORDER BY meta_id ASC ";
			  									$queryQua1 = mysql_db_query($dbname, $sqlQua1) or die("Can't QueryQua1");
			  									$rowQua1 = mysql_fetch_array($queryQua1);
			  									?>
			  									<?php if ($rowQua1["meta_value"] == "") { ?>
			  									<?php } else if ($rowQua1["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowQua1["meta_value"]?> </font></td>
												<?php } ?>

												<?php
              									$sqlCos1 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemCost_1' ORDER BY meta_id ASC ";
			  									$queryCos1 = mysql_db_query($dbname, $sqlCos1) or die("Can't QueryCos1");
			  									$rowCos1 = mysql_fetch_array($queryCos1);
			  									?>
			  									<?php if ($rowCos1["meta_value"] == "") { ?>
			  									<?php } else if ($rowCos1["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowCos1["meta_value"]?></font></td>
												<?php } ?>
											</tr>

											<tr>
												<?php
              									$sqlDes2 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemDescription_2' ORDER BY meta_id ASC ";
			  									$queryDes2 = mysql_db_query($dbname, $sqlDes2) or die("Can't QueryDes2");
			  									$rowDes2 = mysql_fetch_array($queryDes2);
			  									?>
			  									<?php if ($rowDes2["meta_value"] == "") { ?>
			  									<?php } else if ($rowDes2["meta_value"] != "") { ?>	
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $rowDes2["meta_value"]?> </td>
												<?php } ?>

												<?php
              									$sqlQua2 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'Quantity_2' ORDER BY meta_id ASC ";
			  									$queryQua2 = mysql_db_query($dbname, $sqlQua2) or die("Can't QueryQua2");
			  									$rowQua2 = mysql_fetch_array($queryQua2);
			  									?>
			  									<?php if ($rowQua2["meta_value"] == "") { ?>
			  									<?php } else if ($rowQua2["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowQua2["meta_value"]?> </font></td>
												<?php } ?>

												<?php
              									$sqlCos2 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemCost_2' ORDER BY meta_id ASC ";
			  									$queryCos2 = mysql_db_query($dbname, $sqlCos2) or die("Can't QueryCos2");
			  									$rowCos2 = mysql_fetch_array($queryCos2);
			  									?>
			  									<?php if ($rowCos2["meta_value"] == "") { ?>
			  									<?php } else if ($rowCos2["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowCos2["meta_value"]?></font></td>
												<?php } ?>
											</tr>

											<tr>
												<?php
              									$sqlDes3 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemDescription_3' ORDER BY meta_id ASC ";
			  									$queryDes3 = mysql_db_query($dbname, $sqlDes3) or die("Can't QueryDes3");
			  									$rowDes3 = mysql_fetch_array($queryDes3);
			  									?>
			  									<?php if ($rowDes3["meta_value"] == "") { ?>
			  									<?php } else if ($rowDes3["meta_value"] != "") { ?>	
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $rowDes3["meta_value"]?> </td>
												<?php } ?>

												<?php
              									$sqlQua3 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'Quantity_3' ORDER BY meta_id ASC ";
			  									$queryQua3 = mysql_db_query($dbname, $sqlQua3) or die("Can't QueryQua3");
			  									$rowQua3 = mysql_fetch_array($queryQua3);
			  									?>
			  									<?php if ($rowQua3["meta_value"] == "") { ?>
			  									<?php } else if ($rowQua3["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowQua3["meta_value"]?> </font></td>
												<?php } ?>

												<?php
              									$sqlCos3 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemCost_3' ORDER BY meta_id ASC ";
			  									$queryCos3 = mysql_db_query($dbname, $sqlCos3) or die("Can't QueryCos3");
			  									$rowCos3 = mysql_fetch_array($queryCos3);
			  									?>
			  									<?php if ($rowCos3["meta_value"] == "") { ?>
			  									<?php } else if ($rowCos3["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowCos3["meta_value"]?></font></td>
												<?php } ?>
											</tr>

											<tr>
												<?php
              									$sqlDes4 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemDescription_4' ORDER BY meta_id ASC ";
			  									$queryDes4 = mysql_db_query($dbname, $sqlDes4) or die("Can't QueryDes4");
			  									$rowDes4 = mysql_fetch_array($queryDes4);
			  									?>
			  									<?php if ($rowDes4["meta_value"] == "") { ?>
			  									<?php } else if ($rowDes4["meta_value"] != "") { ?>	
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $rowDes4["meta_value"]?> </td>
												<?php } ?>

												<?php
              									$sqlQua4 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'Quantity_4' ORDER BY meta_id ASC ";
			  									$queryQua4 = mysql_db_query($dbname, $sqlQua4) or die("Can't QueryQua4");
			  									$rowQua4 = mysql_fetch_array($queryQua4);
			  									?>
			  									<?php if ($rowQua4["meta_value"] == "") { ?>
			  									<?php } else if ($rowQua4["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowQua4["meta_value"]?> </font></td>
												<?php } ?>

												<?php
              									$sqlCos4 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemCost_4' ORDER BY meta_id ASC ";
			  									$queryCos4 = mysql_db_query($dbname, $sqlCos4) or die("Can't QueryCos4");
			  									$rowCos4 = mysql_fetch_array($queryCos4);
			  									?>
			  									<?php if ($rowCos4["meta_value"] == "") { ?>
			  									<?php } else if ($rowCos4["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowCos4["meta_value"]?></font></td>
												<?php } ?>
											</tr>

											<tr>
												<?php
              									$sqlDes5 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemDescription_5' ORDER BY meta_id ASC ";
			  									$queryDes5 = mysql_db_query($dbname, $sqlDes5) or die("Can't QueryDes5");
			  									$rowDes5 = mysql_fetch_array($queryDes5);
			  									?>
			  									<?php if ($rowDes5["meta_value"] == "") { ?>
			  									<?php } else if ($rowDes5["meta_value"] != "") { ?>	
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $rowDes5["meta_value"]?> </td>
												<?php } ?>

												<?php
              									$sqlQua5 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'Quantity_5' ORDER BY meta_id ASC ";
			  									$queryQua5 = mysql_db_query($dbname, $sqlQua5) or die("Can't QueryQua5");
			  									$rowQua5 = mysql_fetch_array($queryQua5);
			  									?>
			  									<?php if ($rowQua5["meta_value"] == "") { ?>
			  									<?php } else if ($rowQua5["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowQua5["meta_value"]?> </font></td>
												<?php } ?>

												<?php
              									$sqlCos5 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemCost_5' ORDER BY meta_id ASC ";
			  									$queryCos5 = mysql_db_query($dbname, $sqlCos5) or die("Can't QueryCos5");
			  									$rowCos5 = mysql_fetch_array($queryCos5);
			  									?>
			  									<?php if ($rowCos5["meta_value"] == "") { ?>
			  									<?php } else if ($rowCos5["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowCos5["meta_value"]?></font></td>
												<?php } ?>
											</tr>

											<tr>
												<?php
              									$sqlDes6 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemDescription_6' ORDER BY meta_id ASC ";
			  									$queryDes6 = mysql_db_query($dbname, $sqlDes6) or die("Can't QueryDes6");
			  									$rowDes6 = mysql_fetch_array($queryDes6);
			  									?>
			  									<?php if ($rowDes6["meta_value"] == "") { ?>
			  									<?php } else if ($rowDes6["meta_value"] != "") { ?>	
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $rowDes6["meta_value"]?> </td>
												<?php } ?>

												<?php
              									$sqlQua6 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'Quantity_6' ORDER BY meta_id ASC ";
			  									$queryQua6 = mysql_db_query($dbname, $sqlQua6) or die("Can't QueryQua6");
			  									$rowQua6 = mysql_fetch_array($queryQua6);
			  									?>
			  									<?php if ($rowQua6["meta_value"] == "") { ?>
			  									<?php } else if ($rowQua6["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowQua6["meta_value"]?> </font></td>
												<?php } ?>

												<?php
              									$sqlCos6 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemCost_6' ORDER BY meta_id ASC ";
			  									$queryCos6 = mysql_db_query($dbname, $sqlCos6) or die("Can't QueryCos6");
			  									$rowCos6 = mysql_fetch_array($queryCos6);
			  									?>
			  									<?php if ($rowCos6["meta_value"] == "") { ?>
			  									<?php } else if ($rowCos6["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowCos6["meta_value"]?></font></td>
												<?php } ?>
											</tr>

											<tr>
												<?php
              									$sqlDes7 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemDescription_7' ORDER BY meta_id ASC ";
			  									$queryDes7 = mysql_db_query($dbname, $sqlDes7) or die("Can't QueryDes7");
			  									$rowDes7 = mysql_fetch_array($queryDes7);
			  									?>
			  									<?php if ($rowDes7["meta_value"] == "") { ?>
			  									<?php } else if ($rowDes7["meta_value"] != "") { ?>	
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $rowDes7["meta_value"]?> </td>
												<?php } ?>

												<?php
              									$sqlQua7 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'Quantity_7' ORDER BY meta_id ASC ";
			  									$queryQua7 = mysql_db_query($dbname, $sqlQua7) or die("Can't QueryQua7");
			  									$rowQua7 = mysql_fetch_array($queryQua7);
			  									?>
			  									<?php if ($rowQua7["meta_value"] == "") { ?>
			  									<?php } else if ($rowQua7["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowQua7["meta_value"]?> </font></td>
												<?php } ?>

												<?php
              									$sqlCos7 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemCost_7' ORDER BY meta_id ASC ";
			  									$queryCos7 = mysql_db_query($dbname, $sqlCos7) or die("Can't QueryCos7");
			  									$rowCos7 = mysql_fetch_array($queryCos7);
			  									?>
			  									<?php if ($rowCos7["meta_value"] == "") { ?>
			  									<?php } else if ($rowCos7["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowCos7["meta_value"]?></font></td>
												<?php } ?>
											</tr>

											<tr>
												<?php
              									$sqlDes8 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemDescription_8' ORDER BY meta_id ASC ";
			  									$queryDes8 = mysql_db_query($dbname, $sqlDes8) or die("Can't QueryDes8");
			  									$rowDes8 = mysql_fetch_array($queryDes8);
			  									?>
			  									<?php if ($rowDes8["meta_value"] == "") { ?>
			  									<?php } else if ($rowDes8["meta_value"] != "") { ?>	
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $rowDes8["meta_value"]?> </td>
												<?php } ?>

												<?php
              									$sqlQua8 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'Quantity_8' ORDER BY meta_id ASC ";
			  									$queryQua8 = mysql_db_query($dbname, $sqlQua8) or die("Can't QueryQua8");
			  									$rowQua8 = mysql_fetch_array($queryQua8);
			  									?>
			  									<?php if ($rowQua8["meta_value"] == "") { ?>
			  									<?php } else if ($rowQua8["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowQua8["meta_value"]?> </font></td>
												<?php } ?>

												<?php
              									$sqlCos8 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemCost_8' ORDER BY meta_id ASC ";
			  									$queryCos8 = mysql_db_query($dbname, $sqlCos8) or die("Can't QueryCos8");
			  									$rowCos8 = mysql_fetch_array($queryCos8);
			  									?>
			  									<?php if ($rowCos8["meta_value"] == "") { ?>
			  									<?php } else if ($rowCos8["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowCos8["meta_value"]?></font></td>
												<?php } ?>
											</tr>

											<tr>
												<?php
              									$sqlDes9 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemDescription_9' ORDER BY meta_id ASC ";
			  									$queryDes9 = mysql_db_query($dbname, $sqlDes9) or die("Can't QueryDes9");
			  									$rowDes9 = mysql_fetch_array($queryDes9);
			  									?>
			  									<?php if ($rowDes9["meta_value"] == "") { ?>
			  									<?php } else if ($rowDes9["meta_value"] != "") { ?>	
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $rowDes9["meta_value"]?> </td>
												<?php } ?>

												<?php
              									$sqlQua9 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'Quantity_9' ORDER BY meta_id ASC ";
			  									$queryQua9 = mysql_db_query($dbname, $sqlQua9) or die("Can't QueryQua9");
			  									$rowQua9 = mysql_fetch_array($queryQua9);
			  									?>
			  									<?php if ($rowQua9["meta_value"] == "") { ?>
			  									<?php } else if ($rowQua9["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowQua9["meta_value"]?> </font></td>
												<?php } ?>

												<?php
              									$sqlCos9 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemCost_9' ORDER BY meta_id ASC ";
			  									$queryCos9 = mysql_db_query($dbname, $sqlCos9) or die("Can't QueryCos9");
			  									$rowCos0 = mysql_fetch_array($queryCos9);
			  									?>
			  									<?php if ($rowCos9["meta_value"] == "") { ?>
			  									<?php } else if ($rowCos9["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowCos9["meta_value"]?></font></td>
												<?php } ?>
											</tr>

											<tr>
												<?php
              									$sqlDes10 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemDescription_10' ORDER BY meta_id ASC ";
			  									$queryDes10 = mysql_db_query($dbname, $sqlDes10) or die("Can't QueryDes10");
			  									$rowDes10 = mysql_fetch_array($queryDes10);
			  									?>
			  									<?php if ($rowDes10["meta_value"] == "") { ?>
			  									<?php } else if ($rowDes10["meta_value"] != "") { ?>	
												<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $rowDes10["meta_value"]?> </td>
												<?php } ?>

												<?php
              									$sqlQua10 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'Quantity_10' ORDER BY meta_id ASC ";
			  									$queryQua10 = mysql_db_query($dbname, $sqlQua10) or die("Can't QueryQua10");
			  									$rowQua10 = mysql_fetch_array($queryQua10);
			  									?>
			  									<?php if ($rowQua10["meta_value"] == "") { ?>
			  									<?php } else if ($rowQua10["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowQua10["meta_value"]?> </font></td>
												<?php } ?>

												<?php
              									$sqlCos10 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'ItemCost_10' ORDER BY meta_id ASC ";
			  									$queryCos10 = mysql_db_query($dbname, $sqlCos10) or die("Can't QueryCos10");
			  									$rowCos10 = mysql_fetch_array($queryCos10);
			  									?>
			  									<?php if ($rowCos10["meta_value"] == "") { ?>
			  									<?php } else if ($rowCos10["meta_value"] != "") { ?>
												<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $rowCos10["meta_value"]?></font></td>
												<?php } ?>
											</tr>
											
											<?php

											$sql10 = " SELECT * FROM vananava_wp_vnnv_order_itemmeta WHERE order_item_id = '$itemmeta_order_item_id' AND meta_key LIKE 'TotalPaid' ";
											$query10 = mysql_db_query($dbname, $sql10) or die("Can't Query10");
											$row10 = mysql_fetch_array($query10);

											?>
											<tr>
									    		<th style='color:#000000; border: 0px solid black; width:80%; height:40px;'></th>
												<th style='color:#000000; border: 1px solid black; width:10%; height:40px;' align="center"><font style='color:#000000;'>Total Price</font></th> 
												<th style='color:#000000; border: 1px solid black; width:10%; height:40px;' align="center"><font style='color:#000000;'><?php echo number_format($row10["meta_value"]);?></font></th> 
											</tr>
										</tbody>
									</table>
									<?php } else if ($ctm_ticket != "") { ?>
									<table role="presentation" style='width:100%;'>
										<tbody>
											<tr>
												<th style='color:#000000; border: 1px solid black; width:80%; height:40px;' align="center"><font style='color:#000000;'>Ticket and Extra Items</font></th>
												<th style='color:#000000; border: 1px solid black; width:10%; height:40px;' align="center"><font style='color:#000000;'>QTY</font></th> 
												<th style='color:#000000; border: 1px solid black; width:10%; height:40px;' align="center"><font style='color:#000000;'>Total</font></th>
											</tr>
											<?php
											$json_ctm_ticket = json_decode($ctm_ticket,true);

												foreach($json_ctm_ticket as $key_ctm_ticket => $val_ctm_ticket) {
    
													foreach($val_ctm_ticket as $a_ctm_ticket)
													{
														foreach($a_ctm_ticket as $b_ctm_ticket)
														{
															?>
															<tr>
																<td style='color:#000000; border: 1px solid black; width:80%; height:30px;'><font style='color:#000000;'><?php echo $b_ctm_ticket['ItemDescriptionMail'];?> <br> <?php echo $b_ctm_ticket['ItemDescriptionsubMail'];?></font></td>
																<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo $b_ctm_ticket['QuantityMail'];?></font></td>
																<td style='color:#000000; border: 1px solid black; width:10%; height:30px;' align="center"><font style='color:#000000;'><?php echo number_format($b_ctm_ticket['ItemCostMail']);?></font></td>
															</tr>
															<?php
														}
													}
												}
											?>
											<tr>
									    		<th style='color:#000000; border: 0px solid black; width:80%; height:40px;'></th>
												<th style='color:#000000; border: 1px solid black; width:10%; height:40px;' align="center"><font style='color:#000000;'>Total Price</font></th> 
												<th style='color:#000000; border: 1px solid black; width:10%; height:40px;' align="center"><font style='color:#000000;'><?php echo number_format($val_ctm_ticket['TotalPaid']);?></font></th> 
											</tr>
										</tbody>
									</table>
									<?php } ?>
									<br>
									<?php if ($row3["order_item_log_contact_data"] == "" || $row3["order_item_log_ticket_data"] == "" || $row3["order_item_log_ticket_data_code"] == "") { ?>

									<?php  } else if ($row3["order_item_log_contact_data"] != "" && $row3["order_item_log_ticket_data"] != "" && $row3["order_item_log_ticket_data_code"] != "") { ?>
									<table role="presentation" style='width:100%;'>
										<tbody>
											<tr>
												<th style='color:#000000; border: 1px solid black; width:80%; height:40px;' align="center"><font style='color:#000000;'>จัดการ</font></th>
												<th style='color:#000000; border: 1px solid black; width:10%; height:40px;' align="center"></th> 
											</tr>
											<tr>
												<td style='color:#000000; border: 1px solid black; width:80%; height:40px;' align="center">ส่งข้อมูล ไปที่ Centaman และ Email (สำหรับส่งข้อมูลที่มีการชำระเงินเข้ามาแล้ว แต่ไม่มีเลข Booking ID และ Email ถึงลูกค้า)</td>
												<td style='color:#000000; border: 1px solid black; width:10%; height:40px;' align="center">
													<?php if ($row3["booking_id"] == "") {?>
														<a href="set_centaman_and_email.php?order_id=<?php echo $order_id ?>" class="button button-primary button-large" onclick="return checkcentaman()"> ส่งข้อมูล </a>
													<?php } else if ($row3["booking_id"] != "") {?>
														<a class="button button-primary button-large"> ส่งข้อมูล </a>
													<?php } ?>	
												</td> 
											</tr>
											<tr>
												<td style='color:#000000; border: 1px solid black; width:80%; height:40px;' align="center">ส่งข้อมูล ไปที่ Email อีกครั้ง (สำหรับการส่ง Email อีกครั้ง จำเป็นต้องมี Booking ID ก่อน)</td>
												<td style='color:#000000; border: 1px solid black; width:10%; height:40px;' align="center">
													<?php if ($row3["booking_id"] != "") {?>
														<a href="set_email.php?order_id=<?php echo $order_id ?>" class="button button-primary button-large" onclick="return checkemail()"> ส่งข้อมูล </a>
													<?php } else if ($row3["booking_id"] == "") {?>
														<a class="button button-primary button-large"> ส่งข้อมูล </a>
													<?php } ?>
												</td> 
											</tr>
										</tbody>
									</table>
									<?php } ?>
								</fieldset>
							</div>
						</div>
					</div><!-- /post-body-content -->
				</div><!-- /post-body -->
			</div>
		</div>									
	<?php
}
function vananava_co_promotion_contents() {
	$listTable = new Co_Promotion_List_Table();
	$listTable->prepare_items();
	?>
	<div class="wrap">
		<h2>Vananava Huahin Co Promotion <a href="admin.php?page=vananava_co_promotion_add_new" class="add-new-h2">Add New</a></h2>
		<?php $listTable->display(); ?>
	</div>
	<?php
}
function vananava_co_promotion_add_new() { ?>
	<style type="text/css">
		select#co_promotion_ticket_show{
			width:100%;
			color:#333333;   
			background-color:#FFFFFF;   
			border:1px solid #DDDDDD;   
		}
		select#co_promotion_ticket_show option{
			color:#333333;   
			background-color:#EAEAEA;   
			border:1px solid #DDDDDD;   
		}
		ul.myUL1{   
			margin:-25px;
			margin-left: -180px;
			padding:0px;  
			font-size:14px;   
			width:200px;   
			color:#333333;   
			background-color:#FFFFFF;   
			border:1px solid #DDDDDD;   
			position:absolute;   
			display:none;   
			list-style:none;   
			z-index:100;
		}   
		ul.myUL1 li{   
			margin:0px;   
			padding:0px;   
			cursor:pointer;   
			text-indent:5px; 
			list-style:none;   
		}   
		ul.myUL1 li:hover{   
			margin:0px;   
			padding:0px;   
			cursor:pointer;   
			background-color:#FFFFFF;   
			color:#000000;   
		}
	</style>
	<div class="wrap">
		<h2>Add New Co Promotion</h2>
		<form action="added_co_promotion.php" method="post" enctype="multipart/form-data" name="frmMain">
			<div id="poststuff">
				<input type="hidden" name="confirm" value="1">
				<input type="hidden" name="co_promotion_ticket_not_show" id="co_promotion_ticket_not_show" value="1150,1151,1152,1173,1174,1175">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content" class="edit-form-section edit-comment-section">
						<div id="namediv" class="stuffbox">
							<div class="inside">
								<h2 class="edit-comment-author">Infomation</h2>
								<fieldset>
									<table class="form-table editcomment" role="presentation">
										<tbody>
											<tr>
												<td class="first"><label for="ticket_name">Co Promotion Name</label></td>
												<td>
													<input type="text" id="co_promotion_name" name="co_promotion_name" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="start_date">Start Date</label></td>
												<td><input type="text"class="datepicker" name="co_promotion_ticket_start_date" id="co_promotion_ticket_start_date" readonly="readonly"></td>
											</tr>
											<tr>
												<td class="first"><label for="end_date">End Date</label></td>
												<td>
													<input type="text"class="datepicker" name="co_promotion_ticket_end_date" id="co_promotion_ticket_end_date" readonly="readonly">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_number">Ticket Number Promotion</label></td>
												<td>
													<select name="co_promotion_ticket_show" id="co_promotion_ticket_show">
														<option value="">Select Ticket Number</option>
													</select>
													<?php
													include('connect.php');
													$strSQL2 = " SELECT * FROM vananava_wp_vnnv_ctm_ticketmeta WHERE ctm_ticket_status = 'promotion' AND ctm_server = 'production' AND ctm_is_display = 'Y' ";
													$objQuery2 = mysql_query($strSQL2) or die ("Error Query [".$strSQL2."]");
													?>
													<ul class="myUL1"> 
														<?php while($objResult2 = mysql_fetch_array($objQuery2)) { ?> 
															<li><input type="checkbox" style="width: 10px; left: 0px; top: 0px;"  name="<?=$objResult2["ctm_ticket_ID"]?>" id="<?=$objResult2["ctm_ticket_ID"]?>" value="<?=$objResult2["ctm_ticket_ID"]?>"><?=$objResult2["ctm_ticket_ID"]?> : <?=$objResult2["ctm_ticket_description"]?></li> 
														<?php } ?> 
													</ul>
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_code">Co Promotion Code<br>A-Z (4 characters)</label></td>
												<td>
													<input type="text" style="text-transform: uppercase;" id="co_promotion_code_num" name="co_promotion_code_num" required="required" maxlength="4">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_code">Quantity Code<br>(ไม่ต้องใส่เครื่องหมาย , ในจำนวน)</label></td>
												<td>
													<input type="text" id="co_promotion_code_quantity_num" name="co_promotion_code_quantity_num" required="required">
												</td>
											</tr>
										</tbody>
									</table>
								</fieldset>
							</div>
						</div>
					</div><!-- /post-body-content -->
					<div id="postbox-container-1" class="postbox-container">
						<div id="submitdiv" class="stuffbox">
							<h2>Status</h2>
							<div class="inside">
								<div class="submitbox" id="submitcomment">
									<div id="minor-publishing">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<legend class="screen-reader-text">Comment status</legend>
												<label><input type="radio" checked="checked" id="co_promotion_status" name="co_promotion_status" value="Y">Approved (ใช้งานได้)</label><br>
												<label><input type="radio" id="co_promotion_status" name="co_promotion_status" value="N">Pending (หยุดการใช้งาน)</label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
									</div>
									<div id="major-publishing-actions">
										<div id="publishing-action"><span class="spinner"></span>
											<input type="submit" name="save" id="save" class="button button-primary button-large" value="Add New">
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div><!-- /submitdiv -->
					</div>
				</div><!-- /post-body -->
			</div>
			<script>
				jQuery(function() {
					jQuery( ".datepicker" ).datepicker({
						dateFormat : "yy-mm-dd"
					});
				});
			</script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
			<script type="text/javascript">
				$(function(){
					var obj1="select#co_promotion_ticket_show";
					var obj2="ul.myUL1";
					$(obj1).focus(function(){   
						var nX=$(this).offset().left;   
						var nY=$(this).offset().top+($(this).height()+3);   
						$(this).html("");
						$(obj2).show().css({   
							"width":$(this).width()+"px",
							"left":nX,   
							"top":nY   
						});
					});   
					$(obj2).children("li").click(function(){ 
						var iCheck=($(this).children("input").attr("checked")=="checked")?false:true;  
						$(this).children("input").attr("checked",iCheck);
					});   
					$(obj2).hover(function(){   
						$(this).show();    
					},function(){   
						var setValue="";
						var setText="";
						$(this).find("input").each(function(key){
							if($(this).attr("checked")=="checked"){
								setValue+=$(this).val()+",";
								setText+=$(this).parent("li").text()+",";
							}       
						});
						setText=(setText!="")?setText:"Select Ticket Number";
						$(this).hide();   
						$(obj1).html("<option value=\""+setValue+"\">"+setText+"</option>").blur();   
					});  
				});
			</script>
		</form>
	</div>
	<?php
}
function vananava_co_promotion_edit_new() {

	include('connect.php');

	$co_promotion_id = $_GET["co_promotion_id"];

	if($co_promotion_id == ""){ header("HTTP/1.1 301 Moved Permanently"); header('Location: admin.php?page=vananava_co_promotion_add_new'); exit(); }

	$sql1 =	" SELECT * FROM vananava_wp_vnnv_co_promotion WHERE co_promotion_id = '$co_promotion_id' ";
	$query1 = mysql_db_query($dbname, $sql1) or die("Can't Query1");
	$row1 = mysql_fetch_array($query1);

	$co_promotion_name = $row1["co_promotion_name"];
	$co_promotion_ticket_start_date = $row1["co_promotion_ticket_start_date"];
	$co_promotion_ticket_end_date = $row1["co_promotion_ticket_end_date"];
	$co_promotion_ticket_show = $row1["co_promotion_ticket_show"];

	$sql2 =	" SELECT * FROM vananava_wp_vnnv_co_promotion_code WHERE co_promotion_code_id = '$co_promotion_id' ";
	$query2 = mysql_db_query($dbname, $sql2) or die("Can't Query2");
	$row2 = mysql_fetch_array($query2);

	$co_promotion_code_num = $row2["co_promotion_code_num"];

	?>
	<style type="text/css">
		select#co_promotion_ticket_show{
			width:100%;
			color:#333333;   
			background-color:#FFFFFF;   
			border:1px solid #DDDDDD;   
		}
		select#co_promotion_ticket_show option{
			color:#333333;   
			background-color:#EAEAEA;   
			border:1px solid #DDDDDD;   
		}
		ul.myUL1{   
			margin:-25px;
			margin-left: -180px;   
			padding:0px;  
			font-size:14px;   
			width:200px;   
			color:#333333;   
			background-color:#FFFFFF;   
			border:1px solid #DDDDDD;   
			position:absolute;   
			display:none;   
			list-style:none;   
			z-index:100;
		}   
		ul.myUL1 li{   
			margin:0px;   
			padding:0px;   
			cursor:pointer;   
			text-indent:5px; 
			list-style:none;   
		}   
		ul.myUL1 li:hover{   
			margin:0px;   
			padding:0px;   
			cursor:pointer;   
			background-color:#FFFFFF;   
			color:#000000;   
		}
	</style>
	<div class="wrap">
		<h2>Edit Vananava Huahin Co Promotion</h2>
		<form action="edited_co_promotion.php" method="post" enctype="multipart/form-data" name="frmMain">
			<div id="poststuff">
				<input type="hidden" name="confirm" value="1">
				<input type="hidden" name="co_promotion_ticket_not_show" id="co_promotion_ticket_not_show" value="1150,1151,1152,1173,1174,1175">
				<input type="hidden" name="co_promotion_id" id="co_promotion_id" value="<?=$co_promotion_id?>">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content" class="edit-form-section edit-comment-section">
						<div id="namediv" class="stuffbox">
							<div class="inside">
								<h2 class="edit-comment-author">Infomation</h2>
								<fieldset>
									<table class="form-table editcomment" role="presentation">
										<tbody>
											<tr>
												<td class="first"><label for="ticket_name">Co Promotion Name</label></td>
												<td>
													<input type="text" id="co_promotion_name" name="co_promotion_name" value="<?=$co_promotion_name?>" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="start_date">Start Date</label></td>
												<td><input type="text"class="datepicker" name="co_promotion_ticket_start_date" id="co_promotion_ticket_start_date" value="<?=$co_promotion_ticket_start_date?>"></td>
											</tr>
											<tr>
												<td class="first"><label for="end_date">End Date</label></td>
												<td>
													<input type="text"class="datepicker" name="co_promotion_ticket_end_date" id="co_promotion_ticket_end_date" value="<?=$co_promotion_ticket_end_date?>">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_number">Ticket Number Promotion</label></td>
												<td>
													<select name="co_promotion_ticket_show" id="co_promotion_ticket_show">
														<option value="<?=$co_promotion_ticket_show?>"><?=$co_promotion_ticket_show?></option>
													</select>
													<?php
													include('connect.php');
													$strSQL2 = " SELECT * FROM vananava_wp_vnnv_ctm_ticketmeta WHERE ctm_ticket_status = 'promotion' AND ctm_server = 'production' AND ctm_is_display = 'Y' ";
													$objQuery2 = mysql_query($strSQL2) or die ("Error Query [".$strSQL2."]");
													?>
													<ul class="myUL1"> 
														<?php while($objResult2 = mysql_fetch_array($objQuery2)) { ?>
															<li>
																<??>
																<input type="checkbox" style="width: 10px; left: 0px; top: 0px;"  name="<?=$objResult2["ctm_ticket_ID"]?>" id="<?=$objResult2["ctm_ticket_ID"]?>" value="<?=$objResult2["ctm_ticket_ID"]?>"><?=$objResult2["ctm_ticket_ID"]?> : <?=$objResult2["ctm_ticket_description"]?>


															</li>
														<?php } ?> 
													</ul>
												</td>
											</tr>
										</tbody>
									</table>
								</fieldset>
							</div>
						</div>
					</div><!-- /post-body-content -->
					<div id="postbox-container-1" class="postbox-container">
						<div id="submitdiv" class="stuffbox">
							<h2>Status</h2>
							<div class="inside">
								<div class="submitbox" id="submitcomment">
									<div id="minor-publishing">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<legend class="screen-reader-text">Comment status</legend>
												<label><input type="radio" checked="checked" id="co_promotion_status" name="co_promotion_status" value="Y">Approved (ใช้งานได้)</label><br>
												<label><input type="radio" id="co_promotion_status" name="co_promotion_status" value="N">Pending (หยุดการใช้งาน)</label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
									</div>
									<div id="major-publishing-actions">
										<div id="publishing-action"><span class="spinner"></span>
											<input type="submit" name="save" id="save" class="button button-primary button-large" value="Edit New">
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div><!-- /submitdiv -->
					</div>
				</div><!-- /post-body -->
			</div>

			<script>
				jQuery(function() {
					jQuery( ".datepicker" ).datepicker({
						dateFormat : "yy-mm-dd"
					});
				});
			</script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
			<script type="text/javascript">
				$(function(){
					var obj1="select#co_promotion_ticket_show";
					var obj2="ul.myUL1";
					$(obj1).focus(function(){   
						var nX=$(this).offset().left;   
						var nY=$(this).offset().top+($(this).height()+3);   
						$(this).html("");
						$(obj2).show().css({   
							"width":$(this).width()+"px",
							"left":nX,   
							"top":nY   
						});
					});   
					$(obj2).children("li").click(function(){ 
						var iCheck=($(this).children("input").attr("checked")=="checked")?false:true;  
						$(this).children("input").attr("checked",iCheck);
					});   
					$(obj2).hover(function(){   
						$(this).show();    
					},function(){   
						var setValue="";
						var setText="";
						$(this).find("input").each(function(key){
							if($(this).attr("checked")=="checked"){
								setValue+=$(this).val()+",";
								setText+=$(this).parent("li").text()+",";
							}       
						});
						setText=(setText!="")?setText:"Select Ticket Number";
						$(this).hide();   
						$(obj1).html("<option value=\""+setValue+"\">"+setText+"</option>").blur();   
					});  
				});
			</script> 

		</form>
	</div>  
	<?php
}
function vananava_co_promotion_view_new() {

	include('connect.php');

	$co_promotion_id = $_GET["co_promotion_id"];

	if($co_promotion_id == ""){ header("HTTP/1.1 301 Moved Permanently"); header('Location: admin.php?page=vananava_co_promotion_add_new'); exit(); }

	$sql1 =	" SELECT * FROM vananava_wp_vnnv_co_promotion WHERE co_promotion_id = '$co_promotion_id' ";
	$query1 = mysql_db_query($dbname, $sql1) or die("Can't Query1");
	$row1 = mysql_fetch_array($query1);

	$co_promotion_name = $row1["co_promotion_name"];

	?>

	<div class="wrap">
		<h2>View Vananava Huahin Co Promotion (<?php echo $co_promotion_name;?>)</h2>
	</div>
	<br>
	<?php
	$co_promotion_id = $_GET["co_promotion_id"];

	$sql2 = " SELECT COUNT(order_item_id) FROM vananava_wp_vnnv_order_items WHERE order_items_promotion_id = '$co_promotion_id' ";
	$query2 = mysql_db_query($dbname, $sql2) or die($sql2);
	$row2 = mysql_fetch_array($query2);

	$count_order_item_id = $row2[0];
	?>
	<?php if ($count_order_item_id == "0") { ?>
		<div align="center"> <br><br> ไม่มีข้อมูลการใช้ Code Co Promotion นี้ </div>
	<?php } else if ($count_order_item_id != "0") { ?>
		<div>
			<form action="report_co_promotion_order.php" method="post" enctype="multipart/form-data" name="frmMain">
				<input type="hidden" name="co_promotion_id" id="co_promotion_id" value="<?php echo $co_promotion_id;?>" required="required">
				<input type="hidden" name="co_promotion_name" id="co_promotion_name" value="<?php echo $co_promotion_name;?>" required="required">
				<input type="submit" name="save" id="save" class="button button-primary button-large" value="Report Co-Promotion Order">
			</form>
		</div>
		<br>
		<table width="100%" align="left">
			<tr>
				<th align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; width: 10%; height: 30px;"> Order ID </th>
				<th align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; width: 10%; height: 30px;"> Booking ID </th>
				<th align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; width: 16%; height: 30px;"> Name </th>
				<th align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; width: 16%; height: 30px;"> Status </th>
				<th align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; width: 16%; height: 30px;"> Promotion Code </th>
				<th align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; width: 16%; height: 30px;"> Promotion Name </th>
				<th align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; width: 16%; height: 30px;"> Total </th>
			</tr>
			<?php
			$strSQL = " SELECT * FROM vananava_wp_vnnv_order_items WHERE order_items_promotion_id = '$co_promotion_id' AND order_items_total_cost != '' ORDER BY order_item_id ASC ";
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
			?>
			<?php while($objResult = mysql_fetch_array($objQuery)) { ?>
				<tr>
					<td align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; height: 30px;"><?php echo $objResult["order_id"]?></td>
					<td align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; height: 30px;"><?php echo $objResult["booking_id"]?></td>
					<td align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; height: 30px;"><?php echo $objResult["order_item_name"]?></td>
					<td align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; height: 30px;"><?php echo $objResult["order_item_status"]?></td>
					<td align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; height: 30px;"><?php echo $objResult["order_items_promotion"]?></td>
					<td align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; height: 30px;"><?php echo $objResult["order_items_promotion_name"]?></td>
					<td align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; height: 30px;"><?php echo $objResult["order_items_total_cost"]?></td>
				</tr>
			<?php } ?>
		</table>

	<?php } ?>
	<div><br><br><br><br>
		<form action="report_co_promotion_code.php" method="post" enctype="multipart/form-data" name="frmMain">
			<input type="hidden" name="co_promotion_id" id="co_promotion_id" value="<?php echo $co_promotion_id;?>" required="required">
			<input type="submit" name="save" id="save" class="button button-primary button-large" value="Report Co-Promotion Code">
		</form>
	</div>
	<br>
	<table width="100%" align="left">
		<tr>
			<th align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; width: 10%; height: 30px;"> Code </th>
			<th align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; width: 10%; height: 30px;"> Status </th>
		</tr>
		<?php
		$strSQL = " SELECT * FROM vananava_wp_vnnv_co_promotion_code WHERE co_promotion_id = '$co_promotion_id' ";
		$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
		$Num_Rows = mysql_num_rows($objQuery);
		$Per_Page = 100;
		$Page = $_GET["Page"];
		if(!$_GET["Page"])
		{
			$Page=1;
		}
		$Prev_Page = $Page-1;
		$Next_Page = $Page+1;

		$Page_Start = (($Per_Page*$Page)-$Per_Page);
		if($Num_Rows<=$Per_Page)
		{
			$Num_Pages =1;
		}
		else if(($Num_Rows % $Per_Page)==0)
		{
			$Num_Pages =($Num_Rows/$Per_Page) ;
		}
		else
		{
			$Num_Pages =($Num_Rows/$Per_Page)+1;
			$Num_Pages = (int)$Num_Pages;
		}
		$strSQL .=" ORDER BY ABS(co_promotion_code_id) ASC LIMIT $Page_Start , $Per_Page";
		$objQuery  = mysql_query($strSQL);
		?>
		<?php while($objResult = mysql_fetch_array($objQuery)) { ?>
			<tr>
				<td align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; height: 30px;">
					<?php echo $objResult["co_promotion_code_num"]?>
				</td>
				<td align="left" style="background-color:#FFFFFF; border: 1px solid #CCC; height: 30px;">
					<?php
					if ($objResult["co_promotion_code_status"] == "Y") { ?>
						ใช้งานได้
					<?php } else if ($objResult["co_promotion_code_status"] == "N") { ?>
						ใช้งานไปแล้ว
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</table>
	<br><br><br><br><br><br><br><br><br>
	<div align="left">
		<?php if($Prev_Page) { echo " <a href='admin.php?page=vananava_co_promotion_view_new&co_promotion_id=$co_promotion_id&Page=$Prev_Page'> < Previous </a> "; } ?>
		<?php
		for($i=1; $i<=$Num_Pages; $i++){
			$Page1 = $Page-2;
			$Page2 = $Page+2;
			if($i != $Page1 && $i >= $Page1 && $i <= $Page2)
			{
				echo "[ <a href='admin.php?page=vananava_co_promotion_view_new&co_promotion_id=$co_promotion_id&Page=$i'>$i</a> ]";
			}
			elseif($i==$Page1)
			{
				echo "<b> $i </b>";
			}
		}
		?>
		<?php if($Page1!=$Num_Pages1) { echo " <admin.php?page=vananava_co_promotion_view_new&co_promotion_id=$co_promotion_id&Page=$Next_Page'> Next > </a> "; } ?>
	</div>	
	<?php


}
function vananava_co_promotion_addmore_new() {

	include('connect.php');

	$co_promotion_id = $_GET["co_promotion_id"];

	if($co_promotion_id == ""){ header("HTTP/1.1 301 Moved Permanently"); header('Location: admin.php?page=vananava_co_promotion_add_new'); exit(); }

	$sql1 =	" SELECT * FROM vananava_wp_vnnv_co_promotion WHERE co_promotion_id = '$co_promotion_id' ";
	$query1 = mysql_db_query($dbname, $sql1) or die("Can't Query1");
	$row1 = mysql_fetch_array($query1);

	$co_promotion_name = $row1["co_promotion_name"];
	$co_promotion_ticket_start_date = $row1["co_promotion_ticket_start_date"];
	$co_promotion_ticket_end_date = $row1["co_promotion_ticket_end_date"];
	$co_promotion_ticket_show = $row1["co_promotion_ticket_show"];

	$sql2 =	" SELECT * FROM vananava_wp_vnnv_co_promotion_code WHERE co_promotion_code_id = '$co_promotion_id' ";
	$query2 = mysql_db_query($dbname, $sql2) or die("Can't Query2");
	$row2 = mysql_fetch_array($query2);

	$co_promotion_code_num = $row2["co_promotion_code_num"];

	$sql3 =	" SELECT MAX(co_promotion_code_num) FROM vananava_wp_vnnv_co_promotion_code WHERE co_promotion_id = '$co_promotion_id' ";
	$query3 = mysql_db_query($dbname, $sql3) or die("Can't Query3");
	$row3 = mysql_fetch_array($query3);

	$co_promotion_code_num = substr($row3[0],0,-4);

	?>

	<style type="text/css">
		select#co_promotion_ticket_show{
			width:100%;
			color:#333333;   
			background-color:#FFFFFF;   
			border:1px solid #DDDDDD;   
		}
		select#co_promotion_ticket_show option{
			color:#333333;   
			background-color:#EAEAEA;   
			border:1px solid #DDDDDD;   
		}
		ul.myUL1{   
			margin:-25px;
			margin-left: -180px;   
			padding:0px;  
			font-size:14px;   
			width:200px;   
			color:#333333;   
			background-color:#FFFFFF;   
			border:1px solid #DDDDDD;   
			position:absolute;   
			display:none;   
			list-style:none;   
			z-index:100;
		}   
		ul.myUL1 li{   
			margin:0px;   
			padding:0px;   
			cursor:pointer;   
			text-indent:5px; 
			list-style:none;   
		}   
		ul.myUL1 li:hover{   
			margin:0px;   
			padding:0px;   
			cursor:pointer;   
			background-color:#FFFFFF;   
			color:#000000;   
		}
	</style>
	<div class="wrap">
		<h2>Add More Code New Co Promotion</h2>
		<form action="edited_addmore_co_promotion.php" method="post" enctype="multipart/form-data" name="frmMain">
			<div id="poststuff">
				<input type="hidden" name="confirm" value="1">
				<input type="hidden" name="co_promotion_ticket_not_show" id="co_promotion_ticket_not_show" value="1150,1151,1152,1173,1174,1175">
				<input type="hidden" id="co_promotion_id" name="co_promotion_id" value="<?=$co_promotion_id?>" readonly="readonly">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content" class="edit-form-section edit-comment-section">
						<div id="namediv" class="stuffbox">
							<div class="inside">
								<h2 class="edit-comment-author">Infomation</h2>
								<fieldset>
									<table class="form-table editcomment" role="presentation">
										<tbody>
											<tr>
												<td class="first"><label for="ticket_name">Co Promotion Name</label></td>
												<td>
													<input type="text" id="co_promotion_name" name="co_promotion_name" value="<?=$co_promotion_name?>" readonly="readonly">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="start_date">Start Date</label></td>
												<td><input type="text"class="datepicker" name="co_promotion_ticket_start_date" id="co_promotion_ticket_start_date" value="<?=$co_promotion_ticket_start_date?>" readonly="readonly"></td>
											</tr>
											<tr>
												<td class="first"><label for="end_date">End Date</label></td>
												<td>
													<input type="text"class="datepicker" name="co_promotion_ticket_end_date" id="co_promotion_ticket_end_date" value="<?=$co_promotion_ticket_end_date?>" readonly="readonly">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_code">Co Promotion Code<br>A-Z (4 characters)</label></td>
												<td>
													<input type="text" style="text-transform: uppercase;" id="co_promotion_code_num" name="co_promotion_code_num" value="<?=$co_promotion_code_num?>" readonly="readonly" maxlength="4" readonly="readonly">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_code">Quantity Code<br>(ไม่ต้องใส่เครื่องหมาย , ในจำนวน)</label></td>
												<td>
													<input type="text" id="co_promotion_code_quantity_num" name="co_promotion_code_quantity_num" required="required">
												</td>
											</tr>
										</tbody>
									</table>
								</fieldset>
							</div>
						</div>
					</div><!-- /post-body-content -->
					<div id="postbox-container-1" class="postbox-container">
						<div id="submitdiv" class="stuffbox">
							<h2>Status</h2>
							<div class="inside">
								<div class="submitbox" id="submitcomment">
									<div id="minor-publishing">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<legend class="screen-reader-text">Comment status</legend>
												<label><input type="radio" checked="checked" id="co_promotion_status" name="co_promotion_status" value="Y">Approved (ใช้งานได้)</label><br>
												<label><input type="radio" id="co_promotion_status" name="co_promotion_status" value="N">Pending (หยุดการใช้งาน)</label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
									</div>
									<div id="major-publishing-actions">
										<div id="publishing-action"><span class="spinner"></span>
											<input type="submit" name="save" id="save" class="button button-primary button-large" value="Add New">
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div><!-- /submitdiv -->
					</div>
				</div><!-- /post-body -->
			</div>
			<script>
				jQuery(function() {
					jQuery( ".datepicker" ).datepicker({
						dateFormat : "yy-mm-dd"
					});
				});
			</script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
			<script type="text/javascript">
				$(function(){
					var obj1="select#co_promotion_ticket_show";
					var obj2="ul.myUL1";
					$(obj1).focus(function(){   
						var nX=$(this).offset().left;   
						var nY=$(this).offset().top+($(this).height()+3);   
						$(this).html("");
						$(obj2).show().css({   
							"width":$(this).width()+"px",
							"left":nX,   
							"top":nY   
						});
					});   
					$(obj2).children("li").click(function(){ 
						var iCheck=($(this).children("input").attr("checked")=="checked")?false:true;  
						$(this).children("input").attr("checked",iCheck);
					});   
					$(obj2).hover(function(){   
						$(this).show();    
					},function(){   
						var setValue="";
						var setText="";
						$(this).find("input").each(function(key){
							if($(this).attr("checked")=="checked"){
								setValue+=$(this).val()+",";
								setText+=$(this).parent("li").text()+",";
							}       
						});
						setText=(setText!="")?setText:"Select Ticket Number";
						$(this).hide();   
						$(obj1).html("<option value=\""+setValue+"\">"+setText+"</option>").blur();   
					});  
				});
			</script>
		</form>
	</div>

	<?php

}
function vananava_ticket_item_add() { ?>
	<style type="text/css">
		select#ctm_ticket_extra_item{
			width:100%;
			color:#333333;   
			background-color:#FFFFFF;   
			border:1px solid #DDDDDD;   
		}
		select#ctm_ticket_extra_item option{
			color:#333333;   
			background-color:#EAEAEA;   
			border:1px solid #DDDDDD;   
		}
		ul.myUL1{   
			margin:-25px;
			margin-left: -180px;
			padding:0px;  
			font-size:14px;   
			width:200px;   
			color:#333333;   
			background-color:#FFFFFF;   
			border:1px solid #DDDDDD;   
			position:absolute;   
			display:none;   
			list-style:none;   
			z-index:100;
		}   
		ul.myUL1 li{   
			margin:0px;   
			padding:0px;   
			cursor:pointer;   
			text-indent:5px; 
			list-style:none;   
		}   
		ul.myUL1 li:hover{   
			margin:0px;   
			padding:0px;   
			cursor:pointer;   
			background-color:#FFFFFF;   
			color:#000000;   
		}
	</style>
	<div class="wrap">
		<h2>Add New Ticket Item</h2>
		<form action="ticket_item_add.php" method="post" enctype="multipart/form-data" name="frmMain">
			<div id="poststuff">
				<input type="hidden" name="confirm" value="1">
				<input type="hidden" name="ctm_ticket_booking_fee" id="ctm_ticket_booking_fee" value="0">
				<input type="hidden" name="ctm_ticket_fee_item_ID" id="ctm_ticket_fee_item_ID" value="0">
				<input type="hidden" name="ctm_deposit_percentage" id="ctm_deposit_percentage" value="0">
				<input type="hidden" name="ctm_is_tax_inclusive" id="ctm_is_tax_inclusive" value="1">
				<input type="hidden" name="ctm_tax_percentage" id="ctm_tax_percentage" value="7">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content" class="edit-form-section edit-comment-section">
						<div id="namediv" class="stuffbox">
							<div class="inside">
								<h2 class="edit-comment-author">Information</h2>
								<fieldset>
									<table class="form-table editcomment" role="presentation">
										<tbody>
											<tr>
												<td class="first"><label for="ticket_name">Ticket ID</label></td>
												<td>
													<input type="text" id="ctm_ticket_ID" name="ctm_ticket_ID" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Centaman Description</label></td>
												<td>
													<input type="text" id="ctm_ticket_description" name="ctm_ticket_description" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Price</label></td>
												<td>
													<input type="text" id="ctm_ticket_price" name="ctm_ticket_price" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Color</label></td>
												<td>
													<select id="ctm_ticket_color" name="ctm_ticket_color" required="required">
  														<option value="black">black</option>
  														<option value="green">green</option>
  														<option value="blue">blue</option>
  														<option value="pink">pink</option>
													</select>
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Name (EN)</label></td>
												<td>
													<input type="text" id="ctm_ticket_name_en" name="ctm_ticket_name_en" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Name (TH)</label></td>
												<td>
													<input type="text" id="ctm_ticket_name_th" name="ctm_ticket_name_th" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Description (EN)</label></td>
												<td>
													<input type="text" id="ctm_ticket_sub_description_en" name="ctm_ticket_sub_description_en">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Description (TH)</label></td>
												<td>
													<input type="text" id="ctm_ticket_sub_description_th" name="ctm_ticket_sub_description_th">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_number">Ticket Extra Item</label></td>
												<td>
													<select name="ctm_ticket_extra_item" id="ctm_ticket_extra_item">
														
													</select>
													<ul class="myUL1">
													<?php
													include('connect.php');
													$strSQL2 = " SELECT * FROM vananava_wp_vnnv_ctm_extrameta WHERE ctm_server = 'production' AND ctm_is_active = 'N' ";
													$objQuery2 = mysql_query($strSQL2) or die ("Error Query [".$strSQL2."]");
													?>
													<?php while($objResult2 = mysql_fetch_array($objQuery2)) { ?> 
														<li><input type="checkbox" style="width: 10px; left: 0px; top: 0px;"  name="<?=$objResult2["ctm_extra_ID"]?>" id="<?=$objResult2["ctm_extra_ID"]?>" value="<?=$objResult2["ctm_extra_ID"]?>"><?=$objResult2["ctm_extra_ID"]?> : <?=$objResult2["ctm_extra_description"]?></li> 
													<?php } ?> 
													<?php
													include('connect.php');
													$strSQL3 = " SELECT * FROM vananava_wp_vnnv_ctm_ticketmeta WHERE ctm_server = 'production' AND ctm_is_display = 'N' AND ctm_ticket_status = 'none' ";
													$objQuery3 = mysql_query($strSQL3) or die ("Error Query [".$strSQL3."]");
													?>
													<?php while($objResult3 = mysql_fetch_array($objQuery3)) { ?> 
														<li><input type="checkbox" style="width: 10px; left: 0px; top: 0px;"  name="<?=$objResult3["ctm_ticket_ID"]?>" id="<?=$objResult3["ctm_ticket_ID"]?>" value="<?=$objResult3["ctm_ticket_ID"]?>"><?=$objResult3["ctm_ticket_ID"]?> : <?=$objResult3["ctm_ticket_description"]?></li> 
													<?php } ?> 
													</ul>
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Status</label></td>
												<td>
													<select id="ctm_ticket_status" name="ctm_ticket_status" required="required">
  														<option value="none">none</option>
  														<option value="standard">standard</option>
  														<option value="advance">advance</option>
  														<option value="promotion">promotion</option>
													</select>
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Group</label></td>
												<td>
													<select id="ctm_ticket_group" name="ctm_ticket_group" required="required">
  														<option value="Special Ticket">Special Ticket</option>
  														<option value="Pass Ticket">Pass Ticket</option>
  														<option value="Family Package">Family Package</option>
  														<option value="All-In Day Pass Lunch Buffet">All-In Day Pass Lunch Buffet</option>
  														<option value="All-In Day Pass Dinner Seafood Buffet">All-In Day Pass Dinner Seafood Buffet</option>
  														<option value="All-In Day Pass Lunch Buffet + Dinner Seafood Buffet">All-In Day Pass Lunch Buffet + Dinner Seafood Buffet</option>
  														<option value="Other Promotion">Other Promotion</option>
													</select>
												</td>
											</tr>
										</tbody>
									</table>
								</fieldset>
							</div>
						</div>
					</div><!-- /post-body-content -->
					<div id="postbox-container-1" class="postbox-container">
						<div id="submitdiv" class="stuffbox">
							<div class="inside">
								<div class="submitbox" id="submitcomment">
									<div id="minor-publishing">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Server Status</label>
												<br><br>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="production" checked="checked">production</label><br>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="test_web">test_web</label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Display On Website</label>
												<br><br>
												<label><input type="radio" id="ctm_server" name="ctm_is_display" value="Y" checked="checked">Y</label><br>
												<label><input type="radio" id="ctm_server" name="ctm_is_display" value="N">N</label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<script type="text/javascript">
					  					function display_time_one() { document.getElementById('ticket_display_time').style.display = 'none'; }
					  					function display_time_two() { document.getElementById('ticket_display_time').style.display = 'block'; }
                      					</script>
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Ticket Display Date</label>
												<br><br>
												<label><input type="radio" id="ctm_ticket_status_show" name="ctm_ticket_status_show" value="no_time_limit" checked="checked" onclick="display_time_one();">no_time_limit</label><br>
												<label><input type="radio" id="ctm_ticket_status_show" name="ctm_ticket_status_show" value="limited_time" onclick="display_time_two();">limited_time</label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<div id="ticket_display_time" style="display:none;">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Display Time</label>
												<br><br>
												<label for="ticket_name">Start Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_start_date" id="ctm_ticket_start_date" readonly="readonly"></label>
												<br>
												<label for="ticket_name">End Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_end_date" id="ctm_ticket_end_date" readonly="readonly"></label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										</div>
										<script type="text/javascript">
					  					function display_time_use_one() { document.getElementById('ticket_display_time_use').style.display = 'none'; }
					  					function display_time_use_two() { document.getElementById('ticket_display_time_use').style.display = 'block'; }
                      					</script>
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Ticket Use Date</label>
												<br><br>
												<label><input type="radio" id="ctm_ticket_status_show_use" name="ctm_ticket_status_show_use" value="no_time_limit" checked="checked" onclick="display_time_use_one();">no_time_limit</label><br>
												<label><input type="radio" id="ctm_ticket_status_show_use" name="ctm_ticket_status_show_use" value="limited_time" onclick="display_time_use_two();">limited_time</label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<div id="ticket_display_time_use" style="display:none;">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Use Time</label>
												<br><br>
												<label for="ticket_name">Start Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_start_date_use" id="ctm_ticket_start_date_use" readonly="readonly"></label>
												<br>
												<label for="ticket_name">End Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_end_date_use" id="ctm_ticket_end_date_use" readonly="readonly"></label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
									    </div>
									</div>
									<div id="major-publishing-actions">
										<div id="publishing-action"><span class="spinner"></span>
											<input type="submit" name="save" id="save" class="button button-primary button-large" value="Add New">
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div><!-- /submitdiv -->
					</div>
				</div><!-- /post-body -->
			</div>
			<script>
				jQuery(function() {
					jQuery( ".datepicker" ).datepicker({
						dateFormat : "yy-mm-dd"
					});
				});
			</script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
			<script type="text/javascript">
				$(function(){
					var obj1="select#ctm_ticket_extra_item";
					var obj2="ul.myUL1";
					$(obj1).focus(function(){   
						var nX=$(this).offset().left;   
						var nY=$(this).offset().top+($(this).height()+3);   
						$(this).html("");
						$(obj2).show().css({   
							"width":$(this).width()+"px",
							"left":nX,   
							"top":nY   
						});
					});   
					$(obj2).children("li").click(function(){ 
						var iCheck=($(this).children("input").attr("checked")=="checked")?false:true;  
						$(this).children("input").attr("checked",iCheck);
					});   
					$(obj2).hover(function(){   
						$(this).show();    
					},function(){   
						var setValue="";
						var setText="";
						$(this).find("input").each(function(key){
							if($(this).attr("checked")=="checked"){
								setValue+=$(this).val()+",";
								setText+=$(this).parent("li").text()+",";
							}       
						});
						setText=(setText!="")?setText:"Ticket Extra Item";
						$(this).hide();   
						$(obj1).html("<option value=\""+setValue+"\">"+setText+"</option>").blur();   
					});  
				});
			</script>
		</form>	
	</div>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<div style="font-size: 14px;"><strong> คำอธิบายการใช้งาน </strong></div><br>
	<div style="font-size: 14px;"> - Ticket ID	: ID ที่ได้รับมาจาก Centaman </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Centaman Description : คำอิบายที่ได้รับมาจาก Centaman ตัวอย่าง ONR CH Ticket 0800 </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Price : ราคา Ticket </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Color : สีที่ใช้แสดง Ticket ในระบบมีสีทั้งหมดดังนี้ black, green, blue, pink </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Name (EN) : ชื่อที่ใช้แสดง ภาษาอังกฤษ </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Name (TH) : ชื่อที่ใช้แสดง ภาษาไทย </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Description (EN) : รายละเอียด Ticket ที่ใช้แสดง ภาษาอังกฤษ	</div>
	<br>
	<div style="font-size: 14px;"> - Ticket Description (TH) : รายละเอียด Ticket ที่ใช้แสดง ภาษาไทย </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Extra Item : เลือก Extra ที่ต้องการ ด้วยการ check ตรง Extra ที่ต้องการ	</div>
	<br>
	<div style="font-size: 14px;"> - Ticket Status : สถานะต่างๆ ของ Ticket ในระบบมี Status ทั้งหมดดังนี้	</div>
	<div style="font-size: 14px;"> --> None คือ Ticket ที่ นอกเหนือจาก 3 ข้อด้านล่าง </div>
	<div style="font-size: 14px;"> --> Standard คือ Ticket พื้นฐานของทางเว็บไซต์ พวก บัตรผู้ใหญ่ หรือ บัตรเด็ก </div>
	<div style="font-size: 14px;"> --> Advance คือ Ticket ที่จะแสดงในหน้า Booking เมื่อลูกค้าจองเข้ามาเกิน 15 วัน </div>
	<div style="font-size: 14px;"> --> Promotion คือ Ticket ที่จะเอาไว้เลือก Ticket ในส่วนของ co promotion </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Group : กลุ่มที่จะไปจัดวาง Ticket นั้น...นั้น ในระบบมี Group ทั้งหมดดังนี้ </div>
	<div style="font-size: 14px;"> --> Special Ticket : จะแสดงบนสุด พร้อมมี ป้าย HOTDEAL กำกับหน้า Ticket </div>
	<div style="font-size: 14px;"> --> Pass Ticket </div>
	<div style="font-size: 14px;"> --> Family Package </div>
	<div style="font-size: 14px;"> --> All-In Day Pass Lunch Buffet </div>
	<div style="font-size: 14px;"> --> All-In Day Pass Dinner Seafood Buffet </div>
	<div style="font-size: 14px;"> --> All-In Day Pass Lunch Buffet + Dinner Seafood Buffet </div>
	<div style="font-size: 14px;"> --> Other Promotion : จะแสดงล่างสุด</div>
	<br>
	<div style="font-size: 14px;"> - Server Status : สถานะต่างๆ ของ Server ในระบบมี Status ทั้งหมดดังนี้</div>
	<div style="font-size: 14px;"> --> production คือ Ticket ที่จะขึ้นแสดงในระบบ จริงมีการเชื่อมโยงกับ Centaman </div>
	<div style="font-size: 14px;"> --> test_web คือ Ticket ที่จะขึ้นแสดงในระบบทดสอบ ไม่มีการเชื่อมโยงกับ Centaman </div>
	<br>
	<div style="font-size: 14px;"> - Display On Website : เปิด-ปิด การแสดงบนหน้าเว็บ </div>
	<div style="font-size: 14px;"> --> Y คือ แสดง Ticket </div>
	<div style="font-size: 14px;"> --> N คือ ไม่แสดง Ticket </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Display Date : วันที่ในการกำหมดในการแสดงบนหน้าเว็บไซต์</div>
	<div style="font-size: 14px;"> --> no_time_limit คือ แสดงตลอด </div>
	<div style="font-size: 14px;"> --> limited_time คือ สามารถกำลังวันที่เริ่มและสิ้นสุดการแสดง Ticket ได้ </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Use Date : วันที่ในการกำหมดในการใช้จองบนหน้าเว็บไซต์ได้</div>
	<div style="font-size: 14px;"> --> no_time_limit คือ แสดงตลอด </div>
	<div style="font-size: 14px;"> --> limited_time คือ สามารถกำลังวันที่เริ่มและสิ้นสุดการใช้ Ticket ได้ </div>
	<?php
}
function vananava_ticket_item_edit() { 

	include('connect.php');

	$ctm_ticket_ID = $_GET["ctm_ticket_ID"];

	if($ctm_ticket_ID == ""){ header("HTTP/1.1 301 Moved Permanently"); header('Location: admin.php?page=vananava_ticket_item_add'); exit(); }

	$sql1 =	" SELECT * FROM vananava_wp_vnnv_ctm_ticketmeta WHERE ctm_ticket_ID = '$ctm_ticket_ID' ";
	$query1 = mysql_db_query($dbname, $sql1) or die("Can't Query1");
	$row1 = mysql_fetch_array($query1);

	?>
	<style type="text/css">
		select#ctm_ticket_extra_item{
			width:100%;
			color:#333333;   
			background-color:#FFFFFF;   
			border:1px solid #DDDDDD;   
		}
		select#ctm_ticket_extra_item option{
			color:#333333;   
			background-color:#EAEAEA;   
			border:1px solid #DDDDDD;   
		}
		ul.myUL1{   
			margin:-25px;
			margin-left: -180px;
			padding:0px;  
			font-size:14px;   
			width:200px;   
			color:#333333;   
			background-color:#FFFFFF;   
			border:1px solid #DDDDDD;   
			position:absolute;   
			display:none;   
			list-style:none;   
			z-index:100;
		}   
		ul.myUL1 li{   
			margin:0px;   
			padding:0px;   
			cursor:pointer;   
			text-indent:5px; 
			list-style:none;   
		}   
		ul.myUL1 li:hover{   
			margin:0px;   
			padding:0px;   
			cursor:pointer;   
			background-color:#FFFFFF;   
			color:#000000;   
		}
	</style>
	<div class="wrap">
		<h2>Edit Ticket Item</h2>
		<form action="ticket_item_edit.php" method="post" enctype="multipart/form-data" name="frmMain">
			<div id="poststuff">
				<input type="hidden" name="confirm" value="1">
				<input type="hidden" name="ctm_ticket_booking_fee" id="ctm_ticket_booking_fee" value="0">
				<input type="hidden" name="ctm_ticket_fee_item_ID" id="ctm_ticket_fee_item_ID" value="0">
				<input type="hidden" name="ctm_deposit_percentage" id="ctm_deposit_percentage" value="0">
				<input type="hidden" name="ctm_is_tax_inclusive" id="ctm_is_tax_inclusive" value="1">
				<input type="hidden" name="ctm_tax_percentage" id="ctm_tax_percentage" value="7">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content" class="edit-form-section edit-comment-section">
						<div id="namediv" class="stuffbox">
							<div class="inside">
								<h2 class="edit-comment-author">Information</h2>
								<fieldset>
									<table class="form-table editcomment" role="presentation">
										<tbody>
											<tr>
												<td class="first"><label for="ticket_name">Ticket ID</label></td>
												<td>
													<input type="text" id="ctm_ticket_ID" name="ctm_ticket_ID" value="<?=$row1['ctm_ticket_ID'];?>" readonly="readonly">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Centaman Description</label></td>
												<td>
													<input type="text" id="ctm_ticket_description" name="ctm_ticket_description" value="<?=$row1['ctm_ticket_description'];?>" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Price</label></td>
												<td>
													<input type="text" id="ctm_ticket_price" name="ctm_ticket_price" value="<?=$row1['ctm_ticket_price'];?>" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Color</label></td>
												<td>
													<select id="ctm_ticket_color" name="ctm_ticket_color" required="required">
														<option value="<?=$row1['ctm_ticket_color'];?>"><?=$row1['ctm_ticket_color'];?></option>
  														<option value="black">black</option>
  														<option value="green">green</option>
  														<option value="blue">blue</option>
  														<option value="pink">pink</option>
													</select>
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Name (EN)</label></td>
												<td>
													<input type="text" id="ctm_ticket_name_en" name="ctm_ticket_name_en" value="<?=$row1['ctm_ticket_name_en'];?>" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Name (TH)</label></td>
												<td>
													<input type="text" id="ctm_ticket_name_th" name="ctm_ticket_name_th" value="<?=$row1['ctm_ticket_name_th'];?>" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Description (EN)</label></td>
												<td>
													<input type="text" id="ctm_ticket_sub_description_en" name="ctm_ticket_sub_description_en" value="<?=$row1['ctm_ticket_sub_description_en'];?>">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Description (TH)</label></td>
												<td>
													<input type="text" id="ctm_ticket_sub_description_th" name="ctm_ticket_sub_description_th" value="<?=$row1['ctm_ticket_sub_description_th'];?>">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_number">Ticket Extra Item</label></td>
												<td>
													<select name="ctm_ticket_extra_item" id="ctm_ticket_extra_item">
														<option>Extra Item</option>
													</select>
													<ul class="myUL1"> 
													<?php
													include('connect.php');
													$strSQL2 = " SELECT * FROM vananava_wp_vnnv_ctm_extrameta WHERE ctm_server = 'production' AND ctm_is_active = 'N' ";
													$objQuery2 = mysql_query($strSQL2) or die ("Error Query [".$strSQL2."]");
													?>
													<?php while($objResult2 = mysql_fetch_array($objQuery2)) { ?> 
														<li><input type="checkbox" style="width: 10px; left: 0px; top: 0px;"  name="<?=$objResult2["ctm_extra_ID"]?>" id="<?=$objResult2["ctm_extra_ID"]?>" value="<?=$objResult2["ctm_extra_ID"]?>"><?=$objResult2["ctm_extra_ID"]?> : <?=$objResult2["ctm_extra_description"]?></li> 
													<?php } ?> 
													<?php
													include('connect.php');
													$strSQL3 = " SELECT * FROM vananava_wp_vnnv_ctm_ticketmeta WHERE ctm_server = 'production' AND ctm_is_display = 'N' AND ctm_ticket_status = 'none' ";
													$objQuery3 = mysql_query($strSQL3) or die ("Error Query [".$strSQL3."]");
													?>
													<?php while($objResult3 = mysql_fetch_array($objQuery3)) { ?> 
														<li><input type="checkbox" style="width: 10px; left: 0px; top: 0px;"  name="<?=$objResult3["ctm_ticket_ID"]?>" id="<?=$objResult3["ctm_ticket_ID"]?>" value="<?=$objResult3["ctm_ticket_ID"]?>"><?=$objResult3["ctm_ticket_ID"]?> : <?=$objResult3["ctm_ticket_description"]?></li> 
													<?php } ?>
													</ul>
													<br>
													<label for="ticket_name">Extra Item Number : <?=$row1['ctm_ticket_extra_item'];?></label>
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Status</label></td>
												<td>
													<select id="ctm_ticket_status" name="ctm_ticket_status" required="required">
														<option value="<?=$row1['ctm_ticket_status'];?>"><?=$row1['ctm_ticket_status'];?></option>
  														<option value="none">none</option>
  														<option value="standard">standard</option>
  														<option value="advance">advance</option>
  														<option value="promotion">promotion</option>
													</select>
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Ticket Group</label></td>
												<td>
													<select id="ctm_ticket_group" name="ctm_ticket_group" required="required">
														<option value="<?=$row1['ctm_ticket_group'];?>"><?=$row1['ctm_ticket_group'];?></option>
  														<option value="Special Ticket">Special Ticket</option>
  														<option value="Pass Ticket">Pass Ticket</option>
  														<option value="Family Package">Family Package</option>
  														<option value="All-In Day Pass Lunch Buffet">All-In Day Pass Lunch Buffet</option>
  														<option value="All-In Day Pass Dinner Seafood Buffet">All-In Day Pass Dinner Seafood Buffet</option>
  														<option value="All-In Day Pass Lunch Buffet + Dinner Seafood Buffet">All-In Day Pass Lunch Buffet + Dinner Seafood Buffet</option>
  														<option value="Other Promotion">Other Promotion</option>
													</select>
												</td>
											</tr>
										</tbody>
									</table>
								</fieldset>
							</div>
						</div>
					</div><!-- /post-body-content -->
					<div id="postbox-container-1" class="postbox-container">
						<div id="submitdiv" class="stuffbox">
							<div class="inside">
								<div class="submitbox" id="submitcomment">
									<div id="minor-publishing">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Server Status</label>
												<br><br>

												<?php if($row1['ctm_server'] == "production") { ?>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="production" checked="checked">production</label><br>
												<?php } else if($row1['ctm_server'] != "production") { ?>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="production">production</label><br>
												<?php } ?>

												<?php if($row1['ctm_server'] == "test_web") { ?>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="test_web" checked="checked">test_web</label>
												<?php } else if($row1['ctm_server'] != "test_web") { ?>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="test_web">test_web</label>
												<?php } ?>

											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Display On Website</label>
												<br><br>
												<?php if($row1['ctm_is_display'] == "Y") { ?>
												<label><input type="radio" id="ctm_is_display" name="ctm_is_display" value="Y" checked="checked">Y</label><br>
												<?php } else if($row1['ctm_is_display'] != "Y") { ?>
												<label><input type="radio" id="ctm_is_display" name="ctm_is_display" value="Y">Y</label><br>
												<?php } ?>

												<?php if($row1['ctm_is_display'] == "N") { ?>
												<label><input type="radio" id="ctm_is_display" name="ctm_is_display" value="N" checked="checked">N</label>
												<?php } else if($row1['ctm_is_display'] != "N") { ?>
												<label><input type="radio" id="ctm_is_display" name="ctm_is_display" value="N">N</label>
												<?php } ?>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<script type="text/javascript">
					  					function display_time_one() { document.getElementById('ticket_display_time').style.display = 'none'; }
					  					function display_time_two() { document.getElementById('ticket_display_time').style.display = 'block'; }
                      					</script>
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Ticket Display Date</label>
												<br><br>
												<?php if($row1['ctm_ticket_status_show'] == "no_time_limit") { ?>
												<label><input type="radio" id="ctm_ticket_status_show" name="ctm_ticket_status_show" value="no_time_limit" checked="checked" onclick="display_time_one();">no_time_limit</label><br>
												<label><input type="radio" id="ctm_ticket_status_show" name="ctm_ticket_status_show" value="limited_time" onclick="display_time_two();">limited_time</label>	
												<?php } else if($row1['ctm_ticket_status_show'] == "limited_time") { ?>
												<label><input type="radio" id="ctm_ticket_status_show" name="ctm_ticket_status_show" value="no_time_limit" onclick="display_time_one();">no_time_limit</label><br>
												<label><input type="radio" id="ctm_ticket_status_show" name="ctm_ticket_status_show" value="limited_time" checked="checked" onclick="display_time_two();">limited_time</label>	
												<?php } else if($row1['ctm_ticket_status_show'] == "") { ?>
												<label><input type="radio" id="ctm_ticket_status_show" name="ctm_ticket_status_show" value="no_time_limit" checked="checked" onclick="display_time_one();">no_time_limit</label><br>
												<label><input type="radio" id="ctm_ticket_status_show" name="ctm_ticket_status_show" value="limited_time" onclick="display_time_two();">limited_time</label>	
												<?php } ?>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<?php if($row1['ctm_ticket_status_show'] == "no_time_limit") { ?>
										<div id="ticket_display_time" style="display:none;">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Display Time</label>
												<br><br>
												<label for="ticket_name">Start Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_start_date" id="ctm_ticket_start_date" readonly="readonly"></label>
												<br>
												<label for="ticket_name">End Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_end_date" id="ctm_ticket_end_date" readonly="readonly"></label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<?php } else if($row1['ctm_ticket_status_show'] == "limited_time") { ?>
										<div id="ticket_display_time">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Display Time</label>
												<br><br>
												<label for="ticket_name">Start Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_start_date" id="ctm_ticket_start_date" value="<?=$row1['ctm_ticket_start_date'];?>" readonly="readonly"></label>
												<br>
												<label for="ticket_name">End Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_end_date" id="ctm_ticket_end_date" value="<?=$row1['ctm_ticket_end_date'];?>" readonly="readonly"></label>
											</fieldset>
										</div>
										<?php } else if($row1['ctm_ticket_status_show'] == "") { ?>
										<div id="ticket_display_time" style="display:none;">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Display Time</label>
												<br><br>
												<label for="ticket_name">Start Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_start_date" id="ctm_ticket_start_date" readonly="readonly"></label>
												<br>
												<label for="ticket_name">End Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_end_date" id="ctm_ticket_end_date" readonly="readonly"></label>
											</fieldset>
										</div>
										<!-- misc actions -->
										<div class="clear"></div>
										<?php } ?>
										</div>

										<script type="text/javascript">
					  					function display_time_use_one() { document.getElementById('ticket_display_time_use').style.display = 'none'; }
					  					function display_time_use_two() { document.getElementById('ticket_display_time_use').style.display = 'block'; }
                      					</script>
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Ticket Use Date</label>
												<br><br>
												<?php if($row1['ctm_ticket_status_show_use'] == "no_time_limit") { ?>
												<label><input type="radio" id="ctm_ticket_status_show_use" name="ctm_ticket_status_show_use" value="no_time_limit" checked="checked" onclick="display_time_use_one();">no_time_limit</label><br>
												<label><input type="radio" id="ctm_ticket_status_show_use" name="ctm_ticket_status_show_use" value="limited_time" onclick="display_time_use_two();">limited_time</label>
												<?php } else if($row1['ctm_ticket_status_show_use'] == "limited_time") { ?>
												<label><input type="radio" id="ctm_ticket_status_show_use" name="ctm_ticket_status_show_use" value="no_time_limit" onclick="display_time_use_one();">no_time_limit</label><br>
												<label><input type="radio" id="ctm_ticket_status_show_use" name="ctm_ticket_status_show_use" value="limited_time" checked="checked" onclick="display_time_use_two();">limited_time</label>
												<?php } else if($row1['ctm_ticket_status_show_use'] == "") { ?>
												<label><input type="radio" id="ctm_ticket_status_show_use" name="ctm_ticket_status_show_use" value="no_time_limit" checked="checked" onclick="display_time_use_one();">no_time_limit</label><br>
												<label><input type="radio" id="ctm_ticket_status_show_use" name="ctm_ticket_status_show_use" value="limited_time" onclick="display_time_use_two();">limited_time</label>
												<?php } ?>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<?php if($row1['ctm_ticket_status_show_use'] == "no_time_limit") { ?>
										<div id="ticket_display_time_use" style="display:none;">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Display Time</label>
												<br><br>
												<label for="ticket_name">Start Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_start_date_use" id="ctm_ticket_start_date_use" readonly="readonly"></label>
												<br>
												<label for="ticket_name">End Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_end_date_use" id="ctm_ticket_end_date_use" readonly="readonly"></label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<?php } else if($row1['ctm_ticket_status_show_use'] == "limited_time") { ?>
										<div id="ticket_display_time_use">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Display Time</label>
												<br><br>
												<label for="ticket_name">Start Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_start_date_use" id="ctm_ticket_start_date_use" value="<?=$row1['ctm_ticket_start_date_use'];?>" readonly="readonly"></label>
												<br>
												<label for="ticket_name">End Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_end_date_use" id="ctm_ticket_end_date_use" value="<?=$row1['ctm_ticket_end_date_use'];?>" readonly="readonly"></label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<?php } else if($row1['ctm_ticket_status_show_use'] == "") { ?>
										<div id="ticket_display_time_use" style="display:none;">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Display Time</label>
												<br><br>
												<label for="ticket_name">Start Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_start_date_use" id="ctm_ticket_start_date_use" readonly="readonly"></label>
												<br>
												<label for="ticket_name">End Date</label>
												<label><input type="text"class="datepicker" name="ctm_ticket_end_date_use" id="ctm_ticket_end_date_use" readonly="readonly"></label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
										<?php } ?>

									</div>
									<div id="major-publishing-actions">
										<div id="publishing-action"><span class="spinner"></span>
											<input type="submit" name="save" id="save" class="button button-primary button-large" value="Edit">
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div><!-- /submitdiv -->
					</div>
				</div><!-- /post-body -->
			</div>
			<script>
				jQuery(function() {
					jQuery( ".datepicker" ).datepicker({
						dateFormat : "yy-mm-dd"
					});
				});
			</script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
			<script type="text/javascript">
				$(function(){
					var obj1="select#ctm_ticket_extra_item";
					var obj2="ul.myUL1";
					$(obj1).focus(function(){   
						var nX=$(this).offset().left;   
						var nY=$(this).offset().top+($(this).height()+3);   
						$(this).html("");
						$(obj2).show().css({   
							"width":$(this).width()+"px",
							"left":nX,   
							"top":nY   
						});
					});   
					$(obj2).children("li").click(function(){ 
						var iCheck=($(this).children("input").attr("checked")=="checked")?false:true;  
						$(this).children("input").attr("checked",iCheck);
					});   
					$(obj2).hover(function(){   
						$(this).show();    
					},function(){   
						var setValue="";
						var setText="";
						$(this).find("input").each(function(key){
							if($(this).attr("checked")=="checked"){
								setValue+=$(this).val()+",";
								setText+=$(this).parent("li").text()+",";
							}       
						});
						setText=(setText!="")?setText:"Extra Item";
						$(this).hide();   
						$(obj1).html("<option value=\""+setValue+"\">"+setText+"</option>").blur();   
					});  
				});
			</script>
		</form>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<div style="font-size: 14px;"><strong> คำอธิบายการใช้งาน </strong></div><br>
	<div style="font-size: 14px;"> - Ticket ID	: ID ที่ได้รับมาจาก Centaman </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Centaman Description : คำอิบายที่ได้รับมาจาก Centaman ตัวอย่าง ONR CH Ticket 0800 </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Price : ราคา Ticket </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Color : สีที่ใช้แสดง Ticket ในระบบมีสีทั้งหมดดังนี้ black, green, blue, pink </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Name (EN) : ชื่อที่ใช้แสดง ภาษาอังกฤษ </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Name (TH) : ชื่อที่ใช้แสดง ภาษาไทย </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Description (EN) : รายละเอียด Ticket ที่ใช้แสดง ภาษาอังกฤษ	</div>
	<br>
	<div style="font-size: 14px;"> - Ticket Description (TH) : รายละเอียด Ticket ที่ใช้แสดง ภาษาไทย </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Extra Item : เลือก Extra ที่ต้องการ ด้วยการ check ตรง Extra ที่ต้องการ	</div>
	<br>
	<div style="font-size: 14px;"> - Ticket Status : สถานะต่างๆ ของ Ticket ในระบบมี Status ทั้งหมดดังนี้	</div>
	<div style="font-size: 14px;"> --> None คือ Ticket ที่ นอกเหนือจาก 3 ข้อด้านล่าง </div>
	<div style="font-size: 14px;"> --> Standard คือ Ticket พื้นฐานของทางเว็บไซต์ พวก บัตรผู้ใหญ่ หรือ บัตรเด็ก </div>
	<div style="font-size: 14px;"> --> Advance คือ Ticket ที่จะแสดงในหน้า Booking เมื่อลูกค้าจองเข้ามาเกิน 15 วัน </div>
	<div style="font-size: 14px;"> --> Promotion คือ Ticket ที่จะเอาไว้เลือก Ticket ในส่วนของ co promotion </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Group : กลุ่มที่จะไปจัดวาง Ticket นั้น...นั้น ในระบบมี Group ทั้งหมดดังนี้ </div>
	<div style="font-size: 14px;"> --> Special Ticket : จะแสดงบนสุด พร้อมมี ป้าย HOTDEAL กำกับหน้า Ticket </div>
	<div style="font-size: 14px;"> --> Pass Ticket </div>
	<div style="font-size: 14px;"> --> Family Package </div>
	<div style="font-size: 14px;"> --> All-In Day Pass Lunch Buffet </div>
	<div style="font-size: 14px;"> --> All-In Day Pass Dinner Seafood Buffet </div>
	<div style="font-size: 14px;"> --> All-In Day Pass Lunch Buffet + Dinner Seafood Buffet </div>
	<div style="font-size: 14px;"> --> Other Promotion : จะแสดงล่างสุด</div>
	<br>
	<div style="font-size: 14px;"> - Server Status : สถานะต่างๆ ของ Server ในระบบมี Status ทั้งหมดดังนี้</div>
	<div style="font-size: 14px;"> --> production คือ Ticket ที่จะขึ้นแสดงในระบบ จริงมีการเชื่อมโยงกับ Centaman </div>
	<div style="font-size: 14px;"> --> test_web คือ Ticket ที่จะขึ้นแสดงในระบบทดสอบ ไม่มีการเชื่อมโยงกับ Centaman </div>
	<br>
	<div style="font-size: 14px;"> - Display On Website : เปิด-ปิด การแสดงบนหน้าเว็บ </div>
	<div style="font-size: 14px;"> --> Y คือ แสดง Ticket </div>
	<div style="font-size: 14px;"> --> N คือ ไม่แสดง Ticket </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Display Date : วันที่ในการกำหมดในการแสดงบนหน้าเว็บไซต์</div>
	<div style="font-size: 14px;"> --> no_time_limit คือ แสดงตลอด </div>
	<div style="font-size: 14px;"> --> limited_time คือ สามารถกำลังวันที่เริ่มและสิ้นสุดการแสดง Ticket ได้ </div>
	<br>
	<div style="font-size: 14px;"> - Ticket Use Date : วันที่ในการกำหมดในการใช้จองบนหน้าเว็บไซต์ได้</div>
	<div style="font-size: 14px;"> --> no_time_limit คือ แสดงตลอด </div>
	<div style="font-size: 14px;"> --> limited_time คือ สามารถกำลังวันที่เริ่มและสิ้นสุดการใช้ Ticket ได้ </div>
	<?php
}
function vananava_extra_item_add() { ?>
	<div class="wrap">
		<h2>Add New Extra Item</h2>
		<form action="extra_item_add.php" method="post" enctype="multipart/form-data" name="frmMain">
			<div id="poststuff">
				<input type="hidden" name="confirm" value="1">
				<input type="hidden" name="ctm_deposit_percentage" id="ctm_deposit_percentage" value="100">
				<input type="hidden" name="ctm_is_tax_inclusive" id="ctm_is_tax_inclusive" value="1">
				<input type="hidden" name="ctm_tax_percentage" id="ctm_tax_percentage" value="7">
				<input type="hidden" name="ctm_is_active" id="ctm_is_active" value="N">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content" class="edit-form-section edit-comment-section">
						<div id="namediv" class="stuffbox">
							<div class="inside">
								<h2 class="edit-comment-author">Information</h2>
								<fieldset>
									<table class="form-table editcomment" role="presentation">
										<tbody>
											<tr>
												<td class="first"><label for="ticket_name">Extra ID</label></td>
												<td>
													<input type="text" id="ctm_extra_ID" name="ctm_extra_ID" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Extra Centaman Description</label></td>
												<td>
													<input type="text" id="ctm_extra_description" name="ctm_extra_description" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Extra Price</label></td>
												<td>
													<input type="text" id="ctm_extra_price" name="ctm_extra_price" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Extra Centaman Name<br>EX: adult-buffet-lunch-food</label></td>
												<td>
													<input type="text" id="ctm_extra_slug" name="ctm_extra_slug" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Extra Name (EN)</label></td>
												<td>
													<input type="text" id="ctm_extra_name_en" name="ctm_extra_name_en" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Extra Name (TH)</label></td>
												<td>
													<input type="text" id="ctm_extra_name_th" name="ctm_extra_name_th" required="required">
												</td>
											</tr>
										</tbody>
									</table>
								</fieldset>
							</div>
						</div>
					</div><!-- /post-body-content -->
					<div id="postbox-container-1" class="postbox-container">
						<div id="submitdiv" class="stuffbox">
							<div class="inside">
								<div class="submitbox" id="submitcomment">
									<div id="minor-publishing">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Server Status</label>
												<br><br>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="production" checked="checked">production</label><br>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="test_web">test_web</label>
											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
									</div>
									<div id="major-publishing-actions">
										<div id="publishing-action"><span class="spinner"></span>
											<input type="submit" name="save" id="save" class="button button-primary button-large" value="Add New">
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div><!-- /submitdiv -->
					</div>
				</div><!-- /post-body -->
			</div>
			<script>
				jQuery(function() {
					jQuery( ".datepicker" ).datepicker({
						dateFormat : "yy-mm-dd"
					});
				});
			</script>
		</form>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<div style="font-size: 14px;"><strong> คำอธิบายการใช้งาน </strong></div><br>
	<div style="font-size: 14px;"> - Extra ID	: ID ที่ได้รับมาจาก Centaman </div>
	<br>
	<div style="font-size: 14px;"> - Extra Centaman Description : คำอิบายที่ได้รับมาจาก Centaman ตัวอย่าง EXT ONR Towel 0100 </div>
	<br>
	<div style="font-size: 14px;"> - Extra Price : ราคา Extra </div>
	<br>
	<div style="font-size: 14px;"> - Extra Centaman Name : เป็นตัวกำหนดชื่อ name,id ของ textbox เพื่อส่งค่าการจอง ตัวอย่าง adult-buffet-lunch-food </div>
	<br>
	<div style="font-size: 14px;"> - Extra Name (EN) : ชื่อที่ใช้แสดง ภาษาอังกฤษ </div>
	<br>
	<div style="font-size: 14px;"> - Extra Name (TH) : ชื่อที่ใช้แสดง ภาษาไทย </div>
	<br>
	<div style="font-size: 14px;"> - Server Status : สถานะต่างๆ ของ Server ในระบบมี Status ทั้งหมดดังนี้</div>
	<div style="font-size: 14px;"> --> production คือ Extra ที่จะขึ้นแสดงในระบบ จริงมีการเชื่อมโยงกับ Centaman </div>
	<div style="font-size: 14px;"> --> test_web คือ Extra ที่จะขึ้นแสดงในระบบทดสอบ ไม่มีการเชื่อมโยงกับ Centaman </div>
	</div>
	<?php
}
function vananava_extra_item_edit() { 

	include('connect.php');

	$ctm_extra_ID = $_GET["ctm_extra_ID"];

	if($ctm_extra_ID == ""){ header("HTTP/1.1 301 Moved Permanently"); header('Location: admin.php?page=vananava_extra_item_add'); exit(); }

	$sql1 =	" SELECT * FROM vananava_wp_vnnv_ctm_extrameta WHERE ctm_extra_ID = '$ctm_extra_ID' ";
	$query1 = mysql_db_query($dbname, $sql1) or die("Can't Query1");
	$row1 = mysql_fetch_array($query1);

	?>
	<div class="wrap">
		<h2>Edit Extra Item</h2>
		<form action="extra_item_edit.php" method="post" enctype="multipart/form-data" name="frmMain">
			<div id="poststuff">
				<input type="hidden" name="confirm" value="1">
				<input type="hidden" name="ctm_deposit_percentage" id="ctm_deposit_percentage" value="100">
				<input type="hidden" name="ctm_is_tax_inclusive" id="ctm_is_tax_inclusive" value="1">
				<input type="hidden" name="ctm_tax_percentage" id="ctm_tax_percentage" value="7">
				<input type="hidden" name="ctm_is_active" id="ctm_is_active" value="N">
				<div id="post-body" class="metabox-holder columns-2">
					<div id="post-body-content" class="edit-form-section edit-comment-section">
						<div id="namediv" class="stuffbox">
							<div class="inside">
								<h2 class="edit-comment-author">Information</h2>
								<fieldset>
									<table class="form-table editcomment" role="presentation">
										<tbody>
											<tr>
												<td class="first"><label for="ticket_name">Extra ID</label></td>
												<td>
													<input type="text" id="ctm_extra_ID" name="ctm_extra_ID" value="<?=$row1['ctm_extra_ID'];?>" readonly="readonly">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Extra Centaman Description</label></td>
												<td>
													<input type="text" id="ctm_extra_description" name="ctm_extra_description" value="<?=$row1['ctm_extra_description'];?>" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Extra Price</label></td>
												<td>
													<input type="text" id="ctm_extra_price" name="ctm_extra_price" value="<?=$row1['ctm_extra_price'];?>" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Extra Centaman Name<br>EX: adult-buffet-lunch-food</label></td>
												<td>
													<input type="text" id="ctm_extra_slug" name="ctm_extra_slug" value="<?=$row1['ctm_extra_slug'];?>" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Extra Name (EN)</label></td>
												<td>
													<input type="text" id="ctm_extra_name_en" name="ctm_extra_name_en" value="<?=$row1['ctm_extra_name_en'];?>" required="required">
												</td>
											</tr>
											<tr>
												<td class="first"><label for="ticket_name">Extra Name (TH)</label></td>
												<td>
													<input type="text" id="ctm_extra_name_th" name="ctm_extra_name_th" value="<?=$row1['ctm_extra_name_th'];?>" required="required">
												</td>
											</tr>
										</tbody>
									</table>
								</fieldset>
							</div>
						</div>
					</div><!-- /post-body-content -->
					<div id="postbox-container-1" class="postbox-container">
						<div id="submitdiv" class="stuffbox">
							<div class="inside">
								<div class="submitbox" id="submitcomment">
									<div id="minor-publishing">
										<div id="misc-publishing-actions">
											<fieldset class="misc-pub-section misc-pub-comment-status" id="comment-status-radio">
												<label for="ticket_code">Server Status</label>
												<br><br>

												<?php if($row1['ctm_server'] == "production") { ?>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="production" checked="checked">production</label><br>
												<?php } else if($row1['ctm_server'] != "production") { ?>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="production">production</label><br>
												<?php } ?>

												<?php if($row1['ctm_server'] == "test_web") { ?>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="test_web" checked="checked">test_web</label>
												<?php } else if($row1['ctm_server'] != "test_web") { ?>
												<label><input type="radio" id="ctm_server" name="ctm_server" value="test_web">test_web</label>
												<?php } ?>

											</fieldset>
										</div> <!-- misc actions -->
										<div class="clear"></div>
									</div>
									<div id="major-publishing-actions">
										<div id="publishing-action"><span class="spinner"></span>
											<input type="submit" name="save" id="save" class="button button-primary button-large" value="Edit">
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>
						</div><!-- /submitdiv -->
					</div>
				</div><!-- /post-body -->
			</div>
			<script>
				jQuery(function() {
					jQuery( ".datepicker" ).datepicker({
						dateFormat : "yy-mm-dd"
					});
				});
			</script>
		</form>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
	<div style="font-size: 14px;"><strong> คำอธิบายการใช้งาน </strong></div><br>
	<div style="font-size: 14px;"> - Extra ID	: ID ที่ได้รับมาจาก Centaman </div>
	<br>
	<div style="font-size: 14px;"> - Extra Centaman Description : คำอิบายที่ได้รับมาจาก Centaman ตัวอย่าง EXT ONR Towel 0100 </div>
	<br>
	<div style="font-size: 14px;"> - Extra Price : ราคา Ticket </div>
	<br>
	<div style="font-size: 14px;"> - Extra Centaman Name : เป็นตัวกำหนดชื่อ name,id ของ textbox เพื่อส่งค่าการจอง ตัวอย่าง adult-buffet-lunch-food </div>
	<br>
	<div style="font-size: 14px;"> - Extra Name (EN) : ชื่อที่ใช้แสดง ภาษาอังกฤษ </div>
	<br>
	<div style="font-size: 14px;"> - Extra Name (TH) : ชื่อที่ใช้แสดง ภาษาไทย </div>
	<br>
	<div style="font-size: 14px;"> - Server Status : สถานะต่างๆ ของ Server ในระบบมี Status ทั้งหมดดังนี้</div>
	<div style="font-size: 14px;"> --> production คือ Extra ที่จะขึ้นแสดงในระบบ จริงมีการเชื่อมโยงกับ Centaman </div>
	<div style="font-size: 14px;"> --> test_web คือ Extra ที่จะขึ้นแสดงในระบบทดสอบ ไม่มีการเชื่อมโยงกับ Centaman </div>
	</div>
	<?php
}
/*
function vananava_order_screen_options() {
	global $vananava_order_page;

	$screen = get_current_screen();
	
	// get out of here if we are not on our settings page
	if(!is_object($screen) || $screen->id != $pippin_sample_page)
		return;
		
	$args = array(
		'label' => __('Members per page', 'pippin'),
		'default' => 10,
		'option' => 'pippin_per_page'
	);
	add_screen_option( 'per_page', $args );
}
*/
/*
 * @see https://wordpress.org/plugins/custom-list-table-example/
 * @see http://www.smashingmagazine.com/2011/11/native-admin-tables-wordpress/
 */

/*
 * Load the base class
 */
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/*
abstract class Simple_WP_List_Table extends WP_List_Table {
	private $per_page = 20;
	function __construct($options, $per_page = NULL) {
		global $status, $page;
		parent::__construct($options);
		if ($per_page) {
			$this->per_page = $per_page;
		}
	}
	function column_default($item, $column_name){
		return $item[$column_name];
	}
	function column_cb($item){
		return '<input type="checkbox" name="'.$this->_args['singular'].'" value="'.$item['id'].'" />';
	}
	function prepare_items() {
		global $wpdb;
		$table_vnnv_order_items = $wpdb->prefix . 'vnnv_order_items';
		$table_vnnv_order_itemmeta = $wpdb->prefix . 'vnnv_order_itemmeta';
		
		$query = "SELECT *";
		$query .= ",(SELECT im.meta_value FROM $table_vnnv_order_itemmeta AS im WHERE im.order_item_id = i.order_item_id AND im.meta_key LIKE 'BookingId' LIMIT 1) BookingId";
		$query .= ",(SELECT im.meta_value FROM $table_vnnv_order_itemmeta AS im WHERE im.order_item_id = i.order_item_id AND im.meta_key LIKE 'Email' LIMIT 1) Email";
		$query .= ",(SELECT im.meta_value FROM $table_vnnv_order_itemmeta AS im WHERE im.order_item_id = i.order_item_id AND im.meta_key LIKE 'MobilePhone' LIMIT 1) MobilePhone";
		$query .= ",(SELECT FORMAT(im.meta_value, 0) FROM $table_vnnv_order_itemmeta AS im WHERE im.order_item_id = i.order_item_id AND im.meta_key LIKE 'TotalPaid' LIMIT 1) TotalPaid";
		$query .= ",(SELECT im.meta_value FROM $table_vnnv_order_itemmeta AS im WHERE im.order_item_id = i.order_item_id AND im.meta_key LIKE 'StartDate' LIMIT 1) StartDate";
		$query .= " FROM $table_vnnv_order_items AS i";
		$orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : 'order_id';
		$order = !empty($_GET["order"]) ? $_GET["order"] : 'DESC';
		$search = ( isset( $_REQUEST['s'] ) ) ? $_REQUEST['s'] : false;
		$query .= ( $search ) ? $wpdb->prepare(" WHERE order_item_name LIKE '%%%s%%' ", $search ) : ''; 
		if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }
		$total_items = $wpdb->query($query);
		$paged = !empty($_GET["paged"]) ? $_GET["paged"] : '';
		if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }
		if(!empty($paged)){
			$offset=($paged-1)*$this->per_page;
			$query.=' LIMIT '.(int)$offset.','.(int)$this->per_page;
		}
		$current_page = $this->get_pagenum();
		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'total_pages' => ceil($total_items/$this->per_page),
			'per_page' => $this->per_page,
		) );
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->process_bulk_action();
		
		$this->items = $wpdb->get_results($query, 'ARRAY_A');
		
		//print_r($query);
	}


	
	function display() {
		?>
		<form method="get">
			<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
			<?php $this->search_box('Search Contact Name', 'search_id'); ?>
			<?php parent::display(); ?>
		</form>
		<?php
	}
}

class Order_List_Table extends Simple_WP_List_Table {
	function __construct() {
		parent::__construct(array(
			'order_id'						=> 'order_id',
			'BookingId'						=> 'BookingId',
			'order_item_name'				=> 'order_item_name',
			'Email'							=> 'Email',
			'MobilePhone'					=> 'MobilePhone',
			'TotalPaid'						=> 'TotalPaid',
			'order_items_promotion_name'	=> 'order_items_promotion_name',
			'StartDate'						=> 'StartDate',
			'order_item_status'				=> 'order_item_status',
			'ajax'							=> false
		), 20);
	}
	function get_columns() {
		return array(
			//'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
			'order_id'						=> __('Order No.'),
			'BookingId'						=> __('Booking No.'),
			'order_item_name'				=> __('Contact Name'),
			'Email'							=> __('Contact Email'),
			'MobilePhone'					=> __('Contact Phone'),
			'TotalPaid'						=> __('Total Cost'),
			'order_items_promotion_name'	=> __('Promotion'),
			'StartDate'						=> __('Planned Date'),
			'order_item_status'				=> __('Payment Status'),
			'order_item_add_date'			=> __('Order Date')
		);
	}
	public function get_sortable_columns() {
		return array(
			'order_id'						=> array('order_id'),
			'BookingId'						=> array('BookingId'),
			'order_item_name'				=> array('order_item_name'),
			'Email'							=> array('Email'),
			'MobilePhone'					=> array('MobilePhone'),
			'TotalPaid'						=> array('TotalPaid'),
			'order_items_promotion_name'	=> array('order_items_promotion_name'),
			'StartDate'						=> array('StartDate'),
			'order_item_status'				=> array('order_item_status'),
			'order_item_add_date'			=> array('order_item_add_date')
		);
	}
	function column_name($item){

		return $item['order_item_status'];
	}
}
*/

abstract class Simple_WP_List_Table_Ticket_Order extends WP_List_Table {
	private $per_page = 20;
	function __construct($options, $per_page = NULL) {
		global $status, $page;
		parent::__construct($options);
		if ($per_page) {
			$this->per_page = $per_page;
		}
	}
	function column_default($item, $column_name){
		return $item[$column_name];
	}
	function column_cb($item){
		return '<input type="checkbox" name="'.$this->_args['singular'].'" value="'.$item['id'].'" />';
	}
	function prepare_items() {
		global $wpdb;
		$table_vnnv_order_items = $wpdb->prefix . 'vnnv_order_items';
		$table_vnnv_order_itemmeta = $wpdb->prefix . 'vnnv_order_itemmeta';

		$query = "SELECT *";
		$query .= ",(SELECT im.meta_value FROM $table_vnnv_order_itemmeta AS im WHERE im.order_item_id = i.order_item_id AND im.meta_key LIKE 'BookingId' LIMIT 1) BookingId";
		$query .= ",(SELECT im.meta_value FROM $table_vnnv_order_itemmeta AS im WHERE im.order_item_id = i.order_item_id AND im.meta_key LIKE 'ReceiptNo' LIMIT 1) ReceiptNo";
		$query .= ",(SELECT im.meta_value FROM $table_vnnv_order_itemmeta AS im WHERE im.order_item_id = i.order_item_id AND im.meta_key LIKE 'Email' LIMIT 1) Email";
		$query .= ",(SELECT im.meta_value FROM $table_vnnv_order_itemmeta AS im WHERE im.order_item_id = i.order_item_id AND im.meta_key LIKE 'MobilePhone' LIMIT 1) MobilePhone";
		$query .= ",(SELECT FORMAT(im.meta_value, 0) FROM $table_vnnv_order_itemmeta AS im WHERE im.order_item_id = i.order_item_id AND im.meta_key LIKE 'TotalPaid' LIMIT 1) TotalPaid";
		$query .= ",(SELECT im.meta_value FROM $table_vnnv_order_itemmeta AS im WHERE im.order_item_id = i.order_item_id AND im.meta_key LIKE 'StartDate' LIMIT 1) StartDate";
		$query .= " FROM $table_vnnv_order_items AS i WHERE order_show = 'show' AND order_server = 'production'";
		$orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : 'order_id';
		$order = !empty($_GET["order"]) ? $_GET["order"] : 'DESC';

		$search = ( isset( $_REQUEST['s'] ) ) ? $_REQUEST['s'] : false;
		$query .= ( $search ) ? $wpdb->prepare(" AND order_id LIKE '%%%s%%' ", $search ) : '';

		if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }
		$total_items = $wpdb->query($query);
		$paged = !empty($_GET["paged"]) ? $_GET["paged"] : '';
		if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }
		if(!empty($paged)){
			$offset=($paged-1)*$this->per_page;
			$query.=' LIMIT '.(int)$offset.','.(int)$this->per_page;
		}
		$current_page = $this->get_pagenum();
		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'total_pages' => ceil($total_items/$this->per_page),
			'per_page' => $this->per_page,
		) );
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->process_bulk_action();
		
		$this->items = $wpdb->get_results($query, 'ARRAY_A');
		
		//print_r($query);
	}
	
	function display() {
		?>

		<form method="get">
			<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
			<?php $this->search_box('Search Order ID', 'search_id'); ?>
			<?php parent::display(); ?>
		</form>

		<?php
	}
}

class Ticket_Order_List_Table extends Simple_WP_List_Table_Ticket_Order {
	function __construct() {
		parent::__construct(array(
			'order_id'						=> 'order_id',
			'BookingId'						=> 'BookingId',
			'ReceiptNo'						=> 'ReceiptNo',
			'order_item_name'				=> 'order_item_name',
			'Email'							=> 'Email',
			'MobilePhone'					=> 'MobilePhone',
			'TotalPaid'						=> 'TotalPaid',
			'order_items_promotion_name'	=> 'order_items_promotion_name',
			'StartDate'						=> 'StartDate',
			'order_item_status'				=> 'order_item_status',
			'ajax'							=> false
		), 20);
	}
	function get_columns() {
		return array(
			//'cb' => '<input type="checkbox" />', //Render a checkbox instead of text
			'order_id'						=> __('Order No.'),
			'BookingId'						=> __('Booking No.'),
			'ReceiptNo'						=> __('Receipt No.'),
			'order_item_name'				=> __('Contact Name'),
			'Email'							=> __('Contact Email'),
			'MobilePhone'					=> __('Contact Phone'),
			'TotalPaid'						=> __('Total Cost'),
			'order_items_promotion_name'	=> __('Promotion'),
			'StartDate'						=> __('Planned Date'),
			'order_item_status'				=> __('Payment Status'),
			'order_item_update_date'		=> __('Order Date')
		);
	}
	public function get_sortable_columns() {
		return array(
			'order_id'						=> array('order_id'),
			'BookingId'						=> array('BookingId'),
			'ReceiptNo'						=> array('ReceiptNo'),
			'order_item_name'				=> array('order_item_name'),
			'Email'							=> array('Email'),
			'MobilePhone'					=> array('MobilePhone'),
			'TotalPaid'						=> array('TotalPaid'),
			'order_items_promotion_name'	=> array('order_items_promotion_name'),
			'StartDate'						=> array('StartDate'),
			'order_item_status'				=> array('order_item_status'),
			'order_item_update_date'		=> array('order_item_update_date')
		);
	}
	function column_order_item_name($item){

		$actions = array(
			'view_order'      => '<a href="admin.php?page=vananava_order_view_order&order_id='.$item['order_id'].'">View Order</a>'
		);

		return $item['order_item_name'].' '.$this->row_actions($actions);
	}	

}

abstract class Simple_WP_List_Table_Co_Promotion extends WP_List_Table {
	private $per_page = 20;
	function __construct($options, $per_page = NULL) {
		global $status, $page;
		parent::__construct($options);
		if ($per_page) {
			$this->per_page = $per_page;
		}
	}
	function column_default($item, $column_name){
		return $item[$column_name];
	}
	function column_cb($item){
		return '<input type="checkbox" name="'.$this->_args['singular'].'" value="'.$item['id'].'" />';
	}
	function prepare_items() {
		global $wpdb;
		$table_vnnv_co_promotion = $wpdb->prefix . 'vnnv_co_promotion';
		
		$query = "SELECT *";
		$query .= " FROM $table_vnnv_co_promotion";
		$orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : 'co_promotion_id';
		$order = !empty($_GET["order"]) ? $_GET["order"] : 'DESC';
		$search = ( isset( $_REQUEST['s'] ) ) ? $_REQUEST['s'] : false;
		$query .= ( $search ) ? $wpdb->prepare(" WHERE co_promotion_name LIKE '%%%s%%' ", $search ) : ''; 
		if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }
		$total_items = $wpdb->query($query);
		$paged = !empty($_GET["paged"]) ? $_GET["paged"] : '';
		if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }
		if(!empty($paged)){
			$offset=($paged-1)*$this->per_page;
			$query.=' LIMIT '.(int)$offset.','.(int)$this->per_page;
		}
		$current_page = $this->get_pagenum();
		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'total_pages' => ceil($total_items/$this->per_page),
			'per_page' => $this->per_page,
		) );
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->process_bulk_action();
		$this->items = $wpdb->get_results($query, 'ARRAY_A');
		
		//print_r($query);
	}
	
	function display() {
		?>
		<form method="get">
			<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
			<?php //$this->search_box('Search Contact Name', 'search_id'); ?>
			<?php parent::display(); ?>
		</form>
		<?php
	}
}

class Co_Promotion_List_Table extends Simple_WP_List_Table_Co_Promotion {
	function __construct() {
		global $status, $page;
		parent::__construct(array(
			'singular'  => 'wp_list_co_promotion',
			'plural'    => 'wp_list_co_promotions',
			'ajax'		=> false
		), 20);
	}
	function get_columns() {
		return array(
			'co_promotion_id'					=> __('Co Promotion ID'),
			'co_promotion_name'					=> __('Co Promotion Name'),
			'co_promotion_status_thai'			=> __('Status (สถานะการใช้งาน)'),
			'co_promotion_ticket_start_date'	=> __('Co Promotion Start (วันแรกการใช้งาน)'),
			'co_promotion_ticket_end_date'		=> __('Co Promotion End (วันสุดท้ายการใช้งาน)')
		);
	}
	public function get_sortable_columns() {
		return array(
			'co_promotion_id'					=> array('co_promotion_id'),
			'co_promotion_name'					=> array('co_promotion_name'),
			'co_promotion_status_thai'			=> array('co_promotion_status_thai'),
			'co_promotion_ticket_start_date'	=> array('co_promotion_ticket_start_date'),
			'co_promotion_ticket_end_date'		=> array('co_promotion_ticket_end_date')
		);
	}
	function column_co_promotion_name($item){

		$actions = array(
			'edit'      => '<a href="admin.php?page=vananava_co_promotion_edit_new&co_promotion_id='.$item['co_promotion_id'].'">Edit</a>',
			'addmore'   => '<a href="admin.php?page=vananava_co_promotion_addmore_new&co_promotion_id='.$item['co_promotion_id'].'">Add More</a>',
			'view'    	=> '<a href="admin.php?page=vananava_co_promotion_view_new&co_promotion_id='.$item['co_promotion_id'].'">View</a>'
		);

		return $item['co_promotion_name'].' '.$this->row_actions($actions);
	}	
/*
	function get_bulk_actions() {
		$actions = array(
			'delete'    => 'Delete'
		);
		return $actions;
	}	
*/

	function process_bulk_action() {
/*
		if( 'delete'===$this->current_action() ) {
			wp_die('Items deleted (or they would be if we had items to delete)!');
		}
*/

		if( 'edit'===$this->current_action() ) {

			?>

			<?php
			
		}

		if( 'addmore'===$this->current_action() ) {


			?>

			<?php
			
		}

		if( 'view'===$this->current_action() ) {

			?>

			<?php
			
		}

		
		if( 'viewcode'===$this->current_action() ) {

			?>

			<?php

		}
	}

}

abstract class Simple_WP_List_Table_Ticket_Item extends WP_List_Table {
	private $per_page = 20;
	function __construct($options, $per_page = NULL) {
		global $status, $page;
		parent::__construct($options);
		if ($per_page) {
			$this->per_page = $per_page;
		}
	}
	function column_default($item, $column_name){
		return $item[$column_name];
	}
	function column_cb($item){
		return '<input type="checkbox" name="'.$this->_args['singular'].'" value="'.$item['id'].'" />';
	}
	function prepare_items() {
		global $wpdb;
		$table_vnnv_ticket_item = $wpdb->prefix . 'vnnv_ctm_ticketmeta';
		
		$query = "SELECT *";
		$query .= " FROM $table_vnnv_ticket_item ";
		//$query .= " ctm_server = 'production'";
		$orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : 'ctm_ticket_ID';
		$order = !empty($_GET["order"]) ? $_GET["order"] : 'ASC';
		$search = ( isset( $_REQUEST['s'] ) ) ? $_REQUEST['s'] : false;
		$query .= ( $search ) ? $wpdb->prepare(" WHERE ctm_ticket_ID LIKE '%%%s%%' ", $search ) : ''; 
		if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }
		$total_items = $wpdb->query($query);
		$paged = !empty($_GET["paged"]) ? $_GET["paged"] : '';
		if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }
		if(!empty($paged)){
			$offset=($paged-1)*$this->per_page;
			$query.=' LIMIT '.(int)$offset.','.(int)$this->per_page;
		}
		$current_page = $this->get_pagenum();
		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'total_pages' => ceil($total_items/$this->per_page),
			'per_page' => $this->per_page,
		) );
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->process_bulk_action();
		$this->items = $wpdb->get_results($query, 'ARRAY_A');
		
		//print_r($query);
	}
	
	function display() {
		?>
		<form method="get">
			<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
			<?php $this->search_box('Search Ticket ID', 'search_id'); ?>
			<?php parent::display(); ?>
		</form>
		<?php
	}
}

class Ticket_Item_List_Table extends Simple_WP_List_Table_Ticket_Item {
	function __construct() {
		global $status, $page;
		parent::__construct(array(
			'singular'  => 'wp_list_co_promotion',
			'plural'    => 'wp_list_co_promotions',
			'ajax'		=> false
		), 20);
	}
	function get_columns() {
		return array(
			'ctm_ticket_ID'				=> __('Ticket ID'),
			'ctm_ticket_description'	=> __('Centaman Description'),
			'ctm_ticket_price'			=> __('Price'),
			'ctm_ticket_name_en'		=> __('Name (EN)'),
			'ctm_ticket_name_th'		=> __('Name (TH)'),
			'ctm_is_display'			=> __('Display On Website'),
			'ctm_ticket_status'			=> __('Ticket Status'),
			'ctm_server'				=> __('Server Status')
		);
	}
	public function get_sortable_columns() {
		return array(
			'ctm_ticket_ID'				=> array('ctm_ticket_ID'),
			'ctm_ticket_description'	=> array('ctm_ticket_description'),
			'ctm_ticket_price'			=> array('ctm_ticket_price'),
			'ctm_ticket_name_en'		=> array('ctm_ticket_name_en'),
			'ctm_ticket_name_th'		=> array('ctm_ticket_name_th'),
			'ctm_is_display'			=> array('ctm_is_display'),
			'ctm_ticket_status'			=> array('ctm_ticket_status'),
			'ctm_server'				=> array('ctm_server')
		);
	}
	function column_ctm_ticket_description($item){

		$actions = array(
			'edit'      => '<a href="admin.php?page=vananava_ticket_item_edit&ctm_ticket_ID='.$item['ctm_ticket_ID'].'">Edit</a>'
		);

		return $item['ctm_ticket_description'].' '.$this->row_actions($actions);
	}	

}

abstract class Simple_WP_List_Table_Extra_Item extends WP_List_Table {
	private $per_page = 20;
	function __construct($options, $per_page = NULL) {
		global $status, $page;
		parent::__construct($options);
		if ($per_page) {
			$this->per_page = $per_page;
		}
	}
	function column_default($item, $column_name){
		return $item[$column_name];
	}
	function column_cb($item){
		return '<input type="checkbox" name="'.$this->_args['singular'].'" value="'.$item['id'].'" />';
	}
	function prepare_items() {
		global $wpdb;
		$table_vnnv_extra_item = $wpdb->prefix . 'vnnv_ctm_extrameta';
		
		$query = "SELECT *";
		$query .= " FROM $table_vnnv_extra_item ";
		//$query .= " ctm_server = 'production'";
		$orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : 'ctm_extra_ID';
		$order = !empty($_GET["order"]) ? $_GET["order"] : 'ASC';
		$search = ( isset( $_REQUEST['s'] ) ) ? $_REQUEST['s'] : false;
		$query .= ( $search ) ? $wpdb->prepare(" WHERE ctm_extra_ID LIKE '%%%s%%' ", $search ) : ''; 
		if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }
		$total_items = $wpdb->query($query);
		$paged = !empty($_GET["paged"]) ? $_GET["paged"] : '';
		if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }
		if(!empty($paged)){
			$offset=($paged-1)*$this->per_page;
			$query.=' LIMIT '.(int)$offset.','.(int)$this->per_page;
		}
		$current_page = $this->get_pagenum();
		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'total_pages' => ceil($total_items/$this->per_page),
			'per_page' => $this->per_page,
		) );
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->process_bulk_action();
		$this->items = $wpdb->get_results($query, 'ARRAY_A');
		
		//print_r($query);
	}
	
	function display() {
		?>
		<form method="get">
			<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
			<?php $this->search_box('Search Extra ID', 'search_id'); ?>
			<?php parent::display(); ?>
		</form>
		<?php
	}
}

class Extra_Item_List_Table extends Simple_WP_List_Table_Extra_Item {
	function __construct() {
		global $status, $page;
		parent::__construct(array(
			'singular'  => 'wp_list_co_promotion',
			'plural'    => 'wp_list_co_promotions',
			'ajax'		=> false
		), 20);
	}
	function get_columns() {
		return array(
			'ctm_extra_ID'			=> __('Ticket ID'),
			'ctm_extra_description'	=> __('Centaman Description'),
			'ctm_extra_price'		=> __('Price'),
			'ctm_extra_name_en'		=> __('Name (EN)'),
			'ctm_extra_name_en'		=> __('Name (EN)'),
			'ctm_server'			=> __('Server Status')
		);
	}
	public function get_sortable_columns() {
		return array(
			'ctm_extra_ID'			=> array('ctm_extra_ID'),
			'ctm_extra_description'	=> array('column_ctm_extra_description'),
			'ctm_extra_price'		=> array('ctm_extra_price'),
			'ctm_extra_name_en'		=> array('ctm_extra_name_en'),
			'ctm_extra_name_en'		=> array('ctm_extra_name_en'),
			'ctm_server'			=> array('ctm_server')
		);
	}
	function column_ctm_extra_description($item){

		$actions = array(
			'edit'      => '<a href="admin.php?page=vananava_extra_item_edit&ctm_extra_ID='.$item['ctm_extra_ID'].'">Edit</a>'
		);

		return $item['ctm_extra_description'].' '.$this->row_actions($actions);
	}	

}

abstract class Simple_WP_List_Table_Member extends WP_List_Table {
	private $per_page = 20;
	function __construct($options, $per_page = NULL) {
		global $status, $page;
		parent::__construct($options);
		if ($per_page) {
			$this->per_page = $per_page;
		}
	}
	function column_default($item, $column_name){
		return $item[$column_name];
	}
	function column_cb($item){
		return '<input type="checkbox" name="'.$this->_args['singular'].'" value="'.$item['id'].'" />';
	}
	function prepare_items() {
		global $wpdb;
		$table_vnnv_member = $wpdb->prefix . 'vnnv_order_items';
		
		$query = "SELECT DISTINCT order_item_name, order_item_email, order_item_phone, order_item_country";
		$query .= " FROM $table_vnnv_member WHERE";
		$query .= " order_server = 'production'";
		$orderby = !empty($_GET["orderby"]) ? $_GET["orderby"] : 'order_item_name';
		$order = !empty($_GET["order"]) ? $_GET["order"] : 'ASC';
		$search = ( isset( $_REQUEST['s'] ) ) ? $_REQUEST['s'] : false;
		$query .= ( $search ) ? $wpdb->prepare(" AND order_item_name LIKE '%%%s%%' ", $search ) : ''; 
		if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }
		$total_items = $wpdb->query($query);
		$paged = !empty($_GET["paged"]) ? $_GET["paged"] : '';
		if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }
		if(!empty($paged)){
			$offset=($paged-1)*$this->per_page;
			$query.=' LIMIT '.(int)$offset.','.(int)$this->per_page;
		}
		$current_page = $this->get_pagenum();
		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'total_pages' => ceil($total_items/$this->per_page),
			'per_page' => $this->per_page,
		) );
		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->process_bulk_action();
		$this->items = $wpdb->get_results($query, 'ARRAY_A');
		
		//print_r($query);
	}
	
	function display() {
		?>
		<form method="get">
			<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
			<?php $this->search_box('Search Member Name', 'search_id'); ?>
			<?php parent::display(); ?>
		</form>
		<?php
	}
}

class Member_List_Table extends Simple_WP_List_Table_Member {
	function __construct() {
		global $status, $page;
		parent::__construct(array(
			'singular'  => 'wp_list_co_promotion',
			'plural'    => 'wp_list_co_promotions',
			'ajax'		=> false
		), 20);
	}
	function get_columns() {
		return array(
			'order_item_name'		=> __('Name'),
			'order_item_email'		=> __('Email'),
			'order_item_phone'		=> __('Phone'),
			'order_item_country'	=> __('Country')
		);
	}
	public function get_sortable_columns() {
		return array(
			'order_item_name'		=> array('order_item_name'),
			'order_item_email'		=> array('order_item_email'),
			'order_item_phone'		=> array('order_item_phone'),
			'order_item_country'	=> array('order_item_country')
		);
	}
	function column_order_item_name($item){

		$actions = array(
			/*'edit'      => '<a href="admin.php?page=vananava_extra_item_edit&ctm_extra_ID='.$item['ctm_extra_ID'].'">Edit</a>'*/
		);

		return $item['order_item_name'].' '.$this->row_actions($actions);
	}	

}



function add_e2_date_picker(){
	//jQuery UI date picker file
	wp_enqueue_script('jquery-ui-datepicker');
	//jQuery UI theme css file
	wp_enqueue_style('e2b-admin-ui-css','http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css',false,"1.9.0",false);
}
add_action('admin_enqueue_scripts', 'add_e2_date_picker'); 
?>