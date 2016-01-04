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
$res=mysql_query($sql) or die (mysql_error());
if (mysql_num_rows($res)==0)
	{
	print "There are no domains with animal products";
	}
else
	{
	$j=mysql_num_rows($res);
	for ($i=0;$i<$j;$i++)
		{
		$row=mysql_fetch_row($res);
		$id_cat[$i]=$row[0];
		}
	print "<table class='bkl'>";
	print "<tr><td align='right' class='bk'><b>User:</b></td><td class='bk'><b>Ad:</b></td></tr>";
	for ($i=0;$i<$j;$i++)
		{
		$sql="select `field_name` from `field` where id_field='$id_cat[$i]'";
		$res=mysql_query($sql) or die (mysql_error());
		$dom=mysql_fetch_row($res);
		$sql="select `username`, `ad_text` from `ads`, `users` where id_field=$id_cat[$i] and ID_user=id_user";
		$res=mysql_query($sql) or die (mysql_error());
		print "<tr><td colspan='2' align='center' class='bk'><b>domainl: $dom[0]</b></td></tr>";
		if (mysql_num_rows($res)==0)
			{
			print "<tr><td colspan='2' align='center' class='bk'>No ads!</td></tr>";
			}
		else
			{
			while ($row=mysql_fetch_row($res))
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