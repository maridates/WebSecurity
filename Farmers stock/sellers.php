<html>
<head>
<title>Login</title>
<style>
.bk
	{
	background-color: #DFDFDF;
	}
.bkl
	{
	background-color: #AFAFAF;
	}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head><body background="pictures/The_Lies.jpg" tracingsrc="pictures/Birds_by_mwmax.jpg" tracingopacity="20">
<p><a href="farmers_stock.php">  </a><a href="farmers_stock.php"><img src="pictures/back.PNG" width="53" height="49" border="0"></a></p>

<div align="center"> 
  <table width="50%" border="0">
    <tr> 
      <td> <P align="center"> <font face="Comic Sans MS">Thank you for visiting our homepage.</font></P>
        <P align="center"><font face="Comic Sans MS">Only here you can make free ads</font></P>
        <p align="center"> <font face="Comic Sans MS"><strong>If you have an account you can <em>login</em> else you can <em>register for free</em>!</strong></font> 
          <button onclick="javascript:window.open('adduser.php');">Register</button>
        </p>
        <form action="userslogin.php" method="post" name="username">
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
                <td colspan="2" align="center" class="bk"><input type="submit" name="submit" value="Login"></td>
              </tr>
            </table>
          </div>
        </form></td>
    </tr>
  </table>
<p>&nbsp;</p></div>
</body>
</html>