<style>
    input{height:20px;vertical-align:middle;}
</style>
<title>Farmer's Stock</title>
<link rel="shortcut icon" href="pictures/favicon.ico">
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
                <tr>
                    <td colspan="2" align="center">Login</td>
                    <td align="right">User:</TD>
                    <td> <input name="User" type="text"></TD>
                    <td align="right">Password:</td>
                    <td><input name="Password" type="password"></td>
                    <td colspan="2" align="center"><input type="submit" name="submit" value="Login"></td>
                   </tr>
            </table>
        </div>
    </form>
    <form action="register.php" method="post">
         <div align="right" id="login">
            <table>
                <tr>
                    <td><input type="submit" name="submit" value="Register"></td>
                </tr>
            </table>
        </div>
    </form>
');
    }else{
        print('<div align="right" id="login">
            <table>
                   <tr></tr>
                    <td align="center">Logged in as: '.$_SESSION['User'].'</td>
                    <td align="right">
                        <form action="header.php" method="post">
                            <input type="submit" name="logout" value="Logout">
                        </form>
                    </td>
                    </tr>
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
