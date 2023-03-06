<?php
require('top.htm');
require('menu.php');
?>
<html dir="rtl">

<head>
<script language = "JavaScript">
<!--
function do_check (form)
{
 if (form.query.value=="") 
 {
    alert('Please make an entry in the product search field.');
    return false;
 } 
  else 
  {
    return true;
  }
}
-->
</script>

<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Search with</title>
</head>

<body>
<center>
<form method="POST" action="search.php" onSubmit = "return do_check(this);">
    <p dir="ltr">&nbsp;&nbsp; Search with :&nbsp; 
  <select size="1" name="field">
	<option>address</option>
	<option>type</option>
  </select>
   <input type="text" name="query" size="38">
	&nbsp;&nbsp;&nbsp; 
	<input type="submit" value="search" name="submitButton"></p>
</form>
</center>
</body>

</html>
<?php
require('bottom.htm');
?>