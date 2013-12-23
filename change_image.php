<?php session_start();
require_once("../codelibrary/inc/variables.php");

if(isset($_GET['id'])){
	$hotel_id = $_GET['id'];
}

	if(isset($_POST['submit'])){

		$change="update tbl_hotel_image set default_img='0'  where hotel_id='".$hotel_id."' ";  

			mysql_query($change) or die(mysql_error());			

			
		$new_img = "update tbl_hotel_image set default_img='1' where hotel_id='".$hotel_id."' and id='".$_POST['default_img']."' ";

		 	mysql_query($new_img) or die(mysql_error());
			header("location:hotel_addf.php?id=$hotel_id");
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include("header.inc.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180" valign="top" class="rightBorder">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><?php include("left_menu.inc.php");?></td>
        </tr>
        <tr>
          <td width="23">&nbsp;</td>
        </tr>
      </table>
    <br />
    <br /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td height="400" align="center" valign="top">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="21" align="left" class="txt">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr>
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Change your profile image</td>
                      <td width="24%" align="right"><a href="hotel_addf.php?id=<?php echo $hotel_id;?>"><input name="b1" type="button" class="button" id="b1" value="Back to edit page"></a></td>
                    </tr>
              </table>
			</td>
          </tr>
		  <tr>
            <td height="400" align="center" valign="top"><br>
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></span> <br />
				    <form name="frm_list" method="post" >
				      <table width="50%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
					  <tr class="blueBackground">
					  	<td width="50%" align="center">Image</td>
						<td width="50%" align="center">Select</td>
					  </tr>
                        <?php 
								$sql = "select * from tbl_hotel_image where hotel_id='".$hotel_id."' ";
								$sql_result = mysql_query($sql) or die(mysql_error());
								if(mysql_num_rows($sql_result)>0){
									while($sql_data=mysql_fetch_array($sql_result)){
						?>
                        <tr>
							<td align="center"><img src="../upload_image/hotel_img/<?php echo $sql_data['image']?>" width="100" height="100"></td>
							<td align="center"><input type="radio" name="default_img" value="<?php echo $sql_data['id']?>" 
							<?php if($sql_data['default_img'] == '1'){echo 'checked="checked"';}else echo " ";?> /></td>
						</tr>
                        <?php } }else{?>
                        <tr align="center" class="oddRow">
                          <td colspan="10" class="warning">Sorry, Currently There are no record to display</td>
                        </tr>
                        <?php }?>
						<tr >
					  	<td width="50%" align="center"><input type="submit" name="submit" class="button" value="Update" /></td>
						<td width="50%" align="center"><a href="hotel_addf.php?id=<?php echo $hotel_id;?>"><input name="b1" type="button" class="button" id="b1" value="Back"></a></td>
					  </tr>
                      </table>
				    </form>
			      </td></tr>
			   <tr align="center">
                 <td>&nbsp;</td>
               </tr>
               <tr align="center">
                 <td>&nbsp;</td>
               </tr>
            </table>
         </td>
       </tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>