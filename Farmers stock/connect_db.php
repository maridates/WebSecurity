<?php
/*$host="localhost";
$user="root";
$pass="";
$dbas="farmers_stock";
mysql_connect($host,$user,$pass) or die (myssql_error());
mysql_select_db($dbas) or die (errorInfo());*/
//$dbh=new PDO('mysql:host:localhost','root','');
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/* Connect to an ODBC database using driver invocation */
$dsn = 'mysql:dbname=farmers_stock;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>