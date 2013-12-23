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
OTEL 24 ile hesap açtığınız için tebrik ederiz!<br />
Lütfen hesabınızın aktivasyonu için E-Posta adresinizi kontrol ediniz.<br />
Aktivasyon işleminizi tamamladıktan sonra hesabınıza giriş yapabilirsiniz.<br />
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
<a href="signin.php">Benim Hesabım</a>
<?php 
}
else
{
?>
<a href="hotelbooksignin.php?id=<?php echo $id; ?>">Benim Hesabım</a>
<?php }?>
</p>
</div>        
</div>                               
</body>
</html>
