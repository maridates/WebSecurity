<?php include "header.php";
?>
<html>
<?php
$usr=htmlspecialchars($_GET['user']);
if (!trim($usr))
	{
	die ();
	}
?>
<head>
<title>User: <? echo $usr; ?></title>
	<link rel="shortcut icon" href="pictures/favicon.ico">
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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body bgcolor="#CCCCCC">
<p style="padding-top: 80px;" align="center" class="bk"><button onclick="javascript:parent.close();">Close</button></p>
<table class="bkl" align="center">
<tr>
	<td align="center" class="bk" colspan="2"><b>User Info</b></td>
</tr>
<?php
include "connect_db.php";
$sql="select last_name, first_name, address, phone from farmers_stock.users where ID_user=:user";
$sth=$dbh->prepare($sql);
$sth->bindParam(":user",$usr);
$sth->execute();
if ($sth->rowCount()==0)
	{
	die();
	}
else
	{
	if ($sth->rowCount()>1)
		{
		die ("<p align='center' class='bkl'>Database error.</p>");
		}
	$row=$sth->fetchALL(PDO::FETCH_ASSOC);
	}
?>
<tr>
	<td align="right" class="bk">Last name:</td>
	<td class="bk">&nbsp;<?php echo $row[0]['last_name']; ?></td>
</tr>
<tr>
	<td align="right" class="bk">First name:</td>
	<td class="bk">&nbsp;<?php echo $row[0]['first_name']; ?></td>
</tr>
<tr>
	<td align="right" class="bk">Address:</td>
	<td class="bk">&nbsp;<?php echo $row[0]['address']; ?></td>
</tr>
<tr>
	<td align="right" class="bk">Phone:</td>
	<td class="bk">&nbsp;<?php echo $row[0]['phone']; ?></td>
	
</tr>
</table>

<table width="50%" border="0" align="center">
  <tr>
 <TD align="CENTER"><a onclick="window.print();"><img src="pictures/Printer.png" width="81" height="81" border="0" align="absmiddle"></a></TD>
  </tr>
</table>

