<?php
add_action('admin_bar_menu', 'create_top_menu', 2000);
function create_top_menu() {
	global $wp_admin_bar;

	$menu_id = 'VANA';
	$wp_admin_bar->add_menu(array('id' => $menu_id, 'title' => '<span class="ab-icon dashicons dashicons-carrot"></span>'.__('Vana Quick'), 'href' => '#'));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Booking Order'), 'id' => 'web_order', 'href' => '/wp-admin/admin.php?page=vananava_order'),1);
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Booking Page'), 'id' => 'web_booking', 'href' => '/online-booking'),0);
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Post Drafts'), 'id' => 'web_drafts', 'href' => '/wp-admin/edit.php?post_status=draft&post_type=post'));
	$wp_admin_bar->add_menu(array('parent' => $menu_id, 'title' => __('Post'), 'id' => 'post', 'href' => '/wp-admin/edit.php'));
	$wp_admin_bar->add_menu(array('parent' => 'post', 'title' => __('Post Promotion EN'), 'id' => 'web_pro_en', 'href' => '/wp-admin/edit.php?s&post_status=all&post_type=post&action=-1&m=0&cat=8&filter_action=Filter&paged=1&action2=-1'));
	$wp_admin_bar->add_menu(array('parent' => 'post', 'title' => __('Post Promotion TH'), 'id' => 'web_pro_th', 'href' => '/wp-admin/edit.php?s&post_status=all&post_type=post&action=-1&m=0&cat=97&filter_action=Filter&paged=1&action2=-1'));
	$wp_admin_bar->add_menu(array('parent' => 'post', 'title' => __('Post Privilege EN'), 'id' => 'web_pri_en', 'href' => '/wp-admin/edit.php?s&post_status=all&post_type=post&action=-1&m=0&cat=112&filter_action=Filter&paged=1&action2=-1'));
	$wp_admin_bar->add_menu(array('parent' => 'post', 'title' => __('Post Privilege TH'), 'id' => 'web_pri_th', 'href' => '/wp-admin/edit.php?s&post_status=all&post_type=post&action=-1&m=0&cat=116&filter_action=Filter&paged=1&action2=-1'));

}