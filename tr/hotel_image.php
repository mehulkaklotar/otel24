 <?php 
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");
$hotel_id=$_GET['id'];


$sql="select * from tbl_hotel where id='".$hotel_id."'";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$hotel_name=$row['hotel_name_Turkish'];

$imgsql="select * from tbl_hotel_image where hotel_id='".$hotel_id."'";
$imgres=mysql_query($imgsql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style.css" />
</head>

<body>

<div id="main1">
<table>
	<caption><?php echo $hotel_name; ?></caption>
    <?php
	$cnt=0;
	 while($imgrow=mysql_fetch_array($imgres))
	 {
	 $cnt++;
	 ?>
     <tr>
     	<td><img src="../upload_image/hotel_img/<?php echo $imgrow['image']; ?>" height="150" width="150" /></td>
     </tr>
     <?php if($cnt%3==0){echo "</tr><tr>";} ?>     
     <?php }?>
</table>
</div>               

</body>
</html>
