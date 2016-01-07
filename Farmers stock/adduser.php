<html>
<head>
	<title>Users Register</title>
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
<body background="pictures/boiler_of_soul_by_Feni_x.jpg" tracingsrc="pictures/boiler_of_soul_by_Feni_x.jpg" tracingopacity="80">
<?php
if (!isset ($_POST['submit']))
{
?>
<form action="adduser.php" method="post">
	<table align="center" class="bk">
		<tr>
			<TD colspan="2" align="center" class="bkl"><a href="javascript:parent.close();">Close</a></TD>
		</TR>
		<tr>
			<td colspan="2" align="center" class="bkl"><b>Register</b></td>
		</tr>
		<TR>
			<TD align="right" class="bkl"><FONT face="verdana" size=2><b>Username:</b></FONT></TD>
			<TD class="bkl">&nbsp;<input type="text" name="username" size="30"></TD>
		</tr>
		<tr>
			<TD align="right" class="bkl"><FONT face="verdana" size=2><b>Password User:</b></FONT></TD>
			<TD class="bkl">&nbsp;<input type="password" name="Password" size="30"></TD>
		</tr>
		<tr>
			<TD align="right" class="bkl"><FONT face="verdana" size=2><b>Password User:</b></FONT></TD>
			<TD class="bkl">&nbsp;<input type="password" name="Password2" size="30"></TD>
		</tr>
		<TR>
			<TD align="right" class="bkl"><FONT face="verdana" size=2><b>Surname:</b></FONT></TD>
			<TD class="bkl">&nbsp;<input type="text" name="Surname" size="30"></TD>
		</TR>
		<tr>
			<TD align="right" class="bkl"><FONT face="verdana" size=2><b>Firstname:</b></FONT></TD>
			<TD class="bkl">&nbsp;<input type="text" name="Firstname" size="30"></TD>
		</TR>
		<tr>
			<TD align="right" class="bkl"><FONT face="verdana" size=2><b>Address:</b></TD>
			<TD class="bkl">&nbsp;<input type="text" name="Address" size="30"></TD>
		</TR>
		<tr>
			<TD align="right" class="bkl"><FONT face="verdana" size=2><b>Phone</b></FONT></TD>
			<TD class="bkl">&nbsp;<input type="text" name="phone" size="30"></TD>
		</TR>
		<tr>
			<TD colspan="2" align="center" class="bkl"><input type="reset" value="Reset"></TD>
		</tr>
		<tr>
			<TD colspan="2" align="center" class="bkl"><input type="submit" value="Validate" name="submit"></TD>
		</TR>
	</table>
	<?php
	}
	else
	{
		$username=$_POST['username'];
		$Password=$_POST['Password'];
		$Password2=$_POST['Password2'];
		$Surname=$_POST['Surname'];
		$Firstname=$_POST['Firstname'];
		$Address=$_POST['Address'];
		$phone=$_POST['phone'];
		if(!trim($username))
		{
			print ("<p align='center' class='bk'>You have to insert USERNAME !<br />- ERROR -</p>");
			print "<meta http-equiv='refresh' content='2;url=adduser.php'>";
			die();
		}
		include "connect_db.php";
		$sql="select `username` from `farmers_stock`.`users` where `username`=:username";
		$sth=$dbh->prepare($sql);
		$sth->bindParam(":username", $username);
		$sth->execute();
		//$res=$sth->fetchAll();
		//$res = $sth->fetchAll(PDO::FETCH_ASSOC);
		$sth->fetchAll(PDO::FETCH_ASSOC);
		//$res=query($sql) or die (errorInfo()); $stmt->rowCount()
		if ($sth->rowCount()!==0)
		{
			print "<p align='center' class='bk'>Username already registered !<br />- ERROR -</p>";
			print "<meta http-equiv='refresh' content='2;url=adduser.php'>";
			die();
		}
		if (!trim($Password))
		{
			print ("<p align='center' class='bk'>You have to choose a Password !<br />- ERROR -</p>");
			print "<meta http-equiv='refresh' content='2;url=adduser.php'>";
			die();
		}
		if (!trim($Password2))
		{
			print ("<p align='center' class='bk'>You have to insert the password the second time!<br />- ERROR -</p>");
			print "<meta http-equiv='refresh' content='2;url=adduser.php'>";
			die();
		}
		if ($Password!=$Password2)
		{
			print ("<p align='center' class='bk'>You have to insert the Password two times!<br />- ERROR -</p>");
			print "<meta http-equiv='refresh' content='2;url=adduser.php'>";
			die();
		}
		if(!trim($Surname))
		{
			print ("<p align='center' class='bk'>You have to insert surname!<br />- ERROR -</p>");
			print "<meta http-equiv='refresh' content='2;url=adduser.php'>";
			die();
		}
		if(!trim($Firstname))
		{
			print ("<p align='center' class='bk'>You have to insert Firstname !<br />- ERROR -</p>");
			print "<meta http-equiv='refresh' content='2;url=adduser.php'>";
			die();
		}
		if(!trim($Address))
		{
			print ("<p align='center' class='bk'>You have to insert an Address !<br />- ERROR -</p>");
			print "<meta http-equiv='refresh' content='2;url=adduser.php'>";
			die();
		}
		if (!trim($phone))
		{
			print ("<p align='center' class='bk'>You have to insert Phone number !<br />- ERROR -</p>");
			print "<meta http-equiv='refresh' content='2;url=adduser.php'>";
			die();
		}
		$Password=hash("sha256",$Password);
		$interogare="INSERT INTO farmers_stock.users (username, password, last_name, first_name, address, phone) VALUES (:username, :Password, :Surname, :Firstname, :Address, :phone)";
		try {
			$sth = $dbh->prepare($interogare);
			$sth->bindParam(":username", $username);
			$sth->bindParam(":Password", $Password);
			$sth->bindParam(":Surname", $Surname);
			$sth->bindParam(":Firstname", $Firstname);
			$sth->bindParam(":Address", $Address);
			$sth->bindParam(":phone", $phone);
			//$sth->bindParam(":username", $_SESSION["username"],PDO::PARAM_STR);
			$sth->execute();
		}
		catch ( PDOException $exception )
		{
			echo "PDO error :" . $exception->getMessage();
		}
		//query($interogare) or die (errorInfo());
		print '<p align="center" class="bk">The data were inserted!';
		print '<br /><a href="javascript:parent.close();">Close window -  go to your account</a></p>';
	}
	?>
	<p><font color="#0066CC" face="Comic Sans MS">Register Instructions </font></p>
	<p><font color="#0066CC" face="Comic Sans MS">In order to insert an ad you have to be registered</font></p>
	<p><font color="#0066CC" face="Comic Sans MS">Your username /
			Password will remain strictly confidential</font></p>
</body>
</html>