<?php
require "../wp-config.php";

$key	=	$_REQUEST['key'];
$value	=	$_REQUEST['value'];

$_SESSION[$key] = $value;

echo json_encode($_SESSION);
exit;
?>