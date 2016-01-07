<HTML>
<HEAD>
<TITLE>Animal products</TITLE>
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
</head>
<body>
<?php
print "<p><a href='farmers_stock.php'>Home</a> <a href='buyers.php'  >Buyers  </a></p>";
include "connect_db.php";
$sql="select `id_field` from `field` where `field_type`='1'";
$sth=$dbh->prepare($sql);
$sth->execute();
//$res=$sth->query($sql);
//$res=query($sql) or die (errorInfo());
if ($sth->rowCount()==0)
	{
	print "There are no domains with animal products";
	}
else
	{
	$j=$sth->rowCount();
	for ($i=0;$i<$j;$i++)
		{
		$row=$sth->fetch(PDO::FETCH_ASSOC);//mysql_fetch_row($res);
		$id_cat[$i]=$row[0];
		}
	print "<table class='bkl'>";
	print "<tr><td align='right' class='bk'><b>User:</b></td><td class='bk'><b>Ad:</b></td></tr>";
	for ($i=0;$i<$j;$i++)
		{
		$sql="select `field_name` from `farmers_stock`.`field` where id_field=:id_field";
			$sth->bindParam(":id_field",$id_cat[$i]);
			$sth=$dbh->prepare($sql);
			$res=$sth->query($sql);
		//$res=query($sql) or die (errorInfo());
		$dom=$sth->fetch(PDO::FETCH_ASSOC);//mysql_fetch_row($res);
		$sql="select `username`, `ad_text` from `farmers_stock`.`ads`, `farmers_stock`.`users` where id_field=:id_field and ID_user=id_user";
			$sth->bindParam(":id_field",$id_cat[$i]);
			$sth=$dbh->prepare($sql);
			$res=$sth->query($sql);
		//$res=query($sql) or die (errorInfo());
		print "<tr><td colspan='2' align='center' class='bk'><b>domainl: $dom[0]</b></td></tr>";
		if (mysql_num_rows($res)==0)
			{
			print "<tr><td colspan='2' align='center' class='bk'>No ads!</td></tr>";
			}
		else
			{
			while ($row=$sth->fetch(PDO::FETCH_ASSOC))//;mysql_fetch_row($res))
				{
				print "<tr><td align='right' class='bk'><a href='userinfo.php?user=$row[0]' target='_blank'>$row[0]</a></td><td class='bk'>$row[1]</td></tr>";
				}
			}
		}
	print "</table>";
	}
?>
</body>
</html>