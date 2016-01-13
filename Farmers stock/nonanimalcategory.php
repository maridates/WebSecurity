<HTML>
<HEAD>
<TITLE>Plant products</TITLE>
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
<body bgcolor="#CCCCCC"></head>
<body> 
<?php
print "<p><a href='farmers_stock.php'>Home</a> <a href='buyers.php'>Buyers</a></p>";
include "connect_db.php";
$sql="select `id_field` from `farmers_stock`.`field` where `field_type`='2'";
$sth=$dbh->prepare($sql);
$sth->execute();
//$res=query($sql) or die (errorInfo());
if ($sth->rowCount()==0)
	{
	print "There are no domains with plant products";
	}
else
	{
	$j=$sth->rowCount();
	for ($i=0;$i<$j;$i++)
		{
		$row=$sth->fetch(PDO::FETCH_ASSOC);//mysql_fetch_row($res);
		$id_cat[$i]=$row['id_field'];
		}
	print "<table class='bkl'>";
	print "<tr><td align='right' class='bk'><b>User:</b></td><td class='bk'><b>Ad:</b></td></tr>";
	for ($i=0;$i<$j;$i++)
		{
		$sql="select `field_name` from `farmers_stock`.`field` where id_field=:id_field";
			$sth=$dbh->prepare($sql);
			$sth->bindParam(":id_field",$id_cat[$i]);
			$sth->execute();
			//$res=$sth->query($sql);//$res=query($sql) or die (errorInfo());
		$dom=$sth->fetch(PDO::FETCH_ASSOC);//=mysql_fetch_row($res);
		$sql="select `ad_text`, `id_user` from `ads` where id_field=:id_field";
			$sth=$dbh->prepare($sql);
			$sth->bindParam(":id_field",$id_cat[$i]);
			$sth->execute();//		$res=query($sql) or die (errorInfo());
		print "<tr><td colspan='2' align='center' class='bk'><b>Field: ".$dom['field_name']."</b></td></tr>";
		if ($sth->rowCount()==0)
			{
			print "<tr><td colspan='2' align='center' class='bk'>There are no ads!</td></tr>";
			}
		else
			{
			while ($row=$sth->fetch(PDO::FETCH_ASSOC))
				{
					$sql1="SELECT username from users where ID_user=:id_user";
					$sth=$dbh->prepare($sql1);
					$sth->bindParam(":id_user",$row['id_user']);
					$sth->execute();
					$user = $sth->fetch(PDO::FETCH_ASSOC);
				print "<tr><td>Username: <b>".$user['username']."</b></td><td align='right' class='bk'>".$row['ad_text']."</td></tr>";
				}
			}
		}
	print "</table>";
	}
?>
</body>
</html>