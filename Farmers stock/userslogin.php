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
//if (strlen($_SESSION['count'])==0)
//	{
//	$_SESSION['count']=0;
//	}
//else
//	{
//	if ($_SESSION['count']>2)
//		{
//		die ("<p align='center' class='bk'>- ERROR - on connecting to database.</p>");
//		}
//	}
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
	$sql="select `ID_user`, `username`, `Password`, `salt` from `farmers_stock`.`users` where `username`=:username";
	$sth=$dbh->prepare($sql);
	$sth->bindParam(":username",$User);
	//$sth->bindParam(":username", $_SESSION["username"],PDO::PARAM_STR);
	$sth->execute();
	//$result=$sth->fetchAll();
	//$result = query ("select `ID_user`, `username`, `Password` from `farmers_stock`.`users` where `username`='$User';") or die (errorInfo());
	if($sth->rowCount()==0)
		{
		print $sth->queryString;
		print ("<p align='center' class='bk'>Incorrect User or Password!<br />- Error 1 -</p>");
		print "<meta http-equiv='refresh' content='2;url=sellers.php'>";
		die();
		}
	else
		{
		if ($sth->rowCount()>1)
			{
			print ("<p align='center' class='bk'>Database error!<br />- Error 2 -</p>");
			print "<meta http-equiv='refresh' content='2;url=sellers.php'>";
			die();
			}
			$row = $sth->fetch(PDO::FETCH_ASSOC);//$row=mysql_fetch_row($result);

		$salt=$row['salt'];
		$Password=hash("sha256",$salt.$Password);

		if ($Password!=$row['Password'])
			{
			//$_SESSION['count']++;
			print ("<p align='center' class='bk'>Incorrect User or Password!<br />- Error 3 -</p>");
			print "<meta http-equiv='refresh' content='2;url=sellers.php'>";
			die();
			}
		//$_SESSION['id_u']=$row[0];
		//$_SESSION['user']=$row[1];
		//print "<meta http-equiv='refresh' content='0;url=add.php'>";
		}
?>