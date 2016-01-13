<?php
include "header.php";
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
include_once 'functions.php';
sec_session_start();

var_dump($_SESSION);
if (!isset($_SESSION['id_u']))
	{
	die ("<p align='center' class='bk'>- Please login (1).</p>");
	}
if (!isset($_SESSION['User']))
	{
	die("<p align='center' class='bk'>- Please login (2).</p>");
	}
include "connect_db.php";
$sql="select `ID_user` from `farmers_stock`.`users` where `username`=:username;";
$sth=$dbh->prepare($sql);
$sth->bindParam(":username", $_SESSION["User"],PDO::PARAM_STR);
$sth->execute();
//$res=$sth->fetchAll();
//$res=query($sql) or die("<p align='center' class='bk'>Database error.</p>");
if ($sth->rowCount()==0)
	{
	die("<p align='center' class='bk'>- ERROR - on connecting to database (3).</p>");
	}
else
	{
	if ($sth->rowCount()>1)
		{
		die("<p align='center' class='bk'>- Error - on the database.</p>");
		}
		$row = $sth->fetchAll();//$row=mysql_fetch_row($res);
		echo "<br>";
print_r ($row);
	if ($row[0]['ID_user']!=$_SESSION['id_u'])
		{
		die("<p align='center' class='bk'>- ERROR - on connecting to database. (4)</p>");
		}
	}
if (isset($_POST['logout']))
	{
	unset ($_SESSION['id_u']);
	unset ($_SESSION['user']);
	//unset ($_SESSION['count']);
	print "<meta http-equiv='refresh' content='0;url=farmers_stock.php'>";
	}
if (isset($_POST['submit']))
	{
	$ID_req=$_GET['id'];
	$sql="delete from `ads` where `ID_req`=::ID_req";
	//query("delete from `farmers_stoch`.`ads` where `ID_req`='$ID_req'") or die (errorInfo());
		$sth=$dbh->prepare($sql);
		$sth->bindParam(":ID_req", $ID_req,PDO::PARAM_INT);
		$sth->execute();
	print "<meta http-equiv='refresh' content='0;url=add.php'>";
	}
?>
<p class="bkl" align="center">Add your announcement</p>
<hr align="center" color="#000000" width="100%">
<form name=adaug action="addeffect.php" method='post'>
  <table>
    <TD align="right">Field:</TD>
	<TD><select name="ID_field">
<?php
$sql="select * from field";
$sth=$dbh->prepare($sql);
$sth->execute();
$row = $sth->fetchALL();
$data=$row;
foreach($data as $row) {
	$id = $row['ID_field'];
	$content = $row['field_name'];
	print "<option value='".$id."'>".$content."</option>";
}
?>
	</select>
    <TR>
		<TD> Description of your ad:
		<TD><textarea name='anunt' cols="100" rows="10"></textarea></td>
	</tr>
	<tr>
		<td colspan="2"><input type='submit' value='Add your announcement'></td>
	</tr>
  </table>
</form>
<hr>
<?php
$sql="select `ID_req`, `ID_field`, `ad_text` from `farmers_stoch`.`ads` where id_user=:ID_user";
$sth=$dbh->prepare($sql);
$sth->bindParam(":ID_user", $_SESSION['id_u'],PDO::PARAM_INT);
$sth->execute();
//$res=$sth->query($sql);
if ($sth->rowCount()==0)
	{
	die("You have no ad published.");
	}
else
	{
	print "Existing ads:";
	}
while ($row = $sth->fetch(PDO::FETCH_ASSOC))
	{
	print "<hr>";
	$sql="select field_name from field where ID_field=:id_field";
		$sth=$dbh->prepare($sql);
		$sth->bindParam(":id_field", $row['ID_field']);
		$sth->execute();
		//$res=$sth->fetchAll();
	$roq=$sth->fetch(PDO::FETCH_ASSOC);
	print "<b>Field:</b> ".$roq[0]."<br /><b>Ad:</b>".$row[2]."<br /><br />";
	print "<form action='add.php?id=$row[0]' method='post'><input type='submit' name='submit' value='Delete'></form>";
	}
?>