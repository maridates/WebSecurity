
<html>
<head>
<title>Login</title>
<style>
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
<?php
include_once ('functions.php');
sec_session_start();

$previous =$_SERVER['HTTP_REFERER'];
$User = filter_input(INPUT_POST, 'User', FILTER_SANITIZE_STRING);
$Password=filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_STRING);//$_POST['Password'];
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
	//$sth->bindParam(":username", $_SESSION["username"],PDO::PARAM_STR);
	$sth->execute();
	if($sth->rowCount()==0)
		{
		print $sth->queryString;
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
			$row = $sth->fetch(PDO::FETCH_ASSOC);//$row=mysql_fetch_row($result);

		$salt=$row['salt'];
		$Password=hash("sha256",$salt.$Password);

		if ($Password!=$row['Password'])
			{
			//$_SESSION['count']++;
			print ("<p align='center' class='bk'>Incorrect User or Password!<br />- Error 3 -</p>");
			print "<meta http-equiv='refresh' content='2;url=$previous'>";
			die();
			}
			include_once 'functions.php';
			sec_session_start();
		$_SESSION['id_u']=$row['ID_user'];
		$_SESSION['User']=$row['username'];
		$login_session=$_SESSION['User'];
		//print_r($_SESSION);
		print "<meta http-equiv='refresh' content='0;url=$previous'>";
			//print "<meta http-equiv='refresh' content='0;url=showuserinfo.php?user=$login_session'>";

		}
?>
