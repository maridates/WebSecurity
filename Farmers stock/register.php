<?php
/**
 * Created by PhpStorm.
 * User: dates
 * Date: 1/14/2016
 * Time: 5:01 PM
 */
include "header.php";
?>
<html>
<head>
    <title>Users Register</title>
    <link rel="shortcut icon" href="pictures/favicon.ico">
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
        table.top {
            margin-top: 10%;
        }
    </style>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<body background="pictures/background.jpg">
<form action="adduser.php" method="post" autocomplete="off">
    <table align="center" class="top">
        <tr>
            <td colspan="2" align="center" class="bkl"><b>Register</b></td>
        </tr>
        <tr>
            <td align="right" class="bkl"><FONT face="verdana" size=2><b>Username:</b></FONT></td>
            <td class="bkl">&nbsp;<input type="text" name="username" size="30"></td>
        </tr>
        <tr>
            <TD align="right" class="bkl"><FONT face="verdana" size=2><b>Password User:</b></FONT></TD>
            <TD class="bkl">&nbsp;<input type="password" name="Password" size="30"></TD>
        </tr>
        <tr>
            <TD align="right" class="bkl"><FONT face="verdana" size=2><b>Password User:</b></FONT></TD>
            <TD class="bkl">&nbsp;<input type="password" name="Password2" size="30"></TD>
        </tr>
        <TR>
            <TD align="right" class="bkl"><FONT face="verdana" size=2><b>Surname:</b></FONT></TD>
            <TD class="bkl">&nbsp;<input type="text" name="Surname" size="30"></TD>
        </TR>
        <tr>
            <TD align="right" class="bkl"><FONT face="verdana" size=2><b>Firstname:</b></FONT></TD>
            <TD class="bkl">&nbsp;<input type="text" name="Firstname" size="30"></TD>
        </TR>
        <tr>
            <TD align="right" class="bkl"><FONT face="verdana" size=2><b>Address:</b></TD>
            <TD class="bkl">&nbsp;<input type="text" name="Address" size="30"></TD>
        </TR>
        <tr>
            <TD align="right" class="bkl"><FONT face="verdana" size=2><b>Phone</b></FONT></TD>
            <TD class="bkl">&nbsp;<input type="text" name="phone" size="30"></TD>
        </TR>
        <tr>
            <TD colspan="2" align="center" class="bkl"><input type="reset" value="Reset"></TD>
        </tr>
        <tr>
            <TD colspan="2" align="center" class="bkl"><input type="submit" value="Validate" name="submit"></TD>
        </TR>
    </table>
</form>
<p align="center"><font face="Comic Sans MS">Register Instructions </font></p>
<p align="center"><font face="Comic Sans MS">In order to insert an ad you have to be registered</font></p>
<p align="center"><font face="Comic Sans MS">Your username /
        Password will remain strictly confidential</font></p>
</body>
</html>
