<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);
if($_SESSION['lang_id'])
{
	$lang_id=$_SESSION['lang_id'];
}
if ($_POST['submitForm'] == "yes")
{    
     if($id==''){
	 $sql_ch=executeQuery("select * from country  where  country_English='$country_English'");
     if(mysql_num_rows($sql_ch))
	 {
	    $_SESSION['msg']=='Country Name is  Aready exist';
	    header("Location: country_addf.php");
		exit();
	 }else {
	  executeQuery("insert into country set country_English='$country_English',country_Turkish='$country_Turkish',status=1");
	 }
  }else {
        executeQuery("update country set country_English='$country_English', country_Turkish='$country_Turkish' where country_id='$id'");
	 }	  
       header("Location: country_list.php");
	   exit();
}
if($id){
		$sql="select * from country where country_id='$id'";
		$result=executeQuery($sql);
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
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function validate_form(obj)
{
  	var msg='Incomplete Data, Kindly fill required fields...\n\n', flag=false;
   	if(obj.country_English.value == '') msg+='- Please Enter Country English \n';
	if(obj.short_name.value == '') msg+='- Please Enter Short Name \n';
   	if(msg == 'Incomplete Data, Kindly fill required fields...\n\n')
		return true;
		else{
		alert(msg);
		return false;
	} 
}
</script>
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
    <td width="1" bgcolor="#398FA8"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td height="400" align="center" valign="top">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="21" align="left" class="txt">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr bgcolor="#EDEDED">
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Country</td>
                      <td width="24%" align="right"><input name="b1" type="button" class="button" id="b1" value="Country Manager" onClick="location.href='country_list.php'">
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top">
			<br />
              <form action="country_addf.php" method="post" enctype="multipart/form-data" name="frm"    onsubmit="return validate_form(this)">
			  <input type="hidden" name="submitForm" value="yes">
			  <input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
				<table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#398FA8"> 
					<TD height="25" colspan="2" class="bigWhite"><strong><?php if($id==''){?>
				    Add New
				    <?php }else{?>
				    Edit
				    <?php }?> 
				    Country Details</strong>
				    </TD>
				</TR>
			    <?php if($_SESSION['sess_msg']!=''){?>
				<tr>
					<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></td>
				</tr>
				<?php }//SELECT * FROM `country` WHERE `short_name`, `country_English`, `country_Turkish`, `country_id`, `status`
				?>
				<tr class="oddRow">
					<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Required Fieldsc</td>
				</tr>
				<tr class="evenRow">
				  <td class="txt" align="right"><strong>Country English:</strong></td>
				  <td align="left"><input type="text" name="country_English" size="45" value="<?php echo $country_English;?>" class="txtfld" />
			      <span class="txt"><span class="warning">*</span></span></td>
				  </tr>
				<tr class="evenRow">
					<td  align="right" width="35%" class="txt"><strong >Country Turkish:  </strong></td>
				  <td align="left" width="65%"><input type="text" name="country_Turkish" size="45" value="<?php echo $country_Turkish;?>" class="txtfld" />
                    <span class="txt"><span class="warning"></span></span></td>
				</tr>
				<TR class="oddRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Submit"/> <?php if($id==''){?><input type="reset" name="reset" class="button" value="Reset" /><? }?></TD>
				</TR>
				</table>
			  </form>
			</td>
       </tr>
     </table>
	</td>
	<td width="20" valign="top" bgcolor="#EDEDED">&nbsp;</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>