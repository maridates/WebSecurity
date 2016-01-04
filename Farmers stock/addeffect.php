<?php
session_start();
if (!isset($_SESSION['id_u']))
	{
	die ("<p align='center' class='bk'>- ERROR - on connecting to database (1).</p>");
	}
if (!isset($_SESSION['user']))
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
$sql="select `ID_user` from `users` where username='$_SESSION[user]';";
$res=mysql_query($sql) or die("<p align='center' class='bk'>Database error.</p>");
if (mysql_num_rows($res)==0)
	{
	die("<p align='center' class='bk'>- ERROR - on connecting to database (3).</p>");
	}
else
	{
	if (mysql_num_rows($res)>1)
		{
		die("<p align='center' class='bk'>- Error in the database.</p>");
		}
	$row=mysql_fetch_row($res);
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
$q="INSERT INTO ads (id_field, id_user, ad_text) VALUES('$id_domain', '$_SESSION[id_u]','$anunt')";
mysql_query($q);
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
