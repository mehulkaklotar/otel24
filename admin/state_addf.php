<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);

if ($_POST['submitForm'] == "yes") {
  	 	if($id)
		$sql="select * from state where name_English='$name_English' and id<>$id ";
		else
	 	$sql="select * from state where name_English='$name_English' and country_id='$country_id'";
	    $res=executeQuery($sql);
		if($rows=mysql_num_rows($res))
		{
			 $_SESSION['sess_msg']='This State is already exist';
		}
		else
		{
			if($id==''){
			$sql = "insert into state set name_English='$name_English',name_Turkish='$name_Turkish',country_id='$country_id', status=1";
						executeUpdate($sql);
			}else{		
			$sql = "update state set name_English='$name_English',name_Turkish='$name_Turkish', country_id='$country_id' ";
			$sql.=" where id='$id'";
			executeUpdate($sql);
			}
			
			header("Location:state_list.php");
			exit();
		}	
    
}
if($id){
	$sql="select * from state where id='$id'";
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
 function validate(obj)
 {
    if(obj.name_English.value=='')
 {
  alert("Please  Enter State English ");
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
    <td width="1" bgcolor="#398FA8"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td height="400" align="center" valign="top">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="21" align="left" class="txt">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr bgcolor="#EDEDED">
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage State</td>
                      <td width="24%" align="right"><input name="b1" type="button" class="button" id="b1" value="State Manager" onClick="location.href='state_list.php'">
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top"><br>
              <form action="state_addf.php" method="post" enctype="multipart/form-data" name="frm" onsubmit="return validate(this)">
			  <input type="hidden" name="submitForm" value="yes">
			  <input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
			 
			  <table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#398FA8"> 
					<TD height="25" colspan="2" class="bigWhite"><strong><?php if($id==''){?>
				    Add New
				    <?php }else{?>
				    Edit
				    <?php }?> 
				    State Details</strong>
				    </TD>
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
				  <td class="txt" align="right"><strong> State English</strong></td>
				  <td align="left"><input type="text" name="name_English" size="25" value="<?php echo $name_English;?>" class="txtfld" />
			      <span class="warning"> *</span></td>
				  </tr>
				<tr class="oddRow">
				  <td class="txt" align="right"><strong> State Turkish</strong></td>
				  <td align="left"><input type="text" name="name_Turkish" size="25" value="<?php echo $name_Turkish;?>" class="txtfld" />
			      <span class="warning"> </span></td>
				  </tr>
				<tr class="evenRow">
					<td width="35%" align="right" class="txt"><strong>Country</strong></td>
					<td align="left" width="65%">
					  <select name="country_id" class="txtfld txt" style="width:150px; ">
					  <?php $aa=mysql_query("select * from country where status=1");
					  		while($aa1=mysql_fetch_assoc($aa))
							{?>
								<option value="<?=$aa1['country_id']?>" <?php if($country_id==$aa1['country_id']){?>selected<? } ?>><?=$aa1['country_English']?></option>
							<? } ?>
					  </select>
				    </td>
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