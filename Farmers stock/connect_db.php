<?php
$host="localhost";
$user="root";
$pass="";
$dbas="farmers_stock";
mysql_connect($host,$user,$pass) or die (myssql_error());
mysql_select_db($dbas) or die (mysql_error());
?>