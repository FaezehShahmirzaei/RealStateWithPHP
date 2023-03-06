<?php
require('top.htm');
$register_script = "./registermlek.php";
$register_script1 = "./search_with.php";
$register_script2 = "./registermelk.php";


//***************************************************************** 
function auth_user($username, $password) 
{
   $link_id = mysql_connect('localhost','root','');
   mysql_select_db("amlak",$link_id);
   $query = "select  name  from malek 
                             where username = '".$username."' 
                             and  password = '".$password."'";
   $result = mysql_query($query,$link_id);
   if($result)
       {
	   $query_data = mysql_fetch_row($result);
      return $query_data[0];
	  }
}
//*****************************************************************

function login_form()
{
   global $PHP_SELF;
 ?>
<html>
<head>
<title>Login</title>
</head>
<body>
<form method="post" action="<? echo $PHP_SELF ?>">
   <div align="center"><center>
      <h3>Welcome to register page.</h3>
   <table border="1" width="200" cellpadding="2">
      <tr>
         <th width="18%" align="right" nowrap>User name</th>
         <td width="82%" nowrap>
            <input type="text" name="username" size="8">
         </td>
      </tr>
      <tr>
         <th width="18%" align="right" nowrap>Password</th>
         <td width="82%" nowrap>
            <input type="password" name="password" size="8">
         </td>
      </tr>
      <tr>
         <td width="100%" colspan="2" align="center" nowrap>
            <input type="submit" value="LOGIN" name="Submit">
         </td>
      </tr>
   </table>
   </center></div>
</form>
</body>
</html>
<?php
}
  login_form();
  $submit = $_POST['Submit'];
  $username = $_POST['username'];
  $password =  $_POST['password'];
  $name = auth_user($username, $password);
  if ($submit == 'LOGIN')
 {
   if(!$name)
   {
      echo '<table border = "1" align = "center">';
       echo '<tr><td align = "center">Authorization failed. </td><tr>' ;
       echo "<tr><td>If you're not a member yet, click " .
           "on the following link to register.";
       echo "<A HREF=\"$register_script\">Membership</A></td></tr></table>";
    }
	else
    {
	echo '<table border ="1" align = "center">';
    echo '<tr><td align = "center"><b>You are  welcome '. $name.'. You can  go on. </b></td></tr>';
	echo "<tr><td>";
	echo "<A HREF=\"$register_script1\">search home</A></td></tr>";
	echo "<tr><td>";
	echo "<A HREF=\"$register_script2\">register home</A></td></tr></table>";
	}
 }
 require('bottom.htm');
?>
