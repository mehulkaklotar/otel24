<?php
session_start();
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="fade.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="swfobject.js"></script>
<link type="text/css" rel="stylesheet" href="autocomplete.css">
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body class="yui-skin-sam">
<form name="frm">
<input type="text" id="searchbar" name="searchbar" value="dfjdsh" class="searchbar head2 searchbara keyboardInput input"  onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
<div id="container1" style="width:250px;"></div></form>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/animation/animation-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/autocomplete/autocomplete-min.js"></script>
<script type="text/javascript">
<?php
$query = mysql_query("select distinct city_English  from city");
			
			if(mysql_num_rows($query) > 0) {
				$string="";
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['city_English']))."\" ";
				}
				
				$string = substr($string,1);
			}
?>
<?php
$query = mysql_query("select distinct city_Turkish from city");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['city_Turkish']))."\" ";
				}
			}
?>
<?php
$query = mysql_query("select distinct country_English  from country");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['country_English']))."\" ";
				}
				
				
			}
?>
<?php
$query = mysql_query("select distinct country_Turkish from country");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['country_Turkish']))."\" ";
				}
			}
?>
<?php
$query = mysql_query("select distinct name_English  from state");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['name_English']))."\" ";
				}
				
				
			}
?>
<?php
$query = mysql_query("select distinct name_Turkish from state");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['name_Turkish']))."\" ";
				}
			}
?>
<?php
$query = mysql_query("select distinct local_English  from local");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['local_English']))."\" ";
				}
				
				
			}
?>
<?php
$query = mysql_query("select distinct local_Turkish from local");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['local_Turkish']))."\" ";
				}
			}
?>
<?php
$query = mysql_query("select distinct village_English  from village");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['village_English']))."\" ";
				}
				
				
			}
?>
<?php
$query = mysql_query("select distinct village_Turkish from local");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['village_Turkish']))."\" ";
				}
			}
?>
<?php
$query = mysql_query("select distinct zipcode_English  from tbl_zip");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['zipcode_English']))."\" ";
				}
				
				
			}
?>
<?php
$query = mysql_query("select distinct zipcode_Turkish from tbl_zip");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['zipcode_Turkish']))."\" ";
				}
			}
?>
<?php
$query = mysql_query("select distinct hotel_name_Turkish  from tbl_hotel");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['hotel_name_Turkish']))."\" ";
				}
				
				
			}
?>
<?php
$query = mysql_query("select distinct hotel_name from tbl_hotel");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['hotel_name']))."\" ";
				}
			}
?>
var countries = new Array(<?php echo $string;?>);
var myDataSource = new YAHOO.util.LocalDataSource(countries);
var myAC = new YAHOO.widget.AutoComplete("searchbar", "container1", myDataSource);
</script>
                                            
</body>
</html>
