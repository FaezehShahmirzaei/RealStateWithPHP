<?php
$fp=fopen("counter.txt","r");
$counter=fread($fp,10);
fclose($fp);
$counter++;
echo "you are visitor number :".$counter;
$fp=fopen("counter.txt","w");
fwrite($fp,$counter);
fclose($fp);
?>