<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
include("FCKeditor/fckeditor.php");
validate_admin();
@extract($_REQUEST);
//SELECT * FROM `tbl_content` WHERE 1`id`, `menus`, `title`, `description`, `access_level`, `generated_by`, `modified_by`, `create_date`, `mdification_date`, `status`

if ($_POST['submitForm'] == "yes")
{    
     if($id){
		 $sql_ch=executeQuery("select * from tbl_content where (menus ='$menus' or title='$title') and id!='$id'");
		}else{
		 $sql_ch=executeQuery("select * from tbl_content where menus ='$menus' or title='$title'");
		}
     if(@mysql_num_rows($sql_ch)>0)
	 {
	    $_SESSION['sess_msg']='Content Menu / Title  already exist!';
	    header("Location: content_addf.php");
		exit();
	 }else {
	 	if($id==''){
		  executeQuery("insert into tbl_content set menus='$menus',title='$title',description='$description',menus_Turkish='$menus_Turkish',title_Turkish='$title_Turkish',description_Turkish='$description_Turkish',generated_by='".$_COOKIE['sess_username']."',create_date=now()");
	    $_SESSION['sess_msg']='Content added successfully!';
	 	}else {
			executeQuery("update tbl_content set menus='$menus',title='$title',description='$description',menus_Turkish='$menus_Turkish',title_Turkish='$title_Turkish',description_Turkish='$description_Turkish',modified_by='".$_COOKIE['sess_username']."',mdification_date='$mdification_date' where id='$id'");
	    $_SESSION['sess_msg']='Content updated successfully!';
	 	}	  
		   header("Location: content_list.php");
		   exit();
}
}
if($id){
		$sql="select * from tbl_content where id='$id'";
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
   
   /*	if(obj.menus.value == ''){
	alert("Please Enter Menu!");
	obj.menus.focus();
	return false;
	}
   	else if(obj.title.value == ''){
	alert("Please Enter Title !");
	obj.title.focus();
	return false;
	}
	else if(obj.description.value == ''){
	alert("Please Enter Description !");
	obj.description.focus();
	return false;
	} 
	else
	{
		return true;
	}*/
}   
		
	
</script>
<script language="javascript">
function suffleon()
{
document.getElementById("myturkey").style.display='inline';document.getElementById("myenglish").style.display='none';
document.getElementById("myid").className='linkactive';
document.getElementById("myid1").className='linkstyle';

}
function suffleoff()
{
document.getElementById("myturkey").style.display='none';document.getElementById("myenglish").style.display='inline';
document.getElementById("myid1").className='linkactive';
document.getElementById("myid").className='linkstyle';

}
</script>
<style type="text/css">
a.linkstyle{
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
font-weight:bold;
text-decoration:none;
color:#79ccd9;
}
.linkstyle a{
color:#79ccd9;
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
font-weight:bold;
text-decoration:none;
}
.linkstyle a:hover{
color:#79ccd9;
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
font-weight:bold;
text-decoration:underline;
}
a.linkactive{
color:#7b8992;
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
font-weight:bold;
text-decoration:none;
}


</style>
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Content</td>
                      <td width="24%" align="right"><input name="b1" type="button" class="button" id="b1" value="User Content" onClick="location.href='content_list.php'">
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top">
			<br />
             <div class="linkstyle"><a href="javascript:;" id="myid" onclick="javascript:suffleon();">Türkçe</a> <a href="javascript:;" id="myid1" onclick="javascript:suffleoff();">English</a>
</div>
            <br>
              <form action="content_addf.php" method="post" enctype="multipart/form-data" name="frm"    onsubmit="return validate_form(this)">
			  <input type="hidden" name="submitForm" value="yes">
			  <input type="hidden" name="id" class="txtfld txt" value="<?php echo $id;?>">
				<table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#398FA8"> 
					<TD height="25" colspan="2" class="bigWhite"><strong><?php if($id==''){?>
				    Add New
				    <?php }else{?>
				    Edit
				    <?php }?> 
				    Content Details</strong>				    </TD>
				</TR>
			    <?php if($_SESSION['sess_msg']){?>
				<tr>
					<td colspan="2" align="center"  class="warning" style="padding:5px; "><?php echo $_SESSION['sess_msg']; $_SESSION['sess_msg']='';?></td>
				</tr>
				<?php }?>
				<tr class="oddRow">
					<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Doldurulması zorunludur.</td>
				</tr>
                
                <tr >
					<td colspan="2">
                    <div id="myenglish" style="display:none;">
                    	<table width="100%">
                        	<tr class="evenRow">
					<td  align="right" width="35%" class="txt"><strong >Menu Name</strong></td>
				  <td align="left" width="65%"><input type="text" name="menus" style="width:250px;" value="<?php echo $menus;?>" class="txtfld txt" />
                    </td>
				</tr>
                <tr class="oddRow">
				  <td class="txt" align="right"><strong>Title</strong></td>
				  <td align="left"><input type="text" name="title" style="width:250px;" value="<?php echo $title;?>" class="txtfld txt" />
			     </td>
				  </tr>
                 <tr class="evenRow">
					<td  align="right" width="35%" class="txt"><strong >Description</strong></td>
				  <td align="left" width="65%">
                  <?php  $ofckeditor = new fckeditor('description');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($description);
														$ofckeditor->Create();?>
                    </td>
				</tr>
                        </table>
                        </div>
                    </td>
				</tr>
               
                
                
                
                 
                 <tr >
					<td colspan="2">
                    <div id="myturkey" >
                    	<table width="100%">
                        <tr class="evenRow">
                            <td  align="right" width="35%" class="txt"><strong >Link Adı  </strong></td>
                          <td align="left" width="65%"><input type="text" name="menus_Turkish" style="width:250px;" value="<?php echo $menus_Turkish;?>" class="txtfld txt" />
                            <span class="txt"></span></td>
                        </tr>
                        
                        <tr class="oddRow">
                          <td class="txt" align="right"><strong>Başlık</strong></td>
                          <td align="left"><input type="text" name="title_Turkish" style="width:250px;" value="<?php echo $title_Turkish;?>" class="txtfld txt" />
                          <span class="txt"></span></td>
                          </tr>
                        
                        <tr class="evenRow">
                            <td  align="right" width="35%" class="txt"><strong >Açıklama  </strong></td>
                          <td align="left" width="65%">
                          <?php  $ofckeditor = new fckeditor('description_Turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($description_Turkish);
														$ofckeditor->Create();?>
                         
                            <span class="txt"></span></td>
                        </tr>
                       </table>
                       </div>
                    </td>
                    </tr>  
				
				
				<TR class="oddRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Gönder"/> <?php if($id==''){?><input type="reset" name="reset" class="button" value="Sil" /><? }?></TD>
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