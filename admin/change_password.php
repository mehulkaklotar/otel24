<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_POST);
if ($_POST['submitForm'] == "yes") {
        $query=mysql_query("select password,username from tbl_admin where username='$old_username' and password='$old_password'");
		$result=mysql_fetch_array($query);
		if($old_username!=$result['username']){
		$_SESSION['sess_msg']='Old Username is Wrong';
		}
		else if($old_password!=$result['password']){
		$_SESSION['sess_msg']='Old Password is Wrong';
		}
		else{
		mysql_query("update tbl_admin set password='$new_password',username='$new_username' where username='$old_username' and password='$old_password'");
		$_SESSION['sess_msg']='Your Info has been updated successfully';
		}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
<script>
function fcheck(obj)
{
	if(obj.old_password.value=='')
	{
		alert("Please Enter Old Password!");
		return false;
	}
	else if(obj.new_password.value=='')
	{
		alert("Please Enter New Password!");
		return false;
	}
	else if(obj.confirm_password.value=='')
	{
		alert("Please Enter Confirm Password!");
		return false;
	}
	else if(obj.new_password.value != obj.confirm_password.value)
	{
		alert("Must be same  New and Confirm Password!");
		return false;
	}
	else
	{
		return true;
	}
}
</script>
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
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="76%" height="25" class="title"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Change Password</td>
                    </tr>
              </table>
			</td>
          </tr>
		  <?php $query1=mysql_query("select * from tbl_admin where id='".$_SESSION['sess_admin_id']."'");
                $result1=mysql_fetch_array($query1);?>
		<tr>
            <td height="400" align="center" valign="top"><br>
              <form action="change_password.php" method="post" enctype="multipart/form-data" onsubmit="return fcheck(this);">
			  <input type="hidden" name="submitForm" value="yes">
			  <input type="hidden" name="id" class="txtfld" value="<?php echo $result1['id'];?>">
				<table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left"> 
					<TD height="25" colspan="2" class="blueBackground">
				    Change Password</TD>
				</TR>
				<?php if($_SESSION['sess_msg']!=''){?>
				<tr>
					<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></td>
				</tr>
				<?php }?>
				<tr class="evenRow">
					<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Required Fields</td>
				</tr>
				<tr class="oddRow">
					<td class="bldTxt" align="right">Username :</td>
					<td align="left" class="txt"><?php echo $result1['username']?></td>
				</tr>
				<tr class="evenRow">
					<td class="bldTxt" align="right">Old Password :</td>
					<td align="left"><input type="password" name="old_password" size="40" class="txtfld" /> <span class="warning">*</span></td>
				</tr>
				<tr class="oddRow">
					<td class="bldTxt" align="right">New Password :</td>
					<td align="left"><input type="password" name="new_password" size="40" class="txtfld" /> <span class="warning">*</span></td>
				</tr>				
				<tr class="evenRow">
					<td class="bldTxt" align="right">Confirm Password :</td>
					<td align="left"><input type="password" name="confirm_password" size="40" class="txtfld" /> <span class="warning">*</span></td>
				</tr>
				<TR class="oddRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Submit"/> <input type="reset" name="reset" class="button" value="Reset" /></TD>
				</TR>
				
				</table>
			  </form>
				</td>
       </tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>
