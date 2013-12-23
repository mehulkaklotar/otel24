<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
include("FCKeditor/fckeditor.php");
validate_admin();
//SELECT * FROM `tbl_hotel` WHERE `id`, `hotel_name`, `category`, `subcategory`, `rate`, `description`, `image`, `video`, `activities`, `services`, `generals`, `rooms`, `prices`, `historical`, `entertainment`, `contact`, `contact_hotel`, `address`, `country`, `city`, `state`, `zipcode`, `gpoint`, `phone`, `fax`, `email`, `status`, `post_date`
@extract($_REQUEST);
if ($_POST['submitForm'] == "yes")
 {    
	if($id){
				$email_dup_query=executeQuery("select id from tbl_hotel where id!=$id and hotel_name='$hotel_name'");
			 }else{
				$email_dup_query=executeQuery("select id from tbl_hotel where hotel_name='$hotel_name'");
			 }
			if(mysql_num_rows($email_dup_query)>0){
				 $_SESSION['sess_msg']='This Hotel already exist';
			 }else{
				
				if($_FILES['image']['size'] > 0){
					$image1 = time().$_FILES['image']['name'];
					@move_uploaded_file($_FILES['image']['tmp_name'],"../upload_image/hotel_img/".$image1);
					@copy("../upload_image/hotel_img/".$image1, "../upload_image/hotel_img/thumb/".$image1);
					resize_img("../upload_image/hotel_img/thumb/".$image1, 97, '', false, 80, 0,'');				
				}
				
				if($_FILES['video']['size'] > 0){
					$video1 = time().$_FILES['video']['name'];
					@move_uploaded_file($_FILES['video']['tmp_name'],"../upload_image/hotel_video/".$video1);
				}
				
				if($id=='')
				   {
					 executeQuery("insert into tbl_hotel set hotel_name='$hotel_name',category='$category',subcategory='$subcategory',rate='$rate',description='$description',image='$image1',video='$video1',activities='$activities',services='$services',generals='$generals',rooms='$rooms',prices='$prices',historical='$historical',entertainment='$entertainment',contact='$contact',contact_hotel='$contact_hotel',address='$address',country='$country',city='$city',state='$state',zipcode='$zipcode',gpoint='$gpoint',phone='$phone',fax='$fax',email='$email',status=1,post_date=now()");
					  $_SESSION['sess_msg']='Hotel added successfully!';
				   }	
				 else
				   {     
					 $sql = "update tbl_hotel set hotel_name='$hotel_name',category='$category',subcategory='$subcategory',rate='$rate',description='$description',activities='$activities',services='$services',generals='$generals',rooms='$rooms',prices='$prices',historical='$historical',entertainment='$entertainment',contact='$contact',contact_hotel='$contact_hotel',address='$address',country='$country',city='$city',state='$state',zipcode='$zipcode',gpoint='$gpoint',phone='$phone',fax='$fax',email='$email'";
					 
					if($image1){
						$sql_un = mysql_query("select image,id from tbl_hotel where id='$id'");
						$sql_res = @mysql_num_rows($sql_un);
						if($sql_res>0){
							$un_imag = mysql_fetch_array($sql_un);
							@unlink("../upload_image/hotel_img/".$un_imag['image']);
							@unlink("../upload_image/hotel_img/thumb/".$un_imag['image']);
						}
							$sql.=",image='".$image1."'";
				}
					if($video1){
						$sql_un = mysql_query("select video,id from tbl_hotel where id='$id'");
						$sql_res = @mysql_num_rows($sql_un);
						if($sql_res>0){
							$un_imag = mysql_fetch_array($sql_un);
							@unlink("../upload_image/hotel_video/".$un_imag['video']);
						}
							$sql.=",video='".$video1."'";
				}
				
					 $sql.=" where id='$id'";
					 executeUpdate($sql);
					  $_SESSION['sess_msg']='Hotel updated successfully!';
				   }
			 header("Location: hotel_list.php?product_id=".$_REQUEST['product_id']);
			 exit();
	}
  }
  
if($id){
	$result=executeQuery("select * from tbl_hotel where id='$id'");
	$num=mysql_num_rows($result);
	if($line=ms_stripslashes(mysql_fetch_array($result))){
	@extract($line);
	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>




<script>
function add_image()
{	
	document.getElementById('newid').innerHTML='<table width="100%"  border="1" cellspacing="0" cellpadding="0"><tr><td>&nbsp;<td><input type="file" name="image[]" size="25" /><input type="button" name="cc" class="button"  value="add more" onclick="javascript: add_image();"></td></tr><tr><td id="newid" colspan="2">&nbsp;</td></tr></table>';
}
</script>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />

</head>
<body >
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Hotel</td>
                      <td width="24%" align="right"><input name="b1" type="button" class="button" id="b1" value="Manage Hotel" onClick="location.href='hotel_list.php'">
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top"><br>
                <form action="hotel_addf.php" method="post" enctype="multipart/form-data"  name="userfrm" onsubmit="return valid_form(this);">
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" value="<?php echo $id;?>">
                <table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#4096AF"> 
					<TD height="25" colspan="2" class="blueBackground"><?php if($id){?>Edit<?php }else{?>Add New<?php }?> Hotel Details</TD>
				</TR>
			    <?php if($_SESSION['sess_msg']!=''){?>
				<tr>
					<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; $_SESSION['sess_msg']='';?></td>
				</tr>
				<?php }?>
				<tr class="oddRow">
					<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Required Fields</td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Add Photos</strong></td>
					<td align="left" ><input type="file" name="image[]" size="25" /><input type="button" name="cc" class="button"  value="add more" onclick="javascript: add_image();">
					</td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; " id="newid" colspan="2">&nbsp;</td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Add Videos</strong></td>
					<td align="left" ><input type="file" name="video" size="25" />&nbsp;<span class="warning"></span>
					<?php 
					if($line['video']){?>&nbsp;<a href="../upload_image/hotel_video/<?php echo $line['video'];?>" class="orangetxt" target="_blank">View</a><?php }?></td>
				</tr>

	<TR class="oddRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Submit"/>&nbsp;<input type="reset" name="reset" class="button" value="Reset" /></TD>
				</TR>
				
                </table>
			  </form>
				</td>
       </tr>
	   				<TR>
					<TD align=center colspan=100%>&nbsp;</TD>
				</TR>

     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>
<script>
<?php if($id){ 
 if($line['category']){?>
linkprofile("<?php echo $line['category'];?>");
<?php } ?>

<?php if($line['country']){?>
linkprofile1("<?php echo $line['country'];?>");
<?php } ?>

<?php if($line['state']){?>
linkprofile2("<?php echo $line['state'];?>");
<?php } ?>

<?php if($line['city']){?>
linkprofile3("<?php echo $line['city'];?>");

<?php } } ?>
</script>
