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
if ($sth->rowCount()==0)
	{
	print "There are no domains with animal products";
	}
else
	{
	$j=$sth->rowCount();
	for ($i=0;$i<$j;$i++)
		{
		$row=$sth->fetch(PDO::FETCH_ASSOC);
			print_r($row);
		$id_cat[$i]=$row['id_field'];
		}
	print "<table class='bkl'>";
	print "<tr><td align='right' class='bk'><b>User:</b></td><td class='bk'><b>Ad:</b></td></tr>";
	for ($i=0;$i<$j;$i++)
		{
		$sql="select `field_name` from `field` where id_field=:id_field";
			$sth=$dbh->prepare($sql);
			$sth->bindParam(":id_field",$id_cat[$i]);
			$sth->execute();
		$dom=$sth->fetch(PDO::FETCH_ASSOC);
			print_r($dom);
		$sql="select `ad_text`, `id_user` from `farmers_stock`.`ads` where id_field=:id_field";
			$sth=$dbh->prepare($sql);
			$sth->bindParam(":id_field",$id_cat[$i]);
			$sth->execute();
		print "<tr><td colspan='2' align='center' class='bk'><b>Field: ".$dom['field_name']."</b></td></tr>";
		if ($sth->rowCount()==0)
			{
			print "<tr><td colspan='2' align='center' class='bk'>No ads!</td></tr>";
			}
		else
			{
			while ($row=$sth->fetch(PDO::FETCH_ASSOC))
				{
				//print "<tr><td align='right' class='bk'><a href='userinfo.php?user=".$row['id_user']."' target='_blank'>".$row['id_user']."</a></td><td class='bk'>".$row['ad_text']."</td></tr>";
					$sql1="SELECT username from users where ID_user=:id_user";
					$sth=$dbh->prepare($sql1);
					$sth->bindParam(":id_user",$row['id_user']);
					$sth->execute();
					$user = $sth->fetch(PDO::FETCH_ASSOC);
					print "<tr><td>Username: <b><a href='userinfo.php?user=".$row['id_user']."' target='_blank'>".$user['username']."</a></b></td><td align='right' class='bk'>".$row['ad_text']."</td></tr>";

				}
			}
		}
	print "</table>";
	}
?>
</body>
</html>