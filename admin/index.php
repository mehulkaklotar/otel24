<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
<script src="../codelibrary/js/script_tmt_validator.js" type="text/javascript"></script>
</head>
<body >
<?php require_once("header.inc.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="images/spacer.gif" width="1" height="1" /></td>
  </tr>
</table>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>

    <td height="400" align="center" valign="top"><p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p align="center" class="warning"><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></p>
<form name="login" method="post" action="login.php" enctype="multipart/form-data" tmt:validate="true">
      <table width="300" border="0" cellpadding="0" cellspacing="0" class="greyBorder">
        <tr>
          <td height="30" align="left" class="blueBackground">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bigWhite">Benim Hesabım</span></td>
        </tr>
        <tr>
          <td><table width="370" border="0" cellspacing="0" cellpadding="4">
              
              <tr class="oddRow">
                <td width="80" ><span class="txt">Kullanıcı ID</span></td>
                <td height="30" align="left"><input name="username" type="text" class="txtfld" tmt:required="true"  tmt:message="Please Enter Username"/></td>
              </tr>
              <tr>
                <td width="80"><span class="txt">Şifre</span></td>
                <td height="30" align="left"><input name="password" type="password" class="txtfld" tmt:required="true" tmt:message="Plesae Enter Password" /></td>
              </tr>
			  <tr class="oddRow">
                <td width="80"><span class="txt"></span></td>
                <td height="30" align="left"><input type='hidden' name="logged" value="yes" /><input type="image" src="images/submittr.jpg" width="84" height="37" /><br /><br /><a href="forgot_login.php" class="bldTxt">Şifremi Unuttum</a></td>
              </tr>
			 
		</table></td>
        </tr>
      </table>
    </form>
    <p>&nbsp;</p>
    <p><br />
    </p>
    <p>&nbsp;</p></td>
  </tr>
</table>
<?php
require_once("footer.inc.php");
?>
</body>
</html>