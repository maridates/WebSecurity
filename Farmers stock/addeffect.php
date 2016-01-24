<?php include "header.php";
?>
<html>
<head>
	<title>Add your announcement</title>
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
		img{
			height: 15vw;
			width: 15vw;
		}
		img.no{
			height: 5vw;
			width: 5vw;
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
<?php
include_once 'functions.php';
sec_session_start();
if (!isset($_SESSION['id_u']))
{
	die ("<p align='center' class='bk'>- ERROR - on connecting to database (1).</p>");
}
if (!isset($_SESSION['User']))
{
	die("<p align='center' class='bk'>- ERROR - on connecting to database (2).</p>");
}
include "connect_db.php";
$sql="select `ID_user` from `users` where username=:sess";
$sth=$dbh->prepare($sql);
$sth->bindParam(":sess",$_SESSION['User']);
$sth->execute();
if ($sth->rowCount()==0)
{
	die("<p align='center' class='bk'>- ERROR - on connecting to database (3).</p>");
}
else
{
	if ($sth->rowCount()>1)
	{
		die("<p align='center' class='bk'>- Error in the database.</p>");
	}
	$row=$sth->fetchALL(PDO::FETCH_ASSOC);
	if ($row[0]['ID_user']!=$_SESSION['id_u'])
	{
		die("<p align='center' class='bk'>- ERROR - on connecting to database. (4)</p>");
	}
}
$id_domain=$_POST['ID_field'];
$anunt = htmlentities($_POST['anunt']);
if (!trim($id_domain))
{
	die ("<p align='center' class='bk'>- ERROR - on connecting to database (1).</p>");
}
if (!trim($anunt))
{
	print "<p align='center' class='bk'>Please insert an ad!</p>";
	print "<meta http-equiv='refresh' content='2;url=add.php'>";
	die();
}
$q="INSERT INTO ads (id_field, id_user, ad_text) VALUES(:id_field, :sess, :ad)";
$sth=$dbh->prepare($q);
$sth->bindParam(":id_field",$id_domain);
$sth->bindParam(":sess",$_SESSION['id_u']);
$sth->bindParam(":ad",$anunt);
$sth->execute();
?>
<body background="pictures/background.jpg">
<div style="padding-top: 70px">
<p> Your ad was successfully added.</p>
<p>Thank you for choosing us.</p>
<a href="farmers_stock.php">Homepage</a>
<br>
<p>If you want to insert another ad please click here</p>
<a href="add.php">INSERT ANOTHER AD / View all ads</a>
</body>
</html>
