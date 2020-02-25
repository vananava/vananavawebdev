<?php
require "../wp-config.php";

$BookingTypeId = CENTAMAN_BOOKING_TYPE_ID;

$pick_date = $_SESSION['pick_date'];
if(!$pick_date) $_SESSION['pick_date'] = $pick_date = date('d/m/Y', strtotime("+2 days"));

echo json_encode($_SESSION);
exit;
?>