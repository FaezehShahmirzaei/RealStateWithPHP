<?php
require('top.htm');
require('menu.php');
//***********************************************************************************
function in_use($username,$link_id)
{
   global $user_tablename;
   $query = "select username from malek  where  username = '$username'";
   $result = mysql_query($query);
   if(!mysql_num_rows($result))
        return 0;
   else return 1;
}

//***********************************************************************
function error_message($msg)
{
   echo "<script> alert (\"Error: $msg\") </script>";
   exit;
}
///************************************************************************************
function register_form()
{
  global $family, $name, $email, $password, $username;
  global $PHP_SELF;
  ?>
  <center><h4>Create your account!</h4></center>
  <form method = "post"  action = "<?php echo $PHP_SELF ?>" >
  <input type = "hidden" name = "action"  value = "register">
   <center><table  border = "1" width = "60%">
    <tr>
      <th width="30%" nowrap>name</th>
      <td width="70%"><input type="text" name="name" size="20"></td>
    </tr>
	<tr>
      <th width="30%" nowrap>family</th>
      <td width="70%"><input type="text" name="family" size="20"></td>
    </tr>
	<tr>
      <th width="30%" nowrap>user name</th>
      <td width="70%"><input type="text" size="20" name="username"></td>
    </tr>
    <tr>
      <th width="30%" nowrap>password</th>
      <td width="70%"><input type="password" 
                             name="password" size="15"></td>
    </tr>
    <tr>
      <th width="30%" nowrap>Retype password</th>
      <td width="70%"><input type="password" 
                             name="password2" size="15" ></td>
    </tr>
    <tr>
      <th width="30%" nowrap>Email</th>
      <td width="70%"><input type="text" name="email" size="80"></td>
    </tr>
    <tr>
      <th width="30%" colspan="2" nowrap>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset"></th>
    </tr>
  </table>
  </center>
</form>
<?php
}
//************************************************************************

function create_account()
{
   $name = $_POST['name'];
   $password =   $_POST['password'] ;
   $password2 =   $_POST['password2'] ;
   $username =   $_POST['username'] ;
   $email =   $_POST['email'] ;
   $family =   $_POST['family'] ;
   if(empty($name)) error_message("Enter your name!");
   if(empty($password)) error_message("Enter your desired password!");
   if(strlen($password) < 4 ) error_message("password too short!");
   if(empty($password2)) 
                  error_message("Retype your password for verification!");
   if(empty($username)) error_message("Enter your username!");
   if(empty($email)) error_message("Enter your email address!");
   if($password != $password2)
      error_message("Your desired password and retyped password mismatch!");

   $link_id = mysql_connect('localhost','root','');
   mysql_select_db("amlak",$link_id);
   if(in_use($username,$link_id))
        error_message("$username is in use. Please choose a different user name.");
   $query = "insert into malek
                   (cod,name,family,password,username,email) values
                   (NULL,'$name','$family','$password','$username','$email')";
  $result = mysql_query($query,$link_id);
  echo  $result.'<br>';
   if(!$result) echo('Error in Registering you! Try later please.');
   if(!$link_id) echo('Error in OPEN DATABASE! Try later please.');
   $usernumber = mysql_insert_id($link_id);
?>   

<center><h3>
<?php echo $username ?>, thank you for registering with us!
</h3></center>
<div align="center"><center><table border="1" width="60%">
  <tr>
    <th width="30%" nowrap>User Number</th>
    <td width="70%"><?php echo $usernumber ?></td>
  </tr>
  <tr>
    <th width="30%" nowrap>Name</th>
    <td width="70%"><?php echo $name ?></td>
  </tr>
  <tr>
    <th width="30%" nowrap>Family</th>
    <td width="70%"><?php echo $family ?></td>
  </tr>
  <tr>
    <th width="30%" nowrap>Desired Password</th>
    <td width="70%"><?php echo $password ?></td>
  </tr>
  <tr>
    <th width="30%" nowrap>User name</th>
    <td width="70%"><?php echo $username ?></td>
  </tr>
  <tr>
    <th width="30%" nowrap>Email</th>
    <td width="70%"><?php echo $email ?></td>
  </tr>
 </table>
 </center></div>
 <?php
}

$action = $_POST['action'];
switch($action)
{
   case "register": 
        create_account();
        break;
   default:
        register_form();
   break;
}    
require('bottom.htm');
?>
