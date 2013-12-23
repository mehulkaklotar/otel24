<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);
if ($_POST['submitForm'] == "yes") {

if($id==''){
$sqlcheck=mysql_query("select * from tbl_subcategory where subcategory_English='$subcategory_English' and cat_id='$cat_id'");
$cnum=@mysql_num_rows($sqlcheck);
}else{
$sqlcheck=mysql_query("select * from tbl_subcategory where subcategory_English='$subcategory_English' and id!='$id' and cat_id='$cat_id'");
$cnum=@mysql_num_rows($sqlcheck);
}
if($cnum >0){
$_SESSION['sess_msg']='Subcategory already exist!';
}else{

if($id==''){
executeQuery("insert into tbl_subcategory set subcategory_English='$subcategory_English',subcategory_Turkish='$subcategory_Turkish',cat_id='$cat_id',status=1,post_date=now()");
		$_SESSION['sess_msg']='Subcategory has been added successfully!';
 		$ccid=$_REQUEST['cid'];
		header("Location: subcategory_list.php?cid=$ccid");
			exit();

}	
else
 {   
		$sql = "update tbl_subcategory set subcategory_English='$subcategory_English',subcategory_Turkish='$subcategory_Turkish',cat_id='$cat_id'";
		$sql.=" where id='$id'";
		executeUpdate($sql);
 		$ccid=$_REQUEST['cid'];
		$_SESSION['sess_msg']='Subcategory has been updated successfully!';
		header("Location: subcategory_list.php?cid=$ccid");
			exit();
 }		
 }
}
if($id){
	$result=executeQuery("select * from tbl_subcategory where id='$id'");
	$num=mysql_num_rows($result);
	if($line=ms_stripslashes(mysql_fetch_array($result))){
		@extract($line);
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script>
function validate_form(obj)
{
	if(obj.subcategory_English.value=='')
	{
		alert("Please Enter Subcategory English!");
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Subcategory</td>
                      <td width="24%" align="right"><input name="b1" type="button" class="button" id="b1" value="Manage Subcategory" onClick="location.href='subcategory_list.php?cid=<?php echo $_REQUEST['cid'];?>'">
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top"><br>
                <form action="subcategory_addf.php" method="post" enctype="multipart/form-data" name="frm" onsubmit="return validate_form(this);">
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
				<input type="hidden" name="cid" value="<?php echo $_REQUEST['cid']; ?>" />
				<input type="hidden" name="cat_id" value="<?php echo $_REQUEST['cid']; ?>" />
                <table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left"> 
					<TD height="25" colspan="2" class="blueBackground"><?php if($id){?>Edit<?php }else{?>Add<?php }?> Subcategory Details</TD>
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
					<td class="bldTxt" align="right" width="35%">Subcategory(English)</td>
					<td align="left" width="65%"><input type="text" name="subcategory_English"   size="45" class="txtfld txt" value="<?php echo $subcategory_English;?>"   />&nbsp;<span class="vwarning">*</span></td>
				</tr>
				<tr class="oddRow">
					<td class="bldTxt" align="right" width="35%">Subcategory(Turkish)</td>
					<td align="left" width="65%"><input type="text" name="subcategory_Turkish"   size="45" class="txtfld txt" value="<?php echo $subcategory_Turkish;?>"   />
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