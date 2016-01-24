
<html>
<head>
	<link rel="shortcut icon" href="pictures/favicon.ico">
	<style>
		body {
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: center;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
		.bk
		{
			background-color: #DFDFDF;
		}
		.bkl
		{
			background-color: #AFAFAF;
		}
	</style>
</head>
<body background="pictures/background.jpg">
<?php
include_once ('functions.php');
sec_session_start();

$previous =$_SERVER['HTTP_REFERER'];
$User = filter_input(INPUT_POST, 'User', FILTER_SANITIZE_STRING);
$Password=filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);
if (!trim($User))
{
	print ("<p align='center' class='bk'>You have to insert the username!<br />- Error -</p>");
	print "<meta http-equiv='refresh' content='2;url=$previous'>";
	die();
}
if (!trim($Password))
{
	print ("<p align='center' class='bk'>You have to insert the Password !<br />- Error -</p>");
	print "<meta http-equiv='refresh' content='2;url=$previous'>";
	die();
}
include "connect_db.php";
$sql="select `ID_user`, `username`, `Password`, `salt` from `farmers_stock`.`users` where `username`=:username";
$sth=$dbh->prepare($sql);
$sth->bindParam(":username",$User);
$sth->execute();
if($sth->rowCount()==0)
{
	print ("<p align='center' class='bk'>Incorrect User or Password!<br />- Error 1 -</p>");
	print "<meta http-equiv='refresh' content='2;url=$previous'>";
	die();
}
else
{
	if ($sth->rowCount()>1)
	{
		print ("<p align='center' class='bk'>Database error!<br />- Error 2 -</p>");
		print "<meta http-equiv='refresh' content='2;url=$previous'>";
		die();
	}
	$row = $sth->fetch(PDO::FETCH_ASSOC);

	$salt=$row['salt'];
	$Password=hash("sha256",$salt.$Password);

	if ($Password!=$row['Password'])
	{
		print ("<p align='center' class='bk'>Incorrect User or Password!<br />- Error 3 -</p>");
		print "<meta http-equiv='refresh' content='2;url=$previous'>";
		die();
	}
	include_once 'functions.php';
	sec_session_start();
	$_SESSION['id_u']=$row['ID_user'];
	$_SESSION['User']=$row['username'];
	$login_session=$_SESSION['User'];

	print "<meta http-equiv='refresh' content='0;url=$previous'>";

}
?>
