<?php
require('top.htm');
require('menu.php');
$field = $_POST['field'];
$q = $_POST['query'];
$db = mysql_connect("localhost","root","");
if(!$db)
{
   echo "Not connect ";
   exit;
}
if (!mysql_select_db('amlak',$db))
{
   echo "cannot open bank" ;
   exit;
}
switch($field)
{
   case 'type' :
         $query = "select  * from melk where type='$q'";
         break;
   case 'address' :
         $query = "select  * from melk where addr = '$q'";
         break;
//    default:
//         $query = "select * from books where  made = '$q'";
}
$result = mysql_query("$query");
if(!$result)
{
    echo " Not Find Anything";
    exit;
}
echo '<table border = "1" align = "center">';
echo "<tr>
  <th> TYPE</th>
  <th> METRAJ</th>
  <th> FLOOR</th>
  <th> CARPARK </th>
  <th> STORE </th>
  <th> ADDRESS </th>
</tr>";
$num = mysql_num_rows($result);
 for($i = 0; $i < $num; $i ++)
    {
        $row = mysql_fetch_row($result);
        echo '<tr>';
        echo "<td><b> $row[1]</b> </td>";
        echo "<td><b> $row[2]</b> </td>";
        echo "<td><b> $row[3]</b> </td>";
        echo "<td><b> $row[4]</b> </td>";
        echo "<td><b> $row[5]</b> </td>";
		echo "<td><b> $row[6]</b> </td>";
        echo '</tr>';
 } 
echo "<tr> <td><b> Number = $num </td></tr>";
echo "</table>";
 mysql_close();
echo "<p></p>";
require('bottom.htm');
?> 
