<?php

add_action( 'admin_menu', 'admin_management_menu', 1);
function admin_management_menu() {
	add_menu_page('Vananava Magagement', 'Vana Manage', 'manage_options', 'vana_options', 'vananava_general','',0);
	add_submenu_page( 'vana-options', 'Theme menu label', 'Vana Setting', 'vana_options', 'vana_options', 'vananava_general');
  	add_submenu_page( 'vana_options', 'Settings page title', 'Settings menu label', 'manage_options', 'theme-op-settings', 'vananava_adminSeting');
	add_submenu_page( 'vana_options', 'FAQ page title', 'FAQ menu label', 'manage_options', 'theme-op-faq', 'vananava_faq');
	//add_submenu_page( 'vana_options', 'Vananava Huahin Ticket Order', 'Ticket Order', 'manage_options', 'vananava_order_view_order', 'vananava_ticketOrder');
}

// genernal function setting
function vananava_general(){
	echo('<h1>General Setting</h1>');
	require_once ('admin_GeneralSetting_function.php');
};

// admin function setting
function vananava_adminSeting(){
	echo('<h1>Admin Setting</h1>');
	require_once ('admin_AdminSetting_function.php');
};

// website FAQ
function vananava_faq(){
	echo('<h1>FAQ</h1>');
};

// Ticket order
//function vananava_ticketOrder(){
	//echo('<h1>Booking Order Setting</h1>');
	//require_once ('../functions.php');
	

	// $myListTable = new My_List_Table();
	// echo '<div class="wrap"><h2>My List Table Test</h2>'; 
	// $myListTable->prepare_items(); 
	// $myListTable->display(); 
	// echo '</div>'; 
//};
