<?php
include "header.php";
?>
	<html>
	<head>
		<title>Add announcement</title>
		<link rel="shortcut icon" href="pictures/favicon.ico">
		<style>
			.bk
			{
				background-color: #ADFF2F;
			}
			.bkl
			{
				background-color: #AFAFAF;
			}
			body {
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-position: center;
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}
			table.top {
				margin-top: 10%;
			}
			p.one {
				margin-right: 50px;
				margin-left: 50px;
			}
			img{
				height: 15vw;
				width: 15vw;
			}
			img.no{
				height: 5vw;
				width: 5vw;
			}
		</style>
	</head>
<body background="pictures/background.jpg">
	<div style="padding-top: 80px;">
<?php
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
	$row = $sth->fetchAll();
	echo "<br>";
	if ($row[0]['ID_user']!=$_SESSION['id_u'])
	{
		die("<p align='center' class='bk'>- ERROR - on connecting to database. (4)</p>");
	}
}
if (isset($_POST['logout']))
{
	unset ($_SESSION['id_u']);
	unset ($_SESSION['user']);
	print "<meta http-equiv='refresh' content='0;url=farmers_stock.php'>";
}
if (isset($_POST['submit']))
{
	$ID_req=$_GET['id'];
	$sql="delete from `ads` where `ID_req`=::ID_req";
	$sth=$dbh->prepare($sql);
	$sth->bindParam(":ID_req", $ID_req,PDO::PARAM_INT);
	$sth->execute();
	print "<meta http-equiv='refresh' content='0;url=add.php'>";
}
?>
	<p style="padding-top: 35px" class="bkl" align="center">Add your announcement</p>
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
					<TD><textarea style=" background-color: #e2e4f3" name='anunt' cols="100" rows="10"></textarea></td>
				</tr>
				<tr>
					<td colspan="2"><input type='submit' value='Add your announcement'></td>
				</tr>
		</table>
	</form>
	<hr>
<?php //`ID_req`, for requests
$sql1="select `ID_field`, `ad_text` from `ads` where id_user=:ID_user ORDER BY `ID_field` ASC";
$sth1=$dbh->prepare($sql1);
$sth1->bindParam(":ID_user", $_SESSION['id_u'],PDO::PARAM_INT);
$sth1->execute();
if ($sth->rowCount()==0)
{
	die("You have no ad published.");
}
else
{
	print "Existing ads:";
}
while ($row1 = $sth1->fetchALL(PDO::FETCH_ASSOC))
{
	for ($i=0; $i<$sth1->rowCount(); $i++) {
		print "<hr>";
		$sql = "select field_name from field where ID_field=:id_field";
		$sth = $dbh->prepare($sql);
		$sth->bindParam(":id_field", $row1[$i]['ID_field']);
		$sth->execute();
		$roq = $sth->fetch(PDO::FETCH_ASSOC);
		print "<b>Field:</b> " . $roq['field_name'] . "<br /><b>Ad:</b>" . $row1[$i]['ad_text'] . "<br /><br />";
		print "<form action='add.php?id=" . $row1[$i]['ID_field'] . "' method='post'><input type='submit' name='submit' value='Delete'></form>";
	}
	}
?>
		</div>
</body>
	</html>
