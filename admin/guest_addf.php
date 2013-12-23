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
				$email_dup_query=executeQuery("select id from tbl_guest where id!=$id and hotel='$hotel'");
			 }else{
				$email_dup_query=executeQuery("select id from tbl_guest where hotel='$hotel'");
			 }
			if(mysql_num_rows($email_dup_query)>0){
				 $_SESSION['sess_msg']='This Guest already exist';
			 }else{
				if($id=='')
				   {
					 executeQuery("insert into tbl_guest set message_English='$message_English',message_Turkish='$message_Turkish',hotel='$hotel',status=1,post_date=now(),name='".$_SESSION['sess_username']."',email='".$_SESSION['sess_email']."',phone='".$_SESSION['sess_phone']."'");
					  $_SESSION['sess_msg']='Hotel added successfully!';
					  
					  ///Update hotel
					  $sql = "SELECT * FROM tbl_guest WHERE hotel='$hotel'";
					  $res = executeQuery($sql);
					  $guestTotal = mysql_num_rows($res);
					
					 mysql_query("update tbl_hotel set guest='$guestTotal' where id='$hotel' ");
				   }	
				 else
				   {     
					 $sql = "update tbl_guest set message_English='$message_English',message_Turkish='$message_Turkish',hotel='$hotel'";
					 $sql.=" where id='$id'";
					 executeUpdate($sql);
					  $_SESSION['sess_msg']='Guest updated successfully!';
				   }
			 header("Location: guest_list.php");
			 exit();
	}
  }
  
if($id){
	$result=executeQuery("select * from tbl_guest where id='$id'");
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
<script src="ajax.js"></script>
<script>

function valid_form(obj)
{
	if(obj.hotel.value =='')
	{
		alert("Please Enter Hotel name!");
		obj.hotel_name.focus();
		return false;
	}
	else
	{
		return true;
	}
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Guest Book </td>
                      <td width="24%" align="right"><input name="b1" type="button" class="button" id="b1" value="Manage Guest Book" onClick="location.href='guest_list.php'">
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top"><br>
                <form action="guest_addf.php" method="post" enctype="multipart/form-data"  name="userfrm" onsubmit="return valid_form(this);">
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" value="<?php echo $id;?>">
                <table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#4096AF"> 
					<TD height="25" colspan="2" class="blueBackground"><?php if($id){?>Edit<?php }else{?>Add New<?php }?>Guest Book Details</TD>
				</TR>
			    <?php if($_SESSION['sess_msg']!=''){?>
				<tr>
					<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; $_SESSION['sess_msg']='';?></td>
				</tr>
				<?php }?>
				<tr class="oddRow">
					<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Required Fields</td>
				</tr>
				<?php if($id)
				{?>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Name</strong></td>
					<td align="left" class="txt" ><?=$line['name']?></td>
				</tr>
				<? } ?>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Message(English)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('message_English');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = $message_English;
														$ofckeditor->Create();?></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Message(Turkish)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('message_Turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = $message_Turkish;
														$ofckeditor->Create();?></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Hotel</strong></td>
					<td align="left" ><select name="hotel" class="txtfld txt" style="width:250px; " >
					<option value="">Select Hotel</option>
<?php //SELECT * FROM `tbl_category` WHERE 1`id`, `category`, `status`, `post_date`
if($_SESSION['sess_type']=='Hotel Owners')
$guesthotel=" and user_id=".$_SESSION['sess_admin_id'];
$sql=mysql_query("SELECT * FROM tbl_hotel where status=1 $guesthotel");
if(@mysql_num_rows($sql)>0){
	while($catline=mysql_fetch_array($sql)){
?>
					<option value="<?php echo $catline['id'];?>"<?php if($line['hotel']==$catline['id']){ echo 'selected';}?>><?php echo $catline['hotel_name'];?></option>
	<?php } }?>
					
					</select>&nbsp;<span class="warning">*</span>
					</td>
				</tr>
				<?php if($id)
				{?>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Date</strong></td>
					<td align="left" class="txt" ><?=$line['post_date']?></td>
				</tr>
				<? } ?>
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
