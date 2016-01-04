<?php
session_start();
?>
<html>
<head>
<title>Add announcement</title>
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
<body>
<?php
if (!isset($_SESSION['id_u']))
	{
	die ("<p align='center' class='bk'>- ERROR - on connecting to database (1).</p>");
	}
if (!isset($_SESSION['user']))
	{
	die("<p align='center' class='bk'>- ERROR - on connecting to database (2).</p>");
	}
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
		die("<p align='center' class='bk'>- Error - on the database.</p>");
		}
	$row=mysql_fetch_row($res);
	if ($row[0]!=$_SESSION['id_u'])
		{
		die("<p align='center' class='bk'>- ERROR - on connecting to database. (4)</p>");
		}
	}
if (isset($_POST['logout']))
	{
	unset ($_SESSION['id_u']);
	unset ($_SESSION['user']);
	unset ($_SESSION['count']);
	print "<meta http-equiv='refresh' content='0;url=farmers_stock.php'>";
	}
if (isset($_POST['submit']))
	{
	$ID_req=$_GET['id'];
	mysql_query("delete from `ads` where `ID_req`='$ID_req'") or die (mysql_error());
	print "<meta http-equiv='refresh' content='0;url=add.php'>";
	}
?>
<center><form action="add.php" method="post"><input type="submit" name="logout" value="Logout">  ( iesire username ) </form></center>
<p class="bkl" align="center">Add your announcement</p>
<hr align="center" color="#000000" width="100%">
<form name=adaug action="addeffect.php" method='post'>
  <table>
    <TD align="right">Field:</TD>
	<TD><select name='ID_field'>
<?php
	$sql="select * from field";
	$res=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($res))
		{
		print "<option value='$row[0]'>$row[1]</option>";
		}
?>
	</select>
    <TR>
		<TD> Ad text: 
		<TD><textarea name='anunt' cols="100" rows="10"></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><input type='submit' value='Add your announcement'></td>
	</tr>
  </table>
</form>
<hr>
<?php
$sql="select `ID_req`, `ID_field`, `ad_text` from ads where id_user='$_SESSION[id_u]'";
$res=mysql_query($sql) or die (mysql_error());
if (mysql_num_rows($res)==0)
	{
	die("You have no ad published.");
	}
else
	{
	print "Existing ads:";
	}
while ($row=mysql_fetch_row($res))
	{
	print "<hr>";
	$sql="select `field_name` from `field` where `ID_field`='$row[1]'";
	$rez=mysql_query($sql);
	$roq=mysql_fetch_row($rez);
	print "<b>Field:</b> ".$roq[0]."<br /><b>Ad:</b>".$row[2]."<br /><br />";
	print "<form action='add.php?id=$row[0]' method='post'><input type='submit' name='submit' value='Delete'></form>";
	}
?>