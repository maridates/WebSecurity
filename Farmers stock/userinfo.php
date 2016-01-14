<html>
<?php
$usr=$_GET['user'];
if (!trim($usr))
	{
	die ();
	}
?>
<head>
<title>User: <? echo $usr; ?></title>
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
</body>
<p align="center" class="bk"><button onclick="javascript:parent.close();">Close</button></p>
<table class="bkl" align="center">
<tr>
	<td align="center" class="bk" colspan="2"><b>User Info</b></td>
</tr>
<?
include "connect_db.php";
$sql="select last_name, first_name, address, phone from farmers_stock.users where username=:username";
$sth->bindParam(":username",$usr);
$sth=$dbh->prepare($sql);
$sth->execute();
$res=$sth->query($sql);
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
	$row=$sth->fetch(PDO::FETCH_ASSOC);
	}
?>
<tr>
	<td align="right" class="bk">Name:</td>
	<td class="bk">&nbsp;<? echo $row[0]; ?></td>
</tr>
<tr>
	<td align="right" class="bk">Surname:</td>
	<td class="bk">&nbsp;<? echo $row[1]; ?></td>
</tr>
<tr>
	<td align="right" class="bk">Adress:</td>
	<td class="bk">&nbsp;<? echo $row[2]; ?></td>
</tr>
<tr>
	<td align="right" class="bk">Phone:</td>
	<td class="bk">&nbsp;<? echo $row[3]; ?></td>
	
</tr>
</table>

<table width="50%" border="0" align="center">
  <tr>
 <TD align="CENTER"><a onclick="window.print();"><img src="pictures/Printer.png" width="81" height="81" border="0" align="absmiddle"></a></TD>
  </tr>
</table>

