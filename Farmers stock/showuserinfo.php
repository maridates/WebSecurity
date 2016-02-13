<?php
/**
 * Created by PhpStorm.
 * User: Mary
 * Date: 1/8/2016
 * Time: 10:12 AM
 */
include_once 'functions.php';
sec_session_start();
$login_session = htmlentities($_GET['user']);

?>
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
        margin-top: 5%;
    }

</style>
<!DOCTYPE html>
<html>
<body background="pictures/background.jpg">
<b> Welcome: <i> <?php echo $login_session; ?></i></b>
<br>
<table class="top" align="center">
    <tr>
        <td align="center" class="bk" colspan="2"><b>User Info</b></td>
    </tr>
    <?php
    include "connect_db.php";
    $sql="select last_name, first_name, address from users where username=:username";

    $sth=$dbh->prepare($sql);
    $sth->bindParam(":username",$login_session);
    $sth->execute();

    if ($sth->rowCount()==0)
    {
        print "<meta http-equiv='refresh' content='0;url=sellers.php'>";
    }
    else
    {
        if ($sth->rowCount()>1)
        {
            die ("<p align='center' class='bkl'>Database error.</p>");
        }
        $row=$sth->fetchAll();
    }
    ?>

    <tr>
        <td align="right" class="bk">Name:</td>
        <td class="bk">&nbsp;<?php echo $row[0]['first_name'] ?></td>
    </tr>
    <tr>
        <td align="right" class="bk">Surname:</td>
        <td class="bk">&nbsp;<?php echo $row[0]['last_name']; ?></td>
    </tr>
    <tr>
        <td align="right" class="bk">Adress:</td>
        <td class="bk">&nbsp;<?php echo $row[0]['address']; ?></td>
    </tr>
</table>

<table width="50%" border="0" align="center">
    <tr>
        <TD align="CENTER"><a onclick="window.print();"><img src="pictures/Printer.png" width="81" height="81" border="0" align="absmiddle"></a></TD>
    </tr>
</table>
<b>Logout: <a href="logout.php" > HERE </a></b>
</body>
</html>
