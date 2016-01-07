<?php
/*$host="localhost";
$user="root";
$pass="";
$dbas="farmers_stock";
mysql_connect($host,$user,$pass) or die (myssql_error());
mysql_select_db($dbas) or die (errorInfo());*/
$dbh=new PDO('mysql:host:localhost:8889','root','soft1234');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
