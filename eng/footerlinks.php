 <?php 
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");
$content_id=$_REQUEST['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style.css" />
<link href="style1.css" rel="stylesheet" type="text/css" />
</head>
<body> 	        	                                 	
<div id="main">
<?php 
$content_sql="select description from tbl_content where id='".$content_id."'";
$content_res=mysql_query($content_sql);
$content_res=mysql_fetch_array($content_res);
echo $content_res['description'];
?>
</div>                                       
</body>
</html>
