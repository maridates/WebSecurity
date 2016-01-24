<?php
/**
 * Created by PhpStorm.
 * User: dates
 * Date: 1/24/2016
 * Time: 12:24 PM
 */
include "header.php";
?>
<html>
<head>
    <title>Add announcement</title>
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
        img.fix{
            height: 53px;
            width: 193px;
        }
    </style>
</head>
<body background="pictures/background.jpg">
<div align="center"  style="padding-top: 50px;">
    <table border="0" class="top">
        <tr>
            <td colspan="2" style="color: #ffffff;"><div align="center"><h2 >Here you can choose if you want to see all the requests buyers added on the website <br> or <br> you can add your advertise/announcement.</h2>
                </div> </td>
        </tr>
        <tr>
            <td width="50%"><div align="center"><a href="showrequest.php"><p class = one><img class = fix src="pictures/show.png"></p></a></div></td>
            <td width="50%"><div align="center"><a href="add.php"><p class = one><img class = fix src="pictures/add1.png" ></p></a></div></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
    </table>

</div>
</body>
</html>