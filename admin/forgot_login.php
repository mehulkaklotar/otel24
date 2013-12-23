<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
@extract($_POST);
if($submit=='yes'){
$sql4=executeQuery("select * from tbl_user where  user_id='$username'");
$line2=mysql_num_rows($sql4);
if($username==''){
$_SESSION['sess_msg']='Please Enter Username';
}
else if($line2<=0){
$_SESSION['sess_msg']='Username is Wrong';
}
else
{
$line2=mysql_fetch_array($sql4);
//extract the email for ForGot Login Information
	          
	           $subject="Your login details - Otel24";
			   $email="Your login details are given below:<br>";
			   $email.="Username: [USERNAME]<br>";
			   $email.="Password: [PASSWORD]<br>";
			   $email.="<br>Thanks,<br>http://otel24.com.tr";
	           $email=str_replace("[USERNAME]",$line2['user_id'],$email);
			   $email=str_replace("[PASSWORD]",$line2['password'],$email);
			   $email=str_replace("SITE_URL",SITE_URL,$email);
	           $headers  = 'MIME-Version: 1.0' . "\r\n";
               $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
               $headers .= "From: Otel24 <admin@otel24.com.tr>\r\n";
               $to = $line2['email'];
			   
               @mail($to, $subject, nl2br($email), $headers);
			   $_SESSION['sess_msg']='Your Login Information has been sent to your Email Address';
			   header("Location: forgot_login.php");
			   exit();
}		
}	   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
<script src="../codelibrary/js/script_tmt_validator.js" type="text/javascript"></script>
</head>
<body >
<?php
require_once("header.inc.php");
?>
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
<form name="login" method="post" action="forgot_login.php" enctype="multipart/form-data" tmt:validate="true">
      <table width="300" border="0" cellpadding="0" cellspacing="0" class="greyBorder">
        <tr>
          <td height="30" align="left" class="blueBackground">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bigWhite">Forgot Login Information </span></td>
        </tr>
        <tr>
          <td><table width="370" border="0" cellspacing="0" cellpadding="4">
              
              <tr class="oddRow">
                <td width="80" ><span class="txt">USERNAME</span></td>
                <td height="30" align="left"><input name="username" type="text" class="txtfld" tmt:required="true"  tmt:message="Please Enter Username"/></td>
              </tr>
              <tr class="evenRow">
                <td width="80"><span class="txt"></span></td>
                <td height="30" align="left"><input type='hidden' name="submit" value="yes" /><input type="image" src="images/submit.gif" width="82" height="26" /><br /><a href="index.php" class="bldTxt">Back to login page</a></td>
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
<?php require_once("footer.inc.php");?>
</body>
</html>
