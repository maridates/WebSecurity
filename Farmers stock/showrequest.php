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
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></HEAD>
<BODY background="pictures/wall2.png">
<p><a href="farmers_stock.php"><img src="pictures/Stop.png" width="61" height="60" border="0"></a> 
  <a href="request.php"><img src="pictures/back.PNG" width="58" height="61" border="0"></a></p>
<H1><font color="#FFFFFF" size="5" face="Comic Sans MS"><strong>requests:</strong></font></H1>
<HR>
<?php
include "connect_db.php";
$interogare = "SELECT * FROM `requests` order by `date` desc";
$rez = mysql_query ($interogare);
$nrRez = mysql_num_rows( $rez );
if($nrRez == 0)
   echo "No request found!";
else
{ 
echo "We found $nrRez requests:<BR>";
echo "<TABLE class='bkl'>";
for($i=0; $i<$nrRez; $i++) {
 $requests = mysql_fetch_object($rez);
 echo "<TR><TD class='bk'>".$requests->add."</TD>"; 
 echo "<TD class='bk'>".$requests->date."</TD></TR>"; 
}
echo "</TABLE>";
}
?>
<HR>  
</HTML>