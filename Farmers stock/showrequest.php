<?php
include "header.php";
?>
<HTML>
<HEAD>
	<TITLE>Show Ads </TITLE>
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
		img{
			height: 15vw;
			width: 15vw;
		}
		img.no{
			height: 5vw;
			width: 5vw;
		}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="shortcut icon" href="pictures/favicon.ico">
</HEAD>
<body background="pictures/background.jpg">
<div style="padding-top: 50px;">
	<H1><font color="#FFFFFF" size="5" face="Comic Sans MS"><strong>Requests:</strong></font></H1>
	<HR>
	<?php
	include "connect_db.php";
	$interogare = "SELECT * FROM `farmers_stock`.`requests` order by `date` desc";
	$sth=$dbh->prepare($interogare);
	$sth->execute();
	$nrRez = $sth->rowCount();
	if($nrRez == 0)
		echo "No request found!";
	else
	{
		echo "We found $nrRez requests:<BR>";
		echo "<TABLE class='bkl'>";
		for($i=0; $i<$nrRez; $i++) {
			$requests =$sth->fetch(PDO::FETCH_OBJ);
			echo "<TR><TD class='bk'>".$requests->add."</TD>";
			echo "<TD class='bk'>".$requests->date."</TD></TR>";
		}
		echo "</TABLE>";
	}
	?>
	<HR>
</div>
</body>
</HTML>