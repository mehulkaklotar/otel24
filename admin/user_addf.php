<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);
//SELECT * FROM `tbl_user` WHERE 1`id`, `user_id`, `password`, `full_name`, `email`, `contact_info`, `user_type`, `status`, `last_login_ip`, `last_login_date`, `total_loged_in`, `post_date`

if ($_POST['submitForm'] == "yes")
{    
     if($id){
		 $sql_ch=executeQuery("select * from tbl_user where (user_id ='$user_id' or email='$email') and id!='$id'");
		}else{
		 $sql_ch=executeQuery("select * from tbl_user where user_id ='$user_id' or email='$email'");
		}
     if(@mysql_num_rows($sql_ch)>0)
	 {
	    $_SESSION['sess_msg']='User Id / Email  already exist!';
	    header("Location: user_addf.php");
		exit();
	 }else {
	 	if($id==''){
		  executeQuery("insert into tbl_user set user_id='$user_id',password='$password',full_name='$full_name',email='$email',contact_info='$contact_info',user_type='$user_type',status=1,post_date=now()");
	    $_SESSION['sess_msg']='User added successfully!';
	 	}else {
			executeQuery("update tbl_user set user_id='$user_id',password='$password',full_name='$full_name',email='$email',contact_info='$contact_info',user_type='$user_type' where id='$id'");
	    $_SESSION['sess_msg']='User updated successfully!';
	 	}	  
		   header("Location: user_list.php");
		   exit();
}
}
if($id){
		$sql="select * from tbl_user where id='$id'";
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
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   
   	if(obj.user_id.value == ''){
	alert("Please Enter User Id !");
	obj.user_id.focus();
	return false;
	}
   	else if(obj.password.value == ''){
	alert("Please Enter Password !");
	obj.password.focus();
	return false;
	}
	else if(obj.full_name.value == ''){
	alert("Please Enter Full Name !");
	obj.full_name.focus();
	return false;
	} 
	else if(obj.email.value == ''){
	alert("Please Enter E-mail Address!");
	obj.email.focus();
	return false;
	} 
	else if(!reg(obj.email.value))
	{
	alert("Please Enter E-mail Address");
	obj.email.focus();
	return false;
	}
	/*else if(obj.contact_info.value == ''){
	alert("Please Enter Contact Information !");
	obj.contact_info.focus();
	return false;
	} */
	else if(obj.user_type.value == ''){
	alert("Please Select User Type !");
	obj.user_type.focus();
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Kullanıcı Yönetimi</td>
                      <td width="24%" align="right"><input name="b1" type="button" class="button" id="b1" value="Ana Sayfa" onClick="location.href='user_list.php'">
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top">
			<br />
              <form action="user_addf.php" method="post" enctype="multipart/form-data" name="frm"    onsubmit="return validate_form(this)">
			  <input type="hidden" name="submitForm" value="yes">
			  <input type="hidden" name="id" class="txtfld txt" value="<?php echo $id;?>">
				<table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#398FA8"> 
					<TD height="25" colspan="2" class="bigWhite"><strong><?php if($id==''){?>
				    <?php }else{?>
				    Düzenle
				    <?php }?> 
				    Kullanıcı Detayları</strong>
				    </TD>
				</TR>
			    <?php if($_SESSION['sess_msg']){?>
				<tr>
					<td colspan="2" align="center"  class="warning" style="padding:5px; "><?php echo $_SESSION['sess_msg']; $_SESSION['sess_msg']='';?></td>
				</tr>
				<?php }?>
				<tr class="oddRow">
					<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Doldurulması Zorunludur.</td>
				</tr>
				<tr class="evenRow">
					<td  align="right" width="35%" class="txt"><strong >Kullanıcı  ID:  </strong></td>
				  <td align="left" width="65%"><input type="text" name="user_id" style="width:250px;" value="<?php echo $user_id;?>" class="txtfld txt" />
                    <span class="txt"><span class="warning">*</span></span></td>
				</tr>
                 <?php if($_SESSION['sess_type']=='Super Admin' ){?>
				<tr class="oddRow">
				  <td class="txt" align="right"><strong>Şifre :</strong></td>
				  <td align="left"><input type="text" name="password" style="width:250px;" value="<?php echo $password;?>" class="txtfld txt" />
			      <span class="txt"><span class="warning">*</span></span></td>
				  </tr>
                  <?php
				  }
				  else
				  {
				 ?>
                  <tr class="oddRow">
				  <td class="txt" align="right"><strong>Şifre :</strong></td>
				  <td align="left"><input type="password" name="password" style="width:250px;" value="<?php echo $password;?>" class="txtfld txt" />
			      <span class="txt"><span class="warning">*</span></span></td>
				  </tr>
                 <?php
				 }
				 ?> 
				<tr class="evenRow">
					<td  align="right" width="35%" class="txt"><strong >Adı Soyadı :  </strong></td>
				  <td align="left" width="65%"><input type="text" name="full_name" style="width:250px;" value="<?php echo $full_name;?>" class="txtfld txt" />
                    <span class="txt"><span class="warning">*</span></span></td>
				</tr>
				<tr class="oddRow">
					<td  align="right" width="35%" class="txt"><strong >ePosta:  </strong></td>
				  <td align="left" width="65%"><input type="text" name="email" style="width:250px;" value="<?php echo $email;?>" class="txtfld txt" />
                    <span class="txt"><span class="warning">*</span></span></td>
				</tr>
				<!--<tr class="evenRow">
					<td  align="right" width="35%" class="txt"><strong >Contact Info:  </strong></td>
				  <td align="left" width="65%"><textarea name="contact_info" style="width:250px; height:100px;" class="txtfld txt" ><?php echo $contact_info;?></textarea>
                    <span class="txt"><span class="warning">*</span></span></td>
				</tr>-->
				<tr class="oddRow">
					<td  align="right" width="35%" class="txt"><strong >Kullanıcı Tipi :  </strong></td>
				  <td align="left" width="65%"><select name="user_type" class="txtfld txt"  style="width:250px;">
				    <option value="">Birini Seçiniz</option>
                                                <?php
													if($_SESSION['sess_type']=='Super Admin')
													{
												?>
                                                <option value="Super Admin"<?php if($user_type=='Super Admin'){ echo 'selected';} ?>>Super Admin</option>
                                                <?php
												}
												?>
                                                <option value="Admin"<?php if($user_type=='Admin'){ echo 'selected';} ?>>Admin</option>
												<option value="Editors"<?php if($user_type=='Editors'){ echo 'selected';} ?>>Editors</option>
                                                <option value="Member"<?php if($user_type=='Editors'){ echo 'selected';} ?>>Member</option>
												<option value="Hotel Owners"<?php if($user_type=='Hotel Owners'){ echo 'selected';} ?>>Place Owner</option>
												</select>
                    <span class="txt"><span class="warning">*</span></span></td>
				</tr>
				<TR class="evenRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Gönder"/> <?php if($id==''){?><input type="reset" name="reset" class="button" value="Formu Temizle" /><? }?></TD>
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