<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);
if ($_POST['submitForm'] == "yes") {
if($id==''){
$sqlcheck=mysql_query("select * from tbl_category where category_English='$category_English'");
$cnum=@mysql_num_rows($sqlcheck);
}else{
$sqlcheck=mysql_query("select * from tbl_category where category_English='$category_English' and id!='$id'");
$cnum=@mysql_num_rows($sqlcheck);
}
if($cnum >0){
$_SESSION['sess_msg']='Category already exist!';
}else{
if($id==''){
executeQuery("insert into tbl_category set category_English='$category_English',category_Turkish='$category_Turkish',status=1,post_date=now()");
		$_SESSION['sess_msg']='Category has been added successfully!';
		header("Location: category_list.php");
		exit();
}	
else
 {   
		$sql = "update tbl_category set category_English='$category_English',category_Turkish='$category_Turkish'";
		$sql.=" where id='$id'";
		executeUpdate($sql);
		$_SESSION['sess_msg']='Category has been updated successfully!';
		header("Location: category_list.php");
		exit();

 }	
 }
 
 }
 
if($id){
	$result=executeQuery("select * from tbl_category where id='$id'");
	$num=mysql_num_rows($result);
	if($line=ms_stripslashes(mysql_fetch_array($result))){
		@extract($line);
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script>
function validEmailAddress(email)
{
		invalidChars = " /:,;~"
		if (email == "") 
		{
			return (false);
		}
		for (i=0; i<invalidChars.length; i++) 
		{
			badChar = invalidChars.charAt(i)
			if (email.indexOf(badChar,0) != -1) 
			{
				return (false);
			}
		}
		atPos = email.indexOf("@",1)
		if (atPos == -1) 
		{
			return (false);
		}
		if (email.indexOf("@",atPos+1) != -1) 
		{
			return (false);
		}
		periodPos = email.indexOf(".",atPos)
		if (periodPos == -1) 
		{
			return (false);
		}
		if (periodPos+3 > email.length)	
		{
			return (false);
		}
			
		return (true);
}
function validate_form(obj)
{
  	if(obj.category_English.value=='')
	{
		alert("Category English can not be blank");
		return false;
	}
	else
	{
		return true;
	}
}
</script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
<script src="../codelibrary/js/script_tmt_validator.js" type="text/javascript"></script>
</head>
<body onload="javascript:document.frm.category.focus()">
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Category</td>
                      <td width="24%" align="right"><input name="b1" type="button" class="button" id="b1" value="Manage Category" onClick="location.href='category_list.php'">
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top"><br>
                <form action="category_addf.php" method="post" enctype="multipart/form-data" name="frm" onsubmit="return validate_form(this)">
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
                <table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left"> 
					<TD height="25" colspan="2" class="blueBackground"><?php if($id){?>Edit<?php }else{?>Add<?php }?> Category Details</TD>
				</TR>
			    <?php if($_SESSION['sess_msg']!=''){?>
				<tr>
					<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></td>
				</tr>
				<?php }?>
				<tr class="oddRow">
					<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Required Fields</td>
				</tr>
				<tr class="evenRow">
					<td class="bldTxt" align="right" width="35%">Category(English)</td>
					<td align="left" width="65%"><input type="text" name="category_English" size="45" class="txtfld txt" value="<?php echo $category_English;?>"   />&nbsp;<span class="vwarning">*</span></td>
				</tr>
				<tr class="oddRow">
					<td class="bldTxt" align="right" width="35%">Category(Turkish)</td>
					<td align="left" width="65%"><input type="text" name="category_Turkish" size="45" class="txtfld txt" value="<?php echo $category_Turkish;?>"   />
					&nbsp;</td>
				</tr>
				<TR class="evenRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Submit"/>&nbsp;<input type="reset" name="reset" class="button" value="Reset" /></TD>
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