<?php
$con=mysql_connect("localhost","root","kil54");
if(!$con)
{
die("couldn't connect:".mysql_error());
}
mysql_select_db('mahi',$con); 
?>