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
$sql="select Surname, Firstname, Address, phone from users where username='$usr'";
$res=mysql_query($sql) or die (mysql_error());
if (mysql_num_rows($res)==0)
	{
	die();
	}
else
	{
	if (mysql_num_rows($res)>1)
		{
		die ("<p align='center' class='bkl'>Database error.</p>");
		}
	$row=mysql_fetch_row($res);
	}
?>
<tr>
	<td align="right" class="bk">Surname:</td>
	<td class="bk">&nbsp;<? echo $row[0]; ?></td>
</tr>
<tr>
	<td align="right" class="bk">Firstname:</td>
	<td class="bk">&nbsp;<? echo $row[1]; ?></td>
</tr>
<tr>
	<td align="right" class="bk">Address:</td>
	<td class="bk">&nbsp;<? echo $row[2]; ?></td>
</tr>
<tr>
	<td align="right" class="bk">Phone:</td>
	<td class="bk">&nbsp;<? echo $row[3]; ?></td>
	
</tr>
</table>

<table width="50%" border="0" align="center">
  <tr>
 <TD align="CENTER"<img src="pictures/Printer.png" width="81" height="81" border="0" align="absmiddle"> PRINT </TD>
  </tr>
</table>

