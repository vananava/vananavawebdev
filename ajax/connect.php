<?php
$hostname = "localhost"; 
$user = "vana2019"; 
$password = "28G?p3do";
$dbname = "vana2019";

mysql_connect($hostname, $user, $password) or die("Can't connect to Database");
mysql_select_db($dbname) or die("Can't select to Database");
mysql_query("SET character_set_results=utf8");
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
?>