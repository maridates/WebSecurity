<html>
<head>
  <title>Login</title>
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
      margin-top: 18%;
    }
    p.one {
      margin-top: 15%;
    }
    .bk
    {
      background-color: #DFDFDF;
    }
    .bkl
    {
      background-color: #AFAFAF;
    }
  </style><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head><body background="pictures/background.jpg">
<div align="center">
  <table class="top" width="50%" border="0">
    <tr>
      <td>
        <P class="one" align="center"><font face="Comic Sans MS" size="42">Sell your products here</font></P>
        <p align="center"> <font face="Comic Sans MS"><strong>If you have an account you can <em>login</em> else you can <em>register for free</em>!</strong></font>
          <button onclick="javascript:window.open('adduser.php');">Register</button>
        </p>
        <form action="userslogin.php" method="post" name="username" autocomplete="off">
          <div align="center">
            <table class="bkl">
              <tr>
                <td colspan="2" align="center" class="bk">Login</td>
              </tr>
              <tr>
                <td align="right" class="bk">User:</TD>
                <td class="bk">&nbsp; <input name="User" type="text"></TD>
              </TR>
              <tr>
                <td align="right" class="bk">Password:</td>
                <td class="bk">&nbsp; <input name="Password" type="password"></td>
              </tr>
              <tr>
                <td colspan="2" align="center"  class="bk"><input type="submit" name="submit" value="Login"></td>
              </tr>
            </table>
          </div>
        </form></td>
    </tr>
  </table>
  <p>&nbsp;</p></div>
</body>
</html>