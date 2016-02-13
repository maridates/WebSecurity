<html>
<head>
	<title>Users Register</title>
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
			margin-top: 18%;
		}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body background="pictures/background.jpg">

<?php
$username=htmlentities($_POST['username']);
$Password=htmlentities($_POST['Password']);
$Password2=htmlentities($_POST['Password2']);
$Surname=htmlentities($_POST['Surname']);
$Firstname=htmlentities($_POST['Firstname']);
$Address=htmlentities($_POST['Address']);
$phone=htmlentities($_POST['phone']);
if(!trim($username))
{
	print ("<p align='center' class='bk'>You have to insert USERNAME !<br />- ERROR -</p>");
	print "<meta http-equiv='refresh' content='2;url=register.php'>";
	die();
}
include "connect_db.php";
$sql="select `username` from `farmers_stock`.`users` where `username`=:username";
$sth=$dbh->prepare($sql);
$sth->bindParam(":username", $username);
$sth->execute();
$sth->fetchAll(PDO::FETCH_ASSOC);
if ($sth->rowCount()!==0)
{
	print "<p align='center' class='bk'>Username already registered !<br />- ERROR -</p>";
	print "<meta http-equiv='refresh' content='2;url=register.php'>";
	die();
}
if (!trim($Password))
{
	print ("<p align='center' class='bk'>You have to choose a Password !<br />- ERROR -</p>");
	print "<meta http-equiv='refresh' content='2;url=register.php'>";
	die();
}
if (!trim($Password2))
{
	print ("<p align='center' class='bk'>You have to insert the password the second time!<br />- ERROR -</p>");
	print "<meta http-equiv='refresh' content='2;url=register.php'>";
	die();
}
if ($Password!=$Password2)
{
	print ("<p align='center' class='bk'>You have to insert the Password two times!<br />- ERROR -</p>");
	print "<meta http-equiv='refresh' content='2;url=register.php'>";
	die();
}
if(!trim($Surname))
{
	print ("<p align='center' class='bk'>You have to insert surname!<br />- ERROR -</p>");
	print "<meta http-equiv='refresh' content='2;url=register.php'>";
	die();
}
if(!trim($Firstname))
{
	print ("<p align='center' class='bk'>You have to insert Firstname !<br />- ERROR -</p>");
	print "<meta http-equiv='refresh' content='2;url=register.php'>";
	die();
}
if(!trim($Address))
{
	print ("<p align='center' class='bk'>You have to insert an Address !<br />- ERROR -</p>");
	print "<meta http-equiv='refresh' content='2;url=register.php'>";
	die();
}
if (!trim($phone))
{
	print ("<p align='center' class='bk'>You have to insert Phone number !<br />- ERROR -</p>");
	print "<meta http-equiv='refresh' content='2;url=register.php'>";
	die();
}
$salt=rand(1000,9999);
$Password=hash("sha256",$salt.$Password);
$interogare="INSERT INTO farmers_stock.users (username, password, last_name, first_name, address, phone, salt) VALUES (:username, :Password, :Surname, :Firstname, :Address, :phone, :salt)";
try {
	$sth = $dbh->prepare($interogare);
	$sth->bindParam(":username", $username);
	$sth->bindParam(":Password", $Password);
	$sth->bindParam(":Surname", $Surname);
	$sth->bindParam(":Firstname", $Firstname);
	$sth->bindParam(":Address", $Address);
	$sth->bindParam(":phone", $phone);
	$sth->bindParam(":salt", $salt);
	$sth->execute();
}
catch ( PDOException $exception )
{
	echo "PDO error :" . $exception->getMessage();
}
print '<p align="center" class="bk">The data were inserted!';
print '<br /><a href="farmers_stock.php">Close window -  go to your account</a></p>';
?>
<p align="center"><font face="Comic Sans MS">Register Instructions </font></p>
<p align="center"><font face="Comic Sans MS">In order to insert an ad you have to be registered</font></p>
<p align="center"><font face="Comic Sans MS">Your username /
		Password will remain strictly confidential</font></p>
</body>
</html>