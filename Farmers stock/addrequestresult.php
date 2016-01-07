<table width="100%"border="1" cellspacing="0" cellpadding="0">

</table>
<HTML>
<HEAD>
<TITLE>Insert ad</TITLE>
</HEAD>
<BODY>
<HR>
<?php
$anunt= addslashes ( trim( $POST["anunt"] ) );
echo "add: ".$anunt."<BR>";
if($anunt=="")
     die("You have not inserted an ad");
include "connect_db.php";
$date=date("D M d, Y H:i:s");
$interogare = "INSERT INTO farmers_stock.requests (`add`, `date`) VALUES (:ad, :dat)";
$sth=$dbh->prepare($interogare);
$sth->bindParam(":ad",$anunt);
$sth->bindParam(":dat",$date);
$rez = $sth->execute();
if (!$rez)
     die("Error on inserting!");
echo "Succesful. Inserted ads: ".$sth->rowCount()."<BR>";
print "<meta http-equiv='refresh' content='2;url=request.php'>";
?>
<HR> 
</BODY>
</HTML> 