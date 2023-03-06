<?php
require('top.htm');
require('menu.php');
function in_use($type,$metr,$floor,$carpark,$store,$addr,$link_db)
{
   global $user_tablename;
   $query = "select * from melk  where  type='$type' and metr='$metr' and floor='$floor' and carpark='$carpark' and store='$store' and addr='$addr'";
   $result = mysql_query($query);
   if(!mysql_num_rows($result))
        return 0;
   else return 1;
}
function error_message($msg)
{
   echo "<script> alert (\"Error: $msg\") </script>";
   exit;
}

function register_form()
{
  global $type, $metr, $floor, $carpark, $store,$addr;
  global $PHP_SELF;
  ?>
  <center><h4>Insert the attribute of your home</h4></center>
  <form method = "post"  action = "<?php echo $PHP_SELF ?>">
  <input type = "hidden" name = "action"  value = "register">
   <center><table  border = "1" width = "60%">
    <tr>
      <th width="30%" nowrap>type</th>
      <td width="70%"><select size="1" name="type">
	<option>rahn</option>
	<option>ejare</option>
	<option>rahn va ejare</option>
	<option>kharid</option>
	<option>forush</option>
	</select></td>
    </tr>
	<tr>
      <th width="30%" nowrap>metr</th>
      <td width="70%"><input type="text" name="metr" size="20"></td>
    </tr>
	<tr>
      <th width="30%" nowrap>floor</th>
      <td width="70%"><input type="text" size="20" name="floor"></td>
    </tr>
    <tr>
      <th width="30%" nowrap>carpark</th>
      <td width="70%"><input type="checkbox" size="20" name="carpark" value="ON">yes</td>
    </tr>
    <tr>
      <th width="30%" nowrap>store</th>
      <td width="70%"><input type="checkbox" size="20" name="store" value="ON">yes</td>
    </tr>
    <tr>
      <th width="30%" nowrap>address</th>
      <td width="70%"><input type="text" name="addr" size="80"></td>
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

function create_account()
{
//----------------- SET VALUES -----------------------------------------------
   $type = $_POST['type'];
   $metr =   $_POST['metr'] ;
   $floor =   $_POST['floor'] ;
   $carpark =   $_POST['carpark'] ;
   $store =   $_POST['store'] ;
   $addr =   $_POST['addr'] ;
   if ($store==ON) $store=1;
   else $store=0;
   if ( $carpark==ON)  $carpark=1;
   else  $carpark=0;
//----------------- CHECK VALUES -----------------------------------------------
   if(empty($metr)) error_message("Enter the metraj of your home!");
   if(empty($floor)) error_message("your home havent eny floor?!");
   if(empty($addr)) error_message("input the address!");
//------------------- link with data bASE ----------------------------------------
   $link_db = mysql_connect('localhost','root','');
   $my=mysql_select_db("amlak",$link_db);
   if(in_use($type,$metr,$floor,$carpark,$store,$addr,$link_db))
        error_message("your home registered before!");
   $query = "insert into melk
                   (mcod,type,metr,floor,carpark,store,addr) values
                   (NULL,'$type','$metr','$floor','$carpark','$store','$addr')";
  $result = mysql_query($query,$link_db);
   if(!$result) echo('Error in Registering you! Try later please.');
   if(!$link_db) echo('Error in OPEN DATABASE! Try later please.');
   $code = mysql_insert_id($link_db);
?>   

<center><h3>
<?php echo $code ?>, thank you for registering with us!
</h3></center>
<div align="center"><center><table border="1" width="60%"> 
  <tr>
    <th width="30%" nowrap>code</th>
    <td width="70%"><?php echo $code ?></td>
  </tr>
  <tr>
    <th width="30%" nowrap>Type</th>
    <td width="70%"><?php echo $type ?></td>
  </tr>
  <tr>
    <th width="30%" nowrap>Metraj</th>
    <td width="70%"><?php echo $metr ?></td>
  </tr>
  <tr>
    <th width="30%" nowrap>Floor</th>
    <td width="70%"><?php echo $floor ?></td>
  </tr>
  <tr>
    <th width="30%" nowrap>carpark</th>
    <td width="70%"><?php echo $carpark ?></td>
  </tr>
  <tr>
    <th width="30%" nowrap>store</th>
    <td width="70%"><?php echo $store ?></td>
  </tr>
  <tr>
    <th width="30%" nowrap>address</th>
    <td width="70%"><?php echo $addr ?></td>
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
