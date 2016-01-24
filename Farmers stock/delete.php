<?php
/**
 * Created by PhpStorm.
 * User: dates
 * Date: 1/24/2016
 * Time: 3:15 PM
 */

include "header.php";
?>
    <html>
    <head>
        <title>Delete your ad</title>
        <link rel="shortcut icon" href="pictures/favicon.ico">
        <style>
            .bk
            {
                background-color: #ADFF2F;
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
            table.top {
                margin-top: 10%;
            }
            p.one {
                margin-right: 50px;
                margin-left: 50px;
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
<div style="padding-top: 70px;">
<?php
//Define the query
include "connect_db.php";
$sql="delete from `farmers_stock`.`ads` where `ID_ad`=:id_ad LIMIT 1;";
$sth=$dbh->prepare($sql);
$sth->bindParam(":id_ad", $_GET['id_ad']);
$sth->execute();
if ($sth->rowCount()==0)
{
    die("<p align='center' class='bk'>- ERROR - on connecting to database.</p>");
} else { ?>

    <strong>Announcement Has Been Deleted</strong><br /><br />

    <?php
    print "<meta http-equiv='refresh' content='0;url=add.php'>";
}
?>