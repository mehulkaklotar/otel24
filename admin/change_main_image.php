<?php 
require_once("../codelibrary/inc/variables.php");

$id = $_GET['id'];
	if(isset($_POST['submit'])){
		$change="update tbl_hotel_image set default_img='0'  where hotel_id='".$id."' ";  
			mysql_query($change) or die(mysql_error());			

		$new_img = "update tbl_hotel_image set default_img='1' where hotel_id='".$id."' and id='".$_POST['default_img']."' ";
		 	mysql_query($new_img) or die(mysql_error());
	}

print_r($sql_data);
?>
<html>
	<head>
		<title>Select Defualt Image</title>
	</head>
<body>
	<table width="100%" cellpadding="0" cellspacing="10" border="0">
	<form name="default_img" action="" method="post">
	<?php 
		$sql = "select * from tbl_hotel_image where hotel_id='".$id."' ";
		$sql_result = mysql_query($sql) or die(mysql_error());
				while($sql_data=mysql_fetch_array($sql_result)){
		?>
		<tr>
			<td><img src="../upload_image/hotel_img/<?php echo $sql_data['image']?>" width="100" height="100"></td>
			<td><input type="radio" name="default_img" value="<?php echo $sql_data['id']?>"></td>
		</tr>
		<?php }?>	
		<tr>
			<td><input type="submit" name="submit" value="submit"><td>
			<td><input type="reset" name="reset" value="Back"></td>
		</td>
		</form>
	</table>
</body>
</html>