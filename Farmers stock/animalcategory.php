<HTML>
<HEAD>
	<TITLE>Animal products</TITLE>
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
			margin-top: 18%;
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
		.bk {
			background-color: #ADFF2F;
		}
		.bkl {
			background-color: #ADFF2F;
		}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body  background="pictures/background.jpg">
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
		$id_cat[$i]=$row['id_field'];
	}
	print "<table class='bkl'>";
	print "<tr><td align='right' class='bk'><b>User:</b></td><td class='bk'><b>Ad:</b></td></tr>";
	for ($i=0;$i<$j;$i++)
	{
		$sql="select `field_name` from `field` where id_field=:id_field";
		$sth1=$dbh->prepare($sql);
		$sth1->bindParam(":id_field",$id_cat[$i]);
		$sth1->execute();
		$dom=$sth1->fetch(PDO::FETCH_ASSOC);
		$sql="select `ad_text`, `id_user` from `farmers_stock`.`ads` where id_field=:id_field";
		$sth2=$dbh->prepare($sql);
		$sth2->bindParam(":id_field",$id_cat[$i]);
		$sth2->execute();
		$count1 = $sth2->rowCount();
		print "<tr><td colspan='2' align='center' class='bk'><b>Field:  &nbsp; &nbsp; ".$dom['field_name']."</b></td></tr>";
		if ($sth2->rowCount()==0)
		{
			print "<tr><td colspan='2' align='center' class='bk'>No ads!</td></tr>";
		}
		else
		{
			while ($row=$sth2->fetchALL(PDO::FETCH_ASSOC))
			{
				for($i=0;$i<$count1;$i++){
					$sql1="SELECT username from users where ID_user=:id_user";
					$sth3=$dbh->prepare($sql1);
					$sth3->bindParam(":id_user",$row[$i]['id_user']);
					$sth3->execute();
					$user = $sth3->fetch(PDO::FETCH_ASSOC);
					print "<tr><td>Username: <b><a href='userinfo.php?user=".$row[$i]['id_user']."' target='_blank'>".$user['username']."</a></b></td><td align='right' class='bk'>".$row[$i]['ad_text']."</td></tr>";

				}
			}
		}
	}
	print "</table>";
}
?>
</body>
</html>