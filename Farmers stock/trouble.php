<?
sec_session_start();
?><head>
	<title>Management</title>
	<link rel="shortcut icon" href="pictures/favicon.ico">
	<style>
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
			bgcolor= #ADFF2F;
			margin-top: 18%;
		}
		p.one {
			margin-right: 50px;
			margin-left: 50px;
		}

		.bk
		{
			background-color: #ADFF2F;
		}
		.bkl
		{
			background-color: #ADFF2F;
		}
	</style>
</head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<body background="pictures/background.jpg" onload="document.login.adm.focus();">
<?
if (!isset($_SESSION[adm]))
{
	if (isset ($_POST[submit]))
	{
		include "connect_db.php";
		$sql="select * from farmers_stoch.admin";
		$sth=$dbh->prepare($sql);
		$sth->execute();
		$res=$sth->fetchAll();
		if ($sth->rowCount()==0)
		{
			die();
		}
		else
		{
			if ($sth->rowCount()>1)
			{
				die();
			}
			else
			{
				$adm=$_POST[adm];
				$pss=$_POST[pss];
				$salt=$row['salt'];
				$pss=hash("sha256",$salt.$pss);
				$row = $sth->fetch(PDO::FETCH_ASSOC);
				if ($row[0]!=$adm)
				{
					die("<meta http-equiv='refresh' content='0;url=trouble.php'>");
				}
				if ($row[1]!=$pss)
				{
					die("<meta http-equiv='refresh' content='0;url=trouble.php'>");
				}
				$_SESSION[adm]=$row[0];
				$_SESSION[pss]=$row[1];
				print "<meta http-equiv='refresh' content='0;url=trouble.php'>";
			}
		}
	}
	else
	{
		?>
		<p align='center' class='bk'><a href='.'>Index</p>
		<form action='trouble.php' method='post' name='login' autocomplete="off">
			<table align='center' class='bkl'>
				<tr><td colspan='2' align='center' class='bk'><b>Login</b></td></tr>
				<tr>
					<td align='right' class='bk'>User:</td>
					<td class='bk'><input type='text' name='adm'></td>
				</tr>
				<tr>
					<td align='right' class='bk'>Password:</td>
					<td class='bk'><input type='password' name='pss'></td>
				</tr>
				<tr><td colspan='2' align='center' class='bk'><input type='submit' name='submit' value='login'></td></tr>
			</table>
		</form>
		<?
	}
}
else
{
if (isset($_POST[logout]))
{
	unset ($_SESSION[adm]);
	unset ($_SESSION[pss]);
	print "<meta http-equiv='refresh' content='0;url=trouble.php'>";
}
else
{
include "connect_db.php";
if (!isset($_SESSION[pss]))
{
	die();
}
$sql="select * from `farmers_stock`.`admin`";
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
		die();
	}
	else
	{
		$row=$sth->fetch(PDO::FETCH_ASSOC);
		if ($_SESSION[adm]!=$row[0])
		{
			die();
		}
		if ($_SESSION[pss]!=$row[1])
		{
			die();
		}
	}
}
?>
<form action='trouble.php' method='post' autocomplete="off">
	<input type='submit' name='logout' value='Logout'>
</form>

<?
$action=$_GET[action];
switch ($action)
{
default:
?>
<div align="center"><a href='trouble.php?action=ads'>Ads</a> <a href='trouble.php?action=requests'>requests</a>
	<a href='trouble.php?action=domain'>Domain</a> <a href='trouble.php?action=users'>Persons</a>
	<?
	break;

	case "ads":
		print "<a href='trouble.php'>Home</a><br/>";
		$domain=$_GET[domain];
		if (strlen($domain)==0)
		{
			$sql="select id_field, field_name from farmers_stock.field";
			$sth=$dbh->prepare($sql);
			$sth->execute();
			$res=$sth->query($sql);
			while ($row=$sth->fetch(PDO::FETCH_ASSOC))
			{
				print "<a href='trouble.php?action=ads&domain=$row[0]'>$row[1]</a><br />";
			}
		}
		else
		{
			if (isset($_POST[del_anunt]))
			{
				$id=$_GET[id];
				$domain=$_GET[domain];
				$sql="delete from farmers_stock.ads where ID_req=:id";
				$sth->bindParam(":id",$id);
				$sth=$dbh->prepare($sql);
				$sth->execute();
				$res=$sth->query($sql);
				print "<meta http-equiv='refresh' content='0;url=trouble.php?action=ads&domain=$domain'>";
				die();
			}
			print " <a href='trouble.php?action=ads'>ads</a><br />";
			$sql="select ad_text, ID_ad from farmers_stock.ads where id_field=:domain";
			$sth=$dbh->prepare($sql);
			$sth->bindParam(":domain",$domain);
			$sth->execute();
			$res=$sth->query($sql);
			print "<table class='bkl'>";
			if ($sth->rowCount()==0)
				print "<tr><td class='bk' align='center'>No ads!</td></tr>";
			else
			{
				while ($row=$sth->fetch(PDO::FETCH_ASSOC))
				{
					print "<tr><td class='bk'>$row[0]</td><form autocomplete=\"off\" action='trouble.php?action=ads&domain=$domain&id=$row[1]' method='post'><td class='bk'><input type='submit' name='del_anunt' value='Delete'></td></form></tr>";
				}
			}

			print "</table>";
		}
		break;

	case "requests":
		print "<a href='trouble.php'>Home</a><br/>";
		if (isset ($_POST[del_request]))
		{
			$id=$_GET[id];
			$sql="delete from farmers_stock.requests where ID_req=:id";
			$sth=$dbh->prepare($sql);
			$sth->bindParam(":id",$id);
			$sth->execute();
			$res=$sth->query($sql);
			print "<meta http-equiv='refresh' content='0;url=trouble.php?action=requests'>";
			die();
		}
		$sql="select add, ID_req from farmers_stock.requests";
		$sth=$dbh->prepare($sql);
		$sth->execute();
		$res=$sth->query($sql);
		print "<table class='bkl'>";
		if ($sth->rowCount()==0)
		{
			print "<tr><td class='bk' align='center'>There are no requests!</td></tr>";
		}
		else
		{
			while($row=$sth->fetch(PDO::FETCH_ASSOC))
			{
				print "<tr><td class='bk'>$row[0]</td><form autocomplete=\"off\" action='trouble.php?action=requests&id=$row[1]' method='post'><td class='bk'><input type='submit' name='del_request' value='Delete'></td></form></tr>";
			}
		}
		print "</table>";
		break;

	case "domain":
		print "<a href='trouble.php'>Home</a><br/></br />";
		if (!isset ($_POST[add]))
		{
			print "Add:<br/><form autocomplete=\"off\" action='trouble.php?action=domain' method='post'><input type='text' name='dom'><select name='tip'><option value='1'>Animal</option><option value='2'>Vegetal</option></select><input type='submit' name='add' value='Add'></form><hr>";
		}
		else
		{
			$dom=$_POST[dom];
			$tip=$_POST[tip];
			$sql="insert into farmers_stock.field (field_name, field_type) values (:dom, :tip)";
			$sth->bindParam(":dom",$dom);
			$sth->bindParam(":tip",$tip);
			query($sql) or die(errorInfo());
			die("<meta http-equiv='refresh' content='0;url=trouble.php?action=domain'>");
		}
		if (isset($_POST[del_dom]))
		{
			$id=$_GET[id];
			$sql="delete from field where id_field=:id";
			$sth->bindParam(":id",$id);
			$sth=$dbh->prepare($sql);
			$sth->execute();
			$sql="delete from ads where id_field=:id";
			$sth->bindParam(":id",$id);
			$sth=$dbh->prepare($sql);
			$sth->execute();
			print "<meta http-equiv='refresh' content='0;url=trouble.php?action=domain'>";
			die();
		}
		print "<table class='bkl'>";
		$sql="select nume_domain, id_domain from farmers_stock.domain";
		$sth=$dbh->prepare($sql);
		$sth->execute();
		$res=$sth->query($sql);
		if ($sth->rowCount()==0)
		{
			print "<tr><td class='bk' align='center'>There are no fields!</td></tr>";
		}
		else
		{
			print "<tr><td class='bk' align='center' colspan='2'><b>Fields:</b></td></tr>";
			while ($row=$sth->fetch(PDO::FETCH_ASSOC))
			{
				print "<tr><td class='bk'>$row[0]</td><form autocomplete=\"off\" action='trouble.php?action=domain&id=$row[1]' method='post'><td class='bk'><input type='submit' name='del_dom' value='Delete'></td></form></tr>";
			}
		}
		print "</table>";
		break;

	case "users":
		print "<a href='trouble.php'>Home</a><br/>";
		if (isset ($_POST[del_pers]))
		{
			$id=$_GET[id];
			$sql="delete from users where ID_user=:id";
			$sth->bindParam(":id",$id);
			$sth=$dbh->prepare($sql);
			$sth->execute();
			$sql="delete from ads where id_user=:id";
			$sth->bindParam(":id",$id);
			$sth=$dbh->prepare($sql);
			$sth->execute();
			print "<meta http-equiv='refresh' content='0;url=trouble.php?action=users'>";
			die();
		}
		$sql="select username, ID_user from users";
		$sth=$dbh->prepare($sql);
		$sth->execute();
		print "<table class='bkl'>";
		if ($sth->rowCount()==0)
		{
			print "<tr><td class='bk' align='center'>No persons!</td></tr>";
		}
		else
		{
			while($row=$sth->fetch(PDO::FETCH_ASSOC))
			{
				print "<tr><td class='bk'><a href='userinfo.php?user=$row[0]' target='_blank'>$row[0]</a></td><form autocomplete=\"off\" action='trouble.php?action=users&id=$row[1]' method='post'><td class='bk'><input type='submit' name='del_pers' value='Delete'></td></form></tr>";
			}
		}
		print "</table>";
		break;
	}
	}
	}
	?>
</div>
