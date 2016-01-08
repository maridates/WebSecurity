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
        margin-right: 50px;
        margin-left: 50px;
    }
    img{
        height: 15vw;
        width: 15vw;
    }
</style>
<body background="pictures/background.jpg">
<div align="center">

<h1>Buy your products here</h1>
<table class="top" border="0" align="center">
    <tr>
        <td width="50%"><div align="center"><a href="animalcategory.php"><p class = one><img src="pictures/meat.png"></p></a></div></td>
        <td width="50%"><div align="center"><a href="nonanimalcategory.php"><p class = one><img src="pictures/plants.png" ></p></a></div></td>
    </tr>
  <tr> 
    <td height="113" colspan="2"><div align="center"> 
        <form name="cauta" method="post" action="searchresult.php">
          <p align="center"><font size="5">Search products (If it is empty 
            all the ads will be shown!)</font><br>
            <input type="text" name="cautare" size="81" maxlength="50">
          <p> 
            <input type="submit" name="trimit" value="Submit">
            <input type="reset" name="sterg" value="Reset">
        </form>
      </div></td>
  </tr>
</table>
</div>

