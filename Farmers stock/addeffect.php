<?php
session_start();
if (!isset($_SESSION['id_u']))
	{
	die ("<p align='center' class='bk'>- ERROR - on connecting to database (1).</p>");
	}
if (!isset($_SESSION['User']))
	{
	die("<p align='center' class='bk'>- ERROR - on connecting to database (2).</p>");
	}
?>
<html>
<head>
<title>Add your announcement</title>
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
include "connect_db.php";
$sql="select `ID_user` from `users` where username=:sess";
$sth=$dbh->prepare($sql);
$sth->bindParam(":sess",$_SESSION['User']);
$sth->execute();
$res=$sth->query($sql) or die("<p align='center' class='bk'>Database error.</p>");
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
	$row=$sth->fetch(PDO::FETCH_ASSOC);//mysql_fetch_row($res);
	if ($row[0]!=$_SESSION['id_u'])
		{
		die("<p align='center' class='bk'>- ERROR - on connecting to database. (4)</p>");
		}
	}
$id_domain=$_POST['id_domain'];
$anunt=$_POST['anunt'];
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
//query($q);
?>
<body bgcolor="#CCCCCC">
<p> Your ad was succesful added.</p>
<p>Thank you for choosing us.</p>
<a href="farmers_stock.php">Homepage</a>
<br>
<p>If you want to insert another ad please click here</p>
<a href="add.php">INSERT ANOTHER AD / View all ads</a>
</body>
</html>
