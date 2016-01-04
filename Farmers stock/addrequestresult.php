<table width="100%"border="1" cellspacing="0" cellpadding="0">

</table>
<HTML>
<HEAD>
<TITLE>Insert ad</TITLE>
</HEAD>
<BODY>
<HR>
<?php
$anunt= addslashes ( trim( $HTTP_POST_VARS["anunt"] ) );
echo "add: ".$anunt."<BR>";
if($anunt=="")
     die("You have not inserted an ad");
include "connect_db.php";
$date=date("D M d, Y H:i:s");
$interogare = "INSERT INTO requests (`add`, `date`) VALUES ('$anunt', '$date')";
$rez = mysql_query ($interogare);
if (!$rez)
     die("Error on inserting!");
echo "Succesful. Inserted ads: ".mysql_affected_rows()."<BR>";
print "<meta http-equiv='refresh' content='2;url=request.php'>";
?>
<HR> 
</BODY>
</HTML> 