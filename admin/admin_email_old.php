<?php
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_POST);
if ($_POST['submitForm'] == "yes") {
		if($new_email==''){
		$_SESSION['sess_msg']='Please Enter Valid Email';  	
		}
		else{
		mysql_query("update tbl_admin set email='$new_email',price='$price',paypal_email='$paypal_email' where id='".$_SESSION['sess_admin_id']."'");
		$_SESSION['sess_msg']='Your record has been Updated Successfully';
		
$sel=mysql_query("select * from tbl_admin where id=1");	
$sel_data=mysql_fetch_assoc($sel);

}
}?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
<script src="../codelibrary/js/script_tmt_validator.js" type="text/javascript"></script>
</head>
<body onload="javascript:document.frm.new_email.focus()">
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
                      <td width="76%" height="25" class="title"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Admin Email</td>
                    </tr>
                </table>
			</td>
          </tr>
<?php   $query=mysql_query("select * from tbl_admin where id='".$_SESSION['sess_admin_id']."'");
		$result=mysql_fetch_array($query);?>
		<tr>
            <td height="400" align="center" valign="top"><br>
              <form action="admin_email.php" method="post" enctype="multipart/form-data" name="frm" tmt:validate="true">
			  <input type="hidden" name="submitForm" value="yes">
				<table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left"> 
					<TD height="25" colspan="2" class="blueBackground">
				    Change Email</TD>
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
					<td width="32%" align="right" class="bldTxt">Enter Email :</td>
					<td width="68%" align="left"><input type="text" name="new_email" size="45" class="txtfld" tmt:required="true" tmt:errorclass="invalid" tmt:message='Please Enter Valid Email' tmt:pattern="email" value="<?php echo $result["email"];?>" /> <span class="warning">*</span></td>
				</tr>
				<tr class="evenRow">
					<td class="bldTxt" align="right">Paypal Email :</td>
					<td align="left"><input type="text" name="paypal_email" size="45" class="txtfld" tmt:required="true" tmt:errorclass="invalid" tmt:message='Please Enter Valid Paypal Email' tmt:pattern="email" value="<?php echo $result["paypal_email"];?>" /> <span class="warning">*</span></td>
				</tr>
				<TR class="oddRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Submit"/> <input type="reset" name="reset" class="button" value="Reset" /></TD>
				</TR>
				
				</table>
			  </form>
				<br>
         </td>
       </tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>
