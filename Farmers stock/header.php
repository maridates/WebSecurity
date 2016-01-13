<div id="fixedheader">
<?php
/**
 * Created by PhpStorm.
 * User: Ronni
 * Date: 13-01-2016
 * Time: 09:51
 */
include_once 'functions.php';
sec_session_start();
if (isset($_POST['logout'])){
    logout();
}
if (!isset($_SESSION['User']))
{
    print('
    <form action="userslogin.php" method="post" name="username">
        <div align="right" id="login">
            <table>
                    <td colspan="2" align="center">Login</td>
                    <td align="right">User:</TD>
                    <td> <input name="User" type="text"></TD>
                    <td align="right">Password:</td>
                    <td><input name="Password" type="password"></td>
                    <td colspan="2" align="center"><input type="submit" name="submit" value="Login"></td>
            </table>
        </div>
    </form>
');
}else{
    print('<div align="right" id="login">
            <table>
                    <td colspan="2" align="center">Logged in as: '.$_SESSION['User'].'</td>
                    <td align="right">
                        <form action="header.php" method="post">
                            <input type="submit" name="logout" value="Logout">
                        </form>
                    </td>
            </table>
        </div>');
}
?>
</div>

<style type="text/css">
div#login {
    padding-right: 20px;
}
div#fixedheader {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    color: #2B6C00;
    background: #2B6C00;
    padding: 5px;
}
</style>
