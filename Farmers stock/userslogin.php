<?
session_start();
?>
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
if (strlen($_SESSION['count'])==0)
	{
	$_SESSION['count']=0;
	}
else
	{
	if ($_SESSION['count']>2)
		{
		die ("<p align='center' class='bk'>- ERROR - on connecting to database.</p>");
		}
	}
$User=$_POST['User'];
$Password=$_POST['Password'];
if (!trim($User))
	{
	print ("<p align='center' class='bk'>You have to insert the username!<br />- Error -</p>");
	print "<meta http-equiv='refresh' content='2;url=sellers.php'>";
	die();
	}
if (!trim($Password))
	{
	print ("<p align='center' class='bk'>You have to insert the Password !<br />- Error -</p>");
	print "<meta http-equiv='refresh' content='2;url=sellers.php'>";
	die();	
	}
	include "connect_db.php";
	$Password=md5($Password);
	$rezultat = mysql_query ("select `ID_user`, `username`, `Password` from `users` where `username`='$User';") or die (mysql_error());
	if(mysql_num_rows($rezultat)==0)
		{
		print ("<p align='center' class='bk'>Incorrect User or Password!<br />- Error -</p>");
		print "<meta http-equiv='refresh' content='2;url=sellers.php'>";
		die();
		}
	else
		{
		if (mysql_num_rows($rezultat)>1)
			{
			print ("<p align='center' class='bk'>Database error!<br />- Error -</p>");
			print "<meta http-equiv='refresh' content='2;url=sellers.php'>";
			die();
			}
		$row=mysql_fetch_row($rezultat);
		if ($Password!=$row[2])
			{
			$_SESSION['count']++;
			print ("<p align='center' class='bk'>Incorrect User or Password!<br />- Error -</p>");
			print "<meta http-equiv='refresh' content='2;url=sellers.php'>";
			die();
			}
		$_SESSION['id_u']=$row[0];
		$_SESSION['user']=$row[1];
		print "<meta http-equiv='refresh' content='0;url=add.php'>";
		}
?>