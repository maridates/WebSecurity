<HTML>
<HEAD>
<TITLE>Results </TITLE>
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
<body background="pictures/wall2.png">
<p><a href="farmers_stock.php"><img src="pictures/Stop.png" width="61" height="60" border="0"></a> 
 <a href='buyers.php'><img src="pictures/back.PNG" width="58" height="61" border="0"></a></p>
<H1 align="center"><font color="#FFFFFF" size="5" face="Comic Sans MS">Show result on search </font></H1>
<HR>
<?php
$cautare = addslashes ( trim( $POST["cautare"] ) );
echo "We are looking for: ".$cautare."<BR>";
include "connect_db.php";
$interogare = "SELECT `id_field`, `ID_user`, `ad_text` FROM `farmers_stock`.`ads` ";
if( $cautare!="") 
     $interogare = $interogare."WHERE `ad_text` LIKE '%".$cautare."%'";
$sth=$dbh->prepare($sql);
$sth->execute();
//$rez=$sth->query($interogare);
//$rez = query ($interogare);
$nrRez = $sth->rowCount();
if($nrRez == 0)
   echo "Nothing to show!";
else
	{ 
	echo "We have found $nrRez products:<BR>";
	echo "<TABLE class='bkl'>";
	print "
	<tr>
		<td class='bk'>User</td>
		<td class='bk'>Field</td>
		<td class='bk'>Ad</td>
	</tr>
	";
	while ($row=$sth->fetch(PDO::FETCH_ASSOC)//mysql_fetch_row($rez))
		{
		$sql="select `username` from `farmers_stock`.`users` where `ID_user`=".$row[1];
		$sth=$dbh->prepare($sql);
		$sth->execute();
		//$res=$sth->query($sql);
		//$res=query($sql) or die (errorInfo());
		$pers=$sth->fetch(PDO::FETCH_ASSOC);//mysql_fetch_row($res);
		$sql="select `field_name` from `farmers_stock`.`field` where `id_field`=".$row[0];
		$sth=$dbh->prepare($sql);
		$sth->execute();
		//$res=$sth->query($sql);
		//$res=query($sql) or die (errorInfo());
		$domain=$sth->fetch(PDO::FETCH_ASSOC);//mysql_fetch_row($res) or die (errorInfo());
		print "<tr>";
		print "<td class='bk'><a href='userinfo.php?user=$pers[0]' target='_blank'>".$pers[0]."</td>";
		print "<td class='bk'>".$domain[0]."</td>";
		print "<td class='bk'>".$row[2]."</td>";
		print "</tr>";
		}
	echo "</TABLE>";
	}
?>
<HR>
</HTML> 

