<?php
session_start();
require_once("../codelibrary/inc/variables.php");
if(isset($_POST['signup']))
{
	$sel = "select * from tbl_user where email='".mysql_real_escape_string($_POST['email'])."' and password='".mysql_real_escape_string($_POST['passwd'])."' and user_type='Member' and status=1";
	$res = mysql_query($sel) or die(mysql_error());
	if(mysql_num_rows($res) > 0)
	{
		$rowid = mysql_fetch_object($res);
		$_SESSION['userid'] = $rowid->id;
	}
	else
	{
		$msg = "Invalid login..";

	}
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="100%" style="padding-left:20px; padding-right:20px;" border="0" cellspacing="4" cellpadding="4">
  <tr>
    <td>Sign in to Otel24 </td>
  </tr>
  <tr>
    <td>Sign in using your Facebook account</td>
  </tr>
  <tr>
    <td><img src="images/facebook.png"  /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
            <form name="frmlogin" method="post" action="" >
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>...or sign in to your Otel24 account </td>
                  </tr>
                  <tr>
                    <td><?php echo $msg;?></td>
                  </tr>
                  <tr>
                    <td>Email address<br>
<input type="text" name="email" size="30" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Password<br>
<input type="password" name="passwd" size="30" /> <a href="forgot.php">Forgot Password</a></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><input type="submit" name="signin" value="Sign in" ></td>
                  </tr>
                </table>
                </form>            </td>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Don't have Otel24 account?</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><a href="register.php">Join free</a></td>
                  </tr>
                </table>

            </td>
          </tr>
        </table>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
</table>
</body>
</html>