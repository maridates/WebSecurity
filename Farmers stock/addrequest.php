<?php
include "header.php";
?>
<head>
  <title>Add request</title>
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
</head>
<body background="pictures/background.jpg">
<table width="100%"border="1" cellspacing="0" cellpadding="0">
</table>
<div style="padding-top: 80px;">
<FORM name="formrequests" method="post" action="addrequestresult.php">
  <P><font color="#FFFFFF" size="5" face="Comic Sans MS"><strong>Add your request</strong></font>
  <P> 
    <INPUT type="text" name="anunt" size="150" maxlength="150">
    <BR>
<P> <INPUT type="submit" name="trimit" value="Submit">
<INPUT type="reset" name="sterg" value="Reset">
</FORM>
  </div>
</BODY>
</HTML> 
