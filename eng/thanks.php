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
<div id="otelimg" align="center">
<img src="images/logo.png" />
</div>
<div class="thanks">
<p align="center">
Thank You For Registration!!!<br />
Please check your E-Mail for Activation...<br />
You can Sign-In after Successful Activation...<br />
<br />
<?php
$id="";
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
}
if($id=="")
{
?>
<a href="signin.php">Sign In</a>
<?php 
}
else
{
?>
<a href="hotelbooksignin.php?id=<?php echo $id; ?>">Sign In</a>
<?php }?>
</p>
</div>        
</div>                               
</body>
</html>
