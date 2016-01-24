<HTML>
<HEAD>
     <TITLE>Insert ad</TITLE>
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
          img{
               height: 15vw;
               width: 15vw;
          }
          img.no{
               height: 5vw;
               width: 5vw;
          }
     </style>
</HEAD>
<?php
$anunt = htmlentities($_POST['anunt']);
//$anunt= addslashes ( trim( $_POST["anunt"] ) );
echo "Request: ".$anunt."<BR>";
if($anunt=="")
     die("You have not inserted a request");
include "connect_db.php";
$date=date("Y-m-d h:i:sa");//date("D M d, Y H:i:s");
$interogare = "INSERT INTO requests(`add`, `date`) VALUES (:ad, :dat)";
$sth=$dbh->prepare($interogare);
$sth->bindParam(":ad",$anunt);
$sth->bindParam(":dat",$date);
$sth->execute();
?>
<body background="pictures/background.jpg">
<p> Your request was successfully added.</p>
<p>Thank you for choosing us.</p>
<a href="farmers_stock.php">Homepage</a>
<br>
<p>If you want to insert another request please click here</p>
<a href="addrequest.php">INSERT ANOTHER AD / View all ads</a>