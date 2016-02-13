<?php
include "header.php";
include_once 'functions.php';
sec_session_start();
$_SESSION['field_search'] = htmlentities( $_POST['field_search']);

?>
<HTML>
<HEAD>
	<TITLE>Results </TITLE>
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
			color: #ffffff;
			font-weight: 900;
		}
		table.top {
			bgcolor= #ADFF2F;
			margin-top: 18%;
			color: #000000;
			font-weight: 900;
		}
		p.one {
			margin-right: 50px;
			margin-left: 50px;
			font-weight: 900;
		}

		.bk
		{
			background:transparent;
			font-weight: 900;
		}
		.bkl
		{
			background:transparent;
			font-weight: 900;
		}
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body background="pictures/background.jpg" >
<div  style="padding-top: 80px; padding-left: 40px" >
	<H1 align="center"><font color="#FFFFFF" size="5" face="Comic Sans MS">Show result on search </font></H1>
	<HR width="80%">
	<div style="padding-left: 140px" >
		<?php

		$field_search = htmlentities($_SESSION['field_search']);
		echo "We are looking for: <b>".$field_search."</b><BR>";
		include "connect_db.php";
		$interogare = "SELECT `id_field`, `ID_user`, `ad_text` FROM `ads` ";
		if( $field_search!="")
			$interogare = $interogare."WHERE `ad_text` LIKE '%".$field_search."%'";
		$sth=$dbh->prepare($interogare);
		$sth->execute();
		$nrRez = $sth->rowCount();
		if($nrRez == 0)
			echo "Nothing to show!";
		else
		{
			echo " We have found <b> $nrRez </b> products:<BR>";
			echo "<TABLE class='bkl'>";
			print "
	<tr>
		<td class='bk'>User</td>
		<td class='bk'>Field</td>
		<td class='bk'>Ad</td>
	</tr>
	";
			while ($row=$sth->fetchALL(PDO::FETCH_ASSOC))
			{
				for($i=0;$i<$nrRez;$i++)
				{
					$sql = "select username from users where ID_user=:id_user";
					$sth = $dbh->prepare($sql);
					$sth->bindParam(":id_user", $row[$i]['ID_user']);
					$sth->execute();
					$pers = $sth->fetch(PDO::FETCH_ASSOC);
					$sql = "select `field_name` from `farmers_stock`.`field` where `id_field`=:id_field";
					$sth = $dbh->prepare($sql);
					$sth->bindParam(":id_field", $row[$i]['id_field']);
					$sth->execute();
					$domain = $sth->fetch(PDO::FETCH_ASSOC);
					print "<tr>";
					print "<td class='bk'><a href='userinfo.php?user=".$row[$i]['ID_user']."' target='_blank'>" . $pers['username'] . "</td>";
					print "<td class='bk'>" . $domain['field_name'] . "</td>";
					print "<td class='bk'>" . $row[$i]['ad_text'] . "</td>";
					print "</tr>";
				}
			}
			echo "</TABLE>";
		}
		?>
	</div>
	<HR width="80%">
</div>
</BODY>
</HTML> 

